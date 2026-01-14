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

// --- FIX 1: Fetch Plan ID and Dynamic Limit from Database ---
// पहले यूजर का plan_id निकालें
$sql_user = "SELECT plan_id FROM registration WHERE userid = '$viewer_id'";
$res_user = mysqli_query($con, $sql_user);
$row_user = mysqli_fetch_assoc($res_user);

$plan_id = $row_user['plan_id'] ?? 1; // Default to ID 1 (Free) if not set

// अब उस plan_id के लिए tbl_plans से लिमिट निकालें
$sql_plan = "SELECT contacts_per_day FROM tbl_plans WHERE id = '$plan_id'";
$res_plan = mysqli_query($con, $sql_plan);

if($res_plan && mysqli_num_rows($res_plan) > 0) {
    $row_plan = mysqli_fetch_assoc($res_plan);
    $daily_limit = $row_plan['contacts_per_day'];
} else {
    $daily_limit = 5; // Fallback default
}

// 2. Count Today's Views
$sql_count = "SELECT COUNT(*) as used FROM contact_view_logs WHERE viewer_id = '$viewer_id' AND view_date = '$current_date'";
$res_count = mysqli_query($con, $sql_count);
$row_count = mysqli_fetch_assoc($res_count);
$used_views = $row_count['used'];

$remaining_views = $daily_limit - $used_views;

// 3. Check if user already viewed THIS profile
$sql_check_dup = "SELECT * FROM contact_view_logs WHERE viewer_id = '$viewer_id' AND viewed_id = '$viewed_id' AND view_date = '$current_date'";
$res_check_dup = mysqli_query($con, $sql_check_dup);

if(mysqli_num_rows($res_check_dup) > 0) {
    echo json_encode(['status' => 'success', 'remaining' => $remaining_views, 'message' => 'Already viewed']);
    exit;
}

// 4. Process Logic
if($used_views < $daily_limit) {
    // Deduct Quota
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