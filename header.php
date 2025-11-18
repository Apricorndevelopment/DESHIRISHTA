<?php
// ob_start();

// include 'config.php';

// $userid = $_COOKIE['dr_userid'];

// $sqlregistration = "select * from registration where userid = '$userid'";
// $resultregistration = mysqli_query($con,$sqlregistration);
// $rowregistration = mysqli_fetch_assoc($resultregistration);

// $id_verification = $rowregistration['verificationinfo'];
// $id_verification_popup = $rowregistration['verification_popup'];
// $id_profilestatus = $rowregistration['profilestatus'];
// $id_profilestatus_popup = $rowregistration['profilestatus_popup'];

ob_start();

include 'config.php';

// --- START FIX ---
// Sabhi variables ko default (null ya 0) par set karein
$userid = null;
$rowregistration = null;
$id_verification = null;
$id_verification_popup = null;
$id_profilestatus = null;
$id_profilestatus_popup = null;
$useractive = 0; // Maan ke chalo ki user active nahi hai

// Ab check karein ki cookie set hai ya nahi
if(isset($_COOKIE['dr_userid'])) {
    
    // Agar cookie set hai, tabhi $userid assign karein
    $userid = $_COOKIE['dr_userid'];

    $sqlregistration = "select * from registration where userid = '$userid'";
    $resultregistration = mysqli_query($con, $sqlregistration);

    // Ye bhi check karein ki query se user mila ya nahi
    if($resultregistration && mysqli_num_rows($resultregistration) > 0) {
        $rowregistration = mysqli_fetch_assoc($resultregistration);

        // Ab ye safe hai, kyunki $rowregistration null nahi hai
        $id_verification = $rowregistration['verificationinfo'];
        $id_verification_popup = $rowregistration['verification_popup'];
        $id_profilestatus = $rowregistration['profilestatus'];
        $id_profilestatus_popup = $rowregistration['profilestatus_popup'];
    }
}
?>
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
    <!-- <link rel="stylesheet" href="css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


<style>
    /* === Mobile Menu Link Slide-Up Effect (Slower: 4 Sec) === */

/* 1. Har link ko hide karein aur animation speed 0.5s set karein */
.mob-me-all .mv-bus ul li,
.mob-me-all .mv-bus h4 {
    opacity: 0;
    transform: translateY(20px);
    /* Speed ko 0.3s se 0.5s kar diya hai */
    transition: opacity 0.5s ease-out, transform 0.5s ease-out;
}

/* 2. Jab menu khule (.act), tab link ko show karein */
.mob-me-all.act .mv-bus ul li,
.mob-me-all.act .mv-bus h4 {
    opacity: 1;
    transform: translateY(0);
}

/* 3. Har link ke liye naya (slow) delay set karein */

/* --- Logged Out Menu (Aapke screenshot ke hisab se) --- */
.mob-me-all.act .mv-bus ul:nth-of-type(1) li:nth-child(1) { transition-delay: 0.2s; }
.mob-me-all.act .mv-bus ul:nth-of-type(1) li:nth-child(2) { transition-delay: 0.4s; }
.mob-me-all.act .mv-bus ul:nth-of-type(1) li:nth-child(3) { transition-delay: 0.6s; }
.mob-me-all.act .mv-bus ul:nth-of-type(1) li:nth-child(4) { transition-delay: 0.8s; }

.mob-me-all.act .mv-bus h4:nth-of-type(1) { transition-delay: 1.0s; } /* "Help & Support" title */

.mob-me-all.act .mv-bus ul:nth-of-type(2) li:nth-child(1) { transition-delay: 1.2s; }
.mob-me-all.act .mv-bus ul:nth-of-type(2) li:nth-child(2) { transition-delay: 1.4s; }
.mob-me-all.act .mv-bus ul:nth-of-type(2) li:nth-child(3) { transition-delay: 1.6s; }
.mob-me-all.act .mv-bus ul:nth-of-type(2) li:nth-child(4) { transition-delay: 1.8s; }


