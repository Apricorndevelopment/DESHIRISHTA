<!-- {
type: uploaded file
fileName: desirishta/user-dashboard.php
fullContent: -->
<?php
include 'header.php';
include 'config.php';

$userid = $_COOKIE['dr_userid'];
$state = $_COOKIE['dr_state'];
$gender = $_COOKIE['dr_gender'];

// --- FIX: TIMEZONE AND DATE VARIABLES ---
date_default_timezone_set('Asia/Kolkata'); 
$current_time = date('Y-m-d H:i:s'); // Current Time
$current_date = date('Y-m-d');       // Current Date
// ----------------------------------------

if($userid == '')
{
    header('location:login.php');
    exit;
}

// --- NEW: FETCH USER NAME FOR GREETING ---
$my_name = "User"; // Default
$sql_name = "SELECT fullname FROM basic_info WHERE userid = '$userid'";
$result_name = mysqli_query($con, $sql_name);
if($result_name && mysqli_num_rows($result_name) > 0) {
    $row_name = mysqli_fetch_assoc($result_name);
    if(!empty($row_name['fullname'])) {
        // Get only the first name
        $name_parts = explode(' ', trim($row_name['fullname']));
        $my_name = $name_parts[0]; 
    }
}
// -----------------------------------------

// --- 1. FETCH POPUP DATA (Banners + Status) ---
$popup_queue = []; 

// A. Fetch Promotional Banners from Database
$sql_banners = "
    SELECT 
        ac.id, ac.subject, ac.media_file, ac.body_content, 'banner' as type
    FROM 
        admin_communication ac
    LEFT JOIN 
        user_banner_logs ubl 
        ON ac.id = ubl.banner_id 
        AND ubl.user_id = '$userid' 
        AND ubl.view_date = '$current_date'
    WHERE 
        ac.type = 'banner'
        AND ac.valid_from <= '$current_time'
        AND ac.valid_till >= '$current_time'
        AND ubl.id IS NULL
        AND (
            ac.target_scope = 'all'
            OR ac.target_users = '$userid'
        )
    ORDER BY ac.id ASC
";

$result_banners = mysqli_query($con, $sql_banners);
if ($result_banners) {
    while ($row = mysqli_fetch_assoc($result_banners)) {
        $popup_queue[] = $row;
    }
}

// B. Add System Status Alerts (Verification, Profile Status, etc.)

// Case 1: Profile Not Screened
if($id_profilestatus == '0' && $id_profilestatus_popup == '0') {
    $popup_queue[] = [
        'id' => 'status_1',
        'type' => 'status',
        'subject' => 'Welcome To Desi Rishta',
        'media_file' => 'images/gif/notscreened.gif', 
        'body_content' => 'Your profile is under screening will be made live shortly',
        'is_local_img' => true,
        'btn_link' => '',
        'btn_text' => ''
    ];
    // Update popup status in DB to avoid showing again
    mysqli_query($con, "UPDATE `registration` SET `profilestatus_popup`='1' WHERE `userid`='$userid'");
}

// Case 2: Screening Complete
if($id_profilestatus == '1' && $id_profilestatus_popup == '0') {
    $popup_queue[] = [
        'id' => 'status_2',
        'type' => 'status',
        'subject' => 'Welcome To Desi Rishta',
        'media_file' => 'images/gif/screeningcompleted.gif',
        'body_content' => "Your profile screening is complete. It's now live!",
        'is_local_img' => true,
        'btn_link' => '',
        'btn_text' => ''
    ];
    mysqli_query($con, "UPDATE `registration` SET `profilestatus_popup`='1' WHERE `userid`='$userid'");
}

// Case 3: Verification Pending
if($id_verification != 'Done' && $id_verification_popup == '0') {
    $popup_queue[] = [
        'id' => 'status_3',
        'type' => 'status',
        'subject' => 'Welcome To Desi Rishta',
        'media_file' => 'images/gif/unverifiedidentity.gif',
        'body_content' => 'Complete verification to earn your trust badge',
        'is_local_img' => true,
        'btn_link' => 'trust-badge.php',
        'btn_text' => 'Verify Now'
    ];
    mysqli_query($con, "UPDATE `registration` SET `verification_popup`='1' WHERE `userid`='$userid'");
}

// Case 4: Verification Done
if($id_verification == 'Done' && $id_verification_popup == '0') {
    $popup_queue[] = [
        'id' => 'status_4',
        'type' => 'status',
        'subject' => 'Welcome To Desi Rishta',
        'media_file' => 'images/gif/verifiedidentity.gif',
        'body_content' => "Congratulations! You've Earned Your Trust Badge",
        'is_local_img' => true,
        'btn_link' => '',
        'btn_text' => ''
    ];
    mysqli_query($con, "UPDATE `registration` SET `verification_popup`='1' WHERE `userid`='$userid'");
}

// Encode queue data to JSON for JavaScript
$json_popup_queue = json_encode($popup_queue);
?>

<style>
    /* Force Black Text for Popups */
    .menu-pop-help h4, 
    .menu-pop-help h5, 
    .menu-pop-help p,
    .menu-pop-help div {
        color: #000000 !important;
        opacity: 1 !important;
        visibility: visible !important;
    }
    #pop-subject {
        font-weight: bold;
        font-size: 20px;
        margin-bottom: 10px;
        color: #333 !important;
        border-bottom: 1px solid #ddd;
        padding-bottom: 10px;
    }
    #pop-body {
        font-size: 16px;
        line-height: 1.5;
        color: #444 !important;
    }

    /* --- BANNER IMAGE FIX --- */
    /* Override 'user-pro' class constraints */
    #pop-img-container.user-pro {
        width: 100% !important;
        height: auto !important;
        border-radius: 0 !important;
        overflow: visible !important;
        max-width: 100% !important;
        margin: 0 auto 15px auto !important;
    }

    /* Banner Image Styling */
    #pop-img-container img {
        width: 100% !important;       /* Full Width */
        height: auto !important;      /* Auto Height */
        max-height: 500px !important; /* Maximum limit so it fits on screen */
        object-fit: contain !important;
        border-radius: 8px;
        display: block;
    }
