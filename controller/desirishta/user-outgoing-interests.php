<?php
include 'header.php';
include 'config.php';

// 1. Auth Check
$userid = $_COOKIE['dr_userid'];
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

$gender = $_COOKIE['dr_gender'];

// =========================================================
// 3. HANDLE ACTIONS (Send / Cancel)
// =========================================================
$msg = "";
$msg_type = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    
    // SEND REQUEST (From All Profiles Tab)
    if ($_POST['action'] == 'send_interest') {
        $receiver_id = mysqli_real_escape_string($con, $_POST['receiver_id']);
        $date = date('Y-m-d H:i:s');
        
        // Check if duplicate
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

    // CANCEL REQUEST (From Pending Tab)
    if ($_POST['action'] == 'cancel_request') {
        $req_id = mysqli_real_escape_string($con, $_POST['req_id']);
        
        // Security: Ensure I am the SENDER
        $check_sql = "SELECT * FROM expressinterest WHERE id = '$req_id' AND ei_sender = '$userid'";
        if(mysqli_num_rows(mysqli_query($con, $check_sql)) > 0) {
            $del_sql = "DELETE FROM expressinterest WHERE id = '$req_id'";
            if(mysqli_query($con, $del_sql)) {
                $msg = "Request cancelled successfully.";
                $msg_type = "warning";
            } else {
                $msg = "Error cancelling request.";
                $msg_type = "danger";
            }
        }
    }
    
    // ACCEPT/DECLINE (If acting on an Incoming Request via All Profiles Tab)
    if ($_POST['action'] == 'accept' || $_POST['action'] == 'decline') {
        $req_id = mysqli_real_escape_string($con, $_POST['req_id']);
        $action = mysqli_real_escape_string($con, $_POST['action']);
        
        $update_sql = "UPDATE expressinterest SET ei_status = '$action' WHERE id = '$req_id' AND ei_receiver = '$userid'";
        if (mysqli_query($con, $update_sql)) {
            $msg = "Request " . $action . "ed successfully!";
            $msg_type = "success";
        }
    }
}

// =========================================================
// 4. FETCH DATA FOR OUTGOING TABS (SENDER = ME)
// =========================================================
$sql_outgoing = "SELECT * FROM expressinterest WHERE ei_sender = '$userid' ORDER BY id DESC";
$result_outgoing = mysqli_query($con, $sql_outgoing);

$pending_list = [];
$accepted_list = [];
$declined_list = [];

if ($result_outgoing) {
    while($row = mysqli_fetch_assoc($result_outgoing)) {
        if($row['ei_status'] == 'accept') $accepted_list[] = $row;
        elseif($row['ei_status'] == 'pending') $pending_list[] = $row;
        elseif($row['ei_status'] == 'decline') $declined_list[] = $row;
    }
}

$cnt_acc = count($accepted_list);
$cnt_pen = count($pending_list);
$cnt_dec = count($declined_list);


// =========================================================
// 5. FETCH DATA FOR "ALL PROFILES" TAB
// =========================================================
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$lower_page = ($page - 1);
$lower_limit = $lower_page * 3; 

$sort = isset($_GET['sort']) ? $_GET['sort'] : 'desc';
$sort_query = ($sort == 'asc') ? 'ASC' : 'DESC';

$sqlcountregis = "SELECT * FROM registration WHERE userid != '$userid' AND gender != '$gender' AND delete_status != 'delete' AND firstapprove = '1'";
$resultcountregis = mysqli_query($con, $sqlcountregis);
$countregis = mysqli_num_rows($resultcountregis);

$sql_all_profiles = "SELECT * FROM registration WHERE userid != '$userid' AND gender != '$gender' AND delete_status != 'delete' AND firstapprove = '1' ORDER BY id $sort_query LIMIT $lower_limit, 4";
$result_all_profiles = mysqli_query($con, $sql_all_profiles);


// =========================================================
// 6. HELPER FUNCTIONS
// =========================================================