/* --- Logged In Menu (Login ke baad ke liye) --- */
.mob-me-all.act .mv-bus h4:nth-of-type(1) { transition-delay: 0.2s; } /* Dashboard */
.mob-me-all.act .mv-bus ul:nth-of-type(1) li:nth-child(1) { transition-delay: 0.4s; }

.mob-me-all.act .mv-bus h4:nth-of-type(2) { transition-delay: 0.6s; } /* Matches */
.mob-me-all.act .mv-bus ul:nth-of-type(2) li:nth-child(1) { transition-delay: 0.8s; }
.mob-me-all.act .mv-bus ul:nth-of-type(2) li:nth-child(2) { transition-delay: 1.0s; }
.mob-me-all.act .mv-bus ul:nth-of-type(2) li:nth-child(3) { transition-delay: 1.2s; }
.mob-me-all.act .mv-bus ul:nth-of-type(2) li:nth-child(4) { transition-delay: 1.4s; }
.mob-me-all.act .mv-bus ul:nth-of-type(2) li:nth-child(5) { transition-delay: 1.6s; }
.mob-me-all.act .mv-bus ul:nth-of-type(2) li:nth-child(6) { transition-delay: 1.8s; }
.mob-me-all.act .mv-bus ul:nth-of-type(2) li:nth-child(7) { transition-delay: 2.0s; }
.mob-me-all.act .mv-bus ul:nth-of-type(2) li:nth-child(8) { transition-delay: 2.2s; }

.mob-me-all.act .mv-bus h4:nth-of-type

/* === Team Member Text Left-Align Fix (Final) === */

/* 1. Card ke text-align ko left par force karein */
.ab-team ul li div {
    text-align: left !important; /* Center ko override karega */
}

/* 2. Text (Name aur Designation) ko side se padding dein */
.ab-team ul li div h4,
.ab-team ul li div p {
    padding-left: 20px;
    padding-right: 20px;
}

/* 3. Social icons (jo hover par aate hain) ko wapas center mein kar dein */
.ab-team ul li div .social-light {
    text-align: center; /* Icons ko center karega */
    margin: 0 auto; /* 'display: table' ke saath milkar center karega */
    padding-top: 10px; /* */
}

/* 4. Ye zaroori hai taaki icons ek line mein rahen */
.ab-team .social-light li {
    display: inline-block;
    float: none !important; 
    width: auto !important;
}
</style>
      
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
                        <li><a href="mailto:info@example.com"><i class="fa-regular fa-envelope"></i>
&nbsp; support@desi-rishta.com</a></li>
                    </ul>
                </div>
                <div class="rhs">
                    <ul>
                        <li><a href="#!"><i class="fa-brands fa-facebook"></i></a></li>
<li><a href="#!"><i class="fa-brands fa-instagram"></i></a></li>
<li><a href="https://wa.me/918377053041?text=Hello..." target="_blank">
    <i class="fa-brands fa-whatsapp"></i>
