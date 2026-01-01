<?php
include 'header.php';
include 'config.php';

// 1. Login Check & Trim ID
if(!isset($_COOKIE['dr_userid']) || empty($_COOKIE['dr_userid'])) {
    echo "<script>window.location.href='login.php';</script>";
    exit;
}
$userid = mysqli_real_escape_string($con, trim($_COOKIE['dr_userid']));

// 2. Fetch User's Current Subscription Details
$user_sql = "SELECT plan_id, plan_expiry_date FROM registration WHERE userid='$userid'";
$user_res = mysqli_query($con, $user_sql);
$user_data = mysqli_fetch_assoc($user_res);

$current_plan_id = $user_data['plan_id'] ?? 1; // Default Free
$expiry_date = $user_data['plan_expiry_date'];

// 3. Fetch Pending Requests
$pending_plans = [];
$req_sql = "SELECT plan_id FROM tbl_subscription_requests WHERE user_id='$userid' AND status='Pending'";
$req_res = mysqli_query($con, $req_sql);
while($r = mysqli_fetch_assoc($req_res)) {
    $pending_plans[] = $r['plan_id'];
}
?>

<section>
    <div class="db">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-lg-3">
                    <?php include 'user-sidebar.php'; ?>
                </div>
                <div class="col-md-8 col-lg-9">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="db-tit">Plan Details</h2>
                        </div>

                        <?php
                        // 4. Fetch All Plans
                        $plan_sql = "SELECT * FROM tbl_plans ORDER BY id ASC";
                        $plan_res = mysqli_query($con, $plan_sql);

                        if(mysqli_num_rows($plan_res) > 0) {
                            while($plan = mysqli_fetch_assoc($plan_res)) {
                                $pid = $plan['id'];
                                $pname = $plan['plan_name'];
                                $validity_days = $plan['validity_days'];
                                $contacts = $plan['contacts_per_day'];
                                $price = $plan['price'];
                                
                                // Logic
                                $is_active = ($pid == $current_plan_id);
                                $is_pending = in_array($pid, $pending_plans);
                                
                                // Show Expiry only for active plan
                                $show_date = ($is_active && $expiry_date) ? date('d F Y', strtotime($expiry_date)) : "N/A";
                        ?>
                        
                        <div class="col-md-4 db-sec-com">
                            <div class="db-pro-stat">
                                <h6 class="tit-top-curv"><?php echo htmlspecialchars($pname); ?> Plan</h6>
                                <div class="db-plan-card">
                                    <img src="images/icon/plan.png" alt="">
                                </div>
                                <div class="db-plan-detil">
                                    <ul>
                                        <li>Plan Name: <strong><?php echo htmlspecialchars($pname); ?></strong></li>
                                        <li>Validity: <strong><?php echo $validity_days; ?> Days</strong></li>
                                        <li>Contacts: <strong><?php echo $contacts; ?> / Day</strong></li>
                                        <li>Valid Till: <strong><?php echo $is_active ? $show_date : '-'; ?></strong></li>
                                        
                                        <li>
                                            <?php if($is_active) { ?>
                                                <a href="#" class="cta-3" style="background-color: #28a745; cursor: default;">Active</a>
                                            <?php } elseif($is_pending) { ?>
                                                <button class="cta-3" style="background-color: #ffc107; color: #000; cursor: not-allowed; border:none; width:100%;">Request Pending</button>
                                            <?php } else { ?>
                                                <form action="submit-plan-request.php" method="POST">
                                                    <input type="hidden" name="plan_id" value="<?php echo $pid; ?>">
                                                    <button type="submit" class="cta-3" style="border:none; width:100%; cursor:pointer;">
                                                        Upgrade (₹<?php echo $price; ?>)
                                                    </button>
                                                </form>
                                            <?php } ?>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <?php 
                            } 
                        } else {
                            echo '<div class="col-md-12"><p>No subscription plans available.</p></div>';
                        }
                        ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>