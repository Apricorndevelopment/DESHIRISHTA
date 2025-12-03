<?php
set_time_limit(0); // Set unlimited execution time for mass mailing

include '../config.php'; // Path to the main database config file

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Adjust paths based on where your PHPMailer libraries are located
require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    // If no ID is provided, redirect or show an error
    header("Location: ../admin/manage-communication.php?error=Missing communication ID");
    exit;
}

$communication_id = (int)$_GET['id'];
$admin_page = '../admin/manage-communication.php'; 

// 1. Fetch communication details
$sql_comm = "SELECT target_scope, target_users, subject, body_content FROM admin_communication WHERE id = '$communication_id' AND type = 'email'";
$result_comm = mysqli_query($con, $sql_comm);

if (mysqli_num_rows($result_comm) == 0) {
    header("Location: " . $admin_page . "?error=Communication record not found or not an email type");
    exit;
}

$comm_data = mysqli_fetch_assoc($result_comm);
$target_scope = $comm_data['target_scope'];
$target_users_raw = $comm_data['target_users'];
$email_subject = $comm_data['subject'];
$email_body = $comm_data['body_content'];

$emails = [];
$user_sql_condition = "WHERE delete_status != 'delete' AND firstapprove = '1'";

// 2. Determine Recipients
if ($target_scope == 'all') {
    $sql = "SELECT email FROM registration $user_sql_condition";
} elseif ($target_scope == 'specific' && !empty($target_users_raw)) {
    $user_ids_array = explode(',', $target_users_raw);
    $safe_user_ids = array_map(function($id) use ($con) {
        return "'" . mysqli_real_escape_string($con, trim($id)) . "'";
    }, $user_ids_array);
    
    $user_id_list = implode(',', $safe_user_ids);
    
    $sql = "SELECT email FROM registration $user_sql_condition AND userid IN ($user_id_list)";
} else {
    // No valid target specified for specific scope
    header("Location: " . $admin_page . "?error=No recipients found for this communication.");
    exit;
}

$result_emails = mysqli_query($con, $sql);
while ($row = mysqli_fetch_assoc($result_emails)) {
    if (!empty($row['email'])) {
        $emails[] = $row['email'];
    }
}

$success_count = 0;
$mail_errors = [];

// 3. Send Emails using PHPMailer
if (count($emails) > 0) {
    foreach ($emails as $recipient_email) {
        $mail = new PHPMailer(true);
        try {
            // Server settings (Update these with your actual SMTP details)
            $mail->isSMTP();                                            
            $mail->Host       = 'smtp.example.com';                     
            $mail->SMTPAuth   = true;                                   
            $mail->Username   = 'user@example.com';                     
            $mail->Password   = 'your_password';                              
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
            $mail->Port       = 465;                                    
            $mail->CharSet    = 'UTF-8';

            // Recipients
            $mail->setFrom('no-reply@desirishta.com', 'Desi Rishta Promotions');
            $mail->addAddress($recipient_email); 

            // Content
            $mail->isHTML(true);                                  
            $mail->Subject = $email_subject;
            $mail->Body    = $email_body;
            $mail->AltBody = strip_tags($email_body); // Plain text version

            $mail->send();
            $success_count++;
        } catch (Exception $e) {
            $mail_errors[] = $recipient_email . ": " . $mail->ErrorInfo;
            // Optionally log the error to a file
        }
    }
}

// 4. Redirect with results
$message = "Email campaign completed. Successfully sent to $success_count recipients.";
if (!empty($mail_errors)) {
    // Only show the first few errors to the admin
    $message .= " However, " . count($mail_errors) . " emails failed (e.g., " . implode(', ', array_slice($mail_errors, 0, 3)) . "...).";
}

header("Location: " . $admin_page . "?success=" . urlencode($message));
exit;
?>