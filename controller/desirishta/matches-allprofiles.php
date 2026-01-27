<?php
include 'header.php';
include 'config.php';

// 1. Auth Check
$userid = $_COOKIE['dr_userid'];
$gender = $_COOKIE['dr_gender'];

if ($userid == '') {
    header('location:login.php');
    exit;
}

// 2. Verification Check
$sql_check_auth = "SELECT verificationinfo FROM registration WHERE userid = '$userid'";
$result_check_auth = mysqli_query($con, $sql_check_auth);
$row_check_auth = mysqli_fetch_assoc($result_check_auth);

if ($row_check_auth['verificationinfo'] != '1') {
    echo "<script>
            alert('Access Denied! Please wait for Admin to approve your ID.');
            window.location.href='user-dashboard.php';
          </script>";
    exit();
}

// ==========================================
// 3. HANDLE SEND/ACCEPT ACTIONS
// ==========================================
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {

    // Send Interest
    if ($_POST['action'] == 'send_interest') {
        $receiver_id = mysqli_real_escape_string($con, $_POST['receiver_id']);
        $date = date('Y-m-d H:i:s');

        $check_dup = "SELECT * FROM expressinterest WHERE ei_sender = '$userid' AND ei_receiver = '$receiver_id'";
        if (mysqli_num_rows(mysqli_query($con, $check_dup)) == 0) {
            $insert_sql = "INSERT INTO expressinterest (ei_sender, ei_receiver, ei_date, ei_status) VALUES ('$userid', '$receiver_id', '$date', 'pending')";
            mysqli_query($con, $insert_sql);
            echo "<script>alert('Interest Sent Successfully!'); window.location.href=window.location.href;</script>";
        }
    }

    // Accept Interest
    if ($_POST['action'] == 'accept') {
        $req_id = mysqli_real_escape_string($con, $_POST['req_id']);
        $update_sql = "UPDATE expressinterest SET ei_status = 'accept' WHERE id = '$req_id' AND ei_receiver = '$userid'";
        mysqli_query($con, $update_sql);
        echo "<script>alert('Request Accepted!'); window.location.href=window.location.href;</script>";
    }
}

// ==========================================
// 4. PREPARE PAGINATION & SORTING
// ==========================================
$results_per_page = 4; // Consistent limit for pagination
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$lower_limit = ($page - 1) * $results_per_page;

$sort = 'DESC'; // Default
if (isset($_GET['sort']) && $_GET['sort'] == 'asc') {
    $sort = 'ASC';
}
// ==========================================
// 5. BUILD DYNAMIC SEARCH QUERY (NEW ADDITION)
// ==========================================

// Start with basic conditions (Active, Not Me, Opposite Gender, Not Blocked)
$conditions = [];
$conditions[] = "r.userid != '$userid'";
$conditions[] = "r.gender != '$gender'";
$conditions[] = "r.delete_status != 'delete'";
$conditions[] = "r.firstapprove = '1'";
$conditions[] = "r.profilestatus = '1'";
$conditions[] = "blk_me.id IS NULL"; // They didn't block me
$conditions[] = "rpt_me.id IS NULL"; // They didn't report me

// --- SMART FILTERS (Only apply if user selected them) ---

// 1. AGE Check
if (!empty($_POST['agefrom']) && !empty($_POST['ageto'])) {
    $ageFrom = mysqli_real_escape_string($con, $_POST['agefrom']);
    $ageTo = mysqli_real_escape_string($con, $_POST['ageto']);
    $conditions[] = "b.age BETWEEN '$ageFrom' AND '$ageTo'";
}

// 2. HEIGHT Check (String comparison - requires formatted data in DB)
if (!empty($_POST['heightfrom']) && !empty($_POST['heightto'])) {
    $hFrom = mysqli_real_escape_string($con, $_POST['heightfrom']);
    $hTo = mysqli_real_escape_string($con, $_POST['heightto']);
    // Note: Comparing height strings like "5 Feet" works but isn't perfect. 
    // Ideally, store height in CM for accurate range search.
    $conditions[] = "b.height >= '$hFrom' AND b.height <= '$hTo'";
}

// 3. MARITAL STATUS (Array)
if (!empty($_POST['maritalstatus'])) {
    $marital_list = implode("','", $_POST['maritalstatus']); // Create 'Single','Divorced'
    $conditions[] = "b.marital IN ('$marital_list')";
}

