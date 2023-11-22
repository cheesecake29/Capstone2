<?php
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $result = $conn->query("SELECT * from product_image_gallery where product_id = '" . $_GET['id'] . "' AND is_deleted = 0");

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

        margin:  4%;
        width: 80%;

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

    .text-price {
        color: firebrick;
    }

    .gallery-item img {
        height: 119px;
        object-fit: cover;
        width: 100%;
    }

    .gallery-container {
        overflow: auto;
        width: 100%;
    }

    .gallery {
        position: relative;
        white-space: nowrap;
        height: 100%;
    }

    .gallery-item {
        margin: 10px;
        cursor: pointer;
        display: inline-block;
    }

    #lightbox {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1000;
        background: rgba(0, 0, 0, 0.8);
    }

    #lightbox img {
        display: block;
        margin: 50px auto;
        max-width: 90%;
        max-height: 90%;
    }

    #lightbox .close {
        color: #fff;
        font-size: 30px;
        position: absolute;
        top: 15px;
        right: 15px;
        cursor: pointer;
    }

    .product_title_description {
        text-align: justify;
    }

    .checked {
        color: #f7d72c;
    }

    .left-container {
        max-width: 25vw;
        min-width: 25vw;
    }

    .product-image img {
        object-fit: cover;
        width: 100%;
    }

    .review-section .review-details i:not(.checked) {
        color: #a5a3a3;
    }

    .review-section .review-details .reviewer-comments {
        font-size: 14px;
        text-align: justify;
    }
</style>

.img-thumbnail{
    box-shadow: 0 3px 10px rgba(3, 3, 3, 0.619);
}

