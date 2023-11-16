<?php
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $qry = $conn->query("SELECT p.*, b.name as brand, c.category from `product_list` p
        inner join brand_list b on p.brand_id = b.id
        inner join categories c on p.category_id = c.id
        -- left join product_variations v on p.id = v.product_id
        where p.id = '{$_GET['id']}'");
    if ($qry->num_rows > 0) {
        while ($row = $qry->fetch_assoc()) {
            foreach ($row as $k => $v) {
                $$k = stripslashes($v);
            }
            $stocks = $conn->query("SELECT SUM(quantity) FROM stock_list where product_id = '$id'")->fetch_array()[0];
            $out = $conn->query("SELECT SUM(quantity) FROM order_items where product_id = '{$id}' and order_id in (SELECT id FROM order_list where `status` != 5)")->fetch_array()[0];
            $cart_item_count = $conn->query("SELECT SUM(quantity) FROM cart_list where product_id = '$id'")->fetch_array()[0];
            $stocks = $stocks > 0 ? $stocks : 0;
            $out = $out > 0 ? $out : 0;
            $available1 = $stocks - $out;
            $available = $available1 - $cart_item_count;

            $variations = $conn->query("SELECT * FROM product_variations where product_id = '$id' and variation_stock > 0");
            while ($variation = $variations->fetch_array()) {
                echo "<script>console.log('" . $variation['variation_name'] . "');</script>";
                echo "<script>console.log('" . $variation['id'] . "');</script>";
            }
        }
    } else {
        echo "<script> alert('Unknown Product ID!'); location.replace('./?page=products');</script>";
    }
} else {
    echo "<script> alert('Product ID is required!'); location.replace('./?page=products');</script>";
}
?>


<head>


