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
                                    <h4>Welcome Back!</h4>
                                    <h1>Sign in to Desi Rishta Matrimony</h1>
                                </div>
                                <div class="form-login">
                                    <?php
                                    if($_POST['credential'] == 'invalid')
                                    {
                                    ?>
                                        <p class="text-danger text-center invalid" id="invalidpop"><i class="fa fa-exclamation-circle"></i>&nbsp;Invalid credentials. <?php echo $_POST['attempt']; ?> attempt left</p>
                                    <?php
                                    }
                                    if($_POST['credential'] == 'blocked')
                                    {
                                    ?>
                                        <p class="text-danger text-center invalid" id="invalidpop"><i class="fa fa-exclamation-circle"></i>&nbsp;For security reasons, the account has been blocked for 30 minutes. Please try again later.</p>
                                    <?php
                                    }
                                    if($_POST['user'] == 'update')
                                    {
                                    ?>
                                        <p class="text-success text-center">Password Updated Successfully</p>
                                    <?php
                                    }
                                    ?>
                                    <form action="check-login.php" method="post" autocomplete="off">
                                        <div class="form-group">
                                            <label class="lb">Phone No. / Email ID</label>
                                            <span class="iconbox">
                                                <input type="text" class="form-control leftspace" id="email" placeholder="Enter Phone No. / Email ID" name="phone" required>
                                                <input type="hidden" class="form-control leftspace" value="<?php if($_POST['attempt'] == '') { echo "3"; } else { echo $_POST['attempt']; } ?>" name="attempt" required>
                                                <span class="material-symbols-outlined icon">account_circle</span>
                                            </span>
                                            <p class="text-danger errorstatement" id="phoneemail" style="display:none">Please Enter Phone No. or Email ID</p>
                                        </div>
                                        <div class="form-group">
                                            <label class="lb">Password</label><a href="forgot-password.php" class="forgotpassword">Forgot Password ?&nbsp;&nbsp;</a>
                                            <span class="iconbox">
                                                <input type="password" class="form-control leftspace" id="pwd" placeholder="Enter Password" name="password" required>
                                                <span class="material-symbols-outlined icon">lock</span>
                                                <span class="material-symbols-outlined iconright" id="openid">visibility</span>
                                                <span class="material-symbols-outlined iconright" id="closeeye" style="display:none;">visibility_off</span>
                                            </span>
                                            <p class="text-danger errorstatement" id="password" style="display:none">Please Enter Password</p>
                                        </div>
                                        <div class="form-group form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="agree" checked> Keep me Signed In 
                                            </label>
                                        </div>
                                        <?php
                                        if($_POST['attempt'] > 0 || $_POST['attempt'] == '')
                                        {
                                        ?>
                                        <button type="submit" class="btn btn-primary" id="signin">Sign In</button>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                        <span type="button" class="btn btn-primary" id="signin_block">30:00</span>
                                        <?php
                                        }
                                        ?>
                                        <div class="form-tit" style="border:0px">
                                        <p class="text-center mt-5">Don't have an account? <a href="sign-up.php" class="linkbold pink">Sign Up Now</a></p>
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
    
    if(email == '')
    {
        $('#phoneemail').show();
        $('#email').css("border","2px solid red");
    }
    else
    {
        $('#phoneemail').hide();
    }
    
    if(pwd == '')
    {
        $('#password').show();
        $('#pwd').css("border","2px solid red");
    }
    else
    {
        $('#password').hide();
    }
});
</script>

<script>
    $(document).ready(function(){
        $('#email').keyup(function(){
            $("#phoneemail").hide();
            $('#email').css("border","2px solid #000");
        });
        $('#pwd').keyup(function(){
            $("#password").hide();
            $('#pwd').css("border","2px solid #000");
        });
    });
</script>

<script>
// Set the date we're counting down to
var countDownDate = new Date("<?php echo $_POST['seconds_left']; ?>").getTime();

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
    window.location.href = "https://myptetest.com/desirishta/check-login.php?phone=<?php echo $_POST['userinput'];?>";
  }
}, 1000);
</script>