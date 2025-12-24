<?php
include 'header.php';
include 'config.php';

// 1. Auth Check
$userid = $_COOKIE['dr_userid'];
if($userid == '') {
    header('location:login.php');
    exit;
}

// 2. Verification Check (As per your snippet)
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

$gender = $_COOKIE['dr_gender'];

// =========================================================
// 3. HANDLE REQUESTS (Accept / Decline / Send) - LOGIC
// =========================================================
$msg = "";
$msg_type = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    
    // ACCEPT OR DECLINE
    if ($_POST['action'] == 'accept' || $_POST['action'] == 'decline') {
        $req_id = mysqli_real_escape_string($con, $_POST['req_id']);
        $action = mysqli_real_escape_string($con, $_POST['action']);
        
        $check_sql = "SELECT * FROM expressinterest WHERE id = '$req_id' AND ei_receiver = '$userid'";
        $check_res = mysqli_query($con, $check_sql);
        
        if (mysqli_num_rows($check_res) > 0) {
            $update_sql = "UPDATE expressinterest SET ei_status = '$action' WHERE id = '$req_id'";
            if (mysqli_query($con, $update_sql)) {
                $msg = "Request " . $action . "ed successfully!";
                $msg_type = "success";
            } else {
                $msg = "Error: " . mysqli_error($con);
                $msg_type = "danger";
            }
        }
    }
    
    // SEND REQUEST (For All Profiles Tab)
    if ($_POST['action'] == 'send_interest') {
        $receiver_id = mysqli_real_escape_string($con, $_POST['receiver_id']);
        $date = date('Y-m-d H:i:s');
        
        // Check if already sent
        $check_dup = "SELECT * FROM expressinterest WHERE ei_sender = '$userid' AND ei_receiver = '$receiver_id'";
        $res_dup = mysqli_query($con, $check_dup);
        
        if(mysqli_num_rows($res_dup) == 0) {
            $insert_sql = "INSERT INTO expressinterest (ei_sender, ei_receiver, ei_date, ei_status) VALUES ('$userid', '$receiver_id', '$date', 'pending')";
            if(mysqli_query($con, $insert_sql)) {
                $msg = "Interest sent successfully!";
                $msg_type = "success";
            } else {
                $msg = "Error sending interest.";
                $msg_type = "danger";
            }
        }
    }
}

// =========================================================
// 4. FETCH DATA FOR TABS
// =========================================================

// A. INCOMING REQUESTS
$sql_incoming = "SELECT * FROM expressinterest WHERE ei_receiver = '$userid' ORDER BY id DESC";
$result_incoming = mysqli_query($con, $sql_incoming);

$pending_list = [];
$accepted_list = [];
$declined_list = [];

if ($result_incoming) {
    while($row = mysqli_fetch_assoc($result_incoming)) {
        if($row['ei_status'] == 'accept') $accepted_list[] = $row;
        elseif($row['ei_status'] == 'pending') $pending_list[] = $row;
        elseif($row['ei_status'] == 'decline') $declined_list[] = $row;
    }
}

$cnt_acc = count($accepted_list);
$cnt_pen = count($pending_list);
$cnt_dec = count($declined_list);

// B. ALL PROFILES LOGIC (Pagination & Search)
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$lower_page = ($page - 1);
$lower_limit = $lower_page * 3; // 3 profiles per page as per your snippet

$sort = isset($_GET['sort']) ? $_GET['sort'] : 'desc';
$sort_query = ($sort == 'asc') ? 'ASC' : 'DESC';

// Main Query for All Profiles
$sqlcountregis = "SELECT * FROM registration WHERE userid != '$userid' AND gender != '$gender' AND delete_status != 'delete' AND firstapprove = '1'";
$resultcountregis = mysqli_query($con, $sqlcountregis);
$countregis = mysqli_num_rows($resultcountregis);

$sql_all_profiles = "SELECT * FROM registration WHERE userid != '$userid' AND gender != '$gender' AND delete_status != 'delete' AND firstapprove = '1' ORDER BY id $sort_query LIMIT $lower_limit, 4";
$result_all_profiles = mysqli_query($con, $sql_all_profiles);

// =========================================================
// 5. HELPER FUNCTIONS
// =========================================================

