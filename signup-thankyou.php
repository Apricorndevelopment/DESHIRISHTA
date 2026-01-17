<?php
include 'header.php';

require_once 'email_layout_template.php';

$email = $_COOKIE['dr_email'];
$fullname =  $_COOKIE['dr_name'];
$subject = "Welcome to Desi Rishta";
$customHtml = "
          <p style='font-size:15px;'>Dear $fullname,</p>
                <p style='font-size:15px;'>On behalf of the entire Desi Rishta team, I extend a warm welcome to you! We are thrilled to have you on board.</p>
                <p style='font-size:15px;'>Your profile is currently under screening. Once we determine that your profile meets our terms and conditions, your account will be made live. You will be notified once this process is complete. In the meantime, please continue your partner search on Desi Rishta.</p>
                <p style='font-size:15px;'>If you have any questions or need assistance, our support team is here to help.</p>
";

$mailContent = getEmailLayout($customHtml);
?>
    <!-- LOGIN -->
    <section>
        <div class="login">
            <div class="container">
                <div class="row">

                    <div class="inn">
                        <div class="lhs">
                            <div class="tit">
                                <h2>Now <b>Find <br> your life partner</b> Easy and fast.</h2>
                            </div>
                            <div class="im">
                                <img src="images/login-couple.png" alt="">
                            </div>
                            <div class="log-bg">&nbsp;</div>
                        </div>
                        <div class="rhs">
                            <div>
                                <div class="form-login">
                                    <div class="edit-pro-parti text-center pb-2">
                                        <img src="images/gif/congrats.gif" style="width:20%">
                                        <h2>Thank you for completing your profile! </h2>
                                        <div class="row">
                                            <div class="col-md-12"><p>Your profile is currently being reviewed by our team. Once approved, your profile will be activated and made live. You'll be notified via Email or WhatsApp message when your profile goes live.</p></div>
                                        </div>
                                    </div>
                                    <a href="user-dashboard.php" class="btn btn-primary">Go To My Dashboard</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- END -->

<?php
include 'footer.php';

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://app.smtpprovider.com/api/send-mail/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('to' => $email,'from' => 'info@noreplies.co.in','from_name' => 'Desi Rishta','subject' => $subject,'body' => $mailContent,'token' => '74765968c67007219b197f4d9aafb4e2'),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;

?>