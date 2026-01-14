<?php
ob_start(); 
include 'config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/email_layout_template.php';


echo $currentdate = date('m-d');

$sqlcheck = "select * from astro_info where dob like '%$currentdate%'";
$resultcheck = mysqli_query($con,$sqlcheck);
while($rowcheck = mysqli_fetch_assoc($resultcheck))
{

$userid = $rowcheck['userid'];

$sqldetails = "select * from registration where userid='$userid'";
$resultdetails = mysqli_query($con,$sqldetails);
$rowdetails = mysqli_fetch_assoc($resultdetails);


$email = $rowdetails['email'];
$fullname =  $rowdetails['name'];
$subject = "🎊🎂 It’s Your Birthday! Desi Rishta Celebrates You 🎉";
$customHtml = "
    <div style='font-size:15px; line-height:1.6; color:#333;'>
        Dear <strong>$fullname</strong>,<br><br>
        🎊🎉 <strong>Happy Birthday!</strong> 🎉🎊<br>
        ✨ <strong>Today is all about celebrating you!</strong> ✨<br><br>
        The entire Desi Rishta team wishes you a year filled with happiness, good health, and beautiful new beginnings.<br><br>
        Thank you for being a valued part of our community. We hope Desi Rishta continues to support you on your journey toward meaningful connections. 💖<br><br>
        Have a fantastic birthday and enjoy every moment! 🎂🎁🎈✨
    </div>
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
echo $response;

}
?>