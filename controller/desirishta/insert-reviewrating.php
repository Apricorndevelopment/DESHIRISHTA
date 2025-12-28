<?php
include 'config.php'; // yaha $con connection hona chahiye

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Cookies se userid
    $userid = $_COOKIE['dr_userid'];

    // Form se data
    $name    = mysqli_real_escape_string($con, $_POST['name']);
    $email   = mysqli_real_escape_string($con, $_POST['email']);
    $phone   = mysqli_real_escape_string($con, $_POST['phone']);
    $rating  = mysqli_real_escape_string($con, $_POST['rate']);
    $message = mysqli_real_escape_string($con, $_POST['message']);

    // Validation
    if ($rating == '' || $message == '') {
        header('location:reviewrating.php?error=yes&#support');
        exit;
    }

    // Insert Query
    $sql = "INSERT INTO review_rating 
            (userid, name, email, phone, rating, message)
            VALUES 
            ('$userid', '$name', '$email', '$phone', '$rating', '$message')";

    if (mysqli_query($con, $sql)) {
        header('location:reviewrating.php?success=yes&#support');
        exit;
    } else {
        echo "Database Error: " . mysqli_error($con);
    }
}
?>
