<?php
require_once('./config.php');

if (isset($_POST['notification_id'])) {
    $clicked_notification_id = $_POST['notification_id'];

    function markNotificationAsRead($conn, $notification_id) {

        $result = $conn->query("UPDATE notifications SET is_read = 1 WHERE id = $notification_id");

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    $is_marked_as_read = markNotificationAsRead($conn, $clicked_notification_id);

    if ($is_marked_as_read) {
        echo "Notification marked as read!";
    } else {
        echo "Failed to mark notification as read.";
    }
}