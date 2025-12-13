<?php
// desirishta/cron_photo_reminder.php
ob_start(); 
include 'config.php';

$current_date = date('Y-m-d');

// 1. Fetch users who are active (not deleted)
$sql_users = "SELECT r.userid, r.name, r.email, r.last_photo_reminder, 
              p.profilepic, p.photo1, p.photo2, p.photo3, p.photo4, p.photo5 
              FROM registration r 
              LEFT JOIN photos_info p ON r.userid = p.userid 
              WHERE r.delete_status != 'delete'";

$result_users = mysqli_query($con, $sql_users);

while($row = mysqli_fetch_assoc($result_users)) {
    
    $userid = $row['userid'];
    $email = $row['email'];
    $fullname = $row['name'];
    $last_sent = $row['last_photo_reminder'];

    // 2. Count Photos
    $photo_count = 0;
    if(!empty($row['profilepic'])) { $photo_count++; }
    if(!empty($row['photo1'])) { $photo_count++; }
    if(!empty($row['photo2'])) { $photo_count++; }
    if(!empty($row['photo3'])) { $photo_count++; }
    if(!empty($row['photo4'])) { $photo_count++; }
    if(!empty($row['photo5'])) { $photo_count++; }

    // 3. Condition: If photos <= 1
    if($photo_count <= 1) {
        
        // 4. Check 15-day Interval
        $should_send = false;
        
        if($last_sent == NULL || $last_sent == '0000-00-00') {
            $should_send = true; // Never sent before
        } else {
            $date1 = date_create($last_sent);
            $date2 = date_create($current_date);
            $diff = date_diff($date1, $date2);
            $days_diff = $diff->format("%a");
            
            if($days_diff >= 15) {
                $should_send = true; // 15 days passed
            }
        }

        // 5. Send Email
        if($should_send) {
            
            $subject = "Make a Great First Impression – Add Your More Picture to Desi Rishta Now!";
            $mailContent = "
                <div style='width:90%; margin:2% auto; padding:3%; font-family: Arial, sans-serif;'>
                    <div style='text-align:center'>
                        <img src='http://myptetest.com/desirishta/images/tlogo.png' style='width:200px'>
                    </div>
                    <div style='width:100%; margin:20px auto'>
                        <div style='color:#333; width:95%; margin:0 auto;'>
                            <p>Hi <b>$fullname</b>,</p>
                            
                            <p>Your profile looks great, let’s make it irresistible! Add a few more pictures so matches can get to know the real you. A bright headshot, a smiling candid, and one full-length photo work best.</p>
                            
                            <p>We review photos to keep the community safe.</p>
                            
                            <div style='background-color: #f9f9f9; padding: 15px; border-left: 4px solid #b16421; margin: 20px 0;'>
                                <strong>Tips:</strong> use recent, well-lit, solo photos; avoid heavy filters; keep it respectful.
                            </div>

                            <p>Please feel free to contact our support team, and we’ll be happy to assist you.</p>
                            <br>
                            <p style='margin:0px'>Thanks & Regards,</p>
                            <p style='margin:0px'><b>Team Desi Rishta</b></p>
                            <p style='margin:0px'><a href='mailto:support@desi-rishta.com'>support@desi-rishta.com</a></p>
                        </div>
                    </div>    
                </div>
            ";

            // Send via SMTP API (Same method as your other files)
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
                  'subject' => $subject,
                  'body' => $mailContent,
                  'token' => '74765968c67007219b197f4d9aafb4e2' // Make sure this token is valid
              ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);

            // 6. Update Database with today's date
            mysqli_query($con, "UPDATE registration SET last_photo_reminder = '$current_date' WHERE userid = '$userid'");
            
            echo "Reminder sent to: $email <br>";
        }
    }
}
echo "Cron Job Completed.";
?>