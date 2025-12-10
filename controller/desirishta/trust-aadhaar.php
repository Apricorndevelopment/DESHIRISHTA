<?php
include 'config.php';

$userid = $_COOKIE['dr_userid'];
$adhaarnum = $_POST['adhaarnum'];
$adhaarotp = $_POST['adhaarotp'];
$fullname = $_POST['fullname'];
$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$pincode = $_POST['pincode'];

$sqlcheck = "select * from verification_info where userid = '$userid'";
$resultcheck = mysqli_query($con,$sqlcheck);
$countcheck = mysqli_num_rows($resultcheck);

if($countcheck == '0')
{
    $sqlinsert = "INSERT INTO `verification_info`(`userid`, `adhaarnum`, `adhaarotp`, `fullname`, `address`, `city`, `state`, `pincode`) VALUES ('$userid', '$adhaarnum', '$adhaarotp', '$fullname', '$address', '$city', '$state', '$pincode')";
    $resultinsert = mysqli_query($con,$sqlinsert);
    
    $updatebasicinfo = "UPDATE `registration` SET `verificationinfo`='Done', `verification_popup`='0' WHERE `userid`='$userid'";
    $resultbasicinfo = mysqli_query($con,$updatebasicinfo);
}
else
{
    $sqlupdate = "UPDATE `verification_info` SET `adhaarnum`='$adhaarnum',`adhaarotp`='$adhaarotp',`fullname`='$fullname',`address`='$address',`city`='$city',`state`='$state',`pincode`='$pincode' WHERE `userid`='$userid'";
    $resultupdate = mysqli_query($con,$sqlupdate);
    
    $updatebasicinfo1 = "UPDATE `registration` SET `verificationinfo`='Done', `verification_popup`='0' WHERE `userid`='$userid'";
    $resultbasicinfo1 = mysqli_query($con,$updatebasicinfo1);
}

$email = $_COOKIE['dr_email'];
$fullname =  $_COOKIE['dr_name'];
$subject = "Verification Complete: You've Earned Your Trust Badge!";
$mailContent = "
    <div style='width:90%; margin:2% auto; padding:3%;'>
        <div style='text-align:center'>
            <img src='http://myptetest.com/desirishta/images/tlogo.png' style='width:50%'>
        </div>
        <div style='width:100%; margin:0 auto'>
            <div style='color:#000; width:90%; margin:0 auto;'>
                <p style='font-size:15px;'>Dear $fullname,</p>
                <p style='font-size:15px;'>We are pleased to inform you that your verification process has been successfully completed. As a result, your trust badge is now active on your profile.</p>
                <p style='font-size:15px;'>We appreciate your cooperation in completing this important step.</p>
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

header('location:trust-badge.php');
?>