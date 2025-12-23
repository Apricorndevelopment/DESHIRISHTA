<?php
// File: manage-religion-caste.php
// Purpose: Manage religion-caste pairs with single-add, CSV bulk upload, list & delete.
// Requirements: include '../config.php' for $con (mysqli connection), include header/footer as needed.

include '../config.php';
include 'header.php';
include 'sidebar.php';
session_start();

// Messages
$message = '';
$error = '';

// --- Handle delete (GET) ---
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $del_id = (int)$_GET['id'];
    if ($del_id > 0) {
        $stmt = mysqli_prepare($con, "DELETE FROM religion_caste WHERE id = ?");
        mysqli_stmt_bind_param($stmt, 'i', $del_id);
        if (mysqli_stmt_execute($stmt)) {
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                $message = 'SUCCESS: Option deleted.';
            } else {
                $error = 'ERROR: No row deleted.';
            }
        } else {
            $error = 'DATABASE ERROR: ' . mysqli_error($con);
        }
        mysqli_stmt_close($stmt);
    } else {
        $error = 'Invalid ID.';
    }
}

// Fetch existing religions for dropdown (ordered)
$existing_religions = [];
$sql_religions = "SELECT DISTINCT religion FROM religion_caste ORDER BY religion ASC";
$result_religions = mysqli_query($con, $sql_religions);
if ($result_religions) {
    while ($row = mysqli_fetch_assoc($result_religions)) {
        $existing_religions[] = $row['religion'];
    }
    mysqli_free_result($result_religions);
}

// --- Handle single add (POST) ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_option'])) {
    // Choose new religion if provided, otherwise selected
    $selected_religion = trim($_POST['religion'] ?? '');
    $new_religion = trim($_POST['religion_new'] ?? '');
    $religion = $new_religion !== '' ? $new_religion : $selected_religion;
    $caste = trim($_POST['caste'] ?? '');
    $sort_order = isset($_POST['sort_order']) ? (int)$_POST['sort_order'] : 0;

    if ($religion === '' || $caste === '') {
        $error = 'ERROR: Religion and Caste are required.';
    } else {
        // normalize whitespace
        $religion = preg_replace('/\s+/', ' ', $religion);
        $caste = preg_replace('/\s+/', ' ', $caste);

        // Check duplicate case-insensitively
        $check_stmt = mysqli_prepare($con, "SELECT id FROM religion_caste WHERE LOWER(religion)=LOWER(?) AND LOWER(caste)=LOWER(?) LIMIT 1");
        mysqli_stmt_bind_param($check_stmt, 'ss', $religion, $caste);
        mysqli_stmt_execute($check_stmt);
        mysqli_stmt_store_result($check_stmt);
        if (mysqli_stmt_num_rows($check_stmt) > 0) {
            $error = "ERROR: Entry '{$caste}' already exists for '{$religion}'.";
            mysqli_stmt_close($check_stmt);
        } else {
            mysqli_stmt_close($check_stmt);
            // Insert
            $stmt = mysqli_prepare($con, "INSERT INTO religion_caste (religion, caste, sort_order) VALUES (?, ?, ?)");
            mysqli_stmt_bind_param($stmt, 'ssi', $religion, $caste, $sort_order);
            if (mysqli_stmt_execute($stmt)) {
                if (mysqli_stmt_affected_rows($stmt) > 0) {
                    $message = "SUCCESS: Caste '{$caste}' added under Religion '{$religion}'.";
                } else {
                    $error = 'ERROR: Unable to add entry.';
                }
            } else {
                $error = 'DATABASE ERROR: ' . mysqli_error($con);
            }
            mysqli_stmt_close($stmt);
            // Refresh existing_religions quick (so dropdown shows new immediately without full page reload)
            $existing_religions = [];
            $res = mysqli_query($con, $sql_religions);
            if ($res) { while ($r = mysqli_fetch_assoc($res)) { $existing_religions[] = $r['religion']; } mysqli_free_result($res); }
        }
    }
}

