<?php
include 'config.php';

$userid = $_COOKIE['dr_userid'];

$sqlonline = "UPDATE `registration` SET `online`='no' WHERE `userid`='$userid'";
$resultonline = mysqli_query($con,$sqlonline);
    
setcookie('dr_userid','');

    
header('location:logout-final.php');
?>