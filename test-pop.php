<?php
// 1. Database Connection include karein (Isi mein $con variable hota hai)
if (file_exists('config.php')) {
    include 'config.php';
} else {
    die("Error: config.php file nahi mili. Database connection setup karein.");
}

// 2. Cookie check karein (Error Fix: Undefined array key "dr_userid")
$userid = isset($_COOKIE['dr_userid']) ? $_COOKIE['dr_userid'] : '';

// Agar user logged in nahi hai toh redirect karein
if (empty($userid)) {
    header('location:login.php');
    exit;
}

// --- TIMEZONE AND DATE VARIABLES ---
date_default_timezone_set('Asia/Kolkata');
$current_time = date('Y-m-d H:i:s');
$current_date = date('Y-m-d');

// 3. User Data Fetch (Error Fix: Fatal error mysqli_query)
// Ensure karein ki $con variable 'config.php' mein define kiya gaya hai
$sql_user_data = "SELECT name, verificationinfo, verification_popup, profilestatus, profilestatus_popup FROM registration WHERE userid = '$userid'";
$result_user_data = mysqli_query($con, $sql_user_data);

if ($result_user_data && mysqli_num_rows($result_user_data) > 0) {
    $row_user_data = mysqli_fetch_assoc($result_user_data);
    
    $id_verification = $row_user_data['verificationinfo'];
    $id_verification_popup = $row_user_data['verification_popup'];
    $id_profilestatus = $row_user_data['profilestatus'];
    $id_profilestatus_popup = $row_user_data['profilestatus_popup'];
    
    $my_name = explode(' ', trim($row_user_data['name']))[0];
} else {
    // Default values agar data na mile
    $id_verification_popup = '1'; 
    $id_profilestatus_popup = '1';
    $my_name = "User";
}

// ... baaki popup queue ka logic ...
?>