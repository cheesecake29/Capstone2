<?php
// Perform a database query to check for new orders
// Replace this with your actual logic to check for new orders
$newOrder = true; // Set to true if there's a new order, otherwise false

$response = array(
    'newOrder' => $newOrder,
);

header('Content-Type: application/json');
echo json_encode($response);
?>
