<?php
include 'config.php';

if(isset($_POST['popup_type']) && isset($_POST['user_id'])) {
    $popup_id = $_POST['popup_type'];
    $userid = $_POST['user_id'];
    
    // Status 4: Verification Done
    if($popup_id == 'status_4') {
        mysqli_query($con, "UPDATE `registration` SET `verification_popup`='1' WHERE `userid`='$userid'");
    }
    // Status 1: Not Screened
    if($popup_id == 'status_1') {
        mysqli_query($con, "UPDATE `registration` SET `profilestatus_popup`='1' WHERE `userid`='$userid'");
    }
    // Status 2: Screening Complete
    if($popup_id == 'status_2') {
        mysqli_query($con, "UPDATE `registration` SET `profilestatus_popup`='1' WHERE `userid`='$userid'");
    }
    // Status 3: Verification Pending
    if($popup_id == 'status_3') {
        mysqli_query($con, "UPDATE `registration` SET `verification_popup`='1' WHERE `userid`='$userid'");
    }
}
?>