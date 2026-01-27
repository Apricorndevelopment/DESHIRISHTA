<?php
include 'config.php'; 

if(isset($_POST['user_id'])) {
    $userid = $_POST['user_id'];

    // Database mein 'reject_popup' flag ko 0 (zero) set karein taaki popup dobara na aaye
    $sql = "UPDATE registration SET reject_popup = '0' WHERE userid = '$userid'";
    
    if(mysqli_query($con, $sql)) {
        echo "SUCCESS"; // Yehi string JavaScript dhoond raha hai
    } else {
        echo "ERROR: " . mysqli_error($con);
    }
} else {
    echo "No User ID Found";
}
?>