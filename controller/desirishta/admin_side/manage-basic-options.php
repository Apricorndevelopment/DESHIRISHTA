<?php
include 'header.php';
include 'config.php';

$msg = "";
$active_tab = "family_status"; // Default tab

// --- 1. HANDLE DELETE ---
if (isset($_GET['del_id']) && isset($_GET['type'])) {
    $id = mysqli_real_escape_string($con, $_GET['del_id']);
    $type = $_GET['type'];

    // General Delete for master_dropdown_options
    mysqli_query($con, "DELETE FROM master_dropdown_options WHERE id='$id'");
    $active_tab = $type;
    
    $msg = "<div class='alert alert-danger'>Record Deleted Successfully!</div>";
}

// --- 2. HANDLE UPDATE (EDIT) ---
if (isset($_POST['update_data'])) {
    $id = $_POST['edit_id'];
    $type = $_POST['edit_type'];
    $val = mysqli_real_escape_string($con, $_POST['option_value']);

    // Check for duplicate before updating
    $check = mysqli_query($con, "SELECT id FROM master_dropdown_options WHERE dropdown_name='$type' AND option_value='$val' AND id != '$id'");
    
    if (mysqli_num_rows($check) == 0) {
        mysqli_query($con, "UPDATE master_dropdown_options SET option_value='$val' WHERE id='$id'");
        $msg = "<div class='alert alert-success'>Record Updated Successfully!</div>";
    } else {
        $msg = "<div class='alert alert-warning'>Update Failed: Value already exists!</div>";
    }
    $active_tab = $type;
}

// --- 3. HANDLE CSV UPLOAD ---
if (isset($_POST['upload_csv'])) {
    $type = $_POST['data_type']; // e.g., family_status, marital_status
    $filename = $_FILES["file"]["tmp_name"];

    if ($_FILES["file"]["size"] > 0) {
        $file = fopen($filename, "r");
        $inserted_count = 0;
        $skipped_count = 0;
        $sort_order = 1; // Start sort order

        // Get max sort order to append new items
        $maxSortQ = mysqli_query($con, "SELECT MAX(sort_order) as max_sort FROM master_dropdown_options WHERE dropdown_name='$type'");
        $maxSortR = mysqli_fetch_assoc($maxSortQ);
        if($maxSortR['max_sort']) {
            $sort_order = $maxSortR['max_sort'] + 1;
        }

        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE) {
            // CSV Format: Col 1 = Option Value
            $val = mysqli_real_escape_string($con, $getData[0]);

            if (!empty($val)) {
                // DUPLICATE CHECK
                $checkQuery = mysqli_query($con, "SELECT id FROM master_dropdown_options WHERE dropdown_name='$type' AND option_value='$val'");
                
                if (mysqli_num_rows($checkQuery) == 0) {
                    mysqli_query($con, "INSERT INTO master_dropdown_options (dropdown_name, option_value, sort_order) VALUES ('$type', '$val', '$sort_order')");
                    $inserted_count++;
                    $sort_order++;
                } else {
                    $skipped_count++;
                }
            }
        }
        fclose($file);
        $active_tab = $type;
        $msg = "<div class='alert alert-success'>Process Complete! Inserted: <b>$inserted_count</b>, Skipped (Duplicates): <b>$skipped_count</b></div>";
    } else {
        $msg = "<div class='alert alert-danger'>Invalid File</div>";
    }
}

