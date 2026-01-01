<?php
ob_start();

include 'config.php';

// --- 1. INITIALIZE VARIABLES (Defaults) ---
// Initialize all variables to null/0 to prevent "Undefined Variable" errors
$userid = null;
$user_data = null; // Stores the main user row
$useractive = 0;   // Default: User is NOT active (0)


// Profile Status Defaults
$id_verification = null;
$id_verification_popup = null;
$id_profilestatus = null;
$id_profilestatus_popup = null;

// Request Count Defaults
$incoming_pending_count = 0;
$outgoing_pending_count = 0;
$total_new_requests = 0;

// --- 2. USER AUTHENTICATION & DATA FETCHING ---
if (isset($_COOKIE['dr_userid'])) {
    // Security: Sanitize the cookie input to prevent SQL injection
    $userid = mysqli_real_escape_string($con, $_COOKIE['dr_userid']);

    // OPTIMIZATION: Single Query to get ALL user details (Replaces 3 separate queries)
    $sql_user = "SELECT * FROM registration WHERE userid = '$userid'";
    $result_user = mysqli_query($con, $sql_user);

    if ($result_user && mysqli_num_rows($result_user) > 0) {
        $user_data = mysqli_fetch_assoc($result_user);

        // Map DB columns to variables used in UI logic
        $id_verification = $user_data['verificationinfo'];
        $id_verification_popup = $user_data['verification_popup'];
        $id_profilestatus = $user_data['profilestatus'];
        $id_profilestatus_popup = $user_data['profilestatus_popup'];

        // Calculate User Active Status (Logic: Must be in DB and otpstatus must be active)
        if ($user_data['otpstatus'] == 'active') {
            $useractive = 1;
        }

        // --- 3. DEACTIVATION CHECK (SECURITY) ---
        // If profile is Deactivated (2) AND user is not on allowed pages, redirect immediately.
        // This is done before HTML output to avoid "Headers already sent" errors.
        $currentPage = basename($_SERVER['PHP_SELF']);
        $allowed_pages = ['user-setting.php', 'logout.php', 'contact.php'];

        if ($id_profilestatus == '2' && !in_array($currentPage, $allowed_pages)) {
            echo "<script>alert('Your profile is deactivated. Please activate it to browse matches.'); window.location.href='user-setting.php';</script>";
            exit();
        }

        // --- 4. CALCULATE REQUEST COUNTS (Only if user is found) ---
        // 4a. Incoming Pending Requests
        $sql_in = "SELECT COUNT(*) as count FROM expressinterest WHERE ei_receiver = '$userid' AND ei_status = 'pending'";
        $res_in = mysqli_query($con, $sql_in);
        $row_in = mysqli_fetch_assoc($res_in);
        $incoming_pending_count = isset($row_in['count']) ? (int)$row_in['count'] : 0;

        // 4b. Outgoing Pending Requests
        $sql_out = "SELECT COUNT(*) as count FROM expressinterest WHERE ei_sender = '$userid' AND ei_status = 'pending'";
        $res_out = mysqli_query($con, $sql_out);
        $row_out = mysqli_fetch_assoc($res_out);
        $outgoing_pending_count = isset($row_out['count']) ? (int)$row_out['count'] : 0;

        // 4c. Total New Requests for badge
        $total_new_requests = $incoming_pending_count + $outgoing_pending_count;
    }
}
?>

<!-- POPUP NOTIFICATION LOGIC (SweetAlert) -->
<?php if ($user_data && $id_profilestatus_popup == '1') { ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                title: 'Profile Status Updated',
                text: '<?php echo ($id_profilestatus == '1') ? "Your profile is now Active and visible to others." : "Your profile has been Deactivated and is hidden from others."; ?>',
                icon: '<?php echo ($id_profilestatus == '1') ? "success" : "warning"; ?>',
                confirmButtonColor: '#6f4efc'
            }).then((result) => {
                // The popup flag is reset via PHP below, so no AJAX needed for basic reset
            });
        });
    </script>
    <?php
    // Reset popup flag immediately server-side so it doesn't appear on refresh
    mysqli_query($con, "UPDATE registration SET profilestatus_popup='0' WHERE userid='$userid'");
    ?>
