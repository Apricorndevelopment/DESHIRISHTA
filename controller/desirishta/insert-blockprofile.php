<?php
include 'config.php';

$userid = $_COOKIE['dr_userid'];
$uid = $_GET['uid'];

$sql = "INSERT INTO `block_ids`(`by_whom`, `for_who`) VALUES ('$userid', '$uid')";
$result = mysqli_query($con,$sql);

header("location:".$_SERVER["HTTP_REFERER"]);
?>