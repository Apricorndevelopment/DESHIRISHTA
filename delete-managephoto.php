<?php
include 'config.php';

$userid = $_GET['uid'];
$coloum = $_GET['coloum'];

$sql = "update photos_info set $coloum = '' where userid = '$userid'";
$result = mysqli_query($con,$sql);

header('location:user-profile-edit.php?tab=photos');

?>