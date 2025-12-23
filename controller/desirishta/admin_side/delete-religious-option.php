<?php
// Include the database connection
include '../config.php'; 

// Check if an ID is provided and is numeric
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $option_id = (int)$_GET['id'];

    $delete_sql = "DELETE FROM religion_caste WHERE id = $option_id LIMIT 1";

    if (mysqli_query($con, $delete_sql)) {
        header('location: manage-religious-options.php?msg=deleted');
        exit();
    } else {
        // Database error
        header('location: manage-religious-options.php?err=delete_failed');
        exit();
    }
} else {
    // Invalid ID or no ID provided
    header('location: manage-religious-options.php?err=invalid_id');
    exit();
}
?>