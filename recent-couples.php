
<!doctype html>
<html lang="en">
<head>
    <title>Desi Rishta | True Matchmaking</title>
    <!--== META TAGS ==-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="theme-color" content="#f6af04">
    <meta name="description" content="">
    <meta name="keyword" content="">
    <!--== FAV ICON(BROWSER TAB ICON) ==-->
    <link rel="shortcut icon" href="images/ring.jpeg" type="image/x-icon">
    <!--== CSS FILES ==-->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
      <![endif]-->
      
      <script language=Javascript>
      
      function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
   </script>
   <script>
       function numberMobile(e){
            e.target.value = e.target.value.replace(/[^\d]/g,'');
            return false;
        }
   </script>
   
   
</head>

<body>
    <!-- PRELOADER -->
    <div id="preloader">
        <div class="plod">
            <span class="lod1"><img src="images/preload.gif" alt="" loading="lazy"></span>
        </div>
    </div>
    <div class="pop-bg"></div>
    <!-- END PRELOADER -->
    
     <!-- POPUP SEARCH -->
    <div class="pop-search">
        <span class="ser-clo">+</span>
        <div class="inn">
            <form action="user-profile-details.php" method="get">
                <input type="text" name="uid" placeholder="Enter Member ID...">
            </form>
            <div class="rel-sear">
                <h4>Example:</h4>
                <a href="#">DR123456789012</a>
            </div>
        </div>
    </div>
    <!-- END -->
    
    <!-- TOP MENU -->
    <div class="head-top">
        <div class="container">
            <div class="row">
                <div class="lhs">
                    <ul>
                        <li><a href="tel:+9704462944"><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;+91-8377053041</a></li>
                        <li><a href="mailto:info@example.com"><i class="fa fa-envelope-o" aria-hidden="true"></i>&nbsp; support@desi-rishta.com</a></li>
                    </ul>
                </div>
                <div class="rhs">
                    <ul>
                        <li><a href="faq.php">FAQ's</a></li>
                        <li><a href="#!"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="#!"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        <li><a href="https://wa.me/918377053041?text=Hello i am having some queries" target="_blank"><i class="fa fa-whatsapp" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- END -->

    <!-- CONTACT EXPERT -->
    <div class="menu-pop menu-pop2">
        <span class="menu-pop-clo"><i class="fa fa-times" aria-hidden="true"></i></span>
        <div class="inn">
            <div class="menu-pop-help">
                <h4>Welcome To Desi Rishta</h4>
                <div class="user-pro">
                    <img src="images/gif/meetup.gif" alt="" loading="lazy">
                </div>
                <div class="user-bio mt-3">
                    <h5>"Unlock countless profiles” </h5>
                    <span>Register for free now!</span>
                    <br>
                    <a href="sign-up.php" class="btn btn-primary btn-sm">Register Now</a>
                </div>
            </div>
        </div>
    </div>
    <!-- END -->
    
    
    <!-- MAIN MENU -->
    <div class="hom-top">
        <div class="container">
            <div class="row">
                <div class="hom-nav">
                    <!-- LOGO -->
                    <div class="logo">
                        <a href="index.php" class="logo-brand"><img src="images/desirishtalogo.png" alt="" loading="lazy" class="ic-logo"></a>
                    </div>
                    
                                        <!-- EXPLORE MENU -->
                    <div class="bl">
                                                <ul>
                            <li><a href="index.php">Home</a></li>
                            <li><a href="about.php">About Us</a></li> 
                            <li><a href="plans.php">Plans</a></li>
                            <li><a href="blog.php">Blogs</a></li>
                            <li class="smenu-pare">
                                <span class="smenu">Help & Support</span>
                                <div class="smenu-open smenu-single">
                                    <ul>
                                        <li><a href="contact.php">Contact Us</a></li>
                                        <li><a href="contact.php?#support">Business Enquiries</a></li>
                                        <li><a href="https://wa.me/918377053041?text=Hi There, I have some queries to ask. Thanks" target="_blank">Chat Support</a></li>
                                        <li><a href="faq.php">FAQ's</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                                            </div>

                    <!-- USER PROFILE -->
                    <div class="al">
                        <div class="head-pro">
                            <span class="menu desk-menu">
                                <i></i><i></i><i></i>
                            </span>
                        </div>
                        <h4 class="loginregister">
                                                        <a href="login.php">Sign In</a> / <a href="sign-up.php">Sign Up</a>
                                                    </h4>
                    </div>

                    <!--MOBILE MENU-->
                    <div class="mob-menu">
                        <div class="mob-me-ic">
                                                        <span class="mobile-exprt">
                                <a href="login.php"><img src="images/icon/loginuser.svg" alt=""></a>
                            </span>
                                                        <span class="mobile-menu" data-mob="mobile">
                                <img src="images/icon/nav.svg" alt="">
                            </span>
                        </div>
                    </div>
                    <!--END MOBILE MENU-->
                </div>
            </div>
        </div>
        <!-- TOP MENU -->
                <!-- END -->
    </div>
    <!-- END -->

    
    <!-- EXPLORE MENU POPUP -->
    <div class="mob-me-all mobile_menu pt-2">
        <div class="mob-me-clo"><img src="images/icon/close.svg" alt=""></div>
        <div class="logo mb-4">
            <a href="index.php" class="logo-brand"><img src="images/tlogo.png" alt="" loading="lazy" class="ic-logo"></a>
        </div>
        <div class="mv-bus">
                            <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About Us</a></li> 
                    <li><a href="plans.php">Plans</a></li>
                    <li><a href="blog.php">Blogs</a></li>
                </ul>
                <h4><i class="fa fa-question-circle" aria-hidden="true"></i> Help & Support</h4>
                <ul>
                    <li><a href="contact.php">Contact Us</a></li>
                    <li><a href="contact.php?#support">Business Enquiries</a></li>
                    <li><a href="https://wa.me/918377053041?text=Hello i am having some queries" target="_blank">Chat Support</a></li>
                    <li><a href="faq.php">FAQ's</a></li>
                </ul>
                        
        </div>
    </div>
    <!-- END MOBILE MENU POPUP -->    <!-- START -->
    <section>
        <div class="wedd pg-wedd-vid m-tp">
            <div class="container">
                <div class="row">
                    <div class="ban-wedd">
                        <h2>Michael <span>& Jessica</span></h2>
                        <p>Lakhs of peoples have found their life partner with Desi Rishta!</p>
                        <!--<a href="make-reservation.html" class="cta-dark">Make reservation</a>-->
                        <div class="wedd-info">
                            <ul>
                                <li><i class="fa fa-calendar-o" aria-hidden="true"></i><span>12 June | 9:00 AM</span>
                                </li>
                                <li><i class="fa fa-map-marker" aria-hidden="true"></i><a href="#!">Direction</a></li>
                            </ul>
                        </div>
                        <div class="wedd-vid">
                            <img src="images/couples/20.jpg" alt="">
                            <iframe src="https://www.youtube.com/embed/P9iKATG9BW4" title="Wedding marriage: Wedding marriage"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                            <span class="vid-play" data-video="https://www.youtube.com/embed/P9iKATG9BW4?autoplay=1"><i
                                    class="fa fa-play" aria-hidden="true"></i></span>
                        </div>
                        <div class="wedd-vid-tree">
                            <span class="wedd-vid-tre-1"></span>
                            <span class="wedd-vid-tre-2"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END -->

    <!-- START -->
    <section>
        <div class="wedd-dat wedd-vid-dat wedd-gall wedd-vid-gall">
            <div class="">
                <div class="gall-inn">
                    <div class="home-tit">
                        <p>collections</p>
                        <h2><span>Photo gallery</span></h2>
                        <span class="leaf1"></span>
                        <span class="tit-ani-"></span>
                    </div>
                    <div class="col-md-2">
                        <div class="gal-im animate animate__animated animate__slow" data-ani="animate__flipInX">
                            <img src="images/gallery/1.jpg" class="gal-siz-1" alt="">
                            <div class="txt">
                                <span>Wedding</span>
                                <h4>Bride & Groom</h4>
                            </div>
                        </div>
                        <div class="gal-im animate animate__animated animate__slower" data-ani="animate__flipInX">
                            <img src="images/gallery/9.jpg" class="gal-siz-2" alt="">
                            <div class="txt">
                                <span>Wedding</span>
                                <h4>Bride & Groom</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="gal-im animate animate__animated animate__slower" data-ani="animate__flipInX">
                            <img src="images/gallery/3.jpg" class="gal-siz-2" alt="">
                            <div class="txt">
                                <span>Wedding</span>
                                <h4>Bride & Groom</h4>
                            </div>
                        </div>
                        <div class="gal-im animate animate__animated animate__slower" data-ani="animate__flipInX">
                            <img src="images/gallery/4.jpg" class="gal-siz-1" alt="">
                            <div class="txt">
                                <span>Wedding</span>
                                <h4>Bride & Groom</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="gal-im animate animate__animated animate__slower" data-ani="animate__flipInX">
                            <img src="images/gallery/5.jpg" class="gal-siz-1" alt="">
                            <div class="txt">
                                <span>Wedding</span>
                                <h4>Bride & Groom</h4>
                            </div>
                        </div>
                        <div class="gal-im animate animate__animated animate__slower" data-ani="animate__flipInX">
                            <img src="images/gallery/6.jpg" class="gal-siz-2" alt="">
                            <div class="txt">
                                <span>Wedding</span>
                                <h4>Bride & Groom</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="gal-im animate animate__animated animate__slower" data-ani="animate__flipInX">
                            <img src="images/gallery/7.jpg" class="gal-siz-2" alt="">
                            <div class="txt">
                                <span>Wedding</span>
                                <h4>Bride & Groom</h4>
                            </div>
                        </div>
                        <div class="gal-im animate animate__animated animate__slower" data-ani="animate__flipInX">
                            <img src="images/gallery/8.jpg" class="gal-siz-1" alt="">
                            <div class="txt">
                                <span>Wedding</span>
                                <h4>Bride & Groom</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="gal-im animate animate__animated animate__slower" data-ani="animate__flipInX">
                            <img src="images/couples/9.jpg" class="gal-siz-2" alt="">
                            <div class="txt">
                                <span>Wedding</span>
                                <h4>Bride & Groom</h4>
                            </div>
                        </div>
                        <div class="gal-im animate animate__animated animate__slower" data-ani="animate__flipInX">
                            <img src="images/couples/11.jpg" class="gal-siz-1" alt="">
                            <div class="txt">
                                <span>Wedding</span>
                                <h4>Bride & Groom</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END -->


    <!-- FOOTER -->
    <section class="wed-hom-footer">
        <div class="container">
            <div class="row wed-foot-link wed-foot-link-1">
                <div class="col-md-4">
                    <h4>Get In Touch</h4>
                    <p>Location: New Delhi, India</p>
                    <p>Phone: <a href="tel:+918377053041">+91-8377053041</a></p>
                    <p>Email: <a href="mailto:support@desi-rishta.com">support@desi-rishta.com</a></p>
                </div>
                <div class="col-md-4">
                    <h4>HELP &amp; SUPPORT</h4>
                                        <ul>
                        <li><a href="contact.php">Contact us</a>
                        </li>
                        <li><a href="contact.php?#support">Business Enquiries</a>
                        </li>
                        <li><a href="https://wa.me/918377053041?text=Hello i am having some queries" target="_blank">Chat Support</a>
                        </li>
                        <li><a href="faq.php">FAQ's</a>
                        </li>
                        <li><a href="faqterms.php">Terms and Conditions</a>
                        </li>
                        <li><a href="faqprivacy.php">Privacy policy </a>
                        </li>
                        <li><a href="faqcookies.php">Cookies policy  </a>
                        </li>
                        <li><a href="faqgravience.php">Graviences</a>
                        </li>
                    </ul>
                                    </div>
                <div class="col-md-4 fot-soc">
                    <h4>SOCIAL MEDIA</h4>
                    <ul>
                        <li><a href="#!"><img src="images/social/facebook.jpeg" alt="" loading="lazy"></a></li>
                        <li><a href="#!"><img src="images/social/instagram.png" alt="" loading="lazy"></a></li>
                        <li><a href="#!"><img src="images/social/linkedin.jpeg" alt="" loading="lazy"></a></li>
                        <li><a href="#!"><img src="images/social/twitter.jpeg" alt="" loading="lazy"></a></li>
                        <li><a href="#!"><img src="images/social/youtube.jpeg" alt="" loading="lazy"></a></li>
                    </ul>
                </div>
            </div>
            <div class="row foot-count">
                <!--<p>Desi Rishta - Trusted by over thousands of Boys & Girls for successfull marriage.</p>-->
                <p>This website is strictly for matrimonial purpose only and not a dating website</p>
                                <p><a href="sign-up.php" class="btn btn-primary btn-sm">Join us today !</a></p>
                            </div>
        </div>
    </section>
    <!-- END -->

    <!-- COPYRIGHTS -->
    <section>
        <div class="cr">
            <div class="container">
                <div class="row">
                    <p class="pb-0">Copyright © <span>2025</span> <a href="#!" target="_blank">Desi-Rishta.com</a> All
                        rights reserved.</p>
                    <p class="pt-0">Crafted with
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart text-danger"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" style="color:rgb(200, 4, 108);"></path></svg> in Gurugram, India</p>
                </div>
            </div>
        </div>
    </section>
    <!-- END -->

    <!-- link copy-->
    <div class="container copybox" style="display:none">
        <div class="alert alert-success">
            <strong>Link Copied!</strong>.
        </div>
    </div>
    <!-- link copy-->
    
    
    <!-- INTEREST POPUP -->
    <div class="modal fade plncanl-pop" id="plancancel">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title seninter-tit">Plan cancellation</h4>
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body seninter chosenini">
                    <div class="row">
                        <div class="col-md-6 lhs-poli">
                            <h5>Cancellation policy</h5>
                            <ul>
                                <li>Your refund amount calculated day basis</li>
                                <li>As per your plan, your perday cost:10$</li>
                                <li>After 3 months only you can able to join</li>
                                <li>Fair ipsum dummy content ipsum jenuane ai</li>
                                <li>Rairt ipsum dummy content ipsum jenuane ai</li>
                            </ul>
                        </div>
                        <div class="col-md-6 rhs-form">
                            <div class="form-login">
                                <form>
                                    <div class="form-group">
                                        <label class="lb">Reason for the cancellation: *</label>
                                        <select class="chosen-select">
                                            <option value="">I joint my pare</option>
                                            <option value="">Profile match not good</option>
                                            <option value="">Support not good</option>
                                            <option value="">My reason not in the list</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="lb">Message: *</label>
                                        <textarea placeholder="Enter your message" class="form-control" id="" cols="20" rows="5"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-bordered table-responsive">
                                <thead>
                                    <tr>
                                      <th>Plan type</th>
                                      <th>Duration</th>
                                      <th>Cost paid</th>
                                      <th>Perday cost</th>
                                      <th>Plan active days</th>
                                      <th>Remaining days</th>
                                      <th>Cancellation charges</th>
                                      <th>Cost saved</th>
                                    </tr>
                                  </thead>
                                <tbody>
                                  <tr>
                                    <td>Platinum</td>
                                    <td>365 days(12 months)</td>
                                    <td>$1000</td>
                                    <td>$2.73</td>
                                    <td>190 days</td>
                                    <td>175 days</td>
                                    <td>$100</td>
                                    <td>$377.75</td>
                                  </tr>
                                </tbody>
                              </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- END INTEREST POPUP -->
    
     <!-- CHAT CONVERSATION BOX START -->
    <div class="chatbox">
        <span class="comm-msg-pop-clo"><i class="fa fa-times" aria-hidden="true"></i></span>

        <div class="inn">
            <form name="new_chat_form" method="post">
                <div class="s1">
                    <img src="images/user/2.jpg" class="intephoto2" alt="">
                    <h4><b class="intename2">Julia</b>,</h4>
                    <span class="avlsta avilyes">Available online</span>
                </div>
                <div class="s2 chat-box-messages">
                    <span class="chat-wel">Start a new chat!!! now</span>
                    <div class="chat-con">
                        <div class="chat-lhs">Hi</div>
                        <div class="chat-rhs">Hi</div>
                    </div>
                    <!--<span>Start A New Chat!!! Now</span>-->
                </div>
                <div class="s3">
                    <input type="text" name="chat_message" placeholder="Type a message here.." required="">
                    <button id="chat_send1" name="chat_send" type="submit">Send <i class="fa fa-paper-plane-o"
                            aria-hidden="true"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- END -->
    
    
    <!-- Optional JavaScript -->
    
    
    
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/select-opt.js"></script>
    <script src="js/slick.js"></script>
    <script src="js/Chart.js"></script>
    <script src="js/gallery.js"></script>
    <script src="js/custom.js"></script> 
    
    <script>
         //COMMON SLIDER
    $('.slider').slick({
        infinite: true,
        slidesToShow: 5,
        arrows: false,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        dots: false,
        responsive: [{
            breakpoint: 992,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
                centerMode: false
            }
        }]
    });
    
    $('.slider11').slick({
        infinite: true,
        slidesToShow: 3,
        arrows: false,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        dots: false,
        vertical: true,
        responsive: [{
            breakpoint: 992,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                centerMode: false
            }
        }]

    });
    
    $('.slider12').slick({
        infinite: true,
        slidesToShow: 1,
        arrows: false,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000,
        dots: false,
        responsive: [{
            breakpoint: 992,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                centerMode: false
            }
        }]
    });

    $('.count').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
    }, {
        duration: 4000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
});

