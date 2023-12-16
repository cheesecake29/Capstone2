<?php
$shop_config = $conn->query("SELECT * from shop_config limit 1");
$unavailable_dates = $conn->query("SELECT * from unavailable_dates");
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

    /* Default styles for all screen sizes */
.order-configuration {
  padding: 0;
}

.config-body {
  width: 100%;
}

/* Media queries for different screen sizes */
@media only screen and (max-width: 480px) {
  /* 320px - 480px: Mobile devices */
  .config-body {
    width: 100%;
  }

  .config-body form {
    width: 100%;
  }

  .config-body form .d-flex {
    flex-direction: column;
  }

  .config-body form .d-flex .mr-2,
  .config-body form .d-flex .mr-2 .schedule-interval {
    margin-right: 0;
    margin-bottom: 10px;
  }

  .main-container {
    width: 100%;
    overflow-x: auto;
  }
}

@media only screen and (min-width: 481px) and (max-width: 768px) {
  /* 481px - 768px: iPads, Tablets */
  .config-body {
    width: 100%;
  }

  .config-body form {
    width: 100%;
  }

  .config-body form .d-flex {
    flex-direction: column;
  }

  .config-body form .d-flex .mr-2,
  .config-body form .d-flex .mr-2 .schedule-interval {
    margin-right: 0;
    margin-bottom: 10px;
  }

  .main-container {
    width: 100%;
    overflow-x: auto;
  }
}

@media only screen and (min-width: 769px) and (max-width: 1024px) {
  /* 769px - 1024px: Small screens, laptops */
  .config-body {
    width: 100%;
  }

  .config-body form {
    width: 100%;
  }

  .config-body form .d-flex {
    flex-direction: column;
  }

  .config-body form .d-flex .mr-2,
  .config-body form .d-flex .mr-2 .schedule-interval {
    margin-right: 0;
    margin-bottom: 10px;
  }

  .main-container {
    width: 100%;
    overflow-x: auto;
  }
}

@media only screen and (min-width: 1025px) and (max-width: 1200px) {
  /* 1025px - 1200px: Desktops, large screens */
  .config-body {
    width: 100%;
  }

  .config-body form {
    width: 100%;
  }

  .config-body form .d-flex {
    flex-direction: column;
  }

  .config-body form .d-flex .mr-2,
  .config-body form .d-flex .mr-2 .schedule-interval {
    margin-right: 0;
    margin-bottom: 10px;
  }

  .main-container {
    width: 100%;
    overflow-x: auto;
  }
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
                    <label for="max_appointment" class="control-label">Maximum Customer<small>per day</small></label>
                    <input 
  name="max_appointment" 
  id="max_appointment" 
  type="number" 
  min="1"  
  max="25" 
  class="form-control" 
  value="<?= isset($config['max_appointment']) ? $config['max_appointment'] : ''; ?>" 
  required
>


                </div>
                <div class="mr-2">
                    <label for="appointment_interval" class="control-label">Time Interval <small>per minutes</small></label>
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
                <div class="mr-2 mb-2">
                    <label for="schedule" class="control-label">When</label>
                    <input name="schedule" id="schedule" class="form-control" placeholder="Select a date">
                </div>
                <div class="mr-2 d-flex mb-2">
                    <div class="schedule-interval">
                        <label for="from_hours" class="control-label">From</label>
                        <input name="from_hours" id="from_hours" class="form-control" placeholder="Select a time">
                    </div>
                    <div class="schedule-interval ml-1">
                        <label for="to_hours" class="control-label">To</label>
                        <input name="to_hours" id="to_hours" disabled class="form-control" required>
                    </div>
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
    <div class="main-container my-5">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">When</th>
                    <th scope="col">Time</th>
                    <th scope="col">Comments</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

                <?php
                while ($row = $unavailable_dates->fetch_assoc()) :
                ?>
                    <tr>
                        <td><?= date('Y-m-d h:m:s a', strtotime($row['schedule'])) ?></td>
                        <td><?= isset($row['from_hours']) ? $row['from_hours'] : 'N/A'; ?> - <?= isset($row['to_hours']) ? $row['to_hours'] : 'N/A'; ?></td>

                        <td><?= $row['comments'] ?></td>
                        <td><button class="btn btn-link text-danger remove_config" data-id="<?php echo $row['id'] ?>"><i class="fas fa-trash"></i></button></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
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
        $('.table').dataTable();
        $('.remove_config').on('click', function() {
            const id = $(this).data('id');
            const currentRow = $(this); // Store the reference to this element
            // Confirm deletion
            if (confirm('Are you sure you want to delete this record?')) {
                // Send AJAX request to delete the record
                $.ajax({
                    url: _base_url_ + "classes/Master.php?f=delete_unavailable_dates",
                    data: {
                        id
                    },
                    method: 'POST',
                    type: 'POST',
                    dataType: 'json',
                    success: function(resp) {
                        if (typeof resp == 'object' && resp.status == 'success') {
                            // Remove the row from the table
                            currentRow.closest('tr').remove();
                            alert_toast('Unavailable date successfully deleted', 'success');
                        } else {
                            alert_toast("An error occurred", 'error');
                            console.log(resp);
                        }
                    }
                });
            }
        })
        $("#schedule").datepicker({
            todayHighlight: true,
            minDate: 1,
            dateFormat: 'yy-mm-dd',
            beforeShowDay: function(date) {
                var day = date.getDay();
                return [(day != -1), ''];
            },
        });
        $("#from_hours").timepicker({
            minTime: '1am',
            maxTime: '11pm',
            timeFormat: 'h:i a',
            step: 30,
            dropdown: true,
            scrollbar: true,
        });
        $("#from_hours").on('change', function(e) {
            const openingValue = moment(`1990-01-01 ${e.currentTarget.value}`).format('LLL');
            const closingValue = $("#to_hours").val() != '' ? moment(`1990-01-01 ${$("#to_hours").val()}`).format('LLL') : $("#to_hour").val();
            const clearClosingValue = moment(new Date(closingValue)).isBefore(new Date(openingValue));
            if (clearClosingValue) {
                $("#closing").val(moment(openingValue).format('hh:mm a'))
            }
            $("#to_hours").removeAttr('disabled');
            $("#to_hours").timepicker({
                minTime: e.currentTarget.value,
                timeFormat: 'h:i a',
                step: 30,
            });
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
                step: 15,
            });
        });
        // shop config submission
        $('#shop-config').submit(function(e) {
            e.preventDefault();
            $("#closing").removeAttr('disabled');
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
            const startValue = formData.get('from_hours');
            const endValue = formData.get('to_hours');
            const start = moment(`1990-01-1 ${startValue}`);
            const end = moment(`1990-01-1 ${endValue}`);
            const duration = moment.duration(moment(end).diff(start)).asHours();
            formData.append('duration', parseFloat(duration));
            console.log(formData.get('duration'))
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