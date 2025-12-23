<?php
include 'config.php';
$clientid = $_POST['clientid'];
$sentotp = $_POST['sentotp'];

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://kyc-api.aadhaarkyc.io/api/v1/aadhaar-v2/submit-otp?client_id='.$clientid.'&otp='.$sentotp,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJmcmVzaCI6ZmFsc2UsImlhdCI6MTY5MTEzNTgzOSwianRpIjoiMTVkNjZkNzctNmI1NS00ZGVkLWFjYzAtYzc0MTFmNmFkZmY5IiwidHlwZSI6ImFjY2VzcyIsImlkZW50aXR5IjoiZGV2LmhhdmVuZGF4YUBzdXJlcGFzcy5pbyIsIm5iZiI6MTY5MTEzNTgzOSwiZXhwIjoyMDA2NDk1ODM5LCJ1c2VyX2NsYWltcyI6eyJzY29wZXMiOlsid2FsbGV0Il19fQ.bA_cc7sJEP4oVoT7T8Bie2jiu4M__mph1quJ6_Udq_w'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;

$obj = json_decode($response, true);

$userid = $_COOKIE['dr_userid'];
$aadharnumber = $_COOKIE['dr_adhaar'];
$fullname =  $obj["data"]["full_name"];
$dob =  $obj["data"]["dob"];
$gender = $obj["data"]["gender"];
$fathername = $obj["data"]["care_of"];
$house = $obj["data"]["address"]["house"];
$street =  $obj["data"]["address"]["street"];
$landmark = $obj["data"]["address"]["landmark"];
$loc = $obj["data"]["address"]["loc"];
$vtc = $obj["data"]["address"]["vtc"];
$po = $obj["data"]["address"]["po"];
$subdist = $obj["data"]["address"]["subdist"];
$dist = $obj["data"]["address"]["dist"];
$state = $obj["data"]["address"]["state"];
$zip = $obj["data"]["zip"];
$full = $house.' '.$street.' '.$landmark.' '.$loc.' '.$vtc.' '.$po;

$sqladhaar = "INSERT INTO `verification_info`(`userid`, `adhaarnum`, `adhaarotp`, `fullname`, `address`, `city`, `state`, `pincode`) VALUES ('$userid', '$aadharnumber', '', '$fullname', '$full', '$dist', '$state', '$zip')";
$resultadhaar = mysqli_query($con,$sqladhaar);

$updateverification = "UPDATE `registration` SET `verificationinfo`='Done' WHERE `userid`='$userid'";
$resultverification = mysqli_query($con,$updateverification);

?>
<div class="row">
    <div class="col-md-4 form-group">
        <label class="lb">Full Name <span class="text-danger">*</span></label>
        <input type="text" class="form-control" placeholder="Enter Details (Auto fetch)" name="fullname" value="<?php echo $fullname; ?>" readonly>
    </div>
    <div class="col-md-8 form-group">
        <label class="lb">Address <span class="text-danger">*</span></label>
        <input type="text" class="form-control text-capitalize" placeholder="Enter Details (Auto fetch)" name="address" value="<?php echo $full; ?>" readonly>
    </div>
    <div class="col-md-4 form-group">
        <label class="lb">City <span class="text-danger">*</span></label>
        <input type="text" class="form-control" placeholder="Enter Details (Auto fetch)" name="city" value="<?php echo $dist; ?>"  readonly>
    </div>
    <div class="col-md-4 form-group">
        <label class="lb">State <span class="text-danger">*</span></label>
        <input type="text" class="form-control" placeholder="Enter Details (Auto fetch)" name="state" value="<?php echo $state; ?>"  readonly>
    </div>
    <div class="col-md-4 form-group">
        <label class="lb">Pincode <span class="text-danger">*</span></label>
        <input type="text" class="form-control" placeholder="Enter Details (Auto fetch)" name="pincode" value="<?php echo $zip; ?>"  readonly>
    </div>
</div>
