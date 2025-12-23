// controller/delete-dropdown-option.php

<?php
include '../config.php'; // Adjust path if necessary
session_start();

// Basic Admin Authentication Check (Add your actual check here)

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $option_id = (int)$_GET['id'];

    $delete_sql = "DELETE FROM master_dropdown_options WHERE id = $option_id LIMIT 1";

    if (mysqli_query($con, $delete_sql)) {
        header('location: manage-basic-options.php?msg=deleted');
        exit();
    } else {
        // Handle error
        header('location: manage-basic-options.php?err=delete_failed');
        exit();
    }
} else {
    header('location: manage-basic-options.php?err=invalid_id');
    exit();
}
?>