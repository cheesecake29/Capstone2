<?php
// 0=pending,1 = confirmed, 2 = packed, 3 = for delivery, 4 = on the way, 5= delivered, 6=cancelled
$pending = $conn->query("SELECT * FROM `order_list` where client_id = '{$_settings->userdata('id')}' and status = 0 order by unix_timestamp(date_created) desc ");
$confirmed = $conn->query("SELECT * FROM `order_list` where client_id = '{$_settings->userdata('id')}' and status in (1,2)  order by unix_timestamp(date_created) desc ");
$forDelivery = $conn->query("SELECT * FROM `order_list` where client_id = '{$_settings->userdata('id')}' and status = 3 order by unix_timestamp(date_created) desc ");
$onTheWay = $conn->query("SELECT * FROM `order_list` where client_id = '{$_settings->userdata('id')}' and status = 4 order by unix_timestamp(date_created) desc ");
$delivered = $conn->query("SELECT * FROM `order_list` where client_id = '{$_settings->userdata('id')}' and status = 5 order by unix_timestamp(date_created) desc ");
$cancelled = $conn->query("SELECT * FROM `order_list` where client_id = '{$_settings->userdata('id')}' and status = 6 order by unix_timestamp(date_created) desc ");
$return = $conn->query("SELECT * FROM `order_list` where client_id = '{$_settings->userdata('id')}' and status = 7 order by unix_timestamp(date_created) desc ");

?>

<style>
    .text-center {
        color: #004399;
    }
