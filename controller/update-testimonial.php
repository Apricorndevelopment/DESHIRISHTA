<?php
include 'config.php';

if(isset($_POST['submit'])) {

    // Form Data
    $id = mysqli_real_escape_string($con, $_POST['id']);
    $user_name = mysqli_real_escape_string($con, $_POST['user_name']);
    $user_designation = mysqli_real_escape_string($con, $_POST['user_designation']);
    $content = mysqli_real_escape_string($con, $_POST['content']);
    $rating = (int)$_POST['rating'];
    $status = mysqli_real_escape_string($con, $_POST['status']);
    
    $old_image = mysqli_real_escape_string($con, $_POST['old_image']);
    $new_image_name = $old_image;

    // Nayi Image ka Logic
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0 && !empty($_FILES['image']['name'])) {
        
        $image_name = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $target_dir = "../images/profiles/";
        $target_path = $target_dir . basename($image_name);

        if(move_uploaded_file($tmp_name, $target_path)) {
            $new_image_name = $image_name; // Naya naam set karein

            // Purani image delete karein
            $old_image_path = $target_dir . $old_image;
            if (file_exists($old_image_path) && $old_image != $new_image_name) {
                unlink($old_image_path);
            }
        }
    }

    // Database UPDATE Query
    $sql = "UPDATE tbl_testimonials SET 
              user_name = '$user_name', 
              user_designation = '$user_designation', 
              content = '$content',
              user_image = '$new_image_name',
              rating = $rating,
              status = '$status'
            WHERE id = '$id'";
    
    if (mysqli_query($con, $sql)) {
        header("Location: view-testimonials.php?status=updated");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($con);
        exit();
    }
} else {
    header("Location: view-testimonials.php");
    exit();
}
?>