</a></li>

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
                    
                    <?php
                    $sqluseractive = "select * from registration where userid = '$userid' and otpstatus = 'active'";
                    $resultuseractive = mysqli_query($con,$sqluseractive);
                    $useractive = mysqli_num_rows($resultuseractive);
                    ?>
                    <!-- EXPLORE MENU -->
                    <div class="bl">
                        <?php
                        if($useractive == '0')
                        {
                        ?>
                        <ul>
                            <li><a href="index.php">Home</a></li>
                            <li><a href="about.php">About Us</a></li> 
                            <li><a href="plans.php">Pricing Plans </a></li>
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
                        <?php
                        }
                        else
                        {
                        ?>
                        <ul>
                            <li><a href="user-dashboard.php">My Dashboard</a></li>
                            <!--<li class="smenu-pare">
                                <span class="smenu">My Activities</span>
                                <div class="smenu-open smenu-single">
                                    <ul>
                                        <li><a href="user-interests.php">Incoming Requests </a></li>
                                        <li><a href="user-interests.php">Outgoing Requests</a></li>
                                    </ul>
                                </div>
                            </li>-->
                            <li class="smenu-pare">
                                <span class="smenu">Matches</span>
                                <div class="smenu-open smenu-single">
                                    <ul>
                                        <li><a href="matches-allprofiles.php">All Profiles </a></li>
                                        <li><a href="matches-newlyjoined.php">Newly Joined</a></li>
                                        <li><a href="matches-newmatches.php">New Matches</a></li>
                                        <li><a href="matches-mymatches.php">My Matches</a></li>
                                        <li><a href="matches-nearby.php">Near By Matches</a></li>
                                        <li><a href="matches-viewed.php">Recently Viewed</a></li>
                                        <li><a href="matches-visitors.php">Recent Visitors</a></li>
                                        <li><a href="matches-shortlisted.php">Shortlisted Profiles</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="smenu-pare">
                                <span class="smenu">Search</span>
                                <div class="smenu-open smenu-single">
                                    <ul>
                                        <li><a href="basic-search.php">Basic Search </a></li>
                                        <li><a href="#" class="ser-open">Member ID Search</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li><a href="user-plan.php">Plans</a></li>
                            <li class="smenu-pare">
                                <span class="smenu">Help & Support</span>
                                <div class="smenu-open smenu-single">
                                    <ul>
                                        <li><a href="contact.php">Contact Us</a></li>
                                        <li><a href="submitrequest.php?#support">Submit a Request</a></li>
                                        <li><a href="https://wa.me/918377053041?text=Hi There, I have some queries to ask. Thanks" target="_blank">Chat Support</a></li>
                                        <li><a href="faq.php">FAQ's</a></li>
                                        <li><a href="reviewrating.php?#support">Reviews & Rating</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                        <?php
                        }
                        ?>
                    </div>

                    <!-- USER PROFILE -->
                    <div class="al">
                        <div class="head-pro">
                            <span class="menu desk-menu">
                                <i></i><i></i><i></i>
                            </span>
                        </div>
                        <h4 class="loginregister">
                            <?php
                            if($useractive == '0')
                            {
                            ?>
                           
                           
                           <h4 class="loginregister">
    <a href="login.php" data-text="Sign In">Sign In</a> /
    <a href="sign-up.php" data-text="Sign Up">Sign Up</a>
</h4>

                            <?php
                            }
                            else
                            {
                            ?>
                            <a href="logout.php">Log Out</a>
                            <?php 
                            }
                            ?>
                        </h4>
                    </div>
                  <!-- <style>
                    .loginregister a {
    position: relative;
    font-weight: 600;
    color: #ffffff;
    display: inline-block;
    overflow: hidden;
}

/* TEXT SHINE EFFECT */
.loginregister a::before {
    content: attr(data-text);
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    color: transparent;
    background: linear-gradient(
        90deg,
        transparent 0%,
        #ffdb8eff 50%,
        transparent 100%
    );
    background-size: 200%;
    background-clip: text;
    -webkit-background-clip: text;
    animation: goldShine 1s linear infinite;
}

@keyframes goldShine {
    0% {
        background-position: -100%;
    }
    100% {
        background-position: 200%;
    }
}

                  </style> -->

                    <!--MOBILE MENU-->
                   <div class="mob-menu">
    <div class="mob-me-ic">
        <?php
        if($useractive == '0') {
        ?>
            <!-- User NOT logged in → LOGIN icon -->
            <span class="mobile-exprt">
                <a href="login.php" class="user-login" style="margin-right:-5px;">
                    <i class="bi bi-person"></i>
                </a>
            </span>
        <?php
        } else {
        ?>
            <!-- User logged in → LOGOUT icon -->
            <span class="mobile-exprt">
                <a href="logout.php" style="margin-right:10px;">
                    <i class="bi bi-power"></i>
                </a>
            </span>
        <?php
        }
        ?>

        <!-- Mobile Menu Icon -->
        <span class="mobile-menu" data-mob="mobile" style="margin-right: 15px;">
            <i class="bi bi-list"></i>
        </span>
    </div>
