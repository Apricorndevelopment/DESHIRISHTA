<?php
// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
    
ob_start();
include 'config.php';

$email = $_COOKIE['dr_email'];
$name = $_COOKIE['dr_name'];

$phone = $_POST['phone'];
$otp = $_POST['otp'];

$sqlcheck = "select * from registration where phone = '$phone' and otp = '$otp'";
$resultcheck = mysqli_query($con,$sqlcheck);
$check = mysqli_num_rows($resultcheck);

if($check == '0')
{
?>
    <form action="verify-otp.php" method="post" id="myForm">
        <input type="hidden" name="invalid" value="false">
    </form>
    <script>
        document.getElementById("myForm").submit();
    </script>
<?php
}
else
{
    $sqlupdate = "UPDATE `registration` SET `otpstatus`='active' WHERE phone = '$phone' and otp = '$otp'";
    $resultupdate = mysqli_query($con,$sqlupdate);
    
    // Include PHPMailer library files
    require 'PHPMailer/Exception.php';
    require 'PHPMailer/PHPMailer.php';
    require 'PHPMailer/SMTP.php';
    
    //Create an instance of PHPMailer class
    $mail = new PHPMailer;
    
    // SMTP configuration
    $mail->isSMTP();                    // Set mailer to use SMTP
    $mail->Host = 'myptetest.com';     // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;             // Enable SMTP authentication
    $mail->Username = 'info@myptetest.com'; // SMTP username
    $mail->Password = 'info@mypte';          // SMTP password
    $mail->SMTPSecure = 'ssl';          // Enable TLS encryption, ssl also accepted
    $mail->Port = 465;                  // TCP port to connect to
    
    // Sender info
    $mail->setFrom('info@myptetest.com', 'Desi Rishta');
    //$mail->addReplyTo('reply@example.com', 'SenderName');
    
    // Add a recipient
    $mail->addAddress($email);
    
    // Add cc or bcc 
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');
    
    // Add attachments
    //$mail->addAttachment('files/codexworld.pdf');
    
    // Email subject
    $mail->Subject = "Welcome to Desi Rishta!";
    
    // Set email format to HTML
    $mail->isHTML(true);
    
    // Email body content
    $mailContent = "
    <div style='background:#000; width:100%; margin:2% auto; padding:3%;'>
        <div style='text-align:center'>
            <img src='http://myptetest.com/desirishta/images/tlogo.png' style='width:50%'>
        </div>
        <div style='width:100%; margin:0 auto'>
            <div style='background:#000; color:#fff; width:100%;'>
                <p>Dear $name,</p>
                <p>On behalf of the entire Desi Rishta team, I extend a warm welcome to you! We are thrilled to have you onboard.</p>
                <p>Your profile is currently under screening. Once we determine that your profile meets our terms and conditions, you will be able to login and continue your partner search on Desi Rishta.</p>
                <p>If you have any questions or need assistance, our support team is here to help.</p>
                <br>
                <p>Thanks & Regards,</p>
                <p>Team Desi Rishta</p>
                <p>support@desi-rishta.com</p>
            </div>
        </div>    
    </div>
    ";
    $mail->Body = $mailContent;
    
    // Send email
    $mail->send();
    
    header('location:user-profile-edit.php');
}
?>