<?php
include 'config.php';

$violation = implode("//", $_POST['violation']);
$subject = $_POST['subject'];
$complaint = $_POST['complaint'];
$against = $_POST['against'];
$by_who = $_POST['by_who'];

$sql = "INSERT INTO `report_ids`(`violation`, `subject`, `complaint`, `against`, `by_who`) VALUES ('$violation', '$subject', '$complaint', '$against', '$by_who')";
$result = mysqli_query($con,$sql);

header('location:matches-reportid.php?success=yes');
?>