
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Website Title</title>
    <!-- Add your other meta tags, stylesheets, and scripts here -->
    <script src="https://kit.fontawesome.com/8714a42433.js" crossorigin="anonymous"></script>

    
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Julius+Sans+One&family=Montserrat:wght@800&family=Poppins:wght@200;200&display=swap">
</head>

<style>
    /* Reset default margin and padding for all elements */
    *, *::before, *::after {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    
}

body {
   width: ; font-family: 'Montserrat', sans-serif;
    font-weight: 450;
    line-height: 1.6;
}

a {
    text-decoration: none;
    color: #1A547E;
}

.Homepage {
    background-image: url(bg12.png);
    background-size: cover;
    height: 200px;
    max-width: 100%;
    max-height: 100%;
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: center;
}

.index-header-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 2.5%;
    background-color: #FFFFFF;
}

.nav {
    list-style: none;
    display: flex;
    align-items: center;
    margin-right: auto;
}

.nav li {
    margin: 0 10px;
    position: relative;
  
}

.nav-link {
    display: block;
    padding: 10px 5px ;
    color: #1A547E;
    font-size: 14px;
    position: relative; /* Create a positioning context for pseudo-element */
}

.nav-link.active,
.nav-link:hover {
   
    color: #004399;
}

/* Underline hover effect for "nav" items with the "nav-item" class */
.nav-link.nav-item:after {
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    width: 0;
    height: 2px;
    background-color: #3002ff;
    transform: scaleX(0);
    transition: 0.3s ease-in;
}

.nav-link.nav-item:hover:after {
    width: 100%;
    transform: scaleX(1);
}

.nav-link.nav-item.active:after {
    width: 100%;
    transform: scaleX(1);
}


.search-cart {
    display: flex;
    align-items: center;
}

.fas {
    padding: 10px;
    color: #004399;
    cursor: pointer;
}

.user-btn {
    background-color: #004399;
    border-radius: 20px;
    padding: 8px 20px;
    margin: 8px;
    color: #fff;
    cursor: pointer;
    box-shadow: 0 0 5px rgba(104, 164, 228, 0.6);
    font-size: 14px;
}

.home-container {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    margin: 7%;
}

.home-container h1 {
    font-size: 60px;
    color: #004399;
}

.home-container p {
    margin-top: 15px;
    font-size: 16px;
    color: #427EA9;
}

.shop-now {
    width: 10%;
    cursor: pointer;
    background-color: #004399;
    border-radius: 20px;
    box-shadow: 0 3px 10px rgba(3, 3, 3, 0.6);
    padding: 10px;
    margin-top: 70px;
    text-align: center;
}

.shop-now a {
    display: block;
    color: #FFFFFF;
    font-size: 16px;
    text-decoration: none;
}

.shop-now:hover {
    border: solid 1px #004399;
    background-color: #FFFFFF;
    transition: background-color 500ms linear;
}

.navbar-nav{
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
   
}




.shop-now:hover a {
    color: #004399;
}

/* START: NOTIFICATIONS */
.dropdown {
    display:inline-block;
    margin-left:20px;
    padding:10px;
  }

.notifications {
   min-width:300px; 
  }
  
  .notifications-wrapper {
     overflow:auto;
      max-height:250px;
    }
    
 .menu-title {
     color:#ff7788;
     font-size: 1.0rem;
        display:inline-block;
      }
 
.notif-circle-arrow-right {
      margin-left:10px;     
   }
  
   
 .notification-heading, .notification-footer  {
 	padding:2px 10px;
       }
      
        
.dropdown-menu.divider {
  margin:5px 0;          
  }

.item-title {
  
 font-size: 0.8rem;
 color:#000;
    
}

.notifications a.content {
 text-decoration:none;
 background:#ccc;

 }
    
.notification-item {
 padding:10px;
 margin:5px;
 background:#ccc;
 border-radius:4px;
 }

 .notification-count {
    width: 30px;
    height: 30px;
    padding: 15.2px 7.8px;
    font-size: 27px;
    border-radius: 26px;
    transform: perspective(0px) translate(-12px) rotate(0deg) scale(0.50);
    transform-origin: top;
    padding-right: 0;
    padding-top: 0.2px;
    padding-left: 0.2px;
    text-align: center;
    border-width: 48px;
 }
 /* END: NOTIFICATIONS */
