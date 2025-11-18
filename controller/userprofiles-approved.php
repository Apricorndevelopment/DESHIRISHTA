<?php
include 'header.php';
include 'config.php';

?>

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">User Profiles</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active"><a href="#">user profiles</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">
                        <div class="dropdown">
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic multiple Column Form section start -->
                <section id="multiple-column-form">
                    <div class="row" id="basic-table">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Profiles</h4>
                            </div>
                            <?php
                            if($_GET['profilestatus'] == 'yes')
                            {
                            ?>
                                <p class="text-center text-success">Profile Status Updated Successfully</p>
                            <?php
                            }
                            ?>
                            <?php
                            if($_GET['delete'] == 'success')
                            {
                            ?>
                                <p class="text-center text-danger">Delete Successfully</p>
                            <?php
                            }
                            ?>
                            <div class="table-responsive col-md-12">
                                <table class="table table-striped file-export" id="dt"> 
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Userid</th>
                                            <th>Name</th>
                                            <th>Phone & Email</th>
                                            <th>Join Date</th>
                                            <th>Profile Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        $sql = "select * from registration where profilestatus = '1' order by id desc";
                                        $result = mysqli_query($con,$sql);
                                        while($row = mysqli_fetch_assoc($result))
                                        {
                                        ?>
                                        <tr>
                                            <td><b><?php echo $i; ?>.</b></td>
                                            <td><?php echo $row['userid']; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['phone'].'<br>'.$row['email']; ?></td>
                                            <!-- <td>
                                                <?php 
                                                if($row['profilestatus'] == '0')
                                                {
                                                    echo "<span class='text-danger'>Pending</span>";
                                                }
                                                else
                                                {
                                                    echo "<span class='text-success'>Approved</span>";
                                                }
                                                ?>
                                            </td> -->


                                                        <td>
                                                <?php 
                                                if($row['profilestatus'] == '0')
                                                {
                                                    echo "<span class='text-danger'>Pending</span>";
                                                }
                                                elseif($row['profilestatus'] == '1')
                                                {
                                                    echo "<span class='text-success'>Approved</span>";
                                                }
                                                elseif($row['profilestatus'] == '2')
                                                {
                                                    echo "<span class='text-warning'>Deactivated</span>"; 
                                                }
                                                elseif($row['profilestatus'] == '3')
                                                {
                                                    echo "<span class='text-dark'>Deleted</span>"; 
                                                }
                                                ?>
                                            </td>
                                            <td><?php echo date('d M Y', strtotime($row['entrydate'])); ?></td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item text-success" href="userprofile-view.php?uid=<?php echo $row['userid']; ?>">
                                                            <i data-feather="eye" class="mr-50"></i>
                                                            <span>View</span>
                                                        </a>
                                                        <a class="dropdown-item text-danger" href="userprofile-delete.php?uid=<?php echo $row['userid']; ?>">
                                                            <i data-feather="trash" class="mr-50"></i>
                                                            <span>Delete</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                        $i++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                </section>
                <!-- Basic Floating Label Form section end -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

<?php
include 'footer.php';   
?>