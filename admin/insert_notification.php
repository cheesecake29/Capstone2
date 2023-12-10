<?php
require_once('./../config.php');

$notificationType = $_POST['notificationType'] ?? '';

if ($notificationType !== '') {
    $checkQuery = "SELECT * FROM notifications WHERE `description` = 'You still have pending orders.'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult && $checkResult->num_rows > 0) {
        // Delete existing notification with the same description
        $deleteQuery = "DELETE FROM notifications WHERE `description` = 'You still have pending orders.'";
        if ($conn->query($deleteQuery) === TRUE) {
            echo "Existing notification deleted successfully";
        } else {
            echo "Error deleting existing notification: " . $conn->error;
        }
    }

    // Insert new notification
    $insertQuery = "INSERT INTO notifications (`type`, `description`) VALUES (2, '$notificationType')";
    if ($conn->query($insertQuery) === TRUE) {
        echo "Notification inserted successfully";
    } else {
        echo "Error inserting notification: " . $conn->error;
    }
} else {
    echo "Invalid notification type";
}


?>