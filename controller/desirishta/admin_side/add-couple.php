<?php
include 'header.php'; // Header include karega
?>

    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Recent Couples</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active">Add Recent Couple
                                    </li>
                                </ol>
                            </div>
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
                                    <h4 class="card-title">Add New Couple</h4>
                                </div>
                                <div class="card-body">
                                    <?php
                                    if(isset($_GET['status']) && $_GET['status'] == 'success') {
                                        echo '<p class="text-center text-success">Couple added successfully!</p>';
                                    }
                                    if(isset($_GET['status']) && $_GET['status'] == 'error') {
                                        echo '<p class="text-center text-danger">Error adding couple. Please try again.</p>';
                                    }
                                    ?>
                                    <form class="form" action="insert-couple.php" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="couple-name"><b>Couple Name</b> (i.e. Dany & July)</label>
                                                    <input type="text" id="couple-name" class="form-control" placeholder="Dany & July" name="couple_name" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="location"><b>Location</b> (i.e. New York)</label>
                                                    <input type="text" id="location" class="form-control" placeholder="New York" name="location">
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="image"><b>Couple Image</b></label>
                                                    <input type="file" id="image" class="form-control" name="image" required>
                                                </div>
                                            </div>
                                            <div class="col-12 text-center mt-2 mb-2">
                                                <button type="submit" name="submit" class="btn btn-primary">Add Couple</button>
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
include 'footer.php'; // Footer include karega  
?>