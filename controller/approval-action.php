<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uid = $_POST['uid'];
    $type = $_POST['type'];     // 'groom', 'photos', 'aboutme', or 'all_pending'
    $action = $_POST['action']; // 'approve' or 'reject'

    // ======================================================
    // 1. BULK ACTION LOGIC (Check what is pending & Process)
    // ======================================================
    if ($type == 'all_pending') {
        
        // Fetch current status of the user
        $check = mysqli_query($con, "SELECT * FROM registration WHERE userid='$uid'");
        $row = mysqli_fetch_assoc($check);

        // A. Process About Me (if pending)
        if($row['aboutme_approval_status'] == 'Pending') {
            processAboutMe($con, $uid, $action);
        }

        // B. Process Groom/Location (if pending)
        if($row['groom_approval_status'] == 'Pending') {
            processGroom($con, $uid, $action);
        }

        // C. Process Photos (if pending)
        if($row['photos_approval_status'] == 'Pending') {
            processPhotos($con, $uid, $action);
        }

    } 
    // ======================================================
    // 2. INDIVIDUAL ACTION LOGIC
    // ======================================================
    else {
        if ($type == 'aboutme') {
            processAboutMe($con, $uid, $action);
        }
        elseif ($type == 'groom') {
            processGroom($con, $uid, $action);
        }
        elseif ($type == 'photos') {
            processPhotos($con, $uid, $action);
        }
    }

    // Redirect back to the Pending List
    header("Location: pending-approvals.php?msg=processed");
    exit();
}

// =================================================================================
//                               HELPER FUNCTIONS
// =================================================================================

// --- FUNCTION: Process About Me ---
function processAboutMe($con, $uid, $action) {
    if ($action == 'approve') {
        // 1. Fetch Temp Data
        $temp_res = mysqli_query($con, "SELECT * FROM temp_basic_info WHERE userid='$uid'");
        $temp_row = mysqli_fetch_assoc($temp_res);
        
        if($temp_row) {
            $new_about = mysqli_real_escape_string($con, $temp_row['aboutme']);

            // 2. Update/Insert Main Table
            $check = mysqli_query($con, "SELECT * FROM basic_info WHERE userid='$uid'");
            if(mysqli_num_rows($check) > 0) {
                mysqli_query($con, "UPDATE basic_info SET aboutme='$new_about' WHERE userid='$uid'");
            } else {
                mysqli_query($con, "INSERT INTO basic_info (userid, aboutme) VALUES ('$uid', '$new_about')");
            }
            
            // 3. Update Status
            mysqli_query($con, "UPDATE registration SET aboutme_approval_status='Approved', aboutme='Done' WHERE userid='$uid'");
        }
    } else {
        // Reject
        mysqli_query($con, "UPDATE registration SET aboutme_approval_status='Rejected' WHERE userid='$uid'");
    }
    // Clear Temp
    mysqli_query($con, "DELETE FROM temp_basic_info WHERE userid='$uid'");
}

// --- FUNCTION: Process Groom/Bride Location ---
function processGroom($con, $uid, $action) {
    if ($action == 'approve') {
        $temp_res = mysqli_query($con, "SELECT * FROM temp_groom_location WHERE userid='$uid'");
        $t = mysqli_fetch_assoc($temp_res);

        if($t) {
            // Update/Insert Main Table
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
            // Note: For gender specific 'Done' status (bridelocation vs groomlocation), 
            // you might want to fetch gender from registration here if needed, but 'Approved' status is sufficient for Admin tracking.
            mysqli_query($con, "UPDATE registration SET groom_approval_status='Approved' WHERE userid='$uid'");
        }
    } else {
        // Reject
        mysqli_query($con, "UPDATE registration SET groom_approval_status='Rejected' WHERE userid='$uid'");
    }
    // Clear Temp
    mysqli_query($con, "DELETE FROM temp_groom_location WHERE userid='$uid'");
}

// --- FUNCTION: Process Photos ---
function processPhotos($con, $uid, $action) {
    if ($action == 'approve') {
        $temp_res = mysqli_query($con, "SELECT * FROM temp_photos_info WHERE userid='$uid'");
        $t = mysqli_fetch_assoc($temp_res);

        if($t) {
            // Update/Insert Main Table
            $check = mysqli_query($con, "SELECT * FROM photos_info WHERE userid='$uid'");
            if(mysqli_num_rows($check) > 0) {
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

            // Update Status
            mysqli_query($con, "UPDATE registration SET photos_approval_status='Approved', photosinfo='Done' WHERE userid='$uid'");
        }
    } else {
        // Reject
        mysqli_query($con, "UPDATE registration SET photos_approval_status='Rejected' WHERE userid='$uid'");
    }
    // Clear Temp
    mysqli_query($con, "DELETE FROM temp_photos_info WHERE userid='$uid'");
}
?>