<?php
include 'config.php';

if(isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);

    // 1. Delete karne se pehle image ka naam get karein
    $sql_select = "SELECT image FROM tbl_recent_couples WHERE id = '$id'";
    $result = mysqli_query($con, $sql_select);
    
    if($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $image_name = $row['image'];
        $file_path = "../images/couples/" . $image_name;

        // 2. Server se image file delete karein
        if (file_exists($file_path)) {
            unlink($file_path);
        }
    }

    // 3. Database se record delete karein
    $sql_delete = "DELETE FROM tbl_recent_couples WHERE id = '$id'";
    
    if (mysqli_query($con, $sql_delete)) {
        // Success
        header("Location: view-couples.php?status=deleted");
        exit();
    } else {
        // Error
        echo "Error deleting record: " . mysqli_error($con);
    }

} else {
    // Agar ID na mile toh redirect karein
    header("Location: view-couples.php");
    exit();
}
?>