<?php
require_once('./config.php');

    $sql = "SELECT * FROM notifications WHERE `type` = 1
        AND `client_id` = '{$_settings->userdata('id')}' ORDER BY is_read ASC, id DESC";
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

            echo '<a class="content notification" href="./?p=my_orders" id="notification_' . $notification_id . '" data-notification-id="'.$notification_id.'">';
            echo '<div class="notification-item ' . $notificationClass . '">';
            echo '<h6>Hello, ' .$_settings->userdata('firstname') . '</h6>';
            echo '<h4 class="item-title">' . $row['description'] . '</h4>';
            // echo '<p class="item-info">' . $row['description'] . '</p>';
            echo '</div>';
            echo '</a>';
            echo '<audio id="audio_' . $notification_id . '" src="./assets/notif_sound.wav"></audio>';
        }

        echo '</div>';
        echo '</ul>';
    } else {
        echo '<ul class="dropdown-menu notifications" role="menu" aria-labelledby="dLabel">';
        echo 'No notifications available.';
    }

?>
<script>
    function fetchNotificationCount(){
        $.ajax({
            url: 'fetch_notification_count.php', // Replace with your PHP file for fetching notifications
            method: 'GET',
            success: function(response) {
            console.log("data", response);
            $('.notification-count').html(response);
            },
            error: function(xhr, status, error) {
            console.error(error);
            }
        });
    }

    $(document).ready(function() {
        $('.notification').on('click', function(e) {
            console.log("CLICK dasds");
            e.preventDefault();

            var notificationID = $(this).data('notification-id');
            var $notificationItem = $(this).find('.notification-item');
            //var audio = document.getElementById('audio_' + notificationID);
            //audio.play();
            $.ajax({
                url: _base_url_ + 'mark_notification_as_read.php',
                method: 'POST',
                data: { notification_id: notificationID },
                success: function(response) {
                    fetchNotificationCount();
                    $notificationItem.css('background', '#ffff');
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
</script>