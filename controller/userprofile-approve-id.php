<?php
ob_start();
include 'config.php';

// 1. Check that all required parameters are present in the URL
if (isset($_GET['uid'])) {
    
    $userid = $_GET['uid'];
    
    // 2. Build the SQL query to approve the ID
    // !!! ZAROORI NOTE: Hum yahaan 'id_verification_status' naam ka column assume kar rahe hain.
    // Agar aapka column naam alag hai (jaise 'aadhaar_status' ya 'id_proof_approved'), toh usse yahaan line 12 mein badal dein.
    $sql = "UPDATE `registration` SET `verificationinfo`='1' WHERE `userid`='$userid'";
    
    // 3. Execute the database update
    $result = mysqli_query($con, $sql);

    // 4. Check if the update was successful
    if ($result) {
        
        // 5. ID Approve hone par email bhejein
        
        // --- User ki details lein ---
        $sqlselect = "select * from registration where userid = '$userid'";
        $resultselect = mysqli_query($con, $sqlselect);
        $rowselect = mysqli_fetch_assoc($resultselect);

        $email = $rowselect['email'];
        $fullname = $rowselect['name'];
        $subject = "Your ID has been Verified on Desi Rishta";
        $mailContent = "
            <div style='width:90%; margin:2% auto; padding:3%;'>
                <div style='text-align:center'>
                    <img src='http://myptetest.com/desirishta/images/tlogo.png' style='width:50%'>
                </div>
                <div style='width:100%; margin:0 auto'>
                    <div style='color:#000; width:90%; margin:0 auto;'>
                        <p style='font-size:15px;'>Dear $fullname,</p>
                        <p style='font-size:15px;'>Congratulations! Your submitted Government ID has been successfully verified by our team.</p>
                        <p style='font-size:15px;'>Your profile will now display a 'Verified' badge, increasing your trust and credibility in the community.</p>
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

        // 6. Redirect back to the user profiles list with a *new* success message
        header('location:user-profiles.php?idstatus=yes');
        
    } else {
        // If the query failed
        echo "Error updating ID verification status: " . mysqli_error($con);
    }

} else {
    // If uid was not in the URL
    echo "Missing required parameter (uid).";
}

ob_end_flush();
?>