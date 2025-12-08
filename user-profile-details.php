<?php
include 'header.php';
include 'config.php';

date_default_timezone_set('Asia/kolkata'); 

$loginid = $_COOKIE['dr_userid'];
$gender = $_COOKIE['dr_gender'];
$profileid = $_GET['uid'];

if($loginid == '')
{
    header('location:login.php');
    exit;
}

$entrydate = date('Y-m-d');

// 1. Log View Visit
$sqlcheck = "select * from viewvist_ids where view = '$loginid' and visit = '$profileid' and entrydate = '$entrydate'";
$resultcheck = mysqli_query($con,$sqlcheck);
$countcheck = mysqli_num_rows($resultcheck);

if($countcheck == 0)
{
    $sqlviewvisit = "INSERT INTO `viewvist_ids`(`view`, `visit`, `entrydate`) VALUES ('$loginid', '$profileid', '$entrydate')";
    $resultviewvisit = mysqli_query($con,$sqlviewvisit);
}

// 2. Fetch Profile Info
$sqlbasicinfo = "select * from basic_info where userid = '$profileid'";
$resultbasicinfo = mysqli_query($con,$sqlbasicinfo);
$rowbasicinfo = mysqli_fetch_assoc($resultbasicinfo);

$sqlastroinfo = "select * from astro_info where userid = '$profileid'";
$resultastroinfo = mysqli_query($con,$sqlastroinfo);
$rowastroinfo = mysqli_fetch_assoc($resultastroinfo);
                                    
$sqlreligiousinfo = "select * from religious_info where userid = '$profileid'";
$resultreligiousinfo = mysqli_query($con,$sqlreligiousinfo);
$rowreligiousinfo = mysqli_fetch_assoc($resultreligiousinfo);
                                    
$sqleducationinfo = "select * from education_info where userid = '$profileid'";
$resulteducationinfo = mysqli_query($con,$sqleducationinfo);
$roweducationinfo = mysqli_fetch_assoc($resulteducationinfo);
                                    
$sqllocationinfo = "select * from groom_location where userid = '$profileid'";
$resultlocationinfo = mysqli_query($con,$sqllocationinfo);
$rowlocationinfo = mysqli_fetch_assoc($resultlocationinfo);
                                    
$sqlphotoinfo = "select * from photos_info where userid = '$profileid'";
$resultphotoinfo = mysqli_query($con,$sqlphotoinfo);
$rowphotoinfo = mysqli_fetch_assoc($resultphotoinfo);

$sqlcontactinfo = "select * from contact_info where userid = '$profileid'";
$resultcontactinfo = mysqli_query($con,$sqlcontactinfo);
$rowcontactinfo = mysqli_fetch_assoc($resultcontactinfo);

$sqlfamilyinfo = "select * from family_info where userid = '$profileid'";
$resultfamilyinfo = mysqli_query($con,$sqlfamilyinfo);
$rowfamilyinfo = mysqli_fetch_assoc($resultfamilyinfo);

$sqlhobbiesinfo = "select * from hobbies_info where userid = '$profileid'";
$resulthobbiesinfo = mysqli_query($con,$sqlhobbiesinfo);
$rowhobbiesinfo = mysqli_fetch_assoc($resulthobbiesinfo);
                                    
$sqlpartnerinfo = "select * from partner_info where userid = '$profileid'";
$resultpartnerinfo = mysqli_query($con,$sqlpartnerinfo);
$rowpartnerinfo = mysqli_fetch_assoc($resultpartnerinfo);

$sqlregistration = "select * from registration where userid = '$profileid'";
$resultregistration = mysqli_query($con,$sqlregistration);
$rowregistration = mysqli_fetch_assoc($resultregistration);

$sqlcountview = "select * from viewvist_ids where visit = '$profileid'";
$rowcountview = mysqli_query($con,$sqlcountview);
$countview = mysqli_num_rows($rowcountview);





$is_contact_unlocked = false;
$relationship_status = 'none';

$contact_privacy = $rowregistration['contact_privacy'] ?? 'Show to All';
$show_click_to_view_btn = false; 

if($loginid == $profileid) {
    $is_contact_unlocked = true;
}

elseif($contact_privacy == 'Show to All') {
 
    $current_date = date('Y-m-d'); 
    $sql_view_log = "SELECT * FROM contact_view_logs WHERE viewer_id = '$loginid' AND viewed_id = '$profileid'"; 
    
    $res_view_log = mysqli_query($con, $sql_view_log);
    
    if(mysqli_num_rows($res_view_log) > 0) {
        $is_contact_unlocked = true; 
    } else {
        $is_contact_unlocked = false; 
        $show_click_to_view_btn = true; 
    }
}

else {
    $sql_conn = "SELECT * FROM expressinterest 
                WHERE (ei_sender = '$loginid' AND ei_receiver = '$profileid') 
                OR (ei_sender = '$profileid' AND ei_receiver = '$loginid')
                ORDER BY id DESC LIMIT 1";
    $res_conn = mysqli_query($con, $sql_conn);
    
    if(mysqli_num_rows($res_conn) > 0) {
        $row_conn = mysqli_fetch_assoc($res_conn);
        $relationship_status = $row_conn['ei_status'];
        
        // अगर रिक्वेस्ट Accept हो गई है, तभी अनलॉक होगा
        if($relationship_status == 'accept') { 
            $is_contact_unlocked = true; 
        }
    }
}

if($is_contact_unlocked) {
  
    $blur_style = 'filter: none !important;border:none; -webkit-filter: none !important; opacity: 1 !important; pointer-events: auto; background:#fff;';
} else {
  
    $blur_style = 'filter: blur(5px);border:1px solid  !important;padding:2px;  -webkit-filter: blur(5px); pointer-events: none; user-select: none; opacity: 0.6;';
}




// 3. Logic for Contact Privacy
$contact_privacy = isset($rowregistration['contact_privacy']) ? $rowregistration['contact_privacy'] : 'Show to All';

// Check Connection Status (Sender/Receiver agnostic)
$is_connected = false;
$request_status = 'none';

if($loginid == $profileid) {
    // Viewing Own Profile
    $is_connected = true;
    $contact_privacy = 'Show to All'; // Force show for self
} else {
    $sql_conn = "SELECT * FROM expressinterest WHERE (ei_sender = '$loginid' AND ei_receiver = '$profileid') OR (ei_sender = '$profileid' AND ei_receiver = '$loginid')";
    $res_conn = mysqli_query($con, $sql_conn);
    if(mysqli_num_rows($res_conn) > 0) {
        $row_conn = mysqli_fetch_assoc($res_conn);
        $request_status = $row_conn['ei_status'];
        if($request_status == 'accept') {
            $is_connected = true;
        }
    }
}
?>




<!-- CSS FOR CONTACT SECTION -->
<style>

