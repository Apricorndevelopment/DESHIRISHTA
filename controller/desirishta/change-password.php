<?php
include 'config.php';

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
        $mailContent = "
            <div style='width:100%; margin:2% auto; padding:3%; font-family: Arial, sans-serif;'>
                <div style='text-align:center'>
                    <img src='https://desi-rishta.com/images/tlogo.png' style='width:200px'>
                </div>
                <div style='width:100%; margin:0 auto'>
                    <div style='color:#000; width:90%; margin:0 auto;'>
                        <p style='font-size:15px;'>Dear $user_name,</p>
                        <p style='font-size:15px;'>This is a confirmation that your Desi Rishta Sign In password has been changed successfully. You can now access your account using the updated credentials.</p>
                        
                        <p style='font-size:15px;'>If you did not request this change or suspect unauthorized activity on your account, please contact our support team immediately at <a href='mailto:support@desi-rishta.com'>support@desi-rishta.com</a></p>
                        <br>
                        <p style='font-size:15px; margin:0px'>Thanks & Regards,</p>
                        <p style='font-size:15px; margin:0px'>Team Desi Rishta</p>
                        <p style='font-size:15px; margin:0px'>support@desi-rishta.com</p>
                    </div>
                </div>    
            </div>
        ";

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