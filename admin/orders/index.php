<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<div class="card card-outline card-dark shadow rounded-0">
    <div class="card-header">
        <h3 class="card-title"><b>Order List</b></h3>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <table class="table table-stripped table-bordered">
                <colgroup>
                    <col width="5%">
                    <col width="15%">
                    <col width="15%">
                    <col width="15%">
                    <col width="20%">
                    <col width="15%">
                    <col width="15%">
                </colgroup>
                <thead>
                    <tr class="bg-gradient-dark text-light">
                        <th class="text-center">#</th>
                        <th class="text-center">Date Ordered</th>
                        <th class="text-center">Ref. Code</th>
                        <th class="text-center">Client</th>
                        <th class="text-center">Total Amount</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i = 1;
                    $orders = $conn->query("SELECT o.*,concat(c.lastname,', ', c.firstname) as fullname FROM `order_list` o inner join client_list c on o.client_id = c.id order by o.status asc, unix_timestamp(o.date_created) desc ");
                    while($row = $orders->fetch_assoc()):
                    ?>
                        <tr>
                            <td class="text-center"><?= $i++ ?></td>
                            <td><?= date("Y-m-d H:i", strtotime($row['date_created'])) ?></td>
                            <td><?= $row['ref_code'] ?></td>
                            <td><?= $row['fullname'] ?></td>
                            <td class="text-right"><?= number_format($row['total_amount'],2) ?></td>
                            <td class="text-center">
                                <!-- 1=pending,2 = confirmed, 3 = for delivery, 4 = on the way, 5= delivered, 6=cancelled	 -->
                                <?php if ($row['status'] == 0) : ?>
                                    <span class="badge badge-secondary px-3 rounded-pill">Confirmed</span>
                                <?php elseif ($row['status'] == 1) : ?>
                                    <span class="badge badge-default bg-gradient-teal px-3 rounded-pill">Shipped</span>
                                <?php elseif ($row['status'] == 2) : ?>
                                    <span class="badge badge-default bg-gradient-teal px-3 rounded-pill">Delivered</span>
                                <?php else : ?>
                                    <span class="badge badge-danger px-3 rounded-pill">Cancelled</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                <a class="btn btn-flat btn-sm btn-default border view_data" href="./?page=orders/view_order&id=<?= $row['id'] ?>" data-id="<?= $row['id'] ?>"><i class="fa fa-eye"></i> View</a>
                
                <?php if (strtolower($row['status']) == 'confirm') : ?>
    <!-- Add a data-toggle and data-target to trigger the modal -->
    <button class="btn btn-flat btn-sm btn-default border confirm_modal" data-toggle="modal" data-target="#confirmationModal"><i class="fa fa-check"></i> Confirm</button>
<?php endif; ?>

            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
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
    $(function() {
        $('.confirm_modal').click(function() {
            // Trigger the confirmation modal to show
            $('#confirmationModal').modal('show');
        });
        // Function to check for new orders
        function checkForNewOrders() {
            // Make an AJAX request to check for new orders
            $.ajax({
                url: 'check_for_new_orders.php', // Replace with the actual URL to check for new orders
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.newOrder) {
                        // If there's a new order, display an alert
                        alert("New order received. Please confirm the order.");
                    }
                },
                error: function() {
                    console.log("Error while checking for new orders.");
                }
            });
        }

        // Call the function to check for new orders every 5 minutes (you can adjust the interval)
        setInterval(checkForNewOrders, 300000); // 300,000 milliseconds = 5 minutes
    });
    </script>
<script>

    $(function() {
        $('.view_data').click(function() {
            uni_modal("Order List", "index.php?id=" + $(this).attr('data-id'), "large");
        });

        $('.table th, .table td').addClass("align-middle px-2 py-1");
        $('.table').dataTable();
        $('.table').dataTable();
    })
</script>
