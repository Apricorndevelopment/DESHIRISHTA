<?php
include 'config.php';

$metatitle = $_POST['metatitle'];
$metadescription = $_POST['metadescription'];
$keywords = $_POST['keywords'];

$sql = "UPDATE `seotech` SET `metatitle`='$metatitle',`metadescription`='$metadescription',`keywords`='$keywords' WHERE `id`='1'";
$result = mysqli_query($con,$sql);

header('location:seotech.php');
?>