<?php
include 'header.php';
include 'config.php';

// --- 1. DATABASE COUNTS LOGIC (Status & Documents) ---

// A. Profile Status Counts
$count_total      = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(id) as count FROM registration"))['count'];
$count_pending    = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(id) as count FROM registration WHERE profilestatus = '0'"))['count'];
$count_approved   = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(id) as count FROM registration WHERE profilestatus = '1'"))['count'];
$count_deactive   = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(id) as count FROM registration WHERE profilestatus = '2'"))['count'];
$count_deleted    = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(id) as count FROM registration WHERE profilestatus = '3'"))['count'];

// B. Document Verification Counts
$doc_pending_sql  = "SELECT COUNT(id) as count FROM registration WHERE document_verification_status = 'Pending' OR document_verification_status IS NULL OR document_verification_status = ''";
$doc_verified_sql = "SELECT COUNT(id) as count FROM registration WHERE document_verification_status = 'Done'";
$doc_declined_sql = "SELECT COUNT(id) as count FROM registration WHERE document_verification_status = 'Declined'";

$count_doc_pending  = mysqli_fetch_assoc(mysqli_query($con, $doc_pending_sql))['count'];
$count_doc_verified = mysqli_fetch_assoc(mysqli_query($con, $doc_verified_sql))['count'];
$count_doc_declined = mysqli_fetch_assoc(mysqli_query($con, $doc_declined_sql))['count'];

// C. Plan Counts Logic (Dynamic)
$plan_stats = [];
$plan_sql = "SELECT p.id, p.plan_name, COUNT(r.id) as user_count 
             FROM tbl_plans p 
             LEFT JOIN registration r ON p.id = r.plan_id 
             GROUP BY p.id";
$plan_res = mysqli_query($con, $plan_sql);
while($p_row = mysqli_fetch_assoc($plan_res)) {
    $plan_stats[] = $p_row;
}


// --- 2. FILTER LOGIC ---
$filter_visibility = "";
$filter_profile = "";
$filter_doc = "";
$filter_plan = "";
$conditions = [];

// Check Profile Filter
if(isset($_GET['filter_profile']) && $_GET['filter_profile'] !== '') {
    $filter_profile = mysqli_real_escape_string($con, $_GET['filter_profile']);
    $conditions[] = "r.profilestatus = '$filter_profile'";
}
if(isset($_GET['filter_visibility']) && $_GET['filter_visibility'] !== '') {
    $filter_visibility = mysqli_real_escape_string($con, $_GET['filter_visibility']);
    
    if($filter_visibility == '1') {
        // Allowed
        $conditions[] = "r.verificationinfo = '1'";
    } else {
        // Restricted (0 or any other value)
        $conditions[] = "r.verificationinfo != '1'";
    }
}
// Check Document Filter
if(isset($_GET['filter_doc']) && $_GET['filter_doc'] !== '') {
    $filter_doc = mysqli_real_escape_string($con, $_GET['filter_doc']);
    
    if($filter_doc == 'Pending') {
        $conditions[] = "(r.document_verification_status = 'Pending' OR r.document_verification_status IS NULL OR r.document_verification_status = '')";
    } else {
        $conditions[] = "r.document_verification_status = '$filter_doc'";
    }
}

// Check Plan Filter
if(isset($_GET['filter_plan']) && $_GET['filter_plan'] !== '') {
    $filter_plan = mysqli_real_escape_string($con, $_GET['filter_plan']);
    $conditions[] = "r.plan_id = '$filter_plan'";
}

// Build WHERE Clause
$where_clause = "";
if(count($conditions) > 0) {
    $where_clause = "WHERE " . implode(' AND ', $conditions);
}

// Main Query (Joined with tbl_plans to get plan name in the list)
// using 'r' as alias for registration and 'p' for plans
$sql = "SELECT r.*, p.plan_name 
        FROM registration r 
        LEFT JOIN tbl_plans p ON r.plan_id = p.id 
        $where_clause 
        ORDER BY r.id DESC";

$result = mysqli_query($con, $sql);

// Fetch all plans for the Filter Dropdown
$all_plans_query = mysqli_query($con, "SELECT * FROM tbl_plans");
// ... after $filter_profile logic ...

// Check Visibility Filter (NEW MODULE)



