<?php
include 'config.php';

$userid = $_COOKIE['dr_userid'];
$phonenumber = $_POST['phonenumber'];
$email = $_POST['email'];
setcookie("dr_email", $email, time() + (10 * 365 * 24 * 60 * 60));

$contactperson = $_POST['contactperson'];
$relationship = $_POST['relationship'];


$sqlcheck = "select * from contact_info where userid = '$userid'";
$resultcheck = mysqli_query($con,$sqlcheck);
$countcheck = mysqli_num_rows($resultcheck);

if($countcheck == '0')
{
    $sqlinsert = "INSERT INTO `contact_info`(`userid`, `phonenumber`, `email`, `contactperson`, `relationship`) VALUES ('$userid', '$phonenumber', '$country', '$contactperson', '$relationship')";
    $resultinsert = mysqli_query($con,$sqlinsert);
    
    if($phonenumber != '' && $email != '' && $contactperson != '' && $relationship != '')
    {
        $updatebasicinfo1 = "UPDATE `registration` SET `contactinfo`='Done' WHERE `userid`='$userid'";
        $resultbasicinfo1 = mysqli_query($con,$updatebasicinfo1);
    }
    else
    {
        $updatebasicinfo2 = "UPDATE `registration` SET `contactinfo`='' WHERE `userid`='$userid'";
        $resultbasicinfo2 = mysqli_query($con,$updatebasicinfo2);
    }
}
else
{
    $sqlupdate = "UPDATE `contact_info` SET `phonenumber`='$phonenumber',`email`='$email',`contactperson`='$contactperson',`relationship`='$relationship' WHERE `userid`='$userid'";
    $resultupdate = mysqli_query($con,$sqlupdate);
    
    if($phonenumber != '' && $email != '' && $contactperson != '' && $relationship != '')
    {
        $updatebasicinfo3 = "UPDATE `registration` SET `contactinfo`='Done' WHERE `userid`='$userid'";
        $resultbasicinfo3 = mysqli_query($con,$updatebasicinfo3);
    }
    else
    {
        $updatebasicinfo4 = "UPDATE `registration` SET `contactinfo`='' WHERE `userid`='$userid'";
        $resultbasicinfo4 = mysqli_query($con,$updatebasicinfo4);   
    }
}

header('location:user-profile-edit.php?tab=contact&contact_update=yes');
?>