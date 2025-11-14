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
                                <div class="form-tit">
                                    <!--<h4>Start for free</h4>-->
                                    <h1>Verify Phone Number</h1>
                                    <p>We sent an SMS with a 4 digit code to <b><?php echo $_COOKIE['dr_phone']; ?></b></p>
                                </div>
                                <div class="form-login">
                                    <form action="check-otp.php" method="post">
                                        <?php
                                        if($_POST['invalid'] == 'false')
                                        {
                                        ?>
                                        <p class="text-danger text-center">Invalid OTP</p>
                                        <?php
                                        }
                                        ?>
                                        <!--<div class="form-group">
                                            <label class="lb">Phone:</label>
                                            <input type="text" class="form-control" id="email" placeholder="Enter phone" name="phone" value="<?php echo  $_COOKIE['dr_phone']; ?>" onkeypress="return isNumberKey(event)" onkeyup="numberMobile(event);" readonly>
                                        </div>-->
                                        <div class="form-group">
                                            <label class="lb">OTP Code</label>
                                            <input type="hidden" class="form-control" id="email" placeholder="Enter phone" name="phone" value="<?php echo  $_COOKIE['dr_phone']; ?>" onkeypress="return isNumberKey(event)" onkeyup="numberMobile(event);" readonly>
                                            <input type="text" class="form-control" id="pwd" placeholder="Enter OTP Code" name="otp" onkeypress="return isNumberKey(event)" onkeyup="numberMobile(event);">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Verify Phone Number</button>
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