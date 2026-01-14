<?php
// File: upload-govtid.php

include 'config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/email_layout_template.php';



// Check if form is submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 1. Get User ID and Post Data (userid from cookie)
    $userid = $_COOKIE['dr_userid'];
    $govtid = mysqli_real_escape_string($con, $_POST['govtid']);
    $new_filename = '';

    if ($userid == '') {
        header('location:login.php');
        exit;
    }

    // 2. File Upload Logic
    if (isset($_FILES["govtidphoto"]) && $_FILES["govtidphoto"]["error"] == 0) {
        
        $file_info = pathinfo($_FILES["govtidphoto"]["name"]);
        $safe_filename = preg_replace("/[^a-zA-Z0-9._-]/", "", $file_info['filename']);
        $new_filename = time() . '_' . $safe_filename . '.' . $file_info['extension'];
        
        $target_dir = "govtidphoto/"; 
        $s11 = $_FILES["govtidphoto"]["tmp_name"];
        $sd1 = move_uploaded_file($s11, $target_dir . $new_filename);
        
        if (!$sd1) {
            header('location:trust-badge.php?error=upload_failed'); 
            exit;
        }
    } 
    
    if (empty($new_filename)) {
        header('location:trust-badge.php?error=no_file_uploaded'); 
        exit;
    }

    // 3. Database Updates
    $sqlcheck = "SELECT * FROM verification_info WHERE userid = '$userid'";
    $resultcheck = mysqli_query($con, $sqlcheck);
    
    if (mysqli_num_rows($resultcheck) == 0) {
        $sqlinsert = "INSERT INTO `verification_info`(`userid`, `govtid`, `govpic`) VALUES ('$userid','$govtid','$new_filename')";
        mysqli_query($con, $sqlinsert);
    } else {
        $sqlupdate = "UPDATE `verification_info` SET `govtid`='$govtid', `govpic`='$new_filename' WHERE `userid`='$userid'";
        mysqli_query($con, $sqlupdate);
    }
    
    // Set status to Pending
    // $update_reg_status = "UPDATE `registration` SET `verificationinfo`='Pending' WHERE `userid`='$userid'";
    // mysqli_query($con, $update_reg_status);

    $update_reg_status = "
    UPDATE `registration` 
    SET 
        `document_verification_status` = 'Pending',
        `verificationinfo` = 'Pending'
    WHERE `userid` = '$userid'
";
mysqli_query($con, $update_reg_status);

    // --- 4. [NEW] Send "Under Screening" Email ---
    
    // Fetch user email and name
    $sql_user = "SELECT email, name FROM registration WHERE userid = '$userid'";
    $res_user = mysqli_query($con, $sql_user);
    $row_user = mysqli_fetch_assoc($res_user);
    $email = $row_user['email'];
    $fullname = $row_user['name'];

    $subject = "Government ID is under screening";
    $customHtml = "
     <p style='font-size:15px;'>Dear $fullname,</p>
                    <p style='font-size:15px;'>Your government ID is currently under screening. Once verified, your account will be marked as ID verified. You will receive a notification upon completion of this process.</p>
                    <p style='font-size:15px;'>If you have any questions or need assistance, our support team is here to help.</p>
";

    $mailContent = getEmailLayout($customHtml);

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
          'to' => $email,
          'from' => 'info@noreplies.co.in',
          'from_name' => 'Desi Rishta',
          'subject'   => $subject,
          'body'      => $mailContent,
          'token'     => '74765968c67007219b197f4d9aafb4e2'
      ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    // ---------------------------------------------

    header('location:trust-badge.php?status=doc_updated_pending_review');
    exit;

} else {
    header('location:trust-badge.php');
    exit;
}
?>