// 4. RELIGION (Array)
if (!empty($_POST['religion'])) {
    $rel_list = implode("','", $_POST['religion']);
    $conditions[] = "rel.religion IN ('$rel_list')";
}

// 5. CASTE (Array)
if (!empty($_POST['caste'])) {
    $caste_list = implode("','", $_POST['caste']);
    $conditions[] = "rel.caste IN ('$caste_list')";
}

// 6. EDUCATION (Array)
if (!empty($_POST['education'])) {
    $edu_list = implode("','", $_POST['education']);
    $conditions[] = "edu.education IN ('$edu_list')";
}

// 7. CITY (Array)
if (!empty($_POST['city'])) {
    $city_list = implode("','", $_POST['city']);
    $conditions[] = "loc.city IN ('$city_list')";
}

// 8. STATE (Array)
if (!empty($_POST['state'])) {
    $state_list = implode("','", $_POST['state']);
    $conditions[] = "loc.state IN ('$state_list')";
}

// 9. COUNTRY (Array)
if (!empty($_POST['country'])) {
    $country_list = implode("','", $_POST['country']);
    $conditions[] = "loc.country IN ('$country_list')";
}

// Combine all conditions with AND
$sql_where_clause = implode(' AND ', $conditions);

// ==========================================
// 6. COUNT TOTAL RESULTS (For Pagination)
// ==========================================
// We must update the Count query to respect the filters too!
$sqlcountregis = "
    SELECT COUNT(DISTINCT r.id) as total
    FROM registration r
    LEFT JOIN basic_info b ON r.userid = b.userid
    LEFT JOIN religious_info rel ON r.userid = rel.userid
    LEFT JOIN education_info edu ON r.userid = edu.userid
    LEFT JOIN groom_location loc ON r.userid = loc.userid
    LEFT JOIN block_ids blk_me ON (blk_me.by_whom = r.userid AND blk_me.for_who = '$userid')
    LEFT JOIN report_ids rpt_me ON (rpt_me.by_who = r.userid AND rpt_me.against = '$userid')
    WHERE $sql_where_clause
";
$resultcountregis = mysqli_query($con, $sqlcountregis);
$rowcount = mysqli_fetch_assoc($resultcountregis);
$countregis = $rowcount['total'];


?>

<style>
    /* Custom Send Interest Button */
    .btn-send-interest {
        background-color: #fdfdfdff;
        /* White Background */
        color: #000000;
        /* Black Text */
        border: 1px solid rgb(51, 51, 51);
        ;
        /* Maroon Border */
        padding: 5px 10px;
        /* Proper Size */
        font-size: 13px;
        font-weight: 400;
        border-radius: 30px;
        /* Rounded Pill Shape */
        transition: all 0.3s ease;
        /* Smooth Animation */
        text-transform: capitalize;
        cursor: pointer;
        margin-right: 5px;
    }

    /* Hover State */
    .btn-send-interest:hover {
        background-color: rgb(212, 20, 116);
        /* Maroon Background */
        color: #ffffff;
        /* White Text */
        border-color: rgb(212, 20, 116);
    }

    /* Status Badges */
    .badge-status {
        padding: 6px 15px;
        border-radius: 30px;
        font-size: 13px;
        font-weight: 400;
        display: inline-block;
        margin-right: 5px;
    }

    .status-sent {
        background-color: #e2e6ea;
        color: #555;
        border: 1px solid #ccc;
    }

    .status-connected {
        background-color: #28a745;
        color: white;
    }

    .status-declined {
        background-color: #dc3545;
        color: white;
    }

    /* Link Container Fix */
    .links form {
        display: inline-block;
    }

    /* --- Status Badges CSS --- */
    .pro-info-status {
        display: flex;
        gap: 10px;
        align-items: center;
        flex-wrap: wrap;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
        line-height: 1;
    }

    /* Verified theme */
    .status-badge.verified {
        background: rgba(40, 167, 69, 0.15);
        color: #28a745;
        padding-top: 5px;
    }

    /* Blocked theme */
    .status-badge.blocked {
        background: rgba(220, 53, 69, 0.15);
        color: #dc3545;
        padding-top: 5px;
    }

    /* Reported theme */
    .status-badge.reported {
        background: rgba(255, 193, 7, 0.15);
        color: #d39e00;
        padding-top: 5px;
    }

    .status-badge i {
        font-size: 13px;
    }

    @media(max-width:576px) {
        .status-badge {
            font-size: 12px;
            padding: 5px 10px;
        }
    }
