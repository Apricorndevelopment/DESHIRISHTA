<?php include 'header.php'; ?>

    <div class="app-content content ">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Testimonials</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active">Add Testimonial</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="multiple-column-form">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header"><h4 class="card-title">Add New Testimonial</h4></div>
                                <div class="card-body">
                                    <form class="form" action="insert-testimonial.php" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="user_name"><b>User Name</b></label>
                                                    <input type="text" id="user_name" class="form-control" placeholder="i.e. John Smith" name="user_name" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="user_designation"><b>Designation</b></label>
                                                    <input type="text" id="user_designation" class="form-control" placeholder="i.e. IT Profession" name="user_designation">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="content"><b>Testimonial Content</b></label>
                                                    <textarea class="form-control" id="content" name="content" rows="4" placeholder="Write testimonial here..."></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="image"><b>User Image</b></label>
                                                    <input type="file" id="image" class="form-control" name="image" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="rating"><b>Rating (1 to 5)</b></label>
                                                    <select class="form-control" id="rating" name="rating">
                                                        <option value="5">5 Stars</option>
                                                        <option value="4">4 Stars</option>
                                                        <option value="3">3 Stars</option>
                                                        <option value="2">2 Stars</option>
                                                        <option value="1">1 Star</option>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="col-12 text-center mt-2 mb-2">
                                                <button type="submit" name="submit" class="btn btn-primary">Add Testimonial</button>
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
<?php include 'footer.php'; ?>