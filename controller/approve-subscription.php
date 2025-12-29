<?php
include 'config.php';

// Debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if(isset($_GET['req_id']) && isset($_GET['action'])) {
    $req_id = mysqli_real_escape_string($con, $_GET['req_id']);
    $action = $_GET['action'];

    if($action == 'approve') {
        // 1. Fetch Request (LEFT JOIN use kiya taaki pata chale kya missing hai)
        $req_sql = "SELECT r.id, r.user_id, r.plan_id, 
                           p.id as plan_exists, p.validity_days, p.plan_name,
                           u.userid as user_exists, u.email 
                    FROM tbl_subscription_requests r
                    LEFT JOIN tbl_plans p ON r.plan_id = p.id
                    LEFT JOIN registration u ON r.user_id = u.userid
                    WHERE r.id = '$req_id'";
        
        $req_res = mysqli_query($con, $req_sql);
        
        // Check if Request ID itself exists
        if(mysqli_num_rows($req_res) == 0) {
             echo "<script>alert('Error: Request ID #$req_id not found in database.'); window.location.href='subscription-requests.php';</script>";
             exit;
        }

        $req_data = mysqli_fetch_assoc($req_res);

        // 2. Validate Relationships (Specific Errors)
        if(empty($req_data['user_exists'])) {
            // User ID registration table mein nahi mili
            echo "<script>alert('Critical Error: User ID ({$req_data['user_id']}) not found in Registration table. Cannot approve.'); window.location.href='subscription-requests.php';</script>";
            exit;
        }

        if(empty($req_data['plan_exists'])) {
             // Plan ID table mein nahi mili
             echo "<script>alert('Critical Error: Plan ID ({$req_data['plan_id']}) not found in Plans table. Cannot approve.'); window.location.href='subscription-requests.php';</script>";
             exit;
        }

        // 3. Proceed if everything is valid
        $userid = $req_data['user_id'];
        $plan_id = $req_data['plan_id'];
        $validity = (int)$req_data['validity_days'];
        
        $start_date = date('Y-m-d');
        $expiry_date = date('Y-m-d', strtotime("+$validity days"));

        // Update User
        $update_user = "UPDATE registration SET plan_id='$plan_id', plan_start_date='$start_date', plan_expiry_date='$expiry_date' WHERE userid='$userid'";
        
        if(mysqli_query($con, $update_user)) {
            // Update Request Status
            mysqli_query($con, "UPDATE tbl_subscription_requests SET status='Approved' WHERE id='$req_id'");
            
            // Reject other pending requests for same user (Cleanup)
            mysqli_query($con, "UPDATE tbl_subscription_requests SET status='Rejected' WHERE user_id='$userid' AND status='Pending' AND id != '$req_id'");
            
            // Send Email Logic (Optional - Uncomment if mail server configured)
            // $to = $req_data['email'];
            // $subject = "Subscription Approved";
            // $msg = "Congratulations! Your plan has been upgraded to {$req_data['plan_name']}.";
            // mail($to, $subject, $msg);
            
            echo "<script>alert('Plan Approved Successfully!'); window.location.href='subscription-requests.php';</script>";
        } else {
             echo "<script>alert('Database Error during update: " . mysqli_error($con) . "'); window.location.href='subscription-requests.php';</script>";
        }

    } elseif($action == 'reject') {
        mysqli_query($con, "UPDATE tbl_subscription_requests SET status='Rejected' WHERE id='$req_id'");
        echo "<script>alert('Request Rejected.'); window.location.href='subscription-requests.php';</script>";
    }
} else {
    header("location:subscription-requests.php");
}
?>