// Render Card for Incoming Requests (Pending/Accept/Decline Tab)
function renderIncomingCard($con, $request_row) {
    $partner_id = $request_row['ei_sender'];
    $req_id = $request_row['id'];
    $date = date('d M, Y', strtotime($request_row['ei_date']));
    
    // Fetch Basic Info
    $basic = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM basic_info WHERE userid = '$partner_id'"));
    $photo_row = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM photos_info WHERE userid = '$partner_id'"));
    $prof_pic = (!empty($photo_row['profilepic'])) ? "userphoto/".$photo_row['profilepic'] : 'images/gif/not-found.gif';
    $fullname = isset($basic['fullname']) ? $basic['fullname'] : $partner_id;

    // Output List Item
    echo '<li>
            <div class="db-int-pro-1"> <img src="'.$prof_pic.'" alt=""> </div>
            <div class="db-int-pro-2">
                <h5>'.$fullname.'</h5>
                <span class="badge  text-dark mb-2">'.$partner_id.'</span>
                <ol class="poi poi-date">
                    <li>Date: '.$date.'</li>
                </ol>
              <a href="user-profile-details.php?uid='.$partner_id.'" 
   class="cta-5" 
   target="_blank"
   style="background:#AD6665 !important;  !important;  color:#fff !important;">
   View Profile
</a>

            </div>
            <div class="db-int-pro-3">';
                
    if($request_row['ei_status'] == 'pending') {
        echo '<form method="POST" style="display:inline;">
                <input type="hidden" name="req_id" value="'.$req_id.'">
                <input type="hidden" name="action" value="accept">
                <button class="btn btn-success btn-sm w-100 mb-2">Accept</button>
              </form>
              <form method="POST" style="display:inline;" onsubmit="return confirm(\'Decline request?\');">
                <input type="hidden" name="req_id" value="'.$req_id.'">
                <input type="hidden" name="action" value="decline">
                <button class="btn btn-outline-danger btn-sm w-100">Decline</button>
              </form>';
    } elseif($request_row['ei_status'] == 'accept') {
        echo '<span class="badge " style="    color: #ffffff;
    border: 1px solid green;
    padding: 10px 10px;
    background: green;
    font-size: 14px;
    font-weight: 400;">Accepted</span>';
    } else {
        echo '<span class="badge bg-secondary">Declined</span>';
    }
    echo '</div></li>';
}

// Render Card for "All Profiles" Tab (Your Custom Design)
function renderMatchCard($con, $rowinfo, $my_userid) {
    $profileid = $rowinfo['userid'];
    
    // 1. Fetch all details
    $basic = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM basic_info WHERE userid = '$profileid'"));
    $rel = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM religious_info WHERE userid = '$profileid'"));
    $edu = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM education_info WHERE userid = '$profileid'"));
    $loc = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM groom_location WHERE userid = '$profileid'"));
    $photo = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM photos_info WHERE userid = '$profileid'"));
    
    // Check Interaction Status
    // A. Did they send me a request?
    $sql_in = "SELECT * FROM expressinterest WHERE ei_sender = '$profileid' AND ei_receiver = '$my_userid' ORDER BY id DESC LIMIT 1";
    $res_in = mysqli_query($con, $sql_in);
    $incoming = mysqli_fetch_assoc($res_in);
    
    // B. Did I send them a request?
    $sql_out = "SELECT * FROM expressinterest WHERE ei_sender = '$my_userid' AND ei_receiver = '$profileid' ORDER BY id DESC LIMIT 1";
    $res_out = mysqli_query($con, $sql_out);
    $outgoing = mysqli_fetch_assoc($res_out);

    // Profile Pic
    $prof_pic = (!empty($photo['profilepic'])) ? "userphoto/".$photo['profilepic'] : 'images/gif/not-found.gif';
    
    // Data Preparation
    $age = $basic['age'] . ' Yrs';
    $height = $basic['height'];
    $marital = $basic['marital'];
    $religion_caste = $rel['religion'] . ', ' . $rel['caste'];
    
    $education = $edu['education'];
    $designation = $edu['designation'];
    $location = $loc['city'] . ', ' . $loc['state'] . ', ' . $loc['country'];
    $created_by = $basic['createby'];

    ?>
    <li>
        <div class="all-pro-box">
            <!-- Image -->
            <div class="pro-img">
                <a href="user-profile-details.php?uid=<?php echo $profileid; ?>">
                    <img src="<?php echo $prof_pic; ?>" alt="" style="width:100%; height:100%; object-fit:cover;">
                </a>
            </div>

            <!-- Details -->
            <div class="pro-detail">
                <!-- Name -->
                <h4><a href="user-profile-details.php?uid=<?php echo $profileid; ?>"><?php echo $basic['fullname']; ?></a></h4>
                
                <!-- Yellow Box ID -->
                <div style="margin-bottom: 8px;">
                    <span style="background-color: #ffeb3b; color: #000; padding: 2px 8px; font-weight: bold; border-radius: 4px; font-size: 13px;">
                        <?php echo $profileid; ?>
                    </span>
                </div>

                <!-- Red Box Details -->
                <div style="border: 1px solid #ffcccc; background-color: #fff5f5; padding: 10px; border-radius: 5px; margin-bottom: 10px;">
                    <!-- Row 1 -->
                    <div style="color: #d9534f; font-weight: 600; font-size: 14px; margin-bottom: 4px;">
                        <?php echo "$age, $height, $marital, ($religion_caste)"; ?>
                    </div>
                    <!-- Row 2 -->
                    <div style="color: #555; font-size: 13px;">
                        <?php echo "$education, $designation"; ?><br>
                        <?php echo "$location"; ?><br>
                        Profile Created by: <strong><?php echo $created_by; ?></strong>
                    </div>
                </div>

                <!-- Action Buttons Logic -->
                <div class="links">
                    <?php
                    if ($incoming) {
                        // They sent me a request
                        if ($incoming['ei_status'] == 'pending') {
                            ?>
                            <form method="POST" style="display:inline-block;">
                                <input type="hidden" name="req_id" value="<?php echo $incoming['id']; ?>">
                                <input type="hidden" name="action" value="accept">
                                <button class="btn btn-success btn-sm">Accept</button>
                            </form>
                            <form method="POST" style="display:inline-block;" onsubmit="return confirm('Decline this request?');">
                                <input type="hidden" name="req_id" value="<?php echo $incoming['id']; ?>">
                                <input type="hidden" name="action" value="decline">
                                <button class="btn btn-danger btn-sm">Decline</button>
                            </form>
                            <?php
                        } elseif ($incoming['ei_status'] == 'accept') {
                            echo '<span class="badge bg-success"><i class="fa fa-check"></i> Connected</span>';
                        } elseif ($incoming['ei_status'] == 'decline') {
                            echo '<span class="badge bg-secondary">Request Declined</span>';
                        }
                    } elseif ($outgoing) {
                        // I sent them a request
                        if ($outgoing['ei_status'] == 'pending') {
                            echo '<button class="btn btn-secondary btn-sm" disabled>Request Sent</button>';
                        } elseif ($outgoing['ei_status'] == 'accept') {
                            echo '<span class="badge bg-success">Request Accepted</span>';
                        } elseif ($outgoing['ei_status'] == 'decline') {
                            echo '<span class="badge bg-danger">Request Declined</span>';
                        }
                    } else {
                        // No interaction yet - Show Send Interest
                        ?>
                        <form method="POST" style="display:inline-block;">
                            <input type="hidden" name="receiver_id" value="<?php echo $profileid; ?>">
                            <input type="hidden" name="action" value="send_interest">
                            <button class="btn btn-primary btn-sm">Send Interest</button>
                        </form>
                        <?php
                    }
                    ?>
                    
                    <a href="user-profile-details.php?uid=<?php echo $profileid; ?>" class="btn btn-info btn-sm text-white">View Profile</a>
                </div>
            </div>
        </div>
    </li>
    <?php
}

