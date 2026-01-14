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

// Error reporting band karein taki redirect me issue na aaye
error_reporting(0);
ini_set('display_errors', 0);

if(isset($_POST['send_push'])) {

    $title   = $_POST['title'];
    $message = $_POST['message'];
    $link    = $_POST['link'];

    // 2. Keys Setup
    $auth = [
        'VAPID' => [
            'subject' => 'mailto:admin@desirishta.com',
            'publicKey' => 'BHfvtXOrMtJBEsTOQyYqEPG-db9j7Ynf-Wq2mxUj8HfXkpJNOBeSmW6xhOfjiyqygUVEZIWml31L3CcFZR--dMg',
            'privateKey' => 'o6XF_j9JVGaUnTmQsHLbfXR1E8eYpX1cX3BZxLTZJbU',
        ],
    ];

    $webPush = new WebPush($auth);

    $res = mysqli_query($con, "SELECT * FROM web_push_subscriptions");
    
    if(mysqli_num_rows($res) > 0) {
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
                'icon' => 'images/logo.png'
            ]);

            $webPush->queueNotification($subscription, $payload);
        }
    }

    // 3. FLUSH & SILENT CLEANUP
    foreach ($webPush->flush() as $report) {
        $endpoint = $report->getRequest()->getUri()->__toString();

        if (!$report->isSuccess()) {
            // Agar subscription expired/invalid hai, to DB se delete karein (Silent Mode)
            if ($report->isSubscriptionExpired()) {
                $safeEndpoint = mysqli_real_escape_string($con, $endpoint);
                mysqli_query($con, "DELETE FROM web_push_subscriptions WHERE endpoint = '$safeEndpoint'");
            }
        }
    }

    // 4. Redirect with Success Message
    header("Location: send-push.php?msg=sent");
    exit();
}
?>