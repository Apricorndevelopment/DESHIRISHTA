<!-- <?php
ob_start();
include 'config.php';

$userid = $_GET['uid'];

$sql = "UPDATE `registration` SET `profilestatus`='1', `firstapprove`='1', `profilestatus_popup` = '0' WHERE `userid`='$userid'";
$result = mysqli_query($con,$sql);

$sqlselect = "select * from registration where userid = '$userid'";
$resultselect = mysqli_query($con,$sqlselect);
$rowselect = mysqli_fetch_assoc($resultselect);

$email = $rowselect['email'];
$fullname =  $rowselect['name'];
$subject = "Your Profile is Now Live on Desi Rishta";
$mailContent = "
    <div style='width:90%; margin:2% auto; padding:3%;'>
        <div style='text-align:center'>
            <img src='http://myptetest.com/desirishta/images/tlogo.png' style='width:50%'>
        </div>
        <div style='width:100%; margin:0 auto'>
            <div style='color:#000; width:90%; margin:0 auto;'>
                <p style='font-size:15px;'>Dear $fullname,</p>
                <p style='font-size:15px;'>We're pleased to inform you that your profile has passed screening and is now live on Desi Rishta. Start connecting with potential partners today!</p>
                <p style='font-size:15px;'>If you have any questions or need assistance, our support team is here to help.</p>
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
//echo $response;

header('location:user-profiles.php?profilestatus=yes');
?> -->

<?php


// 1. Check that all required parameters are present in the URL
if (isset($_GET['uid']) && isset($_GET['status'])) {
    
    $userid = $_GET['uid'];
    $new_status = $_GET['status']; // This will be 1, 2, or 3
    $sql = ""; // Initialize the SQL query variable

    // 2. Build the correct SQL query based on the new status
    if ($new_status == '1') {
        // --- APPROVE ---
        // This is your original query for approving a user
        $sql = "UPDATE `registration` SET `profilestatus`='1', `firstapprove`='1', `profilestatus_popup` = '0' WHERE `userid`='$userid'";
    
    } elseif ($new_status == '2') {
        // --- DEACTIVATE ---
        // This query just updates the status to '2'
        // $sql = "UPDATE `registration` SET `profilestatus`='2' WHERE `userid`='$userid'";
        $sql = "UPDATE `registration` SET `profilestatus`='2', `verificationinfo`='0', `document_verification_status`='Pending' WHERE `userid`='$userid'";
    
    } elseif ($new_status == '3') {
        // --- DELETE ---
        // This query just updates the status to '3'
        $sql = "UPDATE `registration` SET `profilestatus`='3' WHERE `userid`='$userid'";
    
    } else {
        // If status is not 1, 2, or 3, stop the script
        echo "Invalid status value provided.";
        exit;
    }

    // 3. Execute the database update
    $result = mysqli_query($con, $sql);

    // 4. Check if the update was successful
    if ($result) {
        
        // 5. ONLY send an email if the new status was '1' (Approve)
        if ($new_status == '1') {
            
            // --- This is your original email-sending code ---
            $sqlselect = "select * from registration where userid = '$userid'";
            $resultselect = mysqli_query($con, $sqlselect);
            $rowselect = mysqli_fetch_assoc($resultselect);

            $email = $rowselect['email'];
            $fullname = $rowselect['name'];
            $subject = "Your Profile is Now Live on Desi Rishta";
            $mailContent = "
                <div style='width:90%; margin:2% auto; padding:3%;'>
                    <div style='text-align:center'>
                        <img src='http://myptetest.com/desirishta/images/tlogo.png' style='width:50%'>
                    </div>
                    <div style='width:100%; margin:0 auto'>
                        <div style='color:#000; width:90%; margin:0 auto;'>
                            <p style='font-size:15px;'>Dear $fullname,</p>
                            <p style='font-size:15px;'>We're pleased to inform you that your profile has passed screening and is now live on Desi Rishta. Start connecting with potential partners today!</p>
                            <p style='font-size:15px;'>If you have any questions or need assistance, our support team is here to help.</p>
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
            //echo $response;
            // --- End of email-sending code ---
        
        } // End of if ($new_status == '1')

        // 6. Redirect back to the user profiles list
        header('location:user-profiles.php?profilestatus=yes');
        
    } else {
        // If the query failed
        echo "Error updating record: " . mysqli_error($con);
    }

} else {
    // If uid or status was not in the URL
    echo "Missing required parameters (uid or status).";
}

ob_end_flush();
?>