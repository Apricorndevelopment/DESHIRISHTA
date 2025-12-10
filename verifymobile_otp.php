<?php
include 'config.php';

// ------------------------
// USER LOGIN CHECK
// ------------------------
if(!isset($_COOKIE['dr_userid']) || $_COOKIE['dr_userid'] == '') {
    header("Location: login.php");
    exit;
}

$userid = $_COOKIE['dr_userid'];

// ------------------------
// FETCH USER DATA
// ------------------------
$sqlprofile = mysqli_query($con, "SELECT * FROM registration WHERE userid='$userid'");
$rowprofile = mysqli_fetch_assoc($sqlprofile);

if(!$rowprofile){
    die("User not found!");
}

$phone = $rowprofile['phone'];
$mobile_number = "91" . $phone;


$otp = sprintf("%04d", rand(0, 9999));

// ------------------------
// UPDATE TEMP OTP IN DB
// ------------------------
// mysqli_query($con, "UPDATE registration SET temp_otp = '$otp' WHERE userid = '$userid'");
mysqli_query($con, "UPDATE registration SET mobile_otp = '$otp' WHERE userid = '$userid'");

$message = "Dear User, Your one time authentication is $otp, Regards SKDG Websoft Technologies (OPC) Pvt. Ltd.";
$message_encoded = urlencode($message);

// ------------------------
// PRIMECLICK SMS API URL
// ------------------------
$api_url = "http://sms.primeclick.in/api/mt/SendSMS";
$api_url .= "?user=Skdgtech";
$api_url .= "&password=Skdg%40123";
$api_url .= "&senderid=SKDGTE";
$api_url .= "&channel=trans";
$api_url .= "&DCS=0";
$api_url .= "&flashsms=0";
$api_url .= "&number=$mobile_number";
$api_url .= "&text=$message_encoded";
$api_url .= "&route=15";
$api_url .= "&DLTTemplateId=1707169572357217271";
$api_url .= "&PEID=1701169547177152621";

// ------------------------
// CURL EXECUTION
// ------------------------
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $api_url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_TIMEOUT => 20
));

$response = curl_exec($curl);
$http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);

// ----------------------------------
// OPTIONAL DEBUGGING (Remove Later)
// ----------------------------------
// echo "HTTP CODE: $http_code <br> RESPONSE: $response"; exit;

// ------------------------
// RESPONSE VALIDATION
// ------------------------
// ------------------------
// RESPONSE VALIDATION
// ------------------------
if ($http_code == 200 && !empty($response) && (stripos($response, "Done") !== false || stripos($response, "Success") !== false)) {

    header("Location: enter-mobile-otp.php?status=success&mobile=$phone");
    exit;

} else {

    ?>
    <script>
        alert("❌ OTP bhejne me problem aayi! Please try again.\nServer Response: <?= addslashes($response); ?>");
        window.location.href = "enter-mobile-otp.php?status=failed";
    </script>
    <?php
    exit;
}

?>
