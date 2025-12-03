<?php
include '../config.php';

// चेक करें कि ID सेट है या नहीं
if(isset($_GET['id']) && $_GET['id'] != '') {
    
    $id = mysqli_real_escape_string($con, $_GET['id']);

    // 1. पहले फाइल का नाम पता करें ताकि उसे फोल्डर से डिलीट कर सकें
    $sql_select = "SELECT media_file FROM admin_communication WHERE id = '$id'";
    $result_select = mysqli_query($con, $sql_select);
    $row = mysqli_fetch_assoc($result_select);

    // अगर फाइल मौजूद है, तो उसे सर्वर से हटाएं
    if($row && !empty($row['media_file'])) {
        $file_path = "../uploads/" . $row['media_file'];
        if(file_exists($file_path)) {
            unlink($file_path); // फाइल डिलीट करें
        }
    }

    // 2. अब डेटाबेस से रिकॉर्ड डिलीट करें
    $sql_delete = "DELETE FROM admin_communication WHERE id = '$id'";
    
    if(mysqli_query($con, $sql_delete)) {
        // सफलता
        header("Location: manage-communication.php?success=Communication deleted successfully.");
    } else {
        // डेटाबेस एरर
        header("Location: manage-communication.php?error=Error deleting record: " . mysqli_error($con));
    }

} else {
    // अगर ID नहीं मिली
    header("Location: manage-communication.php?error=Invalid ID provided.");
}
?>