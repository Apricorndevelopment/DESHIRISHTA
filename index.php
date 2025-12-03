<?php
include 'header.php';

if(isset($_COOKIE['dr_userid']) && $_COOKIE['dr_userid'] != '')
{
header('location:user-dashboard.php');
    exit;
}
// 1. Default (static) values set karein
$couples_paired = 200;
$total_registrants = 1500;
$total_men = 700;
$total_women = 800;

// 2. Database se admin-dwara set ki gayi values laayein
// (Aapki sociallink.php file $con variable ka istemaal karti hai)
$sql_stats = "SELECT * FROM tbl_homepage_stats WHERE id=1";
$stats_result = mysqli_query($con, $sql_stats);

if ($stats_result && mysqli_num_rows($stats_result) > 0) {
    $stats_row = mysqli_fetch_assoc($stats_result);
    $couples_paired = $stats_row['couples_paired'];
    $total_registrants = $stats_row['total_registrants'];
    $total_men = $stats_row['total_men'];
    $total_women = $stats_row['total_women'];
}

$couples_sql = "SELECT * FROM tbl_recent_couples ORDER BY date_added DESC LIMIT 8"; // Slider ke liye 8 limit
$couples_result = mysqli_query($con, $couples_sql);

$team_sql = "SELECT * FROM tbl_team ORDER BY id ASC LIMIT 8";
$team_result = mysqli_query($con, $team_sql);

?>
<style>
    /* Search Banner Dropdown Styling */
.ban-search .chosen-container .chosen-single {
    height: 48px !important;
    line-height: 40px !important;
    padding-left: 12px !important;
    border-radius: 8px !important;
    outline: none !important;
    border: none !important;
    background: #ffffff !important;
    box-shadow: none !important;
    text-align: left !important;
}

.ban-search .chosen-container .chosen-single span {
    margin: 0 !important;
    padding: 0 !important;
    text-align: left !important;
}

/* Remove default huge padding of chosen dropdown */
.ban-search .chosen-container .chosen-drop {
    border-radius: 8px;
    padding-left: 0 !important;
}

/* Dropdown list text left aligned */
.ban-search .chosen-container .chosen-results li {
    padding-left: 12px !important;
    text-align: left !important;
}

/* Label ko bilkul neat rakhna */
.ban-search .form-group label {
    margin-bottom: 5px;
    font-size: 14px;
    font-weight: 600;
    color: #fff; /* You can change if needed */
}

/* Input boxes (Chosen wrapper) spacing fix */
.ban-search .form-group {
    margin-bottom: 12px;
}

</style>
    <!-- BANNER & SEARCH -->
