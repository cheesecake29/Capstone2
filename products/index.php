<?php
$search = isset($_GET['search']) ? $_GET['search'] : '';
$brand_filter = isset($_GET['brand_filter']) ? explode(",", $_GET['brand_filter']) : 'all';
$category_filter = isset($_GET['category_filter']) ? explode(",", $_GET['category_filter']) : 'all';

// Step 1: Get price range from the URL parameters
$min_price = isset($_GET['min_price']) ? floatval($_GET['min_price']) : 0;
$max_price = isset($_GET['max_price']) ? floatval($_GET['max_price']) : 0;

// Step 2: Filter products by price range
$price_filter = ($min_price > 0 || $max_price > 0)
    ? "AND p.price >= $min_price AND p.price <= $max_price"
    : "";

$where = "";


?>

<meta name="viewport" content="width=device-width, initial-scale=1.0">


<style>

@media only screen and (max-width: 1000px) {
    .filters-container {
        display: none; /* Hide the filters by default on small screens */
    }

    .filter-toggle {
        display: block; /* Show the filter toggle button on small screens */
        margin-top: 10px; /* Add some top margin for better spacing */
        background-color: #007bff; /* Add a background color for better visibility */
        color: white;
        border: none;
        padding: 10px;
        cursor: pointer;
    }

    .container {
        display: flex;
        flex-direction: column; /* Stack the columns in a vertical layout on smaller screens */
        align-items: center; /* Center align content on smaller screens */
    }

    .filters-container.show {
        display: flex; /* Show the filters when the show class is applied */
        flex-direction: column;
        align-items: center;
    }

    /* Adjust styling for other elements as needed */
    .search-input {
        width: 100%; /* Make the search input full width on smaller screens */
    }

    .product-container {
        width: 100%; /* Make product containers full width on smaller screens */
        margin: 1% 0; /* Adjust the margin for better spacing */
    }

    .filter-toggle{
        display: flex;
        justify-content: center;
        align-items: center;
    }
}
    .name {
        text-align: center;
        white-space: nowrap;
        /* Prevent text from wrapping */
        overflow: hidden;
        /* Hide overflowing text */
        text-overflow: ellipsis;
        /* Show ellipsis (...) when text overflows */
        max-width: 100%;
        /* Limit the maximum width to prevent container resizing */
        font-size: 20px;
        cursor: pointer;
        /* Change cursor to pointer on hover */
    }

    .price {
        font-size: 25px;
        color: black;
        text-align: center;
    }

    .stock {
        font-size: 14px;
        text-align: center;
    }

    .product-img-holder {
        margin: 2%;
    }

    .product-img-holder img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Maintain aspect ratio */
}


    .card {
        border: none;
    }

    .custom-control {
        display: flex;
    }

    .search-input {
        font-size: 14px;
    }

    .search-input:focus {
        box-shadow: none !important;
    }
span.ribbon {
    position: absolute;
    top: 9px;
    right: 8px;
    background-color: #e74c3c;
    color: #fff;
    padding: 5px 10px;
    /* transform: rotate(45deg); */
    z-index: 1;
    border-radius: 32px;
    font-size: 14px;
    font-weight: 100;
    letter-spacing: 1px;
}
</style>