/* Modal Overlay */
.cv-modal-overlay {
    display: none; position: fixed; z-index: 100000; left: 0; top: 0;
    width: 100%; height: 100%; background-color: rgba(0,0,0,0.6);
    align-items: center; justify-content: center;
}
/* Modal Box */
.cv-modal {
    background: #fff; width: 90%; max-width: 400px;
    border-radius: 8px; padding: 25px; text-align: center;
    box-shadow: 0 5px 15px rgba(0,0,0,0.3); position: relative;
}
/* Close Icon */
.cv-close {
    position: absolute; top: 10px; right: 15px; font-size: 20px;
    cursor: pointer; color: #888;
}
.cv-btn {
    padding: 10px 20px; border: none; border-radius: 5px; font-weight: bold; cursor: pointer; margin: 5px;
}
.cv-btn-ok { background: #E91E63; color: white; }
.cv-btn-cancel { background: #ddd; color: #333; }
.cv-btn-grey { background: #ccc; color: #fff; cursor: not-allowed; }

    .contact-grid-box {
        background: #fff;
        border: 1px solid #eee;
        border-radius: 8px;
        padding: 20px;
    }
    .c-row {
        display: flex;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid #f5f5f5;
    }
    .c-row:last-child { border-bottom: none; }
    .c-icon {
        width: 35px;
        height: 35px;
        background: #fff0f0;
        color: #d9534f;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        margin-right: 15px;
    }
    .c-details h6 { margin: 0; font-size: 12px; color: #888; text-transform: uppercase; }
    .c-details p { margin: 0; font-size: 15px; font-weight: 600; color: #333; }
    
    /* Lock Overlay */
 /* Lock Screen Container (your existing div) */
.lockscreen {
    position: absolute;
    top: 50%;
    right: 20px;       /* RIGHT ME FIXED */
    transform: translateY(-50%);
    z-index: 10;
    cursor: pointer;
}


/* Inside content (your flex box with padding-left) */
.lockscreen > div {
    display: flex;
    align-items: center;
    justify-content: center;        
    gap: 12px;

    padding-left: 0 !important;   
}

    .lock-container:hover {
        background: #fff9f9;
        border-color: #d9534f;
    }
    .lock-icon { font-size: 30px; color: #d9534f; margin-bottom: 10px; }
    .lock-title { font-size: 16px; font-weight: 700; color: #333; margin-bottom: 5px; }
    .lock-desc { font-size: 13px; color: #777; }

    
</style>

    <!-- PROFILE -->
    <section>
        <div class="profi-pg profi-ban">
            <div class="">
                <div class="">
                   
                   
<div class="profile" style="background: white;">
                    
              
                    <div class="premium-profile-wrapper">
                        <div class="premium-card">
                            
                            <!-- Profile Picture with Zoom On Click -->
                            <div class="premium-pic-box" onclick="openZoomModal(0)">
                                <?php 
                                    $displayPic = ($rowphotoinfo['profilepic'] != '') ? "userphoto/".$rowphotoinfo['profilepic'] : "images/no-profile-pic.jpg"; 
                                ?>
                                <img src="<?php echo $displayPic; ?>" class="premium-pic" alt="Profile Pic">
                                
                                <!-- Verified Badge -->
                                <?php if($rowregistration['verificationinfo'] == '1') { ?>
                                <div class="verify-badge" title="Verified Profile">
                                    <i class="fa fa-check"></i>
                                </div>
                                <?php } ?>
                            </div>
                        

                            <!-- Name & User ID -->
                            <h2 class="premium-name"><?php echo $rowbasicinfo['fullname']; ?></h2>
                            <p class="premium-id">@<?php echo $rowbasicinfo['userid']; ?></p>

                            <div class="premium-divider"></div>

                            <!-- Share Section -->
                            <div class="share-title">Share Profile</div>
                         
<div class="premium-actions">
    <a href="#!" onclick="shareTo('whatsapp')" class="p-action-btn icon-wa">
        <i class="bi bi-whatsapp"></i>
    </a>

    <a href="#!" onclick="shareTo('facebook')" class="p-action-btn icon-fb">
        <i class="bi bi-facebook"></i>
    </a>

    <a href="#!" onclick="shareTo('instagram')" class="p-action-btn icon-in">
        <i class="bi bi-instagram"></i>
    </a>

    <a href="#!" onclick="shareTo('twitter')" class="p-action-btn icon-in">
        <i class="bi bi-twitter-x"></i>
    </a>
</div>
<script>
function shareTo(platform) {

    // Current Page URL
    let url = window.location.href;

    // Copy to Clipboard
    navigator.clipboard.writeText(url);

    // Social Share Links
    let shareLinks = {
        whatsapp: "https://api.whatsapp.com/send?text=Check this profile: " + url,
        facebook: "https://www.facebook.com/sharer/sharer.php?u=" + url,
        instagram: "https://www.instagram.com/?url=" + url,  // Instagram does not support direct share, opens app
        twitter: "https://twitter.com/intent/tweet?text=Check this profile: " + url
    };

    // Open in new tab
    if (shareLinks[platform]) {
        window.open(shareLinks[platform], "_blank");
    }
}
</script>

                            <!-- Copy Link Section -->
 <div class="copy-link-wrapper">
    <div class="link-display" id="linkText"></div>

    <button class="btn-copy" id="copyBtn" onclick="copyCurrentURL()">
        <i class="fa fa-copy"></i> Copy
    </button>
</div>

<script>
// Set current URL inside the box
document.getElementById("linkText").innerText = window.location.href;

function copyCurrentURL() {
    let url = window.location.href;

    navigator.clipboard.writeText(url);

    let btn = document.getElementById("copyBtn");

    // Change icon + text
    btn.innerHTML = '<i class="fa fa-check"></i> Copied';

    // Revert icon after 2 sec
    setTimeout(() => {
        btn.innerHTML = '<i class="fa fa-copy"></i> Copy';
    }, 2000);
}
</script>



                        </div>
                    </div>
                    <!-- END PREMIUM MODULE -->

                </div>
                
                     <div class="profi-pg profi-bio">
                        <div class="lhs">
                            <div class="pro-pg-intro pr-bio-c">
                                <h1><?php echo $rowbasicinfo['fullname']; ?></h1>
                                <div class="mb-2 brown textcenter"><b><?php echo $rowbasicinfo['userid']; ?></b></div>
                                <div class="pro-info-status">
                                    <?php if($rowregistration['verificationinfo'] == '1') { ?>
                                    <span class="stat-3"><b>ID Verified</b></span>
                                    <?php } ?>
                                    <span class="stat-1"><b><?php echo $countview;?></b> viewers</span>
                                    <?php if($rowregistration['online'] == 'yes') { ?>
                                    <span class="stat-2"><b>Available</b></span>
                                    <?php } elseif($rowregistration['online'] == 'no') { ?>
                                    <span class="stat-4"><b>Unavailable</b></span>
                                    <?php } ?>
                                </div>
                                <ul class="mb-3">
                                    <li><div><img src="images/gif/age.gif" loading="lazy"><span> <strong><?php echo $rowbasicinfo['age'].' Yrs'; ?></strong></span></div></li>
                                    <li><div><img src="images/gif/height.gif" loading="lazy"><span> <strong><?php echo $rowbasicinfo['height']; ?></strong></span></div></li>
                                    <li><div><img src="images/gif/religioncaste.gif" loading="lazy"><span> <strong><?php echo $rowreligiousinfo['religion'].', '.$rowreligiousinfo['caste']; ?></strong></span></div></li>
                                    <li><div><img src="images/gif/graduation-cap.gif" loading="lazy"><span> <strong><?php echo $roweducationinfo['education']; ?></strong></span></div></li>
                                    <li><div><img src="images/gif/career.gif" loading="lazy"><span> <strong><?php echo $roweducationinfo['designation']; ?></strong></span></div></li>
                                    <li><div><img src="images/gif/location.gif" loading="lazy"><span> <strong><?php echo $rowlocationinfo['city'].', '.$rowlocationinfo['state']; ?></strong></span></div></li>
                                </ul>
                            </div>

                            <!-- ABOUT ME -->
                            <div class="pr-bio-c pr-bio-abo" id="contactinfo">
                                <h3><img src="images/profilepage/aboutus.png" style="width:6%"> About <?php echo $rowbasicinfo['fullname']; ?></h3>
                                <p class="text-justify"><?php echo $rowbasicinfo['aboutme']; ?></p>
                            </div>

                     
<?php


    // --- FINAL LOGIC: DEDUCT QUOTA FOR ACCEPTED REQUESTS ALSO ---

    $current_date = date('Y-m-d');

    // 1. GET VIEWER'S PLAN & LIMIT (Logic added here because we need it for PHP check)
    $sql_viewer_plan = "SELECT plan_name FROM registration WHERE userid = '$loginid'";
    $res_viewer_plan = mysqli_query($con, $sql_viewer_plan);
    $row_viewer_plan = mysqli_fetch_assoc($res_viewer_plan);
    $plan_name = $row_viewer_plan['plan_name'] ?? 'Free';

    $daily_limit = 5; // Default Free
    if($plan_name == 'Gold') { $daily_limit = 15; }
    if($plan_name == 'Platinum') { $daily_limit = 25; }

    // 2. CHECK TODAY'S USAGE
    $sql_usage = "SELECT COUNT(*) as used FROM contact_view_logs WHERE viewer_id = '$loginid' AND view_date = '$current_date'";
    $res_usage = mysqli_query($con, $sql_usage);
    $row_usage = mysqli_fetch_assoc($res_usage);
    $used_views = $row_usage['used'];


    // 3. CHECK RELATIONSHIP STATUS
    $relationship_status = 'none';
    $sql_conn = "SELECT * FROM expressinterest 
                 WHERE (ei_sender = '$loginid' AND ei_receiver = '$profileid') 
                 OR (ei_sender = '$profileid' AND ei_receiver = '$loginid')
                 ORDER BY id DESC LIMIT 1";
    $res_conn = mysqli_query($con, $sql_conn);
    if(mysqli_num_rows($res_conn) > 0) {
        $row_conn = mysqli_fetch_assoc($res_conn);
        $relationship_status = $row_conn['ei_status'];
    }


    // 4. MAIN UNLOCK LOGIC
    $is_contact_unlocked = false;

    // Condition A: Viewing Own Profile (Always Free)
    if($loginid == $profileid) {
        $is_contact_unlocked = true;
    }
    else {
        // Check if ALREADY viewed today (Common for both flows)
        // Agar aaj pehle hi dekh liya hai (view log exist karta hai), toh Direct Unlock.
        $sql_already_viewed = "SELECT * FROM contact_view_logs WHERE viewer_id = '$loginid' AND viewed_id = '$profileid' AND view_date = '$current_date'";
        $res_already_viewed = mysqli_query($con, $sql_already_viewed);

        if(mysqli_num_rows($res_already_viewed) > 0) {
            $is_contact_unlocked = true; // Already paid for today
        } 
        else {
            // Not viewed today yet. Now check conditions to deduct quota.
            
            // Condition B: Request Accepted -> AUTO DEDUCT QUOTA
            if($relationship_status == 'accept') {
                if($used_views < $daily_limit) {
                    // Limit bachi hai -> Deduct karo aur dikha do
                    $sql_insert = "INSERT INTO `contact_view_logs`(`viewer_id`, `viewed_id`, `view_date`) VALUES ('$loginid', '$profileid', '$current_date')";
                    mysqli_query($con, $sql_insert);
                    $is_contact_unlocked = true;
                } else {
                    // Limit khatam -> Accepted hai fir bhi mat dikhao (Locked rahega)
                    $is_contact_unlocked = false; 
                }
            }
            
            // Condition C: Show to All (No Request) -> WAIT FOR CLICK
            // Isme hum auto-deduct nahi karenge, user click karega tab AJAX handle karega.
            // Isliye yahan $is_contact_unlocked = false hi rahega.
        }
    }


    // 5. GENERATE CSS STYLE
    if(isset($is_contact_unlocked) && $is_contact_unlocked === true) {
        // UNLOCKED
        $blur_style = 'filter: none !important; border:none !important;-webkit-filter: none !important; opacity: 1 !important; pointer-events: auto; background:#fff;';
    } else {
        // LOCKED (Blur + Lower Opacity)
        $blur_style = 'filter: blur(5px); border:1px solid; -webkit-filter: blur(5px); pointer-events: none; user-select: none; opacity: 0.6;';
    }

    // --- UPDATED LOGIC FOR CONTACT PRIVACY ---
    
    // NOTE: Humne yahan se duplicate logic hata diya hai.
    // $is_contact_unlocked ki value ab file ke top par (Database check) se aa rahi hai.
    // Agar hum yahan dobara check karenge toh "Daily Quota" wala logic overwrite ho jayega.

    // --- CSS STYLE GENERATION ---
    // if(isset($is_contact_unlocked) && $is_contact_unlocked === true) {
    //     // UNLOCKED: Force remove blur and fix opacity
    //     $blur_style = 'filter: none !important; -webkit-filter: none !important; opacity: 1 !important; pointer-events: auto; background:#fff;';
    // } else {
        // LOCKED: Apply blur
    //     $blur_style = 'filter: blur(5px); -webkit-filter: blur(5px); pointer-events: none; user-select: none; opacity: 0.6;';
    // }
    // --- LOGIC END ---
?>
<style>
    
.pr-bio-conta ul li span {
    font-weight: 400;
    position: relative;
    padding-left: 0px;
    display: block;
    display: flex;
    align-items: center;
}
/* MOBILE RESPONSIVE FIX */
@media (max-width: 600px) {
    .premium-pic-box {
        width: 90% !important;
        height: auto !important;
    }
    .premium-pic {
        height: auto !important;
        border-radius: 12px;
    }
}
.zoom-modal {
    z-index: 909999999 !important;
}

.zoom-nav,
.close-zoom .zoom-next .zoom-prev {
    z-index: 10000000 !important;
    pointer-events: auto !important; /* ensure clickable */
}

</style>
    <!-- <div class="pr-bio-c pr-bio-conta" style="position: relative;">
        <h3><img src="images/profilepage/contactinfo.png" style="width:6%"> Contact information</h3>
        
        <div class="conborder" style="position: relative; border: none; background:#fff;">
            
            <ul class="coninfo" style="<?php echo $blur_style; ?>  ">
                
                <li>
                    <span>
                        <i class="fa fa-mobile" aria-hidden="true"></i>
                        <b>Phone</b>
                        <?php 
                        if($is_contact_unlocked) {
                            echo $rowcontactinfo['phonenumber']; 
                            echo '&nbsp;<i class="fa fa-check text-success b-0" aria-hidden="true"></i>';
                        } else {
                            echo '+91 98XXX XXXXX'; 
                        }
                        ?>
                    </span>
                </li>

                <li>
                    <span>
                        <i class="bi bi-envelope" aria-hidden="true"></i>
                        <b>Email</b>
                        <?php 
                        if($is_contact_unlocked) {
                            echo $rowcontactinfo['email']; 
                            if($rowregistration['emailverify'] == '1') { echo '&nbsp;<i class="fa fa-check text-success b-0" aria-hidden="true"></i>'; }
                        } else {
                            echo 'xxxxxxxxx@gmail.com'; 
                        }
                        ?>
                    </span>
                </li>

                <?php if($rowcontactinfo['contactperson'] != '') { ?>
                <li>
                    <span>
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <b>Contact Person</b>
                        <?php 
                        if($is_contact_unlocked) {
                            echo $rowcontactinfo['contactperson'];
                        } else {
                            echo 'Mr. Xxxxx Xxxxx'; 
                        }
                        ?>
                    </span>
                </li>
                <?php } ?>

                <?php if($rowcontactinfo['relationship'] != '') { ?>
                <li>
                    <span>
                        <i class="bi bi-people" aria-hidden="true"></i>
                        <b>Relationship</b>
                        <?php 
                        if($is_contact_unlocked) {
                            echo $rowcontactinfo['relationship'];
                        } else {
                            echo 'Father/Brother'; 
                        }
                        ?>
                    </span>
                </li>
                <?php } ?>

            </ul>
        </div>

        <?php if(!$is_contact_unlocked) { ?>
        <div class="lockscreen" onclick="redirectToRequestPage()" style="position: absolute; top: 50%; left: 73%; transform: translate(-50%, -50%); text-align: center; width: 100%; cursor: pointer; z-index: 10;">
            
          <div style="display:flex; align-items:center; gap:10px;">

            <div style="
                width:55px;
                height:55px;
                border-radius:50%;
                border:2px solid #d5d5d5;
                display:flex;
                align-items:center;
                justify-content:center;
                background:white;
            ">
                <img src="images/gif/lock.gif" style="width:32px;">
            </div>

            <div style="font-size:15px; font-weight:600; color:#555;">
                <span style="color:#E91E63; cursor:pointer;">
                    <?php 
                    if($relationship_status == 'pending') { 
                        echo "Request Pending"; 
                    } else { 
                        echo "Click"; 
                    } 
                    ?>
                </span>

                <?php 
                if($relationship_status == 'pending') { 
                    echo " - Waiting"; 
                } else { 
                    echo " to view contact details"; 
                } 
                ?>
            </div>
        </div>

        </div>
        <?php } ?>

    </div> -->

   <div class="pr-bio-c pr-bio-conta" style="position: relative;">
    <h3><img src="images/profilepage/contactinfo.png" style="width:6%"> Contact information</h3>
    

<div class="conborder" style="position: relative; background:#fff;">
        <ul class="coninfo" id="contact-ul" style="<?php echo $blur_style; ?>">
             <li>
                <span><i class="fa fa-mobile"></i> <b>Phone</b> <?php echo $is_contact_unlocked ? $rowcontactinfo['phonenumber'] : '+91 98XXX XXXXX'; ?></span>
             </li>
             <li>
                <span><i class="bi bi-envelope"></i> <b>Email</b> <?php echo $is_contact_unlocked ? $rowcontactinfo['email'] : 'xxxxx@gmail.com'; ?></span>
             </li>
        </ul>
    </div>

    <?php if(!$is_contact_unlocked) { ?>
    <div class="lockscreen" id="lock-overlay" onclick="handleLockClick()" style="position: absolute; top: 50%; left: 50%;    transform: translate(-27%, -30%); text-align: center; width: 70%; cursor: pointer; z-index: 10;">
        <div style="display:flex; align-items:center; gap:10px; justify-content:center;">
            <div style="width:55px; height:55px; border-radius:50%; border:2px solid #979797ff; display:flex; align-items:center; justify-content:center; background:white;">
                <img src="images/gif/lock.gif" style="width:32px;">
            </div>
            <div style="font-size:15px; font-weight:600; color:#555;">
                <span style="color:#E91E63; cursor:pointer;">
                    <?php 
                    if($show_click_to_view_btn) {
                        echo "Click to View Contact"; 
                    } elseif($relationship_status == 'pending') { 
                        echo "Request Pending"; 
                    } else { 
                        echo "Click to Request"; 
                    } 
                    ?>
                </span>
            </div>
        </div>
    </div>
    <?php } ?>

  
</div>

<div id="modal-confirm" class="cv-modal-overlay">
    <div class="cv-modal">
        <h4>View Contact Details</h4>
        <p id="confirm-msg">You are about to view this contact.</p>
        <div style="margin-top:15px;">
            <button class="cv-btn cv-btn-cancel" onclick="closeModals()">Cancel</button>
            <button class="cv-btn cv-btn-ok" onclick="proceedToView()">OK</button>
        </div>
    </div>
</div>

<div id="modal-limit" class="cv-modal-overlay">
    <div class="cv-modal">
        <span class="cv-close" onclick="closeModals()">&times;</span>
        <h4 style="color:#d9534f;">Limit Reached</h4>
        <p>Daily view limit reached. Please come back tomorrow!</p>
        <div style="margin-top:15px;">
            <button class="cv-btn cv-btn-grey" disabled>OK</button>
        </div>
    </div>
</div>

<script>
var profileId = '<?php echo $profileid; ?>';
var isClickToView = <?php echo $show_click_to_view_btn ? 'true' : 'false'; ?>;
var isRequestMode = <?php echo ($show_click_to_view_btn) ? 'false' : 'true'; ?>;
var requestStatus = '<?php echo $relationship_status; ?>';

function handleLockClick() {
    if(isClickToView) {
        // Show Confirmation Modal
        // First we can fetch remaining count via simple calculation or text
        // Ideally we fetch current remaining count from dashboard logic, but here we can just show generic msg
        // Or make a quick ajax check. For now, static message as per requirement.
        $('#modal-confirm').css('display', 'flex');
    } else {
        // Old "Request" Logic
        if(requestStatus == 'pending') {
            alert("Request Pending...");
        } else {
             window.location.href = "user-incoming-interests.php?tab=allprofiles"; 
        }
    }
}

function proceedToView() {
    // Call AJAX to check quota and unlock
    $.ajax({
        url: 'ajax-contact-view.php',
        type: 'POST',
        data: { viewed_id: profileId },
        dataType: 'json',
        success: function(resp) {
            closeModals();
            if(resp.status == 'success') {
                // Unlock UI
                $('#contact-ul').css({ 'filter': 'none', 'opacity': '1', 'pointer-events': 'auto' });
                $('#lock-overlay').hide();
                // Optionally reload to fetch real phone number if PHP didn't render it hidden
                location.reload(); 
            } else if(resp.status == 'limit_reached') {
                $('#modal-limit').css('display', 'flex');
            } else {
                alert(resp.message);
            }
        }
    });
}

function closeModals() {
    $('.cv-modal-overlay').hide();
}
</script>
   
   
   <script>
        function redirectToRequestPage() {
            <?php if($relationship_status == 'pending') { ?>
                alert("You have already sent a request. Please wait for acceptance.");
            <?php } else { ?>
                window.location.href = "user-incoming-interests.php?tab=allprofiles"; 
            <?php } ?>
        }
    </script>
 



                            <!-- BASIC INFO -->
                            <div class="pr-bio-c pr-bio-info">
                                <h3><img src="images/profilepage/basicinfo.png" style="width:6%"> Basic Information </h3>
                                <ul>
                                    <?php if($rowbasicinfo['createby'] != '') { ?> <li><b>Profile Created by</b> <?php echo $rowbasicinfo['createby']; ?></li> <?php } ?>
                                    <?php if($rowbasicinfo['gender'] != '') { ?> <li><b>Gender</b> <?php echo $rowbasicinfo['gender']; ?></li> <?php } ?>
                                    <?php if($rowbasicinfo['marital'] != '') { ?> <li><b>Marital Status</b> <?php echo $rowbasicinfo['marital']; ?></li> <?php } ?>
                                    <?php if($rowbasicinfo['marital'] == 'Divorced') { ?> <li><b>Children</b> <?php echo $rowbasicinfo['children']; ?></li> <?php } ?>
                                    <?php if($rowbasicinfo['age'] != '') { ?> <li><b>Age</b> <?php echo $rowbasicinfo['age']; ?> Yrs</li> <?php } ?>
                                    <?php if($rowbasicinfo['height'] != '') { ?> <li><b>Height</b> <?php echo $rowbasicinfo['height']; ?></li> <?php } ?>
                                    <?php if($rowbasicinfo['weight'] != '') { ?> <li><b>Weight</b> <?php echo $rowbasicinfo['weight']; ?></li> <?php } ?>
                                    <?php if($rowbasicinfo['physical'] != '') { ?> <li><b>Any Disability</b> <?php echo $rowbasicinfo['physical']; ?></li> <?php } ?>
                                    <?php if($rowbasicinfo['langauge'] != '') { ?> <li><b>Languages Known</b> <?php echo str_replace("//", ", ",$rowbasicinfo['langauge']); ?></li> <?php } ?>
                                    <?php if($rowlocationinfo['country'] != '') { ?> <li><b>Country Living In</b> <?php echo $rowlocationinfo['country']; ?></li> <?php } ?>
                                    <?php if($rowlocationinfo['state'] != '') { ?> <li><b>State</b> <?php echo $rowlocationinfo['state']; ?></li> <?php } ?>
                                    <?php if($rowlocationinfo['city'] != '') { ?> <li><b>City</b> <?php echo $rowlocationinfo['city']; ?></li> <?php } ?>
                                    <?php if($rowlocationinfo['citizenship'] != '') { ?> <li><b>Citizenship</b> <?php echo $rowlocationinfo['citizenship']; ?></li> <?php } ?>
                                    <?php if($rowlocationinfo['resident'] != '') { ?> <li><b>Resident Status</b> <?php echo $rowlocationinfo['resident']; ?></li> <?php } ?>
                                    <?php if($rowbasicinfo['eating'] != '') { ?> <li><b>Eating Habits</b> <?php echo $rowbasicinfo['eating']; ?></li> <?php } ?>
                                    <?php if($rowbasicinfo['smoking'] != '') { ?> <li><b>Smoking Habits</b> <?php echo $rowbasicinfo['smoking']; ?></li> <?php } ?>
                                    <?php if($rowbasicinfo['drinking'] != '') { ?> <li><b>Drinking Habits</b> <?php echo $rowbasicinfo['drinking']; ?></li> <?php } ?>
                                </ul>
                            </div>

                            <!-- ASTRO DETAILS -->
                            <div class="pr-bio-c pr-bio-info">
                                <h3><img src="images/profilepage/astrology.png" style="width:6%"> Astro Details </h3>
                                <ul>
                                    <?php if($rowastroinfo['dob'] != '') { ?> <li><b>Date of Birth</b> <?php echo date('d M Y', strtotime($rowastroinfo['dob'])); ?></li> <?php } ?>
                                    <?php if($rowastroinfo['birthplace'] != '') { ?> <li><b>Place of Birth</b> <?php echo $rowastroinfo['birthplace']; ?></li> <?php } ?>
                                    <?php if($rowastroinfo['birthtime'] != '') { ?> <li><b>Time of Birth</b> <?php echo $rowastroinfo['birthtime']; ?></li> <?php } ?>
                                    <?php if($rowastroinfo['manglik'] != '') { ?> <li><b>Dosh/Dosham</b> <?php echo $rowastroinfo['manglik']; ?></li> <?php } ?>
                                </ul>
                            </div>

                            <!-- RELIGIOUS BACKGROUND -->
                            <div class="pr-bio-c pr-bio-info">
                                <h3><img src="images/profilepage/religion.png" style="width:6%"> Religious Background </h3>
                                <ul>
                                    <?php if($rowreligiousinfo['religion'] != '') { ?> <li><b>Religion</b> <?php echo $rowreligiousinfo['religion']; ?></li> <?php } ?>
                                    <?php if($rowreligiousinfo['caste'] != '') { ?> <li><b>Caste</b> <?php echo $rowreligiousinfo['caste']; ?></li> <?php } ?>
                                    <?php if($rowreligiousinfo['subcaste'] != '') { ?> <li><b>Subcaste</b> <?php echo $rowreligiousinfo['subcaste']; ?></li> <?php } ?>
                                    <?php if($rowreligiousinfo['gothram'] != '') { ?> <li><b>Gothram</b> <?php echo $rowreligiousinfo['gothram']; ?></li> <?php } ?>
                                </ul>
                            </div>

                            <!-- EDUCATION & CAREER -->
                            <div class="pr-bio-c pr-bio-info">
                                <h3><img src="images/profilepage/career.png" style="width:6%"> Education & Career </h3>
                                <ul>
                                    <?php if($roweducationinfo['stream'] != '') { ?> <li><b>Stream</b> <?php echo $roweducationinfo['stream']; ?></li> <?php } ?>
                                    <?php if($roweducationinfo['education'] != '') { ?> <li><b>Highest Education</b> <?php echo $roweducationinfo['education']; ?></li> <?php } ?>
                                    <?php if($roweducationinfo['college'] != '') { ?> <li><b>College/Institute</b> <?php echo $roweducationinfo['college']; ?></li> <?php } ?>
                                    <?php if($roweducationinfo['workingwith'] != '') { ?> <li><b>Working With</b> <?php echo $roweducationinfo['workingwith']; ?></li> <?php } ?>
                                    <?php if($roweducationinfo['profession'] != '') { ?> <li><b>Profession</b> <?php echo $roweducationinfo['profession']; ?></li> <?php } ?>
                                    <?php if($roweducationinfo['profession'] != '') { ?> <li><b>Designation</b> <?php echo $roweducationinfo['profession']; ?></li> <?php } ?>
                                    <?php if($roweducationinfo['professiondetail'] != '') { ?> <li><b>Profession in Detail</b> <?php echo $roweducationinfo['professiondetail']; ?></li> <?php } ?>
                                    <?php if($roweducationinfo['employername'] != '') { ?> <li><b>Employer Name</b> <?php echo $roweducationinfo['employername']; ?></li> <?php } ?>
                                    <?php if($roweducationinfo['income'] != '') { ?> <li><b>Annual Income</b> <?php echo $roweducationinfo['income']; ?></li> <?php } ?>
                                </ul>
                            </div>

                            <!-- FAMILY DETAILS -->
                            <div class="pr-bio-c pr-bio-info">
                                <h3><img src="images/profilepage/family.png" style="width:6%"> Family Details </h3>
                                <ul>
                                    <?php if($rowfamilyinfo['fathername'] != '') { ?> <li><b>Father Name</b> <?php echo $rowfamilyinfo['fathername']; ?></li> <?php } ?>
                                    <?php if($rowfamilyinfo['mothername'] != '') { ?> <li><b>Mother Name</b> <?php echo $rowfamilyinfo['mothername']; ?></li> <?php } ?>
                                    <?php if($rowfamilyinfo['fatheroccupation'] != '') { ?> <li><b>Father’s Occupation</b> <?php echo $rowfamilyinfo['fatheroccupation']; ?></li> <?php } ?>
                                    <?php if($rowfamilyinfo['motheroccupation'] != '') { ?> <li><b>Mother’s Occupation</b> <?php echo $rowfamilyinfo['motheroccupation']; ?></li> <?php } ?>
                                    <?php if($rowfamilyinfo['familyvalue'] != '') { ?> <li><b>Family Value</b> <?php echo $rowfamilyinfo['familyvalue']; ?></li> <?php } ?>
                                    <?php if($rowfamilyinfo['familytype'] != '') { ?> <li><b>Family Type</b> <?php echo $rowfamilyinfo['familytype']; ?></li> <?php } ?>
                                    <?php if($rowfamilyinfo['familystatus'] != '') { ?> <li><b>Family Status</b> <?php echo $rowfamilyinfo['familystatus']; ?></li> <?php } ?>
                                    <?php if($rowfamilyinfo['nativeplace'] != '') { ?> <li><b>Native Place</b> <?php echo $rowfamilyinfo['nativeplace']; ?></li> <?php } ?>
                                    <?php if($rowfamilyinfo['brothers'] != '') { ?> <li><b>No. of Brother</b> <?php echo $rowfamilyinfo['brothers']; ?></li> <?php } ?>
                                    <?php if($rowfamilyinfo['bromarried'] != '') { ?> <li><b>Bothers Married</b> <?php echo $rowfamilyinfo['bromarried']; ?></li> <?php } ?>
                                    <?php if($rowfamilyinfo['sisters'] != '') { ?> <li><b>No. of Sisters</b> <?php echo $rowfamilyinfo['sisters']; ?></li> <?php } ?>
                                    <?php if($rowfamilyinfo['sismarried'] != '') { ?> <li><b>Sisters Married</b> <?php echo $rowfamilyinfo['sismarried']; ?></li> <?php } ?>
                                    <?php if($rowfamilyinfo['country'] != '') { ?> <li><b>Country Living In</b> <?php echo $rowfamilyinfo['country']; ?></li> <?php } ?>
                                    <?php if($rowfamilyinfo['state'] != '') { ?> <li><b>State</b> <?php echo $rowfamilyinfo['state']; ?></li> <?php } ?>
                                    <?php if($rowfamilyinfo['city'] != '') { ?> <li><b>City</b> <?php echo $rowfamilyinfo['city']; ?></li> <?php } ?>
                                      <?php if(isset($rowfamilyinfo['citizenship']) && $rowfamilyinfo['citizenship'] != '') { ?><li><b>Citizenship</b> <?php echo $rowfamilyinfo['citizenship']; ?></li><?php } ?>
                                      <?php if(isset($rowfamilyinfo['resident']) && $rowfamilyinfo['resident'] != '') { ?> <li><b>Resident Status</b> <?php echo $rowfamilyinfo['resident']; ?></li> <?php } ?>

                                </ul>
                            </div>

                            <!-- HOBBIES -->
                            <div class="pr-bio-c pr-bio-hob">
                                <h3><img src="images/profilepage/hobbiesinterests.png" style="width:6%"> Hobbies and Interest</h3>
                                <ul>
                                    <?php
                                    $hobbies = $rowhobbiesinfo['hobbies'];
                                    $music = $rowhobbiesinfo['music'];
                                    $sports = $rowhobbiesinfo['sports'];
                                    $food  = $rowhobbiesinfo['food'];
                                    
                                    if($hobbies == "" && $music == "" && $sports == "" && $food == "") {
                                        echo "<li>User didn't share the details</li>";
                                    } else {
                                        if($hobbies) { foreach(explode("//", $hobbies) as $sh) echo "<li><span>$sh</span></li>"; }
                                        if($music) { foreach(explode("//", $music) as $sm) echo "<li><span>$sm</span></li>"; }
                                        if($sports) { foreach(explode("//", $sports) as $ss) echo "<li><span>$ss</span></li>"; }
                                        if($food) { foreach(explode("//", $food) as $sf) echo "<li><span>$sf</span></li>"; }
                                    }
                                    ?>
                                </ul>
                            </div>

                            <!-- PARTNER PREFERENCES -->
                            <div class="pr-bio-c pr-bio-info">
                                <h3><img src="images/profilepage/preferences.png" style="width:6%"> Partner Preferences </h3>
                                <ul>
                                    <?php if($rowpartnerinfo['partnerage'] != '') { ?> <li><b>Partner Age</b> <?php echo $rowpartnerinfo['partnerage']; ?></li> <?php } ?>
                                    <?php if($rowpartnerinfo['partnerheight'] != '') { ?> <li><b>Height</b> <?php echo $rowpartnerinfo['partnerheight']; ?></li> <?php } ?>
                                    <?php if($rowpartnerinfo['partnermarital'] != '') { ?> <li><b>Marital Status</b> <?php echo $rowpartnerinfo['partnermarital']; ?></li> <?php } ?>
                                    <?php if($rowpartnerinfo['partnerphysical'] != '') { ?> <li><b>Physical Status</b> <?php echo $rowpartnerinfo['partnerphysical']; ?></li> <?php } ?>
                                    <?php if($rowpartnerinfo['partnereating'] != '') { ?> <li><b>Eating Habits</b> <?php echo $rowpartnerinfo['partnereating']; ?></li> <?php } ?>
                                    <?php if($rowpartnerinfo['partnerdrinking'] != '') { ?> <li><b>Drinking Habits</b> <?php echo $rowpartnerinfo['partnerdrinking']; ?></li> <?php } ?>
                                    <?php if($rowpartnerinfo['partnersmoking'] != '') { ?> <li><b>Smoking Habits</b> <?php echo $rowpartnerinfo['partnersmoking']; ?></li> <?php } ?>
                                    <?php if($rowpartnerinfo['partnermanglik'] != '') { ?> <li><b>Dosh/Dosham</b> <?php echo $rowpartnerinfo['partnermanglik']; ?></li> <?php } ?>
                                    <?php if($rowpartnerinfo['partnerreligion'] != '') { ?> <li><b>Religion</b> <?php echo str_replace("//", ", ", $rowpartnerinfo['partnerreligion']); ?></li> <?php } ?>
                                    <?php if($rowpartnerinfo['partnercaste'] != '') { ?> <li><b>Caste</b> <?php echo str_replace("//", ", ", $rowpartnerinfo['partnercaste']); ?></li> <?php } ?>
                                    <?php if($rowpartnerinfo['partnergothram'] != '') { ?> <li><b>Gothram</b> <?php echo $rowpartnerinfo['partnergothram']; ?></li> <?php } ?>
                                    <?php if($rowpartnerinfo['partnerstream'] != '') { ?> <li><b>Stream</b> <?php echo str_replace("//", ", ", $rowpartnerinfo['partnerstream']); ?></li> <?php } ?>
                                    <?php if($rowpartnerinfo['partnereducation'] != '') { ?> <li><b>Highest Education</b> <?php echo str_replace("//", ", ", $rowpartnerinfo['partnereducation']); ?></li> <?php } ?>
                                    <?php if($rowpartnerinfo['partnerprofession'] != '') { ?> <li><b>Profession</b> <?php echo str_replace("//", ", ", $rowpartnerinfo['partnerprofession']); ?></li> <?php } ?>
                                    <?php if($rowpartnerinfo['partnerdomain'] != '') { ?> <li><b>Working With</b> <?php echo str_replace("//", ", ", $rowpartnerinfo['partnerdomain']); ?></li> <?php } ?>
                                    <?php if($rowpartnerinfo['partnerincome'] != '') { ?> <li><b>Annual Income</b> <?php echo $rowpartnerinfo['partnerincome']; ?></li> <?php } ?>
                                    <?php if($rowpartnerinfo['partnercity'] != '') { ?> <li><b>City</b> <?php echo str_replace("//", ", ", $rowpartnerinfo['partnercity']); ?></li> <?php } ?>
                                    <?php if($rowpartnerinfo['partnerstate'] != '') { ?> <li><b>State</b> <?php echo str_replace("//", ", ", $rowpartnerinfo['partnerstate']); ?></li> <?php } ?>
                                    <?php if($rowpartnerinfo['partnercountry'] != '') { ?> <li><b>Country</b> <?php echo str_replace("//", ", ", $rowpartnerinfo['partnercountry']); ?></li> <?php } ?>
                                </ul>
                            </div>
                        </div>

                        <!-- RIGHT HAND SIDE (RELATED PROFILES) -->
                        <div class="rhs">
                            <div class="slid-inn pr-bio-c wedd-rel-pro relatedprofile m-0">
                                <h3>Related profiles</h3>
                                <ul class="slider4">
                                    <?php
                                    // Fetch current user details for basic matching
                                    $cur_basic = mysqli_fetch_assoc(mysqli_query($con, "select * from basic_info where userid = '$loginid'"));
                                    $cur_rel = mysqli_fetch_assoc(mysqli_query($con, "select * from religious_info where userid = '$loginid'"));
                                    $cur_edu = mysqli_fetch_assoc(mysqli_query($con, "select * from education_info where userid = '$loginid'"));
                                    
                                    if($cur_basic) {
                                        $age = $cur_basic['age'];
                                        $marital = $cur_basic['marital'];
                                        $religion = $cur_rel['religion'];
                                        $caste = $cur_rel['caste'];
                                        $stream = $cur_edu['stream'];
                                        $workingwith = $cur_edu['workingwith'];

                                        $sqlinfo = "select * from final_bio where age <= '$age' and marital = '$marital' and religion = '$religion' and caste = '$caste' and stream = '$stream' and workingwith = '$workingwith' and gender != '$gender' and userid != '$loginid' and userid != '$profileid' order by id desc limit 50";
                                        $resultinfo = mysqli_query($con,$sqlinfo);
                                        
                                        if(mysqli_num_rows($resultinfo) > 0) {
                                            while($rowinfo = mysqli_fetch_assoc($resultinfo)) {
                                                $rel_userid = $rowinfo['userid'];
                                                $rel_photo = mysqli_fetch_assoc(mysqli_query($con, "select * from photos_info where userid = '$rel_userid'"));
                                                $rel_basic = mysqli_fetch_assoc(mysqli_query($con, "select * from basic_info where userid = '$rel_userid'"));
                                                $rel_loc = mysqli_fetch_assoc(mysqli_query($con, "select * from groom_location where userid = '$rel_userid'"));
                                                ?>
                                                <li>
                                                    <div class="wedd-rel-box">
                                                        <div class="wedd-rel-img">
                                                            <img src="userphoto/<?php echo $rel_photo['profilepic']?>" alt="">
                                                        </div>
                                                        <div class="wedd-rel-con">
                                                            <h5><?php echo $rel_basic['fullname']; ?></h5>
                                                            <span>City <b><?php echo $rel_loc['city'];?></b></span>
                                                        </div>
                                                        <a href="user-profile-details.php?uid=<?php echo $rel_userid; ?>" class="fclick"></a>
                                                    </div>
                                                </li>
                                                <?php
                                            }
                                        } else {
                                            echo "<li><b>No Profiles Found</b></li>";
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 <!-- <div class="rhs">
                        <div class="slid-inn pr-bio-c wedd-rel-pro relatedprofile m-0">
                            <h3>Related profiles</h3>
                            <ul class="slider4">
                                <?php
                                $cur_basic = mysqli_fetch_assoc(mysqli_query($con, "select * from basic_info where userid = '$loginid'"));
                                $cur_rel = mysqli_fetch_assoc(mysqli_query($con, "select * from religious_info where userid = '$loginid'"));
                                $cur_edu = mysqli_fetch_assoc(mysqli_query($con, "select * from education_info where userid = '$loginid'"));
                                
                                if($cur_basic) {
                                    $age = $cur_basic['age'];
                                    $marital = $cur_basic['marital'];
                                    $religion = $cur_rel['religion'];
                                    $caste = $cur_rel['caste'];
                                    $stream = $cur_edu['stream'];
                                    $workingwith = $cur_edu['workingwith'];

                                    $sqlinfo = "select * from final_bio where age <= '$age' and marital = '$marital' and religion = '$religion' and caste = '$caste' and stream = '$stream' and workingwith = '$workingwith' and gender != '$gender' and userid != '$loginid' and userid != '$profileid' order by id desc limit 50";
                                    $resultinfo = mysqli_query($con,$sqlinfo);
                                    
                                    if(mysqli_num_rows($resultinfo) > 0) {
                                        while($rowinfo = mysqli_fetch_assoc($resultinfo)) {
                                            $rel_userid = $rowinfo['userid'];
                                            $rel_photo = mysqli_fetch_assoc(mysqli_query($con, "select * from photos_info where userid = '$rel_userid'"));
                                            $rel_basic = mysqli_fetch_assoc(mysqli_query($con, "select * from basic_info where userid = '$rel_userid'"));
                                            $rel_loc = mysqli_fetch_assoc(mysqli_query($con, "select * from groom_location where userid = '$rel_userid'"));
                                            ?>
                                            <li>
                                                <div class="wedd-rel-box">
                                                    <div class="wedd-rel-img">
                                                        <img src="userphoto/<?php echo $rel_photo['profilepic']?>" alt="">
                                                    </div>
                                                    <div class="wedd-rel-con">
                                                        <h5><?php echo $rel_basic['fullname']; ?></h5>
                                                        <span>City <b><?php echo $rel_loc['city'];?></b></span>
                                                    </div>
                                                    <a href="user-profile-details.php?uid=<?php echo $rel_userid; ?>" class="fclick"></a>
                                                </div>
                                            </li>
                                            <?php
                                        }
                                    } else {
                                        echo "<li><b>No Profiles Found</b></li>";
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div> -->
                    <style>
    /* --- PREMIUM PROFILE CARD STYLES --- */
    .premium-profile-wrapper {
        /* background: #fff; */
        padding: 20px;
        margin-bottom: 50px;
        margin-top:14px;
        border-radius: 8px;
        /* box-shadow: 0 2px 10px rgba(0,0,0,0.05); */
    }

    /* The Gradient Card Container */
    .premium-card {
    background: linear-gradient(135deg, #debfc0ff 0%, #fecfef 50%, #c1d4f3ff 100%);
    /* background: linear-gradient(to bottom, #805757 0%, #F4EFE6 50%, #966c6cff 100%); */

    border-radius: 20px;
    padding: 16px 20px;
    /* margin: 30px 30px; */
    text-align: center;
    color: #333;
    position: relative;
    overflow: hidden;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    max-width: 500px;
    margin: 20px auto;
}

    /* Profile Picture Container */
    .premium-pic-box {
        position: relative;
        width: 400px;
        height: 300px;
        margin: 0 auto 15px auto;
        cursor: pointer;
        transition: transform 0.3s ease;
    }
    .premium-pic-box:hover {
        transform: scale(1.05);
    }
    
    .premium-pic {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 10%;
        border: 5px solid #fff;
        box-shadow: 0 5px 15px rgba(0,0,0,0.15);
    }

    /* Verified Badge */
  .verify-badge {
    position: absolute;
    bottom: -10px;
    right: -9px;
    width: 40px;
    height: 40px;
    background: #1877F2;
    color: #fff;
    border-radius: 50%;
    border: 3px dashed #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 30px;
}

    /* Name & ID */
    .premium-name {
        font-size: 26px;
        font-weight: 800;
        margin: 0;
        color: #2c3e50;
    }
    .premium-id {
        font-size: 16px;
        color: #555;
        font-weight: 500;
        margin-top: 5px;
        margin-bottom: 5px;
        opacity: 0.8;
    }

    /* Divider Line */
    .premium-divider {
        height: 1px;
        background: rgba(0,0,0,0.08);
        width: 80%;
        margin: 0 auto 25px auto;
    }
    
    .share-title {
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        color: #666;
        margin-bottom: 15px;
    }

    /* Share Icons */
    .premium-actions {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-bottom: 30px;
    }
    .p-action-btn {
        width: 50px;
        height: 50px;
        background: #fff;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        text-decoration: none;
        transition: all 0.2s ease;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    .p-action-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 15px rgba(0,0,0,0.12);
    }
    .icon-wa { color: #25D366; }
    .icon-fb { color: #1877F2; }
    .icon-in { color: #E1306C; }
    
    /* Copy Link Section */
    .copy-link-wrapper {
        background: #fff;
        border-radius: 12px;
        padding: 6px;
        display: flex;
        align-items: center;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        max-width: 90%;
        margin: 0 auto;
    }
    .link-display {
        flex: 1;
        padding: 0 15px;
        font-size: 14px;
        color: #777;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        text-align: left;
    }
    .btn-copy {
        background: #1a2332;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .btn-copy:hover {
        background: #333;
    }

    /* --- MODAL (ZOOM) STYLES --- */
    .zoom-modal {
        display: none; 
        position: fixed; 
        z-index: 9999; 
        left: 0;
        top: 0;
        width: 100%; 
        height: 100%; 
        overflow: hidden; 
        background-color: rgba(0,0,0,0.9);
    }
    /* .zoom-content {
        margin: auto;
        display: block;
        max-width: 90%;
        max-height: 85vh;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        border: 4px solid #fff;
        border-radius: 4px;
    } */
        .zoom-content {
    max-width: 95vw;
    max-height: 90vh;
    width: auto;
    height: auto;
    display: block;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    border: 4px solid #fff;
    border-radius: 10px;
}

    .close-zoom {
        position: absolute;
        top: 20px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
        cursor: pointer;
        z-index: 10000;
    }
    .zoom-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        color: white;
        font-size: 50px;
        font-weight: bold;
        cursor: pointer;
        padding: 16px;
        user-select: none;
        background: rgba(0,0,0,0.3);
        border-radius: 5px;
        transition: 0.3s;
        .zoom-nav {
    pointer-events: auto !important;
}

    }
    .zoom-nav:hover { background: rgba(255,255,255,0.2); }
    .zoom-prev { left: 20px; }
    .zoom-next { right: 20px; }


    /* --- ORIGINAL CSS FOR CONTACT/DETAILS --- */
    .contact-grid-box {
        background: #fff;
        border: 1px solid #eee;
        border-radius: 8px;
        padding: 20px;
    }
    .c-row {
        display: flex;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid #f5f5f5;
    }
    .c-row:last-child { border-bottom: none; }
    .c-icon {
        width: 35px;
        height: 35px;
        background: #fff0f0;
        color: #d9534f;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        margin-right: 15px;
    }
    .c-details h6 { margin: 0; font-size: 12px; color: #888; text-transform: uppercase; }
    .c-details p { margin: 0; font-size: 15px; font-weight: 600; color: #333; }
    
    /* Lock Overlay */
    .lockscreen {
        position: absolute;
        top: 50%;
        right: 20px;       
        transform: translateY(-50%);
        z-index: 10;
        cursor: pointer;
    }
    .lockscreen > div {
        display: flex;
        align-items: center;
        justify-content: center;        
        gap: 12px;
        padding-left: 0 !important;   
    }
    .lock-container:hover {
        background: #fff9f9;
        border-color: #d9534f;
    }
    .pr-bio-conta ul li span {
        font-weight: 400;
        position: relative;
        padding-left: 0px;
        display: block;
        display: flex;
        align-items: center;
    }
</style>
<div id="imageModal" class="zoom-modal">
    <span class="close-zoom" onclick="closeZoomModal()">&times;</span>
    <span class="zoom-nav zoom-prev" onclick="changeSlide(-1)">&#10094;</span>
    <img class="zoom-content" id="modalImg">
    <span class="zoom-nav zoom-next" onclick="changeSlide(1)">&#10095;</span>
</div>



    </section>

<script>
// document.addEventListener("click", function (e) {
//     if (e.target.classList.contains("zoom-prev")) {
//         changeSlide(-1);
//     }
//     if (e.target.classList.contains("zoom-next")) {
//         changeSlide(1);
//     }
// });


document.querySelector('.close-zoom').onclick = function(e) {
    e.stopPropagation();
    closeZoomModal();
};


    function handleContactClick(action) {
        if(action === 'reveal') {
            // Hide lock, Show Details
            document.querySelector('.lock-container').style.display = 'none';
            document.getElementById('contact-details-box').style.display = 'block';
        } 
        else if(action === 'send_interest') {
            // Trigger Form Submission
            if(confirm('Do you want to send an interest request to view contact details?')) {
                // You can either redirect to insert-submitrequest.php?receiver_id=...
                // Or submit a form. Here we redirect for simplicity as typically used in PHP links.
                window.location.href = "insert-submitrequest.php?receiver_id=<?php echo $profileid; ?>";
            }
        }
    }
     let photos = [];
    <?php 
    if($rowphotoinfo['profilepic']) echo "photos.push('userphoto/".$rowphotoinfo['profilepic']."');";
    if($rowphotoinfo['photo1']) echo "photos.push('userphoto/".$rowphotoinfo['photo1']."');";
    if($rowphotoinfo['photo2']) echo "photos.push('userphoto/".$rowphotoinfo['photo2']."');";
    if($rowphotoinfo['photo3']) echo "photos.push('userphoto/".$rowphotoinfo['photo3']."');";
    ?>

   
let currentPhotoIndex = 0;
const modal = document.getElementById("imageModal");
const modalImg = document.getElementById("modalImg");

function openZoomModal(startIndex) {
    currentPhotoIndex = startIndex;
    modal.style.display = "block";
    // modalImg.src = photos[currentPhotoIndex];
modalImg.style.opacity = 0; 
setTimeout(() => {
    modalImg.src = photos[currentPhotoIndex];
    modalImg.style.opacity = 1;
}, 50);


}

function closeZoomModal() {
    modal.style.display = "none";
}

function changeSlide(n) {
    currentPhotoIndex += n;

    if (currentPhotoIndex >= photos.length) currentPhotoIndex = 0;
    if (currentPhotoIndex < 0) currentPhotoIndex = photos.length - 1;

    // modalImg.src = photos[currentPhotoIndex];
    modalImg.style.opacity = 0; 
setTimeout(() => {
    modalImg.src = photos[currentPhotoIndex];
    modalImg.style.opacity = 1;
}, 50);

}

// Close when clicked outside
window.addEventListener("click", function(event) {
    if (event.target == modal) closeZoomModal();
});

    // 2. Copy Link Function
    function copyLink(text) {
        // Fallback for older browsers
        var textArea = document.createElement("textarea");
        textArea.value = text;
        document.body.appendChild(textArea);
        textArea.select();
        try {
            document.execCommand('copy');
            alert("Profile link copied to clipboard!");
        } catch (err) {
            alert("Failed to copy link.");
        }
        document.body.removeChild(textArea);
    }
</script>



<?php
include 'footer.php';
?>