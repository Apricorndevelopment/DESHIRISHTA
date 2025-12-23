<?php
include 'config.php';

$facebook = $_POST['facebook'];
$twitter = $_POST['twitter'];
$linkedin = $_POST['linkedin'];
$pinterest = $_POST['pinterest'];
$instagram = $_POST['instagram'];

$sql = "UPDATE `sociallinks` SET `facebook`='$facebook',`twitter`='$twitter',`linkedin`='$linkedin',`pinterest`='$pinterest',`instagram`='$instagram' WHERE `id`='1'";
$result = mysqli_query($con,$sql);

header('location:sociallink.php?update=success');

?>