// --- 4. FETCH DATA FOR EDIT ---
$editRow = null;
$editType = "";
if (isset($_GET['edit_id'])) {
    $editId = mysqli_real_escape_string($con, $_GET['edit_id']);
    $res = mysqli_query($con, "SELECT * FROM master_dropdown_options WHERE id='$editId'");
    $editRow = mysqli_fetch_assoc($res);
    $editType = $editRow['dropdown_name'];
    $active_tab = $editType;
}
?>

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row mb-2">
            <div class="col-12">
                <h2 class="content-header-title">Manage Basic Options</h2>
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
                                <div class="col-md-10 form-group">
                                    <label>Option Value</label>
                                    <input type="text" name="option_value" class="form-control" value="<?php echo $editRow['option_value']; ?>" required>
                                </div>
                                <div class="col-md-2 form-group mt-2">
                                    <button type="submit" name="update_data" class="btn btn-success btn-block mt-1">Update</button>
                                    <a href="manage-basic-options.php" class="btn btn-secondary btn-block mt-1">Cancel</a>
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
                                        <option value="family_status">Family Status</option>
                                        <option value="marital_status">Marital Status</option>
                                        <option value="height">Height</option>
                                        <option value="weight">Weight</option>
                                        <option value="eating_habits">Eating Habits</option>
                                        <option value="drinking_habits">Drinking Habits</option>
                                        <option value="smoking_habits">Smoking Habits</option>
                                        <option value="disability">Disability</option>
                                        <option value="language_known">Languages Known</option>
                                        <!-- Add these inside the <select name="data_type"> -->
                                        <option value="hobbies">Hobbies</option>
                                        <option value="music">Music</option>
                                        <option value="sports">Sports</option>
                                        <option value="food">Food</option>
                                        <option value="relationship">Relationship</option>
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
                            <strong>CSV Guide:</strong> Single Column with Values (e.g., "Middle Class", "Affluent")
                        </div>
                    <?php } ?>
                </div>
            </div>

            <!-- DATA LIST -->
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($active_tab == 'family_status') ? 'active' : ''; ?>" data-toggle="tab" href="#tab_family">Family Status</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($active_tab == 'marital_status') ? 'active' : ''; ?>" data-toggle="tab" href="#tab_marital">Marital Status</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($active_tab == 'height') ? 'active' : ''; ?>" data-toggle="tab" href="#tab_height">Height</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($active_tab == 'weight') ? 'active' : ''; ?>" data-toggle="tab" href="#tab_weight">Weight</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($active_tab == 'eating_habits') ? 'active' : ''; ?>" data-toggle="tab" href="#tab_eating">Eating Habits</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($active_tab == 'drinking_habits') ? 'active' : ''; ?>" data-toggle="tab" href="#tab_drinking">Drinking Habits</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($active_tab == 'smoking_habits') ? 'active' : ''; ?>" data-toggle="tab" href="#tab_smoking">Smoking Habits</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($active_tab == 'disability') ? 'active' : ''; ?>" data-toggle="tab" href="#tab_disability">Disability</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($active_tab == 'language_known') ? 'active' : ''; ?>" data-toggle="tab" href="#tab_lang">Languages</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($active_tab == 'hobbies') ? 'active' : ''; ?>" data-toggle="tab" href="#tab_hobbies">Hobbies</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($active_tab == 'music') ? 'active' : ''; ?>" data-toggle="tab" href="#tab_music">Music</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($active_tab == 'sports') ? 'active' : ''; ?>" data-toggle="tab" href="#tab_sports">Sports</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($active_tab == 'food') ? 'active' : ''; ?>" data-toggle="tab" href="#tab_food">Food</a>
                        </li>
                        <li class="nav-item">
    <a class="nav-link <?php echo ($active_tab == 'relationship') ? 'active' : ''; ?>" data-toggle="tab" href="#tab_relationship">Relationship</a>
