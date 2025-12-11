<?php
ob_start(); 
include 'config.php';
$userid = $_COOKIE['dr_userid'];
$email = $_COOKIE['dr_email'];
$fullname =  $_COOKIE['dr_name'];
$subject = "Email verification link from Desi Rishta";
$mailContent = "
    <div style='width:100%; margin:2% auto; padding:3%;'>
        <div style='text-align:center'>
            <img src='https://desi-rishta.com//images/tlogo.png' style='width:50%'>
        </div>
        <div style='width:100%; margin:0 auto'>
            <div style='color:#000; width:90%; margin:0 auto;'>
                <p style='font-size:15px;'>Hi $fullname,</p>
                <p style='font-size:15px;'>Please click the link below to complete your email verification process.</p>
                <p style='font-size:15px;'><a href='https://desi-rishta.com/verifiedemail.php?userid=$userid'>Click Here To Verify Your Email</a></p>
                <br>
                <p style='font-size:15px; margin:0px'>Thanks & Regards,</p>
                <p style='font-size:15px; margin:0px'>Team Desi Rishta</p>
                <p style='font-size:15px; margin:0px'>support@desi-rishta.com</p>
            </div>
        </div>    
    </div>
    ";

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