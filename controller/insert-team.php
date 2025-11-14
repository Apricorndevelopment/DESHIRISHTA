<?php
include 'config.php';

if(isset($_POST['submit'])) {

    // Form Data
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $designation = mysqli_real_escape_string($con, $_POST['designation']);
    $facebook = mysqli_real_escape_string($con, $_POST['facebook']);
    $twitter = mysqli_real_escape_string($con, $_POST['twitter']);
    $whatsapp = mysqli_real_escape_string($con, $_POST['whatsapp']);
    $linkedin = mysqli_real_escape_string($con, $_POST['linkedin']);
    $instagram = mysqli_real_escape_string($con, $_POST['instagram']);

    // Image Upload Logic
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_name = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        
        // Image ko 'images/profiles/' folder mein move karein
        $target_dir = "../images/profiles/";
        $target_path = $target_dir . basename($image_name);

        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        if(move_uploaded_file($tmp_name, $target_path)) {
            
            // Database mein Insert Karein
            $sql = "INSERT INTO tbl_team (name, designation, image, facebook, twitter, whatsapp, linkedin, instagram) 
                    VALUES ('$name', '$designation', '$image_name', '$facebook', '$twitter', '$whatsapp', '$linkedin', '$instagram')";
            
            if (mysqli_query($con, $sql)) {
                header("Location: view-team.php?status=added");
                exit();
            } else {
                header("Location: add-team.php?status=error");
                exit();
            }
        } else {
            header("Location: add-team.php?status=img_error");
            exit();
        }
    } else {
        header("Location: add-team.php?status=no_img");
        exit();
    }
} else {
    header("Location: add-team.php");
    exit();
}
?>