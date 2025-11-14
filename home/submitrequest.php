<?php
include 'header.php';

$userid = $_COOKIE['dr_userid'];

if($userid == '')
{
    header('location:login.php');
}
?>
    <!-- BANNER -->
    <section>
        <div class="str">
            <div class="ban-inn ab-ban pg-cont">
                <div class="container">
                    <div class="row">
                        <div class="hom-ban">
                            <div class="ban-tit">
                                <span>We are here to assist you.</span>
                                <h1>Submit A Request</h1>
                                <p>Most Trusted and premium Matrimony & Matchmaking Service in the World.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END -->

    <!-- START -->
    <section>
        <div class="ab-sec2 pg-cont">
            <div class="container">
                <div class="row">
                    <ul>
                        <li>
                            <div class="we-cont">
                                <img src="images/icon/buildings.png" alt="">
                                <h4>Our office</h4>
                                <p class="mb-2"> +91-8377053041</p>
                                <p class="mb-2"> support@desi-rishta.com </p>
                                <p class="mb-2"> New Delhi, India</p>
                            </div>
                        </li>
                        <li>
                            <div class="we-cont">
                                <img src="images/icon/help-desk.png" alt="">
                                <h4>Customer Relations</h4>
                                <p>Your messages are invaluable to us</p>
                                <a href="#support" class="cta-rou-line">Send Request Now</a>
                            </div>
                        </li>
                        <li>
                            <div class="we-cont">
                                <img src="images/icon/telephone.png" alt="">
                                <h4>WhatsApp Support</h4>
                                <p>Welcome to our WhatsApp support</p>
                                <a href="https://wa.me/918377053041?text=Hello i am having some queries" target="_blank" class="cta-rou-line">Chat Now</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- END -->

    <!-- REGISTER -->
    <section>
        <div class="login pg-cont" id="support">
            <div class="container">
                <div class="row">

                    <div class="inn">
                        <div class="lhs">
                            <div class="tit">
                                <h2>Now <b>Contact to us</b> Easy and fast.</h2>
                            </div>
                            <div class="im">
                                <img src="images/login-couple.png" alt="">
                            </div>
                            <div class="log-bg">&nbsp;</div>
                        </div>
                        <div class="rhs">
                            <div>
                                <div class="form-tit">
                                    <h4>Let's talk</h4>
                                    <h1>Send your message now </h1>
                                </div>
                                <div class="form-login">
                                    <form class="cform fvali" method="post" action="insert-submitrequest.php">
                                            <?php
                                            if($_GET['success'] == 'yes')
                                            {
                                            ?>
                                            <p class="text-success text-center" id="invalidpop">Your message was sent successfully.</p>
                                            <?php
                                            }
                                            ?>
                                        <div class="form-group">
                                            <label class="lb">Name</label>
                                            <span class="iconbox">
                                                <input type="text" id="name" class="form-control leftspace" placeholder="Enter Full Name" value="<?php echo $_COOKIE['dr_name']; ?>" name="name" required readonly>
                                                <span class="material-symbols-outlined icon">account_circle</span>
                                            </span>
                                        </div>
                                        <div class="form-group">
                                            <label class="lb">Email ID</label>
                                            <span class="iconbox">
                                                <input type="email" class="form-control leftspace" id="email" placeholder="Enter Email ID" value="<?php echo $_COOKIE['dr_email']; ?>" name="email" required readonly>
                                                <span class="material-symbols-outlined icon">mail</span>
                                            </span>
                                        </div>
                                        <div class="form-group">
                                            <label class="lb">Phone No.</label>
                                            <span class="iconbox">
                                                <input type="text" class="form-control leftspace" id="phone" placeholder="Enter Phone No." value="<?php echo $_COOKIE['dr_phone']; ?>" name="phone" required readonly>
                                                <span class="material-symbols-outlined icon">call</span>
                                            </span>
                                        </div>
                                        <div class="form-group">
                                            <label class="lb">Message</label>
                                            <span class="iconbox">
                                                <textarea name="message" class="form-control leftspace" id="message" placeholder="Enter Message" required></textarea>
                                                <span class="material-symbols-outlined icon">edit_note</span>
                                            </span>
                                            <p class="text-danger errorstatement" id="messerror" style="display:none">Please Enter Message</p>
                                        </div>
                                        <button type="submit" id="enquirybtn" class="btn btn-primary">Send Enquiry</button>
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
$(document).ready(function(){
  $("#enquirybtn").click(function(){
    var message = $("#message").val();
    
    if(message == '')
    {
        $("#messerror").show();
        $("#message").css("border", "2px solid red");
        return false;
    }
    else
    {
        $("#messerror").hide();
        return true;
    }
  });
  
  $("#message").keyup(function(){
    $("#messerror").hide();
  });
});
</script>