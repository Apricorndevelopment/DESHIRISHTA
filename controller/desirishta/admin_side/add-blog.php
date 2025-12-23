<?php
include 'header.php';
include 'config.php';

date_default_timezone_set("Asia/Kolkata");
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
                            <h2 class="content-header-title float-left mb-0">Add Blog</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active"><a href="#">Add Blog</a>
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
                                    <h4 class="card-title">Add Blog</h4>
                                </div>
                                <div class="card-body">
                                    <form class="form" action="insert-blog.php" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-8 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column"><b>Heading</b></label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i data-feather="file-text"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" name="heading" placeholder="Heading"/>
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
                                                        <input type="text" class="form-control" name="category" placeholder="Category"/>
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
                                                            <option>Active</option>
                                                            <option>Draft</option>
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
                                                            <span class="input-group-text"><i data-feather="calendar"></i></span>
                                                        </div>
                                                        <input type="date" class="form-control" name="postdate" placeholder="postdate" value="<?php echo date('Y-m-d'); ?>"/>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column"><b>Short Content</b></label>
                                                    <div class="input-group input-group-merge">
                                                        <textarea class="form-control" name="shortcontent" placeholder="Short Content"/></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column"><b>Content</b></label>
                                                    <div class="input-group input-group-merge">
                                                        <textarea id="editor" class="form-control" name="content" placeholder="Content"/ style="width:100%"></textarea>
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