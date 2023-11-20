<?php
if (isset($_GET['id'])) {
    $qry = $conn->query("SELECT * FROM `order_list` where id = '{$_GET['id']}'");
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_array() as $k => $v) {
            if (!is_numeric($k))
                $$k = $v;
        }
    }
}
?>
<?php
if (!isset($_GET['id'])) {
    $_settings->set_flashdata('error', 'No order ID Provided.');
    redirect('admin/?page=orders');
}
$order = $conn->query("SELECT o.*,concat(c.firstname,' ',c.lastname) as fullname FROM `order_list` o inner join client_list c on c.id = o.client_id where o.id = '{$_GET['id']}' ");
if ($order->num_rows > 0) {
    foreach ($order->fetch_assoc() as $k => $v) {
        $$k = $v;
    }
} else {
    $_settings->set_flashdata('error', 'Order ID provided is Unknown');
    redirect('admin/?page=orders');
}
?>
<style>
    .prod-cart-img {
        width: 7em;
        height: 7em;
        object-fit: scale-down;
        object-position: center center;
    }

    .row{
        display: flex;
        flex-direction: column;
    }

 
</style>
<div class="card card-outline card-dark shadow rounded0-0">
    <div class="card-header">
        <h3 class="card-title"><b>Order Details</b></h3>
        <div class="card-tools">
            <button class="btn btn-primary btn-flat btn-sm" type="button" id="update_status"><i class="fa fa-edit"></i> Update Status</button>
            <button class="btn btn-danger btn-flat btn-sm" type="button" id="delete_order"><i class="fa fa-trash"></i> Delete</button>
            <a class="btn btn-default btn-flat border btn-sm" href="./?page=orders"><i class="fa fa-angle-left"></i> Back to List</a>
        </div>
    </div>


    <div class="card-body">
        <div class="container-fluid">
        <div class="row">
            <div class="info1 col-md-6">
                <label for="" class="text-muted">Client Name</label>
                <div class="ml-3"><b><?php echo $fullname?></b></div>
            
                <br>

<<<<<<< Updated upstream
                <p><b>Client Name: <?php echo $fullname ?></b></p><br>

                <div class="col-md-6">
                    <label for="" class="text-muted">Reference Code</label>
                    <div class="ml-3"><b><?= isset($ref_code) ? $ref_code : "N/A" ?></b></div>
                </div>
                <div class="col-md-6">
                    <label for="" class="text-muted">Date Ordered</label>
                    <div class="ml-3"><b><?= isset($date_created) ? date("M d, Y h:i A", strtotime($date_created)) : "N/A" ?></b></
                </div>
=======
               
            
                <label for="" class="text-muted">Reference Code</label>
                <div class="ml-3"><b><?= isset($ref_code) ? $ref_code : "N/A" ?></b></div>
            
                <br>
            
                <label for="" class="text-muted">Date Ordered</label>
                <div class="ml-3"><b><?= isset($date_created) ? date("M d, Y h:i A", strtotime($date_created)) : "N/A" ?></b></div>
