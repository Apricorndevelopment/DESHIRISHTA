<?php
include 'header.php';
include 'sidebar.php';
include '../config.php';

$sql = "SELECT * FROM admin_communication ORDER BY id DESC";
$result = mysqli_query($con, $sql);
?>

<style>
body { overflow-y:auto !important; }
.vertical-layout .main-menu { height:100vh !important; overflow-y:auto !important; }
.app-content { overflow:visible !important; }
</style>

<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>

    <div class="content-wrapper">

        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <h2 class="content-header-title mb-0">Manage Communications</h2>
            </div>
        </div>

        <?php if(isset($_GET['success'])) { ?>
            <div class="alert alert-success text-center"><?php echo $_GET['success']; ?></div>
        <?php } ?>

        <?php if(isset($_GET['error'])) { ?>
            <div class="alert alert-danger text-center"><?php echo $_GET['error']; ?></div>
        <?php } ?>

        <div class="content-body">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Communications List</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="dt">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Subject</th>
                                    <th>Type</th>
                                    <th>Target</th>
                                    <th>Date Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                            <?php $i=1; while($row=mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><b><?php echo $i++; ?></b></td>

                                    <td><?php echo htmlspecialchars($row['subject'] ?? '--'); ?></td>

                                    <td><?php echo ucfirst($row['type']); ?></td>

                                    <td>
                                        <?php
                                            echo ($row['target_scope']=='all')
                                            ? "<span class='text-primary'>All Users</span>"
                                            : "<span class='text-info'>Specific Users</span>";
                                        ?>
                                    </td>

                                    <td>
                                        <?php
                                            if(!empty($row['valid_from'])) {
                                                echo date("d M Y h:i A", strtotime($row['valid_from']));
                                            } else {
                                                echo '--';
                                            }
                                        ?>
                                    </td>

                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm dropdown-toggle" data-toggle="dropdown">Action</button>
                                            <div class="dropdown-menu">

                                                <a class="dropdown-item" href="view-email.php?id=<?php echo $row['id']; ?>">
                                                    View
                                                </a>

                                                <?php if($row['type']=='email') { ?>
                                                <a class="dropdown-item text-success"
                                                   href="../controller/send-email-campaign.php?id=<?php echo $row['id']; ?>"
                                                   onclick="return confirm('Send this email?');">
                                                   Send Email
                                                </a>
                                                <?php } ?>

                                                <a class="dropdown-item text-danger"
                                                   href="delete-communication.php?id=<?php echo $row['id']; ?>"
                                                   onclick="return confirm('Delete this record?');">
                                                   Delete
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
        </div>

    </div>
</div>

<?php include 'footer.php'; ?>

<script>
$(document).ready(function(){
    $('#dt').DataTable({
        order:[[4,'desc']]
    });
});
</script>
