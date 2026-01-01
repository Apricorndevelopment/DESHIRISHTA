<?php
include 'header.php';
include 'config.php';

$res = mysqli_query($con, "SELECT * FROM web_notifications ORDER BY id DESC");
?>

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-body">
            <div class="card">
                <div class="card-header">
                    <h4>🔔 Web Push Notifications</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Message</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; while($row=mysqli_fetch_assoc($res)) { ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $row['title'] ?></td>
                                <td><?= $row['message'] ?></td>
                                <td>
                                    <?php if($row['status']=='active'){ ?>
                                        <span class="badge badge-success">Active</span>
                                    <?php } else { ?>
                                        <span class="badge badge-secondary">Inactive</span>
                                    <?php } ?>
                                </td>
                                <td>
                                    <a href="delete-notification.php?id=<?= $row['id'] ?>"
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Delete this notification?')">
                                       Delete
                                    </a>
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

<?php include 'footer.php'; ?>
