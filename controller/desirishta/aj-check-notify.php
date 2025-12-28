<?php
// Database connection include karein
include 'config.php';

// Header set karein taaki browser isko JSON samjhe
header('Content-Type: application/json');

// Sabse latest 'active' notification fetch karein
$sql = "SELECT * FROM web_notifications WHERE status = 'active' ORDER BY id DESC LIMIT 1";
$result = mysqli_query($con, $sql);

if($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    
    // Agar notification mila toh JSON format mein data return karein
    echo json_encode([
        'status' => 'found',
        'id' => $row['id'],
        'title' => $row['title'],
        'msg' => $row['message'],
        'link' => $row['link']
    ]);
} else {
    // Agar koi active notification nahi hai
    echo json_encode(['status' => 'empty']);
}
?>