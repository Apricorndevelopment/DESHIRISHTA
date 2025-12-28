<?php
include 'config.php';

if(isset($_POST['popup_type']) && isset($_POST['user_id'])) {
    $popup_id = $_POST['popup_type'];
    $userid = $_POST['user_id'];
    
    // Status 4: Verification Done (Isme conflict nahi hai, ise 1 rehne dein)
    if($popup_id == 'status_4') {
        mysqli_query($con, "UPDATE `registration` SET `verification_popup`='1' WHERE `userid`='$userid'");
    }
    
    // Status 1: Not Screened (FIX: Change '1' to '2')
    // Isse header.php ka loop nahi chalega
    if($popup_id == 'status_1') {
        mysqli_query($con, "UPDATE `registration` SET `profilestatus_popup`='2' WHERE `userid`='$userid'");
    }
    
    // Status 2: Screening Complete (FIX: Change '1' to '2')
    if($popup_id == 'status_2') {
        mysqli_query($con, "UPDATE `registration` SET `profilestatus_popup`='2' WHERE `userid`='$userid'");
    }
    
    // Status 3: Verification Pending (Isme conflict nahi hai)
    if($popup_id == 'status_3') {
        mysqli_query($con, "UPDATE `registration` SET `verification_popup`='1' WHERE `userid`='$userid'");
    }
}
?>