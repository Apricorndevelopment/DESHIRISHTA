<?php
include 'header.php';

// Default values
$couples_paired = 200;
$total_registrants = 1500;
$total_men = 700;
$total_women = 800;

// Naya Debugging info
$debug_message = "";

// 1. Check connection
if (!$con) {
    $debug_message = "ERROR: Database connection ($con) nahi mili!";
} else {
    // 2. Run query
    $sql_stats = "SELECT * FROM tbl_homepage_stats WHERE id=1";
    $stats_result = mysqli_query($con, $sql_stats);
    
    // 3. Check for query errors
    if (!$stats_result) {
        $debug_message = "ERROR: Query Fail ho gayi! " . mysqli_error($con);
    } 
    // 4. Check for rows
    else if (mysqli_num_rows($stats_result) == 0) {
        $debug_message = "WARNING: Query OK, lekin 'tbl_homepage_stats' mein id=1 waali row nahi mili.";
    } 
    // 5. Success!
    else {
        $stats_row = mysqli_fetch_assoc($stats_result);
        $couples_paired = $stats_row['couples_paired'];
        $total_registrants = $stats_row['total_registrants'];
        $total_men = $stats_row['total_men'];
        $total_women = $stats_row['total_women'];
        
        // Check if values are NULL
        if ($couples_paired === NULL) {
            $debug_message = "SUCCESS! Row mil gayi, lekin database mein values NULL hain. Admin panel se update karein.";
            // Agar NULL hai, toh default value use karein taaki '0' na dikhe
            $couples_paired = 200;
            $total_registrants = 1500;
            $total_men = 700;
            $total_women = 800;
        } else {
            $debug_message = "SUCCESS! Values database se fetch ho gayi hain.";
        }
    }
}
$sql_testimonials = "SELECT * FROM tbl_testimonials WHERE status = 'Active' ORDER BY date_added DESC";
$result_testimonials = mysqli_query($con, $sql_testimonials);

$team_sql = "SELECT * FROM tbl_team ORDER BY id ASC LIMIT 8";
$team_result = mysqli_query($con, $team_sql);

?>

    <!-- BANNER -->
    <section>
        <div class="str">
            <div class="ban-inn ab-ban">
                <div class="container">
                    <div class="row">
                        <div class="hom-ban">
                            <div class="ban-tit">
                                <span><i class="no1">#1</i> Wedding Website</span>
                                <h1>About us</h1>
                                <p>The Most Trusted Premium Matrimony & True Matchmaking Service Brand</p>
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
        <div class="ab-sec2">
            <div class="container">
                <div class="row">
                    <ul>
                        <li>
                            <div>
                                <img src="images/happy-customer.gif" alt="">
                                <h4>Goverment ID Verified</h4>
                                <p>All onboard profiles are 100% Goverment ID verified only</p>
                            </div>
                        </li>
                        <li>
                            <div>
                                <img src="images/clipboard.gif" alt="">
                                <h4>Genuine Profiles</h4>
                                <p>100% manually screened profiles to restrict contents/photos.</p>
                            </div>
                        </li>
                        <li>
                            <div>
                                <img src="images/protected-file.gif" alt="">
                                <h4>Control over Privacy</h4>
                                <p>Restrict unwanted access to contact details & photos/videos</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- END -->
    
            
    <!-- END -->
    
    <!-- START -->
    <section>
        <div class="hom-partners abo-partners">
            <div class="container" style="    padding-bottom: 100px;
    margin-top: -90px;">
                <div class="row">
                    <div class="wedd-shap">
                        <span class="abo-shap-1"></span>
                        <span class="abo-shap-2"></span>
                        <span class="abo-shap-4"></span>
                        <span class="abo-shap-5"></span>
                    </div>
                    <div class="col-lg-6">
                        <div class="ab-wel-lhs">
                            <span class="ab-wel-3"></span>
                            <img src="images/about/1.jpg" alt="" class="ab-wel-1">
                            <img src="images/about/2.jpg" alt="" class="ab-wel-2">
                            <span class="ab-wel-4"></span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="ab-wel-rhs">
                            <div class="ab-wel-tit">
                                <h2>Welcome to <em>Desi Rishta Matrimony</em></h2>
                                <p><a href="#">Our Mission : </a> Our mission is to provide customers with a user-friendly platform featuring an extensive database of genuine profiles, enabling faster matches with minimal screening. Setting ourselves apart through a commitment to privacy, transparency, and customer satisfaction, we aim to establish a secure and reliable environment for individuals embarking on their journey towards a blissful married life.</p>
                            </div>
                            <div class="ab-wel-tit">
                                <p><a href="#">Our Vision : </a> We aspire to become the leading and most dependable provider of matrimonial website services, dedicated to simplicity, trustworthiness, and expediting matches. </p>
                            </div>
                            <div class="ab-wel-tit-1">
                            </div>
                            <div class="ab-wel-tit-2">
                                <ul>
                                    <li>
                                        <div>
                                            <i class="fa fa-phone" aria-hidden="true"></i>
                                            <h4>Enquiry <em>+91-8377053041</em></h4>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <i class="bi bi-envelope" aria-hidden="true"></i>
                                            <h4>Get Support <em>support@desi-rishta.com</em></h4>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<style>
    /* =========================
   DESKTOP (default)
========================= */
.team-slider .slick-dots,
.testimonial-slider .slick-dots {
    position: relative;
    bottom: 0;
    padding-top: 20px;
    text-align: center;
}
.wedd-shap span {
    position: absolute;
    z-index: -1;
}
/* =========================
   MOBILE FIX
========================= */
@media (max-width: 768px) {

    .team-slider .slick-dots,
    .testimonial-slider .slick-dots {
        padding-left: 0 !important;
        margin-left: 0 !important;
        left: 0;
        right: 0;
        text-align: center;
        display: flex !important;
        justify-content: center;
    }

    .team-slider .slick-dots li,
    .testimonial-slider .slick-dots li {
        margin: 0 6px;
    }
}

