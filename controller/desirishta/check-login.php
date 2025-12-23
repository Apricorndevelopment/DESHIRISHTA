<?php
ob_start();
include 'config.php';

date_default_timezone_set('Asia/Kolkata'); 

// 1. Get Phone/Email Input
if(isset($_GET['phone']) && $_GET['phone'] != '') {
    $phone = $_GET['phone'];
} else {
    $phone = $_POST['phone'];
}

$password = $_POST['password'];
$attempt = $_POST['attempt'];

$final_attempt = ($attempt - 1);
$blocktime = date('Y-m-d H:i:s');

// 2. Check Credentials in Database
$sqlselect = "select * from registration where (phone = '$phone' or email = '$phone') and password = '$password' and otpstatus = 'active' and delete_status != 'delete'";
$resultselect = mysqli_query($con, $sqlselect);
$rowselect = mysqli_fetch_assoc($resultselect);
$check = mysqli_num_rows($resultselect);

// --- SCENARIO A: WRONG CREDENTIALS ---
if($check == '0') {
    
    // If attempts are exhausted, insert a block entry
    if($final_attempt == '0') {
        $sqlblock = "INSERT INTO `loginblock_otp`(`phone_email`, `date_time`) VALUES ('$phone','$blocktime')";
        $resultblock = mysqli_query($con, $sqlblock);
    }
    
    // Check if user is currently blocked
    $sqlcheckblock = "select * from loginblock_otp where phone_email = '$phone'";
    $resultcheckblock = mysqli_query($con, $sqlcheckblock);
    $rowcheckblock = mysqli_fetch_assoc($resultcheckblock);
    $checkblock = mysqli_num_rows($resultcheckblock);
    
    if($checkblock >= 1) {
        $current_time = date("Y-m-d H:i:s");
        $ct = strtotime($current_time);
        $store_time = $rowcheckblock['date_time'];
        $st = strtotime($store_time);
        $add_mins = "1800"; // 30 Minutes
        $block_till = $st + $add_mins;
        $bt = date('M d, Y H:i:s', $block_till);
        
        if($block_till > $ct) {
            // Still Blocked
            ?>
            <form action="login.php" method="post" id="myForm1">
                <input type="hidden" name="credential" value="blocked">
                <input type="hidden" name="attempt" value="0">
                <input type="hidden" name="seconds_left" value="<?php echo $bt; ?>">
                <input type="hidden" name="userinput" value="<?php echo $phone; ?>">
            </form>
            <script>document.getElementById("myForm1").submit();</script>
            <?php
        } else {
            // Block Expired - Delete entry and allow retry
            $sqldeleteblock = "delete from `loginblock_otp` where `phone_email` = '$phone'";
            $resultdeleteblock = mysqli_query($con, $sqldeleteblock);
            ?>
            <form action="login.php" method="post" id="myForm2">
                <input type="hidden" name="attempt" value="3">
            </form>
            <script>document.getElementById("myForm2").submit();</script>
            <?php
        }
    } else {
        // Just wrong password, not blocked yet
        ?>
        <form action="login.php" method="post" id="myForm3">
            <input type="hidden" name="credential" value="invalid">
            <input type="hidden" name="attempt" value="<?php echo $final_attempt; ?>">
        </form>
        <script>document.getElementById("myForm3").submit();</script>
        <?php
    }

// --- SCENARIO B: CORRECT CREDENTIALS ---
} else {
    
    // Even if password is correct, check if user is still under a temporary block from previous attempts
    $sqlcheckblock = "select * from loginblock_otp where phone_email = '$phone'";
    $resultcheckblock = mysqli_query($con, $sqlcheckblock);
    $rowcheckblock = mysqli_fetch_assoc($resultcheckblock);
    $checkblock = mysqli_num_rows($resultcheckblock);
    
    if($checkblock >= 1) {
        // User is blocked
        $current_time = date("Y-m-d H:i:s");
        $ct = strtotime($current_time);
        $store_time = $rowcheckblock['date_time'];
        $st = strtotime($store_time);
        $add_mins = "1800";
        $block_till = $st + $add_mins;
        $bt = date('M d, Y H:i:s', $block_till);
        
        if($block_till > $ct) {
            ?>
            <form action="login.php" method="post" id="myForm4">
                <input type="hidden" name="credential" value="blocked">
                <input type="hidden" name="attempt" value="0">
                <input type="hidden" name="seconds_left" value="<?php echo $bt; ?>">
                <input type="hidden" name="userinput" value="<?php echo $phone; ?>">
            </form>
            <script>document.getElementById("myForm4").submit();</script>
            <?php
        } else {
            // Block expired
            $sqldeleteblock = "delete from `loginblock_otp` where `phone_email` = '$phone'";
            $resultdeleteblock = mysqli_query($con, $sqldeleteblock);
            ?>
            <form action="login.php" method="post" id="myForm5">
                <input type="hidden" name="attempt" value="3">
            </form>
            <script>document.getElementById("myForm5").submit();</script>
            <?php
        }
    } else {
        // --- LOGIN SUCCESSFUL ---
        
        $userid = $rowselect['userid'];
        $user_agent = $_SERVER['HTTP_USER_AGENT'];

        // 1. INACTIVITY POPUP CHECK
        // We check the LAST login time *before* we insert the new log for right now.
        $sql_last_login = "SELECT login_time FROM user_logs WHERE userid = '$userid' ORDER BY id DESC LIMIT 1";
        $res_last_login = mysqli_query($con, $sql_last_login);
        
        if ($res_last_login && mysqli_num_rows($res_last_login) > 0) {
            $row_last = mysqli_fetch_assoc($res_last_login);
            $last_login_time = strtotime($row_last['login_time']);
            $current_time_str = time();
            
            // Calculate difference in days
            $days_diff = round(($current_time_str - $last_login_time) / (60 * 60 * 24));

            // If inactive for more than 15 days, set cookie
            if ($days_diff > 15) {
                setcookie("show_reconnect_popup", "yes", time() + 3600, "/"); // Valid for 1 hour
            }
        }

        // 2. DEVICE DETECTION
        if (preg_match('/mobile/i', $user_agent)) {
            $device = "Mobile";
        } elseif (preg_match('/tablet/i', $user_agent)) {
            $device = "Tablet";
        } else {
            $device = "Desktop";
        }

        // 3. BROWSER DETECTION
        function detectBrowser($agent) {
            if (strpos($agent, 'Edg') !== false) { return "Edge"; }
            elseif (strpos($agent, 'OPR') !== false || strpos($agent, 'Opera') !== false) { return "Opera"; }
            elseif (strpos($agent, 'Brave') !== false) { return "Brave"; }
            elseif (strpos($agent, 'UCBrowser') !== false) { return "UC Browser"; }
            elseif (strpos($agent, 'SamsungBrowser') !== false) { return "Samsung Internet"; }
            elseif (strpos($agent, 'Firefox') !== false) { return "Firefox"; }
            elseif (strpos($agent, 'Safari') !== false && strpos($agent, 'Chrome') === false) { return "Safari"; }
            elseif (strpos($agent, 'Chrome') !== false) { return "Chrome"; }
            else { return "Other"; }
        }
        $browser = detectBrowser($user_agent);

        // 4. IP & LOCATION
        $ip = $_SERVER['REMOTE_ADDR'];
        $locationData = @json_decode(file_get_contents("http://ip-api.com/json/$ip"), true);
        $country = $locationData['country'] ?? '';
        $state   = $locationData['regionName'] ?? '';
        $city    = $locationData['city'] ?? '';

        // 5. INSERT LOGIN LOG
        mysqli_query($con, "
            INSERT INTO user_logs (userid, login_time, browser, device, ip_address, country, state, city)
            VALUES ('$userid', NOW(), '$browser', '$device', '$ip', '$country', '$state', '$city')
        ");

        // 6. UPDATE REGISTRATION (Online Status & Last Login Date)
        // Ensure you have added 'last_login_date' column to your registration table
        mysqli_query($con, "UPDATE registration SET online='yes', last_login_date=NOW() WHERE userid='$userid'");

        // 7. SET COOKIES
        setcookie("dr_userid", $userid, time() + (10 * 365 * 24 * 60 * 60));
        setcookie("dr_email", $rowselect['email'], time() + (10 * 365 * 24 * 60 * 60));
        setcookie("dr_phone", $rowselect['phone'], time() + (10 * 365 * 24 * 60 * 60));
        setcookie("dr_name", $rowselect['name'], time() + (10 * 365 * 24 * 60 * 60));
        setcookie("dr_state", $rowselect['state'], time() + (10 * 365 * 24 * 60 * 60));
        setcookie("dr_gender", $rowselect['gender'], time() + (10 * 365 * 24 * 60 * 60));
        setcookie("dr_country", $rowselect['country'], time() + (10 * 365 * 24 * 60 * 60));
        setcookie("dr_city", $rowselect['city'], time() + (10 * 365 * 24 * 60 * 60));

        // 8. REDIRECT
        header('location:user-dashboard.php');
    }
}
?>