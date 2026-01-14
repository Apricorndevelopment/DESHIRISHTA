<?php
ob_start(); 
include 'config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/email_layout_template.php';
$userid = $_COOKIE['dr_userid'];
$email = $_COOKIE['dr_email'];
$fullname =  $_COOKIE['dr_name'];
$subject = "Email verification link from Desi Rishta";

$customHtml = "
  <p style='font-size:15px;'>Hi $fullname,</p>
                <p style='font-size:15px;'>Please click the link below to complete your email verification process.</p>
                <p style='font-size:15px;'><a href='https://desi-rishta.com/verifiedemail.php?userid=$userid'>Click Here To Verify Your Email</a></p>
";
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
//echo $response;

$sqlupdate = "UPDATE `registration` SET `emailverify`='0' WHERE `userid`='$userid'";
$resultupdate = mysqli_query($con,$sqlupdate);
header('location:user-setting.php?action=mailsent');
// header('location:user-setting.php');
?>