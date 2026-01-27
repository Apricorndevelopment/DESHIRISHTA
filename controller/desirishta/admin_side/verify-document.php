<?php
// verify-document.php

ob_start();
include 'config.php';

require_once '../email_layout_template.php';

// Check if all necessary parameters are set
if (isset($_GET['uid']) && isset($_GET['action'])) {
    
    $userid = mysqli_real_escape_string($con, $_GET['uid']);
    $action = $_GET['action']; // 'verify' or 'decline'
    
    $redirect_message = '';
    
    // Determine the status value based on action
    if ($action == 'verify') {
        
        $redirect_message = 'doc_verified';
        
        // --- 1. PRIMARY UPDATE: Document Status (Ye Sabse Zaroori Hai) ---
        $sql_doc = "UPDATE registration SET document_verification_status = 'Done' WHERE userid = '$userid'";
        mysqli_query($con, $sql_doc);

        // --- 2. SECONDARY UPDATE: Trust Badge (Verification Info) ---
        // Ise alag query mein rakha hai taki error na aaye
        $sql_badge = "UPDATE registration SET verificationinfo = 'Done' WHERE userid = '$userid'";
        mysqli_query($con, $sql_badge);

        // --- 3. TERTIARY UPDATE: Account Activation ---
        // Agar account deactivate tha to use Active karein
        // (Agar 'status' column nahi hua to bhi upar wale updates nahi rukenge)
        $sql_active = "UPDATE registration SET status = 'Active' WHERE userid = '$userid'";
        mysqli_query($con, $sql_active);

        // --- 4. UPDATE VERIFICATION_INFO TABLE ---
        $sql_verify_info = "UPDATE verification_info SET gov_status = 'Done' WHERE userid = '$userid'";
        mysqli_query($con, $sql_verify_info);

        // --- 5. SEND SUCCESS EMAIL ---
        $sql_user = "SELECT email, name FROM registration WHERE userid = '$userid'";
        $res_user = mysqli_query($con, $sql_user);
        
        if($res_user && mysqli_num_rows($res_user) > 0){
            $row_user = mysqli_fetch_assoc($res_user);
            $email = $row_user['email'];
            $fullname = $row_user['name'];

            $subject = "Government ID verification completed: You've Earned Your Trust Badge!";
            $customHtml = "
                 <p style='font-size:15px;'>Dear User,</p>
                            <p style='font-size:15px;'>We are pleased to inform you that your verification process has been successfully completed. As a result, your trust badge is now active on your profile.</p>
                            <p style='font-size:15px;'>We appreciate your cooperation in completing this important step.</p>
";
            $mailContent = getEmailLayout($customHtml);
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://app.smtpprovider.com/api/send-mail/',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => array(
                    'to'        => $email,
                    'from'      => 'info@noreplies.co.in',
                    'from_name' => 'Desi Rishta',
                    'subject'   => $subject,
                    'body'      => $mailContent,
                    'token'     => '74765968c67007219b197f4d9aafb4e2'
                )
            ));
            curl_exec($curl);
            curl_close($curl);
        }

    } elseif ($action == 'decline') {
        
        $redirect_message = 'doc_declined';
        
        // Decline Logic - Separate Queries for safety
        mysqli_query($con, "UPDATE registration SET document_verification_status = 'Declined' WHERE userid = '$userid'");
        mysqli_query($con, "UPDATE verification_info SET gov_status = 'Declined' WHERE userid = '$userid'");
    } 

    // --- 6. Add Admin Remark (Optional) ---
    // Uncomment if table exists
    // $remark_text = ($action == 'verify') ? "Govt. ID verified" : "Govt. ID declined";
    // mysqli_query($con, "INSERT INTO admin_remarks (user_id, remark_text, created_at) VALUES ('$userid', '$remark_text', NOW())");

    // Redirect
    header('Location: userprofile-view.php?uid=' . $userid . '&status=' . $redirect_message);
    exit;

} else {
    echo "Missing required parameters.";
}

ob_end_flush();
?>