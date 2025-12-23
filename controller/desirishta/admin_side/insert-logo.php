<?php
include 'config.php';

$s1=$_FILES["logo"]["name"];
$s11=$_FILES["logo"]["tmp_name"];
$sd1=move_uploaded_file($s11,"logo//".$s1);

$sql = "UPDATE `logo` SET `logo`='$s1' WHERE `id`='1'";
$resut = mysqli_query($con,$sql);

header('location:logo.php');
?>