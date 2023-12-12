<?php
require_once('./../../config.php');
if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM `supplier_list` WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the data
        $row = $result->fetch_assoc();
        // Assign the values to variables
        $id = $row['id'];
        $name = $row['name'];
        $contact = $row['contact'];
        $email = $row['email'];
        $status = $row['status'];
    }
    $stmt->close();
}

?>
<style>
    #uni_modal img#cimg{
		height: 5em;
		width: 5em;
		object-fit: scale-down;
		object-position: center center;
	}
</style>
<div class="container-fluid">
<form action="" id="supplier-form">
			<input type="hidden" name ="id" value="<?php echo isset($id) ? $id : '' ?>">
            <div class="form-group">
    

			<div class="form-group">
				<label for="name" class="control-label">Name</label>
                <input name="name" id="name" type="varchar" class="form-control rounded-0" value="<?php echo isset($name) ? $name : ''; ?>" onkeydown="return allowOnlyLetters(event)" required>
			</div>
			<div class="form-group">
				<label for="sup_contact" class="control-label">Contact</label>
                <input name="sup_contact" id="sup_contact" type="text" class="form-control rounded-0" value="<?php echo isset($sup_contact) ? $sup_contact: ''; ?>" onkeydown="return allowOnlyNumbers(event)" maxlength="11" required>
			</div>
           
			
            <div class="form-group">
				<label for="status" class="control-label">Status</label>
                <select name="status" id="status" class="custom-select selevt">
                <option value="1" <?php echo isset($status) && $status == 1 ? 'selected' : '' ?>>Active</option>
                <option value="0" <?php echo isset($status) && $status == 0 ? 'selected' : '' ?>>Inactive</option>
                </select>
			</div>
			</div>
			
		</form>
</div>
<script>

function allowOnlyLetters(event) {
        // Check if the key pressed is a letter
        if (event.key.match(/[A-Za-z]/)) {
            return true;  // Allow the key press
        } else {
            return false; // Prevent the key press
        }
    }


function allowOnlyNumbers(event) {
    // Check if the key pressed is a number or the backspace key
    if (event.key.match(/[0-9]/) || event.keyCode === 8 /* Backspace */) {
        return true;  // Allow the key press
    } else {
        return false; // Prevent the key press
    }
}

	$(document).ready(function(){
		$('#supplier-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_supplier",
				data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
				error:err=>{
					console.log(err)
					alert_toast("An error occured",'error');
					end_loader();
				},
				success:function(resp){
					if(typeof resp =='object' && resp.status == 'success'){
						location.href = "./?page=maintenance/supplier";
					}else if(resp.status == 'failed' && !!resp.msg){
                        var el = $('<div>')
                            el.addClass("alert alert-danger err-msg").text(resp.msg)
                            _this.prepend(el)
                            el.show('slow')
                            $("html, body").animate({ scrollTop: _this.closest('.card').offset().top }, "fast");
                            end_loader()
                    }else{
						alert_toast("An error occured",'error');
						end_loader();
                        console.log(resp)
					}
				}
			})
		})
    })
   
</script>