</style>
    <!-- START -->
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
                                    <h4 class="counter" data-count="<?php echo $couples_paired; ?>">0</h4>
                                    <span>Couples paired</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="ab-cont-po">
                                <i class="fa fa-users" aria-hidden="true"></i>
                                <div>
                                    <h4 class="counter" data-count="<?php echo $total_registrants; ?>">0</h4>
                                    <span>Registerents</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="ab-cont-po">
                                <i class="fa fa-male" aria-hidden="true"></i>
                                <div>
                                    <h4 class="counter" data-count="<?php echo $total_men; ?>">0</h4>
                                    <span>Mens</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="ab-cont-po">
                                <i class="fa fa-female" aria-hidden="true"></i>
                                <div>
                                    <h4 class="counter" data-count="<?php echo $total_women; ?>">0</h4>
                                    <span>Womens</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <!-- <ul>
                        <li>
                            <div class="ab-cont-po">
                               <i class="fa-regular fa-heart"></i>

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
                                    <span>Registered users</span>
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
                    </ul> -->
                    </div>
            </div>
        </div>

    </section>
    <section>
        <div class="ab-team">
            <div class="container" style="overflow: hidden;">
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
                                            <li><a href="<?php echo htmlspecialchars($member['facebook']); ?>" target="_blank"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li> <?php } ?>
                                        <?php if(!empty($member['twitter'])) { ?>
                                            <li><a href="<?php echo htmlspecialchars($member['twitter']); ?>" target="_blank"><i class="fa-brands fa-x-twitter" aria-hidden="true"></i></a></li> <?php } ?>
                                        <?php if(!empty($member['whatsapp'])) { ?>
                                            <li><a href="<?php echo htmlspecialchars($member['whatsapp']); ?>" target="_blank"><i class="fab fa-whatsapp" aria-hidden="true"></i></a></li> <?php } ?>
                                        <?php if(!empty($member['linkedin'])) { ?>
                                            <li><a href="<?php echo htmlspecialchars($member['linkedin']); ?>" target="_blank"><i class="fab fa-linkedin-in" aria-hidden="true"></i></a></li> <?php } ?>
                                        <?php if(!empty($member['instagram'])) { ?>
                                            <li><a href="<?php echo htmlspecialchars($member['instagram']); ?>" target="_blank"><i class="fab fa-instagram" aria-hidden="true"></i></a></li> <?php } ?>
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
    <style>
        .social-light li a:hover .fa-linkedin-in {
    background: #53a6f8;
}
.social-light li a:hover .fa-facebook-f {
    background: #1877f2;
}

.social-light li a:hover .fa-x-twitter {
    background: #000;
}
    </style>
    <!-- END -->
<section>
    <div class="hom-partners abo-partners" id="testimonials">
        <div class="container">
            <div class="row">
                <div class="sub-tit-caps">
                    <h2>Customer <span class="animate animate__animated" data-ani="animate__flipInX" data-dely="0.1">Testimonials</span></h2>
                    <p>What our clients say about us</p>
                </div>
                <div class="wedd-shap">
                    <span class="abo-shap-1"></span>
                     <span class="abo-shap-2"></span>
                      <span class="abo-shap-4"></span>
                    <span class="abo-shap-3"></span>
                </div>
                

                <div class="cus-revi">
                    <ul class="testimonial-slider">
                        
                        <?php
                        // Check karein ki testimonials hain ya nahi
                        if ($result_testimonials && mysqli_num_rows($result_testimonials) > 0) {
                            while ($testimonial = mysqli_fetch_assoc($result_testimonials)) {
                        ?>

                        <li>
                            <div class="ab-testmo">
                                <div class="ab-test-rat">
                                    <div class="ab-test-star">
                                        <?php
                                        // Rating ke liye stars ka loop
                                        for ($i = 1; $i <= 5; $i++) {
                                            if ($i <= $testimonial['rating']) {
                                                echo '<i class="fa fa-star" aria-hidden="true"></i>';
                                            } else {
                                                echo '<i class="fa fa-star-o" aria-hidden="true"></i>'; // Khali star
                                            }
                                        }
                                        ?>
                                        </div>
                                    <div class="ab-test-conte">
                                        <p><?php echo htmlspecialchars($testimonial['content']); ?></p>
                                    </div>
                                </div>
                                <div class="ab-rat-user">
                                    <img src="images/profiles/<?php echo htmlspecialchars($testimonial['user_image']); ?>" alt="User">
                                    <div>
                                        <h4><?php echo htmlspecialchars($testimonial['user_name']); ?></h4>
                                        <span><?php echo htmlspecialchars($testimonial['user_designation']); ?></span>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <?php
                            } // while loop yahan khatm
                        } else {
                            // Agar DB mein koi testimonial nahi hai
                            // echo "<li><div class='ab-testmo'><p>No testimonials to display yet.</p></div></li>";
                        }
                        ?>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>





