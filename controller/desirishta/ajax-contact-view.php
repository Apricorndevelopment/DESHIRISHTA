<?php
include 'config.php';

// Set Timezone
date_default_timezone_set('Asia/Kolkata');
$current_date = date('Y-m-d');

// Get User ID from Cookie
if(!isset($_COOKIE['dr_userid'])) {
    echo json_encode(['status' => 'error', 'message' => 'Please login first']);
    exit;
}

$viewer_id = $_COOKIE['dr_userid'];
$viewed_id = $_POST['viewed_id'];

// 1. Determine Daily Limit based on User's Plan
// You can fetch this from a 'plans' table or hardcode as per your plans.php
$sql_user = "SELECT plan_name FROM registration WHERE userid = '$viewer_id'";
$res_user = mysqli_query($con, $sql_user);
$row_user = mysqli_fetch_assoc($res_user);
$plan_name = $row_user['plan_name'] ?? 'Free';

$daily_limit = 5; // Default Free
if($plan_name == 'Gold') { $daily_limit = 15; }
if($plan_name == 'Platinum') { $daily_limit = 25; }

// 2. Count Today's Views
$sql_count = "SELECT COUNT(*) as used FROM contact_view_logs WHERE viewer_id = '$viewer_id' AND view_date = '$current_date'";
$res_count = mysqli_query($con, $sql_count);
$row_count = mysqli_fetch_assoc($res_count);
$used_views = $row_count['used'];

$remaining_views = $daily_limit - $used_views;

// 3. Check if user already viewed THIS profile (Re-views are usually free)
// If you want to deduct quota EVERY time they click, remove this check.
// Standard logic: Once unlocked, it stays unlocked for the day without extra cost.
$sql_check_dup = "SELECT * FROM contact_view_logs WHERE viewer_id = '$viewer_id' AND viewed_id = '$viewed_id' AND view_date = '$current_date'";
$res_check_dup = mysqli_query($con, $sql_check_dup);

if(mysqli_num_rows($res_check_dup) > 0) {
    // Already viewed today, return success without deducting
    echo json_encode(['status' => 'success', 'remaining' => $remaining_views, 'message' => 'Already viewed']);
    exit;
}

// 4. Process Logic
if($used_views < $daily_limit) {
    // Deduct Quota (Insert Log)
    $sql_insert = "INSERT INTO `contact_view_logs`(`viewer_id`, `viewed_id`, `view_date`) VALUES ('$viewer_id', '$viewed_id', '$current_date')";
    if(mysqli_query($con, $sql_insert)) {
        $new_remaining = $remaining_views - 1;
        echo json_encode(['status' => 'success', 'remaining' => $new_remaining]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Database error']);
    }
} else {
    // Limit Reached
    echo json_encode(['status' => 'limit_reached', 'limit' => $daily_limit]);
}
?>