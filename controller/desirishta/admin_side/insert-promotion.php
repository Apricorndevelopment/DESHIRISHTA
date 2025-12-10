<?php
include 'config.php';

$fpromotion = $_POST['fpromotion'];
$spromotion = $_POST['spromotion'];

$sql = "UPDATE `promotion` SET `fpromotion`='$fpromotion',`spromotion`='$spromotion' WHERE `id`='1'";
$result = mysqli_query($con,$sql);

header('location:promotion.php?insert=success')

?>