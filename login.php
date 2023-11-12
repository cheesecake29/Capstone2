<?php  require_once('./config.php');  ?>
<!DOCTYPE html>
<html lang="en">
<?php   require_once('inc/header.php');  ?> 

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Julius+Sans+One&family=Montserrat:wght@800&family=Poppins:wght@200;200&display=swap">

  <!-- Montserrat Font (800 weight) -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&display=swap">
    
    <!-- Julius Sans One Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Julius+Sans+One&display=swap">
    
    <!-- Montserrat Font (800 weight) and Poppins Font (200 weight) -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&family=Poppins:wght@200;200&display=swap">

<style>
  body{
    margin: 0;
    padding: 0;
    border: none;
    outline: 0;
    list-style: none;
    text-decoration: none;
    font-family: 'Poppins', sans-serif;
    
    
}

.login-container {
  display: flex;
  flex-direction: row;
}

.left-login {
  background-color: #FFFFFF;
  width: 50%;
  height: 60vh;
 
}

.right-login {
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: #609AC4;
  width: 50%;
  height: 100vh;
}

.right-login img {
  max-width: 100%;
  max-height: 100%;
}

.left-login h1 {
  display: flex;
  justify-content: center;
  margin: 3%;
  margin-top: 8%;
  font-family: 'Julius Sans One', sans-serif;
  font-size: 40px;
  font-weight: 100;
}



#clogin-frm{
    display: flex;
    justify-content: center;
    flex-direction: column;
    width: 100%;
    align-items: center;   
   
   
    
}

.login-textfield-container {
    display: flex;
    
    flex-direction: column; 
    margin-top: 15%;  
    width: 75%;
  }
  
.login-textfield-container input {
    padding: 2%;
    border: solid 1px #609AC4; 
    border-radius: 3px;
    width: 100%;
    height: 20px;  

}

label{
    font-weight: normal;
}


.label-password-login {
  margin-top: 30px;
}

.back_to_shop a{
  text-align: left;
  font-size: 12px;
  text-decoration: none;
}

#login-btn,
#no-account{
    display: flex;
    align-items: center;
    justify-content: center;

}

#no-account a {
  text-decoration: none;
}
#login-btn button{
    
    margin-top: 8%;
    background-color: #B6DFF4;
    width: 30%;
    color: black;
    font-size: 15px;
    padding: 1%;
    border-radius: 20px;
    cursor: pointer;
    border: none;
   
}


#no-account {
  font-size: 12px;
  margin-top: 2%;
}

</style>
<body>
  <script>
    start_loader();
  </script>

<?php $page = isset($_GET['page']) ? $_GET['page'] : 'home';  ?>
    <?php if($_settings->chk_flashdata('success')): ?>
      <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
      </script>
    <?php endif;?>

  <div class="login-container">
    <div class="left-login">
      <h1>FIND YOUR PERFECT FIT</h1>
     
        <form id="clogin-frm" action="" method="post">
          <div class="login-textfield-container">

          <div class="text-field-login">
          <div class="input-area">
            <label class="label" for="email">Email</label>
            <input type="email" name="email" autofocus placeholder="Enter your email" required>
            </div>
          </div>

          <div class="text-field-login label-password-login">
          <div class="input-area">
            <label class="label" for="password">Password</label>
            <input type="password" name="password" placeholder="Enter your password" required>
            </div>
          </div>
          <div class="back_to_shop">
            <a href="<?php echo base_url ?>">Back to Shop</a>
          </div>
          <div id="login-btn">
            <button type="submit">Log in</button>
          </div>
          <div id="no-account">No account? 
            <a href="<?php echo base_url.'register.php' ?>"> Signup here.</a>
          </div>
          </div>
        </form>
     
    </div>
    <div class="right-login">
      <img src="<?= validate_image($_settings->info('logo')) ?>" alt="System Logo">
    </div>
  </div>
  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="dist/js/adminlte.min.js"></script>
  <script>
    $(document).ready(function () {
      end_loader();
    });
  </script>
</body>
</html>
