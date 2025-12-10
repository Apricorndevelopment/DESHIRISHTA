<?php
include 'config.php';

$userid = $_COOKIE['dr_userid'];
$hobbies = implode("//", $_POST['hobbies']);
$music = implode("//", $_POST['music']);
$sports = implode("//", $_POST['sports']);
$food = implode("//", $_POST['food']);


$sqlcheck = "select * from hobbies_info where userid = '$userid'";
$resultcheck = mysqli_query($con,$sqlcheck);
$countcheck = mysqli_num_rows($resultcheck);

if($countcheck == '0')
{
    $sqlinsert = "INSERT INTO `hobbies_info`(`userid`, `hobbies`, `music`, `sports`, `food`) VALUES ('$userid', '$hobbies', '$music', '$sports', '$food')";
    $resultinsert = mysqli_query($con,$sqlinsert);
    
    if($hobbies != '' && $music != '' && $sports != '' && $food != '')
    {
        $updatebasicinfo1 = "UPDATE `registration` SET `hobbiesinfo`='Done' WHERE `userid`='$userid'";
        $resultbasicinfo1 = mysqli_query($con,$updatebasicinfo1);
    }
    else
    {
        $updatebasicinfo2 = "UPDATE `registration` SET `hobbiesinfo`='' WHERE `userid`='$userid'";
        $resultbasicinfo2 = mysqli_query($con,$updatebasicinfo2);
    }
}
else
{
    $sqlupdate = "UPDATE `hobbies_info` SET `hobbies`='$hobbies',`music`='$music',`sports`='$sports',`food`='$food' WHERE `userid`='$userid'";
    $resultupdate = mysqli_query($con,$sqlupdate);
    
    if($hobbies != '' && $music != '' && $sports != '' && $food != '')
    {
        $updatebasicinfo3 = "UPDATE `registration` SET `hobbiesinfo`='Done' WHERE `userid`='$userid'";
        $resultbasicinfo3 = mysqli_query($con,$updatebasicinfo3);
    }
    else
    {
        $updatebasicinfo4 = "UPDATE `registration` SET `hobbiesinfo`='' WHERE `userid`='$userid'";
        $resultbasicinfo4 = mysqli_query($con,$updatebasicinfo4);
    }
}

header('location:user-profile-edit.php?tab=hobbies&hobbies_update=yes');
?>