>>>>>>> Stashed changes
            </div>
        </div>

            <div class="row">
                <div class="col-md-6">
                    <label for="" class="text-muted">Status</label>
                    <div class="ml-3">
                        <?php if (isset($status)) : ?>
                            <?php if ($status == 0) : ?>
                                <span class="badge badge-secondary px-3 rounded-pill">Pending</span>

                            <?php elseif ($status == 1) : ?>
                                <span class="badge badge-primary px-3 rounded-pill">Confirm</span>

                            <?php elseif ($status == 2) : ?>
                                <span class="badge badge-primary px-3 rounded-pill">Packed</span>

                            <?php elseif ($status == 3) : ?>
                                <span class="badge badge-success px-3 rounded-pill">For Delivery</span>
                            <?php elseif ($status == 4) : ?>
                                <span class="badge badge-warning px-3 rounded-pill">On the Way</span>
                            <?php elseif ($status == 5) : ?>
                                <span class="badge badge-default bg-gradient-teal px-3 rounded-pill">Delivered</span>
                            <?php else : ?>
                                <span class="badge badge-danger px-3 rounded-pill">Cancelled</span>
                            <?php endif; ?>
                        <?php else : ?>
                            N/A
                        <?php endif; ?>
                    </div>
                    <label for="" class="text-muted">Order Type</label>
                        <div class="ml-3">
                            <b>
                            <?php
                                switch ($order_type) {
                                    case 1:
                                        echo 'JRS';
                                        break;
                                    case 2:
                                        echo 'Lalamove';
                                        break;
                                    case 3:
                                        echo 'Meet Up: '.$other_address;
                                        break;
                                    case 4:
                                        echo 'Pick Up: '.$other_address;
                                        break;
                                    default:
                                        echo 'N/A';
                                        break;
                                }
                                ?>
                            </b>
                        </div>

                    </div>
                <div class="col-md-6">
                    <?php
                    //get province name
                    $api_url = 'https://ph-locations-api.buonzz.com/v1/provinces';
                    $response = file_get_contents($api_url);

                    $provinces = json_decode($response, true);

                    $provinceCode = $province;

                    $provinceName = null;

                    foreach ($provinces['data'] as $province) {
                        if ($province['id'] === $provinceCode) {
                            $provinceName = $province['name'];
                            break;
                        }
                    }

                    //get city name
                    $api_url2 = 'https://ph-locations-api.buonzz.com/v1/cities';
                    $response2 = file_get_contents($api_url2);

                    $cities = json_decode($response2, true);

                    $cityCode = $city;

                    $cityName = null;

                    foreach ($cities['data'] as $city) {
                        if ($city['id'] === $cityCode) {
                            $cityName = $city['name'];
                            break;
                        }
                    }

                           
                            echo '<label for="" class="text-muted">Client Address</label>';
                            echo '<div class="ml-3" id="prov"> ' ,'<b>'. $cityName . ', ' . $provinceName . '</b>','</div>';
                          
                            echo '<label for="" class="text-muted">Customer Number:</label>';
                            echo '<div class="ml-3" id="contact">' . $contact . '</div>';
                            if($addressline1){
                              
                                echo '<label for="" class="text-muted">Address Line 1</label>';
                               
                                echo '<div class="ml-3" id="adr1">'  ,'<b>'. $addressline1 . '</b>','</div>';
                            }
                            if($addressline2){
                                echo '<label for="" class="text-muted">Address Line 2</label>';
                               
                                echo '<div class="ml-3" id="adr2">' . $addressline2 . '</div>';
                            }


                    ?>

                </div>
              
            </div>
            <div class="clear-fix my-2"></div>
            <div class="row">
                <div class="col-12">
                    <div class="w-100" id="order-list">
                        <?php
                        $queryCheck = "SELECT order_id FROM shipping_fee WHERE order_id = '{$id}'";
                        $result = $conn->query($queryCheck);
                        $total = 0;
                        if (isset($id)) :
                            $query = '';
                            if ($result && $result->num_rows > 0) {
                                $queryWithSF = "SELECT o.*, p.name, p.price, p.image_path, b.name AS brand, cc.category, ol.order_type, v.variation_name,
                                GROUP_CONCAT(v.variation_name) AS all_variations,
                                GROUP_CONCAT(v.variation_stock) AS all_variation_stock
                                FROM `order_items` o
                                INNER JOIN product_list p ON o.product_id = p.id
                                INNER JOIN brand_list b ON p.brand_id = b.id
                                INNER JOIN categories cc ON p.category_id = cc.id
                                INNER JOIN product_variations v ON v.product_id = p.id AND v.id = o.variation_id
                                INNER JOIN order_list ol ON ol.id = o.order_id
                                LEFT JOIN shipping_fee sf ON sf.order_id = o.order_id
                                WHERE o.order_id = '{$id}'
                                    AND (ol.order_type = 1 OR ol.order_type = 2)
                                GROUP BY o.id, p.id, o.quantity, p.name, p.price, p.image_path, b.name, cc.category, ol.order_type
                                ORDER BY p.name ASC";
                                
                                $query = $queryWithSF;
                            }
                            else{
                                $queryWithoutSF = "SELECT o.*, p.name, p.price, p.image_path, b.name AS brand, cc.category, ol.order_type, v.variation_name,
                                GROUP_CONCAT(v.variation_name) AS all_variations,
                                GROUP_CONCAT(v.variation_stock) AS all_variation_stock
                                FROM `order_items` o
                                INNER JOIN product_list p ON o.product_id = p.id
                                INNER JOIN brand_list b ON p.brand_id = b.id
                                INNER JOIN categories cc ON p.category_id = cc.id
                                INNER JOIN product_variations v ON v.product_id = p.id and  v.id = o.variation_id
                                INNER JOIN order_list ol ON ol.id = o.order_id
                                WHERE o.order_id = '{$id}'
                                GROUP BY o.id, p.id, o.quantity, p.name, p.price, p.image_path, b.name, cc.category, ol.order_type
                                ORDER BY p.name ASC;";
                                $query = $queryWithoutSF;
                            }
                            $order_item = $conn->query($query);
                            while ($row = $order_item->fetch_assoc()) :
                                $total += ($row['quantity'] * $row['price']);
                        ?>
                                <div class="d-flex align-items-center w-100 border cart-item" data-id="<?= $row['id'] ?>">
                                    <div class="col-auto flex-grow-1 flex-shrink-1 px-1 py-1">
                                        <div class="d-flex align-items-center w-100 ">
                                            <div class="col-auto">
                                                <img src="<?= validate_image($row['image_path']) ?>" alt="Product Image" class="img-thumbnail prod-cart-img">
                                            </div>
                                            <div class="col-auto flex-grow-1 flex-shrink-1">
                                                <a href="./?p=products/view_product&id=<?= $row['product_id'] ?>" class="h4 text-muted" target="_blank">
                                                    <p class="text-truncate-1 m-0"><?= $row['name'] ?></p>
                                                </a>
                                                <small><?= $row['brand'] ?></small><br>
                                                <small><?= $row['category'] ?></small><br>
                                                <small><?= $row['all_variations'] ?></small><br>
                                                <div class="d-flex align-items-center w-100 mb-1">
                                                    <span><?= number_format($row['quantity']) ?></span>
                                                    <span class="ml-2">X <?= number_format($row['price'], 2) ?>
                                                        <?= $row['variation_name'] ?>
                                                    </span><br>
                                                </div>
                                            </div>
                                            <div class="col-auto text-right">

                                                <h3><b><?= number_format($row['quantity'] * $row['price'], 2) ?></b></h3>
                                            </div>
                                        </div>

                                        <?php
                                        if ($row['order_type'] == 1) {
                                            $total_amount = $total + $row['amount'];
                                        } else {
                                            $total_amount = $total;
                                        }
                                        ?>
                                <?php
                            endwhile;
                        endif;
                                ?>
                                <?php if (isset($order_item) && $order_item->num_rows <= 0) : ?>
                                    <div class="d-flex align-items-center w-100 border justify-content-center">
                                        <div class="col-12 flex-grow-1 flex-shrink-1 px-1 py-1">
                                            <small class="text-muted">No Data</small>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="d-flex align-items-center w-100 border">
                                    <div class="col-auto flex-grow-1 flex-shrink-1 px-1 py-1">
                                        <h3 class="text-center">TOTAL</h3>
                                    </div>
                                    <div class="col-auto text-right">
                                        <h3><b><?= number_format($total_amount, 2) ?></b></h3>
                                    </div>
                                </div>
                                    </div>
                                </div>
                    </div>
                    <div class="clear-fix my-2"></div>
                </div>
            </div>
        </div>

        <script>
            $(function() {
                $('#update_status').click(function() {
                    uni_modal("Update Order Status", "orders/update_status.php?id=<?= isset($id) ? $id : '' ?>?client_id=<?= isset($client_id) ? $client_id : '' ?>")
                })
                $('#btn-cancel').click(function() {
                    _conf("Are you sure to cancel this order?", "cancel_order", [])
                })
                $('#delete_order').click(function() {
                    _conf("Are you sure to delete this order permanently?", "delete_order", [])
                })
            })

            function delete_order() {
                start_loader();
                $.ajax({
                    url: _base_url_ + 'classes/master.php?f=delete_order',
                    data: {
                        id: "<?= isset($id) ? $id : '' ?>"
                    },
                    method: 'POST',
                    dataType: 'json',
                    error: err => {
                        console.error(err)
                        alert_toast('An error occurred.', 'error')
                        end_loader()
                    },
                    success: function(resp) {
                        if (resp.status == 'success') {
                            location.replace('./?page=orders')
                        } else if (!!resp.msg) {
                            alert_toast(resp.msg, 'error')
                        } else {
                            alert_toast('An error occurred.', 'error')
                        }
                        end_loader();
                    }
                })
            }
        </script>