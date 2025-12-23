<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user_id = $_POST['user_id'];
    $admin_username = $_POST['admin_username'];
    $remark_text = mysqli_real_escape_string($con, $_POST['remark_text']);
    
    $file_path = ""; // Default empty
    
    // Handle file upload
    if (isset($_FILES['remark_file']) && $_FILES['remark_file']['error'] == 0) {
        $target_dir = "../uploads/remarks/"; // Ek naya folder "remarks" bana lein "uploads" mein
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
        $file_name = time() . '_' . basename($_FILES["remark_file"]["name"]);
        $target_file = $target_dir . $file_name;
        
        if (move_uploaded_file($_FILES["remark_file"]["tmp_name"], $target_file)) {
            $file_path = $target_file; // DB me save karne ke liye path
        }
    }
    
    // Insert into database
    $sql = "INSERT INTO admin_remarks (user_id, admin_username, remark_text, file_path) 
            VALUES ('$user_id', '$admin_username', '$remark_text', '$file_path')";
            
    if (mysqli_query($con, $sql)) {
        // Success
        header('Location: userprofile-view.php?uid=' . $user_id . '&remark=added');
    } else {
        // Error
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
    
} else {
    echo "Invalid request.";
}
?>