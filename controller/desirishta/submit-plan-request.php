<?php
include 'config.php';

// --- DEBUGGING CODE START (Ye file 'error.logtext' banayega) ---
$log_file = 'error.logtext';
$current_time = date('Y-m-d H:i:s');
$cookie_id = isset($_COOKIE['dr_userid']) ? $_COOKIE['dr_userid'] : 'COOKIE_NOT_SET';
$post_plan = isset($_POST['plan_id']) ? $_POST['plan_id'] : 'PLAN_NOT_SET';

$log_message = "[$current_time] Attempting Request:\n";
$log_message .= "  -> User ID form Cookie: '$cookie_id'\n";
$log_message .= "  -> Requested Plan ID: '$post_plan'\n";
$log_message .= "--------------------------------------\n";

// File mein likho
file_put_contents($log_file, $log_message, FILE_APPEND);
// --- DEBUGGING CODE END ---


// 1. STRICT CHECK: Agar User ID nahi hai to roko
if (!isset($_COOKIE['dr_userid']) || empty($_COOKIE['dr_userid']) || $_COOKIE['dr_userid'] == '0') {
    // Log mein error bhi likh do
    file_put_contents($log_file, "[$current_time] ERROR: User ID missing. Request Blocked.\n\n", FILE_APPEND);
    
    echo "<script>
            alert('Error: You are not logged in properly (User ID is 0 or Empty). Please Logout and Login again.'); 
            window.location.href='login.php';
          </script>";
    exit; // Code yahi band kar do
}

$userid = mysqli_real_escape_string($con, $_COOKIE['dr_userid']);
$plan_id = mysqli_real_escape_string($con, $_POST['plan_id']);

// 2. DUPLICATE CHECK
$check_sql = "SELECT * FROM tbl_subscription_requests WHERE user_id='$userid' AND status='Pending'";
$check_res = mysqli_query($con, $check_sql);

if(mysqli_num_rows($check_res) > 0) {
    echo "<script>alert('You already have a pending request. Please wait for admin approval.'); window.location.href='user-plan.php';</script>";
} else {
    // 3. INSERT DATA
    $insert_sql = "INSERT INTO tbl_subscription_requests (user_id, plan_id, status, request_date) VALUES ('$userid', '$plan_id', 'Pending', NOW())";
    
    if(mysqli_query($con, $insert_sql)) {
        file_put_contents($log_file, "[$current_time] SUCCESS: Request Inserted for User '$userid'.\n\n", FILE_APPEND);
        echo "<script>alert('Request Sent Successfully!'); window.location.href='user-plan.php';</script>";
    } else {
        $db_err = mysqli_error($con);
        file_put_contents($log_file, "[$current_time] DB ERROR: $db_err\n\n", FILE_APPEND);
        echo "<script>alert('Database Error. Check error.logtext'); window.location.href='user-plan.php';</script>";
    }
}
?>