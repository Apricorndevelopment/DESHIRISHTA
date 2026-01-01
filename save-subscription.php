<?php
// Errors dekhne ke liye settings
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Config check
if (!file_exists('config.php')) {
    die("Config missing");
}
include 'config.php';

// DB Check
if (!$con) {
    die("Connection failed");
}

// Receive Data
$json_input = file_get_contents("php://input");
$data = json_decode($json_input, true);

if ($data) {
    $endpoint = mysqli_real_escape_string($con, $data['endpoint']);
    $p256dh  = mysqli_real_escape_string($con, $data['keys']['p256dh']);
    $auth    = mysqli_real_escape_string($con, $data['keys']['auth']);

    // --- MAIN FIX: Pehle check karein ki user exist karta hai ya nahi ---
    $check_query = "SELECT id FROM web_push_subscriptions WHERE endpoint = '$endpoint'";
    $check_res = mysqli_query($con, $check_query);

    if (mysqli_num_rows($check_res) > 0) {
        // Agar user pehle se hai, toh sirf keys update karein (Insert nahi)
        $sql = "UPDATE web_push_subscriptions SET p256dh='$p256dh', auth='$auth' WHERE endpoint='$endpoint'";
        mysqli_query($con, $sql);
        echo "Updated"; // Frontend ko pata chalega ki update hua
    } else {
        // Agar naya user hai, tabhi INSERT karein
        $sql = "INSERT INTO web_push_subscriptions (endpoint, p256dh, auth) VALUES ('$endpoint', '$p256dh', '$auth')";
        
        if (mysqli_query($con, $sql)) {
            echo "Inserted";
        } else {
            echo "SQL Error";
        }
    }
} else {
    echo "Invalid Data";
}
?>