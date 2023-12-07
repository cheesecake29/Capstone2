<?php
require_once('./config.php');

$type = isset($_POST['type']) ? $_POST['type'] : null;

if ($type !== null) {
    try {
        $stmt = $conn->prepare("UPDATE notifications SET is_read = 1 WHERE type = ?");
        
        if (!$stmt) {
            header('Content-Type: application/json');
            echo json_encode(array('success' => false, 'message' => 'Error preparing query: ' . $conn->error));
            exit;
        }

        $stmt->bind_param('i', $type);

        if ($stmt->execute()) {
            header('Content-Type: application/json');
            echo json_encode(array('success' => true, 'message' => 'Marked as read successfully.'));
        } else {
            header('Content-Type: application/json');
            echo json_encode(array('success' => false, 'message' => 'Error executing query: ' . $stmt->error));
        }
    } catch (Exception $e) {
        header('Content-Type: application/json');
        echo json_encode(array('success' => false, 'message' => 'Error: ' . $e->getMessage()));
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(array('success' => false, 'message' => 'Invalid request'));
}