</head>
<style>
    .product-img {
        max-width: 450px;
        object-fit: scale-down;
        object-position: center center;
        border: none;
    }

    .card-body {
        display: flex;
        flex-direction: row;

    }

    .left,
    .right {
        width: 50%;
        margin: 0 0 0 0.5%;

    }

    .right {
        display: flex;
        flex-direction: column;
    }

    .brand_name {
        color: #004399;
        font-size: 1.875rem;
    }

    .price {
        color: #004399;
        font-size: 1.25rem;
    }

    .desc {
        text-align: justify;
    }

    .ab {
        flex-direction: row;
    }

    .add-cart {
        border: 1px solid none;
        margin: 10% 0%;
        padding: 3% 5%;
        background-color: #004399;
        color: white;
        border-radius: 2px;
        width: 100%;

    }

    .add-cart a {
        text-align: center;
        color: white;
    }




    .card-title {
        color: white;
    }

    .containerr {

        margin: 0 4%;
        width: 80%;

    }

    .content {
        display: flex;
        justify-content: center;
        align-items: center;


    }


    .card {
        border: none;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    button[disabled] {
        opacity: 0.6;
        /* Reduce opacity to indicate it's disabled */
        cursor: not-allowed;
        /* Change cursor to indicate non-interactivity */
        /* Optionally, you can add other styles like changing background color, text color, etc. */
    }
</style>
<div class="content ">
    <div class="containerr">
        <div class="d-flex">
            <div class="left-container px-5">
                <div class="image text-center">
                    <img src="<?= validate_image(isset($image_path) ? $image_path : "") ?>" alt="Product Image <?= isset($name) ? $name : "" ?>" class="img-thumbnail product-img">
                </div>
            </div>
            <div class="right-container px-5 flex-grow-1">
                <div class="info">
                    <h1 class="brand_name text-capitalize"><?= isset($name) ? $name : '' ?> </h1>
                    <?= isset($description) ? html_entity_decode($description) : '' ?>
                </div>
                <h3 class="text-success">₱<strong><?= isset($price) ? number_format($price, 2) : '' ?></strong></h3>
                <div class="mt-3 border-bottom">
                    <h5>Details: </h3>
                </div>
                <div class="info">
                    <small>Compatible Models: <?= isset($models) ? $models : '' ?></small>
                </div>
                <div class="info">
                    <small>Category: <strong><?= isset($category) ? $category : '' ?></strong></small>
                </div>
                <div class="info">
                    <small> Brand: <strong><?= isset($brand) ? $brand : '' ?></strong></small>
                </div>
                <div class="mt-3 border-bottom">
                    <h5>Variation: </h3>
                </div>
                <div class="info mt-3">
                    <h6>
                        Total Available Stocks:
                        <strong>
                            <?php
                            $productQuantityQuery = $conn->query("SELECT * FROM stock_list where product_id = $id");
                            $productQuantity = $productQuantityQuery->fetch_assoc();
                            $orderItemStocks = $conn->query("SELECT SUM(quantity) as totalQuantity FROM order_items where product_id = '{$id}' and order_id in (SELECT id FROM order_list where `status` != 5)");
                            $productStockTotalQuantity = $productQuantity['quantity'];
                            if ($orderItemStocks->num_rows > 0) {
                                $oiStocksQuantity = $orderItemStocks->fetch_assoc();
                                $productStockTotalQuantity = $productQuantity['quantity'] - $oiStocksQuantity['totalQuantity'];
                            }
                            ?>
                            <span id="available_stock"><?= isset($productStockTotalQuantity) ? number_format($productStockTotalQuantity) : '' ?></span>
                        </strong>
                    </h6>
                    <div class="d-flex flex-column">
                        <?php
                        $variations = $conn->query("SELECT * FROM product_variations where product_id = $id");
                        while ($variation = $variations->fetch_assoc()) :
                            $orderItemWithSameVariation = $conn->query("SELECT SUM(quantity) FROM order_items where product_id = '{$id}' and variation_id = '{$variation['id']}' and order_id in (SELECT id FROM order_list where `status` != 5)");
                            $variationTotalQuantity = $variation['variation_stock'];
                            if ($orderItemWithSameVariation->num_rows > 0) {
                                $oitQuantity = $orderItemWithSameVariation->fetch_array()[0];
                                $variationTotalQuantity = $variation['variation_stock'] - $oitQuantity;
                            }
                        ?>
                            <div class="d-block me-5">
                                <label for='variation_<?php echo $variation['id'] ?>'>
                                    <input type='radio' name='variations' id='variation_<?php echo $variation['id'] ?>' value='<?php echo $variation['id'] ?>' onclick='handleVariationSelect(this)' />
                                    <span id='stock_<?php echo $variation['id'] ?>'><?php echo $variation['variation_name'] ?>
                                        (Stock: <span id='variation_stock_<?php echo $variation['id'] ?>'> <?= $variationTotalQuantity ?></span>)
                                    </span>
                                </label>
                            </div>
                        <?php
                        endwhile; ?>
                    </div>
                    <span id="limit" style="font-size: 0.8rem; color: #dc3545;">You have reached the maximum limit for this item</span>
                </div>
                <div class="d-block mt-3">
                    <div id="available">
                        <button id='add_to_cart' class='btn text-white' style="background: #004399" onclick='addToCart()' disabled>Add to Cart</button>
                    </div>
                    <div class="out-of-stock" id="unavailable">
                        <button class="btn btn-danger">Out of Stock</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<script>
    $(document).ready(function() {
        fetch();
        let availability = 0;
        let cart_count = 0;
    });

    function handleVariationSelect(variation) {
        if (variation.checked) {
            // Do something when the radio button is clicked and checked
            console.log(`Selected value: ${variation.value}`);
            $('#add_to_cart').removeAttr("disabled");

        }
    }

    function addToCart() {
        const variationId = $("input[type='radio'][name='variations']:checked").val();
        if ("<?= $_settings->userdata('id') > 0 && $_settings->userdata('login_type') == 2 ?>" == 1) {
            availability--;
            let avail_stock = availability - cart_count;
            $('#available_stock').html(avail_stock);
            console.log(variationId);

            if (availability > 0) {
                start_loader();
                $.ajax({
                    url: _base_url_ + "classes/Master.php?f=save_to_cart",
                    method: 'POST',
                    data: {
                        product_id: '<?= isset($id) ? $id : "" ?>',
                        variation_id: variationId,
                        quantity: 1
                    },
                    dataType: 'json',
                    error: err => {
                        console.error(err);
                        alert_toast("An error occurred", "error");
                        end_loader();
                    },
                    success: function(resp) {
                        if (resp.status == 'success') {
                            // update_cart_count(resp.cart_count);
                            fetch();
                            alert_toast("Product has been added to cart.", 'success');
                        } else if (!!resp.msg) {
                            alert_toast(resp.msg, 'error');
                        } else {
                            alert_toast("An error occurred", "error");
                        }
                        end_loader();
                    }
                });
            } else {
                alert_toast("You have reached the maximum limit for this item", "error");
            }
        } else {
            alert_toast("Please Login First!", 'warning');
        }
    }



    function initialize() {
        console.log("available:", availability);
        console.log("cart_count:", cart_count);
        var isAvailable = (availability > 0 && cart_count < availability);
        var availableDiv = document.getElementById('available');
        var unavailableDiv = document.getElementById('unavailable');
        var limitReached = document.getElementById('limit');

        if (isAvailable) {
            availableDiv.style.display = 'block';
            unavailableDiv.style.display = 'none';
            limitReached.style.display = 'none';
        } else {
            availableDiv.style.display = 'none';
            unavailableDiv.style.display = 'block';
            limitReached.style.display = 'block';
        }
    }

    function fetch() {
        $.ajax({
            url: _base_url_ + "products/fetch_products.php",
            method: 'GET',
            data: {
                id: '<?= isset($id) ? $id : "" ?>'
            },
            dataType: 'json',
            success: function(data) {
                availability = data.available;
                cart_count = data.cart_count;
                initialize();
            },
            error: err => {
                console.log(err);
                alert_toast("An error occurred", "error");
            },
        });

    }

    function buyNow() {
        if ("<?= $_settings->userdata('id') > 0 && $_settings->userdata('login_type') == 2 ?>" == 1) {
            if ('<?= $available > 0 ?>' == 1) {
                start_loader();
                $.ajax({
                    url: _base_url_ + "classes/Master.php?f=process_immediate_purchase", // Replace with the appropriate URL for immediate purchase
                    method: 'POST',
                    data: {
                        product_id: '<?= isset($id) ? $id : "" ?>',
                        quantity: 1
                    },
                    dataType: 'json',
                    error: err => {
                        console.error(err);
                        alert_toast("An error occurred", "error");
                        end_loader();
                    },
                    success: function(resp) {
                        if (resp.status == 'success') {
                            // Handle the success response for immediate purchase
                            alert_toast("Product has been purchased.", 'success');
                        } else if (!!resp.msg) {
                            alert_toast(resp.msg, 'error');
                        } else {
                            alert_toast("An error occurred", "error");
                        }
                        end_loader();
                    }
                });
            }
        } else {
            alert_toast("Please Login First!", 'warning');
        }
    }
</script>