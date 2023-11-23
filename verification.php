<?php 
require_once('./config.php');

  // Validate and sanitize the input
  function validateInput($input) {
    // Implement your validation logic here if needed
    return htmlspecialchars(trim($input));
}

  // Extract the token from the URL
  $token = validateInput($_GET['token']);

  // Create a new PDO instance
  $pdo = new PDO("mysql:host=localhost;dbname=capstone_two_db", "root", "");
  $query = $pdo->prepare("UPDATE client_list SET status = 1 WHERE verification_code = :token");
  $query->bindParam(':token', $token);
  $query->execute();
?>

<!DOCTYPE html>
<html lang="en">
<?php require_once('inc/header.php');  ?>

<!-- Montserrat Font (800 weight) -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&display=swap">

<!-- Julius Sans One Font -->
<link href="https://fonts.googleapis.com/css2?family=Julius+Sans+One&display=swap" rel="stylesheet">

<!-- Montserrat Font (800 weight) and Poppins Font (200 weight) -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&family=Poppins:wght@200;200&display=swap">
<link rel="stylesheet" href="./css/login.css">
<style>
.login-textfield-container {
    width: 100%;
    max-width: 600px;
    margin: 0 auto;
}
.left-login {
    text-align: center;
    align-items: center;
}
#login-btn a{
  margin-top: 8%;
    background-color: #b6dff4;
    width: 30%;
    color: black;
    font-size: 15px;
    padding: 1%;
    border-radius: 20px;
    cursor: pointer;
    border: none;
    text-decoration:none;
}
</style>
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
      <h1>Your Email is Already verified you can login now.</h1>
      <div id="login-btn">
        <a class="btn-success" href="<?php echo base_url . 'login.php' ?>">Login Now</a>
      </div>
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