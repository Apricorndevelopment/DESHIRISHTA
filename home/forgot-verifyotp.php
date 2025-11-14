<?php
include 'header.php';
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
                                <div>
                                    <a href="forgot-password.php"><i class="fa fa-arrow-left text-left leftarrow"></i></a>
                                    <a href="login.php"><i class="fa fa-close text-right closecross"></i></a>
                                </div>
                                <div class="form-tit">
                                    <!--<h4>Start for free</h4>-->
                                    <h1>Forgot Password</h1>
                                    <p>We have sent an OTP to your Mobile No./Email ID</p>
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
    <!-- END -->

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