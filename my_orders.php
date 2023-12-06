<?php
// 0=pending,1 = confirmed, 2 = packed, 3 = for delivery, 4 = on the way, 5= delivered, 6=cancelled
$pending = $conn->query("SELECT * FROM `order_list` where client_id = '{$_settings->userdata('id')}' and status = 0 order by unix_timestamp(date_created) desc ");
$readytoship = $conn->query("SELECT * FROM `order_list` where client_id = '{$_settings->userdata('id')}' and status = 1  order by unix_timestamp(date_created) desc ");
$delivered = $conn->query("SELECT * FROM `order_list` where client_id = '{$_settings->userdata('id')}' and status = 2 order by unix_timestamp(date_created) desc ");
$cancelled = $conn->query("SELECT * FROM `order_list` where client_id = '{$_settings->userdata('id')}' and status = 3 order by unix_timestamp(date_created) desc ");
$return = $conn->query("SELECT * FROM `order_list` where client_id = '{$_settings->userdata('id')}' and status = 4 order by unix_timestamp(date_created) desc ");


$currentStatus = "pending"; // Default status is pending

// Check the current status and update the variable accordingly
if (isset($_GET['readytoship'])) {
    $currentStatus = "readytoship";
}  elseif (isset($_GET['delivered'])) {
    $currentStatus = "delivered";
} elseif (isset($_GET['cancelled'])) {
    $currentStatus = "cancelled";
} elseif (isset($_GET['return_refund'])) {
    $currentStatus = "return-refund";
}
?>



<style>
    .text-center {
        color: #004399;
    }
    .row{
    display: flex;
    flex-direction: column;
    }

    .navy .nav{
        display: flex;
        justify-content: space-around;
        align-items: center;
        width: 100%;
        background-color: white;
        
    }

    

    .nav-link.active {
        background-color: #0062CC; /* Set your desired background color */
        color: white !important; /* Set the text color */
        padding: 1% 3%;
    }

  
</style>
<div class="content py-5 mt-3">
    <div class="container">
        <h3><b>My Orders</b></h3>
        <hr>
        <div class="row">
            <div class="navy">
                <div class="nav flex-row " id="v-pills-tab" role="tablist" aria-orientation="horizontal">
                    <a class="nav-link <?= ($currentStatus === 'pending') ? 'active' : ''; ?>" id="v-pills-pending-tab" data-toggle="pill" href="#v-pills-pending" role="tab" aria-controls="v-pills-pending" aria-selected="<?= ($currentStatus === 'pending') ? 'true' : 'false'; ?>">Pending</a>
                    <a class="nav-link <?= ($currentStatus === 'readytoship') ? 'active' : ''; ?>" id="v-pills-readytoship-tab" data-toggle="pill" href="#v-pills-readytoship" role="tab" aria-controls="v-pills-readytoship" aria-selected="<?= ($currentStatus === 'readytoship') ? 'true' : 'false'; ?>">Shipped</a>

              
                <a class="nav-link <?= ($currentStatus === 'delivered') ? 'active' : ''; ?>" id="v-pills-delivered-tab" data-toggle="pill" href="#v-pills-delivered" role="tab" aria-controls="v-pills-delivered" aria-selected="<?= ($currentStatus === 'delivered') ? 'true' : 'false'; ?>">Delivered</a>
                <a class="nav-link <?= ($currentStatus === 'cancelled') ? 'active' : ''; ?>" id="v-pills-cancelled-tab" data-toggle="pill" href="#v-pills-cancelled" role="tab" aria-controls="v-pills-cancelled" aria-selected="<?= ($currentStatus === 'cancelled') ? 'true' : 'false'; ?>">Cancelled</a>
                <a class="nav-link <?= ($currentStatus === 'return-refund') ? 'active' : ''; ?>" id="v-pills-return-tab" data-toggle="pill" href="#v-pills-return" role="tab" aria-controls="v-pills-return" aria-selected="<?= ($currentStatus === 'return-refund') ? 'true' : 'false'; ?>">For Return/Refund</a>
                </div>
            </div>
            <div class="order-container">
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
                    <div class="tab-pane fade" id="v-pills-readytoship" role="tabpanel" aria-labelledby="v-pills-readytoship-tab">
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
                                            while ($row = $readytoship->fetch_assoc()) :
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
                                                        <span class="badge badge-secondary px-3 rounded-pill p-2 bg-info">Ready to ship</span>
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