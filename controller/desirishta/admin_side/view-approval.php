<?php
include 'header.php';
include 'config.php';

$uid = $_GET['uid'];
$user_sql = mysqli_query($con, "SELECT * FROM registration WHERE userid='$uid'");
$user_row = mysqli_fetch_assoc($user_sql);

// 1. Check which sections are pending
$pending_items = [];
if($user_row['aboutme_approval_status'] == 'Pending') { $pending_items[] = 'About Me'; }
if($user_row['groom_approval_status'] == 'Pending')   { $pending_items[] = 'Location'; }
if($user_row['photos_approval_status'] == 'Pending')  { $pending_items[] = 'Photos'; }

// 2. Determine if Bulk Actions are needed (More than 1 item pending)
$is_multiple = count($pending_items) > 1;
$pending_string = implode(" + ", $pending_items);
?>

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="col-12 mb-2">
                <h2>Review Changes for User: <?php echo $user_row['name']; ?> (<?php echo $uid; ?>)</h2>
            </div>
        </div>
        <div class="content-body">

            <?php if($is_multiple) { ?>
            <div class="card mb-3 border-primary" style="border: 2px solid #7367f0;">
                <div class="card-header bg-primary text-white text-center justify-content-center">
                    <h4 class="mb-0 text-white"><i class="fa fa-bolt"></i> Bulk Actions (Multiple Updates)</h4>
                </div>
                <div class="card-body mt-2 text-center">
                    <p class="font-medium-2">
                        User has requested updates for: <strong><?php echo $pending_string; ?></strong>. <br>
                        You can approve or reject all of them at once.
                    </p>
                    <form action="approval-action.php" method="post" style="display:inline-block;">
                        <input type="hidden" name="uid" value="<?php echo $uid; ?>">
                        <input type="hidden" name="type" value="all_pending">
                        
                        <button type="submit" name="action" value="approve" class="btn btn-success btn-lg mr-2 shadow">
                            <i class="fa fa-check-double"></i> Accept All (<?php echo $pending_string; ?>)
                        </button>
                        
                        <button type="submit" name="action" value="reject" class="btn btn-danger btn-lg shadow">
                            <i class="fa fa-times-circle"></i> Decline All (<?php echo $pending_string; ?>)
                        </button>
                    </form>
                </div>
            </div>
            <?php } ?>
            <?php if($user_row['aboutme_approval_status'] == 'Pending') { 
                $old_basic = mysqli_fetch_assoc(mysqli_query($con, "SELECT aboutme FROM basic_info WHERE userid='$uid'"));
                $new_basic = mysqli_fetch_assoc(mysqli_query($con, "SELECT aboutme FROM temp_basic_info WHERE userid='$uid'"));
            ?>
            <div class="card">
                <div class="card-header bg-light-primary">
                    <h4 class="mb-0 text-primary">About Me Update</h4>
                </div>
                <div class="card-body mt-2">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Current Live Data</h5>
                            <div class="p-2 border rounded bg-light" style="min-height:80px;">
                                <?php echo nl2br($old_basic['aboutme'] ?? 'No Data'); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5>New Requested Change</h5>
                            <div class="p-2 border rounded border-warning bg-light-warning" style="min-height:80px;">
                                <?php echo nl2br($new_basic['aboutme']); ?>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2 text-right">
                        <form action="approval-action.php" method="post" style="display:inline;">
                            <input type="hidden" name="uid" value="<?php echo $uid; ?>">
                            <input type="hidden" name="type" value="aboutme">
                            <button type="submit" name="action" value="reject" class="btn btn-outline-danger">Reject About Me</button>
                            <button type="submit" name="action" value="approve" class="btn btn-success">Approve About Me</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php } ?>

            <?php if($user_row['groom_approval_status'] == 'Pending') { 
                $old_loc = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM groom_location WHERE userid='$uid'"));
                $new_loc = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM temp_groom_location WHERE userid='$uid'"));
                
                // Helper fields to compare
                $fields = ['country', 'state', 'city', 'citizenship', 'resident'];
            ?>
            <div class="card">
                <div class="card-header bg-light-info">
                    <h4 class="mb-0 text-info">Location Details Update</h4>
                </div>
                <div class="card-body mt-2">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Field</th>
                                <th>Current Live Data</th>
                                <th>New Request</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($fields as $f) { 
                                $old_val = $old_loc[$f] ?? '-';
                                $new_val = $new_loc[$f] ?? '-';
                                // Highlight row if values are different
                                $bg = ($old_val != $new_val) ? 'style="background-color: #e6fffa;"' : ''; 
                            ?>
                            <tr <?php echo $bg; ?>>
                                <td class="text-capitalize font-weight-bold"><?php echo $f; ?></td>
                                <td class="text-muted"><?php echo $old_val; ?></td>
                                <td class="text-dark font-weight-bold"><?php echo $new_val; ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <div class="mt-2 text-right">
                        <form action="approval-action.php" method="post">
                            <input type="hidden" name="uid" value="<?php echo $uid; ?>">
                            <input type="hidden" name="type" value="groom">
                            <button type="submit" name="action" value="reject" class="btn btn-outline-danger">Reject Location</button>
                            <button type="submit" name="action" value="approve" class="btn btn-success">Approve Location</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php } ?>

            <?php if($user_row['photos_approval_status'] == 'Pending') { 
                 $old_pho = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM photos_info WHERE userid='$uid'"));
                 $new_pho = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM temp_photos_info WHERE userid='$uid'"));
                 $photo_fields = ['profilepic', 'photo1', 'photo2', 'photo3'];
            ?>
            <div class="card">
                <div class="card-header bg-light-success">
                    <h4 class="mb-0 text-success">Photos Update</h4>
                </div>
                <div class="card-body mt-2">
                    <p>Comparison of Current vs New Photos:</p>
                    <div class="row">
                        <?php 
                        foreach($photo_fields as $field) {
                            if(!empty($new_pho[$field])) {
                        ?>
                            <div class="col-md-3 text-center mb-3 p-2 border ml-1 mr-1" style="background:#f8f9fa; border-radius:8px;">
                                <h6 class="text-capitalize"><?php echo $field; ?></h6>
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <div style="width:48%;">
                                        <small class="d-block mb-1 text-muted">Current</small>
                                        <?php if(!empty($old_pho[$field])) { ?>
                                            <img src="../userphoto/<?php echo $old_pho[$field]; ?>" class="img-fluid rounded border" style="height:80px; width:100%; object-fit:cover;">
                                        <?php } else { echo "<span class='text-muted'>No Img</span>"; } ?>
                                    </div>
                                    <div style="width:48%;">
                                        <small class="d-block mb-1 text-success font-weight-bold">New</small>
                                        <img src="../userphoto/<?php echo $new_pho[$field]; ?>" class="img-fluid rounded border border-success" style="height:80px; width:100%; object-fit:cover;">
                                    </div>
                                </div>
                            </div>
                        <?php 
                            }
                        }
                        ?>
                    </div>
                    <div class="mt-2 text-right">
                        <form action="approval-action.php" method="post">
                            <input type="hidden" name="uid" value="<?php echo $uid; ?>">
                            <input type="hidden" name="type" value="photos">
                            <button type="submit" name="action" value="reject" class="btn btn-outline-danger">Reject Photos</button>
                            <button type="submit" name="action" value="approve" class="btn btn-success">Approve Photos</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php } ?>

        </div>
    </div>
</div>

<?php include 'footer.php'; ?>