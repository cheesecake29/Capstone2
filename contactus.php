<?php
include 'sendemail.php';



?>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="contact.css">
  <script src="https://kit.fontawesome.com/8714a42433.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
</head>
<style>
  /*--------------------------------------Contact-Us-Layout-----------------------------------------------------*/


  .contact-info {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    justify-content: space-around;
    align-items: stretch;
    padding: 1%;
  }

  .contact-info h1 {
    font-size: 24px;
  }



  .Address p {
    font-size: 11px;
  }

  .contact-h1 {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    flex-direction: column;
    text-align: center;
    color: #fff;
    background-color: #004399;
    height: 40px;
    width: 100%;
    height: 300px;
  }


  .contact-h1 h1 {
    margin-top: 3%;
  }

  .contact-h1 p {
    margin-top: 1%;
  }

  .contact-info>div {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.619);

    margin: 40px;
    margin-top: -150px;
    border-radius: 10px;
    background-color: rgb(255, 255, 255);
  }

  .contact-info>div img {
    max-width: 100%;
    height: auto;
  }

  .contact-info h1,
  .contact-info p {
    margin: 5px 0;
  }

  .connect-with-us {
    position: fixed;
    bottom: 0;
    left: 0;
  }

  .messenger-icon {
    display: flex;
    align-items: center;



    padding: 10px;
    /* Adjust padding as needed */
    border-radius: 10px;
    /* Add border-radius for rounded corners */
  }

  .messenger-icon i {
    color: #EF4A98;
    /* Add some spacing between the icon and the background */
    font-size: 54px;

    margin: 10%;
  }

  .contact-section {
    display: flex;
    flex-direction: row;

    justify-content: center;
    align-items: center;

  }

  .contact {
    display: flex;
    flex-direction: column;
    padding: 4%;
  }

  .connect-with-us a {
    margin-top: 1%;
    margin-bottom: 1%;
    color: #004399;
    font-size: 24px;
  }

  .contact-section {
    display: flex;
    flex-direction: row;

    justify-content: center;
    align-items: center;

  }



  .contact-form {

    width: 50%;
    margin: 5%;
    border: none;
    background-color: white;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.619);
  }



  .text-box,
  textarea {
    border-radius: 25px;
    padding: 2%;
    border: none;
    background-color: #D4EEFA;
    margin: 2% 0;
  }

  .send-btn {
    background-color: #004399;
    color: white;
    border-radius: 25px;
    padding: 2%;
    border: none;
  }

  /*-------------------------------------End-Contact-Us-Layout-----------------------------------------------------*/
</style>

<body class="Contactus">

  <!--END-OF-HEADER--------------------------------------------------------------------------------->

  <!--Contact--------------------------------------------------------------------------------------->
  <div class="contact-container">
    <div class="contact-h1">
      <h1>Contact us</h1>
      <p>Reach out to us through our provided phone number, address, and email for direct communication with our shop.</p>
    </div>

    <div class="contact-info">

      <div class="Phone">
        <img src="images/phone.png" alt="Phone">
        <h1>Phone</h1>
        <?php echo $_settings->info('phonenumber') ?>
      </div>

      <div class="Address">
        <img src="images/address.png" alt="Address">
        <h1>Address</h1>
        <?php echo $_settings->info('address') ?>
      </div>

      <div class="Email">
        <img src="images/email.png" alt="Email">
        <h1>Email</h1>
        <?php echo $_settings->info('email') ?>
      </div>


    </div>


    <?php if (!empty($alert)) : ?>
      <div class="alert"><?php echo $alert; ?></div>
    <?php endif; ?>
    <div class="connect-with-us">
      <a href="<?php echo $_settings->info('link') ?>" class="messenger-icon">
        <i class="fab fa-facebook-messenger"></i>
      </a>
    </div>

  </div>

 <div class="contact-section">

    
    <div class="contact-form">
      
        <form class="contact" action="" method="post">
            <input type="varchar" id="name" name="name" class="text-box" placeholder="Your Name" ronkeydown="return allowOnlyLetters(event)" required>
            <input type="email" id="email" name="email" class="text-box" placeholder="Your Email" required>
            <textarea type="text" name="message" id="message" rows="5" placeholder="Message" required></textarea>
            <input type="submit" name="submit" class="send-btn" value="Send">

        </form>
    </div>
   
</div>


  <script type="text/javascript">
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>


</body>

<script>
  function allowOnlyLetters(event) {
    // Check if the key pressed is a letter
    if (event.key.match(/[A-Za-z]/)) {
      return true; // Allow the key press
    } else {
      return false; // Prevent the key press
    }
  }
</script>