<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./style.css">
    <script src="https://kit.fontawesome.com/8714a42433.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600&display=swap" rel="stylesheet">
    <style>
        .banner_fw_container {
            height: 100vh;
        }
        #banner-fw{
            background-image: url('<?php echo validate_image($_settings->info('cover')) ?>');
            background-size: cover;
            height: 100vh;
            position: relative;
            background-color:#1A547E;
        }
        .banner_fw {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgb(0 0 0 / 30%); /* Adjust the alpha value (fourth parameter) to control the overlay's transparency */
        }
        .banner_content{
            color:white;
        }
        .banner_content span {
            color:white;
            font-size: 30px;
        }
        .banner_content h1 {
            font-size: 65px;
        }
        button.shop-now-fw {
            padding: 15px 60px;
            background: none;
            box-shadow: none !important;
            border: 1px solid white;
        }
        button.shop-now-fw a{
            color:white;
            font-family: 'Montserrat', sans-serif;
        }
        .container.products_home_content {
            padding: 60px 0px;
        }
        .image_container_best_seller img {
            width: 100%;
        }
        .header_product_home {
            align-items: flex-start;
            display: flex;
            flex-direction: column;
            flex-wrap: nowrap;
            align-content: center;
            justify-content: center;
        }
        .header_product_home_ctn{
            padding:50px;
        }
        .header_product_home_ctn a {
            background: #0d6efd;
            color: white;
            padding: 15px 60px;
            border-radius: 41px;
        }
        .product_tn_home {
            margin-top: 45px;
        }
        .header_product_home_ctn span {
            color: #0d6efd;
            font-weight: 700;
            font-size: 24px;
        }
        section.new_arrivals h1 {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 30px;
            color: #0d6efd;
            font-weight: 500;
            font-size: 50px;
            border-bottom: 1px solid #e9e9e9;
        }
        .button_bottom_home a {
            background: #0d6efd;
            color: white;
            padding: 15px 60px;
            border-radius: 41px;
        }
        .button_bottom_home {
            text-align: center;
            margin-top: 60px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .d-flex {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
        }

        /* Styles for large screens */
        @media (min-width: 992px) {
            .banner_fw_container {
                height: 80vh;
            }
            .banner_fw .banner_fw_container {
                height: 100%;
            }
            .header_product_home {
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .button_bottom_home {
                display: flex;
                justify-content: center;
                align-items: center;
                text-align: center;
            }
            .banner_content h1 {
                font-size: 65px;
            }
            .banner_content p {
                font-size: 20px;
            }
        }

        /* Styles for medium screens */
        @media (max-width: 991px) {
            .banner_fw_container {
                height: 60vh;
            }
            .banner_fw .banner_fw_container {
                height: 100%;
            }
            .header_product_home {
                align-items: center;
            }
            .button_bottom_home {
                display: flex;
                justify-content: center;
                align-items: center;
                text-align: center;
            }
            .banner_content h1 {
                font-size: 50px;
                overflow-wrap: break-word;
            }
            .banner_content p {
                font-size: 18px;
                overflow-wrap: break-word;
            }
        }

        /* Styles for small screens */
        @media (max-width: 767px) {
            .banner_fw_container {
                height: 40vh;
            }
            .banner_fw .banner_fw_container {
                height: 100%;
            }
            .header_product_home {
                align-items: center;

            }
            .button_bottom_home {
                display: flex;
                justify-content: center;
                align-items: center;
                text-align: center;
            }
            .banner_content h1 {
                font-size: 40px;
                overflow-wrap: break-word;
            }
            .banner_content p {
                font-size: 16px;
                overflow-wrap: break-word;
            }
        }

    </style>
</head>
<body>
    <section id="banner-fw" >
        <div class="banner_fw">
            <div class="banner_fw_container container d-flex align-items-center">
                <div class="banner_content">
                   
                    <h1><?php echo $_settings->info('homename1') ?></h1>
                    <p><?php echo $_settings->info('homedes1')  ?> </p>
                    <button class="shop-now-fw"><a href="./?p=products">Shop now</a></button>
                </div>
            </div>
        </div>
    </section>
    <section id="products-home-fw" >
        <div class="products_home_fw">
            <div class="container products_home_content">
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="header_product_home">
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
                            // Counter variable to keep track of displayed products
                            $counter = 0;
                            while ($row = $products->fetch_assoc()) :
                                // Increment the counter
                                $counter++;
                                // Display your product information here
                            ?>
                            <div class="image_container_best_seller">
                                <img src="<?= validate_image($row['image_path']) ?>" alt="Product Image" class="img-top"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-12 header_product_home">
                        <div class="header_product_home_ctn">
                            <span>Best Seller</span>
                            <h2><?= $row['name'] ?></h2>
                            <p> <?= isset($description) ? html_entity_decode($description) : '' ?></p>
                            <div class="product_tn_home">
                                <a href="./?p=products/view_product&id=<?= $row['id'] ?>">View Product</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
                
                <?php
                    // Check if we have displayed 4 products, and break out of the loop if true
                    if ($counter >= 4) {
                        break;
                        }
                    endwhile;
                ?>
            </div>
        </div>
    </section>
    <section class="new_arrivals py-5">
        <div class="container">
            <h1 class="new-arrivals-ctn">New Arrivals</h1>
            <div class="row">
                <?php
                $products = $conn->query("SELECT p.*, b.name as brand, c.category FROM `product_list` p INNER JOIN brand_list b ON p.brand_id = b.id INNER JOIN `categories` c ON p.category_id = c.id WHERE p.delete_flag = 0 AND p.status = 1 LIMIT 4");
                // Counter variable to keep track of displayed products
                $counter = 0;
                while ($row = $products->fetch_assoc()) :
                    // Increment the counter
                    $counter++;
                    // Display your product information here
                ?>  
                    <div class="col-md-4 product_archive">
                        <a class="product-container1" href="./?p=products/view_product&id=<?= $row['id'] ?>">
                            <div class="card">
                                <div class="product-img-holder">
                                    <img src="<?= validate_image($row['image_path']) ?>" alt="Product Image" class="img-top" style="width: 100%; height: 250px; display: flex; justify-content: center; align-items: center; object-fit:cover;" />
                                </div>
                                <div class="card-body border-top">
                                    <div class="card-title my-0">
                                        <span><?= $row['name'] ?></span>
                                    </div>
                                    <p class="price">₱<?= strip_tags(html_entity_decode($row['price'])) ?>
                                        <span class="fas fa-tag"></span>
                                    </p>
                                </div>
                            </div>
                        </a>
                        
                    </div>
                <?php
                    // Check if we have displayed 4 products, and break out of the loop if true
                    if ($counter >= 3) {
                        break;
                    }
                endwhile;
                ?>
                <div class="button_bottom_home">
                    <a href="./?p=products/">Shop Now</a>
                </div>
            </div>
        </div>
    </section>
</body>
</html>