// ... before $filter_doc logic ...
?>
<STYLE>
    table.dataTable thead .sorting:after,
    table.dataTable thead .sorting_asc:after,
    table.dataTable thead .sorting_desc:after,
    table.dataTable thead .sorting_asc_disabled:after,
    table.dataTable thead .sorting_desc_disabled:after {
        content: "" !important;
    }
    table.dataTable thead .sorting:before,
    table.dataTable thead .sorting_asc:before,
    table.dataTable thead .sorting_desc:before,
    table.dataTable thead .sorting_asc_disabled:before,
    table.dataTable thead .sorting_desc_disabled:before {
        content: "" !important;
    }
    table.dataTable thead .sorting:after, table.dataTable thead .sorting_asc:after, table.dataTable thead .sorting_desc:after, table.dataTable thead .sorting_asc_disabled:after, table.dataTable thead .sorting_desc_disabled:after {
        right:12PX;
        FONT-SIZE: 23PX;
        TOP: 20PX;
    }
    table.dataTable thead .sorting:before, table.dataTable thead .sorting_asc:before, table.dataTable thead .sorting_desc:before, table.dataTable thead .sorting_asc_disabled:before, table.dataTable thead .sorting_desc_disabled:before {
        right: 1em;
        content: "\2191";
        TOP: 5PX;
    }
    .stats-box, .card {
        box-shadow: none !important;
        border: 1px solid #eee;
    }
