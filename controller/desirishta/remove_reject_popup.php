<?php
include 'config.php';

$userid = $_COOKIE['dr_userid'];

mysqli_query($con, "UPDATE registration 
SET reject_popup='0' 
WHERE userid='$userid'");
?>
