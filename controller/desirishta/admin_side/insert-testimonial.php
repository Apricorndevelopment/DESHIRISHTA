<?php
include 'config.php';

if(isset($_POST['submit'])) {

    // Form Data
    $user_name = mysqli_real_escape_string($con, $_POST['user_name']);
    $user_designation = mysqli_real_escape_string($con, $_POST['user_designation']);
    $content = mysqli_real_escape_string($con, $_POST['content']);
    $rating = (int)$_POST['rating'];

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
            $sql = "INSERT INTO tbl_testimonials (user_name, user_designation, user_image, content, rating, status) 
                    VALUES ('$user_name', '$user_designation', '$image_name', '$content', $rating, 'Active')";
            
            if (mysqli_query($con, $sql)) {
                header("Location: view-testimonials.php?status=added");
                exit();
            } else {
                header("Location: add-testimonial.php?status=error_db");
                exit();
            }
        } else {
            header("Location: add-testimonial.php?status=error_img");
            exit();
        }
    } else {
        header("Location: add-testimonial.php?status=error_no_img");
        exit();
    }
} else {
    header("Location: add-testimonial.php");
    exit();
}
?>