<?php
include 'config.php';

if(isset($_GET['uid']) && isset($_GET['plan_id'])) {
    $uid = mysqli_real_escape_string($con, $_GET['uid']);
    $plan_id = mysqli_real_escape_string($con, $_GET['plan_id']);

    // 1. पहले चुने गए प्लान की Validity (दिन) निकालें
    $plan_sql = "SELECT validity_days FROM tbl_plans WHERE id = '$plan_id'";
    $plan_res = mysqli_query($con, $plan_sql);
    
    if(mysqli_num_rows($plan_res) > 0) {
        $plan_row = mysqli_fetch_assoc($plan_res);
        $days = (int)$plan_row['validity_days']; // जैसे 200, 300, 365 आदि
    } else {
        $days = 0; // अगर प्लान न मिले
    }

    // 2. नई Expiry Date कैलकुलेट करें (आज की तारीख + प्लान के दिन)
    $start_date = date('Y-m-d');
    $expiry_date = date('Y-m-d', strtotime("+$days days"));

    // 3. अब Plan ID के साथ-साथ Dates भी अपडेट करें
    $sql = "UPDATE registration SET 
            plan_id = '$plan_id',
            plan_start_date = '$start_date',
            plan_expiry_date = '$expiry_date'
            WHERE userid = '$uid'";
    
    if(mysqli_query($con, $sql)) {
        // Redirect back with success
        echo "<script>alert('Plan & Validity Updated Successfully!'); window.location.href='userprofile-view.php?uid=$uid';</script>";
    } else {
        echo "<script>alert('Error updating plan.'); window.location.href='userprofile-view.php?uid=$uid';</script>";
    }
} else {
    header("Location: dashboard.php");
}
?>