<?php
// File: upload-govtid.php

include 'config.php';

// Check if form is submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 1. Get User ID and Post Data (userid from cookie)
    $userid = $_COOKIE['dr_userid'];
    $govtid = mysqli_real_escape_string($con, $_POST['govtid']);
    $new_filename = '';

    if ($userid == '') {
        // Redirect if user is not logged in
        header('location:login.php');
        exit;
    }

    // 2. File Upload Logic
    if (isset($_FILES["govtidphoto"]) && $_FILES["govtidphoto"]["error"] == 0) {
        
        // Sanitize file name and create a unique name
        $file_info = pathinfo($_FILES["govtidphoto"]["name"]);
        $safe_filename = preg_replace("/[^a-zA-Z0-9._-]/", "", $file_info['filename']);
        $new_filename = time() . '_' . $safe_filename . '.' . $file_info['extension'];
        
        // Destination directory is 'govtidphoto/' (relative to this script location)
        $target_dir = "govtidphoto/"; 
        $s11 = $_FILES["govtidphoto"]["tmp_name"];
        $sd1 = move_uploaded_file($s11, $target_dir . $new_filename);
        
        if (!$sd1) {
            // Handle file move failure
            header('location:trust-badge.php?error=upload_failed'); 
            exit;
        }
    } 
    
    // Check if a file was actually uploaded or if user tried to submit without file
    if (empty($new_filename)) {
        // If the file upload failed or no file was selected, redirect with error
        header('location:trust-badge.php?error=no_file_uploaded'); 
        exit;
    }

    // 3. Check if a record exists in verification_info
    $sqlcheck = "SELECT * FROM verification_info WHERE userid = '$userid'";
    $resultcheck = mysqli_query($con, $sqlcheck);
    
    // Use mysqli_num_rows to check if a record exists
    if (mysqli_num_rows($resultcheck) == 0) {
        // --- INSERT New Record ---
        $sqlinsert = "INSERT INTO `verification_info`(`userid`, `govtid`, `govpic`) VALUES ('$userid','$govtid','$new_filename')";
        mysqli_query($con, $sqlinsert);
        
    } else {
        // --- UPDATE Existing Record ---
        $sqlupdate = "UPDATE `verification_info` SET `govtid`='$govtid', `govpic`='$new_filename' WHERE `userid`='$userid'";
        mysqli_query($con, $sqlupdate);
    }
    
    // 4. IMPORTANT: Reset registration status to PENDING for admin review
    // 'Pending' status will ensure the admin panel shows the Verify/Decline buttons.
    $update_reg_status = "UPDATE `registration` SET `verificationinfo`='Pending' WHERE `userid`='$userid'";
    mysqli_query($con, $update_reg_status);

    
    // 5. Redirect to the verification page (User side)
    // Removed automatic 'Verification Complete' email as status is now Pending
    header('location:trust-badge.php?status=doc_updated_pending_review');
    exit;

} else {
    // Handle non-POST request
    header('location:trust-badge.php');
    exit;
}
?>