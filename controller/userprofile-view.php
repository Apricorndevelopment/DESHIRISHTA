<?php
include 'header.php';
include 'config.php';

$userid = $_GET['uid'];

$sqlformfill = "select * from registration where userid = '$userid'";
$resultformfill = mysqli_query($con,$sqlformfill);
$rowformfill = mysqli_fetch_assoc($resultformfill);

$sqlbasicinfo = "select * from basic_info where userid = '$userid'";
$resultbasicinfo = mysqli_query($con,$sqlbasicinfo);
$rowbasicinfo = mysqli_fetch_assoc($resultbasicinfo);

$sqlastroinfo = "select * from astro_info where userid = '$userid'";
$resultastroinfo = mysqli_query($con,$sqlastroinfo);
$rowastroinfo = mysqli_fetch_assoc($resultastroinfo);

$sqlreligiousinfo = "select * from religious_info where userid = '$userid'";
$resultreligiousinfo = mysqli_query($con,$sqlreligiousinfo);
$rowreligiousinfo = mysqli_fetch_assoc($resultreligiousinfo);

$sqleudcationinfo = "select * from education_info where userid = '$userid'";
$resulteudcationinfo = mysqli_query($con,$sqleudcationinfo);
$roweudcationinfo = mysqli_fetch_assoc($resulteudcationinfo);

$sqlgroomlocation = "select * from groom_location where userid = '$userid'";
$resultgroomlocation = mysqli_query($con,$sqlgroomlocation);
$rowgroomlocation = mysqli_fetch_assoc($resultgroomlocation);

$sqlfamilyinfo = "select * from family_info where userid = '$userid'";
$resultfamilyinfo = mysqli_query($con,$sqlfamilyinfo);
$rowfamilyinfo = mysqli_fetch_assoc($resultfamilyinfo);

$sqlhobbiesinfo = "select * from hobbies_info where userid = '$userid'";
$resulthobbiesinfo = mysqli_query($con,$sqlhobbiesinfo);
$rowhobbiesinfo = mysqli_fetch_assoc($resulthobbiesinfo);

$sqlpartnerinfo = "select * from partner_info where userid = '$userid'";
$resultpartnerinfo = mysqli_query($con,$sqlpartnerinfo);
$rowpartnerinfo = mysqli_fetch_assoc($resultpartnerinfo);

$sqlcontactinfo = "select * from contact_info where userid = '$userid'";
$resultcontactinfo = mysqli_query($con,$sqlcontactinfo);
$rowcontactinfo = mysqli_fetch_assoc($resultcontactinfo);

$sqlphotosinfo = "select * from photos_info where userid = '$userid'";
$resultphotosinfo = mysqli_query($con,$sqlphotosinfo);
$rowphotosinfo = mysqli_fetch_assoc($resultphotosinfo);

$sqlremarks = "select * from admin_remarks where user_id = '$userid' ORDER BY created_at DESC";
$resultremarks = mysqli_query($con, $sqlremarks);


// Admin side par user ki ID se data fetch karna
$sql_admin_verification = "SELECT * FROM verification_info WHERE userid = '$userid'";
$result_admin_verification = mysqli_query($con, $sql_admin_verification);
$row_admin_verification = mysqli_fetch_assoc($result_admin_verification);


?>

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">

                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Edit Profile</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active"><a href="#">Edit Profile</a>
                                    </li>
                                </ol>
                            </div>
                            
                        </div>
                    </div>
                </div>
               <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
    <div class="form-group breadcrumb-right">
        <a href="export-single-user.php?uid=<?php echo $userid; ?>" class="btn btn-success" target="_blank">
            <i data-feather="download"></i> Export to Excel
        </a>
        </div>
