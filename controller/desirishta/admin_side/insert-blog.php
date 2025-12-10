<?php
include 'config.php';

$heading = $_POST['heading'];
$url = str_replace(" ", "-", $_POST['heading']);
$status = $_POST['status'];

$s1=$_FILES["blogimages"]["name"];
$s11=$_FILES["blogimages"]["tmp_name"];
$sd1=move_uploaded_file($s11,"blogimages//".$s1);

$category = $_POST['category'];
$shortcontent = str_replace("'", "\'", $_POST['shortcontent']);
$content = str_replace("'", "\'", $_POST['content']);

$postdate = $_POST['postdate'];

echo $sql = "INSERT INTO `blogs`(`heading`, `url`, `category`, `shortcontent`, `content`, `postdate`, `blogimages`, `status`) VALUES ('$heading', '$url', '$category', '$shortcontent', '$content', '$postdate', '$s1', '$status')";
$result = mysqli_query($con,$sql);

header('location:view-blogs.php?page=1');
?>