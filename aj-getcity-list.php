<?php
include 'config.php';

if(isset($_POST['state'])) {
    // Agar state value mein underscore (_) hai toh use space se badlein (DB matching ke liye)
    $state = str_replace("_", " ", $_POST['state']);
    
    $sql = "SELECT * FROM city_state WHERE state = '$state' ORDER BY city ASC";
    $result = mysqli_query($con, $sql);
    
    echo '<option value="">Select City</option>';
    
    while($row = mysqli_fetch_assoc($result)) {
        echo '<option value="'.$row['city'].'">'.$row['city'].'</option>';
    }
}
?>