<section>
        <div class="str">
            <div class="hom-head">
                <div class="container">
                    <div class="row">
                        <div class="hom-ban">
                            <div class="ban-tit">
                                <!--<span><i class="no1">#1</i> Matrimony</span>-->
                                <h1>Find your<br><b>Right Match</b> here</h1>
                                <p>Most Trusted Matrimony & True Matchmaking Service Brand.</p>
                            </div>
                            <!-- <div class="ban-search chosenini">
                                <form action="search-profile.php" method="post">
                                    <ul>
                                        <li class="sr-look">
                                            <div class="form-group">
                                                <label>I'm looking for</label>
                                                <select class="chosen-select">
                                                    <option value="">I'm looking for</option>
                                                    <option value="Men">Men</option>
                                                    <option value="Women">Women</option>
                                                </select>
                                            </div>
                                        </li>
                                        <li class="sr-age">
                                            <div class="form-group">
                                                <label>Age From</label>
                                                <select class="chosen-select">
                                                    <option value="">Age From</option>
                                                    <option value="">25</option>
                                                    <option value="">26</option>
                                                    <option value="">27</option>
                                                    <option value="">28</option>
                                                    <option value="">29</option>
                                                    <option value="">30</option>
                                                </select>
                                            </div>
                                        </li>
                                        <li class="sr-age">
                                            <div class="form-group">
                                                <label>Age To</label>
                                                <select class="chosen-select">
                                                    <option value="">Age To</option>
                                                    <option value="">31</option>
                                                    <option value="">32</option>
                                                    <option value="">33</option>
                                                    <option value="">34</option>
                                                    <option value="">35</option>
                                                    <option value="">36</option>
                                                </select>
                                            </div>
                                        </li>
                                        <li class="sr-reli">
                                            <div class="form-group">
                                                <label>Religion</label>
                                                <select class="chosen-select">
                                                    <option>Religion</option>
                                                    <option>Any</option>
                                                    <option>Hindu</option>
                                                    <option>Muslim</option>
                                                    <option>Jain</option>
                                                    <option>Christian</option>
                                                </select>
                                            </div>
                                        </li>
                                        <li class="sr-cit">
                                            <div class="form-group">
                                                <label>City</label>
                                                <select class="chosen-select">
                                                    <option>Location</option>
                                                    <option>Any location</option>
                                                    <option>Chennai</option>
                                                    <option>New york</option>
                                                    <option>Perth</option>
                                                    <option>London</option>
                                                </select>
                                            </div>
                                        </li>
                                        <li class="sr-btn">
                                            <input type="submit" value="Let’s Begin ">
                                        </li>
                                    </ul>
                                </form>
                            </div> -->
                       
                       <div class="ban-search chosenini">
    <form action="search-profile1.php" method="post" id="banner-search-form">
        <ul>
            <li class="sr-look">
                <div class="form-group">
                    <label>I'm looking for</label>
                    <select class="chosen-select" name="looking_for" id="looking_for">
                        <option value="">I'm looking for</option>
                        <option value="Men">Men</option>
                        <option value="Women">Women</option>
                    </select>
                </div>
            </li>
            <li class="sr-age">
                <div class="form-group">
                    <label>Age From</label>
                    <select class="chosen-select" name="age_from" id="age_from">
                        <option value="">Age From</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                    </select>
                </div>
            </li>
            <li class="sr-age">
                <div class="form-group">
                    <label>Age To</label>
                    <select class="chosen-select" name="age_to" id="age_to">
                        <option value="">Age To</option>
                        <option value="31">31</option>
                        <option value="32">32</option>
                        <option value="33">33</option>
                        <option value="34">34</option>
                        <option value="35">35</option>
                        <option value="36">36</option>
                    </select>
                </div>
            </li>
            <li class="sr-reli">
                <div class="form-group">
                    <label>Religion</label>
                    <select class="chosen-select" name="religion" id="religion">
                        <option value="">Religion</option> <option value="Any">Any</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Muslim">Muslim</option>
                        <option value="Jain">Jain</option>
                        <option value="Christian">Christian</option>
                    </select>
                </div>
            </li>
            <li class="sr-cit">
                <div class="form-group">
                    <label>City</label>
                    <select class="chosen-select" name="city" id="city">
                        <option value="">Location</option> <option value="Any location">Any location</option>
                        <option value="Chennai">Chennai</option>
                        <option value="New york">New york</option>
                        <option value="Perth">Perth</option>
                        <option value="London">London</option>
                    </select>
                </div>
            </li>
            <li class="sr-btn">
                <input type="submit" value="Let’s Begin ">
                <br>
                <small id="search-alert" style="color: red; display: none; font-weight: bold;">
                    Please fill at least one field.
                </small>
            </li>
        </ul>
    </form>
