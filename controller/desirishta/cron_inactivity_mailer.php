<?php
include 'config.php'; // Ensure DB connection

// Helper function to send email via your API
function send_custom_mail($to_email, $to_name, $subject, $body_content) {
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
          'to' => $to_email,
          'from' => 'info@noreplies.co.in',
          'from_name' => 'Desi Rishta',
          'subject' => $subject,
          'body' => $body_content,
          'token' => '74765968c67007219b197f4d9aafb4e2' // Your API Token
      ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}

// Get current date
$today = date('Y-m-d');

// --- REMINDER 1 (15 Days) ---
$sql1 = "SELECT userid, name, email FROM registration WHERE delete_status!='delete' AND DATEDIFF('$today', DATE(last_login_date)) = 15";
$res1 = mysqli_query($con, $sql1);
while($row = mysqli_fetch_assoc($res1)) {
    $msg = "Dear " . $row['name'] . ",<br><br>We noticed that you haven’t signed in to your Desi Rishta account for the past 15 days... <br><a href='https://desi-rishta.com/login.php'>Sign In Now</a>";
    send_custom_mail($row['email'], $row['name'], "Reminder 1: We Miss You on Desi Rishta", $msg);
}

// --- REMINDER 2 (21 Days) ---
$sql2 = "SELECT userid, name, email FROM registration WHERE delete_status!='delete' AND DATEDIFF('$today', DATE(last_login_date)) = 21";
$res2 = mysqli_query($con, $sql2);
while($row = mysqli_fetch_assoc($res2)) {
    $msg = "Dear " . $row['name'] . ",<br><br>We noticed that you haven’t signed in to your Desi Rishta account for the past 21 days... <br><a href='https://desi-rishta.com/login.php'>Sign In Now</a>";
    send_custom_mail($row['email'], $row['name'], "Reminder 2: We Miss You on Desi Rishta", $msg);
}

// --- REMINDER 3 (28 Days) ---
$sql3 = "SELECT userid, name, email FROM registration WHERE delete_status!='delete' AND DATEDIFF('$today', DATE(last_login_date)) = 28";
$res3 = mysqli_query($con, $sql3);
while($row = mysqli_fetch_assoc($res3)) {
    $msg = "Dear " . $row['name'] . ",<br><br>It's been 28 days. Please sign in within 2 days to avoid deactivation. <br><a href='https://desi-rishta.com/login.php'>Sign In Now</a>";
    send_custom_mail($row['email'], $row['name'], "Reminder 3: Action Required", $msg);
}

// --- REMINDER 4 (29 Days) ---
$sql4 = "SELECT userid, name, email FROM registration WHERE delete_status!='delete' AND DATEDIFF('$today', DATE(last_login_date)) = 29";
$res4 = mysqli_query($con, $sql4);
while($row = mysqli_fetch_assoc($res4)) {
    $msg = "Dear " . $row['name'] . ",<br><br>Last chance! Your account will be deactivated tomorrow if you do not sign in. <br><a href='https://desi-rishta.com/login.php'>Sign In Now</a>";
    send_custom_mail($row['email'], $row['name'], "Reminder 4: Final Notice", $msg);
}

// --- DEACTIVATION (30 Days) ---
$sql5 = "SELECT userid, name, email FROM registration WHERE delete_status!='delete' AND DATEDIFF('$today', DATE(last_login_date)) = 30";
$res5 = mysqli_query($con, $sql5);
while($row = mysqli_fetch_assoc($res5)) {
    $uid = $row['userid'];
    
    // Deactivate User
    mysqli_query($con, "UPDATE registration SET delete_status='deactive' WHERE userid='$uid'");
    
    $msg = "Dear " . $row['name'] . ",<br><br>Your account has been deactivated due to 30 days of inactivity. Contact support to reactivate.";
    send_custom_mail($row['email'], $row['name'], "Account Deactivation Notification", $msg);
}

echo "Inactivity Check Complete.";
?>