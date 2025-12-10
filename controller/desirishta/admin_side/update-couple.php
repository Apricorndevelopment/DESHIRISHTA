<?php
include 'config.php';

if(isset($_POST['submit'])) {

    // 1. Form Data Collect Karein
    $id = mysqli_real_escape_string($con, $_POST['id']);
    $couple_name = mysqli_real_escape_string($con, $_POST['couple_name']);
    $location = mysqli_real_escape_string($con, $_POST['location']);
    $old_image = mysqli_real_escape_string($con, $_POST['old_image']);
    $new_image_name = $old_image; // Default purani image hi rakhein

    // 2. Check karein ki NAYI image upload hui hai ya nahi
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0 && !empty($_FILES['image']['name'])) {
        
        $image_name = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $target_dir = "../images/couples/";
        $target_path = $target_dir . basename($image_name);

        // Nayi file ko move karein
        if(move_uploaded_file($tmp_name, $target_path)) {
            $new_image_name = $image_name; // DB mein save karne ke liye naya naam set karein

            // Purani image ko delete karein
            $old_image_path = $target_dir . $old_image;
            if (file_exists($old_image_path) && $old_image != $new_image_name) {
                unlink($old_image_path);
            }
        }
    }

    // 3. Database ko UPDATE karein
    $sql = "UPDATE tbl_recent_couples SET 
              couple_name = '$couple_name', 
              location = '$location', 
              image = '$new_image_name' 
            WHERE id = '$id'";
    
    if (mysqli_query($con, $sql)) {
        // Success: View page par redirect karein
        header("Location: view-couples.php?status=updated");
        exit();
    } else {
        // DB Error
        echo "Error updating record: " . mysqli_error($con);
        exit();
    }

} else {
    // Direct access rokne ke liye
    header("Location: view-couples.php");
    exit();
}
?>