<?php
include 'config.php'; // Include database connection
session_start(); // Assuming admin uses sessions

// Function to upload media file
function uploadMedia($file) {
    $target_dir = "../uploads/";
    $unique_name = time() . '_' . basename($file["name"]);
    $target_file = $target_dir . $unique_name;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Check file size (e.g., limit to 2MB)
    if ($file["size"] > 20000000000) {
        return ['success' => false, 'message' => "Sorry, your file is too large."];
    }

    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        return ['success' => true, 'filename' => $unique_name];
    } else {
        return ['success' => false, 'message' => "Sorry, there was an error uploading your file."];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 1. Sanitize and collect data
    $type = mysqli_real_escape_string($con, $_POST['type']);
    $scope = mysqli_real_escape_string($con, $_POST['target_scope']);
    $subject = mysqli_real_escape_string($con, $_POST['subject']);
    $body = mysqli_real_escape_string($con, $_POST['body_content']);
    $admin_id = 1; // Replace with $_SESSION['admin_id']

    $target_users = null;
    if ($scope == 'specific' && isset($_POST['target_users'])) {
        $target_users_array = $_POST['target_users'];
        $target_users = mysqli_real_escape_string($con, implode(',', $target_users_array));
    }
    
    $media_filename = null;
    $valid_from = date('Y-m-d H:i:s'); // Default to current time for both
    $valid_till = null;

    if ($type == 'banner') {
        $valid_from = mysqli_real_escape_string($con, $_POST['valid_from']);
        $valid_till = mysqli_real_escape_string($con, $_POST['valid_till']);
        
        // 2. Handle file upload for banner
        if (isset($_FILES['media_file']) && $_FILES['media_file']['error'] == 0) {
            $upload_result = uploadMedia($_FILES['media_file']);
            if ($upload_result['success']) {
                $media_filename = $upload_result['filename'];
            } else {
                // Handle upload error
                header("Location: manage-communication.php?error=" . urlencode($upload_result['message']));
                exit;
            }
        }
    }
    
    // 3. Prepare and Execute SQL Insert
    
    // Using prepared statement for security against SQL injection
    $stmt = mysqli_prepare($con, "INSERT INTO admin_communication (type, target_scope, target_users, subject, body_content, media_file, valid_from, valid_till, admin_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    // Adjust valid_from and valid_till for email type (setting valid_till to a far future date)
    if ($type == 'email') {
        $valid_till_db = '2099-12-31 23:59:59'; // Not relevant for emails, but database needs a value
    } else {
        $valid_till_db = $valid_till;
    }
    
    // Bind parameters: s-string, s-string, s-string, s-string, s-string, s-string, s-string, s-string, i-integer
    mysqli_stmt_bind_param($stmt, "ssssssssi", $type, $scope, $target_users, $subject, $body, $media_filename, $valid_from, $valid_till_db, $admin_id);
    
    if (mysqli_stmt_execute($stmt)) {
        $communication_id = mysqli_insert_id($con);
        
        if ($type == 'email') {
            // Redirect to the email sender logic immediately after DB insertion
            header("Location: send-promo-email.php?id=" . $communication_id);
        } else {
            // Banner created successfully
            header("Location: manage-communication.php?success=Banner created successfully");
        }
        
    } else {
        header("Location: manage-communication.php?error=Database insert failed: " . mysqli_error($con));
    }
    
    mysqli_stmt_close($stmt);

} else {
    header("Location: manage-communication.php");
}
?>