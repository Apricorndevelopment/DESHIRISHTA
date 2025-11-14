<?php
include 'header.php';
include 'config.php';
?>

    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">View Couples</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active">View Recent Couples
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">All Recent Couples</h4>
                                    <a href="add-couple.php" class="btn btn-primary">Add New Couple</a>
                                </div>
                                <div class="card-body">
                                    <?php
                                    if(isset($_GET['status']) && $_GET['status'] == 'added') {
                                        echo '<p class="text-center text-success">Couple added successfully!</p>';
                                    }
                                    if(isset($_GET['status']) && $_GET['status'] == 'deleted') {
                                        echo '<p class="text-center text-success">Couple deleted successfully!</p>';
                                    }
                                    ?>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Image</th>
                                                    <th>Couple Name</th>
                                                    <th>Location</th>
                                                    <th>Date Added</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // Database se couples fetch karein
                                                $sql = "SELECT * FROM tbl_recent_couples ORDER BY date_added DESC";
                                                $result = mysqli_query($con, $sql);
                                                
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $row['id']; ?></td>
                                                        <td>
                                                            <img src="../images/couples/<?php echo $row['image']; ?>" alt="Couple Image" style="width: 100px; border-radius: 5px;">
                                                        </td>
                                                        <td><?php echo $row['couple_name']; ?></td>
                                                        <td><?php echo $row['location']; ?></td>
                                                        <td><?php echo date('d-M-Y', strtotime($row['date_added'])); ?></td>
                                                       
<td>
    <a href="edit-couple.php?id=<?php echo $row['id']; ?>" 
       class="btn btn-info btn-sm">
       Edit
    </a>

    <a href="delete-couple.php?id=<?php echo $row['id']; ?>" 
       class="btn btn-danger btn-sm" 
       onclick="return confirm('Are you sure you want to delete this couple?');">
       Delete
    </a>
</td>

                                                    </tr>
                                                <?php
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='6' class='text-center'>No couples found.</td></tr>";
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
    <?php
include 'footer.php';   
?>