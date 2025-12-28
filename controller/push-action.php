<?php
// --- 1. XAMPP OpenSSL Fix (Localhost ke liye Zaroori) ---
$configPath = 'C:\xampp\apache\conf\openssl.cnf'; 
if (file_exists($configPath)) {
    putenv("OPENSSL_CONF=$configPath");
} else {
    putenv("OPENSSL_CONF=C:\xampp\php\extras\ssl\openssl.cnf");
}
// -------------------------------------------------------

require __DIR__ . '/../vendor/autoload.php';
include '../config.php';

use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

// Error display on karein testing ke liye
error_reporting(E_ALL);
ini_set('display_errors', 1);

if(isset($_POST['send_push'])) {

    $title   = $_POST['title'];
    $message = $_POST['message'];
    $link    = $_POST['link'];

    // 2. Asli Keys Yahan Set Karein (Placeholder nahi chalega)
    $auth = [
        'VAPID' => [
            'subject' => 'mailto:admin@desirishta.com',
            'publicKey' => 'BHfvtXOrMtJBEsTOQyYqEPG-db9j7Ynf-Wq2mxUj8HfXkpJNOBeSmW6xhOfjiyqygUVEZIWml31L3CcFZR--dMg',
            'privateKey' => 'o6XF_j9JVGaUnTmQsHLbfXR1E8eYpX1cX3BZxLTZJbU', // Aapki private key
        ],
    ];

    // WebPush initialize karein
    $webPush = new WebPush($auth);

    // Database se users layein
    $res = mysqli_query($con, "SELECT * FROM web_push_subscriptions");
    
    if(mysqli_num_rows($res) == 0) {
        die("<h3>Error: Database me koi subscriber nahi hai. Pehle 'Allow Notification' karein.</h3>");
    }

    echo "<h3>Notification Sending Report:</h3><ul>";

    while($row = mysqli_fetch_assoc($res)) {

        $subscription = Subscription::create([
            'endpoint' => $row['endpoint'],
            'publicKey' => $row['p256dh'],
            'authToken' => $row['auth'],
        ]);

        $payload = json_encode([
            'title' => $title,
            'message' => $message,
            'link' => $link,
            'icon' => 'images/logo.png' // Icon path check karein
        ]);

        // Notification queue mein dalein
        $webPush->queueNotification($subscription, $payload);
    }

    // 3. FLUSH aur REPORT Check (Sabse Important Step)
    // Ye actually send karega aur batayega ki success hua ya fail
    foreach ($webPush->flush() as $report) {
        $endpoint = $report->getRequest()->getUri()->__toString();

        if ($report->isSuccess()) {
            echo "<li style='color:green;'>✅ Success: Notification sent successfully!</li>";
        } else {
            echo "<li style='color:red;'>❌ Failed: " . $report->getReason() . "</li>";
            
            // Agar subscription expire ho gayi hai, toh use delete kar dein
            if ($report->isSubscriptionExpired()) {
                echo "<span>(Subscription expired, deleting from DB...)</span>";
                // Optional: Delete query here
            }
        }
    }
    echo "</ul>";
    echo "<br><a href='send-push.php'>Go Back</a>";
}
?>