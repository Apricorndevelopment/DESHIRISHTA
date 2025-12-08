<?php
include 'config.php';

if (isset($_POST['update'])) {
    $id = $_POST['id'];
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
    
    $old_image = $_POST['old_image'];
    $image = $_FILES['image']['name'];

    if ($image != "") {
        $temp_image = $_FILES['image']['tmp_name'];
        $target_dir = "../images/profiles/";
        move_uploaded_file($temp_image, $target_dir . $image);
    } else {
        $image = $old_image;
    }

    $sql = "UPDATE `dummy-profile` SET 
            profile_id='$profile_id', name='$name', age='$age', height='$height', 
            marital_status='$marital_status', religion='$religion', caste='$caste', 
            education='$education', profession='$profession', city='$city', image='$image' 
            WHERE id='$id'";

    if (mysqli_query($con, $sql)) {
        echo "<script>alert('Updated Successfully'); window.location.href='view-dummy.php';</script>";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>