</div>
                       
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END -->

    <!-- BANNER SLIDER -->
    <section>
        <div class="hom-ban-sli">
            <div>
                <ul class="ban-sli">
                    <li>
                        <div class="image">
                            <img src="images/ban-bg.jpg" alt="" loading="lazy">
                        </div>
                    </li>
                    <li>
                        <div class="image">
                            <img src="images/banner.jpg" alt="" loading="lazy">
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <!-- END -->

    <!-- TRUST BRANDS -->
    <section>
        <div class="hom-cus-revi">
            <div class="container">
                <div class="row">
                    <div class="home-tit">
                        <p>trusted brand</p>
                        <h2><span>Why Choose us</span></h2>
                        <span class="leaf1"></span>
                        <span class="tit-ani-"></span>
                    </div>
                    <div class="slid-inn cus-revi">
                        <ul class="slider4">
                            <li>
                                <div class="cus-revi-box">
                                    <div class="revi-im">
                                        <img src="images/happy-customer.gif" alt="" loading="lazy">
                                        <i class="cir-com cir-1"></i>
                                        <i class="cir-com cir-2"></i>
                                        <i class="cir-com cir-3"></i>
                                    </div>
                                    <h5>Goverment ID Verified </h5>
                                    <p>All onboard profiles are 100% Goverment ID verified only</p>
                                </div>
                            </li>
                            <li>
                                <div class="cus-revi-box">
                                    <div class="revi-im">
                                        <img src="images/clipboard.gif" alt="" loading="lazy">
                                        <i class="cir-com cir-1"></i>
                                        <i class="cir-com cir-2"></i>
                                        <i class="cir-com cir-3"></i>
                                    </div>
                                    <h5>Genuine Profiles</h5>
                                    <p>100% manually screened profiles to restrict contents/photos</p>
                                </div>
                            </li>
                            <li>
                                <div class="cus-revi-box">
                                    <div class="revi-im">
                                        <img src="images/protected-file.gif" alt="" loading="lazy">
                                        <i class="cir-com cir-1"></i>
                                        <i class="cir-com cir-2"></i>
                                        <i class="cir-com cir-3"></i>
                                    </div>
                                    <h5>Control over Privacy</h5>
                                    <p>Restrict unwanted access to contact details & photos/videos</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END -->
    
    <!-- COUNTS START -->
  

    <section>
    <div class="ab-cont">
        <div class="container">
            <div class="row">
                <div class="sub-tit-caps">
                    <h2>Membership <span class="animate animate__animated" data-ani="animate__flipInX" data-dely="0.1">Analytics</span></h2>
                </div>
                <ul>
                    <li>
                        <div class="ab-cont-po">
                            <i class="fa-regular fa-heart" aria-hidden="true"></i> 
                            <div>
                                <h4><span class="counter" data-count="<?php echo $couples_paired; ?>">0</span>+</h4>
                                <span>Couples pared</span>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="ab-cont-po">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            <div>
                                <h4><span class="counter" data-count="<?php echo $total_registrants; ?>">0</span>+</h4>
                                <span>Registered</span>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="ab-cont-po">
                            <i class="fa fa-male" aria-hidden="true"></i>
                            <div>
                                <h4><span class="counter" data-count="<?php echo $total_men; ?>">0</span>+</h4>
                                <span>Mens</span>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="ab-cont-po">
                            <i class="fa fa-female" aria-hidden="true"></i>
                            <div>
                                <h4><span class="counter" data-count="<?php echo $total_women; ?>">0</span>+</h4>
                                <span>Womens</span>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Cookie Policy Popup -->
<div id="cookie-popup" style="
    display: flex;
    flex-direction: column;
    position: fixed;
    bottom: 24px;
    right: 24px;
    background: #b16421ff;
    border-radius: 16px;
    box-shadow: 0 2px 8px rgba(0,0,0, 0.15);
    padding: 28px 32px;
    color: #fff;
    max-width: 360px;
    z-index: 2000;
    left: 25px;
    font-family: Arial, sans-serif;
">
    <div style="font-size: 20px; font-weight: bold; margin-bottom: 8px;">We value your privacy</div>
    <div style="font-size: 15px; margin-bottom: 24px;">
        We use cookies and tracking technologies to enhance your browsing experience, deliver personalized ads, and analyse traffic.
        By clicking "Accept all cookies", you consent to our use of cookies.
        For more details, visit our <a href="cookie-policy.html" style="color: #fff; text-decoration:underline;" target="_blank">Cookie Policy</a>.
    </div>
    <div style="display: flex; gap: 14px;">
        <button id="accept-cookies" style="background:#fff;color:#985b24;border:none;padding:10px 21px;border-radius:8px;font-weight:bold;cursor:pointer;transition:background 0.2s;">
            Accept all
        </button>
        <button id="reject-cookies" style="background:transparent;color:#fff;border:1px solid #fff;padding:10px 21px;border-radius:8px;font-weight:bold;cursor:pointer;transition:background 0.2s;">
            Reject all
        </button>
    </div>
