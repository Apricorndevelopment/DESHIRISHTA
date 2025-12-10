<?php
include 'header.php';
include 'config.php';

$page = $_GET['page'];

$lower_page = $page - 1;

$lower_limit = $lower_page * 10;
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
                            <h2 class="content-header-title float-left mb-0">Blogs</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active"><a href="#">Blogs</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">
                        <div class="dropdown">
                            <a href="add-blog.php" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle">Add Blogs</a>
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
                                <h4 class="card-title">Blogs</h4>
                            </div>
                            <?php
                            if($_GET['insert'] == 'success')
                            {
                            ?>
                                <p class="text-center text-success">Insert Successfully</p>
                            <?php
                            }
                            ?>
                            <?php
                            if($_GET['update'] == 'success')
                            {
                            ?>
                                <p class="text-center text-success">Update Successfully</p>
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
                                <table class="table table-striped file-export"> 
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Image</th>
                                            <th>Heading</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        $sql = "select * from blogs order by id desc limit $lower_limit,10";
                                        $result = mysqli_query($con,$sql);
                                        while($row = mysqli_fetch_assoc($result))
                                        {
                                        ?>
                                        <tr>
                                            <td><b><?php echo $i * $page; ?>.</b></td>
                                            <td><img src="blogimages/<?php echo $row['blogimages']; ?>" style="width:100px;"> </td>
                                            <td><?php echo $row['heading']; ?></td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                                        <i data-feather="more-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item text-success" href="edit-blogs.php?id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>">
                                                            <i data-feather="edit-2" class="mr-50"></i>
                                                            <span>Edit</span>
                                                        </a>
                                                        <a class="dropdown-item text-danger" href="delete-blogs.php?id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>">
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
                            <div class="row">
                                <div class="col-sm-4 col-md-4">
                                </div>   
                                <div class="col-sm-4 col-md-4 m-2">
                                    <?php
                                    $sql1 = "select * from blogs order by id asc";
                                    $result1 = mysqli_query($con,$sql1);
                                    $count = mysqli_num_rows($result1);
                                    
                                    $total_page = ceil($count/10);
                                    ?>
                                    <div class="dataTables_paginate paging_simple_numbers" id="dt_paginate">
                                        <ul class="pagination">
                                            <li class="paginate_button page-item previous <?php if($page < '2') { echo 'disabled'; } ?>" id="dt_previous">
                                                <a href="view-blogs.php?page=<?php echo $page - 1; ?>" aria-controls="dt" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
                                            </li>
                                            <li class="paginate_button page-item active">
                                                <a href="#" aria-controls="dt" data-dt-idx="1" tabindex="0" class="page-link">Page <?php echo $page; ?></a>
                                            </li>
                                            <li class="paginate_button page-item next <?php if($page > ($total_page - 1)) { echo 'disabled'; } ?>" id="dt_next">
                                                <a href="view-blogs.php?page=<?php echo $page + 1; ?>" aria-controls="dt" data-dt-idx="3" tabindex="0" class="page-link">Next</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4">
                                </div>
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