<?php
include 'header.php';
include 'config.php';

$uid = $_GET['uid'];
$user_sql = mysqli_query($con, "SELECT * FROM registration WHERE userid='$uid'");
$user_row = mysqli_fetch_assoc($user_sql);
?>

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="col-12 mb-2">
                <h2>Review Changes for User: <?php echo $user_row['name']; ?> (<?php echo $uid; ?>)</h2>
            </div>
        </div>
        <div class="content-body">

            <?php if($user_row['aboutme_approval_status'] == 'Pending') { 
                // Fetch Old Data
                $old_basic = mysqli_fetch_assoc(mysqli_query($con, "SELECT aboutme FROM basic_info WHERE userid='$uid'"));
                // Fetch New Data
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
                            <div class="p-2 border rounded bg-light">
                                <?php echo nl2br($old_basic['aboutme'] ?? 'No Data'); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5>New Requested Change</h5>
                            <div class="p-2 border rounded border-warning bg-light-warning">
                                <?php echo nl2br($new_basic['aboutme']); ?>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2 text-right">
                        <form action="approval-action.php" method="post" style="display:inline;">
                            <input type="hidden" name="uid" value="<?php echo $uid; ?>">
                            <input type="hidden" name="type" value="aboutme">
                            <button type="submit" name="action" value="reject" class="btn btn-outline-danger">Reject</button>
                            <button type="submit" name="action" value="approve" class="btn btn-success">Approve</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php } ?>

            <?php if($user_row['groom_approval_status'] == 'Pending') { 
                $old_loc = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM groom_location WHERE userid='$uid'"));
                $new_loc = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM temp_groom_location WHERE userid='$uid'"));
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
                            <tr>
                                <td>Country</td>
                                <td><?php echo $old_loc['country'] ?? '-'; ?></td>
                                <td class="text-warning font-weight-bold"><?php echo $new_loc['country']; ?></td>
                            </tr>
                            <tr>
                                <td>State</td>
                                <td><?php echo $old_loc['state'] ?? '-'; ?></td>
                                <td class="text-warning font-weight-bold"><?php echo $new_loc['state']; ?></td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td><?php echo $old_loc['city'] ?? '-'; ?></td>
                                <td class="text-warning font-weight-bold"><?php echo $new_loc['city']; ?></td>
                            </tr>
                             <tr>
                                <td>Citizenship</td>
                                <td><?php echo $old_loc['citizenship'] ?? '-'; ?></td>
                                <td class="text-warning font-weight-bold"><?php echo $new_loc['citizenship']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="mt-2 text-right">
                        <form action="approval-action.php" method="post">
                            <input type="hidden" name="uid" value="<?php echo $uid; ?>">
                            <input type="hidden" name="type" value="groom">
                            <button type="submit" name="action" value="reject" class="btn btn-outline-danger">Reject</button>
                            <button type="submit" name="action" value="approve" class="btn btn-success">Approve</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php } ?>

             <?php if($user_row['photos_approval_status'] == 'Pending') { 
                 $new_photos = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM temp_photos_info WHERE userid='$uid'"));
            ?>
            <div class="card">
                <div class="card-header bg-light-success">
                    <h4 class="mb-0 text-success">Photos Update</h4>
                </div>
                <div class="card-body mt-2">
                    <p>User has uploaded new photos. Below are the <b>NEW</b> photos requested.</p>
                    <div class="row">
                        <?php 
                        $photo_fields = ['profilepic', 'photo1', 'photo2', 'photo3', 'photo4', 'photo5'];
                        foreach($photo_fields as $field) {
                            if(!empty($new_photos[$field])) {
                                // Note: Ensure path is correct relative to admin folder. 
                                // Assuming 'userphoto' is in root, so '../userphoto/'
                                echo '<div class="col-md-2 text-center mb-2">';
                                echo '<img src="../userphoto/'.$new_photos[$field].'" class="img-fluid rounded border" style="height:100px; width:100px; object-fit:cover;">';
                                echo '<p class="small mt-1">'.$field.'</p>';
                                echo '</div>';
                            }
                        }
                        ?>
                    </div>
                    <div class="mt-2 text-right">
                        <form action="approval-action.php" method="post">
                            <input type="hidden" name="uid" value="<?php echo $uid; ?>">
                            <input type="hidden" name="type" value="photos">
                            <button type="submit" name="action" value="reject" class="btn btn-outline-danger">Reject</button>
                            <button type="submit" name="action" value="approve" class="btn btn-success">Approve</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php } ?>

        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
