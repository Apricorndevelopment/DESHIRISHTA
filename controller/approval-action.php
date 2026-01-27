<?php
include 'config.php';

// --- INCLUDE EMAIL TEMPLATE (Check path relative to admin_side) ---
// Since we are in admin_side, we go one step back (../)
if (file_exists('../email_layout_template.php')) {
    require_once '../email_layout_template.php';
} elseif (file_exists($_SERVER['DOCUMENT_ROOT'] . '/email_layout_template.php')) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/email_layout_template.php';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uid = $_POST['uid'];
    $type = $_POST['type'];     // 'groom', 'photos', 'aboutme', or 'all_pending'
    $action = $_POST['action']; // 'approve' or 'reject'

    // ======================================================
    // 1. BULK ACTION LOGIC (Check what is pending & Process)
    // ======================================================
    if ($type == 'all_pending') {
        
        // Fetch current status of the user
        $check = mysqli_query($con, "SELECT * FROM registration WHERE userid='$uid'");
        $row = mysqli_fetch_assoc($check);

        // A. Process About Me (if pending)
        if($row['aboutme_approval_status'] == 'Pending') {
            processAboutMe($con, $uid, $action);
        }

        // B. Process Groom/Location (if pending)
        if($row['groom_approval_status'] == 'Pending') {
            processGroom($con, $uid, $action);
        }

        // C. Process Photos (if pending)
        if($row['photos_approval_status'] == 'Pending') {
            processPhotos($con, $uid, $action);
        }

    } 
    // ======================================================
    // 2. INDIVIDUAL ACTION LOGIC
    // ======================================================
    else {
        if ($type == 'aboutme') {
            processAboutMe($con, $uid, $action);
        }
        elseif ($type == 'groom') {
            processGroom($con, $uid, $action);
        }
        elseif ($type == 'photos') {
            processPhotos($con, $uid, $action);
        }
    }

    // Redirect back to the Pending List
    header("Location: pending-approvals.php?msg=processed");
    exit();
}

// =================================================================================
//                              HELPER FUNCTIONS
// =================================================================================

// --- FUNCTION TO SEND EMAIL ---
function sendApprovalStatusEmail($con, $userid, $subject, $msgBody) {
    // 1. Fetch User Data
    $u_sql = mysqli_query($con, "SELECT name, email FROM registration WHERE userid='$userid'");
    if(mysqli_num_rows($u_sql) > 0) {
        $u_row = mysqli_fetch_assoc($u_sql);
        $fullname = $u_row['name'];
        $email = $u_row['email'];

        // 2. Prepare HTML Body (Using your existing style)
        $customHtml = "
            <p style='font-size:15px;'>Hi $fullname,</p>
            <p style='font-size:15px;'>$msgBody</p>
            <p style='font-size:15px;'>Please login to your account for more details.</p>
        ";

        // 3. Get Template Layout
        if(function_exists('getEmailLayout')) {
            $mailContent = getEmailLayout($customHtml);

            // 4. Send via SMTP Provider API
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://app.smtpprovider.com/api/send-mail/',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0, // No timeout for background process
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'to' => $email,
                    'from' => 'info@noreplies.co.in',
                    'from_name' => 'Desi Rishta',
                    'subject' => $subject,
                    'body' => $mailContent,
                    'token' => '74765968c67007219b197f4d9aafb4e2'
                ),
            ));
            
            $response = curl_exec($curl);
            curl_close($curl);
        }
    }
}

// --- FUNCTION: Process About Me ---
function processAboutMe($con, $uid, $action) {
    if ($action == 'approve') {
        // 1. Fetch Temp Data
        $temp_res = mysqli_query($con, "SELECT * FROM temp_basic_info WHERE userid='$uid'");
        $temp_row = mysqli_fetch_assoc($temp_res);
        
        if($temp_row) {
            $new_about = mysqli_real_escape_string($con, $temp_row['aboutme']);

            // 2. Update/Insert Main Table
            $check = mysqli_query($con, "SELECT * FROM basic_info WHERE userid='$uid'");
            if(mysqli_num_rows($check) > 0) {
                mysqli_query($con, "UPDATE basic_info SET aboutme='$new_about' WHERE userid='$uid'");
            } else {
                mysqli_query($con, "INSERT INTO basic_info (userid, aboutme) VALUES ('$uid', '$new_about')");
            }
            
            // 3. Update Status (Approved)
            mysqli_query($con, "UPDATE registration SET aboutme_approval_status='Approved', aboutme='Done' WHERE userid='$uid'");
            
            // 4. Send Approval Email
            sendApprovalStatusEmail($con, $uid, "About Me Approved - Desi Rishta", "Your 'About Me' profile description has been approved by the admin.");
        }
    } else {
        // Reject - (With reject_popup='1')
        mysqli_query($con, "UPDATE registration SET aboutme_approval_status='Rejected', reject_popup='1' WHERE userid='$uid'");
        
        // Send Rejection Email
        sendApprovalStatusEmail($con, $uid, "About Me Rejected - Desi Rishta", "Your 'About Me' profile description was rejected. Please update it according to our guidelines.");
    }
    // Clear Temp
    mysqli_query($con, "DELETE FROM temp_basic_info WHERE userid='$uid'");
}

