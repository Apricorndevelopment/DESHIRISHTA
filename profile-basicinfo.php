<?php
include 'config.php';

$userid = $_COOKIE['dr_userid'];

// Data Retrieval with Safety Checks
$fullname = isset($_POST['fullname']) ? mysqli_real_escape_string($con, $_POST['fullname']) : '';
$marital  = isset($_POST['marital']) ? mysqli_real_escape_string($con, $_POST['marital']) : '';

// Children logic
if($marital == 'Never Married') {
    $children = ''; // Logic says no children if never married
} else {
    $children = isset($_POST['children']) ? mysqli_real_escape_string($con, $_POST['children']) : '';
}

$age      = isset($_POST['age']) ? mysqli_real_escape_string($con, $_POST['age']) : '';
$height   = isset($_POST['height']) ? mysqli_real_escape_string($con, $_POST['height']) : '';
$weight   = isset($_POST['weight']) ? mysqli_real_escape_string($con, $_POST['weight']) : '';
$physical = isset($_POST['physical']) ? mysqli_real_escape_string($con, $_POST['physical']) : '';
$eating   = isset($_POST['eating']) ? mysqli_real_escape_string($con, $_POST['eating']) : '';
$smoking  = isset($_POST['smoking']) ? mysqli_real_escape_string($con, $_POST['smoking']) : '';
$drinking = isset($_POST['drinking']) ? mysqli_real_escape_string($con, $_POST['drinking']) : '';

// Handle Language Array Safely
$langauge = '';
if(isset($_POST['langauge']) && is_array($_POST['langauge'])){
    $langauge = implode("//", $_POST['langauge']);
}

// Check existing record
$sqlcheck = "select * from basic_info where userid = '$userid'";
$resultcheck = mysqli_query($con,$sqlcheck);
$countcheck = mysqli_num_rows($resultcheck);

if($countcheck == '0')
{
    // Insert Logic
    $sqlinsert = "INSERT INTO `basic_info`(`userid`, `fullname`, `marital`, `children`, `age`, `height`, `weight`, `physical`, `langauge`, `eating`, `smoking`, `drinking`) VALUES ('$userid', '$fullname', '$marital', '$children', '$age', '$height', '$weight', '$physical', '$langauge', '$eating', '$smoking', '$drinking')";
    mysqli_query($con,$sqlinsert);
}
else
{
    // Update Logic
    $sqlupdate = "UPDATE `basic_info` SET `fullname`='$fullname',`marital`='$marital',`children`='$children',`age`='$age',`height`='$height',`weight`='$weight',`physical`='$physical',`langauge`='$langauge',`eating`='$eating',`smoking`='$smoking',`drinking`='$drinking' WHERE `userid`='$userid'";
    mysqli_query($con,$sqlupdate);
}

// --- STATUS UPDATE LOGIC ---
// Check ALL mandatory fields (Required for Green Tick)
if($fullname != '' && $marital != '' && $age != '' && $height != '' && $weight != '' && $physical != '' && $langauge != '' && $eating != '' && $smoking != '' && $drinking != '')
{
    // Agar Marital status married/divorced hai toh children bhi check hona chahiye
    if(($marital != 'Never Married') && $children == '') {
        $updatebasicinfo = "UPDATE `registration` SET `basicinfo`='' WHERE `userid`='$userid'";
    } else {
        $updatebasicinfo = "UPDATE `registration` SET `basicinfo`='Done' WHERE `userid`='$userid'";
    }
}
else
{
    // Agar koi bhi field khali hai
    $updatebasicinfo = "UPDATE `registration` SET `basicinfo`='' WHERE `userid`='$userid'";
}

// Execute Status Update
mysqli_query($con, $updatebasicinfo);

header('location:user-profile-edit.php?tab=basic&basic_update=yes');
?>