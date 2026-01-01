<?php
include 'config.php';
date_default_timezone_set('Asia/Kolkata');

/* =========================
   VALIDATION
========================= */
$phone = trim($_POST['phonenum'] ?? '');

if (!preg_match('/^[6-9]\d{9}$/', $phone)) {
    die("Invalid mobile number");
}

$otp = rand(1000, 9999);

$message = "Dear Customer, Your Desi Rishta verification PIN is {$otp}. "
         . "It is valid for 10 minutes and is confidential. "
         . "Please do not share it with anyone.";


$payload = [
    "listsms" => [
        [
            "sms"        => $message,
            "mobiles"    => $phone,
            "senderid"   => "DSIRST",
            "tempid"     => "1207176473586978716",
            "responsein" => "json"
        ]
    ],
    "user"     => "desirsms",
    "password" => "30c3c138b0XX"
];

$jsonPayload = json_encode($payload);

/* =========================
   CURL REQUEST
========================= */
$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL            => "https://www.proactivesms.in/REST/sendsms",
    CURLOPT_POST           => true,
    CURLOPT_POSTFIELDS     => $jsonPayload,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER     => ["Content-Type: application/json"]
]);

$response = curl_exec($ch);
$curlError = curl_error($ch);
curl_close($ch);

/* =========================
   LOG SMS RESPONSE
========================= */
file_put_contents(
    "sms_debug.log",
    date('Y-m-d H:i:s') . "\n$response\n$curlError\n\n",
    FILE_APPEND
);

/* =========================
   SAVE OTP (FIXED WAY)
========================= */
$stmt = mysqli_prepare(
    $con,
    "INSERT INTO mobile_otp (mobile, otp, status)
     VALUES (?, ?, 0)"
);

if (!$stmt) {
    die("Prepare failed: " . mysqli_error($con));
}

mysqli_stmt_bind_param($stmt, "si", $phone, $otp);

if (mysqli_stmt_execute($stmt)) {
    echo "OTP SENT & SAVED";
} else {
    file_put_contents(
        "db_error.log",
        date('Y-m-d H:i:s') . " - " . mysqli_error($con) . "\n",
        FILE_APPEND
    );
    echo "OTP SENT BUT DB ERROR";
}

mysqli_stmt_close($stmt);
?>
