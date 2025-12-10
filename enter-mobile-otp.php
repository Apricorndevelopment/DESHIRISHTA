<?php
// ----------------------------------------------------
// 1. ERROR REPORTING ON (Taaki hum asli error dekh sakein)
// ----------------------------------------------------
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

ob_start();
include 'config.php';

// Check agar user login hai ya nahi
if(!isset($_COOKIE['dr_userid'])) {
    header('location:login.php');
    exit();
}

$userid = $_COOKIE['dr_userid'];
$msg = ""; 

// ----------------------------------------------------
// LOGIC SECTION
// ----------------------------------------------------
if(isset($_POST['verify_otp'])) {
    
    // Check connection first
    if (!$con) {
        die("Database Connection Failed: " . mysqli_connect_error());
    }

    $entered_otp = mysqli_real_escape_string($con, $_POST['otp_input']);

    // Database se saved OTP nikalo
    $sql = "SELECT mobile_otp FROM registration WHERE userid = '$userid'";
    $result = mysqli_query($con, $sql);
    
    if(!$result) {
        die("Query Failed: " . mysqli_error($con)); // Agar query galat hai to yahan error dikhega
    }

    $row = mysqli_fetch_assoc($result);

    // Check karo
    if($row && $row['mobile_otp'] == $entered_otp) {
        
        // Match ho gaya: Update karo
        $update_sql = "UPDATE registration SET mobileverify = '1', mobile_otp = '' WHERE userid = '$userid'";
        
        if(mysqli_query($con, $update_sql)) {
            // SUCCESS
            header("Location: user-setting.php?status=verified");
            exit();
        } else {
            $msg = "<div class='alert alert-danger'>Update Error: " . mysqli_error($con) . "</div>";
        }

    } else {
        // Match nahi hua
        $msg = "<div class='alert alert-danger text-center'>Incorrect OTP! Please try again.</div>";
    }
}
// ----------------------------------------------------
// LOGIC END
// ----------------------------------------------------

include 'header.php';
?>

<section>
    <div class="db" style="padding: 50px 0;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="col-md-12 db-sec-com">
                        
                        <div class="fol-set-tit fol-pro-abo-ico text-center">
                            <h2 class="db-tit">Mobile Verification</h2>
                            <p>Enter the 4-digit code sent to your mobile number.</p>
                        </div>

                        <div class="fol-sett-box" style="padding: 30px;">
                            
                            <?php if($msg != "") { echo $msg; } ?>

                            <form method="post" action="">
                                <div class="form-group">
                                    <label>Enter OTP:</label>
                                    <input type="text" name="otp_input" class="form-control" placeholder="Ex: 1234" maxlength="4" required style="font-size: 18px; letter-spacing: 5px; text-align: center;">
                                </div>
                                
                                <br>
                                
                                <div class="text-center">
                                    <button type="submit" name="verify_otp" class="btn btn-primary" style="background: #e44d3a; border:none; padding: 10px 30px;">Verify OTP</button>
                                </div>
                            </form>
                            
                            <hr>
                            
                            <div class="text-center">
                                <p>Didn't receive the code?</p>
                                <a href="verifymobile_otp.php" style="color: #e44d3a; font-weight: bold;">Resend OTP</a>
                                <br><br>
                                <a href="user-setting.php" style="color: #555;">Cancel</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include 'footer.php';
?>