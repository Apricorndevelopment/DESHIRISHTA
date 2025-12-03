<?php
include 'header.php';
include 'config.php';

$msg = "";
$active_tab = "country"; // Default tab

// --- 1. HANDLE DELETE ---
if (isset($_GET['del_id']) && isset($_GET['type'])) {
    $id = mysqli_real_escape_string($con, $_GET['del_id']);
    $type = $_GET['type'];

    if ($type == 'country') {
        mysqli_query($con, "DELETE FROM countries WHERE id='$id'");
        $active_tab = "country";
    } elseif ($type == 'state_city') {
        mysqli_query($con, "DELETE FROM city_state WHERE id='$id'");
        $active_tab = "state_city";
    }
    $msg = "<div class='alert alert-danger'>Record Deleted Successfully!</div>";
}

// --- 2. HANDLE UPDATE (EDIT) ---
if (isset($_POST['update_data'])) {
    $id = $_POST['edit_id'];
    $type = $_POST['edit_type'];

    if ($type == 'country') {
        $country = mysqli_real_escape_string($con, $_POST['country']);
        // Check for duplicate before updating
        $check = mysqli_query($con, "SELECT id FROM countries WHERE country='$country' AND id != '$id'");
        if (mysqli_num_rows($check) == 0) {
            mysqli_query($con, "UPDATE countries SET country='$country' WHERE id='$id'");
            $msg = "<div class='alert alert-success'>Record Updated Successfully!</div>";
        } else {
            $msg = "<div class='alert alert-warning'>Update Failed: Country already exists!</div>";
        }
        $active_tab = "country";
    } elseif ($type == 'state_city') {
        $state = mysqli_real_escape_string($con, $_POST['state']);
        $city = mysqli_real_escape_string($con, $_POST['city']);
        
        // Check for duplicate before updating
        // $check = mysqli_query($con, "SELECT id FROM city_state WHERE state='$state' AND city='$city' AND id != '$id'");
      
      $check = mysqli_query($con, "
    SELECT id FROM city_state 
    WHERE state='$state' 
    AND (city='$city' OR city LIKE '$city %')
    AND id != '$id'
");

        if (mysqli_num_rows($check) == 0) {
            mysqli_query($con, "UPDATE city_state SET state='$state', city='$city' WHERE id='$id'");
            $msg = "<div class='alert alert-success'>Record Updated Successfully!</div>";
        } else {
            $msg = "<div class='alert alert-warning'>Update Failed: This State-City combination already exists!</div>";
        }
        $active_tab = "state_city";
    }
    
    // Refresh page after a slight delay to show message or use simple redirect
    // echo "<script>window.location.href='manage-location-attributes.php';</script>";
}

// --- 3. HANDLE CSV UPLOAD WITH DUPLICATE CHECK ---
// if (isset($_POST['upload_csv'])) {
//     $type = $_POST['data_type'];
//     $filename = $_FILES["file"]["tmp_name"];

//     if ($_FILES["file"]["size"] > 0) {
//         $file = fopen($filename, "r");
//         $inserted_count = 0;
//         $skipped_count = 0;

//         while (($getData = fgetcsv($file, 10000, ",")) !== FALSE) {
//             if ($type == 'country') {
//                 // CSV Format: Col 1 = Country Name
//                 $val = mysqli_real_escape_string($con, $getData[0]);
                
//                 if (!empty($val)) {
//                     // DUPLICATE CHECK
//                     $checkQuery = mysqli_query($con, "SELECT id FROM countries WHERE country='$val'");
//                     if (mysqli_num_rows($checkQuery) == 0) {
//                         mysqli_query($con, "INSERT INTO countries (country) VALUES ('$val')");
//                         $inserted_count++;
//                     } else {
//                         $skipped_count++;
//                     }
//                 }
//                 $active_tab = "country";

//             } elseif ($type == 'state_city') {
//                 // CSV Format: Col 1 = State, Col 2 = City
//                 $state = mysqli_real_escape_string($con, $getData[0]);
//                 $city = mysqli_real_escape_string($con, $getData[1]);
                
//                 if (!empty($state) && !empty($city)) {
//                     // DUPLICATE CHECK
//                     $checkQuery = mysqli_query($con, "SELECT id FROM city_state WHERE state='$state' AND city='$city'");
//                     if (mysqli_num_rows($checkQuery) == 0) {
//                         mysqli_query($con, "INSERT INTO city_state (state, city) VALUES ('$state', '$city')");
//                         $inserted_count++;
//                     } else {
//                         $skipped_count++;
//                     }
//                 }
//                 $active_tab = "state_city";
//             }
//         }
//         fclose($file);
//         $msg = "<div class='alert alert-success'>Process Complete! Inserted: <b>$inserted_count</b>, Skipped (Duplicates): <b>$skipped_count</b></div>";
//     } else {
//         $msg = "<div class='alert alert-danger'>Invalid File</div>";
//     }
// }
// --- 3. HANDLE CSV UPLOAD WITH STRONG DUPLICATE CHECK ---
// --- 3. HANDLE CSV UPLOAD WITH STRONG DUPLICATE CHECK (FINAL FIXED VERSION) ---

if (isset($_POST['upload_csv'])) {
    $type = $_POST['data_type'];
    $filename = $_FILES["file"]["tmp_name"];

    if ($_FILES["file"]["size"] > 0) {
        $file = fopen($filename, "r");
        $inserted_count = 0;
        $skipped_count   = 0;
        $line_number     = 0; // for debugging if needed

        // Skip header row if your CSV has header (State,City)
        // Remove next line if your CSV has no header
        fgetcsv($file, 10000, ","); 

        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE) {
            $line_number++;

            // ---------------- COUNTRY ----------------
            if ($type == 'country') {
                $val = mysqli_real_escape_string($con, trim($getData[0]));
                if (!empty($val)) {
                    $check = mysqli_query($con, "SELECT id FROM countries WHERE country = '$val'");
                    if (mysqli_num_rows($check) == 0) {
                        mysqli_query($con, "INSERT INTO countries (country) VALUES ('$val')");
                        $inserted_count++;
                    } else {
                        $skipped_count++;
                    }
                }
                $active_tab = "country";
            }

            // ---------------- STATE + CITY ----------------
            else if ($type == 'state_city') {
                // Safety: in case CSV has less/more columns
                $state = isset($getData[0]) ? trim($getData[0]) : '';
                $city  = isset($getData[1]) ? trim($getData[1]) : '';

                if ($state === '' || $city === '') {
                    $skipped_count++;
                    continue;
                }

                $state = mysqli_real_escape_string($con, $state);
                $city  = mysqli_real_escape_string($con, $city);

                // ---- CORE FIX: Remove trailing numbers like " 1", " 2", ..., " 5" ----
                // "Mumbai 1" → "Mumbai"   |   "Pune 5" → "Pune"   |   "Delhi" → "Delhi"
                $base_city = preg_replace('/\s+\d+$/', '', $city);   // Removes " 1", " 2", etc.

                // Strong duplicate check: block if same base city already exists
                $check_query = "
                    SELECT id FROM city_state 
                    WHERE state = '$state' 
                      AND (
                            city = '$base_city' 
                         OR city LIKE '$base_city %' 
                         OR city LIKE '$base_city'
                         OR city = '$city'                     /* exact match bhi cover kar lo */
                      )
                    LIMIT 1
                ";

                $check = mysqli_query($con, $check_query);

                if (mysqli_num_rows($check) == 0) {
                    // Safe to insert
                    mysqli_query($con, "INSERT INTO city_state (state, city) VALUES ('$state', '$city')");
                    $inserted_count++;
                } else {
                    $skipped_count++;
                }
            }
        }
        fclose($file);

        $msg = "<div class='alert alert-success'>
                    <strong>CSV Import Complete!</strong><br>
                    Inserted: <b>$inserted_count</b> records<br>
                    Skipped (Duplicates): <b>$skipped_count</b> records
                </div>";
    } else {
        $msg = "<div class='alert alert-danger'>Invalid or Empty File!</div>";
    }

    $active_tab = ($type == 'country') ? 'country' : 'state_city';
}