// A. RENDER OUTGOING CARD (Showing person I SENT TO)
function renderOutgoingCard($con, $request_row) {
    $partner_id = $request_row['ei_receiver']; // RECEIVER is the partner
    $req_id = $request_row['id'];
    $date = date('d M, Y', strtotime($request_row['ei_date']));
    
    $basic = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM basic_info WHERE userid = '$partner_id'"));
    $photo_row = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM photos_info WHERE userid = '$partner_id'"));
    $prof_pic = (!empty($photo_row['profilepic'])) ? "userphoto/".$photo_row['profilepic'] : 'images/gif/not-found.gif';
    $fullname = isset($basic['fullname']) ? $basic['fullname'] : $partner_id;

   echo '<li>
        <div class="db-int-pro-1"> 
            <img src="'.$prof_pic.'" alt=""> 
        </div>
        <div class="db-int-pro-2">
            <h5>'.$fullname.'</h5>
            <span class="badge text-dark mb-2">'.$partner_id.'</span>';

            // ====== FETCH ALL DETAILS FOR BULLET LIST ======
            $rel   = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM religious_info WHERE userid = '$partner_id'"));
            $edu   = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM education_info WHERE userid = '$partner_id'"));
            $loc   = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM groom_location WHERE userid = '$partner_id'"));

            $age      = $basic['age'] . " Yrs";
            $height   = $basic['height'];
            $marital  = $basic['marital'];
            $religion = $rel['religion'];
            $caste    = $rel['caste'];
            $edu_h    = $edu['education'];
            $desig    = $edu['designation'];
            $city     = $loc['city'];
            $state    = $loc['state'];
            $country  = $loc['country'];
            $creator  = $basic['createby'];

            // ====== PRINT BULLET POINT DETAILS ======
 echo '
<ul style="margin:0; padding-left:18px; margin-top:15px; margin-bottom:15px; list-style:disc;">

    <ol style="font-size:13px;">
        <b>Age:</b> '.$age.' &nbsp;•
        <b>Height:</b> '.$height.' &nbsp;•
        <b>Marital Status:</b> '.$marital.'
        <b>Religion:</b> '.$religion.' &nbsp;•
        <b>Caste:</b> '.$caste.'
    </ol>
    <ol style="font-size:13px;">
        <b>Profile Created by:</b> '.$creator.' &nbsp;•
        <b>Sent:</b> '.$date.'
    </ol>

</ul>



            <a href="user-profile-details.php?uid='.$partner_id.'" class="cta-5" target="_blank">View Profile</a>
        </div>
        <div class="db-int-pro-3">';

                
    if($request_row['ei_status'] == 'pending') {
        echo '<button class="btn btn-secondary btn-sm w-100 mb-2" disabled>Request Sent</button>
              <form method="POST" style="display:inline;" onsubmit="return confirm(\'Cancel this request?\');">
                <input type="hidden" name="req_id" value="'.$req_id.'">
                <input type="hidden" name="action" value="cancel_request">
                <button class="btn btn-outline-danger btn-sm w-100">Cancel Request</button>
              </form>';
    } elseif($request_row['ei_status'] == 'accept') {
        echo '<span class="badge  mb-2 w-100" style="    color: #ffffff;
    border: 1px solid green;
    padding: 10px 10px;
    background: green;
    font-size: 14px;
    font-weight: 400;">Accepted</span>
              <a href="user-profile-details.php?uid='.$partner_id.'#contact" class="btn btn-outline-success btn-sm w-100">View Contact</a>';
    } else {
        echo '<span class="badge bg-danger w-100">Declined</span>';
    }
    echo '</div></li>';
}

