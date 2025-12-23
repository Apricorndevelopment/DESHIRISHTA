<?php
include 'config.php'; // $con variable yahan se aayega

if(isset($_POST['submit'])) {

    // 1. Text Data Collect Karein
    $couple_name = mysqli_real_escape_string($con, $_POST['couple_name']);
    $location = mysqli_real_escape_string($con, $_POST['location']);
    
    // New Fields
    $event_date = mysqli_real_escape_string($con, $_POST['event_date']);
    $event_time = mysqli_real_escape_string($con, $_POST['event_time']);
    $description = mysqli_real_escape_string($con, $_POST['description']);

    // 2. Main Image Upload Logic
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        
        $image_name = time() . "_" . $_FILES['image']['name']; // Unique name
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
            
            // 3. Database mein Insert Karein (Updated Query with new fields)
            $sql = "INSERT INTO tbl_recent_couples (couple_name, location, event_date, event_time, description, image, date_added) 
                    VALUES ('$couple_name', '$location', '$event_date', '$event_time', '$description', '$image_name', NOW())";
            
            if (mysqli_query($con, $sql)) {
                
                $couple_id = mysqli_insert_id($con); // Get Last Inserted ID for Gallery
                
                // 4. Gallery Images Upload Logic
                if(isset($_FILES['gallery_images'])) {
                    $total_files = count($_FILES['gallery_images']['name']);
                    
                    // Limit loop to 4 images max
                    $count_limit = ($total_files > 4) ? 4 : $total_files;

                    // Create gallery folder if not exists
                    $gallery_dir = "../images/couples/gallery/";
                    if (!file_exists($gallery_dir)) {
                        mkdir($gallery_dir, 0777, true);
                    }

                    for($i = 0; $i < $count_limit; $i++) {
                        if($_FILES['gallery_images']['name'][$i] != "") {
                            $gal_img_name = time() . "_" . $i . "_" . $_FILES['gallery_images']['name'][$i];
                            $gal_tmp_name = $_FILES['gallery_images']['tmp_name'][$i];
                            
                            if(move_uploaded_file($gal_tmp_name, $gallery_dir . $gal_img_name)) {
                                // Insert into gallery table
                                $gal_sql = "INSERT INTO tbl_couple_gallery (couple_id, image_name) VALUES ('$couple_id', '$gal_img_name')";
                                mysqli_query($con, $gal_sql);
                            }
                        }
                    }
                }

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