</div>
<script>
    // Show the popup only if not yet chosen
    if (!localStorage.getItem("cookiesChoice")) {
        document.getElementById('cookie-popup').style.display = 'flex';
    } else {
        document.getElementById('cookie-popup').style.display = 'none';
    }
    document.getElementById('accept-cookies').onclick = function() {
        localStorage.setItem("cookiesChoice", "accepted");
        document.getElementById('cookie-popup').style.display = 'none';
    };
    document.getElementById('reject-cookies').onclick = function() {
        localStorage.setItem("cookiesChoice", "rejected");
        document.getElementById('cookie-popup').style.display = 'none';
    };
</script>

<style> 
.ab-cont ul li .ab-cont-po div span {
    text-transform: uppercase;
    font-size: 16px;
    font-weight: 500;
}
</style>
    <!-- END -->
<style>
/* === Slick Slider Arrow Alignment Fix === */

/* 1. Main container ko relative banayein */
.hom-coup-test {
    position: relative;
    padding: 0 40px; /* Arrows ke liye side mein jagah banayein */
}

/* 2. Arrows ko style karein (Prev aur Next) */
.couple-sli .slick-prev,
.couple-sli .slick-next {
    position: absolute;
    top: 50%; /* Vertical center */
    transform: translateY(-50%);
    z-index: 10; /* Taaki yeh images ke upar dikhe */
    
    /* Button styling */
    background: rgba(110, 218, 60, 0.4);
    color: white;
    border: none;
    height: 45px;
    width: 45px;
    font-size: 0px;
    border-radius: 50%;
    cursor: pointer;
    transition: all 0.3s ease;
}

.couple-sli .slick-prev:hover,
.couple-sli .slick-next:hover {
    background: rgba(0, 0, 0, 0.7);
}

/* 3. Arrow ki position set karein */
.couple-sli .slick-prev {
    left: 10px; /* Left arrow */
}

.couple-sli .slick-next {
    right: 10px; /* Right arrow */
}

/* 4. Slick default icons ko fit karein (Aapke project mein FontAwesome hai) */
.couple-sli .slick-prev::before {
    content: '\f104'; /* FontAwesome Left Arrow */
    font-family: 'FontAwesome';
    line-height: 45px;
}

.couple-sli .slick-next::before {
    content: '\f105'; /* FontAwesome Right Arrow */
    font-family: 'FontAwesome';
    line-height: 45px;
}

