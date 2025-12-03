<?php
include 'config.php';

// SAVE userid BEFORE deleting cookie
// $userid = $_COOKIE['dr_userid'];
$userid = $rowselect['userid']; 

// UPDATE LOGOUT TIME & SESSION DURATION
mysqli_query($con, "
    UPDATE user_logs 
    SET logout_time = NOW(),
        session_seconds = TIMESTAMPDIFF(SECOND, login_time, NOW())
    WHERE userid = '$userid'
    ORDER BY id DESC
    LIMIT 1
");

// UPDATE ONLINE STATUS
mysqli_query($con, "UPDATE registration SET online='no' WHERE userid='$userid'");

// NOW clear the cookie
setcookie('dr_userid', '', time() - 3600);

// REDIRECT
header('location:logout-final.php');
?>
