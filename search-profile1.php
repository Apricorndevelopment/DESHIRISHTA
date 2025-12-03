
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
                    
                                        <!-- EXPLORE MENU -->
                    <div class="bl">
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
                                            </div>

                    <!-- USER PROFILE -->
                    <div class="al">
                        <div class="head-pro">
                            <span class="menu desk-menu">
                                <i></i><i></i><i></i>
                            </span>
                        </div>
                        <h4 class="loginregister">
                                                       
                           
                          
    <a href="login.php" data-text="Sign In">Sign In</a> /
    <a href="sign-up.php" data-text="Sign Up">Sign Up</a>


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
                    <!-- User NOT logged in → LOGIN icon -->
            <span class="mobile-exprt">
                <a href="login.php" class="user-login" style="margin-right:-5px;">
                    <i class="bi bi-person"></i>
                </a>
            </span>
        
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
                        
        </div>
    </div>
    <!-- END MOBILE MENU POPUP -->    <!-- SUB-HEADING -->
    <section>
        <div class="all-pro-head">
            <div class="container">
                <div class="row">
                    <h1>Search Profiles</h1>
                </div>
            </div>
        </div>
        <!--FILTER ON MOBILE VIEW-->
        <div class="fil-mob fil-mob-act">
            <h4>Profile filters <i class="fa fa-filter" aria-hidden="true"></i> </h4>
        </div>
    </section>
    <!-- END -->

    <!-- START -->
    <section>
        <div class="all-weddpro all-jobs all-serexp chosenini">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 fil-mob-view">
                        <span class="filter-clo">+</span>
                        <form action="filter-profiles.php" method="post">
                            <!-- START -->
                            <div class="filt-com lhs-cate">
                                <h4><i><span class="material-icons">123</span></i>Age <span class="text-danger">*</span></h4>
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group">
                                            <select class="chosen-select" name="agefrom" required>
                                                <option value="">From</option>
                                                                                                <option  value="18">18</option>
                                                                                                <option  value="19">19</option>
                                                                                                <option  value="20">20</option>
                                                                                                <option  value="21">21</option>
                                                                                                <option  value="22">22</option>
                                                                                                <option  value="23">23</option>
                                                                                                <option  value="24">24</option>
                                                                                                <option  value="25">25</option>
                                                                                                <option  value="26">26</option>
                                                                                                <option  value="27">27</option>
                                                                                                <option  value="28">28</option>
                                                                                                <option  value="29">29</option>
                                                                                                <option  value="30">30</option>
                                                                                                <option  value="31">31</option>
                                                                                                <option  value="32">32</option>
                                                                                                <option  value="33">33</option>
                                                                                                <option  value="34">34</option>
                                                                                                <option  value="35">35</option>
                                                                                                <option  value="36">36</option>
                                                                                                <option  value="37">37</option>
                                                                                                <option  value="38">38</option>
                                                                                                <option  value="39">39</option>
                                                                                                <option  value="40">40</option>
                                                                                                <option  value="41">41</option>
                                                                                                <option  value="42">42</option>
                                                                                                <option  value="43">43</option>
                                                                                                <option  value="44">44</option>
                                                                                                <option  value="45">45</option>
                                                                                                <option  value="46">46</option>
                                                                                                <option  value="47">47</option>
                                                                                                <option  value="48">48</option>
                                                                                                <option  value="49">49</option>
                                                                                                <option  value="50">50</option>
                                                                                                <option  value="51">51</option>
                                                                                                <option  value="52">52</option>
                                                                                                <option  value="53">53</option>
                                                                                                <option  value="54">54</option>
                                                                                                <option  value="55">55</option>
                                                                                                <option  value="56">56</option>
                                                                                                <option  value="57">57</option>
                                                                                                <option  value="58">58</option>
                                                                                                <option  value="59">59</option>
                                                                                                <option  value="60">60</option>
                                                                                                <option  value="61">61</option>
                                                                                                <option  value="62">62</option>
                                                                                                <option  value="63">63</option>
                                                                                                <option  value="64">64</option>
                                                                                                <option  value="65">65</option>
                                                                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="chosen-select" name="ageto" required>
                                                <option value="">To</option>
                                                                                                <option  value="20">20</option>
                                                                                                <option  value="21">21</option>
                                                                                                <option  value="22">22</option>
                                                                                                <option  value="23">23</option>
                                                                                                <option  value="24">24</option>
                                                                                                <option  value="25">25</option>
                                                                                                <option  value="26">26</option>
                                                                                                <option  value="27">27</option>
                                                                                                <option  value="28">28</option>
                                                                                                <option  value="29">29</option>
                                                                                                <option  value="30">30</option>
                                                                                                <option  value="31">31</option>
                                                                                                <option  value="32">32</option>
                                                                                                <option  value="33">33</option>
                                                                                                <option  value="34">34</option>
                                                                                                <option  value="35">35</option>
                                                                                                <option  value="36">36</option>
                                                                                                <option  value="37">37</option>
                                                                                                <option  value="38">38</option>
                                                                                                <option  value="39">39</option>
                                                                                                <option  value="40">40</option>
                                                                                                <option  value="41">41</option>
                                                                                                <option  value="42">42</option>
                                                                                                <option  value="43">43</option>
                                                                                                <option  value="44">44</option>
                                                                                                <option  value="45">45</option>
                                                                                                <option  value="46">46</option>
                                                                                                <option  value="47">47</option>
                                                                                                <option  value="48">48</option>
                                                                                                <option  value="49">49</option>
                                                                                                <option  value="50">50</option>
                                                                                                <option  value="51">51</option>
                                                                                                <option  value="52">52</option>
                                                                                                <option  value="53">53</option>
                                                                                                <option  value="54">54</option>
                                                                                                <option  value="55">55</option>
                                                                                                <option  value="56">56</option>
                                                                                                <option  value="57">57</option>
                                                                                                <option  value="58">58</option>
                                                                                                <option  value="59">59</option>
                                                                                                <option  value="60">60</option>
                                                                                                <option  value="61">61</option>
                                                                                                <option  value="62">62</option>
                                                                                                <option  value="63">63</option>
                                                                                                <option  value="64">64</option>
                                                                                                <option  value="65">65</option>
                                                                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END -->
                            <!-- START -->
                            <div class="filt-com lhs-cate">
                                <h4><i><span class="material-icons">height</span></i>Height</h4>
                                <div class="row">
                                    <div class="col-md-12 mb-2">
                                        <div class="form-group">
                                            <select class="chosen-select" name="heightfrom">
                                                <option value="">From</option>
                                                <option  value="4 Feet 5 Inches">4 Feet 5 Inches</option>
                                                <option  value="4 Feet 6 Inches">4 Feet 6 Inches</option>
                                                <option  value="4 Feet 7 Inches">4 Feet 7 Inches</option>
                                                <option  value="4 Feet 8 Inches">4 Feet 8 Inches</option>
                                                <option  value="4 Feet 9 Inches">4 Feet 9 Inches</option>
                                                <option  value="4 Feet 10 Inches">4 Feet 10 Inches</option>
                                                <option  value="4 Feet 11 Inches">4 Feet 11 Inches</option>
                                                <option  value="5 Feet 0 Inches">5 Feet 0 Inches</option>
                                                <option  value="5 Feet 1 Inches">5 Feet 1 Inches</option>
                                                <option  value="5 Feet 2 Inches">5 Feet 2 Inches</option>
                                                <option  value="5 Feet 3 Inches">5 Feet 3 Inches</option>
                                                <option  value="5 Feet 4 Inches">5 Feet 4 Inches</option>
                                                <option  value="5 Feet 5 Inches">5 Feet 5 Inches</option>
                                                <option  value="5 Feet 6 Inches">5 Feet 6 Inches</option>
                                                <option  value="5 Feet 7 Inches">5 Feet 7 Inches</option>
                                                <option  value="5 Feet 8 Inches">5 Feet 8 Inches</option>
                                                <option  value="5 Feet 9 Inches">5 Feet 9 Inches</option>
                                                <option  value="5 Feet 10 Inches">5 Feet 10 Inches</option>
                                                <option  value="5 Feet 11 Inches">5 Feet 11 Inches</option>
                                                <option  value="6 Feet 0 Inches">6 Feet 0 Inches</option>
                                                <option  value="6 Feet 1 Inches">6 Feet 1 Inches</option>
                                                <option  value="6 Feet 2 Inches">6 Feet 2 Inches</option>
                                                <option  value="6 Feet 3 Inches">6 Feet 3 Inches</option>
                                                <option  value="6 Feet 4 Inches">6 Feet 4 Inches</option>
                                                <option  value="6 Feet 5 Inches">6 Feet 5 Inches</option>
                                                <option  value="6 Feet 6 Inches">6 Feet 6 Inches</option>
                                                <option  value="6 Feet 7 Inches">6 Feet 7 Inches</option>
                                                <option  value="6 Feet 8 Inches">6 Feet 8 Inches</option>
                                                <option  value="6 Feet 9 Inches">6 Feet 9 Inches</option>
                                                <option  value="6 Feet 10 Inches">6 Feet 10 Inches</option>
                                                <option  value="6 Feet 11 Inches">6 Feet 11 Inches</option>
                                                <option  value="7 Feet 0 Inches">7 Feet 0 Inches</option>
                                                <option  value="7 Feet 1 Inches">7 Feet 1 Inches</option>
                                                <option  value="7 Feet 2 Inches">7 Feet 2 Inches</option>
                                                <option  value="7 Feet 3 Inches">7 Feet 3 Inches</option>
                                                <option  value="7 Feet 4 Inches">7 Feet 4 Inches</option>
                                                <option  value="7 Feet 5 Inches">7 Feet 5 Inches</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <select class="chosen-select" name="heightto">
                                                <option value="">To</option>
                                                <option  value="5 Feet 0 Inches">5 Feet 0 Inches</option>
                                                <option  value="5 Feet 1 Inches">5 Feet 1 Inches</option>
                                                <option  value="5 Feet 2 Inches">5 Feet 2 Inches</option>
                                                <option  value="5 Feet 3 Inches">5 Feet 3 Inches</option>
                                                <option  value="5 Feet 4 Inches">5 Feet 4 Inches</option>
                                                <option  value="5 Feet 5 Inches">5 Feet 5 Inches</option>
                                                <option  value="5 Feet 6 Inches">5 Feet 6 Inches</option>
                                                <option  value="5 Feet 7 Inches">5 Feet 7 Inches</option>
                                                <option  value="5 Feet 8 Inches">5 Feet 8 Inches</option>
                                                <option  value="5 Feet 9 Inches">5 Feet 9 Inches</option>
                                                <option  value="5 Feet 10 Inches">5 Feet 10 Inches</option>
                                                <option  value="5 Feet 11 Inches">5 Feet 11 Inches</option>
                                                <option  value="6 Feet 0 Inches">6 Feet 0 Inches</option>
                                                <option  value="6 Feet 1 Inches">6 Feet 1 Inches</option>
                                                <option  value="6 Feet 2 Inches">6 Feet 2 Inches</option>
                                                <option  value="6 Feet 3 Inches">6 Feet 3 Inches</option>
                                                <option  value="6 Feet 4 Inches">6 Feet 4 Inches</option>
                                                <option  value="6 Feet 5 Inches">6 Feet 5 Inches</option>
                                                <option  value="6 Feet 6 Inches">6 Feet 6 Inches</option>
                                                <option  value="6 Feet 7 Inches">6 Feet 7 Inches</option>
                                                <option  value="6 Feet 8 Inches">6 Feet 8 Inches</option>
                                                <option  value="6 Feet 9 Inches">6 Feet 9 Inches</option>
                                                <option  value="6 Feet 10 Inches">6 Feet 10 Inches</option>
                                                <option  value="6 Feet 11 Inches">6 Feet 11 Inches</option>
                                                <option  value="7 Feet 0 Inches">7 Feet 0 Inches</option>
                                                <option  value="7 Feet 1 Inches">7 Feet 1 Inches</option>
                                                <option  value="7 Feet 2 Inches">7 Feet 2 Inches</option>
                                                <option  value="7 Feet 3 Inches">7 Feet 3 Inches</option>
                                                <option  value="7 Feet 4 Inches">7 Feet 4 Inches</option>
                                                <option  value="7 Feet 5 Inches">7 Feet 5 Inches</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END -->
                            <!-- START -->
                            <div class="filt-com lhs-cate">
                                <h4><i><span class="material-symbols-outlined">diversity_4</span></i>Marital Status</h4>
                                <div class="form-group">
                                    <select class="chosen-select" name="maritalstatus">
                                        <option value="">Select</option>
                                        <option  value="Never Married">Never Married</option>
                                        <option  value="Divorced">Divorced</option>
                                        <option  value="Widowed">Widowed</option>
                                        <option  value="Awaiting Divorce">Awaiting Divorce</option>
                                    </select>
                                </div>
                            </div>
                            <!-- END -->
                            <!-- START -->
                            <div class="filt-com lhs-cate">
                                <h4><i><span class="material-symbols-outlined">temple_hindu</span></i>Religion</h4>
                                <div class="form-group">
                                    <select class="chosen-select" name="religion">
                                        <option value="">Select</option>
                                        <option  value="Hindu">Hindu</option>
                                        <option  value="Muslim">Muslim</option>
                                        <option  value="Christain">Christain</option>
                                        <option  value="Sikh">Sikh</option>
                                        <option  value="Parsi">Parsi</option>
                                        <option  value="Jain">Jain</option>
                                        <option  value="Buddhist">Buddhist</option>
                                        <option  value="Jewish">Jewish</option>
                                        <option  value="Other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <!-- END -->
                            <!-- START -->
                            <div class="filt-com lhs-cate">
                                <h4><i><span class="material-symbols-outlined">reduce_capacity</span></i>Caste</h4>
                                <div class="form-group">
                                                                        <select class="form-select chosen-select" name="caste[]" multiple>
                                                                            <option  value="Ad Dharmi">Ad Dharmi</option>
                                                                            <option  value="Adi Andhra">Adi Andhra</option>
                                                                            <option  value="Adi Dravida">Adi Dravida</option>
                                                                            <option  value="Adi Karnataka">Adi Karnataka</option>
                                                                            <option  value="Agamudayar">Agamudayar</option>
                                                                            <option  value="Agri">Agri</option>
                                                                            <option  value="Ahir">Ahir</option>
                                                                            <option  value="Ahir - Ahir Shimpi">Ahir - Ahir Shimpi</option>
                                                                            <option  value="Ahirwar">Ahirwar</option>
                                                                            <option  value="Ahom">Ahom</option>
                                                                            <option  value="Ambalavasi">Ambalavasi</option>
                                                                            <option  value="Ambalavasi - Pisharody">Ambalavasi - Pisharody</option>
                                                                            <option  value="Ambalavasi - Poduval">Ambalavasi - Poduval</option>
                                                                            <option  value="Amma Kodava">Amma Kodava</option>
                                                                            <option  value="Arakh Arakvanshiya">Arakh Arakvanshiya</option>
                                                                            <option  value="Arekatica">Arekatica</option>
                                                                            <option  value="Arunthathiyar">Arunthathiyar</option>
                                                                            <option  value="Arya Vysya">Arya Vysya</option>
                                                                            <option  value="Ayyaraka">Ayyaraka</option>
                                                                            <option  value="Badaga">Badaga</option>
                                                                            <option  value="Badhai">Badhai</option>
                                                                            <option  value="Bagdi">Bagdi</option>
                                                                            <option  value="Baghel Gaderiya">Baghel Gaderiya</option>
                                                                            <option  value="Bahi">Bahi</option>
                                                                            <option  value="Baidya">Baidya</option>
                                                                            <option  value="Bairwa">Bairwa</option>
                                                                            <option  value="Baishnab">Baishnab</option>
                                                                            <option  value="Baishya">Baishya</option>
                                                                            <option  value="Baishya - Saha">Baishya - Saha</option>
                                                                            <option  value="Baishya Kapali">Baishya Kapali</option>
                                                                            <option  value="Bajantri">Bajantri</option>
                                                                            <option  value="Balai">Balai</option>
                                                                            <option  value="Balija">Balija</option>
                                                                            <option  value="Balija - Balija Naidu">Balija - Balija Naidu</option>
                                                                            <option  value="Balija - Balija Reddy">Balija - Balija Reddy</option>
                                                                            <option  value="Balija - Ediga/Goud (Balija)">Balija - Ediga/Goud (Balija)</option>
                                                                            <option  value="Balija - Gajula/Kavarai">Balija - Gajula/Kavarai</option>
                                                                            <option  value="Balija - Kapu">Balija - Kapu</option>
                                                                            <option  value="Balija - Kavara">Balija - Kavara</option>
                                                                            <option  value="Balija - Linga Balija">Balija - Linga Balija</option>
                                                                            <option  value="Balija - Modikarlu">Balija - Modikarlu</option>
                                                                            <option  value="Balija - Munnuru Kapu">Balija - Munnuru Kapu</option>
                                                                            <option  value="Balija - Musukama">Balija - Musukama</option>
                                                                            <option  value="Balija - Namdarlu">Balija - Namdarlu</option>
                                                                            <option  value="Balija - Pagadala">Balija - Pagadala</option>
                                                                            <option  value="Balija - Perika">Balija - Perika</option>
                                                                            <option  value="Balija - Setti Balija">Balija - Setti Balija</option>
                                                                            <option  value="Balija - Surya Balija">Balija - Surya Balija</option>
                                                                            <option  value="Balija - Telaga">Balija - Telaga</option>
                                                                            <option  value="Balija - Thota">Balija - Thota</option>
                                                                            <option  value="Balija - Vada Balija">Balija - Vada Balija</option>
                                                                            <option  value="Balija - Velama">Balija - Velama</option>
                                                                            <option  value="Balija - Waada Balija">Balija - Waada Balija</option>
                                                                            <option  value="Balija Naidu">Balija Naidu</option>
                                                                            <option  value="Balija Naidu - Balija Naidu">Balija Naidu - Balija Naidu</option>
                                                                            <option  value="Balija Naidu - Balija Reddy">Balija Naidu - Balija Reddy</option>
                                                                            <option  value="Balija Naidu - Setti Balija">Balija Naidu - Setti Balija</option>
                                                                            <option  value="Balija Naidu - Surya Balija">Balija Naidu - Surya Balija</option>
                                                                            <option  value="Balija Naidu - Vada Balija">Balija Naidu - Vada Balija</option>
                                                                            <option  value="Balija Naidu - Waada Balija">Balija Naidu - Waada Balija</option>
                                                                            <option  value="Banayat Oriya">Banayat Oriya</option>
                                                                            <option  value="Bania">Bania</option>
                                                                            <option  value="Bania - Agarwal">Bania - Agarwal</option>
                                                                            <option  value="Bania - Agrahari">Bania - Agrahari</option>
                                                                            <option  value="Bania - Asathi">Bania - Asathi</option>
                                                                            <option  value="Bania - Ayodhyavasi">Bania - Ayodhyavasi</option>
                                                                            <option  value="Bania - Baniya Kumuti">Bania - Baniya Kumuti</option>
                                                                            <option  value="Bania - Barnwals">Bania - Barnwals</option>
                                                                            <option  value="Bania - Bisa Agarwal">Bania - Bisa Agarwal</option>
                                                                            <option  value="Bania - Chaturth">Bania - Chaturth</option>
                                                                            <option  value="Bania - Choudharys">Bania - Choudharys</option>
                                                                            <option  value="Bania - Dosar/Dusra">Bania - Dosar/Dusra</option>
                                                                            <option  value="Bania - Gahoi">Bania - Gahoi</option>
                                                                            <option  value="Bania - Gandha Vanika">Bania - Gandha Vanika</option>
                                                                            <option  value="Bania - Gulahre">Bania - Gulahre</option>
                                                                            <option  value="Bania - Jaiswal">Bania - Jaiswal</option>
                                                                            <option  value="Bania - Kalwar">Bania - Kalwar</option>
                                                                            <option  value="Bania - Kandu/Kanu">Bania - Kandu/Kanu</option>
                                                                            <option  value="Bania - Kanojia Kanu">Bania - Kanojia Kanu</option>
                                                                            <option  value="Bania - Kanykubj Bania">Bania - Kanykubj Bania</option>
                                                                            <option  value="Bania - Kasaundhan">Bania - Kasaundhan</option>
                                                                            <option  value="Bania - Keshris/Kesarwani">Bania - Keshris/Kesarwani</option>
                                                                            <option  value="Bania - Khandelwal">Bania - Khandelwal</option>
                                                                            <option  value="Bania - Komti Arya Vaishya">Bania - Komti Arya Vaishya</option>
                                                                            <option  value="Bania - Lad">Bania - Lad</option>
                                                                            <option  value="Bania - Madhesiya/Kawa/Halwai">Bania - Madhesiya/Kawa/Halwai</option>
                                                                            <option  value="Bania - Mahajan">Bania - Mahajan</option>
                                                                            <option  value="Bania - Maheshwari/Meshri">Bania - Maheshwari/Meshri</option>
                                                                            <option  value="Bania - Mahor">Bania - Mahor</option>
                                                                            <option  value="Bania - Mahuri">Bania - Mahuri</option>
                                                                            <option  value="Bania - Marwari">Bania - Marwari</option>
                                                                            <option  value="Bania - Modh Ghanchi">Bania - Modh Ghanchi</option>
                                                                            <option  value="Bania - Modi">Bania - Modi</option>
                                                                            <option  value="Bania - Nema">Bania - Nema</option>
                                                                            <option  value="Bania - Oswal">Bania - Oswal</option>
                                                                            <option  value="Bania - Padmavati Porwal">Bania - Padmavati Porwal</option>
                                                                            <option  value="Bania - Patwa">Bania - Patwa</option>
                                                                            <option  value="Bania - Porwal/Porwar">Bania - Porwal/Porwar</option>
                                                                            <option  value="Bania - Rastogi">Bania - Rastogi</option>
                                                                            <option  value="Bania - Rathi">Bania - Rathi</option>
                                                                            <option  value="Bania - Rauniars">Bania - Rauniars</option>
                                                                            <option  value="Bania - Rauniyar">Bania - Rauniyar</option>
                                                                            <option  value="Bania - Shaw/Sahu/Teli">Bania - Shaw/Sahu/Teli</option>
                                                                            <option  value="Bania - Sinduriya">Bania - Sinduriya</option>
                                                                            <option  value="Bania - Sudi/Suri/Sundhi/Shaundik">Bania - Sudi/Suri/Sundhi/Shaundik</option>
                                                                            <option  value="Bania - Ummar/Umre/Bagaria">Bania - Ummar/Umre/Bagaria</option>
                                                                            <option  value="Bania - Vaishnav">Bania - Vaishnav</option>
                                                                            <option  value="Bania - Vani/Vaishya">Bania - Vani/Vaishya</option>
                                                                            <option  value="Bania - Varshneys">Bania - Varshneys</option>
                                                                            <option  value="Bania - Vijayvargia">Bania - Vijayvargia</option>
                                                                            <option  value="Banik">Banik</option>
                                                                            <option  value="Banjara">Banjara</option>
                                                                            <option  value="Banjara - Lambani">Banjara - Lambani</option>
                                                                            <option  value="Barai">Barai</option>
                                                                            <option  value="Bari">Bari</option>
                                                                            <option  value="Beldar">Beldar</option>
                                                                            <option  value="Besta">Besta</option>
                                                                            <option  value="Bhajantri">Bhajantri</option>
                                                                            <option  value="Bhatia">Bhatia</option>
                                                                            <option  value="Bhatraju">Bhatraju</option>
                                                                            <option  value="Bhavsar">Bhavsar</option>
                                                                            <option  value="Bhil">Bhil</option>
                                                                            <option  value="Bhovi/Bhoi">Bhovi/Bhoi</option>
                                                                            <option  value="Bhoyar">Bhoyar</option>
                                                                            <option  value="Bhulia/Meher">Bhulia/Meher</option>
                                                                            <option  value="Billava">Billava</option>
                                                                            <option  value="Bishnoi/Vishnoi">Bishnoi/Vishnoi</option>
                                                                            <option  value="Bondili">Bondili</option>
                                                                            <option  value="Boyer">Boyer</option>
                                                                            <option  value="Brahmakshatriya">Brahmakshatriya</option>
                                                                            <option  value="Brahmbatt">Brahmbatt</option>
                                                                            <option  value="Brahmin">Brahmin</option>
                                                                            <option  value="Brahmin - Niyogi">Brahmin - Niyogi</option>
                                                                            <option  value="Brahmin - Anavil">Brahmin - Anavil</option>
                                                                            <option  value="Brahmin - Andhra">Brahmin - Andhra</option>
                                                                            <option  value="Brahmin - Audichya">Brahmin - Audichya</option>
                                                                            <option  value="Brahmin - Audichyasahastra">Brahmin - Audichyasahastra</option>
                                                                            <option  value="Brahmin - Bajkhedwal">Brahmin - Bajkhedwal</option>
                                                                            <option  value="Brahmin - Bardai">Brahmin - Bardai</option>
                                                                            <option  value="Brahmin - Barendra">Brahmin - Barendra</option>
                                                                            <option  value="Brahmin - Bengali">Brahmin - Bengali</option>
                                                                            <option  value="Brahmin - Bhargava">Brahmin - Bhargava</option>
                                                                            <option  value="Brahmin - Bhatt">Brahmin - Bhatt</option>
                                                                            <option  value="Brahmin - Bhumihar">Brahmin - Bhumihar</option>
                                                                            <option  value="Brahmin - Brahacharanam">Brahmin - Brahacharanam</option>
                                                                            <option  value="Brahmin - BrahmBhatt">Brahmin - BrahmBhatt</option>
                                                                            <option  value="Brahmin - Brajastha Maithil">Brahmin - Brajastha Maithil</option>
                                                                            <option  value="Brahmin - Chittpavan Kokanastha">Brahmin - Chittpavan Kokanastha</option>
                                                                            <option  value="Brahmin - Dadhich">Brahmin - Dadhich</option>
                                                                            <option  value="Brahmin - Daivadnya">Brahmin - Daivadnya</option>
                                                                            <option  value="Brahmin - Danua">Brahmin - Danua</option>
                                                                            <option  value="Brahmin - Deshastha">Brahmin - Deshastha</option>
                                                                            <option  value="Brahmin - Devrukhe">Brahmin - Devrukhe</option>
                                                                            <option  value="Brahmin - Dhiman">Brahmin - Dhiman</option>
                                                                            <option  value="Brahmin - Dravida">Brahmin - Dravida</option>
                                                                            <option  value="Brahmin - Dunua">Brahmin - Dunua</option>
                                                                            <option  value="Brahmin - Embrandiri">Brahmin - Embrandiri</option>
                                                                            <option  value="Brahmin - Garhwali">Brahmin - Garhwali</option>
                                                                            <option  value="Brahmin - Gaud Saraswat">Brahmin - Gaud Saraswat</option>
                                                                            <option  value="Brahmin - Gaur">Brahmin - Gaur</option>
                                                                            <option  value="Brahmin - Gautam">Brahmin - Gautam</option>
                                                                            <option  value="Brahmin - Goswami">Brahmin - Goswami</option>
                                                                            <option  value="Brahmin - Gujar Gaur">Brahmin - Gujar Gaur</option>
                                                                            <option  value="Brahmin - Gujrati">Brahmin - Gujrati</option>
                                                                            <option  value="Brahmin - Gurukkal">Brahmin - Gurukkal</option>
                                                                            <option  value="Brahmin - Halua">Brahmin - Halua</option>
                                                                            <option  value="Brahmin - Havyaka">Brahmin - Havyaka</option>
                                                                            <option  value="Brahmin - Hoysala">Brahmin - Hoysala</option>
                                                                            <option  value="Brahmin - Iyengar">Brahmin - Iyengar</option>
                                                                            <option  value="Brahmin - Iyer">Brahmin - Iyer</option>
                                                                            <option  value="Brahmin - Jangid">Brahmin - Jangid</option>
                                                                            <option  value="Brahmin - Jangra">Brahmin - Jangra</option>
                                                                            <option  value="Brahmin - Jhadua">Brahmin - Jhadua</option>
                                                                            <option  value="Brahmin - Jhijhotiya">Brahmin - Jhijhotiya</option>
                                                                            <option  value="Brahmin - Jogi">Brahmin - Jogi</option>
                                                                            <option  value="Brahmin - Kannada">Brahmin - Kannada</option>
                                                                            <option  value="Brahmin - Kanyakubj">Brahmin - Kanyakubj</option>
                                                                            <option  value="Brahmin - Karhade">Brahmin - Karhade</option>
                                                                            <option  value="Brahmin - Karnataka">Brahmin - Karnataka</option>
                                                                            <option  value="Brahmin - Kashmiri Pandit">Brahmin - Kashmiri Pandit</option>
                                                                            <option  value="Brahmin - Khadayat">Brahmin - Khadayat</option>
                                                                            <option  value="Brahmin - Khandelwal">Brahmin - Khandelwal</option>
                                                                            <option  value="Brahmin - Khedaval">Brahmin - Khedaval</option>
                                                                            <option  value="Brahmin - Koknastha">Brahmin - Koknastha</option>
                                                                            <option  value="Brahmin - Kota">Brahmin - Kota</option>
                                                                            <option  value="Brahmin - Kulin">Brahmin - Kulin</option>
                                                                            <option  value="Brahmin - Kumaoni">Brahmin - Kumaoni</option>
                                                                            <option  value="Brahmin - Madhwa">Brahmin - Madhwa</option>
                                                                            <option  value="Brahmin - Maharastra">Brahmin - Maharastra</option>
                                                                            <option  value="Brahmin - Maithil">Brahmin - Maithil</option>
                                                                            <option  value="Brahmin - Malviya">Brahmin - Malviya</option>
                                                                            <option  value="Brahmin - Marwari">Brahmin - Marwari</option>
                                                                            <option  value="Brahmin - Mevada">Brahmin - Mevada</option>
                                                                            <option  value="Brahmin - Modh">Brahmin - Modh</option>
                                                                            <option  value="Brahmin - Mohapatra Mahapatra">Brahmin - Mohapatra Mahapatra</option>
                                                                            <option  value="Brahmin - Mohyal">Brahmin - Mohyal</option>
                                                                            <option  value="Brahmin - Nagar">Brahmin - Nagar</option>
                                                                            <option  value="Brahmin - Namboodiri">Brahmin - Namboodiri</option>
                                                                            <option  value="Brahmin - Nai">Brahmin - Nai</option>
                                                                            <option  value="Brahmin - Paliwal">Brahmin - Paliwal</option>
                                                                            <option  value="Brahmin - Panda">Brahmin - Panda</option>
                                                                            <option  value="Brahmin - Pandit">Brahmin - Pandit</option>
                                                                            <option  value="Brahmin - Panicker">Brahmin - Panicker</option>
                                                                            <option  value="Brahmin - Pareek">Brahmin - Pareek</option>
                                                                            <option  value="Brahmin - Pushkarna">Brahmin - Pushkarna</option>
                                                                            <option  value="Brahmin - Rajapuri Saraswat">Brahmin - Rajapuri Saraswat</option>
                                                                            <option  value="Brahmin - Rajasthani">Brahmin - Rajasthani</option>
                                                                            <option  value="Brahmin - Rajgor">Brahmin - Rajgor</option>
                                                                            <option  value="Brahmin - Rarhi">Brahmin - Rarhi</option>
                                                                            <option  value="Brahmin - Rigvedi">Brahmin - Rigvedi</option>
                                                                            <option  value="Brahmin - Rudraj">Brahmin - Rudraj</option>
                                                                            <option  value="Brahmin - Sachora">Brahmin - Sachora</option>
                                                                            <option  value="Brahmin - Sakaldwipi">Brahmin - Sakaldwipi</option>
                                                                            <option  value="Brahmin - Sanadya">Brahmin - Sanadya</option>
                                                                            <option  value="Brahmin - Sanchihar">Brahmin - Sanchihar</option>
                                                                            <option  value="Brahmin - Sanketi">Brahmin - Sanketi</option>
                                                                            <option  value="Brahmin - Saraswat">Brahmin - Saraswat</option>
                                                                            <option  value="Brahmin - Sarotri">Brahmin - Sarotri</option>
                                                                            <option  value="Brahmin - Sarua">Brahmin - Sarua</option>
                                                                            <option  value="Brahmin - Saryuparin">Brahmin - Saryuparin</option>
                                                                            <option  value="Brahmin - Shivalli">Brahmin - Shivalli</option>
                                                                            <option  value="Brahmin - Shrimali">Brahmin - Shrimali</option>
                                                                            <option  value="Brahmin - Sikhwal">Brahmin - Sikhwal</option>
                                                                            <option  value="Brahmin - Smartha">Brahmin - Smartha</option>
                                                                            <option  value="Brahmin - Sri Vishnava">Brahmin - Sri Vishnava</option>
                                                                            <option  value="Brahmin - Stanika">Brahmin - Stanika</option>
                                                                            <option  value="Brahmin - Tapodhan">Brahmin - Tapodhan</option>
                                                                            <option  value="Brahmin - Tyagi">Brahmin - Tyagi</option>
                                                                            <option  value="Brahmin - Utkal">Brahmin - Utkal</option>
                                                                            <option  value="Brahmin - Vaidiki">Brahmin - Vaidiki</option>
                                                                            <option  value="Brahmin - Vaikhanasa">Brahmin - Vaikhanasa</option>
                                                                            <option  value="Brahmin - Vaikhawas">Brahmin - Vaikhawas</option>
                                                                            <option  value="Brahmin - Vaishnav">Brahmin - Vaishnav</option>
                                                                            <option  value="Brahmin - Valam">Brahmin - Valam</option>
                                                                            <option  value="Brahmin - Velanadu">Brahmin - Velanadu</option>
                                                                            <option  value="Brahmin - Viswa">Brahmin - Viswa</option>
                                                                            <option  value="Brahmin - Vyas">Brahmin - Vyas</option>
                                                                            <option  value="Brahmin - Yajurvedi">Brahmin - Yajurvedi</option>
                                                                            <option  value="Brahmin - Zalora">Brahmin - Zalora</option>
                                                                            <option  value="Brahmo">Brahmo</option>
                                                                            <option  value="Buddar">Buddar</option>
                                                                            <option  value="Bunt Shetty">Bunt Shetty</option>
                                                                            <option  value="Chalawadi/Holeya">Chalawadi/Holeya</option>
                                                                            <option  value="Chamar">Chamar</option>
                                                                            <option  value="Chambhar">Chambhar</option>
                                                                            <option  value="Chandravanshi Kahar">Chandravanshi Kahar</option>
                                                                            <option  value="Charan">Charan</option>
                                                                            <option  value="Chasa">Chasa</option>
                                                                            <option  value="Chattada Sri Vaishnava">Chattada Sri Vaishnava</option>
                                                                            <option  value="Chaudary">Chaudary</option>
                                                                            <option  value="Chaudary - Ghrit">Chaudary - Ghrit</option>
                                                                            <option  value="Chaurasia">Chaurasia</option>
                                                                            <option  value="Chennadasar">Chennadasar</option>
                                                                            <option  value="Cheramar">Cheramar</option>
                                                                            <option  value="Chettiar">Chettiar</option>
                                                                            <option  value="Chettiar - 24 Manai Telugu Chettiar">Chettiar - 24 Manai Telugu Chettiar</option>
                                                                            <option  value="Chettiar - 24 Manai Telugu Chettiar 16 Veedu">Chettiar - 24 Manai Telugu Chettiar 16 Veedu</option>
                                                                            <option  value="Chettiar - 24 Manai Telugu Chettiar 8 Veedu">Chettiar - 24 Manai Telugu Chettiar 8 Veedu</option>
                                                                            <option  value="Chettiar - Achirapakkam Chettiar">Chettiar - Achirapakkam Chettiar</option>
                                                                            <option  value="Chettiar - Agaram Vellan Chettiar">Chettiar - Agaram Vellan Chettiar</option>
                                                                            <option  value="Chettiar - Arya Vysya">Chettiar - Arya Vysya</option>
                                                                            <option  value="Chettiar - Ayira Vysya">Chettiar - Ayira Vysya</option>
                                                                            <option  value="Chettiar - Beri Chettiar">Chettiar - Beri Chettiar</option>
                                                                            <option  value="Chettiar - Devanga Chettiar">Chettiar - Devanga Chettiar</option>
                                                                            <option  value="Chettiar - Elur Cheety">Chettiar - Elur Cheety</option>
                                                                            <option  value="Chettiar - Gandla/Ganiga">Chettiar - Gandla/Ganiga</option>
                                                                            <option  value="Chettiar - Kasukara">Chettiar - Kasukara</option>
                                                                            <option  value="Chettiar - Kongu Chettiar">Chettiar - Kongu Chettiar</option>
                                                                            <option  value="Chettiar - Kuruhini Chetty">Chettiar - Kuruhini Chetty</option>
                                                                            <option  value="Chettiar - Manjapudur Chettiar">Chettiar - Manjapudur Chettiar</option>
                                                                            <option  value="Chettiar - Nattukottai Chettiar">Chettiar - Nattukottai Chettiar</option>
                                                                            <option  value="Chettiar - Padma Saliar">Chettiar - Padma Saliar</option>
                                                                            <option  value="Chettiar - Pannirandam Chettiar">Chettiar - Pannirandam Chettiar</option>
                                                                            <option  value="Chettiar - Parvatha Rajakulam">Chettiar - Parvatha Rajakulam</option>
                                                                            <option  value="Chettiar - Pattinavar">Chettiar - Pattinavar</option>
                                                                            <option  value="Chettiar - Pattusali">Chettiar - Pattusali</option>
                                                                            <option  value="Chettiar - Sadhu Chetty">Chettiar - Sadhu Chetty</option>
                                                                            <option  value="Chettiar - Saiva Vellan Chettiar">Chettiar - Saiva Vellan Chettiar</option>
                                                                            <option  value="Chettiar - Senai Thalaivar">Chettiar - Senai Thalaivar</option>
                                                                            <option  value="Chettiar - Sozhia Chettiar">Chettiar - Sozhia Chettiar</option>
                                                                            <option  value="Chettiar - Telugupatti">Chettiar - Telugupatti</option>
                                                                            <option  value="Chettiar - Vadambar">Chettiar - Vadambar</option>
                                                                            <option  value="Chettiar - Vaniya Chettiar">Chettiar - Vaniya Chettiar</option>
                                                                            <option  value="Chettiar - Vellan Chettiar">Chettiar - Vellan Chettiar</option>
                                                                            <option  value="Chhetri">Chhetri</option>
                                                                            <option  value="Chippolu Mera">Chippolu Mera</option>
                                                                            <option  value="Coorgi">Coorgi</option>
                                                                            <option  value="Coorgi - Kodava">Coorgi - Kodava</option>
                                                                            <option  value="Dasapalanjika Kannada Saineegar">Dasapalanjika Kannada Saineegar</option>
                                                                            <option  value="Devadigas">Devadigas</option>
                                                                            <option  value="Devang Koshthi">Devang Koshthi</option>
                                                                            <option  value="Devang Koshthi - Devanga">Devang Koshthi - Devanga</option>
                                                                            <option  value="Devang Koshthi - Devanga Chettiar">Devang Koshthi - Devanga Chettiar</option>
                                                                            <option  value="Devanga">Devanga</option>
                                                                            <option  value="Devendra Kula Vellalar">Devendra Kula Vellalar</option>
                                                                            <option  value="Devipujak (Vaghri)">Devipujak (Vaghri)</option>
                                                                            <option  value="Dewar/Dhibara">Dewar/Dhibara</option>
                                                                            <option  value="Dhanak">Dhanak</option>
                                                                            <option  value="Dhangar">Dhangar</option>
                                                                            <option  value="Dhanuk">Dhanuk</option>
                                                                            <option  value="Dheevara">Dheevara</option>
                                                                            <option  value="Dhiman">Dhiman</option>
                                                                            <option  value="Dhoba">Dhoba</option>
                                                                            <option  value="Dhobi">Dhobi</option>
                                                                            <option  value="Dhobi - Kanaujia">Dhobi - Kanaujia</option>
                                                                            <option  value="Dhor/Dhoar">Dhor/Dhoar</option>
                                                                            <option  value="Dommala">Dommala</option>
                                                                            <option  value="Dumal">Dumal</option>
                                                                            <option  value="Dusadh">Dusadh</option>
                                                                            <option  value="Edigas">Edigas</option>
                                                                            <option  value="Ezhava">Ezhava</option>
                                                                            <option  value="Ezhava - Ezhava Panicker">Ezhava - Ezhava Panicker</option>
                                                                            <option  value="Ezhava - Ezhava Thandan">Ezhava - Ezhava Thandan</option>
                                                                            <option  value="Ezhava - Kavuthiya">Ezhava - Kavuthiya</option>
                                                                            <option  value="Ezhava - Thiyya">Ezhava - Thiyya</option>
                                                                            <option  value="Ezhuthachan">Ezhuthachan</option>
                                                                            <option  value="Gabit">Gabit</option>
                                                                            <option  value="Ganda">Ganda</option>
                                                                            <option  value="Gangai/Ganesh">Gangai/Ganesh</option>
                                                                            <option  value="Ganiga">Ganiga</option>
                                                                            <option  value="Ganiga - Shiva Jyothipana">Ganiga - Shiva Jyothipana</option>
                                                                            <option  value="Garhwali">Garhwali</option>
                                                                            <option  value="Gatti">Gatti</option>
                                                                            <option  value="Gavali">Gavali</option>
                                                                            <option  value="Gavandi">Gavandi</option>
                                                                            <option  value="Gavara">Gavara</option>
                                                                            <option  value="Ghasi">Ghasi</option>
                                                                            <option  value="Ghisadi">Ghisadi</option>
                                                                            <option  value="Ghumar">Ghumar</option>
                                                                            <option  value="Goala">Goala</option>
                                                                            <option  value="Goan">Goan</option>
                                                                            <option  value="Gond Gondi Raj Gond">Gond Gondi Raj Gond</option>
                                                                            <option  value="Gondhali">Gondhali</option>
                                                                            <option  value="Gopal">Gopal</option>
                                                                            <option  value="Goud">Goud</option>
                                                                            <option  value="Gounder">Gounder</option>
                                                                            <option  value="Gounder - Kongu Vellala Gounder">Gounder - Kongu Vellala Gounder</option>
                                                                            <option  value="Gounder - Nattu Gounder">Gounder - Nattu Gounder</option>
                                                                            <option  value="Gounder - Urali Gounder">Gounder - Urali Gounder</option>
                                                                            <option  value="Gounder - Vanniya Kula Kshatriyar">Gounder - Vanniya Kula Kshatriyar</option>
                                                                            <option  value="Gounder - Vettuva Gounder">Gounder - Vettuva Gounder</option>
                                                                            <option  value="Gowda">Gowda</option>
                                                                            <option  value="Gowda - Arebashe">Gowda - Arebashe</option>
                                                                            <option  value="Gowda - Bunt">Gowda - Bunt</option>
                                                                            <option  value="Gowda - Das">Gowda - Das</option>
                                                                            <option  value="Gowda - Gangadikar">Gowda - Gangadikar</option>
                                                                            <option  value="Gowda - Gowda-Kuruba Gowda">Gowda - Gowda-Kuruba Gowda</option>
                                                                            <option  value="Gowda - Hallikar">Gowda - Hallikar</option>
                                                                            <option  value="Gowda - Hosadevaru">Gowda - Hosadevaru</option>
                                                                            <option  value="Gowda - Kunchitaga">Gowda - Kunchitaga</option>
                                                                            <option  value="Gowda - Morasu">Gowda - Morasu</option>
                                                                            <option  value="Gowda - Musuku">Gowda - Musuku</option>
                                                                            <option  value="Gowda - Namadari">Gowda - Namadari</option>
                                                                            <option  value="Gowda - Okkaliga">Gowda - Okkaliga</option>
                                                                            <option  value="Gowda - Reddy">Gowda - Reddy</option>
                                                                            <option  value="Gowda - Sarpa">Gowda - Sarpa</option>
                                                                            <option  value="Gowda - Uttamakula">Gowda - Uttamakula</option>
                                                                            <option  value="Gramani">Gramani</option>
                                                                            <option  value="Gudia">Gudia</option>
                                                                            <option  value="Gujjar">Gujjar</option>
                                                                            <option  value="Gujjar - Dode">Gujjar - Dode</option>
                                                                            <option  value="Gujjar - Leva">Gujjar - Leva</option>
                                                                            <option  value="Gupta">Gupta</option>
                                                                            <option  value="Gurav">Gurav</option>
                                                                            <option  value="Halba Koshti">Halba Koshti</option>
                                                                            <option  value="Hegde">Hegde</option>
                                                                            <option  value="Helava">Helava</option>
                                                                            <option  value="Holar">Holar</option>
                                                                            <option  value="Jaalari">Jaalari</option>
                                                                            <option  value="Jaiswal">Jaiswal</option>
                                                                            <option  value="Jandra">Jandra</option>
                                                                            <option  value="Jangam">Jangam</option>
                                                                            <option  value="Jat">Jat</option>
                                                                            <option  value="Jat - Agharia">Jat - Agharia</option>
                                                                            <option  value="Jat - Agoh">Jat - Agoh</option>
                                                                            <option  value="Jat - Agra">Jat - Agra</option>
                                                                            <option  value="Jat - Ahlawat">Jat - Ahlawat</option>
                                                                            <option  value="Jat - Alwal">Jat - Alwal</option>
                                                                            <option  value="Jat - Antil/Antal">Jat - Antil/Antal</option>
                                                                            <option  value="Jat - Arya">Jat - Arya</option>
                                                                            <option  value="Jat - Badhwar">Jat - Badhwar</option>
                                                                            <option  value="Jat - Bagaria">Jat - Bagaria</option>
                                                                            <option  value="Jat - Bagri">Jat - Bagri</option>
                                                                            <option  value="Jat - Bains">Jat - Bains</option>
                                                                            <option  value="Jat - Balhara">Jat - Balhara</option>
                                                                            <option  value="Jat - Balyan">Jat - Balyan</option>
                                                                            <option  value="Jat - Bana">Jat - Bana</option>
                                                                            <option  value="Jat - Barach">Jat - Barach</option>
                                                                            <option  value="Jat - Bargoti">Jat - Bargoti</option>
                                                                            <option  value="Jat - Beniwal">Jat - Beniwal</option>
                                                                            <option  value="Jat - Bhal">Jat - Bhal</option>
                                                                            <option  value="Jat - Bhambu">Jat - Bhambu</option>
                                                                            <option  value="Jat - Bhodu">Jat - Bhodu</option>
                                                                            <option  value="Jat - Bomal">Jat - Bomal</option>
                                                                            <option  value="Jat - Budania">Jat - Budania</option>
                                                                            <option  value="Jat - Bugaliya">Jat - Bugaliya</option>
                                                                            <option  value="Jat - Burdak">Jat - Burdak</option>
                                                                            <option  value="Jat - Chahal">Jat - Chahal</option>
                                                                            <option  value="Jat - Chaudhry">Jat - Chaudhry</option>
                                                                            <option  value="Jat - Chauhan">Jat - Chauhan</option>
                                                                            <option  value="Jat - Chhikara/Chikara">Jat - Chhikara/Chikara</option>
                                                                            <option  value="Jat - Chillar">Jat - Chillar</option>
                                                                            <option  value="Jat - Dabas">Jat - Dabas</option>
                                                                            <option  value="Jat - Dagar">Jat - Dagar</option>
                                                                            <option  value="Jat - Dagua">Jat - Dagua</option>
                                                                            <option  value="Jat - Dahiya">Jat - Dahiya</option>
                                                                            <option  value="Jat - Dalal">Jat - Dalal</option>
                                                                            <option  value="Jat - Dangi">Jat - Dangi</option>
                                                                            <option  value="Jat - Dara">Jat - Dara</option>
                                                                            <option  value="Jat - Deshwal">Jat - Deshwal</option>
                                                                            <option  value="Jat - Dhaka">Jat - Dhaka</option>
                                                                            <option  value="Jat - Dhama">Jat - Dhama</option>
                                                                            <option  value="Jat - Dhanchak">Jat - Dhanchak</option>
                                                                            <option  value="Jat - Dhanda">Jat - Dhanda</option>
                                                                            <option  value="Jat - Dhankhar">Jat - Dhankhar</option>
                                                                            <option  value="Jat - Dhillon">Jat - Dhillon</option>
                                                                            <option  value="Jat - Dhomi">Jat - Dhomi</option>
                                                                            <option  value="Jat - Dhoot">Jat - Dhoot</option>
                                                                            <option  value="Jat - Dhoriwal">Jat - Dhoriwal</option>
                                                                            <option  value="Jat - Dhull">Jat - Dhull</option>
                                                                            <option  value="Jat - Dollya">Jat - Dollya</option>
                                                                            <option  value="Jat - Dudi">Jat - Dudi</option>
                                                                            <option  value="Jat - Duhan">Jat - Duhan</option>
                                                                            <option  value="Jat - Gahlot">Jat - Gahlot</option>
                                                                            <option  value="Jat - Garhwal">Jat - Garhwal</option>
                                                                            <option  value="Jat - Gehlawat">Jat - Gehlawat</option>
                                                                            <option  value="Jat - Ghangas">Jat - Ghangas</option>
                                                                            <option  value="Jat - Gill">Jat - Gill</option>
                                                                            <option  value="Jat - Godara">Jat - Godara</option>
                                                                            <option  value="Jat - Grewal">Jat - Grewal</option>
                                                                            <option  value="Jat - Gulia">Jat - Gulia</option>
                                                                            <option  value="Jat - Heer">Jat - Heer</option>
                                                                            <option  value="Jat - Hooda">Jat - Hooda</option>
                                                                            <option  value="Jat - Jaglon">Jat - Jaglon</option>
                                                                            <option  value="Jat - Jakhar">Jat - Jakhar</option>
                                                                            <option  value="Jat - Jam">Jat - Jam</option>
                                                                            <option  value="Jat - Jaswal">Jat - Jaswal</option>
                                                                            <option  value="Jat - Jatasra">Jat - Jatasra</option>
                                                                            <option  value="Jat - Jewlia">Jat - Jewlia</option>
                                                                            <option  value="Jat - Jutrana">Jat - Jutrana</option>
                                                                            <option  value="Jat - Kadian">Jat - Kadian</option>
                                                                            <option  value="Jat - Kahlon">Jat - Kahlon</option>
                                                                            <option  value="Jat - Kajala">Jat - Kajala</option>
                                                                            <option  value="Jat - Kakran">Jat - Kakran</option>
                                                                            <option  value="Jat - Kalen">Jat - Kalen</option>
                                                                            <option  value="Jat - Kaliramna">Jat - Kaliramna</option>
                                                                            <option  value="Jat - Kalkhanse">Jat - Kalkhanse</option>
                                                                            <option  value="Jat - Karwasra">Jat - Karwasra</option>
                                                                            <option  value="Jat - Kaswan">Jat - Kaswan</option>
                                                                            <option  value="Jat - Kataria">Jat - Kataria</option>
                                                                            <option  value="Jat - Khakar">Jat - Khakar</option>
                                                                            <option  value="Jat - Khallia">Jat - Khallia</option>
                                                                            <option  value="Jat - Kharb">Jat - Kharb</option>
                                                                            <option  value="Jat - Khatkar">Jat - Khatkar</option>
                                                                            <option  value="Jat - Khatri">Jat - Khatri</option>
                                                                            <option  value="Jat - Kherwa">Jat - Kherwa</option>
                                                                            <option  value="Jat - Khichad">Jat - Khichad</option>
                                                                            <option  value="Jat - Kothari">Jat - Kothari</option>
                                                                            <option  value="Jat - Kuhar">Jat - Kuhar</option>
                                                                            <option  value="Jat - Kulhari">Jat - Kulhari</option>
                                                                            <option  value="Jat - Kundu">Jat - Kundu</option>
                                                                            <option  value="Jat - Lakhlan">Jat - Lakhlan</option>
                                                                            <option  value="Jat - Lakra">Jat - Lakra</option>
                                                                            <option  value="Jat - Lamba">Jat - Lamba</option>
                                                                            <option  value="Jat - Lamoria">Jat - Lamoria</option>
                                                                            <option  value="Jat - Lather">Jat - Lather</option>
                                                                            <option  value="Jat - Lathwal">Jat - Lathwal</option>
                                                                            <option  value="Jat - Latiyan">Jat - Latiyan</option>
                                                                            <option  value="Jat - Laur">Jat - Laur</option>
                                                                            <option  value="Jat - Lehga">Jat - Lehga</option>
                                                                            <option  value="Jat - Maan">Jat - Maan</option>
                                                                            <option  value="Jat - Mahan">Jat - Mahan</option>
                                                                            <option  value="Jat - Malhan">Jat - Malhan</option>
                                                                            <option  value="Jat - Malik">Jat - Malik</option>
                                                                            <option  value="Jat - Mandhan">Jat - Mandhan</option>
                                                                            <option  value="Jat - Mangat">Jat - Mangat</option>
                                                                            <option  value="Jat - Mann Rai">Jat - Mann Rai</option>
                                                                            <option  value="Jat - Meel">Jat - Meel</option>
                                                                            <option  value="Jat - Mehria">Jat - Mehria</option>
                                                                            <option  value="Jat - Mhla">Jat - Mhla</option>
                                                                            <option  value="Jat - Mohar">Jat - Mohar</option>
                                                                            <option  value="Jat - Moond">Jat - Moond</option>
                                                                            <option  value="Jat - Mor/More">Jat - Mor/More</option>
                                                                            <option  value="Jat - Nain">Jat - Nain</option>
                                                                            <option  value="Jat - Nairwal">Jat - Nairwal</option>
                                                                            <option  value="Jat - Nandal">Jat - Nandal</option>
                                                                            <option  value="Jat - Nara">Jat - Nara</option>
                                                                            <option  value="Jat - Natt/Nat">Jat - Natt/Nat</option>
                                                                            <option  value="Jat - Nauhr">Jat - Nauhr</option>
                                                                            <option  value="Jat - Nehra">Jat - Nehra</option>
                                                                            <option  value="Jat - Nitharwal">Jat - Nitharwal</option>
                                                                            <option  value="Jat - Ola">Jat - Ola</option>
                                                                            <option  value="Jat - Pachehra">Jat - Pachehra</option>
                                                                            <option  value="Jat - Palsania">Jat - Palsania</option>
                                                                            <option  value="Jat - Panghal">Jat - Panghal</option>
                                                                            <option  value="Jat - Panwar">Jat - Panwar</option>
                                                                            <option  value="Jat - Parihar">Jat - Parihar</option>
                                                                            <option  value="Jat - Pattor">Jat - Pattor</option>
                                                                            <option  value="Jat - Pawar">Jat - Pawar</option>
                                                                            <option  value="Jat - Phalaswal">Jat - Phalaswal</option>
                                                                            <option  value="Jat - Phogat">Jat - Phogat</option>
                                                                            <option  value="Jat - Pilania">Jat - Pilania</option>
                                                                            <option  value="Jat - Pooni">Jat - Pooni</option>
                                                                            <option  value="Jat - Punia">Jat - Punia</option>
                                                                            <option  value="Jat - Rahan">Jat - Rahan</option>
                                                                            <option  value="Jat - Rajaura">Jat - Rajaura</option>
                                                                            <option  value="Jat - Rana">Jat - Rana</option>
                                                                            <option  value="Jat - Rangi">Jat - Rangi</option>
                                                                            <option  value="Jat - Ranwa">Jat - Ranwa</option>
                                                                            <option  value="Jat - Rao">Jat - Rao</option>
                                                                            <option  value="Jat - Rathi">Jat - Rathi</option>
                                                                            <option  value="Jat - Rawal">Jat - Rawal</option>
                                                                            <option  value="Jat - Redhu">Jat - Redhu</option>
                                                                            <option  value="Jat - Repswal">Jat - Repswal</option>
                                                                            <option  value="Jat - Saharan">Jat - Saharan</option>
                                                                            <option  value="Jat - Sandhi">Jat - Sandhi</option>
                                                                            <option  value="Jat - Sangawan">Jat - Sangawan</option>
                                                                            <option  value="Jat - Sansanwal">Jat - Sansanwal</option>
                                                                            <option  value="Jat - Saran">Jat - Saran</option>
                                                                            <option  value="Jat - Saroha">Jat - Saroha</option>
                                                                            <option  value="Jat - Sarot">Jat - Sarot</option>
                                                                            <option  value="Jat - Sehrawat">Jat - Sehrawat</option>
                                                                            <option  value="Jat - Sheoran">Jat - Sheoran</option>
                                                                            <option  value="Jat - Shokeen">Jat - Shokeen</option>
                                                                            <option  value="Jat - Sidhu">Jat - Sidhu</option>
                                                                            <option  value="Jat - Sikarwar">Jat - Sikarwar</option>
                                                                            <option  value="Jat - Sindhu">Jat - Sindhu</option>
                                                                            <option  value="Jat - Singhal">Jat - Singhal</option>
                                                                            <option  value="Jat - Sinsinwar">Jat - Sinsinwar</option>
                                                                            <option  value="Jat - Sirohi">Jat - Sirohi</option>
                                                                            <option  value="Jat - Siwach">Jat - Siwach</option>
                                                                            <option  value="Jat - Solanki">Jat - Solanki</option>
                                                                            <option  value="Jat - Suhag">Jat - Suhag</option>
                                                                            <option  value="Jat - Sunda">Jat - Sunda</option>
                                                                            <option  value="Jat - Takhar">Jat - Takhar</option>
                                                                            <option  value="Jat - Tanar">Jat - Tanar</option>
                                                                            <option  value="Jat - Tanwar">Jat - Tanwar</option>
                                                                            <option  value="Jat - Tevatia">Jat - Tevatia</option>
                                                                            <option  value="Jat - Thakaran">Jat - Thakaran</option>
                                                                            <option  value="Jat - Thenua">Jat - Thenua</option>
                                                                            <option  value="Jat - Thori">Jat - Thori</option>
                                                                            <option  value="Jat - Tokas">Jat - Tokas</option>
                                                                            <option  value="Jat - Tomar">Jat - Tomar</option>
                                                                            <option  value="Jatav">Jatav</option>
                                                                            <option  value="Jetty Malla">Jetty Malla</option>
                                                                            <option  value="Jingar">Jingar</option>
                                                                            <option  value="Julaha">Julaha</option>
                                                                            <option  value="Kachara">Kachara</option>
                                                                            <option  value="Kahar">Kahar</option>
                                                                            <option  value="Kaibarta">Kaibarta</option>
                                                                            <option  value="Kaikaala">Kaikaala</option>
                                                                            <option  value="Kakkalan">Kakkalan</option>
                                                                            <option  value="Kalal">Kalal</option>
                                                                            <option  value="Kalanji">Kalanji</option>
                                                                            <option  value="Kalar">Kalar</option>
                                                                            <option  value="Kalinga">Kalinga</option>
                                                                            <option  value="Kalinga Vysya">Kalinga Vysya</option>
                                                                            <option  value="Kalita">Kalita</option>
                                                                            <option  value="Kalwar">Kalwar</option>
                                                                            <option  value="Kamboj">Kamboj</option>
                                                                            <option  value="Kamma">Kamma</option>
                                                                            <option  value="Kammala">Kammala</option>
                                                                            <option  value="Kanakaan Padonna">Kanakaan Padonna</option>
                                                                            <option  value="Kanakkan Padanna">Kanakkan Padanna</option>
                                                                            <option  value="Kandara">Kandara</option>
                                                                            <option  value="Kaniyan">Kaniyan</option>
                                                                            <option  value="Kansari">Kansari</option>
                                                                            <option  value="Kansyakaar">Kansyakaar</option>
                                                                            <option  value="Kapol">Kapol</option>
                                                                            <option  value="Kapu">Kapu</option>
                                                                            <option  value="Kapu - Balija/Balija Naidu">Kapu - Balija/Balija Naidu</option>
                                                                            <option  value="Kapu - Ediga/Goud (Balija)">Kapu - Ediga/Goud (Balija)</option>
                                                                            <option  value="Kapu - Gajula/Kavarai">Kapu - Gajula/Kavarai</option>
                                                                            <option  value="Kapu - Kapu All">Kapu - Kapu All</option>
                                                                            <option  value="Kapu - Kapu Munnuru">Kapu - Kapu Munnuru</option>
                                                                            <option  value="Kapu - Kapu Naidu">Kapu - Kapu Naidu</option>
                                                                            <option  value="Kapu - Kurupu/Kapu">Kapu - Kurupu/Kapu</option>
                                                                            <option  value="Kapu - Ontari">Kapu - Ontari</option>
                                                                            <option  value="Kapu - Perika">Kapu - Perika</option>
                                                                            <option  value="Kapu - Reddy">Kapu - Reddy</option>
                                                                            <option  value="Kapu - Setty Balija">Kapu - Setty Balija</option>
                                                                            <option  value="Kapu - Surya Balija">Kapu - Surya Balija</option>
                                                                            <option  value="Kapu - Telaga">Kapu - Telaga</option>
                                                                            <option  value="Kapu - Turupu Kapu">Kapu - Turupu Kapu</option>
                                                                            <option  value="Kapu - Velama">Kapu - Velama</option>
                                                                            <option  value="Kapu Munnuru">Kapu Munnuru</option>
                                                                            <option  value="Karakala Bhakthula">Karakala Bhakthula</option>
                                                                            <option  value="Karana">Karana</option>
                                                                            <option  value="Karmakar">Karmakar</option>
                                                                            <option  value="Karuneegar">Karuneegar</option>
                                                                            <option  value="Kasar">Kasar</option>
                                                                            <option  value="Kashyap - Nishad">Kashyap - Nishad</option>
                                                                            <option  value="Katiya">Katiya</option>
                                                                            <option  value="Kayastha">Kayastha</option>
                                                                            <option  value="Kayastha - Ambastha">Kayastha - Ambastha</option>
                                                                            <option  value="Kayastha - Ambastha Kayastha">Kayastha - Ambastha Kayastha</option>
                                                                            <option  value="Kayastha - Asthana">Kayastha - Asthana</option>
                                                                            <option  value="Kayastha - Barujibi">Kayastha - Barujibi</option>
                                                                            <option  value="Kayastha - Basu">Kayastha - Basu</option>
                                                                            <option  value="Kayastha - Bengali Kayastha">Kayastha - Bengali Kayastha</option>
                                                                            <option  value="Kayastha - Bhatnagar">Kayastha - Bhatnagar</option>
                                                                            <option  value="Kayastha - Bose">Kayastha - Bose</option>
                                                                            <option  value="Kayastha - Chanda">Kayastha - Chanda</option>
                                                                            <option  value="Kayastha - Dass">Kayastha - Dass</option>
                                                                            <option  value="Kayastha - Dey">Kayastha - Dey</option>
                                                                            <option  value="Kayastha - Dhar">Kayastha - Dhar</option>
                                                                            <option  value="Kayastha - Dutta">Kayastha - Dutta</option>
                                                                            <option  value="Kayastha - Ghosh">Kayastha - Ghosh</option>
                                                                            <option  value="Kayastha - Gour">Kayastha - Gour</option>
                                                                            <option  value="Kayastha - Guha">Kayastha - Guha</option>
                                                                            <option  value="Kayastha - Johri">Kayastha - Johri</option>
                                                                            <option  value="Kayastha - Karna">Kayastha - Karna</option>
                                                                            <option  value="Kayastha - Kars">Kayastha - Kars</option>
                                                                            <option  value="Kayastha - Kulin">Kayastha - Kulin</option>
                                                                            <option  value="Kayastha - Kulshreshtha">Kayastha - Kulshreshtha</option>
                                                                            <option  value="Kayastha - Mathur">Kayastha - Mathur</option>
                                                                            <option  value="Kayastha - Mitra">Kayastha - Mitra</option>
                                                                            <option  value="Kayastha - Nag">Kayastha - Nag</option>
                                                                            <option  value="Kayastha - Nandi">Kayastha - Nandi</option>
                                                                            <option  value="Kayastha - Nigam">Kayastha - Nigam</option>
                                                                            <option  value="Kayastha - Palit">Kayastha - Palit</option>
                                                                            <option  value="Kayastha - Paul">Kayastha - Paul</option>
                                                                            <option  value="Kayastha - Rakshit">Kayastha - Rakshit</option>
                                                                            <option  value="Kayastha - Rarhi">Kayastha - Rarhi</option>
                                                                            <option  value="Kayastha - Roy">Kayastha - Roy</option>
                                                                            <option  value="Kayastha - Saxena">Kayastha - Saxena</option>
                                                                            <option  value="Kayastha - Sen">Kayastha - Sen</option>
                                                                            <option  value="Kayastha - Sil">Kayastha - Sil</option>
                                                                            <option  value="Kayastha - Sinha">Kayastha - Sinha</option>
                                                                            <option  value="Kayastha - Srivastava">Kayastha - Srivastava</option>
                                                                            <option  value="Khandayat">Khandayat</option>
                                                                            <option  value="Khandayat - Kalinja">Khandayat - Kalinja</option>
                                                                            <option  value="Kharvi">Kharvi</option>
                                                                            <option  value="Kharwar">Kharwar</option>
                                                                            <option  value="Khatik">Khatik</option>
                                                                            <option  value="Khatri">Khatri</option>
                                                                            <option  value="Khatri - Anand">Khatri - Anand</option>
                                                                            <option  value="Khatri - Arora">Khatri - Arora</option>
                                                                            <option  value="Khatri - Bagga">Khatri - Bagga</option>
                                                                            <option  value="Khatri - Bahl">Khatri - Bahl</option>
                                                                            <option  value="Khatri - Batra">Khatri - Batra</option>
                                                                            <option  value="Khatri - Bedi">Khatri - Bedi</option>
                                                                            <option  value="Khatri - Behal">Khatri - Behal</option>
                                                                            <option  value="Khatri - Behl">Khatri - Behl</option>
                                                                            <option  value="Khatri - Beri">Khatri - Beri</option>
                                                                            <option  value="Khatri - Bhalla">Khatri - Bhalla</option>
                                                                            <option  value="Khatri - Bhandari">Khatri - Bhandari</option>
                                                                            <option  value="Khatri - Bhasin">Khatri - Bhasin</option>
                                                                            <option  value="Khatri - Bhatti">Khatri - Bhatti</option>
                                                                            <option  value="Khatri - Chaddha">Khatri - Chaddha</option>
                                                                            <option  value="Khatri - Chadha">Khatri - Chadha</option>
                                                                            <option  value="Khatri - Chandok">Khatri - Chandok</option>
                                                                            <option  value="Khatri - Chaudhary">Khatri - Chaudhary</option>
                                                                            <option  value="Khatri - Chhabra">Khatri - Chhabra</option>
                                                                            <option  value="Khatri - Chopra">Khatri - Chopra</option>
                                                                            <option  value="Khatri - Choudhuri">Khatri - Choudhuri</option>
                                                                            <option  value="Khatri - Dang">Khatri - Dang</option>
                                                                            <option  value="Khatri - Dhawan">Khatri - Dhawan</option>
                                                                            <option  value="Khatri - Dhir">Khatri - Dhir</option>
                                                                            <option  value="Khatri - Duggal">Khatri - Duggal</option>
                                                                            <option  value="Khatri - Ghai">Khatri - Ghai</option>
                                                                            <option  value="Khatri - Handa">Khatri - Handa</option>
                                                                            <option  value="Khatri - Jaggi">Khatri - Jaggi</option>
                                                                            <option  value="Khatri - Jairath">Khatri - Jairath</option>
                                                                            <option  value="Khatri - Jerath">Khatri - Jerath</option>
                                                                            <option  value="Khatri - Jham">Khatri - Jham</option>
                                                                            <option  value="Khatri - Kakkar">Khatri - Kakkar</option>
                                                                            <option  value="Khatri - Kapur/Kapoor">Khatri - Kapur/Kapoor</option>
                                                                            <option  value="Khatri - Kehar">Khatri - Kehar</option>
                                                                            <option  value="Khatri - Khanna">Khatri - Khanna</option>
                                                                            <option  value="Khatri - Khosla">Khatri - Khosla</option>
                                                                            <option  value="Khatri - Khukrain">Khatri - Khukrain</option>
                                                                            <option  value="Khatri - Khullar">Khatri - Khullar</option>
                                                                            <option  value="Khatri - Kochar">Khatri - Kochar</option>
                                                                            <option  value="Khatri - Kohli">Khatri - Kohli</option>
                                                                            <option  value="Khatri - Lamba">Khatri - Lamba</option>
                                                                            <option  value="Khatri - Mahendru">Khatri - Mahendru</option>
                                                                            <option  value="Khatri - Malhotra">Khatri - Malhotra</option>
                                                                            <option  value="Khatri - Marwah">Khatri - Marwah</option>
                                                                            <option  value="Khatri - Mehra">Khatri - Mehra</option>
                                                                            <option  value="Khatri - Mehta">Khatri - Mehta</option>
                                                                            <option  value="Khatri - Nagrath">Khatri - Nagrath</option>
                                                                            <option  value="Khatri - Nanda">Khatri - Nanda</option>
                                                                            <option  value="Khatri - Nayyar">Khatri - Nayyar</option>
                                                                            <option  value="Khatri - Oberoi">Khatri - Oberoi</option>
                                                                            <option  value="Khatri - Ohri">Khatri - Ohri</option>
                                                                            <option  value="Khatri - Passi">Khatri - Passi</option>
                                                                            <option  value="Khatri - Puri">Khatri - Puri</option>
                                                                            <option  value="Khatri - Sabharwal">Khatri - Sabharwal</option>
                                                                            <option  value="Khatri - Sahni">Khatri - Sahni</option>
                                                                            <option  value="Khatri - Sareen">Khatri - Sareen</option>
                                                                            <option  value="Khatri - Sarin">Khatri - Sarin</option>
                                                                            <option  value="Khatri - Sawhney">Khatri - Sawhney</option>
                                                                            <option  value="Khatri - Sehgal">Khatri - Sehgal</option>
                                                                            <option  value="Khatri - Sekhri">Khatri - Sekhri</option>
                                                                            <option  value="Khatri - Seth">Khatri - Seth</option>
                                                                            <option  value="Khatri - Sethi">Khatri - Sethi</option>
                                                                            <option  value="Khatri - Sobto">Khatri - Sobto</option>
                                                                            <option  value="Khatri - Sodhi">Khatri - Sodhi</option>
                                                                            <option  value="Khatri - Sandhi">Khatri - Sandhi</option>
                                                                            <option  value="Khatri - Soni">Khatri - Soni</option>
                                                                            <option  value="Khatri - Sood">Khatri - Sood</option>
                                                                            <option  value="Khatri - Suri">Khatri - Suri</option>
                                                                            <option  value="Khatri - Talwar">Khatri - Talwar</option>
                                                                            <option  value="Khatri - Tandon">Khatri - Tandon</option>
                                                                            <option  value="Khatri - Thapar">Khatri - Thapar</option>
                                                                            <option  value="Khatri - Tuli">Khatri - Tuli</option>
                                                                            <option  value="Khatri - Uppal">Khatri - Uppal</option>
                                                                            <option  value="Khatri - Vadhera">Khatri - Vadhera</option>
                                                                            <option  value="Khatri - Verma">Khatri - Verma</option>
                                                                            <option  value="Khatri - Vij">Khatri - Vij</option>
                                                                            <option  value="Khatri - Vohra">Khatri - Vohra</option>
                                                                            <option  value="Khatri - Wadhawan">Khatri - Wadhawan</option>
                                                                            <option  value="Khatri - Wahi">Khatri - Wahi</option>
                                                                            <option  value="Khatri - Walia">Khatri - Walia</option>
                                                                            <option  value="Koeri/Koiri">Koeri/Koiri</option>
                                                                            <option  value="Koli">Koli</option>
                                                                            <option  value="Koli - Koli Mahadev">Koli - Koli Mahadev</option>
                                                                            <option  value="Koli - Koli Patel">Koli - Koli Patel</option>
                                                                            <option  value="Koli - Mangela">Koli - Mangela</option>
                                                                            <option  value="Koli Mahadev">Koli Mahadev</option>
                                                                            <option  value="Kondara">Kondara</option>
                                                                            <option  value="Kongu Vellala Gounder">Kongu Vellala Gounder</option>
                                                                            <option  value="Kongu Vellala Gounder - Aadai">Kongu Vellala Gounder - Aadai</option>
                                                                            <option  value="Kongu Vellala Gounder - Aadhi">Kongu Vellala Gounder - Aadhi</option>
                                                                            <option  value="Kongu Vellala Gounder - Aanthai">Kongu Vellala Gounder - Aanthai</option>
                                                                            <option  value="Kongu Vellala Gounder - Aavan">Kongu Vellala Gounder - Aavan</option>
                                                                            <option  value="Kongu Vellala Gounder - Alagan">Kongu Vellala Gounder - Alagan</option>
                                                                            <option  value="Kongu Vellala Gounder - Andai">Kongu Vellala Gounder - Andai</option>
                                                                            <option  value="Kongu Vellala Gounder - Andhuvan">Kongu Vellala Gounder - Andhuvan</option>
                                                                            <option  value="Kongu Vellala Gounder - Cheran">Kongu Vellala Gounder - Cheran</option>
                                                                            <option  value="Kongu Vellala Gounder - Devendran">Kongu Vellala Gounder - Devendran</option>
                                                                            <option  value="Kongu Vellala Gounder - Eenjan">Kongu Vellala Gounder - Eenjan</option>
                                                                            <option  value="Kongu Vellala Gounder - Ennai">Kongu Vellala Gounder - Ennai</option>
                                                                            <option  value="Kongu Vellala Gounder - Kaadai">Kongu Vellala Gounder - Kaadai</option>
                                                                            <option  value="Kongu Vellala Gounder - Kaari">Kongu Vellala Gounder - Kaari</option>
                                                                            <option  value="Kongu Vellala Gounder - Kanakkan">Kongu Vellala Gounder - Kanakkan</option>
                                                                            <option  value="Kongu Vellala Gounder - Kannan">Kongu Vellala Gounder - Kannan</option>
                                                                            <option  value="Kongu Vellala Gounder - Kannandhai">Kongu Vellala Gounder - Kannandhai</option>
                                                                            <option  value="Kongu Vellala Gounder - Keeran">Kongu Vellala Gounder - Keeran</option>
                                                                            <option  value="Kongu Vellala Gounder - Koorai">Kongu Vellala Gounder - Koorai</option>
                                                                            <option  value="Kongu Vellala Gounder - Koventhar">Kongu Vellala Gounder - Koventhar</option>
                                                                            <option  value="Kongu Vellala Gounder - Kuzhlaayan">Kongu Vellala Gounder - Kuzhlaayan</option>
                                                                            <option  value="Kongu Vellala Gounder - Maadai">Kongu Vellala Gounder - Maadai</option>
                                                                            <option  value="Kongu Vellala Gounder - Maniyan">Kongu Vellala Gounder - Maniyan</option>
                                                                            <option  value="Kongu Vellala Gounder - Medhi">Kongu Vellala Gounder - Medhi</option>
                                                                            <option  value="Kongu Vellala Gounder - Muthan">Kongu Vellala Gounder - Muthan</option>
                                                                            <option  value="Kongu Vellala Gounder - Muzhlukkadhan">Kongu Vellala Gounder - Muzhlukkadhan</option>
                                                                            <option  value="Kongu Vellala Gounder - Nattu Gounder">Kongu Vellala Gounder - Nattu Gounder</option>
                                                                            <option  value="Kongu Vellala Gounder - Odhaalar">Kongu Vellala Gounder - Odhaalar</option>
                                                                            <option  value="Kongu Vellala Gounder - Paandian">Kongu Vellala Gounder - Paandian</option>
                                                                            <option  value="Kongu Vellala Gounder - Padaithalaiyan">Kongu Vellala Gounder - Padaithalaiyan</option>
                                                                            <option  value="Kongu Vellala Gounder - Panaiyan">Kongu Vellala Gounder - Panaiyan</option>
                                                                            <option  value="Kongu Vellala Gounder - Panangadai">Kongu Vellala Gounder - Panangadai</option>
                                                                            <option  value="Kongu Vellala Gounder - Pannai">Kongu Vellala Gounder - Pannai</option>
                                                                            <option  value="Kongu Vellala Gounder - Pannan">Kongu Vellala Gounder - Pannan</option>
                                                                            <option  value="Kongu Vellala Gounder - Pavalan">Kongu Vellala Gounder - Pavalan</option>
                                                                            <option  value="Kongu Vellala Gounder - Payiran">Kongu Vellala Gounder - Payiran</option>
                                                                            <option  value="Kongu Vellala Gounder - Pariyan">Kongu Vellala Gounder - Pariyan</option>
                                                                            <option  value="Kongu Vellala Gounder - Perizhanthan">Kongu Vellala Gounder - Perizhanthan</option>
                                                                            <option  value="Kongu Vellala Gounder - Perunkudi">Kongu Vellala Gounder - Perunkudi</option>
                                                                            <option  value="Kongu Vellala Gounder - Pillan">Kongu Vellala Gounder - Pillan</option>
                                                                            <option  value="Kongu Vellala Gounder - Podiyan">Kongu Vellala Gounder - Podiyan</option>
                                                                            <option  value="Kongu Vellala Gounder - Ponnan">Kongu Vellala Gounder - Ponnan</option>
                                                                            <option  value="Kongu Vellala Gounder - Poochadhai Poodhiyan">Kongu Vellala Gounder - Poochadhai Poodhiyan</option>
                                                                            <option  value="Kongu Vellala Gounder - Poosan">Kongu Vellala Gounder - Poosan</option>
                                                                            <option  value="Kongu Vellala Gounder - Sathandhai">Kongu Vellala Gounder - Sathandhai</option>
                                                                            <option  value="Kongu Vellala Gounder - Sedan">Kongu Vellala Gounder - Sedan</option>
                                                                            <option  value="Kongu Vellala Gounder - Sellan">Kongu Vellala Gounder - Sellan</option>
                                                                            <option  value="Kongu Vellala Gounder - Sempoothan">Kongu Vellala Gounder - Sempoothan</option>
                                                                            <option  value="Kongu Vellala Gounder - Sengannan">Kongu Vellala Gounder - Sengannan</option>
                                                                            <option  value="Kongu Vellala Gounder - Sengunni">Kongu Vellala Gounder - Sengunni</option>
                                                                            <option  value="Kongu Vellala Gounder - Seralan">Kongu Vellala Gounder - Seralan</option>
                                                                            <option  value="Kongu Vellala Gounder - Sevadi">Kongu Vellala Gounder - Sevadi</option>
                                                                            <option  value="Kongu Vellala Gounder - Thodai">Kongu Vellala Gounder - Thodai</option>
                                                                            <option  value="Kongu Vellala Gounder - Thooran">Kongu Vellala Gounder - Thooran</option>
                                                                            <option  value="Kongu Vellala Gounder - Vannakkan">Kongu Vellala Gounder - Vannakkan</option>
                                                                            <option  value="Kongu Vellala Gounder - Veliyan">Kongu Vellala Gounder - Veliyan</option>
                                                                            <option  value="Kongu Vellala Gounder - Vellamban">Kongu Vellala Gounder - Vellamban</option>
                                                                            <option  value="Kongu Vellala Gounder - Venduvan">Kongu Vellala Gounder - Venduvan</option>
                                                                            <option  value="Kongu Vellala Gounder - Viliyan">Kongu Vellala Gounder - Viliyan</option>
                                                                            <option  value="Kongu Vellala Gounder - Villi">Kongu Vellala Gounder - Villi</option>
                                                                            <option  value="Konkani">Konkani</option>
                                                                            <option  value="Koracha">Koracha</option>
                                                                            <option  value="Korama">Korama</option>
                                                                            <option  value="Kori">Kori</option>
                                                                            <option  value="Kori/Koli">Kori/Koli</option>
                                                                            <option  value="Korvi">Korvi</option>
                                                                            <option  value="Koshti">Koshti</option>
                                                                            <option  value="Krishnavaka">Krishnavaka</option>
                                                                            <option  value="Kshatriya">Kshatriya</option>
                                                                            <option  value="Kshatriya - Agnikula Kshatriya">Kshatriya - Agnikula Kshatriya</option>
                                                                            <option  value="Kshatriya - Aguri Ugra Kshatriya">Kshatriya - Aguri Ugra Kshatriya</option>
                                                                            <option  value="Kshatriya - Amethia">Kshatriya - Amethia</option>
                                                                            <option  value="Kshatriya - Bachhil">Kshatriya - Bachhil</option>
                                                                            <option  value="Kshatriya - Bagel">Kshatriya - Bagel</option>
                                                                            <option  value="Kshatriya - Baghela/Veghela">Kshatriya - Baghela/Veghela</option>
                                                                            <option  value="Kshatriya - Banafar">Kshatriya - Banafar</option>
                                                                            <option  value="Kshatriya - Bhodoria">Kshatriya - Bhodoria</option>
                                                                            <option  value="Kshatriya - Bhandari">Kshatriya - Bhandari</option>
                                                                            <option  value="Kshatriya - Bhardwaj">Kshatriya - Bhardwaj</option>
                                                                            <option  value="Kshatriya - Bhatraju">Kshatriya - Bhatraju</option>
                                                                            <option  value="Kshatriya - Bhavasar Kshatriya">Kshatriya - Bhavasar Kshatriya</option>
                                                                            <option  value="Kshatriya - Bundela">Kshatriya - Bundela</option>
                                                                            <option  value="Kshatriya - Chopra">Kshatriya - Chopra</option>
                                                                            <option  value="Kshatriya - Chudasa">Kshatriya - Chudasa</option>
                                                                            <option  value="Kshatriya - Dangi">Kshatriya - Dangi</option>
                                                                            <option  value="Kshatriya - Dhawan">Kshatriya - Dhawan</option>
                                                                            <option  value="Kshatriya - Dixit">Kshatriya - Dixit</option>
                                                                            <option  value="Kshatriya - Gaherwar">Kshatriya - Gaherwar</option>
                                                                            <option  value="Kshatriya - Gargvansi">Kshatriya - Gargvansi</option>
                                                                            <option  value="Kshatriya - Gaur">Kshatriya - Gaur</option>
                                                                            <option  value="Kshatriya - Hada">Kshatriya - Hada</option>
                                                                            <option  value="Kshatriya - Haihaivanshi">Kshatriya - Haihaivanshi</option>
                                                                            <option  value="Kshatriya - Jaiswar">Kshatriya - Jaiswar</option>
                                                                            <option  value="Kshatriya - Janwar">Kshatriya - Janwar</option>
                                                                            <option  value="Kshatriya - Kandera">Kshatriya - Kandera</option>
                                                                            <option  value="Kshatriya - Kapur">Kshatriya - Kapur</option>
                                                                            <option  value="Kshatriya - Katiyar">Kshatriya - Katiyar</option>
                                                                            <option  value="Kshatriya - Khandayat">Kshatriya - Khandayat</option>
                                                                            <option  value="Kshatriya - Khanna">Kshatriya - Khanna</option>
                                                                            <option  value="Kshatriya - Khare">Kshatriya - Khare</option>
                                                                            <option  value="Kshatriya - Kshatriya Raju">Kshatriya - Kshatriya Raju</option>
                                                                            <option  value="Kshatriya - Kshatriya Raju Chandravamsam">Kshatriya - Kshatriya Raju Chandravamsam</option>
                                                                            <option  value="Kshatriya - Kshatriya Raju Suryavamsam">Kshatriya - Kshatriya Raju Suryavamsam</option>
                                                                            <option  value="Kshatriya - Kumawat">Kshatriya - Kumawat</option>
                                                                            <option  value="Kshatriya - Kurmi">Kshatriya - Kurmi</option>
                                                                            <option  value="Kshatriya - Mehra">Kshatriya - Mehra</option>
                                                                            <option  value="Kshatriya - Nagvanshi">Kshatriya - Nagvanshi</option>
                                                                            <option  value="Kshatriya - Negi">Kshatriya - Negi</option>
                                                                            <option  value="Kshatriya - Niari">Kshatriya - Niari</option>
                                                                            <option  value="Kshatriya - Nikhumbh">Kshatriya - Nikhumbh</option>
                                                                            <option  value="Kshatriya - Paliwal">Kshatriya - Paliwal</option>
                                                                            <option  value="Kshatriya - Pawar">Kshatriya - Pawar</option>
                                                                            <option  value="Kshatriya - Peroka Puragiri Kshatriya">Kshatriya - Peroka Puragiri Kshatriya</option>
                                                                            <option  value="Kshatriya - Pundir">Kshatriya - Pundir</option>
                                                                            <option  value="Kshatriya - Raikwar">Kshatriya - Raikwar</option>
                                                                            <option  value="Kshatriya - Rajkumar">Kshatriya - Rajkumar</option>
                                                                            <option  value="Kshatriya - Rajwar">Kshatriya - Rajwar</option>
                                                                            <option  value="Kshatriya - Rama Kshatriya">Kshatriya - Rama Kshatriya</option>
                                                                            <option  value="Kshatriya - Rathor">Kshatriya - Rathor</option>
                                                                            <option  value="Kshatriya - Rawal">Kshatriya - Rawal</option>
                                                                            <option  value="Kshatriya - Rawat">Kshatriya - Rawat</option>
                                                                            <option  value="Kshatriya - Sahni">Kshatriya - Sahni</option>
                                                                            <option  value="Kshatriya - Saithwar Mall">Kshatriya - Saithwar Mall</option>
                                                                            <option  value="Kshatriya - Sami">Kshatriya - Sami</option>
                                                                            <option  value="Kshatriya - Sengar">Kshatriya - Sengar</option>
                                                                            <option  value="Kshatriya - Seth">Kshatriya - Seth</option>
                                                                            <option  value="Kshatriya - Shrinet">Kshatriya - Shrinet</option>
                                                                            <option  value="Kshatriya - Singh">Kshatriya - Singh</option>
                                                                            <option  value="Kshatriya - Sisodiya">Kshatriya - Sisodiya</option>
                                                                            <option  value="Kshatriya - Soma Vamsha Arya Kshatriya">Kshatriya - Soma Vamsha Arya Kshatriya</option>
                                                                            <option  value="Kshatriya - Somavanshi Sahasrarjun Kshatriya">Kshatriya - Somavanshi Sahasrarjun Kshatriya</option>
                                                                            <option  value="Kshatriya - Somvanshi">Kshatriya - Somvanshi</option>
                                                                            <option  value="Kshatriya - Tandon">Kshatriya - Tandon</option>
                                                                            <option  value="Kshatriya - Tanwar">Kshatriya - Tanwar</option>
                                                                            <option  value="Kshatriya - Thogata Veera Kshatriya">Kshatriya - Thogata Veera Kshatriya</option>
                                                                            <option  value="Kshatriya - Tomar/Tanwar">Kshatriya - Tomar/Tanwar</option>
                                                                            <option  value="Kshatriya - Tong Kshatriya">Kshatriya - Tong Kshatriya</option>
                                                                            <option  value="Kshatriya - Vahi">Kshatriya - Vahi</option>
                                                                            <option  value="Kshatriya - Vohra">Kshatriya - Vohra</option>
                                                                            <option  value="Kshatriya - Wadhwa">Kshatriya - Wadhwa</option>
                                                                            <option  value="Kshatriya Agnikula">Kshatriya Agnikula</option>
                                                                            <option  value="Kudumbi">Kudumbi</option>
                                                                            <option  value="Kulalar">Kulalar</option>
                                                                            <option  value="Kulita">Kulita</option>
                                                                            <option  value="Kumaoni">Kumaoni</option>
                                                                            <option  value="Kumawat">Kumawat</option>
                                                                            <option  value="Kumbhakar">Kumbhakar</option>
                                                                            <option  value="Kumhar/Kumbhar">Kumhar/Kumbhar</option>
                                                                            <option  value="Kummari">Kummari</option>
                                                                            <option  value="Kunbi">Kunbi</option>
                                                                            <option  value="Kunbi - Ghatode">Kunbi - Ghatode</option>
                                                                            <option  value="Kunbi - Kunbi - Dhanoje">Kunbi - Kunbi - Dhanoje</option>
                                                                            <option  value="Kunbi - Kunbi - Khaire">Kunbi - Kunbi - Khaire</option>
                                                                            <option  value="Kunbi - Kunbi - Khedule">Kunbi - Kunbi - Khedule</option>
                                                                            <option  value="Kunbi - Kunbi - Lonari">Kunbi - Kunbi - Lonari</option>
                                                                            <option  value="Kunbi - Kunbi - Maratha">Kunbi - Kunbi - Maratha</option>
                                                                            <option  value="Kunbi - Kunbi - Tirale">Kunbi - Kunbi - Tirale</option>
                                                                            <option  value="Kunbi - Zade">Kunbi - Zade</option>
                                                                            <option  value="Kurava">Kurava</option>
                                                                            <option  value="Kuravan/Kuravar">Kuravan/Kuravar</option>
                                                                            <option  value="Kurmi">Kurmi</option>
                                                                            <option  value="Kurmi - Awadhiya">Kurmi - Awadhiya</option>
                                                                            <option  value="Kurmi - Baghel">Kurmi - Baghel</option>
                                                                            <option  value="Kurmi - Chandel">Kurmi - Chandel</option>
                                                                            <option  value="Kurmi - Chandra">Kurmi - Chandra</option>
                                                                            <option  value="Kurmi - Chandrakar">Kurmi - Chandrakar</option>
                                                                            <option  value="Kurmi - Chandrawanshi">Kurmi - Chandrawanshi</option>
                                                                            <option  value="Kurmi - Chaudhary">Kurmi - Chaudhary</option>
                                                                            <option  value="Kurmi - Chaudhury">Kurmi - Chaudhury</option>
                                                                            <option  value="Kurmi - Deshmukh">Kurmi - Deshmukh</option>
                                                                            <option  value="Kurmi - Gangwar">Kurmi - Gangwar</option>
                                                                            <option  value="Kurmi - Ghamaila">Kurmi - Ghamaila</option>
                                                                            <option  value="Kurmi - Jaiswar">Kurmi - Jaiswar</option>
                                                                            <option  value="Kurmi - Kashyap">Kurmi - Kashyap</option>
                                                                            <option  value="Kurmi - Katiyar">Kurmi - Katiyar</option>
                                                                            <option  value="Kurmi - Kochyasa">Kurmi - Kochyasa</option>
                                                                            <option  value="Kurmi - Kumar">Kurmi - Kumar</option>
                                                                            <option  value="Kurmi - Kushwaha (Koiri)">Kurmi - Kushwaha (Koiri)</option>
                                                                            <option  value="Kurmi - Mahata">Kurmi - Mahata</option>
                                                                            <option  value="Kurmi - Mahato">Kurmi - Mahato</option>
                                                                            <option  value="Kurmi - Mahto">Kurmi - Mahto</option>
                                                                            <option  value="Kurmi - Parganiha">Kurmi - Parganiha</option>
                                                                            <option  value="Kurmi - Patel">Kurmi - Patel</option>
                                                                            <option  value="Kurmi - Patidar">Kurmi - Patidar</option>
                                                                            <option  value="Kurmi - Prasad">Kurmi - Prasad</option>
                                                                            <option  value="Kurmi - Rai">Kurmi - Rai</option>
                                                                            <option  value="Kurmi - Sachan">Kurmi - Sachan</option>
                                                                            <option  value="Kurmi - Singh">Kurmi - Singh</option>
                                                                            <option  value="Kurmi - Verma">Kurmi - Verma</option>
                                                                            <option  value="Kurmi Kshatriya">Kurmi Kshatriya</option>
                                                                            <option  value="Kurmi Kshatriya - Awadhya">Kurmi Kshatriya - Awadhya</option>
                                                                            <option  value="Kurmi Kshatriya - Baghel">Kurmi Kshatriya - Baghel</option>
                                                                            <option  value="Kurmi Kshatriya - Chandel">Kurmi Kshatriya - Chandel</option>
                                                                            <option  value="Kurmi Kshatriya - Chandra">Kurmi Kshatriya - Chandra</option>
                                                                            <option  value="Kurmi Kshatriya - Chandrakar">Kurmi Kshatriya - Chandrakar</option>
                                                                            <option  value="Kurmi Kshatriya - Chandrawanshi">Kurmi Kshatriya - Chandrawanshi</option>
                                                                            <option  value="Kurmi Kshatriya - Chaudhury">Kurmi Kshatriya - Chaudhury</option>
                                                                            <option  value="Kurmi Kshatriya - Deshmukh">Kurmi Kshatriya - Deshmukh</option>
                                                                            <option  value="Kurmi Kshatriya - Gangwar">Kurmi Kshatriya - Gangwar</option>
                                                                            <option  value="Kurmi Kshatriya - Ghamaila">Kurmi Kshatriya - Ghamaila</option>
                                                                            <option  value="Kurmi Kshatriya - Jaiswar">Kurmi Kshatriya - Jaiswar</option>
                                                                            <option  value="Kurmi Kshatriya - Kashyap">Kurmi Kshatriya - Kashyap</option>
                                                                            <option  value="Kurmi Kshatriya - Katiyar">Kurmi Kshatriya - Katiyar</option>
                                                                            <option  value="Kurmi Kshatriya - Kochaisa">Kurmi Kshatriya - Kochaisa</option>
                                                                            <option  value="Kurmi Kshatriya - Kumar">Kurmi Kshatriya - Kumar</option>
                                                                            <option  value="Kurmi Kshatriya - Kushwaha Koiri">Kurmi Kshatriya - Kushwaha Koiri</option>
                                                                            <option  value="Kurmi Kshatriya - Mahata">Kurmi Kshatriya - Mahata</option>
                                                                            <option  value="Kurmi Kshatriya - Mahato">Kurmi Kshatriya - Mahato</option>
                                                                            <option  value="Kurmi Kshatriya - Mahto">Kurmi Kshatriya - Mahto</option>
                                                                            <option  value="Kurmi Kshatriya - Parganiha">Kurmi Kshatriya - Parganiha</option>
                                                                            <option  value="Kurmi Kshatriya - Patel">Kurmi Kshatriya - Patel</option>
                                                                            <option  value="Kurmi Kshatriya - Prasad">Kurmi Kshatriya - Prasad</option>
                                                                            <option  value="Kurmi Kshatriya - Rai">Kurmi Kshatriya - Rai</option>
                                                                            <option  value="Kurmi Kshatriya - Sachan">Kurmi Kshatriya - Sachan</option>
                                                                            <option  value="Kurmi Kshatriya - Singh">Kurmi Kshatriya - Singh</option>
                                                                            <option  value="Kurmi Kshatriya - Verma">Kurmi Kshatriya - Verma</option>
                                                                            <option  value="Kuruba">Kuruba</option>
                                                                            <option  value="Kuruhina Shetty">Kuruhina Shetty</option>
                                                                            <option  value="Kurumbar">Kurumbar</option>
                                                                            <option  value="Kuruva">Kuruva</option>
                                                                            <option  value="Kushwaha">Kushwaha</option>
                                                                            <option  value="Kutchi">Kutchi</option>
                                                                            <option  value="Kutchi Gurjar">Kutchi Gurjar</option>
                                                                            <option  value="Lambadi">Lambadi</option>
                                                                            <option  value="Laxminarayan gola">Laxminarayan gola</option>
                                                                            <option  value="Leva Patidar">Leva Patidar</option>
                                                                            <option  value="Leva Patil">Leva Patil</option>
                                                                            <option  value="Lingayat">Lingayat</option>
                                                                            <option  value="Lingayat - Agasa">Lingayat - Agasa</option>
                                                                            <option  value="Lingayat - Akkasali">Lingayat - Akkasali</option>
                                                                            <option  value="Lingayat - Aradhya">Lingayat - Aradhya</option>
                                                                            <option  value="Lingayat - Balegala">Lingayat - Balegala</option>
                                                                            <option  value="Lingayat - Banagar">Lingayat - Banagar</option>
                                                                            <option  value="Lingayat - Banajiga">Lingayat - Banajiga</option>
                                                                            <option  value="Lingayat - Bhandari">Lingayat - Bhandari</option>
                                                                            <option  value="Lingayat - Bilijedaru">Lingayat - Bilijedaru</option>
                                                                            <option  value="Lingayat - Bilimagga">Lingayat - Bilimagga</option>
                                                                            <option  value="Lingayat - Chaturtha">Lingayat - Chaturtha</option>
                                                                            <option  value="Lingayat - Dikshwant">Lingayat - Dikshwant</option>
                                                                            <option  value="Lingayat - Ganiga">Lingayat - Ganiga</option>
                                                                            <option  value="Lingayat - Gowda">Lingayat - Gowda</option>
                                                                            <option  value="Lingayat - Gowli">Lingayat - Gowli</option>
                                                                            <option  value="Lingayat - Gurav">Lingayat - Gurav</option>
                                                                            <option  value="Lingayat - Hadapada">Lingayat - Hadapada</option>
                                                                            <option  value="Lingayat - Hatgar">Lingayat - Hatgar</option>
                                                                            <option  value="Lingayat - Hoogar/Hugar/Jeer">Lingayat - Hoogar/Hugar/Jeer</option>
                                                                            <option  value="Lingayat - Jadaru">Lingayat - Jadaru</option>
                                                                            <option  value="Lingayat - Jangam">Lingayat - Jangam</option>
                                                                            <option  value="Lingayat - Kudu Vokkaliga">Lingayat - Kudu Vokkaliga</option>
                                                                            <option  value="Lingayat - Kumbar/Kumbara">Lingayat - Kumbar/Kumbara</option>
                                                                            <option  value="Lingayat - Kumbhar">Lingayat - Kumbhar</option>
                                                                            <option  value="Lingayat - Kuruhina Setty">Lingayat - Kuruhina Setty</option>
                                                                            <option  value="Lingayat - Lamba">Lingayat - Lamba</option>
                                                                            <option  value="Lingayat - Lolagonda">Lingayat - Lolagonda</option>
                                                                            <option  value="Lingayat - Madivala">Lingayat - Madivala</option>
                                                                            <option  value="Lingayat - Malgar">Lingayat - Malgar</option>
                                                                            <option  value="Lingayat - Mali">Lingayat - Mali</option>
                                                                            <option  value="Lingayat - Neelagar">Lingayat - Neelagar</option>
                                                                            <option  value="Lingayat - Neeli/Neelagar">Lingayat - Neeli/Neelagar</option>
                                                                            <option  value="Lingayat - Neygi">Lingayat - Neygi</option>
                                                                            <option  value="Lingayat - Nolamba">Lingayat - Nolamba</option>
                                                                            <option  value="Lingayat - Pancham">Lingayat - Pancham</option>
                                                                            <option  value="Lingayat - Panchamasali">Lingayat - Panchamasali</option>
                                                                            <option  value="Lingayat - Pattasali">Lingayat - Pattasali</option>
                                                                            <option  value="Lingayat - Reddy Reddi">Lingayat - Reddy Reddi</option>
                                                                            <option  value="Lingayat - Sadar">Lingayat - Sadar</option>
                                                                            <option  value="Lingayat - Sajjan/Sajjanaganigar">Lingayat - Sajjan/Sajjanaganigar</option>
                                                                            <option  value="Lingayat - Setty">Lingayat - Setty</option>
                                                                            <option  value="Lingayat - Shilwant">Lingayat - Shilwant</option>
                                                                            <option  value="Lingayat - Shiva Simpi">Lingayat - Shiva Simpi</option>
                                                                            <option  value="Lingayat - Vani">Lingayat - Vani</option>
                                                                            <option  value="Lingayat - Veerashaiva">Lingayat - Veerashaiva</option>
                                                                            <option  value="Lohana">Lohana</option>
                                                                            <option  value="Lohana - Ghoghari">Lohana - Ghoghari</option>
                                                                            <option  value="Lohana - Halai">Lohana - Halai</option>
                                                                            <option  value="Lohana - Kutchi">Lohana - Kutchi</option>
                                                                            <option  value="Lohana - Vaishnav">Lohana - Vaishnav</option>
                                                                            <option  value="Lhar">Lhar</option>
                                                                            <option  value="Lubana">Lubana</option>
                                                                            <option  value="Madiga">Madiga</option>
                                                                            <option  value="Mahar">Mahar</option>
                                                                            <option  value="Mahendra">Mahendra</option>
                                                                            <option  value="Maheshwari">Maheshwari</option>
                                                                            <option  value="Mahindra">Mahindra</option>
                                                                            <option  value="Mahisya">Mahisya</option>
                                                                            <option  value="Majabi Mazhbi">Majabi Mazhbi</option>
                                                                            <option  value="Mala">Mala</option>
                                                                            <option  value="Mali">Mali</option>
                                                                            <option  value="Mallah">Mallah</option>
                                                                            <option  value="Mallah - Kewat/Keot">Mallah - Kewat/Keot</option>
                                                                            <option  value="Mallah - Nishad">Mallah - Nishad</option>
                                                                            <option  value="Manikpuri">Manikpuri</option>
                                                                            <option  value="Manipuri">Manipuri</option>
                                                                            <option  value="Manjhi">Manjhi</option>
                                                                            <option  value="Mannan/Velon/Vannan">Mannan/Velon/Vannan</option>
                                                                            <option  value="Mapila">Mapila</option>
                                                                            <option  value="Maratha">Maratha</option>
                                                                            <option  value="Maratha - 96 Kuli Maratha">Maratha - 96 Kuli Maratha</option>
                                                                            <option  value="Maratha - 96 Kuli Kokanastha">Maratha - 96 Kuli Kokanastha</option>
                                                                            <option  value="Maratha - Aramari Gabit">Maratha - Aramari Gabit</option>
                                                                            <option  value="Maratha - Deshastha Maratha">Maratha - Deshastha Maratha</option>
                                                                            <option  value="Maratha - Deshmukh">Maratha - Deshmukh</option>
                                                                            <option  value="Maratha - Deshtha Maratha">Maratha - Deshtha Maratha</option>
                                                                            <option  value="Maratha - Gomantak Maratha">Maratha - Gomantak Maratha</option>
                                                                            <option  value="Maratha - Jhadav">Maratha - Jhadav</option>
                                                                            <option  value="Maratha - Kokanastha Maratha">Maratha - Kokanastha Maratha</option>
                                                                            <option  value="Maratha - Kunbi Dhanoje">Maratha - Kunbi Dhanoje</option>
                                                                            <option  value="Maratha - Kunbi Khaire">Maratha - Kunbi Khaire</option>
                                                                            <option  value="Maratha - Kunbi Khedule">Maratha - Kunbi Khedule</option>
                                                                            <option  value="Maratha - Kunbi Lonari">Maratha - Kunbi Lonari</option>
                                                                            <option  value="Maratha - Kunbi Maratha">Maratha - Kunbi Maratha</option>
                                                                            <option  value="Maratha - Kunbi Tirale">Maratha - Kunbi Tirale</option>
                                                                            <option  value="Maratha - Malwani">Maratha - Malwani</option>
                                                                            <option  value="Maratha - Maratha Kshatriya">Maratha - Maratha Kshatriya</option>
                                                                            <option  value="Maratha - Parit">Maratha - Parit</option>
                                                                            <option  value="Maratha - Patil">Maratha - Patil</option>
                                                                            <option  value="Maratha - Sonar">Maratha - Sonar</option>
                                                                            <option  value="Maratha - Suthar">Maratha - Suthar</option>
                                                                            <option  value="Maratha - Vani">Maratha - Vani</option>
                                                                            <option  value="Maravar">Maravar</option>
                                                                            <option  value="Maruthuvar">Maruthuvar</option>
                                                                            <option  value="Matang">Matang</option>
                                                                            <option  value="Maurya">Maurya</option>
                                                                            <option  value="Maurya - Kachchi">Maurya - Kachchi</option>
                                                                            <option  value="Maurya - Kushwaha">Maurya - Kushwaha</option>
                                                                            <option  value="Meda">Meda</option>
                                                                            <option  value="Meena">Meena</option>
                                                                            <option  value="Meenavar">Meenavar</option>
                                                                            <option  value="Meghwal">Meghwal</option>
                                                                            <option  value="Mehra">Mehra</option>
                                                                            <option  value="Mehtar">Mehtar</option>
                                                                            <option  value="Menon">Menon</option>
                                                                            <option  value="Meru">Meru</option>
                                                                            <option  value="Meru darji">Meru darji</option>
                                                                            <option  value="Mochi">Mochi</option>
                                                                            <option  value="Modak">Modak</option>
                                                                            <option  value="Mogaveera">Mogaveera</option>
                                                                            <option  value="Monchi">Monchi</option>
                                                                            <option  value="Motati Reddy">Motati Reddy</option>
                                                                            <option  value="Mudaliar">Mudaliar</option>
                                                                            <option  value="Mudaliar - Agamudayar/Arcot/Thuluva Vellala">Mudaliar - Agamudayar/Arcot/Thuluva Vellala</option>
                                                                            <option  value="Mudaliar - Isai Vellalar">Mudaliar - Isai Vellalar</option>
                                                                            <option  value="Mudaliar - Kerala Mudali">Mudaliar - Kerala Mudali</option>
                                                                            <option  value="Mudaliar - Kongu Vellala Gounder">Mudaliar - Kongu Vellala Gounder</option>
                                                                            <option  value="Mudaliar - Mudailiar Arcot">Mudaliar - Mudailiar Arcot</option>
                                                                            <option  value="Mudaliar - Mudaliar All">Mudaliar - Mudaliar All</option>
                                                                            <option  value="Mudaliar - Mudaliar Saiva">Mudaliar - Mudaliar Saiva</option>
                                                                            <option  value="Mudaliar - Mudaliar Sengupta">Mudaliar - Mudaliar Sengupta</option>
                                                                            <option  value="Mudaliar - Saiva Pillai Tirunelveli">Mudaliar - Saiva Pillai Tirunelveli</option>
                                                                            <option  value="Mudaliar - Sengunthar/Kaikolar">Mudaliar - Sengunthar/Kaikolar</option>
                                                                            <option  value="Mudaliar - Sozhiya Vellalar">Mudaliar - Sozhiya Vellalar</option>
                                                                            <option  value="Mudaliar - Thondai Mandala Vellala">Mudaliar - Thondai Mandala Vellala</option>
                                                                            <option  value="Mudaliar - Veerakodi Vellala">Mudaliar - Veerakodi Vellala</option>
                                                                            <option  value="Mudaliar Arcot">Mudaliar Arcot</option>
                                                                            <option  value="Mudiraj">Mudiraj</option>
                                                                            <option  value="Muthuraja">Muthuraja</option>
                                                                            <option  value="Naagavamsam">Naagavamsam</option>
                                                                            <option  value="Nadar">Nadar</option>
                                                                            <option  value="Nadar - Kongu Nadar">Nadar - Kongu Nadar</option>
                                                                            <option  value="Nagaralu">Nagaralu</option>
                                                                            <option  value="Naicker">Naicker</option>
                                                                            <option  value="Naicker - Naicker others">Naicker - Naicker others</option>
                                                                            <option  value="Naicker - Naicker-Vanniya Kula Kshatriyar">Naicker - Naicker-Vanniya Kula Kshatriyar</option>
                                                                            <option  value="Naicker - Rajaka Chakali Dhobi">Naicker - Rajaka Chakali Dhobi</option>
                                                                            <option  value="Naidu">Naidu</option>
                                                                            <option  value="Naidu - Balija Naidu">Naidu - Balija Naidu</option>
                                                                            <option  value="Naidu - Ediga/Goud">Naidu - Ediga/Goud</option>
                                                                            <option  value="Naidu - Gajula Kavarai">Naidu - Gajula Kavarai</option>
                                                                            <option  value="Naidu - Gavara">Naidu - Gavara</option>
                                                                            <option  value="Naidu - Kamma">Naidu - Kamma</option>
                                                                            <option  value="Naidu - Kapu Naidu">Naidu - Kapu Naidu</option>
                                                                            <option  value="Naidu - Munnuru Kapu">Naidu - Munnuru Kapu</option>
                                                                            <option  value="Naidu - Mutharaja">Naidu - Mutharaja</option>
                                                                            <option  value="Naidu - Perika">Naidu - Perika</option>
                                                                            <option  value="Naidu - Raja Kambalathu Naicker">Naidu - Raja Kambalathu Naicker</option>
                                                                            <option  value="Naidu - Raju">Naidu - Raju</option>
                                                                            <option  value="Naidu - Reddy">Naidu - Reddy</option>
                                                                            <option  value="Naidu - Shetty Balija">Naidu - Shetty Balija</option>
                                                                            <option  value="Naidu - Surya Balija">Naidu - Surya Balija</option>
                                                                            <option  value="Naidu - Telaga">Naidu - Telaga</option>
                                                                            <option  value="Naidu - Turupu Kapu">Naidu - Turupu Kapu</option>
                                                                            <option  value="Naidu - Vada Balija">Naidu - Vada Balija</option>
                                                                            <option  value="Naidu - Vadugan">Naidu - Vadugan</option>
                                                                            <option  value="Naidu - Velama">Naidu - Velama</option>
                                                                            <option  value="Naidu - Yadava Naidu">Naidu - Yadava Naidu</option>
                                                                            <option  value="Naik Nayak Nayaka">Naik Nayak Nayaka</option>
                                                                            <option  value="Nair">Nair</option>
                                                                            <option  value="Nair - Adiyodi">Nair - Adiyodi</option>
                                                                            <option  value="Nair - Anthur">Nair - Anthur</option>
                                                                            <option  value="Nair - Chekkala Nair">Nair - Chekkala Nair</option>
                                                                            <option  value="Nair - Illam">Nair - Illam</option>
                                                                            <option  value="Nair - Kaimal">Nair - Kaimal</option>
                                                                            <option  value="Nair - Kartha">Nair - Kartha</option>
                                                                            <option  value="Nair - Kiryathil">Nair - Kiryathil</option>
                                                                            <option  value="Nair - Kurup">Nair - Kurup</option>
                                                                            <option  value="Nair - Maniyani">Nair - Maniyani</option>
                                                                            <option  value="Nair - Mannadiar">Nair - Mannadiar</option>
                                                                            <option  value="Nair - Marar">Nair - Marar</option>
                                                                            <option  value="Nair - Menon">Nair - Menon</option>
                                                                            <option  value="Nair - Nair All">Nair - Nair All</option>
                                                                            <option  value="Nair - Nair-Vaniya">Nair - Nair-Vaniya</option>
                                                                            <option  value="Nair - Nambiar">Nair - Nambiar</option>
                                                                            <option  value="Nair - Panicker">Nair - Panicker</option>
                                                                            <option  value="Nair - Pillai">Nair - Pillai</option>
                                                                            <option  value="Nair - Poduval">Nair - Poduval</option>
                                                                            <option  value="Nair - Thampi">Nair - Thampi</option>
                                                                            <option  value="Nair - Tharakan">Nair - Tharakan</option>
                                                                            <option  value="Nair - Unnithan">Nair - Unnithan</option>
                                                                            <option  value="Nair - Vellala Pillai">Nair - Vellala Pillai</option>
                                                                            <option  value="Nair - Veluthedathu">Nair - Veluthedathu</option>
                                                                            <option  value="Nair - Vilakkithala">Nair - Vilakkithala</option>
                                                                            <option  value="Nair Veluthedathu">Nair Veluthedathu</option>
                                                                            <option  value="Nair Vilakkithala">Nair Vilakkithala</option>
                                                                            <option  value="Namasudra/Namosudra">Namasudra/Namosudra</option>
                                                                            <option  value="Nambiar">Nambiar</option>
                                                                            <option  value="Nambisan">Nambisan</option>
                                                                            <option  value="Namboodiri">Namboodiri</option>
                                                                            <option  value="Namdev Chhipa">Namdev Chhipa</option>
                                                                            <option  value="Nandiwale">Nandiwale</option>
                                                                            <option  value="Napit">Napit</option>
                                                                            <option  value="Nath Jogi">Nath Jogi</option>
                                                                            <option  value="Nayee (Barber)">Nayee (Barber)</option>
                                                                            <option  value="Nepali">Nepali</option>
                                                                            <option  value="Nessi/Kurni">Nessi/Kurni</option>
                                                                            <option  value="Nhavi">Nhavi</option>
                                                                            <option  value="Nonia">Nonia</option>
                                                                            <option  value="OBC">OBC</option>
                                                                            <option  value="Odan">Odan</option>
                                                                            <option  value="Oraon">Oraon</option>
                                                                            <option  value="Oswal">Oswal</option>
                                                                            <option  value="Otari">Otari</option>
                                                                            <option  value="Others">Others</option>
                                                                            <option  value="Padmashali">Padmashali</option>
                                                                            <option  value="Padmashali - Devanga">Padmashali - Devanga</option>
                                                                            <option  value="Padmashali - Jaandra">Padmashali - Jaandra</option>
                                                                            <option  value="Padmashali - Kaikaala">Padmashali - Kaikaala</option>
                                                                            <option  value="Padmashali - Karakala Bhakthula">Padmashali - Karakala Bhakthula</option>
                                                                            <option  value="Padmashali - Karni Bhakthula">Padmashali - Karni Bhakthula</option>
                                                                            <option  value="Padmashali - Kurni">Padmashali - Kurni</option>
                                                                            <option  value="Padmashali - Neeli Saali">Padmashali - Neeli Saali</option>
                                                                            <option  value="Padmashali - Neesi">Padmashali - Neesi</option>
                                                                            <option  value="Padmashali - Pattusali">Padmashali - Pattusali</option>
                                                                            <option  value="Padmashali - Shettigar">Padmashali - Shettigar</option>
                                                                            <option  value="Padmashali - Swakula Saali">Padmashali - Swakula Saali</option>
                                                                            <option  value="Padmashali - Thogata Veerakshathriya">Padmashali - Thogata Veerakshathriya</option>
                                                                            <option  value="Pal">Pal</option>
                                                                            <option  value="Panan">Panan</option>
                                                                            <option  value="Panchal">Panchal</option>
                                                                            <option  value="Panchamsali">Panchamsali</option>
                                                                            <option  value="Pandaram">Pandaram</option>
                                                                            <option  value="Panicker">Panicker</option>
                                                                            <option  value="Pano">Pano</option>
                                                                            <option  value="Paravan Bhartar">Paravan Bhartar</option>
                                                                            <option  value="Parkava Kulam">Parkava Kulam</option>
                                                                            <option  value="Parvatha Rajakulam">Parvatha Rajakulam</option>
                                                                            <option  value="Pasi">Pasi</option>
                                                                            <option  value="Paswan/Dusadh">Paswan/Dusadh</option>
                                                                            <option  value="Patel">Patel</option>
                                                                            <option  value="Patel - Anjana (Chowdary) Patel">Patel - Anjana (Chowdary) Patel</option>
                                                                            <option  value="Patel - Desai">Patel - Desai</option>
                                                                            <option  value="Patel - Dodia">Patel - Dodia</option>
                                                                            <option  value="Patel - Kadava Patel">Patel - Kadava Patel</option>
                                                                            <option  value="Patel - Leva Patel">Patel - Leva Patel</option>
                                                                            <option  value="Patel - Matia Patel">Patel - Matia Patel</option>
                                                                            <option  value="Patel - Patel Desai">Patel - Patel Desai</option>
                                                                            <option  value="Patel Dodia">Patel Dodia</option>
                                                                            <option  value="Patel Kadva">Patel Kadva</option>
                                                                            <option  value="Patel Leva">Patel Leva</option>
                                                                            <option  value="Patel Leva - 27 Gam">Patel Leva - 27 Gam</option>
                                                                            <option  value="Patel Leva - Baavis Gam">Patel Leva - Baavis Gam</option>
                                                                            <option  value="Patel Leva - Chaa Gam">Patel Leva - Chaa Gam</option>
                                                                            <option  value="Patel Leva - Chovis Gam">Patel Leva - Chovis Gam</option>
                                                                            <option  value="Patel Leva - Mota Sattavi">Patel Leva - Mota Sattavi</option>
                                                                            <option  value="Patel Leva - Nani Sattavi">Patel Leva - Nani Sattavi</option>
                                                                            <option  value="Patel Leva - Panch Gam">Patel Leva - Panch Gam</option>
                                                                            <option  value="Patel Lodhi">Patel Lodhi</option>
                                                                            <option  value="Pathare Prabhu">Pathare Prabhu</option>
                                                                            <option  value="Patnaick">Patnaick</option>
                                                                            <option  value="Patra">Patra</option>
                                                                            <option  value="Perika">Perika</option>
                                                                            <option  value="Pillai">Pillai</option>
                                                                            <option  value="Pillai - Aaru Nattu Vellala">Pillai - Aaru Nattu Vellala</option>
                                                                            <option  value="Pillai - Agarmudayar/Arcot/Thuluva Vellala">Pillai - Agarmudayar/Arcot/Thuluva Vellala</option>
                                                                            <option  value="Pillai - Cherakula Vellalar">Pillai - Cherakula Vellalar</option>
                                                                            <option  value="Pillai - Desikar">Pillai - Desikar</option>
                                                                            <option  value="Pillai - Desikar Thanjavur">Pillai - Desikar Thanjavur</option>
                                                                            <option  value="Pillai - Illaththu Pillai">Pillai - Illaththu Pillai</option>
                                                                            <option  value="Pillai - Isai Vellalar">Pillai - Isai Vellalar</option>
                                                                            <option  value="Pillai - Karkathar">Pillai - Karkathar</option>
                                                                            <option  value="Pillai - Kadikal Pillai">Pillai - Kadikal Pillai</option>
                                                                            <option  value="Pillai - Nanjil">Pillai - Nanjil</option>
                                                                            <option  value="Pillai - Nanjil Mudali">Pillai - Nanjil Mudali</option>
                                                                            <option  value="Pillai - Nankudi Vellalar">Pillai - Nankudi Vellalar</option>
                                                                            <option  value="Pillai - Othuvaar">Pillai - Othuvaar</option>
                                                                            <option  value="Pillai - Pandiya Vellalar">Pillai - Pandiya Vellalar</option>
                                                                            <option  value="Pillai - Saiva Pillai Thanjavur">Pillai - Saiva Pillai Thanjavur</option>
                                                                            <option  value="Pillai - Saiva Pillai Tirunelvi">Pillai - Saiva Pillai Tirunelvi</option>
                                                                            <option  value="Pillai - Sengunthar/Kaikolar">Pillai - Sengunthar/Kaikolar</option>
                                                                            <option  value="Pillai - Sozhiya Vellalar">Pillai - Sozhiya Vellalar</option>
                                                                            <option  value="Pillai - Thondai Mandala Vellala">Pillai - Thondai Mandala Vellala</option>
                                                                            <option  value="Pillai - Veerakodi Vellala">Pillai - Veerakodi Vellala</option>
                                                                            <option  value="Pillai - Vellala Pillai">Pillai - Vellala Pillai</option>
                                                                            <option  value="Pollon Devandra Kula Vellalan">Pollon Devandra Kula Vellalan</option>
                                                                            <option  value="Ponan">Ponan</option>
                                                                            <option  value="Poosala">Poosala</option>
                                                                            <option  value="Poundra">Poundra</option>
                                                                            <option  value="Prajapati">Prajapati</option>
                                                                            <option  value="Pulaya Chruman">Pulaya Chruman</option>
                                                                            <option  value="Rabari">Rabari</option>
                                                                            <option  value="Raigar">Raigar</option>
                                                                            <option  value="Raikwar">Raikwar</option>
                                                                            <option  value="Rajaka">Rajaka</option>
                                                                            <option  value="Rajaka - Rajaka Vannar">Rajaka - Rajaka Vannar</option>
                                                                            <option  value="Rajbhar">Rajbhar</option>
                                                                            <option  value="Rajbongshi">Rajbongshi</option>
                                                                            <option  value="Rajpurohit">Rajpurohit</option>
                                                                            <option  value="Rajput">Rajput</option>
                                                                            <option  value="Rajput - Aheria Rajput">Rajput - Aheria Rajput</option>
                                                                            <option  value="Rajput - Baghel">Rajput - Baghel</option>
                                                                            <option  value="Rajput - Bais">Rajput - Bais</option>
                                                                            <option  value="Rajput - Bankawat">Rajput - Bankawat</option>
                                                                            <option  value="Rajput - Bargujar">Rajput - Bargujar</option>
                                                                            <option  value="Rajput - Bhadauria">Rajput - Bhadauria</option>
                                                                            <option  value="Rajput - Bharbhunja">Rajput - Bharbhunja</option>
                                                                            <option  value="Rajput - Bhatti">Rajput - Bhatti</option>
                                                                            <option  value="Rajput - Bhriguvansha">Rajput - Bhriguvansha</option>
                                                                            <option  value="Rajput - Bisen">Rajput - Bisen</option>
                                                                            <option  value="Rajput - Bisht">Rajput - Bisht</option>
                                                                            <option  value="Rajput - Chandel">Rajput - Chandel</option>
                                                                            <option  value="Rajput - Chandravanshi">Rajput - Chandravanshi</option>
                                                                            <option  value="Rajput - Chandrawat">Rajput - Chandrawat</option>
                                                                            <option  value="Rajput - Chauhan">Rajput - Chauhan</option>
                                                                            <option  value="Rajput - Chawda/Chavada">Rajput - Chawda/Chavada</option>
                                                                            <option  value="Rajput - Chib">Rajput - Chib</option>
                                                                            <option  value="Rajput - Chundawat">Rajput - Chundawat</option>
                                                                            <option  value="Rajput - Dhakare">Rajput - Dhakare</option>
                                                                            <option  value="Rajput - Dixit">Rajput - Dixit</option>
                                                                            <option  value="Rajput - Doad">Rajput - Doad</option>
                                                                            <option  value="Rajput - Dogra">Rajput - Dogra</option>
                                                                            <option  value="Rajput - Durgavanshi">Rajput - Durgavanshi</option>
                                                                            <option  value="Rajput - Gahlot">Rajput - Gahlot</option>
                                                                            <option  value="Rajput - Garhwal">Rajput - Garhwal</option>
                                                                            <option  value="Rajput - Gautam">Rajput - Gautam</option>
                                                                            <option  value="Rajput - Gogawat">Rajput - Gogawat</option>
                                                                            <option  value="Rajput - Gohil">Rajput - Gohil</option>
                                                                            <option  value="Rajput - Goud/Gaur">Rajput - Goud/Gaur</option>
                                                                            <option  value="Rajput - Jadeja">Rajput - Jadeja</option>
                                                                            <option  value="Rajput - Jadon">Rajput - Jadon</option>
                                                                            <option  value="Rajput - Jamwal">Rajput - Jamwal</option>
                                                                            <option  value="Rajput - Janjua">Rajput - Janjua</option>
                                                                            <option  value="Rajput - Jasrotia">Rajput - Jasrotia</option>
                                                                            <option  value="Rajput - Jaswal">Rajput - Jaswal</option>
                                                                            <option  value="Rajput - Jhala">Rajput - Jhala</option>
                                                                            <option  value="Rajput - Kachwaha">Rajput - Kachwaha</option>
                                                                            <option  value="Rajput - Kalyat">Rajput - Kalyat</option>
                                                                            <option  value="Rajput - Katoch">Rajput - Katoch</option>
                                                                            <option  value="Rajput - Kaushik">Rajput - Kaushik</option>
                                                                            <option  value="Rajput - Khadagvanshi Khagi">Rajput - Khadagvanshi Khagi</option>
                                                                            <option  value="Rajput - Khangarot">Rajput - Khangarot</option>
                                                                            <option  value="Rajput - Khati">Rajput - Khati</option>
                                                                            <option  value="Rajput - Kirar">Rajput - Kirar</option>
                                                                            <option  value="Rajput - Kumaoni">Rajput - Kumaoni</option>
                                                                            <option  value="Rajput - Kuruvanshi">Rajput - Kuruvanshi</option>
                                                                            <option  value="Rajput - Kushwaha">Rajput - Kushwaha</option>
                                                                            <option  value="Rajput - Lodhi Rajput">Rajput - Lodhi Rajput</option>
                                                                            <option  value="Rajput - Loniya Lonia Lunia">Rajput - Loniya Lonia Lunia</option>
                                                                            <option  value="Rajput - Madad">Rajput - Madad</option>
                                                                            <option  value="Rajput - Mahror">Rajput - Mahror</option>
                                                                            <option  value="Rajput - Mahthan">Rajput - Mahthan</option>
                                                                            <option  value="Rajput - Mahyavanshi">Rajput - Mahyavanshi</option>
                                                                            <option  value="Rajput - Manhas">Rajput - Manhas</option>
                                                                            <option  value="Rajput - Nagvanshi">Rajput - Nagvanshi</option>
                                                                            <option  value="Rajput - Naruka">Rajput - Naruka</option>
                                                                            <option  value="Rajput - Nathawat">Rajput - Nathawat</option>
                                                                            <option  value="Rajput - Negi">Rajput - Negi</option>
                                                                            <option  value="Rajput - Nikumbh">Rajput - Nikumbh</option>
                                                                            <option  value="Rajput - Oad Rajput">Rajput - Oad Rajput</option>
                                                                            <option  value="Rajput - Parihar">Rajput - Parihar</option>
                                                                            <option  value="Rajput - Parmar">Rajput - Parmar</option>
                                                                            <option  value="Rajput - Pratihar">Rajput - Pratihar</option>
                                                                            <option  value="Rajput - Pundir">Rajput - Pundir</option>
                                                                            <option  value="Rajput - Raghuvanshi">Rajput - Raghuvanshi</option>
                                                                            <option  value="Rajput - Rajawal">Rajput - Rajawal</option>
                                                                            <option  value="Rajput - Rajput Swarnkar">Rajput - Rajput Swarnkar</option>
                                                                            <option  value="Rajput - Rana">Rajput - Rana</option>
                                                                            <option  value="Rajput - Rao">Rajput - Rao</option>
                                                                            <option  value="Rajput - Rathore">Rajput - Rathore</option>
                                                                            <option  value="Rajput - Rawa Rajput">Rajput - Rawa Rajput</option>
                                                                            <option  value="Rajput - Rawal">Rajput - Rawal</option>
                                                                            <option  value="Rajput - Rohilla">Rajput - Rohilla</option>
                                                                            <option  value="Rajput - Sagar Rajput">Rajput - Sagar Rajput</option>
                                                                            <option  value="Rajput - Sainthwar Rajput">Rajput - Sainthwar Rajput</option>
                                                                            <option  value="Rajput - Sarangdevot">Rajput - Sarangdevot</option>
                                                                            <option  value="Rajput - Shakya">Rajput - Shakya</option>
                                                                            <option  value="Rajput - Shekhawat">Rajput - Shekhawat</option>
                                                                            <option  value="Rajput - Sikarwar">Rajput - Sikarwar</option>
                                                                            <option  value="Rajput - Singh">Rajput - Singh</option>
                                                                            <option  value="Rajput - Sisodia">Rajput - Sisodia</option>
                                                                            <option  value="Rajput - Solanki">Rajput - Solanki</option>
                                                                            <option  value="Rajput - Somvansha">Rajput - Somvansha</option>
                                                                            <option  value="Rajput - Surwar">Rajput - Surwar</option>
                                                                            <option  value="Rajput - Suryavanshi">Rajput - Suryavanshi</option>
                                                                            <option  value="Rajput - Tanwar">Rajput - Tanwar</option>
                                                                            <option  value="Rajput - Thakur">Rajput - Thakur</option>
                                                                            <option  value="Rajput - Tomar">Rajput - Tomar</option>
                                                                            <option  value="Rajput - Ujjain">Rajput - Ujjain</option>
                                                                            <option  value="Rajput - Vaishhya">Rajput - Vaishhya</option>
                                                                            <option  value="Rajput Garhwali">Rajput Garhwali</option>
                                                                            <option  value="Rajput Kumaoni">Rajput Kumaoni</option>
                                                                            <option  value="Rajput Rohella Tank">Rajput Rohella Tank</option>
                                                                            <option  value="Ramdasia">Ramdasia</option>
                                                                            <option  value="Ramgarhia">Ramgarhia</option>
                                                                            <option  value="Ramoshi Berad Bedar">Ramoshi Berad Bedar</option>
                                                                            <option  value="Ravidasia">Ravidasia</option>
                                                                            <option  value="Rawat">Rawat</option>
                                                                            <option  value="Reddy">Reddy</option>
                                                                            <option  value="Reddy - Ayodhi">Reddy - Ayodhi</option>
                                                                            <option  value="Reddy - Bhoomanchi Reddy">Reddy - Bhoomanchi Reddy</option>
                                                                            <option  value="Reddy - Chowdary">Reddy - Chowdary</option>
                                                                            <option  value="Reddy - Desuru">Reddy - Desuru</option>
                                                                            <option  value="Reddy - Gandla">Reddy - Gandla</option>
                                                                            <option  value="Reddy - Ganjam">Reddy - Ganjam</option>
                                                                            <option  value="Reddy - Gone Kapu">Reddy - Gone Kapu</option>
                                                                            <option  value="Reddy - Gudati">Reddy - Gudati</option>
                                                                            <option  value="Reddy - Kapu">Reddy - Kapu</option>
                                                                            <option  value="Reddy - Motati">Reddy - Motati</option>
                                                                            <option  value="Reddy - Palle">Reddy - Palle</option>
                                                                            <option  value="Reddy - Palnati">Reddy - Palnati</option>
                                                                            <option  value="Reddy - Patna">Reddy - Patna</option>
                                                                            <option  value="Reddy - Pedakanti">Reddy - Pedakanti</option>
                                                                            <option  value="Reddy - Poknati">Reddy - Poknati</option>
                                                                            <option  value="Reddy - Reddiar">Reddy - Reddiar</option>
                                                                            <option  value="Reddy - Sajjana">Reddy - Sajjana</option>
                                                                            <option  value="Reddy - Vanni">Reddy - Vanni</option>
                                                                            <option  value="Reddy - Velanati">Reddy - Velanati</option>
                                                                            <option  value="Relli">Relli</option>
                                                                            <option  value="Rohit Chamar">Rohit Chamar</option>
                                                                            <option  value="Ror">Ror</option>
                                                                            <option  value="Sadgope">Sadgope</option>
                                                                            <option  value="Saha">Saha</option>
                                                                            <option  value="Sahu">Sahu</option>
                                                                            <option  value="Saini">Saini</option>
                                                                            <option  value="Saliya">Saliya</option>
                                                                            <option  value="Samagar">Samagar</option>
                                                                            <option  value="Sambava">Sambava</option>
                                                                            <option  value="Santhali">Santhali</option>
                                                                            <option  value="Sargara">Sargara</option>
                                                                            <option  value="Sathwara">Sathwara</option>
                                                                            <option  value="Satnami">Satnami</option>
                                                                            <option  value="Savji">Savji</option>
                                                                            <option  value="Sawantwadi">Sawantwadi</option>
                                                                            <option  value="Scheduled Caste">Scheduled Caste</option>
                                                                            <option  value="Scheduled Tribe">Scheduled Tribe</option>
                                                                            <option  value="Senai Thalaivar">Senai Thalaivar</option>
                                                                            <option  value="Senguntha Mudaliyar">Senguntha Mudaliyar</option>
                                                                            <option  value="Settibalija">Settibalija</option>
                                                                            <option  value="Shah">Shah</option>
                                                                            <option  value="Shilpkar">Shilpkar</option>
                                                                            <option  value="Shimpi">Shimpi</option>
                                                                            <option  value="Silawat">Silawat</option>
                                                                            <option  value="Sillekyatha">Sillekyatha</option>
                                                                            <option  value="Sindhi">Sindhi</option>
                                                                            <option  value="Sindhi - Sindhi Amil">Sindhi - Sindhi Amil</option>
                                                                            <option  value="Sindhi - Sindhi Baibhand">Sindhi - Sindhi Baibhand</option>
                                                                            <option  value="Sindhi - Sindhi Bhanusali">Sindhi - Sindhi Bhanusali</option>
                                                                            <option  value="Sindhi - Sindhi Bhatia">Sindhi - Sindhi Bhatia</option>
                                                                            <option  value="Sindhi - Sindhi Chhapru">Sindhi - Sindhi Chhapru</option>
                                                                            <option  value="Sindhi - Sindhi Daru">Sindhi - Sindhi Daru</option>
                                                                            <option  value="Sindhi - Sindhi Hydrabadi">Sindhi - Sindhi Hydrabadi</option>
                                                                            <option  value="Sindhi - Sindhi Larai">Sindhi - Sindhi Larai</option>
                                                                            <option  value="Sindhi - Sindhi Larkan">Sindhi - Sindhi Larkan</option>
                                                                            <option  value="Sindhi - Sindhi Larkana">Sindhi - Sindhi Larkana</option>
                                                                            <option  value="Sindhi - Sindhi Lohana">Sindhi - Sindhi Lohana</option>
                                                                            <option  value="Sindhi - Sindhi Rohiri">Sindhi - Sindhi Rohiri</option>
                                                                            <option  value="Sindhi - Sindhi Sahiti">Sindhi - Sindhi Sahiti</option>
                                                                            <option  value="Sindhi - Sindhi Sakkhar">Sindhi - Sindhi Sakkhar</option>
                                                                            <option  value="Sindhi - Sindhi Sehwani">Sindhi - Sindhi Sehwani</option>
                                                                            <option  value="Sindhi - Sindhi Shikarpuri">Sindhi - Sindhi Shikarpuri</option>
                                                                            <option  value="Sindhi - Sindhi Thatai">Sindhi - Sindhi Thatai</option>
                                                                            <option  value="Siyal">Siyal</option>
                                                                            <option  value="SKP">SKP</option>
                                                                            <option  value="Somvanshi">Somvanshi</option>
                                                                            <option  value="Somvanshi Kayastha Prabhu">Somvanshi Kayastha Prabhu</option>
                                                                            <option  value="Sonar/Sunar">Sonar/Sunar</option>
                                                                            <option  value="Sonkar">Sonkar</option>
                                                                            <option  value="Sourashtra">Sourashtra</option>
                                                                            <option  value="Sozhiya Vellalar">Sozhiya Vellalar</option>
                                                                            <option  value="Sirsayani">Sirsayani</option>
                                                                            <option  value="SSK">SSK</option>
                                                                            <option  value="Subarna Banik">Subarna Banik</option>
                                                                            <option  value="Sudi Suri Sundhi Shaundik">Sudi Suri Sundhi Shaundik</option>
                                                                            <option  value="Sugali (Naika)">Sugali (Naika)</option>
                                                                            <option  value="Sutar">Sutar</option>
                                                                            <option  value="Swarnkar">Swarnkar</option>
                                                                            <option  value="Tamboli">Tamboli</option>
                                                                            <option  value="Tammali">Tammali</option>
                                                                            <option  value="Tanti">Tanti</option>
                                                                            <option  value="Tantuway">Tantuway</option>
                                                                            <option  value="Telaga">Telaga</option>
                                                                            <option  value="Teli">Teli</option>
                                                                            <option  value="Thachar">Thachar</option>
                                                                            <option  value="Thakkar">Thakkar</option>
                                                                            <option  value="Thandan">Thandan</option>
                                                                            <option  value="Tharakan">Tharakan</option>
                                                                            <option  value="Thevar Mukkulathor">Thevar Mukkulathor</option>
                                                                            <option  value="Thevar Mukkulathor - Agamudayar">Thevar Mukkulathor - Agamudayar</option>
                                                                            <option  value="Thevar Mukkulathor - Ambalakarar">Thevar Mukkulathor - Ambalakarar</option>
                                                                            <option  value="Thevar Mukkulathor - Appanad Kondayamkottai Maravar">Thevar Mukkulathor - Appanad Kondayamkottai Maravar</option>
                                                                            <option  value="Thevar Mukkulathor - Easanattu Kallar">Thevar Mukkulathor - Easanattu Kallar</option>
                                                                            <option  value="Thevar Mukkulathor - Kallar">Thevar Mukkulathor - Kallar</option>
                                                                            <option  value="Thevar Mukkulathor - Maniyakarar">Thevar Mukkulathor - Maniyakarar</option>
                                                                            <option  value="Thevar Mukkulathor - Maravar">Thevar Mukkulathor - Maravar</option>
                                                                            <option  value="Thevar Mukkulathor - Piramalai Kallar">Thevar Mukkulathor - Piramalai Kallar</option>
                                                                            <option  value="Thevar Mukkulathor - Rajakula Agamudayar">Thevar Mukkulathor - Rajakula Agamudayar</option>
                                                                            <option  value="Thevar Mukkulathor - Sembanad Maravar">Thevar Mukkulathor - Sembanad Maravar</option>
                                                                            <option  value="Thevar Mukkulathor - Servai">Thevar Mukkulathor - Servai</option>
                                                                            <option  value="Thevar Mukkulathor - Thanjavur Kallar">Thevar Mukkulathor - Thanjavur Kallar</option>
                                                                            <option  value="Thevar Mukkulathor - Vallambar">Thevar Mukkulathor - Vallambar</option>
                                                                            <option  value="Thigala">Thigala</option>
                                                                            <option  value="Thiyya">Thiyya</option>
                                                                            <option  value="Thiyya - Ezhava">Thiyya - Ezhava</option>
                                                                            <option  value="Thiyya - Kavuthiya">Thiyya - Kavuthiya</option>
                                                                            <option  value="Thiyya - Thiyya Thandan">Thiyya - Thiyya Thandan</option>
                                                                            <option  value="Tili">Tili</option>
                                                                            <option  value="Togata">Togata</option>
                                                                            <option  value="Tonk Kshatriya">Tonk Kshatriya</option>
                                                                            <option  value="Tribe">Tribe</option>
                                                                            <option  value="Turi">Turi</option>
                                                                            <option  value="Turupu Kapu">Turupu Kapu</option>
                                                                            <option  value="Uppara">Uppara</option>
                                                                            <option  value="Vadar">Vadar</option>
                                                                            <option  value="Vaddera">Vaddera</option>
                                                                            <option  value="Vaduka">Vaduka</option>
                                                                            <option  value="Vaidiki Velanadu">Vaidiki Velanadu</option>
                                                                            <option  value="Vaish">Vaish</option>
                                                                            <option  value="Vaish - Vaish Dhaneshawat">Vaish - Vaish Dhaneshawat</option>
                                                                            <option  value="Vaishnav">Vaishnav</option>
                                                                            <option  value="Vaishnav - Bairagi Swami">Vaishnav - Bairagi Swami</option>
                                                                            <option  value="Vaishnav - Vaishnav Bhatia">Vaishnav - Vaishnav Bhatia</option>
                                                                            <option  value="Vaishnav - Vaishnav Dishaval">Vaishnav - Vaishnav Dishaval</option>
                                                                            <option  value="Vaishnav - Vaishnav Kapol">Vaishnav - Vaishnav Kapol</option>
                                                                            <option  value="Vaishnav - Vaishnav Khadyata">Vaishnav - Vaishnav Khadyata</option>
                                                                            <option  value="Vaishnav - Vaishnav Lad">Vaishnav - Vaishnav Lad</option>
                                                                            <option  value="Vaishnav - Vaishnav Modh">Vaishnav - Vaishnav Modh</option>
                                                                            <option  value="Vaishnav - Vaishnav Porvad">Vaishnav - Vaishnav Porvad</option>
                                                                            <option  value="Vaishnav - Vaishnav Shrimali">Vaishnav - Vaishnav Shrimali</option>
                                                                            <option  value="Vaishnav - Vaishnav Sorathaiya">Vaishnav - Vaishnav Sorathaiya</option>
                                                                            <option  value="Vaishnav - Vaishnav Vania">Vaishnav - Vaishnav Vania</option>
                                                                            <option  value="Vaishnav Vanik">Vaishnav Vanik</option>
                                                                            <option  value="Vaishnava">Vaishnava</option>
                                                                            <option  value="Vaishnava - Brahmin Sri Vaishnava">Vaishnava - Brahmin Sri Vaishnava</option>
                                                                            <option  value="Vaishnava - Chhatada Sri Vaishnava">Vaishnava - Chhatada Sri Vaishnava</option>
                                                                            <option  value="Vaishnava - Sri Vaishnava">Vaishnava - Sri Vaishnava</option>
                                                                            <option  value="Vaishya">Vaishya</option>
                                                                            <option  value="Vaishya - Mahuri">Vaishya - Mahuri</option>
                                                                            <option  value="Vaishya - Mathur Vaishya">Vaishya - Mathur Vaishya</option>
                                                                            <option  value="Vaishya Vani">Vaishya Vani</option>
                                                                            <option  value="Vallala">Vallala</option>
                                                                            <option  value="Valluvar">Valluvar</option>
                                                                            <option  value="Valmiki">Valmiki</option>
                                                                            <option  value="Valuvan">Valuvan</option>
                                                                            <option  value="Vania">Vania</option>
                                                                            <option  value="Vaniya">Vaniya</option>
                                                                            <option  value="Vaniya - Nair-Vaniya">Vaniya - Nair-Vaniya</option>
                                                                            <option  value="Vaniya - Vaniya Chettiar">Vaniya - Vaniya Chettiar</option>
                                                                            <option  value="Vanjara">Vanjara</option>
                                                                            <option  value="Vanjari">Vanjari</option>
                                                                            <option  value="Vankar">Vankar</option>
                                                                            <option  value="Vannar">Vannar</option>
                                                                            <option  value="Vannia Kula Kshatriyar">Vannia Kula Kshatriyar</option>
                                                                            <option  value="Vannia Kula Kshatriyar - Arasu">Vannia Kula Kshatriyar - Arasu</option>
                                                                            <option  value="Vannia Kula Kshatriyar - Gounder">Vannia Kula Kshatriyar - Gounder</option>
                                                                            <option  value="Vannia Kula Kshatriyar - Naicker">Vannia Kula Kshatriyar - Naicker</option>
                                                                            <option  value="Vannia Kula Kshatriyar - Padayachi">Vannia Kula Kshatriyar - Padayachi</option>
                                                                            <option  value="Vannia Kula Kshatriyar - Palli">Vannia Kula Kshatriyar - Palli</option>
                                                                            <option  value="Vannia Kula Kshatriyar - Pandal">Vannia Kula Kshatriyar - Pandal</option>
                                                                            <option  value="Vannia Kula Kshatriyar - Urs">Vannia Kula Kshatriyar - Urs</option>
                                                                            <option  value="Vannia Kula Kshatriyar - Vannia Reddiar">Vannia Kula Kshatriyar - Vannia Reddiar</option>
                                                                            <option  value="Vannia Kula Kshatriyar - Vanniyar">Vannia Kula Kshatriyar - Vanniyar</option>
                                                                            <option  value="Vanniyar">Vanniyar</option>
                                                                            <option  value="Variar">Variar</option>
                                                                            <option  value="Varshney">Varshney</option>
                                                                            <option  value="Veershaiva Veera Saivam">Veershaiva Veera Saivam</option>
                                                                            <option  value="Velaan">Velaan</option>
                                                                            <option  value="Velama">Velama</option>
                                                                            <option  value="Velama - Adivelama">Velama - Adivelama</option>
                                                                            <option  value="Velama - Koppula">Velama - Koppula</option>
                                                                            <option  value="Velama - Padmanayaka">Velama - Padmanayaka</option>
                                                                            <option  value="Velama - Polinati">Velama - Polinati</option>
                                                                            <option  value="Velama - Yellapa">Velama - Yellapa</option>
                                                                            <option  value="Velan">Velan</option>
                                                                            <option  value="Vellalar">Vellalar</option>
                                                                            <option  value="Vellalar - Aaru Nattu Vellala">Vellalar - Aaru Nattu Vellala</option>
                                                                            <option  value="Vellalar - Agamudayar/Arcot/Thuluva Vellala">Vellalar - Agamudayar/Arcot/Thuluva Vellala</option>
                                                                            <option  value="Vellalar - Cherakula Vellalar">Vellalar - Cherakula Vellalar</option>
                                                                            <option  value="Vellalar - Desikar">Vellalar - Desikar</option>
                                                                            <option  value="Vellalar - Devendra Kula Vellalar">Vellalar - Devendra Kula Vellalar</option>
                                                                            <option  value="Vellalar - Illaththu Pillai">Vellalar - Illaththu Pillai</option>
                                                                            <option  value="Vellalar - Isai Vellalar">Vellalar - Isai Vellalar</option>
                                                                            <option  value="Vellalar - Karkathar">Vellalar - Karkathar</option>
                                                                            <option  value="Vellalar - Kodikal Pillai">Vellalar - Kodikal Pillai</option>
                                                                            <option  value="Vellalar - Kongu Vellala Gounder">Vellalar - Kongu Vellala Gounder</option>
                                                                            <option  value="Vellalar - Nanjil Mudali">Vellalar - Nanjil Mudali</option>
                                                                            <option  value="Vellalar - Nanjil Nattu Vellalar">Vellalar - Nanjil Nattu Vellalar</option>
                                                                            <option  value="Vellalar - Nanjil Vellalar">Vellalar - Nanjil Vellalar</option>
                                                                            <option  value="Vellalar - Nankudi Vellalar">Vellalar - Nankudi Vellalar</option>
                                                                            <option  value="Vellalar - Othuvaar">Vellalar - Othuvaar</option>
                                                                            <option  value="Vellalar - Pandiya Vellalar">Vellalar - Pandiya Vellalar</option>
                                                                            <option  value="Vellalar - Saiva Pillai Thanjavur">Vellalar - Saiva Pillai Thanjavur</option>
                                                                            <option  value="Vellalar - Saiva Pillai Tirunelveli">Vellalar - Saiva Pillai Tirunelveli</option>
                                                                            <option  value="Vellalar - Saiva Vellalar">Vellalar - Saiva Vellalar</option>
                                                                            <option  value="Vellalar - Sengunthar/Kaikolar">Vellalar - Sengunthar/Kaikolar</option>
                                                                            <option  value="Vellalar - Sozhiya Vellalar">Vellalar - Sozhiya Vellalar</option>
                                                                            <option  value="Vellalar - Thondai Mandala Vellala">Vellalar - Thondai Mandala Vellala</option>
                                                                            <option  value="Vellalar - Veerakodi">Vellalar - Veerakodi</option>
                                                                            <option  value="Vellalar - Vellalar All">Vellalar - Vellalar All</option>
                                                                            <option  value="Vettuva Gounder">Vettuva Gounder</option>
                                                                            <option  value="Vettuvan">Vettuvan</option>
                                                                            <option  value="Vishwakarma">Vishwakarma</option>
                                                                            <option  value="Vishwakarma - Black Smith">Vishwakarma - Black Smith</option>
                                                                            <option  value="Vishwakarma - Carpentry (Vadrangi, Vadla)">Vishwakarma - Carpentry (Vadrangi, Vadla)</option>
                                                                            <option  value="Vishwakarma - Goldsmiths">Vishwakarma - Goldsmiths</option>
                                                                            <option  value="Vishwakarma - Sculptor (Shilpi)">Vishwakarma - Sculptor (Shilpi)</option>
                                                                            <option  value="Vokkaliga">Vokkaliga</option>
                                                                            <option  value="Vysya">Vysya</option>
                                                                            <option  value="Wani">Wani</option>
                                                                            <option  value="Yadav/Yadava">Yadav/Yadava</option>
                                                                            <option  value="Yadav/Yadava - Aheer/Ahir">Yadav/Yadava - Aheer/Ahir</option>
                                                                            <option  value="Yadav/Yadava - Ala Golla">Yadav/Yadava - Ala Golla</option>
                                                                            <option  value="Yadav/Yadava - Daddi">Yadav/Yadava - Daddi</option>
                                                                            <option  value="Yadav/Yadava - Das">Yadav/Yadava - Das</option>
                                                                            <option  value="Yadav/Yadava - Dhador">Yadav/Yadava - Dhador</option>
                                                                            <option  value="Yadav/Yadava - Erragola">Yadav/Yadava - Erragola</option>
                                                                            <option  value="Yadav/Yadava - Gadri/Gadariya">Yadav/Yadava - Gadri/Gadariya</option>
                                                                            <option  value="Yadav/Yadava - Gauda">Yadav/Yadava - Gauda</option>
                                                                            <option  value="Yadav/Yadava - Gawli">Yadav/Yadava - Gawli</option>
                                                                            <option  value="Yadav/Yadava - Goal/Gola/Golla">Yadav/Yadava - Goal/Gola/Golla</option>
                                                                            <option  value="Yadav/Yadava - Gop/Gopal/Gopala">Yadav/Yadava - Gop/Gopal/Gopala</option>
                                                                            <option  value="Yadav/Yadava - Goriya">Yadav/Yadava - Goriya</option>
                                                                            <option  value="Yadav/Yadava - Gwala">Yadav/Yadava - Gwala</option>
                                                                            <option  value="Yadav/Yadava - Gwalvanshi">Yadav/Yadava - Gwalvanshi</option>
                                                                            <option  value="Yadav/Yadava - Jadav">Yadav/Yadava - Jadav</option>
                                                                            <option  value="Yadav/Yadava - Kohar">Yadav/Yadava - Kohar</option>
                                                                            <option  value="Yadav/Yadava - Konar">Yadav/Yadava - Konar</option>
                                                                            <option  value="Yadav/Yadava - Korna">Yadav/Yadava - Korna</option>
                                                                            <option  value="Yadav/Yadava - Krishnauth">Yadav/Yadava - Krishnauth</option>
                                                                            <option  value="Yadav/Yadava - Kurudas Gollas">Yadav/Yadava - Kurudas Gollas</option>
                                                                            <option  value="Yadav/Yadava - Kuruma">Yadav/Yadava - Kuruma</option>
                                                                            <option  value="Yadav/Yadava - Mandal">Yadav/Yadava - Mandal</option>
                                                                            <option  value="Yadav/Yadava - Manjrauth">Yadav/Yadava - Manjrauth</option>
                                                                            <option  value="Yadav/Yadava - Nandvanshi">Yadav/Yadava - Nandvanshi</option>
                                                                            <option  value="Yadav/Yadava - Pakanati">Yadav/Yadava - Pakanati</option>
                                                                            <option  value="Yadav/Yadava - Puja">Yadav/Yadava - Puja</option>
                                                                            <option  value="Yadav/Yadava - Raut">Yadav/Yadava - Raut</option>
                                                                            <option  value="Yadav/Yadava - Suryavanshi">Yadav/Yadava - Suryavanshi</option>
                                                                            <option  value="Yadav/Yadava - Thethwar">Yadav/Yadava - Thethwar</option>
                                                                            <option  value="Yadav/Yadava - Yadav Golla">Yadav/Yadava - Yadav Golla</option>
                                                                            <option  value="Yadav/Yadava - Yaduvanshi">Yadav/Yadava - Yaduvanshi</option>
                                                                            <option  value="Yellapu">Yellapu</option>
                                                                            <option  value="Ansari (Shia)">Ansari (Shia)</option>
                                                                            <option  value="Arain (Shia)">Arain (Shia)</option>
                                                                            <option  value="Awan (Shia)">Awan (Shia)</option>
                                                                            <option  value="Barhai (Shia)">Barhai (Shia)</option>
                                                                            <option  value="Bohra (Shia)">Bohra (Shia)</option>
                                                                            <option  value="Chikwa (Shia)">Chikwa (Shia)</option>
                                                                            <option  value="Dekkani (Shia)">Dekkani (Shia)</option>
                                                                            <option  value="Dhunia (Shia)">Dhunia (Shia)</option>
                                                                            <option  value="Dudekula (Shia)">Dudekula (Shia)</option>
                                                                            <option  value="Hajjam (Shia)">Hajjam (Shia)</option>
                                                                            <option  value="Hanafi (Shia)">Hanafi (Shia)</option>
                                                                            <option  value="Jat (Shia)">Jat (Shia)</option>
                                                                            <option  value="Kabaria (Shia)">Kabaria (Shia)</option>
                                                                            <option  value="Khoja (Shia)">Khoja (Shia)</option>
                                                                            <option  value="Kumhar (Shia)">Kumhar (Shia)</option>
                                                                            <option  value="Lebbai (Shia)">Lebbai (Shia)</option>
                                                                            <option  value="Malik (Shia)">Malik (Shia)</option>
                                                                            <option  value="Manihar (Shia)">Manihar (Shia)</option>
                                                                            <option  value="Mapila (Shia)">Mapila (Shia)</option>
                                                                            <option  value="Maraicar (Shia)">Maraicar (Shia)</option>
                                                                            <option  value="Memon (Shia)">Memon (Shia)</option>
                                                                            <option  value="Mughal (Shia)">Mughal (Shia)</option>
                                                                            <option  value="Other (Shia)">Other (Shia)</option>
                                                                            <option  value="Pathan (Shia)">Pathan (Shia)</option>
                                                                            <option  value="Qureshi (Shia)">Qureshi (Shia)</option>
                                                                            <option  value="Rajput (Shia)">Rajput (Shia)</option>
                                                                            <option  value="Sheikh (Shia)">Sheikh (Shia)</option>
                                                                            <option  value="Syed (Shia)">Syed (Shia)</option>
                                                                            <option  value="Teli (Shia)">Teli (Shia)</option>
                                                                            <option  value="Ansari (Sunni)">Ansari (Sunni)</option>
                                                                            <option  value="Arain (Sunni)">Arain (Sunni)</option>
                                                                            <option  value="Awan (Sunni)">Awan (Sunni)</option>
                                                                            <option  value="Barhai (Sunni)">Barhai (Sunni)</option>
                                                                            <option  value="Bohra (Sunni)">Bohra (Sunni)</option>
                                                                            <option  value="Chikwa (Sunni)">Chikwa (Sunni)</option>
                                                                            <option  value="Dekkani (Sunni)">Dekkani (Sunni)</option>
                                                                            <option  value="Dhunia (Sunni)">Dhunia (Sunni)</option>
                                                                            <option  value="Dudekula (Sunni)">Dudekula (Sunni)</option>
                                                                            <option  value="Hajjam (Sunni)">Hajjam (Sunni)</option>
                                                                            <option  value="Hanafi (Sunni)">Hanafi (Sunni)</option>
                                                                            <option  value="Jat (Sunni)">Jat (Sunni)</option>
                                                                            <option  value="Kabaria (Sunni)">Kabaria (Sunni)</option>
                                                                            <option  value="Khoja (Sunni)">Khoja (Sunni)</option>
                                                                            <option  value="Kumhar (Sunni)">Kumhar (Sunni)</option>
                                                                            <option  value="Lebbai (Sunni)">Lebbai (Sunni)</option>
                                                                            <option  value="Malik (Sunni)">Malik (Sunni)</option>
                                                                            <option  value="Manihar (Sunni)">Manihar (Sunni)</option>
                                                                            <option  value="Mapila (Sunni)">Mapila (Sunni)</option>
                                                                            <option  value="Maraicar (Sunni)">Maraicar (Sunni)</option>
                                                                            <option  value="Memon (Sunni)">Memon (Sunni)</option>
                                                                            <option  value="Mughal (Sunni)">Mughal (Sunni)</option>
                                                                            <option  value="Other (Sunni)">Other (Sunni)</option>
                                                                            <option  value="Pathan (Sunni)">Pathan (Sunni)</option>
                                                                            <option  value="Qureshi (Sunni)">Qureshi (Sunni)</option>
                                                                            <option  value="Rajput (Sunni)">Rajput (Sunni)</option>
                                                                            <option  value="Sheikh (Sunni)">Sheikh (Sunni)</option>
                                                                            <option  value="Syed (Sunni)">Syed (Sunni)</option>
                                                                            <option  value="Teli (Sunni)">Teli (Sunni)</option>
                                                                            <option  value="Others">Others</option>
                                                                            <option  value="Arora">Arora</option>
                                                                            <option  value="Bhatia">Bhatia</option>
                                                                            <option  value="Gursikh">Gursikh</option>
                                                                            <option  value="Jat">Jat</option>
                                                                            <option  value="Jat - Achara">Jat - Achara</option>
                                                                            <option  value="Jat - Bhakar">Jat - Bhakar</option>
                                                                            <option  value="Jat - Dhatarwal">Jat - Dhatarwal</option>
                                                                            <option  value="Jat - Janu">Jat - Janu</option>
                                                                            <option  value="Jat - Kuntal">Jat - Kuntal</option>
                                                                            <option  value="Jat - Poria">Jat - Poria</option>
                                                                            <option  value="Jat - Sheokhand">Jat - Sheokhand</option>
                                                                            <option  value="Jat - Tangar">Jat - Tangar</option>
                                                                            <option  value="Kamboj">Kamboj</option>
                                                                            <option  value="Kesadhari">Kesadhari</option>
                                                                            <option  value="Khashap Rajpoot">Khashap Rajpoot</option>
                                                                            <option  value="Khatri">Khatri</option>
                                                                            <option  value="Khatri - Batta">Khatri - Batta</option>
                                                                            <option  value="Khatri - Bindra">Khatri - Bindra</option>
                                                                            <option  value="Khatri - Dhingara">Khatri - Dhingara</option>
                                                                            <option  value="Khatri - Mehra/Malhotra">Khatri - Mehra/Malhotra</option>
                                                                            <option  value="Labana">Labana</option>
                                                                            <option  value="Mazbhi">Mazbhi</option>
                                                                            <option  value="Nai">Nai</option>
                                                                            <option  value="Others">Others</option>
                                                                            <option  value="Prajapati">Prajapati</option>
                                                                            <option  value="Rai Sikh">Rai Sikh</option>
                                                                            <option  value="Rajput">Rajput</option>
                                                                            <option  value="Rajput - Kalyanot">Rajput - Kalyanot</option>
                                                                            <option  value="Rajput - Karadiya/Nadoda">Rajput - Karadiya/Nadoda</option>
                                                                            <option  value="Rajput - Mair Rajput Swarnkar">Rajput - Mair Rajput Swarnkar</option>
                                                                            <option  value="Rajput - Pathania">Rajput - Pathania</option>
                                                                            <option  value="Rajput - Rawat">Rajput - Rawat</option>
                                                                            <option  value="Rajput - Sengar">Rajput - Sengar</option>
                                                                            <option  value="Rajput - Verma">Rajput - Verma</option>
                                                                            <option  value="Ramdasia">Ramdasia</option>
                                                                            <option  value="Ramgarhia">Ramgarhia</option>
                                                                            <option  value="Ravidasia">Ravidasia</option>
                                                                            <option  value="Saini">Saini</option>
                                                                            <option  value="Scheduled Caste">Scheduled Caste</option>
                                                                            <option  value="Tonk Kshatriya">Tonk Kshatriya</option>
                                                                            <option  value="Anglo Indian">Anglo Indian</option>
                                                                            <option  value="Born Again">Born Again</option>
                                                                            <option  value="Brethren">Brethren</option>
                                                                            <option  value="Catholic">Catholic</option>
                                                                            <option  value="Catholic - Knanaya">Catholic - Knanaya</option>
                                                                            <option  value="Catholic - Latin">Catholic - Latin</option>
                                                                            <option  value="Catholic - Malankara">Catholic - Malankara</option>
                                                                            <option  value="Catholic - Roman">Catholic - Roman</option>
                                                                            <option  value="Catholic - Syrian">Catholic - Syrian</option>
                                                                            <option  value="CMS">CMS</option>
                                                                            <option  value="CSI">CSI</option>
                                                                            <option  value="Evangelical">Evangelical</option>
                                                                            <option  value="Indian Orthodox">Indian Orthodox</option>
                                                                            <option  value="Jacobite">Jacobite</option>
                                                                            <option  value="Jacobite - Knanaya">Jacobite - Knanaya</option>
                                                                            <option  value="Jacobite - Syrian">Jacobite - Syrian</option>
                                                                            <option  value="Kharvi">Kharvi</option>
                                                                            <option  value="Knanaya">Knanaya</option>
                                                                            <option  value="Mangalorean">Mangalorean</option>
                                                                            <option  value="Manglorean">Manglorean</option>
                                                                            <option  value="Marthomite">Marthomite</option>
                                                                            <option  value="Nadar">Nadar</option>
                                                                            <option  value="Others">Others</option>
                                                                            <option  value="Pentecost">Pentecost</option>
                                                                            <option  value="Protestant">Protestant</option>
                                                                            <option  value="Syrian">Syrian</option>
                                                                            <option  value="Syrian - Malabar">Syrian - Malabar</option>
                                                                            <option  value="Syrian - Orthodox">Syrian - Orthodox</option>
                                                                            <option  value="Syro-Malabar">Syro-Malabar</option>
                                                                            <option  value="Digamber">Digamber</option>
                                                                            <option  value="Digamber - Agarwal">Digamber - Agarwal</option>
                                                                            <option  value="Digamber - Bania">Digamber - Bania</option>
                                                                            <option  value="Digamber - Intercaste">Digamber - Intercaste</option>
                                                                            <option  value="Digamber - Jaiswal">Digamber - Jaiswal</option>
                                                                            <option  value="Digamber - Khandelwal">Digamber - Khandelwal</option>
                                                                            <option  value="Digamber - Kutchi">Digamber - Kutchi</option>
                                                                            <option  value="Digamber - KVO">Digamber - KVO</option>
                                                                            <option  value="Digamber - Oswal">Digamber - Oswal</option>
                                                                            <option  value="Digamber - Others">Digamber - Others</option>
                                                                            <option  value="Digamber - Porwal">Digamber - Porwal</option>
                                                                            <option  value="Digamber - Vaishta">Digamber - Vaishta</option>
                                                                            <option  value="Jain">Jain</option>
                                                                            <option  value="Others">Others</option>
                                                                            <option  value="Shwetamber">Shwetamber</option>
                                                                            <option  value="Shwetamber - Agarwal">Shwetamber - Agarwal</option>
                                                                            <option  value="Shwetamber - Bania">Shwetamber - Bania</option>
                                                                            <option  value="Shwetamber - Intercaste">Shwetamber - Intercaste</option>
                                                                            <option  value="Shwetamber - Jaiswal">Shwetamber - Jaiswal</option>
                                                                            <option  value="Shwetamber - Khandelwal">Shwetamber - Khandelwal</option>
                                                                            <option  value="Shwetamber - Kutchi">Shwetamber - Kutchi</option>
                                                                            <option  value="Shwetamber - KVO">Shwetamber - KVO</option>
                                                                            <option  value="Shwetamber - Oswal">Shwetamber - Oswal</option>
                                                                            <option  value="Shwetamber - Others">Shwetamber - Others</option>
                                                                            <option  value="Shwetamber - Porwal">Shwetamber - Porwal</option>
                                                                            <option  value="Shwetamber - Vaishta">Shwetamber - Vaishta</option>
                                                                        </select>
                                </div>
                            </div>
                            <!-- END -->
                            <!-- START -->
                            <div class="filt-com lhs-cate">
                                <h4><i><span class="material-symbols-outlined">error</span></i>Dosh/Doshm</h4>
                                <div class="form-group">
                                    <select class="chosen-select" name="manglik">
                                        <option value="">Select</option>
                                        <option  value="Yes">Yes</option>
                                        <option  value="No">No</option>
                                        <option  value="Dont Know">Dont Know</option>
                                    </select>
                                </div>
                            </div>
                            <!-- END -->
                            <!-- START -->
                            <div class="filt-com lhs-cate">
                                <h4><i><span class="material-symbols-outlined">school</span></i>Highest Education </h4>
                                <div class="form-group">
                                                                        <select class="chosen-select" name="education[]" multiple>
                                        <option value="">Select</option>
                                                                                <option  value="BE/B.Tech">BE/B.Tech</option>
                                                                                <option  value="ME/M.Tech">ME/M.Tech</option>
                                                                                <option  value="M.S Engineering">M.S Engineering</option>
                                                                                <option  value="B.Eng (Hons)">B.Eng (Hons)</option>
                                                                                <option  value="M.Eng (Hons)">M.Eng (Hons)</option>
                                                                                <option  value="Engineering Diploma">Engineering Diploma</option>
                                                                                <option  value="AE">AE</option>
                                                                                <option  value="AET">AET</option>
                                                                                <option  value="B.A">B.A</option>
                                                                                <option  value="B.Ed">B.Ed</option>
                                                                                <option  value="BJMC">BJMC</option>
                                                                                <option  value="BFA">BFA</option>
                                                                                <option  value="B.Arch">B.Arch</option>
                                                                                <option  value="B.Des">B.Des</option>
                                                                                <option  value="BMM">BMM</option>
                                                                                <option  value="MFA">MFA</option>
                                                                                <option  value="M.Ed">M.Ed</option>
                                                                                <option  value="M.A">M.A</option>
                                                                                <option  value="MSW">MSW</option>
                                                                                <option  value="MJMC">MJMC</option>
                                                                                <option  value="M.Arch">M.Arch</option>
                                                                                <option  value="M.Des">M.Des</option>
                                                                                <option  value="B.A (Hons)">B.A (Hons)</option>
                                                                                <option  value="B.Arch (Hons)">B.Arch (Hons)</option>
                                                                                <option  value="DFA">DFA</option>
                                                                                <option  value="D.Ed">D.Ed</option>
                                                                                <option  value="D.Arch">D.Arch</option>
                                                                                <option  value="AA">AA</option>
                                                                                <option  value="AFA">AFA</option>
                                                                                <option  value="B.Com">B.Com</option>
                                                                                <option  value="CA/CPA">CA/CPA</option>
                                                                                <option  value="CFA">CFA</option>
                                                                                <option  value="CS">CS</option>
                                                                                <option  value="BFin">BFin</option>
                                                                                <option  value="M.Com">M.Com</option>
                                                                                <option  value="B.Com (Hons)">B.Com (Hons)</option>
                                                                                <option  value="M.Com (Hons)">M.Com (Hons)</option>
                                                                                <option  value="PGD Finance">PGD Finance</option>
                                                                                <option  value="BCA">BCA</option>
                                                                                <option  value="BCS">BCS</option>
                                                                                <option  value="B.IT">B.IT</option>
                                                                                <option  value="BA Computer Science">BA Computer Science</option>
                                                                                <option  value="MCA">MCA</option>
                                                                                <option  value="PGDCA">PGDCA</option>
                                                                                <option  value="IT Diploma">IT Diploma</option>
                                                                                <option  value="ADIT">ADIT</option>
                                                                                <option  value="B.Sc">B.Sc</option>
                                                                                <option  value="M.Sc">M.Sc</option>
                                                                                <option  value="B.Sc (Hons)">B.Sc (Hons)</option>
                                                                                <option  value="DipSc">DipSc</option>
                                                                                <option  value="AS">AS</option>
                                                                                <option  value="AAS">AAS</option>
                                                                                <option  value="MBBS">MBBS</option>
                                                                                <option  value="BDS">BDS</option>
                                                                                <option  value="BPT">BPT</option>
                                                                                <option  value="BAMS">BAMS</option>
                                                                                <option  value="BHMS">BHMS</option>
                                                                                <option  value="B.Pharma">B.Pharma</option>
                                                                                <option  value="BVSc">BVSc</option>
                                                                                <option  value="BNS/BScN">BNS/BScN</option>
                                                                                <option  value="MDS">MDS</option>
                                                                                <option  value="MCh">MCh</option>
                                                                                <option  value="M.D">M.D</option>
                                                                                <option  value="M.S Medicine">M.S Medicine</option>
                                                                                <option  value="MPT">MPT</option>
                                                                                <option  value="DM">DM</option>
                                                                                <option  value="M.Pharma">M.Pharma</option>
                                                                                <option  value="MVsc">MVsc</option>
                                                                                <option  value="Mmed">Mmed</option>
                                                                                <option  value="PGD Medicine">PGD Medicine</option>
                                                                                <option  value="AND">AND</option>
                                                                                <option  value="BBA">BBA</option>
                                                                                <option  value="MBA">MBA</option>
                                                                                <option  value="BHM">BHM</option>
                                                                                <option  value="BBM">BBM</option>
                                                                                <option  value="PGDM">PGDM</option>
                                                                                <option  value="ABA">ABA</option>
                                                                                <option  value="ADBus">ADBus</option>
                                                                                <option  value="BL/LLB">BL/LLB</option>
                                                                                <option  value="ML/LLM">ML/LLM</option>
                                                                                <option  value="LLB (Hons)">LLB (Hons)</option>
                                                                                <option  value="ALA">ALA</option>
                                                                                <option  value="Ph.D">Ph.D</option>
                                                                                <option  value="M.Phil">M.Phil</option>
                                                                                <option  value="Bachelor">Bachelor</option>
                                                                                <option  value="Master">Master</option>
                                                                                <option  value="Diploma">Diploma</option>
                                                                                <option  value="Honours">Honours</option>
                                                                                <option  value="Doctorate">Doctorate</option>
                                                                                <option  value="Associate">Associate</option>
                                                                                <option  value="Others">Others</option>
                                                                                <option  value="High School">High School</option>
                                                                                <option  value="Less then High School">Less then High School</option>
                                                                            </select>
                                </div>
                            </div>
                            <!-- END -->
                            <!-- START -->
                            <div class="filt-com lhs-cate">
                                <h4><i><span class="material-symbols-outlined">account_circle</span></i>Profession</h4>
                                <div class="form-group">
                                                                        <select class="chosen-select" name="domain[]" multiple>
                                                                                <option  value="Accounting-Banking-and-Finance">Accounting, Banking & Finance</option>
                                                                                <option  value="Administration-and-HR">Administration & HR</option>
                                                                                <option  value="Advertisment-Media-and-Entertainment">Advertisment, Media & Entertainment</option>
                                                                                <option  value="Others">Others</option>
                                                                                <option  value="Agriculture">Agriculture</option>
                                                                                <option  value="Airline-and-Aviation">Airline and Aviation</option>
                                                                                <option  value="Architecture-and-Design">Architecture & Design</option>
                                                                                <option  value="Animators-and-Web-Designers-">Animators & Web Designers </option>
                                                                                <option  value="Beauty-Fashion-and-Jewellery-Designer">Beauty, Fashion & Jewellery Designer</option>
                                                                                <option  value="BPO-KPO-and-Customer-Support">BPO, KPO & Customer Support</option>
                                                                                <option  value="Civil-Services">Civil Services</option>
                                                                                <option  value="Law-Enforcement">Law Enforcement</option>
                                                                                <option  value="Defence-Forces">Defence Forces</option>
                                                                                <option  value="Police-Force">Police Force</option>
                                                                                <option  value="Central-Police-Force">Central Police Force</option>
                                                                                <option  value="Education-and-Training">Education & Training</option>
                                                                                <option  value="Engineering">Engineering</option>
                                                                                <option  value="IT-and-Software-Engineering">IT & Software Engineering</option>
                                                                                <option  value="Hotel-and-Hospitality">Hotel & Hospitality</option>
                                                                                <option  value="Legal">Legal</option>
                                                                                <option  value="Medical-and-Healthcare">Medical & Healthcare</option>
                                                                                <option  value="Merchant-Navy">Merchant Navy</option>
                                                                                <option  value="Science">Science</option>
                                                                                <option  value="Corporate-Professionals">Corporate Professionals</option>
                                                                                <option  value="Scientist">Scientist</option>
                                                                                <option  value="Not-Working">Not Working</option>
                                                                            </select>
                                </div>
                            </div>
                            <!-- END -->
                            <!-- START -->
                            <div class="filt-com lhs-cate">
                                <h4><i><span class="material-symbols-outlined">currency_rupee</span></i>Annual Income </h4>
                                <div class="form-group">
                                    <select class="chosen-select" name="income">
                                        <option value="">Select</option>
                                        <option  value="Upto 1 Lakhs">Upto 1 Lakhs</option>
                                        <option  value="1 Lakhs - 2 Lakhs">1 Lakhs - 2 Lakhs</option>
                                        <option  value="2 Lakhs - 5 Lakhs">2 Lakhs - 5 Lakhs</option>
                                        <option  value="5 Lakhs - 7 Lakhs">5 Lakhs - 7 Lakhs</option>
                                        <option  value="7 Lakhs - 10 Lakhs">7 Lakhs - 10 Lakhs</option>
                                        <option  value="10 Lakhs - 15 Lakhs">10 Lakhs - 15 Lakhs</option>
                                        <option  value="15 Lakhs - 20 Lakhs">15 Lakhs - 20 Lakhs</option>
                                        <option  value="20 Lakhs - 25 Lakhs">20 Lakhs - 25 Lakhs</option>
                                        <option  value="25 Lakhs - 30 Lakhs">25 Lakhs - 30 Lakhs</option>
                                        <option  value="30 Lakhs - 50 Lakhs">30 Lakhs - 50 Lakhs</option>
                                        <option  value="50 Lakhs - 75 Lakhs">50 Lakhs - 75 Lakhs</option>
                                        <option  value="75 Lakhs - 1 Crore">75 Lakhs - 1 Crore</option>
                                        <option  value="1 Crore and Above">1 Crore and Above</option>
                                    </select>
                                </div>
                            </div>
                            <!-- END -->
                            <!-- START -->
                            <div class="filt-com lhs-cate">
                                <h4><i><span class="material-symbols-outlined">location_on</span></i>City</h4>
                                <div class="form-group">
                                    <select class="chosen-select" name="city[]" multiple>
                                                                                <option value="Visakhapatnam">Visakhapatnam</option>
                                                                                <option value="Vijayawada">Vijayawada</option>
                                                                                <option value="Guntur">Guntur</option>
                                                                                <option value="Nellore">Nellore</option>
                                                                                <option value="Kurnool">Kurnool</option>
                                                                                <option value="Kakinada">Kakinada</option>
                                                                                <option value="Rajahmundry">Rajahmundry</option>
                                                                                <option value="Kadapa">Kadapa</option>
                                                                                <option value="Mangalagiri-Tadepalli">Mangalagiri-Tadepalli</option>
                                                                                <option value="Tirupati">Tirupati</option>
                                                                                <option value="Anantapuram">Anantapuram</option>
                                                                                <option value="Vizianagaram">Vizianagaram</option>
                                                                                <option value="Eluru">Eluru</option>
                                                                                <option value="Nandyal">Nandyal</option>
                                                                                <option value="Ongole">Ongole</option>
                                                                                <option value="Adoni">Adoni</option>
                                                                                <option value="Madanapalle">Madanapalle</option>
                                                                                <option value="Machilipatnam">Machilipatnam</option>
                                                                                <option value="Tenali">Tenali</option>
                                                                                <option value="Proddatur">Proddatur</option>
                                                                                <option value="Chittoor">Chittoor</option>
                                                                                <option value="Hindupur">Hindupur</option>
                                                                                <option value="Srikakulam">Srikakulam</option>
                                                                                <option value="Bhimavaram">Bhimavaram</option>
                                                                                <option value="Tadepalligudem">Tadepalligudem</option>
                                                                                <option value="Guntakal">Guntakal</option>
                                                                                <option value="Dharmavaram">Dharmavaram</option>
                                                                                <option value="Gudivada">Gudivada</option>
                                                                                <option value="Narasaraopet">Narasaraopet</option>
                                                                                <option value="Kadiri">Kadiri</option>
                                                                                <option value="Tadipatri">Tadipatri</option>
                                                                                <option value="Chilakaluripet">Chilakaluripet</option>
                                                                                <option value="Aalo">Aalo</option>
                                                                                <option value="Anini">Anini</option>
                                                                                <option value="Basar">Basar</option>
                                                                                <option value="Boleng">Boleng</option>
                                                                                <option value="Bomdila">Bomdila</option>
                                                                                <option value="Changlang">Changlang</option>
                                                                                <option value="Daporijo">Daporijo</option>
                                                                                <option value="Deomali">Deomali</option>
                                                                                <option value="Dirang">Dirang</option>
                                                                                <option value="Hawai">Hawai</option>
                                                                                <option value="Itanagar">Itanagar</option>
                                                                                <option value="Jairampur">Jairampur</option>
                                                                                <option value="Khonsa">Khonsa</option>
                                                                                <option value="Koloriang">Koloriang</option>
                                                                                <option value="Longding">Longding</option>
                                                                                <option value="Miao">Miao</option>
                                                                                <option value="Naharlagun">Naharlagun</option>
                                                                                <option value="Namsai">Namsai</option>
                                                                                <option value="Pasighat">Pasighat</option>
                                                                                <option value="Roing">Roing</option>
                                                                                <option value="Rupa">Rupa</option>
                                                                                <option value="Sagalee">Sagalee</option>
                                                                                <option value="Seppa">Seppa</option>
                                                                                <option value="Tawang">Tawang</option>
                                                                                <option value="Tezu">Tezu</option>
                                                                                <option value="Yingkiong">Yingkiong</option>
                                                                                <option value="Ziro">Ziro</option>
                                                                                <option value="Odalguri">Odalguri</option>
                                                                                <option value="Tangla">Tangla</option>
                                                                                <option value="Karimganj">Karimganj</option>
                                                                                <option value="Badarpur">Badarpur</option>
                                                                                <option value="Silchar">Silchar</option>
                                                                                <option value="Lakhipur">Lakhipur</option>
                                                                                <option value="Rangia">Rangia</option>
                                                                                <option value="Palashbari">Palashbari</option>
                                                                                <option value="Guwahati">Guwahati</option>
                                                                                <option value="North Guwahati">North Guwahati</option>
                                                                                <option value="Diphu">Diphu</option>
                                                                                <option value="Dokmoka">Dokmoka</option>
                                                                                <option value="Howraghat">Howraghat</option>
                                                                                <option value="Bokajan">Bokajan</option>
                                                                                <option value="Hamren">Hamren</option>
                                                                                <option value="Donkamokam">Donkamokam</option>
                                                                                <option value="Kokrajhar">Kokrajhar</option>
                                                                                <option value="Gossaigaon">Gossaigaon</option>
                                                                                <option value="Golaghat">Golaghat</option>
                                                                                <option value="Dergaon">Dergaon</option>
                                                                                <option value="Bokakhat">Bokakhat</option>
                                                                                <option value="Sarupathar">Sarupathar</option>
                                                                                <option value="Borpathar">Borpathar</option>
                                                                                <option value="Goalpara">Goalpara</option>
                                                                                <option value="Basugaon">Basugaon</option>
                                                                                <option value="Bijni">Bijni</option>
                                                                                <option value="Dibrugarh">Dibrugarh</option>
                                                                                <option value="Naharkatia">Naharkatia</option>
                                                                                <option value="Chabua">Chabua</option>
                                                                                <option value="Haflong">Haflong</option>
                                                                                <option value="Umrangso">Umrangso</option>
                                                                                <option value="Mahur">Mahur</option>
                                                                                <option value="Maibang">Maibang</option>
                                                                                <option value="Tinsukia">Tinsukia</option>
                                                                                <option value="Digboi">Digboi</option>
                                                                                <option value="Margherita">Margherita</option>
                                                                                <option value="Doomdooma">Doomdooma</option>
                                                                                <option value="Makum">Makum</option>
                                                                                <option value="Mangaldoi">Mangaldoi</option>
                                                                                <option value="Kharupetia">Kharupetia</option>
                                                                                <option value="Namkhola">Namkhola</option>
                                                                                <option value="Duni">Duni</option>
                                                                                <option value="Dhubri">Dhubri</option>
                                                                                <option value="Gouripur">Gouripur</option>
                                                                                <option value="Sapatgram">Sapatgram</option>
                                                                                <option value="Bilasipara">Bilasipara</option>
                                                                                <option value="Chapar">Chapar</option>
                                                                                <option value="Dhemaji">Dhemaji</option>
                                                                                <option value="Silapathar">Silapathar</option>
                                                                                <option value="Nagaon">Nagaon</option>
                                                                                <option value="Kampur">Kampur</option>
                                                                                <option value="Roha">Roha</option>
                                                                                <option value="Doboka">Doboka</option>
                                                                                <option value="Hojai">Hojai</option>
                                                                                <option value="Lumding">Lumding</option>
                                                                                <option value="Lanka">Lanka</option>
                                                                                <option value="Nalbari">Nalbari</option>
                                                                                <option value="Tihu">Tihu</option>
                                                                                <option value="Bongaigaon">Bongaigaon</option>
                                                                                <option value="Abhayapuri">Abhayapuri</option>
                                                                                <option value="Barpeta">Barpeta</option>
                                                                                <option value="Barpeta Road">Barpeta Road</option>
                                                                                <option value="Howli">Howli</option>
                                                                                <option value="Sarthebari">Sarthebari</option>
                                                                                <option value="Pathsala">Pathsala</option>
                                                                                <option value="Sarbhog">Sarbhog</option>
                                                                                <option value="Goreswar">Goreswar</option>
                                                                                <option value="Jagi Bhakatgaon">Jagi Bhakatgaon</option>
                                                                                <option value="Borduba">Borduba</option>
                                                                                <option value="Jorhat">Jorhat</option>
                                                                                <option value="Mariani">Mariani</option>
                                                                                <option value="Teok">Teok</option>
                                                                                <option value="North Lakhimpur">North Lakhimpur</option>
                                                                                <option value="Bihpuria">Bihpuria</option>
                                                                                <option value="Dhakuakhona">Dhakuakhona</option>
                                                                                <option value="Sivasagar">Sivasagar</option>
                                                                                <option value="Amguri">Amguri</option>
                                                                                <option value="Simaluguri">Simaluguri</option>
                                                                                <option value="Sonari">Sonari</option>
                                                                                <option value="Moranhat">Moranhat</option>
                                                                                <option value="Nazira">Nazira</option>
                                                                                <option value="Tezpur">Tezpur</option>
                                                                                <option value="Rangapara">Rangapara</option>
                                                                                <option value="Dhekiajuli">Dhekiajuli</option>
                                                                                <option value="Gohpur">Gohpur</option>
                                                                                <option value="Biswanath Chariali">Biswanath Chariali</option>
                                                                                <option value="Hailakandi">Hailakandi</option>
                                                                                <option value="lala">lala</option>
                                                                                <option value="Amarpur">Amarpur</option>
                                                                                <option value="Anwari">Anwari</option>
                                                                                <option value="Araria">Araria</option>
                                                                                <option value="Areraj">Areraj</option>
                                                                                <option value="Arrah">Arrah</option>
                                                                                <option value="Arwal">Arwal</option>
                                                                                <option value="Asarganj">Asarganj</option>
                                                                                <option value="Aurangabad">Aurangabad</option>
                                                                                <option value="Bagaha">Bagaha</option>
                                                                                <option value="Bahadurganj">Bahadurganj</option>
                                                                                <option value="Bahadurpur">Bahadurpur</option>
                                                                                <option value="Bairgania">Bairgania</option>
                                                                                <option value="Bakhri">Bakhri</option>
                                                                                <option value="Bakhtiarpur">Bakhtiarpur</option>
                                                                                <option value="Balia">Balia</option>
                                                                                <option value="Banka">Banka</option>
                                                                                <option value="Bara">Bara</option>
                                                                                <option value="Barahiya">Barahiya</option>
                                                                                <option value="Barauli">Barauli</option>
                                                                                <option value="Barauni">Barauni</option>
                                                                                <option value="Barbigha">Barbigha</option>
                                                                                <option value="Barh">Barh</option>
                                                                                <option value="Begusarai">Begusarai</option>
                                                                                <option value="Behea">Behea</option>
                                                                                <option value="Belsand">Belsand</option>
                                                                                <option value="Benipur">Benipur</option>
                                                                                <option value="Bettiah">Bettiah</option>
                                                                                <option value="Bhabua">Bhabua</option>
                                                                                <option value="Bhadauni">Bhadauni</option>
                                                                                <option value="Bhagalpur">Bhagalpur</option>
                                                                                <option value="Bhagirathpur">Bhagirathpur</option>
                                                                                <option value="Bhardua">Bhardua</option>
                                                                                <option value="Bhuindhara">Bhuindhara</option>
                                                                                <option value="Bihat">Bihat</option>
                                                                                <option value="Bihta">Bihta</option>
                                                                                <option value="Bikramganj">Bikramganj</option>
                                                                                <option value="Birpur">Birpur</option>
                                                                                <option value="Bodh Gaya">Bodh Gaya</option>
                                                                                <option value="Buxar">Buxar</option>
                                                                                <option value="Chakia">Chakia</option>
                                                                                <option value="Chanari">Chanari</option>
                                                                                <option value="Chanpatia">Chanpatia</option>
                                                                                <option value="Chapra">Chapra</option>
                                                                                <option value="Colgong">Colgong</option>
                                                                                <option value="Dalsinghsarai">Dalsinghsarai</option>
                                                                                <option value="Damodarpur">Damodarpur</option>
                                                                                <option value="Darbhanga">Darbhanga</option>
                                                                                <option value="Dariapur">Dariapur</option>
                                                                                <option value="Daudnagar">Daudnagar</option>
                                                                                <option value="Dehri">Dehri</option>
                                                                                <option value="Dhaka">Dhaka</option>
                                                                                <option value="Dharampur">Dharampur</option>
                                                                                <option value="Dighwara">Dighwara</option>
                                                                                <option value="Danapur">Danapur</option>
                                                                                <option value="Dumari urf Damodarpur Shahjahan">Dumari urf Damodarpur Shahjahan</option>
                                                                                <option value="Dumra">Dumra</option>
                                                                                <option value="Dumraon">Dumraon</option>
                                                                                <option value="Ekangar Sarai">Ekangar Sarai</option>
                                                                                <option value="Fatwah">Fatwah</option>
                                                                                <option value="Forbesganj">Forbesganj</option>
                                                                                <option value="Gaya">Gaya</option>
                                                                                <option value="Gazipur">Gazipur</option>
                                                                                <option value="Ghoghardiha">Ghoghardiha</option>
                                                                                <option value="Gogri Jamalpur">Gogri Jamalpur</option>
                                                                                <option value="Gopalganj">Gopalganj</option>
                                                                                <option value="Habibpur">Habibpur</option>
                                                                                <option value="Hajipur">Hajipur</option>
                                                                                <option value="Hanspura">Hanspura</option>
                                                                                <option value="Hathua">Hathua</option>
                                                                                <option value="Hat Saraiya">Hat Saraiya</option>
                                                                                <option value="Hilsa">Hilsa</option>
                                                                                <option value="Hisua">Hisua</option>
                                                                                <option value="Islampur">Islampur</option>
                                                                                <option value="Jagdishpur">Jagdishpur</option>
                                                                                <option value="Jainagar">Jainagar</option>
                                                                                <option value="Jamalpur">Jamalpur</option>
                                                                                <option value="Jamui">Jamui</option>
                                                                                <option value="Janpur">Janpur</option>
                                                                                <option value="Jehanabad">Jehanabad</option>
                                                                                <option value="Jhajha">Jhajha</option>
                                                                                <option value="Jhanjharpur">Jhanjharpur</option>
                                                                                <option value="Jogabani">Jogabani</option>
                                                                                <option value="Kanti">Kanti</option>
                                                                                <option value="Kargahia Purab">Kargahia Purab</option>
                                                                                <option value="Kasba">Kasba</option>
                                                                                <option value="Kataiya">Kataiya</option>
                                                                                <option value="Katihar">Katihar</option>
                                                                                <option value="Kesaria">Kesaria</option>
                                                                                <option value="Khagaria">Khagaria</option>
                                                                                <option value="Khagaul">Khagaul</option>
                                                                                <option value="Kharagpur">Kharagpur</option>
                                                                                <option value="Khusrupur">Khusrupur</option>
                                                                                <option value="Kishanganj">Kishanganj</option>
                                                                                <option value="Koath">Koath</option>
                                                                                <option value="Koilwar">Koilwar</option>
                                                                                <option value="Kurthaur">Kurthaur</option>
                                                                                <option value="Lakhisarai">Lakhisarai</option>
                                                                                <option value="Lalganj">Lalganj</option>
                                                                                <option value="Laruara">Laruara</option>
                                                                                <option value="Madhepura">Madhepura</option>
                                                                                <option value="Madhuban">Madhuban</option>
                                                                                <option value="Madhubani">Madhubani</option>
                                                                                <option value="Maharajganj">Maharajganj</option>
                                                                                <option value="Mahnar Bazar">Mahnar Bazar</option>
                                                                                <option value="Mairwa">Mairwa</option>
                                                                                <option value="Majhauli Khetal">Majhauli Khetal</option>
                                                                                <option value="Makhdumpur">Makhdumpur</option>
                                                                                <option value="Malhipur">Malhipur</option>
                                                                                <option value="Maner">Maner</option>
                                                                                <option value="Manihari">Manihari</option>
                                                                                <option value="Mansur Chak">Mansur Chak</option>
                                                                                <option value="Marhaura">Marhaura</option>
                                                                                <option value="Masaurhi">Masaurhi</option>
                                                                                <option value="Mathurapur">Mathurapur</option>
                                                                                <option value="Mehsi">Mehsi</option>
                                                                                <option value="Mirganj">Mirganj</option>
                                                                                <option value="Mohanpur">Mohanpur</option>
                                                                                <option value="Mokameh">Mokameh</option>
                                                                                <option value="Motihari">Motihari</option>
                                                                                <option value="Motipur">Motipur</option>
                                                                                <option value="Munger">Munger</option>
                                                                                <option value="Murliganj">Murliganj</option>
                                                                                <option value="Muzaffarpur">Muzaffarpur</option>
                                                                                <option value="Nabinagar">Nabinagar</option>
                                                                                <option value="Narkatiaganj">Narkatiaganj</option>
                                                                                <option value="Nasriganj">Nasriganj</option>
                                                                                <option value="Naubatpur">Naubatpur</option>
                                                                                <option value="Naugachhia">Naugachhia</option>
                                                                                <option value="Nawada">Nawada</option>
                                                                                <option value="Nirmali">Nirmali</option>
                                                                                <option value="Nohsa">Nohsa</option>
                                                                                <option value="Nokha">Nokha</option>
                                                                                <option value="Nurpur">Nurpur</option>
                                                                                <option value="Obra">Obra</option>
                                                                                <option value="Padri">Padri</option>
                                                                                <option value="Paharpur">Paharpur</option>
                                                                                <option value="Pakri Dayal">Pakri Dayal</option>
                                                                                <option value="Pareo">Pareo</option>
                                                                                <option value="Paria">Paria</option>
                                                                                <option value="Patna">Patna</option>
                                                                                <option value="Phulwari Sharif">Phulwari Sharif</option>
                                                                                <option value="Piro">Piro</option>
                                                                                <option value="Puraini">Puraini</option>
                                                                                <option value="Purnia">Purnia</option>
                                                                                <option value="Rafiganj">Rafiganj</option>
                                                                                <option value="Raghunathpur">Raghunathpur</option>
                                                                                <option value="Rajauli">Rajauli</option>
                                                                                <option value="Rajgir">Rajgir</option>
                                                                                <option value="Ramgarh">Ramgarh</option>
                                                                                <option value="Ramnagar">Ramnagar</option>
                                                                                <option value="Revelganj">Revelganj</option>
                                                                                <option value="Rosera">Rosera</option>
                                                                                <option value="Sabour">Sabour</option>
                                                                                <option value="Saharsa">Saharsa</option>
                                                                                <option value="Sahebganj">Sahebganj</option>
                                                                                <option value="Saidpura">Saidpura</option>
                                                                                <option value="Samastipur">Samastipur</option>
                                                                                <option value="Sanrha">Sanrha</option>
                                                                                <option value="Saraiya">Saraiya</option>
                                                                                <option value="Sarimpur">Sarimpur</option>
                                                                                <option value="Sasaram">Sasaram</option>
                                                                                <option value="Satghara">Satghara</option>
                                                                                <option value="Shahjangi">Shahjangi</option>
                                                                                <option value="Shahpur">Shahpur</option>
                                                                                <option value="Sheikhpura">Sheikhpura</option>
                                                                                <option value="Shekhpura">Shekhpura</option>
                                                                                <option value="Sheohar">Sheohar</option>
                                                                                <option value="Sherghati">Sherghati</option>
                                                                                <option value="Silao">Silao</option>
                                                                                <option value="Singhesar Asthan">Singhesar Asthan</option>
                                                                                <option value="Sitamarhi">Sitamarhi</option>
                                                                                <option value="Siwan">Siwan</option>
                                                                                <option value="Sonepur">Sonepur</option>
                                                                                <option value="Sugauli">Sugauli</option>
                                                                                <option value="Sultanganj">Sultanganj</option>
                                                                                <option value="Supaul">Supaul</option>
                                                                                <option value="Talkhapur Dumra">Talkhapur Dumra</option>
                                                                                <option value="Tarapur">Tarapur</option>
                                                                                <option value="Teghra">Teghra</option>
                                                                                <option value="Telkap">Telkap</option>
                                                                                <option value="Thakurganj">Thakurganj</option>
                                                                                <option value="Tikari">Tikari</option>
                                                                                <option value="Tola Baliadih">Tola Baliadih</option>
                                                                                <option value="Tola Chain">Tola Chain</option>
                                                                                <option value="Tola Mansaraut">Tola Mansaraut</option>
                                                                                <option value="Tola Pairamatihana">Tola Pairamatihana</option>
                                                                                <option value="Warisaliganj">Warisaliganj</option>
                                                                                <option value="Yehiapur">Yehiapur</option>
                                                                                <option value="Raipur">Raipur</option>
                                                                                <option value="Bhilai (Bhilai Nagar)">Bhilai (Bhilai Nagar)</option>
                                                                                <option value="Bilaspur">Bilaspur</option>
                                                                                <option value="Korba">Korba</option>
                                                                                <option value="Raj Nandgaon">Raj Nandgaon</option>
                                                                                <option value="Raigarh">Raigarh</option>
                                                                                <option value="Jagdalpur">Jagdalpur</option>
                                                                                <option value="Ambikapur">Ambikapur</option>
                                                                                <option value="Dhamtari">Dhamtari</option>
                                                                                <option value="Chirmiri">Chirmiri</option>
                                                                                <option value="Bhatapara">Bhatapara</option>
                                                                                <option value="Mahasamund">Mahasamund</option>
                                                                                <option value="Dalli-Rajhara">Dalli-Rajhara</option>
                                                                                <option value="Kawardha">Kawardha</option>
                                                                                <option value="Champa">Champa</option>
                                                                                <option value="Naila Janjgir">Naila Janjgir</option>
                                                                                <option value="Kanker">Kanker</option>
                                                                                <option value="Dongragarh">Dongragarh</option>
                                                                                <option value="Tilda Neora">Tilda Neora</option>
                                                                                <option value="Mungeli">Mungeli</option>
                                                                                <option value="Manendragarh">Manendragarh</option>
                                                                                <option value="Kondagaon">Kondagaon</option>
                                                                                <option value="Gobranawapara">Gobranawapara</option>
                                                                                <option value="Bemetara">Bemetara</option>
                                                                                <option value="Baikunthpur">Baikunthpur</option>
                                                                                <option value="Bicholim">Bicholim</option>
                                                                                <option value="Canacona">Canacona</option>
                                                                                <option value="Cuncolim">Cuncolim</option>
                                                                                <option value="Curchorem">Curchorem</option>
                                                                                <option value="Mapusa">Mapusa</option>
                                                                                <option value="Margao">Margao</option>
                                                                                <option value="Mormugao">Mormugao</option>
                                                                                <option value="Panaji">Panaji</option>
                                                                                <option value="Pernem">Pernem</option>
                                                                                <option value="Ponda">Ponda</option>
                                                                                <option value="Quepem">Quepem</option>
                                                                                <option value="Sanguem">Sanguem</option>
                                                                                <option value="Sanquelim">Sanquelim</option>
                                                                                <option value="Valpoi">Valpoi</option>
                                                                                <option value="Ahmedabad">Ahmedabad</option>
                                                                                <option value="Surat">Surat</option>
                                                                                <option value="Vadodara">Vadodara</option>
                                                                                <option value="Rajkot">Rajkot</option>
                                                                                <option value="Bhavnagar">Bhavnagar</option>
                                                                                <option value="Jamnagar">Jamnagar</option>
                                                                                <option value="Gandhinagar">Gandhinagar</option>
                                                                                <option value="Junagadh">Junagadh</option>
                                                                                <option value="Gandhidham">Gandhidham</option>
                                                                                <option value="Anand">Anand</option>
                                                                                <option value="Navsari">Navsari</option>
                                                                                <option value="Morbi">Morbi</option>
                                                                                <option value="Nadiad">Nadiad</option>
                                                                                <option value="Surendranagar">Surendranagar</option>
                                                                                <option value="Bharuch">Bharuch</option>
                                                                                <option value="Mehsana">Mehsana</option>
                                                                                <option value="Bhuj">Bhuj</option>
                                                                                <option value="Porbandar">Porbandar</option>
                                                                                <option value="Palanpur">Palanpur</option>
                                                                                <option value="Valsad">Valsad</option>
                                                                                <option value="Vapi">Vapi</option>
                                                                                <option value="Gondal">Gondal</option>
                                                                                <option value="Veraval">Veraval</option>
                                                                                <option value="Godhra">Godhra</option>
                                                                                <option value="Patan">Patan</option>
                                                                                <option value="Kalol">Kalol</option>
                                                                                <option value="Dahod">Dahod</option>
                                                                                <option value="Botad">Botad</option>
                                                                                <option value="Amreli">Amreli</option>
                                                                                <option value="Deesa">Deesa</option>
                                                                                <option value="Jetpur">Jetpur</option>
                                                                                <option value="Faridabad">Faridabad</option>
                                                                                <option value="Gurugram">Gurugram</option>
                                                                                <option value="Panipat">Panipat</option>
                                                                                <option value="Ambala">Ambala</option>
                                                                                <option value="Yamunanagar">Yamunanagar</option>
                                                                                <option value="Rohtak">Rohtak</option>
                                                                                <option value="Hisar">Hisar</option>
                                                                                <option value="Karnal">Karnal</option>
                                                                                <option value="Sonipat">Sonipat</option>
                                                                                <option value="Panchkula">Panchkula</option>
                                                                                <option value="Bhiwani">Bhiwani</option>
                                                                                <option value="Sirsa">Sirsa</option>
                                                                                <option value="Bahadurgarh">Bahadurgarh</option>
                                                                                <option value="Jind">Jind</option>
                                                                                <option value="Thanesar">Thanesar</option>
                                                                                <option value="Kaithal">Kaithal</option>
                                                                                <option value="Rewari">Rewari</option>
                                                                                <option value="Narnaul">Narnaul</option>
                                                                                <option value="Pundri">Pundri</option>
                                                                                <option value="Kosli">Kosli</option>
                                                                                <option value="Shimla">Shimla</option>
                                                                                <option value="Dharamsala">Dharamsala</option>
                                                                                <option value="Solan">Solan</option>
                                                                                <option value="Mandi">Mandi</option>
                                                                                <option value="Palampur">Palampur</option>
                                                                                <option value="Baddi">Baddi</option>
                                                                                <option value="Nahan">Nahan</option>
                                                                                <option value="Paonta Sahib">Paonta Sahib</option>
                                                                                <option value="Sundarnagar">Sundarnagar</option>
                                                                                <option value="Chamba">Chamba</option>
                                                                                <option value="Una">Una</option>
                                                                                <option value="Kullu">Kullu</option>
                                                                                <option value="Hamirpur">Hamirpur</option>
                                                                                <option value="Yol Cantonment">Yol Cantonment</option>
                                                                                <option value="Nalagarh">Nalagarh</option>
                                                                                <option value="Kangra">Kangra</option>
                                                                                <option value="Baijnath Paprola">Baijnath Paprola</option>
                                                                                <option value="Santokhgarh">Santokhgarh</option>
                                                                                <option value="Mehatpur Basdehra">Mehatpur Basdehra</option>
                                                                                <option value="Shamshi">Shamshi</option>
                                                                                <option value="Parwanoo">Parwanoo</option>
                                                                                <option value="Manali">Manali</option>
                                                                                <option value="Tira Sujanpur">Tira Sujanpur</option>
                                                                                <option value="Ghumarwin">Ghumarwin</option>
                                                                                <option value="Dalhousie">Dalhousie</option>
                                                                                <option value="Rohru">Rohru</option>
                                                                                <option value="Nagrota Bagwan">Nagrota Bagwan</option>
                                                                                <option value="Rampur">Rampur</option>
                                                                                <option value="Jawalamukhi">Jawalamukhi</option>
                                                                                <option value="Jogindernagar">Jogindernagar</option>
                                                                                <option value="Dera Gopipur">Dera Gopipur</option>
                                                                                <option value="Sarkaghat">Sarkaghat</option>
                                                                                <option value="Jhakhri">Jhakhri</option>
                                                                                <option value="Indora">Indora</option>
                                                                                <option value="Bhuntar">Bhuntar</option>
                                                                                <option value="Nadaun">Nadaun</option>
                                                                                <option value="Theog">Theog</option>
                                                                                <option value="Kasauli">Kasauli</option>
                                                                                <option value="Gagret">Gagret</option>
                                                                                <option value="Chuari Khas">Chuari Khas</option>
                                                                                <option value="Daulatpur">Daulatpur</option>
                                                                                <option value="Sabathu Cantonment">Sabathu Cantonment</option>
                                                                                <option value="Rajgarh">Rajgarh</option>
                                                                                <option value="Arki">Arki</option>
                                                                                <option value="Dagshai">Dagshai</option>
                                                                                <option value="Seoni">Seoni</option>
                                                                                <option value="Talai">Talai</option>
                                                                                <option value="Jutogh">Jutogh</option>
                                                                                <option value="Chaupal">Chaupal</option>
                                                                                <option value="Rewalsar">Rewalsar</option>
                                                                                <option value="Bakloh">Bakloh</option>
                                                                                <option value="Jubbal">Jubbal</option>
                                                                                <option value="Bhota">Bhota</option>
                                                                                <option value="Banjar">Banjar</option>
                                                                                <option value="Naina Devi">Naina Devi</option>
                                                                                <option value="Kotkhai">Kotkhai</option>
                                                                                <option value="Narkanda">Narkanda</option>
                                                                                <option value="Ranchi">Ranchi</option>
                                                                                <option value="Dhanbad">Dhanbad</option>
                                                                                <option value="Jamshedpur">Jamshedpur</option>
                                                                                <option value="Hazaribagh">Hazaribagh</option>
                                                                                <option value="Bokaro Steel City">Bokaro Steel City</option>
                                                                                <option value="Deoghar">Deoghar</option>
                                                                                <option value="Giridih">Giridih</option>
                                                                                <option value="Medininagar">Medininagar</option>
                                                                                <option value="Phusro">Phusro</option>
                                                                                <option value="Chirkunda">Chirkunda</option>
                                                                                <option value="Jhumri Telaiya">Jhumri Telaiya</option>
                                                                                <option value="Bangalore">Bangalore</option>
                                                                                <option value="Hubballi-Dharwad">Hubballi-Dharwad</option>
                                                                                <option value="Mysore">Mysore</option>
                                                                                <option value="Kalaburagi">Kalaburagi</option>
                                                                                <option value="Mangalore">Mangalore</option>
                                                                                <option value="Belagavi">Belagavi</option>
                                                                                <option value="Davanagere">Davanagere</option>
                                                                                <option value="Bellary">Bellary</option>
                                                                                <option value="Vijayapura">Vijayapura</option>
                                                                                <option value="Shimoga">Shimoga</option>
                                                                                <option value="Tumkur">Tumkur</option>
                                                                                <option value="Raichur">Raichur</option>
                                                                                <option value="Bidar">Bidar</option>
                                                                                <option value="Udupi">Udupi</option>
                                                                                <option value="Hospet">Hospet</option>
                                                                                <option value="Gadag-Betageri">Gadag-Betageri</option>
                                                                                <option value="Robertsonpet">Robertsonpet</option>
                                                                                <option value="Hassan">Hassan</option>
                                                                                <option value="Bhadravati">Bhadravati</option>
                                                                                <option value="Chitradurga">Chitradurga</option>
                                                                                <option value="Kolar">Kolar</option>
                                                                                <option value="Mandya">Mandya</option>
                                                                                <option value="Chikmagalur">Chikmagalur</option>
                                                                                <option value="Gangavati">Gangavati</option>
                                                                                <option value="Bagalkot">Bagalkot</option>
                                                                                <option value="Ranebennuru">Ranebennuru</option>
                                                                                <option value="Thiruvananthapuram">Thiruvananthapuram</option>
                                                                                <option value="Kochi">Kochi</option>
                                                                                <option value="Kozhikode">Kozhikode</option>
                                                                                <option value="Kollam">Kollam</option>
                                                                                <option value="Thrissur">Thrissur</option>
                                                                                <option value="Kannur">Kannur</option>
                                                                                <option value="Alappuzha">Alappuzha</option>
                                                                                <option value="Kottayam">Kottayam</option>
                                                                                <option value="Palakkad">Palakkad</option>
                                                                                <option value="Malappuram">Malappuram</option>
                                                                                <option value="Kanhangad">Kanhangad</option>
                                                                                <option value="Kayamkulam">Kayamkulam</option>
                                                                                <option value="Kasaragod">Kasaragod</option>
                                                                                <option value="Ottappalam">Ottappalam</option>
                                                                                <option value="Chalakudy">Chalakudy</option>
                                                                                <option value="Changanassery">Changanassery</option>
                                                                                <option value="Cherthala">Cherthala</option>
                                                                                <option value="Kothamangalam">Kothamangalam</option>
                                                                                <option value="Indore">Indore</option>
                                                                                <option value="Bhopal">Bhopal</option>
                                                                                <option value="Jabalpur">Jabalpur</option>
                                                                                <option value="Gwalior">Gwalior</option>
                                                                                <option value="Ujjain">Ujjain</option>
                                                                                <option value="Sagar">Sagar</option>
                                                                                <option value="Dewas">Dewas</option>
                                                                                <option value="Satna">Satna</option>
                                                                                <option value="Ratlam">Ratlam</option>
                                                                                <option value="Rewa">Rewa</option>
                                                                                <option value="Katni">Katni</option>
                                                                                <option value="Singrauli">Singrauli</option>
                                                                                <option value="Burhanpur">Burhanpur</option>
                                                                                <option value="Khandwa">Khandwa</option>
                                                                                <option value="Bhind">Bhind</option>
                                                                                <option value="Chhindwara">Chhindwara</option>
                                                                                <option value="Guna">Guna</option>
                                                                                <option value="Shivpuri">Shivpuri</option>
                                                                                <option value="Vidisha">Vidisha</option>
                                                                                <option value="Chhatarpur">Chhatarpur</option>
                                                                                <option value="Damoh">Damoh</option>
                                                                                <option value="Mandsaur">Mandsaur</option>
                                                                                <option value="Khargone">Khargone</option>
                                                                                <option value="Neemuch">Neemuch</option>
                                                                                <option value="Pithampur">Pithampur</option>
                                                                                <option value="Narmadapuram">Narmadapuram</option>
                                                                                <option value="Itarsi">Itarsi</option>
                                                                                <option value="Sehore">Sehore</option>
                                                                                <option value="Chambal">Chambal</option>
                                                                                <option value="Betul">Betul</option>
                                                                                <option value="Datia">Datia</option>
                                                                                <option value="Nagda">Nagda</option>
                                                                                <option value="Dindori">Dindori</option>
                                                                                <option value="Mumbai">Mumbai</option>
                                                                                <option value="Pune">Pune</option>
                                                                                <option value="Nagpur">Nagpur</option>
                                                                                <option value="Thane">Thane</option>
                                                                                <option value="Pimpri-Chinchwad">Pimpri-Chinchwad</option>
                                                                                <option value="Nashik">Nashik</option>
                                                                                <option value="Kalyan-Dombivli">Kalyan-Dombivli</option>
                                                                                <option value="Vasai-Virar">Vasai-Virar</option>
                                                                                <option value="Navi Mumbai">Navi Mumbai</option>
                                                                                <option value="Solapur">Solapur</option>
                                                                                <option value="Mira-Bhayandar">Mira-Bhayandar</option>
                                                                                <option value="Bhiwandi-Nizampur">Bhiwandi-Nizampur</option>
                                                                                <option value="Jalgaon">Jalgaon</option>
                                                                                <option value="Amravati">Amravati</option>
                                                                                <option value="Nanded-Waghala">Nanded-Waghala</option>
                                                                                <option value="Kolhapur">Kolhapur</option>
                                                                                <option value="Ulhasnagar">Ulhasnagar</option>
                                                                                <option value="Sangli-Miraj-Kupwad">Sangli-Miraj-Kupwad</option>
                                                                                <option value="Malegaon">Malegaon</option>
                                                                                <option value="Akola">Akola</option>
                                                                                <option value="Latur">Latur</option>
                                                                                <option value="Dhule">Dhule</option>
                                                                                <option value="Ahmednagar">Ahmednagar</option>
                                                                                <option value="Chandrapur">Chandrapur</option>
                                                                                <option value="Parbhani">Parbhani</option>
                                                                                <option value="Ichalkaranji">Ichalkaranji</option>
                                                                                <option value="Jalna">Jalna</option>
                                                                                <option value="Ambarnath">Ambarnath</option>
                                                                                <option value="Bhusawal">Bhusawal</option>
                                                                                <option value="Panvel">Panvel</option>
                                                                                <option value="Badlapur">Badlapur</option>
                                                                                <option value="Beed">Beed</option>
                                                                                <option value="Gondia">Gondia</option>
                                                                                <option value="Satara">Satara</option>
                                                                                <option value="Barshi">Barshi</option>
                                                                                <option value="Yavatmal">Yavatmal</option>
                                                                                <option value="Achalpur">Achalpur</option>
                                                                                <option value="Dharashiv">Dharashiv</option>
                                                                                <option value="Nandurbar">Nandurbar</option>
                                                                                <option value="Wardha">Wardha</option>
                                                                                <option value="Udgir">Udgir</option>
                                                                                <option value="Hinganghat">Hinganghat</option>
                                                                                <option value="Andro">Andro</option>
                                                                                <option value="Bishnupur">Bishnupur</option>
                                                                                <option value="Chingangbam Leikai">Chingangbam Leikai</option>
                                                                                <option value="Heingang">Heingang</option>
                                                                                <option value="Heirok">Heirok</option>
                                                                                <option value="Hill Town">Hill Town</option>
                                                                                <option value="Imphal">Imphal</option>
                                                                                <option value="Jiribam">Jiribam</option>
                                                                                <option value="Kakching">Kakching</option>
                                                                                <option value="Kakching Khunou">Kakching Khunou</option>
                                                                                <option value="Kangpokpi">Kangpokpi</option>
                                                                                <option value="Khongman">Khongman</option>
                                                                                <option value="Khurai Sajor Leikai">Khurai Sajor Leikai</option>
                                                                                <option value="Kiyamgei">Kiyamgei</option>
                                                                                <option value="Kshetrigao">Kshetrigao</option>
                                                                                <option value="Kumbi">Kumbi</option>
                                                                                <option value="Kwakta">Kwakta</option>
                                                                                <option value="Laipham Siphai">Laipham Siphai</option>
                                                                                <option value="Lairikyengbam Leikai">Lairikyengbam Leikai</option>
                                                                                <option value="Lamjaotongba">Lamjaotongba</option>
                                                                                <option value="Lamlai">Lamlai</option>
                                                                                <option value="Lamsang (Lamshang)">Lamsang (Lamshang)</option>
                                                                                <option value="Langjing">Langjing</option>
                                                                                <option value="Lilong (Thoubal)">Lilong (Thoubal)</option>
                                                                                <option value="Lilong (Imphal West)">Lilong (Imphal West)</option>
                                                                                <option value="Luwangsangbam">Luwangsangbam</option>
                                                                                <option value="Mayang Imphal">Mayang Imphal</option>
                                                                                <option value="Moirang">Moirang</option>
                                                                                <option value="Moreh">Moreh</option>
                                                                                <option value="Nambol">Nambol</option>
                                                                                <option value="Naoriya Pakhanglakpa">Naoriya Pakhanglakpa</option>
                                                                                <option value="Ningthoukhong">Ningthoukhong</option>
                                                                                <option value="Oinam">Oinam</option>
                                                                                <option value="Porompat">Porompat</option>
                                                                                <option value="Rengkai">Rengkai</option>
                                                                                <option value="Sagolband">Sagolband</option>
                                                                                <option value="Samurou">Samurou</option>
                                                                                <option value="Sekmai Bazar">Sekmai Bazar</option>
                                                                                <option value="Sikhong Sekmai">Sikhong Sekmai</option>
                                                                                <option value="Sugnu">Sugnu</option>
                                                                                <option value="Takyel Mapal">Takyel Mapal</option>
                                                                                <option value="Tamenglong">Tamenglong</option>
                                                                                <option value="Thongju">Thongju</option>
                                                                                <option value="Thongkhong Laxmi Bazar">Thongkhong Laxmi Bazar</option>
                                                                                <option value="Thoubal">Thoubal</option>
                                                                                <option value="Torban (Kshetri Leikai)">Torban (Kshetri Leikai)</option>
                                                                                <option value="Ukhrul">Ukhrul</option>
                                                                                <option value="Wangjing">Wangjing</option>
                                                                                <option value="Wangoi">Wangoi</option>
                                                                                <option value="Yairipok">Yairipok</option>
                                                                                <option value="Zenhang Lamka">Zenhang Lamka</option>
                                                                                <option value="Shillong">Shillong</option>
                                                                                <option value="Nongstoin">Nongstoin</option>
                                                                                <option value="Cherrapunji">Cherrapunji</option>
                                                                                <option value="Williamnagar">Williamnagar</option>
                                                                                <option value="Mawlai - Mawiong">Mawlai - Mawiong</option>
                                                                                <option value="Nongmynsong">Nongmynsong</option>
                                                                                <option value="Mawsynram">Mawsynram</option>
                                                                                <option value="Mawlynnong">Mawlynnong</option>
                                                                                <option value="Laitkor Lumheh">Laitkor Lumheh</option>
                                                                                <option value="Umling">Umling</option>
                                                                                <option value="Laitumkhrah">Laitumkhrah</option>
                                                                                <option value="Tura">Tura</option>
                                                                                <option value="East Garo Hills">East Garo Hills</option>
                                                                                <option value="Baghmara">Baghmara</option>
                                                                                <option value="West Garo Hills">West Garo Hills</option>
                                                                                <option value="Nongthymmai">Nongthymmai</option>
                                                                                <option value="Pynthorumkhrah">Pynthorumkhrah</option>
                                                                                <option value="Mawphlang">Mawphlang</option>
                                                                                <option value="Dawki">Dawki</option>
                                                                                <option value="Tyrna">Tyrna</option>
                                                                                <option value="Lapalang">Lapalang</option>
                                                                                <option value="Nongpoh">Nongpoh</option>
                                                                                <option value="Mairang">Mairang</option>
                                                                                <option value="Jowai">Jowai</option>
                                                                                <option value="Resubelpara">Resubelpara</option>
                                                                                <option value="Madanryting">Madanryting</option>
                                                                                <option value="Ampati">Ampati</option>
                                                                                <option value="Laitkynsew">Laitkynsew</option>
                                                                                <option value="Dalu">Dalu</option>
                                                                                <option value="Aizawl">Aizawl</option>
                                                                                <option value="Bairabi">Bairabi</option>
                                                                                <option value="Biate">Biate</option>
                                                                                <option value="Champhai">Champhai</option>
                                                                                <option value="Darlawn">Darlawn</option>
                                                                                <option value="Hnahthial">Hnahthial</option>
                                                                                <option value="Khawhai">Khawhai</option>
                                                                                <option value="Khawzawl">Khawzawl</option>
                                                                                <option value="Kolasib">Kolasib</option>
                                                                                <option value="Lawngtlai">Lawngtlai</option>
                                                                                <option value="Lengpui">Lengpui</option>
                                                                                <option value="Lunglei">Lunglei</option>
                                                                                <option value="Mamit">Mamit</option>
                                                                                <option value="N. Kawnpui">N. Kawnpui</option>
                                                                                <option value="North Vanlaiphai">North Vanlaiphai</option>
                                                                                <option value="Saiha">Saiha</option>
                                                                                <option value="Sairang">Sairang</option>
                                                                                <option value="Saitual">Saitual</option>
                                                                                <option value="Serchhip">Serchhip</option>
                                                                                <option value="Thenzawl">Thenzawl</option>
                                                                                <option value="Tlabung">Tlabung</option>
                                                                                <option value="Vairengte">Vairengte</option>
                                                                                <option value="Zawlnuam">Zawlnuam</option>
                                                                                <option value="Changtongya">Changtongya</option>
                                                                                <option value="Chumukedima">Chumukedima</option>
                                                                                <option value="Dimapur">Dimapur</option>
                                                                                <option value="Jalukie">Jalukie</option>
                                                                                <option value="Kiphire">Kiphire</option>
                                                                                <option value="Kohima">Kohima</option>
                                                                                <option value="Kuda">Kuda</option>
                                                                                <option value="Longleng">Longleng</option>
                                                                                <option value="Medziphema">Medziphema</option>
                                                                                <option value="Mokokchung">Mokokchung</option>
                                                                                <option value="Mon Town">Mon Town</option>
                                                                                <option value="Naginimora">Naginimora</option>
                                                                                <option value="Peren">Peren</option>
                                                                                <option value="Pfutsero">Pfutsero</option>
                                                                                <option value="Phek">Phek</option>
                                                                                <option value="Rangapahar">Rangapahar</option>
                                                                                <option value="Satakha">Satakha</option>
                                                                                <option value="Tseminyu">Tseminyu</option>
                                                                                <option value="Tuensang">Tuensang</option>
                                                                                <option value="Tuli">Tuli</option>
                                                                                <option value="Wokha">Wokha</option>
                                                                                <option value="Zunheboto">Zunheboto</option>
                                                                                <option value="Cuttack">Cuttack</option>
                                                                                <option value="Raurkela (Rourkela)">Raurkela (Rourkela)</option>
                                                                                <option value="Brahmapur (Berhampur)">Brahmapur (Berhampur)</option>
                                                                                <option value="Sambalpur">Sambalpur</option>
                                                                                <option value="Puri">Puri</option>
                                                                                <option value="Baleshwar (Balasore)">Baleshwar (Balasore)</option>
                                                                                <option value="Bhadrak">Bhadrak</option>
                                                                                <option value="Baripada">Baripada</option>
                                                                                <option value="Balangir">Balangir</option>
                                                                                <option value="Jharsuguda">Jharsuguda</option>
                                                                                <option value="Jaypur">Jaypur</option>
                                                                                <option value="Bargarh">Bargarh</option>
                                                                                <option value="Brajarajnagar">Brajarajnagar</option>
                                                                                <option value="Rayagada">Rayagada</option>
                                                                                <option value="Bhawanipatna">Bhawanipatna</option>
                                                                                <option value="Paradip">Paradip</option>
                                                                                <option value="Dhenkanal">Dhenkanal</option>
                                                                                <option value="Barbil (Bada Barabil)">Barbil (Bada Barabil)</option>
                                                                                <option value="Jatani">Jatani</option>
                                                                                <option value="Kendujhar (Kendujhargarh)">Kendujhar (Kendujhargarh)</option>
                                                                                <option value="Byasanagar">Byasanagar</option>
                                                                                <option value="Rajagangapur">Rajagangapur</option>
                                                                                <option value="Sunabeda">Sunabeda</option>
                                                                                <option value="Koraput">Koraput</option>
                                                                            </select>
                                </div>
                            </div>
                            <div class="filt-com lhs-cate">
                                <h4><i><span class="material-symbols-outlined">flag</span></i>Country</h4>
                                <div class="form-group mb-3">
                                    <select class="chosen-select" name="country[]" multiple> 
                                                                                <option value="Afghanistan">Afghanistan</option>
                                                                                <option value="Albania">Albania</option>
                                                                                <option value="Algeria">Algeria</option>
                                                                                <option value="Andorra">Andorra</option>
                                                                                <option value="Angola">Angola</option>
                                                                                <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                                                                <option value="Argentina">Argentina</option>
                                                                                <option value="Armenia">Armenia</option>
                                                                                <option value="Australia">Australia</option>
                                                                                <option value="Austria">Austria</option>
                                                                                <option value="Azerbaijan">Azerbaijan</option>
                                                                                <option value="The Bahamas">The Bahamas</option>
                                                                                <option value="Bahrain">Bahrain</option>
                                                                                <option value="Bangladesh">Bangladesh</option>
                                                                                <option value="Barbados">Barbados</option>
                                                                                <option value="Belarus">Belarus</option>
                                                                                <option value="Belgium">Belgium</option>
                                                                                <option value="Belize">Belize</option>
                                                                                <option value="Benin">Benin</option>
                                                                                <option value="Bhutan">Bhutan</option>
                                                                                <option value="Bolivia">Bolivia</option>
                                                                                <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                                                                <option value="Botswana">Botswana</option>
                                                                                <option value="Brazil">Brazil</option>
                                                                                <option value="Brunei">Brunei</option>
                                                                                <option value="Bulgaria">Bulgaria</option>
                                                                                <option value="Burkina Faso">Burkina Faso</option>
                                                                                <option value="Burundi">Burundi</option>
                                                                                <option value="Cabo Verde">Cabo Verde</option>
                                                                                <option value="Cambodia">Cambodia</option>
                                                                                <option value="Cameroon">Cameroon</option>
                                                                                <option value="Canada">Canada</option>
                                                                                <option value="Central African Republic">Central African Republic</option>
                                                                                <option value="Chad">Chad</option>
                                                                                <option value="Chile">Chile</option>
                                                                                <option value="China">China</option>
                                                                                <option value="Colombia">Colombia</option>
                                                                                <option value="Comoros">Comoros</option>
                                                                                <option value="Congo, Democratic Republic of the">Congo, Democratic Republic of the</option>
                                                                                <option value="Congo, Republic of the">Congo, Republic of the</option>
                                                                                <option value="Costa Rica">Costa Rica</option>
                                                                                <option value="Côte d’Ivoire">Côte d’Ivoire</option>
                                                                                <option value="Croatia">Croatia</option>
                                                                                <option value="Cuba">Cuba</option>
                                                                                <option value="Cyprus">Cyprus</option>
                                                                                <option value="Czech Republic">Czech Republic</option>
                                                                                <option value="Denmark">Denmark</option>
                                                                                <option value="Djibouti">Djibouti</option>
                                                                                <option value="Dominica">Dominica</option>
                                                                                <option value="Dominican Republic">Dominican Republic</option>
                                                                                <option value="East Timor (Timor-Leste)">East Timor (Timor-Leste)</option>
                                                                                <option value="Ecuador">Ecuador</option>
                                                                                <option value="Egypt">Egypt</option>
                                                                                <option value="El Salvador">El Salvador</option>
                                                                                <option value="Equatorial Guinea">Equatorial Guinea</option>
                                                                                <option value="Eritrea">Eritrea</option>
                                                                                <option value="Estonia">Estonia</option>
                                                                                <option value="Eswatini">Eswatini</option>
                                                                                <option value="Ethiopia">Ethiopia</option>
                                                                                <option value="Fiji">Fiji</option>
                                                                                <option value="Finland">Finland</option>
                                                                                <option value="France">France</option>
                                                                                <option value="Gabon">Gabon</option>
                                                                                <option value="The Gambia">The Gambia</option>
                                                                                <option value="Georgia">Georgia</option>
                                                                                <option value="Germany">Germany</option>
                                                                                <option value="Ghana">Ghana</option>
                                                                                <option value="Greece">Greece</option>
                                                                                <option value="Grenada">Grenada</option>
                                                                                <option value="Guatemala">Guatemala</option>
                                                                                <option value="Guinea">Guinea</option>
                                                                                <option value="Guinea-Bissau">Guinea-Bissau</option>
                                                                                <option value="Guyana">Guyana</option>
                                                                                <option value="Haiti">Haiti</option>
                                                                                <option value="Honduras">Honduras</option>
                                                                                <option value="Hungary">Hungary</option>
                                                                                <option value="Iceland">Iceland</option>
                                                                                <option value="India">India</option>
                                                                                <option value="Indonesia">Indonesia</option>
                                                                                <option value="Iran">Iran</option>
                                                                                <option value="Iraq">Iraq</option>
                                                                                <option value="Ireland">Ireland</option>
                                                                                <option value="Israel">Israel</option>
                                                                                <option value="Italy">Italy</option>
                                                                                <option value="Jamaica">Jamaica</option>
                                                                                <option value="Japan">Japan</option>
                                                                                <option value="Jordan">Jordan</option>
                                                                                <option value="Kazakhstan">Kazakhstan</option>
                                                                                <option value="Kenya">Kenya</option>
                                                                                <option value="Kiribati">Kiribati</option>
                                                                                <option value="Korea, North">Korea, North</option>
                                                                                <option value="Korea, South">Korea, South</option>
                                                                                <option value="Kosovo">Kosovo</option>
                                                                                <option value="Kuwait">Kuwait</option>
                                                                                <option value="Kyrgyzstan">Kyrgyzstan</option>
                                                                                <option value="Laos">Laos</option>
                                                                                <option value="Latvia">Latvia</option>
                                                                                <option value="Lebanon">Lebanon</option>
                                                                                <option value="Lesotho">Lesotho</option>
                                                                                <option value="Liberia">Liberia</option>
                                                                                <option value="Libya">Libya</option>
                                                                                <option value="Liechtenstein">Liechtenstein</option>
                                                                                <option value="Lithuania">Lithuania</option>
                                                                                <option value="Luxembourg">Luxembourg</option>
                                                                                <option value="Madagascar">Madagascar</option>
                                                                                <option value="Malawi">Malawi</option>
                                                                                <option value="Malaysia">Malaysia</option>
                                                                                <option value="Maldives">Maldives</option>
                                                                                <option value="Mali">Mali</option>
                                                                                <option value="Malta">Malta</option>
                                                                                <option value="Marshall Islands">Marshall Islands</option>
                                                                                <option value="Mauritania">Mauritania</option>
                                                                                <option value="Mauritius">Mauritius</option>
                                                                                <option value="Mexico">Mexico</option>
                                                                                <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                                                                                <option value="Moldova">Moldova</option>
                                                                                <option value="Monaco">Monaco</option>
                                                                                <option value="Mongolia">Mongolia</option>
                                                                                <option value="Montenegro">Montenegro</option>
                                                                                <option value="Morocco">Morocco</option>
                                                                                <option value="Mozambique">Mozambique</option>
                                                                                <option value="Myanmar (Burma)">Myanmar (Burma)</option>
                                                                                <option value="Namibia">Namibia</option>
                                                                                <option value="Nauru">Nauru</option>
                                                                                <option value="Nepal">Nepal</option>
                                                                                <option value="Netherlands">Netherlands</option>
                                                                                <option value="New Zealand">New Zealand</option>
                                                                                <option value="Nicaragua">Nicaragua</option>
                                                                                <option value="Niger">Niger</option>
                                                                                <option value="Nigeria">Nigeria</option>
                                                                                <option value="North Macedonia">North Macedonia</option>
                                                                                <option value="Norway">Norway</option>
                                                                                <option value="Oman">Oman</option>
                                                                                <option value="Pakistan">Pakistan</option>
                                                                                <option value="Palau">Palau</option>
                                                                                <option value="Panama">Panama</option>
                                                                                <option value="Papua New Guinea">Papua New Guinea</option>
                                                                                <option value="Paraguay">Paraguay</option>
                                                                                <option value="Peru">Peru</option>
                                                                                <option value="Philippines">Philippines</option>
                                                                                <option value="Poland">Poland</option>
                                                                                <option value="Portugal">Portugal</option>
                                                                                <option value="Qatar">Qatar</option>
                                                                                <option value="Romania">Romania</option>
                                                                                <option value="Russia">Russia</option>
                                                                                <option value="Rwanda">Rwanda</option>
                                                                                <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                                                                <option value="Saint Lucia">Saint Lucia</option>
                                                                                <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                                                                                <option value="Samoa">Samoa</option>
                                                                                <option value="San Marino">San Marino</option>
                                                                                <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                                                                <option value="Saudi Arabia">Saudi Arabia</option>
                                                                                <option value="Senegal">Senegal</option>
                                                                                <option value="Serbia">Serbia</option>
                                                                                <option value="Seychelles">Seychelles</option>
                                                                                <option value="Sierra Leone">Sierra Leone</option>
                                                                                <option value="Singapore">Singapore</option>
                                                                                <option value="Slovakia">Slovakia</option>
                                                                                <option value="Slovenia">Slovenia</option>
                                                                                <option value="Solomon Islands">Solomon Islands</option>
                                                                                <option value="Somalia">Somalia</option>
                                                                                <option value="South Africa">South Africa</option>
                                                                                <option value="Spain">Spain</option>
                                                                                <option value="Sri Lanka">Sri Lanka</option>
                                                                                <option value="Sudan">Sudan</option>
                                                                                <option value="Sudan, South">Sudan, South</option>
                                                                                <option value="Suriname">Suriname</option>
                                                                                <option value="Sweden">Sweden</option>
                                                                                <option value="Switzerland">Switzerland</option>
                                                                                <option value="Syria">Syria</option>
                                                                                <option value="Taiwan">Taiwan</option>
                                                                                <option value="Tajikistan">Tajikistan</option>
                                                                                <option value="Tanzania">Tanzania</option>
                                                                                <option value="Thailand">Thailand</option>
                                                                                <option value="Togo">Togo</option>
                                                                                <option value="Tonga">Tonga</option>
                                                                                <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                                                                <option value="Tunisia">Tunisia</option>
                                                                                <option value="Turkey">Turkey</option>
                                                                                <option value="Turkmenistan">Turkmenistan</option>
                                                                                <option value="Tuvalu">Tuvalu</option>
                                                                                <option value="Uganda">Uganda</option>
                                                                                <option value="Ukraine">Ukraine</option>
                                                                                <option value="United Arab Emirates">United Arab Emirates</option>
                                                                                <option value="United Kingdom">United Kingdom</option>
                                                                                <option value="United States">United States</option>
                                                                                <option value="Uruguay">Uruguay</option>
                                                                                <option value="Uzbekistan">Uzbekistan</option>
                                                                                <option value="Vanuatu">Vanuatu</option>
                                                                                <option value="Vatican City">Vatican City</option>
                                                                                <option value="Venezuela">Venezuela</option>
                                                                                <option value="Vietnam">Vietnam</option>
                                                                                <option value="Yemen">Yemen</option>
                                                                                <option value="Zambia">Zambia</option>
                                                                                <option value="Zimbabwe">Zimbabwe</option>
                                                                            </select>
                                </div>
                            </div>
                            <!-- END -->
                            <!-- START -->
                            <div class="filt-com lhs-cate">
                                <p class="text-danger">Required field</p>
                                <button type="submit" class="cta-3 w-100 text-center">Search</button>
                            </div>
                            <!-- END -->
                        </form>                    </div>
                    <div class="col-md-9">
                        <div class="short-all">
                            <div class="short-lhs">
                                Showing <b>18</b> profiles
                            </div>
                            <div class="short-rhs">
                                <ul>
                                    <li>
                                        Sort by:
                                    </li>
                                    <li>
                                        <div class="form-group oldnew">
                                            <select class="chosen-select p-2" id="sortby">
                                                <option value="">Select</option>
                                                <option value="desc" >Date listed: Newest</option>
                                                <option value="asc" >Date listed: Oldest</option>
                                            </select>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="sort-grid sort-grid-1">
                                            <i class="fa fa-th-large" aria-hidden="true"></i>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="sort-grid sort-grid-2 act">
                                            <i class="fa fa-bars" aria-hidden="true"></i>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="all-list-sh">
                            <ul>
                                                                    <li>
                                        <div class="all-pro-box user-avil-onli head-pro2" data-useravil="avilyes" data-aviltxt="Available online">
                                            <!--PROFILE IMAGE-->
                                            <div class="pro-img">
                                                <div class="slid-inn pr-bio-c wedd-rel-pro sliderarrow m-0">
                                                    <ul class="slider5">
                                                                                                                <li>
                                                            <div class="wedd-rel-box">
                                                                <div class="wedd-rel-img">
                                                                    <img src="userphoto/d.png" alt="">
                                                                </div>
                                                            </div>
                                                        </li>
                                                                                                            </ul>
                                                </div>
                                            </div>
                                            <!--END PROFILE IMAGE-->
    
                                            <!--PROFILE NAME-->
                                            <div class="pro-detail">
                                                <h4><a href="#">test</a></h4>
                                                <div>
                                                    DR251118201022                                                                                                    </div>
                                                <div class="pro-info-status mobile mb-2">
                                                                                                    </div>
                                                <div class="pro-bio m-0 b-0 pb-1">
                                                    <span>25 Yrs</span>
                                                    <span>4 Feet 7 Inches</span>
                                                    <span>Divorced</span>
                                                    <span>Muslim, Ansari (Shia)</span>
                                                </div>    
                                                <div class="pro-bio m-0 pt-0">
                                                    <span>B.Ed</span>
                                                    <span>Company Secretary</span>
                                                                                                        <span>Tangla, Assam</span>
                                                </div>
                                                <div class="links">
                                                    <a href="#">Profile</a>
                                                    <a href="#">Contact</a>
                                                    <a href="#">Shortlist</a>
                                                    <a href="#">WhatsApp</a>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-outline-secondary blockreport" data-bs-toggle="dropdown">
                                                            <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                                                                                    <li><a class="dropdown-item" href="#">Block</a></li>
                                                                                                                    <li><a class="dropdown-item" href="#">Report</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                        
                                                <!--SAVE-->
                                                                                                <!--END SAVE-->
                                            </div>
                                            <!--END PROFILE NAME-->
                                        </div>
                                    </li>
                                                                        <li>
                                        <div class="all-pro-box user-avil-onli head-pro2" data-useravil="avilyes" data-aviltxt="Available online">
                                            <!--PROFILE IMAGE-->
                                            <div class="pro-img">
                                                <div class="slid-inn pr-bio-c wedd-rel-pro sliderarrow m-0">
                                                    <ul class="slider5">
                                                                                                                <li>
                                                            <div class="wedd-rel-box">
                                                                <div class="wedd-rel-img">
                                                                    <img src="userphoto/1763450878_modern-stone-brick-wall-background-stone-texture.jpg" alt="">
                                                                </div>
                                                            </div>
                                                        </li>
                                                                                                                <li>
                                                            <div class="wedd-rel-box">
                                                                <div class="wedd-rel-img">
                                                                    <img src="userphoto/1763454144_d.png" alt="">
                                                                </div>
                                                            </div>
                                                        </li>
                                                                                                                <li>
                                                            <div class="wedd-rel-box">
                                                                <div class="wedd-rel-img">
                                                                    <img src="userphoto/1763450878_b.png" alt="">
                                                                </div>
                                                            </div>
                                                        </li>
                                                                                                                <li>
                                                            <div class="wedd-rel-box">
                                                                <div class="wedd-rel-img">
                                                                    <img src="userphoto/1763450878_f.png" alt="">
                                                                </div>
                                                            </div>
                                                        </li>
                                                                                                            </ul>
                                                </div>
                                            </div>
                                            <!--END PROFILE IMAGE-->
    
                                            <!--PROFILE NAME-->
                                            <div class="pro-detail">
                                                <h4><a href="#">suhailkhan</a></h4>
                                                <div>
                                                    DR251117101617                                                                                                    </div>
                                                <div class="pro-info-status mobile mb-2">
                                                                                                    </div>
                                                <div class="pro-bio m-0 b-0 pb-1">
                                                    <span>23 Yrs</span>
                                                    <span>4 Feet 6 Inches</span>
                                                    <span>Divorced</span>
                                                    <span>Muslim, Other (Sunni)</span>
                                                </div>    
                                                <div class="pro-bio m-0 pt-0">
                                                    <span>BCA</span>
                                                    <span>Web/UX Designer</span>
                                                                                                        <span>Tangla, test</span>
                                                </div>
                                                <div class="links">
                                                    <a href="#">Profile</a>
                                                    <a href="#">Contact</a>
                                                    <a href="#">Shortlist</a>
                                                    <a href="#">WhatsApp</a>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-outline-secondary blockreport" data-bs-toggle="dropdown">
                                                            <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                                                                                    <li><a class="dropdown-item" href="#">Block</a></li>
                                                                                                                    <li><a class="dropdown-item" href="#">Report</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                        
                                                <!--SAVE-->
                                                                                                <!--END SAVE-->
                                            </div>
                                            <!--END PROFILE NAME-->
                                        </div>
                                    </li>
                                                                        <li>
                                        <div class="all-pro-box user-avil-onli head-pro2" data-useravil="avilyes" data-aviltxt="Available online">
                                            <!--PROFILE IMAGE-->
                                            <div class="pro-img">
                                                <div class="slid-inn pr-bio-c wedd-rel-pro sliderarrow m-0">
                                                    <ul class="slider5">
                                                                                                                <li>
                                                            <div class="wedd-rel-box">
                                                                <div class="wedd-rel-img">
                                                                    <img src="userphoto/1000039167.jpg" alt="">
                                                                </div>
                                                            </div>
                                                        </li>
                                                                                                            </ul>
                                                </div>
                                            </div>
                                            <!--END PROFILE IMAGE-->
    
                                            <!--PROFILE NAME-->
                                            <div class="pro-detail">
                                                <h4><a href="#">Karan Sehgal</a></h4>
                                                <div>
                                                    DR250208133649                                                                                                    </div>
                                                <div class="pro-info-status mobile mb-2">
                                                                                                    </div>
                                                <div class="pro-bio m-0 b-0 pb-1">
                                                    <span>37 Yrs</span>
                                                    <span>4 Feet 8 Inches</span>
                                                    <span>Never Married</span>
                                                    <span>Hindu, Agamudayar</span>
                                                </div>    
                                                <div class="pro-bio m-0 pt-0">
                                                    <span>BCS</span>
                                                    <span>Banking Professional</span>
                                                                                                        <span>Anwari, Bihar</span>
                                                </div>
                                                <div class="links">
                                                    <a href="#">Profile</a>
                                                    <a href="#">Contact</a>
                                                    <a href="#">Shortlist</a>
                                                    <a href="#">WhatsApp</a>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-outline-secondary blockreport" data-bs-toggle="dropdown">
                                                            <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                                                                                    <li><a class="dropdown-item" href="#">Block</a></li>
                                                                                                                    <li><a class="dropdown-item" href="#">Report</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                        
                                                <!--SAVE-->
                                                                                                <!--END SAVE-->
                                            </div>
                                            <!--END PROFILE NAME-->
                                        </div>
                                    </li>
                                                                </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END -->
    
    <!-- START -->
    <section>
        <div class="blog-main">
            <div class="container">
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <div class="page-nation">
                            <ul class="pagination pagination-sm">
                                                                <li class="page-item "><a class="page-link" href="search-profile.php?page=1">1</a></li>
                                                                <li class="page-item "><a class="page-link" href="search-profile.php?page=2">2</a></li>
                                                                <li class="page-item "><a class="page-link" href="search-profile.php?page=3">3</a></li>
                                                                <li class="page-item "><a class="page-link" href="search-profile.php?page=4">4</a></li>
                                                                <li class="page-item "><a class="page-link" href="search-profile.php?page=5">5</a></li>
                                                                <li class="page-item"><a class="page-link" href="search-profile.php?page=1">Next</a></li>
                                                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
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
                    <p>Email: <a href="mailto:support@desi-rishta.com">support@desi-rishta.com.</a></p>
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
                           <li><a href="faqterms.php">Terms and Conditions </a>
                        </li>
                         <li><a href="faqprivacy.php">Privacy policy</a>
                        </li>
                         <li><a href="faqcookies.php"> Cookies policy </a>
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
            <strong>Copied!</strong> link has been copied.
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

<script>
$(document).ready(function () {
   
    $("#banner-search-form").submit(function (event) {
        
        // Saari values check karein
        var lookingFor = $('#looking_for').val();
        var ageFrom = $('#age_from').val();
        var ageTo = $('#age_to').val();
        var religion = $('#religion').val();
        var city = $('#city').val();

        
        if (lookingFor === "" && ageFrom === "" && ageTo === "" && religion === "" && city === "") {
            
          
            event.preventDefault(); 
            
          
            $("#search-alert").show();
        } else {
           
            $("#search-alert").hide();
        }
    });
});
</script>
</body>
</html>
<style>
    @media (min-width: 768px) {
    .col-md-4 {
        flex: 0 0 auto;
        width: 33.333333%;
    }
}
</style> 