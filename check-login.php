<?php
ob_start();
include 'config.php';

date_default_timezone_set('Asia/Kolkata'); 

if($_GET['phone'] != '')
{
    $phone = $_GET['phone'];
}
else
{
    $phone =  $_POST['phone'];
}
$password = $_POST['password'];
$attempt = $_POST['attempt'];

$final_attempt = ($attempt - 1);
$blocktime = date('Y-m-d H:i:s');

$sqlselect  = "select * from registration where (phone = '$phone' or email = '$phone') and password = '$password' and otpstatus = 'active' and delete_status != 'delete'";
$resultselect = mysqli_query($con,$sqlselect);
$rowselect = mysqli_fetch_assoc($resultselect);
$check = mysqli_num_rows($resultselect);

if($check == '0')
{
    if($final_attempt == '0')
    {
        $sqlblock = "INSERT INTO `loginblock_otp`(`phone_email`, `date_time`) VALUES ('$phone','$blocktime')";
        $resultblock = mysqli_query($con,$sqlblock);
    }
    
    $sqlcheckblock = "select * from loginblock_otp where phone_email = '$phone'";
    $resultcheckblock = mysqli_query($con,$sqlcheckblock);
    $rowcheckblock = mysqli_fetch_assoc($resultcheckblock);
    $checkblock = mysqli_num_rows($resultcheckblock);
    
    if($checkblock >= 1)
    {
        $current_time = date("Y-m-d H:i:s");
        $ct = strtotime($current_time);
        $store_time = $rowcheckblock['date_time'];
        $st = strtotime($store_time);
        $add_mins = "1800";
        $block_till = $st + $add_mins;
        $bt = date('M d, Y H:i:s', $block_till);
        
        if($block_till > $ct)
        {
        ?>
            <form action="login.php" method="post" id="myForm1">
                <input type="hidden" name="credential" value="blocked">
                <input type="hidden" name="attempt" value="0">
                <input type="hidden" name="seconds_left" value="<?php echo $bt; ?>">
                <input type="hidden" name="userinput" value="<?php echo $phone; ?>">
            </form>
            <script>
                document.getElementById("myForm1").submit();
            </script>
        <?php
        }
        else
        {
            $sqldeleteblock = "delete from `loginblock_otp` where `phone_email` = '$phone'";
            $resultdeleteblock = mysqli_query($con,$sqldeleteblock);
        ?>
            <form action="login.php" method="post" id="myForm2">
                <input type="hidden" name="attempt" value="3">
            </form>
            <script>
                document.getElementById("myForm2").submit();
            </script>
        <?php
        }
    }
    else
    {
    ?>
        <form action="login.php" method="post" id="myForm3">
            <input type="hidden" name="credential" value="invalid">
            <input type="hidden" name="attempt" value="<?php echo $final_attempt; ?>">
        </form>
        <script>
            document.getElementById("myForm3").submit();
        </script>
    <?php
    }
}
else
{
    $sqlcheckblock = "select * from loginblock_otp where phone_email = '$phone'";
    $resultcheckblock = mysqli_query($con,$sqlcheckblock);
    $rowcheckblock = mysqli_fetch_assoc($resultcheckblock);
    $checkblock = mysqli_num_rows($resultcheckblock);
    
    if($checkblock >= 1)
    {
        $current_time = date("Y-m-d H:i:s");
        $ct = strtotime($current_time);
        $store_time = $rowcheckblock['date_time'];
        $st = strtotime($store_time);
        $add_mins = "1800";
        $block_till = $st + $add_mins;
        $bt = date('M d, Y H:i:s', $block_till);
        
        if($block_till > $ct)
        {
        ?>
            <form action="login.php" method="post" id="myForm4">
                <input type="hidden" name="credential" value="blocked">
                <input type="hidden" name="attempt" value="0">
                <input type="hidden" name="seconds_left" value="<?php echo $bt; ?>">
                <input type="hidden" name="userinput" value="<?php echo $phone; ?>">
            </form>
            <script>
                document.getElementById("myForm4").submit();
            </script>
        <?php
        }
        else
        {
            $sqldeleteblock = "delete from `loginblock_otp` where `phone_email` = '$phone'";
            $resultdeleteblock = mysqli_query($con,$sqldeleteblock);
        ?>
            <form action="login.php" method="post" id="myForm5">
                <input type="hidden" name="attempt" value="3">
            </form>
            <script>
                document.getElementById("myForm5").submit();
            </script>
        <?php
        }
    }
    else
    {
        $userid = $rowselect['userid'];
        setcookie("dr_userid", $userid, time() + (10 * 365 * 24 * 60 * 60));
        
        $email = $rowselect['email'];
        setcookie("dr_email", $email, time() + (10 * 365 * 24 * 60 * 60));
        
        $phone = $rowselect['phone'];
        setcookie("dr_phone", $phone, time() + (10 * 365 * 24 * 60 * 60));
        
        $fullname = $rowselect['name'];
        setcookie("dr_name", $fullname, time() + (10 * 365 * 24 * 60 * 60));
        
        $state = $rowselect['state'];
        setcookie("dr_state", $state, time() + (10 * 365 * 24 * 60 * 60));
        
        $gender = $rowselect['gender'];
        setcookie("dr_gender", $gender, time() + (10 * 365 * 24 * 60 * 60));
        
        $country = $rowselect['country'];
        setcookie("dr_country", $country, time() + (10 * 365 * 24 * 60 * 60));
        
        $city = $rowselect['city'];
        setcookie("dr_city", $city, time() + (10 * 365 * 24 * 60 * 60));
        
        $sqlonline = "UPDATE `registration` SET `online`='yes' WHERE `userid`='$userid'";
        $resultonline = mysqli_query($con,$sqlonline);
        
         header('location:user-dashboard.php');
    }
}
?>