<?php require_once('./config.php') ?>

<!DOCTYPE html>
<html lang="en">
  <?php require_once('inc/header.php') ?>
 <!--- <link rel="stylesheet" href="registerstyle.css"> --->
 <!--- <link rel="stylesheet" href="registerstyle.css"> --->

 <!-- Montserrat Font (800 weight) -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&display=swap">

<!-- Julius Sans One Font -->
<link href="https://fonts.googleapis.com/css2?family=Julius+Sans+One&display=swap" rel="stylesheet">

<!-- Montserrat Font (800 weight) and Poppins Font (200 weight) -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&family=Poppins:wght@200;200&display=swap">
<link rel="stylesheet" href="./css/register.css">
  <body>
  <div class="signin-container">

    <div class="left-signin ">
    <marquee>FIND YOUR PERFECT FIT</marquee>
      
        <form id="register-frm" action="" method="POST">
        <div class="signin-textfield-container">
        <div class="text-field-sign">
          <div class="input-area">
            <label class="label" for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Enter your email" required>
          </div>
        </div>

      
        <div class="back_to_shop">
            <a href="<?php echo base_url ?>">Back to Shop</a>
          </div>

          <div id="signin-btn">
            <button type="submit" class="reset">Reset password</button>
          </div>

        </div>
            </form>


      
    </div>
    <div class="right-signin">

      <img src="<?= validate_image($_settings->info('logo')) ?>" alt="System Logo">
        
    </div>
    </div>

<script src="<?= base_url ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<!-- <script src="<?= base_url ?>dist/js/adminlte.min.js"></script> -->

<script>
$(document).ready(function () {
    $('#register-frm').submit(function (e) {
        e.preventDefault();
        var _this = $(this);
        var email = $('#email').val();
        start_loader();

        $.ajax({
            url: "reset_password.php",
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            dataType: 'json',
            error: function (jqXHR, textStatus, errorThrown) {
                console.log("AJAX Error:", jqXHR.responseText);
                alert_toast("An error occurred", 'error');
                end_loader();
            },
            success: function (resp) {
                console.log("Response:", resp);

                // Log the response status for further debugging
                console.log("Response status:", resp.status);

                if (resp.status === 'success') {
                    alert("Kindly check your email to reset your password");
                    location.href = "login.php?email=" + encodeURIComponent(email);
                } else if (resp.status === 'failed' && resp.msg) {
                    var errorMessage = $('<div class="alert alert-danger err-msg"></div>').text(resp.msg);
                    _this.prepend(errorMessage);
                    errorMessage.show('slow');
                } else {
                    alert_toast("An error occurred", 'error');
                    end_loader();
                    console.log("Unexpected response:", resp);
                    location.href = "login.php";
                }
                $('html, body').scrollTop(0);
            }
        });
    });
});
</script>