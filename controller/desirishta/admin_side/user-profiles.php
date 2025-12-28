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


// --- 2. FILTER LOGIC ---
$filter_profile = "";
$filter_doc = "";
$conditions = [];

// Check Profile Filter
if(isset($_GET['filter_profile']) && $_GET['filter_profile'] !== '') {
    $filter_profile = mysqli_real_escape_string($con, $_GET['filter_profile']);
    $conditions[] = "profilestatus = '$filter_profile'";
}

// Check Document Filter
if(isset($_GET['filter_doc']) && $_GET['filter_doc'] !== '') {
    $filter_doc = mysqli_real_escape_string($con, $_GET['filter_doc']);
    
    if($filter_doc == 'Pending') {
        $conditions[] = "(document_verification_status = 'Pending' OR document_verification_status IS NULL OR document_verification_status = '')";
    } else {
        $conditions[] = "document_verification_status = '$filter_doc'";
    }
}

// Build WHERE Clause
$where_clause = "";
if(count($conditions) > 0) {
    $where_clause = "WHERE " . implode(' AND ', $conditions);
}

// Main Query
$sql = "SELECT * FROM registration $where_clause ORDER BY id DESC";
$result = mysqli_query($con, $sql);

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
    /* content: "\2193"; */
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
        /* box-shadow: 0 4px 24px 0 rgba(34, 41, 47, 0.1); */
    }
    .card-stat:hover {
        transform: translateY(-5px);
    }
    .card-body { padding: 1.5rem; }
    
    /* Profile Colors */
    .bg-light-total { background-color: #f0f2f5; color: #3e2b85ff; }
    .bg-light-pending { background-color: #ffe5e5; color: #ea5455; } /* Light Red */
    .bg-light-approved { background-color: #e5ffe5; color: #28c76f; } /* Light Green */
    .bg-light-deactive { background-color: #ffffe5; color: #ff9f43; } /* Light Orange */
    .bg-light-deleted { background-color: #eaeaec; color: #82868b; } /* Light Grey */

    /* Document Colors (Distinct) */
    .bg-doc-pending { background-color: #fff0e1; color: #ff9f43; } /* Peach/Orange */
    .bg-doc-verified { background-color: #e0f7fa; color: #00cfe8; } /* Light Cyan/Blue */
    .bg-doc-declined { background-color: #fce4ec; color: #e91e63; } /* Light Pink */

    .stat-title { font-size: 0.9rem; font-weight: 600; margin-top: 10px; display: block; }
    .stat-count { font-size: 1.8rem; font-weight: bold; margin-bottom: 0; }
    
    /* Table Styling */
    table.dataTable thead .sorting:after,
    table.dataTable thead .sorting_asc:after,
    table.dataTable thead .sorting_desc:after { content: "" !important; }
    table.dataTable thead .sorting:before,
    table.dataTable thead .sorting_asc:before,
    table.dataTable thead .sorting_desc:before { content: "" !important; }
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
<style>
    .row{
        display:flex;
        justify-content: center;
    }
</style>
        <div class="content-body">
            
           
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
                            <span class="stat-title">User Profile Pending</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-4 col-sm-6 col-12">
                    <div class="card card-stat bg-light-approved text-center">
                        <div class="card-body">
                            <h2 class="stat-count"><?php echo $count_approved; ?></h2>
                            <span class="stat-title">User Profile Approved</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-4 col-sm-6 col-12">
                    <div class="card card-stat bg-light-deactive text-center">
                        <div class="card-body">
                            <h2 class="stat-count"><?php echo $count_deactive; ?></h2>
                            <span class="stat-title">User Profile Deactivated</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-4 col-sm-6 col-12">
                    <div class="card card-stat bg-light-deleted text-center">
                        <div class="card-body">
                            <h2 class="stat-count"><?php echo $count_deleted; ?></h2>
                            <span class="stat-title">User Profile Deleted</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION 2: DOCUMENT STATUS CARDS -->
            <!-- <h5 class="mb-1 mt-2">Document (Govt ID) Overview</h5> -->
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

            <!-- SECTION 3: FILTER & TABLE -->
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
                                            <label class="mr-50 font-small-3">Profile:</label>
                                            <select name="filter_profile" class="form-control form-control-sm" onchange="this.form.submit()">
                                                <option value="">All Profiles</option>
                                                <option value="0" <?php if($filter_profile === '0') echo 'selected'; ?>>Pending</option>
                                                <option value="1" <?php if($filter_profile === '1') echo 'selected'; ?>>Approved</option>
                                                <option value="2" <?php if($filter_profile === '2') echo 'selected'; ?>>Deactivated</option>
                                                <option value="3" <?php if($filter_profile === '3') echo 'selected'; ?>>Deleted</option>
                                            </select>
                                        </div>

                                        <!-- Document Status Filter -->
                                        <div class="form-group mr-1">
                                            <label class="mr-50 font-small-3">Document:</label>
                                            <select name="filter_doc" class="form-control form-control-sm" onchange="this.form.submit()">
                                                <option value="">All Docs</option>
                                                <option value="Pending" <?php if($filter_doc === 'Pending') echo 'selected'; ?>>Pending Review</option>
                                                <option value="Done" <?php if($filter_doc === 'Done') echo 'selected'; ?>>Verified</option>
                                                <option value="Declined" <?php if($filter_doc === 'Declined') echo 'selected'; ?>>Declined</option>
                                            </select>
                                        </div>
                                        
                                        <?php if($filter_profile !== '' || $filter_doc !== '') { ?>
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
                                            <th>Matches Visibility Status</th>
                                            <th>ID Verification <br> Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                    <?php
                                    $i = 1;
                                    if(mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            
                                            // Verification Status (verificationinfo)
                                            $id_status_val = $row['verificationinfo']; 
                                            
                                            // Document Upload Status
                                            $doc_status_val = $row['document_verification_status'] ?? 'Pending'; 
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

                                        <!-- Profile Status Badge -->
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

                                        <!-- ID Status (verificationinfo) -->
                                        <td>
                                            <?php
                                            if($id_status_val == '1') {
                                                echo "<span class='text-primary font-weight-bold'>Allowed</span>";
                                            } else {
                                                echo "<span class='text-muted'>Restricted</span>";
                                            }
                                            ?>
                                        </td>

                                        <!-- Document Status (Govt ID) -->
                                        <td>
                                            <?php
                                                if ($doc_status_val == 'Done') {
                                                    echo '<span class="badge badge-pill badge-light-info">
                                                            <i data-feather="check-circle" style="width:12px;"></i> Verified
                                                          </span>';
                                                } elseif ($doc_status_val == 'Declined') {
                                                    echo '<span class="badge badge-pill badge-light-danger">
                                                            <i data-feather="x-circle" style="width:12px;"></i> Declined
                                                          </span>';
                                                } else {
                                                    echo '<span class="badge badge-pill badge-light-warning">
                                                            <i data-feather="clock" style="width:12px;"></i> Pending
                                                          </span>';
                                                }
                                            ?>
                                        </td>

                                        <!-- -->
                                        <td>
    <div class="dropdown">
        <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle" data-toggle="dropdown">
            Action
        </button>

        <div class="dropdown-menu">

            <a class="dropdown-item" href="userprofile-view.php?uid=<?php echo $row['userid']; ?>">
                <i data-feather="eye" class="mr-50"></i> View Full Profile
            </a>

            <div class="dropdown-divider"></div>

            <?php if($row['profilestatus'] != '1'): ?>
            <a class="dropdown-item text-success" href="userprofile-update.php?uid=<?php echo $row['userid']; ?>&status=1">
                <i data-feather="check" class="mr-50"></i> Approve Profile
            </a>
            <?php endif; ?>

            <!-- ID STATUS VERIFY / UNVERIFY BUTTON -->
            <?php if($row['verificationinfo'] == '1'): ?>
                <a class="dropdown-item text-danger"
                   href="userprofile-approve-id.php?uid=<?php echo $row['userid']; ?>&status=0"
                   onclick="return confirm('Mark ID as NOT VERIFIED?');">
                    <i data-feather="x-circle" class="mr-50"></i> Unverify ID
                </a>
            <?php else: ?>
                <a class="dropdown-item text-primary"
                   href="userprofile-approve-id.php?uid=<?php echo $row['userid']; ?>&status=1"
                   onclick="return confirm('Verify ID for this user?');">
                    <i data-feather="check-circle" class="mr-50"></i> Verify ID
                </a>
            <?php endif; ?>
            <!-- END ID BUTTON -->

            <!-- Shortcut for Document verify -->
            <?php if($doc_status_val != 'Done'): ?>
            <a class="dropdown-item text-info"
               href="verify-document.php?uid=<?php echo $row['userid']; ?>&action=verify"
               onclick="return confirm('Verify Document for this user?')">
                <i data-feather="shield" class="mr-50"></i> Verify Doc
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
                                        echo "<tr><td colspan='9' class='text-center py-3'>No records found for selected filters.</td></tr>";
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