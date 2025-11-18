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
                                    <a href="login.php"><i class="fa fa-arrow-left text-left leftarrow"></i></a>
                                    <a href="login.php"><i class="fa fa-close text-right closecross"></i></a>
                                </div>
                                <div class="form-tit mt-5">
                                    <!--<h4>Start for free</h4>-->
                                    <h1>Forgot Password</h1>
                                    <p>We will send you an OTP to reset your password</p>
                                </div>
                                <div class="form-login">
                                    <?php
                                        if($_POST['user'] == 'not-exist')
                                        {
                                        ?>
                                        <p class="text-danger text-center invalid" id="invalidpop"><i class="fa fa-exclamation-circle"></i>&nbsp;Credentials Does Not Exist</p>
                                        <?php
                                        }
                                        ?>
                                    <form action="forgot-sendotp.php" method="post" autocomplete="off">
                                        <div class="form-group">
                                            <label class="lb">Phone No.</label>
                                            <span class="iconbox">
                                                <input type="text" class="form-control leftspace" id="phone" placeholder="Enter Phone No." name="phone" required>
                                                <span class="material-symbols-outlined icon">call</span>
                                            </span>
                                            <p class="text-danger errorstatement" id="phoneerror" style="display:none">Please Enter Phone No.</p>
                                        </div>
                                        <div class="form-group m-0 text-center">
                                            <h2 class="hr-lines"><span class="or">OR</span></h2>
                                        </div>
                                        <div class="form-group">
                                            <label class="lb">Email ID</label>
                                            <span class="iconbox">
                                                <input type="text" class="form-control leftspace" id="email" placeholder="Enter Email ID" name="email" required>
                                                <span class="material-symbols-outlined icon">mail</span>
                                            </span>
                                            <p class="text-danger errorstatement" id="emailerror" style="display:none">Please Enter Email ID</p>
                                        </div>
                                        <button type="submit" id="resetpassword" class="btn btn-primary">Send OTP</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
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
    <!-- END -->

<?php
include 'footer.php';
?>

<script>
$('#resetpassword').click(function() {
    var email = $('#email').val();
    var phone = $('#phone').val();
    
    if(email == '')
    {
        if(phone != '')
        {
            $('#emailerror').hide();
        }
        else
        {
            $('#emailerror').show();
            $("#email").css("border-color", "#dc3545");
        }
    }
    else
    {
        $('#emailerror').hide();
        $('#phoneerror').hide();
        $("#phone").removeAttr("required");
    }
    
    if(phone == '')
    {
        if(email != '')
        {
            $('#phoneerror').hide();
        }
        else
        {
            $('#phoneerror').show();
            $("#phone").css("border-color", "#dc3545");
        }
    }
    else
    {
        $('#emailerror').hide();
        $("#email").removeAttr("required");
        $('#phoneerror').hide();
    }
});
</script>

<script>
$('#phone').keyup(function() {
    $('#phoneerror').hide();
    $("#phone").css("border-color", "#616366");
});
</script>

<script>
$('#email').keyup(function() {
    $('#emailerror').hide();
    $("#email").css("border-color", "#616366");
});
</script>