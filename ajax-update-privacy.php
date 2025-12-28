<?php
include 'config.php';

$userid = $_COOKIE['dr_userid'];

if(isset($_POST['action']) && $userid != '') {
    
    $action = $_POST['action'];
    
    if($action == 'set_privacy_show') {
        // User chose to Keep "Show to All"
        // Privacy remains default, set first_login to 0
        $sql = "UPDATE registration SET contact_privacy = 'Show to All', first_login = 0 WHERE userid = '$userid'";
        if(mysqli_query($con, $sql)) {
            echo "success";
        } else {
            echo "error";
        }
    }
    
    if($action == 'set_privacy_hide') {
        // User chose "Hide from All"
        // Update privacy AND set first_login to 0
        $sql = "UPDATE registration SET contact_privacy = 'Hide from All', first_login = 0 WHERE userid = '$userid'";
        if(mysqli_query($con, $sql)) {
            echo "success";
        } else {
            echo "error";
        }
    }
    if($action == 'wa_privacy_all') {
        $sql = "UPDATE registration SET whatsapp_privacy = 'all_members' WHERE userid = '$userid'";
        if(mysqli_query($con, $sql)) { echo "success"; } else { echo "error"; }
    }

    if($action == 'wa_privacy_hide') {
        $sql = "UPDATE registration SET whatsapp_privacy = 'hide' WHERE userid = '$userid'";
        if(mysqli_query($con, $sql)) { echo "success"; } else { echo "error"; }
    }
}
?>