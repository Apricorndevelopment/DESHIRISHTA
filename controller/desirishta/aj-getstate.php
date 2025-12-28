<?php
include 'config.php';

if(isset($_POST['country'])) {
    $country = $_POST['country'];
    
    // Yahan hum check kar rahe hain ki city_state table mein 'country' column ho
    // Agar aapke table mein column ka naam alag hai (jaise 'country_name'), toh use replace karein
    $sql = "SELECT DISTINCT state FROM city_state WHERE country = '$country' ORDER BY state ASC";
    $result = mysqli_query($con, $sql);
    
    echo '<option value="">Select State</option>';
    
    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            // State value mein spaces ko underscore se replace kiya ja raha hai (existing logic ke hisaab se)
            $safe_val = str_replace(" ", "_", $row['state']);
            echo '<option value="'.$safe_val.'">'.$row['state'].'</option>';
        }
    } else {
        echo '<option value="">No states found</option>';
    }
}
?>