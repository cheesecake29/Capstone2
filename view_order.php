<?php
require_once('./config.php');
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
    #uni_modal .modal-footer {
        display: none;
    }

    .prod-cart-img {
        width: 7em;
        height: 7em;
        object-fit: scale-down;
        object-position: center center;
    }
    @media print {
      .print-btn {
        display: none !important;
      }
    }
</style>
<<<<<<< HEAD
<div class="container-fluid">
=======
<div class="container-fluid" id="orderDetailsContainer">

>>>>>>> f23a26e6234cdb19298c5e275c3492301c6fe8ee
    <div class="row">
        <div class="col-md-6">
            <label for="" class="text-muted">Name</label>
            <div class="ml-3"><b><?= isset($fullname) ? $fullname : "N/A" ?></b></div>
        </div>
        <div class="col-md-6">
            <label for="" class="text-muted">Reference Code</label>
            <div class="ml-3"><b><?= isset($ref_code) ? $ref_code : "N/A" ?></b></div>
        </div>
        <div class="col-md-6">
            <label for="" class="text-muted">Date Ordered</label>
            <div class="ml-3"><b><?= isset($date_created) ? date("M d, Y h:i A", strtotime($date_created)) : "N/A" ?></b></div>
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
                        <span class="badge badge-secondary px-3 rounded-pill">Confirm</span>
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
        </div>
    </div>
    <div class="clear-fix my-2"></div>
    <div class="row">
        <div class="col-12">

            <div class="w-100" id="order-list">
                <?php
                $total = 0;
                if (isset($id)) :
                    $order_item = $conn->query(
                        "SELECT 
                        o.*,
                        p.name,
                        pv.variation_price as price,
                        pv.variation_name,
                        p.image_path,b.name as brand,
                        cl.firstname,
                        cl.lastname,
                        cl.email,
                        cc.category
                    FROM `order_items` o
                        inner join product_list p on o.product_id = p.id
                        inner join brand_list b on p.brand_id = b.id
                        inner join categories cc on p.category_id = cc.id
                        inner join order_list ol on ol.id = o.order_id
                        inner join client_list cl on cl.id = ol.client_id
                        inner join product_variations pv on pv.id = o.variation_id 
                    where o.order_id = '{$id}' order by p.name asc
                "
                    );
                    while ($row = $order_item->fetch_assoc()) :
                        $total += ($row['quantity'] * $row['price']);
                ?>
<<<<<<< HEAD
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
                                        <div class="d-flex align-items-center w-100 mb-1">
                                            <span><?= number_format($row['quantity']) ?></span>
                                            <span class="ml-2">X <?= number_format($row['price'], 2) ?></span>
                                        </div>
                                    </div>
=======
                <div class="d-flex align-items-center w-100 border cart-item p-2" data-id="<?= $row['id'] ?>">
                    <div class="col-auto flex-grow-1 flex-shrink-1 px-1 py-1">
                        <div class="d-flex align-items-center w-100">
                            <div class="col-auto">
                                <img src="<?= validate_image($row['image_path']) ?>" alt="Product Image" class="img-thumbnail prod-cart-img">
                            </div>
                            <div class="col-auto flex-grow-1 flex-shrink-1  p-2">
                                <a href="./?p=products/view_product&id=<?= $row['product_id'] ?>" class="h4 text-muted" target="_blank">
                                    <p class="text-truncate-1 m-0"><?= $row['name'] ?></p>
                                </a>
                                <small><?= $row['brand'] ?></small><br>
                                <small><?= $row['category'] ?></small><br>
                                <div class="d-flex align-items-center w-100 mb-1">
                                    <span><?= number_format($row['quantity']) ?></span>
                                    <span class="ml-2">X <?= number_format($row['price'],2) ?></span>
>>>>>>> f23a26e6234cdb19298c5e275c3492301c6fe8ee
                                </div>
                            </div>
<<<<<<< HEAD
                            <div class="col-auto text-right">
                                <h3><b><?= number_format($row['quantity'] * $row['price'], 2) ?></b></h3>
                            </div>
