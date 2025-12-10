<?php
ob_start();
include 'config.php';

echo $phone = $_POST['phone'];
$email = $_POST['email'];
echo $otp = $_POST['otp'];

if($phone != '')
{
    $sqlcheck = "select * from forgot_otp where number = '$phone' and otp = '$otp' and status = '0'";
    $resultcheck = mysqli_query($con,$sqlcheck);
    $check = mysqli_num_rows($resultcheck);
    
    if($check >= '1')
    {
        $sqlupdate = "UPDATE `forgot_otp` SET `status`='1' WHERE `number`='$phone' and `otp`='$otp'";
        $resultupdate = mysqli_query($con,$sqlupdate);
        
    ?>
        <form action="forgot-newpassword.php" method="post" id="myForm1">
            <input type="hidden" name="validphone" value="<?php echo $phone; ?>">
        </form>
        <script> 
            document.getElementById("myForm1").submit();
        </script>
    <?php
    }
    else
    {
    ?>
    <form action="forgot-verifyotp.php" method="post" id="myForm2">
        <input type="hidden" name="validphone" value="<?php echo $phone; ?>">
        <input type="hidden" name="invalid" value="false">
    </form>
    <script> 
        document.getElementById("myForm2").submit();
    </script>
    <?php
    }
}

if($email != '')
{
    $sqlcheck1 = "select * from forgot_otp where email = '$email' and otp = '$otp' and status = '0'";
    $resultcheck1 = mysqli_query($con,$sqlcheck1);
    $check1 = mysqli_num_rows($resultcheck1);
    
    if($check1 >= '1')
    {
        $sqlupdate1 = "UPDATE `forgot_otp` SET `status`='1' WHERE `email`='$email' and `otp`='$otp'";
        $resultupdate1 = mysqli_query($con,$sqlupdate1);
    
    ?>    
        <form action="forgot-newpassword.php" method="post" id="myForm3">
            <input type="hidden" name="validemail" value="<?php echo $email; ?>">
        </form>
        <script> 
            document.getElementById("myForm3").submit();
        </script>
    
    <?php
    }
    else
    {
    ?>
    <form action="forgot-verifyotp.php" method="post" id="myForm4">
        <input type="hidden" name="validemail" value="<?php echo $email; ?>">
        <input type="hidden" name="invalid" value="false">
    </form>
    <script> 
        document.getElementById("myForm4").submit();
    </script>
    <?php
    }
}
?>