// --- Handle CSV Upload ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['upload_csv']) && isset($_FILES['csv_file']) && $_FILES['csv_file']['error'] == UPLOAD_ERR_OK) {
    $file_info = pathinfo($_FILES['csv_file']['name']);
    $ext = strtolower($file_info['extension'] ?? '');
    if ($ext !== 'csv') {
        $error = 'ERROR: Only CSV files are allowed.';
    } else {
        $handle = fopen($_FILES['csv_file']['tmp_name'], 'r');
        if ($handle === FALSE) {
            $error = 'ERROR: Unable to open CSV file.';
        } else {
            $inserted_count = 0;
            $skipped_count = 0;
            $row_count = 0;
            // Optionally skip header row if it looks like header
            $firstRow = fgetcsv($handle, 1000, ',');
            $hasHeader = false;
            if ($firstRow !== FALSE) {
                $row_count++;
                $lowerConcat = strtolower(implode(',', $firstRow));
                if (strpos($lowerConcat, 'religion') !== false && strpos($lowerConcat, 'caste') !== false) {
                    $hasHeader = true;
                } else {
                    // process first row as data
                    fseek($handle, 0);
                    $row_count = 0;
                }
            }

            while (($data = fgetcsv($handle, 2000, ',')) !== FALSE) {
                $row_count++;
                // skip empty/invalid
                if (count($data) < 2 || trim($data[0]) === '' || trim($data[1]) === '') {
                    $skipped_count++;
                    continue;
                }
                $religion_csv = trim($data[0]);
                $caste_csv = trim($data[1]);
                $sort_order_csv = (isset($data[2]) && is_numeric(trim($data[2]))) ? (int)trim($data[2]) : 0;

                // normalize
                $religion_csv = preg_replace('/\s+/', ' ', $religion_csv);
                $caste_csv = preg_replace('/\s+/', ' ', $caste_csv);

                // Check duplicate CI
                $check_stmt = mysqli_prepare($con, "SELECT id FROM religion_caste WHERE LOWER(religion)=LOWER(?) AND LOWER(caste)=LOWER(?) LIMIT 1");
                mysqli_stmt_bind_param($check_stmt, 'ss', $religion_csv, $caste_csv);
                mysqli_stmt_execute($check_stmt);
                mysqli_stmt_store_result($check_stmt);
                if (mysqli_stmt_num_rows($check_stmt) > 0) {
                    $skipped_count++;
                    mysqli_stmt_close($check_stmt);
                    continue;
                }
                mysqli_stmt_close($check_stmt);

                $stmt = mysqli_prepare($con, "INSERT INTO religion_caste (religion, caste, sort_order) VALUES (?, ?, ?)");
                mysqli_stmt_bind_param($stmt, 'ssi', $religion_csv, $caste_csv, $sort_order_csv);
                if (mysqli_stmt_execute($stmt)) {
                    if (mysqli_stmt_affected_rows($stmt) > 0) {
                        $inserted_count++;
                    } else {
                        $skipped_count++;
                    }
                } else {
                    $skipped_count++;
                    $error .= "DB Error on row {$row_count}: " . mysqli_error($con) . " ";
                }
                mysqli_stmt_close($stmt);
            }
            fclose($handle);
            $message = "CSV Upload Complete. Total rows processed: {$row_count}. Inserted: {$inserted_count}. Skipped (Duplicate/Invalid): {$skipped_count}.";
            // refresh existing religions
            $existing_religions = [];
            $res = mysqli_query($con, $sql_religions);
            if ($res) { while ($r = mysqli_fetch_assoc($res)) { $existing_religions[] = $r['religion']; } mysqli_free_result($res); }
        }
    }
}

// Fetch grouped options for display
$options_sql = "SELECT id, religion, caste, sort_order FROM religion_caste ORDER BY religion ASC, sort_order ASC, caste ASC";
$options_result = mysqli_query($con, $options_sql);
$grouped_options = [];
if ($options_result) {
    while ($row = mysqli_fetch_assoc($options_result)) {
        $grouped_options[$row['religion']][] = $row;
    }
    if (is_object($options_result)) mysqli_free_result($options_result);
}

// --- HTML / UI ---
?>

