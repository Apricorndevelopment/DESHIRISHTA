<?php
$aadharnumber = $_POST['aadharnumber'];
setcookie("dr_adhaar", $aadharnumber, time() + (10 * 365 * 24 * 60 * 60));

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://kyc-api.aadhaarkyc.io/api/v1/aadhaar-v2/generate-otp?id_number='.$aadharnumber,
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

?>

<div class="row">
    <?php
    if($obj["message"] == 'OTP Sent.')
    {
    ?>
    <div class="col-md-4 form-group">
        <label class="lb">Adhaar Number: <span class="text-danger">*</span></label>
        <input type="text" class="form-control is-valid" id="aadharnumber1" placeholder="Enter Details" name="adhaarnum" value="<?php echo $aadharnumber; ?>">
        <span class="text-success"><?php echo $obj["message"]; ?></span>
    </div>
    <?php
    }
    else
    {
    ?>
    <div class="col-md-4 form-group">
        <label class="lb">Adhaar Number: <span class="text-danger">*</span></label>
        <input type="text" class="form-control is-invalid" id="aadharnumber1" placeholder="Enter Details" name="adhaarnum" value="<?php echo $aadharnumber; ?>">
        <span class="text-success"><?php echo $obj["message"]; ?></span>
    </div>
    <?php
    }
    ?>
    <div class="col-md-4 form-group">
        <label class="lb">Adhaar OTP: <span class="text-danger">*</span></label>
        <input type="hidden" id="clientid" class="form-control" name="clientid" value="<?php echo $obj["data"]["client_id"]; ?>"/>
        <input type="text" id="otp" class="form-control" placeholder="Enter Details" name="adhaarotp">
    </div>
    <div class="col-md-4 form-group">
        <label class="lb"></label>
        <button type="button" class="btn btn-primary m-0" id="adhaarvalidate">Validate</button>
    </div>
</div>

<script>
        $(document).ready(function(){
            $('#adhaarvalidate').click(function(){
                //do something
                var client = $('#clientid').val();
                var otp = $('#otp').val();
                
                var otplen = $('#otp').val().length;
                
                if(otplen == '6')
                {
                    $.ajax({
                        type: "POST",
                        url: "api_aadharverification.php",
                        data: { clientid : client, sentotp : otp} 
                    }).done(function(data){
                        $("#aadhardata").html(data);
                    });
                }
            });
        });
</script>

<script>
        $(document).ready(function(){
            //setup before functions
            var typingTimer1;                //timer identifier
            var doneTypingInterval1 = 1000;  //time in ms (5 seconds)
            
            //on keyup, start the countdown
            $('#aadharnumber1').keyup(function(){
                clearTimeout(typingTimer1);
                if ($('#aadharnumber1').val()) {
                    typingTimer1 = setTimeout(doneTyping1, doneTypingInterval1);
                }
            });
            
            //user is "finished typing," do something
            function doneTyping1 () {
                //do something
                var aadharnum = $('#aadharnumber1').val();
                
                var aadharnumlen = $('#aadharnumber1').val().length;
                
                if(aadharnumlen == '12')
                {
                    $.ajax({
                        type: "POST",
                        url: "api_aadharotp.php",
                        data: { aadharnumber : aadharnum} 
                    }).done(function(data){
                        $("#aadharnumber1").addClass('is-valid')
                        $("#aadharbox").html(data);
                    });
                }
                else
                {
                    $("#aadharnumber1").addClass('is-invalid')
                }
            }
        });
</script>
