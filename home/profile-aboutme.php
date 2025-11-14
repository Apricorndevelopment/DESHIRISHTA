<?php
include 'config.php';

$userid = $_COOKIE['dr_userid'];
$aboutme = str_replace("'", "\'", $_POST['aboutme']);


$sqlcheck = "select * from basic_info where userid = '$userid'";
$resultcheck = mysqli_query($con,$sqlcheck);
$countcheck = mysqli_num_rows($resultcheck);

if($countcheck == '0')
{
    $sqlinsert = "INSERT INTO `basic_info`(`userid`, `aboutme`) VALUES ('$userid', '$aboutme')";
    $resultinsert = mysqli_query($con,$sqlinsert);
    
    if($aboutme != '')
    {
        $updatebasicinfo1 = "UPDATE `registration` SET `aboutme`='Done', `profilestatus`='0' WHERE `userid`='$userid'";
        $resultbasicinfo1 = mysqli_query($con,$updatebasicinfo1);
    }
    else
    {
        $updatebasicinfo2 = "UPDATE `registration` SET `aboutme`='', `profilestatus`='0' WHERE `userid`='$userid'";
        $resultbasicinfo2 = mysqli_query($con,$updatebasicinfo2);
    }
}
else
{
    $sqlupdate = "UPDATE `basic_info` SET `aboutme`='$aboutme' WHERE `userid`='$userid'";
    $resultupdate = mysqli_query($con,$sqlupdate);
    
    if($aboutme != '')
    {
        $updatebasicinfo3 = "UPDATE `registration` SET `aboutme`='Done', `profilestatus`='0' WHERE `userid`='$userid'";
        $resultbasicinfo3 = mysqli_query($con,$updatebasicinfo3);
    }
    else
    {
        $updatebasicinfo4 = "UPDATE `registration` SET `aboutme`='', `profilestatus`='0' WHERE `userid`='$userid'";
        $resultbasicinfo4 = mysqli_query($con,$updatebasicinfo4);
    }
}

$email = $_COOKIE['dr_email'];
$fullname =  $_COOKIE['dr_name'];
$subject = "Profile under screening";
$mailContent = "
    <div style='width:90%; margin:2% auto; padding:3%;'>
        <div style='text-align:center'>
            <img src='http://myptetest.com/desirishta/images/tlogo.png' style='width:50%'>
        </div>
        <div style='width:100%; margin:0 auto'>
            <div style='color:#000; width:90%; margin:0 auto;'>
                <p style='font-size:15px;'>Dear $fullname,</p>
                <p style='font-size:15px;'>Your profile is currently under screening. Once we determine that your profile meets our terms and conditions, your account will be made live. You will be notified once this process is complete. In the meantime, please continue your partner search on Desi Rishta.</p>
                <p style='font-size:15px;'>If you have any questions or need assistance, our support team is here to help.</p>
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
header('location:user-profile-edit.php?tab=aboutme&aboutme_update=yes');
?>