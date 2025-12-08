<?php 
include 'header.php'; 
include 'config.php';

if(isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);
    $sql = "SELECT * FROM `dummy-profile` WHERE id='$id'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
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
                    <form class="form" action="update-dummy.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <input type="hidden" name="old_image" value="<?php echo $row['image']; ?>">
                        
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
                                <label>New Image (Optional)</label>
                                <input type="file" class="form-control" name="image">
                                <img src="../images/profiles/<?php echo $row['image']; ?>" width="100" class="mt-2">
                            </div>
                            <div class="col-12">
                                <button type="submit" name="update" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>