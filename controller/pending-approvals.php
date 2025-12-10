<?php
include 'header.php';
include 'config.php';
?>

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <h2 class="content-header-title float-left mb-0">Pending Approvals</h2>
            </div>
        </div>
        <div class="content-body">
            <div class="row" id="basic-table">
                <div class="col-12">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>User ID</th>
                                        <th>Name</th>
                                        <th>Update Type (Combined)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Logic: Hum wahi users fetch karenge jinka koi bhi ek status 'Pending' ho
                                    $sql = "SELECT * FROM registration 
                                            WHERE groom_approval_status = 'Pending' 
                                               OR photos_approval_status = 'Pending' 
                                               OR aboutme_approval_status = 'Pending'";
                                    
                                    $result = mysqli_query($con, $sql);
                                    
                                    if(mysqli_num_rows($result) > 0) {
                                        while($row = mysqli_fetch_assoc($result)) {
                                            $uid = $row['userid'];
                                            $types = []; // Yahan hum saare pending types store karenge
                                            
                                            if($row['groom_approval_status'] == 'Pending') {
                                                $types[] = "Groom/Bride Location";
                                            }
                                            if($row['photos_approval_status'] == 'Pending') {
                                                $types[] = "Photos";
                                            }
                                            if($row['aboutme_approval_status'] == 'Pending') {
                                                $types[] = "About Me";
                                            }
                                            
                                            // Array ko string mein convert karein (comma separated)
                                            $type_string = implode(" + ", $types);
                                    ?>
                                    <tr>
                                        <td><?php echo $row['userid']; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><span class="badge badge-pill badge-light-warning mr-1"><?php echo $type_string; ?></span></td>
                                        <td>
                                            <a href="view-approval.php?uid=<?php echo $uid; ?>" class="btn btn-primary btn-sm">View & Act</a>
                                        </td>
                                    </tr>
                                    <?php 
                                        }
                                    } else {
                                        echo "<tr><td colspan='4' class='text-center'>No Pending Approvals Found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>