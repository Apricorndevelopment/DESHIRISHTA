<?php
include 'header.php';
include 'config.php';

$msg = "";
$active_tab = "stream"; // Default active tab

// --- 1. HANDLE DELETE ---
if (isset($_GET['del_id']) && isset($_GET['type'])) {
    $id = mysqli_real_escape_string($con, $_GET['del_id']);
    $type = $_GET['type'];

    if ($type == 'stream') {
        mysqli_query($con, "DELETE FROM stream_education WHERE id='$id'");
        $active_tab = "stream";
    } elseif ($type == 'domain') {
        mysqli_query($con, "DELETE FROM domain_designation WHERE id='$id'");
        $active_tab = "domain";
    } elseif ($type == 'working' || $type == 'income') {
        mysqli_query($con, "DELETE FROM master_dropdown_options WHERE id='$id'");
        $active_tab = ($type == 'working') ? "working" : "income";
    }
    $msg = "<div class='alert alert-danger'>Record Deleted Successfully!</div>";
}

// --- 2. HANDLE UPDATE (EDIT) ---
if (isset($_POST['update_data'])) {
    $id = $_POST['edit_id'];
    $type = $_POST['edit_type'];

    if ($type == 'stream') {
        $stream = mysqli_real_escape_string($con, $_POST['stream']);
        $education = mysqli_real_escape_string($con, $_POST['education']);
        mysqli_query($con, "UPDATE stream_education SET stream='$stream', education='$education' WHERE id='$id'");
        $active_tab = "stream";
    } elseif ($type == 'domain') {
        $domain = mysqli_real_escape_string($con, $_POST['domain']);
        $designation = mysqli_real_escape_string($con, $_POST['designation']);
        mysqli_query($con, "UPDATE domain_designation SET domain='$domain', designation='$designation' WHERE id='$id'");
        $active_tab = "domain";
    } elseif ($type == 'working' || $type == 'income') {
        $val = mysqli_real_escape_string($con, $_POST['option_value']);
        mysqli_query($con, "UPDATE master_dropdown_options SET option_value='$val' WHERE id='$id'");
        $active_tab = ($type == 'working') ? "working" : "income";
    }
    $msg = "<div class='alert alert-success'>Record Updated Successfully!</div>";
    // Refresh page to clear edit mode
    echo "<script>window.location.href='manage-education-attributes.php';</script>";
}

// --- 3. HANDLE CSV UPLOAD ---
if (isset($_POST['upload_csv'])) {
    $type = $_POST['data_type'];
    $filename = $_FILES["file"]["tmp_name"];

    if ($_FILES["file"]["size"] > 0) {
        $file = fopen($filename, "r");
        $count = 0;
        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE) {
            $count++;
            if ($type == 'stream_edu') {
                $stream = mysqli_real_escape_string($con, $getData[0]);
                $education = mysqli_real_escape_string($con, $getData[1]);
                if (!empty($stream) && !empty($education)) {
                    mysqli_query($con, "INSERT INTO stream_education (stream, education) VALUES ('$stream', '$education')");
                }
                $active_tab = "stream";
            } elseif ($type == 'domain_desig') {
                $domain = mysqli_real_escape_string($con, $getData[0]);
                $designation = mysqli_real_escape_string($con, $getData[1]);
                if (!empty($domain) && !empty($designation)) {
                    mysqli_query($con, "INSERT INTO domain_designation (domain, designation) VALUES ('$domain', '$designation')");
                }
                $active_tab = "domain";
            } elseif ($type == 'working_with') {
                $val = mysqli_real_escape_string($con, $getData[0]);
                if (!empty($val)) {
                    mysqli_query($con, "INSERT INTO master_dropdown_options (dropdown_name, option_value, sort_order) VALUES ('working_with', '$val', '$count')");
                }
                $active_tab = "working";
            } elseif ($type == 'annual_income') {
                $val = mysqli_real_escape_string($con, $getData[0]);
                if (!empty($val)) {
                    mysqli_query($con, "INSERT INTO master_dropdown_options (dropdown_name, option_value, sort_order) VALUES ('annual_income', '$val', '$count')");
                }
                $active_tab = "income";
            }
        }
        fclose($file);
        $msg = "<div class='alert alert-success'>Data Imported Successfully!</div>";
    } else {
        $msg = "<div class='alert alert-danger'>Invalid File</div>";
    }
}