</style>

<section>
    <div class="all-pro-head">
        <div class="container">
            <div class="row">
                <h1>All Profiles</h1>
            </div>
        </div>
    </div>
    <div class="fil-mob fil-mob-act">
        <h4>Profile filters <i class="fa fa-filter" aria-hidden="true"></i> </h4>
    </div>
</section>

<section>
    <div class="all-weddpro all-jobs all-serexp chosenini">
        <div class="container">
            <div class="row">
                <div class="col-md-3 fil-mob-view">
                    <span class="filter-clo">+</span>
                    <?php include 'filter-sidebar.php'; ?>
                </div>

                <div class="col-md-9">
                    <div class="short-all">
                        <div class="short-lhs">
                            Showing <b><?php echo $countregis; ?></b> profiles
                        </div>
                        <div class="short-rhs">
                            <ul>
                                <li>Sort by:</li>
                                <li>
                                    <div class="form-group oldnew">
                                        <select class="chosen-select p-2" id="sortby" onchange="window.location.href='matches-allprofiles.php?sort='+this.value">
                                            <option value="desc" <?php if ($_GET['sort'] == 'desc') echo "selected"; ?>>Date listed: Newest</option>
                                            <option value="asc" <?php if ($_GET['sort'] == 'asc') echo "selected"; ?>>Date listed: Oldest</option>
                                        </select>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="all-list-sh">
                        <ul>
                            <?php
                            // ==========================================
                            // 5. RUN OPTIMIZED QUERY
                            // ==========================================
                            // ==========================================
// 7. RUN MAIN QUERY
// ==========================================
$sqlinfo = "
    SELECT 
        r.id as reg_id, r.userid, r.verificationinfo, r.contact_privacy, r.whatsapp_privacy,
        b.fullname, b.age, b.height, b.marital,
        rel.religion, rel.caste,
        edu.education, edu.designation,
        loc.city, loc.state,
        p.profilepic, p.photo1, p.photo2, p.photo3,
        MAX(ei_out.ei_status) as outgoing_status,
        MAX(ei_out.id) as outgoing_id,
        MAX(ei_in.ei_status) as incoming_status,
        MAX(ei_in.id) as incoming_id,
        MAX(blk.id) as is_blocked,
        MAX(sh.id) as is_shortlisted,
        MAX(rpt.id) as is_reported
    FROM registration r
    LEFT JOIN basic_info b ON r.userid = b.userid
    LEFT JOIN religious_info rel ON r.userid = rel.userid
    LEFT JOIN education_info edu ON r.userid = edu.userid
    LEFT JOIN groom_location loc ON r.userid = loc.userid
    LEFT JOIN photos_info p ON r.userid = p.userid
    
    LEFT JOIN expressinterest ei_out ON (ei_out.ei_sender = '$userid' AND ei_out.ei_receiver = r.userid)
    LEFT JOIN expressinterest ei_in ON (ei_in.ei_sender = r.userid AND ei_in.ei_receiver = '$userid')
    LEFT JOIN block_ids blk ON (blk.by_whom = '$userid' AND blk.for_who = r.userid)
    LEFT JOIN shortlist_ids sh ON (sh.by_whom = '$userid' AND sh.for_who = r.userid)
    LEFT JOIN report_ids rpt ON (rpt.by_who = '$userid' AND rpt.against = r.userid)
    LEFT JOIN block_ids blk_me ON (blk_me.by_whom = r.userid AND blk_me.for_who = '$userid')
    LEFT JOIN report_ids rpt_me ON (rpt_me.by_who = r.userid AND rpt_me.against = '$userid')

    WHERE $sql_where_clause
    
    GROUP BY r.id
    ORDER BY r.id $sort 
    LIMIT $lower_limit, $results_per_page
";

