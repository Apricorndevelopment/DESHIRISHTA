<?php
include 'header.php';
include 'config.php';

// 1. Check ID
if(!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<p>Invalid ID.</p>"; exit();
}
$id = mysqli_real_escape_string($con, $_GET['id']);

// 2. Data Fetch
$sql = "SELECT * FROM tbl_team WHERE id = '$id'";
$result = mysqli_query($con, $sql);
if(mysqli_num_rows($result) == 0) {
    echo "<p>No member found.</p>"; exit();
}
$row = mysqli_fetch_assoc($result);
?>

    <div class="app-content content ">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Edit Team Member</h2>
                </div>
            </div>
            <div class="content-body">
                <section id="multiple-column-form">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header"><h4 class="card-title">Edit Member Details</h4></div>
                                <div class="card-body">
                                    <form class="form" action="update-team.php" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <input type="hidden" name="old_image" value="<?php echo $row['image']; ?>">

                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label>Full Name</label>
                                                    <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label>Designation</label>
                                                    <input type="text" class="form-control" name="designation" value="<?php echo htmlspecialchars($row['designation']); ?>">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Change Image (Optional)</label>
                                                    <input type="file" class="form-control" name="image">
                                                    <img src="../images/profiles/<?php echo $row['image']; ?>" alt="Current" style="width: 100px; margin-top: 10px;">
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="col-12"><h5 class="mt-2">Social Links (Optional)</h5></div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label>Facebook URL</label>
                                                    <input type="text" class="form-control" name="facebook" value="<?php echo htmlspecialchars($row['facebook']); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label>Twitter URL</label>
                                                    <input type="text" class="form-control" name="twitter" value="<?php echo htmlspecialchars($row['twitter']); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label>WhatsApp Number</label>
                                                    <input type="text" class="form-control" name="whatsapp" value="<?php echo htmlspecialchars($row['whatsapp']); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label>LinkedIn URL</label>
                                                    <input type="text" class="form-control" name="linkedin" value="<?php echo htmlspecialchars($row['linkedin']); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label>Instagram URL</label>
                                                    <input type="text" class="form-control" name="instagram" value="<?php echo htmlspecialchars($row['instagram']); ?>">
                                                </div>
                                            </div>
                                            
                                            <div class="col-12 text-center mt-2 mb-2">
                                                <button type="submit" name="submit" class="btn btn-primary">Update Member</button>
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