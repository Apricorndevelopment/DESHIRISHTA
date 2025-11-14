<?php
include 'header.php';
include 'config.php';

$userid = $_GET['uid'];

$sqlformfill = "select * from registration where userid = '$userid'";
$resultformfill = mysqli_query($con,$sqlformfill);
$rowformfill = mysqli_fetch_assoc($resultformfill);

$sqlbasicinfo = "select * from basic_info where userid = '$userid'";
$resultbasicinfo = mysqli_query($con,$sqlbasicinfo);
$rowbasicinfo = mysqli_fetch_assoc($resultbasicinfo);

$sqlastroinfo = "select * from astro_info where userid = '$userid'";
$resultastroinfo = mysqli_query($con,$sqlastroinfo);
$rowastroinfo = mysqli_fetch_assoc($resultastroinfo);

$sqlreligiousinfo = "select * from religious_info where userid = '$userid'";
$resultreligiousinfo = mysqli_query($con,$sqlreligiousinfo);
$rowreligiousinfo = mysqli_fetch_assoc($resultreligiousinfo);

$sqleudcationinfo = "select * from education_info where userid = '$userid'";
$resulteudcationinfo = mysqli_query($con,$sqleudcationinfo);
$roweudcationinfo = mysqli_fetch_assoc($resulteudcationinfo);

$sqlgroomlocation = "select * from groom_location where userid = '$userid'";
$resultgroomlocation = mysqli_query($con,$sqlgroomlocation);
$rowgroomlocation = mysqli_fetch_assoc($resultgroomlocation);

$sqlfamilyinfo = "select * from family_info where userid = '$userid'";
$resultfamilyinfo = mysqli_query($con,$sqlfamilyinfo);
$rowfamilyinfo = mysqli_fetch_assoc($resultfamilyinfo);

$sqlhobbiesinfo = "select * from hobbies_info where userid = '$userid'";
$resulthobbiesinfo = mysqli_query($con,$sqlhobbiesinfo);
$rowhobbiesinfo = mysqli_fetch_assoc($resulthobbiesinfo);

$sqlpartnerinfo = "select * from partner_info where userid = '$userid'";
$resultpartnerinfo = mysqli_query($con,$sqlpartnerinfo);
$rowpartnerinfo = mysqli_fetch_assoc($resultpartnerinfo);

$sqlcontactinfo = "select * from contact_info where userid = '$userid'";
$resultcontactinfo = mysqli_query($con,$sqlcontactinfo);
$rowcontactinfo = mysqli_fetch_assoc($resultcontactinfo);

