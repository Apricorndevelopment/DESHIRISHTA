<?php
include 'config.php';

$phone_num = $_POST['phone_num'];
$otp_val = $_POST['otp_val'];

$sqlcheckotp = "select * from mobile_otp where mobile = '$phone_num' and otp = '$otp_val' and status = '0'";
$resultcheckotp = mysqli_query($con,$sqlcheckotp);
$countcheckotp = mysqli_num_rows($resultcheckotp);

if($countcheckotp == 0)
{
?>
    <p class="text-danger text-center invalid w-50" id="invalidpop"><i class="fa fa-exclamation-circle"></i>&nbsp;Invalid OTP</p>
<?php
}
else
{
    $sqlupdate = "UPDATE `mobile_otp` SET `status`='1' WHERE `mobile`='$phone_num' and `otp`='$otp_val'";
    $resultupdate = mysqli_query($con,$sqlupdate);
?>
    <script>
        $('#registration').hide();
        $('#mobileverify').hide();
        $('#basicinfo').show();
        $('#astrodetails').hide();
        $('#religiousbackground').hide();
        $('#educationcareer').hide();
        $('#familydetails').hide();
        $('#groomlocation').hide();
        $('#aboutme').hide();
        $('#profilepic').hide();
    </script>
<?php
}
?>