</div>
            </div>
            <div class="content-body">
                <!-- Basic multiple Column Form section start -->
                 <form action="userprofile-admin-update.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="userid" value="<?php echo $userid; ?>">
                <section id="multiple-column-form">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-primary mb-2">
                                    <h4 class="card-title text-white">Basic Information</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>User ID</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="key"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" value="<?php echo $rowformfill['userid']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Password</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="lock"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="password" value="<?php echo $rowformfill['password']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Profile created by</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="createby" value="<?php echo $rowbasicinfo['createby']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Name</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="fullname" value="<?php echo $rowbasicinfo['fullname']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Gender</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control"  name="gender" value="<?php echo $rowbasicinfo['gender']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Marital Status</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="marital" value="<?php echo $rowbasicinfo['marital']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Have Children</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="children" value="<?php echo $rowbasicinfo['children']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Age</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="age" value="<?php echo $rowbasicinfo['age']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Height</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="height" value="<?php echo $rowbasicinfo['height']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Weight</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="weight" value="<?php echo $rowbasicinfo['weight']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Any Disability</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="physical" value="<?php echo $rowbasicinfo['physical']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Language Known</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="langauge" value="<?php echo $rowbasicinfo['langauge']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Eating Habits</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="eating" value="<?php echo $rowbasicinfo['eating']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Smoking Habits</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="smoking" value="<?php echo $rowbasicinfo['smoking']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Drinking Habits</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="drinking" value="<?php echo $rowbasicinfo['drinking']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-info mb-2">
                <h4 class="card-title text-white">Verification Details</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <b>Aadhaar Number:</b> 
                        <?php echo htmlspecialchars($row_admin_verification['adhaarnum'] ?? 'N/A'); ?>
                    </div>
                    <div class="col-md-4">
                        <b>Aadhaar Full Name:</b> 
                        <?php echo htmlspecialchars($row_admin_verification['fullname'] ?? 'N/A'); ?>
                    </div>
                    <div class="col-md-4">
                        <b>Govt ID Type:</b> 
                        <?php echo htmlspecialchars($row_admin_verification['govtid'] ?? 'N/A'); ?>
                    </div>
                    <div class="col-md-12 mt-3">
                        <b>Uploaded Govt ID Photo:</b>
                        <?php if (!empty($row_admin_verification['govpic'])) { ?>
                            <a href="../govtidphoto/<?php echo $row_admin_verification['govpic']; ?>" target="_blank">
                                View Document
                            </a>
                            
                        <?php } else {
                            echo 'No document uploaded.';
                        } ?>
                    </div>

<div class="col-md-12 mt-4 text-center">
    
    <?php 

    $id_status_value = $rowformfill['verificationinfo']; 
   
    if ($id_status_value == '1' || $id_status_value == 'Done') { // '1' या 'Done' दोनों verified हो सकते हैं
        $id_status_badge = '<span class="badge bg-success">Verified ✅</span>';
    } elseif ($id_status_value == 'Declined') {
        $id_status_badge = '<span class="badge bg-danger">Declined ❌</span>';
    } else {
        $id_status_badge = '<span class="badge bg-warning text-dark">Pending Review ⏳</span>';
    }
    ?>
    <p class="mb-2">
        <strong>Profile ID Status:</strong> 
        <?php echo $id_status_badge; ?>
    </p>


    <?php 

    $doc_status_value = $rowformfill['document_verification_status'] ?? 'Pending'; 
    
    if ($doc_status_value == 'Done') { 
        $doc_status_badge = '<span class="badge bg-success">Verified ✅</span>';
    } elseif ($doc_status_value == 'Declined') {
        $doc_status_badge = '<span class="badge bg-danger">Declined ❌</span>';
    } else {
        $doc_status_badge = '<span class="badge bg-warning text-dark">Pending Upload / Review ⏳</span>';
    }
    ?>
    <p>
        <strong>Current Document Status:</strong> 
        <?php echo $doc_status_badge; ?>
    </p>
    
    <div class="mt-3">
        
        <?php 
 
        if ($doc_status_value != 'Done') { 
        ?>
            <a href="verify-document.php?uid=<?php echo $userid; ?>&action=verify" 
               class="btn btn-success mr-1" 
               onclick="return confirm('Are you sure you want to VERIFY this document?')">
                <i data-feather="check"></i> Verify Document
            </a>
        <?php 
        } 
        
        if ($doc_status_value != 'Declined') { 
        ?>
            <a href="verify-document.php?uid=<?php echo $userid; ?>&action=decline" 
               class="btn btn-danger" 
               onclick="return confirm('Are you sure you want to DECLINE this document?')">
                <i data-feather="x"></i> Decline Document
            </a>
        <?php 
        } 
        ?>
    </div>
