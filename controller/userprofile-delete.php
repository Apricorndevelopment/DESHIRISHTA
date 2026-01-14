<?php
ob_start();
include 'config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/email_layout_template.php';

if (isset($_GET['uid']) && !empty($_GET['uid'])) {
    $uid = mysqli_real_escape_string($con, $_GET['uid']);


    $sqlSelect = "SELECT email, name FROM registration WHERE userid = ?";
    $stmt = mysqli_prepare($con, $sqlSelect);
    mysqli_stmt_bind_param($stmt, "s", $uid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $userData = mysqli_fetch_assoc($result);

    if ($userData) {
        $email = $userData['email'];
        $fullname = $userData['name'];

     
        $sqlDelete = "DELETE FROM registration WHERE userid = ?";
        $stmtDel = mysqli_prepare($con, $sqlDelete);
        mysqli_stmt_bind_param($stmtDel, "s", $uid);
        
        if (mysqli_stmt_execute($stmtDel)) {
            
            $subject = "Your Account has been Deleted - Desi Rishta";
            $customHtml = "
                <p style='font-size:15px;'>Dear $fullname,</p>
                <p style='font-size:15px;'>This is a confirmation that your account on <strong>Desi Rishta</strong> has been successfully deleted from our system.</p>
                <p style='font-size:15px;'>We are sorry to see you go. If this wasn't you, please contact our support immediately.</p>
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

            $response = curl_exec($curl);
            curl_close($curl);

            echo "<script>alert('User profile deleted and email sent successfully'); window.location.href='user-profiles.php';</script>";
        } else {
            echo "<script>alert('Error deleting record'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('User not found'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Invalid Request'); window.history.back();</script>";
}

ob_end_flush();
?>