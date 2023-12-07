<?php
require_once('./config.php');

if(isset($_POST['galleryID'])) {
    // Sanitize and get the gallery ID from the POST data
    $galleryID = mysqli_real_escape_string($conn, $_POST['galleryID']);

    // Run the query to update the database
    $del = $conn->query("UPDATE `product_image_gallery` set `is_deleted` = 1  where id = '$galleryID'");
    if($del) {
        echo "Update successful";
    } else {
        echo "Update failed: " . mysqli_error($conn);
    }
} else {
    echo "Gallery ID not provided";
}
