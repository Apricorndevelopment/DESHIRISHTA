<?php
include 'config.php';

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "UPDATE `administrator` SET `email`= '$email', `password`= '$password' WHERE `id`= '1'";
$result = mysqli_query($con,$sql);

header('location:changepassword.php?update=success');
?>