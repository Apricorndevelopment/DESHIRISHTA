<?php
ob_start();
include 'config.php';

$loginid = $_COOKIE['dr_userid'];
$userid = $_GET['userid'];

$sqlupdate = "UPDATE `registration` SET `emailverify`='1' WHERE `userid`='$userid'";
$resultupdate = mysqli_query($con,$sqlupdate);

if($loginid == '')
{
   header('location:login.php');
}
else
{
    header('location:user-setting.php');
}

?>