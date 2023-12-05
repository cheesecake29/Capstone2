<?php
$appointmentList = $conn->query("SELECT a.*, cl.firstname, cl.lastname, a.status as appt_status from appointment a inner join client_list cl on cl.id = a.client_id order by a.datetime");
?>
<div class="container">
    <div class="d-flex justify-content-center">
        <div id="calendar_div" class="mx-5" style="min-width: 750px; max-width: 750px;">
            <?php
            include './../calendar.php';
            echo getCalendar();
            ?>
        </div>
    </div>
    <div class="appointment-list my-5">
        <div class="config-header">
            <h1>Appointment List</h1>
        </div>
        <div class="dropdown-divider my-4"></div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Order ID</th>
                    <th scope="col">Client Name</th>
                    <th scope="col">Dates</th>
                    <th scope="col">Status</th>
                    <th scope="col">Submitted On</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

                <?php
                while ($row = $appointmentList->fetch_assoc()) :
                ?>
                    <tr>
                        <td><a href="<?php echo base_url ?>admin/?page=orders/view_order&id=<?= $row['order_id'] ?>"><?= $row['order_id'] ?></a></td>
                        <th><?= $row['lastname'] ?>, <?= $row['firstname'] ?></th>
                        <td><?= $row['dates'] ?> - <?= $row['hours'] ?></td>
                        <td>
                            <?php switch (strval($row['appt_status'])):
                                case 0: ?>
                                    <b class="text-secondary">Pending </b>
                                <?php break;
                                case 1: ?>
                                    <b class="text-success">Confirmed</b>
                                <?php break;
                                case 2: ?>
                                    <b class="text-danger">Cancelled</b>
                                <?php break;
                                case 3: ?>
                                    <b class="text-danger">Rejected</b>
                                <?php break;
                                default: ?>
                                    <b class="text-secondary">Pending</b>
                                    <?php break; ?>
                            <?php endswitch; ?>
                        </td>
                        <td><?= date('Y-m-d h:m:s a', strtotime($row['datetime'])) ?></td>
                        <td><button class="btn btn-link text-primary update_appointment" data-id="<?php echo $row['id'] ?>"><i class="fas fa-edit"></i></button></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>


<div class="modal fade" id="update_status" role='dialog'>
    <div class="modal-dialog modal-lg modal-dialog-end" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Update appointment</h3>
            </div>
            <form id="update-appt-status" action="">
                <div class="modal-body">
                    <input type="hidden" id="appointment_id" name="appointment_id">
                    <select class="form-control" id="status" name="status">
                        <option value="0">Pending</option>
                        <option value="1">Confirmed</option>
                        <option value="2">Cancelled</option>
                        <option value="3">Rejected</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.update_appointment').click(function() {
            $('#update_status').modal('show');
            const appointmentId = $(this).attr('data-id');
            $('#appointment_id').val(appointmentId);
        })
        // max order config submission
        $('#update-appt-status').submit(function(e) {
            e.preventDefault();
            const formData = new FormData($(this)[0]);
            var appointmentId = parseInt(formData.get('appointment_id'));
            var status = parseInt(formData.get('status'));
            console.log({
                appointmentId,
                status
            })
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=update_appt_status",
                data: {
                    appointmentId,
                    status
                },
                method: 'POST',
                type: 'POST',
                dataType: 'json',
                success: function(resp) {
                    if (typeof resp == 'object' && resp.status == 'success') {
                        location.href = './?page=shop_calendar';
                    } else {
                        alert_toast("An error occured", 'error');
                        console.log(resp)
                    }
                }
            })
        })
    })
</script>