</div>

                    <!--END MOBILE MENU-->
                </div>
            </div>
        </div>
        <!-- TOP MENU -->
        <?php
        $sqlannoucement = "select * from promotion where id = '1'";
        $resultannoucement = mysqli_query($con,$sqlannoucement);
        $rowannoucement = mysqli_fetch_assoc($resultannoucement);
        if($rowannoucement['fpromotion'] != '')
        {
        ?>
        <div class="head-bottom">
            <div class="">
                <div class="row">
                    <marquee><?php echo $rowannoucement['fpromotion']?></marquee>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
        <!-- END -->
    </div>
    <!-- END -->

    
    <!-- EXPLORE MENU POPUP -->
    <div class="mob-me-all mobile_menu pt-2">
        <div class="mob-me-clo">
           
    <i class="bi bi-x-lg"></i>


        </div>
        <div class="logo mb-4">
            <a href="index.php" class="logo-brand"><img src="images/tlogo.png" alt="" loading="lazy" class="ic-logo"></a>
        </div>
        <div class="mv-bus">
            <?php
            if($useractive == '0')
            {
            ?>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About Us</a></li> 
                    <li><a href="plans.php">Pricing Plans </a></li>
                    <li><a href="blog.php">Blogs</a></li>
                </ul>
                <h4><i class="fa fa-question-circle" aria-hidden="true"></i> Help & Support</h4>
                <ul>
                    <li><a href="contact.php">Contact Us</a></li>
                    <li><a href="contact.php?#support">Business Enquiries</a></li>
                    <li><a href="https://wa.me/918377053041?text=Hello i am having some queries" target="_blank">Chat Support</a></li>
                    <li><a href="faq.php">FAQ's</a></li>
                </ul>
            <?php
            }
            else
            {
            ?>
                <h4><i class="fa fa-dashboard" aria-hidden="true"></i> Dashbord</h4>
                <ul>
                    <li><a href="user-dashboard.php">My Dashboard</a></li>
                </ul>
                <h4><i class="fa fa-users" aria-hidden="true"></i> Matches</h4>
                <ul>
                    <li><a href="matches-allprofiles.php">All Profiles </a></li>
                    <li><a href="matches-newlyjoined.php">Newly Joined</a></li>
                    <li><a href="matches-newmatches.php">New Matches</a></li>
                    <li><a href="matches-mymatches.php">My Matches</a></li>
                    <li><a href="matches-nearby.php">Near By Matches</a></li>
                    <li><a href="matches-viewed.php">Recently Viewed</a></li>
                    <li><a href="matches-visitors.php">Recent Visitors</a></li>
                    <li><a href="matches-shortlisted.php">Shortlisted Profiles</a></li>
                </ul>
                <h4><i class="fa fa-search" aria-hidden="true"></i> Search</h4>
                <ul>
                    <li><a href="basic-search.php">Basic Search </a></li>
                    <li><a href="#" class="ser-open">Member ID Search</a></li>
                </ul>
                <h4><i class="fa fa-list" aria-hidden="true"></i>Plans </h4>
                <ul>
                    <li><a href="user-plan.php">Pricing Plans </a></li>
                </ul>
                <h4><i class="fa fa-question-circle" aria-hidden="true"></i> Help & Support</h4>
                <ul>
                    <li><a href="contact.php">Contact Us</a></li>
                    <li><a href="submitrequest.php?#support">Submit a Request</a></li>
                    <li><a href="https://wa.me/918377053041?text=Hello i am having some queries" target="_blank">Chat Support</a></li>
                    <li><a href="faq.php">FAQ's</a></li>
                    <li><a href="reviewrating.php?#support">Reviews & Rating</a></li>
                </ul>
            <?php
            }
            ?>
            
        </div>
    </div>
    <!-- END MOBILE MENU POPUP -->