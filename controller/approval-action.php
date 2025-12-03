<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uid = $_POST['uid'];
    $type = $_POST['type'];     // 'groom', 'photos', or 'aboutme'
    $action = $_POST['action']; // 'approve' or 'reject'

    // ================= ABOUT ME =================
    if ($type == 'aboutme') {
        if ($action == 'approve') {
            // 1. Fetch Temp Data
            $temp_res = mysqli_query($con, "SELECT * FROM temp_basic_info WHERE userid='$uid'");
            $temp_row = mysqli_fetch_assoc($temp_res);
            $new_about = mysqli_real_escape_string($con, $temp_row['aboutme']);

            // 2. Check if row exists in Main Table
            $check = mysqli_query($con, "SELECT * FROM basic_info WHERE userid='$uid'");
            if(mysqli_num_rows($check) > 0) {
                // Update
                mysqli_query($con, "UPDATE basic_info SET aboutme='$new_about' WHERE userid='$uid'");
            } else {
                // Insert
                mysqli_query($con, "INSERT INTO basic_info (userid, aboutme) VALUES ('$uid', '$new_about')");
            }

            // 3. Update Registration Status & Live Column
            mysqli_query($con, "UPDATE registration SET aboutme_approval_status='Approved', aboutme='Done' WHERE userid='$uid'");
        } else {
            // Reject: Just revert status (User will have to submit again)
            mysqli_query($con, "UPDATE registration SET aboutme_approval_status='Rejected' WHERE userid='$uid'");
        }
        // Clear Temp Data
        mysqli_query($con, "DELETE FROM temp_basic_info WHERE userid='$uid'");
    }

    // ================= GROOM/BRIDE LOCATION =================
    if ($type == 'groom') {
        if ($action == 'approve') {
            $temp_res = mysqli_query($con, "SELECT * FROM temp_groom_location WHERE userid='$uid'");
            $t = mysqli_fetch_assoc($temp_res);

            // Check main table
            $check = mysqli_query($con, "SELECT * FROM groom_location WHERE userid='$uid'");
            if(mysqli_num_rows($check) > 0) {
                $sql = "UPDATE groom_location SET 
                        state='{$t['state']}', city='{$t['city']}', country='{$t['country']}', 
                        citizenship='{$t['citizenship']}', resident='{$t['resident']}', ancestralorigin='{$t['ancestralorigin']}'
                        WHERE userid='$uid'";
                mysqli_query($con, $sql);
            } else {
                $sql = "INSERT INTO groom_location (userid, state, city, country, citizenship, resident, ancestralorigin)
                        VALUES ('$uid', '{$t['state']}', '{$t['city']}', '{$t['country']}', '{$t['citizenship']}', '{$t['resident']}', '{$t['ancestralorigin']}')";
                mysqli_query($con, $sql);
            }

            // Update Status
            // Note: Logic for gender specific 'Done' status update is simplified here.
            mysqli_query($con, "UPDATE registration SET groom_approval_status='Approved' WHERE userid='$uid'");
        } else {
            mysqli_query($con, "UPDATE registration SET groom_approval_status='Rejected' WHERE userid='$uid'");
        }
        mysqli_query($con, "DELETE FROM temp_groom_location WHERE userid='$uid'");
    }

    // ================= PHOTOS =================
    if ($type == 'photos') {
        if ($action == 'approve') {
            $temp_res = mysqli_query($con, "SELECT * FROM temp_photos_info WHERE userid='$uid'");
            $t = mysqli_fetch_assoc($temp_res);

            $check = mysqli_query($con, "SELECT * FROM photos_info WHERE userid='$uid'");
            if(mysqli_num_rows($check) > 0) {
                // Update only if fields are not empty in temp (simplified logic)
                // Ideally temp holds the full final state.
                $sql = "UPDATE photos_info SET 
                        profilepic='{$t['profilepic']}', photo1='{$t['photo1']}', photo2='{$t['photo2']}', 
                        photo3='{$t['photo3']}', photo4='{$t['photo4']}', photo5='{$t['photo5']}'
                        WHERE userid='$uid'";
                mysqli_query($con, $sql);
            } else {
                $sql = "INSERT INTO photos_info (userid, profilepic, photo1, photo2, photo3, photo4, photo5)
                        VALUES ('$uid', '{$t['profilepic']}', '{$t['photo1']}', '{$t['photo2']}', '{$t['photo3']}', '{$t['photo4']}', '{$t['photo5']}')";
                mysqli_query($con, $sql);
            }

            mysqli_query($con, "UPDATE registration SET photos_approval_status='Approved', photosinfo='Done' WHERE userid='$uid'");
        } else {
            mysqli_query($con, "UPDATE registration SET photos_approval_status='Rejected' WHERE userid='$uid'");
        }
        mysqli_query($con, "DELETE FROM temp_photos_info WHERE userid='$uid'");
    }

    // Redirect back to list
    header("Location: pending-approvals.php?msg=processed");
}
?>