// Determine Active Tab
$active_tab = 'pending'; // Default
if(isset($_GET['tab'])) {
    $active_tab = $_GET['tab'];
} elseif(isset($_GET['page']) || isset($_GET['sort'])) {
    $active_tab = 'allprofiles'; // Keep All Profiles active if pagination/sort is used
}
?>

<!-- HTML SECTION -->
<section>
    <div class="db">
        <div class="container">
            <div class="row">
                <!-- User Sidebar -->
                <div class="col-md-4 col-lg-3">
                    <?php include 'user-sidebar.php'; ?>
                </div>
                
                <!-- Main Content -->
                <div class="col-md-8 col-lg-8">
                    <div class="row">
                        <div class="col-md-12 db-sec-com">
                            <h2 class="db-tit">My Activities & Matches</h2>
                            
                            <!-- Messages -->
                            <?php if($msg != "") { ?>
                                <div class="alert alert-<?php echo $msg_type; ?> alert-dismissible fade show">
                                    <?php echo $msg; ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            <?php } ?>

                            <div class="db-pro-stat">
                                <div class="db-inte-main">
                                    
                                    <!-- TABS -->
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link <?php if($active_tab=='pending') echo 'active'; ?>" data-bs-toggle="tab" href="#pending">Pending <span class="badge bg-warning text-dark"><?php echo $cnt_pen; ?></span></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link <?php if($active_tab=='accepted') echo 'active'; ?>" data-bs-toggle="tab" href="#accepted">Accepted <span class="badge bg-success"><?php echo $cnt_acc; ?></span></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link <?php if($active_tab=='declined') echo 'active'; ?>" data-bs-toggle="tab" href="#declined">Declined <span class="badge bg-secondary"><?php echo $cnt_dec; ?></span></a>
                                        </li>
                                        <!-- <li class="nav-item">
                                            <a class="nav-link <?php if($active_tab=='allprofiles') echo 'active'; ?>" data-bs-toggle="tab" href="#allprofiles">All Profiles</a>
                                        </li> -->
                                    </ul>

                                    <!-- TAB CONTENT -->
                                    <div class="tab-content">
                                        
                                        <!-- Pending Tab -->
                                        <div id="pending" class="container tab-pane <?php if($active_tab=='pending') echo 'active'; ?>"><br>
                                            <div class="db-inte-prof-list">
                                                <ul>
                                                    <?php 
                                                    if($cnt_pen > 0) {
                                                        foreach($pending_list as $req) { renderIncomingCard($con, $req); }
                                                    } else { echo "<p class='text-center mt-3'>No pending requests.</p>"; }
                                                    ?>
                                                </ul>
                                            </div>
                                        </div>

                                        <!-- Accepted Tab -->
                                        <div id="accepted" class="container tab-pane <?php if($active_tab=='accepted') echo 'active'; ?>"><br>
                                            <div class="db-inte-prof-list">
                                                <ul>
                                                    <?php 
                                                    if($cnt_acc > 0) {
                                                        foreach($accepted_list as $req) { renderIncomingCard($con, $req); }
                                                    } else { echo "<p class='text-center mt-3'>No accepted requests.</p>"; }
                                                    ?>
                                                </ul>
                                            </div>
                                        </div>

                                        <!-- Declined Tab -->
                                        <div id="declined" class="container tab-pane <?php if($active_tab=='declined') echo 'active'; ?>"><br>
                                            <div class="db-inte-prof-list">
                                                <ul>
                                                    <?php 
                                                    if($cnt_dec > 0) {
                                                        foreach($declined_list as $req) { renderIncomingCard($con, $req); }
                                                    } else { echo "<p class='text-center mt-3'>No declined requests.</p>"; }
                                                    ?>
                                                </ul>
                                            </div>
                                        </div>

                                        <!-- ALL PROFILES TAB (Matches + Actions) -->
                                        <div id="allprofiles" class="container tab-pane <?php if($active_tab=='allprofiles') echo 'active'; ?>"><br>
                                            <div class="row">
                                                <!-- Sidebar Filter (Inside Tab) -->
                                                <div class="col-md-4">
                                                    <?php include 'filter-sidebar.php'; ?>
                                                </div>
                                                
                                                <!-- Profile List -->
                                                <div class="col-md-8">
                                                    <div class="short-all mb-3">
                                                        <div class="short-lhs">
                                                            Showing <b><?php echo $countregis; ?></b> profiles
                                                        </div>
                                                        <div class="short-rhs">
                                                            <!-- Sort Dropdown with Auto-Submit or Link -->
                                                            <form method="GET" action="user-incoming-interests.php" style="display:inline;">
                                                                <input type="hidden" name="tab" value="allprofiles">
                                                                <select name="sort" class="form-select form-select-sm" onchange="this.form.submit()">
                                                                    <option value="desc" <?php if($sort=='desc') echo 'selected'; ?>>Newest First</option>
                                                                    <option value="asc" <?php if($sort=='asc') echo 'selected'; ?>>Oldest First</option>
                                                                </select>
                                                            </form>
                                                        </div>
                                                    </div>

                                                    <div class="all-list-sh">
                                                        <ul>
                                                            <?php
                                                            if(mysqli_num_rows($result_all_profiles) > 0) {
                                                                while($row = mysqli_fetch_assoc($result_all_profiles)) {
                                                                    renderMatchCard($con, $row, $userid);
                                                                }
                                                            } else {
                                                                echo "<div class='text-center'>No profiles found matching criteria.</div>";
                                                            }
                                                            ?>
                                                        </ul>
                                                    </div>

                                             </style>

                                                    <!-- PAGINATION -->
                                                    <div class="page-nation mt-4 text-center" style=" padding-left: 33px;">
                                                        <ul class="pagination pagination-sm justify-content-center">
                                                            <?php
                                                            $total_page = ceil($countregis/4); // Limit is 4 per page
                                                            
                                                            // Previous
                                                            if($page > 1) {
                                                                echo '<li class="page-item"><a class="page-link" href="user-incoming-interests.php?tab=allprofiles&page='.($page-1).'&sort='.$sort.'">Previous</a></li>';
                                                            }

                                                            // Numbers (Simplified)
                                                            for($i=1; $i<=$total_page; $i++) {
                                                                $active = ($page == $i) ? 'active' : '';
                                                                echo '<li class="page-item '.$active.'"><a class="page-link" href="user-incoming-interests.php?tab=allprofiles&page='.$i.'&sort='.$sort.'">'.$i.'</a></li>';
                                                            }

                                                            // Next
                                                            if($total_page > $page) {
                                                                echo '<li class="page-item"><a class="page-link" href="user-incoming-interests.php?tab=allprofiles&page='.($page+1).'&sort='.$sort.'">Next</a></li>';
                                                            }
                                                            ?>
                                                        </ul>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include 'footer.php';
?>