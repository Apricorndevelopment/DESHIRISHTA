<?php
include 'config.php';

if(!isset($_COOKIE['dr_userid']) || $_COOKIE['dr_userid'] == '') {
    header("Location: login.php");
    exit;
}

$userid = $_COOKIE['dr_userid'];

$sqlprofile = mysqli_query($con, "SELECT * FROM registration WHERE userid='$userid'");
$rowprofile = mysqli_fetch_assoc($sqlprofile);

if(!$rowprofile){
    die("User not found!");
}

$phone = $rowprofile['phone'];
$mobile_number = $phone; 

$otp = sprintf("%04d", rand(1000, 9999));

mysqli_query($con, "UPDATE registration SET mobile_otp = '$otp' WHERE userid = '$userid'");

$message = "Dear Customer, Your Desi Rishta Mobile Verification PIN is {$otp}. It is valid for 10 minutes and is confidential. Please do not share it with anyone.";

$payload = [
    "listsms" => [
        [
            "sms"        => $message,
            "mobiles"    => $mobile_number,
            "senderid"   => "DSIRST",
            "tempid"     => "1207176681662137357",
            "responsein" => "json"
        ]
    ],
    "user"     => "desirsms",
    "password" => "30c3c138b0XX" 
];

$jsonPayload = json_encode($payload);

$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL            => "https://www.proactivesms.in/REST/sendsms",
    CURLOPT_POST           => true,
    CURLOPT_POSTFIELDS     => $jsonPayload,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER     => ["Content-Type: application/json"],
    CURLOPT_TIMEOUT        => 20
]);

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError = curl_error($ch);
curl_close($ch);

if ($http_code == 200 && $response !== false) {
    header("Location: enter-mobile-otp.php?status=success&mobile=$phone");
    exit;
} else {
    ?>
    <script>
        alert("❌ OTP bhejne me problem aayi! Please try again.\nError: <?= addslashes($curlError); ?>");
        window.location.href = "enter-mobile-otp.php?status=failed";
    </script>
    <?php
    exit;
}
?>