<?php
include 'config.php';

$userid = $_COOKIE['dr_userid'];
$fullname = $_POST['fullname'];
$marital = $_POST['marital'];
if($marital == 'Never Married')
{
    $children = '';
}
else
{
    $children = $_POST['children'];
}
$age = $_POST['age'];
$height = $_POST['height'];
$weight = $_POST['weight'];
$physical = $_POST['physical'];
$langauge = implode("//", $_POST['langauge']);
$eating = $_POST['eating'];
$smoking = $_POST['smoking'];
$drinking = $_POST['drinking'];


$sqlcheck = "select * from basic_info where userid = '$userid'";
$resultcheck = mysqli_query($con,$sqlcheck);
$countcheck = mysqli_num_rows($resultcheck);

if($countcheck == '0')
{
    $sqlinsert = "INSERT INTO `basic_info`(`userid`, `fullname`, `marital`, `children`, `age`, `height`, `weight`, `physical`, `langauge`, `eating`, `smoking`, `drinking`) VALUES ('$userid', '$fullname', '$marital', '$children', '$age', '$height', '$weight', '$physical', '$langauge', '$eating', '$smoking', '$drinking')";
    $resultinsert = mysqli_query($con,$sqlinsert);
    
    if($fullname != '' && $marital != '' &&  $age != '' && $height != '' && $weight != '' && $physical != '' && $langauge != '' && $eating != '' && $smoking != '' && $drinking != '')
    {
        $updatebasicinfo1 = "UPDATE `registration` SET `basicinfo`='Done' WHERE `userid`='$userid'";
        $resultbasicinfo1 = mysqli_query($con,$updatebasicinfo1);
    }
    else
    {
        $updatebasicinfo2 = "UPDATE `registration` SET `basicinfo`='' WHERE `userid`='$userid'";
        $resultbasicinfo2 = mysqli_query($con,$updatebasicinfo2);
    }
}
else
{
    $sqlupdate = "UPDATE `basic_info` SET `fullname`='$fullname',`marital`='$marital',`children`='$children',`age`='$age',`height`='$height',`weight`='$weight',`physical`='$physical',`langauge`='$langauge',`eating`='$eating',`smoking`='$smoking',`drinking`='$drinking' WHERE `userid`='$userid'";
    $resultupdate = mysqli_query($con,$sqlupdate);
    
    if($fullname != '' && $marital != '' &&  $age != '' && $height != '' && $weight != '' && $physical != '' && $langauge != '' && $eating != '' && $smoking != '' && $drinking != '')
    {
        $updatebasicinfo3 = "UPDATE `registration` SET `basicinfo`='Done' WHERE `userid`='$userid'";
        $resultbasicinfo3 = mysqli_query($con,$updatebasicinfo3);
    }
    else
    {
        $updatebasicinfo4 = "UPDATE `registration` SET `basicinfo`='' WHERE `userid`='$userid'";
        $resultbasicinfo4 = mysqli_query($con,$updatebasicinfo4);
    }
}

header('location:user-profile-edit.php?tab=basic&basic_update=yes');
?>