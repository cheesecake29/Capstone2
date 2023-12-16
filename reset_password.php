<?php
require_once('./config.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
        
require 'classes/phpmailer/src/Exception.php';
require 'classes/phpmailer/src/PHPMailer.php';
require 'classes/phpmailer/src/SMTP.php';

if (isset($_POST['email'])) {
    $emailInput = mysqli_real_escape_string($conn, $_POST['email']);

    // Check if the email exists in the client_list table
    $checkEmailQuery = $conn->query("SELECT * FROM `client_list` WHERE email = '$emailInput'");
    if ($checkEmailQuery->num_rows > 0) {
        $token = bin2hex(random_bytes(32)); // 32 bytes = 256 bits
        $stmt = $conn->prepare("INSERT INTO `forgotpassword` (`email`, `token`, `status`) VALUES (?, ?, 'requestPassword')");
        $stmt->bind_param("ss", $emailInput, $token);
        if ($stmt->execute()) {
            $mail = new PHPMailer();
            try {
                $mail->isSMTP();
                $mail->Host = "smtp.hostinger.com";
                $mail->SMTPAuth = true;
                $mail->Username = "testemail@celesment.com";
                $mail->Password = "Test@12345";
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;

                $mail->setFrom('testemail@celesment.com', 'Arnold TV Motoshop');
                $mail->addAddress($emailInput);
                $mail->Subject = 'Password Reset Request';
                $mail->Body = 'Your password reset request was successful. Click the following link to reset your password: ' .
                    'https://atvmotoshop.online/Capstone2/password_reset.php?token=' . $token . '&email=' . urlencode($_POST['email']);

                $mail->send();
                echo json_encode([
                    'status' => 'success',
                    'msg' => 'Your Password Requested Successfully. Check your email for the password reset link.'
                ]);
            } catch (Exception $e) {
                echo json_encode([
                    'status' => 'failed',
                    'msg' => 'Error sending email: ' . $e->getMessage()
                ]);
            }
        } else {
            echo json_encode([
                'status' => 'failed',
                'msg' => 'Failed to process the password reset request.'
            ]);
        }
        $stmt->close();
    } else {
        echo json_encode([
            'status' => 'failed',
            'msg' => 'Email does not exist in our records.'
        ]);
    }
} else {
    echo json_encode([
        'status' => 'failed',
        'msg' => 'Email not provided'
    ]);
}
?>
