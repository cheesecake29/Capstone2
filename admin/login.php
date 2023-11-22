<?php require_once('../config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<?php require_once('inc/header.php'); ?>
<link rel="stylesheet" href="loginstyle.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<!-- Montserrat Font (800 weight) -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap">

<!-- Julius Sans One Font -->
<link href="https://fonts.googleapis.com/css2?family=Julius+Sans+One&display=swap" rel="stylesheet">

<!-- Montserrat Font (800 weight) and Poppins Font (200 weight) -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Poppins:wght@200;200&display=swap">

<style>
  /* Add the CSS styles for the design here */
  body {
    margin: 0;
    padding: 0;
    border: 0;
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

  label {
    font-weight: normal;
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

  #login-frm {
    display: flex;
    justify-content: center;
    flex-direction: column;
    width: 100%;
    align-items: center;
    margin-top: 12%
  }

  .input-group {
    width: 75%;
    margin-top: 6%;
  }

  .input-group input[type="text"],
  .input-group input[type="password"] {
    padding: 2%;
    border: solid 1px #609AC4;
    border-radius: 5px 5px 5px 5px;
    width: 100%;
    height: 40px;
  }



  .input-group-text {
    background-color: #609AC4;
    color: white;
    border: solid 1px #609AC4;


  }

  .Signin-btn button {
    display: flex;
    align-items: center;
    justify-content: center;

    margin-top: 100%;
    background-color: #B6DFF4;
    width: 100%;
    color: black;
    font-size: 15px;

    border-radius: 20px;
    cursor: pointer;
    border: none;

  }
</style>

<body>
  <script>
    start_loader();
  </script>

  <?php $page = isset($_GET['page']) ? $_GET['page'] : 'home'; ?>
  <?php if ($_settings->chk_flashdata('success')) : ?>
    <script>
      alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success');
    </script>
  <?php endif; ?>

  <div class="login-container">
    <div class="left-login">
      <h1>ADMIN LOGIN PAGE</h1>

      <form id="login-frm" action="" method="post">
        <div class="input-group">
          <label class="label" for="username">Username</label>
          <input type="text" class="form-control" name="username" autofocus placeholder="Username">

        </div>
        <div class="input-group">
          <label class="label" for="password">Password</label>
          <input type="password" class="form-control" name="password" placeholder="Password">

        </div>


        <div class="Signin-btn">
          <button type="submit" class="signin-btn">Log in</button>
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
    $(document).ready(function() {
      end_loader();
    });
  </script>
</body>

</html>