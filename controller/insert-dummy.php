<?php
include 'config.php';

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $profile_id = mysqli_real_escape_string($con, $_POST['profile_id']);
    $age = mysqli_real_escape_string($con, $_POST['age']);
    $height = mysqli_real_escape_string($con, $_POST['height']);
    $marital_status = mysqli_real_escape_string($con, $_POST['marital_status']);
    $religion = mysqli_real_escape_string($con, $_POST['religion']);
    $caste = mysqli_real_escape_string($con, $_POST['caste']);
    $education = mysqli_real_escape_string($con, $_POST['education']);
    $profession = mysqli_real_escape_string($con, $_POST['profession']);
    $city = mysqli_real_escape_string($con, $_POST['city']);

    // Image Upload Logic
    $image = $_FILES['image']['name'];
    $temp_image = $_FILES['image']['tmp_name'];
    $target_dir = "../images/profiles/";
    
    // Ensure directory exists
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    if ($image != "") {
        move_uploaded_file($temp_image, $target_dir . $image);
    } else {
        $image = "default.jpg"; // Fallback image
    }

    $sql = "INSERT INTO `dummy-profile` (profile_id, name, age, height, marital_status, religion, caste, education, profession, city, image) 
            VALUES ('$profile_id', '$name', '$age', '$height', '$marital_status', '$religion', '$caste', '$education', '$profession', '$city', '$image')";

    if (mysqli_query($con, $sql)) {
        echo "<script>alert('Profile Added Successfully'); window.location.href='view-dummy.php';</script>";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>