</style>
    <!-- MOMENTS START -->
    <section>
        <div class="wedd-tline">
            <div class="container">
                <div class="row">
                    <div class="wedd-shap">
                        <span class="abo-shap-1"></span>
                        <span class="abo-shap-2"></span>
                        <span class="abo-shap-4"></span>
                        <span class="abo-shap-5"></span>
                    </div>
                    <div class="home-tit">
                        <p>Moments</p>
                        <h2><span>How it works</span></h2>
                        <span class="leaf1"></span>
                        <span class="tit-ani-"></span>
                    </div>
                    <div class="inn">
                        <ul>
                            <li>
                                <div class="tline-inn">
                                    <div class="tline-im animate animate__animated animate__slower"
                                        data-ani="animate__fadeInUp">
                                        <img src="images/icon/ring.jpeg" alt="" loading="lazy">
                                    </div>
                                    <div class="tline-con animate animate__animated animate__slow"
                                        data-ani="animate__fadeInUp">
                                        <h5>Register</h5>
                                        <!--<span>Timing: 7:00 PM</span>-->
                                        <p>Embark on your journey to find a life companion by creating your tailored profile</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="tline-inn tline-inn-reve">
                                    <div class="tline-con animate animate__animated animate__slower"
                                        data-ani="animate__fadeInUp">
                                        <h5>Find your Match</h5>
                                        <!--<span>Timing: 7:00 PM</span>-->
                                        <p>Discover a diverse range of compatible profiles within our extensive database</p>
                                    </div>
                                    <div class="tline-im animate animate__animated animate__slow"
                                        data-ani="animate__fadeInUp">
                                        <img src="images/icon/match.jpeg" alt="" loading="lazy">
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="tline-inn">
                                    <div class="tline-im animate animate__animated animate__slow"
                                        data-ani="animate__fadeInUp">
                                        <img src="images/icon/profileinfo.jpeg" alt="" loading="lazy">
                                    </div>
                                    <div class="tline-con animate animate__animated animate__slower"
                                        data-ani="animate__fadeInUp">
                                        <h5>Get Profile Information</h5>
                                        <!--<span>Timing: 7:00 PM</span>-->
                                        <p>Delve into detailed profiles to gain valuable insights into personalities and preferences</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="tline-inn tline-inn-reve">
                                    <div class="tline-con animate animate__animated animate__slow"
                                        data-ani="animate__fadeInUp">
                                        <h5>Contact</h5>
                                        <!--<span>Timing: 7:00 PM</span>-->
                                        <p>Initiate meaningful conversations with potential matches to explore compatibility</p>
                                    </div>
                                    <div class="tline-im animate animate__animated animate__slower"
                                        data-ani="animate__fadeInUp">
                                        <img src="images/icon/contact.jpeg" alt="" loading="lazy">
                                    </div>
                                </div>
                            </li>
                            
                            <li>
                                <div class="tline-inn">
                                    <div class="tline-im animate animate__animated animate__slower"
                                        data-ani="animate__fadeInUp">
                                        <img src="images/icon/meet.jpeg" alt="" loading="lazy">
                                    </div>
                                    <div class="tline-con animate animate__animated animate__slow"
                                        data-ani="animate__fadeInUp">
                                        <h5>Start Meetups</h5>
                                        <!--<span>Timing: 7:00 PM</span>-->
                                        <p>Foster deeper connections through arranged meetups or virtual interactions</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="tline-inn tline-inn-reve">
                                    <div class="tline-con animate animate__animated animate__slower"
                                        data-ani="animate__fadeInUp">
                                        <h5>Getting Married</h5>
                                        <!--<span>Timing: 7:00 PM</span>-->
                                        <p>Seamlessly transition from courtship to matrimony with our steadfast support and guidance</p>
                                    </div>
                                    <div class="tline-im animate animate__animated animate__slow"
                                        data-ani="animate__fadeInUp">
                                        <img src="images/icon/married.jpeg" alt="" loading="lazy">
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END -->
      
   <section>
    <div class="hom-couples-all">
        <div class="container">
            <div class="row">
                <div class="home-tit">
                    <p>trusted brand</p>
                    <h2><span>Recent Couples</span></h2>
                    <span class="leaf1"></span>
                    <span class="tit-ani-"></span>
                </div>
            </div>
        </div>
        <div class="hom-coup-test">
            <ul class="couple-sli">
                
                <?php
                // Check karein ki couples hain ya nahi
                if ($couples_result && mysqli_num_rows($couples_result) > 0) {
                    
                    // Har couple ke liye loop chalayein
                    while ($couple = mysqli_fetch_assoc($couples_result)) {
                        
                        // Admin se image ka sirf naam (e.g., '6.jpg') save karein
                        $image_path = 'images/couples/' . $couple['image']; 
                ?>

                <li>
                    <div class="hom-coup-box">
                        <img src="<?php echo $image_path; ?>" alt="<?php echo htmlspecialchars($couple['couple_name']); ?>" loading="lazy">
                        <div class="bx">
                            <h4><?php echo htmlspecialchars($couple['couple_name']); ?> <span><?php echo htmlspecialchars($couple['location']); ?></span></h4>
                            <a href="recent-couples.php" class="sml-cta cta-dark">View more</a>
                        </div>
                    </div>
                </li>

                <?php
                    } // while loop yahan khatm
                } else {
                    // Agar DB mein koi couple nahi hai
                    echo "<li><div class='hom-coup-box'><p>No recent couples to display.</p></div></li>";
                }
                ?>
                
            </ul>
        </div>
    </div>