<div class="content py-5 mt-3">
    <div class="container">
        <div class="row">

        <div class="col-md-4 d-md-none">
                <button class="btn btn-primary filter-toggle">Toggle Filters</button>
            </div>

            <div class="col-md-4 filters-container">
                <h3 class="text-muted">Filters</h3>
                <hr>
                <div class="card card-outline shadow card-primary rounded-0">
                    <div class="card-header" style="background-color:#0062CC; color:white;">
                        <h3 class="card-title"><b>Brands</b></h3>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-action">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input me-1" type="checkbox" id="brand_all" value="all" <?= !is_array($brand_filter) && $brand_filter == 'all' ? 'checked' : '' ?>>
                                    <label for="brand_all" class="custom-control-label w-100">All</label>
                                </div>
                            </li>
                            <?php
                            $brands = $conn->query("SELECT * FROM `brand_list` where `delete_flag` = 0 and `status` = 1 order by `name` asc");
                            while ($row = $brands->fetch_assoc()) :
                            ?>
                                <li class="list-group-item list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input me-1 brand_filter" type="checkbox" id="brand_<?= $row['id'] ?>" value="<?= $row['id'] ?>" <?= ((is_array($brand_filter) && in_array($row['id'], $brand_filter)) || (!is_array($brand_filter) && $brand_filter == 'all')) ? 'checked' : '' ?>>
                                        <label for="brand_<?= $row['id'] ?>" class="custom-control-label w-100"><?= $row['name'] ?></label>
                                    </div>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                </div>
                <div class="card card-outline shadow card-primary rounded-0">
                <div class="card-header" style="background-color:#0062CC; color:white;">
                        <h3 class="card-title"><b>Categories</b></h3>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-action">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input me-1" type="checkbox" id="category_all" value="all" <?= !is_array($category_filter) && $category_filter == 'all' ? 'checked' : '' ?>>
                                    <label for="category_all" class="custom-control-label w-100">All</label>
                                </div>
                            </li>
                            <?php
                            $categories = $conn->query("SELECT * FROM `categories` where `delete_flag` = 0 and `status` = 1 order by `category` asc");
                            while ($row = $categories->fetch_assoc()) :
                            ?>
                                <li class="list-group-item list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input me-1 category_filter" type="checkbox" id="category_<?= $row['id'] ?>" value="<?= $row['id'] ?>" <?= ((is_array($category_filter) && in_array($row['id'], $category_filter)) || (!is_array($category_filter) && $category_filter == 'all')) ? 'checked' : '' ?>>
                                        <label for="category_<?= $row['id'] ?>" class="custom-control-label w-100"><?= $row['category'] ?></label>
                                    </div>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                </div>
                <!-- Start price range -->
                <div class="card card-outline shadow card-primary rounded-0">
                <div class="card-header" style="background-color:#0062CC; color:white;">
                        <h3 class="card-title"><b>Price Range</b></h3>
                    </div>
                    <div class="card-body">
                        <form id="price_filter_form">
                            <div class="form-group">
                                <label for="min_price">Min Price</label>
                                <input type="number" name="min_price" placeholder="₱ MIN" id="min_price" class="form-control" value="<?= $min_price ?>" min="0" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                            </div>
                            <div class="form-group">
                                <label for="max_price">Max Price</label>
                                <input type="number" name="max_price" placeholder="₱ MAX" id="max_price" class="form-control" value="<?= $max_price ?>" min="0" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                            </div>
                            <button type="submit" class="btn btn-primary mt-3" id="apply_button">Apply</button>
                            <div id="error_message" style="color: red;"></div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8 mt-3">
                <div class="row">
                    <div class="col-md-12">
                        <form action="" id="search_prod">
                            <div class="input-group">
                            <input type="search" name="search" value="<?= $search ?>" class="search-input form-control" placeholder="Search Product...">

                                <div class="input-group-append" style="background-color:#0062CC;">
                                    <button class="btn btn-outline-secondary"><i class="fa fa-search" style="color:white;"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row row-cols-sm-1 row-cols-md-2 row-cols-xl-3">
                <?php
                    $products = $conn->query("SELECT p.*, b.name AS brand, c.category, COUNT(o.product_id) AS order_count
                        FROM product_list p
                            INNER JOIN brand_list b ON p.brand_id = b.id
                            INNER JOIN categories c ON p.category_id = c.id
                            INNER JOIN order_items o ON o.product_id = p.id
                        WHERE p.delete_flag = 0 
                            AND p.status = 1 
                            GROUP BY p.id
                            ORDER BY order_count DESC
                        LIMIT 1;");

                while ($row = $products->fetch_assoc()) :
                    $row['stocks'] = $conn->query("SELECT SUM(quantity) FROM stock_list where product_id = '{$row['id']}'")->fetch_array()[0];
                    $row['out'] = $conn->query("SELECT SUM(quantity) FROM order_items where product_id = '{$row['id']}' and order_id in (SELECT id FROM order_list where `status` != 5)")->fetch_array()[0];
        
                    if (array_key_exists('out', $row)) {
                        $row['available'] = $row['stocks'] - $row['out'];
                    } else {
                        $row['available'] = $row['stocks'];
                    }
                ?>
                
                    <!--Start Best Seller --->
                    <a class="product-container " href="./?p=products/view_product&id=<?= $row['id'] ?>" style="width: 250px;">
                        <div class="card ">
                            <div class="product-img-holder overflow-hidden position-relative">
                                <img src="<?= validate_image($row['image_path']) ?>" alt="Product Image" class="img-top" style="width: 100%; height: 250px; display: flex; justify-content: center; align-items: center;" />
                                <span class="ribbon">Best seller</span>
                                <span class="position-absolute price-tag rounded-pill bg-gradient-primary text-light px-3">
                                    <i class="fa fa-tags"></i> <b><?= number_format($row['price'], 2) ?></b>
                                </span>
                            </div>
                            <div class="card-body border-top">
                                <div class="name card-title my-0">
                                    <b><?= $row['name'] ?></b>
                                </div>
                                <p class="price">₱<?= strip_tags(html_entity_decode($row['price'])) ?>
                                    <span class="fas fa-tag"></span>
                                </p>
                                
                            </div>
                        </div>
                    </a>
                    
                        <!--End Best Seller--->
                        <?php endwhile; ?>

                    <?php
                    $where = "";
                    if (is_array($brand_filter)) {
                        $where .= " and p.brand_id in (" . implode(',', $brand_filter) . ") ";
                    }
                    if (is_array($category_filter)) {
                        $where .= " and p.category_id in (" . implode(',', $category_filter) . ") ";
                    }
                    if (!empty($search)) {
                        $where .= " and (p.name LIKE '%{$search}%' or p.price LIKE '%{$search}%' or p.description LIKE '%{$search}%' or b.name LIKE '%{$search}%' or c.category LIKE '%{$search}%') ";
                    }
                    if ($min_price > 0 || $max_price > 0) {
                        $where .= " and p.price >= $min_price and p.price <= $max_price";
                    }

                    $products = $conn->query("SELECT p.*,b.name as brand, c.category FROM `product_list` p
                        inner join brand_list b on p.brand_id = b.id
                        inner join `categories` c on p.category_id = c.id
                        where p.delete_flag = 0 and p.status = 1 {$where} order by RAND()");

                    while ($row = $products->fetch_assoc()) :
                        $row['stocks'] = $conn->query("SELECT SUM(quantity) FROM stock_list where product_id = '{$row['id']}'")->fetch_array()[0];
                        $row['out'] = $conn->query("SELECT SUM(quantity) FROM order_items where product_id = '{$row['id']}' and order_id in (SELECT id FROM order_list where `status` != 5)")->fetch_array()[0];
           
                        // Check if 'out' key exists in the $row array before using it
                        if (array_key_exists('out', $row)) {
                            $row['available'] = $row['stocks'] - $row['out'];
                        } else {
                            // Handle the case when 'out' key is not present
                            $row['available'] = $row['stocks'];
                        }
                    ?>

                        <!--Start Product--->
                        <a class="product-container " href="./?p=products/view_product&id=<?= $row['id'] ?>" style="width: 250px;">
                            <div class="card ">
                                <div class="product-img-holder overflow-hidden position-relative">
                                    <img src="<?= validate_image($row['image_path']) ?>" alt="Product Image" class="img-top" style="width: 100%; height: 250px; display: flex; justify-content: center; align-items: center;" />
                                    <span class="position-absolute price-tag rounded-pill bg-gradient-primary text-light px-3">
                                        <i class="fa fa-tags"></i> <b><?= number_format($row['price'], 2) ?></b>
                                    </span>
                                </div>
                                <div class="card-body border-top">
                                    <div class="name card-title my-0">
                                        <b><?= $row['name'] ?></b>
                                    </div>
                                    <p class="price">₱<?= strip_tags(html_entity_decode($row['price'])) ?>
                                        <span class="fas fa-tag"></span>
                                    </p>
                                   
                                </div>
                            </div>
                        </a>


                        <!--End Product--->
                    <?php endwhile; ?>
                </div>
                <?php if ($products->num_rows <= 0) : ?>
                    <div class="w-100 d-flex justify-content-center align-items-center" style="min-height:10em">
                        <center><em class="text-muted">No product available.</em></center>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<script>
$(function() {
    function toggleFilters() {
        $('.filters-container').slideToggle();
    }

    // Attach a click event handler to the filter toggle button
    $('.filter-toggle').click(function(e) {
        e.stopPropagation(); // Prevent the click from closing the filter section
        toggleFilters();
    });

    // Attach a click event handler to the document to close the filter section when clicking outside of it


   
        function validateAndEnableButton() {
            const min_price = parseFloat($("#min_price").val());
            const max_price = parseFloat($("#max_price").val());
            const errorElement = $("#error_message");
            const applyButton = $("#apply_button");

            if (isNaN(max_price)) {
                errorElement.text(""); // Clear the error message if max_price is empty
            } else if (max_price < min_price) {
                errorElement.text("Please input a valid price range");
                applyButton.prop("disabled", true); // Disable the button
            } else {
                errorElement.text(""); // Clear any previous error message
                applyButton.prop("disabled", false); // Enable the button
            }
        }

        function validatePriceInput(minPrice, maxPrice) {
            console.log(minPrice, maxPrice)
        }

        // Call the validation function when the input fields change
        $("#min_price, #max_price").on("input", validateAndEnableButton);

        // Attach a click event handler to the "Apply" button
        $("#apply_button").click(function() {
            validateAndEnableButton(); // Perform validation on button click
        });


        if ($('.brand_filter').length == $('.brand_filter:checked').length) {
            $('#brand_all').prop("checked", true)
        } else {
            $('#brand_all').prop("checked", false)
        }
        if ($('.category_filter').length == $('.category_filter:checked').length) {
            $('#category_all').prop("checked", true)
        } else {
            $('#category_all').prop("checked", false)
        }
        $('#brand_all').change(function() {
            if ($(this).is(':checked') == true) {
                $('.brand_filter').prop("checked", true).trigger('change')
            }
        })
        $('#category_all').change(function() {
            if ($(this).is(':checked') == true) {
                $('.category_filter').prop("checked", true).trigger('change')
            }
        })
        $('#search_prod').submit(function(e) {
            e.preventDefault();
            var search = $(this).serialize();
            var minPrice = parseFloat($('#min_price').val());
            var maxPrice = parseFloat($('#max_price').val());
            var minPriceError = $('#min_price_error');
            var maxPriceError = $('#max_price_error');

            var isMinPriceValid = validatePriceInput(minPrice, minPriceError);
            var isMaxPriceValid = validatePriceInput(maxPrice, maxPriceError);

            var priceRangeQuery = '';
            if (minPrice > 0 || maxPrice > 0) {
                priceRangeQuery = "&min_price=" + minPrice + "&max_price=" + maxPrice;
            }
            var brandFilter = '<?= isset($_GET['brand_filter']) ? "&brand_filter=" . $_GET['brand_filter'] : "" ?>';
            var categoryFilter = '<?= isset($_GET['category_filter']) ? "&category_filter=" . $_GET['category_filter'] : "" ?>';
            var price_filter = '<?= isset($_GET['price_filter']) ? "&price_filter=" . $_GET['price_filter'] : "" ?>';
            location.href = "./?p=products" + (search != '' ? "&" + search : "") + brandFilter + categoryFilter + priceRangeQuery;
        });
        $('#min_price, #max_price').on('input', function() {
            validatePriceInput($(this), $(this).siblings('.text-danger'));
        });

        $('#apply_button').click(function(e) {
            e.preventDefault();
            var minPrice = parseFloat($('#min_price').val());
            var maxPrice = parseFloat($('#max_price').val());
            var searchParams = new URLSearchParams(window.location.search);

            // Update the URL parameters with the price range
            searchParams.set('min_price', minPrice);
            searchParams.set('max_price', maxPrice);

            // Redirect to the filtered URL
            window.location.search = searchParams.toString();
        });

        



        $('.brand_filter').change(function() {
            var brand_ids = [];
            if ($('.brand_filter').length == $('.brand_filter:checked').length) {
                $('#brand_all').prop("checked", true)
            } else {
                $('#brand_all').prop("checked", false)
                $('.brand_filter:checked').each(function() {
                    brand_ids.push($(this).val())
                })
                brand_ids = brand_ids.join(",")
            }

            location.href = "./?p=products" + (brand_ids.length > 0 ? "&brand_filter=" + brand_ids : "") + "<?= isset($_GET['category_filter']) ? "&category_filter=" . $_GET['category_filter'] : "" ?><?= isset($_GET['search']) ? "&search=" . $_GET['search'] : "" ?>";
        })
        $('.category_filter').change(function() {
            var category_ids = [];
            if ($('.category_filter').length == $('.category_filter:checked').length) {
                $('#category_all').prop("checked", true)
            } else {
                $('#category_all').prop("checked", false)
                $('.category_filter:checked').each(function() {
                    category_ids.push($(this).val())
                })
                category_ids = category_ids.join(",")
            }

            location.href = "./?p=products" + (category_ids.length > 0 ? "&category_filter=" + category_ids : "") + "<?= isset($_GET['brand_filter']) ? "&brand_filter=" . $_GET['brand_filter'] : "" ?><?= isset($_GET['search']) ? "&search=" . $_GET['search'] : "" ?>";
        })
    })

   
</script>