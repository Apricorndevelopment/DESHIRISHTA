<?php 
include 'header.php'; 
include 'config.php';

// Fetch existing data
if(isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);
    $sql = "SELECT * FROM `dummy-profile` WHERE id='$id'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);

    // Explode the image string into an array to handle multiple photos
    $current_images = explode(',', $row['image']);
}
?>

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-body">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Profile</h4>
                </div>
                <div class="card-body">
                    <form class="form" action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        
                        <input type="hidden" name="old_image_string" value="<?php echo $row['image']; ?>">
                        
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" value="<?php echo $row['name']; ?>" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Profile ID</label>
                                <input type="text" class="form-control" name="profile_id" value="<?php echo $row['profile_id']; ?>" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Age</label>
                                <input type="number" class="form-control" name="age" value="<?php echo $row['age']; ?>">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Height</label>
                                <input type="text" class="form-control" name="height" value="<?php echo $row['height']; ?>">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Religion</label>
                                <input type="text" class="form-control" name="religion" value="<?php echo $row['religion']; ?>">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Caste</label>
                                <input type="text" class="form-control" name="caste" value="<?php echo $row['caste']; ?>">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Marital Status</label>
                                <select class="form-control" name="marital_status">
                                    <option value="<?php echo $row['marital_status']; ?>" selected><?php echo $row['marital_status']; ?></option>
                                    <option value="Never Married">Never Married</option>
                                    <option value="Divorced">Divorced</option>
                                    <option value="Widowed">Widowed</option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Education</label>
                                <input type="text" class="form-control" name="education" value="<?php echo $row['education']; ?>">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Profession</label>
                                <input type="text" class="form-control" name="profession" value="<?php echo $row['profession']; ?>">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>City</label>
                                <input type="text" class="form-control" name="city" value="<?php echo $row['city']; ?>">
                            </div>

                            <div class="col-md-12 form-group">
                                <label class="d-block mb-2">Current Images (Check box to REMOVE image)</label>
                                <div class="row">
                                    <?php 
                                    if(!empty($row['image'])) {
                                        foreach($current_images as $img) {
                                            if(trim($img) != "") { // check if not empty
                                    ?>
                                        <div class="col-md-2 col-4 text-center mb-2">
                                            <div style="border:1px solid #ddd; padding:5px; border-radius:5px;">
                                                <img src="../images/profiles/<?php echo $img; ?>" style="width:100%; height:100px; object-fit:cover;">
                                                <div class="custom-control custom-checkbox mt-1">
                                                    <input type="checkbox" class="custom-control-input" id="remove_<?php echo $img; ?>" name="remove_images[]" value="<?php echo $img; ?>">
                                                    <label class="custom-control-label text-danger" for="remove_<?php echo $img; ?>">Remove</label>
                                                </div>
                                            </div>
                                        </div>
                                    <?php 
                                            }
                                        }
                                    } else {
                                        echo "<p class='ml-2 text-muted'>No images uploaded.</p>";
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class="col-md-12 form-group">
                                <label>Add New Images (Optional - Select Multiple)</label>
                                <input type="file" class="form-control" name="new_images[]" multiple>
                                <small class="text-muted">These will be added to the existing photos.</small>
                            </div>

                            <div class="col-12">
                                <button type="submit" name="update" class="btn btn-primary">Update Profile</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>

<?php
if (isset($_POST['update'])) {
    $id = mysqli_real_escape_string($con, $_POST['id']);
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

    // 1. Handle Existing Images (Filter out removed ones)
    $old_image_string = $_POST['old_image_string'];
    $current_images_array = explode(',', $old_image_string);
    $kept_images = array();

    // Get list of images user wants to remove
    $images_to_remove = isset($_POST['remove_images']) ? $_POST['remove_images'] : array();

    foreach ($current_images_array as $img) {
        if (!in_array($img, $images_to_remove)) {
            $kept_images[] = $img; // Keep this image if NOT in remove list
        } else {
            // Optional: Delete the actual file from server if you want to save space
            // unlink("../images/profiles/" . $img); 
        }
    }

    // 2. Handle New Uploads
    $target_dir = "../images/profiles/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    if(isset($_FILES['new_images']['name']) && $_FILES['new_images']['name'][0] != "") {
        $total_files = count($_FILES['new_images']['name']);
        
        for($i = 0; $i < $total_files; $i++) {
            $image_name = $_FILES['new_images']['name'][$i];
            $temp_name = $_FILES['new_images']['tmp_name'][$i];
            
            // To be safe, you might want to rename to avoid duplicates, but using original name for now:
            $final_name = $image_name; 

            if(move_uploaded_file($temp_name, $target_dir . $final_name)) {
                $kept_images[] = $final_name; // Add new image to the kept list
            }
        }
    }

    // 3. Create final string
    // Filter array to remove empty slots just in case
    $kept_images = array_filter($kept_images);
    $final_image_string = implode(',', $kept_images);

    // If all images removed and no new ones added, ensure it's not empty (optional fallback)
    if(empty($final_image_string)) {
        $final_image_string = "default.jpg"; 
    }

    // 4. Update Database
    $update_sql = "UPDATE `dummy-profile` SET 
                   profile_id='$profile_id', name='$name', age='$age', height='$height', 
                   marital_status='$marital_status', religion='$religion', caste='$caste', 
                   education='$education', profession='$profession', city='$city', 
                   image='$final_image_string' 
                   WHERE id='$id'";

    if (mysqli_query($con, $update_sql)) {
        echo "<script>alert('Profile Updated Successfully'); window.location.href='view-dummy.php';</script>";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>