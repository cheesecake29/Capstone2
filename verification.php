<?php require_once('./config.php');  ?>
<!DOCTYPE html>
<html lang="en">
<?php require_once('inc/header.php');  ?>
<?php
// verification.php

// Validate and sanitize the email parameter
$email = isset($_GET['email']) ? filter_var($_GET['email'], FILTER_VALIDATE_EMAIL) : null;

if (!$email) {
    die('Invalid email parameter');
}

// Display the OTP input form
?>

<!-- Montserrat Font (800 weight) -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&display=swap">

<!-- Julius Sans One Font -->
<link href="https://fonts.googleapis.com/css2?family=Julius+Sans+One&display=swap" rel="stylesheet">

<!-- Montserrat Font (800 weight) and Poppins Font (200 weight) -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&family=Poppins:wght@200;200&display=swap">
<link rel="stylesheet" href="./css/login.css">

<body>
  <script>
    start_loader();
  </script>

  <?php $page = isset($_GET['page']) ? $_GET['page'] : 'home';  ?>
  <?php if ($_settings->chk_flashdata('success')) : ?>
    <script>
      alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
    </script>
  <?php endif; ?>

  <div class="login-container">
    <div class="left-login">
      <h1>OTP Verification</h1>
      <form id="verification-frm" action="" method="post">
        <div class="login-textfield-container">
          <div class="text-field-login">
            <div class="input-area">
              <label class="label" for="email">Email</label>
              <input type="email" name="email" autofocus placeholder="Enter OTP" value="<?php echo $email; ?>" required disabled>

              <label class="label" for="verification">OTP</label>
              <input type="text" name="verification" autofocus placeholder="Enter OTP" required>
            </div>
          </div>
        </div>
        </form>
    </div>
    <div class="right-login">
      <img src="<?= validate_image($_settings->info('logo')) ?>" alt="System Logo">
    </div>
  </div>

  <script src="<?= base_url ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<!-- <script src="<?= base_url ?>dist/js/adminlte.min.js"></script> -->

<script>
  $(document).ready(function(){
    end_loader();
    $('#verification-frm').submit(function(e){
      e.preventDefault()
      var _this = $(this)
      $('.err-msg').remove(); // Make sure to add an element with class 'err-msg' where you want error messages
      var el = $('<div>')
      el.hide()
      start_loader();
      $.ajax({
        url: _base_url_ + "classes/Users.php?f=verification_code",
        data: new FormData($('#verification-frm')[0]), // Use the form ID directly
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        dataType: 'json',
        error: err => {
          console.log(err)
          alert_toast("An error occurred", 'error');
          end_loader();
        },
        success: function(resp){
          if(typeof resp == 'object' && resp.status == 'success'){
            var emailInput = $("#email").val(); // Get the email input value
            location.href = "login.php";
          } else if(resp.status == 'failed' && !!resp.msg){   
            el.addClass("alert alert-danger err-msg").text(resp.msg)
            _this.prepend(el)
            el.show('slow')
          } else {
            alert_toast("An error occurred", 'error');
            end_loader();
            console.log(resp)
          }
          $('html, body').scrollTop(0)
        }
      })
    })
  })
</script>
 
  
</body>

</html>