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
                                <div class="form-tit">
                                    <!--<h4>Start for free</h4>-->
                                    <h1>Reset Password</h1>
                                    <p>Now enter new password</p>
                                </div>
                                <div class="form-login">
                                    <?php
                                    if($_POST['passtype'] == 'old')
                                    {
                                    ?>
                                        <p class="text-danger text-center invalid" id="invalidpop"><i class="fa fa-exclamation-circle"></i>&nbsp;Your new password cannot be one of your last three passwords</p>
                                    <?php
                                    }
                                    ?>
                                    <form action="update-newpassword.php" method="post" autocomplete="off">
                                        <div class="form-group">
                                            <label class="lb">New Password</label>
                                            <span class="iconbox">
                                                <input type="hidden" class="form-control" placeholder="Enter phone" name="phone" value="<?php echo  $_POST['validphone']; ?>" onkeypress="return isNumberKey(event)" onkeyup="numberMobile(event);" readonly>
                                                <input type="hidden" class="form-control" placeholder="Enter phone" name="email" value="<?php echo  $_POST['validemail']; ?>" onkeypress="return isNumberKey(event)" onkeyup="numberMobile(event);" readonly>
                                                <input type="password" class="form-control leftspace" id="newpass" placeholder="Enter New Password" name="newpass" required>
                                                <span class="material-symbols-outlined icon">lock</span>
                                                <span class="material-symbols-outlined iconright" id="openid">visibility</span>
                                                <span class="material-symbols-outlined iconright" id="closeeye" style="display:none;">visibility_off</span>
                                            </span>
                                            <p class="text-danger errorstatement" id="newpasserror" style="display:none">Please Enter New Password.</p>
                                            <p class="mb-2 errorstatement" id="charlen" style="display:none"  style="display:none"><i class="fa fa-exclamation-circle" id="charlenexclamation"></i><i class="fa fa-check" id="charlencheck" style="display:none"></i>&nbsp;Password must be 6-20 characters long</p>
                                            <p class="mb-2 errorstatement" id="charnum" style="display:none"><i class="fa fa-exclamation-circle" id="charnumexclamation"></i><i class="fa fa-check" id="charnumcheck" style="display:none"></i>&nbsp;Password must contain at least one numeric character</p>
                                            <p class="text-success errorstatement" id="passaccept" style="display:none"><i class="fa fa-check"></i>&nbsp;Password Accepted</p>
                                            <p class="text-danger errorstatement" id="criterianotmatch" style="display:none">Password criteria do not match</p>
                                        </div>
                                        <div class="form-group">
                                            <label class="lb">Confirm Password</label>
                                            <span class="iconbox">
                                                <input type="password" class="form-control leftspace" id="comfrimpass" placeholder="Enter Confirm Password" name="comfrimpass" required>
                                                <span class="material-symbols-outlined icon">lock</span>
                                                <span class="material-symbols-outlined iconright" id="openid">visibility</span>
                                                <span class="material-symbols-outlined iconright" id="closeeye" style="display:none;">visibility_off</span>
                                            </span>
                                            <p class="text-danger errorstatement" id="comfrimpasserror" style="display:none">Please Enter Confirm Password</p>
                                            <p class="text-danger errorstatement" id="notmatched" style="display:none"><i class="fa fa-exclamation-circle"></i>&nbsp;The Password you entered do not match</p>
                                            <p class="text-success errorstatement" id="matched" style="display:none"><i class="fa fa-check"></i>&nbsp;The Password you entered matches</p>
                                        </div>
                                        <button type="submit" id="resetpassword" class="btn btn-primary">Reset Password</button>
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
    $('#newpass').attr('type', 'text');
});

$('#closeeye').click(function() {
    $('#closeeye').hide();
    $('#openid').show();
    $('#newpass').attr('type', 'password');
});

$('#openid1').click(function() {
    $('#openid1').hide();
    $('#closeeye1').show();
    $('#comfrimpass').attr('type', 'text');
});

$('#closeeye1').click(function() {
    $('#closeeye1').hide();
    $('#openid1').show();
    $('#comfrimpass').attr('type', 'password');
});

