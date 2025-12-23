<?php
include 'header.php';
include 'config.php';
?>

    <div class="app-content content ">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">View Team</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active">View Team Members</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">All Team Members</h4>
                                    <a href="add-team.php" class="btn btn-primary">Add New Member</a>
                                </div>
                                <div class="card-body">
                                    <?php
                                    if(isset($_GET['status']) && $_GET['status'] == 'added') { echo '<p class="text-center text-success">Member added successfully!</p>'; }
                                    if(isset($_GET['status']) && $_GET['status'] == 'updated') { echo '<p class="text-center text-success">Member updated successfully!</p>'; }
                                    if(isset($_GET['status']) && $_GET['status'] == 'deleted') { echo '<p class="text-center text-success">Member deleted successfully!</p>'; }
                                    ?>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Image</th>
                                                    <th>Name</th>
                                                    <th>Designation</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = "SELECT * FROM tbl_team ORDER BY id ASC";
                                                $result = mysqli_query($con, $sql);
                                                
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $row['id']; ?></td>
                                                        <td>
                                                            <img src="../images/profiles/<?php echo $row['image']; ?>" alt="Profile" style="width: 70px; border-radius: 5px;">
                                                        </td>
                                                        <td><?php echo $row['name']; ?></td>
                                                        <td><?php echo $row['designation']; ?></td>
                                                        <td>
                                                            <a href="edit-team.php?id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">Edit</a>
                                                            <a href="delete-team.php?id=<?php echo $row['id']; ?>" 
                                                               class="btn btn-danger btn-sm" 
                                                               onclick="return confirm('Are you sure you want to delete this member?');">
                                                               Delete
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='5' class='text-center'>No team members found.</td></tr>";
                                                }
                                                ?>
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