$sqlphotosinfo = "select * from photos_info where userid = '$userid'";
$resultphotosinfo = mysqli_query($con,$sqlphotosinfo);
$rowphotosinfo = mysqli_fetch_assoc($resultphotosinfo);
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
                            <h2 class="content-header-title float-left mb-0">View Profile</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active"><a href="#">View Profile</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">
                        <div class="dropdown"></div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic multiple Column Form section start -->
                <section id="multiple-column-form">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-primary mb-2">
                                    <h4 class="card-title text-white">Basic Information</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Profile created by</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="heading" value="<?php echo $rowbasicinfo['createby']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Name</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="category" value="<?php echo $rowbasicinfo['fullname']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Gender</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="category" value="<?php echo $rowbasicinfo['gender']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Marital Status</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="category" value="<?php echo $rowbasicinfo['marital']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Have Children</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="category" value="<?php echo $rowbasicinfo['children']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Age</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="category" value="<?php echo $rowbasicinfo['age']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Height</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="category" value="<?php echo $rowbasicinfo['height']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Weight</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="category" value="<?php echo $rowbasicinfo['weight']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Any Disability</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="category" value="<?php echo $rowbasicinfo['physical']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Language Known</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="category" value="<?php echo str_replace("//", ", ", $rowbasicinfo['langauge']); ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Eating Habits</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="category" value="<?php echo $rowbasicinfo['eating']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Smoking Habits</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="category" value="<?php echo $rowbasicinfo['smoking']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Drinking Habits</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="category" value="<?php echo $rowbasicinfo['drinking']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-primary mb-2">
                                    <h4 class="card-title text-white">About <?php if($rowformfill['groomlocation'] == 'Done') { echo "Groom"; } if($rowformfill['bridelocation'] == 'Done') { echo "Bride"; } ?></h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <div class="input-group input-group-merge">
                                                    <textarea class="form-control" name="shortcontent" placeholder="About" readonly/><?php echo $rowbasicinfo['aboutme']; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-primary mb-2">
                                    <h4 class="card-title text-white">Astro Details</h4> 
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Date of Birth</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="heading" value="<?php echo $rowastroinfo['dob']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Place of Birth</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="category" value="<?php echo $rowastroinfo['birthplace']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Time of Birth</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="category" value="<?php echo $rowastroinfo['birthtime']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Dosh/Dosham</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="category" value="<?php echo $rowastroinfo['manglik']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-primary mb-2">
                                    <h4 class="card-title text-white">Religious Background</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Religion</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="heading" value="<?php echo $rowreligiousinfo['religion']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Caste</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="category" value="<?php echo $rowreligiousinfo['caste']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Gothram</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="category" value="<?php echo $rowreligiousinfo['gothram']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Sub-caste</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="category" value="<?php echo $rowreligiousinfo['subcaste']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-primary mb-2">
                                    <h4 class="card-title text-white">Education & Career</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Stream</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="heading" value="<?php echo $roweudcationinfo['stream']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Highest Education</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="category" value="<?php echo $roweudcationinfo['education']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>College / Institution</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="category" value="<?php echo $roweudcationinfo['college']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Working With</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="category" value="<?php echo $roweudcationinfo['workingwith']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Profession</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="category" value="<?php echo $roweudcationinfo['profession']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Designation</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="category" value="<?php echo $roweudcationinfo['designation']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Profession in Detail</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="category" value="<?php echo $roweudcationinfo['professiondetail']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Employer Name</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="category" value="<?php echo $roweudcationinfo['employername']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Annual Income</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="category" value="<?php echo $roweudcationinfo['income']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-primary mb-2">
                                    <h4 class="card-title text-white"><?php if($rowformfill['groomlocation'] == 'Done') { echo "Groom"; } if($rowformfill['bridelocation'] == 'Done') { echo "Bride"; } ?> Location</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Country</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="heading" value="<?php echo $rowgroomlocation['country']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Citizenship</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="category"  value="<?php echo $rowgroomlocation['citizenship']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Resident Status</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="category"  value="<?php echo $rowgroomlocation['resident']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>State</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="category"  value="<?php echo $rowgroomlocation['state']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>City</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="category"  value="<?php echo str_replace("//", "", $rowgroomlocation['city']); ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-primary mb-2">
                                    <h4 class="card-title text-white">Family Details</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Family Value</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="heading" value="<?php echo $rowfamilyinfo['familyvalue']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Family Type</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="category" value="<?php echo $rowfamilyinfo['familytype']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Family Status</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="category" value="<?php echo $rowfamilyinfo['familystatus']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Native Place</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="category" value="<?php echo $rowfamilyinfo['nativeplace']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Father Name</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="category" value="<?php echo $rowfamilyinfo['fathername']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Mother Name</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="category" value="<?php echo $rowfamilyinfo['mothername']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Father's Occupation</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="category" value="<?php echo $rowfamilyinfo['fatheroccupation']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Mother's Occupation</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="category" value="<?php echo $rowfamilyinfo['motheroccupation']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>No. Of Brothers</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="category" value="<?php echo $rowfamilyinfo['brothers']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Brothers Married</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="category" value="<?php echo $rowfamilyinfo['bromarried']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>No. Of Sisters</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="category" value="<?php echo $rowfamilyinfo['sisters']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Sisters Married</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="category" value="<?php echo $rowfamilyinfo['sismarried']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Family Location</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="category" value="<?php echo $rowfamilyinfo['familylocation']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>State</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="category" value="<?php echo $rowfamilyinfo['state']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>City</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="category" value="<?php echo $rowfamilyinfo['city']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Country</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="category" value="<?php echo $rowfamilyinfo['country']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-primary mb-2">
                                    <h4 class="card-title text-white">Hobbies & Interest</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Hobbies and Interest</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="heading" value="<?php echo str_replace("//", ", ", $rowhobbiesinfo['hobbies']); ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Favourite Music</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="category" value="<?php echo str_replace("//", ", ", $rowhobbiesinfo['music']); ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Sports you like</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="category" value="<?php echo str_replace("//", ", ", $rowhobbiesinfo['sports']); ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Your Favourite Food</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="category" value="<?php echo str_replace("//", ", ", $rowhobbiesinfo['food']); ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-primary mb-2">
                                    <h4 class="card-title text-white">Partner Preferences</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Partner Age</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="category" value="<?php echo $rowpartnerinfo['partnerage']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Height</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="category" value="<?php echo $rowpartnerinfo['partnerheight']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Marital Status</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="heading" value="<?php echo $rowpartnerinfo['partnermarital']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Eating Habits</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="category" value="<?php echo $rowpartnerinfo['partnereating']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Drinking Habits</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="category" value="<?php echo $rowpartnerinfo['partnerdrinking']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Smoking Habits</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="category" value="<?php echo $rowpartnerinfo['partnersmoking']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Religion</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="category" value="<?php echo $rowpartnerinfo['partnerreligion']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Caste</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="category" value="<?php echo $rowpartnerinfo['partnercaste']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Manglik</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="category" value="<?php echo $rowpartnerinfo['partnermanglik']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Stream</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="category" value="<?php echo $rowpartnerinfo['partnerstream']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Highesh Education</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="category" value="<?php echo $rowpartnerinfo['partnereducation']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>College / Institution</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="category" value="<?php echo $rowpartnerinfo['partnercollege']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Profession</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                       
                                                    <input type="text" class="form-control" name="category" value="<?php echo $rowpartnerinfo['partnerprofession']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Domain</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="category" value="<?php echo $rowpartnerinfo['partnerdomain']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Designation</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="category" value="<?php echo $rowpartnerinfo['partnerdesignation']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Employer Name</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="category" value="<?php echo $rowpartnerinfo['partneremployername']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Annual Income</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="category" value="<?php echo $rowpartnerinfo['partnerincome']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>State</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="category" value="<?php echo $rowpartnerinfo['partnerstate']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>City</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="category" value="<?php echo $rowpartnerinfo['partnercity']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Country</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="category" value="<?php echo $rowpartnerinfo['partnercountry']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-primary mb-2">
                                    <h4 class="card-title text-white">Contact Details</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Phone Number</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="heading" value="<?php echo $rowcontactinfo['phonenumber']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Email</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="category" value="<?php echo $rowcontactinfo['email']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Name of Contact Person</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="category" value="<?php echo $rowcontactinfo['contactperson']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Relationship with the member</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text gray "><i data-feather="file-text"></i></span>
                                                    </div>                                                        
                                                    <input type="text" class="form-control" name="category" value="<?php echo $rowcontactinfo['relationship']; ?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-primary mb-2">
                                    <h4 class="card-title text-white">Manage Photos</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Profile Picture</b></label>
                                                <div class="input-group input-group-merge">
                                                    <img src="../userphoto/<?php echo $rowphotosinfo['profilepic']; ?>" style="width:100%">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Photo 1</b></label>
                                                <div class="input-group input-group-merge">
                                                    <img src="../userphoto/<?php echo $rowphotosinfo['photo1']; ?>" style="width:100%">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Photo 2</b></label>
                                                <div class="input-group input-group-merge">
                                                    <img src="../userphoto/<?php echo $rowphotosinfo['photo2']; ?>" style="width:100%">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"><b>Photo 3</b></label>
                                                <div class="input-group input-group-merge">
                                                    <img src="../userphoto/<?php echo $rowphotosinfo['photo3']; ?>" style="width:100%">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    if($rowformfill['profilestatus'] == '0')
                    {
                    ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 text-center mt-2 mb-2">
                                            <a href="userprofile-update.php?uid=<?php echo $userid; ?>" class="btn btn-success">Make Profile Live</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </section>
                <!-- Basic Floating Label Form section end -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

<?php
include 'footer.php';   
?>