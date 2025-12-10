<?php
include 'config.php';

$phone = $_POST['phonenum'];
$otp = rand(0000,9999);

$curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://sms.primeclick.in/api/mt/SendSMS?user=Skdgtech&password=Skdg%40123&senderid=SKDGTE&channel=trans&DCS=0&flashsms=0&number='.$phone.'&text=Dear%20User%2C%20Your%20one%20time%20authentication%20is%20'.$otp.'%2C%20Regards%20SKDG%20Websoft%20Technologies%20(OPC)%20Pvt.%20Ltd.&route=15&DLTTemplateId=1707169572357217271&PEID=1701169547177152621',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;

$sql = "INSERT INTO `mobile_otp`(`mobile`, `otp`, `status`) VALUES ('$phone', '$otp', '0')";
$result = mysqli_query($con,$sql);
?>