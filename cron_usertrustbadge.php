<?php
include 'config.php';

$sqlcheck = "select * from registration where verificationinfo != 'Done'";
$resultcheck = mysqli_query($con,$sqlcheck);
while($rowcheck = mysqli_fetch_assoc($resultcheck))
{
    $email = $rowcheck['email'];
    $fullname =  $rowcheck['name'];
    $subject = "Complete Your Verification to Earn Your Trust Badge";
    $mailContent = "
        <div style='width:90%; margin:2% auto; padding:3%;'>
            <div style='text-align:center'>
                <img src='http://myptetest.com/desirishta/images/tlogo.png' style='width:50%'>
            </div>
            <div style='width:100%; margin:0 auto'>
                <div style='color:#000; width:90%; margin:0 auto;'>
                    <p style='font-size:15px;'>Dear $fullname,</p>
                    <p style='font-size:15px;'>We have noticed that you haven't completed your verification yet. Please complete the process to earn your trust badge. </p>
                    <p style='font-size:15px;'>The trust badge enhances your credibility on our platform and signifies your commitment to authenticity. We look forward to seeing your profile marked as Verified.</p>
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