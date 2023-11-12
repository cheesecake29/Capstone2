
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css">
        <script src="https://kit.fontawesome.com/8714a42433.js" crossorigin="anonymous"></script>
    </head>
    <style>
    /*--------------------------------------Contact-Us-Layout-----------------------------------------------------*/


.contact-info {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    justify-content: space-around;
    align-items: stretch; 
    padding:1%;
  }

  .contact-info h1{
    font-size: 24px;
  }

 

  .Address p {
    font-size: 11px;
  }

  .contact-h1{
    display: flex;
    justify-content:  flex-start;
    align-items: center;
    flex-direction: column;
    text-align: center;
    color: #fff;
    background-color: #004399;
    height: 40px;
    width: 100%;
    height:300px;
  }


  .contact-h1 h1{
    margin-top: 3%;
  }

  .contact-h1 p{
    margin-top: 1%;
  }
  
  .contact-info > div {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.619);
    
    margin:  40px;
    margin-top:  -150px;
    border-radius:  10px;
    background-color: rgb(255, 255, 255);
  }
  
  .contact-info > div img {
    max-width: 100%;
    height: auto;
  }
  
  .contact-info h1,
  .contact-info p {
    margin: 5px 0;
  }
  
  .connect-with-us{
    display: flex;
    flex-direction:column;
    justify-content: center;
    align-items: center;
    
    
    
    
    
    
  }

  .connect-with-us > h2{
    margin-top: 1%;
  }

  .connect-with-us a{
    margin-top: 1%;
    margin-bottom: 1%;
    color: #004399;
    font-size: 24px;
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
        <div class="connect-with-us">
       <h2>Connect with us!</h2>

       <a href=" <?php echo $_settings->info('link') ?>"><i class="fab fa-facebook"><?php echo $_settings->info('link') ?> </i></a>
      
    </div>

</body>


    