var xValues = "0";
    var yValues = "50";

    new Chart("Chart_leads", {
        type: "line",
        data: {
            labels: xValues,
            datasets: [{
                fill: false,
                lineTension: 0,
                backgroundColor: "#f1bb51",
                borderColor: "#fae9c8",
                data: yValues
            }]
        },
        options: {
            responsive: true,
            legend: {display: false},
            scales: {
                yAxes: [{ticks: {min: 0, max: 100}}]
            }
        }
    });
    </script>
    
    <script>
    //CHAT WINDOW OPEN
    $(".db-chat-trig").on('click', function () {
        $(".chatbox").addClass("open")
    });
    </script>
    
    <script>
    $(document).ready(function(){
        $('#marital').on('change', function() {
        
        var marital = this.value;
        
        if(marital == 'Divorced')
        {
            $("#children").show();
        }
        else if(marital == 'Widowed')
        {
            $("#children").show();
        }
        else if(marital == 'Awaiting Divorce')
        {
            $("#children").show();
        }
        else
        {
            $("#children").hide();
        }
        });
    });
    </script>
    
    <script>
    $(document).ready(function(){
        $('#familylocation').on('change', function() {
        
        var familylocation = this.value;
        
        if(familylocation == 'Same as my location')
        {
            $(".familystate").hide();
            $("#familystate").prop("required", false);
            $(".familycity").hide();
            $(".familycountry").hide();
            $("#diffcountry").prop("required", false);
            $(".familycities").hide();
        }
        else
        {
            $(".familystate").show();
            $("#familystate").prop("required", true);
            $(".familycity").show();
            $(".familycountry").show();
            $("#diffcountry").prop("required", true);
        }
        });
    });
    </script>
    
    <script>
    $(document).ready(function(){
        $('#stream').on('change', function() {
        
        var stream1 = this.value;
        
        if(stream1 == '')
        {
            $("#emptyeducation").css("display","block"); 
            $(".signupstream").css("display","none");
            $("#"+stream1).css("display","none");
        }
        else
        {
            $("#emptyeducation").css("display","none");
            $(".signupstream").css("display","none");
            $("#"+stream1).css("display","block");
        }
        });
    });
    </script>
    
    <script>
    /*$(document).ready(function(){
        $('#partnerstream').on('change', function() {
        
        var stream11 = this.value;
        
        $.ajax({
            url: "aj-geteducation.php",
            type: "POST",
            data: {stream : stream11}
        }).done(function(data){
                $("#partnereducation").html(data);
            });
        });
    });*/
    </script>
    
    <script>
    $(document).ready(function(){
        $('#domain').on('change', function() {
        
        var domain1 = this.value;
        
        if(domain1 == '')
        {
            $("#emptydesignation").css("display","block");
            $(".signupdomain").css("display","none");
            $("#"+"desig_"+domain1).css("display","none");
        }
        else
        {
            $("#emptydesignation").css("display","none");
            $(".signupdomain").css("display","none");
            $("#"+"desig_"+domain1).css("display","block");
        }
        });
    });
    </script>
    
    <script>
    $(document).ready(function(){
        $('#partnerdomain').on('change', function() {
        
        var domain11 = this.value;
        
        $.ajax({
            url: "aj-getdesignation.php",
            type: "POST",
            data: {domain : domain11}
        }).done(function(data){
                $("#partnerdesignation").html(data);
            });
        });
    });
    </script>
    
    <script>
    $(document).ready(function(){
        $('#state').on('change', function() {
        
        var state1 = this.value;
        
        $.ajax({
            url: "aj-getcity.php",
            type: "POST",
            data: {state : state1}
        }).done(function(data){
                $("#city").html(data);
            });
        });
    });
    </script>
    
    <script>
    $(document).ready(function(){
        $('#partnerstate').on('change', function() {
        
        var state11 = this.value;
        
        if(state11 == '')
        {
            $("#emptypartnercity").css("display","block");
            $(".signuppartnercity").css("display","none");
            $("#"+"pc_"+state11).css("display","none");
        }
        else
        {
            $("#emptypartnercity").css("display","none");
            $(".signuppartnercity").css("display","none");
            $("#"+"pc_"+state11).css("display","block");
        }
            
        });
        
        $('#groomstate').on('change', function() {
        
        var state22 = this.value;
        
        if(state22 == '')
        {
            $("#emptygroomcity").css("display","block");
            $(".signupgroomcity").css("display","none");
            $("#"+state22).css("display","none");
        }
        else
        {
            $("#emptygroomcity").css("display","none");
            $(".signupgroomcity").css("display","none");
            $("#"+state22).css("display","block");
        }
        });
        
        $('#familystate').on('change', function() {
        
        var state33 = this.value;
        
        if(state33 == '')
        {
            $("#emptyfamilycity").css("display","block");
            $(".familycities").css("display","none");
            $("#"+state33).css("display","none");
        }
        else
        {
            $("#emptyfamilycity").css("display","none");
            $(".familycities").css("display","none");
            $("#"+state33).css("display","block");
            $("#gc_"+state33).prop("required",true);
        }
        });
    });
    </script>
    
    <script>
    $(document).ready(function(){
        $('#religion').on('change', function() {
        
        var religion1 = this.value;
        
        if(religion1 == '')
        {
            $("#emptycaste").css("display","block");
            $(".signupcaste").css("display","none");
            $("#"+religion1).css("display","none");
        }
        else
        {
            $("#emptycaste").css("display","none");
            $(".signupcaste").css("display","none");
            $("#"+religion1).css("display","block");
        }
        });
    });
    </script>
    
    <script>
    /*$(document).ready(function(){
        $('#partnerreligion').on('change', function() {
        
        var religion11 = this.value;
        
        $.ajax({
            url: "aj-getcaste.php",
            type: "POST",
            data: {religion : religion11}
        }).done(function(data){
                $("#partnercaste").html(data);
            });
        });
    });*/
    </script>
    
    
    
    <script>
        $(document).ready(function(){
            $('#bridecountry').on('change', function() {
            
            var bridecountry = this.value;
            
            if(bridecountry != 'India')
            {
                $('#bridecitizen').show();
                $('#brideresident').show();
            }
            else
            {
                $('#bridecitizen').hide();
                $('#brideresident').hide();
            }
        });
    });
    </script>
    
        
    <script>
        $(document).ready(function(){
            //setup before functions
            var typingTimer1;                //timer identifier
            var doneTypingInterval1 = 1000;  //time in ms (5 seconds)
            
            //on keyup, start the countdown
            $('#aadharnumber').keyup(function(){
                clearTimeout(typingTimer1);
                if ($('#aadharnumber').val()) {
                    typingTimer1 = setTimeout(doneTyping1, doneTypingInterval1);
                }
            });
            
            //user is "finished typing," do something
            function doneTyping1 () {
                //do something
                var aadharnum = $('#aadharnumber').val();
                
                var aadharnumlen = $('#aadharnumber').val().length;
                
                if(aadharnumlen == '12')
                {
                    $.ajax({
                        type: "POST",
                        url: "api_aadharotp.php",
                        data: { aadharnumber : aadharnum} 
                    }).done(function(data){
                        $("#aadharnumber").addClass('is-valid')
                        $("#aadharotp").html(data);
                    });
                }
                else
                {
                    $("#aadharnumber").addClass('is-invalid')
                }
            }
        });
