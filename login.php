<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'header.php';
?>
<?php
$attempt = isset($_POST['attempt']) ? $_POST['attempt'] : 3; 
?>

<!-- LOGIN -->
<style>
    /* FORM INPUTS (INPUT + TEXTAREA + SELECT) */
    .form-login .form-control,
    .form-login select.form-select,
    .form-login textarea.form-control {
        border: none !important;
        border-radius: 0 !important;
        border-bottom: 3px solid maroon !important;
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
        padding-left: 50px !important;
        /* because of left icon */
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

    .material-symbols-outlined {
        font-variation-settings:
            'FILL' 1,
            'wght' 400,
            'GRAD' 0,
            'opsz' 48;
    }

    .material-symbols-outlined {
        font-variation-settings: 'FILL' 1;
    }
    .material-symbols-outlined {
  font-variation-settings:
    'FILL' 1,
    'wght' 700,
    'GRAD' 0,
    'opsz' 48;
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
                            <div class="form-tit">
                                <h4>Welcome Back!</h4>
                                <h1>Sign in to Desi Rishta Matrimony</h1>
                            </div>

                        
                        <div class="form-login">

    <?php
    if (isset($_POST['credential']) && $_POST['credential'] == 'invalid') {
    ?>
        <p class="text-danger text-center invalid" id="invalidpop">
            <i class="fa fa-exclamation-circle"></i>&nbsp;
            Invalid credentials. <?php echo $_POST['attempt']; ?> attempt left
        </p>
    <?php
    }
    ?>

    <?php
    if (isset($_POST['credential']) && $_POST['credential'] == 'blocked') {
    ?>
        <p class="text-danger text-center invalid" id="invalidpop">
            <i class="fa fa-exclamation-circle"></i>&nbsp;
            For security reasons, the account has been blocked for 30 minutes. Please try again later.
        </p>
    <?php
    }
    ?>

    <?php
    if (isset($_POST['user']) && $_POST['user'] == 'update') {
    ?>
        <p class="text-success text-center">Password Updated Successfully</p>
    <?php
    }
    ?>

    <?php
    // Attempt value
    $attempt = isset($_POST['attempt']) ? $_POST['attempt'] : 3;
    ?>

    <form action="check-login.php" method="post" autocomplete="off">
        <div class="form-group">
            <label class="lb">Phone No. / Email ID</label>
            <span class="iconbox">
                <input type="text" class="form-control leftspace" id="email"
                    placeholder="Enter Phone No. / Email ID" name="phone" required>

                <input type="hidden" name="attempt" value="<?php echo $attempt; ?>">

                <span class="material-symbols-outlined icon">account_circle</span>
            </span>
            <p class="text-danger errorstatement" id="phoneemail" style="display:none">Please Enter Phone No. or Email ID</p>
        </div>

        <div class="form-group">
            <label class="lb">Password</label>
            <a href="forgot-password.php" class="forgotpassword">Forgot Password ?&nbsp;&nbsp;</a>

            <span class="iconbox">
                <input type="password" class="form-control leftspace" id="pwd"
                    placeholder="Enter Password" name="password" required>
                <span class="material-symbols-outlined icon">lock</span>

                <span class="material-symbols-outlined iconright" id="openid">visibility</span>
                <span class="material-symbols-outlined iconright" id="closeeye" style="display:none;">visibility_off</span>
            </span>

            <p class="text-danger errorstatement" id="password" style="display:none">Please Enter Password</p>
        </div>

        <div class="form-group form-check">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="agree" checked>
                Keep me Signed In
            </label>
        </div>

        <?php if ($attempt > 0) { ?>
            <button type="submit" class="btn btn-primary" id="signin">Sign In</button>
        <?php } else { ?>
            <span class="btn btn-primary" id="signin_block">30:00</span>
        <?php } ?>

        <div class="form-tit" style="border:0px">
            <p class="text-center mt-5">Don't have an account?
                <a href="sign-up.php" class="linkbold pink" style="font-weight: 800;">Sign Up Now</a>
            </p>
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
    $('#openid').click(function() {
        $('#openid').hide();
        $('#closeeye').show();
        $('#pwd').attr('type', 'text');
    });

    $('#closeeye').click(function() {
        $('#closeeye').hide();
        $('#openid').show();
        $('#pwd').attr('type', 'password');
    });

    $('#signin').click(function() {
        var email = $('#email').val();
        var pwd = $('#pwd').val();

        if (email == '') {
            $('#phoneemail').show();
            $('#email').css("border", "2px solid red");
        } else {
            $('#phoneemail').hide();
        }

        if (pwd == '') {
            $('#password').show();
            $('#pwd').css("border", "2px solid red");
        } else {
            $('#password').hide();
        }
    });
</script>

<script>
    $(document).ready(function() {
        $('#email').keyup(function() {
            $("#phoneemail").hide();
            $('#email').css("border", "2px solid #000");
        });
        $('#pwd').keyup(function() {
            $("#password").hide();
            $('#pwd').css("border", "2px solid #000");
        });
    });
</script>

<script>
    // Set the date we're counting down to
    // var countDownDate = new Date("<?php echo $_POST['seconds_left']; ?>").getTime();
    var countDownDate = new Date("<?php echo isset($_POST['seconds_left']) ? $_POST['seconds_left'] : ''; ?>").getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the result in the element with id="demo"
        document.getElementById("signin_block").innerHTML = minutes + "m " + seconds + "s left";

        // If the count down is finished, write some text
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("signin_block").innerHTML = "0m 0s";
           window.location.href = "https://desi-rishta.com/check-login.php?phone=<?php echo isset($_POST['userinput']) ? $_POST['userinput'] : ''; ?>";
        }
    }, 1000);
</script>
