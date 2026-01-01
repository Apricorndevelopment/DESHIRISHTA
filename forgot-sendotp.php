<?php
include 'config.php';

// --- Masking Logic Start ---
$display_message = '';

if(isset($_GET['phone']) && $_GET['phone'] != '')
{
    $phone = $_GET['phone'];
    $phattempt = ($_GET['attempt'] - 1);
    
    $phdate = date('d-m-Y');
    
    if($phattempt == '-1')
    {
        $sqlphinsert = "INSERT INTO `block_otp`(`phone`, `date`) VALUES ('$phone', '$phdate')";
        $resultphinsert = mysqli_query($con,$sqlphinsert);

    }    
}
else
{
    $phone = $_POST['phone'];
}

if(isset($_GET['email']) && $_GET['email'] != '')
{
    $email = $_GET['email'];
    $emattempt = ($_GET['attempt'] - 1);
    
    $emdate = date('d-m-Y');
    
    if($emattempt == '-1')
    {
        $sqleminsert = "INSERT INTO `block_otp`(`email`, `date`) VALUES ('$email', '$emdate')";
        $resulteminsert = mysqli_query($con,$sqleminsert);

    }    
}
else
{
    $email = $_POST['email'];
}


if($phone != '')
{
    // Masking: Show last 4 digits
    $masked_phone = str_repeat('X', strlen($phone) - 4) . substr($phone, -4);
    $display_message = "Aapke number $masked_phone par ek OTP bheja gaya hai.";
    
    $sqlphblock = "select * from block_otp where phone = '$phone'";
    $resultphblock = mysqli_query($con,$sqlphblock);
    $checkphblock = mysqli_num_rows($resultphblock);
    
    if($checkphblock >= 1)
    {
    ?>
        <form action="forgot-verifyotp.php" method="post" id="myForm1">
            <input type="hidden" name="validphone" value="<?php echo $phone; ?>">
            <input type="hidden" name="attempt" value="<?php echo "-1"; ?>">
            <input type="hidden" name="display_contact" value="<?php echo $masked_phone; ?>">
        </form>
        <script>
            document.getElementById("myForm1").submit();
        </script>
    <?php
    }
   
    else {
    $phone = trim($_POST['phone'] ?? ''); // Make sure $phone is defined
    $msgphone = '91' . $phone;
    
    // Cookie set karein
    setcookie("forgot_dr_phone", $phone, time() + (10 * 365 * 24 * 60 * 60));
    
    // OTP Generate karein (4 digit)
    $otp = rand(1000, 9999);
    
    // 1. Check karein ki user exist karta hai ya nahi (Prepared Statement use karein)
    $stmt_check = mysqli_prepare($con, "SELECT id FROM registration WHERE phone = ?");
    mysqli_stmt_bind_param($stmt_check, "s", $phone);
    mysqli_stmt_execute($stmt_check);
    mysqli_stmt_store_result($stmt_check);
    $check = mysqli_stmt_num_rows($stmt_check);
    
    if($check == 1) {
        // 2. OTP Database mein save karein
        $stmt_ins = mysqli_prepare($con, "INSERT INTO `forgot_otp` (`number`, `otp`) VALUES (?, ?)");
        mysqli_stmt_bind_param($stmt_ins, "si", $phone, $otp);
        mysqli_stmt_execute($stmt_ins);

        
        $message = "Dear Customer, Your Desi Rishta Forgot Password PIN is {$otp}. It is valid for 10 minutes and is confidential. Please do not share it with anyone.";

        $payload = [
            "listsms" => [
                [
                    "sms"        => $message,
                    "mobiles"    => $phone,
                    "senderid"   => "DSIRST",
                    "tempid"     => "1207176681254116168",
                    "responsein" => "json"
                ]
            ],
            "user"     => "desirsms",
            "password" => "30c3c138b0XX" 
        ];

        $jsonPayload = json_encode($payload);

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL            => "https://www.proactivesms.in/REST/sendsms",
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $jsonPayload,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER     => ["Content-Type: application/json"]
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        // Auto-submit form to verify page
        ?>
        <form action="forgot-verifyotp.php" method="post" id="myForm2">
            <input type="hidden" name="validphone" value="<?php echo $phone; ?>">
            <input type="hidden" name="attempt" value="<?php echo ($phattempt ?? "2"); ?>">
            <input type="hidden" name="display_contact" value="<?php echo ($masked_phone ?? $phone); ?>">
        </form>
        <script>document.getElementById("myForm2").submit();</script>
        <?php
    } 
    else {
        // User exist nahi karta
        ?>
        <form action="forgot-password.php" method="post" id="myForm3">
            <input type="hidden" name="user" value="not-exist">
        </form>
        <script>document.getElementById("myForm3").submit();</script>
        <?php
    }
}
}


