<?php
include 'header.php';
include 'config.php'; // Ensure DB connection is available

// Check if user is logged in to handle button logic
$is_logged_in = isset($_COOKIE['dr_userid']);
$user_id = $is_logged_in ? $_COOKIE['dr_userid'] : 0;
?>

    <section>
        <div class="plans-ban">
            <div class="container">
                <div class="row">
                    <span class="pri">Pricing</span>
                    <h1>Get Started <br> Pick your Plan Now</h1>
                    <p>Leading Matrimony & Genuine Matchmaking Service At An Affordable Price</p>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="plans-main">
            <div class="container">
                <div class="row">
                    <ul>
                        <?php
                        // 1. Fetch Plans from Database
                        $sql = "SELECT * FROM tbl_plans ORDER BY id ASC";
                        $result = mysqli_query($con, $sql);
                        
                        $counter = 0; // To track iteration for styling (Free/Gold/Platinum)

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                
                                // 2. Determine Styles based on order (0=Free, 1=Gold, 2=Platinum)
                                $list_class = "pri-free"; // Default
                                $box_class = "pri-box";
                                $pop_badge = "";

                                if ($counter == 1) { // 2nd Plan (Gold style)
                                    $list_class = "pri-gold";
                                    $box_class = "pri-box pri-box-pop";
                                    $pop_badge = '<span class="pop-pln">Most popular plan</span>';
                                } elseif ($counter == 2) { // 3rd Plan (Platinum style)
                                    $list_class = "pri-platinum";
                                }

                                // 3. Check for Pending Requests (If user is logged in)
                                $is_pending = false;
                                if ($is_logged_in) {
                                    $check_req = mysqli_query($con, "SELECT * FROM tbl_subscription_requests WHERE user_id='$user_id' AND plan_id='{$row['id']}' AND status='Pending'");
                                    if (mysqli_num_rows($check_req) > 0) {
                                        $is_pending = true;
                                    }
                                }
                        ?>

                        <li>
                            <div class="<?php echo $box_class; ?>">
                                <?php echo $pop_badge; ?>
                                
                                <h2><?php echo htmlspecialchars($row['plan_name']); ?></h2>
                                
                                <?php if (!$is_logged_in) { ?>
                                    <a href="sign-up.php" class="cta"><?php echo htmlspecialchars($row['button_text']); ?></a>
                                <?php } elseif ($is_pending) { ?>
                                    <button class="cta" style="background:#ccc; cursor:not-allowed;" disabled>Request Pending</button>
                                <?php } else { ?>
                                    <form action="submit-plan-request.php" method="POST">
                                        <input type="hidden" name="plan_id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" class="cta" style="border:none; width:100%; cursor:pointer;">
                                            <?php echo htmlspecialchars($row['button_text']); ?>
                                        </button>
                                    </form>
                                <?php } ?>

                                <span class="pri-cou"><b>₹ <?php echo htmlspecialchars($row['price']); ?></b></span>

                                <ol class="pricing-list <?php echo $list_class; ?>">
                                    <li><i class="bi bi-check-lg"></i> View <?php echo $row['contacts_per_day']; ?> contact details/day</li>
                                    <li><i class="bi bi-check-lg"></i> Validity – <?php echo $row['validity_days']; ?> days</li>
                                    
                                    <?php 
                                    $details = explode("\n", $row['details']);
                                    foreach($details as $line) {
                                        if(trim($line) != "") {
                                            echo '<li><i class="bi bi-check-lg"></i> '.htmlspecialchars($line).'</li>';
                                        }
                                    }
                                    ?>
                                </ol>
                            </div>
                        </li>

                        <?php 
                                $counter++; 
                            } 
                        } else {
                            echo "<p class='text-center'>No plans currently available.</p>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <style>
        /* Default green tick (Free Plan) */
        .pri-free li i {
            background: #34A853;
            color: #fff;
            font-size: 14px;
            padding: 8px;
            border-radius: 50%;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            width: 28px;
            height: 28px;
            margin-right: 10px;
        }

        /* Gold style */
        .pri-gold li i {
            background: #34A853;
            color: #fff;
            font-size: 14px;
            padding: 8px;
            border-radius: 50%;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            width: 28px;
            height: 28px;
            margin-right: 10px;
            border: 2px solid #d4af37;
        }

        /* Platinum / Premium */
        .pri-platinum li i {
            background: #34A853;
            color: #000000ff;
            font-size: 14px;
            padding: 8px;
            border-radius: 50%;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            width: 28px;
            height: 28px;
            margin-right: 10px;
            border: 2px solid #b7b7b7;
        }

        /* List alignment clean */
        .pricing-list li {
            list-style: none;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            text-align: left; /* Ensure text aligns left nicely */
        }
        
        /* Ensure buttons look clickable in form */
        form .cta:hover {
            opacity: 0.9;
        }
    </style>

<?php
include 'footer.php';
?>