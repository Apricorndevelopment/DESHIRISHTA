<?php
include 'header.php';
include 'config.php';

date_default_timezone_set('Asia/kolkata'); 

$loginid = $_COOKIE['dr_userid'];
$gender = $_COOKIE['dr_gender'];

// CRITICAL: For "My Profile", the profile ID is the logged-in user's ID
$profileid = $loginid;

if($loginid == '')
{
    echo "<script>window.location.href='login.php';</script>";
    exit;
}

// --- FETCH ALL USER DATA ---

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

// Count how many people viewed ME
$sqlcountview = "select * from viewvist_ids where visit = '$profileid'";
$rowcountview = mysqli_query($con,$sqlcountview);
$countview = mysqli_num_rows($rowcountview);


?>


<!-- CSS FOR PREMIUM CARD LAYOUT -->
<style>
    /* --- PREMIUM PROFILE CARD STYLES --- */
    .premium-profile-wrapper {
        padding: 20px;
        margin-bottom: 15px;
        margin-top:14px;
        border-radius: 8px;
    }

    /* The Gradient Card Container */
    .premium-card {
        background: linear-gradient(135deg, #debfc0ff 0%, #fecfef 50%, #c1d4f3ff 100%);
        border-radius: 20px;
        padding: 16px 20px;
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
        margin-bottom: 10px;
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
        pointer-events: auto !important;
    }
    .zoom-nav:hover { background: rgba(255,255,255,0.2); }
    .zoom-prev { left: 20px; }
    .zoom-next { right: 20px; }

    /* Mobile Responsive Fix */
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
    
    .pr-bio-conta ul li span {
        font-weight: 400;
        position: relative;
        padding-left: 0px;
        display: block;
        display: flex;
        align-items: center;
    }
</style>

    <!-- PROFILE -->
    <section>
        <div class="profi-pg profi-ban">
            <div class="">
                <div class="">
                    
                    <!-- NEW PREMIUM CARD SECTION -->
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
                                    <?php if($rowregistration['verificationinfo'] == 'Done') { ?>
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
                                <!-- <div class="share-title">Share Profile</div> -->
                                
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

                                <!-- Copy Link Section -->
                                <div class="copy-link-wrapper">
                                    <div class="link-display" id="linkText"></div>
                                    <button class="btn-copy" id="copyBtn" onclick="copyCurrentURL()">
                                        <i class="fa fa-copy"></i> Copy
                                    </button>
                                </div>
                                
                                <!-- EDIT PROFILE BUTTON (Only for User Profile) -->
                                <!-- <div style="margin-top: 20px;">
                                    <a href="user-profile-edit.php" class="btn btn-dark btn-sm" style="border-radius: 20px; padding: 8px 20px;">
                                        <i class="fa fa-pencil"></i> Edit Profile
                                    </a>
                                </div> -->

                            </div>
                        </div>
                    </div>
                    <!-- END PREMIUM MODULE -->

                    <div class="profi-pg profi-bio">
                        <div class="lhs">
                            
                            <!-- INTRO SECTION -->
                            <div class="pro-pg-intro pr-bio-c">
                                <h1><?php echo $rowbasicinfo['fullname']; ?></h1>
                                <div class="mb-2 brown textcenter"><b><?php echo $rowbasicinfo['userid']; ?></b></div>
<!--                                 
                                <div class="pro-info-status">
                                    <?php if($rowregistration['verificationinfo'] == 'Done') { ?>
                                    <span class="stat-3"><b>ID Verified</b></span>
                                    <?php } ?>
                                    
                                    <span class="stat-1"><b><?php echo $countview;?></b> viewers</span>
                                    
                                    <?php if($rowregistration['online'] == 'yes') { ?>
                                    <span class="stat-2"><b>Available</b></span>
                                    <?php } else { ?>
                                    <span class="stat-4"><b>Unavailable</b></span>
                                    <?php } ?>
                                </div> -->
                                <div class="pro-info-status">
    <?php if($rowregistration['verificationinfo'] == 'Done') { ?>
        <span class="stat-3"><b>ID Verified</b></span>
    <?php } ?>
    
    <span class="stat-1"><b><?php echo $countview;?></b> viewers</span>
    
    <?php
    if($loginid == $profileid || strtolower(trim($rowregistration['online'])) == 'yes') {
    ?>
        <span class="stat-2"><b>Available</b></span>
    <?php } else { ?>
        <span class="stat-4"><b>Unavailable</b></span>
    <?php } ?>
</div>
<style>.coninfo {
    /* filter: blur(5px); */
    background-color: #ffffff00;
    -webkit-user-select: none;
}</style>

                                
                                <ul class="mb-3">
                                    <li><div><img src="images/gif/age.gif" loading="lazy"><span> <strong><?php echo $rowbasicinfo['age'].' Yrs'; ?></strong></span></div></li>
                                    <li><div><img src="images/gif/height.gif" loading="lazy"><span> <strong><?php echo $rowbasicinfo['height']; ?></strong></span></div></li>
                                    <li><div><img src="images/gif/religioncaste.gif" loading="lazy"><span> <strong><?php echo $rowreligiousinfo['religion'].', '.$rowreligiousinfo['caste']; ?></strong></span></div></li>
                                    <li><div><img src="images/gif/graduation-cap.gif" loading="lazy"><span> <strong><?php echo $roweducationinfo['education']; ?></strong></span></div></li>
                                    <li><div><img src="images/gif/career.gif" loading="lazy"><span> <strong><?php echo $roweducationinfo['designation']; ?></strong></span></div></li>
                                    <li>
                                        <div>
                                            <img src="images/gif/location.gif" loading="lazy">
                                            <?php
                                            $cityarray1 = explode("//", $rowlocationinfo['city']);
                                            $state11 = str_replace("_", " ", $rowlocationinfo['state']);
                                            $city11 = $cityarray1[0]; 
                                            ?>
                                            <span> <strong><?php echo $city11.', '.$state11; ?></strong></span>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <!-- ABOUT ME -->
                            <div class="pr-bio-c pr-bio-abo" id="contactinfo">
                                <h3><img src="images/profilepage/aboutus.png" style="width:6%"> About <?php echo $rowbasicinfo['fullname']; ?></h3>
                                <p class="text-justify"><?php echo $rowbasicinfo['aboutme']; ?></p>
                            </div>

                            <!-- CONTACT INFORMATION (UNLOCKED FOR SELF) -->
                            <div class="pr-bio-c pr-bio-conta">
                                <h3><img src="images/profilepage/contactinfo.png" style="width:6%"> Contact information</h3>
                                <div class="conborder">
                                    <ul class="coninfo" style="filter: none !important; opacity: 1 !important; pointer-events: auto;">
                                        <li>
                                            <span>
                                                <i class="fa fa-mobile" aria-hidden="true"></i>
                                                <b>Phone</b> <?php echo $rowcontactinfo['phonenumber']; ?>
                                                &nbsp;<i class="fa fa-check text-success b-0" aria-hidden="true" title="Verified"></i>
                                            </span>
                                        </li>
                                        <li class="desktop">
                                            <span>
                                                <i class="fa bi-envelope" aria-hidden="true"></i>
                                                <b>Email</b> <?php echo $rowcontactinfo['email']; ?>
                                                &nbsp;<?php if($rowregistration['emailverify'] == '1') { echo '<i class="fa fa-check text-success b-0" aria-hidden="true" title="Verified"></i>'; } ?>
                                            </span>
                                        </li>
                                        <li class="mobile">
                                            <span>
                                                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                                <b>Email</b><br><?php echo $rowcontactinfo['email']; ?>
                                                &nbsp;<?php if($rowregistration['emailverify'] == '1') { echo '<i class="fa fa-check text-success b-0" aria-hidden="true"></i>'; } ?>
                                            </span>
                                        </li>
                                        <?php if($rowcontactinfo['contactperson'] != '') { ?>
                                        <li><span><i class="fa fa-user" aria-hidden="true"></i><b>Contact Person</b><?php echo $rowcontactinfo['contactperson']; ?></span></li>
                                        <?php } ?>
                                        <?php if($rowcontactinfo['relationship'] != '') { ?>
                                        <li><span><i class="fa fa-handshake-o" aria-hidden="true"></i><b>Relationship</b><?php echo $rowcontactinfo['relationship']; ?></span></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>

                            <!-- BASIC INFORMATION -->
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
                                    <?php if($rowlocationinfo['state'] != '') { ?> <li><b>State</b> <?php echo str_replace("_", " ", $rowlocationinfo['state']); ?></li> <?php } ?>
                                    <?php if($rowlocationinfo['city'] != '') { ?> <li><b>City</b> <?php echo $city11; ?></li> <?php } ?>
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
                                    <?php if($roweducationinfo['profession'] != '') { ?> <li><b>Profession</b> <?php echo str_replace("-", " ", $roweducationinfo['profession']); ?></li> <?php } ?>
                                    <?php if($roweducationinfo['designation'] != '') { ?> <li><b>Designation</b> <?php echo $roweducationinfo['designation']; ?></li> <?php } ?>
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
                                    <?php if($rowfamilyinfo['bromarried'] != '') { ?> <li><b>Brothers Married</b> <?php echo $rowfamilyinfo['bromarried']; ?></li> <?php } ?>
                                    <?php if($rowfamilyinfo['sisters'] != '') { ?> <li><b>No. of Sisters</b> <?php echo $rowfamilyinfo['sisters']; ?></li> <?php } ?>
                                    <?php if($rowfamilyinfo['sismarried'] != '') { ?> <li><b>Sisters Married</b> <?php echo $rowfamilyinfo['sismarried']; ?></li> <?php } ?>
                                    <?php if($rowfamilyinfo['familylocation'] == 'Same as my location') { ?>
                                        <?php if($rowlocationinfo['country'] != '') { ?> <li><b>Country Living In</b> <?php echo $rowlocationinfo['country']; ?></li> <?php } ?>
                                        <?php if($rowlocationinfo['state'] != '') { ?> <li><b>State</b> <?php echo $rowlocationinfo['state']; ?></li> <?php } ?>
                                        <?php if($rowlocationinfo['city'] != '') { ?> <li><b>City</b> <?php echo $rowlocationinfo['city']; ?></li> <?php } ?>
                                    <?php } elseif($rowfamilyinfo['familylocation'] == 'Different Location') { ?>
                                        <?php if($rowfamilyinfo['country'] != '') { ?> <li><b>Country Living In</b> <?php echo $rowfamilyinfo['country']; ?></li> <?php } ?>
                                        <?php if($rowfamilyinfo['state'] != '') { ?> <li><b>State</b> <?php echo $rowfamilyinfo['state']; ?></li> <?php } ?>
                                        <?php if($rowfamilyinfo['city'] != '') { ?> <li><b>City</b> <?php echo $rowfamilyinfo['city']; ?></li> <?php } ?>
                                    <?php } ?>
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
                                    <?php if($rowpartnerinfo['partnercaste'] != '') { ?> <li><b>Caste</b> <?php echo ($rowpartnerinfo['castebar'] == 'yes') ? "Caste No Bar" : str_replace("//", ", ", $rowpartnerinfo['partnercaste']); ?></li> <?php } ?>
                                    <?php if($rowpartnerinfo['partnergothram'] != '') { ?> <li><b>Gothram</b> <?php echo $rowpartnerinfo['partnergothram']; ?></li> <?php } ?>
                                    <?php if($rowpartnerinfo['partnerstream'] != '') { ?> <li><b>Stream</b> <?php echo str_replace("//", ", ", $rowpartnerinfo['partnerstream']); ?></li> <?php } ?>
                                    <?php if($rowpartnerinfo['partnereducation'] != '') { ?> <li><b>Highest Education</b> <?php echo str_replace("//", ", ", $rowpartnerinfo['partnereducation']); ?></li> <?php } ?>
                                    <?php if($rowpartnerinfo['partnerprofession'] != '') { ?> <li><b>Working With</b> <?php echo str_replace("//", ", ", $rowpartnerinfo['partnerprofession']); ?></li> <?php } ?>
                                    <?php if($rowpartnerinfo['partnerdomain'] != '') { ?> <li><b>Profession</b> <?php echo str_replace("//", ", ", $rowpartnerinfo['partnerdomain']); ?></li> <?php } ?>
                                    <?php if($rowpartnerinfo['partnerincome'] != '') { ?> <li><b>Annual Income</b> <?php echo $rowpartnerinfo['partnerincome']; ?></li> <?php } ?>
                                    <?php if($rowpartnerinfo['partnercity'] != '') { ?> <li><b>City</b> <?php echo str_replace("//", ", ", $rowpartnerinfo['partnercity']); ?></li> <?php } ?>
                                    <?php if($rowpartnerinfo['partnerstate'] != '') { ?> <li><b>State</b> <?php echo str_replace("//", ", ", $rowpartnerinfo['partnerstate']); ?></li> <?php } ?>
                                    <?php if($rowpartnerinfo['partnercountry'] != '') { ?> <li><b>Country</b> <?php echo str_replace("//", ", ", $rowpartnerinfo['partnercountry']); ?></li> <?php } ?>
                                </ul>
                            </div>
                        </div>

                        <!-- RIGHT HAND SIDE (MATCHES) -->
                        <div class="rhs">
                            <div class="slid-inn pr-bio-c wedd-rel-pro relatedprofile m-0">
                                <h3>Related profiles (Matches)</h3>
                                <ul class="slider4">
                                    <?php
                                    // Logic to find matches based on YOUR details (Inverse gender)
                                    $age = $rowbasicinfo['age'];
                                    $marital = $rowbasicinfo['marital'];
                                    $religion = $rowreligiousinfo['religion'];
                                    $caste = $rowreligiousinfo['caste'];
                                    $stream = $roweducationinfo['stream'];
                                    $workingwith = $roweducationinfo['workingwith'];

                                    // Finding profiles that match YOUR background but are opposite gender
                                    $sqlinfo = "select * from final_bio where age <= '$age' and marital = '$marital' and religion = '$religion' and caste = '$caste' and stream = '$stream' and workingwith = '$workingwith' and gender != '$gender' and userid != '$loginid' order by id desc limit 50";
                                    $resultinfo = mysqli_query($con,$sqlinfo);
                                    
                                    if(mysqli_num_rows($resultinfo) > 0)
                                    {
                                        while($rowinfo = mysqli_fetch_assoc($resultinfo))
                                        {
                                            $rel_userid = $rowinfo['userid'];
                                            
                                            // Fetch match photos
                                            $resultphotoinfo1 = mysqli_query($con,"select * from photos_info where userid = '$rel_userid'");
                                            $rowphotoinfo1 = mysqli_fetch_assoc($resultphotoinfo1);
                                            
                                            // Fetch match name
                                            $resultbasicinfo1 = mysqli_query($con,"select * from basic_info where userid = '$rel_userid'");
                                            $rowbasicinfo1 = mysqli_fetch_assoc($resultbasicinfo1);
                                            
                                            // Fetch match location
                                            $resultlocationinfo1 = mysqli_query($con,"select * from groom_location where userid = '$rel_userid'");
                                            $rowlocationinfo1 = mysqli_fetch_assoc($resultlocationinfo1);
                                            
                                            // Fallback for no photo
                                            $dispPic = $rowphotoinfo1['profilepic'] ? "userphoto/".$rowphotoinfo1['profilepic'] : "images/no-profile-pic.jpg";
                                            ?>
                                            <li>
                                                <div class="wedd-rel-box">
                                                    <div class="wedd-rel-img">
                                                        <img src="<?php echo $dispPic; ?>" alt="">
                                                    </div>
                                                    <div class="wedd-rel-con">
                                                        <h5><?php echo $rowbasicinfo1['fullname']; ?></h5>
                                                        <span>City <b><?php echo $rowlocationinfo1['city'];?></b></span>
                                                    </div>
                                                    <a href="user-profile-details.php?uid=<?php echo $rowbasicinfo1['userid']; ?>" class="fclick"></a>
                                                </div>
                                            </li>
                                            <?php
                                        }
                                    } else {
                                        echo "<li><b>No Profile Found</b></li>";
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Image Zoom Modal -->
        <div id="imageModal" class="zoom-modal">
            <span class="close-zoom" onclick="closeZoomModal()">&times;</span>
            <span class="zoom-nav zoom-prev" onclick="changeSlide(-1)">&#10094;</span>
            <img class="zoom-content" id="modalImg">
            <span class="zoom-nav zoom-next" onclick="changeSlide(1)">&#10095;</span>
        </div>

    </section>
    
<script>
    // --- ZOOM LOGIC ---
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
        if(photos.length === 0) return;
        currentPhotoIndex = startIndex;
        modal.style.display = "block";
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
        modalImg.style.opacity = 0; 
        setTimeout(() => {
            modalImg.src = photos[currentPhotoIndex];
            modalImg.style.opacity = 1;
        }, 50);
    }

    // Close on overlay click
    window.addEventListener("click", function(event) {
        if (event.target == modal) closeZoomModal();
    });
    
    // --- SHARE LOGIC ---
    function shareTo(platform) {
        let url = window.location.href;
        // Count store logic if needed
        // fetch('ajax-share-count.php', ...);

        let links = {
            whatsapp: "https://api.whatsapp.com/send?text=" + encodeURIComponent("Check out my profile: " + url),
            facebook: "https://www.facebook.com/sharer/sharer.php?u=" + url,
            instagram: "https://www.instagram.com/?url=" + url,
            twitter: "https://twitter.com/intent/tweet?url=" + url
        };
        if(links[platform]) window.open(links[platform], "_blank");
    }

    // --- COPY LINK LOGIC ---
    document.getElementById("linkText").innerText = window.location.href;
    function copyCurrentURL() {
        let url = window.location.href;
        navigator.clipboard.writeText(url);
        let btn = document.getElementById("copyBtn");
        btn.innerHTML = '<i class="fa fa-check"></i> Copied';
        setTimeout(() => { btn.innerHTML = '<i class="fa fa-copy"></i> Copy'; }, 2000);
    }
</script>

    <!-- END PROFILE -->
<?php
include 'footer.php';
?>