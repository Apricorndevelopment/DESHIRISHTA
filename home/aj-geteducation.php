<?php
include 'config.php';

$stream = $_POST['stream'];

$sql = "select * from stream_education where stream = '$stream'";
$result = mysqli_query($con,$sql);
?>
<label class="lb">Education/Qualification</label>
<span class="iconbox">
    <select class="form-select chosen-select" name="education" id="education1">
        <option value="">Select</option>
        <?php
        while($row = mysqli_fetch_assoc($result))
        {
        ?>
          <option><?php echo $row['education']; ?></option>
        <?php    
        }
        ?>
    </select>
    <i class="fa fa-graduation-cap icon"></i>
</span>