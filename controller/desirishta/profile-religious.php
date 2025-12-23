<?php
include 'config.php';

$userid = $_COOKIE['dr_userid'];
$religion = $_POST['religion'];
$caste = $_POST['caste'];
$gothram = $_POST['gothram'];
$subcaste = $_POST['subcaste'];


$sqlcheck = "select * from religious_info where userid = '$userid'";
$resultcheck = mysqli_query($con,$sqlcheck);
$countcheck = mysqli_num_rows($resultcheck);

if($countcheck == '0')
{
    $sqlinsert = "INSERT INTO `religious_info`(`userid`, `religion`, `caste`, `gothram`, `tongue`, `subcaste`) VALUES ('$userid', '$religion', '$caste', '$gothram', '$tongue', '$subcaste')";
    $resultinsert = mysqli_query($con,$sqlinsert);
    
    if($religion != '' && $caste != '' && $gothram != '' && $subcaste != '')
    {
        $updatebasicinfo = "UPDATE `registration` SET `religiousinfo`='Done' WHERE `userid`='$userid'";
        $resultbasicinfo = mysqli_query($con,$updatebasicinfo);
    }
    else
    {
        $updatebasicinfo1 = "UPDATE `registration` SET `religiousinfo`='' WHERE `userid`='$userid'";
        $resultbasicinfo1 = mysqli_query($con,$updatebasicinfo1);
    }
}
else
{
    $sqlupdate = "UPDATE `religious_info` SET `religion`='$religion',`caste`='$caste',`gothram`='$gothram',`tongue`='$tongue',`subcaste`='$subcaste' WHERE `userid`='$userid'";
    $resultupdate = mysqli_query($con,$sqlupdate);
    
    if($religion != '' && $caste != '' && $gothram != '' && $subcaste != '')
    {
        $updatebasicinfo2 = "UPDATE `registration` SET `religiousinfo`='Done' WHERE `userid`='$userid'";
        $resultbasicinfo2 = mysqli_query($con,$updatebasicinfo2);
    }
    else
    {
        $updatebasicinfo3 = "UPDATE `registration` SET `religiousinfo`='' WHERE `userid`='$userid'";
        $resultbasicinfo3 = mysqli_query($con,$updatebasicinfo3);
    }
}

header('location:user-profile-edit.php?tab=religious&religious_update=yes');
?>