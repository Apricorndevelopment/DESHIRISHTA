<?php 
include 'header.php'; 
include 'config.php'; 
$id = $_GET['id'];

if(isset($_POST['update_plan'])) {
    $name = mysqli_real_escape_string($con, $_POST['plan_name']);
    $btn = mysqli_real_escape_string($con, $_POST['button_text']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    $details = mysqli_real_escape_string($con, $_POST['details']);
    $contacts = $_POST['contacts_per_day'];
    $validity = $_POST['validity_days'];

    $sql = "UPDATE tbl_plans SET plan_name='$name', button_text='$btn', price='$price', details='$details', contacts_per_day='$contacts', validity_days='$validity' WHERE id='$id'";
    // if(mysqli_query($con, $sql)) {
    //     echo "<script>alert('Plan Updated Successfully'); window.location.href='manage-plans.php';</script>";
    // }
    if (mysqli_query($con, $sql)) {

    // ⚠️ EXTEND EXISTING USERS EXPIRY
    mysqli_query($con, "
        UPDATE registration
        SET plan_expiry_date = DATE_ADD(plan_start_date, INTERVAL $validity DAY)
        WHERE plan_id = '$id'
          AND plan_start_date IS NOT NULL
    ");

    echo "<script>alert('Plan Updated & User Expiry Extended'); window.location.href='manage-plans.php';</script>";
}

}

$row = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tbl_plans WHERE id='$id'"));
?>
<div class="app-content content">
    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <form method="post">
                    <div class="form-group">
                        <label>Subscription Name</label>
                        <input type="text" name="plan_name" class="form-control" value="<?php echo $row['plan_name']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Button Text</label>
                        <input type="text" name="button_text" class="form-control" value="<?php echo $row['button_text']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input type="text" name="price" class="form-control" value="<?php echo $row['price']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Details</label>
                        <textarea name="details" class="form-control" rows="4"><?php echo $row['details']; ?></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Contacts Per Day</label>
                            <input type="number" name="contacts_per_day" class="form-control" value="<?php echo $row['contacts_per_day']; ?>">
                        </div>
                        <div class="col-md-6">
                            <label>Validity (Days)</label>
                            <input type="number" name="validity_days" class="form-control" value="<?php echo $row['validity_days']; ?>">
                        </div>
                    </div>
                    <br>
                    <button type="submit" name="update_plan" class="btn btn-success">Update Plan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>