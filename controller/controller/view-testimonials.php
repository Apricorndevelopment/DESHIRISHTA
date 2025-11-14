<?php
include 'header.php';
include 'config.php';
?>

    <div class="app-content content ">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">View Testimonials</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active">View Testimonials</li>
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
                                    <h4 class="card-title">All Testimonials</h4>
                                    <a href="add-testimonial.php" class="btn btn-primary">Add New</a>
                                </div>
                                <div class="card-body">
                                    <?php
                                    if(isset($_GET['status']) && $_GET['status'] == 'added') { echo '<p class="text-center text-success">Added successfully!</p>'; }
                                    if(isset($_GET['status']) && $_GET['status'] == 'updated') { echo '<p class="text-center text-success">Updated successfully!</p>'; }
                                    if(isset($_GET['status']) && $_GET['status'] == 'deleted') { echo '<p class="text-center text-success">Deleted successfully!</p>'; }
                                    ?>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Image</th>
                                                    <th>Name</th>
                                                    <th>Designation</th>
                                                    <th>Rating</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = "SELECT * FROM tbl_testimonials ORDER BY id DESC";
                                                $result = mysqli_query($con, $sql);
                                                
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $row['id']; ?></td>
                                                        <td>
                                                            <img src="../images/profiles/<?php echo $row['user_image']; ?>" alt="Profile" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                                                        </td>
                                                        <td><?php echo $row['user_name']; ?></td>
                                                        <td><?php echo $row['user_designation']; ?></td>
                                                        <td><?php echo $row['rating']; ?> Stars</td>
                                                        <td>
                                                            <?php 
                                                            if($row['status'] == 'Active') {
                                                                echo '<span class="badge badge-success">Active</span>';
                                                            } else {
                                                                echo '<span class="badge badge-danger">Inactive</span>';
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <a href="edit-testimonial.php?id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">Edit</a>
                                                            <a href="delete-testimonial.php?id=<?php echo $row['id']; ?>" 
                                                               class="btn btn-danger btn-sm" 
                                                               onclick="return confirm('Are you sure?');">
                                                               Delete
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='7' class='text-center'>No testimonials found.</td></tr>";
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