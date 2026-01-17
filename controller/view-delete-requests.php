<?php
include 'header.php';
include 'config.php';

// --- DATA FETCHING QUERY ---
// We use LEFT JOIN to get the Name and Phone from 'delete_users' table
// using the common 'userid' column.
$sql = "SELECT dp.*, du.name, du.phone, du.email 
        FROM delete_profile dp 
        LEFT JOIN delete_users du ON dp.userid = du.userid 
        ORDER BY dp.id DESC";

$result = mysqli_query($con, $sql);
?>

<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <h2 class="content-header-title float-left mb-0">Deleted Profile Requests</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Delete Requests</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="content-body">
            <section id="basic-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header border-bottom p-1">
                                <h4 class="card-title">List of Users who Deleted Profiles</h4>
                            </div>
                            
                            <div class="table-responsive p-1">
                                <table class="table table-striped table-hover" id="dt">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>User Details</th>
                                            <th>Reason Selected</th>
                                            <th>Marriage/Other Details</th>
                                            <th>Partner Info</th>
                                            <!-- <th>Proofs (Photos)</th> -->
                                            <th>Date of Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                    <?php
                                    $i = 1;
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            
                                            // Image Paths (Images are in the main 'weddingphoto' folder)
                                            // We use '../' to go back one step from admin_side
                                            $img1_path = "../images/user/" . $row['s1'];
                                            $img2_path = "../weddingphoto/" . $row['s2'];
                                            $has_img1 = !empty($row['s1']) && file_exists($img1_path);
                                            $has_img2 = !empty($row['s2']) && file_exists($img2_path);
                                    ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span class="font-weight-bold text-primary"><?php echo $row['userid']; ?></span>
                                                <span class="font-weight-bold"><?php echo $row['name'] ? $row['name'] : 'Name Not Found'; ?></span>
                                                <small class="text-muted"><?php echo $row['phone']; ?></small>
                                                <small class="text-muted"><?php echo $row['email']; ?></small>
                                            </div>
                                        </td>

                                        <td>
                                            <span class="badge badge-light-danger mb-1"><?php echo $row['options']; ?></span>
                                            <?php if (!empty($row['otherreason'])) { ?>
                                                <div class="small text-muted"><strong>Reason:</strong> <?php echo $row['otherreason']; ?></div>
                                            <?php } ?>
                                        </td>

                                        <td>
                                            <ul class="list-unstyled mb-0 small">
                                                <?php if (!empty($row['mfoption'])) { ?>
                                                    <li><strong>Fixed By:</strong> <?php echo $row['mfoption']; ?></li>
                                                <?php } ?>
                                                
                                                <?php if (!empty($row['marriagedate']) && $row['marriagedate'] != '0000-00-00') { ?>
                                                    <li><strong>Date:</strong> <?php echo date('d-M-Y', strtotime($row['marriagedate'])); ?></li>
                                                <?php } ?>

                                                <?php if (!empty($row['osoption'])) { ?>
                                                    <li><strong>Source:</strong> <?php echo $row['osoption']; ?></li>
                                                <?php } ?>

                                                <?php if (!empty($row['matchmaking'])) { ?>
                                                    <li><strong>Site:</strong> <?php echo $row['matchmaking']; ?></li>
                                                <?php } ?>

                                                <?php if (!empty($row['matchmakers'])) { ?>
                                                    <li><strong>Maker:</strong> <?php echo $row['matchmakers']; ?></li>
                                                <?php } ?>

                                                <?php if (!empty($row['others'])) { ?>
                                                    <li><strong>Other:</strong> <?php echo $row['others']; ?></li>
                                                <?php } ?>
                                            </ul>
                                        </td>

                                        <td>
                                            <?php if (!empty($row['partnername'])) { ?>
                                                <div class="font-weight-bold"><?php echo $row['partnername']; ?></div>
                                            <?php } else { echo "-"; } ?>
                                            
                                            <?php if (!empty($row['partnerid'])) { ?>
                                                <div class="small text-muted">ID: <?php echo $row['partnerid']; ?></div>
                                            <?php } ?>
                                        </td>

                                        <!-- <td>
                                            <div class="d-flex align-items-center">
                                                <?php if ($has_img1) { ?>
                                                    <a href="<?php echo $img1_path; ?>" target="_blank" class="mr-1">
                                                        <img src="<?php echo $img1_path; ?>" width="50" height="50" class="rounded border" style="object-fit:cover">
                                                    </a>
                                                <?php } ?>
                                                
                                                <?php if ($has_img2) { ?>
                                                    <a href="<?php echo $img2_path; ?>" target="_blank">
                                                        <img src="<?php echo $img2_path; ?>" width="50" height="50" class="rounded border" style="object-fit:cover">
                                                    </a>
                                                <?php } ?>
                                                
                                                <?php if (!$has_img1 && !$has_img2) { echo "<span class='text-muted small'>No Photos</span>"; } ?>
                                            </div>
                                        </td> -->

                                        <td>
                                            <span class="badge badge-pill badge-light-secondary">Record #<?php echo $row['id']; ?></span>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='7' class='text-center py-3'>No deleted profile requests found.</td></tr>";
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
<?php include 'footer.php'; ?>