</script>

<script>
$(document).ready(function(){
  $("#activities").click(function(){
    $("#activitiessubmenu").toggle();
  });
});

$(document).ready(function(){
  $("#profile").click(function(){
    $("#profilesubmenu").toggle();
  });
});
</script>

<script>
$(document).ready(function(){
      $(".collapse1").click(function(){
    $("#collapse1").toggle();
    $(".collapse1").toggleClass("collapse");
    $(".collapse1").toggleClass("collapsed");
  });
    $(".collapse2").click(function(){
    $("#collapse2").toggle();
    $(".collapse2").toggleClass("collapse");
    $(".collapse2").toggleClass("collapsed");
  });
    $(".collapse3").click(function(){
    $("#collapse3").toggle();
    $(".collapse3").toggleClass("collapse");
    $(".collapse3").toggleClass("collapsed");
  });
    $(".collapse4").click(function(){
    $("#collapse4").toggle();
    $(".collapse4").toggleClass("collapse");
    $(".collapse4").toggleClass("collapsed");
  });
    $(".collapse5").click(function(){
    $("#collapse5").toggle();
    $(".collapse5").toggleClass("collapse");
    $(".collapse5").toggleClass("collapsed");
  });
    $(".collapse6").click(function(){
    $("#collapse6").toggle();
    $(".collapse6").toggleClass("collapse");
    $(".collapse6").toggleClass("collapsed");
  });
    $(".collapse7").click(function(){
    $("#collapse7").toggle();
    $(".collapse7").toggleClass("collapse");
    $(".collapse7").toggleClass("collapsed");
  });
    $(".collapse8").click(function(){
    $("#collapse8").toggle();
    $(".collapse8").toggleClass("collapse");
    $(".collapse8").toggleClass("collapsed");
  });
    $(".collapse9").click(function(){
    $("#collapse9").toggle();
    $(".collapse9").toggleClass("collapse");
    $(".collapse9").toggleClass("collapsed");
  });
    $(".collapse10").click(function(){
    $("#collapse10").toggle();
    $(".collapse10").toggleClass("collapse");
    $(".collapse10").toggleClass("collapsed");
  });
    $(".collapse11").click(function(){
    $("#collapse11").toggle();
    $(".collapse11").toggleClass("collapse");
    $(".collapse11").toggleClass("collapsed");
  });
    $(".collapse12").click(function(){
    $("#collapse12").toggle();
    $(".collapse12").toggleClass("collapse");
    $(".collapse12").toggleClass("collapsed");
  });
    $(".collapse13").click(function(){
    $("#collapse13").toggle();
    $(".collapse13").toggleClass("collapse");
    $(".collapse13").toggleClass("collapsed");
  });
    $(".collapse14").click(function(){
    $("#collapse14").toggle();
    $(".collapse14").toggleClass("collapse");
    $(".collapse14").toggleClass("collapsed");
  });
    $(".collapse15").click(function(){
    $("#collapse15").toggle();
    $(".collapse15").toggleClass("collapse");
    $(".collapse15").toggleClass("collapsed");
  });
    $(".collapse16").click(function(){
    $("#collapse16").toggle();
    $(".collapse16").toggleClass("collapse");
    $(".collapse16").toggleClass("collapsed");
  });
    $(".collapse17").click(function(){
    $("#collapse17").toggle();
    $(".collapse17").toggleClass("collapse");
    $(".collapse17").toggleClass("collapsed");
  });
    $(".collapse18").click(function(){
    $("#collapse18").toggle();
    $(".collapse18").toggleClass("collapse");
    $(".collapse18").toggleClass("collapsed");
  });
    $(".collapse19").click(function(){
    $("#collapse19").toggle();
    $(".collapse19").toggleClass("collapse");
    $(".collapse19").toggleClass("collapsed");
  });
    $(".collapse20").click(function(){
    $("#collapse20").toggle();
    $(".collapse20").toggleClass("collapse");
    $(".collapse20").toggleClass("collapsed");
  });
    $(".collapse21").click(function(){
    $("#collapse21").toggle();
    $(".collapse21").toggleClass("collapse");
    $(".collapse21").toggleClass("collapsed");
  });
    $(".collapse22").click(function(){
    $("#collapse22").toggle();
    $(".collapse22").toggleClass("collapse");
    $(".collapse22").toggleClass("collapsed");
  });
    $(".collapse23").click(function(){
    $("#collapse23").toggle();
    $(".collapse23").toggleClass("collapse");
    $(".collapse23").toggleClass("collapsed");
  });
    $(".collapse24").click(function(){
    $("#collapse24").toggle();
    $(".collapse24").toggleClass("collapse");
    $(".collapse24").toggleClass("collapsed");
  });
    $(".collapse25").click(function(){
    $("#collapse25").toggle();
    $(".collapse25").toggleClass("collapse");
    $(".collapse25").toggleClass("collapsed");
  });
    $(".collapse26").click(function(){
    $("#collapse26").toggle();
    $(".collapse26").toggleClass("collapse");
    $(".collapse26").toggleClass("collapsed");
  });
    $(".collapse27").click(function(){
    $("#collapse27").toggle();
    $(".collapse27").toggleClass("collapse");
    $(".collapse27").toggleClass("collapsed");
  });
    $(".collapse28").click(function(){
    $("#collapse28").toggle();
    $(".collapse28").toggleClass("collapse");
    $(".collapse28").toggleClass("collapsed");
  });
    $(".collapse29").click(function(){
    $("#collapse29").toggle();
    $(".collapse29").toggleClass("collapse");
    $(".collapse29").toggleClass("collapsed");
  });
    $(".collapse30").click(function(){
    $("#collapse30").toggle();
    $(".collapse30").toggleClass("collapse");
    $(".collapse30").toggleClass("collapsed");
  });
    $(".collapse31").click(function(){
    $("#collapse31").toggle();
    $(".collapse31").toggleClass("collapse");
    $(".collapse31").toggleClass("collapsed");
  });
    $(".collapse32").click(function(){
    $("#collapse32").toggle();
    $(".collapse32").toggleClass("collapse");
    $(".collapse32").toggleClass("collapsed");
  });
    $(".collapse33").click(function(){
    $("#collapse33").toggle();
    $(".collapse33").toggleClass("collapse");
    $(".collapse33").toggleClass("collapsed");
  });
    $(".collapse34").click(function(){
    $("#collapse34").toggle();
    $(".collapse34").toggleClass("collapse");
    $(".collapse34").toggleClass("collapsed");
  });
    $(".collapse35").click(function(){
    $("#collapse35").toggle();
    $(".collapse35").toggleClass("collapse");
    $(".collapse35").toggleClass("collapsed");
  });
    $(".collapse36").click(function(){
    $("#collapse36").toggle();
    $(".collapse36").toggleClass("collapse");
    $(".collapse36").toggleClass("collapsed");
  });
    $(".collapse37").click(function(){
    $("#collapse37").toggle();
    $(".collapse37").toggleClass("collapse");
    $(".collapse37").toggleClass("collapsed");
  });
    $(".collapse38").click(function(){
    $("#collapse38").toggle();
    $(".collapse38").toggleClass("collapse");
    $(".collapse38").toggleClass("collapsed");
  });
    $(".collapse39").click(function(){
    $("#collapse39").toggle();
    $(".collapse39").toggleClass("collapse");
    $(".collapse39").toggleClass("collapsed");
  });
    $(".collapse40").click(function(){
    $("#collapse40").toggle();
    $(".collapse40").toggleClass("collapse");
    $(".collapse40").toggleClass("collapsed");
  });
    $(".collapse41").click(function(){
    $("#collapse41").toggle();
    $(".collapse41").toggleClass("collapse");
    $(".collapse41").toggleClass("collapsed");
  });
    $(".collapse42").click(function(){
    $("#collapse42").toggle();
    $(".collapse42").toggleClass("collapse");
    $(".collapse42").toggleClass("collapsed");
  });
    $(".collapse43").click(function(){
    $("#collapse43").toggle();
    $(".collapse43").toggleClass("collapse");
    $(".collapse43").toggleClass("collapsed");
  });
    $(".collapse44").click(function(){
    $("#collapse44").toggle();
    $(".collapse44").toggleClass("collapse");
    $(".collapse44").toggleClass("collapsed");
  });
    $(".collapse45").click(function(){
    $("#collapse45").toggle();
    $(".collapse45").toggleClass("collapse");
    $(".collapse45").toggleClass("collapsed");
  });
    $(".collapse46").click(function(){
    $("#collapse46").toggle();
    $(".collapse46").toggleClass("collapse");
    $(".collapse46").toggleClass("collapsed");
  });
    $(".collapse47").click(function(){
    $("#collapse47").toggle();
    $(".collapse47").toggleClass("collapse");
    $(".collapse47").toggleClass("collapsed");
  });
    $(".collapse48").click(function(){
    $("#collapse48").toggle();
    $(".collapse48").toggleClass("collapse");
    $(".collapse48").toggleClass("collapsed");
  });
    $(".collapse49").click(function(){
    $("#collapse49").toggle();
    $(".collapse49").toggleClass("collapse");
    $(".collapse49").toggleClass("collapsed");
  });
    $(".collapse50").click(function(){
    $("#collapse50").toggle();
    $(".collapse50").toggleClass("collapse");
    $(".collapse50").toggleClass("collapsed");
  });
  });
