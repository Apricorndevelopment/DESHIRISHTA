<?php
ob_start();
include 'config.php';

if (isset($_GET['uid']) && isset($_GET['status'])) {

    $userid  = $_GET['uid'];
    $status  = $_GET['status'];  // 1 = Verify, 0 = Unverify

    // Update query
    $sql = "UPDATE `registration` SET `verificationinfo`='$status' WHERE `userid`='$userid'";
    $result = mysqli_query($con, $sql);

    if ($result) {

        // Only send email when status = 1 (Verified)
        if ($status == '1') {

            $sqlselect = "SELECT * FROM registration WHERE userid = '$userid'";
            $resultselect = mysqli_query($con, $sqlselect);
            $rowselect = mysqli_fetch_assoc($resultselect);

            $email    = $rowselect['email'];
            $fullname = $rowselect['name'];
            $subject  = "Your ID has been Verified on Desi Rishta";

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
                            <p style='font-size:15px; margin:0px'>Thanks & Regards,<br>Team Desi Rishta<br>support@desi-rishta.com</p>
                        </div>
                    </div>    
                </div>";

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
        }

        header("Location: user-profiles.php?idstatus=yes");
        exit;

    } else {
        echo "Error updating ID status: " . mysqli_error($con);
    }

} else {
    echo "Missing parameter (uid or status).";
}

ob_end_flush();
?>
