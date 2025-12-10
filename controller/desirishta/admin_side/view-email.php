<?php
include 'header.php';
include 'sidebar.php';
include '../config.php';

// ID चेक करें और डेटा लाएं
if(isset($_GET['id']) && $_GET['id'] != '') {
    $id = mysqli_real_escape_string($con, $_GET['id']);
    
    // कम्युनिकेशन डिटेल्स फेच करें
    $sql = "SELECT * FROM admin_communication WHERE id = '$id'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    
    // अगर रिकॉर्ड नहीं मिला
    if(!$row) {
        echo "<script>window.location.href='manage-communication.php?error=Record not found';</script>";
        exit;
    }
} else {
    echo "<script>window.location.href='manage-communication.php?error=Invalid ID';</script>";
    exit;
}
?>

<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">View Communication Details</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="manage-communication.php">Communications</a></li>
                                <li class="breadcrumb-item active">View Details</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-body">
            <section class="app-user-view">
                <div class="row justify-content-center">
                    <div class="col-xl-10 col-lg-10 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">
                                    <?php echo ($row['type'] == 'email') ? 'Email Campaign Details' : 'Banner Details'; ?>
                                </h4>
                                <a href="manage-communication.php" class="btn btn-outline-secondary btn-sm">
                                    <i data-feather="arrow-left"></i> Back to List
                                </a>
                            </div>
                            <hr class="m-0">
                            <div class="card-body">
                                <div class="row">
                                    
                                    <div class="col-12">
                                        <table class="table table-bordered table-striped">
                                            <tbody>
                                                <tr>
                                                    <th width="25%">Subject / Title</th>
                                                    <td><strong><?php echo htmlspecialchars($row['subject']); ?></strong></td>
                                                </tr>
                                                <tr>
                                                    <th>Type</th>
                                                    <td>
                                                        <?php if($row['type'] == 'email') { ?>
                                                            <span class="badge badge-light-primary">Email</span>
                                                        <?php } else { ?>
                                                            <span class="badge badge-light-warning">Banner</span>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Date Created</th>
                                                    <td><?php echo date("d M Y, h:i A", strtotime($row['entry_date'])); ?></td>
                                                </tr>
                                                
                                                <?php if($row['type'] == 'banner') { ?>
                                                <tr>
                                                    <th>Valid From</th>
                                                    <td><?php echo date("d M Y, h:i A", strtotime($row['valid_from'])); ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Valid Till</th>
                                                    <td><?php echo date("d M Y, h:i A", strtotime($row['valid_till'])); ?></td>
                                                </tr>
                                                <?php } ?>

                                                <tr>
                                                    <th>Target Audience</th>
                                                    <td>
                                                        <?php 
                                                        if($row['target_scope'] == 'all') {
                                                            echo "<span class='badge badge-pill badge-light-success'>All Users</span>";
                                                        } else {
                                                            echo "<span class='badge badge-pill badge-light-info'>Specific Users</span>";
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                                
                                                <?php if($row['target_scope'] == 'specific') { ?>
                                                <tr>
                                                    <th>Target IDs</th>
                                                    <td class="text-break"><?php echo htmlspecialchars($row['target_users']); ?></td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="col-12 mt-3">
                                        <h5 class="mb-1 text-primary"><i data-feather="align-left" class="mr-50"></i> Message / Body Content</h5>
                                        <div class="p-2 border rounded bg-light text-dark">
                                            <?php 
                                            // अगर HTML कंटेंट है तो html_entity_decode यूज़ करें, वरना nl2br
                                            echo nl2br($row['body_content']); 
                                            ?>
                                        </div>
                                    </div>

                                    <?php if(!empty($row['media_file'])) { ?>
                                    <div class="col-12 mt-3">
                                        <h5 class="mb-1 text-primary"><i data-feather="image" class="mr-50"></i> Attachment / Banner Image</h5>
                                        <div class="border p-3 rounded text-center" style="background: #f8f8f8;">
                                            <?php 
                                            $file_path = "../uploads/" . $row['media_file'];
                                            $ext = strtolower(pathinfo($row['media_file'], PATHINFO_EXTENSION));
                                            $img_exts = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                                            
                                            if(in_array($ext, $img_exts)) {
                                                // अगर इमेज है तो दिखाएं
                                                echo '<img src="'.$file_path.'" class="img-fluid rounded shadow-sm" style="max-height: 400px;" alt="Communication Media">';
                                            } else {
                                                // अगर कोई और फाइल है तो डाउनलोड बटन दिखाएं
                                                echo '<div class="mt-1"><i data-feather="file-text" style="width: 50px; height: 50px;"></i><br>';
                                                echo '<span class="d-block mt-1">'.$row['media_file'].'</span>';
                                                echo '<a href="'.$file_path.'" target="_blank" class="btn btn-primary mt-2">Download File</a></div>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    
                                    <div class="col-12 mt-3 text-right">
                                        <?php if($row['type'] == 'email') { ?>
                                            <a href="send-email-campaign.php?id=<?php echo $row['id']; ?>" 
                                               class="btn btn-success mr-1"
                                               onclick="return confirm('Are you sure you want to send this email now?');">
                                               <i data-feather="send"></i> Send Campaign
                                            </a>
                                        <?php } ?>
                                        
                                        <a href="delete-communication.php?id=<?php echo $row['id']; ?>" 
                                           class="btn btn-danger"
                                           onclick="return confirm('Are you sure you want to delete this?');">
                                           <i data-feather="trash-2"></i> Delete
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>