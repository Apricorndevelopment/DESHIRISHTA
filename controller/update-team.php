<?php
include 'config.php';

if(isset($_POST['submit'])) {

    // Form Data
    $id = mysqli_real_escape_string($con, $_POST['id']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $designation = mysqli_real_escape_string($con, $_POST['designation']);
    $facebook = mysqli_real_escape_string($con, $_POST['facebook']);
    $twitter = mysqli_real_escape_string($con, $_POST['twitter']);
    $whatsapp = mysqli_real_escape_string($con, $_POST['whatsapp']);
    $linkedin = mysqli_real_escape_string($con, $_POST['linkedin']);
    $instagram = mysqli_real_escape_string($con, $_POST['instagram']);
    
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
    $sql = "UPDATE tbl_team SET 
              name = '$name', 
              designation = '$designation', 
              image = '$new_image_name',
              facebook = '$facebook',
              twitter = '$twitter',
              whatsapp = '$whatsapp',
              linkedin = '$linkedin',
              instagram = '$instagram'
            WHERE id = '$id'";
    
    if (mysqli_query($con, $sql)) {
        header("Location: view-team.php?status=updated");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($con);
        exit();
    }

} else {
    header("Location: view-team.php");
    exit();
}
?>