// --- FUNCTION: Process Groom/Bride Location ---
function processGroom($con, $uid, $action) {
    if ($action == 'approve') {
        $temp_res = mysqli_query($con, "SELECT * FROM temp_groom_location WHERE userid='$uid'");
        $t = mysqli_fetch_assoc($temp_res);

        if($t) {
            // Update/Insert Main Table
            $check = mysqli_query($con, "SELECT * FROM groom_location WHERE userid='$uid'");
            if(mysqli_num_rows($check) > 0) {
                $sql = "UPDATE groom_location SET 
                        state='{$t['state']}', city='{$t['city']}', country='{$t['country']}', 
                        citizenship='{$t['citizenship']}', resident='{$t['resident']}', ancestralorigin='{$t['ancestralorigin']}'
                        WHERE userid='$uid'";
                mysqli_query($con, $sql);
            } else {
                $sql = "INSERT INTO groom_location (userid, state, city, country, citizenship, resident, ancestralorigin)
                        VALUES ('$uid', '{$t['state']}', '{$t['city']}', '{$t['country']}', '{$t['citizenship']}', '{$t['resident']}', '{$t['ancestralorigin']}')";
                mysqli_query($con, $sql);
            }

            // Update Status (Approved)
            mysqli_query($con, "UPDATE registration SET groom_approval_status='Approved' WHERE userid='$uid'");

            // Send Approval Email
            sendApprovalStatusEmail($con, $uid, "Location Details Approved - Desi Rishta", "Your location details have been approved and updated on your profile.");
        }
    } else {
        // Reject - (With reject_popup='1')
        mysqli_query($con, "UPDATE registration SET groom_approval_status='Rejected', reject_popup='1' WHERE userid='$uid'");

        // Send Rejection Email
        sendApprovalStatusEmail($con, $uid, "Location Details Rejected - Desi Rishta", "Your location details request was declined. Please verify and submit valid details.");
    }
    // Clear Temp
    mysqli_query($con, "DELETE FROM temp_groom_location WHERE userid='$uid'");
}

// --- FUNCTION: Process Photos ---
function processPhotos($con, $uid, $action) {
    if ($action == 'approve') {
        $temp_res = mysqli_query($con, "SELECT * FROM temp_photos_info WHERE userid='$uid'");
        $t = mysqli_fetch_assoc($temp_res);

        if($t) {
            // Update/Insert Main Table
            $check = mysqli_query($con, "SELECT * FROM photos_info WHERE userid='$uid'");
            if(mysqli_num_rows($check) > 0) {
                $sql = "UPDATE photos_info SET 
                        profilepic='{$t['profilepic']}', photo1='{$t['photo1']}', photo2='{$t['photo2']}', 
                        photo3='{$t['photo3']}', photo4='{$t['photo4']}', photo5='{$t['photo5']}'
                        WHERE userid='$uid'";
                mysqli_query($con, $sql);
            } else {
                $sql = "INSERT INTO photos_info (userid, profilepic, photo1, photo2, photo3, photo4, photo5)
                        VALUES ('$uid', '{$t['profilepic']}', '{$t['photo1']}', '{$t['photo2']}', '{$t['photo3']}', '{$t['photo4']}', '{$t['photo5']}')";
                mysqli_query($con, $sql);
            }

            // Update Status (Approved)
            mysqli_query($con, "UPDATE registration SET photos_approval_status='Approved', photosinfo='Done' WHERE userid='$uid'");

            // Send Approval Email
            sendApprovalStatusEmail($con, $uid, "Photos Approved - Desi Rishta", "Great news! Your uploaded photos have been approved.");
        }
    } else {
        // Reject - (With reject_popup='1')
        mysqli_query($con, "UPDATE registration SET photos_approval_status='Rejected', reject_popup='1' WHERE userid='$uid'");

        // Send Rejection Email
        sendApprovalStatusEmail($con, $uid, "Photos Rejected - Desi Rishta", "Your uploaded photos were rejected by the admin. Please upload clear photos with your face visible.");
    }
    // Clear Temp
    mysqli_query($con, "DELETE FROM temp_photos_info WHERE userid='$uid'");
}
?>