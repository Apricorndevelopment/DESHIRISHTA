<?php
include 'config.php';

$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];

$sql = "UPDATE `contact` SET `email`='$email',`phone`='$phone',`address`='$address' WHERE `id`='1'";
$result = mysqli_query($con,$sql);

header('location:contact.php?update=success');

?>