<style>
.card { border: 1px solid #eee; box-shadow: none; }
.card-header.bg-primary { background-color: #f0f2f5 !important; color: #3e2b85ff !important; border-bottom: 1px solid #e6e9ef; }
.card-header.bg-success { background-color: #f7fff9 !important; color: #1b7a4b !important; border-bottom: 1px solid #e6e9ef; }
.card-header.bg-dark { background-color: #f6f7fb !important; color: #333 !important; border-bottom: 1px solid #e6e9ef; }
.page-title { color: #2b2b2b; margin-top: 10px; font-weight: 600; }
.table thead th { background: #fafbfd; }
.btn-primary { background-color: #6b4cff; border-color: #6b4cff; }
.btn-success { background-color: #28a745; border-color: #28a745; }
.alert-success { background-color: #e9f7ec; color: #22663b; border-color: #d0ecd6; }
.alert-danger { background-color: #fff1f2; color: #9f2b2b; border-color: #ffd7d9; }
.form-text { color:#6b6f76; }
</style>

<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-body">

            <div class="row mb-2">
                <div class="col-12">
                    <h2 class="page-title">Manage Religious Options</h2>
                    <p class="mb-3">Add or import Religion & Caste (sect) values for the site.</p>
                    <?php if (!empty($message)): ?>
                        <div class="alert alert-success"><?php echo htmlspecialchars($message); ?></div>
                    <?php endif; ?>
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h5 class="m-0">1. Add Single Religion/Caste Pair</h5>
                        </div>
                        <div class="card-body">
                            <form action="" method="post">
                                <input type="hidden" name="add_option" value="1">

                                <div class="form-group mb-3">
                                    <label for="religion_input" class="form-label">Select Existing Religion</label>
                                    <select class="form-control" id="religion_input" name="religion">
                                        <option value="">-- Select existing religion --</option>
                                        <?php foreach ($existing_religions as $rel): ?>
                                            <option value="<?php echo htmlspecialchars($rel); ?>"><?php echo htmlspecialchars($rel); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small class="form-text">Or use the field below to add a new religion.</small>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="religion_new" class="form-label">Add New Religion (optional)</label>
                                    <input type="text" class="form-control" id="religion_new" name="religion_new" placeholder="Type a new religion name if not listed here">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="caste" class="form-label">Caste/Sect Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="caste" name="caste" required placeholder="Enter caste/sect name">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="sort_order" class="form-label">Sort Order (Optional)</label>
                                    <input type="number" class="form-control" id="sort_order" name="sort_order" value="0" min="0">
                                </div>
                                <button type="submit" class="btn btn-primary">➕ Add</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mb-4">
                    <div class="card">
                        <div class="card-header bg-success">
                            <h5 class="m-0">2. Bulk Upload Options (CSV)</h5>
                        </div>
                        <div class="card-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="upload_csv" value="1">
                                <div class="form-group mb-3">
                                    <label for="csv_file" class="form-label">Upload CSV File <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" id="csv_file" name="csv_file" accept=".csv" required>
                                    <small class="form-text mt-2">CSV Format: <code>religion,caste,sort_order</code> (sort_order optional). Example: <code>Hindu,Brahmin,10</code></small>
                                </div>
                                <button type="submit" class="btn btn-success">⬆️ Upload CSV</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-dark">
                            <h5 class="m-0">3. Existing Options Overview</h5>
                        </div>
                        <div class="card-body">
                            <?php if (empty($grouped_options)): ?>
                                <div class="alert alert-info">No religion/caste data found.</div>
                            <?php else: ?>
                                <?php foreach ($grouped_options as $religion_name => $options): ?>
                                    <h4 class="mt-4 mb-2 text-primary border-bottom pb-1"><?php echo htmlspecialchars($religion_name); ?> <span class="badge bg-secondary"><?php echo count($options); ?> castes</span></h4>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-sm align-middle">
                                            <thead class="table-light">
                                                <tr>
                                                    <th style="width: 60%">Caste Value</th>
                                                    <th style="width: 20%">Sort Order</th>
                                                    <th style="width: 20%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($options as $option): ?>
                                                    <tr>
                                                        <td><?php echo htmlspecialchars($option['caste']); ?></td>
                                                        <td><?php echo htmlspecialchars($option['sort_order']); ?></td>
                                                        <td>
                                                            <a href="?action=delete&id=<?php echo $option['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this option?')">Delete</a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php
include 'footer.php';
?>
