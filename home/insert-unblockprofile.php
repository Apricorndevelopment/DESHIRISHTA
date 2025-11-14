<?php
include 'config.php';

$userid = $_COOKIE['dr_userid'];
$uid = $_GET['uid'];

$sql = "DELETE FROM `block_ids` WHERE `by_whom` = '$userid' and `for_who` = '$uid'";
$result = mysqli_query($con,$sql);

header("location:".$_SERVER["HTTP_REFERER"]);
?>