</script>

<script>
$(document).ready(function(){
  $(".sett-acc-edit-eve").click(function(){
    $(".sett-acc-edit").toggle();
  });
});
</script>


<script>
    $(document).ready(function () {
    $("#passupdate").click(function () {
        var pass = $('#pass').val();
        var cpass = $('#cpass').val();
        
        if (pass === "") 
        {
            $(".pempty").show();
            return false;
        }
        
        if (cpass === "") 
        {
            $(".pempty").hide();
            $(".cpempty").show();
            return false;
        }
        
        if ( parseInt(pass) < parseInt(cpass) ) 
        {
            $(".pempty").hide();
            $(".cpempty").hide();
            $(".notmatch").toggle();
            return false;
        }
        
        if ( parseInt(pass) === parseInt(cpass) )
        {
            $(".pempty").hide();
            $(".cpempty").hide();
            $(".notmatch").hide();
            return true;
        }
    });
});
</script>

<script>
    $(document).ready(function() {
        setTimeout(function() { 
            $("#invalidpop").fadeOut(1500); 
        }, 13000)
    });
</script>

<script>
    $(document).ready(function() {
        setTimeout(function() { 
            $(".copybox").fadeOut(1500); 
        }, 13000)
    });
</script>

<script>
$(document).ready(function(){
    timeLeft = 60;

    function countdown() {
	    timeLeft--;
	    document.getElementById("seconds").innerHTML = String( timeLeft );
	    if (timeLeft > 0) {
		    setTimeout(countdown, 1000);
	    }
	    else
	    {
	        $('#resendbtn').css('display', 'block');
	        $('#timer').css('display', 'none');
	        $('#pwd').css('border', '2px solid red')
	    }
    };

    setTimeout(countdown, 1000);

});
</script>


<script>
    $(document).ready(function () {
        $("#sortby").change(function () {
            var sortby = $('#sortby').val();
            
            currLoc = $(location).attr('href');
            
            var clean_uri = currLoc.substring(0, currLoc.indexOf("?"))
            
            window.location.replace(clean_uri+'?&sort='+sortby);
        });
    });
</script>

<script>
    $(document).ready(function () {
        $("#removeblur").click(function () {
            $("ul").removeClass("coninfo");
            $("div").removeClass("conborder");
            $(".lockscreen").hide();
        });
    });
</script>

</body>
</html>