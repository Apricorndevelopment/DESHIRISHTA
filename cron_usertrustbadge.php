<?php
include 'config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/email_layout_template.php';

$sqdate_default_timezone_set('Asia/Kolkata');

// 1. ACCOUNT DEACTIVATION LOGIC (More than 7 days old + No Verification)
// We assume 'status' column handles activation. If 'delete_status' is used, change 'status' to 'delete_status' = 'inactive'
$seven_days_ago = date('Y-m-d', strtotime('-7 days'));

$sql_deactivate = "SELECT * FROM registration 
                   WHERE verificationinfo != 'Done' 
                   AND verificationinfo != 'Pending' 
                   AND entrydate < '$seven_days_ago' 
                   AND status = 'Active'"; 

$result_deactivate = mysqli_query($con, $sql_deactivate);

while($row = mysqli_fetch_assoc($result_deactivate)) {
    $userid = $row['userid'];
    $email = $row['email'];
    $fullname = $row['name'];

    // Deactivate User
    mysqli_query($con, "UPDATE registration SET status='Inactive' WHERE userid='$userid'");

    // Send Deactivation Email
    $subject = "Account deactivation due to missing government ID details";
    $customHtml = "
  <p style='font-size:15px;'>Dear $fullname,</p>
                    <p style='font-size:15px;'>We noticed that you have not uploaded your government ID since registration. As a result, your account has been deactivated.</p>
                    <p style='font-size:15px;'>To reactivate your account, please upload your government ID at your earliest convenience. Once verified, your account will be automatically activated by our Desi Rishta Team. If you need any assistance, feel free to contact us at support@desi-rishta.com.</p>
                    <p style='font-size:15px;'>Thank you for your prompt attention.</p>
";
    $mailContent = getEmailLayout($customHtml);

    send_mail_cron($email, $subject, $mailContent);
    echo "Deactivated: $email <br>";
}


// 2. REMINDER LOGIC (Less than or equal to 7 days old + No Verification)
$sql_remind = "SELECT * FROM registration 
               WHERE verificationinfo != 'Done' 
               AND verificationinfo != 'Pending' 
               AND entrydate >= '$seven_days_ago' 
               AND status = 'Active'";

$result_remind = mysqli_query($con, $sql_remind);

while($row = mysqli_fetch_assoc($result_remind)) {
    $email = $row['email'];
    $fullname = $row['name'];

    $subject = "Complete Your Verification to Earn Your Trust Badge";
    $mailContent = "
        <div style='width:90%; margin:2% auto; padding:3%;'>
            <div style='text-align:center'>
                <img src='http://myptetest.com/desirishta/images/tlogo.png' style='width:50%'>
            </div>
            <div style='width:100%; margin:0 auto'>
                <div style='color:#000; width:90%; margin:0 auto;'>
                    <p style='font-size:15px;'>Dear $fullname,</p>
                    <p style='font-size:15px;'>We have noticed that you have not completed your verification yet. Please complete the process to earn your trust badge.</p>
                    <p style='font-size:15px;'>The trust badge enhances your credibility on our platform and signifies your commitment to authenticity. We look forward to seeing your profile marked as verified.</p>
                    <p style='font-size:15px;'>Kindly complete the verification process within 7 days from the date of registration to avoid getting the account deactivated.</p>
                    <br>
                    <p style='font-size:15px; margin:0px'>Thanks & Regards,<br>Team Desi Rishta<br>support@desi-rishta.com</p>
                </div>
            </div>    
        </div>";

    send_mail_cron($email, $subject, $mailContent);
    echo "Reminder sent: $email <br>";
}

// Helper function to send mail
function send_mail_cron($to, $subject, $body) {
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
          'to' => $to,
          'from' => 'info@noreplies.co.in',
          'from_name' => 'Desi Rishta',
          'subject' => $subject,
          'body' => $body,
          'token' => '74765968c67007219b197f4d9aafb4e2'
      ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}
?>