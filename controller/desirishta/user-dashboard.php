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
$sqlbasicinfo = "select * from basic_info where userid = '$userid'";
$resultbasicinfo = mysqli_query($con,$sqlbasicinfo);
$rowbasicinfo = mysqli_fetch_assoc($resultbasicinfo);
// --- NEW: FETCH USER DATA FOR POPUP & GREETING ---
$my_name = "User"; // Default
$show_first_login_popup = false;

// CORRECTION: Changed 'fullname' to 'name' based on your database structure
$sql_user_data = "SELECT name, first_login, contact_privacy, entrydate FROM registration WHERE userid = '$userid'";
$result_user_data = mysqli_query($con, $sql_user_data);

if($result_user_data && mysqli_num_rows($result_user_data) > 0) {
    $row_user_data = mysqli_fetch_assoc($result_user_data);
    
    // Get Name
    if(!empty($row_user_data['name'])) {
        $name_parts = explode(' ', trim($row_user_data['name']));
        $my_name = $name_parts[0]; 
    }

    // --- LOGIC: SHOW POPUP FOR 15 DAYS IF PUBLIC ---
    $privacy_setting = isset($row_user_data['contact_privacy']) ? $row_user_data['contact_privacy'] : 'Show to All';
    $entry_date_str = $row_user_data['entrydate'];
    
    // Calculate Days since joining
    $entry_dt = new DateTime($entry_date_str);
    $current_dt = new DateTime($current_date);
    $interval = $entry_dt->diff($current_dt);
    $days_old = $interval->days;

    // Condition: If (Account <= 15 days old) AND (Privacy is 'Show to All')
    if($days_old <= 15 && $privacy_setting == 'Show to All') {
        $show_first_login_popup = true;
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
// Note: Keeping your existing logic variables ($id_profilestatus etc.) assuming they come from header.php or config.php
// If they are not defined, you might need to fetch them from 'registration' table above.

// Case 1: Profile Not Screened
if(isset($id_profilestatus) && $id_profilestatus == '0' && $id_profilestatus_popup == '0') {
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
    mysqli_query($con, "UPDATE `registration` SET `profilestatus_popup`='1' WHERE `userid`='$userid'");
}

// Case 2: Screening Complete
if(isset($id_profilestatus) && $id_profilestatus == '1' && $id_profilestatus_popup == '0') {
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
if(isset($id_verification) && $id_verification != 'Done' && $id_verification_popup == '0') {
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
if(isset($id_verification) && $id_verification == 'Done' && $id_verification_popup == '0') {
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


$popup_queue = []; 

// A. Birthday Check (New Implementation)
$sql_dob_check = "SELECT dob FROM astro_info WHERE userid = '$userid'";
$result_dob_check = mysqli_query($con, $sql_dob_check);
if($result_dob_check && mysqli_num_rows($result_dob_check) > 0) {
    $row_dob = mysqli_fetch_assoc($result_dob_check);
    if(!empty($row_dob['dob']) && $row_dob['dob'] != '0000-00-00') {
        $user_dob_md = date('m-d', strtotime($row_dob['dob']));
        $today_md = date('m-d');
        
        if($user_dob_md == $today_md) {
            // Check cookie to prevent showing multiple times in one session if desired
            // For now, we show it on dashboard load if it's their birthday
            $popup_queue[] = [
                'id' => 'birthday_'.date('Y'),
                'type' => 'status',
                'subject' => 'Happy Birthday, ' . $my_name . '! 🎂',
                'media_file' => 'images/gif/birthday1.gif', // Ensure this GIF exists
                'body_content' => 'Wishing you a wonderful birthday filled with love and joy from the Desi Rishta Team! 🎉',
                'is_local_img' => true,
                'btn_link' => '',
                'btn_text' => 'Thank You'
            ];
        }
    }
}
// Encode queue data to JSON for JavaScript
$json_popup_queue = json_encode($popup_queue);
?>

<style>
    /* Force Black Text for Standard Popups */
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
    #pop-img-container.user-pro {
        width: 100% !important;
        height: auto !important;
        border-radius: 0 !important;
        overflow: visible !important;
        max-width: 100% !important;
        margin: 0 auto 15px auto !important;
    }

    #pop-img-container img {
        width: 100% !important;
        height: auto !important;
        max-height: 500px !important;
        object-fit: contain !important;
        border-radius: 8px;
        display: block;
    }

    /* BG Overlay */
.welcome-modal {
    display: none;
    position: fixed;
    z-index: 999999;
    left: 0; top: 0;
    width: 100%; height: 100%;
    background-color: rgba(0,0,0,0.85);
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(6px);
}

/* Main box */
.welcome-modal-content {
    background: #fff;
    width: 95%;
    max-width: 650px;
    border-radius: 14px;
    overflow: hidden;
    animation: slideDown 0.4s ease-out;
    box-shadow: 0 12px 35px rgba(0,0,0,0.45);
}

/* Ribbon - brown gradient + gold text */
.welcome-ribbon {
    background: linear-gradient(135deg, #5c2c28, #3d1a17);
    color: #eac26a;
    padding: 15px 20px;
    text-align: center;
    font-size: 20px;
    font-weight: 800;
    letter-spacing: 1px;
}

/* Body */
.welcome-body { padding: 20px; }

/* Boxes */
.guideline-box {
    border: 1px solid #e6d9c4;
    background: #fbf6ef;
    padding: 15px;
    border-radius: 10px;
    margin-bottom: 15px;
}

/* Heading inside box */
.guideline-title {
    font-size: 15px;
    font-weight: 700;
    color: #5c2c28;
    border-bottom: 2px solid #e6d9c4;
    padding-bottom: 6px;
    margin-bottom: 10px;
    display: flex;
    gap: 6px;
    align-items: center;
}

/* Status rows */
.status-row {
    display: flex;
    justify-content: space-between;
    padding: 4px 0;
    border-bottom: 1px dashed #ddd;
    font-size: 13px;
}

.status-active { color: #28a745; font-weight: 700; }
.status-inactive { color: #d9534f; font-weight: 700; }

/* Buttons */
.modal-actions {
    padding: 15px;
    background: #f6ebe0;
    display: flex;
    justify-content: center;
    gap: 15px;
}

.btn-popup-outline {
    border: 2px solid #5c2c28;
    color: #5c2c28;
    padding: 8px 15px;
    border-radius: 6px;
    font-weight: 600;
    background: transparent;
}
.btn-popup-outline:hover {
    background: #5c2c28;
    color: #fff;
}

.btn-popup-primary {
    background: #a17238;
    border: 2px solid #a17238;
    color: white;
    padding: 8px 15px;
    border-radius: 6px;
    font-weight: 600;
}
.btn-popup-primary:hover {
    background: #8d6231;
    border-color: #8d6231;
}

/* Animation */
@keyframes slideDown {
    from { opacity: 0; transform: translateY(-40px); }
    to   { opacity: 1; transform: translateY(0); }
}

</style>

<!-- STANDARD NOTIFICATION POPUP (EXISTING) -->
<div class="menu-pop menu-pop1" id="dynamic-popup">
    <span class="menu-pop-clo" id="close-popup-btn"><i class=" fa bi bi-x" aria-hidden="true"></i></span>
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



<?php if($show_first_login_popup) { ?>
<div id="firstLoginModal" class="welcome-modal" style="display: flex;">
    <div class="welcome-modal-content">

        <!-- Ribbon -->
        <div class="welcome-ribbon">
            WELCOME TO DESI RISHTA “<?php echo strtoupper($my_name); ?>”
        </div>

        <div class="welcome-body">
            <p class="text-center mb-3" style="font-size:15px; color:#333;">
                <b>Guidelines for Viewing Contacts and Sending Interest</b>
            </p>

            <!-- Box 1 -->
            <div class="guideline-box">
                <div class="guideline-title">
                    <i class="bi bi-eye-fill"></i>  
                    1. When Contact Privacy = Show to All (Default)
                </div>

                <ul>
                    <li>Contacts are always visible (no request needed).</li>
                </ul>

                <div class="status-row">
                    <span><i class="bi bi-telephone-fill"></i> Contact View</span>
                    <span class="status-active"><i class="bi bi-check-circle-fill"></i> Active</span>
                </div>

                <div class="status-row" style="border:none;">
                    <span><i class="bi bi-heart"></i> Send Interest</span>
                    <span class="status-inactive"><i class="bi bi-x-circle-fill"></i> Inactive</span>
                </div>
            </div>

            <!-- Box 2 -->
            <div class="guideline-box">
                <div class="guideline-title">
                    <i class="bi bi-eye-slash-fill"></i>
                    2. When Contact Privacy = Hide from All
                </div>

                <ul>
                    <li>Contacts are hidden (request required).</li>
                    <li>Once the other member accepts your interest, their contact becomes visible.</li>
                </ul>

                <div class="status-row">
                    <span><i class="bi bi-heart-fill"></i> Send Interest</span>
                    <span class="status-active"><i class="bi bi-check-circle-fill"></i> Active</span>
                </div>

                <div class="status-row">
                    <span><i class="bi bi-telephone-x-fill"></i> Contact View</span>
                    <span class="status-inactive"><i class="bi bi-x-circle-fill"></i> Inactive</span>
                </div>
            </div>

            <p class="text-center text-muted small mt-2">
                Your current privacy setting is <b>Show to All</b>. Choose your preference:
            </p>
        </div>

        <div class="modal-actions">
            <button class="btn-popup-outline" onclick="closePrivacyModal()">Keep "Show to All"</button>
            <button class="btn-popup-primary" onclick="updatePrivacy('hide')">Change to "Hide from All"</button>
        </div>

    </div>
</div>
<?php } ?>


<!-- DASHBOARD CONTENT -->
<section>
    <div class="db">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-lg-3">
                    <?php include 'user-sidebar.php'; ?>
                </div>
                <div class="col-md-8 col-lg-9">
                    <div class="row">
                        <!-- CLOCK & GREETING SECTION -->
                        <div class="col-lg-12 col-xl-12 mb-4">
                            <div class="db-pro-stat p-4 text-center" style="background: #fff; border-radius: 10px; border: 1px solid #e6e6e6; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
                                <div class="d-flex justify-content-center align-items-center flex-wrap" style="gap: 40px;">
                                    <div class="clock-section">
                                        <h2 id="live-clock" style="margin: 0; color: #b16421; font-weight: 800; font-size: 36px; line-height: 1;">--:--:--</h2>
                                        <div id="live-date" style="margin-top: 5px; color: #666; font-weight: 600; font-size: 14px; text-transform: uppercase; letter-spacing: 1px;">Loading Date...</div>
                                    </div>
                                    <div class="d-none d-md-block" style="border-left: 2px solid #eee; height: 50px;"></div>
                                    <div class="greeting-section">
                                        <h2 id="greeting-display" style="margin: 0; color: #333; font-weight: 700; font-size: 24px; line-height: 1;"></h2>
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
                                <!-- All Profiles -->
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
                                <!-- New Matches -->
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
                                <!-- My Matches (Placeholder 0) -->
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
                                <!-- Nearby Matches -->
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
                                <!-- Recently Viewed -->
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
                                <!-- Recent Visitors -->
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
                                <!-- Shortlisted -->
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
                                <!-- Contact Views -->
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
                                <!-- WhatsApp Shares -->
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

                            <!-- ROW: Profile Completion & Plan -->
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
                                        <ul class="pro-stat-ic">
                                            <li class="roundicon <?php if($resultprofilecomplete['basicinfo'] == 'Done') { echo "bg-success"; } else { echo "bg-danger"; }?>"><span class="material-symbols-outlined">contacts</span></li>
                                            <li class="roundicon <?php if($resultprofilecomplete['aboutme'] == 'Done') { echo "bg-success"; } else { echo "bg-danger"; }?>"><span class="material-symbols-outlined">person</span></li>
                                            <li class="roundicon <?php if($resultprofilecomplete['astroinfo'] == 'Done') { echo "bg-success"; } else { echo "bg-danger"; }?>"><span class="material-symbols-outlined">brightness_auto</span></li>
                                            <li class="roundicon <?php if($resultprofilecomplete['religiousinfo'] == 'Done') { echo "bg-success"; } else { echo "bg-danger"; }?>"><span class="material-symbols-outlined">temple_hindu</span></li>
                                            <li class="roundicon <?php if($resultprofilecomplete['educationinfo'] == 'Done') { echo "bg-success"; } else { echo "bg-danger"; }?>"><span class="material-symbols-outlined">school</span></li>
                                            <li class="roundicon <?php if($resultprofilecomplete['familyinfo'] == 'Done') { echo "bg-success"; } else { echo "bg-danger"; }?>"><span class="material-symbols-outlined">family_restroom</span></li>
                                            <li class="roundicon <?php if($resultprofilecomplete['hobbiesinfo'] == 'Done') { echo "bg-success"; } else { echo "bg-danger"; }?>"><span class="material-symbols-outlined">interests</span></li>
                                            <li class="roundicon <?php if($resultprofilecomplete['partnerinfo'] == 'Done') { echo "bg-success"; } else { echo "bg-danger"; }?>"><span class="material-symbols-outlined">diversity_2</span></li>
                                            <li class="roundicon <?php if($resultprofilecomplete['contactinfo'] == 'Done') { echo "bg-success"; } else { echo "bg-danger"; }?>"><span class="material-symbols-outlined">call</span></li>
                                            <li class="roundicon <?php if($resultprofilecomplete['photosinfo'] == 'Done') { echo "bg-success"; } else { echo "bg-danger"; }?>"><span class="material-symbols-outlined">photo_camera</span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6 col-xl-4 db-sec-com">
    <h2 class="db-tit">Plan details</h2>
    <div class="db-pro-stat h-85">
        <h6 class="tit-top-curv">My Plan Status</h6>
        <div class="db-plan-card">
            <img src="images/icon/plan.png" alt="">
        </div>
        <div class="db-plan-detil mt-3">
            <?php
            // 1. Get Plan Name
            $plan_name = $row_user_data['plan_name'] ?? 'Free';
            $limit = 5; 
            if($plan_name=='Gold') $limit=15; 
            if($plan_name=='Platinum') $limit=25;

            // 2. Get Usage Today
            $today = date('Y-m-d');
            $sql_usage = "SELECT COUNT(*) as cnt FROM contact_view_logs WHERE viewer_id='$userid' AND view_date='$today'";
            $res_usage = mysqli_query($con, $sql_usage);
            $row_usage = mysqli_fetch_assoc($res_usage);
            $used = $row_usage['cnt'];
            ?>
            
            <ul>
                <li>Current Plan: <strong><?php echo $plan_name; ?></strong></li>
                <li>Daily Limit: <strong><?php echo $limit; ?> Contacts</strong></li>
                <li>Views Used Today: <strong style="color: #b16421; font-size:16px;"><?php echo $used; ?> / <?php echo $limit; ?></strong></li>
                <li><a href="plans.php" class="cta-3">Upgrade Plan</a></li>
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
                                            if($countvisitors == 0) {
                                            ?>
                                                <img src="userphoto/recent-visitors.gif" alt="" style="width:100%">
                                                <p class="text-center"><b>No Visitors Yet</b></p>
                                            <?php
                                            } else {
                                            ?>
                                            <ul class="slider11">
                                                <?php
                                                while($rowvisitors = mysqli_fetch_assoc($resultvisitors)) {
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
                                                <?php } ?>
                                            </ul>
                                            <?php } ?>
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
                                    while($rowprofile = mysqli_fetch_assoc($resultprofile)) {
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
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <style>
 .couple-sli .slick-prev, .couple-sli .slick-next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 2;
    background:#f6af04;
    color: white;
    border: none;
    height: 45px;
    width: 45px;
    font-size: 0px;
    border-radius: 50%;
    cursor: pointer;
    transition: all 0.3s 
ease;
}</style>
<?php include 'footer.php'; ?>
<div id="reconnectModal" class="custom-modal" style="display: none;">
    <div class="custom-modal-content">
        <span class="close-modal-btn" onclick="closeReconnect()">&times;</span>
        <div class="modal-body">
            <img src="images/gif/reconnect.gif" alt="Welcome Back" class="success-gif" style="width:150px;">
            <h3 class="modal-title" style="color:#b16421;">It’s been a while!</h3>
            <p class="modal-desc">Let’s reconnect on Desi Rishta. We missed you!</p>
            <button class="ok-btn" onclick="closeReconnect()">OK</button>
        </div>
    </div>
</div>

<script>
    function closeReconnect() {
        document.getElementById('reconnectModal').style.display = 'none';
        // Remove cookie via JS so it doesn't show again in this session
        document.cookie = "show_reconnect_popup=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    }

    // Check PHP set cookie via JS
    function getCookie(name) {
        let match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
        if (match) return match[2];
    }

    window.onload = function() {
        // ... your existing onload scripts ...
        if(getCookie('show_reconnect_popup') === 'yes') {
            document.getElementById('reconnectModal').style.display = 'flex';
        }
    };
</script>
<!-- SCRIPTS FOR POPUPS, CLOCK, AND BATTERY -->
<script>
$(document).ready(function(){

    var popupQueue = <?php echo !empty($json_popup_queue) ? $json_popup_queue : '[]'; ?>;
    var currentPopup = null;

    // FILTER POPUP: Birthday repeat ना हो
    popupQueue = popupQueue.filter(function(p){
        if(p.id.includes("birthday_")){
            return !localStorage.getItem(p.id);
        }
        return true;
    });

    function showNextPopup() {
        if (popupQueue.length === 0) {
            $('.menu-pop1, .pop-bg').removeClass('act');
            return;
        }

        currentPopup = popupQueue.shift();

        $('#pop-subject').text(currentPopup.subject || 'Notification');
        $('#pop-body').html(currentPopup.body_content || "");

        if(currentPopup.media_file){
            var imgSrc = currentPopup.is_local_img ? currentPopup.media_file : 'uploads/' + currentPopup.media_file;
            $('#pop-img').attr('src', imgSrc);
            $('#pop-img-container').show();
        } else {
            $('#pop-img-container').hide();
        }

        if(currentPopup.btn_text){
            $('#pop-btn').text(currentPopup.btn_text).attr('href', currentPopup.btn_link).show();
        } else {
            $('#pop-btn').hide();
        }

        $('.menu-pop1, .pop-bg').addClass('act');
    }

    if(popupQueue.length > 0 && $('#firstLoginModal').length == 0){
        setTimeout(showNextPopup, 1000);
    }

    // Close button logic
    $('#close-popup-btn, #pop-btn').on('click', function() {

        // Birthday popup clicked -> Save in localStorage
        if(currentPopup && currentPopup.id.includes("birthday_")){
            localStorage.setItem(currentPopup.id, "done");
        }

        if(currentPopup && currentPopup.type === 'banner'){
            $.post('aj-log-banner-view.php', { banner_ids: currentPopup.id });
        }

        $('.menu-pop1, .pop-bg').removeClass('act');

        setTimeout(showNextPopup, 500);
    });

});


// $(document).ready(function(){
//     // 1. STANDARD POPUP QUEUE (Banners/Status)
//     var popupQueue = <?php echo !empty($json_popup_queue) ? $json_popup_queue : '[]'; ?>;
//     var currentPopup = null;

//     function showNextPopup() {
//         if (popupQueue.length === 0) {
//             $('.menu-pop1, .pop-bg').removeClass('act');
//             return;
//         }
//         currentPopup = popupQueue.shift();
        
//         $('#pop-subject').text(currentPopup.subject || 'Notification');
//         if(currentPopup.body_content) {
//             $('#pop-body').html(currentPopup.body_content);
//         } else {
//             $('#pop-body').text("");
//         }

//         if (currentPopup.media_file && currentPopup.media_file !== '') {
//             var imgSrc = currentPopup.is_local_img ? currentPopup.media_file : 'uploads/' + currentPopup.media_file;
//             $('#pop-img').attr('src', imgSrc);
//             $('#pop-img-container').show();
//         } else {
//             $('#pop-img-container').hide();
//         }

//         if(currentPopup.btn_text && currentPopup.btn_text !== '') {
//             $('#pop-btn').text(currentPopup.btn_text);
//             $('#pop-btn').attr('href', currentPopup.btn_link);
//             $('#pop-btn').show();
//         } else {
//             $('#pop-btn').hide();
//         }
//         $('.menu-pop1, .pop-bg').addClass('act');
//     }

//     // Only start standard popups if First Login Popup is NOT showing
//     if(popupQueue.length > 0 && $('#firstLoginModal').length == 0) {
//         setTimeout(function(){ showNextPopup(); }, 1000); 
//     }

//     $('#close-popup-btn').on('click', function() {
//         if(currentPopup && currentPopup.type === 'banner') {
//             $.post('aj-log-banner-view.php', { banner_ids: currentPopup.id });
//         }
//         $('.menu-pop1, .pop-bg').removeClass('act');
//         setTimeout(function(){ showNextPopup(); }, 500);
//     });
// });

// 2. FIRST LOGIN PRIVACY POPUP LOGIC



function closePrivacyModal() {
    document.getElementById('firstLoginModal').style.display = 'none';
    // If you want, you can trigger standard popups here if the queue exists
    if(typeof showNextPopup === 'function' && popupQueue.length > 0) {
        showNextPopup();
    }
}

function updatePrivacy(type) {
    var action = (type === 'hide') ? 'set_privacy_hide' : 'set_privacy_show';
    $.ajax({
        url: 'ajax-update-privacy.php',
        type: 'POST',
        data: { action: action },
        success: function(response) {
            if(response.trim() == 'success') {
                document.getElementById('firstLoginModal').style.display = 'none';
                if(type === 'hide') {
                    alert('Privacy updated to "Hide from All". You can change this later in Settings.');
                    location.reload(); // Reload to reflect changes
                } else {
                    // For "Keep", just close modal (handled by closePrivacyModal above, but here for AJAX consistency)
                    // No reload needed
                }
            } else {
                alert('Error updating privacy. Please try again.');
            }
        },
        error: function() { alert('Network error.'); }
    });
}

// 3. CLOCK, GREETING, BATTERY
function updateClock() {
    const now = new Date();
    let timeString = now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true });
    const dateOptions = { weekday: 'long', year: 'numeric', month: 'short', day: 'numeric' };
    let dateString = now.toLocaleDateString('en-US', dateOptions);
    document.getElementById('live-clock').innerText = timeString;
    document.getElementById('live-date').innerText = dateString;
}
setInterval(updateClock, 1000);
updateClock();

function updateGreeting() {
    const now = new Date();
    const hour = now.getHours();
    const name = "<?php echo $my_name; ?>";
    let greetingText = "Good Morning";
    let emoji = "☕";
    if (hour >= 5 && hour < 12) { greetingText = "Good Morning"; emoji = "☕"; }
    else if (hour >= 12 && hour < 17) { greetingText = "Good Afternoon"; emoji = "☀️"; }
    else if (hour >= 17 && hour < 21) { greetingText = "Good Evening"; emoji = "🌆"; }
    else { greetingText = "Good Night"; emoji = "🌙"; }
    const display = document.getElementById('greeting-display');
    if(display) { display.innerHTML = `${greetingText} ${name} ${emoji}`; }
}
updateGreeting();
setInterval(updateGreeting, 60000);

if ('getBattery' in navigator) {
    navigator.getBattery().then(function(battery) {
        const batteryWrapper = document.getElementById('battery-wrapper');
        const batteryLevel = document.getElementById('battery-level');
        const batteryIcon = document.getElementById('battery-icon');
        const chargingStatus = document.getElementById('charging-status');
        function updateBattery() {
            batteryWrapper.style.display = 'block';
            let level = Math.round(battery.level * 100);
            batteryLevel.innerText = level + '%';
            batteryIcon.className = 'fa '; 
            if(level >= 75) { batteryIcon.classList.add('fa-battery-full'); batteryIcon.style.color = 'green'; }
            else if(level >= 50) { batteryIcon.classList.add('fa-battery-three-quarters'); batteryIcon.style.color = '#b16421'; }
            else if(level >= 25) { batteryIcon.classList.add('fa-battery-quarter'); batteryIcon.style.color = 'orange'; }
            else { batteryIcon.classList.add('fa-battery-empty'); batteryIcon.style.color = 'red'; }
            if(battery.charging) { chargingStatus.style.display = 'inline-block'; } else { chargingStatus.style.display = 'none'; }
        }
        updateBattery();
        battery.addEventListener('levelchange', updateBattery);
        battery.addEventListener('chargingchange', updateBattery);
    });
}
</script>