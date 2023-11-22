<?php
use PHPMailer\PHPMailer\PHPMailer;

require_once 'phpmailer/Exception.php';
require_once 'phpmailer/PHPMailer.php';
require_once 'phpmailer/SMTP.php';

$mail = new PHPMailer(true);

$alert = '';

if(isset($_POST['submit'])){
  // ... (your existing code for processing other fields)

  // Additional fields from the second code
  $email = $_POST['email'];
  $phone_number = $_POST['phone_number'];
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $order_type = $_POST['order_type'];
  $province = $_POST['province'];
  $city = $_POST['city'];
  $addressline1 = $_POST['addressline1'];
  $addressline2 = $_POST['addressline2'];
  $zipcode = $_POST['zipcode'];

  try{
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'jewellsalongcong09@gmail.com'; // Gmail address which you want to use as SMTP server
    $mail->Password = 'qtvg fecm oroc fbik'; // Gmail address Password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = '587';

    $mail->setFrom('jewellsalongcong09@gmail.com');
    $mail->addAddress('jewellsalongcong09@gmail.com');

    $mail->isHTML(true);
    $mail->Subject = 'Message Received (Contact Page)';

    // Modify the email body to include additional fields
    $mail->Body = "
      <h3>Name : $name <br>
      Email: $email <br>
      Message : $message <br>
      Phone Number: $phone_number <br>
      First Name: $firstname <br>
      Last Name: $lastname <br>
      Order Type: $order_type <br>
      Province: $province <br>
      City: $city <br>
      Address Line 1: $addressline1 <br>
      Address Line 2: $addressline2 <br>
      Zip Code: $zipcode <br>
      </h3>";

    $mail->send();
    $alert = '<div class="alert-success">
                 <span>Message Sent! Thank you for contacting us.</span>
                </div>';
  } catch (Exception $e){
    $alert = '<div class="alert-error">
                <span>'.$e->getMessage().'</span>
              </div>';
  }
}
?>