</div>

                    <!-- <div class="col-md-12 mt-4 text-center">
                       <p>
                            <strong>Current ID Status:</strong> 
                            <?php 
                            // $rowformfill is assumed to be fetched on userprofile-view.php
                            $id_status = $rowformfill['verificationinfo'];
                            
                            if ($id_status == 'Done') {
                                echo '<span class="badge bg-success">Verified </span>';
                            } elseif ($id_status == 'Declined') {
                                echo '<span class="badge bg-danger">Declined </span>';
                            } else {
                                echo '<span class="badge bg-warning text-dark">Pending Review ⏳</span>';
                            }
                            ?>
                        </p>
                        
                        <div class="mt-3">
                            <?php 
                            if ($id_status != 'Done') { 
                            ?>
                                <a href="verify-document.php?uid=<?php echo $userid; ?>&action=verify" 
                                   class="btn btn-success mr-1" 
                                   onclick="return confirm('Are you sure you want to VERIFY this document?')">
                                    <i data-feather="check"></i> Verify Document
                                </a>
                            <?php 
                            } 
                            
                            if ($id_status != 'Declined') { 
                            ?>
                                <a href="verify-document.php?uid=<?php echo $userid; ?>&action=decline" 
                                   class="btn btn-danger" 
                                   onclick="return confirm('Are you sure you want to DECLINE this document?')">
                                    <i data-feather="x"></i> Decline Document
                                </a>
                            <?php 
                            } 
                            ?>
                        
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>
</div>
<!--_--_--_--_--_   MEMBERSHIP PLAN BUTTONS   _--_--_--_--_-->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-dark mb-2">
                                    <h4 class="card-title text-white">Change Membership Plan</h4>
                                </div>
                                <div class="card-body text-center">
                                    <?php
                                    // 1. Get Current Plan ID
                                    // Assuming 'plan_id' column exists in registration table
                                    $current_plan_id = isset($rowformfill['plan_id']) ? $rowformfill['plan_id'] : '1'; 

                                    // 2. Define Plans Configuration
                                    // IMPORTANT: Change the array keys (1, 2, 3) to match your database IDs for these plans
                                    $plans = [
                                        '1' => [
                                            'name' => 'Free', 
                                            'class' => 'btn-outline-secondary', 
                                            'icon' => 'user'
                                        ],
                                        '2' => [
                                            'name' => 'Gold', 
                                            'class' => 'btn-warning', // Yellow/Gold color
                                            'icon' => 'star'
                                        ],
                                        '3' => [
                                            'name' => 'Platinum', 
                                            'class' => 'btn-info', // Blue/Purple color
                                            'icon' => 'award'
                                        ]
                                    ];
                                    ?>

                                    <div class="d-flex justify-content-center align-items-center flex-wrap">
                                        <?php foreach ($plans as $id => $plan) { 
                                            // Check if this is the current plan
                                            $isActive = ($current_plan_id == $id);
                                            
                                            // Style adjustments for active/inactive state
                                            $btnClass = $isActive ? 'btn-secondary' : $plan['class'];
                                            $btnText  = $plan['name'];
                                            $disabled = $isActive ? 'disabled' : '';
                                            $cursor   = $isActive ? 'cursor: not-allowed;' : '';
                                            
                                            if($isActive) {
                                                $btnText .= ' (Current)';
                                            }
                                        ?>
                                            <!-- Action Button -->
                                            <a href="userprofile-update-plan.php?uid=<?php echo $userid; ?>&plan_id=<?php echo $id; ?>" 
                                               class="btn <?php echo $btnClass; ?> mr-2 mb-1 btn-lg"
                                               style="<?php echo $cursor; ?>"
                                               <?php echo $disabled; ?>
                                               onclick="return confirm('Are you sure you want to change user plan to <?php echo $plan['name']; ?>?');">
                                                <i data-feather="<?php echo $plan['icon']; ?>" class="mr-50"></i>
                                                <?php echo $btnText; ?>
                                            </a>
                                        <?php } ?>
                                    </div>
                                    
                                    <small class="text-muted mt-1 d-block">Clicking a button will immediately update the user's plan.</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-primary mb-2">
                                    <h4 class="card-title text-white">About <?php if($rowformfill['groomlocation'] == 'Done') { echo "Groom"; } if($rowformfill['bridelocation'] == 'Done') { echo "Bride"; } ?></h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <div class="input-group input-group-merge">
                                                    <textarea class="form-control" name="aboutme" placeholder="About" rows="5"><?php echo $rowbasicinfo['aboutme']; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-primary mb-2">
                                    <h4 class="card-title text-white">Astro Details</h4> 
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Date of Birth</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="dob" value="<?php echo $rowastroinfo['dob']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Place of Birth</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="birthplace" value="<?php echo $rowastroinfo['birthplace']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Time of Birth</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="birthtime" value="<?php echo $rowastroinfo['birthtime']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Dosh/Dosham</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="manglik" value="<?php echo $rowastroinfo['manglik']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-primary mb-2">
                                    <h4 class="card-title text-white">Religious Background</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Religion</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="religion" value="<?php echo $rowreligiousinfo['religion']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Caste</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="caste" value="<?php echo $rowreligiousinfo['caste']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Gothram</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="gothram" value="<?php echo $rowreligiousinfo['gothram']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Sub-caste</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="subcaste" value="<?php echo $rowreligiousinfo['subcaste']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-primary mb-2">
                                    <h4 class="card-title text-white">Education & Career</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Stream</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="stream" value="<?php echo $roweudcationinfo['stream']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Highest Education</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="education" value="<?php echo $roweudcationinfo['education']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>College / Institution</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="college" value="<?php echo $roweudcationinfo['college']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Working With</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="workingwith" value="<?php echo $roweudcationinfo['workingwith']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Profession</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="profession" value="<?php echo $roweudcationinfo['profession']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Designation</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="designation" value="<?php echo $roweudcationinfo['designation']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Profession in Detail</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="professiondetail" value="<?php echo $roweudcationinfo['professiondetail']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Employer Name</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="employername" value="<?php echo $roweudcationinfo['employername']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Annual Income</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="income" value="<?php echo $roweudcationinfo['income']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-primary mb-2">
                                    <h4 class="card-title text-white"><?php if($rowformfill['groomlocation'] == 'Done') { echo "Groom"; } if($rowformfill['bridelocation'] == 'Done') { echo "Bride"; } ?> Location</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Country</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="groom_country" value="<?php echo $rowgroomlocation['country']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Citizenship</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="groom_citizenship"  value="<?php echo $rowgroomlocation['citizenship']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Resident Status</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="groom_resident"  value="<?php echo $rowgroomlocation['resident']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>State</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="groom_state"  value="<?php echo $rowgroomlocation['state']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>City</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="groom_city"  value="<?php echo $rowgroomlocation['city']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-primary mb-2">
                                    <h4 class="card-title text-white">Family Details</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Family Value</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="familyvalue" value="<?php echo $rowfamilyinfo['familyvalue']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Family Type</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="familytype" value="<?php echo $rowfamilyinfo['familytype']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Family Status</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="familystatus" value="<?php echo $rowfamilyinfo['familystatus']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Native Place</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="nativeplace" value="<?php echo $rowfamilyinfo['nativeplace']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Father Name</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="fathername" value="<?php echo $rowfamilyinfo['fathername']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Mother Name</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="mothername" value="<?php echo $rowfamilyinfo['mothername']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Father's Occupation</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="fatheroccupation" value="<?php echo $rowfamilyinfo['fatheroccupation']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Mother's Occupation</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="motheroccupation" value="<?php echo $rowfamilyinfo['motheroccupation']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>No. Of Brothers</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="brothers" value="<?php echo $rowfamilyinfo['brothers']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Brothers Married</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="bromarried" value="<?php echo $rowfamilyinfo['bromarried']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>No. Of Sisters</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="sisters" value="<?php echo $rowfamilyinfo['sisters']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Sisters Married</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="sismarried" value="<?php echo $rowfamilyinfo['sismarried']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Family Location</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="familylocation" value="<?php echo $rowfamilyinfo['familylocation']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>State</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="family_state" value="<?php echo $rowfamilyinfo['state']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>City</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="family_city" value="<?php echo $rowfamilyinfo['city']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Country</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="family_country" value="<?php echo $rowfamilyinfo['country']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-primary mb-2">
                                    <h4 class="card-title text-white">Hobbies & Interest</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Hobbies and Interest</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="hobbies" value="<?php echo $rowhobbiesinfo['hobbies']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Favourite Music</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="music" value="<?php echo $rowhobbiesinfo['music']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Sports you like</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="sports" value="<?php echo $rowhobbiesinfo['sports']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Your Favourite Food</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="food" value="<?php echo $rowhobbiesinfo['food']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-primary mb-2">
                                    <h4 class="card-title text-white">Partner Preferences</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Partner Age</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="partnerage" value="<?php echo $rowpartnerinfo['partnerage']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Height</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="partnerheight" value="<?php echo $rowpartnerinfo['partnerheight']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Marital Status</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="partnermarital" value="<?php echo $rowpartnerinfo['partnermarital']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Eating Habits</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="partnereating" value="<?php echo $rowpartnerinfo['partnereating']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Drinking Habits</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="partnerdrinking" value="<?php echo $rowpartnerinfo['partnerdrinking']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Smoking Habits</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="partnersmoking" value="<?php echo $rowpartnerinfo['partnersmoking']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Religion</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="partnerreligion" value="<?php echo $rowpartnerinfo['partnerreligion']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Caste</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="partnercaste" value="<?php echo $rowpartnerinfo['partnercaste']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Manglik</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="partnermanglik" value="<?php echo $rowpartnerinfo['partnermanglik']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Stream</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="partnerstream" value="<?php echo $rowpartnerinfo['partnerstream']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Highesh Education</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="partnereducation" value="<?php echo $rowpartnerinfo['partnereducation']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>College / Institution</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="partnercollege" value="<?php echo $rowpartnerinfo['partnercollege']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Profession</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                       
                                                    <input type="text" class="form-control" name="partnerprofession" value="<?php echo $rowpartnerinfo['partnerprofession']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Domain</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="partnerdomain" value="<?php echo $rowpartnerinfo['partnerdomain']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Designation</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="partnerdesignation" value="<?php echo $rowpartnerinfo['partnerdesignation']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Employer Name</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="partneremployername" value="<?php echo $rowpartnerinfo['partneremployername']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Annual Income</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="partnerincome" value="<?php echo $rowpartnerinfo['partnerincome']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>State</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="partnerstate" value="<?php echo $rowpartnerinfo['partnerstate']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>City</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="partnercity" value="<?php echo $rowpartnerinfo['partnercity']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Country</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="partnercountry" value="<?php echo $rowpartnerinfo['partnercountry']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-primary mb-2">
                                    <h4 class="card-title text-white">Contact Details</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Phone Number</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="phonenumber" value="<?php echo $rowcontactinfo['phonenumber']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Email</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="email" value="<?php echo $rowcontactinfo['email']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Name of Contact Person</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="contactperson" value="<?php echo $rowcontactinfo['contactperson']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Relationship with the member</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="relationship" value="<?php echo $rowcontactinfo['relationship']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary mb-2">
                <h4 class="card-title text-white">Manage Photos</h4>
            </div>
            <div class="card-body">
                <div class="row">

                    <!-- REUSABLE PHOTO BOX -->
                    <?php
                    $photo_fields = [
                        "profilepic" => "Profile Picture",
                        "photo1" => "Photo 1",
                        "photo2" => "Photo 2",
                        "photo3" => "Photo 3"
                    ];

                    foreach ($photo_fields as $field => $label) {
                    ?>
                        <div class="col-md-3 col-12">
                            <div class="photo-box">
                                <label><b><?php echo $label; ?></b></label>

                                <?php if ($rowphotosinfo[$field] != '') { ?>
                                    <img src="../userphoto/<?php echo $rowphotosinfo[$field]; ?>" class="photo-preview">

                                    <div class="delete-wrap">
                                        <input type="checkbox" name="delete_<?php echo $field; ?>" value="1">
                                        <span>Delete this photo</span>
                                    </div>
                                <?php } ?>

                                <label class="upload-btn">
                                    <i data-feather="upload-cloud"></i> Upload
                                    <input type="file" name="<?php echo $field; ?>">
                                </label>

                                <span class="file-name">No file chosen</span>
                            </div>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .photo-box {
    background: #ffffff;
    padding: 12px;
    border-radius: 10px;
    border: 1px solid #ddd;
    margin-bottom: 20px;
    text-align: center;
}

.photo-preview {
    width: 100%;
    height: 180px;
    object-fit: cover;
    border-radius: 8px;
    border: 2px solid #dcdcdc;
    margin-bottom: 12px;
}

.upload-btn {
    background: #6f4efc;
    color: white;
    padding: 8px 16px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: 0.3s;
    margin-top: 5px;
}

.upload-btn:hover {
    background: #5a3ce6;
}

.upload-btn input[type="file"] {
    display: none;
}

.file-name {
    display: block;
    margin-top: 8px;
    font-size: 12px;
    color: #555;
}

.delete-wrap {
    margin-bottom: 10px;
    font-size: 13px;
}

.delete-wrap span {
    margin-left: 5px;
}

</style>
<script>
document.querySelectorAll('.upload-btn input[type="file"]').forEach(input => {
    input.addEventListener('change', function(){
        let fileName = this.files[0] ? this.files[0].name : "No file chosen";
        this.closest('.photo-box').querySelector('.file-name').textContent = fileName;
    });
});
</script>

<script>
    feather.replace();
</script>


                    <!-- <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-primary mb-2">
                                    <h4 class="card-title text-white">Manage Photos</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label><b>Profile Picture</b></label>
                                                <?php if($rowphotosinfo['profilepic'] != '') { ?>
                                                    <img src="../userphoto/<?php echo $rowphotosinfo['profilepic']; ?>" style="width:100%; height: 200px; object-fit: cover; margin-bottom: 10px; border: 2px solid #ddd;">
                                                    <input type="checkbox" name="delete_profilepic" value="1"> <label>Delete this photo</label>
                                                <?php } ?>
                                                <input type="file" name="profilepic" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label><b>Photo 1</b></label>
                                                <?php if($rowphotosinfo['photo1'] != '') { ?>
                                                    <img src="../userphoto/<?php echo $rowphotosinfo['photo1']; ?>" style="width:100%; height: 200px; object-fit: cover; margin-bottom: 10px; border: 2px solid #ddd;">
                                                    <input type="checkbox" name="delete_photo1" value="1"> <label>Delete this photo</label>
                                                <?php } ?>
                                                <input type="file" name="photo1" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label><b>Photo 2</b></label>
                                                <?php if($rowphotosinfo['photo2'] != '') { ?>
                                                    <img src="../userphoto/<?php echo $rowphotosinfo['photo2']; ?>" style="width:100%; height: 200px; object-fit: cover; margin-bottom: 10px; border: 2px solid #ddd;">
                                                    <input type="checkbox" name="delete_photo2" value="1"> <label>Delete this photo</label>
                                                <?php } ?>
                                                <input type="file" name="photo2" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label><b>Photo 3</b></label>
                                                <?php if($rowphotosinfo['photo3'] != '') { ?>
                                                    <img src="../userphoto/<?php echo $rowphotosinfo['photo3']; ?>" style="width:100%; height: 200px; object-fit: cover; margin-bottom: 10px; border: 2px solid #ddd;">
                                                    <input type="checkbox" name="delete_photo3" value="1"> <label>Delete this photo</label>
                                                <?php } ?>
                                                <input type="file" name="photo3" class="form-control">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   -->
                    <!--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_-->
                    <!--_--_--_--_--_     PROFILE ACTION BUTTONS     _--_--_--_--_-->
                    <!--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_-->
                    <?php
                    // Fetch the profile status from the registration table query
                    $current_status = $rowformfill['profilestatus'];
                    
                    // --- DEFAULT (PENDING) STATE ---
                    // Default links for the buttons
                    $approve_link = "userprofile-update.php?uid=" . $userid . "&status=1";
                    $deactivate_link = "userprofile-update.php?uid=" . $userid . "&status=2";
                    $delete_link = "userprofile-update.php?uid=" . $userid . "&status=3";
                    
                    // Default classes for the buttons
                    $approve_class = "btn-success";
                    $deactivate_class = "btn-warning";
                    $delete_class = "btn-danger";
                    
                    // Default text for the buttons
                    $approve_text = "Approve";
                    $deactivate_text = "Deactivate";
                    $delete_text = "Delete";
                    
                    // Default disabled state
                    $approve_disabled = "";
                    $deactivate_disabled = "";
                    $delete_disabled = "";
                    
                    // --- LOGIC FOR DIFFERENT STATUSES ---
                    
                    if ($current_status == '1') {
                        // B) If Profile is LIVE (Approved)
                        $approve_text = "Approved";
                        $approve_class = "btn-dark"; // Use btn-dark for inactive
                        $approve_disabled = "disabled"; // Make button inactive
                    
                    } elseif ($current_status == '2') {
                        // C) If Profile is DEACTIVATED
                        $deactivate_text = "Deactivated";
                        $deactivate_class = "btn-dark"; // Use btn-dark for inactive
                        $deactivate_disabled = "disabled"; // Make button inactive
                    
                    } elseif ($current_status == '3') {
                        // D) If Profile is DELETED
                        $approve_text = "Approved";
                        $approve_class = "btn-dark";
                        $approve_disabled = "disabled";
                        
                        $deactivate_text = "Deactivated";
                        $deactivate_class = "btn-dark";
                        $deactivate_disabled = "disabled";
                        
                        $delete_text = "Deleted";
                        $delete_class = "btn-dark";
                        $delete_disabled = "disabled";
                    }
                    // Note: If status is '0' (Pending), the default active buttons will be used.
                    
                    ?>
                    
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Manage Profile Status</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 text-center mt-2 mb-2">
                                        
                                            <!-- APPROVE BUTTON -->
                                            <a href="<?php echo $approve_link; ?>" 
                                               class="btn <?php echo $approve_class; ?> mr-1" 
                                               <?php echo $approve_disabled; ?>>
                                               <?php echo $approve_text; ?>
                                            </a>
                                            
                                            <!-- DEACTIVATE BUTTON -->
                                            <a href="<?php echo $deactivate_link; ?>" 
                                               class="btn <?php echo $deactivate_class; ?> mr-1" 
                                               <?php echo $deactivate_disabled; ?>>
                                               <?php echo $deactivate_text; ?>
                                            </a>
                                            
                                            <!-- DELETE BUTTON -->
                                            <a href="<?php echo $delete_link; ?>" 
                                               class="btn <?php echo $delete_class; ?>" 
                                               <?php echo $delete_disabled; ?>>
                                               <?php echo $delete_text; ?>
                                            </a>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 text-center mt-2 mb-2">
                                            <button type="submit" class="btn btn-success btn-lg mr-1">
                                                <i data-feather="save"></i> Save All Changes
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </section>
                </form>
     <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-info mb-2">
                            <h4 class="card-title text-white">Admin Remarks (Internal Notes)</h4>
                        </div>
                        <div class="card-body">

                            <form action="insert-admin-remark.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="user_id" value="<?php echo $userid; ?>">
                                <input type="hidden" name="admin_username" value="CurrentAdmin"> 
                                
                                <div class="form-group">
                                    <label><b>Add New Remark:</b></label>
                                    <textarea name="remark_text" class="form-control" rows="4" placeholder="Type your internal note here..."></textarea>
                                </div>
                                <div class="form-group">
                                    <label><b>Attach File (Optional):</b></label>
                                    <input type="file" name="remark_file" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-info">Save Remark</button>
                            </form>

                            <hr>

                            <h5><b>Existing Remarks:</b></h5>
                            <div class="mt-2" style="max-height: 400px; overflow-y: auto;">
                                <?php
                                if (mysqli_num_rows($resultremarks) > 0) {
                                    while ($rowremark = mysqli_fetch_assoc($resultremarks)) {
                                ?>
                                        <div class="border p-2 mb-2" style="background: #f9f9f9; border-radius: 8px;">
                                            <p style="white-space: pre-wrap;"><?php echo htmlspecialchars($rowremark['remark_text']); ?></p>
                                            <small>
                                                <strong>By:</strong> <?php echo htmlspecialchars($rowremark['admin_username']); ?> | 
                                                <strong>On:</strong> <?php echo date('d M Y, h:i A', strtotime($rowremark['created_at'])); ?>
                                            </small>
                                            <?php if (!empty($rowremark['file_path'])) { ?>
                                                <br>
                                                <a href="<?php echo $rowremark['file_path']; ?>" target="_blank" class="btn btn-sm btn-outline-primary mt-1">
                                                    <i data-feather="paperclip"></i> View Attached File
                                                </a>
                                            <?php } ?>
                                        </div>
                                <?php
                                    }
                                } else {
                                    echo "<p>No remarks found for this user.</p>";
                                }
                                ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            </div>
    </div>
</div>
                <!-- Basic Floating Label Form section end -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
    

<?php
include 'footer.php';   
?>