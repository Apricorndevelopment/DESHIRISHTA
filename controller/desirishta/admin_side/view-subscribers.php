<?php
include 'header.php';
include 'config.php';

if (isset($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];
    mysqli_query($con, "DELETE FROM tbl_newsletter WHERE id='$deleteId'");
    echo "<script>alert('Subscriber Deleted Successfully'); window.location.href='newsletter-subscribers.php';</script>";
}
?>

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Newsletter Subscribers</h2>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                <div class="form-group breadcrumb-right">
                    <a href="export-subscribers.php" class="btn btn-primary">Export to Excel</a>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="basic-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body card-dashboard">
                                <div class="table-responsive">
                                    <table class="table zero-configuration">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Email ID</th>
                                                <th>Date Subscribed</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * FROM tbl_newsletter ORDER BY id DESC";
                                            $result = mysqli_query($con, $sql);
                                            $count = 1;
                                            while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $count++; ?></td>
                                                    <td><?php echo $row['email']; ?></td>
                                                    <td><?php echo date('d M Y, h:i A', strtotime($row['created_at'])); ?></td>
                                                    <td>
                                                        <a href="?delete_id=<?php echo $row['id']; ?>"
                                                            class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Are you sure you want to delete this subscriber?');">
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
            </section>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>