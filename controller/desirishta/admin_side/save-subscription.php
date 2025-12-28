<?php
include 'config.php';

$data = json_decode(file_get_contents("php://input"), true);

$endpoint = $data['endpoint'];
$p256dh  = $data['keys']['p256dh'];
$auth    = $data['keys']['auth'];

mysqli_query($con, "INSERT INTO web_push_subscriptions (endpoint, p256dh, auth)
VALUES ('$endpoint','$p256dh','$auth')");
