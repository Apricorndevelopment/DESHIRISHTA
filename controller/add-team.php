<?php include 'header.php'; ?>

    <div class="app-content content ">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Our Team</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active">Add Team Member</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="multiple-column-form">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header"><h4 class="card-title">Add New Team Member</h4></div>
                                <div class="card-body">
                                    <form class="form" action="insert-team.php" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="name"><b>Full Name</b></label>
                                                    <input type="text" id="name" class="form-control" placeholder="i.e. Ashley Jen" name="name" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="designation"><b>Designation</b></label>
                                                    <input type="text" id="designation" class="form-control" placeholder="i.e. Marketing Manager" name="designation">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="image"><b>Profile Image</b></label>
                                                    <input type="file" id="image" class="form-control" name="image" required>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="col-12"><h5 class="mt-2">Social Links (Optional)</h5></div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label>Facebook URL</label>
                                                    <input type="text" class="form-control" name="facebook" placeholder="https://facebook.com/username">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label>Twitter URL</label>
                                                    <input type="text" class="form-control" name="twitter" placeholder="https://twitter.com/username">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label>WhatsApp Number</label>
                                                    <input type="text" class="form-control" name="whatsapp" placeholder="https://wa.me/91...">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label>LinkedIn URL</label>
                                                    <input type="text" class="form-control" name="linkedin" placeholder="https://linkedin.com/in/username">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label>Instagram URL</label>
                                                    <input type="text" class="form-control" name="instagram" placeholder="https://instagram.com/username">
                                                </div>
                                            </div>
                                            
                                            <div class="col-12 text-center mt-2 mb-2">
                                                <button type="submit" name="submit" class="btn btn-primary">Add Member</button>
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