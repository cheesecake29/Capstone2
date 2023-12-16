<?php
require_once('./../config.php');

if (isset($_GET['id']) && $_GET['id'] > 0) {
    $response = array();  // Create an array to store the response data

    $qry = $conn->query("SELECT p.*, b.name as brand, c.category from `product_list` p inner join brand_list b on p.brand_id = b.id inner join categories c on p.category_id = c.id where p.id = '{$_GET['id']}' ");

    if ($qry->num_rows > 0) {
        while ($row = $qry->fetch_assoc()) {
            foreach ($row as $k => $v) {
                $response[$k] = stripslashes($v);  // Add each key-value pair to the response array
            }
            // Get total stock of product
            $stocks = $conn->query("SELECT SUM(quantity) FROM stock_list where product_id = '{$response['id']}'")->fetch_array()[0];
            // Get inprogress order of product where status is not delivered yet
            $out = $conn->query("SELECT SUM(quantity) FROM order_items where product_id = '{$response['id']}' and order_id in (SELECT id FROM order_list where `status` != 5)")->fetch_array()[0];
            // Get total quantity of the users cart by THIS product id
            $cart_item_count = $conn->query("SELECT SUM(quantity) FROM cart_list where product_id = '{$response['id']}'")->fetch_array()[0];
            $stocks = $stocks > 0 ? $stocks : 0; // Set stocks [product total stocks]
            $out = $out > 0 ? $out : 0; // Set out [inprogress orders]

            // Return available and user total cart count
            $placeholder_total =  $stocks - $out; // subtract the inprogress orders from the total stocks
            $response['available'] = $placeholder_total - $cart_item_count; 
            $response['cart_count'] = $cart_item_count > 0 ? $cart_item_count : 0;
        }
    }

    // Send the response as JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}
