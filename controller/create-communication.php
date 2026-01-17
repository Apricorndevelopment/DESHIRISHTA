<?php

include '../config.php';
include 'header.php';
include 'sidebar.php';

// Fetch all email communications
$sql = "SELECT * FROM admin_communication WHERE type='email' ORDER BY id DESC";
$result = mysqli_query($con, $sql);
$sql_users = mysqli_query($con, "
    SELECT userid, name, email 
    FROM registration 
    WHERE profilestatus = '1'
    ORDER BY name ASC
");

?>
<style>
    body {
    overflow-y: auto !important;
}

.vertical-layout .main-menu {
    height: 100vh !important;
    overflow-y: auto !important;
}

.app-content {
    overflow: visible !important;
}

</style>
<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>

    <div class="content-wrapper">

        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <h2 class="content-header-title float-left mb-0">Create New Communication</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">Marketing & Comms</li>
                        <li class="breadcrumb-item active">Create Communication</li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- SUCCESS / ERROR ALERTS -->
        <?php if(isset($_GET['success'])) { ?>
            <div class="alert alert-success text-center">
                <?php echo $_GET['success']; ?>
            </div>
        <?php } ?>

        <?php if(isset($_GET['error'])) { ?>
            <div class="alert alert-danger text-center">
                <?php echo $_GET['error']; ?>
            </div>
        <?php } ?>

        <!-- CONTENT BODY -->
        <div class="content-body">
            <section id="basic-datatable">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Compose New Campaign</h4>
                    </div>

                    <div class="card-body">
                        <form action="insert-communication.php" method="POST" enctype="multipart/form-data">
                             <div class="form-group">
                                <label><b>Communication Type</b></label>
                                <select class="form-control" name="type" id="campaign_type" required>
                                    <option value="">-- Select Type --</option>
                                    <option value="email">Email Campaign</option>
                                    <option value="banner">Banner Campaign</option>
                                </select>
                            </div>

                             <div class="form-group">
                                <label><b>Target Users</b></label>
                                <select class="form-control" name="target_scope" id="target_scope" required>
                                    <option value="all">All Users</option>
                                    <option value="specific">Specific Users</option>
                                </select>
                            </div>
<div class="form-group" id="specific_users_box" style="display:none;">
    <label><b>Select Users</b></label>
    <select class="form-control" name="target_users[]" multiple style="height:200px;">
        <?php while($u = mysqli_fetch_assoc($sql_users)) { ?>
            <option value="<?php echo $u['userid']; ?>">
                <?php echo $u['name'].' ('.$u['email'].')'; ?>
            </option>
        <?php } ?>
    </select>
    <small>Select multiple users using CTRL + Click</small>
</div>

                            <!-- SUBJECT -->
                            <div class="form-group" id="email_subject_box">
                                <label><b>Email Subject</b></label>
                                <input type="text" class="form-control" name="subject" placeholder="Enter subject">
                            </div>

                            <!-- MESSAGE BODY -->
                            <div class="form-group" id="email_body_box">
                                <label><b>Message / Email Body</b></label>
                                <textarea class="form-control" name="body_content" rows="6"></textarea>
                            </div>

                            <!-- BANNER UPLOAD -->
                            <div id="banner_upload_box" style="display:none;">

                                <div class="form-group">
                                    <label><b>Upload Banner Image</b></label>
                                    <input type="file" class="form-control" name="media_file" accept="image/*">
                                </div>

                                <div class="form-group">
                                    <label><b>Valid From</b></label>
                                    <input type="datetime-local" class="form-control" name="valid_from">
                                </div>

                                <div class="form-group">
                                    <label><b>Valid Till</b></label>
                                    <input type="datetime-local" class="form-control" name="valid_till">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary mt-2">
                                Create Communication
                            </button>
                        </form>
                    </div>

                </div>
            </section>
        </div>

    </div>
</div>
<!-- END: Content-->

<?php include 'footer.php'; ?>


<script>
/* Show/Hide Specific Users */
$('#target_scope').change(function() {
    if($(this).val() === 'specific') {
        $('#specific_users_box').show();
    } else {
        $('#specific_users_box').hide();
    }
});

/* Show/Hide Email or Banner Fields */
$('#campaign_type').change(function() {
    if($(this).val() === 'email') {
        $('#email_subject_box').show();
        $('#email_body_box').show();
        $('#banner_upload_box').hide();
    } else {
        $('#email_subject_box').hide();
        $('#email_body_box').hide();
        $('#banner_upload_box').show();
    }
});

/* ⭐ IMPORTANT — RUN DEFAULT SELECTION ON PAGE LOAD */
$(document).ready(function() {
    $('#campaign_type').trigger('change');
    $('#target_scope').trigger('change');
});
</script>

