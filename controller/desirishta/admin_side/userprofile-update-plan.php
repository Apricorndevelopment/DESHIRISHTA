<?php
include 'config.php';

if(isset($_GET['uid']) && isset($_GET['plan_id'])) {
    $uid = mysqli_real_escape_string($con, $_GET['uid']);
    $plan_id = mysqli_real_escape_string($con, $_GET['plan_id']);

    // Update query
    $sql = "UPDATE registration SET plan_id = '$plan_id' WHERE userid = '$uid'";
    
    if(mysqli_query($con, $sql)) {
        // Redirect back to view profile with success
        echo "<script>alert('Plan Updated Successfully!'); window.location.href='userprofile-view.php?uid=$uid';</script>";
    } else {
        echo "<script>alert('Error updating plan.'); window.location.href='userprofile-view.php?uid=$uid';</script>";
    }
} else {
    header("Location: dashboard.php");
}
?>