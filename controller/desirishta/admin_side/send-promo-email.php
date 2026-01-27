<?php
set_time_limit(0); // Unlimited execution time to handle bulk emails
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../config.php'; // Database Connection

// --- CONFIGURATION ---
$site_url = "https://yourwebsite.com"; // UPDATE THIS: Your actual website URL
$logo_url = "https://yourwebsite.com/assets/images/logo.png"; // UPDATE THIS: Path to your logo
$api_token = '74765968c67007219b197f4d9aafb4e2'; 
$api_endpoint = 'https://app.smtpprovider.com/api/send-mail/';
$sender_email = 'info@noreplies.co.in';
$sender_name  = 'Desi Rishta';

// --- DEBUG UI CSS ---
echo '<style>
    body { font-family: "Courier New", monospace; background: #f4f4f4; color: #333; padding: 20px; }
    h3 { border-bottom: 2px solid #ccc; padding-bottom: 10px; }
    .log-box { background: #fff; padding: 15px; border: 1px solid #ddd; height: 500px; overflow-y: scroll; margin-top: 20px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
    .log-entry { border-bottom: 1px solid #eee; padding: 5px 0; font-size: 13px; }
    .success { color: green; font-weight:bold; }
    .error { color: red; font-weight:bold; }
    .info { color: blue; }
    .btn { display: inline-block; padding: 10px 20px; background: #007bff; color: white; text-decoration: none; border-radius: 4px; margin-top: 20px; }
    .btn:hover { background: #0056b3; }
</style>';

// 1. VALIDATION
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("<h3 class='error'>Error: Missing communication ID.</h3>");
}

$communication_id = (int)$_GET['id'];
$admin_page = 'create-communication.php'; 

// 2. FETCH COMMUNICATION DETAILS
$sql_comm = "SELECT target_scope, target_users, subject, body_content FROM admin_communication WHERE id = '$communication_id' AND type = 'email'";
$result_comm = mysqli_query($con, $sql_comm);

if (mysqli_num_rows($result_comm) == 0) {
    die("<h3 class='error'>Error: Communication record not found.</h3>");
}

$comm_data = mysqli_fetch_assoc($result_comm);
$target_scope = $comm_data['target_scope'];
$target_users_raw = $comm_data['target_users'];
$email_subject = $comm_data['subject'];
$email_body = $comm_data['body_content']; // This is the content from your Admin Panel (CKEditor/Textarea)

echo "<h3>Sending Promo Email (Desi Rishta Style)...</h3>";
echo "<p><strong>Subject:</strong> $email_subject</p>";

// 3. DETERMINE RECIPIENTS
$emails = [];
$user_sql_condition = "WHERE delete_status != 'delete' AND firstapprove = '1'";

if ($target_scope == 'all') {
    $sql = "SELECT email, name FROM registration $user_sql_condition";
} elseif ($target_scope == 'specific' && !empty($target_users_raw)) {
    $user_ids_array = explode(',', $target_users_raw);
    $safe_user_ids = array_map(function($id) use ($con) {
        return "'" . mysqli_real_escape_string($con, trim($id)) . "'";
    }, $user_ids_array);
    $user_id_list = implode(',', $safe_user_ids);
    $sql = "SELECT email, name FROM registration $user_sql_condition AND userid IN ($user_id_list)";
} else {
    die("<h3 class='error'>Error: No recipients found based on scope.</h3>");
}

$result_emails = mysqli_query($con, $sql);
while ($row = mysqli_fetch_assoc($result_emails)) {
    if (!empty($row['email'])) {
        $emails[] = ['email' => $row['email'], 'name' => $row['name']];
    }
}

$total_emails = count($emails);
echo "<p><strong>Total Recipients:</strong> $total_emails</p>";
echo '<div class="log-box">';

$success_count = 0;
$fail_count = 0;
$current_year = date('Y');

// 4. SEND EMAILS LOOP
if ($total_emails > 0) {
    foreach ($emails as $recipient) {
        
        $to_email = $recipient['email'];
        // Handle name safely (fallback if empty)
        $user_name = !empty($recipient['name']) ? htmlspecialchars($recipient['name']) : 'Member';
        
        // --- HTML EMAIL UI TEMPLATE START ---
        $message_ui = "
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>$email_subject</title>
            <style>
                body { margin: 0; padding: 0; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f4f4f4; }
                .email-container { max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.1); font-size: 16px; color: #333333; }
                .header { background: linear-gradient(135deg, #e91e63 0%, #d81b60 100%); padding: 30px 20px; text-align: center; }
                .header h1 { color: #ffffff; margin: 0; font-size: 26px; letter-spacing: 1px; font-weight: 700; }
                .content { padding: 40px 30px; line-height: 1.6; }
                .content p { margin-bottom: 15px; }
                .btn-primary { display: inline-block; padding: 12px 25px; background-color: #e91e63; color: #ffffff !important; text-decoration: none; border-radius: 5px; font-weight: bold; margin-top: 20px; }
                .footer { background-color: #333333; color: #bbbbbb; text-align: center; padding: 20px; font-size: 12px; }
                .footer a { color: #e91e63; text-decoration: none; }
            </style>
        </head>
        <body>
            <table width='100%' cellpadding='0' cellspacing='0' style='background-color: #f4f4f4; padding: 20px 0;'>
                <tr>
                    <td align='center'>
                        <div class='email-container'>
                            <!-- Header -->
                            <div class='header'>
                                <!-- Replace text with <img> tag if you have a logo url -->
                                <h1>Desi Rishta</h1> 
                            </div>

                            <!-- Body -->
                            <div class='content'>
                                <p style='font-size: 18px; color: #e91e63;'><strong>Namaste $user_name,</strong></p>
                                
                                <!-- Dynamic Content from Admin Panel -->
                                <div style='margin-bottom: 20px;'>
                                    $email_body
                                </div>

                                <center>
                                    <a href='$site_url' class='btn-primary'>Visit Website</a>
                                </center>
                            </div>

                            <!-- Footer -->
                            <div class='footer'>
                                <p>&copy; $current_year $sender_name. All rights reserved.</p>
                                <p>
                                    <a href='$site_url/login'>Login</a> | 
                                    <a href='$site_url/contact-us'>Support</a>
                                </p>
                                <p style='margin-top:10px; opacity: 0.7;'>You are receiving this email because you are a registered member of Desi Rishta.</p>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </body>
        </html>
        ";
        // --- HTML EMAIL UI TEMPLATE END ---

        // API Data Preparation
        $post_fields = array(
            'to' => $to_email,
            'from' => $sender_email,
            'from_name' => $sender_name,
            'subject' => $email_subject,
            'body' => $message_ui, // Sending the designed HTML
            'token' => $api_token
        );

        // cURL Initialization
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $api_endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $post_fields,
            CURLOPT_SSL_VERIFYHOST => 0, // Disabled for debug/flexibility
            CURLOPT_SSL_VERIFYPEER => 0, // Disabled for debug/flexibility
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        
        echo "<div class='log-entry'>";
        if ($err) {
            echo "<span class='error'>[Connection Error]</span> $to_email: $err";
            $fail_count++;
        } else {
            // Check HTTP Status Code
            if ($httpcode == 200) {
                // Optional: Check inner JSON status if API returns {status: 'error'} even on 200 OK
                // $json_response = json_decode($response, true);
                echo "<span class='success'>[Sent]</span> $to_email - Status: $httpcode";
                $success_count++;
            } else {
                echo "<span class='error'>[Failed]</span> $to_email - HTTP Code: $httpcode - Response: " . htmlspecialchars($response);
                $fail_count++;
            }
        }
        echo "</div>";

        // Flush output buffer to show progress in real-time
        flush();
        ob_flush();
    }
} else {
    echo "<p class='info'>No emails found in list to send.</p>";
}

echo '</div>'; // End log box

// 5. SUMMARY & NAVIGATION
echo "<div style='margin-top: 20px; padding: 15px; background: #fff; border: 1px solid #ddd;'>";
echo "<h4>Execution Complete</h4>";
echo "<p>Successfully Sent: <b style='color:green'>$success_count</b></p>";
echo "<p>Failed: <b style='color:red'>$fail_count</b></p>";
echo "<a href='$admin_page' class='btn'>Go Back to Admin Panel</a>";
echo "</div>";
?>