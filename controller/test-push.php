<?php
require __DIR__ . '/../vendor/autoload.php';

include 'config.php';

use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

$vapid = [
    'subject' => 'mailto:admin@desirishta.com',
    'publicKey' => 'BHfvtXOrMtJBEsTOQyYqEPG-db9j7Ynf-Wq2mxUj8HfXkpJNOBeSmW6xhOfjiyqygUVEZIWml31L3CcFZR--dMg',
    'privateKey' => 'o6XF_j9JVGaUnTmQsHLbfXR1E8eYpX1cX3BZxLTZJbU',
];

$webPush = new WebPush($vapid);

$res = mysqli_query($con, "SELECT * FROM web_push_subscriptions");

while ($row = mysqli_fetch_assoc($res)) {
    $sub = Subscription::create([
        'endpoint' => $row['endpoint'],
        'publicKey' => $row['p256dh'],
        'authToken' => $row['auth']
    ]);

    $payload = json_encode([
        'title' => '🔥 Test Notification',
        'message' => 'Web Push successfully working!',
        'link' => 'https://desi-rishta.com'
    ]);

    $webPush->sendOneNotification($sub, $payload);
}

$webPush->flush();

echo "Push Sent";
