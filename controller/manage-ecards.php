<?php
// 1. Config sabse pehle include karein (DB connection ke liye)
include '../config.php';

/* ================= MULTIPLE IMAGE UPLOAD PROCESSING ================= */
// Logic ko Header/Sidebar se PEHLE rakhein
if (isset($_POST['upload_template'])) {

    $target_dir = "../images/ecards/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $success_count = 0;
    $error_count = 0;

    // Check if files were uploaded
    if (isset($_FILES['t_image']) && !empty($_FILES['t_image']['name'][0])) {
        
        // Loop through each file
        foreach ($_FILES['t_image']['name'] as $key => $val) {
            
            $raw_filename = basename($_FILES['t_image']['name'][$key]);
            $tmp_name     = $_FILES['t_image']['tmp_name'][$key];
            
            // Generate unique name: time + index + filename
            $filename     = time() . "_" . $key . "_" . $raw_filename;
            $target_file  = $target_dir . $filename;

            // Move file
            if (move_uploaded_file($tmp_name, $target_file)) {
                
                // Insert into DB
                $insert = mysqli_query(
                    $con, 
                    "INSERT INTO tbl_ecard_templates (template_image) VALUES ('$filename')"
                );

                if ($insert) {
                    $success_count++;
                } else {
                    $error_count++;
                }

            } else {
                $error_count++;
            }
        }

        // Redirect with summary
        if ($success_count > 0) {
            $msg = "$success_count templates uploaded successfully.";
            if($error_count > 0) {
                $msg .= " ($error_count failed)";
            }
            header("Location: manage-ecards.php?success=$msg");
            exit;
        } else {
            header("Location: manage-ecards.php?error=Failed to upload files");
            exit;
        }

    } else {
        header("Location: manage-ecards.php?error=No files selected");
        exit;
    }
}

/* ================= DELETE TEMPLATE ================= */
// Delete logic bhi sabse upar rakhein
if (isset($_GET['del'])) {

    $id = intval($_GET['del']);
    $sql = mysqli_query($con, "SELECT template_image FROM tbl_ecard_templates WHERE id='$id'");
    $row = mysqli_fetch_assoc($sql);

    if ($row) {
        // Delete physical file
        $file_path = "../images/ecards/" . $row['template_image'];
        if (file_exists($file_path)) {
            @unlink($file_path);
        }
        // Delete DB record
        mysqli_query($con, "DELETE FROM tbl_ecard_templates WHERE id='$id'");
    }

    header("Location: manage-ecards.php?success=Template deleted successfully");
    exit;
}

// 2. Ab Header aur Sidebar include karein (Processing ke baad)
include 'header.php';
include 'sidebar.php';
?>

<!-- BEGIN: Content -->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>

    <div class="content-wrapper">

        <!-- PAGE HEADER -->
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <h2 class="content-header-title mb-0">
                    Manage Wedding Card Templates
                </h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item">Communication</li>
                        <li class="breadcrumb-item active">E-Card Templates</li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- ALERTS -->
        <?php if (isset($_GET['success'])) { ?>
            <div class="alert alert-success text-center">
                <?php echo htmlspecialchars($_GET['success']); ?>
            </div>
        <?php } ?>

        <?php if (isset($_GET['error'])) { ?>
            <div class="alert alert-danger text-center">
                <?php echo htmlspecialchars($_GET['error']); ?>
            </div>
        <?php } ?>

        <!-- CONTENT BODY -->
        <div class="content-body">

            <!-- UPLOAD TEMPLATE -->
            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="card-title">Upload New Wedding Card Templates</h4>
                </div>
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data">
                        <div class="row align-items-end">
                            <div class="col-md-6">
                                <label>Select Images (Select Multiple) <p style="color:red;">📐 Image Dimensions

Width: 564 px

Height: 1002 px</p> </label>
                                <input type="file" name="t_image[]" class="form-control" accept="image/*" multiple required>
                                <small class="text-muted">Hold Ctrl (Windows) or Command (Mac) to select multiple files.</small>
                            </div>
                            <div class="col-md-3 mt-2">
                                <button type="submit" name="upload_template" class="btn btn-primary">
                                    Upload Templates
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- TEMPLATE LIST -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Available Templates</h4>
                </div>

                <div class="card-body">
                    <div class="row">

                        <?php
                        $res = mysqli_query($con, "SELECT * FROM tbl_ecard_templates ORDER BY id DESC");
                        
                        if (mysqli_num_rows($res) > 0) {
                            while ($row = mysqli_fetch_assoc($res)) {
                        ?>
                            <div class="col-xl-3 col-lg-4 col-md-6 mb-3">
                                <div class="card text-center p-2 h-100 shadow-sm border">
                                    <img src="../images/ecards/<?php echo $row['template_image']; ?>"
                                         class="img-fluid mb-2"
                                         style="height:200px; width:100%; object-fit:cover; border-radius:6px;">

                                    <a href="manage-ecards.php?del=<?php echo $row['id']; ?>"
                                       class="btn btn-danger btn-sm btn-block"
                                       onclick="return confirm('Are you sure you want to delete this template?');">
                                       <i class="feather icon-trash"></i> Delete
                                    </a>
                                </div>
                            </div>
                        <?php 
                            } 
                        } else {
                            echo '<div class="col-12 text-center p-3">No templates found.</div>';
                        }
                        ?>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- END: Content -->

<?php include 'footer.php'; ?>

<!-- AUTO HIDE SUCCESS MESSAGE -->
<script>
setTimeout(() => {
    const alertBox = document.querySelector('.alert');
    if (alertBox) {
        alertBox.style.transition = "opacity 0.5s ease";
        alertBox.style.opacity = 0;
        setTimeout(() => alertBox.remove(), 500);
    }
}, 4000);
</script>