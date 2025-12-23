<?php
ob_start();
include 'config.php';

$userid = $_COOKIE['dr_userid'];
$dob = $_POST['dob'];
$birthplace = $_POST['birthplace'];
$birthtime = $_POST['birthtime'];
$manglik = $_POST['manglik'];

$sqlcheck = "select * from astro_info where userid = '$userid'";
$resultcheck = mysqli_query($con,$sqlcheck);
$countcheck = mysqli_num_rows($resultcheck);

if($countcheck == '0')
{
    $sqlinsert = "INSERT INTO `astro_info`(`userid`, `dob`, `birthplace`, `birthtime`, `manglik`) VALUES ('$userid', '$dob', '$birthplace', '$birthtime', '$manglik')";
    $resultinsert = mysqli_query($con,$sqlinsert);
    
    if($dob != '' && $birthplace != '' && $birthtime != '' && $manglik != '')
    {
        $updatebasicinfo1 = "UPDATE `registration` SET `astroinfo`='Done' WHERE `userid`='$userid'";
        $resultbasicinfo1 = mysqli_query($con,$updatebasicinfo1);
    }
    else
    {
        $updatebasicinfo2 = "UPDATE `registration` SET `astroinfo`='' WHERE `userid`='$userid'";
        $resultbasicinfo2 = mysqli_query($con,$updatebasicinfo2);
    }
}
else
{
    $sqlupdate = "UPDATE `astro_info` SET `dob`='$dob',`birthplace`='$birthplace',`birthtime`='$birthtime',`manglik`='$manglik' WHERE `userid`='$userid'";
    $resultupdate = mysqli_query($con,$sqlupdate);
    
    if($dob != '' && $birthplace != '' && $birthtime != '' && $manglik != '')
    {
        $updatebasicinfo3 = "UPDATE `registration` SET `astroinfo`='Done' WHERE `userid`='$userid'";
        $resultbasicinfo3 = mysqli_query($con,$updatebasicinfo3);
    }
    else
    {
        $updatebasicinfo4 = "UPDATE `registration` SET `astroinfo`='' WHERE `userid`='$userid'";
        $resultbasicinfo4 = mysqli_query($con,$updatebasicinfo4);
    }
}

header('location:user-profile-edit.php?tab=astro&astro_update=yes');
?>