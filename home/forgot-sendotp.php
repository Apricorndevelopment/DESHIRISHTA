<?php
include 'config.php';

if($_GET['phone'] != '')
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

if($_GET['email'] != '')
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
    $sqlphblock = "select * from block_otp where phone = '$phone'";
    $resultphblock = mysqli_query($con,$sqlphblock);
    $checkphblock = mysqli_num_rows($resultphblock);
    
    if($checkphblock >= 1)
    {
    ?>
        <form action="forgot-verifyotp.php" method="post" id="myForm1">
            <input type="hidden" name="validphone" value="<?php echo $phone; ?>">
            <input type="hidden" name="attempt" value="<?php echo "-1"; ?>">
        </form>
        <script>
            document.getElementById("myForm1").submit();
        </script>
    <?php
    }
    else
    {
        $msgphone = '91'.$_POST['phone'];
        
        setcookie("forgot_dr_phone", $phone, time() + (10 * 365 * 24 * 60 * 60));
        
        $otp = rand(0000,9999);
        
        $sqlcheck = "select * from registration where phone = '$phone'";
        $rowcheck = mysqli_query($con,$sqlcheck);
        echo $check = mysqli_num_rows($rowcheck);
        
        if($check == '1')
        {
            $sql = "INSERT INTO `forgot_otp`(`number`, `otp`) VALUES ('$phone', '$otp')";
            $result = mysqli_query($con,$sql);
            
            $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'http://sms.primeclick.in/api/mt/SendSMS?user=Skdgtech&password=Skdg%40123&senderid=SKDGTE&channel=trans&DCS=0&flashsms=0&number='.$phone.'&text=Dear%20User%2C%20Your%20one%20time%20authentication%20is%20'.$otp.'%2C%20Regards%20SKDG%20Websoft%20Technologies%20(OPC)%20Pvt.%20Ltd.&route=15&DLTTemplateId=1707169572357217271&PEID=1701169547177152621',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        //echo $response;
        //header('location:forgot-verifyotp.php');
        ?>
            <form action="forgot-verifyotp.php" method="post" id="myForm2">
                <input type="hidden" name="validphone" value="<?php echo $phone; ?>">
                <input type="hidden" name="attempt" value="<?php if($phattempt != '') { echo $phattempt; } else { echo "2"; } ?>">
            </form>
            <script>
                document.getElementById("myForm2").submit();
            </script>
        <?php
        }
        else
        {
        ?>
            <form action="forgot-password.php" method="post" id="myForm3">
                <input type="hidden" name="user" value="not-exist">
            </form>
            <script>
                document.getElementById("myForm3").submit();
            </script>
        <?php
        }
    }
}


if($email != '')
{
    $sqlemblock = "select * from block_otp where email = '$email'";
    $resultemblock = mysqli_query($con,$sqlemblock);
    $checkemblock = mysqli_num_rows($resultemblock);
    
    if($checkemblock >= 1)
    {
    ?>
        <form action="forgot-verifyotp.php" method="post" id="myForm4">
            <input type="hidden" name="validemail" value="<?php echo $email; ?>">
            <input type="hidden" name="attempt" value="<?php echo "-1"; ?>">
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