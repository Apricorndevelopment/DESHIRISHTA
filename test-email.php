<?php
// desirishta/test-email.php

if(isset($_POST['send_test'])) {
    $to_email = $_POST['email'];
    $subject = "Test Email from Desi Rishta";
    $fullname = "Admin Testing";
    
    // Email Body (Same style as your project)
    $mailContent = "
    <div style='width:90%; margin:2% auto; padding:3%; font-family: Arial, sans-serif; border:1px solid #ddd;'>
        <div style='text-align:center'>
            <h2>Desi Rishta Mail Test</h2>
        </div>
        <div style='width:100%; margin:20px auto'>
            <div style='color:#333; width:95%; margin:0 auto;'>
                <p>Dear $fullname,</p>
                <p>This is a test email to verify that your email integration is working correctly.</p>
                <p>Agar aapko ye email mila hai, iska matlab aapka email system <b>SUCCESSFULLY</b> kaam kar raha hai.</p>
                <br>
                <p style='margin:0px'>Thanks & Regards,</p>
                <p style='margin:0px'><b>Team Desi Rishta</b></p>
            </div>
        </div>    
    </div>
    ";

    // Curl Logic (Copied from your profile-photos.php)
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
            'body' => $mailContent, 
            'token' => '74765968c67007219b197f4d9aafb4e2' // Aapka token
        ),
    ));
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
        echo "<div style='color:red; font-weight:bold;'>cURL Error #: " . $err . "</div>";
    } else {
        echo "<div style='color:green; font-weight:bold;'>API Response: " . $response . "</div>";
        echo "<p>Agar response mein 'success' ya 'queued' likha hai, toh inbox check karein.</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Test Email Functionality</title>
</head>
<body style="font-family: sans-serif; padding: 50px;">
    <h2>Email Testing Tool</h2>
    <form method="post">
        <label>Enter Recipient Email (Jisko mail bhejna hai):</label><br><br>
        <input type="email" name="email" required placeholder="example@gmail.com" style="padding: 10px; width: 300px;">
        <br><br>
        <button type="submit" name="send_test" style="padding: 10px 20px; background: maroon; color: #fff; border: none; cursor: pointer;">Send Test Email</button>
    </form>
</body>
</html>