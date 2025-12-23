<?php
include 'config.php'; // Database connection

if(isset($_POST['email'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);

    // Check karein ki email pehle se exist karti hai ya nahi
    $check_query = "SELECT * FROM tbl_newsletter WHERE email = '$email'";
    $check_result = mysqli_query($con, $check_query);

    if(mysqli_num_rows($check_result) > 0) {
        echo "exist"; // Agar email pehle se hai
    } else {
        $sql = "INSERT INTO tbl_newsletter (email) VALUES ('$email')";
        if(mysqli_query($con, $sql)) {
            echo "success";
        } else {
            echo "error";
        }
    }
}
?>