<?php
require_once('./config.php');

$response = array();
$countQuery = "SELECT COUNT(id) AS notificationCount FROM notifications WHERE `type` = 1
AND `is_read` = 0
AND `client_id` = '{$_settings->userdata('id')}'";
$result = $conn->query($countQuery);

if ($result) {
$row = $result->fetch_assoc();
$response = $row['notificationCount'];




// Send the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
}