<?php
include 'config.php';

$userid = $_COOKIE['dr_userid'];
$govtid = $_POST['govtid'];

$s1=$_FILES["govtidphoto"]["name"];
$s11=$_FILES["govtidphoto"]["tmp_name"];
$sd1=move_uploaded_file($s11,"govtidphoto//".$s1);

$sqlcheck = "select * from verification_info where userid = '$userid'";
$resultcheck = mysqli_query($con,$sqlcheck);
$countcheck = mysqli_fetch_assoc($resultcheck);

if($countcheck == 0)
{
    $sqlinsert = "INSERT INTO `verification_info`(`userid`, `govtid`, `govpic`) VALUES ('$userid','$govtid','$s1')";
    $resultinsert = mysqli_query($con,$sqlinsert);
    
    $updatebasicinfo1 = "UPDATE `registration` SET `verificationinfo`='Done', `verification_popup`='0' WHERE `userid`='$userid'";
    $resultbasicinfo1 = mysqli_query($con,$updatebasicinfo1);
    
}
else
{
    $sqlupdate = "UPDATE `verification_info` SET `govtid`='$govtid',`govpic`='$s1' WHERE `userid`='$userid'";
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