// B. RENDER MATCH CARD (Same as Incoming Page for Consistency)
function renderMatchCard($con, $rowinfo, $my_userid) {
    $profileid = $rowinfo['userid'];
    
    $basic = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM basic_info WHERE userid = '$profileid'"));
    $rel = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM religious_info WHERE userid = '$profileid'"));
    $edu = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM education_info WHERE userid = '$profileid'"));
    $loc = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM groom_location WHERE userid = '$profileid'"));
    $photo = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM photos_info WHERE userid = '$profileid'"));
    
    // Check Status
    $sql_in = "SELECT * FROM expressinterest WHERE ei_sender = '$profileid' AND ei_receiver = '$my_userid' ORDER BY id DESC LIMIT 1";
    $incoming = mysqli_fetch_assoc(mysqli_query($con, $sql_in));
    
    $sql_out = "SELECT * FROM expressinterest WHERE ei_sender = '$my_userid' AND ei_receiver = '$profileid' ORDER BY id DESC LIMIT 1";
    $outgoing = mysqli_fetch_assoc(mysqli_query($con, $sql_out));

    $prof_pic = (!empty($photo['profilepic'])) ? "userphoto/".$photo['profilepic'] : 'images/gif/not-found.gif';
    
    // Formatting
    $age = isset($basic['age']) ? $basic['age'] . ' Yrs' : '';
    $height = isset($basic['height']) ? $basic['height'] : '';
    $marital = isset($basic['marital']) ? $basic['marital'] : '';
    $religion_caste = (isset($rel['religion']) ? $rel['religion'] : '') . ', ' . (isset($rel['caste']) ? $rel['caste'] : '');
    $education = isset($edu['education']) ? $edu['education'] : '';
    $designation = isset($edu['designation']) ? $edu['designation'] : '';
    $location = (isset($loc['city']) ? $loc['city'] : '') . ', ' . (isset($loc['state']) ? $loc['state'] : '') . ', ' . (isset($loc['country']) ? $loc['country'] : '');
    $created_by = isset($basic['createby']) ? $basic['createby'] : '';

    ?>
    <li>
        <div class="all-pro-box">
            <div class="pro-img">
                <a href="user-profile-details.php?uid=<?php echo $profileid; ?>">
                    <img src="<?php echo $prof_pic; ?>" alt="" style="width:100%; height:100%; object-fit:cover;">
                </a>
            </div>
            <div class="pro-detail">
                <h4><a href="user-profile-details.php?uid=<?php echo $profileid; ?>"><?php echo isset($basic['fullname']) ? $basic['fullname'] : $profileid; ?></a></h4>
                
                <div style="margin-bottom: 8px;">
                    <span style="background-color: #ffeb3b; color: #000; padding: 2px 8px; font-weight: bold; border-radius: 4px; font-size: 13px;">
                        <?php echo $profileid; ?>
                    </span>
                </div>

                <div style="border: 1px solid #ffcccc; background-color: #fff5f5; padding: 10px; border-radius: 5px; margin-bottom: 10px;">
                    <div style="color: #d9534f; font-weight: 600; font-size: 14px; margin-bottom: 4px;">
                        <?php echo "$age, $height, $marital, ($religion_caste)"; ?>
                    </div>
                    <div style="color: #555; font-size: 13px;">
                        <?php echo "$education, $designation"; ?><br>
                        <?php echo "$location"; ?><br>
                        Profile Created by: <strong><?php echo $created_by; ?></strong>
                    </div>
                </div>

                <div class="links">
                    <?php
                    if ($incoming) {
                        if ($incoming['ei_status'] == 'pending') {
                            ?>
                            <form method="POST" style="display:inline-block;">
                                <input type="hidden" name="req_id" value="<?php echo $incoming['id']; ?>">
                                <input type="hidden" name="action" value="accept">
                                <button class="btn btn-success btn-sm">Accept</button>
                            </form>
                            <?php
                        } elseif ($incoming['ei_status'] == 'accept') {
                            echo '<span class="badge bg-success">Connected</span>';
                        }
                    } elseif ($outgoing) {
                        if ($outgoing['ei_status'] == 'pending') {
                            echo '<button class="btn btn-secondary btn-sm" disabled>Request Sent</button>';
                        } elseif ($outgoing['ei_status'] == 'accept') {
                            echo '<span class="badge bg-success">Accepted</span>';
                        } elseif ($outgoing['ei_status'] == 'decline') {
                            echo '<span class="badge bg-danger">Declined</span>';
                        }
                    } else {
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

$active_tab = 'pending';
if(isset($_GET['tab'])) {
    $active_tab = $_GET['tab'];
} elseif(isset($_GET['page']) || isset($_GET['sort'])) {
    $active_tab = 'allprofiles';
}
?>

<!-- HTML SECTION -->
<section>
    <div class="db">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-lg-3">
                    <?php include 'user-sidebar.php'; ?>
                </div>
                
                <div class="col-md-8 col-lg-8">
                    <div class="row">
                        <div class="col-md-12 db-sec-com">
                            <h2 class="db-tit">Outgoing Interests (Sent)</h2>
                            
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
                                                        foreach($pending_list as $req) { renderOutgoingCard($con, $req); }
                                                    } else { echo "<p class='text-center mt-3'>No pending sent requests.</p>"; }
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
                                                        foreach($accepted_list as $req) { renderOutgoingCard($con, $req); }
                                                    } else { echo "<p class='text-center mt-3'>No sent requests accepted yet.</p>"; }
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
                                                        foreach($declined_list as $req) { renderOutgoingCard($con, $req); }
                                                    } else { echo "<p class='text-center mt-3'>No sent requests declined.</p>"; }
                                                    ?>
                                                </ul>
                                            </div>
                                        </div>

                                        <!-- ALL PROFILES TAB -->
                                        <div id="allprofiles" class="container tab-pane <?php if($active_tab=='allprofiles') echo 'active'; ?>"><br>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <?php include 'filter-sidebar.php'; ?>
                                                </div>
                                                
                                                <div class="col-md-8">
                                                    <div class="short-all mb-3">
                                                        <div class="short-lhs">
                                                            Showing <b><?php echo $countregis; ?></b> profiles
                                                        </div>
                                                        <div class="short-rhs">
                                                            <form method="GET" action="user-outgoing-interests.php" style="display:inline;">
                                                                <input type="hidden" name="tab" value="allprofiles">
                                                                <select name="sort" class="form-select form-select-sm" onchange="this.form.submit()">
                                                                    <option value="">Sort by</option>
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
                                                                echo "<div class='text-center'>No profiles found.</div>";
                                                            }
                                                            ?>
                                                        </ul>
                                                    </div>

                                                    <!-- PAGINATION -->
                                                    <div class="page-nation mt-4 text-center" style=" padding-left: 33px;">
                                                        <ul class="pagination pagination-sm justify-content-center">
                                                            <?php
                                                            $total_page = ceil($countregis/3);
                                                            if($page > 1) {
                                                                echo '<li class="page-item"><a class="page-link" href="user-outgoing-interests.php?tab=allprofiles&page='.($page-1).'&sort='.$sort.'">Previous</a></li>';
                                                            }
                                                            for($i=1; $i<=$total_page; $i++) {
                                                                $active = ($page == $i) ? 'active' : '';
                                                                echo '<li class="page-item '.$active.'"><a class="page-link" href="user-outgoing-interests.php?tab=allprofiles&page='.$i.'&sort='.$sort.'">'.$i.'</a></li>';
                                                            }
                                                            if($total_page > $page) {
                                                                echo '<li class="page-item"><a class="page-link" href="user-outgoing-interests.php?tab=allprofiles&page='.($page+1).'&sort='.$sort.'">Next</a></li>';
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
<style>
    .db-inte-prof-list ul li {
    list-style-type: none;
    border-bottom: 0px solid rgba(231, 231, 231, 0);
    position: relative;
    overflow: hidden;
    padding: 20px 0px;
}
.db-inte-prof-list ul li:first-child {
    padding-top: 0;
    margin-bottom: 15px;
    /* border-bottom: 1px solid #ffcccc; */
    padding-bottom: 10px;
}
ol, ul {
    padding-left: 0rem;
}

</style>

<?php
include 'footer.php';
?>