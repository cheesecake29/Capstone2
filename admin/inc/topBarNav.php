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
        text-decoration: none;
        background: #ccc;

    }

    .notification-item {
        padding: 10px;
       
        background: #F4F5FA;
        border-radius: 4px;
    }

    .unread-notification {
        padding: 10px;
       
        background: #F4F5FA;
        border-radius: 4px;
    }

    .read-notification {
        padding: 10px;
       
        background: #ffff;
        border-radius: 4px;
    }

    .notification-item:hover {
      
        background: #ffff;
       
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
              echo '<a id="dLabel" role="button" data-toggle="dropdown" data-target="#">';
              echo '<i class="fas fa-bell"></i>';

              $countQuery = "SELECT COUNT(id) AS order_list FROM notifications WHERE `type` = 2 AND `is_read` = 0" ;
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
                      echo '<input id="notifcount" value="'. $notificationCount .'" type="hidden">';
                      echo '<span class="badge bg-danger notification-count">' . $notificationCount . '</span>';
                  }
              }

              echo '</a>';

              echo '<div id="notif-container">';
                        
                    $sql = "SELECT * FROM notifications WHERE `type` = 2 ORDER BY is_read ASC, id DESC";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        echo '<ul class="dropdown-menu notifications" role="menu" aria-labelledby="dLabel">';
                        echo '<div class="notification-heading"><span class="menu-title">Notifications</span></div>';
                        echo '<li class="divider"></li>';
                        echo '<div class="notifications-wrapper">';

                        while ($row = $result->fetch_assoc()) {
                            $notification_id = $row['id'];
                            $is_read = $row['is_read'];

                            $notificationClass = ($is_read == 0) ? 'unread-notification' : 'read-notification';

                            echo '<a class="content notification" href="./?page=orders/view_order&id='. $row['order_id'] . '"
                              id="notification_' . $notification_id . '" data-notification-id="'.$notification_id.'">';
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

                        
                echo '</div>';

                        ?>
          </li>
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
<script>
    let previousCount = 0;

    function fetchNotifications(){
        $.ajax({
            url: 'fetch_notifications_admin.php',
            method: 'GET',
            dataType: 'html',
            success: function(response) {
                fetchNotificationCount();
                previousCount = $('#notifcount').val();
                $('#notif-container').html(response);
            },
            error: function(xhr, status, error) {
            console.error(error);
            }
        });

    }

    function fetchNotificationCount(){
        var notificationID = $('.notification').data('notification-id');
        $.ajax({
            url: 'fetch_notification_count_admin.php',
            method: 'GET',
            success: function(response) {
            const newCount = parseInt(response);
            console.log("new Count: ", newCount);
            console.log("previousCount: ", previousCount);
            if (newCount > previousCount) {
                var audio = document.getElementById('audio_' + notificationID);
                audio.play();
                console.log("played Audio: ");

            }
            $('#notifcount').val(response);
            $('.notification-count').html(response);
            },
            error: function(xhr, status, error) {
            console.error(error);
            }
        });
    }
    $(document).ready(function() {
        $('#dLabel').on('click', function(e) {
            $('.notifications').toggleClass('show');

            if ($('.notifications').hasClass('show')) {
                $('.notifications').css({
                'left': '0px',
                'right': 'inherit'
                });
            } else {
                $('.notifications').css({
                'left': '',
                'right': ''
                });
            }
        });
        fetchNotifications();

        setInterval(fetchNotifications, 15000);
        setInterval(fetchNotificationCount, 15000);
    });
</script>