<?php
include 'footer.php';
?>

<style>
    /* === Team Slider Styling === */
.team-slider .slick-slide {
    padding: 0 10px; /* Cards ke beech 10px ka gap */
    height: auto;
}

/* Dots ki styling same Testimonials jaisi */
.team-slider .slick-dots {
    bottom: -5px;
    position: relative;
    padding-top: 20px;
    text-align: center; /* Dots ko center mein dikhane ke liye */
    padding-left: 230PX;
}

.team-slider .slick-dots li {
    display: inline-block;
    margin: 0 5px;
    padding: 7px;
}

.team-slider .slick-dots li button {
    color: transparent;
    width: 10px;
    height: 10px;
    background: #ccc;
    border-radius: 50%;
    border: 0;
    outline: none;
    transition: all 0.3s ease;
}

.team-slider .slick-dots li.slick-active button {
    background: #66451c; /* Active dot color */
    width: 12px;
    height: 12px;
}
</style>

<script>
    // Team Slider Initialization
$('.team-slider').slick({
    slidesToShow: 4,      // Laptop/PC par 4 members dikhenge
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 3000,
    dots: true,           // Niche dots dikhenge
    arrows: false,        // Arrows band
    responsive: [
        {
            breakpoint: 1024, // Tablet Landscape
            settings: {
                slidesToShow: 3,
            }
        },
        {
            breakpoint: 768, // Tablet Portrait / Large Mobile
            settings: {
                slidesToShow: 2,
            }
        },
        {
            breakpoint: 480, // Chote Mobile
            settings: {
                slidesToShow: 1,
            }
        }
    ]
});
  // Testimonial Slider
$('.testimonial-slider').slick({
    slidesToShow: 3,      // Ek baar mein 3 dikhaye
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 3000,
    dots: true,           // Slider ke neeche dots dikhaye
    arrows: false,        // Arrows hide karein
    responsive: [
        {
            breakpoint: 1024, // Tablet par
            settings: {
                slidesToShow: 2,
            }
        },
        {
            breakpoint: 768, // Mobile par
            settings: {
                slidesToShow: 1,
            }
        }
    ]
});

$(document).ready(function() {

    
    var analytics_counter_ran = 0; 

    $(window).scroll(function() {

        var analytic_section = $('.ab-cont'); 
        
        if(analytic_section.length > 0) { 
            var oTop = analytic_section.offset().top - window.innerHeight;
            
            if (analytics_counter_ran == 0 && $(window).scrollTop() > oTop) {
                
                analytics_counter_ran = 1; 
                
                $('.counter').each(function() {
                    var $this = $(this),
                        countTo = $this.attr('data-count');
                    
                    $({ countNum: $this.text()}).animate({
                        countNum: countTo
                    },
                    {
                        duration: 8000, 
                        easing: 'swing',
                        step: function() {
                            $this.text(Math.floor(this.countNum));
                        },
                        complete: function() {
                            $this.text(this.countNum);
                        }
                    });
                });
            }
        }
    });

});

</script>
<style>
    /* === Testimonial Slider Fix (About Page) === */
.testimonial-slider .slick-slide {
    padding: 0 0px; /* Cards ke beech gap */
    height: auto;
}
.testimonial-slider .slick-slide > div,
.testimonial-slider .slick-slide li {
    height: 100%;
}

/* Card ko equal height dena */
.testimonial-slider .ab-testmo {
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 5px;
    /* border: 1px solid #f0f0f0; */
    border-radius: 8px;
    /* box-shadow: 0 2px 7px -1px #625c472b; */
}
.testimonial-slider .ab-test-rat {
    flex-grow: 1; /* Content ko expand karega */
}

/* Dots ko style karna */
.testimonial-slider .slick-dots {
    bottom: 0px; /* Dots ko slider se thoda neeche karein */
    position: relative;
    padding-top: 30px;
    margin-left: 240px;
}
.testimonial-slider .slick-dots li button {
    color: #0000;
    width: 10px;
    height: 10px;
    background: #ccc;
    border-radius: 50px;
    border: 0;
    outline: none;
    transition: all 0.3s ease;
}
.testimonial-slider .slick-dots li.slick-active button {
    background: #66451c; /* Aapka main color */
    width: 12px;
    height: 12px;
}
</style>