</style>
<div class="content ">
    <div class="container">
        <div class="d-flex">
            <div class="left-container">
                <div class="image product-image text-center">
                    <img src="<?= validate_image(isset($image_path) ? $image_path : "") ?>" alt="Product Image <?= isset($name) ? $name : "" ?>" class="img-thumbnail product-img">
                </div>
                <div class="gallery-container">
                    <div class="gallery">
                        <?php
                        while ($row = $result->fetch_assoc()) {
                            echo '<div class="gallery-item" data-image="' . $row['image_url'] . '">
                                      <img src="' . $row['image_url'] . '" alt="Gallery Image">
                                  </div>';
                        }
                        ?>
                    </div>
                </div>
                <div id="lightbox">
                    <span class="close">&times;</span>
                    <img id="lightbox-image" src="" alt="Lightbox Image">
                </div>
            </div>
            <div class="right-container px-5">
                <div class="info">
                    <h1 class="brand_name text-capitalize"><?= isset($name) ? $name : '' ?> </h1>
                    <?= isset($description) ? html_entity_decode($description) : '' ?>
                </div>
                <h3 class="text-success" id="default">
                    ₱<?php
                        $minVariation = $conn->query("SELECT MIN(variation_price) as lowestVariation FROM product_variations where product_id = $id")->fetch_assoc();
                        echo number_format($minVariation['lowestVariation'], 2);
                        ?> 
                </h3>
                <h3 class="text-success" id="selectedVariation"></h3>
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
                            $cartItemCount = $conn->query("SELECT SUM(quantity) as cartQuantity FROM cart_list where product_id = '{$id}'")->fetch_array()[0];
                            $productStockTotalQuantity = $productQuantity['quantity'];
                            if ($orderItemStocks->num_rows > 0) {
                                $oiStocksQuantity = $orderItemStocks->fetch_assoc();
                                $productStockQuantity = $productQuantity['quantity'] - $oiStocksQuantity['totalQuantity'];
                                $productStockTotalQuantity = $productStockQuantity - $cartItemCount;
                            }
                            ?>
                            <span id="available_stock"><?= isset($productStockTotalQuantity) ? number_format($productStockTotalQuantity) : '' ?></span>
                        </strong>
                    </h6>
                    <div class="d-flex flex-column">
                        <?php
                        $variations = $conn->query("SELECT * FROM product_variations where product_id = $id");
                        while ($variation = $variations->fetch_assoc()) :
                            $orderItemWithSameVariation = $conn->query("SELECT SUM(quantity) FROM order_items where product_id = '{$id}'
                                and variation_id = '{$variation['id']}' and order_id in (SELECT id FROM order_list where `status` != 5)");
                            $variationTotalQuantity = $variation['variation_stock'];
                            $cartVarItemCount = $conn->query("SELECT SUM(quantity) as cartQuantity FROM cart_list where product_id = '{$id}'
                                and variation_id = '{$variation['id']}'")->fetch_array()[0];
                            if ($orderItemWithSameVariation->num_rows > 0) {
                                $oitQuantity = $orderItemWithSameVariation->fetch_array()[0];
                                $variationQuantity = $variation['variation_stock'] - $oitQuantity;
                                $variationTotalQuantity = $variationQuantity - $cartVarItemCount;
                            }
                        ?>
                            <div class="d-block me-5">
                                <label class="w-100" for='variation_<?php echo $variation['id'] ?>'>
                                    <div class="d-flex justify-content-between">
                                        <div class="bd-highlights">
                                            <input type='radio' name='variations' id='variation_<?php echo $variation['id'] ?>' value='<?php echo $variation['id'] ?>' onclick="handleVariationSelect(this, '<?= number_format($variation['variation_price'], 2)  ?>')" />
                                            <span id='stock_<?php echo $variation['id'] ?>'>
                                                <?php echo $variation['variation_name'] ?> -
                                                <span class="text-price"> <?= number_format($variation['variation_price'], 2)  ?> php </span>
                                        </div>
                                        <div class="bd-highlights">
                                            <small>
                                                <span id='variation_stock_<?php echo $variation['id'] ?>' class="var_stock" data-id="<?php echo $variation['id'] ?>" data-total="<?= $variationTotalQuantity ?>"> <?= $variationTotalQuantity ?> qty.</span>
                                            </small>
                                        </div>
                                    </div>
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
    <div class="container my-5">
        <div class="product-review">
            <?php
            $productReviews = $conn->query(
                "SELECT oi.rate_level, oi.rate_comments, oi.date_updated, cl.firstname, cl.lastname FROM `order_items` oi
                    inner join `order_list` ol on ol.id = oi.order_id
                    inner join `client_list` cl on cl.id = ol.client_id
                where oi.product_id =  $id and oi.rated = 1 order by unix_timestamp(oi.date_updated) desc;
                "
            );
            while ($review = $productReviews->fetch_assoc()) :
            ?>
                <div class="review-section mb-3 border rounded p-3">
                    <figure class="mb-1">
                        <blockquote class="blockquote">
                            <p><?= ucfirst($review['lastname']), ', ', ucfirst($review['firstname']) ?></p>
                        </blockquote>
                        <figcaption class="blockquote-footer mb-1">
                            <?= date("Y-m-d h:i:s A", strtotime($review['date_updated'])) ?>
                        </figcaption>
                    </figure>
                    <div class="review-details">
                        <?php switch (strval($review['rate_level'])):
                            case "1": ?>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            <?php break;
                            case "2": ?>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            <?php break;
                            case "3": ?>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            <?php break;
                            case "4": ?>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star-o"></i>
                            <?php break;
                            case "5": ?>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star checked"></i>
                            <?php break;
                            default: ?>
                        <?php endswitch; ?>
                        <p class="reviewer-comments mt-3"><?= ucfirst($review['rate_comments']) ?></p>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</div>




<script>
    $(document).ready(function() {
        fetch();
        let availability = 0;
        let cart_count = 0;
    });

    function handleVariationSelect(variation, variation_price) {
        if (variation.checked) {
            $('#add_to_cart').removeAttr("disabled");
            $('#default').hide("slow");
            $('#selectedVariation').html(`₱ ${variation_price}`);

        }
    }

    function addToCart() {
        const variationId = $("input[type='radio'][name='variations']:checked").val();
        if ("<?= $_settings->userdata('id') > 0 && $_settings->userdata('login_type') == 2 ?>" == 1) {
            availability--;
            let avail_stock = availability - cart_count;
            $('#available_stock').html(avail_stock);
            let var_item_stock = $('#variation_stock_' + variationId).data('total');
            var_item_stock--;
            $('#variation_stock_' + variationId).html(var_item_stock + " qty.");
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
                            fetch();
                            alert_toast("Product has been added to cart.", 'success');
                            update_cart_count(resp.cart_count);
                            const cartCount = resp.cart_count;
                            const cartCountSpan = $('#cart_count');

                            if (cartCount !== 0) {
                                cartCountSpan.text(cartCount).addClass('badge bg-danger cart-badge').removeClass('hidden');
                            } else {
                                cartCountSpan.text('').removeClass('badge bg-danger cart-badge').addClass('hidden');
                            }

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

    // function update_cart_count($count){
    //     $('#cart_count').text($count)
    // }

    function initialize() {
        console.log("available:", availability);
        console.log("cart_count:", cart_count);
        var isAvailable = (availability > 0 && cart_count < availability);
        var availableDiv = document.getElementById('available');
        var unavailableDiv = document.getElementById('unavailable');
        var limitReached = document.getElementById('limit');
        //var cartNum = document.getElementById('cart_count');

        if (isAvailable) {
            availableDiv.style.display = 'block';
            unavailableDiv.style.display = 'none';
            limitReached.style.display = 'none';
        } else {
            availableDiv.style.display = 'none';
            unavailableDiv.style.display = 'block';
            limitReached.style.display = 'block';
        }
        update_cart_count(cart_count);

        //document.getElementById('cart_count').textContent = cart_count;
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
                update_cart_count(cart_count);
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
    $(document).ready(function() {
        // Open lightbox on image click
        $('.gallery-item').on('click', function() {
            var imagePath = $(this).data('image');
            $('#lightbox-image').attr('src', imagePath);
            $('#lightbox').fadeIn();
        });

        // Close lightbox on close button click or outside click
        $('#lightbox, .close').on('click', function() {
            $('#lightbox').fadeOut();
        });
    });
</script>