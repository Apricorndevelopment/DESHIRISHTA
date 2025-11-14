<?php
include 'header.php';
include 'config.php';

// 1. Check ID
if(!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<p>Invalid ID.</p>"; exit();
}
$id = mysqli_real_escape_string($con, $_GET['id']);

// 2. Data Fetch
$sql = "SELECT * FROM tbl_testimonials WHERE id = '$id'";
$result = mysqli_query($con, $sql);
if(mysqli_num_rows($result) == 0) {
    echo "<p>No testimonial found.</p>"; exit();
}
$row = mysqli_fetch_assoc($result);
?>

    <div class="app-content content ">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Edit Testimonial</h2>
                </div>
            </div>
            <div class="content-body">
                <section id="multiple-column-form">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header"><h4 class="card-title">Edit Testimonial Details</h4></div>
                                <div class="card-body">
                                    <form class="form" action="update-testimonial.php" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <input type="hidden" name="old_image" value="<?php echo $row['user_image']; ?>">

                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label>User Name</label>
                                                    <input type="text" class="form-control" name="user_name" value="<?php echo htmlspecialchars($row['user_name']); ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label>Designation</label>
                                                    <input type="text" class="form-control" name="user_designation" value="<?php echo htmlspecialchars($row['user_designation']); ?>">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Testimonial Content</label>
                                                    <textarea class="form-control" name="content" rows="4"><?php echo htmlspecialchars($row['content']); ?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label>Change Image (Optional)</label>
                                                    <input type="file" class="form-control" name="image">
                                                    <img src="../images/profiles/<?php echo $row['user_image']; ?>" alt="Current" style="width: 70px; height: 70px; border-radius: 50%; margin-top: 10px;">
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-12">
                                                <div class="form-group">
                                                    <label>Rating (1 to 5)</label>
                                                    <select class="form-control" name="rating">
                                                        <option value="5" <?php if($row['rating'] == 5) echo 'selected'; ?>>5 Stars</option>
                                                        <option value="4" <?php if($row['rating'] == 4) echo 'selected'; ?>>4 Stars</option>
                                                        <option value="3" <?php if($row['rating'] == 3) echo 'selected'; ?>>3 Stars</option>
                                                        <option value="2" <?php if($row['rating'] == 2) echo 'selected'; ?>>2 Stars</option>
                                                        <option value="1" <?php if($row['rating'] == 1) echo 'selected'; ?>>1 Star</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-12">
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <select class="form-control" name="status">
                                                        <option value="Active" <?php if($row['status'] == 'Active') echo 'selected'; ?>>Active</option>
                                                        <option value="Inactive" <?php if($row['status'] == 'Inactive') echo 'selected'; ?>>Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="col-12 text-center mt-2 mb-2">
                                                <button type="submit" name="submit" class="btn btn-primary">Update Testimonial</button>
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