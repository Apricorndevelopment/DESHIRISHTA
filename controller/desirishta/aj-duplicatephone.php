<?php
include 'config.php';

$phone = $_POST['phone'];

$sql = "select * from registration where phone = '$phone'";
$result = mysqli_query($con,$sql);
$count = mysqli_num_rows($result);
if($count >= '1')
{
?>
<input type="checkbox" id="phonecheck" required style="display:none;">
<p class="text-danger errorstatement"><i class="fa fa-exclamation-circle"></i>&nbsp;Already registered Phone No., try another</p>
<script>
    $("#duplicatephone").show();
    $("#phoneerror").css("display", "none");
    $('#phone').css("border", "2px solid red");
</script>
<?php
}
else
{
?>
<input type="checkbox" id="phonecheck" value="checked" required  style="display:none;">
<script>
    $('#phone').css("border", "");
</script>
<?php
}
?>

