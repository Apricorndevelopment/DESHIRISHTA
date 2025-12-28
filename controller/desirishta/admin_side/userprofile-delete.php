<?php
include 'config.php'; // DB connection

// UID check
if (!isset($_GET['uid']) || $_GET['uid'] == '') {
    echo "<script>alert('Invalid Request'); window.history.back();</script>";
    exit;
}

$uid = mysqli_real_escape_string($con, $_GET['uid']);

// OPTIONAL: pehle user exist karta hai ya nahi check
$check = mysqli_query($con, "SELECT * FROM registration WHERE userid='$uid'");
if (mysqli_num_rows($check) == 0) {
    echo "<script>alert('User not found'); window.history.back();</script>";
    exit;
}

// DELETE user
$delete = mysqli_query($con, "DELETE FROM registration WHERE userid='$uid'");

if ($delete) {
    echo "<script>
        alert('User profile deleted successfully');
        window.location.href='user-profiles.php';
    </script>";
} else {
    echo "<script>alert('Something went wrong'); window.history.back();</script>";
}
?>