</style>
<body>
    <nav id="topNavBar">
        <div class="index-header-container">
            <a class="navbar-brand" href="./">
                <img src="<?php echo validate_image($_settings->info('logo')) ?>" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
                <?php echo $_settings->info('sys_shortname') ?>
            </a>

           <!--  <button id="navbarToggler">
                <span class="navbar-toggler-icon"></span>
            </button>-->

            <div id="navbarSupportedContent">
            <ul class="nav">
                        <li><a class="nav-link nav-item <?= isset($page) && $page == 'home'? "active" : '' ?>" aria-current="page" href="./">Home</a></li>
                        <li><a class="nav-link nav-item <?= isset($page) && $page == 'products'? "active" : '' ?>" href="./?p=products">Products</a></li>
                        <li><a class="nav-link nav-item <?= isset($page) && $page == 'services'? "active" : '' ?>" href="./?p=services">Services</a></li>
                        <li><a class="nav-link nav-item <?= isset($page) && $page == 'contactus'? "active" : '' ?>" href="./?p=contactus">Contact us</a></li>
                        <li><a class="nav-link nav-item <?= isset($page) && $page == 'about'? "active" : '' ?>" href="./?p=about">About Us</a></li>
                    </ul>

                <div class="search-cart">
                    <!-- Search form -->
                </div>
            </div>
            <div>
                <?php if($_settings->userdata('id') > 0 && $_settings->userdata('login_type') == 2): ?>
                    
                    <?php 
                            $cart_count = $conn->query("SELECT SUM(quantity) from cart_list where client_id = '{$_settings->userdata('id')}'")->fetch_array()[0];
                            $cart_count = $cart_count > 0 ? number_format($cart_count) : 0;
                            ?>
                    <div class="right-top d-flex align-items-end">
                        <!-- Cart and user dropdown -->
                       
                       <div class="navbar-nav">
                        <div class="dropdown">
                            <?php
                                echo '<a id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="/page.html">';
                                echo '<i class="fas fa-bell"></i>';

                                $countQuery = "SELECT COUNT(id) AS notificationCount FROM notifications WHERE `type` = 1";
                                $result = $conn->query($countQuery);

                                if ($result) {
                                    $row = $result->fetch_assoc();
                                    $notificationCount = $row['notificationCount'];

                                    echo '<span class="badge bg-danger notification-count">' . $notificationCount . '</span>';
                                } else {
                                    // Handle the case where the query failed
                                    echo '<span class="badge bg-danger notification-count">Error</span>';
                                }

                                echo '</a>';

                                $sql = "SELECT * FROM notifications WHERE `type` = 1";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    echo '<ul class="dropdown-menu notifications" role="menu" aria-labelledby="dLabel">';
                                    echo '<div class="notification-heading"><span class="menu-title">Notifications</span></div>';
                                    echo '<li class="divider"></li>';
                                    echo '<div class="notifications-wrapper">';

                                    while ($row = $result->fetch_assoc()) {
                                        echo '<a class="content" href="#">';
                                        echo '<div class="notification-item">';
                                        echo '<h4 class="item-title">' . $row['description'] . '</h4>';
                                        // echo '<p class="item-info">' . $row['description'] . '</p>';
                                        echo '</div>';
                                        echo '</a>';
                                    }

                                    echo '</div>';
                                    echo '</ul>';
                                } else {
                                    echo 'No notifications available.';
                                }
                            ?>
                                
                                <ul class="dropdown-menu notifications" role="menu" aria-labelledby="dLabel">
                                    <div class="notification-heading">
                                        <span class="menu-title">Notifications</span>
                                    </div>
                                    <li class="divider"></li>
                                    <div class="notifications-wrapper">
                                        <a class="content" href="#">
                                        <div class="notification-item">
                                            <h4 class="item-title">Your order is confirmed.</h4>
                                            <p class="item-info">Sample text</p>
                                        </div>
                                        
                                        </a>
                                        <a class="content" href="#">
                                        <div class="notification-item">
                                            <h4 class="item-title">Your order is confirmed.</h4>
                                            <p class="item-info">Sample text</p>
                                        </div>
                                        </a>
                                        <a class="content" href="#">
                                        <div class="notification-item">
                                            <h4 class="item-title">Your order is on the way.</h4>
                                            <p class="item-info">Sample text</p>
                                        </div>
                                        </a>
                                    </div>
                                </ul>
                            </div>
                        <div class="nav-item">
                            <a href="./?p=cart" class="nav-link">
                                <i class="fas fa-shopping-cart"></i> 
                                <span
                                    class="badge bg-danger"
                                    style="width: 30px;
                                    height: 30px;
                                    padding: 15.2px 7.8px;
                                    font-size: 27px;
                                    border-radius: 26px;
                                    transform: perspective(0px) translate(-12px) rotate(0deg) scale(0.50);
                                    transform-origin: top;
                                    padding-right: 0;
                                    padding-top: 0.2px;
                                    padding-left: 0.2px;
                                    text-align: center;
                                    border-width: 48px;
                                    "><?= $cart_count ?></span>
                            </a>
                        </div>
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user"></i> Welcome, <?= $_settings->userdata('firstname') ?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                          <a class="dropdown-item" href="./?p=my_orders">My Orders</a>
                          <a class="dropdown-item" href="./?p=my_services">My Service Requests</a>
                          <a class="dropdown-item" href="./?p=manage_account">Manage Account</a>
                          <a class="dropdown-item" href="./classes/Login.php?f=logout_client">Logout</a>
                        </div>
                        </div>
                    </div>


                <?php else: ?>
                    <a href="./login.php" class="text-light text-decoration-none mx-2 user-btn"><b>Login</b></a> 
                    <a href="./register.php" class="text-light text-decoration-none mx-2 user-btn"><b>Register</b></a> 
                   
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Your content goes here -->

    <!-- Include any necessary scripts at the end of the body -->

