<?php
// verify-document.php

ob_start();
include 'config.php';

// Check if all necessary parameters are set
if (isset($_GET['uid']) && isset($_GET['action'])) {
    
    $userid = mysqli_real_escape_string($con, $_GET['uid']);
    $action = $_GET['action']; // 'verify' or 'decline'
    
    $update_status_value = '';
    $redirect_message = '';
    
    // Determine the status value based on action
    if ($action == 'verify') {
        $update_status_value = 'Done'; // Set ID verification status to Done (Verified)
        $redirect_message = 'doc_verified';
        $message_for_user = "Your uploaded Government ID has been **successfully verified** by the administration.";
        
    } elseif ($action == 'decline') {
        $update_status_value = 'Declined'; // Set ID verification status to Declined
        $redirect_message = 'doc_declined';
        $message_for_user = "Your uploaded Government ID was **declined** due to insufficient clarity or mismatch. Please re-upload a clear document.";
        
    } else {
        // Handle invalid action
        header('Location: userprofile-view.php?uid=' . $userid . '&status=error');
        exit;
    }
    
    // --- 1. Update the verification status in the registration table ---
    // $sql_reg = "UPDATE registration SET verificationinfo = '$update_status_value' WHERE userid = '$userid'";
   $sql_reg = "UPDATE registration SET document_verification_status = '$update_status_value' WHERE userid = '$userid'";
mysqli_query($con, $sql_reg);
   
    mysqli_query($con, $sql_reg);

    // --- 2. Update the status in the verification_info table ---
    // Note: Assuming 'gov_status' column exists in verification_info table to track ID status separately
    // If 'gov_status' does not exist, use the registration table status only.
    $sql_verify = "UPDATE verification_info SET gov_status = '$update_status_value' WHERE userid = '$userid'";
    mysqli_query($con, $sql_verify);

    // --- 3. Add an Admin Remark (Optional but recommended) ---
    // Assuming you have an admin session variable for username (e.g., $_SESSION['admin_user'])
    $admin_username = "AdminUser"; // Replace with actual admin session variable
    $remark_text = "Govt. ID status set to '$update_status_value' by $admin_username.";

    $sql_remark = "INSERT INTO admin_remarks (user_id, admin_username, remark_text, created_at) VALUES (?, ?, ?, NOW())";
    $stmt = mysqli_prepare($con, $sql_remark);
    mysqli_stmt_bind_param($stmt, 'sss', $userid, $admin_username, $remark_text);
    mysqli_stmt_execute($stmt);


    // --- 4. Send Email Notification to User (Recommended) ---
    // (You would need a separate function or cURL logic here, similar to profile approval)
    // For simplicity, we just redirect. You should implement the actual mailing logic.
    
    
    // --- 5. Redirect back to the profile view page ---
    header('Location: userprofile-view.php?uid=' . $userid . '&status=' . $redirect_message);
    exit;

} else {
    echo "Missing required parameters.";
}

ob_end_flush();
?>