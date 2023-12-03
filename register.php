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
            <label class="label" for="firstname">First Name</label>
            <input type="text" name="firstname" id="firstname" placeholder="Enter First Name" onkeydown="return allowOnlyLetters(event)" autofocus required>
          </div>
        </div>

        <div class="text-field-sign">
          <div class="input-area">
            <label class="label" for="lastname">Last Name</label>
            <input type="text" name="lastname" id="lastname" placeholder="Enter Last Name" onkeydown="return allowOnlyLetters(event)" required>
          </div>
        </div>

        <div class="text-field-sign">
          <div class="input-area">
            <label class="label" for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Enter your email" required>
          </div>
        </div>

        <div class="text-field-sign">
          <div class="input-area">
            <label class="label" for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Type your password" required>
          </div>
        </div>

        <div class="text-field-sign">
          <div class="input-area">
            <label class="label" for="cpassword">Confirm Password</label>
            <input type="password" id="cpassword" placeholder="Confirm Password" required>
          </div>
        </div>

        


      
        <div class="back_to_shop">
            <a href="<?php echo base_url ?>">Back to Shop</a>
          </div>

          <div id="signin-btn">
            <button type="submit">Register</button>
          </div>

      
        <div>
          <div id="have-account">Already have an Account?
            <a href="<?php echo base_url.'login.php' ?>">Login here</a>
          </div>
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
      function allowOnlyLetters(event) {
        // Check if the key pressed is a letter
        if (event.key.match(/[A-Za-z]/)) {
            return true;  // Allow the key press
        } else {
            return false; // Prevent the key press
        }
    }
  $(document).ready(function(){

 
    end_loader();
    $('.pass_type').click(function(){
      var type = $(this).attr('data-type')
      if(type == 'password'){
        $(this).attr('data-type','text')
        $(this).closest('.input-group').find('input').attr('type',"text")
        $(this).removeClass("fa-eye-slash")
        $(this).addClass("fa-eye")
      }else{
        $(this).attr('data-type','password')
        $(this).closest('.input-group').find('input').attr('type',"password")
        $(this).removeClass("fa-eye")
        $(this).addClass("fa-eye-slash")
      }
    })
    $('#register-frm').submit(function(e){
      e.preventDefault()
      var _this = $(this)
      $('.err-msg').remove();
      var el = $('<div>')
      el.hide()
      if($('#password').val() != $('#cpassword').val()){
        el.addClass('alert alert-danger err-msg').text('Password does not match.');
        _this.prepend(el)
        el.show('slow')
        return false;
      }
      var password = $('#password').val();

        // Check if the password length is greater than 8
        if (password.length <= 8) {
          el.addClass('alert alert-danger err-msg').text('Password must be at least 8 characters long.');
          _this.prepend(el);
          el.show('fast');
          return false;
        }

        if (!/[^a-zA-Z\s]/.test(firstname)&&!/[^a-zA-Z\s]/.test(lastname)) {
        el.addClass('alert alert-danger err-msg').text('Letters only.');
        _this.prepend(el);
        el.show('fast');
        return false;
        }
      start_loader();
      $.ajax({
        url:_base_url_+"classes/Users.php?f=save_client",
        data: new FormData($(this)[0]),
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        type: 'POST',
        dataType: 'json',
        error:err=>{
          console.log(err)
          alert_toast("An error occurred",'error');
          end_loader();
        },
        success:function(resp){
          if(typeof resp =='object' && resp.status == 'success'){
            var emailInput = $("#email").val(); // Get the email input value
            location.href = "./login.php?email=" + encodeURIComponent(emailInput);
          } else if(resp.status == 'failed' && !!resp.msg){   
            el.addClass("alert alert-danger err-msg").text(resp.msg)
            _this.prepend(el)
            el.show('slow')
          } else {
            alert_toast("An error occurred",'error');
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