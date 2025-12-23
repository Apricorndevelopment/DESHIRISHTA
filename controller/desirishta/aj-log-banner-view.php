<?php
include 'config.php'; 

if (isset($_COOKIE['dr_userid'])) {
    $userid = $_COOKIE['dr_userid'];
} else {
    echo "Error: User not authenticated.";
    exit;
}

if (isset($_POST['banner_ids'])) {
    $banner_ids_raw = $_POST['banner_ids'];
    $banner_ids = explode(',', $banner_ids_raw);
    
    $stmt = mysqli_prepare($con, "INSERT INTO user_banner_logs (user_id, banner_id, view_date) VALUES (?, ?, CURDATE()) ON DUPLICATE KEY UPDATE view_date = VALUES(view_date)");
    
    foreach ($banner_ids as $banner_id) {
        $clean_banner_id = (int)$banner_id; 
        
        if ($clean_banner_id > 0) {
            mysqli_stmt_bind_param($stmt, "si", $userid, $clean_banner_id);
            mysqli_stmt_execute($stmt);
        }
    }
    
    mysqli_stmt_close($stmt);
    echo "Logs recorded successfully";
} else {
    echo "Error: Missing banner IDs.";
}
?>