</section>
    <!-- END -->
    
    <!-- TEAM START -->
    <!-- <section>
        <div class="ab-team">
            <div class="container">
                <div class="row">
                    <div class="home-tit">
                        <p>OUR PROFESSIONALS</p>
                        <h2><span>Meet Our Team</span></h2>
                        <span class="leaf1"></span>
                    </div>
                    <ul>
                        <li>
                            <div>
                                <img src="images/profiles/6.jpg" alt="" loading="lazy">
                                <h4>Ashley Jen</h4>
                                <p>Marketing Manager</p>
                                <ul class="social-light">
                                    <li><a href="#!"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                    <li><a href="#!"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                    <li><a href="#!"><i class="fa fa-whatsapp" aria-hidden="true"></i></a></li>
                                    <li><a href="#!"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                    <li><a href="#!"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <div>
                                <img src="images/profiles/7.jpg" alt="" loading="lazy">
                                <h4>Ashley Jen</h4>
                                <p>Marketing Manager</p>
                                <ul class="social-light">
                                    <li><a href="#!"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                    <li><a href="#!"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                    <li><a href="#!"><i class="fa fa-whatsapp" aria-hidden="true"></i></a></li>
                                    <li><a href="#!"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                    <li><a href="#!"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <div>
                                <img src="images/profiles/8.jpg" alt="" loading="lazy">
                                <h4>Emily Arrov</h4>
                                <p>Creative Manager</p>
                                <ul class="social-light">
                                    <li><a href="#!"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                    <li><a href="#!"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                    <li><a href="#!"><i class="fa fa-whatsapp" aria-hidden="true"></i></a></li>
                                    <li><a href="#!"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                    <li><a href="#!"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <div>
                                <img src="images/profiles/9.jpg" alt="" loading="lazy">
                                <h4>Julia sear</h4>
                                <p>Client Coordinator</p>
                                <ul class="social-light">
                                    <li><a href="#!"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                    <li><a href="#!"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                    <li><a href="#!"><i class="fa fa-whatsapp" aria-hidden="true"></i></a></li>
                                    <li><a href="#!"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                    <li><a href="#!"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section> -->
    <!-- END -->
<style>
/* === Team Slider Arrow Alignment Fix === */
.ab-team-test {
    position: relative;
    padding: 0 40px; /* Arrows ke liye side mein jagah */
}

.team-slider .slick-prev,
.team-slider .slick-next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 10;
    
    background: rgba(0, 0, 0, 0.4);
    color: white;
    border: none;
    height: 45px;
    width: 45px;
    border-radius: 50%;
    cursor: pointer;
    transition: all 0.3s ease;
    
    font-size: 0;  /* Text ko hide karega */
    line-height: 0; /* Text ko hide karega */
}

.team-slider .slick-prev:hover,
.team-slider .slick-next:hover {
    background: rgba(0, 0, 0, 0.7);
}

.team-slider .slick-prev { left: 10px; }
.team-slider .slick-next { right: 10px; }

/* Icon ko wapas dikhane ke liye */
.team-slider .slick-prev::before,
.team-slider .slick-next::before {
    font-family: 'FontAwesome';
    font-size: 20px;
    line-height: 45px; /* Button ke center mein */
}

.team-slider .slick-prev::before { content: '\f104'; } /* Left arrow icon */
.team-slider .slick-next::before { content: '\f105'; } /* Right arrow icon */

