<?php
include 'config.php';

$domain = $_POST['domain'];

$sql = "select * from domain_designation where domain = '$domain'";
$result = mysqli_query($con,$sql);
?>
<select class="form-select chosen-select" name="designation" id="designation">
    <option value="">Select</option>
<?php
while($row = mysqli_fetch_assoc($result))
{
?>
  <option><?php echo $row['designation']; ?></option>
<?php    
}
?>
</select>
<i class="fa fa-address-card icon"></i>