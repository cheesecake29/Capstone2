<?php
// Include your database connection
include 'db_connection.php'; // Replace with the actual path to your database connection script

if (isset($_POST['brand_id'])) {
    $brand_id = $_POST['brand_id'];

    // Perform a database query to fetch categories for the selected brand
    $categories = array();

    // Replace this with your actual query to fetch categories based on $brand_id
    $category_query = $conn->query("SELECT id, name FROM categories WHERE brand_id = $brand_id");

    if ($category_query->num_rows > 0) {
        while ($category_row = $category_query->fetch_assoc()) {
            $categories[$category_row['id']] = $category_row['name'];
        }
    }

    // Return categories as JSON
    echo json_encode($categories);
} else {
    echo json_encode(array()); // Return an empty JSON array if brand_id is not set
}
?>