=======
                            
                            <?php if (!$row['rated'] && $status == 5) : ?>
                                    <div class="accordion" id="accordionExample-<?= $row['id'] ?>">
                                        <div class="card">
                                            <div class="card-header" id="reviewContent">
                                                <h2 class="mb-0">
                                                    <button class="btn btn-link btn-block text-primary text-left" type="button" data-toggle="collapse" data-target="#reviewSection-<?= $row['id'] ?>" aria-expanded="false" aria-controls="reviewSection-<?= $row['id'] ?>">
                                                        Submit a review
                                                    </button>
                                                </h2>
                                            </div>
                                            <div id="reviewSection-<?= $row['id'] ?>" class="collapse" aria-labelledby="reviewContent" data-parent="#accordionExample-<?= $row['id'] ?>">
                                                <form id="submit-review-<?= $row['id'] ?>" action="">
                                                    <div class="card-body">
                                                        <input class="invisible w-0" value="<?= $row['product_id'] ?>" required type="hidden" name="product_id">
                                                        <input class="invisible w-0" value="<?= $row['variation_id'] ?>" required type="hidden" name="variation_id">
                                                        <input class="invisible w-0" value="<?= $row['name'] ?>" required type="hidden" name="product_name">
                                                        <input class="invisible w-0" value="<?= $row['lastname'], ', ', $row['firstname'] ?>" required type="hidden" name="author_name">
                                                        <input class="invisible w-0" value="<?= $row['email'] ?>" required type="hidden" name="author_email">
                                                        <input class="invisible w-0" value="<?= $row['id'] ?>" required type="hidden" name="order_id">
                                                        <div class="rating">
                                                            <label class="mt-1">Rate: </label>
                                                            <div class="rating-stars">
                                                                <input type="radio" name="rate_level" value="5" id="5-<?= $row['id'] ?>"><label for="5-<?= $row['id'] ?>">☆</label>
                                                                <input type="radio" name="rate_level" value="4" id="4-<?= $row['id'] ?>"><label for="4-<?= $row['id'] ?>">☆</label>
                                                                <input type="radio" name="rate_level" value="3" id="3-<?= $row['id'] ?>"><label for="3-<?= $row['id'] ?>">☆</label>
                                                                <input type="radio" name="rate_level" value="2" id="2-<?= $row['id'] ?>"><label for="2-<?= $row['id'] ?>">☆</label>
                                                                <input type="radio" name="rate_level" value="1" id="1-<?= $row['id'] ?>"><label for="1-<?= $row['id'] ?>">☆</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleFormControlTextarea1">Comments: </label>
                                                            <textarea class="form-control" name="author_comments" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                        </div>
                                                        <button class="btn btn-flat btn-primary mt-3" onclick="submitReview('submit-review', '<?= $row['id'] ?>')" type="button">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
>>>>>>> b2d14991f558d3afc4dde751c95d47911ea9b1fe
                        </div>
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
<<<<<<< HEAD
                        <h3 class="text-center">TOTAL</h3>
                    </div>
                    <div class="col-auto text-right">
                        <h3>
                            <b><?= number_format($total, 2) ?></b>
                        </h3>
=======
                            <span>TOTAL</span>
                    </div>
                    <div class="col-auto text-right">
                        <span><b><?= number_format($total,2) ?></b></span>
>>>>>>> f23a26e6234cdb19298c5e275c3492301c6fe8ee
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clear-fix my-2"></div>
    <div class="row">
<<<<<<< HEAD
        <div class="col-12 text-right">
            <?php if (isset($status)  && $status == 0) : ?>
                <button class="btn btn-danger btn-flat btn-sm" id="btn-cancel" type="button">Cancel Order</button>
=======
        <div class="col-12 text-right " id="disregardThisDiv">
            <?php if(isset($status)  && $status == 0): ?>
            <button class="btn btn-danger btn-flat btn-sm" id="btn-cancel" type="button">Cancel Order</button>
>>>>>>> f23a26e6234cdb19298c5e275c3492301c6fe8ee
            <?php endif; ?>
            <button class="btn btn-dark btn-flat btn-sm print-btn" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
            <button onclick="printOrderDetails()" class="print-btn">Print Order Details</button>
        </div>
    </div>
</div>
<script>
<<<<<<< HEAD
    $('#btn-cancel').click(function() {
        _conf("Are you sure to cancel this order?", "cancel_order", [])
=======
    function printOrderDetails() {
        // Specify the div to print using its ID
        var printContents = document.getElementById("orderDetailsContainer").innerHTML;

        // Create a new window for printing
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        document.getElementById("disregardThisDiv").style.display = 'none';
        // Use the JavaScript print function to print the content of the div
        window.print();

        // Restore the original content after printing
        document.body.innerHTML = originalContents;
        
        $('#btn-cancel').click(function(){
        _conf("Are you sure to cancel this order?","cancel_order",[])
    })

<<<<<<< HEAD
=======
    function submitReview(form, formId) {
        var elements = document.getElementById(`${form}-${formId}`).elements;
        var obj = {};
        for (var i = 0; i < elements.length; i++) {
            var item = elements.item(i);
            if (item.name === 'rate_level') {
                if (item.checked) {
                    obj[item.name] = item.value;
                }
            } else {
                obj[item.name] = item.value;
            }
        }
        const formData = new FormData();
        for (var key in obj) {
            formData.append(key, obj[key]);
        }

        $.ajax({
            url: _base_url_ + "classes/Master.php?f=submit_review",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            dataType: 'json',
            error: err => {
                console.log(err)
                alert_toast("An error occured", 'error');
                end_loader();
            },
            success: function(resp) {
                console.log(resp);
                if (resp.status == 'success') {
                    $(`#reviewSection-${formId}`).removeClass('show')
                    $(`#accordionExample-${formId}`).css('display', 'none');
                    alert_toast(resp.msg, 'success')
                } else if (resp.status === 'failed') {
                    console.log(resp.error)
                    alert_toast(resp.msg, 'error')
                } else {
                    alert_toast('An error occurred.', 'error')
                }
            }
        })
>>>>>>> b2d14991f558d3afc4dde751c95d47911ea9b1fe
    }
    $('#btn-cancel').click(function(){
        _conf("Are you sure to cancel this order?","cancel_order",[])
>>>>>>> f23a26e6234cdb19298c5e275c3492301c6fe8ee
    })

    function cancel_order() {
        start_loader();
        $.ajax({
            url: _base_url_ + 'classes/master.php?f=cancel_order',
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
                    location.reload()
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