<?php
include 'header.php';
include 'sidebar.php';
include '../config.php';

// Fetch all email communications
// $sql = "SELECT * FROM admin_communication WHERE type='email' ORDER BY id DESC";
// सभी (Email और Banner) दिखाने के लिए:
$sql = "SELECT * FROM admin_communication ORDER BY id DESC";
$result = mysqli_query($con, $sql);
?>

<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>

    <div class="content-wrapper">

        <!-- PAGE HEADER -->
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">
                            Manage Email Communications
                        </h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">Communication</a></li>
                                <li class="breadcrumb-item active">Email Campaigns</li>
                            </ol>
                        </div>
                    </div>
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
                        <h4 class="card-title">Email Communications List</h4>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="dt">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Subject</th>
                                        <th>Type</th> 


                                        <th>Target</th>
                                        <th>Date Created</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php 
                                    $i = 1;
                                    while($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                        <td><b><?php echo $i++; ?>.</b></td>

                                        <td><?php echo htmlspecialchars($row['subject']); ?></td>

<td>
    <?php echo ucfirst($row['type']); ?>
</td>
                                        <td>
                                            <?php 
                                                if($row['target_scope'] === 'all') {
                                                    echo "<span class='text-primary'>All Users</span>";
                                                } else {
                                                    echo "<span class='text-info'>Specific Users</span>";
                                                }
                                            ?>
                                        </td>

                                        <td><?php echo date("d M Y h:i A", strtotime($row['entry_date'])); ?></td>

                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown">
                                                    Action
                                                </button>

                                                <div class="dropdown-menu">

                                                    <a class="dropdown-item" href="view-email.php?id=<?php echo $row['id']; ?>">
                                                        <i data-feather="eye" class="mr-50"></i> View
                                                    </a>

                                                    <a class="dropdown-item text-success" 
                                                       href="../controller/send-email-campaign.php?id=<?php echo $row['id']; ?>"
                                                       onclick="return confirm('Are you sure you want to send this email campaign?');">
                                                        <i data-feather="send" class="mr-50"></i> Send Email
                                                    </a>

                                                    <a class="dropdown-item text-danger" 
                                                       href="delete-communication.php?id=<?php echo $row['id']; ?>"
                                                       onclick="return confirm('Delete this communication?');">
                                                        <i data-feather="trash" class="mr-50"></i> Delete
                                                    </a>

                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    <?php } ?>
                                </tbody>

                            </table>
                        </div>
                    </div>

                </div>
            </section>
        </div>

    </div>
</div>
<!-- END: Content-->

<?php include 'footer.php'; ?>

<script>
$(document).ready(function() {
    $('#dt').DataTable();
});
</script>
