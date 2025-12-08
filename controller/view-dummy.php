<?php include 'header.php'; ?>
<?php include 'config.php'; ?>

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-body">
            <div class="row" id="basic-table">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">All Dummy Profiles</h4>
                            <a href="add-dummy.php" class="btn btn-primary">Add New</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Details</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM `dummy-profile` ORDER BY id DESC";
                                    $result = mysqli_query($con, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                        <tr>
                                            <td><img src="../images/profiles/<?php echo $row['image']; ?>" width="60"></td>
                                            <td><?php echo $row['profile_id']; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['age'] . " Yrs, " . $row['city']; ?></td>
                                            <td>
                                                <a href="edit-dummy.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-info">Edit</a>
                                                <a href="dummy-delete.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
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
</div>

<?php include 'footer.php'; ?>