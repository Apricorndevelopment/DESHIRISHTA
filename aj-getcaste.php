<?php
include 'config.php';

$religion = $_POST['religion'];

$sql = "select * from religion_caste where religion = '$religion'";
$result = mysqli_query($con,$sql);
?>
<label class="lb">Caste </label>
<span class="iconbox">
    <select class="form-select chosen-select" name="caste" id="caste11">
    <?php
    while($row = mysqli_fetch_assoc($result))
    {
    ?>
      <option><?php echo $row['caste']; ?></option>
    <?php    
    }
    ?>
    </select>
    <i class="fa fa-list icon"></i>
</span>
