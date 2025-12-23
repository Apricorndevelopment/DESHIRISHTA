<?php
include('config.php');

if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['phone']) || empty($_POST['category']) || empty($_POST['message'])) {
    header('location:contact.php?error=missingfields#support');
    exit;
}

$name = mysqli_real_escape_string($con, $_POST['name']);
$email = mysqli_real_escape_string($con, $_POST['email']);
$phone = mysqli_real_escape_string($con, $_POST['phone']);
$category = mysqli_real_escape_string($con, $_POST['category']);
$message = mysqli_real_escape_string($con, $_POST['message']);

$sql = "INSERT INTO contact_us (name, email, phone, category, message, status)
        VALUES ('$name', '$email', '$phone', '$category', '$message', 'New')";

if (mysqli_query($con, $sql)) {
    header('location:contact.php?success=yes#support');
    exit;
} else {
    echo "DB Error: " . mysqli_error($con);
}
?>
