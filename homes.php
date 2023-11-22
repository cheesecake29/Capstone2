<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <script src="https://kit.fontawesome.com/8714a42433.js" crossorigin="anonymous"></script>
</head>

<header class="" id="main-header">
<div class="home-container ">
        <div class="">
             <h1><?php echo $_settings->info('homename1') ?></h1>
        <p><?php echo $_settings->info('homedes1')  ?> </p>
            <div class="col-auto mt-2">
                <button class="shop-now"><a href="./?p=products">Shop now</a></button>
            </div>
        </div>
    </div>
</header>

<body class="Homepage">


<section class="py-5">
    <div class="containerrr">
        <h1 class="new-arrivals">New Arrivals</h1>
        <div class="row row-cols-sm-1 row-cols-md-2 row-cols-xl-4">
            <?php 
                $products = $conn->query("SELECT p.*, b.name as brand, c.category FROM `product_list` p INNER JOIN brand_list b ON p.brand_id = b.id INNER JOIN `categories` c ON p.category_id = c.id WHERE p.delete_flag = 0 AND p.status = 1 LIMIT 4");

                // Counter variable to keep track of displayed products
                $counter = 0;

                while ($row = $products->fetch_assoc()):
                    // Increment the counter
                    $counter++;

                    // Display your product information here
            ?>
                    <a class="product-container1" href="./?p=products/view_product&id=<?= $row['id'] ?>" style="width: 250px;">
                        <div class="card">
                            <div class="product-img-holder">
                                <img src="<?= validate_image($row['image_path']) ?>" alt="Product Image" class="img-top" style="width: 100%; height: 250px; display: flex; justify-content: center; align-items: center;" />
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

</body>

</html>