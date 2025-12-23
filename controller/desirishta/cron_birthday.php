<?php
ob_start(); 
include 'config.php';

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
$subject = "Wishing You a Joyful and Love-Filled Birthday from Desi Rishta! 🎉🎂";
$mailContent = "
    <div style='width:100%; margin:2% auto; padding:3%;'>
        <div style='text-align:center'>
            <img src='http://myptetest.com/desirishta/images/tlogo.png' style='width:50%'>
        </div>
        <div style='width:100%; margin:0 auto'>
            <div style='color:#000; width:90%; margin:0 auto;'>
                <p style='font-size:15px;'>Dear $fullname,</p>
                <p style='font-size:15px;'>Wishing you a joyful and love-filled birthday from all of us at Desi Rishta! 🎂🎉🥳</p>
                <p style='font-size:15px;'>We hope your special day is full of happiness, and that the year ahead brings you closer to finding your perfect match.</p>
                <p style='font-size:15px;'>Enjoy your day to the fullest! 🥳</p>
                <br>
                <p style='font-size:15px; margin:0px'>Thanks & Regards,</p>
                <p style='font-size:15px; margin:0px'>Team Desi Rishta</p>
                <p style='font-size:15px; margin:0px'>support@desi-rishta.com</p>
            </div>
        </div>    
    </div>
    ";

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