$resultinfo = mysqli_query($con, $sqlinfo);

                            if (mysqli_num_rows($resultinfo) > 0) {
                                while ($rowinfo = mysqli_fetch_assoc($resultinfo)) {
                                    $profileid = $rowinfo['userid'];

                                    // Blocked Style Logic
                                    $blocked_style = "";
                                    if (!empty($rowinfo['is_blocked'])) {
                                        $blocked_style = 'style="background-color: red !important; color: white !important; border-color: red !important; pointer-events: none; cursor: not-allowed; opacity: 0.7;"';
                                    }

                                    // Image Logic
                                    $prof_pic = !empty($rowinfo['profilepic']) ? "userphoto/" . $rowinfo['profilepic'] : "images/gif/not-found.gif";
                            ?>
                                    <li>
                                        <div class="all-pro-box user-avil-onli">

                                            <div class="pro-img">
                                                <div class="slid-inn pr-bio-c wedd-rel-pro sliderarrow m-0">
                                                    <ul class="slider5">
                                                        <li>
                                                            <div class="wedd-rel-box">
                                                                <div class="wedd-rel-img"><img src="<?php echo $prof_pic; ?>" alt=""></div>
                                                            </div>
                                                        </li>
                                                        <?php if (!empty($rowinfo['photo1'])) { ?><li>
                                                                <div class="wedd-rel-box">
                                                                    <div class="wedd-rel-img"><img src="userphoto/<?php echo $rowinfo['photo1']; ?>" alt=""></div>
                                                                </div>
                                                            </li><?php } ?>
                                                        <?php if (!empty($rowinfo['photo2'])) { ?><li>
                                                                <div class="wedd-rel-box">
                                                                    <div class="wedd-rel-img"><img src="userphoto/<?php echo $rowinfo['photo2']; ?>" alt=""></div>
                                                                </div>
                                                            </li><?php } ?>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="pro-detail">
                                                <h4><a href="user-profile-details.php?uid=<?php echo $profileid; ?>"><?php echo $rowinfo['fullname']; ?></a></h4>
                                                <div>
                                                    <?php echo $profileid; ?>
                                                </div>

                                                <div class="pro-info-status mb-2">
                                                    <?php if ($rowinfo['verificationinfo'] == '1') { ?>
                                                        <span class="status-badge verified">
                                                            <i class="fa fa-check-circle"></i> ID Verified
                                                        </span>
                                                    <?php } ?>

                                                    <?php if (!empty($rowinfo['is_blocked'])) { ?>
                                                        <span class="status-badge blocked">
                                                            <i class="fa fa-ban"></i> Blocked
                                                        </span>
                                                    <?php } ?>

                                                    <?php if (!empty($rowinfo['is_reported'])) { ?>
                                                        <span class="status-badge reported">
                                                            <i class="fa fa-exclamation-triangle"></i> Reported
                                                        </span>
                                                    <?php } ?>
                                                </div>

                                                <div class="pro-bio m-0 b-0 pb-1">
                                                    <span><?php echo $rowinfo['age']; ?> Yrs</span>
                                                    <span><?php echo $rowinfo['height']; ?></span>
                                                    <span><?php echo $rowinfo['marital']; ?></span>
                                                    <span><?php echo $rowinfo['religion'] . ', ' . $rowinfo['caste']; ?></span>
                                                </div>
                                                <div class="pro-bio m-0 pt-0">
                                                    <span><?php echo $rowinfo['education']; ?></span>
                                                    <span><?php echo $rowinfo['designation']; ?></span>
                                                    <span><?php echo $rowinfo['city'] . ', ' . $rowinfo['state']; ?></span>
                                                </div>

                                                <div class="links">
                                                    <a href="user-profile-details.php?uid=<?php echo $profileid; ?>">Profile</a>

                                                    <?php
                                                    // Logic: Check Incoming -> Then Outgoing -> Then Default
                                                    if (!empty($rowinfo['incoming_status'])) {
                                                        if ($rowinfo['incoming_status'] == 'pending') { ?>
                                                            <form method="POST">
                                                                <input type="hidden" name="req_id" value="<?php echo $rowinfo['incoming_id']; ?>">
                                                                <input type="hidden" name="action" value="accept">
                                                                <button class="btn btn-success btn-sm" style="border-radius:30px; padding: 6px 20px;">Accept</button>
                                                            </form>
                                                        <?php } elseif ($rowinfo['incoming_status'] == 'accept') {
                                                            echo '<span class="badge-status status-connected">Connected</span>';
                                                        }
                                                    } elseif (!empty($rowinfo['outgoing_status'])) {
                                                        if ($rowinfo['outgoing_status'] == 'pending') {
                                                            echo '<span class="badge-status status-sent">Sent</span>';
                                                        } elseif ($rowinfo['outgoing_status'] == 'accept') {
                                                            echo '<span class="badge-status status-connected">Accepted</span>';
                                                        } elseif ($rowinfo['outgoing_status'] == 'decline') {
                                                            echo '<span class="badge-status status-declined">Declined</span>';
                                                        }
                                                    } else {
                                                        if ($rowinfo['contact_privacy'] == 'Hide from All') {
                                                        ?>
                                                            <form method="POST">
                                                                <input type="hidden" name="receiver_id" value="<?php echo $profileid; ?>">
                                                                <input type="hidden" name="action" value="send_interest">
                                                                <button class="btn-send-interest">Send</button>
                                                            </form>
                                                    <?php
                                                        } else {
                                                            // Show 'View' or 'Send' for 'Show to All' profiles too?
                                                            // Currently keeping original behavior (Nothing shows) 
                                                            // unless you want me to add a button here too.
                                                        }
                                                    }
                                                    ?>

                                                    <?php if ($rowinfo['is_shortlisted']) { ?>
                                                        <a href="#" class="bg-success text-white shortlist" <?php echo $blocked_style; ?>>Shortlisted</a>
                                                    <?php } else { ?>
                                                        <a href="insert-shortlisted.php?uid=<?php echo $profileid; ?>" <?php echo $blocked_style; ?>>Shortlist</a>
                                                    <?php } ?>

                                                    <?php
                                                    // HIDE WHATSAPP if Privacy is Hidden
                                                    if ($rowinfo['whatsapp_privacy'] != 'hide') {
                                                    ?>
                                                        <a href="https://api.whatsapp.com/send?text=Check out this profile: https://myptetest.com/desirishta/user-profile-details.php?uid=<?php echo $profileid; ?>" target="_blank" <?php echo $blocked_style; ?>>WhatsApp</a>
                                                    <?php } ?>

                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-outline-secondary blockreport" data-bs-toggle="dropdown">
                                                            <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <?php if (empty($rowinfo['is_blocked']) && empty($rowinfo['is_shortlisted'])) { ?>
                                                                <li><a class="dropdown-item" href="insert-blockprofile.php?uid=<?php echo $profileid; ?>">Block</a></li>
                                                            <?php } ?>
                                                            <li><a class="dropdown-item" href="matches-reportid.php?uid=<?php echo $profileid; ?>">Report</a></li>
                                                        </ul>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </li>
                            <?php
                                }
                            } else {
                                echo "<li><div class='all-pro-box'><h4 class='text-center p-4'>No profiles found.</h4></div></li>";
                            }
                            ?>
                        </ul>
                    </div>

                    <div class="page-nation">
                        <ul class="pagination pagination-sm" style="justify-content: center;">
                            <?php
                            $total_pages = ceil($countregis / $results_per_page);

                            // Prev Button
                            if ($page > 1) {
                                echo '<li class="page-item"><a class="page-link" href="matches-allprofiles.php?page=' . ($page - 1) . '&sort=' . $_GET['sort'] . '">Previous</a></li>';
                            }

                            // Page Numbers
                            for ($i = 1; $i <= $total_pages; $i++) {
                                $active = ($page == $i) ? 'active' : '';
                                echo '<li class="page-item ' . $active . '"><a class="page-link" href="matches-allprofiles.php?page=' . $i . '&sort=' . $_GET['sort'] . '">' . $i . '</a></li>';
                            }

                            // Next Button
                            if ($page < $total_pages) {
                                echo '<li class="page-item"><a class="page-link" href="matches-allprofiles.php?page=' . ($page + 1) . '&sort=' . $_GET['sort'] . '">Next</a></li>';
                            }
                            ?>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
</section>
<style>
    .db-inte-prof-list ul li {
        list-style-type: none;
        border-bottom: 0px solid rgba(231, 231, 231, 0);
        position: relative;
        overflow: hidden;
        padding: 0px 0px;
        margin-bottom: 40px;
    }
</style>
<?php
include 'footer.php';
?>