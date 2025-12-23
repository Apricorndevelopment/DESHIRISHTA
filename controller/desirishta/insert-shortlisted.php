<?php
include 'config.php';

$userid = $_COOKIE['dr_userid'];
$uid = $_GET['uid'];

$sqlcheck = "SELECT * FROM `shortlist_ids` WHERE `by_whom` = '$userid' and `for_who` = '$uid'";
$resultcheck = mysqli_query($con,$sqlcheck);
$countcheck = mysqli_num_rows($resultcheck);

if($countcheck == '0')
{
    $sql = "INSERT INTO `shortlist_ids`(`by_whom`, `for_who`) VALUES ('$userid', '$uid')";
    $result = mysqli_query($con,$sql);
}

header("location:matches-allprofiles.php");
?>