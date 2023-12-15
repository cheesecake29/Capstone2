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
                <input type="hidden" name="id">

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
  $(document).ready(function(){
    $('.reset').click(function(){
      var email = $('#email').val();
      var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

      if (!emailPattern.test(email)) {
        $('#email-error').text('Please enter a valid email address');
        return;
      } else {
        $('#email-error').text('');
      }
      console.log(email);
      // $.ajax({
      //   type: 'POST',
      //   url: 'reset_password.php', // Replace 'reset_password.php' with your PHP endpoint for handling password reset
      //   data: { email: email },
      //   success: function(response){
      //     // Handle the response after sending the email
      //     console.log(response);
      //     // You can add further actions here based on the response
      //   },
      //   error: function(error){
      //     // Handle errors if the request fails
      //     console.error(error);
      //   }
      // });
    });
  });
</script>