<?php } ?>

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
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700;900&display=swap" rel="stylesheet">

    <style>
        /* === NOTIFICATION PULSE ANIMATION === */
        .notif-link {
            position: relative;
            display: inline-block;
            padding-right: 20px;
        }

        .notif-dot {
            width: 10px;
            height: 10px;
            background: #e74c3c;
            border-radius: 50%;
            position: absolute;
            top: 50%;
            right: 0;
            transform: translateY(-50%);
            animation: pulse-red 1.5s infinite;
        }

        @keyframes pulse-red {
            0% { box-shadow: 0 0 0 0 rgba(231, 76, 60, 0.7); }
            70% { box-shadow: 0 0 0 6px rgba(231, 76, 60, 0); }
            100% { box-shadow: 0 0 0 0 rgba(231, 76, 60, 0); }
        }

        /* === MOBILE MENU ANIMATION CORE === */
        .mob-me-all {
            /* Existing styles usually handled by external CSS, ensuring base visibility logic */
            transition: all 0.4s ease;
            display: none; /* Default hidden */
            opacity: 0;
            visibility: hidden;
        }
        
        /* Active state for the container */
        .mob-me-all.act {
            display: block;
            opacity: 1;
            visibility: visible;
        }

        /* Initial State of Menu Items (Hidden & Pushed Down) */
        .mob-me-all .mv-bus h4, 
        .mob-me-all .mv-bus ul li {
            opacity: 0;
            transform: translateY(30px); /* Bottom-up start position */
            transition: opacity 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94), 
                        transform 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            will-change: opacity, transform;
        }

        /* Active State of Menu Items (Visible & Original Position) */
        .mob-me-all.act .mv-bus h4.anim-active, 
        .mob-me-all.act .mv-bus ul li.anim-active {
            opacity: 1;
            transform: translateY(0);
        }
    </style>

    <script language=Javascript>
        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57)) return false;
            return true;
        }

        function numberMobile(e) {
            e.target.value = e.target.value.replace(/[^\d]/g, '');
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

    <!-- TOP MENU -->
    <div class="head-top">
        <div class="container">
            <div class="row">
                <div class="lhs">
                    <ul>
                        <li><a href="tel:+9704462944"><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;+91-8377053041</a></li>
                        <li><a href="mailto:info@example.com"><i class="fa-regular fa-envelope"></i>&nbsp; support@desi-rishta.com</a></li>
                    </ul>
                </div>
                <div class="rhs">
                    <ul>
                        <li><a href="#!"><i class="fa-brands fa-facebook"></i></a></li>
                        <li><a href="#!"><i class="fa-brands fa-instagram"></i></a></li>
                        <li><a href="https://wa.me/918377053041?text=Hello..." target="_blank"><i class="fa-brands fa-whatsapp"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

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

    <!-- MAIN MENU -->
    <div class="hom-top">
        <div class="container">
            <div class="row">
                <div class="hom-nav">
                    <!-- LOGO -->
                    <div class="logo">
                        <a href="index.php" class="logo-brand"><img src="images/desirishtalogo.png" alt="" loading="lazy" class="ic-logo"></a>
                    </div>

                    <!-- DESKTOP EXPLORE MENU -->
                    <div class="bl">
                        <?php if ($useractive == 0) { ?>
                            <!-- GUEST MENU -->
                            <ul>
                                <li><a href="index.php">Home</a></li>
                                <li><a href="about.php">About Us</a></li>
                                <li><a href="plans.php">Pricing Plans </a></li>
                                <li><a href="blog.php">Blogs</a></li>
                                <li class="smenu-pare">
                                    <span class="smenu">SERVICES</span>
                                    <div class="smenu-open smenu-single">
                                        <ul>
                                            <li><a href="wedding-ecard.php">Wedding E-Card</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="smenu-pare">
                                    <span class="smenu">HELP</span>
                                    <div class="smenu-open smenu-single">
                                        <ul>
                                            <li><a href="contact.php">Contact Us</a></li>
                                            <li><a href="contact.php?#support">Business Enquiries</a></li>
                                            <li><a href="https://wa.me/918377053041?text=Hi There..." target="_blank">Chat Support</a></li>
                                            <li><a href="faq.php">FAQ's</a></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        <?php } else { ?>
                            <!-- LOGGED IN MENU -->
                            <ul>
                                <li><a href="user-dashboard.php">Dashboard</a></li>

                                <?php if ($id_verification == '1') { ?>
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
                                <?php } ?>

                                <li class="smenu-pare">
                                    <span class="smenu">SERVICES</span>
                                    <div class="smenu-open smenu-single">
                                        <ul>
                                            <li><a href="wedding-ecard.php">Wedding E-Card</a></li>
                                        </ul>
                                    </div>
                                </li>

                                <li class="smenu-pare">
                                    <span class="smenu">HELP</span>
                                    <div class="smenu-open smenu-single">
                                        <ul>
                                            <li><a href="contact.php">Contact Us</a></li>
                                            <li><a href="submitrequest.php?#support">Submit a Request</a></li>
                                            <li><a href="https://wa.me/918377053041?text=Hi There..." target="_blank">Chat Support</a></li>
                                            <li><a href="faq.php">FAQ's</a></li>
                                            <li><a href="reviewrating.php?#support">Reviews & Rating</a></li>
                                        </ul>
                                    </div>
                                </li>

                                <?php if ($id_verification == '1') { ?>
                                    <li class="smenu-pare">
                                        <span class="smenu">INBOX <?php if ($total_new_requests > 0) {
                                                                        echo '(' . $total_new_requests . ')';
                                                                    } ?></span>
                                        <div class="smenu-open smenu-single">
                                            <ul>
                                                <li>
                                                    <a href="user-incoming-interests.php" class="notif-link">
                                                        Incoming Request
                                                        <?php if ($incoming_pending_count > 0) { ?>
                                                            <div class="notif-dot"></div>
                                                        <?php } ?>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="user-outgoing-interests.php" class="notif-link">
                                                        Outgoing Requests
                                                        <?php if ($outgoing_pending_count > 0) { ?>
                                                            <div class="notif-dot"></div>
                                                        <?php } ?>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </div>

                    <!-- USER PROFILE / LOGIN LINK -->
                    <div class="al">
                        <div class="head-pro">
                            <span class="menu desk-menu">
                                <i></i><i></i><i></i>
                            </span>
                        </div>
                        <h4 class="loginregister">
                            <?php if ($useractive == 0) { ?>
                                <a href="login.php" data-text="Sign In">Sign In</a> /
                                <a href="sign-up.php" data-text="Sign Up">Sign Up</a>
                            <?php } else { ?>
                                <a href="logout.php" id="logout">Log Out</a>
                            <?php } ?>
                        </h4>
                    </div>

                    <!-- MOBILE MENU TOGGLE -->
                    <div class="mob-menu">
                        <div class="mob-me-ic">
                            <?php if ($useractive == 0) { ?>
                                <span class="mobile-exprt">
                                    <a href="login.php" class="user-login" style="margin-right:-5px;">
                                        <i class="bi bi-person"></i>
                                    </a>
                                </span>
                            <?php } else { ?>
                                <span class="mobile-exprt">
                                    <a href="logout.php">
                                        <i class="bi bi-power"></i>
                                    </a>
                                </span>
                            <?php } ?>
                            <!-- Trigger for Animation -->
                            <span class="mobile-menu-trigger" style="margin-right: 15px; cursor: pointer;">
                                <i class="bi bi-list" style="font-size: 28px;"></i>
                            </span>
                        </div>
                    </div>
                    <!-- END MOBILE MENU TOGGLE -->

                </div>
            </div>
        </div>

        <!-- PROMOTION BANNER -->
        <?php
        $sqlannoucement = "SELECT * FROM promotion WHERE id = '1'";
        $resultannoucement = mysqli_query($con, $sqlannoucement);
        $rowannoucement = mysqli_fetch_assoc($resultannoucement);
        if ($rowannoucement && $rowannoucement['fpromotion'] != '') {
        ?>
            <div class="head-bottom">
                <div class="">
                    <div class="row">
                        <marquee><?php echo $rowannoucement['fpromotion'] ?></marquee>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <!-- MOBILE MENU POPUP -->
    <div class="mob-me-all mobile_menu pt-2">
        <div class="mob-me-clo">
            <i class="bi bi-x-lg"></i>
        </div>
        <div class="logo mb-4">
            <a href="index.php" class="logo-brand"><img src="images/tlogo.png" alt="" loading="lazy" class="ic-logo"></a>
        </div>
        <div class="mv-bus">
            <?php if ($useractive == 0) { ?>
                <!-- GUEST MOBILE MENU -->
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="plans.php">Pricing Plans </a></li>
                    <li><a href="blog.php">Blogs</a></li>
                </ul>
                <h4><i class="fa fa-question-circle" aria-hidden="true"></i> SERVICES</h4>
                <ul>
                    <li><a href="wedding-ecard.php">Wedding E-Card</a></li>
                </ul>
                <h4><i class="fa fa-question-circle" aria-hidden="true"></i>HELP</h4>
                <ul>
                    <li><a href="contact.php">Contact Us</a></li>
                    <li><a href="contact.php?#support">Business Enquiries</a></li>
                    <li><a href="https://wa.me/918377053041?text=Hello..." target="_blank">Chat Support</a></li>
                    <li><a href="faq.php">FAQ's</a></li>
                </ul>
            <?php } else { ?>
                <!-- LOGGED IN USER MOBILE MENU -->

                <?php if ($id_verification == '1') { ?>
                    <!-- INBOX -->
                    <h4><i class="fa fa-envelope" aria-hidden="true"></i> Inbox <?php if ($total_new_requests > 0) {
                                                                                    echo '(' . $total_new_requests . ')';
                                                                                } ?></h4>
                    <ul>
                        <li>
                            <a href="user-incoming-interests.php" class="notif-link">
                                Incoming Requests
                                <?php if ($incoming_pending_count > 0) { ?>
                                    <div class="notif-dot"></div>
                                <?php } ?>
                            </a>
                        </li>

                        <li>
                            <a href="user-outgoing-interests.php" class="notif-link">
                                Outgoing Requests
                                <?php if ($outgoing_pending_count > 0) { ?>
                                    <div class="notif-dot"></div>
                                <?php } ?>
                            </a>
                        </li>
                    </ul>
                <?php } ?>

                <!-- DASHBOARD -->
                <h4><i class="fa fa-dashboard" aria-hidden="true"></i> Dashbord</h4>
                <ul>
                    <li><a href="user-dashboard.php">Dashboard</a></li>
                </ul>

                <?php if ($id_verification == '1') { ?>
                    <!-- MATCHES -->
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

                    <!-- SEARCH -->
                    <h4><i class="fa fa-search" aria-hidden="true"></i> Search</h4>
                    <ul>
                        <li><a href="basic-search.php">Basic Search </a></li>
                        <li><a href="#" class="ser-open">Member ID Search</a></li>
                    </ul>
                <?php } ?>

                <!-- PLANS -->
                <h4><i class="fa fa-list" aria-hidden="true"></i>Plans </h4>
                <ul>
                    <li><a href="user-plan.php">Pricing Plans </a></li>
                </ul>

                <!-- SERVICES -->
                <h4><i class="fa fa-service" aria-hidden="true"></i>SERVICES</h4>
                <ul>
                    <li><a href="wedding-ecard.php">Wedding E-card</a></li>
                </ul>

                <!-- HELP -->
                <h4><i class="fa fa-question-circle" aria-hidden="true"></i>HELP</h4>
                <ul>
                    <li><a href="contact.php">Contact Us</a></li>
                    <li><a href="submitrequest.php?#support">Submit a Request</a></li>
                    <li><a href="https://wa.me/918377053041?text=Hello..." target="_blank">Chat Support</a></li>
                    <li><a href="faq.php">FAQ's</a></li>
                    <li><a href="reviewrating.php?#support">Reviews & Rating</a></li>
                </ul>
            <?php } ?>
        </div>
    </div>

    <!-- SCRIPT FOR BOTTOM-UP ANIMATION -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuTrigger = document.querySelector('.mobile-menu-trigger');
            const mobileMenu = document.querySelector('.mob-me-all');
            const closeBtn = document.querySelector('.mob-me-clo');
            
            // Select all Headers and List Items inside the mobile menu
            const animateItems = document.querySelectorAll('.mob-me-all .mv-bus h4, .mob-me-all .mv-bus ul li');

            function openMenu() {
                mobileMenu.classList.add('act');
                document.body.style.overflow = 'hidden'; // Prevent background scrolling

                // Apply staggered delays dynamically
                animateItems.forEach((item, index) => {
                    item.style.transitionDelay = (index * 0.05) + 's'; // 0.05s delay per item
                    // Slight timeout to ensure class is added after display block
                    setTimeout(() => {
                        item.classList.add('anim-active');
                    }, 50);
                });
            }

            function closeMenu() {
                mobileMenu.classList.remove('act');
                document.body.style.overflow = 'auto';

                // Reset animations
                animateItems.forEach((item) => {
                    item.style.transitionDelay = '0s'; // Remove delay so they disappear instantly or normally
                    item.classList.remove('anim-active');
                });
            }

            if(menuTrigger) {
                menuTrigger.addEventListener('click', openMenu);
            }

            if(closeBtn) {
                closeBtn.addEventListener('click', closeMenu);
            }
        });
    </script>
</body>
</html>