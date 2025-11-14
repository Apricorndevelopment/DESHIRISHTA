<?php
include 'config.php';

$userid = $_COOKIE['dr_userid'];
$country = $_POST['country'];
$citizenship = $_POST['citizenship'];
$resident = $_POST['resident'];
$state = $_POST['state'];
$city = implode("//",$_POST['city']);
$groomorigin = $_POST['groomorigin'];

$sqlbasicinfo = "select * from basic_info where userid = '$userid'";
$resultbasicinfo = mysqli_query($con,$sqlbasicinfo);
$rowbasicinfo = mysqli_fetch_assoc($resultbasicinfo);

$sqlcheck = "select * from groom_location where userid = '$userid'";
$resultcheck = mysqli_query($con,$sqlcheck);
$countcheck = mysqli_num_rows($resultcheck);

if($countcheck == '0')
{
    $sqlinsert = "INSERT INTO `groom_location`(`userid`, `state`, `city`, `country`, `citizenship`, `resident`, `ancestralorigin`) VALUES ('$userid', '$state', '$city', '$country', '$citizenship', '$resident', '$groomorigin')";
    $resultinsert = mysqli_query($con,$sqlinsert);
    
    if($rowbasicinfo['gender'] == 'Male' && $country != '' && $citizenship != '' && $resident != '' && $state != '' && $city != '')
    {
        $updatebasicinfo1 = "UPDATE `registration` SET `groomlocation`='Done', bridelocation`='' WHERE `userid`='$userid'";
        $resultbasicinfo1 = mysqli_query($con,$updatebasicinfo1);
    }
    else
    {
        $updatebasicinfo2 = "UPDATE `registration` SET `groomlocation`='', `bridelocation`='' WHERE `userid`='$userid'";
        $resultbasicinfo2 = mysqli_query($con,$updatebasicinfo2);
    }
    
    if($rowbasicinfo['gender'] == 'Female' && $country != '' && $citizenship != '' && $resident != '' && $state != '' && $city != '')
    {
        $updatebasicinfo1 = "UPDATE `registration` SET `groomlocation`='', bridelocation`='Done' WHERE `userid`='$userid'";
        $resultbasicinfo1 = mysqli_query($con,$updatebasicinfo1);
    }
    else
    {
        $updatebasicinfo2 = "UPDATE `registration` SET `groomlocation`='', `bridelocation`='' WHERE `userid`='$userid'";
        $resultbasicinfo2 = mysqli_query($con,$updatebasicinfo2);
    }
}
else
{
    $sqlupdate = "UPDATE `groom_location` SET `state`='$state',`city`='$city',`country`='$country',`citizenship`='$citizenship',`resident`='$resident',`ancestralorigin`='$groomorigin' WHERE `userid`='$userid'";
    $resultupdate = mysqli_query($con,$sqlupdate);
    
    if($rowbasicinfo['gender'] == 'Male' && $country != '' && $citizenship != '' && $resident != '' && $state != '' && $city != '')
    {
        $updatebasicinfo3 = "UPDATE `registration` SET `groomlocation`='Done', bridelocation`='' WHERE `userid`='$userid'";
        $resultbasicinfo3 = mysqli_query($con,$updatebasicinfo3);
    }
    else
    {
        $updatebasicinfo4 = "UPDATE `registration` SET `groomlocation`='', `bridelocation`='Done' WHERE `userid`='$userid'";
        $resultbasicinfo4 = mysqli_query($con,$updatebasicinfo4);
    }
    
    if($rowbasicinfo['gender'] == 'Female' && $country != '' && $citizenship != '' && $resident != '' && $state != '' && $city != '')
    {
        $updatebasicinfo3 = "UPDATE `registration` SET `groomlocation`='', bridelocation`='Done' WHERE `userid`='$userid'";
        $resultbasicinfo3 = mysqli_query($con,$updatebasicinfo3);
    }
    else
    {
        $updatebasicinfo4 = "UPDATE `registration` SET `groomlocation`='', `bridelocation`='' WHERE `userid`='$userid'";
        $resultbasicinfo4 = mysqli_query($con,$updatebasicinfo4);
    }
}

header('location:user-profile-edit.php?tab=groom&groom_update=yes');
?>