$('#resetpassword').click(function() {
    var comfrimpass = $('#comfrimpass').val();
    var newpass = $('#newpass').val();
    
    var newpasslen1 = $('#newpass').val().length;
    var regex1 = /\d+/g;
            
    if(newpass == '')
    {
        $('#newpasserror').show();
    }
    else
    {
        $('#newpasserror').hide();
    }
    
    if(comfrimpass == '')
    {
        $('#comfrimpasserror').show();
    }
    else
    {
        $('#comfrimpasserror').hide();
    }
    
    if(newpass != comfrimpass)
    {
        $("#notmatched").show();
        $("#matched").hide();
        $("#charlen").hide();
        $("#charnum").hide();
        $("#criterianotmatch").hide();
        
        $("#newpass").css('border', "2px solid red");
        $("#comfrimpass").css('border', "2px solid red");
        
        return false;
    }
    else
    {
        if(newpass == '' && comfrimpass == '')
        {
            $("#newpass").css('border', "2px solid red");
            $("#comfrimpass").css('border', "2px solid red");
        
            $("#notmatched").hide();
            $("#matched").hide();
        }
        else
        {
            if(newpasslen1 >= '6' && regex1.test(newpass))
            {
                $("#newpass").css('border', "2px solid green");
                $("#comfrimpass").css('border', "2px solid green");
        
                $("#notmatched").hide();
                $("#matched").show();
                
                return true;
            }
            else
            {
                $("#charlen").hide();
                $("#charnum").hide();
                $("#criterianotmatch").show();
                $("#newpass").css('border', "2px solid red");
                return false;
            }
        }
        
    }
});
</script>

<script>
    $('#comfrimpass').keyup(function() {
    var comfrimpass = $('#comfrimpass').val();
    var newpass = $('#newpass').val();
    
    $('#comfrimpasserror').hide();
    
    if(newpass != comfrimpass)
    {
        $("#notmatched").show();
        $("#matched").hide();
        
        $("#newpass").css('border', "2px solid red");
        $("#comfrimpass").css('border', "2px solid red");
        
        return false;
    }
    else
    {
        if(newpass == '' && comfrimpass == '')
        {
            $("#notmatched").hide();
            $("#matched").hide();
            
            $("#newpass").css('border', "");
            $("#comfrimpass").css('border', "");
            
            $('#newpasserror').hide();
            $('#comfrimpasserror').hide();
        }
        else
        {
            $("#newpass").css('border', "2px solid green");
            $("#comfrimpass").css('border', "2px solid green");
        
            $("#notmatched").hide();
            $("#matched").show();
        }
        return true;
    }
});
</script>
<script>
    $(document).ready(function(){
        $('#newpass').keyup(function(){
            
            $('#newpasserror').hide();
            $("#charlen").show();
            $("#charnum").show();
            $("#criterianotmatch").hide();
            $("#matched").hide();
            $("#comfrimpass").css('border', "");
            
            var newpassstr = $('#newpass').val();
            var comfrimpassstr = $('#comfrimpass').val();
            var newpasslen = $('#newpass').val().length;
            var regex = /\d+/g;
    
            if(newpassstr == comfrimpassstr)
            {
                $("#newpass").css('border', "2px solid green");
                $("#comfrimpass").css('border', "2px solid green");
            
                $("#notmatched").hide();
                $("#matched").show();
            }
            else
            {
                $("#newpass").css('border', "2px solid red");
                $("#comfrimpass").css('border', "2px solid red");
            
                $("#notmatched").show();
                $("#matched").hide();
            }
            
            if(newpassstr == '' && comfrimpassstr == '')
            {
                $("#notmatched").hide();
                $("#matched").hide();
            
                $("#newpass").css('border', "");
                $("#comfrimpass").css('border', "");
                
                $('#newpasserror').hide();
                $('#comfrimpasserror').hide();
            }
        
            if(newpassstr == '' && comfrimpassstr != '')
            {
                $("#notmatched").show();
                $("#matched").hide();
        
                $("#newpass").css('border', "2px solid red");
                $("#comfrimpass").css('border', "2px solid red");
            }
            
            if(newpassstr != '' && comfrimpassstr == '')
            {
                $("#notmatched").hide();
                $("#matched").hide();
        
                $("#newpass").css('border', "");
                $("#comfrimpass").css('border', "");
            }
            
            if(newpassstr == '')
            {
                $("#charlen").hide();
                $("#charnum").hide();
                $("#passaccept").hide();
            }
            
            if(newpasslen >= '6')
            {
                $('#charlen').css("color", "green");
                $("#charlenexclamation").hide();
                $("#charlencheck").show();
                
                if(regex.test(newpassstr))
                {
                    $("#passaccept").show();
                    $("#charlen").hide();
                    $("#charnum").hide();
                }
                else
                {
                    $("#passaccept").hide();
                    $("#charlen").show();
                    $("#charnum").show();
                }
            }
            else
            {
                $('#charlen').css("color", "");
                $("#charlenexclamation").show();
                $("#charlencheck").hide();
            }
            
            if(regex.test(newpassstr))
            { 
                $('#charnum').css("color", "green");
                $("#charnumexclamation").hide();
                $("#charnumcheck").show();
                
                if(newpasslen >= '6')
                {
                    $("#passaccept").show();
                    $("#charlen").hide();
                    $("#charnum").hide();
                }
                else
                {
                    $("#passaccept").hide();
                    $("#charlen").show();
                    $("#charnum").show();
                }
            }
            else
            {
                $('#charnum').css("color", "");
                $("#charnumexclamation").show();
                $("#charnumcheck").hide();
            }
            
        });
    });
</script>