<?php
include 'config.php';
date_default_timezone_set('Asia/Kolkata');

$userid = $_COOKIE['dr_userid'];
$profileid = $_POST['profileid'];
$platform = $_POST['platform'];

$is_whatsapp = ($platform === 'whatsapp') ? 1 : 0;

// Check record exists or not
$chk = mysqli_query($con, "SELECT * FROM user_share_counts 
        WHERE userid='$userid' AND profileid='$profileid'");

if(mysqli_num_rows($chk) > 0) {

    if($is_whatsapp) {
        mysqli_query($con, "UPDATE user_share_counts 
            SET whatsapp_count = whatsapp_count + 1, last_updated = NOW()
            WHERE userid='$userid' AND profileid='$profileid'");
    } else {
        mysqli_query($con, "UPDATE user_share_counts 
            SET other_count = other_count + 1, last_updated = NOW()
            WHERE userid='$userid' AND profileid='$profileid'");
    }

} else {

    $wa = $is_whatsapp ? 1 : 0;
    $other = $is_whatsapp ? 0 : 1;

    mysqli_query($con, "INSERT INTO user_share_counts 
        (userid, profileid, whatsapp_count, other_count, last_updated)
        VALUES ('$userid','$profileid','$wa','$other',NOW())");
}

echo json_encode(['status'=>'success']);