</style>
<section>
    <div class="ab-team">
        <div class="container">
            <div class="row">
                <div class="home-tit">
                    <p>OUR PROFESSIONALS</p>
                    <h2><span>Meet Our Team</span></h2>
                    <span class="leaf1"></span>
                </div>

                <div class="ab-team-test"> 
                    <ul class="team-slider">

                        <?php
                        if ($team_result && mysqli_num_rows($team_result) > 0) {
                            while ($member = mysqli_fetch_assoc($team_result)) {
                                $image_path = 'images/profiles/' . $member['image'];
                        ?>

                        <li>
                            <div>
                                <img src="<?php echo $image_path; ?>" alt="<?php echo htmlspecialchars($member['name']); ?>" loading="lazy">
                                <h4><?php echo htmlspecialchars($member['name']); ?></h4>
                                <p><?php echo htmlspecialchars($member['designation']); ?></p>
                                <ul class="social-light">
                                    <?php if(!empty($member['facebook'])) { ?>
                                        <li><a href="<?php echo htmlspecialchars($member['facebook']); ?>" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
                                    <?php } ?>
                                    <?php if(!empty($member['twitter'])) { ?>
                                        <li><a href="<?php echo htmlspecialchars($member['twitter']); ?>" target="_blank"><i class="fa-brands fa-x-twitter"></i>
</a></li>
                                    <?php } ?>
                                    <?php if(!empty($member['whatsapp'])) { ?>
                                        <li><a href="<?php echo htmlspecialchars($member['whatsapp']); ?>" target="_blank"><i class="fa-brands fa-whatsapp"></i></a></li>
                                    <?php } ?>
                                    <?php if(!empty($member['linkedin'])) { ?>
                                        <li><a href="<?php echo htmlspecialchars($member['linkedin']); ?>" target="_blank"><i class="fa-brands fa-linkedin"></i></a></li>
                                    <?php } ?>
                                    <?php if(!empty($member['instagram'])) { ?>
                                        <li><a href="<?php echo htmlspecialchars($member['instagram']); ?>" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </li>

                        <?php
                            } // while loop ends
                        } else {
                            echo "<li><div><p>No team members found.</p></div></li>";
                        }
                        ?>
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>


    <!-- BLOG POSTS START -->
    <section>
        <div class="hom-blog slid-inn">
            <div class="container">
                <div class="row">
                    <div class="home-tit mb-0">
                        <p>Blog posts</p>
                        <h2><span>Blog & Articles</span></h2>
                        <span class="leaf1"></span>
                        <span class="tit-ani-"></span>
                    </div>
                    <div class="blog cus-revi pt-4">
                        <ul class="slider4">
                            <?php
                            $sqlblog = "select * from blogs order by id desc limit 10";
                            $resultblog = mysqli_query($con,$sqlblog);
                            while($rowblog = mysqli_fetch_assoc($resultblog))
                            {
                            ?>
                            <li>
                                <div class="blog-box">
                                    <img src="controller/blogimages/<?php echo $rowblog['blogimages']; ?>" alt="" loading="lazy">
                                    <span><?php echo $rowblog['category']; ?></span>
                                    <h2><?php echo $rowblog['heading']; ?></h2>
                                    <p class="text-justify"><?php echo $rowblog['shortcontent']; ?></p>
                                    <a href="blog-detail.php?url=<?php echo $rowblog['url'].'_'.$rowblog['id'];?>" class="cta-dark"><span>Read more</span></a>
                                </div>
                            </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
/* === BLOG CARD SLIDER - COMPLETE FIX v2 (Gaps, Align, Button, Line-Clamp) === */

/* 1. Slider ko setup karna */
ul.slider4 .slick-slide {
    padding: 0 10px; /* Cards ke beech mein gap */
    height: auto;
}
ul.slider4 .slick-slide > div,
ul.slider4 .slick-slide li {
     height: 100%; 
}

/* 2. Card (.blog-box) ki styling */
.blog-box {
    display: flex !important; 
    flex-direction: column; /* Content ko upar se neeche align karega */
    height: 100%; /* Taaki sab cards barabar height ke hon */
    border: 1px solid #f0f0f0;
    border-radius: 8px;
    overflow: hidden;
    background: #fff;
}

/* 3. Image ki height fix karna */
.blog-box img {
    width: 100%;
    height: 220px;  /* Fixed height */
    object-fit: cover; 
    flex-shrink: 0;
}

/* 4. Card content ki spacing */
.blog-box span {
    padding: 0 15px;
    margin-top: 15px;
    color: #888;
    font-size: 0.9rem;
}
.blog-box h2 {
    padding: 0 15px;
    font-size: 1.2rem;
    margin-top: 10px;
    /* Aapke original CSS se */
    margin-bottom: 15px;
}

/* 5. DESCRIPTION KO 4 LINE MEIN FIX KARNA */
.blog-box p {
    padding: 0 15px;
    margin-top: 0px; /* h2 se margin le liya hai */
    margin-bottom: 20px;
    color: #666;
    flex-grow: 1; /* Button ko neeche push karne ke liye */

    /* === Line clamp code === */
    line-height: 1.5; /* Line height set karein */
    max-height: 6em; /* 4 lines * 1.5em = 6em */
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 4; /* 4 lines */
    -webkit-box-orient: vertical;
}

/* 6. Button ko chhota aur align karna */
.blog-box .cta-dark {
    padding: 8px 18px; 
    font-size: 0.85rem;
    margin: 0 15px 20px 15px; 
    align-self: flex-start;  
    flex-shrink: 0; 
    /* float: left ko CSS se hataya */
}

/* === SLIDER ARROW FIX (CUT-OFF PROBLEM) === */
.slid-inn .slick-prev,
.slid-inn .slick-next {
    position: absolute;
    top: 55%;
    transform: translateY(-50%);
    z-index: 10; /* Arrows ko upar laane ke liye */
    background: rgba(81, 83, 228, 0.5);
    color: white;
    border: none;
    height: 40px;
    width: 40px;
    border-radius: 50%;
    font-size: 0;
    cursor: pointer;
}
.slid-inn .slick-prev:hover,
.slid-inn .slick-next:hover {
    background: rgba(0, 0, 0, 0.8);
}

/* Arrows ko container ke andar rakha */
.slid-inn .slick-prev { left: 15px; } /* -15px se 15px kiya */
.slid-inn .slick-next { right: 15px; } /* -15px se 15px kiya */

.slid-inn .slick-prev::before,
.slid-inn .slick-next::before {
    font-family: 'FontAwesome';
    font-size: 18px;
    line-height: 40px;
}
.slid-inn .slick-prev::before { content: '\f104'; }
.slid-inn .slick-next::before { content: '\f105'; }
        
    </style>
    <!-- END -->

     <!-- FIND YOUR MATCH BANNER -->
    <section>
        <div class="str">
            <div class="container">
                <div class="row">
                    <div class="fot-ban-inn">
                        <div class="lhs">
                            <h2>Find your perfect Match now</h2>
                            <p>Find your perfect match and begin a new journey of love, happiness, and lifelong companionship. Join our community and discover endless possibilities for your heart's desires!</p>
                            <a href="sign-up.php" class="cta-3">Register Now</a>
                            <a href="contact.php" class="cta-4">Help & Support</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<script>
$(document).ready(function () {
  // Jab bhi banner search form submit ho
  $("#banner-search-form").submit(function (event) {
    
    // Saari values check karein
    var lookingFor = $('#looking_for').val();
    var ageFrom = $('#age_from').val();
    var ageTo = $('#age_to').val();
    var religion = $('#religion').val();
    var city = $('#city').val();

    // Check karein ki kya sabhi fields khali hain
    if (lookingFor === "" && ageFrom === "" && ageTo === "" && religion === "" && city === "") {
      
      // 1. Form ko submit hone se rokein
      event.preventDefault(); 
      
      // 2. Alert message dikhayein
      $("#search-alert").show();
    } else {
      // Agar koi ek field bhi bhara hai, toh alert ko chhupa dein
      $("#search-alert").hide();
    }
  });
});
</script>

</body>
</html>
<?php
include 'footer.php';
?>
