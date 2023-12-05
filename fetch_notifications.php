<?php
require_once('./config.php');

function fetchNotifications($conn) {
    global $_settings;
    $userId = $_settings->userdata('id');
    $query = "SELECT * FROM notifications WHERE `type` = 1
                AND `client_id` = '$userId' ORDER BY is_read ASC, id DESC";
    $result = $conn->query($query);

    // Check if there are notifications
    if ($result->num_rows > 0) {
        $notifications = array();

        // Fetch each notification
        while ($row = $result->fetch_assoc()) {
            $notifications[] = $row;
        }

        // Return notifications as JSON
        header('Content-Type: application/json');
        echo json_encode($notifications);
    } else {
        // If there are no notifications
        $response = array('message' => 'No notifications available');
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    // Close the database connection
    $conn->close();
}

// Call the function to fetch notifications
fetchNotifications($conn);
?>
