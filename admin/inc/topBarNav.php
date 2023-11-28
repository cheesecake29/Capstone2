<style>
  .user-img{
        position: absolute;
        height: 27px;
        width: 27px;
        object-fit: cover;
        left: -7%;
        top: -12%;
  }
  .btn-rounded{
        border-radius: 50px;
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
<!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-light text-sm shadow">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="<?php echo base_url ?>" class="nav-link"><?php echo (!isMobileDevice()) ? $_settings->info('sysname'):$_settings->info('sys_shortname'); ?> - Admin</a>
          </li>
        </ul>
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto align-items-center">
          <li class="notif dropdown">
          <?php
              echo '<a id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="/page.html">';
              echo '<i class="fas fa-bell"></i>';

              $countQuery = "SELECT COUNT(id) AS order_list FROM notifications WHERE `type` = 2";
              $result = $conn->query($countQuery);

              if ($result === false) {
                  // Handle the case where the query failed
                  echo '<span class="badge bg-danger notification-count">Error: ' . $conn->error . '</span>';
              } else {
                  $row = $result->fetch_assoc();

                  if ($row === null) {
                      // Handle the case where no rows were found (if it's not an error in your logic)
                      echo '<span class="badge bg-danger notification-count">No data found</span>';
                  } else {
                      $notificationCount = $row['order_list'];
                      echo '<span class="badge bg-danger notification-count">' . $notificationCount . '</span>';
                  }
              }

              echo '</a>';
                        
                        $sql = "SELECT * FROM notifications WHERE `type` = 2 ORDER BY id DESC";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            echo '<ul class="dropdown-menu notifications" role="menu" aria-labelledby="dLabel">';
                            echo '<div class="notification-heading"><span class="menu-title">Notifications</span></div>';
                            echo '<li class="divider"></li>';
                            echo '<div class="notifications-wrapper">';

                            while ($row = $result->fetch_assoc()) {
                                echo '<a class="content" href="./?page=orders/view_order&id='. $row['order_id'] . '">';
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
          </li>
          <!-- Navbar Search -->
          <!-- <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
              <form class="form-inline">
                <div class="input-group input-group-sm">
                  <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                  <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                    </button>
                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </li> -->
          <!-- Messages Dropdown Menu -->
          <li class="nav-item">
            <div class="btn-group nav-link">
                  <button type="button" class="btn btn-rounded badge badge-light dropdown-toggle dropdown-icon" data-toggle="dropdown">
                    <span><img src="<?php echo validate_image($_settings->userdata('avatar')) ?>" class="img-circle elevation-2 user-img" alt="User Image"></span>
                    <span class="ml-3"><?php echo ucwords($_settings->userdata('firstname').' '.$_settings->userdata('lastname')) ?></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <div class="dropdown-menu" role="menu">
                    <a class="dropdown-item" href="<?php echo base_url.'admin/?page=user' ?>"><span class="fa fa-user"></span> My Account</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo base_url.'/classes/Login.php?f=logout' ?>"><span class="fas fa-sign-out-alt"></span> Logout</a>
                  </div>
              </div>
          </li>
          <li class="nav-item">
            
          </li>
         <!--  <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
            </a>
          </li> -->
        </ul>
      </nav>
      <!-- /.navbar -->