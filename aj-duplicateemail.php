<?php
include 'config.php';

$email = $_POST['email'];

$sql = "select * from registration where email = '$email'";
$result = mysqli_query($con,$sql);
$count = mysqli_num_rows($result);
if($count >= '1')
{
?>
<input type="checkbox" id="emailcheck" required style="display:none;">
<p class="text-danger errorstatement"><i class="fa fa-exclamation-circle"></i>&nbsp;Already registered Email ID, try another</p>
<script>
    $("#duplicateemail").show();
    $("#emailerror").css("display", "none");
    $('#email').css("border", "2px solid red");
</script>
<?php
}
else
{
?>
<input type="checkbox" id="emailcheck" value="checked" checked required style="display:none;">
<script>
    $('#email').css("border", "");
</script>
<?php
}
?>