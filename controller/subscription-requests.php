<?php include 'header.php'; include 'config.php'; ?>
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="col-12">
                <h2>Pending Subscription Requests</h2>
            </div>
        </div>
        <div class="content-body">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Request ID</th>
                                    <th>User Details</th>
                                    <th>Plan</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // LEFT JOIN use kiya taaki agar User/Plan delete bhi ho jaye to Request dikhe
                                $sql = "SELECT r.id, r.user_id, r.request_date, p.plan_name, u.name 
                                        FROM tbl_subscription_requests r 
                                        LEFT JOIN tbl_plans p ON r.plan_id = p.id 
                                        LEFT JOIN registration u ON r.user_id = u.userid 
                                        WHERE r.status = 'Pending' 
                                        ORDER BY r.request_date DESC";
                                
                                $res = mysqli_query($con, $sql);
                                
                                if(mysqli_num_rows($res) > 0) {
                                    while($row = mysqli_fetch_assoc($res)) { 
                                        // Fallback agar naam na mile
                                        $user_name = !empty($row['name']) ? $row['name'] : "<span class='text-danger'>Unknown User</span>";
                                        $plan_name = !empty($row['plan_name']) ? $row['plan_name'] : "<span class='text-danger'>Unknown Plan (ID: {$row['plan_id']})</span>";
                                ?>
                                    <tr>
                                        <td>#<?php echo $row['id']; ?></td>
                                        <td>
                                            <b><?php echo $user_name; ?></b><br>
                                            <small>(ID: <?php echo $row['user_id']; ?>)</small>
                                        </td>
                                        <td><span class="badge badge-warning"><?php echo $plan_name; ?></span></td>
                                        <td><?php echo date('d M Y h:i A', strtotime($row['request_date'])); ?></td>
                                        <td>
                                            <a href="approve-subscription.php?req_id=<?php echo $row['id']; ?>&action=approve" class="btn btn-success btn-sm" onclick="return confirm('Approve this plan?');">Approve</a>
                                            <a href="approve-subscription.php?req_id=<?php echo $row['id']; ?>&action=reject" class="btn btn-danger btn-sm" onclick="return confirm('Reject this request?');">Reject</a>
                                        </td>
                                    </tr>
                                <?php 
                                    } 
                                } else {
                                    echo "<tr><td colspan='5' class='text-center'>No Pending Requests Found</td></tr>";
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
<?php include 'footer.php'; ?>