</style>
<div class="content py-5 mt-3">
    <div class="container">
        <h3><b>My Orders</b></h3>
        <hr>
        <div class="row">
            <div class="col-2">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-pending-tab" data-toggle="pill" href="#v-pills-pending" role="tab" aria-controls="v-pills-pending" aria-selected="true">Pending</a>
                    <a class="nav-link" id="v-pills-confirmed-tab" data-toggle="pill" href="#v-pills-confirmed" role="tab" aria-controls="v-pills-confirmed" aria-selected="false">Confirmed</a>
                    <a class="nav-link" id="v-pills-for-delivery-tab" data-toggle="pill" href="#v-pills-for-delivery" role="tab" aria-controls="v-pills-for-delivery" aria-selected="false">For Delivery</a>
                    <a class="nav-link" id="v-pills-on-the-way-tab" data-toggle="pill" href="#v-pills-on-the-way" role="tab" aria-controls="v-pills-on-the-way" aria-selected="false">On the way</a>
                    <a class="nav-link" id="v-pills-delivered-tab" data-toggle="pill" href="#v-pills-delivered" role="tab" aria-controls="v-pills-delivered" aria-selected="false">Delivered</a>
                    <a class="nav-link" id="v-pills-cancelled-tab" data-toggle="pill" href="#v-pills-cancelled" role="tab" aria-controls="v-pills-cancelled" aria-selected="false">Cancelled</a>
                    <a class="nav-link" id="v-pills-return-tab" data-toggle="pill" href="#v-pills-return" role="tab" aria-controls="v-pills-return" aria-selected="false">For Return/Refund</a>
                </div>
            </div>
            <div class="col-10">
                <div class="tab-content" id="v-pills-tabContent">
                    <!-- Pending -->
                    <div class="tab-pane fade show active" id="v-pills-pending" role="tabpanel" aria-labelledby="v-pills-pending-tab">
                        <div class="card card-outline card-dark shadow rounded-0">
                            <div class="card-body">
                                <div class="container-fluid">
                                    <table class="table table-stripped">
                                        <colgroup>
                                            <col width="5%">
                                            <col width="20%">
                                            <col width="25%">
                                            <col width="20%">
                                            <col width="15%">
                                            <col width="15%">
                                        </colgroup>
                                        <thead>
                                            <tr class="bg-gradient-dark text-light">
                                                <th class="text-center">#</th>
                                                <th class="text-center">Date Ordered</th>
                                                <th class="text-center">Ref. Code</th>
                                                <th class="text-center">Total Amount</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            while ($row = $pending->fetch_assoc()) :
                                            ?>
                                                <tr>
                                                    <td class="text-center"><?= $i++ ?></td>
                                                    <td>
                                                        <p class="m-0 text-center"><?= date("Y-m-d H:i", strtotime($row['date_created'])) ?></p>
                                                    </td>
                                                    <td>
                                                        <p class="m-0 text-center"><?= $row['ref_code'] ?></p>
                                                    </td>
                                                    <td class="text-center"><?= number_format($row['total_amount'], 2) ?></td>
                                                    <td class="text-center">
                                                        <span class="badge badge-secondary px-3 rounded-pill p-2 bg-secondary">Pending</span>
                                                    </td>
                                                    <td class="text-center">
                                                        <button class="btn btn-flat btn-sm btn-default border view_data" type="button" data-id="<?= $row['id'] ?>"><i class="fa fa-eye"></i> View</button>
                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Confirmed and Packed -->
                    <div class="tab-pane fade" id="v-pills-confirmed" role="tabpanel" aria-labelledby="v-pills-confirmed-tab">
                        <div class="card card-outline card-dark shadow rounded-0">
                            <div class="card-body">
                                <div class="container-fluid">
                                    <table class="table table-stripped">
                                        <colgroup>
                                            <col width="5%">
                                            <col width="20%">
                                            <col width="25%">
                                            <col width="20%">
                                            <col width="15%">
                                            <col width="15%">
                                        </colgroup>
                                        <thead>
                                            <tr class="bg-gradient-dark text-light">
                                                <th class="text-center">#</th>
                                                <th class="text-center">Date Ordered</th>
                                                <th class="text-center">Ref. Code</th>
                                                <th class="text-center">Total Amount</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            while ($row = $confirmed->fetch_assoc()) :
                                            ?>
                                                <tr>
                                                    <td class="text-center"><?= $i++ ?></td>
                                                    <td>
                                                        <p class="m-0 text-center"><?= date("Y-m-d H:i", strtotime($row['date_created'])) ?></p>
                                                    </td>
                                                    <td>
                                                        <p class="m-0 text-center"><?= $row['ref_code'] ?></p>
                                                    </td>
                                                    <td class="text-center"><?= number_format($row['total_amount'], 2) ?></td>
                                                    <td class="text-center">
                                                        <span class="badge badge-secondary px-3 rounded-pill p-2 bg-info">Confirmed</span>
                                                    </td>
                                                    <td class="text-center">
                                                        <button class="btn btn-flat btn-sm btn-default border view_data" type="button" data-id="<?= $row['id'] ?>"><i class="fa fa-eye"></i> View</button>
                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- For Delivery -->
                    <div class="tab-pane fade" id="v-pills-for-delivery" role="tabpanel" aria-labelledby="v-pills-for-delivery-tab">
                        <div class="card card-outline card-dark shadow rounded-0">
                            <div class="card-body">
                                <div class="container-fluid">
                                    <table class="table table-stripped">
                                        <colgroup>
                                            <col width="5%">
                                            <col width="20%">
                                            <col width="25%">
                                            <col width="20%">
                                            <col width="15%">
                                            <col width="15%">
                                        </colgroup>
                                        <thead>
                                            <tr class="bg-gradient-dark text-light">
                                                <th class="text-center">#</th>
                                                <th class="text-center">Date Ordered</th>
                                                <th class="text-center">Ref. Code</th>
                                                <th class="text-center">Total Amount</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            while ($row = $forDelivery->fetch_assoc()) :
                                            ?>
                                                <tr>
                                                    <td class="text-center"><?= $i++ ?></td>
                                                    <td>
                                                        <p class="m-0 text-center"><?= date("Y-m-d H:i", strtotime($row['date_created'])) ?></p>
                                                    </td>
                                                    <td>
                                                        <p class="m-0 text-center"><?= $row['ref_code'] ?></p>
                                                    </td>
                                                    <td class="text-center"><?= number_format($row['total_amount'], 2) ?></td>
                                                    <td class="text-center">
                                                        <span class="badge badge-secondary px-3 rounded-pill p-2 bg-primary">For Delivery</span>
                                                    </td>
                                                    <td class="text-center">
                                                        <button class="btn btn-flat btn-sm btn-default border view_data" type="button" data-id="<?= $row['id'] ?>"><i class="fa fa-eye"></i> View</button>
                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- On The Way -->
                    <div class="tab-pane fade" id="v-pills-on-the-way" role="tabpanel" aria-labelledby="v-pills-on-the-way-tab">
                        <div class="card card-outline card-dark shadow rounded-0">
                            <div class="card-body">
                                <div class="container-fluid">
                                    <table class="table table-stripped">
                                        <colgroup>
                                            <col width="5%">
                                            <col width="20%">
                                            <col width="25%">
                                            <col width="20%">
                                            <col width="15%">
                                            <col width="15%">
                                        </colgroup>
                                        <thead>
                                            <tr class="bg-gradient-dark text-light">
                                                <th class="text-center">#</th>
                                                <th class="text-center">Date Ordered</th>
                                                <th class="text-center">Ref. Code</th>
                                                <th class="text-center">Total Amount</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            while ($row = $onTheWay->fetch_assoc()) :
                                            ?>
                                                <tr>
                                                    <td class="text-center"><?= $i++ ?></td>
                                                    <td>
                                                        <p class="m-0 text-center"><?= date("Y-m-d H:i", strtotime($row['date_created'])) ?></p>
                                                    </td>
                                                    <td>
                                                        <p class="m-0 text-center"><?= $row['ref_code'] ?></p>
                                                    </td>
                                                    <td class="text-center"><?= number_format($row['total_amount'], 2) ?></td>
                                                    <td class="text-center">
                                                        <span class="badge badge-secondary px-3 rounded-pill" style="color: black;">On the Way</span>
                                                    </td>
                                                    <td class="text-center">
                                                        <button class="btn btn-flat btn-sm btn-default border view_data" type="button" data-id="<?= $row['id'] ?>"><i class="fa fa-eye"></i> View</button>
                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Delivered -->
                    <div class="tab-pane fade" id="v-pills-delivered" role="tabpanel" aria-labelledby="v-pills-delivered">
                        <div class="card card-outline card-dark shadow rounded-0">
                            <div class="card-body">
                                <div class="container-fluid">
                                    <table class="table table-stripped">
                                        <colgroup>
                                            <col width="5%">
                                            <col width="20%">
                                            <col width="25%">
                                            <col width="20%">
                                            <col width="15%">
                                            <col width="15%">
                                        </colgroup>
                                        <thead>
                                            <tr class="bg-gradient-dark text-light">
                                                <th class="text-center">#</th>
                                                <th class="text-center">Date Ordered</th>
                                                <th class="text-center">Ref. Code</th>
                                                <th class="text-center">Total Amount</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            while ($row = $delivered->fetch_assoc()) :
                                            ?>
                                                <tr>
                                                    <td class="text-center"><?= $i++ ?></td>
                                                    <td>
                                                        <p class="m-0 text-center"><?= date("Y-m-d H:i", strtotime($row['date_created'])) ?></p>
                                                    </td>
                                                    <td>
                                                        <p class="m-0 text-center"><?= $row['ref_code'] ?></p>
                                                    </td>
                                                    <td class="text-center"><?= number_format($row['total_amount'], 2) ?></td>
                                                    <td class="text-center">
                                                        <span class="badge badge-secondary px-3 rounded-pill p-2 bg-success">Delivered</span>
                                                    </td>
                                                    <td class="text-center">
                                                        <button class="btn btn-flat btn-sm btn-default border view_data" type="button" data-id="<?= $row['id'] ?>"><i class="fa fa-eye"></i> View</button>
                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Cancelled -->
                    <div class="tab-pane fade" id="v-pills-cancelled" role="tabpanel" aria-labelledby="v-pills-cancelled">
                        <div class="card card-outline card-dark shadow rounded-0">
                            <div class="card-body">
                                <div class="container-fluid">
                                    <table class="table table-stripped">
                                        <colgroup>
                                            <col width="5%">
                                            <col width="20%">
                                            <col width="25%">
                                            <col width="20%">
                                            <col width="15%">
                                            <col width="15%">
                                        </colgroup>
                                        <thead>
                                            <tr class="bg-gradient-dark text-light">
                                                <th class="text-center">#</th>
                                                <th class="text-center">Date Ordered</th>
                                                <th class="text-center">Ref. Code</th>
                                                <th class="text-center">Total Amount</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            while ($row = $cancelled->fetch_assoc()) :
                                            ?>
                                                <tr>
                                                    <td class="text-center"><?= $i++ ?></td>
                                                    <td>
                                                        <p class="m-0 text-center"><?= date("Y-m-d H:i", strtotime($row['date_created'])) ?></p>
                                                    </td>
                                                    <td>
                                                        <p class="m-0 text-center"><?= $row['ref_code'] ?></p>
                                                    </td>
                                                    <td class="text-center"><?= number_format($row['total_amount'], 2) ?></td>
                                                    <td class="text-center">
                                                        <span class="badge badge-secondary px-3 rounded-pill p-2 bg-warning">Cancelled</span>
                                                    </td>
                                                    <td class="text-center">
                                                        <button class="btn btn-flat btn-sm btn-default border view_data" type="button" data-id="<?= $row['id'] ?>"><i class="fa fa-eye"></i> View</button>
                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- For Return -->
                    <div class="tab-pane fade" id="v-pills-return" role="tabpanel" aria-labelledby="v-pills-return">
                        <div class="card card-outline card-dark shadow rounded-0">
                            <div class="card-body">
                                <div class="container-fluid">
                                    <table class="table table-stripped">
                                        <colgroup>
                                            <col width="5%">
                                            <col width="20%">
                                            <col width="25%">
                                            <col width="20%">
                                            <col width="15%">
                                            <col width="15%">
                                        </colgroup>
                                        <thead>
                                            <tr class="bg-gradient-dark text-light">
                                                <th class="text-center">#</th>
                                                <th class="text-center">Date Ordered</th>
                                                <th class="text-center">Ref. Code</th>
                                                <th class="text-center">Total Amount</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            while ($row = $return->fetch_assoc()) :
                                            ?>
                                                <tr>
                                                    <td class="text-center"><?= $i++ ?></td>
                                                    <td>
                                                        <p class="m-0 text-center"><?= date("Y-m-d H:i", strtotime($row['date_created'])) ?></p>
                                                    </td>
                                                    <td>
                                                        <p class="m-0 text-center"><?= $row['ref_code'] ?></p>
                                                    </td>
                                                    <td class="text-center"><?= number_format($row['total_amount'], 2) ?></td>
                                                    <td class="text-center">
                                                        <span class="badge badge-secondary px-3 rounded-pill p-2 bg-warning">For Return/Refund</span>
                                                    </td>
                                                    <td class="text-center">
                                                        <button class="btn btn-flat btn-sm btn-default border view_data" type="button" data-id="<?= $row['id'] ?>"><i class="fa fa-eye"></i> View</button>
                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $('.view_data').click(function() {
            uni_modal("Order Details", "view_order.php?id=" + $(this).attr('data-id'), "large")
        })
        $('.table th, .table td').addClass("align-middle px-2 py-1")
        $('.table').dataTable();
        $('.table').dataTable();
    })
</script>