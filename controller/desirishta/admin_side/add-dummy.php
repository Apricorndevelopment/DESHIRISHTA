<?php include 'header.php'; ?>

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Manage Dummy Profiles</h2>
            </div>
        </div>
        <div class="content-body">
            <section id="basic-vertical-layouts">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add New Profile</h4>
                            </div>
                            <div class="card-body">
                                <form class="form form-vertical" action="insert-dummy.php" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" class="form-control" name="name" placeholder="Name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Profile ID (Custom ID)</label>
                                                <input type="text" class="form-control" name="profile_id" placeholder="e.g. DR250101..." required>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-6">
                                            <div class="form-group">
                                                <label>Age</label>
                                                <input type="number" class="form-control" name="age" placeholder="25" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-6">
                                            <div class="form-group">
                                                <label>Height</label>
                                                <input type="text" class="form-control" name="height" placeholder="5 Feet 5 Inches" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Marital Status</label>
                                                <select class="form-control" name="marital_status">
                                                    <option value="Never Married">Never Married</option>
                                                    <option value="Divorced">Divorced</option>
                                                    <option value="Widowed">Widowed</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Religion</label>
                                                <select class="form-control" name="religion">
                                                    <option value="Hindu">Hindu</option>
                                                    <option value="Muslim">Muslim</option>
                                                    <option value="Sikh">Sikh</option>
                                                    <option value="Christian">Christian</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Caste / Sect</label>
                                                <input type="text" class="form-control" name="caste" placeholder="e.g. Brahmin, Sunni">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Education</label>
                                                <input type="text" class="form-control" name="education" placeholder="e.g. MBA, B.Tech">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Profession</label>
                                                <input type="text" class="form-control" name="profession" placeholder="e.g. Software Engineer">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>City</label>
                                                <input type="text" class="form-control" name="city" placeholder="e.g. Delhi">
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label>Profile Image</label>
                                                <input type="file" class="form-control" name="image" required>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" name="submit" class="btn btn-primary mr-1">Submit</button>
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