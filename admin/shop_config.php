<?php
$shop_config = $conn->query("SELECT * from shop_config limit 1");
if ($shop_config->num_rows > 0) {
    $config = $shop_config->fetch_assoc();
}
?>

<style>
    .ui-datepicker {
        min-width: 300px;
    }

    .ui-datepicker .ui-datepicker-calendar {
        background: #fff;
    }

    .ui-datepicker table {
        width: 100%;
    }


    .ui-datepicker table td,
    .ui-datepicker table td th {
        border: 1px solid #1A547E;
        padding: 5px;
    }

    .ui-datepicker>table .ui-datepicker-unselectable {
        background-color: #1A547E;
        color: white;
    }

    .ui-datepicker>table .ui-datepicker-unselectable .ui-state-default {
        border: unset;
    }

    .ui-datepicker-header .ui-datepicker-prev {
        position: absolute;
        padding: 5px;
        color: white;
        left: 8px;
        cursor: pointer;
    }

    .ui-datepicker-header .ui-datepicker-title {
        width: 100%;
        text-align: center;
    }

    .ui-datepicker-header .ui-datepicker-next {
        position: absolute;
        padding: 5px;
        color: white;
        right: 8px;
        cursor: pointer;
    }

    .ui-datepicker-header {
        display: flex;
        align-items: center;
        background: #1A547E;
        min-height: 35px;
        color: white;
    }


    .ui-state-default,
    .ui-widget-content .ui-state-default,
    .ui-widget-header .ui-state-default {

        border-width: 1px 0 0 1px;
    }
</style>
<div class="order-configuration px-3 bg-white mb-5">
    <h1 class="pt-3">Shop Configuration</h1>
    <div class="dropdown-divider my-3"></div>
    <div class="config-body">
        <form id="shop-config" action="">
            <div class="d-flex align-items-end">
                <div class="mr-2">
                    <label for="opening" class="control-label">Opening</label>
                    <input name="opening" id="opening" class="form-control" value="<?= isset($config) ? $config['opening'] : ''; ?>" placeholder="Select a time">
                </div>
                <div class="mr-2">
                    <label for="closing" class="control-label">Closing</label>
                    <input name="closing" id="closing" disabled class="form-control" value="<?= isset($config) ? $config['closing'] : ''; ?>" required>
                </div>
                <div class="mr-2">
                    <label for="appointment_interval" class="control-label">Appointment Interval <small>per minutes</small></label>
                    <input name="appointment_interval" id="appointment_interval" type="number" min="15" class="form-control" value="<?= isset($config) ? $config['appointment_interval'] : ''; ?>" required>
                </div>
                <div class="d-flex align-items-end">
                    <button class="btn btn-flat btn-primary" type="submit">Save</button>
                </div>
            </div>
        </form>
    </div>
    <div class="dropdown-divider my-3"></div>
    <h3>Shop Unavailable Dates</h3>
    <form id="shop-unavailable" action="">
        <div class="d-flex flex-column align-items-start">
            <div class="d-flex flex-column">
                <div class="mr-2">
                    <label for="schedule" class="control-label">When</label>
                    <input name="schedule" id="schedule" class="form-control" value="<?= isset($setup) ? $setup['schedule'] : ''; ?>" placeholder="Select a time">
                </div>
                <div class="d-flex flex-column">
                    <label for="comments" class="control-label">Comments</label>
                    <textarea class="form-control" name="comments"><?= isset($setup) ? $setup['comments'] : ''; ?></textarea>
                </div>
            </div>
            <div class="d-flex align-items-end mt-3">
                <button class="btn btn-flat btn-primary" type="submit">Save</button>
            </div>
        </div>
    </form>
    <div class="d-flex justify-content-center">
        <div id="calendar_div" class="mx-5" style="min-width: 750px; max-width: 750px;">
            <?php
            include './../calendar.php';
            echo getCalendar();
            ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#schedule").datepicker({
            todayHighlight: true,
            minDate: 3,
            dateFormat: 'yy-mm-dd',
            beforeShowDay: function(date) {
                var day = date.getDay();
                return [(day != -1), ''];
            },
        });
        $("#opening").timepicker({
            minTime: '1am',
            maxTime: '11pm',
            timeFormat: 'h:i a',
            step: 15,
            dropdown: true,
            scrollbar: true,
        });
        $("#opening").on('change', function(e) {
            const openingValue = moment(`1990-01-01 ${e.currentTarget.value}`).format('LLL');
            const closingValue = $("#closing").val() != '' ? moment(`1990-01-01 ${$("#closing").val()}`).format('LLL') : $("#closing").val();
            const clearClosingValue = moment(new Date(closingValue)).isBefore(new Date(openingValue));
            if (clearClosingValue) {
                $("#closing").val(moment(openingValue).format('hh:mm a'))
            }
            $("#closing").removeAttr('disabled');
            $("#closing").timepicker({
                minTime: e.currentTarget.value,
                timeFormat: 'h:i a',
            });
        });
        // shop config submission
        $('#shop-config').submit(function(e) {
            e.preventDefault();
            const formData = new FormData($(this)[0]);
            // Display the values
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=save_shop_config",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
                success: function(resp) {
                    console.log(resp)
                    if (typeof resp == 'object' && resp.status == 'success') {
                        location.href = './?page=shop_config';
                    } else {
                        alert_toast("An error occured", 'error');
                        console.log(resp)
                    }
                }
            })
        })
        $('#shop-unavailable').submit(function(e) {
            e.preventDefault();
            const formData = new FormData($(this)[0]);
            // Display the values
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=save_unavailable_dates",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
                success: function(resp) {
                    console.log(resp)
                    if (typeof resp == 'object' && resp.status == 'success') {
                        location.href = './?page=shop_config';
                    } else {
                        alert_toast("An error occured", 'error');
                        console.log(resp)
                    }
                }
            })
        })
    })
</script>