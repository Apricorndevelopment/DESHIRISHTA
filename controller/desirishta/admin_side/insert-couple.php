<?php
include 'config.php'; // $con variable yahan se aayega

if(isset($_POST['submit'])) {

    // 1. Text Data Collect Karein
    $couple_name = mysqli_real_escape_string($con, $_POST['couple_name']);
    $location = mysqli_real_escape_string($con, $_POST['location']);

    // 2. Image Upload Logic
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        
        $image_name = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        
        // Image ko 'controller' folder se bahar 'images/couples/' folder mein move karein
        $target_dir = "../images/couples/";
        $target_path = $target_dir . basename($image_name);

        // Check karein ki 'images/couples' folder hai ya nahi
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // File ko move karein
        if(move_uploaded_file($tmp_name, $target_path)) {
            
            // 3. Database mein Insert Karein
            $sql = "INSERT INTO tbl_recent_couples (couple_name, location, image) 
                    VALUES ('$couple_name', '$location', '$image_name')";
            
            if (mysqli_query($con, $sql)) {
                // Success: View page par redirect karein
                header("Location: view-couples.php?status=added");
                exit();
            } else {
                // DB Error
                header("Location: add-couple.php?status=error");
                exit();
            }

        } else {
            // Image Upload Error
            header("Location: add-couple.php?status=error");
            exit();
        }
    } else {
        // No File Error
        header("Location: add-couple.php?status=error");
        exit();
    }
} else {
    // Direct access rokne ke liye
    header("Location: add-couple.php");
    exit();
}
?>