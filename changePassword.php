<?php
require_once('./config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $token = isset($_POST['token']) ? $_POST['token'] : '';
    $newPassword = isset($_POST['newPass']) ? $_POST['newPass'] : '';

    // Check if email and token exist in the forgotPassword table
    $checkTokenQuery = $conn->query("SELECT * FROM `forgotPassword` WHERE email = '$email' AND token = '$token'");
    $tokenExists = $checkTokenQuery->num_rows > 0;

    if ($tokenExists) {
        // Hash the new password using MD5
        $hashedPassword = md5($newPassword);

        // Update password in the client_list table
        $changePass = $conn->query("UPDATE `client_list` SET `password` = '$hashedPassword' WHERE email = '$email'");

        if ($changePass) {
            // Delete the record from the forgotPassword table
            $deleteTokenQuery = $conn->query("DELETE FROM `forgotPassword` WHERE email = '$email' AND token = '$token'");

            if ($deleteTokenQuery) {
                echo json_encode(['status' => 'success', 'msg' => 'Update successful']);
            } else {
                echo json_encode(['status' => 'failed', 'msg' => 'Failed to delete token: ' . mysqli_error($conn)]);
            }
        } else {
            echo json_encode(['status' => 'failed', 'msg' => 'Update failed: ' . mysqli_error($conn)]);
        }
    } else {
        echo json_encode(['status' => 'failed', 'msg' => 'Invalid token or email']);
    }
} else {
    // Handle invalid request method
    http_response_code(405);
    echo json_encode(['status' => 'failed', 'msg' => 'Method Not Allowed']);
}
?>
