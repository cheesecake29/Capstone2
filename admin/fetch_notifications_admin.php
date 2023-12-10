<?php
require_once('./../config.php');

$sql = "SELECT * FROM notifications WHERE `type` = 2 ORDER BY is_read ASC, id DESC";
$result = $conn->query($sql);

$sql2 = "SELECT COUNT(*) AS count FROM notifications WHERE `type` = 2 AND `description` LIKE '%has placed an order%' AND is_read = 0";
$result2 = $conn->query($sql2);

$has_placed_order = false;

if ($result2) {
    $row = $result2->fetch_assoc();
    $has_placed_order = ($row['count'] > 0); // Returns true if there are notifications matching the criteria
} else {
    // Handle query error
    $has_placed_order = false; // If an error occurred, set to false or handle it as needed
}

echo '<input type="hidden" data-id="hasOrder" id="hasOrder" value="'.$has_placed_order.'" />';


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
        echo '<audio id="audio_' . $notification_id . '" src="../assets/notif_sound.wav"></audio>';
    }

    echo '</div>';
    echo '<div class="m-2"><button class=" btn btn-sm btn-primary notifAll">Mark All Read</button></div>';
    echo '</ul>';
} else {
    echo 'No notifications available.';
}

?>
<script>
    function fetchNotificationCount(){
        $.ajax({
            url: 'fetch_notification_count_admin.php',
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
            console.log("CLICK admin");
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

    $(document).ready(function() {
        $('.notifAll').on('click', function(e) {
            console.log("CLICK admin");
            e.preventDefault();
            $.ajax({
                url: _base_url_ + 'mark_all_as_readClient.php',
                method: 'POST',
                data: { type: 2 },
                success: function(response) {
                    if (response && response.message !== undefined) {
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
                    } else {
                        console.warn("Success response does not contain a 'message' property:", response);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
</script>