</li>

                    </ul>

                    <div class="tab-content mt-2">
                        <!-- FAMILY STATUS TAB -->
                        <div id="tab_family" class="tab-pane <?php echo ($active_tab == 'family_status') ? 'active' : 'fade'; ?>">
                            <?php renderTable($con, 'family_status'); ?>
                        </div>

                        <!-- MARITAL STATUS TAB -->
                        <div id="tab_marital" class="tab-pane <?php echo ($active_tab == 'marital_status') ? 'active' : 'fade'; ?>">
                            <?php renderTable($con, 'marital_status'); ?>
                        </div>

                        <!-- HEIGHT TAB -->
                        <div id="tab_height" class="tab-pane <?php echo ($active_tab == 'height') ? 'active' : 'fade'; ?>">
                            <?php renderTable($con, 'height'); ?>
                        </div>

                        <!-- WEIGHT TAB -->
                        <div id="tab_weight" class="tab-pane <?php echo ($active_tab == 'weight') ? 'active' : 'fade'; ?>">
                            <?php renderTable($con, 'weight'); ?>
                        </div>

                        <!-- EATING HABITS TAB -->
                        <div id="tab_eating" class="tab-pane <?php echo ($active_tab == 'eating_habits') ? 'active' : 'fade'; ?>">
                            <?php renderTable($con, 'eating_habits'); ?>
                        </div>

                        <!-- DRINKING HABITS TAB -->
                        <div id="tab_drinking" class="tab-pane <?php echo ($active_tab == 'drinking_habits') ? 'active' : 'fade'; ?>">
                            <?php renderTable($con, 'drinking_habits'); ?>
                        </div>

                        <!-- SMOKING HABITS TAB -->
                        <div id="tab_smoking" class="tab-pane <?php echo ($active_tab == 'smoking_habits') ? 'active' : 'fade'; ?>">
                            <?php renderTable($con, 'smoking_habits'); ?>
                        </div>

                        <!-- DISABILITY TAB -->
                        <div id="tab_disability" class="tab-pane <?php echo ($active_tab == 'disability') ? 'active' : 'fade'; ?>">
                            <?php renderTable($con, 'disability'); ?>
                        </div>

                        <!-- LANGUAGE TAB -->
                        <div id="tab_lang" class="tab-pane <?php echo ($active_tab == 'language_known') ? 'active' : 'fade'; ?>">
                            <?php renderTable($con, 'language_known'); ?>
                        </div>
                                                <!-- HOBBIES TAB -->
                        <div id="tab_hobbies" class="tab-pane <?php echo ($active_tab == 'hobbies') ? 'active' : 'fade'; ?>">
                            <?php renderTable($con, 'hobbies'); ?>
                        </div>

                        <!-- MUSIC TAB -->
                        <div id="tab_music" class="tab-pane <?php echo ($active_tab == 'music') ? 'active' : 'fade'; ?>">
                            <?php renderTable($con, 'music'); ?>
                        </div>

                        <!-- SPORTS TAB -->
                        <div id="tab_sports" class="tab-pane <?php echo ($active_tab == 'sports') ? 'active' : 'fade'; ?>">
                            <?php renderTable($con, 'sports'); ?>
                        </div>

                        <!-- FOOD TAB -->
                        <div id="tab_food" class="tab-pane <?php echo ($active_tab == 'food') ? 'active' : 'fade'; ?>">
                            <?php renderTable($con, 'food'); ?>
                        </div>
                        <div id="tab_relationship" class="tab-pane <?php echo ($active_tab == 'relationship') ? 'active' : 'fade'; ?>">
    <?php renderTable($con, 'relationship'); ?>
</div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .nav-tabs {
    flex-wrap: nowrap !important;
    overflow-x: auto !important;
    overflow-y: hidden;
    white-space: nowrap;
}

.nav-tabs .nav-item {
    flex: 0 0 auto !important;
}

.nav-tabs::-webkit-scrollbar {
    height: 2px;
}

.nav-tabs::-webkit-scrollbar-thumb {
    background: #d1866fff;
    border-radius: 3px;
}

</style>
<?php 
include 'footer.php'; 

// Helper function to render table rows
function renderTable($con, $type) {
    echo '<div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Value</th>
                        <th style="width: 150px;">Action</th>
                    </tr>
                </thead>
                <tbody>';
    
    $q = mysqli_query($con, "SELECT * FROM master_dropdown_options WHERE dropdown_name='$type' ORDER BY sort_order ASC, option_value ASC");
    if(mysqli_num_rows($q) > 0){
        while ($r = mysqli_fetch_assoc($q)) {
            echo "<tr>
                    <td>{$r['option_value']}</td>
                    <td>
                        <a href='?edit_id={$r['id']}' class='btn btn-sm btn-info'><i data-feather='edit'></i></a>
                        <a href='?del_id={$r['id']}&type={$type}' class='btn btn-sm btn-danger' onclick='return confirm(\"Delete this record?\")'><i data-feather='trash'></i></a>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='2' class='text-center'>No data found. Please upload CSV.</td></tr>";
    }
    
    echo '  </tbody>
          </table>
        </div>';
}
?>