<?php
include 'config.php';

date_default_timezone_set('Asia/Kolkata'); 

$today_date = date('d-m-Y');

$sqldelete = "delete from block_otp where date != '$today_date'";
$resultdelete = mysqli_query($con,$sqldelete);

?>