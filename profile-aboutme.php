<?php
include 'config.php';


require_once'email_layout_template.php';

$userid = $_COOKIE['dr_userid'];

// Better security sanitization
$aboutme = mysqli_real_escape_string($con, $_POST['aboutme']);

// ----------------------------------------------------------------
// APPROVAL WORKFLOW LOGIC (Temp Table)
// ----------------------------------------------------------------

// 1. Check if data exists in temporary table
$sqlcheck = "SELECT * FROM temp_basic_info WHERE userid = '$userid'";
$resultcheck = mysqli_query($con, $sqlcheck);
$countcheck = mysqli_num_rows($resultcheck);

if ($countcheck > 0) {
    // Update existing pending request
    $sql = "UPDATE `temp_basic_info` SET `aboutme`='$aboutme' WHERE `userid`='$userid'";
} else {
    // Insert new pending request
    $sql = "INSERT INTO `temp_basic_info` (`userid`, `aboutme`) VALUES ('$userid', '$aboutme')";
}

$result = mysqli_query($con, $sql);

if ($result) {
    // 2. Set Approval Status to 'Pending' in registration table
    // Note: We do NOT update the live 'aboutme' column status to 'Done' yet, 
    // or update 'profilestatus', until Admin approves.
    $update_status = "UPDATE `registration` SET `aboutme_approval_status`='Pending' WHERE `userid`='$userid'";
    mysqli_query($con, $update_status);
} else {
    echo "Error updating profile: " . mysqli_error($con);
    exit;
}

// ----------------------------------------------------------------
// EMAIL NOTIFICATION
// ----------------------------------------------------------------
$email = $_COOKIE['dr_email'];
$fullname =  $_COOKIE['dr_name'];
$subject = "About Me updated – Under Screening";

$customHtml = "
    <p style='font-size:15px;'>Dear $fullname,</p>
                <p style='font-size:15px;'>You have recently updated your 'About Me' description. These changes are currently under screening.</p>
                <p style='font-size:15px;'>Once approved by our team, the new details will be visible on your live profile.</p> ";


$mailContent = getEmailLayout($customHtml);
    
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://app.smtpprovider.com/api/send-mail/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('to' => $email,'from' => 'info@noreplies.co.in','from_name' => 'Desi Rishta','subject' => $subject,'body' => $mailContent,'token' => '74765968c67007219b197f4d9aafb4e2'),
));

$response = curl_exec($curl);
curl_close($curl);

// ----------------------------------------------------------------
// REDIRECT
// ----------------------------------------------------------------
header('location:user-profile-edit.php?tab=aboutme&aboutme_update=pending');
?>