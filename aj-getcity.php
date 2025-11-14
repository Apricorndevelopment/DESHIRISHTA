<?php
include 'config.php';

$state = $_POST['state'];

$sql = "select * from city_state where state = '$state'";
$result = mysqli_query($con,$sql);
?>
<label class="lb">City</label>
<span class="iconbox">
    <select class="form-select chosen-select" name="city" id="city">
        <option value="">Select</option>
    <?php
    while($row = mysqli_fetch_assoc($result))
    {
    ?>
      <option><?php echo $row['city']; ?></option>
    <?php    
    }
    ?>
    </select>
    <i class="fa fa-edit icon"></i>
</span>