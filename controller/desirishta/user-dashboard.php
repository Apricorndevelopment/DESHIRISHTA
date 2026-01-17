<?php
include 'header.php';
include 'config.php';

$userid = $_COOKIE['dr_userid'];
$state = $_COOKIE['dr_state'];
$gender = $_COOKIE['dr_gender'];

// --- TIMEZONE AND DATE VARIABLES ---
date_default_timezone_set('Asia/Kolkata');
$current_time = date('Y-m-d H:i:s');
$current_date = date('Y-m-d');

if ($userid == '') {
    header('location:login.php');
    exit;
}

// Fetch Basic Info
$sqlbasicinfo = "select * from basic_info where userid = '$userid'";
$resultbasicinfo = mysqli_query($con, $sqlbasicinfo);
$rowbasicinfo = mysqli_fetch_assoc($resultbasicinfo);

// --- FETCH USER DATA FOR POPUP & GREETING ---
$my_name = "User"; // Default
$show_first_login_popup = false;

// UPDATED QUERY: Added 'plan_id' to fetch subscription info
// $sql_user_data = "SELECT name, first_login, contact_privacy, entrydate, plan_id, verificationinfo, verification_popup, profilestatus, profilestatus_popup, otpstatus, delete_status, email, phone FROM registration WHERE userid = '$userid'";
$sql_user_data = "SELECT name, first_login, contact_privacy, entrydate, plan_id, verificationinfo, verification_popup, profilestatus, profilestatus_popup, otpstatus, delete_status, email, phone, emailverify FROM registration WHERE userid = '$userid'";
$result_user_data = mysqli_query($con, $sql_user_data);

// Initialize Dynamic Plan Variables (Default to Free/Fallback)
$current_plan_name = "Free";
$current_daily_limit = 5; 

