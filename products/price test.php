<?php
$search = isset($_GET['search']) ? $_GET['search'] : '';
$brand_filter = isset($_GET['brand_filter']) ? explode(",", $_GET['brand_filter']) : 'all';
$category_filter = isset($_GET['category_filter']) ? explode(",", $_GET['category_filter']) : 'all';

// Step 1: Get price range from the URL parameters
$min_price = isset($_GET['min_price']) ? floatval($_GET['min_price']) : 0;
$max_price = isset($_GET['max_price']) ? floatval($_GET['max_price']) : PHP_FLOAT_MAX;

// Step 2: Filter products by price range
$price_filter = "AND p.price >= $min_price AND p.price <= $max_price";

?>
<div class="content py-5 mt-3">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <!-- ... (other filter options) ... -->

                <!-- Start-Price range -->
                <div class="card card-outline shadow card-primary rounded-0">
                    <div class="card-header">
                        <h3 class="card-title"><b>Price Range</b></h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="get">
                            <div class="form-group">
                                <label for="min_price">Min Price</label>
                                <input type="text" name="min_price" id="min_price" class="form-control" value="<?= $min_price ?>">
                            </div>
                            <div class="form-group">
                                <label for="max_price">Max Price</label>
                                <input type="text" name="max_price" id="max_price" class="form-control" value="<?= $max_price ?>">
                            </div>
                            <button type="submit" class="btn btn-primary">Apply</button>
                        </form>
                    </div>
                </div>
                <!-- End-Price range -->
            </div>

            <div class="col-md-8 mt-3">
                <!-- ... (other content) ... -->

                <!-- Step 2: Apply price filter to the SQL query -->
                <?php
                $where = "";
                if (is_array($brand_filter)) {
                    $where .= " AND p.brand_id IN (" . implode(',', $brand_filter) . ") ";
                }
                if (is_array($category_filter)) {
                    $where .= " AND p.category_id IN (" . implode(',', $category_filter) . ") ";
                }
                

                if (!empty($search)) {
                    $where .= " AND (p.name LIKE '%$search%' OR p.description LIKE '%$search%' OR b.name LIKE '%$search%' OR c.category LIKE '%$search%') ";
                }
                // Apply price range filter
                $where .= $price_filter;

                $products = $conn->query("SELECT p.*, b.name as brand, c.category FROM `product_list` p
                    INNER JOIN brand_list b ON p.brand_id = b.id
                    INNER JOIN `categories` c ON p.category_id = c.id
                    WHERE p.delete_flag = 0 AND p.status = 1 $where
                    ORDER BY RAND()");
                while ($row = $products->fetch_assoc()):
                ?>
                <!-- ... (product display) ... -->
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</div>
<script>
    // ... (JavaScript for other filter options) ...

    // Update the URL with the price range filter
    $('#search_prod').submit(function (e) {
        e.preventDefault();
        var search = $(this).serialize();
        location.href = "./?p=products" + (search != '' ? "&" + search : "") +
            "<?= isset($_GET['brand_filter']) ? "&brand_filter=" . $_GET['brand_filter'] : "" ?>" +
            "<?= isset($_GET['category_filter']) ? "&category_filter=" . $_GET['category_filter'] : "" ?>" +
            "<?= isset($_GET['min_price']) ? "&min_price=" . $_GET['min_price'] : "" ?>" +
            "<?= isset($_GET['max_price']) ? "&max_price=" . $_GET['max_price'] : "" ?>";
    });

    // ... (JavaScript for other filter options) ...
</script>
