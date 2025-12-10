<?php
error_reporting(1);

include 'config.php';

$page = $_POST['page'];
$tableid = $_POST['tableid'];
$heading = $_POST['heading'];
$url = str_replace(" ", "-", $_POST['heading']);
$status = $_POST['status'];

$oldblogimages = $_POST['oldblogimages'];
$s1=$_FILES["blogimages"]["name"];
if($s1 == '')
{
    $s1 = $oldblogimages;
}
else
{
    $s1=$_FILES["blogimages"]["name"];
    $s11=$_FILES["blogimages"]["tmp_name"];
    $sd1=move_uploaded_file($s11,"blogimages//".$s1);
    
}
$category = $_POST['category'];
$shortcontent = str_replace("'", "\'", $_POST['shortcontent']);
$content = str_replace("'", "\'", $_POST['content']);

$postdate = $_POST['postdate'];

$sql = "UPDATE `blogs` SET `heading`= '$heading', `url`= '$url',`category`= '$category', `shortcontent`= '$shortcontent', `content`= '$content', `postdate`= '$postdate', `blogimages`= '$s1', `status`= '$status'  WHERE `id`= '$tableid'";
$result = mysqli_query($con,$sql);

header('location:view-blogs.php?page='.$page);
?>