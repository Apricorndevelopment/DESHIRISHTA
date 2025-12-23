<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);

    // Get image to delete file
    $sql_img = "SELECT image FROM `dummy-profile` WHERE id='$id'";
    $res_img = mysqli_query($con, $sql_img);
    if ($row_img = mysqli_fetch_assoc($res_img)) {
        $file = "../images/profiles/" . $row_img['image'];
        if (file_exists($file)) {
            unlink($file);
        }
    }

    $sql = "DELETE FROM `dummy-profile` WHERE id='$id'";
    if (mysqli_query($con, $sql)) {
        header("Location: view-profiles.php?msg=deleted");
    } else {
        echo "Error deleting record";
    }
}
?>