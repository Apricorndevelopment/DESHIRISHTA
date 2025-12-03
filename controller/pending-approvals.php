<?php
include 'header.php';
include 'config.php';
?>

<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Pending Approvals</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <div class="row" id="basic-table">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Users Waiting for Approval</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>User ID</th>
                                        <th>Name</th>
                                        <th>Update Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Fetch users who have ANY pending status
                                    $sql = "SELECT * FROM registration 
                                            WHERE groom_approval_status = 'Pending' 
                                               OR photos_approval_status = 'Pending' 
                                               OR aboutme_approval_status = 'Pending'";
                                    
                                    $result = mysqli_query($con, $sql);
                                    
                                    if(mysqli_num_rows($result) > 0) {
                                        while($row = mysqli_fetch_assoc($result)) {
                                            $uid = $row['userid'];
                                            $types = [];
                                            
                                            if($row['groom_approval_status'] == 'Pending') $types[] = "Groom/Bride Location";
                                            if($row['photos_approval_status'] == 'Pending') $types[] = "Photos";
                                            if($row['aboutme_approval_status'] == 'Pending') $types[] = "About Me";
                                            
                                            $type_string = implode(", ", $types);
                                    ?>
                                    <tr>
                                        <td><?php echo $row['userid']; ?></td>
                                        <td><?php echo $row['name']; ?></td> <td><span class="badge badge-pill badge-light-warning mr-1"><?php echo $type_string; ?></span></td>
                                        <td>
                                            <a href="view-approval.php?uid=<?php echo $uid; ?>" class="btn btn-primary btn-sm">View Details</a>
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