<?php
require __DIR__ . '/../vendor/autoload.php';
include '../config.php';

use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

if(isset($_POST['send_push'])) {

    $title   = $_POST['title'];
    $message = $_POST['message'];
    $link    = $_POST['link'];

    $vapid = [
        'subject' => 'mailto:admin@desirishta.com',
        'publicKey' => 'YOUR_PUBLIC_VAPID_KEY',
        'privateKey' => 'YOUR_PRIVATE_VAPID_KEY',
    ];

    $webPush = new WebPush($vapid);

    $res = mysqli_query($con, "SELECT * FROM web_push_subscriptions");

    while($row = mysqli_fetch_assoc($res)) {

        $subscription = Subscription::create([
            'endpoint' => $row['endpoint'],
            'publicKey' => $row['p256dh'],
            'authToken' => $row['auth'],
        ]);

        $payload = json_encode([
            'title' => $title,
            'message' => $message,
            'link' => $link
        ]);

        $webPush->sendOneNotification($subscription, $payload);
    }

    $webPush->flush();

    echo "<script>alert('Push Notification Sent Successfully');window.location.href='send-push.php';</script>";
}
