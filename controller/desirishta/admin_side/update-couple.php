<?php
include 'config.php';

if(isset($_POST['submit'])) {
    
    // 1. Collect Data from Form
    $id = mysqli_real_escape_string($con, $_POST['id']);
    $couple_name = mysqli_real_escape_string($con, $_POST['couple_name']);
    $location = mysqli_real_escape_string($con, $_POST['location']);
    
    // New Fields Data
    $event_date = mysqli_real_escape_string($con, $_POST['event_date']);
    $event_time = mysqli_real_escape_string($con, $_POST['event_time']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    
    $old_image = $_POST['old_image'];
    $image = $old_image; // Default to keeping the old image

    // 2. Handle Main Image Update (If a new one is selected)
    if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
        
        $image_name = time() . "_" . $_FILES['image']['name'];
        $target_dir = "../images/couples/";
        $target_path = $target_dir . basename($image_name);

        // Create directory if it doesn't exist
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        if(move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
            $image = $image_name; // Set new image name for DB update
        }
    }
    
    // 3. Update Query
    $sql = "UPDATE tbl_recent_couples SET 
            couple_name = '$couple_name',
            location = '$location',
            event_date = '$event_date',
            event_time = '$event_time',
            description = '$description',
            image = '$image'
            WHERE id = '$id'";
            
    if(mysqli_query($con, $sql)) {
        
        // 4. Handle New Gallery Images Upload (Add to existing gallery)
        if(isset($_FILES['gallery_images'])) {
            $total_files = count($_FILES['gallery_images']['name']);
            
            // Create gallery folder if not exists
            $gallery_dir = "../images/couples/gallery/";
            if (!file_exists($gallery_dir)) {
                mkdir($gallery_dir, 0777, true);
            }

            // Loop through selected files
            for($i = 0; $i < $total_files; $i++) {
                if($_FILES['gallery_images']['name'][$i] != "") {
                    
                    $gal_img_name = time() . "_" . $i . "_" . $_FILES['gallery_images']['name'][$i];
                    $gal_tmp_name = $_FILES['gallery_images']['tmp_name'][$i];
                    
                    if(move_uploaded_file($gal_tmp_name, $gallery_dir . $gal_img_name)) {
                        // Insert into gallery table (Link to this couple ID)
                        $gal_sql = "INSERT INTO tbl_couple_gallery (couple_id, image_name) VALUES ('$id', '$gal_img_name')";
                        mysqli_query($con, $gal_sql);
                    }
                }
            }
        }

        header("Location: view-couples.php?status=updated");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }
} else {
    // If accessed directly without form submission
    header("Location: view-couples.php");
    exit();
}
?>