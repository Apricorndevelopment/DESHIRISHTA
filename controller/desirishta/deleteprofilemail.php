<?php
ob_start(); 

require_once $_SERVER['DOCUMENT_ROOT'] . '/email_layout_template.php';

$email = $_COOKIE['dr_email'];
$fullname =  $_COOKIE['dr_name'];
$subject = "Confirmation of Profile Deletion from Desi Rishta";
$customHtml = "
 <p style='font-size:15px;'>Dear $fullname,</p>
                <p style='font-size:15px;'>Your profile has been successfully deleted from Desi Rishta.</p>
                <p style='font-size:15px;'>Thank you for using our platform. If you have any questions or need assistance, feel free to contact us.</p>
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
  CURLOPT_POSTFIELDS => array('to' => $email,'from' => 'info@noreplies.co.in','from_name' => 'Desi Rishta','subject' => $subject,'body' => $mailContent,'token' => '74765968c67007219b197f4d9aafb4e2'),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;
setcookie("dr_userid", "", time()-3600);
header('location:index.php');
?>