// --- 4. FETCH DATA FOR EDIT ---
$editRow = null;
$editType = "";
if (isset($_GET['edit_id']) && isset($_GET['type'])) {
    $editId = mysqli_real_escape_string($con, $_GET['edit_id']);
    $editType = $_GET['type'];
    
    if ($editType == 'country') {
        $res = mysqli_query($con, "SELECT * FROM countries WHERE id='$editId'");
        $editRow = mysqli_fetch_assoc($res);
        $active_tab = "country";
    } elseif ($editType == 'state_city') {
        $res = mysqli_query($con, "SELECT * FROM city_state WHERE id='$editId'");
        $editRow = mysqli_fetch_assoc($res);
        $active_tab = "state_city";
    }
}
?>

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row mb-2">
            <div class="col-12">
                <h2 class="content-header-title">Manage Location Attributes</h2>
            </div>
        </div>
        <div class="content-body">
            <?php echo $msg; ?>

            <!-- UPLOAD / EDIT FORM -->
            <div class="card">
                <div class="card-body">
                    <?php if ($editRow) { ?>
                        <!-- EDIT MODE -->
                        <h4 class="card-title">Edit Record</h4>
                        <form method="post">
                            <input type="hidden" name="edit_id" value="<?php echo $editRow['id']; ?>">
                            <input type="hidden" name="edit_type" value="<?php echo $editType; ?>">
                            
                            <div class="row">
                                <?php if ($editType == 'country') { ?>
                                    <div class="col-md-10 form-group">
                                        <label>Country Name</label>
                                        <input type="text" name="country" class="form-control" value="<?php echo $editRow['country']; ?>" required>
                                    </div>
                                <?php } elseif ($editType == 'state_city') { ?>
                                    <div class="col-md-5 form-group">
                                        <label>State</label>
                                        <input type="text" name="state" class="form-control" value="<?php echo $editRow['state']; ?>" required>
                                    </div>
                                    <div class="col-md-5 form-group">
                                        <label>City</label>
                                        <input type="text" name="city" class="form-control" value="<?php echo $editRow['city']; ?>" required>
                                    </div>
                                <?php } ?>
                                <div class="col-md-2 form-group mt-2">
                                    <button type="submit" name="update_data" class="btn btn-success btn-block mt-1">Update</button>
                                    <a href="manage-location-attributes.php" class="btn btn-secondary btn-block mt-1">Cancel</a>
                                </div>
                            </div>
                        </form>
                    <?php } else { ?>
                        <!-- IMPORT MODE -->
                        <h4 class="card-title">Import CSV Data</h4>
                        <form method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label>Select Category</label>
                                    <select name="data_type" class="form-control" required>
                                        <option value="">Select Option</option>
                                        <option value="country">Countries (Citizenship/Location)</option>
                                        <option value="state_city">States & Cities</option>
                                    </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label>Upload CSV File</label>
                                    <input type="file" name="file" class="form-control" accept=".csv" required>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label>&nbsp;</label>
                                    <button type="submit" name="upload_csv" class="btn btn-primary btn-block">Import CSV</button>
                                </div>
                            </div>
                        </form>
                        <div class="alert alert-info mt-2">
                            <strong>CSV Guide:</strong>
                            <ul>
                                <li><b>Countries:</b> Col 1: Country Name (e.g., India, USA)</li>
                                <li><b>States & Cities:</b> Col 1: State Name, Col 2: City Name (e.g., Maharashtra, Mumbai)</li>
                            </ul>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <!-- DATA LIST -->
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($active_tab == 'country') ? 'active' : ''; ?>" data-toggle="tab" href="#tab_country">Countries</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($active_tab == 'state_city') ? 'active' : ''; ?>" data-toggle="tab" href="#tab_state_city">States & Cities</a>
                        </li>
                    </ul>

                    <div class="tab-content mt-2">
                        <!-- Country Tab -->
                        <div id="tab_country" class="tab-pane <?php echo ($active_tab == 'country') ? 'active' : 'fade'; ?>">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Country</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $q = mysqli_query($con, "SELECT * FROM countries ORDER BY country ASC");
                                        while ($r = mysqli_fetch_assoc($q)) {
                                            echo "<tr>
                                                <td>{$r['id']}</td>
                                                <td>{$r['country']}</td>
                                                <td>
                                                    <a href='?edit_id={$r['id']}&type=country' class='btn btn-sm btn-info'><i data-feather='edit'></i></a>
                                                    <a href='?del_id={$r['id']}&type=country' class='btn btn-sm btn-danger' onclick='return confirm(\"Delete this country?\")'><i data-feather='trash'></i></a>
                                                </td>
                                            </tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- State City Tab -->
                        <div id="tab_state_city" class="tab-pane <?php echo ($active_tab == 'state_city') ? 'active' : 'fade'; ?>">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>State</th>
                                            <th>City</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $q = mysqli_query($con, "SELECT * FROM city_state ORDER BY state ASC");
                                        while ($r = mysqli_fetch_assoc($q)) {
                                            echo "<tr>
                                                <td>{$r['id']}</td>
                                                <td>{$r['state']}</td>
                                                <td>{$r['city']}</td>
                                                <td>
                                                    <a href='?edit_id={$r['id']}&type=state_city' class='btn btn-sm btn-info'><i data-feather='edit'></i></a>
                                                    <a href='?del_id={$r['id']}&type=state_city' class='btn btn-sm btn-danger' onclick='return confirm(\"Delete this record?\")'><i data-feather='trash'></i></a>
                                                </td>
                                            </tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>