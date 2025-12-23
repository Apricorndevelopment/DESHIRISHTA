<?php
include 'header.php';
?>
 <style>
        /* FORM INPUTS (INPUT + TEXTAREA + SELECT) */
.form-login .form-control,
.form-login select.form-select,
.form-login textarea.form-control {
    border: none !important;
    border-radius: 0 !important;
    border-bottom: 2px solid maroon !important;
    outline: none !important;
    box-shadow: none !important;
    background: transparent !important;
}

/* FOCUS EFFECT */
.form-login .form-control:focus,
.form-login select.form-select:focus,
.form-login textarea.form-control:focus {
    border-bottom-color: maroon !important;
    box-shadow: none !important;
}

/* ICONBOX */
.iconbox {
    position: relative;
}

.iconbox .icon,
.iconbox .iconright {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    color: maroon;
}

/* Left padding for inputs */
.leftspace {
    padding-left: 50px !important;
}

/* Right-side icon */
.iconright {
    right: 10px;
}

/* SELECT DROPDOWN DESIGN */
/* FIX SELECT DESIGN FULLY */
.form-login select.form-select {
    border: none !important;
    border-bottom: 2px solid maroon !important;
    border-radius: 0 !important;

    background-color: transparent !important;
    background-image: url("data:image/svg+xml;utf8,<svg fill='maroon' height='24' width='24' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/></svg>") !important;

    background-repeat: no-repeat !important;
    background-position: right 12px center !important;
    background-size: 18px !important;

    height: 45px !important;
    padding-left: 50px !important; /* because of left icon */
    padding-right: 35px !important;

    appearance: none !important;
    -webkit-appearance: none !important;
    -moz-appearance: none !important;

    box-shadow: none !important;
    outline: none !important;
}

/* Focus */
.form-login select.form-select:focus {
    border-bottom-color: maroon !important;
    box-shadow: none !important;
}

    </style> 
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
                                <div>
                                    <a href="forgot-password.php"><i class="fa fa-arrow-left text-left leftarrow"></i></a>
                                    <a href="login.php"><i class="fa fa-close text-right closecross"></i></a>
                                </div>
                                <div class="form-tit">
                                    <h1>Forgot Password</h1>
                                    
                                    <?php
                                    // Yahan par masked number/email display karein
                                    if(isset($_POST['display_contact']) && $_POST['display_contact'] != '') {
                                        $contact_info = $_POST['display_contact'];
                                        // Aap style ko apne hisaab se adjust kar sakte hain
                                        echo "<p style='color:black; font-weight:bold; font-size:20px;'>Otp sent on  $contact_info .</p>";
                                    } else {
                                        // Fallback agar kisi vajah se display_contact nahi aata hai
                                        echo "<p>We have sent an OTP to your Mobile No./Email ID</p>";
                                    }
                                    ?>
                                    
                                </div>
                                <div class="form-login">
                                    <form action="forgot-checkotp.php" method="post">
                                        <?php
                                        if($_POST['invalid'] == 'false')
                                        {
                                        ?>
                                        <p class="text-danger text-center invalid w-50" id="invalidpop"><i class="fa fa-exclamation-circle"></i>&nbsp;Invalid OTP</p>
                                        <?php
                                        }
                                        ?>
                                        <div class="form-group">
                                            <label class="lb">OTP Code</label>
                                            <span class="iconbox">
                                                <input type="hidden" class="form-control" placeholder="Enter phone" name="phone" value="<?php echo  $_POST['validphone']; ?>" onkeypress="return isNumberKey(event)" onkeyup="numberMobile(event);" readonly>
                                                <input type="hidden" class="form-control" placeholder="Enter phone" name="email" value="<?php echo  $_POST['validemail']; ?>" onkeypress="return isNumberKey(event)" onkeyup="numberMobile(event);" readonly>
                                                <input type="text" class="form-control leftspace" id="otppwd" placeholder="Enter OTP Code" name="otp" onkeypress="return isNumberKey(event)" onkeyup="numberMobile(event);" required>
                                                <span class="material-symbols-outlined icon">password</span>
                                            </span>
                                            <p class="text-danger errorstatement" id="otperror" style="display:none">Please Enter OTP</p>
                                        </div>
                                        <?php
                                        if($_POST['attempt'] != -1)
                                        {
                                        ?>
                                        <button type="submit" id="otpbtn" class="btn btn-primary">Continue</button>
                                        <?php
                                        }
                                        ?>
                                        <div class="form-tit m-0" style="border:0px">
                                            <?php
                                            if($_POST['attempt'] != -1)
                                            {
                                            ?>
                                            <p class="text-center mt-5" id="timer">Resend OTP in <span id="seconds">60</span> Seconds</p>
                                            <p class="text-center mt-5" id="resendbtn" style="display:none">Didn’t received OTP? <a href="forgot-sendotp.php?phone=<?php echo  $_POST['validphone']; ?>&email=<?php echo  $_POST['validemail']; ?>&attempt=<?php echo $_POST['attempt']; ?>" class="pink">Resend</a></p>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                            <p class="text-center mt-5 text-danger" id="resendbtn"><i class="fa fa-exclamation-circle"></i>&nbsp;For security reasons, OTP requests are limited to two per day. Please try again later.</p>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </form>
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

<script>
    $('#otpbtn').click(function() {
    var otp = $('#otppwd').val();
    
    if(otp == '')
    {
        $('#otperror').show();
        $("#otppwd").css("border-color", "#dc3545");
        return false;
    }
    else
    {
        $('#otperror').hide(); 
        
        return true;
    }
});
</script>

<script>
$('#otppwd').keyup(function() {
    $('#otperror').hide();
    $("#otppwd").css("border-color", "#616366");
});
</script>