</style>

<div class="menu-pop menu-pop1" id="dynamic-popup">
    <span class="menu-pop-clo" id="close-popup-btn"><i class="fa fa-times" aria-hidden="true"></i></span>
    <div class="inn">
        <div class="menu-pop-help">
            <h4 id="pop-subject">Notification</h4>
            
            <div class="user-pro" id="pop-img-container" style="display:none;">
                <img src="" alt="" id="pop-img" loading="lazy">
            </div>

            <div class="user-bio mt-3">
                <h5 id="pop-body">Loading...</h5>
                
                <br>
                <a href="#" id="pop-btn" class="btn btn-primary btn-sm" style="display:none;">Action</a>
            </div>
        </div>
    </div>
</div>

    <section>
        <div class="db">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-lg-3">
                        <?php
                        include 'user-sidebar.php';
                        ?>
                    </div>
<div class="col-md-8 col-lg-9">
    <div class="row">
  <div class="col-lg-12 col-xl-12 mb-4">
            <div class="db-pro-stat p-4 text-center" style="background: #fff; border-radius: 10px; border: 1px solid #e6e6e6; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
                
                <div class="d-flex justify-content-center align-items-center flex-wrap" style="gap: 40px;">
                    
                    <div class="clock-section">
                        <h2 id="live-clock" style="margin: 0; color: #b16421; font-weight: 800; font-size: 36px; line-height: 1;">
                            --:--:--
                        </h2>
                        <div id="live-date" style="margin-top: 5px; color: #666; font-weight: 600; font-size: 14px; text-transform: uppercase; letter-spacing: 1px;">
                            Loading Date...
                        </div>
                    </div>

                    <div class="d-none d-md-block" style="border-left: 2px solid #eee; height: 50px;"></div>

                    <div class="greeting-section">
                        <h2 id="greeting-display" style="margin: 0; color: #333; font-weight: 700; font-size: 24px; line-height: 1;">
                            </h2>
                    </div>

                    <div class="d-none d-md-block" style="border-left: 2px solid #eee; height: 50px;"></div>
                    
                    <div id="battery-wrapper" class="battery-section" style="display:none;">
                        <h2 style="margin: 0; font-weight: 700; color: #333; font-size: 28px; line-height: 1;">
                            <i id="battery-icon" class="fa fa-battery-three-quarters" aria-hidden="true"></i> 
                            <span id="battery-level">--%</span>
                        </h2>
                        <div id="charging-status" style="margin-top: 5px; color: #28a745; font-weight: 700; font-size: 12px; display: none; text-transform: uppercase;">
                            <i class="fa fa-bolt"></i> Charging
                        </div>
                    </div>

                </div>
            </div>
          </div>
       

                    <div class="col-md-8 col-lg-12">
                        <div class="row">
                            <div class="col-lg-12 col-xl-12">
                                <h2 class="db-tit">Summary</h2>
                            </div>
                            <div class="col-lg-12 col-xl-4 mb-3">
                                <div class="db-pro-stat p-3 pt-1 pb-1">
                                    <div class="db-inte-prof-list db-inte-prof-chat">
                                        <ul>
                                            <li>
                                                <div class="db-int-pro-1"> <img src="images/gif/allprofiles.gif" alt=""> </div>
                                                <div class="db-int-pro-2">
                                                    <?php
                                                    $sqlallprofile = "select * from registration where userid != '$userid' and gender != '$gender' and delete_status != 'delete' and firstapprove = '1'";
                                                    $resultallprofile = mysqli_query($con,$sqlallprofile);
                                                    $countallprofile = mysqli_num_rows($resultallprofile)
                                                    ?>
                                                    <h5><?php echo $countallprofile; ?></h5> 
                                                    <span><b>All Profiles</b></span> 
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-4 mb-3">
                                <div class="db-pro-stat p-3 pt-1 pb-1">
                                    <div class="db-inte-prof-list db-inte-prof-chat">
                                        <ul>
                                            <li>
                                                <div class="db-int-pro-1"> <img src="images/gif/recentvisitors.gif" alt=""> </div>
                                                <div class="db-int-pro-2">
                                                    <?php
                                                    $today_date = date("Y-m-d");
                                                    $seven_days = date("Y-m-d", strtotime('-7 days'));
                                                    
                                                    $sqlnewmatches = "select * from registration where userid != '$userid' and gender != '$gender' and delete_status != 'delete' and entrydate between '$seven_days' and '$today_date'";
                                                    $resultnewmatches = mysqli_query($con,$sqlnewmatches);
                                                    $countnewmatches = mysqli_num_rows($resultnewmatches);
                                                    ?>
                                                    <h5><?php echo $countnewmatches; ?></h5> 
                                                    <span><b>New Matches</b></span> 
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-4 mb-3">
                                <div class="db-pro-stat p-3 pt-1 pb-1">
                                    <div class="db-inte-prof-list db-inte-prof-chat">
                                        <ul>
                                            <li>
                                                <div class="db-int-pro-1"> <img src="images/gif/mymatches.gif" alt=""> </div>
                                                <div class="db-int-pro-2">
                                                    <h5>0</h5> 
                                                    <span><b>My Matches</b></span> 
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-4 mb-3">
                                <div class="db-pro-stat p-3 pt-1 pb-1">
                                    <div class="db-inte-prof-list db-inte-prof-chat">
                                        <ul>
                                            <li>
                                                <div class="db-int-pro-1"> <img src="images/gif/nearbymatches-pin.gif" alt=""> </div>
                                                <div class="db-int-pro-2">
                                                    <?php
                                                    $sqlnearby = "select * from registration where userid != '$userid' and gender != '$gender' and state = '$state'  and delete_status != 'delete'";
                                                    $resultnearby = mysqli_query($con,$sqlnearby);
                                                    $rownearby = mysqli_num_rows($resultnearby);
                                                    ?>
                                                    <h5><?php echo $rownearby; ?></h5> 
                                                    <span><b>Nearby Matches</b></span> 
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-4 mb-3">
                                <div class="db-pro-stat p-3 pt-1 pb-1">
                                    <div class="db-inte-prof-list db-inte-prof-chat">
                                        <ul>
                                            <li>
                                                <div class="db-int-pro-1"> <img src="images/gif/recentlyviewed.gif" alt=""> </div>
                                                <div class="db-int-pro-2">
                                                    <?php
                                                    $sqlviewed = "select DISTINCT(visit) from viewvist_ids where view = '$userid' and visit != '' and delete_status != 'delete'";
                                                    $resultviewed = mysqli_query($con,$sqlviewed);
                                                    $rowviewed = mysqli_num_rows($resultviewed);
                                                    ?>
                                                    <h5><?php echo $rowviewed; ?></h5> 
                                                    <span><b>Recently Viewed</b></span> 
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-4 mb-3">
                                <div class="db-pro-stat p-3 pt-1 pb-1">
                                    <div class="db-inte-prof-list db-inte-prof-chat">
                                        <ul>
                                            <li>
                                                <div class="db-int-pro-1"> <img src="images/gif/like.gif" alt=""> </div>
                                                <div class="db-int-pro-2">
                                                    <?php
                                                    $sqlvisited = "select DISTINCT(view) from viewvist_ids where visit = '$userid' and view != '' and delete_status != 'delete'";
                                                    $resultvisited = mysqli_query($con,$sqlvisited);
                                                    $rowvisited = mysqli_num_rows($resultvisited);
                                                    ?>
                                                    <h5><?php echo $rowvisited; ?></h5> 
                                                    <span><b>Recent Visitors</b></span> 
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-4 mb-3">
                                <div class="db-pro-stat p-3 pt-1 pb-1">
                                    <div class="db-inte-prof-list db-inte-prof-chat">
                                        <ul>
                                            <li>
                                                <div class="db-int-pro-1"> <img src="images/gif/shortlistedlist.gif" alt=""> </div>
                                                <div class="db-int-pro-2">
                                                    <?php
                                                    $sqlshortlisted = "select * from shortlist_ids where by_whom = '$userid' and delete_status != 'delete'";
                                                    $resultshortlisted = mysqli_query($con,$sqlshortlisted);
                                                    $countshortlisted = mysqli_num_rows($resultshortlisted);
                                                    ?>
                                                    <h5><?php echo $countshortlisted; ?></h5> 
                                                    <span><b>Shortlisted Members</b></span> 
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-4 mb-3">
                                <div class="db-pro-stat p-3 pt-1 pb-1">
                                    <div class="db-inte-prof-list db-inte-prof-chat">
                                        <ul>
                                            <li>
                                                <div class="db-int-pro-1"> <img src="images/gif/contactviews.gif" alt=""> </div>
                                                <div class="db-int-pro-2">
                                                    <?php
                                                    $sqlcontact = "select DISTINCT(visit) from viewvist_ids where view = '$userid' and delete_status != 'delete'";
                                                    $resultcontact = mysqli_query($con,$sqlcontact);
                                                    $rowcontact = mysqli_num_rows($resultcontact);
                                                    ?>
                                                    <h5><?php echo $rowcontact; ?></h5> 
                                                    <span><b>Contact Views</b></span> 
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-4 mb-3">
                                <div class="db-pro-stat p-3 pt-1 pb-1">
                                    <div class="db-inte-prof-list db-inte-prof-chat">
                                        <ul>
                                            <li>
                                                <div class="db-int-pro-1"> <img src="images/gif/whatsappshare.gif" alt=""> </div>
                                                <div class="db-int-pro-2">
                                                    <h5>0</h5> 
                                                    <span><b>Whatsapp Shares</b></span> 
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12 col-lg-6 col-xl-4 db-sec-com">
                                <h2 class="db-tit">Profiles completion</h2>
                                <div class="db-pro-stat h-85">
                                    <h6>Profile completion</h6>
                                    <div class="db-pro-pgog">
                                        <?php
                                        $sqlprofilecomplete = "select * from registration where userid='$userid'";
                                        $resultprofilecomplete = mysqli_query($con,$sqlprofilecomplete);
                                        $resultprofilecomplete = mysqli_fetch_assoc($resultprofilecomplete);
                                        
                                        $basicinfo = ($resultprofilecomplete['basicinfo'] == 'Done') ? 10 : 0;
                                        $aboutme = ($resultprofilecomplete['aboutme'] == 'Done') ? 10 : 0;
                                        $astroinfo = ($resultprofilecomplete['astroinfo'] == 'Done') ? 10 : 0;
                                        $religiousinfo = ($resultprofilecomplete['religiousinfo'] == 'Done') ? 10 : 0;
                                        $educationinfo = ($resultprofilecomplete['educationinfo'] == 'Done') ? 10 : 0;
                                        $familyinfo = ($resultprofilecomplete['familyinfo'] == 'Done') ? 10 : 0;
                                        $hobbiesinfo = ($resultprofilecomplete['hobbiesinfo'] == 'Done') ? 10 : 0;
                                        $partnerinfo = ($resultprofilecomplete['partnerinfo'] == 'Done') ? 10 : 0;
                                        $contactinfo = ($resultprofilecomplete['contactinfo'] == 'Done') ? 10 : 0;
                                        $photosinfo = ($resultprofilecomplete['photosinfo'] == 'Done') ? 10 : 0;
                                        ?>
                                        <span><b class="count"><?php echo ($basicinfo + $aboutme + $astroinfo + $religiousinfo + $educationinfo + $familyinfo + $hobbiesinfo + $partnerinfo + $contactinfo + $photosinfo); ?></b>%</span>
                                    </div>
                                    <?php
                                    $sqlformfill = "select * from registration where userid = '$userid'";
                                    $resultformfill = mysqli_query($con,$sqlformfill);
                                    $rowformfill = mysqli_fetch_assoc($resultformfill);
                                    ?>
                                    <ul class="pro-stat-ic">
                                        <li class="roundicon <?php if($rowformfill['basicinfo'] == 'Done') { echo "bg-success"; } else { echo "bg-danger"; }?>"><span class="material-symbols-outlined">contacts</span></li>
                                        <li class="roundicon <?php if($rowformfill['aboutme'] == 'Done') { echo "bg-success"; } else { echo "bg-danger"; }?>"><span class="material-symbols-outlined">person</span></li>
                                        <li class="roundicon <?php if($rowformfill['astroinfo'] == 'Done') { echo "bg-success"; } else { echo "bg-danger"; }?>"><span class="material-symbols-outlined">brightness_auto</span></li>
                                        <li class="roundicon <?php if($rowformfill['religiousinfo'] == 'Done') { echo "bg-success"; } else { echo "bg-danger"; }?>"><span class="material-symbols-outlined">temple_hindu</span></li>
                                        <li class="roundicon <?php if($rowformfill['educationinfo'] == 'Done') { echo "bg-success"; } else { echo "bg-danger"; }?>"><span class="material-symbols-outlined">school</span></li>
                                        <li class="roundicon <?php if($rowformfill['familyinfo'] == 'Done') { echo "bg-success"; } else { echo "bg-danger"; }?>"><span class="material-symbols-outlined">family_restroom</span></li>
                                        <li class="roundicon <?php if($rowformfill['hobbiesinfo'] == 'Done') { echo "bg-success"; } else { echo "bg-danger"; }?>"><span class="material-symbols-outlined">interests</span></li>
                                        <li class="roundicon <?php if($rowformfill['partnerinfo'] == 'Done') { echo "bg-success"; } else { echo "bg-danger"; }?>"><span class="material-symbols-outlined">diversity_2</span></li>
                                        <li class="roundicon <?php if($rowformfill['contactinfo'] == 'Done') { echo "bg-success"; } else { echo "bg-danger"; }?>"><span class="material-symbols-outlined">call</span></li>
                                        <li class="roundicon <?php if($rowformfill['photosinfo'] == 'Done') { echo "bg-success"; } else { echo "bg-danger"; }?>"><span class="material-symbols-outlined">photo_camera</span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6 col-xl-4 db-sec-com">
                                <h2 class="db-tit">Plan details</h2>
                                <div class="db-pro-stat h-85">
                                    <h6 class="tit-top-curv">Standard plan</h6>
                                    <div class="db-plan-card">
                                        <img src="images/icon/plan.png" alt="">
                                    </div>
                                    <div class="db-plan-detil mt-3">
                                        <?php
                                        $joindate = "select * from registration where userid = '$userid'";
                                        $resultjoindate = mysqli_query($con,$joindate);
                                        $rowjoindate = mysqli_fetch_assoc($resultjoindate);
                                        
                                        $tilldate = date('M d, Y H:i:s', strtotime('+14 day',strtotime($rowjoindate['entrydate'])));
                                        ?>
                                        <script>
                                        // Check if demo element exists to avoid console errors
                                        document.addEventListener("DOMContentLoaded", function() {
                                            var demoElement = document.getElementById("demo");
                                            if(demoElement) {
                                                var countDownDate = new Date("<?php echo $tilldate; ?>").getTime();
                                                var x = setInterval(function() {
                                                  var now = new Date().getTime();
                                                  var distance = countDownDate - now;
                                                  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                                  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                                  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                                  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                                                  demoElement.innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";
                                                  if (distance < 0) {
                                                    clearInterval(x);
                                                    demoElement.innerHTML = "EXPIRED";
                                                  }
                                                }, 1000);
                                            }
                                        });
                                        </script>
                                        <ul>
                                            <li>Plan name: <strong>Free</strong></li>
                                            <li>Validity: <strong>Unlimited</strong></li>
                                            <li>Join Date: <strong><?php echo date('d M Y', strtotime($rowjoindate['entrydate'])); ?></strong></li>
                                            <li><a href="#" class="cta-3">Comming Soon</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-4 db-sec-com">
                                <h2 class="db-tit">Recent Visitors</h2>
                                    <div class="db-pro-stat overflow h-85">
                                        <div class="db-inte-prof-list db-inte-prof-chat">
                                            <?php
                                            $sqlvisitors = "select distinct(view) from viewvist_ids where visit = '$userid' and view != '' and delete_status != 'delete' order by id desc limit 50";
                                            $resultvisitors = mysqli_query($con,$sqlvisitors);
                                            $countvisitors = mysqli_num_rows($resultvisitors);
                                            if($countvisitors == 0)
                                            {
                                            ?>
                                                <img src="userphoto/recent-visitors.gif" alt="" style="width:100%">
                                                <p class="text-center"><b>No Visitors Yet</b></p>
                                            <?php
                                            } 
                                            else
                                            {
                                            ?>
                                            <ul class="slider11">
                                            <?php
                                                    while($rowvisitors = mysqli_fetch_assoc($resultvisitors))
                                                    {
                                                        $pro_id = $rowvisitors['view'];
                                                        
                                                        $sqlphoto = "select * from photos_info where userid = '$pro_id'";
                                                        $resultphoto = mysqli_query($con,$sqlphoto);
                                                        $rowphoto = mysqli_fetch_assoc($resultphoto);
                                        
                                                        $sqlbasic = "select * from basic_info where userid = '$pro_id'";
                                                        $resultbasic = mysqli_query($con,$sqlbasic);
                                                        $rowbasic = mysqli_fetch_assoc($resultbasic);
                                                        
                                                        $sqllocation = "select * from groom_location where userid = '$pro_id'";
                                                        $resultlocation = mysqli_query($con,$sqllocation);
                                                        $rowlocation = mysqli_fetch_assoc($resultlocation);
                                                     ?>
                                                    <li>
                                                        <div class="db-int-pro-1"> <img src="userphoto/<?php echo $rowphoto['profilepic']?>" alt=""> </div>
                                                        <div class="db-int-pro-2">
                                                            <h5><?php echo $rowbasic['fullname']; ?></h5> 
                                                            <span><?php echo $rowlocation['city'].', '.$rowlocation['country'] ?></span> 
                                                        </div>
                                                        <a href="user-profile-details.php?uid=<?php echo $pro_id; ?>" class="fclick">&nbsp;</a>
                                                    </li>
                                                    <?php
                                                    }
                                            
                                            ?>
                                            </ul>
                                            <?php
                                            }
                                            ?>
                                            
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="col-md-12 db-sec-com db-new-pro-main">
                            <h2 class="db-tit">New Profiles Matches</h2>
                            <ul class="slider">
                                <?php
                                $sqlprofile = "select * from registration where userid != '$userid' and gender != '$gender' and delete_status != 'delete' order by id desc limit 50";
                                $resultprofile = mysqli_query($con,$sqlprofile);
                                while($rowprofile = mysqli_fetch_assoc($resultprofile))
                                {
                                    $profileid = $rowprofile['userid'];
                                    
                                    $sqlbasicinfo = "select * from basic_info where userid = '$profileid'";
                                    $resultbasicinfo = mysqli_query($con,$sqlbasicinfo);
                                    $rowbasicinfo = mysqli_fetch_assoc($resultbasicinfo);
                                    
                                    $sqlphotoinfo = "select * from photos_info where userid = '$profileid'";
                                    $resultphotoinfo = mysqli_query($con,$sqlphotoinfo);
                                    $rowphotoinfo = mysqli_fetch_assoc($resultphotoinfo);
                                    
                                    $sqllocationinfo = "select * from groom_location where userid = '$profileid'";
                                    $resultlocationinfo = mysqli_query($con,$sqllocationinfo);
                                    $rowlocationinfo = mysqli_fetch_assoc($resultlocationinfo);
                                ?>
                                <li>
                                    <div class="db-new-pro">
                                        <img src="userphoto/<?php echo $rowphotoinfo['profilepic']?>" alt="" class="profile">
                                        <div>
                                            <h5><?php echo $rowbasicinfo['fullname']; ?></h5>
                                            <span class="city"><?php echo $rowlocationinfo['city']; ?></span>
                                            <br>
                                            <span class="age"><?php echo $rowbasicinfo['age']; ?> Years</span>
                                        </div>
                                        <a href="user-profile-details.php?uid=<?php echo $profileid; ?>" class="fclick">&nbsp;</a>
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
        </div>
    </section>
    <?php
include 'footer.php'; 
?>

<script>
$(document).ready(function(){
    
    // 1. GET DATA FROM PHP (With check to prevent null error)
    var popupQueue = <?php echo !empty($json_popup_queue) ? $json_popup_queue : '[]'; ?>;
    var currentPopup = null;

    console.log("Popup Queue Data:", popupQueue);

    // 2. FUNCTION TO SHOW POPUPS
    function showNextPopup() {
        // Check if queue is empty
        if (popupQueue.length === 0) {
            $('.menu-pop1, .pop-bg').removeClass('act');
            return;
        }

        // Get first item
        currentPopup = popupQueue.shift();
        console.log("Showing Popup:", currentPopup);

        // A. Set Text Content
        $('#pop-subject').text(currentPopup.subject || 'Notification');
        
        // Use html() to allow formatting, fallback to empty string
        if(currentPopup.body_content) {
            $('#pop-body').html(currentPopup.body_content);
        } else {
            $('#pop-body').text("");
        }

        // B. Set Image
        if (currentPopup.media_file && currentPopup.media_file !== '') {
            var imgSrc = '';
            // Check if it's a system gif or uploaded banner
            if(currentPopup.is_local_img) {
                imgSrc = currentPopup.media_file; 
            } else {
                imgSrc = 'uploads/' + currentPopup.media_file; 
            }
            $('#pop-img').attr('src', imgSrc);
            $('#pop-img-container').show();
        } else {
            $('#pop-img-container').hide();
        }

        // C. Set Button
        if(currentPopup.btn_text && currentPopup.btn_text !== '') {
            $('#pop-btn').text(currentPopup.btn_text);
            $('#pop-btn').attr('href', currentPopup.btn_link);
            $('#pop-btn').show();
        } else {
            $('#pop-btn').hide();
        }

        // D. Show the Popup Container
        $('.menu-pop1, .pop-bg').addClass('act');
    }

    // 3. INITIAL TRIGGER (Delay slightly for page load)
    if(popupQueue.length > 0) {
        setTimeout(function(){
            showNextPopup();
        }, 1000); 
    }

    // 4. CLOSE BUTTON HANDLER
    $('#close-popup-btn').on('click', function() {
        
        // A. If it was a Banner, mark as viewed in Database
        if(currentPopup && currentPopup.type === 'banner') {
            $.post('aj-log-banner-view.php', { 
                banner_ids: currentPopup.id 
            });
        }

        // B. Hide Current Popup
        $('.menu-pop1, .pop-bg').removeClass('act');

        // C. Wait 500ms and show next item in Queue
        setTimeout(function(){
            showNextPopup();
        }, 500);
    });

});
</script>
 <script>
        // 1. CLOCK FUNCTION
        function updateClock() {
            const now = new Date();
            
            // Time Format (e.g., 10:30:45 AM)
            let timeString = now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true });
            
            // Date Format (e.g., Friday, 21 Nov 2025)
            const dateOptions = { weekday: 'long', year: 'numeric', month: 'short', day: 'numeric' };
            let dateString = now.toLocaleDateString('en-US', dateOptions);

            document.getElementById('live-clock').innerText = timeString;
            document.getElementById('live-date').innerText = dateString;
        }
        setInterval(updateClock, 1000);
        updateClock(); // Run immediately

        // 2. BATTERY FUNCTION
        if ('getBattery' in navigator) {
            navigator.getBattery().then(function(battery) {
                const batteryWrapper = document.getElementById('battery-wrapper');
                const batteryLevel = document.getElementById('battery-level');
                const batteryIcon = document.getElementById('battery-icon');
                const chargingStatus = document.getElementById('charging-status');

                function updateBattery() {
                    batteryWrapper.style.display = 'block'; // Show only if supported
                    let level = Math.round(battery.level * 100);
                    batteryLevel.innerText = level + '%';

                    // Icon Logic based on percentage
                    batteryIcon.className = 'fa '; // reset
                    if(level >= 75) { batteryIcon.classList.add('fa-battery-full'); batteryIcon.style.color = 'green'; }
                    else if(level >= 50) { batteryIcon.classList.add('fa-battery-three-quarters'); batteryIcon.style.color = '#b16421'; }
                    else if(level >= 25) { batteryIcon.classList.add('fa-battery-quarter'); batteryIcon.style.color = 'orange'; }
                    else { batteryIcon.classList.add('fa-battery-empty'); batteryIcon.style.color = 'red'; }

                    // Charging Status
                    if(battery.charging) {
                        chargingStatus.style.display = 'inline-block';
                    } else {
                        chargingStatus.style.display = 'none';
                    }
                }

                updateBattery();
                
                // Event Listeners for changes
                battery.addEventListener('levelchange', updateBattery);
                battery.addEventListener('chargingchange', updateBattery);
            });
        } else {
            console.log("Battery API not supported on this device/browser.");
        }

        // 3. GREETING FUNCTION (NEW)
        function updateGreeting() {
            const now = new Date();
            const hour = now.getHours();
            const name = "<?php echo $my_name; ?>";
            let greetingText = "Good Morning";
            let emoji = "☕"; // Default: Morning Coffee

            if (hour >= 5 && hour < 12) {
                greetingText = "Good Morning";
                emoji = "☕";
            } else if (hour >= 12 && hour < 17) {
                greetingText = "Good Afternoon";
                emoji = "☀️";
            } else if (hour >= 17 && hour < 21) {
                greetingText = "Good Evening";
                emoji = "🌆";
            } else {
                greetingText = "Good Night";
                emoji = "🌙";
            }
            
            // Set the text content
            const display = document.getElementById('greeting-display');
            if(display) {
                display.innerHTML = `${greetingText} ${name} ${emoji}`;
            }
        }
        
        // Run once on load, then every minute
        updateGreeting();
        setInterval(updateGreeting, 60000);

        </script>
        
