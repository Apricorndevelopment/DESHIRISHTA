<?php
include 'config.php';

$userid = $_COOKIE['dr_userid'];

// --- 1. FILE UPLOAD LOGIC ---
// Check if new file uploaded, otherwise use old file name

// Profile Pic
$oldprofilepic = $_POST['oldprofilepic'];
$s1 = $_FILES["profilepic"]["name"];
if ($s1 == '') {
    $s1 = $oldprofilepic;
} else {
    $s11 = $_FILES["profilepic"]["tmp_name"];
    move_uploaded_file($s11, "userphoto//" . $s1);
}

// Photo 1
$oldphoto1 = $_POST['oldphoto1'];
$s2 = $_FILES["photo1"]["name"];
if ($s2 == '') {
    $s2 = $oldphoto1;
} else {
    $s22 = $_FILES["photo1"]["tmp_name"];
    move_uploaded_file($s22, "userphoto//" . $s2);
}

// Photo 2
$oldphoto2 = $_POST['oldphoto2'];
$s3 = $_FILES["photo2"]["name"];
if ($s3 == '') {
    $s3 = $oldphoto2;
} else {
    $s33 = $_FILES["photo2"]["tmp_name"];
    move_uploaded_file($s33, "userphoto//" . $s3);
}

// Photo 3
$oldphoto3 = $_POST['oldphoto3'];
$s4 = $_FILES["photo3"]["name"];
if ($s4 == '') {
    $s4 = $oldphoto3;
} else {
    $s44 = $_FILES["photo3"]["tmp_name"];
    move_uploaded_file($s44, "userphoto//" . $s4);
}

// Photo 4
$oldphoto4 = $_POST['oldphoto4'];
$s5 = $_FILES["photo4"]["name"];
if ($s5 == '') {
    $s5 = $oldphoto4;
} else {
    $s55 = $_FILES["photo4"]["tmp_name"];
    move_uploaded_file($s55, "userphoto//" . $s5);
}

// Photo 5
$oldphoto5 = $_POST['oldphoto5'];
$s6 = $_FILES["photo5"]["name"];
if ($s6 == '') {
    $s6 = $oldphoto5;
} else {
    $s66 = $_FILES["photo5"]["tmp_name"];
    move_uploaded_file($s66, "userphoto//" . $s6);
}

// --- 2. APPROVAL WORKFLOW LOGIC (Temp Table) ---

// Check if data exists in temporary table
$sqlcheck = "SELECT * FROM temp_photos_info WHERE userid = '$userid'";
$resultcheck = mysqli_query($con, $sqlcheck);
$countcheck = mysqli_num_rows($resultcheck);

if ($countcheck > 0) {
    // Update existing pending request
    $sql = "UPDATE `temp_photos_info` SET 
            `profilepic`='$s1',
            `photo1`='$s2',
            `photo2`='$s3',
            `photo3`='$s4',
            `photo4`='$s5',
            `photo5`='$s6' 
            WHERE `userid`='$userid'";
} else {
    // Insert new pending request
    $sql = "INSERT INTO `temp_photos_info`
            (`userid`, `profilepic`, `photo1`, `photo2`, `photo3`, `photo4`, `photo5`) 
            VALUES 
            ('$userid', '$s1', '$s2', '$s3', '$s4', '$s5', '$s6')";
}

$result = mysqli_query($con, $sql);

if ($result) {
    // Set Approval Status to 'Pending'
    $update_status = "UPDATE `registration` SET `photos_approval_status`='Pending', `photosinfo`='Done' WHERE `userid`='$userid'";
    mysqli_query($con, $update_status);
} else {
    echo "Error updating photos: " . mysqli_error($con);
    exit;
}

// --- 3. EMAIL NOTIFICATION (Optional: Notify user that changes are under review) ---
$email = $_COOKIE['dr_email'];
$fullname =  $_COOKIE['dr_name'];
$subject = "Photos updated - Under Screening";
$mailContent = "
    <div style='width:90%; margin:2% auto; padding:3%;'>
        <div style='text-align:center'>
            <img src='http://myptetest.com/desirishta/images/tlogo.png' style='width:50%'>
        </div>
        <div style='width:100%; margin:0 auto'>
            <div style='color:#000; width:90%; margin:0 auto;'>
                <p style='font-size:15px;'>Dear $fullname,</p>
                <p style='font-size:15px;'>You have recently updated your profile photos. These changes are currently under screening.</p>
                <p style='font-size:15px;'>Once approved by our team, the new photos will be visible on your live profile.</p>
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
    CURLOPT_POSTFIELDS => array('to' => $email, 'from' => 'info@noreplies.co.in', 'from_name' => 'Desi Rishta', 'subject' => $subject, 'body' => $mailContent, 'token' => '74765968c67007219b197f4d9aafb4e2'),
));
$response = curl_exec($curl);
curl_close($curl);

// --- 4. REDIRECT TO EDIT PAGE ---
header('location:user-profile-edit.php?tab=photos&photos_update=pending');
?>