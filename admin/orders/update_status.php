<?php 
require_once('./../../config.php');
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `order_list` where id = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        foreach($qry->fetch_array() as $k => $v){
            if(!is_numeric($k))
            $$k = $v;
        }
    }
}
?>
<head>
    <!-- Other head elements -->

    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="path/to/bootstrap.min.css">
</head>

<div class="container-fluid">
    <form action="" id="update_order">
        <input type="hidden" name="id" value="<?= isset($id) ? $id : "" ?>">
        <input type="hidden" name="client_id" value="<?= isset($client_id) ? $client_id : "" ?>">
        <div class="form-group">
            <label for="status" class="control-label">Status</label>
            <select name="status" id="status" class="custom-select form-control-sm">
             
                <option value="0" <?= isset($status) && $status == 0 ? 'selected' : "" ?>>Confirm</option>
                <option value="1" <?= isset($status) && $status == 1 ? 'selected' : "" ?>>Ready to ship</option>
                <option value="2" <?= isset($status) && $status == 2 ? 'selected' : "" ?>>Delivered</option>
                <option value="3" <?= isset($status) && $status == 3? 'selected' : "" ?>>Cancelled</option>
            </select>
        </div>
    </form>
</div>
<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Item Packed</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                The item has been packed!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
    // Handle change event of the status dropdown
    $('#status').change(function () {
        var selectedStatus = parseInt($(this).val());

        console.log("selected status: ", selectedStatus);

        // Check if the selected status is "Delivered" or "Confirm"
        if (selectedStatus === 5) {
            disableOptions([1, 3, 4, 5]);
        } else {
            // Enable all options if the status is not "Delivered" or "Confirm"
            enableAllOptions();
        }
    });

    // Trigger the change event initially to apply the correct options based on the default selected status
    $('#status').change();

    $('#update_order').submit(function (e) {
        e.preventDefault();
        var _this = $(this);
        $('.err-msg').remove();
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Master.php?f=update_order_status",
            data: new FormData(_this[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            dataType: 'json',
            error: function (err) {
                console.log(err);
                alert_toast("An error occurred", 'error');
                end_loader();
            },
            success: function (resp) {
                if (resp.status === 'success') {
                    // Check if the selected status is "Confirm"
                    if (parseInt($('#status').val()) === 1) {
                        // Show a Bootstrap modal when the status is set to "Confirm"
                        $('#confirmationModal').modal('show');
                    }
                } else if (resp.status === 'failed' && resp.msg) {
                    var el = $('<div>').addClass("alert alert-danger err-msg").text(resp.msg);
                    _this.prepend(el).show('slow');
                    $("html, body").animate({
                        scrollTop: _this.closest('.card').offset().top
                    }, "fast");
                } else {
                    alert_toast("An error occurred", 'error');
                    console.log(resp);
                }
                end_loader();
            }
        });
    });
});

function disableOptions(optionsToDisable) {
    optionsToDisable.forEach(function (optionValue) {
        var option = $('select[name="status"] option[value="' + optionValue + '"]');
        if (option.length > 0) {
            option.prop('disabled', true);
        }
    });
}

function enableAllOptions() {
    $('select[name="status"] option').prop('disabled', false);
}



</script>