if ($result_user_data && mysqli_num_rows($result_user_data) > 0) {
    $row_user_data = mysqli_fetch_assoc($result_user_data);

    // --- 1. GET DYNAMIC PLAN DETAILS ---
    $my_plan_id = $row_user_data['plan_id'];
    // Fetch plan details from tbl_plans based on ID
    $sql_plan_fetch = "SELECT plan_name, contacts_per_day FROM tbl_plans WHERE id = '$my_plan_id'";
    $res_plan_fetch = mysqli_query($con, $sql_plan_fetch);
    if($res_plan_fetch && mysqli_num_rows($res_plan_fetch) > 0){
        $row_plan_fetch = mysqli_fetch_assoc($res_plan_fetch);
        $current_plan_name = $row_plan_fetch['plan_name'];
        $current_daily_limit = $row_plan_fetch['contacts_per_day'];
    }

    // Variables for logic
    $id_verification = $row_user_data['verificationinfo'];
    $id_verification_popup = $row_user_data['verification_popup'];
    $id_profilestatus = $row_user_data['profilestatus'];
    $id_profilestatus_popup = $row_user_data['profilestatus_popup'];

    // Get Name
    if (!empty($row_user_data['name'])) {
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
    if ($days_old <= 15 && $privacy_setting == 'Show to All') {
        $show_first_login_popup = true;
    }
}

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
// ================= SHARE COUNTS =================
$sql_share = "
    SELECT 
        IFNULL(SUM(whatsapp_count),0) AS whatsapp_total,
        IFNULL(SUM(other_count),0) AS other_total
    FROM user_share_counts
    WHERE userid = '$userid'
";
$res_share = mysqli_query($con, $sql_share);
$row_share = mysqli_fetch_assoc($res_share);

$whatsapp_shares = $row_share['whatsapp_total'] ?? 0;
$other_shares = $row_share['other_total'] ?? 0;

// B. System Status Alerts 

// Case 1: Profile Not Screened
if (isset($id_profilestatus) && $id_profilestatus == '0' && $id_profilestatus_popup == '0') {
    $popup_queue[] = [
        'id' => 'status_1',
        'type' => 'status',
        'subject' => 'Welcome To Desi Rishta',
        'media_file' => 'images/gif/notscreened.gif',
        'body_content' => 'Your profile is under screening will be made live shortly',
        'is_local_img' => true,
        'btn_link' => '',
        'btn_text' => 'Ok'
    ];
}

// Case 2: Screening Complete
if (isset($id_profilestatus) && $id_profilestatus == '1' && $id_profilestatus_popup == '0') {
    $popup_queue[] = [
        'id' => 'status_2',
        'type' => 'status',
        'subject' => 'Welcome To Desi Rishta',
        'media_file' => 'images/gif/screeningcompleted.gif',
        'body_content' => "Your profile screening is complete. It's now live!",
        'is_local_img' => true,
        'btn_link' => '',
        'btn_text' => 'ok'
    ];
}

// Case 3: Verification Pending
if (isset($id_verification) && $id_verification != 'Done' && $id_verification_popup == '0') {
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
}

// Case 4: Verification Done
if (isset($id_verification) && $id_verification == 'Done' && $id_verification_popup == '0') {
    $popup_queue[] = [
        'id' => 'status_4',
        'type' => 'status',
        'subject' => 'Welcome To Desi Rishta',
        'media_file' => 'images/gif/verifiedidentity.gif',
        'body_content' => "Congratulations! You've Earned Your Trust Badge",
        'is_local_img' => true,
        'btn_link' => '',
        'btn_text' => 'okey'
    ];
}

// C. Birthday Check
$sql_dob_check = "SELECT dob FROM astro_info WHERE userid = '$userid'";
$result_dob_check = mysqli_query($con, $sql_dob_check);
if ($result_dob_check && mysqli_num_rows($result_dob_check) > 0) {
    $row_dob = mysqli_fetch_assoc($result_dob_check);
    if (!empty($row_dob['dob']) && $row_dob['dob'] != '0000-00-00') {
        $user_dob_md = date('m-d', strtotime($row_dob['dob']));
        $today_md = date('m-d');

        if ($user_dob_md == $today_md) {
            $popup_queue[] = [
                'id' => 'birthday_' . date('Y'),
                'type' => 'status',
                'subject' => 'Happy Birthday, ' . $my_name . '! 🎂',
                'media_file' => 'images/gif/birthday1.gif',
                'body_content' => 'Wishing you a wonderful birthday filled with love and joy from the Desi Rishta Team! 🎉',
                'is_local_img' => true,
                'btn_link' => '',
                'btn_text' => 'Thank You'
            ];
        }
    }
}

$json_popup_queue = json_encode($popup_queue);
?>

<style>
    /* Popup Styles */
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

    /* Welcome Modal Styles */
    .welcome-modal {
        display: none;
        position: fixed;
        z-index: 999999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.85);
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(6px);
    }

    .welcome-modal-content {
        background: #fff;
        width: 95%;
        max-width: 650px;
        border-radius: 14px;
        overflow: hidden;
        animation: slideDown 0.4s ease-out;
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.45);
    }

    .welcome-ribbon {
        background: linear-gradient(135deg, #5c2c28, #3d1a17);
        color: #eac26a;
        padding: 15px 20px;
        text-align: center;
        font-size: 20px;
        font-weight: 800;
        letter-spacing: 1px;
    }

    .welcome-body {
        padding: 20px;
    }

    .guideline-box {
        border: 1px solid #e6d9c4;
        background: #fbf6ef;
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 15px;
    }

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

    .status-row {
        display: flex;
        justify-content: space-between;
        padding: 4px 0;
        border-bottom: 1px dashed #ddd;
        font-size: 13px;
    }

    .status-active {
        color: #28a745;
        font-weight: 700;
    }

    .status-inactive {
        color: #d9534f;
        font-weight: 700;
    }

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
@media (max-width: 991px) {
    .material-symbols-outlined {
        vertical-align: middle;
        color: #000000ff !important;
    }
}
    .btn-popup-primary:hover {
        background: #8d6231;
        border-color: #8d6231;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-40px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Slider Arrow CSS */
    .couple-sli .slick-prev,
    .couple-sli .slick-next {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 2;
        background: #f6af04;
        color: white;
        border: none;
        height: 45px;
        width: 45px;
        font-size: 0px;
        border-radius: 50%;
        cursor: pointer;
        transition: all 0.3s ease;
    }
</style>

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

<?php if ($show_first_login_popup) { ?>
    <div id="firstLoginModal" class="welcome-modal" style="display: flex;">
        <div class="welcome-modal-content">
            <div class="welcome-ribbon">WELCOME TO DESI RISHTA “<?php echo strtoupper($my_name); ?>”</div>
            <div class="welcome-body">
                <p class="text-center mb-3" style="font-size:15px; color:#333;"><b>Guidelines for Viewing Contacts and Sending Interest</b></p>
                <div class="guideline-box">
                    <div class="guideline-title"><i class="bi bi-eye-fill"></i> 1. When Contact Privacy = Show to All (Default)</div>
                    <ul>
                        <li>Contacts are always visible (no request needed).</li>
                    </ul>
                    <div class="status-row"><span><i class="bi bi-telephone-fill"></i> Contact View</span><span class="status-active"><i class="bi bi-check-circle-fill"></i> Active</span></div>
                    <div class="status-row" style="border:none;"><span><i class="bi bi-heart"></i> Send Interest</span><span class="status-inactive"><i class="bi bi-x-circle-fill"></i> Inactive</span></div>
                </div>
                <div class="guideline-box">
                    <div class="guideline-title"><i class="bi bi-eye-slash-fill"></i> 2. When Contact Privacy = Hide from All</div>
                    <ul>
                        <li>Contacts are hidden (request required).</li>
                        <li>Once the other member accepts your interest, their contact becomes visible.</li>
                    </ul>
                    <div class="status-row"><span><i class="bi bi-heart-fill"></i> Send Interest</span><span class="status-active"><i class="bi bi-check-circle-fill"></i> Active</span></div>
                    <div class="status-row"><span><i class="bi bi-telephone-x-fill"></i> Contact View</span><span class="status-inactive"><i class="bi bi-x-circle-fill"></i> Inactive</span></div>
                </div>
                <p class="text-center text-muted small mt-2">Your current privacy setting is <b>Show to All</b>. Choose your preference:</p>
            </div>
            <div class="modal-actions">
                <button class="btn-popup-outline" onclick="closePrivacyModal()">Keep "Show to All"</button>
                <button class="btn-popup-primary" onclick="updatePrivacy('hide')">Change to "Hide from All"</button>
            </div>
        </div>
    </div>
<?php } ?>

<section>
    <div class="db">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-lg-3">
                    <?php include 'user-sidebar.php'; ?>
                </div>
                <div class="col-md-8 col-lg-9">
                    <div class="row">
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
                                    <div id="weather-wrapper" class="weather-section" style="display:none;">
                                        <h2 style="margin: 0; font-weight: 700; color: #333; font-size: 28px; line-height: 1;">
                                            <i id="weather-icon" class="fa fa-sun-o" aria-hidden="true" style="color:#f39c12;"></i>
                                            <span id="weather-temp">--°C</span>
                                        </h2>
                                        <div id="weather-loc" style="margin-top: 5px; color: #666; font-weight: 600; font-size: 12px; text-transform: uppercase;">Loading Location...</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <style>
                            .stat-main-text {
                                margin: 0;
                                color: #b16421;
                                font-weight: 800;
                                font-size: 36px;
                                line-height: 1;
                            }
                        </style>
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
                                                        $resultallprofile = mysqli_query($con, $sqlallprofile);
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
                                                        $resultnewmatches = mysqli_query($con, $sqlnewmatches);
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
                                                        <?php
                                                        // My Matches = Active Profiles of Opposite Gender
                                                        $sqlmymatches = "SELECT * FROM registration WHERE userid != '$userid' AND gender != '$gender' AND delete_status != 'delete' AND profilestatus = '1'";
                                                        $resmymatches = mysqli_query($con, $sqlmymatches);
                                                        $countmymatches = mysqli_num_rows($resmymatches);
                                                        ?>
                                                        <h5><?php echo $countmymatches; ?></h5>
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
                                                        $resultnearby = mysqli_query($con, $sqlnearby);
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
                                                        // visit = profile I visited, view = me
                                                        $sqlviewed = "select DISTINCT(visit) from viewvist_ids where view = '$userid' and visit != '' and delete_status != 'delete'";
                                                        $resultviewed = mysqli_query($con, $sqlviewed);
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
                                                    <div class="db-int-pro-1"> <img src="images/gif/like.gif" alt="Block"> </div>
                                                    <div class="db-int-pro-2">
                                                        <?php
                                                        // view = who viewed me, visit = me
                                                        $sqlvisited = "select DISTINCT(view) from viewvist_ids where visit = '$userid' and view != '' and delete_status != 'delete'";
                                                        $resultvisited = mysqli_query($con, $sqlvisited);
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
                                                        $resultshortlisted = mysqli_query($con, $sqlshortlisted);
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
                                                    <div class="db-int-pro-1"> <img src="images/gif/block.gif" alt="Block"> </div>
                                                    <div class="db-int-pro-2">
                                                        <?php
                                                        $sqlblocked = "select * from block_ids where by_whom = '$userid'";
                                                        $resultblocked = mysqli_query($con, $sqlblocked);
                                                        $countblocked = mysqli_num_rows($resultblocked);
                                                        ?>
                                                        <h5><?php echo $countblocked; ?></h5>
                                                        <span><b>Blocked Members</b></span>
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
                                                    <div class="db-int-pro-1"> <img src="images/gif/megaphone.gif" alt="Report"> </div>
                                                    <div class="db-int-pro-2">
                                                        <?php
                                                        $sqlreport = "select * from report_ids where by_who = '$userid'";
                                                        $resultreport = mysqli_query($con, $sqlreport);
                                                        $countreport = mysqli_num_rows($resultreport);
                                                        ?>
                                                        <h5><?php echo $countreport; ?></h5>
                                                        <span><b>Reported Members</b></span>
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
                                                        // Count times MY ID appeared in 'viewed_id' column
                                                        $sqlcontact = "SELECT count(*) as cnt FROM contact_view_logs WHERE viewed_id = '$userid'";
                                                        $resultcontact = mysqli_query($con, $sqlcontact);
                                                        $rowcontact = mysqli_fetch_assoc($resultcontact);
                                                        ?>
                                                        <h5><?php echo $rowcontact['cnt']; ?></h5>
                                                        <span style="color:red;"><b>My Contact Views</b></span>
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
                                                    <div class="db-int-pro-1"> <img src="images/gif/contact.gif" alt=""> </div>
                                                    <div class="db-int-pro-2">
                                                        <?php
                                                        // Count times MY ID appeared in 'viewer_id' column
                                                        $sqlmemview = "SELECT count(*) as cnt FROM contact_view_logs WHERE viewer_id = '$userid'";
                                                        $resmemview = mysqli_query($con, $sqlmemview);
                                                        $rowmemview = mysqli_fetch_assoc($resmemview);
                                                        ?>
                                                        <h5><?php echo $rowmemview['cnt']; ?></h5>
                                                        <span><b>Members Contact Views</b></span>
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
                                                    <div class="db-int-pro-1"> <img src="images/gif/contact.gif" alt=""> </div>
                                                    <div class="db-int-pro-2">
                                                        <?php
                                                        // UPDATED LOGIC: Using Dynamic variables from Top
                                                        $today_dash = date('Y-m-d');
                                                        $sql_usage_dash = "SELECT COUNT(*) as cnt FROM contact_view_logs WHERE viewer_id='$userid' AND view_date='$today_dash'";
                                                        $res_usage_dash = mysqli_query($con, $sql_usage_dash);
                                                        $row_usage_dash = mysqli_fetch_assoc($res_usage_dash);
                                                        
                                                        $used_dash = $row_usage_dash['cnt'];
                                                        $left_dash = $current_daily_limit - $used_dash; // Uses dynamic limit
                                                        if ($left_dash < 0) $left_dash = 0;
                                                        ?>
                                                        <h5><?php echo $left_dash; ?> / <?php echo $current_daily_limit; ?></h5>
                                                        <span><b>Contact Views Left</b></span>
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
                                                        <?php

                                                        // No table created for this yet, keeping 0 safe
                                                        ?>
                                                        <h5><?php echo $whatsapp_shares; ?></h5>
                                                        <span><b>Whatsapp Shares</b></span>
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
                                                    <div class="db-int-pro-1"> <img src="images/gif/more.gif" alt=""> </div>
                                                    <div class="db-int-pro-2">
                                                        <h5><?php echo $other_shares; ?></h5>
                                                        <span><b>Others Sharing</b></span>
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
                                                    <div class="db-int-pro-1"> <img src="images/gif/login.gif" alt=""> </div>
                                                    <div class="db-int-pro-2">
                                                        <?php
                                                        $sqllogins = "SELECT count(*) as cnt FROM user_logs WHERE userid='$userid'";
                                                        $reslogins = mysqli_query($con, $sqllogins);
                                                        $rowlogins = mysqli_fetch_assoc($reslogins);
                                                        ?>
                                                        <h5><?php echo $rowlogins['cnt']; ?></h5>
                                                        <span><b>Number of Logins</b></span>
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
                                                    <div class="db-int-pro-1"> <img src="images/gif/search.gif" alt=""> </div>
                                                    <div class="db-int-pro-2">
                                                        <?php
                                                        $sqlsearches = "SELECT count(*) as cnt FROM user_search_logs WHERE userid='$userid'";
                                                        $ressearches = mysqli_query($con, $sqlsearches);
                                                        $rowsearches = mysqli_fetch_assoc($ressearches);
                                                        ?>
                                                        <h5><?php echo $rowsearches['cnt']; ?></h5>
                                                        <span><b>Searches</b></span>
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
                                                    <div class="db-int-pro-1"> <img src="images/gif/comments.gif" alt=""> </div>
                                                    <div class="db-int-pro-2">
                                                        <?php
                                                        $sqledits = "SELECT count(*) as cnt FROM user_edit_logs WHERE userid='$userid'";
                                                        $resedits = mysqli_query($con, $sqledits);
                                                        $rowedits = mysqli_fetch_assoc($resedits);
                                                        ?>
                                                        <h5><?php echo $rowedits['cnt']; ?></h5>
                                                        <span><b>No. Of Edits</b></span>
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
                                                    <div class="db-int-pro-1"> <img src="images/gif/picture.gif" alt=""> </div>
                                                    <div class="db-int-pro-2">
                                                        <?php
                                                        $sqlphotos = "SELECT * FROM photos_info WHERE userid='$userid'";
                                                        $resphotos = mysqli_query($con, $sqlphotos);
                                                        $rowphotos = mysqli_fetch_assoc($resphotos);
                                                        $photo_count = 0;
                                                        if (!empty($rowphotos['profilepic'])) $photo_count++;
                                                        if (!empty($rowphotos['photo1'])) $photo_count++;
                                                        if (!empty($rowphotos['photo2'])) $photo_count++;
                                                        if (!empty($rowphotos['photo3'])) $photo_count++;
                                                        if (isset($rowphotos['photo4']) && !empty($rowphotos['photo4'])) $photo_count++;
                                                        if (isset($rowphotos['photo5']) && !empty($rowphotos['photo5'])) $photo_count++;
                                                        ?>
                                                        <h5><?php echo $photo_count; ?></h5>
                                                        <span><b>Photos Uploaded</b></span>
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
                                                    <div class="db-int-pro-1"> <img src="images/gif/user.gif" alt=""> </div>
                                                    <div class="db-int-pro-2">
                                                        <?php
                                                        $status_txt = "Inactive";
                                                        $status_color = "text-danger";
                                                        if ($row_user_data['otpstatus'] == 'active' && $row_user_data['delete_status'] != 'delete') {
                                                            $status_txt = "Active";
                                                            $status_color = "text-success";
                                                        }
                                                        ?>
                                                        <h5 class="<?php echo $status_color; ?>"><?php echo $status_txt; ?></h5>
                                                        <span><b>Account Status</b></span>
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
                    <div class="db-int-pro-1"> <img src="images/gif/badge.gif" alt=""> </div>
                    <div class="db-int-pro-2">
                        <?php
                        // Logic: Check Verification Info
                        $ver_info = $row_user_data['verificationinfo'];
                        
                        if ($ver_info == '1') {
                            $t_status = "Verified";
                            $t_class = "text-success";
                            $t_icon = '<i class="fa fa-check-circle"></i>';
                        } elseif (!empty($ver_info)) {
                            $t_status = "Pending";
                            $t_class = "text-warning";
                            $t_icon = '<i class="fa fa-clock-o"></i>';
                        } else {
                            $t_status = "Not Applied";
                            $t_class = "text-danger";
                            $t_icon = '<i class="fa fa-times-circle"></i>';
                        }
                        ?>
                        <h5 class="<?php echo $t_class; ?>"><?php echo $t_status; ?> <?php echo $t_icon; ?></h5>
                        <span><b>Trust Badge</b></span>
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
                    <div class="db-int-pro-1"> <img src="images/gif/comments.gif" alt=""> </div>
                    <div class="db-int-pro-2">
                        <?php
                        // Logic: Check Phone (otpstatus) & Email (verify_email)
                        $phone_ok = ($row_user_data['otpstatus'] == 'active' || $row_user_data['otpstatus'] == 'Done');
                        $email_ok = ($row_user_data['emailverify'] == '1' || $row_user_data['emailverify'] == 'Done'); // Check DB value

                        if ($phone_ok && $email_ok) {
                            $pe_text = "Verified";
                            $pe_class = "text-success";
                            $pe_icon = '<i class="fa fa-check-circle"></i>';
                        } elseif ($phone_ok || $email_ok) {
                            $pe_text = "Partially Verified";
                            $pe_class = "text-warning";
                            $pe_icon = '<i class="fa fa-exclamation-circle"></i>';
                        } else {
                            $pe_text = "Unverified";
                            $pe_class = "text-danger";
                            $pe_icon = '<i class="fa fa-times-circle"></i>';
                        }
                        ?>
                        <h5 class="<?php echo $pe_class; ?>"><?php echo $pe_text; ?> <?php echo $pe_icon; ?></h5>
                        <span><b>Phone & Email</b></span>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- 
                                <div class="col-lg-12 col-xl-4 mb-3">
                                    <div class="db-pro-stat p-3 pt-1 pb-1">
                                        <div class="db-inte-prof-list db-inte-prof-chat">
                                            <ul>
                                                <li>
                                                    <div class="db-int-pro-1"> <img src="images/gif/badge.gif" alt=""> </div>
                                                    <div class="db-int-pro-2">
                                                        <?php
                                                        $trust_status = ($id_verification == 'Done') ? "Verified" : "Pending";
                                                        $trust_color = ($id_verification == 'Done') ? "text-success" : "text-warning";
                                                        ?>
                                                        <h5 class="<?php echo $trust_color; ?>"><?php echo $trust_status; ?></h5>
                                                        <span><b>Trust Badge</b></span>
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
                                                    <div class="db-int-pro-1"> <img src="images/gif/comments.gif" alt=""> </div>
                                                    <div class="db-int-pro-2">
                                                        <h5 class="text-success">Verified <i class="fa fa-check-circle"></i></h5>
                                                        <span><b>Phone & Email</b></span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div> -->

                            </div>

                            <div class="row mt-4">
                                <div class="col-md-12 col-lg-6 col-xl-4 db-sec-com">
                                    <h2 class="db-tit">Profiles Completion </h2>
                                    <div class="db-pro-stat h-85">
                                        <h6></h6>
                                        <div class="db-pro-pgog">
                                            <?php
                                            $sqlprofilecomplete = "select * from registration where userid='$userid'";
                                            $resultprofilecomplete = mysqli_query($con, $sqlprofilecomplete);
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
                                            <li class="roundicon <?php if ($resultprofilecomplete['basicinfo'] == 'Done') {
                                                                        echo "bg-success";
                                                                    } else {
                                                                        echo "bg-danger";
                                                                    } ?>"><span class="material-symbols-outlined">contacts</span></li>
                                            <li class="roundicon <?php if ($resultprofilecomplete['aboutme'] == 'Done') {
                                                                        echo "bg-success";
                                                                    } else {
                                                                        echo "bg-danger";
                                                                    } ?>"><span class="material-symbols-outlined">person</span></li>
                                            <li class="roundicon <?php if ($resultprofilecomplete['astroinfo'] == 'Done') {
                                                                        echo "bg-success";
                                                                    } else {
                                                                        echo "bg-danger";
                                                                    } ?>"><span class="material-symbols-outlined">brightness_auto</span></li>
                                            <li class="roundicon <?php if ($resultprofilecomplete['religiousinfo'] == 'Done') {
                                                                        echo "bg-success";
                                                                    } else {
                                                                        echo "bg-danger";
                                                                    } ?>"><span class="material-symbols-outlined">temple_hindu</span></li>
                                            <li class="roundicon <?php if ($resultprofilecomplete['educationinfo'] == 'Done') {
                                                                        echo "bg-success";
                                                                    } else {
                                                                        echo "bg-danger";
                                                                    } ?>"><span class="material-symbols-outlined">school</span></li>
                                            <li class="roundicon <?php if ($resultprofilecomplete['familyinfo'] == 'Done') {
                                                                        echo "bg-success";
                                                                    } else {
                                                                        echo "bg-danger";
                                                                    } ?>"><span class="material-symbols-outlined">family_restroom</span></li>
                                            <li class="roundicon <?php if ($resultprofilecomplete['hobbiesinfo'] == 'Done') {
                                                                        echo "bg-success";
                                                                    } else {
                                                                        echo "bg-danger";
                                                                    } ?>"><span class="material-symbols-outlined">interests</span></li>
                                            <li class="roundicon <?php if ($resultprofilecomplete['partnerinfo'] == 'Done') {
                                                                        echo "bg-success";
                                                                    } else {
                                                                        echo "bg-danger";
                                                                    } ?>"><span class="material-symbols-outlined">diversity_2</span></li>
                                            <li class="roundicon <?php if ($resultprofilecomplete['contactinfo'] == 'Done') {
                                                                        echo "bg-success";
                                                                    } else {
                                                                        echo "bg-danger";
                                                                    } ?>"><span class="material-symbols-outlined">call</span></li>
                                            <li class="roundicon <?php if ($resultprofilecomplete['photosinfo'] == 'Done') {
                                                                        echo "bg-success";
                                                                    } else {
                                                                        echo "bg-danger";
                                                                    } ?>"><span class="material-symbols-outlined">photo_camera</span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6 col-xl-4 db-sec-com">
                                    <h2 class="db-tit">Plan </h2>
                                    <div class="db-pro-stat h-85">
                                        <h6 class="tit-top-curv"></h6>
                                        <div class="db-plan-card">
                                            <img src="images/gif/unlimted.gif" alt="">
                                        </div>
                                        <div class="db-plan-detil mt-3">
                                            <?php
                                            // Get Usage Today
                                            $sql_usage = "SELECT COUNT(*) as cnt FROM contact_view_logs WHERE viewer_id='$userid' AND view_date='$current_date'";
                                            $res_usage = mysqli_query($con, $sql_usage);
                                            $row_usage = mysqli_fetch_assoc($res_usage);
                                            $used = $row_usage['cnt'];
                                            ?>
                                            <ul>
                                                <li>Current Plan: <strong><?php echo $current_plan_name; ?></strong></li>
                                                <li>Daily Limit: <strong><?php echo $current_daily_limit; ?> Contacts</strong></li>
                                                <li>Views Used Today: <strong style="color: #b16421; font-size:16px;"><?php echo $used; ?> / <?php echo $current_daily_limit; ?></strong></li>
                                                <li><a href="user-plan.php" class="cta-3">Upgrade Plan</a></li>
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
                                            $resultvisitors = mysqli_query($con, $sqlvisitors);
                                            $countvisitors = mysqli_num_rows($resultvisitors);
                                            if ($countvisitors == 0) {
                                            ?>
                                                <img src="userphoto/recent-visitors.gif" alt="" style="width:100%">
                                                <p class="text-center"><b>No Visitors Yet</b></p>
                                            <?php
                                            } else {
                                            ?>
                                                <ul class="slider11">
                                                    <?php
                                                    while ($rowvisitors = mysqli_fetch_assoc($resultvisitors)) {
                                                        $pro_id = $rowvisitors['view'];
                                                        $sqlphoto = "select * from photos_info where userid = '$pro_id'";
                                                        $resultphoto = mysqli_query($con, $sqlphoto);
                                                        $rowphoto = mysqli_fetch_assoc($resultphoto);

                                                        $sqlbasic = "select * from basic_info where userid = '$pro_id'";
                                                        $resultbasic = mysqli_query($con, $sqlbasic);
                                                        $rowbasic = mysqli_fetch_assoc($resultbasic);

                                                        $sqllocation = "select * from groom_location where userid = '$pro_id'";
                                                        $resultlocation = mysqli_query($con, $sqllocation);
                                                        $rowlocation = mysqli_fetch_assoc($resultlocation);
                                                    ?>
                                                        <li>
                                                            <div class="db-int-pro-1"> <img src="userphoto/<?php echo $rowphoto['profilepic'] ?>" alt=""> </div>
                                                            <div class="db-int-pro-2">
                                                                <h5><?php echo $rowbasic['fullname']; ?></h5>
                                                                <span><?php echo $rowlocation['city'] . ', ' . $rowlocation['country'] ?></span>
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
                                    $resultprofile = mysqli_query($con, $sqlprofile);
                                    while ($rowprofile = mysqli_fetch_assoc($resultprofile)) {
                                        $profileid = $rowprofile['userid'];

                                        $sqlbasicinfo = "select * from basic_info where userid = '$profileid'";
                                        $resultbasicinfo = mysqli_query($con, $sqlbasicinfo);
                                        $rowbasicinfo = mysqli_fetch_assoc($resultbasicinfo);

                                        $sqlphotoinfo = "select * from photos_info where userid = '$profileid'";
                                        $resultphotoinfo = mysqli_query($con, $sqlphotoinfo);
                                        $rowphotoinfo = mysqli_fetch_assoc($resultphotoinfo);

                                        $sqllocationinfo = "select * from groom_location where userid = '$profileid'";
                                        $resultlocationinfo = mysqli_query($con, $sqllocationinfo);
                                        $rowlocationinfo = mysqli_fetch_assoc($resultlocationinfo);
                                    ?>
                                        <li>
                                            <div class="db-new-pro">
                                                <img src="userphoto/<?php echo $rowphotoinfo['profilepic'] ?>" alt="" class="profile">
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
    </div>
</section>

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
// --- 1. UTILITY FUNCTIONS (Cookies & Modals) ---
function getCookie(name) {
    let match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
    if (match) return match[2];
}

function closeReconnect() {
    document.getElementById('reconnectModal').style.display = 'none';
    document.cookie = "show_reconnect_popup=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
}

function closePrivacyModal() {
    document.getElementById('firstLoginModal').style.display = 'none';
    // Privacy modal band hone ke baad check karein agar koi aur popup queue mein hai
    if (typeof triggerPopups === 'function') triggerPopups();
}

function updatePrivacy(type) {
    var action = (type === 'hide') ? 'set_privacy_hide' : 'set_privacy_show';
    $.post('ajax-update-privacy.php', { action: action }, function(response) {
        if (response.trim() == 'success') {
            document.getElementById('firstLoginModal').style.display = 'none';
            if (type === 'hide') {
                // Success modal/alert ki jagah direct reload taaki settings apply ho jayein
                location.reload();
            } else {
                if (typeof triggerPopups === 'function') triggerPopups();
            }
        }
    });
}

// --- 2. MAIN EXECUTION BLOCK ---
$(document).ready(function() {
    
    // A. POPUP QUEUE SYSTEM
    var popupQueue = <?php echo !empty($json_popup_queue) ? $json_popup_queue : '[]'; ?>;
    var currentPopup = null;

    // Filter out already shown birthdays (Local Storage check)
    popupQueue = popupQueue.filter(function(p) {
        if (p.id && p.id.toString().includes("birthday_")) {
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

        if (currentPopup.media_file) {
            var imgSrc = currentPopup.is_local_img ? currentPopup.media_file : 'uploads/' + currentPopup.media_file;
            $('#pop-img').attr('src', imgSrc);
            $('#pop-img-container').show();
        } else {
            $('#pop-img-container').hide();
        }

        if (currentPopup.btn_text) {
            $('#pop-btn').text(currentPopup.btn_text).attr('href', currentPopup.btn_link || '#').show();
        } else {
            $('#pop-btn').hide();
        }
        $('.menu-pop1, .pop-bg').addClass('act');
    }

    // Centralized function to close and decide next step
    function handlePopupClosure(url) {
        $('.menu-pop1, .pop-bg').removeClass('act');
        if (url && url !== '#' && url !== '') {
            window.location.href = url;
        } else {
            setTimeout(showNextPopup, 500);
        }
    }

    // GLOBAL CLICK HANDLER (For Ok/Close buttons)
    $('#close-popup-btn, #pop-btn').off('click').on('click', function(e) {
        e.preventDefault(); 
        var targetUrl = $(this).attr('href');

        if (!currentPopup) {
            handlePopupClosure(targetUrl);
            return;
        }

        // 1. Birthday mark as done
        if (currentPopup.id.toString().includes("birthday_")) {
            localStorage.setItem(currentPopup.id, "done");
        }

        // 2. AJAX Database Update (Status Popups)
        if (currentPopup.type === 'status') {
            $.post('aj-update-popup-status.php', {
                popup_type: currentPopup.id, 
                user_id: '<?php echo $userid; ?>'
            }, function() {
                handlePopupClosure(targetUrl);
            });
        } 
        // 3. Banner Logs
        else if (currentPopup.type === 'banner') {
            $.post('aj-log-banner-view.php', { banner_ids: currentPopup.id }, function() {
                handlePopupClosure(targetUrl);
            });
        } 
        else {
            handlePopupClosure(targetUrl);
        }
    });

    // Start Popups logic
    window.triggerPopups = function() {
        if (popupQueue.length > 0) setTimeout(showNextPopup, 1000);
    }

    // Priority Check: First Login Modal -> triggerPopups
    if ($('#firstLoginModal').length > 0 && $('#firstLoginModal').css('display') !== 'none') {
        // Wait for user to close privacy modal
    } else {
        triggerPopups();
    }

    // B. RECONNECT MODAL (Cookie based)
    if (getCookie('show_reconnect_popup') === 'yes') {
        document.getElementById('reconnectModal').style.display = 'flex';
    }

    // C. CLOCK & GREETING
    function updateClockAndGreeting() {
        const now = new Date();
        // Clock
        let timeStr = now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true });
        let dateStr = now.toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'short', day: 'numeric' });
        $('#live-clock').text(timeStr);
        $('#live-date').text(dateStr);

        // Greeting
        const hour = now.getHours();
        const name = "<?php echo $my_name; ?>";
        let greet = "Good Night", emoji = "🌙";
        if (hour >= 5 && hour < 12) { greet = "Good Morning"; emoji = "☕"; }
        else if (hour >= 12 && hour < 17) { greet = "Good Afternoon"; emoji = "☀️"; }
        else if (hour >= 17 && hour < 21) { greet = "Good Evening"; emoji = "🌆"; }
        
        $('#greeting-display').html(`${greet} ${name} ${emoji}`);
    }
    setInterval(updateClockAndGreeting, 1000);
    updateClockAndGreeting();

    // D. WEATHER SCRIPT
    if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(function(pos) {
            const lat = pos.coords.latitude, lon = pos.coords.longitude;
            // Location Name
            $.get(`https://api.bigdatacloud.net/data/reverse-geocode-client?latitude=${lat}&longitude=${lon}&localityLanguage=en`, function(data) {
                $('#weather-loc').text(data.city || data.locality || "Local Weather");
            });
            // Temp & Icon
            $.get(`https://api.open-meteo.com/v1/forecast?latitude=${lat}&longitude=${lon}&current_weather=true`, function(data) {
                const temp = Math.round(data.current_weather.temperature);
                const code = data.current_weather.weathercode;
                $('#weather-temp').text(temp + "°C");
                $('#weather-wrapper').show();
                
                let icon = "fa-sun-o", color = "#f39c12";
                if (code > 3 && code <= 48) { icon = "fa-cloud"; color = "#bdc3c7"; }
                else if (code > 48 && code <= 67) { icon = "fa-tint"; color = "#3498db"; }
                else if (code > 77) { icon = "fa-bolt"; color = "#f1c40f"; }
                $('#weather-icon').attr('class', 'fa ' + icon).css('color', color);
            });
        });
    }
});
</script>