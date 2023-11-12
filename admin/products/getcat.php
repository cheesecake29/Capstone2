<?php
require_once('./../../config.php');
$user = $_REQUEST['user'];
//this gets the brand selected
$brands = $conn->query("SELECT * FROM brand_list where id = " . $user)->fetch_assoc();
//this gets the category related to brand
$categories = $conn->query("SELECT * FROM categories where id = " . $brands['category_id'] . " order by `category` asc ");
$row = $categories->fetch_assoc();

//returns the data
echo json_encode($row);
?>