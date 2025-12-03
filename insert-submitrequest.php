<?php
// Database connection file include karein
include('config.php'); 

// Zaroori: PHPMailer classes ko include karein
require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php'; 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


// ----------------------------------------------------
// 1. FORM DATA LENA (Getting Input Data)
// ----------------------------------------------------

// Form data ko check karein
if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['message']) || empty($_POST['category']) || empty($_POST['phone'])) {
    header('location:submitrequest.php?error=missingfields&#support');
    exit;
}

// Data sanitize karein
$name = mysqli_real_escape_string($con, $_POST['name']);
$email = mysqli_real_escape_string($con, $_POST['email']);
$category = mysqli_real_escape_string($con, $_POST['category']); // Hardcoded value
$phone = mysqli_real_escape_string($con, $_POST['phone']); 
$message = mysqli_real_escape_string($con, $_POST['message']);

// ----------------------------------------------------
// 2. DATABASE MEIN DATA DAALNA (Database Insertion in contact_us)
// ----------------------------------------------------
// contact_us table mein phone column nahi hai, isliye sirf zaruri fields use honge
$sql = "INSERT INTO contact_us (name, email, category, message, status) 
        VALUES ('$name', '$email', '$category', '$message', 'New')"; 

if (mysqli_query($con, $sql)) {
    
    // ----------------------------------------------------
    // 3. ADMIN KO EMAIL NOTIFICATION BHEJNA (Email Sending)
    // ----------------------------------------------------
    try {
        $mail = new PHPMailer(true);

        // PHPMailer Setup: Yahan apni SMTP details bharein aur uncomment karein
        /*
        $mail->isSMTP();
        $mail->Host       = 'smtp.yourdomain.com'; 
        $mail->SMTPAuth   = true;
        $mail->Username   = 'noreply@yourdomain.com';
        $mail->Password   = 'YourSMTPPassword';     
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; 
        $mail->Port       = 465;
        */

        // Recipients
        $admin_email = 'admin_email@yourwebsite.com'; // ⬅️ Apna Admin Email Yahan Dalein
        
        $mail->setFrom($email, $name); 
        $mail->addAddress($admin_email, 'Website Admin'); 
        
        // Content
        $mail->isHTML(true);
        $mail->Subject = 'NEW USER SUPPORT REQUEST: ' . $category;

        // Email Body - Phone number ko yahan shamil kiya gaya hai
        $mail_body = "
            <h2>New Support Request (from Submit Request Form)</h2>
            <p>A logged-in user has submitted a request from the support form.</p>
            <table border='1' cellpadding='10' cellspacing='0' style='width:100%; border-collapse: collapse;'>
                <tr><td style='background-color:#f2f2f2; width:30%;'><strong>Name:</strong></td><td>" . $name . "</td></tr>
                <tr><td style='background-color:#f2f2f2;'><strong>Email:</strong></td><td>" . $email . "</td></tr>
                <tr><td style='background-color:#f2f2f2;'><strong>Phone:</strong></td><td>" . $phone . "</td></tr> 
                <tr><td style='background-color:#f2f2f2;'><strong>Category:</strong></td><td>" . $category . "</td></tr>
                <tr><td style='background-color:#f2f2f2;'><strong>Message:</strong></td><td>" . nl2br($message) . "</td></tr>
            </table>
        ";
        
        $mail->Body = $mail_body;
        // $mail->send(); // ⬅️ Jab email setup ho jaye, tab is line ko uncomment karein

        // Database mein save hone ke baad hi success redirect karein
        header('location:submitrequest.php?success=yes&#support');
        exit;

    } catch (Exception $e) {
        // Agar email bhejte waqt error aaya, toh sirf error log karein 
        error_log("Support Request saved to contact_us DB, but email could not be sent. Mailer Error: {$mail->ErrorInfo}");
        header('location:submitrequest.php?success=yes&#support'); 
        exit;
    }

} else {
    // Agar database mein data save nahi ho paya
    error_log("Database Error on support request insert into contact_us: " . mysqli_error($con) . " | SQL: " . $sql);
    header('location:submitrequest.php?error=dbfail&#support');
    exit;
}
?>