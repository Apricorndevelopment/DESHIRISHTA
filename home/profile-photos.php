<?php
include 'config.php';

$userid = $_COOKIE['dr_userid'];

$oldprofilepic = $_POST['oldprofilepic'];
$s1=$_FILES["profilepic"]["name"];
if($s1 == '')
{
    $s1 = $oldprofilepic;
}
else
{
    $s11=$_FILES["profilepic"]["tmp_name"];
    $sd1=move_uploaded_file($s11,"userphoto//".$s1);
}

$oldphoto1 = $_POST['oldphoto1'];
$s2=$_FILES["photo1"]["name"];
if($s2 == '')
{
    $s2 = $oldphoto1;
}
else
{
    $s22=$_FILES["photo1"]["tmp_name"];
    $sd2=move_uploaded_file($s22,"userphoto//".$s2);
}

$oldphoto2 = $_POST['oldphoto2'];
$s3=$_FILES["photo2"]["name"];
if($s3 == '')
{
    $s3 = $oldphoto2;
}
else
{
    $s33=$_FILES["photo2"]["tmp_name"];
    $sd3=move_uploaded_file($s33,"userphoto//".$s3);
}

$oldphoto3 = $_POST['oldphoto3'];
$s4=$_FILES["photo3"]["name"];
if($s4 == '')
{
    $s4 = $oldphoto3;
}
else
{
    $s44=$_FILES["photo3"]["tmp_name"];
    $sd4=move_uploaded_file($s44,"userphoto//".$s4);
}

$oldphoto4 = $_POST['oldphoto4'];
$s5=$_FILES["photo4"]["name"];
if($s5 == '')
{
    $s5 = $oldphoto4;
}
else
{
    $s55=$_FILES["photo4"]["tmp_name"];
    $sd5=move_uploaded_file($s55,"userphoto//".$s5);
}

$oldphoto5 = $_POST['oldphoto5'];
$s6=$_FILES["photo5"]["name"];
if($s6 == '')
{
    $s6 = $oldphoto5;
}
else
{
    $s66=$_FILES["photo5"]["tmp_name"];
    $sd6=move_uploaded_file($s66,"userphoto//".$s6);
}

$sqlcheck = "select * from photos_info where userid = '$userid'";
$resultcheck = mysqli_query($con,$sqlcheck);
$countcheck = mysqli_num_rows($resultcheck);

if($countcheck == '0')
{
    $sqlinsert = "INSERT INTO `photos_info`(`userid`, `profilepic`, `photo1`, `photo2`, `photo3`, `photo4`, `photo5`) VALUES ('$userid', '$s1', '$s2', '$s3', '$s4', '$s5', '$s6')";
    $resultinsert = mysqli_query($con,$sqlinsert);
    
    $updatebasicinfo = "UPDATE `registration` SET `photosinfo`='Done', `profilestatus`='0' WHERE `userid`='$userid'";
    $resultbasicinfo = mysqli_query($con,$updatebasicinfo);
}
else
{
    $sqlupdate = "UPDATE `photos_info` SET `profilepic`='$s1',`photo1`='$s2',`photo2`='$s3',`photo3`='$s4',`photo4`='$s5',`photo5`='$s6' WHERE `userid`='$userid'";
    $resultupdate = mysqli_query($con,$sqlupdate);
    
    $updatebasicinfo1 = "UPDATE `registration` SET `photosinfo`='Done', `profilestatus`='0' WHERE `userid`='$userid'";
    $resultbasicinfo1 = mysqli_query($con,$updatebasicinfo1);
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

header('location:user-profile-edit.php?tab=photos&photos_update=yes');
?>
