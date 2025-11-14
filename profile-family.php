<?php
include 'config.php';

$userid = $_COOKIE['dr_userid'];
$familyvalue = $_POST['familyvalue'];
$familytype = $_POST['familytype'];
$familystatus = $_POST['familystatus']; 
$nativeplace = $_POST['nativeplace'];
$fathername = $_POST['fathername'];
$mothername = $_POST['mothername'];
$fatheroccupation = $_POST['fatheroccupation'];
$motheroccupation = $_POST['motheroccupation'];
$brothers = $_POST['brothers'];
$bromarried = $_POST['bromarried'];
$sisters = $_POST['sisters'];
$sismarried = $_POST['sismarried'];
$familylocation = $_POST['familylocation'];
$state = str_replace("_", " ",$_POST['state']);
$city = str_replace("//","",implode("//",$_POST['city']));
$country = $_POST['country'];


$sqlcheck = "select * from family_info where userid = '$userid'";
$resultcheck = mysqli_query($con,$sqlcheck);
$countcheck = mysqli_num_rows($resultcheck);

if($countcheck == '0')
{
    $sqlinsert = "INSERT INTO `family_info`(`userid`, `familyvalue`, `familytype`, `familystatus`, `nativeplace`, `fathername`, `mothername`, `fatheroccupation`, `motheroccupation`, `brothers`, `bromarried`, `sisters`, `sismarried`, `familylocation`, `state`, `city`, `country`) VALUES ('$userid', '$familyvalue', '$familytype', '$familystatus', '$nativeplace', '$fathername', '$mothername', '$fatheroccupation', '$motheroccupation', '$brothers', '$bromarried', '$sisters', '$sismarried', '$familylocation', '$state', '$city', '$country')";
    $resultinsert = mysqli_query($con,$sqlinsert);
    
    if($familyvalue != '' && $familytype != '' && $familystatus != '' && $nativeplace != '' && $fathername != '' && $mothername != '' && $fatheroccupation != '' && $motheroccupation != '' && $brothers != '' && $bromarried != '' && $sisters != '' && $sismarried != '' && $familylocation != '' && $state != '' && $city != '' && $country != '')
    {
        $updatebasicinfo1 = "UPDATE `registration` SET `familyinfo`='Done' WHERE `userid`='$userid'";
        $resultbasicinfo1 = mysqli_query($con,$updatebasicinfo1);
    }
    else
    {
        $updatebasicinfo2 = "UPDATE `registration` SET `familyinfo`='' WHERE `userid`='$userid'";
        $resultbasicinfo2 = mysqli_query($con,$updatebasicinfo2);
    }
}
else
{
    echo $sqlupdate = "UPDATE `family_info` SET `familyvalue`='$familyvalue',`familytype`='$familytype',`familystatus`='$familystatus',`nativeplace`='$nativeplace',`fathername`='$fathername',`mothername`='$mothername',`fatheroccupation`='$fatheroccupation',`motheroccupation`='$motheroccupation',`brothers`='$brothers',`bromarried`='$bromarried',`sisters`='$sisters',`sismarried`='$sismarried',`familylocation`='$familylocation',`state`='$state',`city`='$city',`country`='$country' WHERE `userid`='$userid'";
    $resultupdate = mysqli_query($con,$sqlupdate);
    
    if($familyvalue != '' && $familytype != '' && $familystatus != '' && $nativeplace != '' && $fathername != '' && $mothername != '' && $fatheroccupation != '' && $motheroccupation != '' && $brothers != '' && $bromarried != '' && $sisters != '' && $sismarried != '' && $familylocation != '' && $state != '' && $city != '' && $country != '')
    {
        $updatebasicinfo3 = "UPDATE `registration` SET `familyinfo`='Done' WHERE `userid`='$userid'";
        $resultbasicinfo3 = mysqli_query($con,$updatebasicinfo3);
    }
    else
    {
        $updatebasicinfo4 = "UPDATE `registration` SET `familyinfo`='' WHERE `userid`='$userid'";
        $resultbasicinfo4 = mysqli_query($con,$updatebasicinfo4);   
    }
}

header('location:user-profile-edit.php?tab=family&family_update=yes');
?>