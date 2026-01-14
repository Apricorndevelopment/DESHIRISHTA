<?php
include 'config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/email_layout_template.php';

$userid = $_POST['userid'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];

$sqlcheck = "select * from registration where userid = '$userid'";
$resultcheck = mysqli_query($con,$sqlcheck);
$rowcheck = mysqli_fetch_assoc($resultcheck);

$previous_pass = $rowcheck['password'];
// Fetch email and name for the notification
$user_email = $rowcheck['email'];
$user_name = $rowcheck['name']; // Assuming the column name is 'name' based on your dashboard code

if($previous_pass != $password)
{
    $sql = "UPDATE `registration` SET `password`='$password' WHERE `userid`='$userid'";
    $result = mysqli_query($con,$sql);

    // --- START EMAIL NOTIFICATION LOGIC ---
    if($user_email != '') {
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
    // --- END EMAIL NOTIFICATION LOGIC ---

?>
    <form action="user-setting.php#accountdetails" method="post" id="myForm1">
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
    <form action="user-setting.php#accountdetails" method="post" id="myForm2">
        <input type="hidden" name="passtype" value="old">
    </form>
    <script> 
        document.getElementById("myForm2").submit();
    </script>
<?php
}
?>