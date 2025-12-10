<?php
include 'header.php';
include 'config.php';

// 1. Auth Check
$userid = $_COOKIE['dr_userid'];
$gender = $_COOKIE['dr_gender'];

if($userid == '') {
    header('location:login.php');
    exit;
}

// 2. Verification Check
$sql_check_auth = "SELECT verificationinfo FROM registration WHERE userid = '$userid'";
$result_check_auth = mysqli_query($con, $sql_check_auth);
$row_check_auth = mysqli_fetch_assoc($result_check_auth);

if($row_check_auth['verificationinfo'] != '1') {
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
        if(mysqli_num_rows(mysqli_query($con, $check_dup)) == 0) {
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
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if($page < 1) $page = 1;
$lower_limit = ($page - 1) * 3;

$sort = 'DESC'; // Default
if(isset($_GET['sort']) && $_GET['sort'] == 'asc') {
    $sort = 'ASC';
}

// Count Total Profiles
$sqlcountregis = "SELECT * FROM registration WHERE userid != '$userid' AND gender != '$gender' AND delete_status != 'delete' AND firstapprove = '1'";
$resultcountregis = mysqli_query($con,$sqlcountregis);
$countregis = mysqli_num_rows($resultcountregis);

?>

<!-- CSS FOR BUTTONS -->
<style>
    /* Custom Send Interest Button */
    .btn-send-interest {
        background-color: #fdfdfdff;      /* White Background */
        color: #000000;                 /* Black Text */
        border: 1px solid rgb(51, 51, 51);;      /* Maroon Border */
        padding: 5px 10px;              /* Proper Size */
        font-size: 13px;
        font-weight: 400;
        border-radius: 30px;            /* Rounded Pill Shape */
        transition: all 0.3s ease;      /* Smooth Animation */
        text-transform: capitalize;
        cursor: pointer;
        margin-right: 5px;
    }

    /* Hover State */
    .btn-send-interest:hover {
        background-color:rgb(212, 20, 116);      /* Maroon Background */
        color: #ffffff;                 /* White Text */
        border-color:rgb(212, 20, 116);
        /* box-shadow: 0 4px 8px rgba(1, 1, 1, 0.2); */
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
    .status-sent { background-color: #e2e6ea; color: #555; border: 1px solid #ccc; }
    .status-connected { background-color: #28a745; color: white; }
    .status-declined { background-color: #dc3545; color: white; }
    
    /* Link Container Fix */
    .links form { display: inline-block; 
    displya:flex;}
</style>

<!-- HTML START -->
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
                                            <option value="desc" <?php if($_GET['sort'] == 'desc') echo "selected"; ?>>Date listed: Newest</option>
                                            <option value="asc" <?php if($_GET['sort'] == 'asc') echo "selected"; ?>>Date listed: Oldest</option>
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
                            // 5. RUN OPTIMIZED QUERY (Inside HTML)
                            // ==========================================
                            $sqlinfo = "
                                SELECT 
                                    r.userid, r.verificationinfo,r.contact_privacy,
                                    b.fullname, b.age, b.height, b.marital,
                                    rel.religion, rel.caste,
                                    edu.education, edu.designation,
                                    loc.city, loc.state,
                                    p.profilepic, p.photo1, p.photo2, p.photo3,
                                    -- Check Outgoing (I Sent)
                                    ei_out.ei_status as outgoing_status,
                                    ei_out.id as outgoing_id,
                                    -- Check Incoming (They Sent)
                                    ei_in.ei_status as incoming_status,
                                    ei_in.id as incoming_id,
                                    -- Check Block/Shortlist
                                    blk.id as is_blocked,
                                    sh.id as is_shortlisted
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
                                WHERE 
                                    r.userid != '$userid' 
                                    AND r.gender != '$gender' 
                                    AND r.delete_status != 'delete' 
                                    AND r.firstapprove = '1'
                                ORDER BY r.id $sort 
                                LIMIT $lower_limit, 4
                            ";
                            
                            $resultinfo = mysqli_query($con, $sqlinfo);

                            if(mysqli_num_rows($resultinfo) > 0) {
                                while($rowinfo = mysqli_fetch_assoc($resultinfo)) {
                                    $profileid = $rowinfo['userid'];
                                    
                                    // Image Logic
                                    $prof_pic = !empty($rowinfo['profilepic']) ? "userphoto/".$rowinfo['profilepic'] : "images/gif/not-found.gif";
                                    ?>
                                    <li>
                                        <div class="all-pro-box user-avil-onli">
                                            
                                            <!-- IMAGES SLIDER -->
                                            <div class="pro-img">
                                                <div class="slid-inn pr-bio-c wedd-rel-pro sliderarrow m-0">
                                                    <ul class="slider5">
                                                        <li><div class="wedd-rel-box"><div class="wedd-rel-img"><img src="<?php echo $prof_pic; ?>" alt=""></div></div></li>
                                                        <?php if(!empty($rowinfo['photo1'])) { ?><li><div class="wedd-rel-box"><div class="wedd-rel-img"><img src="userphoto/<?php echo $rowinfo['photo1']; ?>" alt=""></div></div></li><?php } ?>
                                                        <?php if(!empty($rowinfo['photo2'])) { ?><li><div class="wedd-rel-box"><div class="wedd-rel-img"><img src="userphoto/<?php echo $rowinfo['photo2']; ?>" alt=""></div></div></li><?php } ?>
                                                    </ul>
                                                </div>
                                            </div>

                                            <!-- DETAILS -->
                                            <div class="pro-detail">
                                                <h4><a href="user-profile-details.php?uid=<?php echo $profileid; ?>"><?php echo $rowinfo['fullname']; ?></a></h4>
                                                <div>
                                                    <?php echo $profileid; ?>
                                                    <?php if($rowinfo['is_blocked']) { echo '<span class="text-danger desktop" style="float: right;">You blocked this member</span>'; } ?>
                                                </div>
                                                
                                                <div class="pro-info-status  mb-2">
                                                    <?php if($rowinfo['verificationinfo'] == '1') { ?>
                                                        <span class="stat-6 text-success"><i class="fa fa-shield text-success"></i> ID Verified</span>
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

                                                <!-- ========================== -->
                                                <!-- DYNAMIC ACTION BUTTONS -->
                                                <!-- ========================== -->
                                                <div class="links" >
                                                    <a href="user-profile-details.php?uid=<?php echo $profileid; ?>">Profile</a>
                                                    
                                                    <?php
                                                    // Logic: Check Incoming -> Then Outgoing -> Then Default
                                                    if (!empty($rowinfo['incoming_status'])) {
                                                        // CASE 1: They Sent Me Request
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
                                                        // CASE 2: I Sent Them Request
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
                                                                    }                                                              
                                                                }

                                                    ?>
                                                    
                                                    <!-- Shortlist Button -->
                                                    <?php if($rowinfo['is_shortlisted']) { ?>
                                                        <a href="#" class="bg-success text-white shortlist">Shortlisted</a>
                                                    <?php } else { ?>
                                                        <a href="insert-shortlisted.php?uid=<?php echo $profileid; ?>">Shortlist</a>
                                                    <?php } ?>

                                                    <a href="https://api.whatsapp.com/send?text=Check out this profile: https://myptetest.com/desirishta/user-profile-details.php?uid=<?php echo $profileid; ?>" target="_blank">WhatsApp</a>
                                                    
                                                    <!-- Dropdown for Block/Report -->
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-outline-secondary blockreport" data-bs-toggle="dropdown">
                                                            <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <?php if(!$rowinfo['is_blocked'] && !$rowinfo['is_shortlisted']) { ?>
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

                    <!-- PAGINATION -->
                    <div class="page-nation">
                        <ul class="pagination pagination-sm">
                            <?php
                            $total_pages = ceil($countregis / 3);
                            
                            // Prev Button
                            if($page > 1) {
                                echo '<li class="page-item"><a class="page-link" href="matches-allprofiles.php?page='.($page-1).'&sort='.$_GET['sort'].'">Previous</a></li>';
                            }

                            // Page Numbers
                            for($i=1; $i<=$total_pages; $i++) {
                                $active = ($page == $i) ? 'active' : '';
                                echo '<li class="page-item '.$active.'"><a class="page-link" href="matches-allprofiles.php?page='.$i.'&sort='.$_GET['sort'].'">'.$i.'</a></li>';
                            }

                            // Next Button
                            if($page < $total_pages) {
                                echo '<li class="page-item"><a class="page-link" href="matches-allprofiles.php?page='.($page+1).'&sort='.$_GET['sort'].'">Next</a></li>';
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