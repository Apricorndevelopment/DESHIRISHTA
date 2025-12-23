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
                                <h1>Review & Rating</h1>
                                <p>Most Trusted and premium Matrimony & Matchmaking Service in the World.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END -->

    <!-- REGISTER -->
    <section>
        <div class="login pg-cont mt-5" id="support">
            <div class="container">
                <div class="row">

                    <div class="inn">
                        <div class="lhs">
                            <div class="tit">
                                <h2>Now <b>Rate and review us</b> Easy and fast.</h2>
                            </div>
                            <div class="im">
                                <img src="images/login-couple.png" alt="">
                            </div>
                            <div class="log-bg">&nbsp;</div>
                        </div>
                        <div class="rhs">
                            <div>
                                <div class="form-tit">
                                    <h4>Let’s Rate & Review</h4>
                                    <h1>Share your ratings and reviews now</h1>
                                </div>
                                <div class="form-login">
                                    <form class="cform fvali" method="post" action="insert-reviewrating.php">
                                        <?php
                                            if($_GET['success'] == 'yes')
                                            {
                                            ?>
                                            <p class="text-success text-center" id="invalidpop">Your message was sent successfully</p>
                                            <?php
                                            }
                                            ?>
                                        <div class="form-group">
                                            <label class="lb">Name</label>
                                            <span class="iconbox">
                                                <input type="text" id="name" class="form-control leftspace" placeholder="Enter Full Name" name="name" value="<?php echo $_COOKIE['dr_name']; ?>" required readonly>
                                                <span class="material-symbols-outlined icon">account_circle</span>
                                            </span>
                                        </div>
                                        <div class="form-group">
                                            <label class="lb">Email ID</label>
                                            <span class="iconbox">
                                                <input type="email" class="form-control leftspace" id="email" placeholder="Enter Email ID" name="email" value="<?php echo $_COOKIE['dr_email']; ?>" required readonly>
                                                <span class="material-symbols-outlined icon">mail</span>
                                            </span>
                                        </div>
                                        <div class="form-group">
                                            <label class="lb">Phone No.</label>
                                            <span class="iconbox">
                                                <input type="text" class="form-control leftspace" id="phone" placeholder="Enter Phone No." name="phone" value="<?php echo $_COOKIE['dr_phone']; ?>" required readonly>
                                                <span class="material-symbols-outlined icon">call</span>
                                            </span>
                                        </div>
                                        <div class="form-group m-0">
                                            <div>
                                                <label class="lb">Rating</label>
                                            </div>
                                            <div class="rate">
                                                <input type="radio" id="star1" name="rate" value="5" />
                                                <label for="star1" title="text"></label>
                                                <input type="radio" id="star2" name="rate" value="4" />
                                                <label for="star2" title="text"></label>
                                                <input type="radio" id="star3" name="rate" value="3" />
                                                <label for="star3" title="text"></label>
                                                <input type="radio" id="star4" name="rate" value="2" />
                                                <label for="star4" title="text"></label>
                                                <input type="radio" id="star5" name="rate" value="1" />
                                                <label for="star5" title="text"></label>
                                            </div>
                                            <input type="hidden" id="rating" name="rate"/>
                                            <p class="text-danger errorstatement" id="ratingerror" style="display:none">Please Select Review Rating</p>
                                        </div>
                                        <div class="form-group">
                                            <label class="lb">Review’s</label>
                                            <span class="iconbox">
                                                <textarea name="message" class="form-control leftspace" id="message" placeholder="Enter Message" required></textarea>
                                                <span class="material-symbols-outlined icon">edit_note</span>
                                            </span>
                                            <p class="text-danger errorstatement" id="messerror" style="display:none">Please Enter Review Message</p>
                                        </div>
                                        <button type="submit" id="enquirybtn" class="btn btn-primary">Submit</button>
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
    var rating = $("#rating").val();
    
    if(rating == '')
    {
        $("#ratingerror").show();
    }
    else
    {
         $("#ratingerror").hide();
    }
    
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
    $("#message").css("border", "2px solid #000");
  });
  
  $("#star1").change(function(){
       var star1 = $("#star1").val();
       $("#rating").val($("#star1").val());
       $("#ratingerror").hide();
  });
  
  $("#star2").change(function(){
       var star2 = $("#star2").val();
       $("#rating").val($("#star2").val());
       $("#ratingerror").hide();
  });
  
  $("#star3").change(function(){
       var star3 = $("#star3").val();
       $("#rating").val($("#star3").val());
       $("#ratingerror").hide();
  });
  
  $("#star4").change(function(){
       var star4 = $("#star4").val();
       $("#rating").val($("#star4").val());
       $("#ratingerror").hide();
  });
  
  $("#star5").change(function(){
       var star5 = $("#star5").val();
       $("#rating").val($("#star5").val());
       $("#ratingerror").hide();
  });
});
</script>