if($email != '')
{
    // Masking: ex*****@gmail.com
    list($username, $domain) = explode('@', $email);
    $masked_email = substr($username, 0, 2) . '*****@' . $domain;
    
    $sqlemblock = "select * from block_otp where email = '$email'";
    $resultemblock = mysqli_query($con,$sqlemblock);
    $checkemblock = mysqli_num_rows($resultemblock);
    
    if($checkemblock >= 1)
    {
    ?>
        <form action="forgot-verifyotp.php" method="post" id="myForm4">
            <input type="hidden" name="validemail" value="<?php echo $email; ?>">
            <input type="hidden" name="attempt" value="<?php echo "-1"; ?>">
            <input type="hidden" name="display_contact" value="<?php echo $masked_email; ?>">
        </form>
        <script>
            document.getElementById("myForm4").submit();
        </script>
    <?php
    }
    else
    {
            setcookie("dr_email", $email, time() + (10 * 365 * 24 * 60 * 60));
        
            $otp1 = rand(0000,9999);
            
            $sqlcheck1 = "select * from registration where email = '$email'";
            $resultcheck1 = mysqli_query($con,$sqlcheck1);
            $rowcheck1 = mysqli_fetch_assoc($resultcheck1);
            $check1 = mysqli_num_rows($resultcheck1);
            
            if($check1 == '1')
            {
                $sql1 = "INSERT INTO `forgot_otp`(`email`, `otp`) VALUES ('$email', '$otp1')";
                $result1 = mysqli_query($con,$sql1);
                
                $name = $rowcheck1['name'];
                $to = $rowcheck1['email'];
                $subject = "Reset Password OTP";
            
                $body = "<p style='color:#000'>Dear $name,</p><p style='color:#000'>Your One Time Authentication is $otp1</p><p style='color:#000'> Thanks and regards, <br> Team Desi Rishta <br> support@desi-rishta.com</p>";
                
                $curl1 = curl_init();
            
                curl_setopt_array($curl1, array(
                  CURLOPT_URL => 'https://dashboard.smtpprovider.com/api/send-mail/',
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'POST',
                  CURLOPT_POSTFIELDS => array('to' => ''.$to.'','from' => 'info@noreply-duastro.com','from_name' => 'Desi Rishta','subject' => ''.$subject.'','body' => ''.$body.'','token' => '4b2e12b43338e42361077cb6516ad63e'),
                ));
                
                $response1 = curl_exec($curl1);
                
                curl_close($curl1);
                //echo $response1;
            ?>
                <form action="forgot-verifyotp.php" method="post" id="myForm5">
                    <input type="hidden" name="validemail" value="<?php echo $email; ?>">
                    <input type="hidden" name="attempt" value="<?php if($emattempt != '') { echo $emattempt; } else { echo "2"; } ?>">
                    <input type="hidden" name="display_contact" value="<?php echo $masked_email; ?>">
                </form>
                <script>
                    document.getElementById("myForm5").submit();
                </script>
            <?php
            }
            else
            {
            ?>
                <form action="forgot-password.php" method="post" id="myForm6">
                    <input type="hidden" name="user" value="not-exist">
                </form>
                <script>
                    document.getElementById("myForm6").submit();
                </script>
            <?php
            }
        
    }
}
?>