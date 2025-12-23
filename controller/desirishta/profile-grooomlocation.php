<?php
include 'config.php';

$userid = $_COOKIE['dr_userid'];

// Form Data Receive Karein
$country = $_POST['country'];
$citizenship = $_POST['citizenship'];
$resident = $_POST['resident'];
$state = $_POST['state'];
$groomorigin = $_POST['groomorigin'];

// --- FIX START: Sirf ek City store karne ka logic ---
$raw_cities = $_POST['city'];
$city = ""; // Default khali rakhein

if (is_array($raw_cities)) {
    // 1. Array mein se khali values hatayein (jo dropdowns hidden the)
    $filtered_cities = array_filter($raw_cities, function($value) {
        return !is_null($value) && trim($value) !== '';
    });

    // 2. Filter hone ke baad jo pehli valid city bachi hai, use select karein
    if (!empty($filtered_cities)) {
        $city = reset($filtered_cities); // Sirf ek value uthayega (e.g. "New Delhi 1")
    }
} else {
    // Agar array nahi hai to direct value lein
    $city = $raw_cities;
}
// --- FIX END ---


// User ki Basic Info nikalein (Gender check karne ke liye)
$sqlbasicinfo = "select * from basic_info where userid = '$userid'";
$resultbasicinfo = mysqli_query($con, $sqlbasicinfo);
$rowbasicinfo = mysqli_fetch_assoc($resultbasicinfo);

// Check karein ki Location data pehle se hai ya nahi
$sqlcheck = "select * from groom_location where userid = '$userid'";
$resultcheck = mysqli_query($con, $sqlcheck);
$countcheck = mysqli_num_rows($resultcheck);

if ($countcheck == '0') {
    // Agar data nahi hai to INSERT karein
    $sqlinsert = "INSERT INTO `groom_location`(`userid`, `state`, `city`, `country`, `citizenship`, `resident`, `ancestralorigin`) VALUES ('$userid', '$state', '$city', '$country', '$citizenship', '$resident', '$groomorigin')";
    $resultinsert = mysqli_query($con, $sqlinsert);

    // Profile Status Update Logic (Insert ke liye)
    if ($rowbasicinfo['gender'] == 'Male' && $country != '' && $citizenship != '' && $resident != '' && $state != '' && $city != '') {
        $updatebasicinfo1 = "UPDATE `registration` SET `groomlocation`='Done', `bridelocation`='' WHERE `userid`='$userid'";
        $resultbasicinfo1 = mysqli_query($con, $updatebasicinfo1);
    } else {
        $updatebasicinfo2 = "UPDATE `registration` SET `groomlocation`='', `bridelocation`='' WHERE `userid`='$userid'";
        $resultbasicinfo2 = mysqli_query($con, $updatebasicinfo2);
    }

    if ($rowbasicinfo['gender'] == 'Female' && $country != '' && $citizenship != '' && $resident != '' && $state != '' && $city != '') {
        $updatebasicinfo1 = "UPDATE `registration` SET `groomlocation`='', `bridelocation`='Done' WHERE `userid`='$userid'";
        $resultbasicinfo1 = mysqli_query($con, $updatebasicinfo1);
    } else {
        $updatebasicinfo2 = "UPDATE `registration` SET `groomlocation`='', `bridelocation`='' WHERE `userid`='$userid'";
        $resultbasicinfo2 = mysqli_query($con, $updatebasicinfo2);
    }
} else {
    // Agar data pehle se hai to UPDATE karein
    $sqlupdate = "UPDATE `groom_location` SET `state`='$state',`city`='$city',`country`='$country',`citizenship`='$citizenship',`resident`='$resident',`ancestralorigin`='$groomorigin' WHERE `userid`='$userid'";
    $resultupdate = mysqli_query($con, $sqlupdate);

    // Profile Status Update Logic (Update ke liye)
    if ($rowbasicinfo['gender'] == 'Male' && $country != '' && $citizenship != '' && $resident != '' && $state != '' && $city != '') {
        $updatebasicinfo3 = "UPDATE `registration` SET `groomlocation`='Done', `bridelocation`='' WHERE `userid`='$userid'";
        $resultbasicinfo3 = mysqli_query($con, $updatebasicinfo3);
    } else {
        $updatebasicinfo4 = "UPDATE `registration` SET `groomlocation`='', `bridelocation`='Done' WHERE `userid`='$userid'";
        $resultbasicinfo4 = mysqli_query($con, $updatebasicinfo4);
    }

    if ($rowbasicinfo['gender'] == 'Female' && $country != '' && $citizenship != '' && $resident != '' && $state != '' && $city != '') {
        $updatebasicinfo3 = "UPDATE `registration` SET `groomlocation`='', `bridelocation`='Done' WHERE `userid`='$userid'";
        $resultbasicinfo3 = mysqli_query($con, $updatebasicinfo3);
    } else {
        $updatebasicinfo4 = "UPDATE `registration` SET `groomlocation`='', `bridelocation`='' WHERE `userid`='$userid'";
        $resultbasicinfo4 = mysqli_query($con, $updatebasicinfo4);
    }
}

// Wapis Edit page par bhej dein
header('location:user-profile-edit.php?tab=groom&groom_update=yes');
?>