<?php
ob_start();
include 'config.php';

$sqlupdate = "update registration set profilestatus_popup = '0' where profilestatus = '0'";
$resultupdate = mysqli_query($con,$sqlupdate);

$sqlupdate1 = "update registration set verification_popup = '0' where verificationinfo != 'Done'";
$resultupdate1 = mysqli_query($con,$sqlupdate1);

?>