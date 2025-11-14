<?php
include 'header.php';
include 'config.php';

$tableid = $_GET['id'];
$page = $_GET['page'];

$sql = "select * from blogs where id = '$tableid'";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($result);
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
                            <h2 class="content-header-title float-left mb-0">Edit Blog</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active"><a href="#">Edit Blog</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">
                        <div class="dropdown">
                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
                            <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="app-todo.html"><i class="mr-1" data-feather="check-square"></i><span class="align-middle">Todo</span></a><a class="dropdown-item" href="app-chat.html"><i class="mr-1" data-feather="message-square"></i><span class="align-middle">Chat</span></a><a class="dropdown-item" href="app-email.html"><i class="mr-1" data-feather="mail"></i><span class="align-middle">Email</span></a><a class="dropdown-item" href="app-calendar.html"><i class="mr-1" data-feather="calendar"></i><span class="align-middle">Calendar</span></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic multiple Column Form section start -->
                <section id="multiple-column-form">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Edit Blog</h4>
                                </div>
                                <div class="card-body">
                                    <form class="form" action="update-blog.php" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-8 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column"><b>Heading</b></label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i data-feather="file-text"></i></span>
                                                        </div>
                                                        <input type="hidden" class="form-control" name="page" value="<?php echo $page; ?>"/>
                                                        <input type="hidden" class="form-control" name="tableid" value="<?php echo $row['id']; ?>"/>
                                                        <input type="text" class="form-control" name="heading" placeholder="Heading" value="<?php echo $row['heading']; ?>"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column"><b>Category</b></label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i data-feather="file-text"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" name="category" placeholder="Category" value="<?php echo $row['category']; ?>"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column"><b>Status</b></label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i data-feather="file-text"></i></span>
                                                        </div>
                                                        <select class="form-control" name="status">
                                                            <option>Select</option>
                                                            <option <?php if($row['status'] == 'Active') { echo "selected"; } ?>>Active</option>
                                                            <option <?php if($row['status'] == 'Draft') { echo "selected"; } ?>>Draft</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column"><b>Image</b></label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i data-feather="image"></i></span>
                                                        </div>
                                                        <input type="file" class="form-control" name="blogimages" />
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column"><b>Post Date</b></label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i data-feather="file-text"></i></span>
                                                        </div>
                                                        <input type="date" class="form-control" name="postdate" placeholder="postdate" value="<?php echo $row['postdate']; ?>"/>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-9 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column"><b>Short Content</b></label>
                                                    <div class="input-group input-group-merge">
                                                        <textarea class="form-control" name="shortcontent" style="height:140px" placeholder="Short Content"/><?php echo $row['shortcontent']; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-3 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column"><b>Upoaded Image</b></label>
                                                    <div class="input-group input-group-merge">
                                                        <img src="blogimages/<?php echo $row['blogimages']; ?>" style="width:150px; height:150px; text-align:center">
                                                        <input type="hidden" class="form-control" name="oldblogimages" value="<?php echo $row['blogimages']; ?>"/>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column"><b>Content</b></label>
                                                    <div class="input-group input-group-merge">
                                                        <textarea id="editor" class="form-control" name="content" placeholder="Content"/><?php echo $row['content']; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-12 text-center mt-2 mb-2">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </form>
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