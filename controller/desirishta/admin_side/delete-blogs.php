<?php
include 'config.php';

$tableid = $_GET['id'];
$page = $_GET['page'];

echo $sql = "delete from blogs where id = '$tableid'";
$result = mysqli_query($con,$sql);

header('location:view-blogs.php?delete=success&page='.$page);
?>