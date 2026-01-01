<?php
// Errors dekhne ke liye settings on karein
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Log file mein entry shuru karein
file_put_contents('debug_log.txt', "--- New Request at " . date('Y-m-d H:i:s') . " ---\n", FILE_APPEND);

// 1. Config file check
if (!file_exists('config.php')) {
    file_put_contents('debug_log.txt', "Error: config.php not found!\n", FILE_APPEND);
    die("Config missing");
}

include 'config.php';

// 2. Database connection check
if (!$con) {
    file_put_contents('debug_log.txt', "Error: Database connection failed: " . mysqli_connect_error() . "\n", FILE_APPEND);
    die("Connection failed");
}

// 3. Receive Data
$json_input = file_get_contents("php://input");
file_put_contents('debug_log.txt', "Received Data: " . $json_input . "\n", FILE_APPEND);

$data = json_decode($json_input, true);

if ($data) {
    $endpoint = mysqli_real_escape_string($con, $data['endpoint']);
    $p256dh  = mysqli_real_escape_string($con, $data['keys']['p256dh']);
    $auth    = mysqli_real_escape_string($con, $data['keys']['auth']);

    // 4. Run Query
    $sql = "INSERT INTO web_push_subscriptions (endpoint, p256dh, auth) VALUES ('$endpoint', '$p256dh', '$auth')";
    
    if (mysqli_query($con, $sql)) {
        file_put_contents('debug_log.txt', "Success: Data inserted into DB\n", FILE_APPEND);
        echo "Success";
    } else {
        file_put_contents('debug_log.txt', "SQL Error: " . mysqli_error($con) . "\n", FILE_APPEND);
        echo "SQL Error";
    }
} else {
    file_put_contents('debug_log.txt', "Error: JSON data empty or invalid\n", FILE_APPEND);
}
?>