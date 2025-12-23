<?php
include 'config.php';

$userid = $_COOKIE['dr_userid'];

// Data Retrieval
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

// Handling optional location fields based on selection
if($familylocation == 'Different Location') {
    $state = str_replace("_", " ", $_POST['state']);
    
    // Handle City Array (agar multiple select hai toh)
    if(isset($_POST['city']) && is_array($_POST['city'])){
        $city = str_replace("//", "", implode("//", $_POST['city']));
    } else {
        $city = '';
    }
    
    $country = $_POST['country'];
} else {
    // Agar Same Location hai toh inko blank rakhein ya existing user location utha lein
    $state = '';
    $city = '';
    $country = '';
}

// --- Check Completion Status Logic ---
$is_completed = false;

// 1. Check Mandatory Basic Fields (Jo sabke liye zaroori hain)
if($familyvalue != '' && $familytype != '' && $familystatus != '' && $nativeplace != '' && $fathername != '' && $mothername != '' && $fatheroccupation != '' && $motheroccupation != '' && $brothers != '' && $bromarried != '' && $sisters != '' && $sismarried != '' && $familylocation != '') 
{
    // 2. Check Location Logic
    if($familylocation == 'Same as my location') {
        // Agar same location hai, toh form complete maana jayega (Address fields check mat karo)
        $is_completed = true;
    } 
    elseif ($familylocation == 'Different Location') {
        // Agar different location hai, toh Address fields hone zaroori hain
        if($state != '' && $city != '' && $country != '') {
            $is_completed = true;
        }
    }
}

// Check existing record
$sqlcheck = "select * from family_info where userid = '$userid'";
$resultcheck = mysqli_query($con, $sqlcheck);
$countcheck = mysqli_num_rows($resultcheck);

if($countcheck == '0')
{
    // INSERT
    $sqlinsert = "INSERT INTO `family_info`(`userid`, `familyvalue`, `familytype`, `familystatus`, `nativeplace`, `fathername`, `mothername`, `fatheroccupation`, `motheroccupation`, `brothers`, `bromarried`, `sisters`, `sismarried`, `familylocation`, `state`, `city`, `country`) VALUES ('$userid', '$familyvalue', '$familytype', '$familystatus', '$nativeplace', '$fathername', '$mothername', '$fatheroccupation', '$motheroccupation', '$brothers', '$bromarried', '$sisters', '$sismarried', '$familylocation', '$state', '$city', '$country')";
    mysqli_query($con, $sqlinsert);
}
else
{
    // UPDATE
    $sqlupdate = "UPDATE `family_info` SET `familyvalue`='$familyvalue',`familytype`='$familytype',`familystatus`='$familystatus',`nativeplace`='$nativeplace',`fathername`='$fathername',`mothername`='$mothername',`fatheroccupation`='$fatheroccupation',`motheroccupation`='$motheroccupation',`brothers`='$brothers',`bromarried`='$bromarried',`sisters`='$sisters',`sismarried`='$sismarried',`familylocation`='$familylocation',`state`='$state',`city`='$city',`country`='$country' WHERE `userid`='$userid'";
    mysqli_query($con, $sqlupdate);
}

// --- Update Registration Status (Tick Mark Logic) ---
if($is_completed) {
    $update_status = "UPDATE `registration` SET `familyinfo`='Done' WHERE `userid`='$userid'";
    mysqli_query($con, $update_status);
} else {
    $update_status = "UPDATE `registration` SET `familyinfo`='' WHERE `userid`='$userid'";
    mysqli_query($con, $update_status);
}

header('location:user-profile-edit.php?tab=family&family_update=yes');
?>