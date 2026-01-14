<?php
include 'config.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/email_layout_template.php';


$phone = $_POST['phone'];
$email = $_POST['email'];
$newpass = $_POST['newpass'];

// Function to send password change email
function sendPasswordChangeEmail($user_email, $user_name) {
    if($user_email == '') return;
    
    $subject = "Desi Rishta Sign In Password changed successfully";
    $customHtml = "
   <p style='font-size:15px;'>Dear $user_name,</p>
                    <p style='font-size:15px;'>This is a confirmation that your Desi Rishta Sign In password has been changed successfully. You can now access your account using the updated credentials.</p>
                    
                    <p style='font-size:15px;'>If you did not request this change or suspect unauthorized activity on your account, please contact our support team immediately at <a href='mailto:support@desi-rishta.com'>support@desi-rishta.com</a></p>
";
    $mailContent = getEmailLayout($customHtml);

    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://app.smtpprovider.com/api/send-mail/',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => array(
          'to' => $user_email,
          'from' => 'info@noreplies.co.in',
          'from_name' => 'Desi Rishta',
          'subject' => $subject,
          'body' => $mailContent,
          'token' => '74765968c67007219b197f4d9aafb4e2'
      ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
}

if($phone != '')
{
    $sqlcheck1 = "select * from registration where phone = '$phone'";
    $resultcheck1 = mysqli_query($con,$sqlcheck1);
    $rowcheck1 = mysqli_fetch_assoc($resultcheck1);

    echo $previous_pass1 = $rowcheck1['password'];
    
    // Fetch data for email
    $user_email_from_phone = $rowcheck1['email'];
    $user_name_from_phone = $rowcheck1['name'];
    
    if($previous_pass1 != $newpass)
    {
        echo $sql1 = "UPDATE `registration` SET `password`='$newpass' WHERE `phone`='$phone'";
        $result1 = mysqli_query($con,$sql1);
        
        // Send Email
        sendPasswordChangeEmail($user_email_from_phone, $user_name_from_phone);
    ?>
        <form action="forgotpassword-update.php" method="post" id="myForm1">
            <input type="hidden" name="passtype" value="new">
        </form>
        <script>
            document.getElementById("myForm1").submit();
        </script>
    <?php
    }
    else
    {
    ?>
        <form action="forgot-newpassword.php" method="post" id="myForm2">
            <input type="hidden" name="passtype" value="old">
            <input type="hidden" name="validphone" value="<?php echo $phone; ?>">
        </form>
        <script>
            document.getElementById("myForm2").submit();
        </script>
    <?php
    }
}

if($email != '')
{
    $sqlcheck2 = "select * from registration where email = '$email'";
    $resultcheck2 = mysqli_query($con,$sqlcheck2);
    $rowcheck2 = mysqli_fetch_assoc($resultcheck2);

    $previous_pass2 = $rowcheck2['password'];
    // Fetch name
    $user_name_from_email = $rowcheck2['name'];
    
    if($previous_pass2 != $newpass)
    {
        $sql2 = "UPDATE `registration` SET `password`='$newpass' WHERE `email`='$email'";
        $result2 = mysqli_query($con,$sql2);
        
        // Send Email (we already have $email variable here)
        sendPasswordChangeEmail($email, $user_name_from_email);
    ?>
        <form action="forgotpassword-update.php" method="post" id="myForm3">
            <input type="hidden" name="passtype" value="new">
        </form>
        <script>
            document.getElementById("myForm3").submit();
        </script>
    <?php
    }
    else
    {
    ?>
        <form action="forgot-newpassword.php" method="post" id="myForm4">
            <input type="hidden" name="passtype" value="old">
            <input type="hidden" name="validemail" value="<?php echo $email; ?>">
        </form>
        <script>
            document.getElementById("myForm4").submit();
        </script>
    <?php
    }
}
?>