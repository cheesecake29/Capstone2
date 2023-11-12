<!DOCTYPE html>

<html>
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
        .service-info {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    justify-content: center;
    align-items: center; 
    margin: 0 auto ;
    margin-bottom: 200px; /* Add this line */
    width: 80%;
    
  }

  .service-info h1{
    font-size: 24px;
  }

  .service-h1{
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

  .service-h1 h1{
    margin-top: 3%;
  }

  .service-h1 p{
    margin:  1%;
  }

  .service-info > a {
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    text-align: center;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.619);
    margin:  40px;
    margin-top:  -130px;
    border-radius:  10px;
    background-color: rgb(255, 255, 255);
    color: black;
    
  }

  .service-info > a:hover{
    background: rgb(212, 225, 228);
    
   
  }

 

  .service-info > a img {
    max-width: 100%;
    height: auto;
  }

  .service-info h1 {
    margin: 5px 0;
  }

    </style>

    <body class="Services">
   
    <!--Start-of-Sevices-------------------------------------------------------------------------------->
    <div class="service-container">
        <div class="service-h1">
        <h1>Our Services</h1>
        <p>Our service page offers efficient delivery service and handles customer inquiries with ease.</p>
        </div> 

        <div class="service-info">
            <a href="#">
            <div class="delivery-services">
                <img src="images/delivery_services.png" alt="Phone">
                <h1>Delivery Services</h1>         
            </div>
        </a>
        <a href="#">
            <div class="customer-inquiries">
                
                <img src="images/customer_inquiries.png" alt="Address">
                <h1>Customer Inquiries</h1>
              
            </div>
        </a>
        

        </div>

    <!--End-of-Sevices--------------------------------------------------------------------------------> 
        
    </body>

    
</html>