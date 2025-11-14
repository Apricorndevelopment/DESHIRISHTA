<?php
include 'header.php';
include 'config.php'; // $con variable yahan se aayega

// Database se current values fetch karein
$sql = "select * from tbl_homepage_stats where id = '1'";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($result);
?>

    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Analytics Stats</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active"><a href="#">Analytics Stats</a>
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
                <section id="multiple-column-form">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Update Homepage Analytics Stats</h4>
                                </div>
                                <div class="card-body">
                                    <?php
                                    // Yeh success message waise hi kaam karega
                                    if(isset($_GET['update']) && $_GET['update'] == 'success')
                                    {
                                    ?>
                                        <p class="text-center text-success">Updated Successfully</p>
                                    <?php
                                    }
                                    ?>
                                    <form class="form" action="update-analytics-stats.php" method="post">
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="couples-paired"><b>Couples Paired</b></label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i data-feather="heart"></i></span>
                                                        </div>
                                                        <input type="number" id="couples-paired" class="form-control" name="couples_paired" value="<?php echo $row['couples_paired']; ?>" placeholder="i.e. 200"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="total-registrants"><b>Total Registrants</b></label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i data-feather="users"></i></span>
                                                        </div>
                                                        <input type="number" id="total-registrants" class="form-control" name="total_registrants" value="<?php echo $row['total_registrants']; ?>" placeholder="i.e. 1500" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="total-men"><b>Total Mens</b></label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i data-feather="user"></i></span>
                                                        </div>
                                                        <input type="number" id="total-men" class="form-control" name="total_men" value="<?php echo $row['total_men']; ?>" placeholder="i.e. 700" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="total-women"><b>Total Womens</b></label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i data-feather="user"></i></span>
                                                        </div>
                                                        <input type="number" id="total-women" class="form-control" name="total_women" value="<?php echo $row['total_women']; ?>" placeholder="i.e. 800" />
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-12 text-center mt-2 mb-2">
                                                <button type="submit" name="submit" class="btn btn-primary">Update Stats</button>
                                            </div>
                                        </div>
                                    </form>
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