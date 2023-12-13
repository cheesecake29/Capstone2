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
<<<<<<< Updated upstream
   body {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .service-info {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        margin: 100px auto;
        width: 50%;
        margin-bottom: 200px;
    }

    .service-info h1 {
        font-size: 24px;
        margin: 5px 0;
    }

    .service-h1 {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        text-align: center;
        color: #fff;
        background-color: #004399;
        height: 200px;
        width: 100%;
    }

    .service-h1 h1 {
        margin-top: 3%;
    }

    .service-h1 p {
        margin: 1%;
    }

    .service-info>a {
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        text-align: center;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.619);
        margin: 40px;
        margin-top: -130px;
        border-radius: 10px;
        background-color: rgb(255, 255, 255);
        color: black;
    }

    .service-info>a:hover {
        background: rgb(212, 225, 228);
    }

    .service-info>a img {
        max-width: 100%;
        height: auto;
    }
=======
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}


    .service-info {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
       
        width: 100%;
       
        
    }

    .service-info h1 {
        font-size: 24px;
        margin: 5px 0;
    }
    .service-h1 {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  text-align: center;
  color: #fff;
  height: 250px;
  width: 100%;
  background-size: cover;
  background-color: #004399; /* Set the background color to blue with 0.5 opacity */

}



    .service-h1 h1 {
        margin-top: 3%;
    }

    .service-h1 p {
        margin: 1%;
    }
    .service-info {
    position: relative; /* Make sure the container is positioned relative */
    width:100%;
    
}

.service-info::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    background-image: url('<?php echo base_url . $_settings->info('service_cover') ?>');
    background-repeat: repeat;
    background-size: cover;
    opacity: 0.1; /* Set the opacity of the background image layer */
    z-index: -2;
   margin: -15px 0 -27px -15px;
}



    .service_description p {
        text-align: center;
    }


    .service-info{
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
    }

   

 .service-img>img{
    width: 70% ;
    height: auto;
    
 }

    .service-info1,
    .service-img{
        width: 80%;
        margin: 5%;
    }
    @media (max-width: 791px) {
    .service-info {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        margin: 2%; /* Adjust the overall margin for service-info */
    }

    .service-info1  {
        width: 80%;
        height: 400px; /* Set a fixed height */
        
        margin: 1% 0; /* Adjust the margin for service-info1 and service-img */
        box-sizing: border-box; /* Include border in width and height */
    }

    .service-img {
       
        width: 80%;
        height: 600px; /* Set a fixed height */
        box-sizing: border-box; /* Include border in width and height */
    }

    .service-img > img {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Maintain aspect ratio and cover the container */
        display: block;
    }
}





>>>>>>> Stashed changes

    .service_description p {
        text-align: center;
    }
    </style>

    <body class="Services">
   
    <!--Start-of-Sevices-------------------------------------------------------------------------------->
    <div class="service-container">
        <div class="service-h1">
<<<<<<< Updated upstream
=======
       
>>>>>>> Stashed changes
        <h1> <?php echo $_settings->info('servicetitle') ?></h1>
        <p> <?php echo $_settings->info('servicep') ?></p>
        
        </div> 
      

        <div class="service-info">
           
<<<<<<< Updated upstream
            <div class="service-desc">
            <p><?php echo $_settings->info('service_description')  ?>  </p>
                   
            </div>
=======
            

                <div class="service-info1">

                    <h1> <?php echo $_settings->info('service_name') ?></h1>
                    <p><?php echo $_settings->info('service_description')  ?>  </p>
                </div>

                <div class="service-img">
                    <img src="<?php echo validate_image($_settings->info('service1')) ?>">    
                </div>

            
>>>>>>> Stashed changes

            

        </div>

        

    <!--End-of-Sevices--------------------------------------------------------------------------------> 
        
    </body>

    
</html>