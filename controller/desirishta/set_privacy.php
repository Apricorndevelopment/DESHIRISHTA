<?php
include 'config.php';

$userid = $_COOKIE['dr_userid'];

if(isset($_POST['action']) && $userid != '') {

    if($_POST['action'] == 'set_privacy_show') {
        $sql = "UPDATE registration SET contact_privacy = 'Show to All', first_login = 0 WHERE userid = '$userid'";
    }

    if($_POST['action'] == 'set_privacy_hide') {
        $sql = "UPDATE registration SET contact_privacy = 'Hide from All', first_login = 0 WHERE userid = '$userid'";
    }

    if(mysqli_query($con, $sql)) {
        echo "success";
    } else {
        echo "error";
    }
}
?>
