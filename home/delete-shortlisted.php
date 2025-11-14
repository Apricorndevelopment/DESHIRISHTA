<?php
include 'config.php';

$userid = $_COOKIE['dr_userid'];
$uid = $_GET['uid'];

$sqlcheck = "delete FROM `shortlist_ids` WHERE `by_whom` = '$userid' and `for_who` = '$uid'";
$resultcheck = mysqli_query($con,$sqlcheck);

header("location:".$_SERVER["HTTP_REFERER"]);
?>