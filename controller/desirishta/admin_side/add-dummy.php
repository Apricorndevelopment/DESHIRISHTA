<?php include 'header.php'; ?>

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Manage Dummy Profiles</h2>
            </div>
        </div>
        <div class="content-body">
            <section id="basic-vertical-layouts">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add New Profile</h4>
                            </div>
                            <div class="card-body">
                                <form class="form form-vertical" action="" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" class="form-control" name="name" placeholder="Name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Profile ID (Custom ID)</label>
                                                <input type="text" class="form-control" name="profile_id" placeholder="e.g. DR250101..." required>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-6">
                                            <div class="form-group">
                                                <label>Age</label>
                                                <input type="number" class="form-control" name="age" placeholder="25" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-6">
                                            <div class="form-group">
                                                <label>Height</label>
                                                <input type="text" class="form-control" name="height" placeholder="5 Feet 5 Inches" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Marital Status</label>
                                                <select class="form-control" name="marital_status">
                                                    <option value="Never Married">Never Married</option>
                                                    <option value="Divorced">Divorced</option>
                                                    <option value="Widowed">Widowed</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Religion</label>
                                                <select class="form-control" name="religion">
                                                    <option value="Hindu">Hindu</option>
                                                    <option value="Muslim">Muslim</option>
                                                    <option value="Sikh">Sikh</option>
                                                    <option value="Christian">Christian</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Caste / Sect</label>
                                                <input type="text" class="form-control" name="caste" placeholder="e.g. Brahmin, Sunni">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Education</label>
                                                <input type="text" class="form-control" name="education" placeholder="e.g. MBA, B.Tech">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Profession</label>
                                                <input type="text" class="form-control" name="profession" placeholder="e.g. Software Engineer">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>City</label>
                                                <input type="text" class="form-control" name="city" placeholder="e.g. Delhi">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label>Profile Images (Select Multiple)</label>
                                                <input type="file" class="form-control" name="images[]" multiple required>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <button type="submit" name="submit" class="btn btn-primary mr-1">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

<?php
include 'config.php';

if (isset($_POST['submit'])) {
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

    // --- UPDATED IMAGE UPLOAD LOGIC ---
    $target_dir = "../images/profiles/";
    
    // Ensure directory exists
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $uploaded_images = array(); // Array to store success filenames

    // Loop through each uploaded file
    if(isset($_FILES['images']['name']) && $_FILES['images']['name'][0] != "") {
        $total_files = count($_FILES['images']['name']);
        
        for($i = 0; $i < $total_files; $i++) {
            $image_name = $_FILES['images']['name'][$i];
            $temp_name = $_FILES['images']['tmp_name'][$i];
            
            // Generate a unique name to prevent overwriting (Optional, allows same filename twice)
            // $final_name = time() . "_" . $image_name; 
            
            // Using original name as per your request
            $final_name = $image_name;

            if(move_uploaded_file($temp_name, $target_dir . $final_name)) {
                $uploaded_images[] = $final_name;
            }
        }
    }

    // Convert array to comma-separated string (e.g., "pic1.jpg,pic2.jpg")
    if (!empty($uploaded_images)) {
        $image_string = implode(',', $uploaded_images);
    } else {
        $image_string = "default.jpg";
    }

    $sql = "INSERT INTO `dummy-profile` (profile_id, name, age, height, marital_status, religion, caste, education, profession, city, image) 
            VALUES ('$profile_id', '$name', '$age', '$height', '$marital_status', '$religion', '$caste', '$education', '$profession', '$city', '$image_string')";

    if (mysqli_query($con, $sql)) {
        echo "<script>alert('Profile Added Successfully with Multiple Images'); window.location.href='view-dummy.php';</script>";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>