// --- 4. FETCH DATA FOR EDIT MODE ---
$editRow = null;
$editType = "";
if (isset($_GET['edit_id']) && isset($_GET['type'])) {
    $editId = mysqli_real_escape_string($con, $_GET['edit_id']);
    $editType = $_GET['type'];
    
    if ($editType == 'stream') {
        $res = mysqli_query($con, "SELECT * FROM stream_education WHERE id='$editId'");
        $editRow = mysqli_fetch_assoc($res);
        $active_tab = "stream";
    } elseif ($editType == 'domain') {
        $res = mysqli_query($con, "SELECT * FROM domain_designation WHERE id='$editId'");
        $editRow = mysqli_fetch_assoc($res);
        $active_tab = "domain";
    } elseif ($editType == 'working' || $editType == 'income') {
        $res = mysqli_query($con, "SELECT * FROM master_dropdown_options WHERE id='$editId'");
        $editRow = mysqli_fetch_assoc($res);
        $active_tab = ($editType == 'working') ? "working" : "income";
    }
}
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row mb-2">
            <div class="col-12">
                <h2 class="content-header-title">Manage Education & Career Attributes</h2>
            </div>
        </div>
        <div class="content-body">
            
            <?php echo $msg; ?>

            <div class="card">
                <div class="card-body">
                    <?php if ($editRow) { ?>
                        <h4 class="card-title">Edit Record</h4>
                        <form method="post">
                            <input type="hidden" name="edit_id" value="<?php echo $editRow['id']; ?>">
                            <input type="hidden" name="edit_type" value="<?php echo $editType; ?>">
                            
                            <div class="row">
                                <?php if ($editType == 'stream') { ?>
                                    <div class="col-md-5 form-group">
                                        <label>Stream</label>
                                        <input type="text" name="stream" class="form-control" value="<?php echo $editRow['stream']; ?>" required>
                                    </div>
                                    <div class="col-md-5 form-group">
                                        <label>Education</label>
                                        <input type="text" name="education" class="form-control" value="<?php echo $editRow['education']; ?>" required>
                                    </div>
                                <?php } elseif ($editType == 'domain') { ?>
                                    <div class="col-md-5 form-group">
                                        <label>Domain / Profession</label>
                                        <input type="text" name="domain" class="form-control" value="<?php echo $editRow['domain']; ?>" required>
                                    </div>
                                    <div class="col-md-5 form-group">
                                        <label>Designation</label>
                                        <input type="text" name="designation" class="form-control" value="<?php echo $editRow['designation']; ?>" required>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-md-10 form-group">
                                        <label>Option Value</label>
                                        <input type="text" name="option_value" class="form-control" value="<?php echo $editRow['option_value']; ?>" required>
                                    </div>
                                <?php } ?>
                                
                                <div class="col-md-2 form-group mt-2">
                                    <button type="submit" name="update_data" class="btn btn-success btn-block mt-1">Update</button>
                                    <a href="manage-education-attributes.php" class="btn btn-secondary btn-block mt-1">Cancel</a>
                                </div>
                            </div>
                        </form>

                    <?php } else { ?>
                        <h4 class="card-title">Import CSV Data</h4>
                        <form method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label>Select Category</label>
                                    <select name="data_type" class="form-control" required>
                                        <option value="">Select Option</option>
                                        <option value="stream_edu">Stream & Education</option>
                                        <option value="domain_desig">Profession & Designation</option>
                                        <option value="working_with">Working With</option>
                                        <option value="annual_income">Annual Income</option>
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
                    <?php } ?>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-2">Existing Data</h4>
                    
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($active_tab == 'stream') ? 'active' : ''; ?>" data-toggle="tab" href="#tab_stream">Stream & Education</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($active_tab == 'domain') ? 'active' : ''; ?>" data-toggle="tab" href="#tab_domain">Profession & Designation</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($active_tab == 'working') ? 'active' : ''; ?>" data-toggle="tab" href="#tab_working">Working With</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($active_tab == 'income') ? 'active' : ''; ?>" data-toggle="tab" href="#tab_income">Annual Income</a>
                        </li>
                    </ul>

                    <div class="tab-content mt-2">
                        
                        <div id="tab_stream" class="tab-pane <?php echo ($active_tab == 'stream') ? 'active' : 'fade'; ?>">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Stream</th>
                                            <th>Education</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $q = mysqli_query($con, "SELECT * FROM stream_education ORDER BY id DESC");
                                        while($r = mysqli_fetch_assoc($q)){
                                            echo "<tr>
                                                <td>{$r['id']}</td>
                                                <td>{$r['stream']}</td>
                                                <td>{$r['education']}</td>
                                                <td>
                                                    <a href='?edit_id={$r['id']}&type=stream' class='btn btn-sm btn-info'><i class='fa fa-edit'></i></a>
                                                    <a href='?del_id={$r['id']}&type=stream' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure?\")'><i class='fa fa-trash'></i></a>
                                                </td>
                                            </tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div id="tab_domain" class="tab-pane <?php echo ($active_tab == 'domain') ? 'active' : 'fade'; ?>">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Domain / Profession</th>
                                            <th>Designation</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $q = mysqli_query($con, "SELECT * FROM domain_designation ORDER BY id DESC");
                                        while($r = mysqli_fetch_assoc($q)){
                                            echo "<tr>
                                                <td>{$r['id']}</td>
                                                <td>{$r['domain']}</td>
                                                <td>{$r['designation']}</td>
                                                <td>
                                                    <a href='?edit_id={$r['id']}&type=domain' class='btn btn-sm btn-info'><i class='fa fa-edit'></i></a>
                                                    <a href='?del_id={$r['id']}&type=domain' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure?\")'><i class='fa fa-trash'></i></a>
                                                </td>
                                            </tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div id="tab_working" class="tab-pane <?php echo ($active_tab == 'working') ? 'active' : 'fade'; ?>">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Working With</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $q = mysqli_query($con, "SELECT * FROM master_dropdown_options WHERE dropdown_name='working_with' ORDER BY id DESC");
                                        while($r = mysqli_fetch_assoc($q)){
                                            echo "<tr>
                                                <td>{$r['id']}</td>
                                                <td>{$r['option_value']}</td>
                                                <td>
                                                    <a href='?edit_id={$r['id']}&type=working' class='btn btn-sm btn-info'><i class='fa fa-edit'></i></a>
                                                    <a href='?del_id={$r['id']}&type=working' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure?\")'><i class='fa fa-trash'></i></a>
                                                </td>
                                            </tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div id="tab_income" class="tab-pane <?php echo ($active_tab == 'income') ? 'active' : 'fade'; ?>">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Annual Income</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $q = mysqli_query($con, "SELECT * FROM master_dropdown_options WHERE dropdown_name='annual_income' ORDER BY id DESC");
                                        while($r = mysqli_fetch_assoc($q)){
                                            echo "<tr>
                                                <td>{$r['id']}</td>
                                                <td>{$r['option_value']}</td>
                                                <td>
                                                    <a href='?edit_id={$r['id']}&type=income' class='btn btn-sm btn-info'><i class='bi bi-pencil'></i></a>
                                                    <a href='?del_id={$r['id']}&type=income' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure?\")'><i class='bi bi-trash'></i></a>
                                                </td>
                                            </tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div> </div>
            </div>

        </div>
    </div>
</div>

<?php include 'footer.php'; ?>