</STYLE>
<style>
    /* Custom Light Colors for Cards */
    .card-stat {
        transition: transform 0.3s ease;
        border: none;
    }
    .card-stat:hover {
        transform: translateY(-5px);
    }
    .card-body { padding: 1.5rem; }
    
    /* Profile Colors */
    .bg-light-total { background-color: #f0f2f5; color: #3e2b85ff; }
    .bg-light-pending { background-color: #ffe5e5; color: #ea5455; }
    .bg-light-approved { background-color: #e5ffe5; color: #28c76f; }
    .bg-light-deactive { background-color: #ffffe5; color: #ff9f43; }
    .bg-light-deleted { background-color: #eaeaec; color: #82868b; }

    /* Document Colors */
    .bg-doc-pending { background-color: #fff0e1; color: #ff9f43; }
    .bg-doc-verified { background-color: #e0f7fa; color: #00cfe8; }
    .bg-doc-declined { background-color: #fce4ec; color: #e91e63; }

    /* Plan Colors */
    .bg-plan-silver { background-color: #f3f3f3; color: #787878; border-bottom: 3px solid #b0b0b0; }
    .bg-plan-gold { background-color: #f1e39cff; color: #ebaa07ff; border-bottom: 3px solid #ffd700; }
    .bg-plan-platinum { background-color: #ae99e99a; color: #4e08cfff; border-bottom: 3px solid #8e44ad; }
    .bg-plan-free { background-color: #88e48d65; color: #11af53ff; border-bottom: 3px solid #e0b7b7ff; }
    .bg-plan-default { background-color: #e6f7ff; color: #007bff; border-bottom: 3px solid #007bff; }


    .stat-title { font-size: 0.9rem; font-weight: 600; margin-top: 10px; display: block; }
    .stat-count { font-size: 1.8rem; font-weight: bold; margin-bottom: 0; }
    
    .row { display:flex; justify-content: center; }
</style>

<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <h2 class="content-header-title float-left mb-0">User Profiles</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">User Profiles</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="content-body">
            
            <!-- SECTION 1: PROFILE STATUS -->
            <div class="row mb-2" >
                <div class="col-xl-2 col-md-4 col-sm-6 col-12">
                    <div class="card card-stat bg-light-total text-center">
                        <div class="card-body">
                            <h2 class="stat-count"><?php echo $count_total; ?></h2>
                            <span class="stat-title">Total Users</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-4 col-sm-6 col-12">
                    <div class="card card-stat bg-light-pending text-center">
                        <div class="card-body">
                            <h2 class="stat-count"><?php echo $count_pending; ?></h2>
                            <span class="stat-title">Profile Pending</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-4 col-sm-6 col-12">
                    <div class="card card-stat bg-light-approved text-center">
                        <div class="card-body">
                            <h2 class="stat-count"><?php echo $count_approved; ?></h2>
                            <span class="stat-title">Profile Approved</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-4 col-sm-6 col-12">
                    <div class="card card-stat bg-light-deactive text-center">
                        <div class="card-body">
                            <h2 class="stat-count"><?php echo $count_deactive; ?></h2>
                            <span class="stat-title">Profile Deactivated</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-4 col-sm-6 col-12">
                    <div class="card card-stat bg-light-deleted text-center">
                        <div class="card-body">
                            <h2 class="stat-count"><?php echo $count_deleted; ?></h2>
                            <span class="stat-title">Profile Deleted</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION 2: DOCUMENT STATUS -->
            <div class="row mb-2">
                <div class="col-xl-4 col-md-4 col-12">
                    <div class="card card-stat bg-doc-pending text-center">
                        <div class="card-body">
                            <div class="avatar bg-white p-50 mb-1">
                                <div class="avatar-content"><i data-feather="clock" class="text-warning font-medium-4"></i></div>
                            </div>
                            <h2 class="stat-count text-warning"><?php echo $count_doc_pending; ?></h2>
                            <span class="stat-title">ID Verification Review</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 col-12">
                    <div class="card card-stat bg-doc-verified text-center">
                        <div class="card-body">
                            <div class="avatar bg-white p-50 mb-1">
                                <div class="avatar-content"><i data-feather="check-circle" class="text-info font-medium-4"></i></div>
                            </div>
                            <h2 class="stat-count text-info"><?php echo $count_doc_verified; ?></h2>
                            <span class="stat-title">ID Verification Verified</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 col-12">
                    <div class="card card-stat bg-doc-declined text-center">
                        <div class="card-body">
                            <div class="avatar bg-white p-50 mb-1">
                                <div class="avatar-content"><i data-feather="x-circle" class="text-danger font-medium-4"></i></div>
                            </div>
                            <h2 class="stat-count text-danger"><?php echo $count_doc_declined; ?></h2>
                            <span class="stat-title"> ID Verification Declined</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION 3: PLAN STATUS (NEW) -->
            <div class="row mb-2">
                <?php foreach($plan_stats as $stat): 
                    // Determine Color based on Plan Name
                    $planName = strtolower($stat['plan_name']);
                    $bgClass = 'bg-plan-default';
                    
                    if(strpos($planName, 'gold') !== false) {
                        $bgClass = 'bg-plan-gold';
                    } elseif(strpos($planName, 'platinum') !== false) {
                        $bgClass = 'bg-plan-platinum';
                    } 
                  
                     elseif(strpos($planName, 'free') !== false || $planName == '') {
                        $bgClass = 'bg-plan-free';
                    }
                ?>

               
                <div class="col-xl-3 col-md-4 col-sm-6 col-12">
                    <div class="card card-stat <?php echo $bgClass; ?> text-center">
                        <div class="card-body">
                            <h2 class="stat-count"><?php echo $stat['user_count']; ?></h2>
                            <span class="stat-title"><?php echo $stat['plan_name'] ? $stat['plan_name'] : 'Unknown'; ?> Users</span>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- SECTION 4: FILTER & TABLE -->
            <section id="basic-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            
                            <!-- Filter Header -->
                            <div class="card-header border-bottom p-1">
                                <h4 class="card-title">User Profiles List</h4>
                                
                                <div class="d-flex align-items-center flex-wrap">
                                    <!-- Filter Form -->
                                    <form method="GET" action="" class="form-inline mr-1">
                                        
                                        <!-- Profile Status Filter -->
                                        <div class="form-group mr-1">
                                            <label class="mr-50 font-small-3">Profile Status:</label>
                                            <select name="filter_profile" class="form-control form-control-sm" onchange="this.form.submit()">
                                                <option value="">All Profiles</option>
                                                <option value="0" <?php if($filter_profile === '0') echo 'selected'; ?>>Pending</option>
                                                <option value="1" <?php if($filter_profile === '1') echo 'selected'; ?>>Approved</option>
                                                <option value="2" <?php if($filter_profile === '2') echo 'selected'; ?>>Deactivated</option>
                                                <option value="3" <?php if($filter_profile === '3') echo 'selected'; ?>>Deleted</option>
                                            </select>
                                        </div>
                                        <div class="form-group mr-1">
    <label class="mr-50 font-small-3">Visibility:</label>
    <select name="filter_visibility" class="form-control form-control-sm" onchange="this.form.submit()">
        <option value="">All</option>
        <option value="1" <?php if(isset($filter_visibility) && $filter_visibility === '1') echo 'selected'; ?>>Allowed</option>
        <option value="0" <?php if(isset($filter_visibility) && $filter_visibility === '0') echo 'selected'; ?>>Restricted</option>
    </select>
</div>

                                        <!-- Document Status Filter -->
                                        <div class="form-group mr-1">
                                            <label class="mr-50 font-small-3">Verification Status </label>
                                            <select name="filter_doc" class="form-control form-control-sm" onchange="this.form.submit()">
                                                <option value="">All Docs</option>
                                                <option value="Pending" <?php if($filter_doc === 'Pending') echo 'selected'; ?>>Pending Review</option>
                                                <option value="Done" <?php if($filter_doc === 'Done') echo 'selected'; ?>>Verified</option>
                                                <option value="Declined" <?php if($filter_doc === 'Declined') echo 'selected'; ?>>Declined</option>
                                            </select>
                                        </div>

                                        <!-- Plan Filter (NEW) -->
                                        <div class="form-group mr-1">
                                            <label class="mr-50 font-small-3">Plan:</label>
                                            <select name="filter_plan" class="form-control form-control-sm" onchange="this.form.submit()">
                                                <option value="">All Plans</option>
                                                <?php 
                                                    // Reset pointer for plan dropdown
                                                    mysqli_data_seek($all_plans_query, 0); 
                                                    while($p = mysqli_fetch_assoc($all_plans_query)) {
                                                        $sel = ($filter_plan == $p['id']) ? 'selected' : '';
                                                        echo "<option value='".$p['id']."' $sel>".$p['plan_name']."</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        
                                   <?php if($filter_profile !== '' || $filter_doc !== '' || $filter_plan !== '' || (isset($filter_visibility) && $filter_visibility !== '')) { ?>
    <a href="user-profiles.php" class="btn btn-sm btn-outline-secondary">Clear</a>
<?php } ?>
                                    </form>

                                    <a href="export-users.php" class="btn btn-success btn-sm" target="_blank">
                                        <i data-feather="download" class="mr-50"></i> Excel
                                    </a>
                                </div>
                            </div>

                            <!-- Alert Messages -->
                            <?php if(isset($_GET['profilestatus']) && $_GET['profilestatus'] == 'yes') { ?>
                                <div class="alert alert-success m-1 p-1 text-center">Profile Status Updated Successfully</div>
                            <?php } ?>
                            
                            <?php if(isset($_GET['delete']) && $_GET['delete'] == 'success') { ?>
                                <div class="alert alert-danger m-1 p-1 text-center">User Deleted Successfully</div>
                            <?php } ?>
                            
                            <?php if(isset($_GET['idstatus']) && $_GET['idstatus'] == 'yes') { ?>
                                <div class="alert alert-info m-1 p-1 text-center">ID Verification Status Updated</div>
                            <?php } ?>

                            <!-- Data Table -->
                            <div class="table-responsive p-1">
                                <table class="table table-striped table-hover" id="dt"> 
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Userid</th>
                                            <th>Name</th>
                                            <th>Phone & Email</th>
                                            <th>Join Date</th>
                                            <th>Profile Status</th>
                                            <th>Matches Status</th>
                                            <th>ID Verification</th>
                                            <th>Current Plan</th> <!-- NEW COLUMN -->
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                    <?php
                                    $i = 1;
                                    if(mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            
                                            // Verification Status
                                            $id_status_val = $row['verificationinfo']; 
                                            // Document Upload Status
                                            $doc_status_val = $row['document_verification_status'] ?? 'Pending';
                                            // Plan Name
                                            $plan_name_display = $row['plan_name'] ? $row['plan_name'] : '<span class="text-muted">Free</span>';
                                    ?>
                                    <tr>
                                        <td><?php echo $i++; ?>.</td>

                                        <td><span class="font-weight-bold"><?php echo $row['userid']; ?></span></td>

                                        <td><span class="font-weight-bold"><?php echo $row['name']; ?></span></td>

                                        <td>
                                            <?php echo $row['phone']; ?><br>
                                            <small class="text-muted"><?php echo $row['email']; ?></small>
                                        </td>

                                        <td><?php echo date('d M Y', strtotime($row['entrydate'])); ?></td>

                                        <!-- Profile Status -->
                                        <td>
                                            <?php 
                                            if($row['profilestatus'] == '0') {
                                                echo "<span class='badge badge-light-danger'>Pending</span>";
                                            } elseif($row['profilestatus'] == '1') {
                                                echo "<span class='badge badge-light-success'>Approved</span>";
                                            } elseif($row['profilestatus'] == '2') {
                                                echo "<span class='badge badge-light-warning'>Deactivated</span>"; 
                                            } elseif($row['profilestatus'] == '3') {
                                                echo "<span class='badge badge-light-secondary'>Deleted</span>"; 
                                            }
                                            ?>
                                        </td>

                                        <!-- Matches Visibility -->
                                        <td>
                                            <?php
                                            if($id_status_val == '1') {
                                                echo "<span class='text-primary font-weight-bold'>Allowed</span>";
                                            } else {
                                                echo "<span class='text-muted'>Restricted</span>";
                                            }
                                            ?>
                                        </td>

                                        <!-- Document Status -->
                                        <td>
                                            <?php
                                                if ($doc_status_val == 'Done') {
                                                    echo '<span class="badge badge-pill badge-light-info">Verified</span>';
                                                } elseif ($doc_status_val == 'Declined') {
                                                    echo '<span class="badge badge-pill badge-light-danger">Declined</span>';
                                                } else {
                                                    echo '<span class="badge badge-pill badge-light-warning">Pending</span>';
                                                }
                                            ?>
                                        </td>

                                        <!-- NEW COLUMN: Current Plan -->
                                        <td>
                                            <span class="font-weight-bold"><?php echo $plan_name_display; ?></span>
                                        </td>

                                        <!-- Actions -->
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                                                    Action
                                                </button>

                                                <div class="dropdown-menu">

                                                    <a class="dropdown-item" href="userprofile-view.php?uid=<?php echo $row['userid']; ?>">
                                                        <i data-feather="eye" class="mr-50"></i> View
                                                    </a>

                                                    <div class="dropdown-divider"></div>

                                                    <?php if($row['profilestatus'] != '1'): ?>
                                                    <a class="dropdown-item text-success" href="userprofile-update.php?uid=<?php echo $row['userid']; ?>&status=1">
                                                        <i data-feather="check" class="mr-50"></i> Approve
                                                    </a>
                                                    <?php endif; ?>

                                                    <!-- ID STATUS -->
                                                    <?php if($row['verificationinfo'] == '1'): ?>
                                                        <a class="dropdown-item text-danger"
                                                           href="userprofile-approve-id.php?uid=<?php echo $row['userid']; ?>&status=0"
                                                           onclick="return confirm('Mark ID as NOT VERIFIED?');">
                                                            <i data-feather="x-circle" class="mr-50"></i> Restricted
                                                        </a>
                                                    <?php else: ?>
                                                        <a class="dropdown-item text-primary"
                                                           href="userprofile-approve-id.php?uid=<?php echo $row['userid']; ?>&status=1"
                                                           onclick="return confirm('Verify ID for this user?');">
                                                            <i data-feather="check-circle" class="mr-50"></i> Allowed
                                                        </a>
                                                    <?php endif; ?>

                                                    <!-- Doc Verify -->
                                                    <?php if($doc_status_val != 'Done'): ?>
                                                    <a class="dropdown-item text-info"
                                                       href="verify-document.php?uid=<?php echo $row['userid']; ?>&action=verify"
                                                       onclick="return confirm('Verify Document for this user?')">
                                                        <i data-feather="shield" class="mr-50"></i> Verify ID 
                                                    </a>
                                                    <?php endif; ?>

                                                    <?php if($row['profilestatus'] != '2'): ?>
                                                    <a class="dropdown-item text-warning"
                                                       href="userprofile-update.php?uid=<?php echo $row['userid']; ?>&status=2">
                                                        <i data-feather="user-x" class="mr-50"></i> Deactivate
                                                    </a>
                                                    <?php endif; ?>

                                                    <a class="dropdown-item text-danger"
                                                       href="userprofile-delete.php?uid=<?php echo $row['userid']; ?>"
                                                       onclick="return confirm('Are you sure to delete?');">
                                                        <i data-feather="trash-2" class="mr-50"></i> Delete
                                                    </a>

                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='10' class='text-center py-3'>No records found.</td></tr>";
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                      
                        </div>
                    </div>
                </div>
            </section>
            
        </div>
    </div>
</div>
<!-- END: Content-->

<?php include 'footer.php'; ?>