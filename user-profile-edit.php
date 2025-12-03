<?php
include 'header.php';
include 'config.php';

$userid = $_COOKIE['dr_userid'];

if ($userid == '') {
    header('location:login.php');
}


$sql_check_gender = "SELECT gender FROM registration WHERE userid = '$userid'";
$result_check_gender = mysqli_query($con, $sql_check_gender);
$row_check_gender = mysqli_fetch_assoc($result_check_gender);

if($row_check_gender['gender'] == 'Male') {
    // If Male, update 'groomlocation'
    $sql_status_update = "UPDATE registration SET groomlocation = 'Done' WHERE userid = '$userid'";
} else {
  
    $sql_status_update = "UPDATE registration SET bridelocation = 'Done' WHERE userid = '$userid'";
}

mysqli_query($con, $sql_status_update);

// header('location: user-profile-edit.php?groom_update=yes&tab=groom');

function render_dropdown_options($con, $dropdownName, $selectedValue)
{
    echo '<option value="">Select</option>';

    $sql = "SELECT option_value FROM master_dropdown_options WHERE dropdown_name = '$dropdownName' ORDER BY sort_order ASC, option_value ASC";
    $result = mysqli_query($con, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $value = htmlspecialchars($row['option_value']);
            // If the selected value matches, set the 'selected' attribute
            $selected = ($selectedValue == $value) ? 'selected' : '';
            echo "<option value=\"$value\" $selected>$value</option>";
        }
        // Free the result set
        if (is_object($result)) {
            mysqli_free_result($result);
        }
    }
}


function render_multiselect_options($con, $dropdownName, $selectedValues)
{
    echo '<option value="">Select</option>';

    $sql = "SELECT option_value FROM master_dropdown_options WHERE dropdown_name = '$dropdownName' ORDER BY sort_order ASC, option_value ASC";
    $result = mysqli_query($con, $sql);

    if ($result) {
        // Ensure selected values are in a usable array format
        if (!is_array($selectedValues)) {
            $selectedValues = [];
        }

        while ($row = mysqli_fetch_assoc($result)) {
            $value = htmlspecialchars($row['option_value']);
            // Check if this option is present in the array of selected values
            $selected = in_array($value, $selectedValues) ? 'selected' : '';
            echo "<option value=\"$value\" $selected>$value</option>";
        }
        // Free the result set
        if (is_object($result)) {
            mysqli_free_result($result);
        }
    }
}





?>
<script type="text/javascript">
    function previewImage1(event) {
        var input1 = document.getElementById('addphoto1input');
        var image1 = document.getElementById('preview1');
        if (addphoto1input.files && addphoto1input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                image1.src = e.target.result;
            }
            reader.readAsDataURL(addphoto1input.files[0]);
        }
        $("#addicon1").hide();
        $("#addbtn1").hide();
    }

    function previewImage2(event) {
        var input2 = document.getElementById('addphoto2input');
        var image2 = document.getElementById('preview2');
        if (addphoto2input.files && addphoto2input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                image2.src = e.target.result;
            }
            reader.readAsDataURL(addphoto2input.files[0]);
        }
        $("#addicon2").hide();
        $("#addbtn2").hide();
    }

    function previewImage3(event) {
        var input3 = document.getElementById('addphoto3input');
        var image3 = document.getElementById('preview3');
        if (addphoto3input.files && addphoto3input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                image3.src = e.target.result;
            }
            reader.readAsDataURL(addphoto3input.files[0]);
        }
        $("#addicon3").hide();
        $("#addbtn3").hide();
    }

    function previewImage4(event) {
        var input4 = document.getElementById('addphoto4input');
        var image4 = document.getElementById('preview4');
        if (addphoto4input.files && addphoto4input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                image4.src = e.target.result;
            }
            reader.readAsDataURL(addphoto4input.files[0]);
        }
        $("#addicon4").hide();
        $("#addbtn4").hide();
    }
</script>
<!-- START -->


<style>
    input[readonly],
    textarea[readonly],
    select[readonly] {
        background-color: #e9ecef !important;
        cursor: default !important;
        color: #6c757d !important;
        /* border-color: #331924 !important; */
        border-bottom: 3px solid maroon;
        opacity: 1 !important;
    }

    .chosen-disabled .chosen-single {
        cursor: default;
        background-color: #e9ecef !important;
        cursor: default !important;
        color: #6c757d !important;
        border-color: #ced4da !important;

    }

    select[disabled] {

        border-color: #ced4da !important;
    }

    input[type="date"][readonly] {
        pointer-events: none;
    }

    .chosen-container-single .chosen-single span {
        color: #6c757d !important;
    }
</style>

<section>
    <div class="inn-ban">
        <div class="container">
            <div class="row">
                <h1>Edit Profile</h1>
            </div>
        </div>
    </div>
</section>
<!-- END -->

<!-- REGISTER -->
<section>
    <div class="login pro-edit-update pt-0">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-lg-3">
                    <div class="col-md-12 db-sec-com">
                        <div class="db-nav">
                            <div class="db-nav-pro text-center mb-2"><img src="images/open-enrollment.gif" class="img-fluid" alt="" style="width:50%"></div>
                            <div class="text-center mb-3">
                                <!-- <b>
                                    <?php
                                    // $uid = str_split($_COOKIE['dr_userid']);
                                    // foreach ($uid as $single_uid) {
                                    //     echo '<span class="rounduid">';
                                    //     echo $single_uid;
                                    //     echo "</span>";
                                    // }
                                    ?>
                                    </span>
                                    
                                </b> -->
<style>
 .numberplate {
    background: #f5f5f5;
    /* border: 2px solid #ccc; */
    padding: 8px 12px;
    /* display: inline-flex; */
    /* gap: 2px; */
    border-radius: 4px;
    align-items: center;
}

/* Main character styling */
.np-char {
    font-size: 26px;
    font-weight: 400;
    font-family: 'Arial', sans-serif;
    color: #222;
    letter-spacing: 1px;
    display: inline-block;
}

/* RESPONSIVE for all mobile screens */
@media (max-width: 480px) {
    .np-char {
        font-size: 22px;
        letter-spacing: 0.5px;
    }
    .numberplate {
        padding: 6px 10px;
        gap: 3px;
    }
}

@media (max-width: 360px) {
    .np-char {
        font-size: 20px;
    }
}

</style>

            <div class="numberplate">
<?php 
$uid = str_split($_COOKIE['dr_userid']); 
foreach($uid as $single_uid) {
    echo '<span class="np-char">'.$single_uid.'</span>';
}
?>
</div>


                            </div>
                            <div class="db-nav-list">
                                <?php
                                $sqlformfill = "select * from registration where userid = '$userid'";
                                $resultformfill = mysqli_query($con, $sqlformfill);
                                $rowformfill = mysqli_fetch_assoc($resultformfill);
                                ?>
                                <ul class="nav nav-tabs profiletabs" role="tablist">
                                    <li><a class="nav-link active border-0" id="basic" data-bs-toggle="tab" href="#basictab"><span class="material-symbols-outlined">contacts</span>&nbsp;&nbsp;Basic Information <?php if ($rowformfill['basicinfo'] == 'Done') { ?><i class="fa fa-check-circle text-success formfill"></i> <?php } else { ?><i class="fa fa-times-circle text-danger formfill"></i><?php } ?></a></li>
                                    <li><a class="nav-link border-0" id="aboutme" data-bs-toggle="tab" href="#aboutmetab"><span class="material-symbols-outlined">person</span>&nbsp;&nbsp;About <?php if ($rowformfill['gender'] == 'Male') {
                                                                                                                                                                                                        echo "Groom";
                                                                                                                                                                                                    }
                                                                                                                                                                                                    if ($rowformfill['gender'] == 'Female') {
                                                                                                                                                                                                        echo "Bride";
                                                                                                                                                                                                    } ?> <?php if ($rowformfill['aboutme'] == 'Done') { ?><i class="fa fa-check-circle text-success formfill"></i> <?php } else { ?><i class="fa fa-times-circle text-danger formfill"></i><?php } ?></a></li>
                                    <li><a class="nav-link border-0" id="astro" data-bs-toggle="tab" href="#astrotab"><span class="material-symbols-outlined">brightness_auto</span>&nbsp;&nbsp;Astro Details <?php if ($rowformfill['astroinfo'] == 'Done') { ?><i class="fa fa-check-circle text-success formfill"></i> <?php } else { ?><i class="fa fa-times-circle text-danger formfill"></i><?php } ?></a></li>
                                    <li><a class="nav-link border-0" id="religious" data-bs-toggle="tab" href="#religioustab"><span class="material-symbols-outlined">temple_hindu</span>&nbsp;&nbsp;Religious Background <?php if ($rowformfill['religiousinfo'] == 'Done') { ?><i class="fa fa-check-circle text-success formfill"></i> <?php } else { ?><i class="fa fa-times-circle text-danger formfill"></i><?php } ?></a></li>
                                    <li><a class="nav-link border-0" id="educationcareer" data-bs-toggle="tab" href="#educationcareertab"><span class="material-symbols-outlined">school</span>&nbsp;&nbsp;Education & Career <?php if ($rowformfill['educationinfo'] == 'Done') { ?><i class="fa fa-check-circle text-success formfill"></i> <?php } else { ?><i class="fa fa-times-circle text-danger formfill"></i><?php } ?></a></li>
                                    <li><a class="nav-link border-0" id="groom" data-bs-toggle="tab" href="#groomtab"><?php if ($rowformfill['gender'] == 'Male') {
                                                                                                                            echo "<span class='material-symbols-outlined'>man</span>&nbsp;&nbsp;Groom";
                                                                                                                        }
                                                                                                                        if ($rowformfill['gender'] == 'Female') {
                                                                                                                            echo "<span class='material-symbols-outlined'>woman</span>&nbsp;&nbsp;Bride";
                                                                                                                        } ?> Location <?php if ($rowformfill['groomlocation'] == 'Done') { ?><i class="fa fa-check-circle text-success formfill"></i> <?php }
                                                                                                                                                                                                                                                    if ($rowformfill['bridelocation'] == 'Done') { ?><i class="fa fa-check-circle text-success formfill"></i> <?php }
                                                                                                                                                                                                                                                                                                                                                            if ($rowformfill['bridelocation'] == '' && $rowformfill['groomlocation'] == '') { ?><i class="fa fa-times-circle text-danger formfill"></i> <?php } ?></a></li>
                                    <li><a class="nav-link border-0" id="family" data-bs-toggle="tab" href="#familytab"><span class="material-symbols-outlined">family_restroom</span>&nbsp;&nbsp;Family Details <?php if ($rowformfill['familyinfo'] == 'Done') { ?><i class="fa fa-check-circle text-success formfill"></i> <?php } else { ?><i class="fa fa-times-circle text-danger formfill"></i><?php } ?></a></li>
                                    <li><a class="nav-link border-0" id="hobbies" data-bs-toggle="tab" href="#hobbiestab"><span class="material-symbols-outlined">interests</span>&nbsp;&nbsp;Hobbies & Interest <?php if ($rowformfill['hobbiesinfo'] == 'Done') { ?><i class="fa fa-check-circle text-success formfill"></i> <?php } else { ?><i class="fa fa-times-circle text-danger formfill"></i><?php } ?></a></li>
                                    <li><a class="nav-link border-0" id="partner" data-bs-toggle="tab" href="#partnertab"><span class="material-symbols-outlined">diversity_2</span>&nbsp;&nbsp;Partner Preferences <?php if ($rowformfill['partnerinfo'] == 'Done') { ?><i class="fa fa-check-circle text-success formfill"></i> <?php } else { ?><i class="fa fa-times-circle text-danger formfill"></i><?php } ?></a></li>
                                    <li><a class="nav-link border-0" id="contact" data-bs-toggle="tab" href="#contacttab"><span class="material-symbols-outlined">call</span>&nbsp;&nbsp;Contact Details <?php if ($rowformfill['contactinfo'] == 'Done') { ?><i class="fa fa-check-circle text-success formfill"></i> <?php } else { ?><i class="fa fa-times-circle text-danger formfill"></i><?php } ?></a></li>
                                    <li><a class="nav-link border-0" id="photos" data-bs-toggle="tab" href="#photostab"><span class="material-symbols-outlined">photo_camera</span>&nbsp;&nbsp;Manage Photos <?php if ($rowformfill['photosinfo'] == 'Done') { ?><i class="fa fa-check-circle text-success formfill"></i> <?php } else { ?><i class="fa fa-times-circle text-danger formfill"></i><?php } ?></a></li>
                                    <!--<li><a class="nav-link border-0" id="verification" data-bs-toggle="tab" href="#verificationtab"><i class="fa fa-check-circle"></i>&nbsp;&nbsp;Verification <?php if ($rowformfill['verificationinfo'] == 'Done') { ?><i class="fa fa-check-circle text-success formfill"></i> <?php } ?></a></li>-->
                                    <li style="display:none"><a class="nav-link border-0" id="thankyou" data-bs-toggle="tab" href="#thankyoutab"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-lg-9">
                    <div class="row">
                        <div class="col-md-12 db-sec-com profileform">
                            <div class="db-pro-stat p-0" style="overflow:visible">
                                <div class="db-inte-main">
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div id="basictab" class=" tab-pane active p-0">
                                            <div class="form-login p-0">
                                                <form action="profile-basicinfo.php" method="post">
                                                    <!--PROFILE BIO-->
                                                    <div class="edit-pro-parti">
                                                        <div class="form-tit p-3 tophead">
                                                            <h1 class="text-white">Basic Information</h1>
                                                            <p class="m-0 text-white">'<span class="text-info">*</span>' Required fields</p>
                                                            <a href="user-profile.php" class="sett-edit-btn sett-acc-edit-eve"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
                                                        </div>
                                                        <?php
                                                        if ($_GET['basic_update'] == 'yes') {
                                                        ?>
                                                            <p class="text-center text-success" id="invalidpop"><b>Your profile has been successfully updated</b></p>
                                                        <?php
                                                        }
                                                        ?>
                                                        <div class="row p-4">
                                                            <?php
                                                            $sqlbasicinfo = "select * from basic_info where userid = '$userid'";
                                                            $resultbasicinfo = mysqli_query($con, $sqlbasicinfo);
                                                            $rowbasicinfo = mysqli_fetch_assoc($resultbasicinfo);
                                                            ?>
                                                            <div class="col-md-6 form-group">
                                                                <label class="lb"><i class="fa fa-times-circle text-danger" id="createbycross" style="display:none"></i> Profile created by <span class="text-danger">*</span></label>
                                                                <span class="iconbox">
                                                                    <select id="disabled" class="form-select chosen-select" name="createby" disabled>
                                                                        <option value="">Select</option>
                                                                        <option <?php if ($rowbasicinfo['createby'] == 'Self') {
                                                                                    echo "selected";
                                                                                } ?>>Self</option>
                                                                        <option <?php if ($rowbasicinfo['createby'] == 'Son') {
                                                                                    echo "selected";
                                                                                } ?>>Son</option>
                                                                        <option <?php if ($rowbasicinfo['createby'] == 'Daughter') {
                                                                                    echo "selected";
                                                                                } ?>>Daughter</option>
                                                                        <option <?php if ($rowbasicinfo['createby'] == 'Brother') {
                                                                                    echo "selected";
                                                                                } ?>>Brother</option>
                                                                        <option <?php if ($rowbasicinfo['createby'] == 'Sister') {
                                                                                    echo "selected";
                                                                                } ?>>Sister</option>
                                                                        <option <?php if ($rowbasicinfo['createby'] == 'Friends') {
                                                                                    echo "selected";
                                                                                } ?>>Friends</option>
                                                                        <option <?php if ($rowbasicinfo['createby'] == 'Relative') {
                                                                                    echo "selected";
                                                                                } ?>>Relative</option>
                                                                        <option <?php if ($rowbasicinfo['createby'] == 'Others') {
                                                                                    echo "selected";
                                                                                } ?>>Others</option>
                                                                    </select>
                                                                    <span class="material-icons icon">person</span>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label class="lb">Full Name <span class="text-danger">*</span></label>
                                                                <span class="iconbox">
                                                                    <input type="text" pseudo="placeholder" class="form-control leftspace" placeholder="Enter Details" value="<?php echo $rowbasicinfo['fullname']; ?>" name="fullname" readonly>
                                                                    <span class="material-icons icon">badge</span>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label class="lb">Gender <span class="text-danger">*</span></label>
                                                                <span class="iconbox">
                                                                    <select id="disabled" class="form-select chosen-select" name="gender" requeird disabled readonly>
                                                                        <option value="">Select</option>
                                                                        <option <?php if ($rowbasicinfo['gender'] == 'Male') {
                                                                                    echo "selected";
                                                                                } ?>>Male</option>
                                                                        <option <?php if ($rowbasicinfo['gender'] == 'Female') {
                                                                                    echo "selected";
                                                                                } ?>>Female</option>
                                                                        <option <?php if ($rowbasicinfo['gender'] == 'Other') {
                                                                                    echo "selected";
                                                                                } ?>>Other</option>
                                                                    </select>
                                                                    <span class="material-icons icon">transgender</span>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label class="lb"><i class="fa fa-times-circle text-danger" id="maritalcross" style="display:none"></i> Marital Status <span class="text-danger">*</span></label>
                                                                <span class="iconbox">
                                                                    <!-- <select class="form-select chosen-select" id="marital" name="marital" required>
                                                                        <option value="">Select</option>
                                                                        <option <?php if ($rowbasicinfo['marital'] == 'Never Married') {
                                                                                    echo "selected";
                                                                                } ?>>Never Married</option>
                                                                        <option <?php if ($rowbasicinfo['marital'] == 'Divorced') {
                                                                                    echo "selected";
                                                                                } ?>>Divorced</option>
                                                                        <option <?php if ($rowbasicinfo['marital'] == 'Widowed') {
                                                                                    echo "selected";
                                                                                } ?>>Widowed</option>
                                                                        <option <?php if ($rowbasicinfo['marital'] == 'Awaiting Divorce') {
                                                                                    echo "selected";
                                                                                } ?>>Awaiting Divorce</option>
                                                                    </select> -->
                                                                    <select class="form-select chosen-select" id="marital" name="marital" required>
                                                                        <?php render_dropdown_options($con, 'marital_status', $rowbasicinfo['marital']); ?>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">diversity_4</span>
                                                                </span>
                                                            </div>

                                                            <div class="col-md-6 form-group" id="children" <?php if ($rowbasicinfo['children'] == '') { ?> style="display:none" <?php } else { ?> style="display:block" <?php } ?>>
                                                                <label class="lb"><i class="fa fa-times-circle text-danger" id="childrencross" style="display:none"></i> Have Children <span class="text-danger">*</span></label>
                                                                <span class="iconbox">
                                                                    <select class="form-select chosen-select" id="childrenselect" name="children">
                                                                        <option value="">Select</option>
                                                                        <option <?php if ($rowbasicinfo['children'] == 'Yes') {
                                                                                    echo "selected";
                                                                                } ?>>Yes</option>
                                                                        <option <?php if ($rowbasicinfo['children'] == 'No') {
                                                                                    echo "selected";
                                                                                } ?>>No</option>
                                                                    </select>
                                                                    <span class="material-icons icon">child_care</span>
                                                                </span>
                                                            </div>

                                                            <div class="col-md-6 form-group">
                                                                <label class="lb">Age <span class="text-danger">*</span></label>
                                                                <?php
                                                                $sqlastroinfo1 = "select * from astro_info where userid = '$userid'";
                                                                $resultastroinfo1 = mysqli_query($con, $sqlastroinfo1);
                                                                $rowastroinfo1 = mysqli_fetch_assoc($resultastroinfo1);

                                                                $dob = explode("-", $rowastroinfo1['dob']);
                                                                $birth_year = $dob[0];
                                                                $current_year = date('Y');
                                                                ?>
                                                                <span class="iconbox">
                                                                    <input type="text" pseudo="placeholder" class="form-control leftspace" placeholder="Enter Age" value="<?php echo ($current_year - $birth_year); ?>" name="age" required readonly>
                                                                    <span class="material-icons icon">123</span>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label class="lb"><i class="fa fa-times-circle text-danger" id="heightcross" style="display:none"></i> Height <span class="text-danger">*</span></label>
                                                                <span class="iconbox">
                                                                    <!-- <select class="form-select chosen-select" id="height" name="height" required>
                                                                        <option value="">Select</option>
                                                                        <option <?php if ($rowbasicinfo['height'] == '4 Feet 5 Inches') {
                                                                                    echo "selected";
                                                                                } ?>>4 Feet 5 Inches</option>
                                                                        <option <?php if ($rowbasicinfo['height'] == '4 Feet 6 Inches') {
                                                                                    echo "selected";
                                                                                } ?>>4 Feet 6 Inches</option>
                                                                        <option <?php if ($rowbasicinfo['height'] == '4 Feet 7 Inches') {
                                                                                    echo "selected";
                                                                                } ?>>4 Feet 7 Inches</option>
                                                                        <option <?php if ($rowbasicinfo['height'] == '4 Feet 8 Inches') {
                                                                                    echo "selected";
                                                                                } ?>>4 Feet 8 Inches</option>
                                                                        <option <?php if ($rowbasicinfo['height'] == '4 Feet 9 Inches') {
                                                                                    echo "selected";
                                                                                } ?>>4 Feet 9 Inches</option>
                                                                        <option <?php if ($rowbasicinfo['height'] == '4 Feet 10 Inches') {
                                                                                    echo "selected";
                                                                                } ?>>4 Feet 10 Inches</option>
                                                                        <option <?php if ($rowbasicinfo['height'] == '4 Feet 11 Inches') {
                                                                                    echo "selected";
                                                                                } ?>>4 Feet 11 Inches</option>
                                                                        <option <?php if ($rowbasicinfo['height'] == '5 Feet 0 Inches') {
                                                                                    echo "selected";
                                                                                } ?>>5 Feet 0 Inches</option>
                                                                        <option <?php if ($rowbasicinfo['height'] == '5 Feet 1 Inches') {
                                                                                    echo "selected";
                                                                                } ?>>5 Feet 1 Inches</option>
                                                                        <option <?php if ($rowbasicinfo['height'] == '5 Feet 2 Inches') {
                                                                                    echo "selected";
                                                                                } ?>>5 Feet 2 Inches</option>
                                                                        <option <?php if ($rowbasicinfo['height'] == '5 Feet 3 Inches') {
                                                                                    echo "selected";
                                                                                } ?>>5 Feet 3 Inches</option>
                                                                        <option <?php if ($rowbasicinfo['height'] == '5 Feet 4 Inches') {
                                                                                    echo "selected";
                                                                                } ?>>5 Feet 4 Inches</option>
                                                                        <option <?php if ($rowbasicinfo['height'] == '5 Feet 5 Inches') {
                                                                                    echo "selected";
                                                                                } ?>>5 Feet 5 Inches</option>
                                                                        <option <?php if ($rowbasicinfo['height'] == '5 Feet 6 Inches') {
                                                                                    echo "selected";
                                                                                } ?>>5 Feet 6 Inches</option>
                                                                        <option <?php if ($rowbasicinfo['height'] == '5 Feet 7 Inches') {
                                                                                    echo "selected";
                                                                                } ?>>5 Feet 7 Inches</option>
                                                                        <option <?php if ($rowbasicinfo['height'] == '5 Feet 8 Inches') {
                                                                                    echo "selected";
                                                                                } ?>>5 Feet 8 Inches</option>
                                                                        <option <?php if ($rowbasicinfo['height'] == '5 Feet 9 Inches') {
                                                                                    echo "selected";
                                                                                } ?>>5 Feet 9 Inches</option>
                                                                        <option <?php if ($rowbasicinfo['height'] == '5 Feet 10 Inches') {
                                                                                    echo "selected";
                                                                                } ?>>5 Feet 10 Inches</option>
                                                                        <option <?php if ($rowbasicinfo['height'] == '5 Feet 11 Inches') {
                                                                                    echo "selected";
                                                                                } ?>>5 Feet 11 Inches</option>
                                                                        <option <?php if ($rowbasicinfo['height'] == '6 Feet 0 Inches') {
                                                                                    echo "selected";
                                                                                } ?>>6 Feet 0 Inches</option>
                                                                        <option <?php if ($rowbasicinfo['height'] == '6 Feet 1 Inches') {
                                                                                    echo "selected";
                                                                                } ?>>6 Feet 1 Inches</option>
                                                                        <option <?php if ($rowbasicinfo['height'] == '6 Feet 2 Inches') {
                                                                                    echo "selected";
                                                                                } ?>>6 Feet 2 Inches</option>
                                                                        <option <?php if ($rowbasicinfo['height'] == '6 Feet 3 Inches') {
                                                                                    echo "selected";
                                                                                } ?>>6 Feet 3 Inches</option>
                                                                        <option <?php if ($rowbasicinfo['height'] == '6 Feet 4 Inches') {
                                                                                    echo "selected";
                                                                                } ?>>6 Feet 4 Inches</option>
                                                                        <option <?php if ($rowbasicinfo['height'] == '6 Feet 5 Inches') {
                                                                                    echo "selected";
                                                                                } ?>>6 Feet 5 Inches</option>
                                                                        <option <?php if ($rowbasicinfo['height'] == '6 Feet 6 Inches') {
                                                                                    echo "selected";
                                                                                } ?>>6 Feet 6 Inches</option>
                                                                        <option <?php if ($rowbasicinfo['height'] == '6 Feet 7 Inches') {
                                                                                    echo "selected";
                                                                                } ?>>6 Feet 7 Inches</option>
                                                                        <option <?php if ($rowbasicinfo['height'] == '6 Feet 8 Inches') {
                                                                                    echo "selected";
                                                                                } ?>>6 Feet 8 Inches</option>
                                                                        <option <?php if ($rowbasicinfo['height'] == '6 Feet 9 Inches') {
                                                                                    echo "selected";
                                                                                } ?>>6 Feet 9 Inches</option>
                                                                        <option <?php if ($rowbasicinfo['height'] == '6 Feet 10 Inches') {
                                                                                    echo "selected";
                                                                                } ?>>6 Feet 10 Inches</option>
                                                                        <option <?php if ($rowbasicinfo['height'] == '6 Feet 11 Inches') {
                                                                                    echo "selected";
                                                                                } ?>>6 Feet 11 Inches</option>
                                                                        <option <?php if ($rowbasicinfo['height'] == '7 Feet 0 Inches') {
                                                                                    echo "selected";
                                                                                } ?>>7 Feet 0 Inches</option>
                                                                        <option <?php if ($rowbasicinfo['height'] == '7 Feet 1 Inches') {
                                                                                    echo "selected";
                                                                                } ?>>7 Feet 1 Inches</option>
                                                                        <option <?php if ($rowbasicinfo['height'] == '7 Feet 2 Inches') {
                                                                                    echo "selected";
                                                                                } ?>>7 Feet 2 Inches</option>
                                                                        <option <?php if ($rowbasicinfo['height'] == '7 Feet 3 Inches') {
                                                                                    echo "selected";
                                                                                } ?>>7 Feet 3 Inches</option>
                                                                        <option <?php if ($rowbasicinfo['height'] == '7 Feet 4 Inches') {
                                                                                    echo "selected";
                                                                                } ?>>7 Feet 4 Inches</option>
                                                                        <option <?php if ($rowbasicinfo['height'] == '7 Feet 5 Inches') {
                                                                                    echo "selected";
                                                                                } ?>>7 Feet 5 Inches</option>
                                                                    </select> -->
                                                                    <select class="form-select chosen-select" id="height" name="height" required>
                                                                        <?php render_dropdown_options($con, 'height', $rowbasicinfo['height']); ?>
                                                                    </select>
                                                                    <span class="material-icons icon">height</span>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label class="lb"><i class="fa fa-times-circle text-danger" id="weightcross" style="display:none"></i> Weight <!--<span class="text-danger">*</span>--></label>
                                                                <span class="iconbox">
                                                                    <select class="form-select chosen-select" id="noweight" name="weight">
                                                                        <?php render_dropdown_options($con, 'weight', $rowbasicinfo['weight']); ?>
                                                                    </select>
                                                                    <span class="material-icons icon">scale</span>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label class="lb"><i class="fa fa-times-circle text-danger" id="physicalcross" style="display:none"></i> Any Disability <!--<span class="text-danger">*</span>--></label>
                                                                <span class="iconbox">
                                                                    <!-- <select class="form-select chosen-select" id="nophysical" name="physical">
                                                                        <option value="">Select</option>
                                                                        <option <?php if ($rowbasicinfo['physical'] == 'Normal') {
                                                                                    echo "selected";
                                                                                } ?>>Normal</option>
                                                                        <option <?php if ($rowbasicinfo['physical'] == 'Handicapped by birth') {
                                                                                    echo "selected";
                                                                                } ?>>Handicapped by birth</option>
                                                                        <option <?php if ($rowbasicinfo['physical'] == 'Handicapped by war') {
                                                                                    echo "selected";
                                                                                } ?>>Handicapped by war</option>
                                                                    </select> -->
                                                                    <select class="form-select chosen-select" id="nophysical" name="physical">
                                                                        <?php render_dropdown_options($con, 'disability', $rowbasicinfo['physical']); ?>
                                                                    </select>
                                                                    <span class="material-icons icon">accessible</span>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <?php
                                                                $lang = explode("//", $rowbasicinfo['langauge'])
                                                                ?>
                                                                <label class="lb"><i class="fa fa-times-circle text-danger" id="langaugecross" style="display:none"></i> Language Known <span class="text-danger">*</span></label>
                                                                <span class="iconbox">
                                                                    <!-- <select class="form-select chosen-select" id="langauge" name="langauge[]" multiple required>
                                                                        <option value="">Select</option>
                                                                        <option <?php if (in_array("Hindi", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Hindi</option>
                                                                        <option <?php if (in_array("Marathi", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Marathi</option>
                                                                        <option <?php if (in_array("Punjabi", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Punjabi</option>
                                                                        <option <?php if (in_array("Bengali", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Bengali</option>
                                                                        <option <?php if (in_array("Gujarati", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Gujarati</option>
                                                                        <option <?php if (in_array("Urdu", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Urdu</option>
                                                                        <option <?php if (in_array("Telugu", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Telugu</option>
                                                                        <option <?php if (in_array("Kannada", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Kannada</option>
                                                                        <option <?php if (in_array("English", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>English</option>
                                                                        <option <?php if (in_array("Tamil", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Tamil</option>
                                                                        <option <?php if (in_array("Odia", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Odia</option>
                                                                        <option <?php if (in_array("Marwari", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Marwari</option>
                                                                        <option <?php if (in_array("Arabic", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Arabic</option>
                                                                        <option <?php if (in_array("Arunachali", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Arunachali</option>
                                                                        <option <?php if (in_array("Assamese", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Assamese</option>
                                                                        <option <?php if (in_array("Awadhi", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Awadhi</option>
                                                                        <option <?php if (in_array("Baluchi", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Baluchi</option>
                                                                        <option <?php if (in_array("Bhojpuri", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Bhojpuri</option>
                                                                        <option <?php if (in_array("Bhutia", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Bhutia</option>
                                                                        <option <?php if (in_array("Brahui", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Brahui</option>
                                                                        <option <?php if (in_array("Brij", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Brij</option>
                                                                        <option <?php if (in_array("Burmese", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Burmese</option>
                                                                        <option <?php if (in_array("Chattisgarhi", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Chattisgarhi</option>
                                                                        <option <?php if (in_array("Coorgi", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Coorgi</option>
                                                                        <option <?php if (in_array("Dogri", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Dogri</option>
                                                                        <option <?php if (in_array("French", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>French</option>
                                                                        <option <?php if (in_array("Garhwali", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Garhwali</option>
                                                                        <option <?php if (in_array("Garo", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Garo</option>
                                                                        <option <?php if (in_array("Haryanavi", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Haryanavi</option>
                                                                        <option <?php if (in_array("Himachali/Pahari", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Himachali/Pahari</option>
                                                                        <option <?php if (in_array("Hindko", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Hindko</option>
                                                                        <option <?php if (in_array("Kakbarak", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Kakbarak</option>
                                                                        <option <?php if (in_array("Kanauji", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Kanauji</option>
                                                                        <option <?php if (in_array("Kashmiri", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Kashmiri</option>
                                                                        <option <?php if (in_array("Khandesi", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Khandesi</option>
                                                                        <option <?php if (in_array("Khasi", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Khasi</option>
                                                                        <option <?php if (in_array("Konkani", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Konkani</option>
                                                                        <option <?php if (in_array("Koshali", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Koshali</option>
                                                                        <option <?php if (in_array("Kumaoni", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Kumaoni</option>
                                                                        <option <?php if (in_array("Kutchi", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Kutchi</option>
                                                                        <option <?php if (in_array("Ladakhi", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Ladakhi</option>
                                                                        <option <?php if (in_array("Lepcha", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Lepcha</option>
                                                                        <option <?php if (in_array("Magahi", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Magahi</option>
                                                                        <option <?php if (in_array("Maithili", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Maithili</option>
                                                                        <option <?php if (in_array("Malay", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Malay</option>
                                                                        <option <?php if (in_array("Malayalam", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Malayalam</option>
                                                                        <option <?php if (in_array("Manipuri", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Manipuri</option>
                                                                        <option <?php if (in_array("Miji", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Miji</option>
                                                                        <option <?php if (in_array("Mizo", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Mizo</option>
                                                                        <option <?php if (in_array("Monpa", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Monpa</option>
                                                                        <option <?php if (in_array("Nepali", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Nepali</option>
                                                                        <option <?php if (in_array("Pashto", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Pashto</option>
                                                                        <option <?php if (in_array("Persian", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Persian</option>
                                                                        <option <?php if (in_array("Rajasthani", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Rajasthani</option>
                                                                        <option <?php if (in_array("Sanskrit", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Sanskrit</option>
                                                                        <option <?php if (in_array("Santhali", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Santhali</option>
                                                                        <option <?php if (in_array("Seraiki", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Seraiki</option>
                                                                        <option <?php if (in_array("Sindhi", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Sindhi</option>
                                                                        <option <?php if (in_array("Sinhala", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Sinhala</option>
                                                                        <option <?php if (in_array("Sourashtra", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Sourashtra</option>
                                                                        <option <?php if (in_array("Tagalog", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Tagalog</option>
                                                                        <option <?php if (in_array("Tulu", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Tulu</option>
                                                                        <option <?php if (in_array("Others", $lang)) {
                                                                                    echo "selected";
                                                                                } ?>>Others</option>
                                                                    </select> -->
                                                                    <select class="form-select chosen-select" id="langauge" name="langauge[]" multiple required>
                                                                        <?php render_multiselect_options($con, 'language_known', $lang); ?>
                                                                    </select>
                                                                    <span class="material-icons icon">language</span>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label class="lb"><i class="fa fa-times-circle text-danger" id="eatingcross" style="display:none"></i> Eating Habits <span class="text-danger">*</span></label>
                                                                <span class="iconbox">
                                                                    <select class="form-select chosen-select" id="eating" name="eating" required>
                                                                        <?php render_dropdown_options($con, 'eating_habits', $rowbasicinfo['eating']); ?>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">restaurant</span>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label class="lb"><i class="fa fa-times-circle text-danger" id="smokingcross" style="display:none"></i> Smoking Habits <span class="text-danger">*</span></label>
                                                                <span class="iconbox">
                                                                    <select class="form-select chosen-select" id="smoking" name="smoking" required>
                                                                        <?php render_dropdown_options($con, 'smoking_habits', $rowbasicinfo['smoking']); ?>
                                                                    </select>
                                                                    <i class="material-icons icon">smoking_rooms</i>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label class="lb"><i class="fa fa-times-circle text-danger" id="drinkingcross" style="display:none"></i> Drinking Habits <span class="text-danger">*</span></label>
                                                                <span class="iconbox">
                                                                    <!-- <select class="form-select chosen-select" id="drinking" name="drinking" required>
                                                                        <option value="">Select</option>
                                                                        <option <?php if ($rowbasicinfo['drinking'] == 'Non-drinker') {
                                                                                    echo "selected";
                                                                                } ?>>Non-drinker</option>
                                                                        <option <?php if ($rowbasicinfo['drinking'] == 'Light / Social drinker') {
                                                                                    echo "selected";
                                                                                } ?>>Light / Social drinker</option>
                                                                        <option <?php if ($rowbasicinfo['drinking'] == 'Regular drinker') {
                                                                                    echo "selected";
                                                                                } ?>>Regular drinker</option>
                                                                    </select> -->
                                                                    <select class="form-select chosen-select" id="drinking" name="drinking" required>
                                                                        <?php render_dropdown_options($con, 'drinking_habits', $rowbasicinfo['drinking']); ?>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">liquor</span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--END PROFILE BIO-->
                                                    <button type="submit" id="basicupdatebtn" class="btn btn-primary profile-btn">Update</button>
                                                </form>
                                            </div>
                                        </div>
    <div id="aboutmetab" class="tab-pane fade p-0">
    <div class="form-login">

        <!-- 🔔 Show Alert if About Me Update is Pending -->
        <?php if(isset($rowformfill['aboutme_approval_status']) && $rowformfill['aboutme_approval_status'] == 'Pending') { ?>
            <div class="alert alert-warning text-center m-3" 
                 style="border: 1px solid #ffc107; background: #fff3cd; color: #856404; padding: 15px; border-radius: 5px;">
                <i class="fa fa-hourglass-half"></i> 
                <b>Update Under Review:</b> You have updated your 'About Me' details. 
                This change is currently waiting for Admin Approval. The old description will remain visible on your profile until approved.
            </div>
        <?php } ?>

        <form action="profile-aboutme.php" method="post">
            <div class="edit-pro-parti">

                <div class="form-tit p-3 tophead">
                    <h1 class="text-white">About 
                        <?php 
                            if ($rowformfill['groomlocation'] == 'Done') echo "Groom";
                            if ($rowformfill['bridelocation'] == 'Done') echo "Bride";
                        ?>, Partner and Family
                    </h1>
                    <p class="m-0 text-white">'<span class="text-info">*</span>' Required fields</p>
                    <a href="user-profile.php" class="sett-edit-btn sett-acc-edit-eve">
                        <i class="fa fa-eye" aria-hidden="true"></i> View
                    </a>
                </div>

                <!-- Success / Pending Message -->
                <?php if (isset($_GET['aboutme_update'])) { ?>
                    <?php if($_GET['aboutme_update'] == 'yes') { ?>
                        <p class="text-center text-success" id="invalidpop"><b>Your profile has been successfully updated</b></p>
                    <?php } elseif($_GET['aboutme_update'] == 'pending') { ?>
                        <p class="text-center text-warning" id="invalidpop"><b>Update sent for approval</b></p>
                    <?php } ?>
                <?php } ?>

                <!-- 🔥 Verification Status Check -->
                <?php if ($rowformfill['verificationinfo'] == '0') { ?>
                    <p class="text-center text-danger m-0 blinking-text">
                        <b>Under review and will be live shortly</b>
                    </p>
                <?php } ?>

                <div class="row p-4">

                    <?php
                    // Fetch LIVE About Me (NOT temporary)
                    $sqlbasicinfo = "SELECT * FROM basic_info WHERE userid = '$userid'";
                    $resultbasicinfo = mysqli_query($con, $sqlbasicinfo);
                    $rowbasicinfo = mysqli_fetch_assoc($resultbasicinfo);
                    ?>

                    <div class="col-md-12 form-group">
                        <label class="lb">
                            <i class="fa fa-times-circle text-danger" id="fewwordscross" style="display:none"></i>
                            Share Few Words <span class="text-danger">*</span>
                        </label>

                        <span class="iconbox">
                            <textarea 
                                class="form-control leftspace"
                                placeholder="Enter Details"
                                id="aboutmecontent"
                                name="aboutme"
                                required
                                <?php if ($rowformfill['verificationinfo'] == '0') echo "disabled"; ?>
                            ><?php echo $rowbasicinfo['aboutme']; ?></textarea>

                            <span class="material-symbols-outlined icon">edit</span>
                        </span>

                        <p class="text-white mt-4 notebox">
                            <b>Note:</b> This section will be reviewed each time you update it. 
                            Please allow up to 24 hours for it to go live.
                        </p>
                    </div>

                </div>
            </div>

            <!-- 🔥 Update Button Only When Verificationinfo = 1 -->
            <?php if ($rowformfill['verificationinfo'] == '1') { ?>
                <button type="submit" id="aboutupdatebtn" class="btn btn-primary profile-btn">
                    Update
                </button>
            <?php } ?>
        </form>
    </div>
</div>

                                        <div id="astrotab" class=" tab-pane fade p-0">
                                            <div class="form-login">
                                                <form action="profile-astro.php" method="post">
                                                    <!--PROFILE BIO-->
                                                    <div class="edit-pro-parti">
                                                        <div class="form-tit p-3 tophead">
                                                            <h1 class="text-white">Astro Details</h1>
                                                            <p class="m-0 text-white">'<span class="text-info">*</span>' Required fields</p>
                                                            <a href="user-profile.php" class="sett-edit-btn sett-acc-edit-eve"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
                                                        </div>
                                                        <?php
                                                        if ($_GET['astro_update'] == 'yes') {
                                                        ?>
                                                            <p class="text-center text-success" id="invalidpop"><b>Your profile has been successfully updated</b></p>
                                                        <?php
                                                        }
                                                        ?>
                                                        <div class="row p-4">
                                                            <?php
                                                            $sqlastroinfo = "select * from astro_info where userid = '$userid'";
                                                            $resultastroinfo = mysqli_query($con, $sqlastroinfo);
                                                            $rowastroinfo = mysqli_fetch_assoc($resultastroinfo);
                                                            ?>
                                                            <div class="col-md-6 form-group">
                                                                <label class="lb"><i class="fa fa-times-circle text-danger" id="dobcross" style="display:none"></i> Date of Birth <span class="text-danger">*</span></label>
                                                                <span class="iconbox">
                                                                    <input type="date" onfocus="this.showPicker()" class="form-control leftspace text-uppercase" id="dob" placeholder="DD-MM-YYYY" value="<?php echo $rowastroinfo['dob']; ?>" name="dob" required readonly>
                                                                    <span class="material-icons icon">calendar_month</span>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label class="lb"><i class="fa fa-times-circle text-danger" id="pobcross" style="display:none"></i> Place of Birth <span class="text-danger">*</span></label>
                                                                <span class="iconbox">
                                                                    <input type="text" class="form-control leftspace" placeholder="Enter Details" name="birthplace" id="pob" value="<?php echo $rowastroinfo['birthplace']; ?>" required>
                                                                    <span class="material-icons icon">location_on</span>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label class="lb"><i class="fa fa-times-circle text-danger" id="tobcross" style="display:none"></i> Time of Birth <span class="text-danger">*</span></label>
                                                                <span class="iconbox">
                                                                    <input type="time" onfocus="this.showPicker()" class="form-control leftspace" placeholder="Enter Details" id="tob" name="birthtime" value="<?php echo $rowastroinfo['birthtime']; ?>" required>
                                                                    <span class="material-symbols-outlined icon">schedule</span>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label class="lb"><i class="fa fa-times-circle text-danger" id="doshcross" style="display:none"></i> Dosh/Dosham <span class="text-danger">*</span></label>
                                                                <span class="iconbox">
                                                                    <select class="form-select chosen-select" id="dosh" name="manglik" required>
                                                                        <option value="">Select</option>
                                                                        <option <?php if ($rowastroinfo['manglik'] == 'Yes') {
                                                                                    echo "selected";
                                                                                } ?>>Yes</option>
                                                                        <option <?php if ($rowastroinfo['manglik'] == 'No') {
                                                                                    echo "selected";
                                                                                } ?>>No</option>
                                                                        <option <?php if ($rowastroinfo['manglik'] == 'Dont Know') {
                                                                                    echo "selected";
                                                                                } ?>>Dont Know</option>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">error</span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--END PROFILE BIO-->
                                                    <button type="submit" id="astroupdatebtn" class="btn btn-primary profile-btn">Update</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div id="religioustab" class=" tab-pane fade p-0">
                                            <div class="form-login">
                                                <form action="profile-religious.php" method="post">
                                                    <!--PROFILE BIO-->
                                                    <div class="edit-pro-parti">
                                                        <div class="form-tit p-3 tophead">
                                                            <h1 class="text-white">Religious Background</h1>
                                                            <p class="m-0 text-white">'<span class="text-info">*</span>' Required fields</p>
                                                            <a href="user-profile.php" class="sett-edit-btn sett-acc-edit-eve"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
                                                        </div>
                                                        <?php
                                                        if ($_GET['religious_update'] == 'yes') {
                                                        ?>
                                                            <p class="text-center text-success" id="invalidpop"><b>Your profile has been successfully updated</b></p>
                                                        <?php
                                                        }
                                                        ?>
                                                        <div class="row p-4">
                                                            <?php
                                                            $sqlreligiousinfo = "select * from religious_info where userid = '$userid'";
                                                            $resultreligiousinfo = mysqli_query($con, $sqlreligiousinfo);
                                                            $rowreligiousinfo = mysqli_fetch_assoc($resultreligiousinfo);
                                                            ?>
                                                            <div class="col-md-6 form-group">
                                                                <label class="lb"><i class="fa fa-times-circle text-danger" id="religioncross" style="display:none"></i> Religion <span class="text-danger">*</span></label>
                                                                <span class="iconbox">
                                                                    <select class="form-select chosen-select" id="religion" name="religion" required>
                                                                        <option value="">Select</option>
                                                                        <?php
                                                                        $sqlreligion = "select distinct(religion) from religion_caste";
                                                                        $resultreligion = mysqli_query($con, $sqlreligion);
                                                                        while ($rowreligion = mysqli_fetch_assoc($resultreligion)) {
                                                                        ?>
                                                                            <option <?php if ($rowreligiousinfo['religion'] == $rowreligion['religion']) {
                                                                                        echo "selected";
                                                                                    } ?> value="<?php echo $rowreligion['religion']; ?>"><?php echo $rowreligion['religion']; ?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">temple_hindu</span>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-6 form-group" id="emptycaste" <?php if ($rowreligiousinfo['religion'] != '') { ?>style="display:none" <?php } ?>>
                                                                <label class="lb"><i class="fa fa-times-circle text-danger" id="emptycastecross" style="display:none"></i> Caste <span class="text-danger">*</span></label>
                                                                <span class="iconbox">
                                                                    <select class="form-select chosen-select" id="emptycaste">
                                                                        <option value="">Select</option>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">reduce_capacity</span>
                                                                </span>
                                                            </div>
                                                            <?php
                                                            $sqlreligion1 = "select distinct(religion) from religion_caste";
                                                            $resultreligion1 = mysqli_query($con, $sqlreligion1);
                                                            while ($rowreligion1 = mysqli_fetch_assoc($resultreligion1)) {
                                                                $religion = $rowreligion1['religion'];
                                                            ?>
                                                                <div class="col-md-6 form-group signupcaste" id="<?php echo str_replace(" ", "-", $religion) ?>" <?php if ($rowreligiousinfo['religion'] == str_replace(" ", "-", $religion)) { ?>style="display:block" <?php } else { ?>style="display:none" <?php } ?>>
                                                                    <label class="lb"><i class="fa fa-times-circle text-danger" id="<?php echo str_replace(" ", "-", $religion) . '_castecross' ?>" style="display:none"></i> Caste <span class="text-danger">*</span></label>
                                                                    <span class="iconbox">
                                                                        <select class="form-select chosen-select castedd" id="<?php echo str_replace(" ", "-", $religion) . '_dd' ?>">
                                                                            <option value="">Select</option>
                                                                            <?php
                                                                            $sqlcaste = "select * from religion_caste where religion = '$religion'";
                                                                            $resultcaste = mysqli_query($con, $sqlcaste);
                                                                            while ($rowcaste = mysqli_fetch_assoc($resultcaste)) {
                                                                            ?>
                                                                                <option <?php if ($rowreligiousinfo['caste'] == $rowcaste['caste']) {
                                                                                            echo "selected";
                                                                                        } ?> value="<?php echo $rowcaste['caste']; ?>"><?php echo $rowcaste['caste']; ?></option>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                        <span class="material-symbols-outlined icon">reduce_capacity</span>
                                                                    </span>
                                                                </div>
                                                            <?php
                                                            }
                                                            ?>
                                                            <div class="col-md-6 form-group">
                                                                <label class="lb">Sub-caste</label>
                                                                <span class="iconbox">
                                                                    <input type="text" class="form-control leftspace" placeholder="Enter Details" name="subcaste" value="<?php echo $rowreligiousinfo['subcaste']; ?>">
                                                                    <span class="material-symbols-outlined icon">reduce_capacity</span>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label class="lb">Gothram</label>
                                                                <span class="iconbox">
                                                                    <input type="text" class="form-control leftspace" placeholder="Enter Details" name="gothram" value="<?php echo $rowreligiousinfo['gothram']; ?>">
                                                                    <span class="material-symbols-outlined icon">group_remove</span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--END PROFILE BIO-->
                                                    <button type="submit" id="religiousupdatebtn" class="btn btn-primary profile-btn">Update</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div id="educationcareertab" class=" tab-pane fade p-0">
                                            <div class="form-login">
                                                <form action="profile-education.php" method="post">
                                                    <!--PROFILE BIO-->
                                                    <div class="edit-pro-parti">
                                                        <div class="form-tit p-3 tophead">
                                                            <h1 class="text-white">Education & Career</h1>
                                                            <p class="m-0 text-white">'<span class="text-info">*</span>' Required fields</p>
                                                            <a href="user-profile.php" class="sett-edit-btn sett-acc-edit-eve"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
                                                        </div>
                                                        <?php
                                                        if ($_GET['education_update'] == 'yes') {
                                                        ?>
                                                            <p class="text-center text-success" id="invalidpop"><b>Your profile has been successfully updated</b></p>
                                                        <?php
                                                        }
                                                        ?>
                                                        <div class="row p-4">
                                                            <?php
                                                            $sqleudcationinfo = "select * from education_info where userid = '$userid'";
                                                            $resulteudcationinfo = mysqli_query($con, $sqleudcationinfo);
                                                            $roweudcationinfo = mysqli_fetch_assoc($resulteudcationinfo);
                                                            ?>
                                                            <div class="col-md-6 form-group">
                                                                <label class="lb"><i class="fa fa-times-circle text-danger" id="streamcross" style="display:none"></i> Stream <span class="text-danger">*</span></label>
                                                                <span class="iconbox">
                                                                    <select class="form-select chosen-select" id="stream" name="stream" required>
                                                                        <option value="">Select</option>
                                                                        <?php
                                                                        $sqlstream = "select distinct(stream) from stream_education";
                                                                        $resultstream = mysqli_query($con, $sqlstream);
                                                                        while ($rowstream = mysqli_fetch_assoc($resultstream)) {
                                                                        ?>
                                                                            <option <?php if ($roweudcationinfo['stream'] == str_replace("/", "_", str_replace(" ", "-", $rowstream['stream']))) {
                                                                                        echo "selected";
                                                                                    } ?> value="<?php echo str_replace("/", "_", str_replace(" ", "-", $rowstream['stream'])); ?>"><?php echo $rowstream['stream']; ?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">menu_book</span>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-6 form-group" id="emptyeducation" <?php if ($roweudcationinfo['education'] != '') { ?>style="display:none" <?php } ?>>
                                                                <label class="lb"><i class="fa fa-times-circle text-danger" id="emptyeducross" style="display:none"></i> Highest Education <span class="text-danger">*</span></label>
                                                                <span class="iconbox">
                                                                    <select class="form-select chosen-select" id="empty_education">
                                                                        <option value="">Select</option>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">school</span>
                                                                </span>
                                                            </div>
                                                            <?php
                                                            $sqlstream1 = "select distinct(stream) from stream_education";
                                                            $resultstream1 = mysqli_query($con, $sqlstream1);
                                                            while ($rowstream1 = mysqli_fetch_assoc($resultstream1)) {
                                                                $stream = $rowstream1['stream'];
                                                            ?>
                                                                <div class="col-md-6 form-group signupstream" id="<?php echo str_replace("/", "_", str_replace(" ", "-", $stream)); ?>" <?php if ($roweudcationinfo['stream'] == str_replace("/", "_", str_replace(" ", "-", $stream))) { ?>style="display:block" <?php } else { ?>style="display:none" <?php } ?>>
                                                                    <label class="lb"><i class="fa fa-times-circle text-danger" id="<?php echo str_replace("/", "_", str_replace(" ", "-", $stream)) . '_educationcross'; ?>" style="display:none"></i> Highest Education <span class="text-danger">*</span></label>
                                                                    <span class="iconbox">
                                                                        <select class="form-select chosen-select educationdd" id="<?php echo str_replace("/", "_", str_replace(" ", "-", $stream)) . '_dd' ?>">
                                                                            <option value="">Select</option>
                                                                            <?php
                                                                            $sqleducation = "select * from stream_education where stream = '$stream'";
                                                                            $resulteducation = mysqli_query($con, $sqleducation);
                                                                            while ($roweducation = mysqli_fetch_assoc($resulteducation)) {
                                                                            ?>
                                                                                <option <?php if ($roweudcationinfo['education'] == $roweducation['education']) {
                                                                                            echo "selected";
                                                                                        } ?> value="<?php echo $roweducation['education']; ?>"><?php echo $roweducation['education']; ?></option>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                        <span class="material-symbols-outlined icon">school</span>
                                                                    </span>
                                                                </div>
                                                            <?php
                                                            }
                                                            ?>
                                                            <div class="col-md-6 form-group">
                                                                <label class="lb">College / Institution</label>
                                                                <span class="iconbox">
                                                                    <input type="text" class="form-control leftspace" placeholder="Enter Details" name="college" value="<?php echo $roweudcationinfo['college']; ?>">
                                                                    <span class="material-symbols-outlined icon">domain</span>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label class="lb"><i class="fa fa-times-circle text-danger" id="workingcross" style="display:none"></i> Working With<span class="text-danger">*</span></label>
                                                                <span class="iconbox">
                                                                    <select class="form-select chosen-select" id="workingwith" name="workingwith" required>
                                                                        <?php render_dropdown_options($con, 'working_with', $roweudcationinfo['workingwith']); ?>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">work</span>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label class="lb"><i class="fa fa-times-circle text-danger" id="domaincross" style="display:none"></i> Profession <span class="text-danger">*</span></label>
                                                                <span class="iconbox">
                                                                    <select class="form-select chosen-select" id="domain" name="profession" required>
                                                                        <option value="">Select</option>
                                                                        <?php
                                                                        $sqldomain = "select distinct(domain) from domain_designation";
                                                                        $resultdomain = mysqli_query($con, $sqldomain);
                                                                        while ($rowdomain = mysqli_fetch_assoc($resultdomain)) {
                                                                        ?>
                                                                            <option <?php if ($roweudcationinfo['profession'] == str_replace("&", "and", str_replace(",", "", str_replace(" ", "-", $rowdomain['domain'])))) {
                                                                                        echo "selected";
                                                                                    } ?> value="<?php echo str_replace("&", "and", str_replace(",", "", str_replace(" ", "-", $rowdomain['domain']))); ?>"><?php echo $rowdomain['domain']; ?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">account_circle</span>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-6 form-group" id="emptydesignation" <?php if ($roweudcationinfo['profession'] != '') { ?>style="display:none" <?php } ?>>
                                                                <label class="lb"><i class="fa fa-times-circle text-danger" id="emptydesigcross" style="display:none"></i> Designation <span class="text-danger">*</span></label>
                                                                <span class="iconbox">
                                                                    <select class="form-select chosen-select" id="empty_designation">
                                                                        <option value="">Select</option>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">airline_seat_recline_normal</span>
                                                                </span>
                                                            </div>
                                                            <?php
                                                            $sqldomain1 = "select distinct(domain) from domain_designation";
                                                            $resultdomain1 = mysqli_query($con, $sqldomain1);
                                                            while ($rowdomain1 = mysqli_fetch_assoc($resultdomain1)) {
                                                                $domain = $rowdomain1['domain'];
                                                            ?>
                                                                <div class="col-md-6 form-group signupdomain" id="<?php echo "desig_" . str_replace("&", "and", str_replace(",", "", str_replace(" ", "-", $domain))); ?>" <?php if ($roweudcationinfo['profession'] == str_replace("&", "and", str_replace(",", "", str_replace(" ", "-", $domain)))) { ?>style="display:block" <?php } else { ?>style="display:none" <?php } ?>>
                                                                    <label class="lb"><i class="fa fa-times-circle text-danger" id="<?php echo str_replace("&", "and", str_replace(",", "", str_replace(" ", "-", $domain))) . '_designationcross'; ?>" style="display:none"></i> Designation <span class="text-danger">*</span></label>
                                                                    <span class="iconbox">
                                                                        <select class="form-select chosen-select designationdd" id="<?php echo str_replace("&", "and", str_replace(",", "", str_replace(" ", "-", $domain))) . '_dd' ?>">
                                                                            <option value="">Select</option>
                                                                            <?php
                                                                            $sqldesignation = "select * from domain_designation where domain = '$domain'";
                                                                            $resultdesignation = mysqli_query($con, $sqldesignation);
                                                                            while ($rowdesignation = mysqli_fetch_assoc($resultdesignation)) {
                                                                            ?>
                                                                                <option <?php if ($roweudcationinfo['designation'] == $rowdesignation['designation']) {
                                                                                            echo "selected";
                                                                                        } ?> value="<?php echo $rowdesignation['designation']; ?>"><?php echo $rowdesignation['designation']; ?></option>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                        <span class="material-symbols-outlined icon">airline_seat_recline_normal</span>
                                                                    </span>
                                                                </div>
                                                            <?php
                                                            }
                                                            ?>
                                                            <div class="col-md-6 form-group">
                                                                <label class="lb">Profession in Detail</label>
                                                                <span class="iconbox">
                                                                    <input type="text" class="form-control leftspace" placeholder="Enter Details" name="professiondetail" value="<?php echo $roweudcationinfo['professiondetail']; ?>">
                                                                    <span class="material-symbols-outlined icon">contact_mail</span>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label class="lb">Employer Name</label>
                                                                <span class="iconbox">
                                                                    <input type="text" class="form-control leftspace" placeholder="Enter Details" name="employername" value="<?php echo $roweudcationinfo['employername']; ?>">
                                                                    <span class="material-symbols-outlined icon">person</span>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label class="lb"><i class="fa fa-times-circle text-danger" id="incomecross" style="display:none"></i> Annual Income <span class="text-danger">*</span></label>
                                                                <span class="iconbox">
                                                                    <select class="form-select chosen-select" name="income" id="income" required>
                                                                        <?php render_dropdown_options($con, 'annual_income', $roweudcationinfo['income']); ?>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">currency_rupee</span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--END PROFILE BIO-->
                                                    <button type="submit" id="educationupdatebtn" class="btn btn-primary profile-btn">Update</button>
                                                </form>
                                            </div>
                                        </div>

                                        <div id="groomtab" class=" tab-pane fade p-0">
                                            <div class="form-login">
                                                <form action="profile-grooomlocation.php" method="post">
                                                    <!--PROFILE BIO-->
                                                    <div class="edit-pro-parti">
                                                        <div class="form-tit p-3 tophead">
                                                            <h1 class="text-white">
                                                                <?php
                                                                if ($rowformfill['groomlocation'] == 'Done') {
                                                                    echo "Groom";
                                                                }
                                                                if ($rowformfill['bridelocation'] == 'Done') {
                                                                    echo "Bride";
                                                                }
                                                                ?> Location
                                                            </h1>
                                                            <p class="m-0 text-white">'<span class="text-info">*</span>' Required fields</p>
                                                            <a href="user-profile.php" class="sett-edit-btn sett-acc-edit-eve"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
                                                        </div>
                                                        <?php if ($_GET['groom_update'] == 'yes') { ?>
                                                            <p class="text-center text-success" id="invalidpop"><b>Your profile has been successfully updated</b></p>
                                                        <?php } ?>

                                                        <div class="row p-4">
                                                            <?php
                                                            $sqlgroomlocation = "select * from groom_location where userid = '$userid'";
                                                            $resultgroomlocation = mysqli_query($con, $sqlgroomlocation);
                                                            $rowgroomlocation = mysqli_fetch_assoc($resultgroomlocation);
                                                            ?>

                                                            <!-- Residing Country -->
                                                            <div class="col-md-6 form-group">
                                                                <label class="lb"><i class="fa fa-times-circle text-danger" id="groomcountrycross" style="display:none"></i> Residing Country <span class="text-danger">*</span></label>
                                                                <span class="iconbox">
                                                                    <select class="form-select chosen-select" name="country" id="groomcountry" required>
                                                                        <option value="">Select</option>
                                                                        <?php
                                                                        // DYNAMIC: Fetch from countries table
                                                                        $sqlcountry = "SELECT * FROM countries ORDER BY country ASC";
                                                                        $resultcountry = mysqli_query($con, $sqlcountry);
                                                                        while ($rowcountry = mysqli_fetch_assoc($resultcountry)) {
                                                                        ?>
                                                                            <option <?php if ($rowcountry['country'] == $rowgroomlocation['country']) {
                                                                                        echo "selected";
                                                                                    } ?>>
                                                                                <?php echo $rowcountry['country']; ?>
                                                                            </option>
                                                                        <?php } ?>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">globe</span>
                                                                </span>
                                                            </div>

                                                            <!-- Citizenship -->
                                                            <div class="col-md-6 form-group" id="groomcitizen">
                                                                <label class="lb">Citizenship</label>
                                                                <span class="iconbox">
                                                                    <select class="form-select chosen-select" name="citizenship">
                                                                        <option value="">Select</option>
                                                                        <?php
                                                                        // DYNAMIC: Fetch from countries table
                                                                        $resultcitizenship = mysqli_query($con, "SELECT * FROM countries ORDER BY country ASC");
                                                                        while ($rowcit = mysqli_fetch_assoc($resultcitizenship)) {
                                                                        ?>
                                                                            <option <?php if ($rowcit['country'] == $rowgroomlocation['citizenship']) {
                                                                                        echo "selected";
                                                                                    } ?>>
                                                                                <?php echo $rowcit['country']; ?>
                                                                            </option>
                                                                        <?php } ?>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">style</span>
                                                                </span>
                                                            </div>

                                                            <!-- Resident Status -->
                                                            <div class="col-md-6 form-group" id="groomresident">
                                                                <label class="lb">Resident Status</label>
                                                                <span class="iconbox">
                                                                    <select class="form-select chosen-select" name="resident">
                                                                        <option value="">Select</option>
                                                                        <option <?php if ($rowgroomlocation['resident'] == 'Yes') {
                                                                                    echo "selected";
                                                                                } ?>>Yes</option>
                                                                        <option <?php if ($rowgroomlocation['resident'] == 'No') {
                                                                                    echo "selected";
                                                                                } ?>>No</option>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">check</span>
                                                                </span>
                                                            </div>

                                                            <!-- Residing State (FIXED: Added DISTINCT) -->
                                                            <div class="col-md-6 form-group">
                                                                <label class="lb"><i class="fa fa-times-circle text-danger" id="groomstatecross" style="display:none"></i> Residing State <span class="text-danger">*</span></label>
                                                                <span class="iconbox">
                                                                    <select class="form-select chosen-select" id="groomstate" name="state" required>
                                                                        <option value="">Select</option>
                                                                        <?php
                                                                        // FIXED: Added DISTINCT to prevent duplicate states
                                                                        $sqlstate = "SELECT DISTINCT(state) FROM city_state ORDER BY state ASC";
                                                                        $resultstate = mysqli_query($con, $sqlstate);
                                                                        while ($rowstate = mysqli_fetch_assoc($resultstate)) {
                                                                            // Create safe ID for matching (replace spaces with underscores)
                                                                            $safe_state_val = str_replace(" ", "_", $rowstate['state']);

                                                                            // Check if selected (Match stored value with current value)
                                                                            // Note: Database might store "Uttar_Pradesh" or "Uttar Pradesh", handle accordingly
                                                                            $isSelected = ($safe_state_val == str_replace(" ", "_", $rowgroomlocation['state'])) ? "selected" : "";
                                                                        ?>
                                                                            <option value="<?php echo $safe_state_val; ?>" <?php echo $isSelected; ?>>
                                                                                <?php echo $rowstate['state']; ?>
                                                                            </option>
                                                                        <?php } ?>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">map</span>
                                                                </span>
                                                            </div>

                                                            <!-- Residing City (Empty container for JS) -->
                                                            <div class="col-md-6 form-group " id="emptygroomcities" style="display:none">
                                                                <label class="lb"><i class="fa fa-times-circle text-danger groomcitycross" style="display:none"></i> Residing City <span class="text-danger">*</span></label>
                                                                <span class="iconbox">
                                                                    <select class="form-select chosen-select" id="groomcity">
                                                                        <option value="">Select</option>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">location_on</span>
                                                                </span>
                                                            </div>

                                                            <?php
                                                            $cityarray = array_filter(explode("//", $rowgroomlocation['city'])); // clean array

                                                            // Re-fetch DISTINCT states
                                                            $resultstate2 = mysqli_query($con, "SELECT DISTINCT(state) FROM city_state ORDER BY state ASC");

                                                            while ($rowstate2 = mysqli_fetch_assoc($resultstate2)) {

                                                                $state_name = trim($rowstate2['state']);
                                                                $safe_state_id = str_replace(" ", "_", $state_name);

                                                                // Saved state match check
                                                                $saved_state_safe = str_replace(" ", "_", trim($rowgroomlocation['state']));
                                                                $is_visible = ($saved_state_safe == $safe_state_id) ? 'style="display:block"' : 'style="display:none"';
                                                            ?>
                                                                <div class="col-md-6 form-group groomcities" id="groom_<?php echo $safe_state_id; ?>" <?php echo $is_visible; ?>>

                                                                    <label class="lb">
                                                                        <i class="fa fa-times-circle text-danger groomcitycross-s" style="display:none"></i>
                                                                        Residing City <span class="text-danger">*</span>
                                                                    </label>

                                                                    <span class="iconbox">
                                                                        <select class="form-select chosen-select gcity"
                                                                            id="groomcity_<?php echo $safe_state_id; ?>"
                                                                            name="city[]">
                                                                            <option value="">Select</option>

                                                                            <?php
                                                                            // Fetch cities for this state
                                                                            $sqlcity = "SELECT city FROM city_state WHERE state = '$state_name' ORDER BY city ASC";
                                                                            $resultcity = mysqli_query($con, $sqlcity);

                                                                            while ($rowcity = mysqli_fetch_assoc($resultcity)) {
                                                                                $current_city = trim($rowcity['city']);
                                                                                $selected = in_array($current_city, $cityarray) ? "selected" : "";
                                                                            ?>
                                                                                <option value="<?php echo $current_city; ?>" <?php echo $selected; ?>>
                                                                                    <?php echo $current_city; ?>
                                                                                </option>
                                                                            <?php } ?>

                                                                        </select>

                                                                        <span class="material-symbols-outlined icon">location_on</span>
                                                                    </span>

                                                                </div>

                                                            <?php } ?>


                                                        </div>
                                                    </div>
                                                    <!--END PROFILE BIO-->
                                                    <button type="submit" id="groomupdatebtn" class="btn btn-primary profile-btn">Update</button>
                                                </form>
                                            </div>
                                        </div>

                                        <!-- <div id="groomtab" class=" tab-pane fade p-0">
    <div class="form-login">
        <form action="profile-grooomlocation.php" method="post">
            <div class="edit-pro-parti">
                <div class="form-tit p-3 tophead">
                    <h1 class="text-white">
                        <?php
                        if ($rowformfill['groomlocation'] == 'Done') {
                            echo "Groom";
                        }
                        if ($rowformfill['bridelocation'] == 'Done') {
                            echo "Bride";
                        }
                        ?> Location
                    </h1>
                    <p class="m-0 text-white">'<span class="text-info">*</span>' Required fields</p>
                    <a href="user-profile.php" class="sett-edit-btn sett-acc-edit-eve"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
                </div>
                <?php if ($_GET['groom_update'] == 'yes') { ?>
                    <p class="text-center text-success" id="invalidpop"><b>Your profile has been successfully updated</b></p>
                <?php } ?>
                
                <div class="row p-4">
                    <?php
                    $sqlgroomlocation = "select * from groom_location where userid = '$userid'";
                    $resultgroomlocation = mysqli_query($con, $sqlgroomlocation);
                    $rowgroomlocation = mysqli_fetch_assoc($resultgroomlocation);
                    ?>

                    <div class="col-md-6 form-group">
                        <label class="lb"><i class="fa fa-times-circle text-danger" id="groomcountrycross" style="display:none"></i> Residing Country <span class="text-danger">*</span></label>
                        <span class="iconbox">
                            <select class="form-select chosen-select" name="country" id="groomcountry" required>
                                <option value="">Select</option>
                                <?php
                                // DYNAMIC: Fetch from countries table
                                $sqlcountry = "SELECT * FROM countries ORDER BY country ASC";
                                $resultcountry = mysqli_query($con, $sqlcountry);
                                while ($rowcountry = mysqli_fetch_assoc($resultcountry)) {
                                ?>
                                    <option <?php if ($rowcountry['country'] == $rowgroomlocation['country']) {
                                                echo "selected";
                                            } ?>>
                                        <?php echo $rowcountry['country']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <span class="material-symbols-outlined icon">globe</span>
                        </span>
                    </div>

                    <div class="col-md-6 form-group" id="groomcitizen">
                        <label class="lb">Citizenship</label>
                        <span class="iconbox">
                            <select class="form-select chosen-select" name="citizenship">
                                <option value="">Select</option>
                                <?php
                                // DYNAMIC: Fetch from countries table
                                $resultcitizenship = mysqli_query($con, "SELECT * FROM countries ORDER BY country ASC");
                                while ($rowcit = mysqli_fetch_assoc($resultcitizenship)) {
                                ?>
                                    <option <?php if ($rowcit['country'] == $rowgroomlocation['citizenship']) {
                                                echo "selected";
                                            } ?>>
                                        <?php echo $rowcit['country']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <span class="material-symbols-outlined icon">style</span>
                        </span>
                    </div>

                    <div class="col-md-6 form-group" id="groomresident">
                        <label class="lb">Resident Status</label>
                        <span class="iconbox">
                            <select class="form-select chosen-select" name="resident">
                                <option value="">Select</option>
                                <option <?php if ($rowgroomlocation['resident'] == 'Yes') {
                                            echo "selected";
                                        } ?>>Yes</option>
                                <option <?php if ($rowgroomlocation['resident'] == 'No') {
                                            echo "selected";
                                        } ?>>No</option>
                            </select>
                            <span class="material-symbols-outlined icon">check</span>
                        </span>
                    </div>

                    <div class="col-md-6 form-group">
                        <label class="lb"><i class="fa fa-times-circle text-danger" id="groomstatecross" style="display:none"></i> Residing State <span class="text-danger">*</span></label>
                        <span class="iconbox">
                            <select class="form-select chosen-select" id="groomstate" name="state" required>
                                <option value="">Select</option>
                                <?php
                                // DYNAMIC: Fetch Distinct States from city_state table
                                $sqlstate = "SELECT DISTINCT(state) FROM city_state ORDER BY state ASC";
                                $resultstate = mysqli_query($con, $sqlstate);
                                while ($rowstate = mysqli_fetch_assoc($resultstate)) {
                                    $safe_state = str_replace(" ", "_", $rowstate['state']);
                                ?>
                                    <option value="<?php echo $safe_state; ?>" <?php if ($rowstate['state'] == str_replace("_", " ", $rowgroomlocation['state'])) {
                                                                                    echo "selected";
                                                                                } ?>>
                                        <?php echo $rowstate['state']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <span class="material-symbols-outlined icon">map</span>
                        </span>
                    </div>

                    <div class="col-md-6 form-group " id="emptygroomcities" style="display:none">
                        <label class="lb"><i class="fa fa-times-circle text-danger groomcitycross" style="display:none"></i> Residing City <span class="text-danger">*</span></label>
                        <span class="iconbox">
                            <select class="form-select chosen-select" id="groomcity">
                                <option value="">Select</option>
                            </select>
                            <span class="material-symbols-outlined icon">location_on</span>
                        </span>
                    </div>

                    <?php
                    // Helper array for selected cities
                    $cityarray = explode("//", $rowgroomlocation['city']);

                    // Loop through states again to generate city lists
                    $resultstate2 = mysqli_query($con, "SELECT DISTINCT(state) FROM city_state ORDER BY state ASC");
                    while ($rowstate2 = mysqli_fetch_assoc($resultstate2)) {
                        $state_name = $rowstate2['state'];
                        $safe_state_id = str_replace(" ", "_", $state_name);

                        // Check if this block should be visible
                        $is_visible = ($rowgroomlocation['state'] == $safe_state_id) ? 'style="display:block"' : 'style="display:none"';
                    ?>
                        <div class="col-md-6 form-group groomcities" id="<?php echo "groom_" . $safe_state_id ?>" <?php echo $is_visible; ?>>
                            <label class="lb"><i class="fa fa-times-circle text-danger groomcitycross-s" style="display:none"></i> Residing City <span class="text-danger">*</span></label>
                            <span class="iconbox">
                                <select class="form-select chosen-select gcity" id="<?php echo "groomcity_" . $safe_state_id ?>" name="city[]">
                                    <option value="">Select</option>
                                    <?php
                                    $sqlcity = "SELECT * FROM city_state WHERE state = '$state_name' ORDER BY city ASC";
                                    $resultcity = mysqli_query($con, $sqlcity);
                                    while ($rowcity = mysqli_fetch_assoc($resultcity)) {
                                    ?>
                                        <option <?php if (in_array($rowcity['city'], str_replace("-", " ", $cityarray))) {
                                                    echo "selected";
                                                } ?> value="<?php echo $rowcity['city']; ?>">
                                            <?php echo $rowcity['city']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <span class="material-symbols-outlined icon">location_on</span>
                            </span>
                        </div>
                    <?php } ?>

                </div>
            </div>
            <button type="submit" id="groomupdatebtn" class="btn btn-primary profile-btn">Update</button>
        </form>
    </div>
</div> -->



                                        <div id="familytab" class=" tab-pane fade p-0">
                                            <div class="form-login">
                                                <form action="profile-family.php" method="post">
                                                    <!--PROFILE BIO-->
                                                    <div class="edit-pro-parti">
                                                        <div class="form-tit p-3 tophead">
                                                            <h1 class="text-white">Family Details </h1>
                                                            <p class="m-0 text-white">'<span class="text-info">*</span>' Required fields</p>
                                                            <a href="user-profile.php" class="sett-edit-btn sett-acc-edit-eve"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
                                                        </div>
                                                        <?php
                                                        if ($_GET['family_update'] == 'yes') {
                                                        ?>
                                                            <p class="text-center text-success" id="invalidpop"><b>Your profile has been successfully updated</b></p>
                                                        <?php
                                                        }
                                                        ?>
                                                        <div class="row p-4">
                                                            <?php
                                                            $sqlfamilyinfo = "select * from family_info where userid = '$userid'";
                                                            $resultfamilyinfo = mysqli_query($con, $sqlfamilyinfo);
                                                            $rowfamilyinfo = mysqli_fetch_assoc($resultfamilyinfo);
                                                            ?>
                                                            <div class="col-md-6 form-group">
                                                                <label class="lb">Family Value</label>
                                                                <span class="iconbox">
                                                                    <select class="form-select chosen-select" name="familyvalue">
                                                                        <option value="">Select</option>
                                                                        <option <?php if ($rowfamilyinfo['familyvalue'] == 'Orthodox') {
                                                                                    echo "selected";
                                                                                } ?>>Orthodox</option>
                                                                        <option <?php if ($rowfamilyinfo['familyvalue'] == 'Traditional') {
                                                                                    echo "selected";
                                                                                } ?>>Traditional</option>
                                                                        <option <?php if ($rowfamilyinfo['familyvalue'] == 'Moderate') {
                                                                                    echo "selected";
                                                                                } ?>>Moderate</option>
                                                                        <option <?php if ($rowfamilyinfo['familyvalue'] == 'Liberal') {
                                                                                    echo "selected";
                                                                                } ?>>Liberal</option>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">diversity_3</span>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label class="lb"><i class="fa fa-times-circle text-danger" id="ftypecross" style="display:none"></i> Family Type <span class="text-danger">*</span></label>
                                                                <span class="iconbox">
                                                                    <select class="form-select chosen-select" name="familytype" id="familytype" required>
                                                                        <option value="">Select</option>
                                                                        <option <?php if ($rowfamilyinfo['familytype'] == 'Joint Family') {
                                                                                    echo "selected";
                                                                                } ?>>Joint Family</option>
                                                                        <option <?php if ($rowfamilyinfo['familytype'] == 'Nuclear Family') {
                                                                                    echo "selected";
                                                                                } ?>>Nuclear Family</option>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">diversity_3</span>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label class="lb"><i class="fa fa-times-circle text-danger" id="fstatuscross" style="display:none"></i> Family Status <span class="text-danger">*</span></label>
                                                                <span class="iconbox">
                                                                    <select class="form-select chosen-select" name="familystatus" id="familystatus" data-placeholder="Select" required>
                                                                        <option value="">Select</option>
                                                                        <?php render_dropdown_options($con, 'family_status', $rowfamilyinfo['familystatus']); ?>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">diversity_3</span>
                                                                </span>
                                                            </div>
                                                            <!-- <div class="col-md-6 form-group">
    <label class="lb">
        <i class="fa fa-times-circle text-danger" id="fstatuscross" style="display:none"></i>
        Family Status <span class="text-danger">*</span>
    </label>

    <span class="iconbox">
        <select class="form-select chosen-select" name="familystatus" id="familystatus" data-placeholder="Select" required>
            <option value="">Select</option>
            <?php render_dropdown_options($con, 'family_status', $rowfamilyinfo['familystatus']); ?>
        </select>

        <span class="material-symbols-outlined icon">diversity_3</span>
    </span>
</div> -->

                                                            <div class="col-md-6 form-group">
                                                                <label class="lb">Native Place:</label>
                                                                <span class="iconbox">
                                                                    <input type="text" class="form-control leftspace" placeholder="Enter Details" name="nativeplace" value="<?php echo $rowfamilyinfo['nativeplace']; ?>">
                                                                    <span class="material-symbols-outlined icon">pin_drop</span>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label class="lb"><i class="fa fa-times-circle text-danger" id="fnamecross" style="display:none"></i> Father's Name <span class="text-danger">*</span></label>
                                                                <span class="iconbox">
                                                                    <input type="text" class="form-control leftspace" placeholder="Enter Details" id="fathername" name="fathername" value="<?php echo $rowfamilyinfo['fathername']; ?>" required>
                                                                    <span class="material-symbols-outlined icon">man</span>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label class="lb"><i class="fa fa-times-circle text-danger" id="mnamecross" style="display:none"></i> Mother's Name <span class="text-danger">*</span></label>
                                                                <span class="iconbox">
                                                                    <input type="text" class="form-control leftspace" placeholder="Enter Details" id="mothername" name="mothername" value="<?php echo $rowfamilyinfo['mothername']; ?>" required>
                                                                    <span class="material-symbols-outlined icon">woman</span>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label class="lb"><i class="fa fa-times-circle text-danger" id="focross" style="display:none"></i> Father's Occupation <span class="text-danger">*</span></label>
                                                                <span class="iconbox">
                                                                    <input type="text" class="form-control leftspace" placeholder="Enter Details" id="fatheroccupation" name="fatheroccupation" value="<?php echo $rowfamilyinfo['fatheroccupation']; ?>" required>
                                                                    <span class="material-symbols-outlined icon">work</span>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label class="lb"><i class="fa fa-times-circle text-danger" id="mocross" style="display:none"></i> Mother's Occupation <span class="text-danger">*</span></label>
                                                                <span class="iconbox">
                                                                    <input type="text" class="form-control leftspace" placeholder="Enter Details" id="motheroccupation" name="motheroccupation" value="<?php echo $rowfamilyinfo['motheroccupation']; ?>" required>
                                                                    <span class="material-symbols-outlined icon">work</span>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label class="lb">No. Of Brothers</label>
                                                                <span class="iconbox">
                                                                    <select class="form-select chosen-select" name="brothers">
                                                                        <option value="">Select</option>
                                                                        <option <?php if ($rowfamilyinfo['brothers'] == '0') {
                                                                                    echo "selected";
                                                                                } ?>>0</option>
                                                                        <option <?php if ($rowfamilyinfo['brothers'] == '1') {
                                                                                    echo "selected";
                                                                                } ?>>1</option>
                                                                        <option <?php if ($rowfamilyinfo['brothers'] == '2') {
                                                                                    echo "selected";
                                                                                } ?>>2</option>
                                                                        <option <?php if ($rowfamilyinfo['brothers'] == '3') {
                                                                                    echo "selected";
                                                                                } ?>>3</option>
                                                                        <option <?php if ($rowfamilyinfo['brothers'] == '4') {
                                                                                    echo "selected";
                                                                                } ?>>4</option>
                                                                        <option <?php if ($rowfamilyinfo['brothers'] == '5') {
                                                                                    echo "selected";
                                                                                } ?>>5</option>
                                                                        <option <?php if ($rowfamilyinfo['brothers'] == '6') {
                                                                                    echo "selected";
                                                                                } ?>>6</option>
                                                                        <option <?php if ($rowfamilyinfo['brothers'] == '7') {
                                                                                    echo "selected";
                                                                                } ?>>7</option>
                                                                        <option <?php if ($rowfamilyinfo['brothers'] == '8') {
                                                                                    echo "selected";
                                                                                } ?>>8</option>
                                                                        <option <?php if ($rowfamilyinfo['brothers'] == '9') {
                                                                                    echo "selected";
                                                                                } ?>>9</option>
                                                                        <option <?php if ($rowfamilyinfo['brothers'] == '10') {
                                                                                    echo "selected";
                                                                                } ?>>10</option>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">boy</span>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label class="lb">Brothers Married</label>
                                                                <span class="iconbox">
                                                                    <select class="form-select chosen-select" name="bromarried">
                                                                        <option value="">Select</option>
                                                                        <option <?php if ($rowfamilyinfo['bromarried'] == '0') {
                                                                                    echo "selected";
                                                                                } ?>>0</option>
                                                                        <option <?php if ($rowfamilyinfo['bromarried'] == '1') {
                                                                                    echo "selected";
                                                                                } ?>>1</option>
                                                                        <option <?php if ($rowfamilyinfo['bromarried'] == '2') {
                                                                                    echo "selected";
                                                                                } ?>>2</option>
                                                                        <option <?php if ($rowfamilyinfo['bromarried'] == '3') {
                                                                                    echo "selected";
                                                                                } ?>>3</option>
                                                                        <option <?php if ($rowfamilyinfo['bromarried'] == '4') {
                                                                                    echo "selected";
                                                                                } ?>>4</option>
                                                                        <option <?php if ($rowfamilyinfo['bromarried'] == '5') {
                                                                                    echo "selected";
                                                                                } ?>>5</option>
                                                                        <option <?php if ($rowfamilyinfo['bromarried'] == '6') {
                                                                                    echo "selected";
                                                                                } ?>>6</option>
                                                                        <option <?php if ($rowfamilyinfo['bromarried'] == '7') {
                                                                                    echo "selected";
                                                                                } ?>>7</option>
                                                                        <option <?php if ($rowfamilyinfo['bromarried'] == '8') {
                                                                                    echo "selected";
                                                                                } ?>>8</option>
                                                                        <option <?php if ($rowfamilyinfo['bromarried'] == '9') {
                                                                                    echo "selected";
                                                                                } ?>>9</option>
                                                                        <option <?php if ($rowfamilyinfo['bromarried'] == '10') {
                                                                                    echo "selected";
                                                                                } ?>>10</option>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">diversity_4</span>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label class="lb">No. Of Sisters</label>
                                                                <span class="iconbox">
                                                                    <select class="form-select chosen-select" name="sisters">
                                                                        <option value="">Select</option>
                                                                        <option <?php if ($rowfamilyinfo['sisters'] == '0') {
                                                                                    echo "selected";
                                                                                } ?>>0</option>
                                                                        <option <?php if ($rowfamilyinfo['sisters'] == '1') {
                                                                                    echo "selected";
                                                                                } ?>>1</option>
                                                                        <option <?php if ($rowfamilyinfo['sisters'] == '2') {
                                                                                    echo "selected";
                                                                                } ?>>2</option>
                                                                        <option <?php if ($rowfamilyinfo['sisters'] == '3') {
                                                                                    echo "selected";
                                                                                } ?>>3</option>
                                                                        <option <?php if ($rowfamilyinfo['sisters'] == '4') {
                                                                                    echo "selected";
                                                                                } ?>>4</option>
                                                                        <option <?php if ($rowfamilyinfo['sisters'] == '5') {
                                                                                    echo "selected";
                                                                                } ?>>5</option>
                                                                        <option <?php if ($rowfamilyinfo['sisters'] == '6') {
                                                                                    echo "selected";
                                                                                } ?>>6</option>
                                                                        <option <?php if ($rowfamilyinfo['sisters'] == '7') {
                                                                                    echo "selected";
                                                                                } ?>>7</option>
                                                                        <option <?php if ($rowfamilyinfo['sisters'] == '8') {
                                                                                    echo "selected";
                                                                                } ?>>8</option>
                                                                        <option <?php if ($rowfamilyinfo['sisters'] == '9') {
                                                                                    echo "selected";
                                                                                } ?>>9</option>
                                                                        <option <?php if ($rowfamilyinfo['sisters'] == '10') {
                                                                                    echo "selected";
                                                                                } ?>>10</option>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">girl</span>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label class="lb">Sisters Married</label>
                                                                <span class="iconbox">
                                                                    <select class="form-select chosen-select" name="sismarried">
                                                                        <option value="">Select</option>
                                                                        <option <?php if ($rowfamilyinfo['sismarried'] == '0') {
                                                                                    echo "selected";
                                                                                } ?>>0</option>
                                                                        <option <?php if ($rowfamilyinfo['sismarried'] == '1') {
                                                                                    echo "selected";
                                                                                } ?>>1</option>
                                                                        <option <?php if ($rowfamilyinfo['sismarried'] == '2') {
                                                                                    echo "selected";
                                                                                } ?>>2</option>
                                                                        <option <?php if ($rowfamilyinfo['sismarried'] == '3') {
                                                                                    echo "selected";
                                                                                } ?>>3</option>
                                                                        <option <?php if ($rowfamilyinfo['sismarried'] == '4') {
                                                                                    echo "selected";
                                                                                } ?>>4</option>
                                                                        <option <?php if ($rowfamilyinfo['sismarried'] == '5') {
                                                                                    echo "selected";
                                                                                } ?>>5</option>
                                                                        <option <?php if ($rowfamilyinfo['sismarried'] == '6') {
                                                                                    echo "selected";
                                                                                } ?>>6</option>
                                                                        <option <?php if ($rowfamilyinfo['sismarried'] == '7') {
                                                                                    echo "selected";
                                                                                } ?>>7</option>
                                                                        <option <?php if ($rowfamilyinfo['sismarried'] == '8') {
                                                                                    echo "selected";
                                                                                } ?>>8</option>
                                                                        <option <?php if ($rowfamilyinfo['sismarried'] == '9') {
                                                                                    echo "selected";
                                                                                } ?>>9</option>
                                                                        <option <?php if ($rowfamilyinfo['sismarried'] == '10') {
                                                                                    echo "selected";
                                                                                } ?>>10</option>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">diversity_4</span>
                                                                </span>
                                                            </div>
                                                            <div class="form-tit mt-4">
                                                                <h6 class="mb-1">Family Location</h6>
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label class="lb"><i class="fa fa-times-circle text-danger" id="flocationcross" style="display:none"></i> Family Location <span class="text-danger">*</span></label>
                                                                <span class="iconbox">
                                                                    <select class="form-select chosen-select" name="familylocation" id="familylocation" required>
                                                                        <option value="">Select</option>
                                                                        <option <?php if ($rowfamilyinfo['familylocation'] == 'Same as my location') {
                                                                                    echo "selected";
                                                                                } ?>>Same as my location</option>
                                                                        <option <?php if ($rowfamilyinfo['familylocation'] == 'Different Location') {
                                                                                    echo "selected";
                                                                                } ?>>Different Location</option>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">location_on</span>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-6 form-group familycountry" <?php if ($rowfamilyinfo['familylocation'] == 'Different Location') {
                                                                                                                echo "style='display:block'";
                                                                                                            } else {
                                                                                                                echo "style='display:none'";
                                                                                                            } ?>>
                                                                <label class="lb"><i class="fa fa-times-circle text-danger" id="diffcountrycross" style="display:none"></i> Residing Country <span class="text-danger">*</span></label>
                                                                <span class="iconbox">
                                                                    <select class="form-select chosen-select" name="country" id="diffcountry">
                                                                        <option value="">Select</option>
                                                                        <?php
                                                                        $sqlcountry = "select * from countries";
                                                                        $resultcountry = mysqli_query($con, $sqlcountry);
                                                                        while ($rowcountry = mysqli_fetch_assoc($resultcountry)) {
                                                                        ?>
                                                                            <option <?php if ($rowcountry['country'] == $rowfamilyinfo['country']) {
                                                                                        echo "selected";
                                                                                    } ?>><?php echo $rowcountry['country']; ?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">globe</span>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-6 form-group familystate" <?php if ($rowfamilyinfo['familylocation'] == 'Different Location') {
                                                                                                                echo "style='display:block'";
                                                                                                            } else {
                                                                                                                echo "style='display:none'";
                                                                                                            } ?>>
                                                                <label class="lb"><i class="fa fa-times-circle text-danger" id="diffstatecross" style="display:none"></i> Residing State <span class="text-danger">*</span></label>
                                                                <span class="iconbox">
                                                                    <select class="form-select chosen-select" id="familystate" name="state">
                                                                        <option value="">Select</option>
                                                                        <?php
                                                                        $sqlstate = "select distinct(state) from city_state";
                                                                        $resultstate = mysqli_query($con, $sqlstate);
                                                                        while ($rowstate = mysqli_fetch_assoc($resultstate)) {
                                                                        ?>
                                                                            <option value="<?php echo str_replace(" ", "_", $rowstate['state']); ?>" <?php if ($rowstate['state'] == $rowfamilyinfo['state']) {
                                                                                                                                                            echo "selected";
                                                                                                                                                        } ?>><?php echo $rowstate['state']; ?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">map</span>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-6 form-group familycity" id="emptyfamilycity" style="display:none">
                                                                <label class="lb"><i class="fa fa-times-circle text-danger" id="emptyfamilycitycross" style="display:none"></i> Residing City <span class="text-danger">*</span></label>
                                                                <span class="iconbox">
                                                                    <select class="form-select chosen-select" id="emptycity">
                                                                        <option value="">Select</option>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">location_on</span>
                                                                </span>
                                                            </div>
                                                            <?php
                                                            $sqlstate1 = "select distinct(state) from city_state";
                                                            $resultstate1 = mysqli_query($con, $sqlstate1);
                                                            while ($rowstate1 = mysqli_fetch_assoc($resultstate1)) {
                                                                $state = $rowstate1['state'];
                                                            ?>
                                                                <div class="col-md-6 form-group familycities" id="<?php echo str_replace(" ", "_", $state) ?>" <?php if ($rowfamilyinfo['familylocation'] == 'Different Location' && $rowfamilyinfo['state'] == $state) {
                                                                                                                                                                    echo 'style="display:block"';
                                                                                                                                                                } else {
                                                                                                                                                                    echo 'style="display:none"';
                                                                                                                                                                } ?>>
                                                                    <label class="lb"><i class="fa fa-times-circle text-danger citycross" style="display:none"></i> Residing City <span class="text-danger">*</span></label>
                                                                    <span class="iconbox">
                                                                        <select class="form-select chosen-select gc" id="<?php echo "gc_" . str_replace(" ", "_", $state) ?>" name="city[]">
                                                                            <option value="">Select</option>
                                                                            <?php
                                                                            $sqlcity = "select * from city_state where state = '$state'";
                                                                            $resultcity = mysqli_query($con, $sqlcity);
                                                                            while ($rowcity = mysqli_fetch_assoc($resultcity)) {
                                                                            ?>
                                                                                <option <?php if ($rowfamilyinfo['city'] == $rowcity['city']) {
                                                                                            echo "selected";
                                                                                        } ?> value="<?php echo $rowcity['city']; ?>"><?php echo $rowcity['city']; ?></option>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                        <span class="material-symbols-outlined icon">location_on</span>
                                                                    </span>
                                                                </div>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>

                                                    </div>
                                                    <!--END PROFILE BIO-->
                                                    <button type="submit" id="familyupdatebtn" class="btn btn-primary profile-btn">Update</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div id="hobbiestab" class=" tab-pane fade p-0">
                                            <div class="form-login">
                                                <form action="profile-hobbies.php" method="post">
                                                    <!--PROFILE BIO-->
                                                    <div class="edit-pro-parti">
                                                        <div class="form-tit p-3 tophead">
                                                            <h1 class="text-white">Hobbies & Interest</h1>
                                                            <p class="m-0 text-white">'<span class="text-info">*</span>' Required fields</p>
                                                            <a href="user-profile.php" class="sett-edit-btn sett-acc-edit-eve"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
                                                        </div>
                                                        <?php
                                                        if (isset($_GET['hobbies_update']) && $_GET['hobbies_update'] == 'yes') {
                                                        ?>
                                                            <p class="text-center text-success" id="invalidpop"><b>Your profile has been successfully updated</b></p>
                                                        <?php
                                                        }
                                                        ?>
                                                        <div class="row p-4">
                                                            <?php
                                                            $sqlhobbiesinfo = "select * from hobbies_info where userid = '$userid'";
                                                            $resulthobbiesinfo = mysqli_query($con, $sqlhobbiesinfo);
                                                            $rowhobbiesinfo = mysqli_fetch_assoc($resulthobbiesinfo);
                                                            ?>

                                                            <!-- HOBBIES SECTION -->
                                                            <div class="col-md-12 form-group">
                                                                <?php
                                                                // Database value ko array mein convert karein (Separator: //)
                                                                $hobbies = [];
                                                                if (!empty($rowhobbiesinfo['hobbies'])) {
                                                                    $hobbies = explode("//", $rowhobbiesinfo['hobbies']);
                                                                }
                                                                ?>
                                                                <label class="lb">Hobbies and interest</label>
                                                                <span class="iconbox">
                                                                    <select class="form-select chosen-select" name="hobbies[]" placeholder="select" multiple>
                                                                        <!-- Dynamic Function Call: Dropdown Name 'hobbies' -->
                                                                        <?php render_multiselect_options($con, 'hobbies', $hobbies); ?>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">interests</span>
                                                                </span>
                                                            </div>

                                                            <!-- MUSIC SECTION -->
                                                            <div class="col-md-12 form-group">
                                                                <?php
                                                                $music = [];
                                                                if (!empty($rowhobbiesinfo['music'])) {
                                                                    $music = explode("//", $rowhobbiesinfo['music']);
                                                                }
                                                                ?>
                                                                <label class="lb">Favourite Music</label>
                                                                <span class="iconbox">
                                                                    <select class="form-select chosen-select" name="music[]" multiple>
                                                                        <!-- Dynamic Function Call: Dropdown Name 'music' -->
                                                                        <?php render_multiselect_options($con, 'music', $music); ?>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">library_music</span>
                                                                </span>
                                                            </div>

                                                            <!-- SPORTS SECTION -->
                                                            <div class="col-md-12 form-group">
                                                                <?php
                                                                $sports = [];
                                                                if (!empty($rowhobbiesinfo['sports'])) {
                                                                    $sports = explode("//", $rowhobbiesinfo['sports']);
                                                                }
                                                                ?>
                                                                <label class="lb">Sports you like</label>
                                                                <span class="iconbox">
                                                                    <select class="form-select chosen-select" name="sports[]" multiple>
                                                                        <!-- Dynamic Function Call: Dropdown Name 'sports' -->
                                                                        <?php render_multiselect_options($con, 'sports', $sports); ?>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">sports_esports</span>
                                                                </span>
                                                            </div>

                                                            <!-- FOOD SECTION -->
                                                            <div class="col-md-12 form-group">
                                                                <?php
                                                                $food = [];
                                                                if (!empty($rowhobbiesinfo['food'])) {
                                                                    $food = explode("//", $rowhobbiesinfo['food']);
                                                                }
                                                                ?>
                                                                <label class="lb">Your Favourite Food</label>
                                                                <span class="iconbox">
                                                                    <select class="form-select chosen-select" name="food[]" multiple>
                                                                        <!-- Dynamic Function Call: Dropdown Name 'food' -->
                                                                        <?php render_multiselect_options($con, 'food', $food); ?>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">restaurant</span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--END PROFILE BIO-->
                                                    <button type="submit" class="btn btn-primary profile-btn">Update</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div id="partnertab" class=" tab-pane fade p-0">
                                            <div class="form-login">
                                                <form action="profile-partner.php" method="post">
                                                    <!--PROFILE BIO-->
                                                    <div class="edit-pro-parti">
                                                        <div class="form-tit p-3 tophead">
                                                            <h1 class="text-white">Partner Preference</h1>
                                                            <p class="m-0 text-white">'<span class="text-info">*</span>' Required fields</p>
                                                            <a href="user-profile.php" class="sett-edit-btn sett-acc-edit-eve"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
                                                        </div>
                                                        <?php
                                                        if ($_GET['partner_update'] == 'yes') {
                                                        ?>
                                                            <p class="text-center text-success" id="invalidpop"><b>Your profile has been successfully updated</b></p>
                                                        <?php
                                                        }
                                                        ?>
                                                        <?php
                                                        $sqlpartnerinfo = "select * from partner_info where userid = '$userid'";
                                                        $resultpartnerinfo = mysqli_query($con, $sqlpartnerinfo);
                                                        $rowpartnerinfo = mysqli_fetch_assoc($resultpartnerinfo);
                                                        ?>

                                                        <div class="row p-4 pb-0">
                                                            <div class="form-tit p-2">
                                                                <h6 class="mb-1">Basic Preference</h6>
                                                            </div>
                                                            <!-- <div class="col-md-6 form-group">
                                                                <label class="lb"><i class="fa fa-times-circle text-danger" id="partneragecross" style="display:none"></i> Partner Age <span class="text-danger">*</span></label>
                                                                <?php
                                                                $partnerage = explode("-", $rowpartnerinfo['partnerage']);
                                                                ?>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <span class="iconbox">
                                                                            <select class="form-select chosen-select" name="partneragefrom" id="partneragefrom" required>
                                                                                <option value="">From</option>
                                                                                <?php
                                                                                for ($from = 20; $from <= "70"; $from++) {
                                                                                ?>
                                                                                    <option <?php if ($partnerage['0'] == $from . ' Yrs') {
                                                                                                echo "selected";
                                                                                            } ?>><?php echo $from ?> Yrs</option>
                                                                                <?php
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                            <span class="material-symbols-outlined icon">123</span>
                                                                        </span>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <span class="iconbox">
                                                                            <select class="form-select chosen-select" name="partnerageto" id="partnerageto" required>
                                                                                <option value="">To</option>
                                                                                <?php
                                                                                for ($to = 21; $to <= "70"; $to++) {
                                                                                ?>
                                                                                    <option <?php if ($partnerage['1'] == $to . ' Yrs') {
                                                                                                echo "selected";
                                                                                            } ?>><?php echo $to ?> Yrs</option>
                                                                                <?php
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                            <span class="material-symbols-outlined icon">123</span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div> -->

                                                            <div class="col-md-6 form-group">
                                                                <label class="lb">
                                                                    <i class="fa fa-times-circle text-danger" id="partneragecross" style="display:none"></i>
                                                                    Partner Age <span class="text-danger">*</span>
                                                                </label>

                                                                <?php
                                                                // 1. डेटाबेस वैल्यू को तोड़ना (Format: "20 Yrs-25 Yrs")
                                                                $partnerage_arr = [];
                                                                if (!empty($rowpartnerinfo['partnerage'])) {
                                                                    $partnerage_arr = explode("-", $rowpartnerinfo['partnerage']);
                                                                }

                                                                // 2. वैल्यू सेट है या नहीं चेक करना (Error से बचने के लिए)
                                                                $age_from_val = isset($partnerage_arr[0]) ? $partnerage_arr[0] : '';
                                                                $age_to_val   = isset($partnerage_arr[1]) ? $partnerage_arr[1] : '';
                                                                ?>

                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <span class="iconbox">
                                                                            <select class="form-select chosen-select" name="partneragefrom" id="partneragefrom" required>
                                                                                <option value="">From</option>
                                                                                <?php
                                                                                // Dynamic Loop: 18 से 70 तक
                                                                                for ($i = 18; $i <= 100; $i++) {
                                                                                    $val = $i . ' Yrs';
                                                                                    // अगर डेटाबेस वाली वैल्यू मैच हो, तो select करें
                                                                                    $selected = (trim($val) == trim($age_from_val)) ? 'selected' : '';
                                                                                    echo "<option value='$val' $selected>$i Yrs</option>";
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                            <span class="material-symbols-outlined icon">123</span>
                                                                        </span>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <span class="iconbox">
                                                                            <select class="form-select chosen-select" name="partnerageto" id="partnerageto" required>
                                                                                <option value="">To</option>
                                                                                <?php
                                                                                // Dynamic Loop: 18 से 70 तक
                                                                                for ($j = 18; $j <= 100; $j++) {
                                                                                    $val = $j . ' Yrs';
                                                                                    $selected = (trim($val) == trim($age_to_val)) ? 'selected' : '';
                                                                                    echo "<option value='$val' $selected>$j Yrs</option>";
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                            <span class="material-symbols-outlined icon">123</span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- <div class="col-md-6 form-group">
                                                                <label class="lb"><i class="fa fa-times-circle text-danger" id="partnerheightcross" style="display:none"></i> Height <span class="text-danger">*</span></label>
                                                                <?php
                                                                $partnerheight = explode("-", $rowpartnerinfo['partnerheight']);
                                                                ?>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <span class="iconbox">
                                                                            <select class="form-select chosen-select" name="partnerheightfrom" id="partnerheightfrom" required>
                                                                                <option value="">Select</option>
                                                                                <option <?php if ($partnerheight['0'] == '4 Feet 5 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>4 Feet 5 Inches</option>
                                                                                <option <?php if ($partnerheight['0'] == '4 Feet 6 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>4 Feet 6 Inches</option>
                                                                                <option <?php if ($partnerheight['0'] == '4 Feet 7 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>4 Feet 7 Inches</option>
                                                                                <option <?php if ($partnerheight['0'] == '4 Feet 8 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>4 Feet 8 Inches</option>
                                                                                <option <?php if ($partnerheight['0'] == '4 Feet 9 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>4 Feet 9 Inches</option>
                                                                                <option <?php if ($partnerheight['0'] == '4 Feet 10 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>4 Feet 10 Inches</option>
                                                                                <option <?php if ($partnerheight['0'] == '4 Feet 11 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>4 Feet 11 Inches</option>
                                                                                <option <?php if ($partnerheight['0'] == '5 Feet 0 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>5 Feet 0 Inches</option>
                                                                                <option <?php if ($partnerheight['0'] == '5 Feet 1 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>5 Feet 1 Inches</option>
                                                                                <option <?php if ($partnerheight['0'] == '5 Feet 2 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>5 Feet 2 Inches</option>
                                                                                <option <?php if ($partnerheight['0'] == '5 Feet 3 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>5 Feet 3 Inches</option>
                                                                                <option <?php if ($partnerheight['0'] == '5 Feet 4 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>5 Feet 4 Inches</option>
                                                                                <option <?php if ($partnerheight['0'] == '5 Feet 5 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>5 Feet 5 Inches</option>
                                                                                <option <?php if ($partnerheight['0'] == '5 Feet 6 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>5 Feet 6 Inches</option>
                                                                                <option <?php if ($partnerheight['0'] == '5 Feet 7 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>5 Feet 7 Inches</option>
                                                                                <option <?php if ($partnerheight['0'] == '5 Feet 8 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>5 Feet 8 Inches</option>
                                                                                <option <?php if ($partnerheight['0'] == '5 Feet 9 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>5 Feet 9 Inches</option>
                                                                                <option <?php if ($partnerheight['0'] == '5 Feet 10 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>5 Feet 10 Inches</option>
                                                                                <option <?php if ($partnerheight['0'] == '5 Feet 11 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>5 Feet 11 Inches</option>
                                                                                <option <?php if ($partnerheight['0'] == '6 Feet 0 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>6 Feet 0 Inches</option>
                                                                                <option <?php if ($partnerheight['0'] == '6 Feet 1 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>6 Feet 1 Inches</option>
                                                                                <option <?php if ($partnerheight['0'] == '6 Feet 2 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>6 Feet 2 Inches</option>
                                                                                <option <?php if ($partnerheight['0'] == '6 Feet 3 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>6 Feet 3 Inches</option>
                                                                                <option <?php if ($partnerheight['0'] == '6 Feet 4 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>6 Feet 4 Inches</option>
                                                                                <option <?php if ($partnerheight['0'] == '6 Feet 5 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>6 Feet 5 Inches</option>
                                                                                <option <?php if ($partnerheight['0'] == '6 Feet 6 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>6 Feet 6 Inches</option>
                                                                                <option <?php if ($partnerheight['0'] == '6 Feet 7 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>6 Feet 7 Inches</option>
                                                                                <option <?php if ($partnerheight['0'] == '6 Feet 8 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>6 Feet 8 Inches</option>
                                                                                <option <?php if ($partnerheight['0'] == '6 Feet 9 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>6 Feet 9 Inches</option>
                                                                                <option <?php if ($partnerheight['0'] == '6 Feet 10 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>6 Feet 10 Inches</option>
                                                                                <option <?php if ($partnerheight['0'] == '6 Feet 11 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>6 Feet 11 Inches</option>
                                                                                <option <?php if ($partnerheight['0'] == '7 Feet 0 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>7 Feet 0 Inches</option>
                                                                                <option <?php if ($partnerheight['0'] == '7 Feet 1 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>7 Feet 1 Inches</option>
                                                                                <option <?php if ($partnerheight['0'] == '7 Feet 2 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>7 Feet 2 Inches</option>
                                                                                <option <?php if ($partnerheight['0'] == '7 Feet 3 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>7 Feet 3 Inches</option>
                                                                                <option <?php if ($partnerheight['0'] == '7 Feet 4 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>7 Feet 4 Inches</option>
                                                                                <option <?php if ($partnerheight['0'] == '7 Feet 5 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>7 Feet 5 Inches</option>
                                                                            </select>
                                                                            <span class="material-symbols-outlined icon">height</span>
                                                                        </span>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <span class="iconbox">
                                                                            <select class="form-select chosen-select" name="partnerheightto" id="partnerheightto" required>
                                                                                <option value="">Select</option>
                                                                                <option <?php if ($partnerheight['1'] == '4 Feet 5 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>4 Feet 5 Inches</option>
                                                                                <option <?php if ($partnerheight['1'] == '4 Feet 6 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>4 Feet 6 Inches</option>
                                                                                <option <?php if ($partnerheight['1'] == '4 Feet 7 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>4 Feet 7 Inches</option>
                                                                                <option <?php if ($partnerheight['1'] == '4 Feet 8 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>4 Feet 8 Inches</option>
                                                                                <option <?php if ($partnerheight['1'] == '4 Feet 9 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>4 Feet 9 Inches</option>
                                                                                <option <?php if ($partnerheight['1'] == '4 Feet 10 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>4 Feet 10 Inches</option>
                                                                                <option <?php if ($partnerheight['1'] == '4 Feet 11 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>4 Feet 11 Inches</option>
                                                                                <option <?php if ($partnerheight['1'] == '5 Feet 0 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>5 Feet 0 Inches</option>
                                                                                <option <?php if ($partnerheight['1'] == '5 Feet 1 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>5 Feet 1 Inches</option>
                                                                                <option <?php if ($partnerheight['1'] == '5 Feet 2 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>5 Feet 2 Inches</option>
                                                                                <option <?php if ($partnerheight['1'] == '5 Feet 3 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>5 Feet 3 Inches</option>
                                                                                <option <?php if ($partnerheight['1'] == '5 Feet 4 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>5 Feet 4 Inches</option>
                                                                                <option <?php if ($partnerheight['1'] == '5 Feet 5 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>5 Feet 5 Inches</option>
                                                                                <option <?php if ($partnerheight['1'] == '5 Feet 6 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>5 Feet 6 Inches</option>
                                                                                <option <?php if ($partnerheight['1'] == '5 Feet 7 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>5 Feet 7 Inches</option>
                                                                                <option <?php if ($partnerheight['1'] == '5 Feet 8 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>5 Feet 8 Inches</option>
                                                                                <option <?php if ($partnerheight['1'] == '5 Feet 9 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>5 Feet 9 Inches</option>
                                                                                <option <?php if ($partnerheight['1'] == '5 Feet 10 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>5 Feet 10 Inches</option>
                                                                                <option <?php if ($partnerheight['1'] == '5 Feet 11 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>5 Feet 11 Inches</option>
                                                                                <option <?php if ($partnerheight['1'] == '6 Feet 0 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>6 Feet 0 Inches</option>
                                                                                <option <?php if ($partnerheight['1'] == '6 Feet 1 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>6 Feet 1 Inches</option>
                                                                                <option <?php if ($partnerheight['1'] == '6 Feet 2 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>6 Feet 2 Inches</option>
                                                                                <option <?php if ($partnerheight['1'] == '6 Feet 3 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>6 Feet 3 Inches</option>
                                                                                <option <?php if ($partnerheight['1'] == '6 Feet 4 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>6 Feet 4 Inches</option>
                                                                                <option <?php if ($partnerheight['1'] == '6 Feet 5 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>6 Feet 5 Inches</option>
                                                                                <option <?php if ($partnerheight['1'] == '6 Feet 6 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>6 Feet 6 Inches</option>
                                                                                <option <?php if ($partnerheight['1'] == '6 Feet 7 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>6 Feet 7 Inches</option>
                                                                                <option <?php if ($partnerheight['1'] == '6 Feet 8 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>6 Feet 8 Inches</option>
                                                                                <option <?php if ($partnerheight['1'] == '6 Feet 9 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>6 Feet 9 Inches</option>
                                                                                <option <?php if ($partnerheight['1'] == '6 Feet 10 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>6 Feet 10 Inches</option>
                                                                                <option <?php if ($partnerheight['1'] == '6 Feet 11 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>6 Feet 11 Inches</option>
                                                                                <option <?php if ($partnerheight['1'] == '7 Feet 0 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>7 Feet 0 Inches</option>
                                                                                <option <?php if ($partnerheight['1'] == '7 Feet 1 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>7 Feet 1 Inches</option>
                                                                                <option <?php if ($partnerheight['1'] == '7 Feet 2 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>7 Feet 2 Inches</option>
                                                                                <option <?php if ($partnerheight['1'] == '7 Feet 3 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>7 Feet 3 Inches</option>
                                                                                <option <?php if ($partnerheight['1'] == '7 Feet 4 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>7 Feet 4 Inches</option>
                                                                                <option <?php if ($partnerheight['1'] == '7 Feet 5 Inches') {
                                                                                            echo "selected";
                                                                                        } ?>>7 Feet 5 Inches</option>
                                                                            </select>
                                                                            <span class="material-symbols-outlined icon">height</span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div> -->


                                                            <div class="col-md-6 form-group">
                                                                <label class="lb">
                                                                    <i class="fa fa-times-circle text-danger" id="partnerheightcross" style="display:none"></i>
                                                                    Height <span class="text-danger">*</span>
                                                                </label>

                                                                <?php

                                                                $partnerheight = [];
                                                                if (!empty($rowpartnerinfo['partnerheight'])) {
                                                                    $partnerheight = explode("-", $rowpartnerinfo['partnerheight']);
                                                                }

                                                                $p_height_from = isset($partnerheight[0]) ? $partnerheight[0] : '';
                                                                $p_height_to   = isset($partnerheight[1]) ? $partnerheight[1] : '';
                                                                ?>

                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <span class="iconbox">
                                                                            <select class="form-select chosen-select" name="partnerheightfrom" id="partnerheightfrom" required>
                                                                                <?php render_dropdown_options($con, 'height', $p_height_from); ?>
                                                                            </select>
                                                                            <span class="material-symbols-outlined icon">height</span>
                                                                        </span>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <span class="iconbox">
                                                                            <select class="form-select chosen-select" name="partnerheightto" id="partnerheightto" required>
                                                                                <?php render_dropdown_options($con, 'height', $p_height_to); ?>
                                                                            </select>
                                                                            <span class="material-symbols-outlined icon">height</span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <!-- <div class="col-md-6 form-group">
                                                                <label class="lb"><i class="fa fa-times-circle text-danger" id="partnermaritalcross" style="display:none"></i> Marital Status <span class="text-danger">*</span></label>
                                                                <span class="iconbox">
                                                                    <select class="form-select chosen-select" name="partnermarital" id="partnermarital" required>
                                                                        <option value="">Select</option>
                                                                        <option <?php if ($rowpartnerinfo['partnermarital'] == 'Never Married') {
                                                                                    echo "selected";
                                                                                } ?>>Never Married</option>
                                                                        <option <?php if ($rowpartnerinfo['partnermarital'] == 'Divorced') {
                                                                                    echo "selected";
                                                                                } ?>>Divorced</option>
                                                                        <option <?php if ($rowpartnerinfo['partnermarital'] == 'Widowed') {
                                                                                    echo "selected";
                                                                                } ?>>Widowed</option>
                                                                        <option <?php if ($rowpartnerinfo['partnermarital'] == 'Awaiting Divorce') {
                                                                                    echo "selected";
                                                                                } ?>>Awaiting Divorce</option>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">diversity_4</span>
                                                                </span>
                                                            </div> -->


                                                            <div class="col-md-6 form-group">
                                                                <label class="lb"><i class="fa fa-times-circle text-danger" id="partnermaritalcross" style="display:none"></i> Marital Status <span class="text-danger">*</span></label>
                                                                <span class="iconbox">
                                                                    <select class="form-select chosen-select" name="partnermarital" id="partnermarital" required>
                                                                        <?php render_dropdown_options($con, 'marital_status', $rowpartnerinfo['partnermarital']); ?>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">diversity_4</span>
                                                                </span>
                                                            </div>
                                                            <!--<div class="col-md-6 form-group">
                                                                        <label class="lb">Physical Status:</label>
                                                                        <span class="iconbox">
                                                                        <select class="form-select chosen-select" name="partnerphysical">
                                                                            <option value="">Select</option>
                                                                            <option <?php if ($rowpartnerinfo['partnerphysical'] == 'Normal') {
                                                                                        echo "selected";
                                                                                    } ?>>Normal</option>
                                                                            <option <?php if ($rowpartnerinfo['partnerphysical'] == 'Handicapped by birth') {
                                                                                        echo "selected";
                                                                                    } ?>>Handicapped by birth</option>
                                                                            <option <?php if ($rowpartnerinfo['partnerphysical'] == 'Handicapped by war') {
                                                                                        echo "selected";
                                                                                    } ?>>Handicapped by war</option>
                                                                      </select>
                                                                      <span class="material-symbols-outlined icon">accessible</span>
                                                                    </span>
                                                                    </div>-->
                                                            <!-- <div class="col-md-6 form-group">
                                                                <label class="lb">Eating Habits</label>
                                                                <span class="iconbox">
                                                                    <select class="form-select chosen-select" name="partnereating">
                                                                        <option value="">Select</option>
                                                                        <option <?php if ($rowpartnerinfo['partnereating'] == 'Vegetarian') {
                                                                                    echo "selected";
                                                                                } ?>>Vegetarian</option>
                                                                        <option <?php if ($rowpartnerinfo['partnereating'] == 'Non-Vegetarian') {
                                                                                    echo "selected";
                                                                                } ?>>Non-Vegetarian</option>
                                                                        <option <?php if ($rowpartnerinfo['partnereating'] == 'Eggetarian') {
                                                                                    echo "selected";
                                                                                } ?>>Eggetarian</option>
                                                                        <otpion <?php if ($rowpartnerinfo['partnereating'] == 'Vegan') {
                                                                                    echo "selected";
                                                                                } ?>>Vegan</otpion>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">restaurant</span>
                                                                </span>
                                                            </div> -->

                                                            <div class="col-md-6 form-group">
                                                                <label class="lb">Eating Habits</label>
                                                                <span class="iconbox">
                                                                    <select class="form-select chosen-select" name="partnereating">
                                                                        <?php render_dropdown_options($con, 'eating_habits', $rowpartnerinfo['partnereating']); ?>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">restaurant</span>
                                                                </span>
                                                            </div>


                                                            <div class="col-md-6 form-group">
                                                                <label class="lb">Drinking Habits</label>
                                                                <span class="iconbox">
                                                                    <select class="form-select chosen-select" name="partnerdrinking">
                                                                        <option value="">Select</option>
                                                                        <option <?php if ($rowpartnerinfo['partnerdrinking'] == 'Non-drinker') {
                                                                                    echo "selected";
                                                                                } ?>>Non-drinker</option>
                                                                        <option <?php if ($rowpartnerinfo['partnerdrinking'] == 'Light / Social drinker') {
                                                                                    echo "selected";
                                                                                } ?>>Light / Social drinker</option>
                                                                        <option <?php if ($rowpartnerinfo['partnerdrinking'] == 'Regular drinker') {
                                                                                    echo "selected";
                                                                                } ?>>Regular drinker</option>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">liquor</span>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label class="lb">Smoking Habits</label>
                                                                <span class="iconbox">
                                                                    <select class="form-select chosen-select" name="partnersmoking">
                                                                        <option value="">Select</option>
                                                                        <option <?php if ($rowpartnerinfo['partnersmoking'] == 'Non-smoker') {
                                                                                    echo "selected";
                                                                                } ?>>Non-smoker</option>
                                                                        <option <?php if ($rowpartnerinfo['partnersmoking'] == 'Light / Social smoker') {
                                                                                    echo "selected";
                                                                                } ?>>Light / Social smoker</option>
                                                                        <option <?php if ($rowpartnerinfo['partnersmoking'] == 'Regular Smoker') {
                                                                                    echo "selected";
                                                                                } ?>>Regular Smoker</option>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">smoking_rooms</span>
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <div class="row p-4 pb-0">
                                                            <div class="form-tit p-2">
                                                                <h6 class="mb-1">Astro Preference</h6>
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label class="lb">Dosh/Dosham</label>
                                                                <span class="iconbox">
                                                                    <select class="form-select chosen-select" name="partnermanglik">
                                                                        <option value="">Select</option>
                                                                        <option <?php if ($rowpartnerinfo['partnermanglik'] == 'Yes') {
                                                                                    echo "selected";
                                                                                } ?>>Yes</option>
                                                                        <option <?php if ($rowpartnerinfo['partnermanglik'] == 'No') {
                                                                                    echo "selected";
                                                                                } ?>>No</option>
                                                                        <option <?php if ($rowpartnerinfo['partnermanglik'] == 'Dont Know') {
                                                                                    echo "selected";
                                                                                } ?>>Dont Know</option>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">error</span>
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <div class="row p-4 pb-0">
                                                            <div class="form-tit p-2">
                                                                <h6 class="mb-1">Religious Preference</h6>
                                                            </div>
                                                            <div class="col-md-12 form-group">
                                                                <label class="lb"><i class="fa fa-times-circle text-danger" id="partnerreligioncross" style="display:none"></i> Religion <span class="text-danger">*</span></label>
                                                                <span class="iconbox">
                                                                    <?php
                                                                    $partnerreligion = explode("//", $rowpartnerinfo['partnerreligion']);
                                                                    ?>
                                                                    <select class="form-select chosen-select" id="partnerreligion" name="partnerreligion[]" multiple required>
                                                                        <option value="">Select</option>
                                                                        <?php
                                                                        $sqlreligion1 = "select distinct(religion) from religion_caste";
                                                                        $resultreligion1 = mysqli_query($con, $sqlreligion1);
                                                                        while ($rowreligion1 = mysqli_fetch_assoc($resultreligion1)) {
                                                                        ?>
                                                                            <option <?php if (in_array($rowreligion1['religion'], $partnerreligion)) {
                                                                                        echo "selected";
                                                                                    } ?> value="<?php echo $rowreligion1['religion']; ?>"><?php echo $rowreligion1['religion']; ?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">temple_hindu</span>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-12 form-group">
                                                                <label class="lb"><i class="fa fa-times-circle text-danger" id="partnercastecross" style="display:none"></i> Caste <span class="text-danger">*</span></label>
                                                                <span class="iconbox">
                                                                    <?php
                                                                    $partnercaste = explode("//", $rowpartnerinfo['partnercaste']);
                                                                    ?>
                                                                    <select class="form-select chosen-select" name="caste[]" id="partnercaste" multiple required>
                                                                        <option value="">Select</option>
                                                                        <?php
                                                                        $sqlgetpartnercaste = "select * from religion_caste";
                                                                        $resultgetpartnercaste = mysqli_query($con, $sqlgetpartnercaste);
                                                                        while ($rowgetpartnercaste = mysqli_fetch_assoc($resultgetpartnercaste)) {
                                                                        ?>
                                                                            <option <?php if (in_array($rowgetpartnercaste['caste'], $partnercaste)) {
                                                                                        echo "selected";
                                                                                    } ?>><?php echo $rowgetpartnercaste['caste']; ?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">reduce_capacity</span>
                                                                </span>
                                                                <div class="form-group form-check">
                                                                    <label class="form-check-label">
                                                                        <input class="form-check-input" type="checkbox" name="castebar" value="yes" <?php if ($rowpartnerinfo['castebar'] == 'yes') {
                                                                                                                                                        echo "checked";
                                                                                                                                                    } ?>> Caste No Bar
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <!--<div class="col-md-6 form-group">
                                                                        <label class="lb">Gothram:</label>
                                                                        <span class="iconbox">
                                                                        <input type="text" class="form-control leftspace" placeholder="Enter Details" name="partnergothram" value="<?php echo $rowpartnerinfo['partnergothram']; ?>">
                                                                        <i class="fa fa-edit icon"></i>
                                                                    </span>
                                                                    </div>-->
                                                        </div>

                                                        <div class="row p-4 pb-0">
                                                            <div class="form-tit p-2">
                                                                <h6 class="mb-1">Education & Career Preference</h6>
                                                            </div>
                                                            <!-- <div class="col-md-12 form-group">
                                                                <label class="lb"><i class="fa fa-times-circle text-danger" id="partnerstreamcross" style="display:none"></i> Stream <span class="text-danger">*</span></label>
                                                                <span class="iconbox">
                                                                    <?php
                                                                    $partnerstream = explode("//", $rowpartnerinfo['partnerstream']);
                                                                    ?>
                                                                    <select class="form-select chosen-select" id="partnerstream" name="partnerstream[]" multiple required>
                                                                        <option value="">Select</option>
                                                                        <?php
                                                                        $sqlstream = "select distinct(stream) from stream_education";
                                                                        $resultstream = mysqli_query($con, $sqlstream);
                                                                        while ($rowstream = mysqli_fetch_assoc($resultstream)) {
                                                                        ?>
                                                                            <option <?php if (in_array($rowstream['stream'], $partnerstream)) {
                                                                                        echo "selected";
                                                                                    } ?>><?php echo $rowstream['stream']; ?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">menu_book</span>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-12 form-group">
                                                                <label class="lb">Education/Qualification </label>
                                                                <span class="iconbox">
                                                                    <?php
                                                                    $partnereducation = explode("//", $rowpartnerinfo['partnereducation']);
                                                                    ?>
                                                                    <select class="form-select chosen-select" name="education[]" id="partnereducation" multiple>
                                                                        <option value="">Select</option>
                                                                        <?php
                                                                        $sqlgetpartnereducation = "select distinct(education) from stream_education";
                                                                        $resultgetpartnereducation = mysqli_query($con, $sqlgetpartnereducation);
                                                                        while ($rowgetpartnereducation = mysqli_fetch_assoc($resultgetpartnereducation)) {
                                                                        ?>
                                                                            <option <?php if (in_array($rowgetpartnereducation['education'], $partnereducation)) {
                                                                                        echo "selected";
                                                                                    } ?>><?php echo $rowgetpartnereducation['education']; ?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">school</span>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-12 form-group">
                                                                <label class="lb"><i class="fa fa-times-circle text-danger" id="partnerprofessioncross" style="display:none"></i> Working With <span class="text-danger">*</span></label>
                                                                <span class="iconbox">
                                                                    <?php
                                                                    $partnerprofession = explode("//", $rowpartnerinfo['partnerprofession']);
                                                                    ?>
                                                                    <select class="form-select chosen-select" name="partnerprofession[]" id="partnerprofession" multiple required>
                                                                        <option value="">Select</option>
                                                                        <option <?php if (in_array('Private Company/Corporate', $partnerprofession)) {
                                                                                    echo "selected";
                                                                                } ?>>Private Company/Corporate</option>
                                                                        <option <?php if (in_array('Government/Public Sector', $partnerprofession)) {
                                                                                    echo "selected";
                                                                                } ?>>Government/Public Sector</option>
                                                                        <option <?php if (in_array('Defence Services', $partnerprofession)) {
                                                                                    echo "selected";
                                                                                } ?>>Defence Services</option>
                                                                        <option <?php if (in_array('Civil Services', $partnerprofession)) {
                                                                                    echo "selected";
                                                                                } ?>>Civil Services</option>
                                                                        <option <?php if (in_array('Business/Self Employed', $partnerprofession)) {
                                                                                    echo "selected";
                                                                                } ?>>Business/Self Employed</option>
                                                                        <option <?php if (in_array('Not Working', $partnerprofession)) {
                                                                                    echo "selected";
                                                                                } ?>>Not Working</option>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">work</span>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-12 form-group">
                                                                <label class="lb"><i class="fa fa-times-circle text-danger" id="professioncross" style="display:none"></i>Profession </label>
                                                                <span class="iconbox">
                                                                    <?php
                                                                    $partnerdomain = explode("//", $rowpartnerinfo['partnerdomain']);
                                                                    ?>
                                                                    <select class="form-select chosen-select" id="partnerdomain" name="partnerdomain[]" multiple>
                                                                        <option value="">Select</option>
                                                                        <?php
                                                                        $sqldomain = "select distinct(domain) from domain_designation";
                                                                        $resultdomain = mysqli_query($con, $sqldomain);
                                                                        while ($rowdomain = mysqli_fetch_assoc($resultdomain)) {
                                                                        ?>
                                                                            <option <?php if (in_array($rowdomain['domain'], $partnerdomain)) {
                                                                                        echo "selected";
                                                                                    } ?>><?php echo $rowdomain['domain']; ?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">account_circle</span>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label class="lb"><i class="fa fa-times-circle text-danger" id="partnerincomecross" style="display:none"></i> Annual Income <span class="text-danger">*</span></label>
                                                                <span class="iconbox">
                                                                    <select class="form-select chosen-select" name="partnerincome" id="partnerincome" required>
                                                                        <option value="">Select</option>
                                                                        <option <?php if ($rowpartnerinfo['partnerincome'] == 'Upto 1 Lakhs') {
                                                                                    echo "selected";
                                                                                } ?>>Upto 1 Lakhs</option>
                                                                        <option <?php if ($rowpartnerinfo['partnerincome'] == '1 Lakhs - 2 Lakhs') {
                                                                                    echo "selected";
                                                                                } ?>>1 Lakhs - 2 Lakhs</option>
                                                                        <option <?php if ($rowpartnerinfo['partnerincome'] == '2 Lakhs - 5 Lakhs') {
                                                                                    echo "selected";
                                                                                } ?>>2 Lakhs - 5 Lakhs</option>
                                                                        <option <?php if ($rowpartnerinfo['partnerincome'] == '5 Lakhs - 7 Lakhs') {
                                                                                    echo "selected";
                                                                                } ?>>5 Lakhs - 7 Lakhs</option>
                                                                        <option <?php if ($rowpartnerinfo['partnerincome'] == '7 Lakhs - 10 Lakhs') {
                                                                                    echo "selected";
                                                                                } ?>>7 Lakhs - 10 Lakhs</option>
                                                                        <option <?php if ($rowpartnerinfo['partnerincome'] == '10 Lakhs - 15 Lakhs') {
                                                                                    echo "selected";
                                                                                } ?>>10 Lakhs - 15 Lakhs</option>
                                                                        <option <?php if ($rowpartnerinfo['partnerincome'] == '15 Lakhs - 20 Lakhs') {
                                                                                    echo "selected";
                                                                                } ?>>15 Lakhs - 20 Lakhs</option>
                                                                        <option <?php if ($rowpartnerinfo['partnerincome'] == '20 Lakhs - 25 Lakhs') {
                                                                                    echo "selected";
                                                                                } ?>>20 Lakhs - 25 Lakhs</option>
                                                                        <option <?php if ($rowpartnerinfo['partnerincome'] == '25 Lakhs - 30 Lakhs') {
                                                                                    echo "selected";
                                                                                } ?>>25 Lakhs - 30 Lakhs</option>
                                                                        <option <?php if ($rowpartnerinfo['partnerincome'] == '30 Lakhs - 50 Lakhs') {
                                                                                    echo "selected";
                                                                                } ?>>30 Lakhs - 50 Lakhs</option>
                                                                        <option <?php if ($rowpartnerinfo['partnerincome'] == '50 Lakhs - 75 Lakhs') {
                                                                                    echo "selected";
                                                                                } ?>>50 Lakhs - 75 Lakhs</option>
                                                                        <option <?php if ($rowpartnerinfo['partnerincome'] == '75 Lakhs - 1 Crore') {
                                                                                    echo "selected";
                                                                                } ?>>75 Lakhs - 1 Crore</option>
                                                                        <option <?php if ($rowpartnerinfo['partnerincome'] == '1 Crore and Above') {
                                                                                    echo "selected";
                                                                                } ?>>1 Crore and Above</option>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">currency_rupee</span>
                                                                </span>
                                                            </div> -->

                                                            <div class="col-md-12 form-group">
                                                                <label class="lb"><i class="fa fa-times-circle text-danger" id="partnerstreamcross" style="display:none"></i> Stream <span class="text-danger">*</span></label>
                                                                <span class="iconbox">
                                                                    <?php
                                                                    $partnerstream = [];
                                                                    if (!empty($rowpartnerinfo['partnerstream'])) {
                                                                        $partnerstream = explode("//", $rowpartnerinfo['partnerstream']);
                                                                    }
                                                                    ?>
                                                                    <select class="form-select chosen-select" id="partnerstream" name="partnerstream[]" multiple required>
                                                                        <option value="">Select</option>
                                                                        <?php
                                                                        $sqlstream = "select distinct(stream) from stream_education";
                                                                        $resultstream = mysqli_query($con, $sqlstream);
                                                                        while ($rowstream = mysqli_fetch_assoc($resultstream)) {
                                                                        ?>
                                                                            <option <?php if (in_array($rowstream['stream'], $partnerstream)) {
                                                                                        echo "selected";
                                                                                    } ?>><?php echo $rowstream['stream']; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">menu_book</span>
                                                                </span>
                                                            </div>

                                                            <div class="col-md-12 form-group">
                                                                <label class="lb">Education/Qualification </label>
                                                                <span class="iconbox">
                                                                    <?php
                                                                    $partnereducation = [];
                                                                    if (!empty($rowpartnerinfo['partnereducation'])) {
                                                                        $partnereducation = explode("//", $rowpartnerinfo['partnereducation']);
                                                                    }
                                                                    ?>
                                                                    <select class="form-select chosen-select" name="education[]" id="partnereducation" multiple>
                                                                        <option value="">Select</option>
                                                                        <?php
                                                                        $sqlgetpartnereducation = "select distinct(education) from stream_education";
                                                                        $resultgetpartnereducation = mysqli_query($con, $sqlgetpartnereducation);
                                                                        while ($rowgetpartnereducation = mysqli_fetch_assoc($resultgetpartnereducation)) {
                                                                        ?>
                                                                            <option <?php if (in_array($rowgetpartnereducation['education'], $partnereducation)) {
                                                                                        echo "selected";
                                                                                    } ?>><?php echo $rowgetpartnereducation['education']; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">school</span>
                                                                </span>
                                                            </div>

                                                            <div class="col-md-12 form-group">
                                                                <label class="lb"><i class="fa fa-times-circle text-danger" id="partnerprofessioncross" style="display:none"></i> Working With <span class="text-danger">*</span></label>
                                                                <span class="iconbox">
                                                                    <?php
                                                                    $partnerprofession = [];
                                                                    if (!empty($rowpartnerinfo['partnerprofession'])) {
                                                                        $partnerprofession = explode("//", $rowpartnerinfo['partnerprofession']);
                                                                    }
                                                                    ?>
                                                                    <select class="form-select chosen-select" name="partnerprofession[]" id="partnerprofession" multiple required>
                                                                        <?php render_multiselect_options($con, 'working_with', $partnerprofession); ?>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">work</span>
                                                                </span>
                                                            </div>

                                                            <div class="col-md-12 form-group">
                                                                <label class="lb"><i class="fa fa-times-circle text-danger" id="professioncross" style="display:none"></i>Profession </label>
                                                                <span class="iconbox">
                                                                    <?php
                                                                    $partnerdomain = [];
                                                                    if (!empty($rowpartnerinfo['partnerdomain'])) {
                                                                        $partnerdomain = explode("//", $rowpartnerinfo['partnerdomain']);
                                                                    }
                                                                    ?>
                                                                    <select class="form-select chosen-select" id="partnerdomain" name="partnerdomain[]" multiple>
                                                                        <option value="">Select</option>
                                                                        <?php
                                                                        $sqldomain = "select distinct(domain) from domain_designation";
                                                                        $resultdomain = mysqli_query($con, $sqldomain);
                                                                        while ($rowdomain = mysqli_fetch_assoc($resultdomain)) {
                                                                        ?>
                                                                            <option <?php if (in_array($rowdomain['domain'], $partnerdomain)) {
                                                                                        echo "selected";
                                                                                    } ?>><?php echo $rowdomain['domain']; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">account_circle</span>
                                                                </span>
                                                            </div>

                                                            <div class="col-md-6 form-group">
                                                                <label class="lb"><i class="fa fa-times-circle text-danger" id="partnerincomecross" style="display:none"></i> Annual Income <span class="text-danger">*</span></label>
                                                                <span class="iconbox">
                                                                    <select class="form-select chosen-select" name="partnerincome" id="partnerincome" required>
                                                                        <?php render_dropdown_options($con, 'annual_income', $rowpartnerinfo['partnerincome']); ?>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">currency_rupee</span>
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <div class="row p-4 pb-0">
                                                            <div class="form-tit p-2">
                                                                <h6 class="mb-1">Location Preference</h6>
                                                            </div>
                                                            <div class="col-md-12 form-group">
                                                                <label class="lb"><i class="fa fa-times-circle text-danger" id="partnercountrycross" style="display:none"></i> Country <span class="text-danger">*</span></label>
                                                                <span class="iconbox">
                                                                    <?php
                                                                    $partnercountry = explode("//", $rowpartnerinfo['partnercountry']);
                                                                    ?>
                                                                    <select class="form-select chosen-select" name="partnercountry[]" id="partnercountry" multiple required>
                                                                        <option value="">Select</option>
                                                                        <?php
                                                                        $sqlcountry = "select * from countries";
                                                                        $resultcountry = mysqli_query($con, $sqlcountry);
                                                                        while ($rowcountry = mysqli_fetch_assoc($resultcountry)) {
                                                                        ?>
                                                                            <option <?php if (in_array($rowcountry['country'], $partnercountry)) {
                                                                                        echo "selected";
                                                                                    } ?>><?php echo $rowcountry['country']; ?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">globe</span>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-12 form-group">
                                                                <label class="lb"><i class="fa fa-times-circle text-danger" id="partnerstatecross" style="display:none"></i> State <span class="text-danger">*</span></label>
                                                                <span class="iconbox">
                                                                    <?php
                                                                    $partnerstate = explode("//", $rowpartnerinfo['partnerstate']);
                                                                    ?>
                                                                    <select class="form-select chosen-select" id="partnerstate" name="partnerstate[]" multiple required>
                                                                        <option value="">Select</option>
                                                                        <?php
                                                                        $sqlstate = "select distinct(state) from city_state";
                                                                        $resultstate = mysqli_query($con, $sqlstate);
                                                                        while ($rowstate = mysqli_fetch_assoc($resultstate)) {
                                                                        ?>
                                                                            <option <?php if (in_array($rowstate['state'], str_replace("-", " ", $partnerstate))) {
                                                                                        echo "selected";
                                                                                    } ?>><?php echo $rowstate['state']; ?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">map</span>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-12 form-group" id="partnercity">
                                                                <label class="lb">City:</label>
                                                                <span class="iconbox">
                                                                    <?php
                                                                    $partnercity = explode("//", $rowpartnerinfo['partnercity']);
                                                                    ?>
                                                                    <select class="form-select chosen-select" name="city[]" multiple>
                                                                        <?php
                                                                        $sqlgetpartnercity = "select * from city_state";
                                                                        $resultgetpartnercity = mysqli_query($con, $sqlgetpartnercity);
                                                                        while ($rowgetpartnercity = mysqli_fetch_assoc($resultgetpartnercity)) {
                                                                        ?>
                                                                            <option <?php if (in_array($rowgetpartnercity['city'], $partnercity)) {
                                                                                        echo "selected";
                                                                                    } ?>><?php echo $rowgetpartnercity['city']; ?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">location_on</span>
                                                                </span>
                                                            </div>
                                                            <p class="text-white mt-4 notebox"><b>Note:</b> User details have been used to auto-fill all mandatory fields.</p>
                                                        </div>
                                                    </div>
                                                    <!--END PROFILE BIO-->
                                                    <button type="submit" id="partnerupdatebtn" class="btn btn-primary profile-btn">Update</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div id="contacttab" class=" tab-pane fade p-0">
                                            <div class="form-login">
                                                <form action="profile-contact.php" method="post">
                                                    <!--PROFILE BIO-->
                                                    <div class="edit-pro-parti">
                                                        <div class="form-tit p-3 tophead">
                                                            <h1 class="text-white">Contact Details</h1>
                                                            <p class="m-0 text-white">'<span class="text-info">*</span>' Required fields</p>
                                                            <a href="user-profile.php" class="sett-edit-btn sett-acc-edit-eve"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
                                                        </div>
                                                        <?php
                                                        if ($_GET['contact_update'] == 'yes') {
                                                        ?>
                                                            <p class="text-center text-success" id="invalidpop"><b>Your profile has been successfully updated</b></p>
                                                        <?php
                                                        }
                                                        ?>
                                                        <div class="row p-4">
                                                            <?php
                                                            $sqlcontactinfo = "select * from contact_info where userid = '$userid'";
                                                            $resultcontactinfo = mysqli_query($con, $sqlcontactinfo);
                                                            $rowcontactinfo = mysqli_fetch_assoc($resultcontactinfo);
                                                            ?>
                                                            <div class="col-md-6 form-group">
                                                                <label class="lb">Phone Number <span class="text-danger">*</span></label>
                                                                <span class="iconbox">
                                                                    <input type="text" class="form-control leftspace" placeholder="Enter Phone Number" name="phonenumber" value="<?php echo $_COOKIE['dr_phone']; ?>" readonly>
                                                                    <i class="fa fa-phone icon"></i>
                                                                    <i class="fa fa-check-circle iconright text-success"></i>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label class="lb">Email <span class="text-danger">*</span></label>
                                                                <span class="iconbox">
                                                                    <input type="text" class="form-control leftspace" placeholder="Enter Email" name="email" value="<?php echo $_COOKIE['dr_email']; ?>" readonly>
                                                                    <i class="fa fa-envelope icon"></i>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label class="lb">Name of Contact Person</label>
                                                                <span class="iconbox">
                                                                    <input type="text" class="form-control leftspace" placeholder="Enter Details" name="contactperson" value="<?php echo $rowcontactinfo['contactperson']; ?>">
                                                                    <span class="material-symbols-outlined icon">person</span>
                                                                </span>
                                                            </div>
                                                            <!-- <div class="col-md-6 form-group">
                                                                <label class="lb">Relationship with the member </label>
                                                                <span class="iconbox">
                                                                    <select class="form-select chosen-select" name="relationship">
                                                                        <option value="">Select</option>
                                                                        <option <?php if ($rowcontactinfo['relationship'] == 'Son') {
                                                                                    echo "selected";
                                                                                } ?>>Son</option>
                                                                        <option <?php if ($rowcontactinfo['relationship'] == 'Daughter') {
                                                                                    echo "selected";
                                                                                } ?>>Daughter</option>
                                                                        <option <?php if ($rowcontactinfo['relationship'] == 'Brother') {
                                                                                    echo "selected";
                                                                                } ?>>Brother</option>
                                                                        <option <?php if ($rowcontactinfo['relationship'] == 'Sister') {
                                                                                    echo "selected";
                                                                                } ?>>Sister</option>
                                                                        <option <?php if ($rowcontactinfo['relationship'] == 'Friends') {
                                                                                    echo "selected";
                                                                                } ?>>Friends</option>
                                                                        <option <?php if ($rowcontactinfo['relationship'] == 'Relative') {
                                                                                    echo "selected";
                                                                                } ?>>Relative</option>
                                                                        <option <?php if ($rowcontactinfo['relationship'] == 'Others') {
                                                                                    echo "selected";
                                                                                } ?>>Others</option>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">partner_exchange</span>
                                                                </span>
                                                            </div> -->
                                                            <div class="col-md-6 form-group">
                                                                <label class="lb">Relationship with the member </label>
                                                                <span class="iconbox">
                                                                    <select class="form-select chosen-select" name="relationship">
                                                                        <?php render_dropdown_options($con, 'relationship', $rowcontactinfo['relationship']); ?>
                                                                    </select>
                                                                    <span class="material-symbols-outlined icon">partner_exchange</span>
                                                                </span>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <!--END PROFILE BIO-->
                                                    <button type="submit" class="btn btn-primary profile-btn">Update</button>
                                                </form>
                                            </div>
                                        </div>
<div id="photostab" class=" tab-pane fade p-0">
    <div class="form-login">
        
        <?php
        if(isset($rowformfill['photos_approval_status']) && $rowformfill['photos_approval_status'] == 'Pending') {
        ?>
            <div class="alert alert-warning text-center m-3" style="border: 1px solid #ffc107; background: #fff3cd; color: #856404; padding: 15px; border-radius: 5px;">
                <i class="fa fa-image"></i> 
                <b>Photos Under Review:</b> You have uploaded new photos. 
                These are currently pending Admin Approval. Your live profile will continue to show your old photos until the new ones are approved.
            </div>
        <?php } ?>
        <form action="profile-photos.php" method="post" enctype="multipart/form-data">
            <div class="edit-pro-parti">
                <div class="form-tit p-3 tophead">
                    <h1 class="text-white">Manage Photos</h1>
                    <p class="m-0 text-white">'<span class="text-info">*</span>' Required fields</p>
                    <a href="user-profile.php" class="sett-edit-btn sett-acc-edit-eve"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
                </div>
                
                <?php
                if (isset($_GET['photos_update'])) {
                    if($_GET['photos_update'] == 'yes') { 
                ?>
                    <p class="text-center text-success" id="invalidpop"><b>Your profile has been successfully updated</b></p>
                <?php 
                    } elseif($_GET['photos_update'] == 'pending') { 
                ?>
                     <p class="text-center text-warning" id="invalidpop"><b>Photos submitted for approval</b></p>
                <?php 
                    } 
                } 
                ?>
                
                <?php
                if ($rowformfill['verificationinfo'] == '0') {
                ?>
                    <p class="text-center text-danger blinking-text"><b>Under review and will be live shortly</b></p>
                <?php
                }
                ?>
                <div class="row p-4">
    <?php
    // Fetch Live Data
    $sqlphotosinfo = "select * from photos_info where userid = '$userid'";
    $resultphotosinfo = mysqli_query($con, $sqlphotosinfo);
    $rowphotosinfo = mysqli_fetch_assoc($resultphotosinfo);
    ?>

    <div class="col-md-3 form-group">
        <label class="lb">Profile Picture <span class="text-danger">*</span></label>
        
        <div class="picborder">
            <?php if ($rowphotosinfo['profilepic'] != '') { ?>
                <img src="userphoto/<?php echo $rowphotosinfo['profilepic']; ?>" class="managephoto" id="preview1">
            <?php } else { ?>
                <img id="preview1" class="managephoto">
                <div id="placeholder1">
                    <span class="material-symbols-outlined" id="addicon1">add_photo_alternate</span>
                    <p class="m-0" id="addbtn1">Add Photo</p>
                </div>
            <?php } ?>
        </div>

        <div class="mt-2 text-center">
            <?php if ($rowphotosinfo['profilepic'] != '') { ?>
                <?php if ($rowformfill['verificationinfo'] == '1') { ?>
                    <a href="delete-managephoto.php?uid=<?php echo $userid; ?>&coloum=profilepic" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');">Delete</a>
                <?php } ?>
                
                <label for="addphoto1input" class="btn btn-primary btn-sm mb-0" style="cursor: pointer;">
                    <i class="fa fa-pencil"></i> Change
                </label>
                
                <input type="hidden" name="oldprofilepic" value="<?php echo $rowphotosinfo['profilepic']; ?>">
            <?php } else { ?>
                <label for="addphoto1input" class="btn btn-success btn-sm" style="cursor: pointer;">Select Photo</label>
            <?php } ?>
        </div>

        <input type="file" class="form-control" id="addphoto1input" name="profilepic" style="display:none;" onchange="previewImage1(event)" accept="image/png, image/jpg, image/jpeg">
    </div>


    <div class="col-md-3 form-group">
        <label class="lb">Picture 1</label>
        
        <div class="picborder">
            <?php if ($rowphotosinfo['photo1'] != '') { ?>
                <img src="userphoto/<?php echo $rowphotosinfo['photo1']; ?>" class="managephoto" id="preview2">
            <?php } else { ?>
                <img id="preview2" class="managephoto">
                <div id="placeholder2">
                    <span class="material-symbols-outlined">add_photo_alternate</span>
                    <p class="m-0">Add Photo</p>
                </div>
            <?php } ?>
        </div>

        <div class="mt-2 text-center">
            <?php if ($rowphotosinfo['photo1'] != '') { ?>
                <?php if ($rowformfill['verificationinfo'] == '1') { ?>
                    <a href="delete-managephoto.php?uid=<?php echo $userid; ?>&coloum=photo1" class="btn btn-danger btn-sm">Delete</a>
                <?php } ?>
                
                <label for="addphoto2input" class="btn btn-primary btn-sm mb-0" style="cursor: pointer;">
                    <i class="fa fa-pencil"></i> Change
                </label>

                <input type="hidden" name="oldphoto1" value="<?php echo $rowphotosinfo['photo1']; ?>">
            <?php } else { ?>
                <label for="addphoto2input" class="btn btn-success btn-sm" style="cursor: pointer;">Select Photo</label>
            <?php } ?>
        </div>

        <input type="file" class="form-control" id="addphoto2input" name="photo1" style="display:none;" onchange="previewImage2(event)" accept="image/png, image/jpg, image/jpeg">
    </div>


    <div class="col-md-3 form-group">
        <label class="lb">Picture 2</label>
        <div class="picborder">
            <?php if ($rowphotosinfo['photo2'] != '') { ?>
                <img src="userphoto/<?php echo $rowphotosinfo['photo2']; ?>" class="managephoto" id="preview3">
            <?php } else { ?>
                <img id="preview3" class="managephoto">
                <div id="placeholder3">
                    <span class="material-symbols-outlined">add_photo_alternate</span>
                    <p class="m-0">Add Photo</p>
                </div>
            <?php } ?>
        </div>
        <div class="mt-2 text-center">
            <?php if ($rowphotosinfo['photo2'] != '') { ?>
                <?php if ($rowformfill['verificationinfo'] == '1') { ?>
                    <a href="delete-managephoto.php?uid=<?php echo $userid; ?>&coloum=photo2" class="btn btn-danger btn-sm">Delete</a>
                <?php } ?>
                <label for="addphoto3input" class="btn btn-primary btn-sm mb-0" style="cursor: pointer;">Change</label>
                <input type="hidden" name="oldphoto2" value="<?php echo $rowphotosinfo['photo2']; ?>">
            <?php } else { ?>
                <label for="addphoto3input" class="btn btn-success btn-sm" style="cursor: pointer;">Select Photo</label>
            <?php } ?>
        </div>
        <input type="file" class="form-control" id="addphoto3input" name="photo2" style="display:none;" onchange="previewImage3(event)" accept="image/png, image/jpg, image/jpeg">
    </div>


    <div class="col-md-3 form-group">
        <label class="lb">Picture 3</label>
        <div class="picborder">
            <?php if ($rowphotosinfo['photo3'] != '') { ?>
                <img src="userphoto/<?php echo $rowphotosinfo['photo3']; ?>" class="managephoto" id="preview4">
            <?php } else { ?>
                <img id="preview4" class="managephoto">
                <div id="placeholder4">
                    <span class="material-symbols-outlined">add_photo_alternate</span>
                    <p class="m-0">Add Photo</p>
                </div>
            <?php } ?>
        </div>
        <div class="mt-2 text-center">
            <?php if ($rowphotosinfo['photo3'] != '') { ?>
                <?php if ($rowformfill['verificationinfo'] == '1') { ?>
                    <a href="delete-managephoto.php?uid=<?php echo $userid; ?>&coloum=photo3" class="btn btn-danger btn-sm">Delete</a>
                <?php } ?>
                <label for="addphoto4input" class="btn btn-primary btn-sm mb-0" style="cursor: pointer;">Change</label>
                <input type="hidden" name="oldphoto3" value="<?php echo $rowphotosinfo['photo3']; ?>">
            <?php } else { ?>
                <label for="addphoto4input" class="btn btn-success btn-sm" style="cursor: pointer;">Select Photo</label>
            <?php } ?>
        </div>
        <input type="file" class="form-control" id="addphoto4input" name="photo3" style="display:none;" onchange="previewImage4(event)" accept="image/png, image/jpg, image/jpeg">
    </div>

</div>

<div class="row">
    <div class="col-md-12 form-group">
        <p class="mt-4 m-0"><span class="text-danger">Supports:</span> PNG, JPG and JPEG</p>
        <p class="text-white mt-0 notebox"><b>Note:</b> Photos will be reviewed before going live.</p>
    </div>
</div>
                <!-- <div class="row p-4">
                    <?php
                    // Fetch Live Data for Display (User sees what is currently live)
                    $sqlphotosinfo = "select * from photos_info where userid = '$userid'";
                    $resultphotosinfo = mysqli_query($con, $sqlphotosinfo);
                    $rowphotosinfo = mysqli_fetch_assoc($resultphotosinfo);
                    ?>
                    
                    <div class="col-md-3 form-group">
                        <?php if ($rowphotosinfo['profilepic'] != '') { ?>
                            <label class="lb">Profile Picture <span class="text-danger">*</span></label>
                            <div class="picborder">
                                <img src="userphoto/<?php echo $rowphotosinfo['profilepic']; ?>" class="managephoto">
                            </div>
                            <div>
                                <?php if ($rowformfill['verificationinfo'] == '1') { ?>
                                    <a href="delete-managephoto.php?uid=<?php echo $userid; ?>&coloum=profilepic" class="btn btn-success">Delete</a>
                                <?php } ?>
                            </div>
                            <input type="hidden" class="form-control lh" name="oldprofilepic" value="<?php echo $rowphotosinfo['profilepic']; ?>">
                        <?php } else { ?>
                            <label class="lb">Profile Picture <span class="text-danger">*</span></label>
                            <div class="picborder" id="addphoto1">
                                <img id="preview1" class="managephoto">
                                <span class="material-symbols-outlined" id="addicon1">add_photo_alternate</span>
                                <p class="m-0" id="addbtn1">Add Photo</p>
                            </div>
                        <?php } ?>
                         <input type="file" class="form-control lh" id="addphoto1input" name="profilepic" style="display:none;" onchange="previewImage1(event)" accept="image/png, image/jpg, image/jpeg">
                    </div>

                    <div class="col-md-3 form-group">
                         <?php if ($rowphotosinfo['photo1'] != '') { ?>
                            <label class="lb">Picture 1</label>
                            <div class="picborder"><img src="userphoto/<?php echo $rowphotosinfo['photo1']; ?>" class="managephoto"></div>
                            <div>
                                <?php if ($rowformfill['verificationinfo'] == '1') { ?>
                                    <a href="delete-managephoto.php?uid=<?php echo $userid; ?>&coloum=photo1" class="btn btn-success">Delete</a>
                                <?php } ?>
                            </div>
                            <input type="hidden" class="form-control lh" name="oldphoto1" value="<?php echo $rowphotosinfo['photo1']; ?>">
                        <?php } else { ?>
                             <label class="lb">Picture 1</label>
                             <div class="picborder" id="addphoto2"><img id="preview2" class="managephoto"><span class="material-symbols-outlined" id="addicon2">add_photo_alternate</span><p class="m-0" id="addbtn2">Add Photo</p></div>
                        <?php } ?>
                        <input type="file" class="form-control lh" id="addphoto2input" name="photo1" style="display:none;" onchange="previewImage2(event)" accept="image/png, image/jpg, image/jpeg">
                    </div>

                    <div class="col-md-3 form-group">
                         <?php if ($rowphotosinfo['photo2'] != '') { ?>
                            <label class="lb">Picture 2</label>
                            <div class="picborder"><img src="userphoto/<?php echo $rowphotosinfo['photo2']; ?>" class="managephoto"></div>
                            <div>
                                <?php if ($rowformfill['verificationinfo'] == '1') { ?>
                                    <a href="delete-managephoto.php?uid=<?php echo $userid; ?>&coloum=photo2" class="btn btn-success">Delete</a>
                                <?php } ?>
                            </div>
                            <input type="hidden" class="form-control lh" name="oldphoto2" value="<?php echo $rowphotosinfo['photo2']; ?>">
                        <?php } else { ?>
                             <label class="lb">Picture 2</label>
                             <div class="picborder" id="addphoto3"><img id="preview3" class="managephoto"><span class="material-symbols-outlined" id="addicon3">add_photo_alternate</span><p class="m-0" id="addbtn3">Add Photo</p></div>
                        <?php } ?>
                        <input type="file" class="form-control lh" id="addphoto3input" name="photo2" style="display:none;" onchange="previewImage3(event)" accept="image/png, image/jpg, image/jpeg">
                    </div>

                    <div class="col-md-3 form-group">
                         <?php if ($rowphotosinfo['photo3'] != '') { ?>
                            <label class="lb">Picture 3</label>
                            <div class="picborder"><img src="userphoto/<?php echo $rowphotosinfo['photo3']; ?>" class="managephoto"></div>
                            <div>
                                <?php if ($rowformfill['verificationinfo'] == '1') { ?>
                                    <a href="delete-managephoto.php?uid=<?php echo $userid; ?>&coloum=photo3" class="btn btn-success">Delete</a>
                                <?php } ?>
                            </div>
                            <input type="hidden" class="form-control lh" name="oldphoto3" value="<?php echo $rowphotosinfo['photo3']; ?>">
                        <?php } else { ?>
                             <label class="lb">Picture 3</label>
                             <div class="picborder" id="addphoto4"><img id="preview4" class="managephoto"><span class="material-symbols-outlined" id="addicon4">add_photo_alternate</span><p class="m-0" id="addbtn4">Add Photo</p></div>
                        <?php } ?>
                        <input type="file" class="form-control lh" id="addphoto4input" name="photo3" style="display:none;" onchange="previewImage4(event)" accept="image/png, image/jpg, image/jpeg">
                    </div>

                    <div class="col-md-12 form-group">
                        <p class="mt-4 m-0"><span class="text-danger">Supports:</span> PNG, JPG and JPEG</p>
                        <p class="text-white mt-0 notebox"><b>Note:</b> Photos will be reviewed before going live.</p>
                    </div>
                </div> -->
            </div>
            <?php if ($rowformfill['verificationinfo'] == '1') { ?>
                 <button type="submit" class="btn btn-primary profile-btn">Update</button>
            <?php } ?>
        </form>
    </div>
</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END -->

<?php
include 'footer.php';
?>


<script>
    $('#basicupdatebtn').click(function() {
        var marital = $('#marital').val();
        var childrenselect = $('#childrenselect').val();
        var height = $('#height').val();
        var weight = $('#weight').val();
        var physical = $('#physical').val();
        var langauge = $('#langauge').val();
        var eating = $('#eating').val();
        var smoking = $('#smoking').val();
        var drinking = $('#drinking').val();

        if (marital == '') {
            $('#maritalcross').show();
            $("#marital_chosen").css("border-color", "#dc3545");
        } else {
            $('#maritalcross').hide();
            $("#marital_chosen").css("border-color", "#616366");
        }

        if (marital == 'Divorced' || marital == 'Widowed' || marital == 'Awaiting Divorce') {
            $("#childrenselect").attr("required", "true");
            if (childrenselect == '') {
                $('#childrencross').show();
                $("#childrenselect_chosen").css("border-color", "#dc3545");
            } else {
                $('#childrencross').hide();
                $("#childrenselect_chosen").css("border-color", "#616366");
            }
        }

        if (height == '') {
            $('#heightcross').show();
            $("#height_chosen").css("border-color", "#dc3545");
        } else {
            $('#heightcross').hide();
            $("#height_chosen").css("border-color", "#616366");
        }
        if (weight == '') {
            $('#weightcross').show();
            $("#weight_chosen").css("border-color", "#dc3545");
        } else {
            $('#weightcross').hide();
            $("#weight_chosen").css("border-color", "#616366");
        }
        if (physical == '') {
            $('#physicalcross').show();
            $("#physical_chosen").css("border-color", "#dc3545");
        } else {
            $('#physicalcross').hide();
            $("#physical_chosen").css("border-color", "#616366");
        }
        if (langauge == '') {
            $('#langaugecross').show();
            $("#langauge_chosen").css("border-color", "#dc3545");
        } else {
            $('#langaugecross').hide();
            $("#langauge_chosen").css("border-color", "#616366");
        }
        if (eating == '') {
            $('#eatingcross').show();
            $("#eating_chosen").css("border-color", "#dc3545");
        } else {
            $('#eatingcross').hide();
            $("#eating_chosen").css("border-color", "#616366");
        }
        if (smoking == '') {
            $('#smokingcross').show();
            $("#smoking_chosen").css("border-color", "#dc3545");
        } else {
            $('#smokingcross').hide();
            $("#smoking_chosen").css("border-color", "#616366");
        }
        if (drinking == '') {
            $('#drinkingcross').show();
            $("#drinking_chosen").css("border-color", "#dc3545");
        } else {
            $('#drinkingcross').hide();
            $("#drinking_chosen").css("border-color", "#616366");
        }


    });
</script>

<script>
    $('#aboutupdatebtn').click(function() {
        var aboutme = $('#aboutmecontent').val();

        if (aboutme == '') {
            $('#fewwordscross').show();
            $("#aboutmecontent").css("border-color", "#dc3545");
        } else {
            $('#fewwordscross').hide();
            $("#aboutmecontent").css("border-color", "#616366");
        }
    });
</script>

<script>
    $('#astroupdatebtn').click(function() {
        var pob = $('#pob').val();
        var tob = $('#tob').val();
        var dosh = $('#dosh').val();

        if (pob == '') {
            $('#pobcross').show();
            $("#pob").css("border-color", "#dc3545");
        } else {
            $('#pobcross').hide();
            $("#pob").css("border-color", "#616366");
        }

        if (tob == '') {
            $('#tobcross').show();
            $("#tob").css("border-color", "#dc3545");
        } else {
            $('#tobcross').hide();
            $("#tob").css("border-color", "#616366");
        }

        if (dosh == '') {
            $('#doshcross').show();
            $("#dosh_chosen").css("border-color", "#dc3545");
        } else {
            $('#doshcross').hide();
            $("#dosh_chosen").css("border-color", "#616366");
        }
    });
</script>

<script>
    $('#religiousupdatebtn').click(function() {
        var religion = $('#religion').val();
        var emptycaste = $('#emptycaste').val();
        var caste = $('#' + religion + '_dd').val();

        $('.castedd').removeAttr('required');
        $('.castedd').removeAttr('name');
        $('#' + religion + '_dd').attr('name', 'caste');
        $('#' + religion + '_dd').attr('required', 'required');

        if (religion == '') {
            $('#religioncross').show();
            $("#religion_chosen").css("border-color", "#dc3545");
        } else {
            $('#religioncross').hide();
            $("#religion_chosen").css("border-color", "#616366");
        }

        if (emptycaste == '') {
            $('#emptycastecross').show();
            $("#emptycaste_chosen").css("border-color", "#dc3545");
        } else {
            $('#emptycastecross').hide();
            $("#emptycaste_chosen").css("border-color", "#616366");
        }

        if (caste == '') {
            $('#' + religion + '_castecross').show();
            $('#' + religion + '_dd_chosen').css("border-color", "#dc3545");
        } else {
            $('#' + religion + '_castecross').hide();
            $('#' + religion + '_dd_chosen').css("border-color", "#616366");
        }
    });
</script>

<script>
    $('#educationupdatebtn').click(function() {
        var stream = $('#stream').val();
        var emptyeducation = $('#empty_education').val();
        var education = $('#' + stream + '_dd').val();
        var domain = $("#domain").val();
        var workingwith = $("#workingwith").val();
        var emptydesignation = $('#empty_designation').val();
        var designation = $('#' + domain + '_dd').val();
        var income = $('#income').val();

        $('.educationdd').removeAttr('required');
        $('.educationdd').removeAttr('name');
        $('#' + stream + '_dd').attr('name', 'education');
        $('#' + stream + '_dd').attr('required', 'required');

        $('.designationdd').removeAttr('required');
        $('.designationdd').removeAttr('name');
        $('#' + domain + '_dd').attr('name', 'designation');
        $('#' + domain + '_dd').attr('required', 'required');

        if (stream == '') {
            $('#streamcross').show();
            $("#stream_chosen").css("border-color", "#dc3545");
        } else {
            $('#streamcross').hide();
            $("#stream_chosen").css("border-color", "#616366");
        }

        if (emptyeducation == '') {
            $('#emptyeducross').show();
            $("#empty_education_chosen").css("border-color", "#dc3545");
        } else {
            $('#emptyeducross').hide();
            $("#empty_education_chosen").css("border-color", "#616366");
        }

        if (education == '') {
            $('#' + stream + '_educationcross').show();
            $('#' + stream + '_dd_chosen').css("border-color", "#dc3545");
        } else {
            $('#' + stream + '_educationcross').hide();
            $('#' + stream + '_dd_chosen').css("border-color", "#616366");
        }

        if (domain == '') {
            $('#domaincross').show();
            $("#domain_chosen").css("border-color", "#dc3545");
        } else {
            $('#domaincross').hide();
            $("#domain_chosen").css("border-color", "#616366");
        }

        if (workingwith == '') {
            $('#workingcross').show();
            $("#workingwith_chosen").css("border-color", "#dc3545");
        } else {
            $('#workingcross').hide();
            $("#workingwith_chosen").css("border-color", "#616366");
        }

        if (emptydesignation == '') {
            $('#emptydesigcross').show();
            $("#empty_designation_chosen").css("border-color", "#dc3545");
        } else {
            $('#emptydesigcross').hide();
            $("#empty_designation_chosen").css("border-color", "#616366");
        }

        if (designation == '') {
            $('#' + domain + '_designationcross').show();
            $('#' + domain + '_dd_chosen').css("border-color", "#dc3545");
        } else {
            $('#' + domain + '_designationcross').hide();
            $('#' + domain + '_dd_chosen').css("border-color", "#616366");
        }

        if (income == '') {
            $('#incomecross').show();
            $("#income_chosen").css("border-color", "#dc3545");
        } else {
            $('#incomecross').hide();
            $("#income_chosen").css("border-color", "#616366");
        }
    });
</script>

<script>
    $('#groomstate').change(function() {
        var groomstate = $("#groomstate").val();

        // --- FIX: Sabhi City Dropdowns ko Khali (Reset) karein ---
        $(".gcity").val("").trigger("chosen:updated");
        // --------------------------------------------------------

        // Sabhi cities se 'required' hata dein taaki hidden fields error na dein
        $(".gcity").prop("required", false);

        if (groomstate == '') {
            $(".groomcities").hide();
            $("#emptygroomcities").show();
        } else {
            $(".groomcities").hide();
            $("#emptygroomcities").hide();

            // Jo State select hua hai, uska City div dikhayein
            $("#groom_" + groomstate).show();

            // Sirf current visible city dropdown ko 'required' karein
            $("#groomcity_" + groomstate).prop("required", true);
        }
    });
</script>

<script>
    $('#groomupdatebtn').click(function() {
        var groomcountry = $('#groomcountry').val();
        var groomstate = $('#groomstate').val();
        var groomcity = $('#groomcity').val();
        var selectcity = $("#groomcity_" + groomstate).val();

        if (groomcountry == '') {
            $('#groomcountrycross').show();
            $("#groomcountry_chosen").css("border-color", "#dc3545");
        } else {
            $('#groomcountrycross').hide();
            $("#groomcountry_chosen").css("border-color", "#616366");
        }

        if (groomstate == '') {
            $('#groomstatecross').show();
            $('#groomstate_chosen').css("border-color", "#dc3545");
        } else {
            $('#groomstatecross').hide();
            $('#groomstate_chosen').css("border-color", "#616366");
        }

        if (groomcity == '') {
            $('.groomcitycross').show();
            $('#groomcity_chosen').css("border-color", "#dc3545");
        } else {
            $('.groomcitycross').hide();
            $('#groomcity_' + groomstate + '_chosen').css("border-color", "#616366");
        }
        if (selectcity == '') {
            $('.groomcitycross-s').show();
            $('#groomcity_' + groomstate + '_chosen').css("border-color", "#dc3545");
        } else {
            $('.groomcitycross-s').hide();
            $('#groomcity_' + groomstate + '_chosen').css("border-color", "#616366");
        }
    });
</script>

<script>
    $('#familyupdatebtn').click(function() {
        var familytype = $('#familytype').val();
        var familystatus = $('#familystatus').val();
        var familylocation = $('#familylocation').val();
        var fathername = $('#fathername').val();
        var mothername = $('#mothername').val();
        var fatheroccupation = $('#fatheroccupation').val();
        var motheroccupation = $('#motheroccupation').val();
        var diffcountry = $('#diffcountry').val();
        var diffstate = $('#familystate').val();
        var emptycity = $('#emptycity').val();
        var city = $("#gc_" + diffstate).val();


        if (familytype == '') {
            $('#ftypecross').show();
            $("#familytype_chosen").css("border-color", "#dc3545");
        } else {
            $('#ftypecross').hide();
            $("#familytype_chosen").css("border-color", "#616366");
        }

        if (familystatus == '') {
            $('#fstatuscross').show();
            $('#familystatus_chosen').css("border-color", "#dc3545");
        } else {
            $('#fstatuscross').hide();
            $('#familystatus_chosen').css("border-color", "#616366");
        }

        if (familylocation == '') {
            $('#flocationcross').show();
            $('#familylocation_chosen').css("border-color", "#dc3545");
        } else {
            $('#flocationcross').hide();
            $('#familylocation_chosen').css("border-color", "#616366");
        }
        if (fathername == '') {
            $('#fnamecross').show();
            $('#fathername').css("border-color", "#dc3545");
        } else {
            $('#fnamecross').hide();
            $('#fathername').css("border-color", "#616366");
        }
        if (mothername == '') {
            $('#mnamecross').show();
            $('#mothername').css("border-color", "#dc3545");
        } else {
            $('#mnamecross').hide();
            $('#mothername').css("border-color", "#616366");
        }
        if (fatheroccupation == '') {
            $('#focross').show();
            $('#fatheroccupation').css("border-color", "#dc3545");
        } else {
            $('#focross').hide();
            $('#fatheroccupation').css("border-color", "#616366");
        }
        if (motheroccupation == '') {
            $('#mocross').show();
            $('#motheroccupation').css("border-color", "#dc3545");
        } else {
            $('#mocross').hide();
            $('#motheroccupation').css("border-color", "#616366");
        }
        if (diffcountry == '') {
            $('#diffcountrycross').show();
            $("#diffcountry_chosen").css("border-color", "#dc3545");
        } else {
            $('#diffcountrycross').hide();
            $("#diffcountry_chosen").css("border-color", "#616366");
        }
        if (diffstate == '') {
            $('#diffstatecross').show();
            $("#familystate_chosen").css("border-color", "#dc3545");
        } else {
            $('#diffstatecross').hide();
            $("#familystate_chosen").css("border-color", "#616366");
        }
        if (emptycity == '') {
            $('#emptyfamilycitycross').show();
            $("#emptycity_chosen").css("border-color", "#dc3545");
        } else {
            $('#emptyfamilycitycross').hide();
            $("#emptycity_chosen").css("border-color", "#616366");
        }
        if (city == '') {
            $('.citycross').show();
            $("#gc_" + diffstate + "_chosen").css("border-color", "#dc3545");
        } else {
            $('.citycross').hide();
            $("#gc_" + diffstate + "_chosen").css("border-color", "#616366");
        }
    });
</script>

<script>
    $(document).ready(function() {
        $('#marital').change(function() {
            $('#maritalcross').hide();
            $("#marital_chosen").css("border-color", "#616366");
        });
        $('#childrenselect').change(function() {
            $('#childrencross').hide();
            $("#childrenselect_chosen").css("border-color", "#616366");
        });

        $('#height').change(function() {
            $('#heightcross').hide();
            $("#height_chosen").css("border-color", "#616366");
        });
        $('#weight').change(function() {
            $('#weightcross').hide();
            $("#weight_chosen").css("border-color", "#616366");
        });
        $('#physical').change(function() {
            $('#physicalcross').hide();
            $("#physical_chosen").css("border-color", "#616366");
        });
        $('#langauge').change(function() {
            $('#langaugecross').hide();
            $("#langauge_chosen").css("border-color", "#616366");
        });
        $('#eating').change(function() {
            $('#eatingcross').hide();
            $("#eating_chosen").css("border-color", "#616366");
        });
        $('#smoking').change(function() {
            $('#smokingcross').hide();
            $("#smoking_chosen").css("border-color", "#616366");
        });
        $('#drinking').change(function() {
            $('#drinkingcross').hide();
            $("#drinking_chosen").css("border-color", "#616366");
        });
        $('#aboutmecontent').keyup(function() {
            $('#fewwordscross').hide();
            $("#aboutmecontent").css("border-color", "#616366");
        });
        $('#pob').keyup(function() {
            $('#pobcross').hide();
            $("#pob").css("border-color", "#616366");
        });
        $('#tob').change(function() {
            $('#tobcross').hide();
            $("#tob").css("border-color", "#616366");
        });
        $('#dosh').change(function() {
            $('#doshcross').hide();
            $("#dosh_chosen").css("border-color", "#616366");
        });

        $('#religion').change(function() {
            $('#religioncross').hide();
            $("#religion_chosen").css("border-color", "#616366");
        });

        $('#stream').change(function() {
            $('#streamcross').hide();
            $("#stream_chosen").css("border-color", "#616366");
        });
        $('#education').change(function() {
            $('#educationcross').hide();
            $("#education_chosen").css("border-color", "#616366");
        });
        $('#domain').change(function() {
            $('#domaincross').hide();
            $("#domain_chosen").css("border-color", "#616366");
        });
        $('#workingwith').change(function() {
            $('#workingcross').hide();
            $("#workingwith_chosen").css("border-color", "#616366");
        });
        $('#designation').change(function() {
            $('#designationcross').hide();
            $("#designation_chosen").css("border-color", "#616366");
        });
        $('#income').change(function() {
            $('#incomecross').hide();
            $("#income_chosen").css("border-color", "#616366");
        });

        $('#groomcountry').change(function() {
            $('#groomcountrycross').hide();
            $("#groomcountry_chosen").css("border-color", "#616366");
        });
        $('#groomstate').change(function() {
            $('#groomstatecross').hide();
            $('.groomcitycross').hide();
            $("#groomstate_chosen").css("border-color", "#616366");
        });
        $('.gcity').change(function() {
            var gs = $("#groomstate").val();
            $('.groomcitycross-s').hide();
            $("#groomcity_" + gs + "_chosen").css("border-color", "#616366");
        });

        $('#familytype').change(function() {
            $('#ftypecross').hide();
            $("#familytype_chosen").css("border-color", "#616366");
        });
        $('#familystatus').change(function() {
            $('#fstatuscross').hide();
            $("#familystatus_chosen").css("border-color", "#616366");
        });
        $('#familylocation').change(function() {
            $('#flocationcross').hide();
            $("#familylocation_chosen").css("border-color", "#616366");
        });
        $('#fathername').keyup(function() {
            $('#fnamecross').hide();
            $("#fathername").css("border-color", "#616366");
        });
        $('#mothername').keyup(function() {
            $('#mnamecross').hide();
            $("#mothername").css("border-color", "#616366");
        });
        $('#fatheroccupation').keyup(function() {
            $('#focross').hide();
            $("#fatheroccupation").css("border-color", "#616366");
        });
        $('#motheroccupation').keyup(function() {
            $('#mocross').hide();
            $("#motheroccupation").css("border-color", "#616366");
        });

        $('#diffcountry').change(function() {
            $('#diffcountrycross').hide();
            $("#diffcountry_chosen").css("border-color", "#616366");
        });

        $('#familystate').change(function() {
            $('#diffstatecross').hide();
            $("#familystate_chosen").css("border-color", "#616366");
        });

        $('.gc').change(function() {
            var familystate = $("#familystate").val();
            $('.citycross').hide();
            $("#gc_" + familystate + "_chosen").css("border-color", "#616366");
        });

        $('#partneragefrom').change(function() {
            $('#partneragecross').hide();
            $("#partneragefrom_chosen").css("border-color", "#616366");
        });
        $('#partnerageto').change(function() {
            $('#partneragecross').hide();
            $("#partnerageto_chosen").css("border-color", "#616366");
        });
        $('#partnerheightfrom').change(function() {
            $('#partnerheightcross').hide();
            $("#partnerheightfrom_chosen").css("border-color", "#616366");
        });
        $('#partnerheightto').change(function() {
            $('#partnerheightcross').hide();
            $("#partnerheightto_chosen").css("border-color", "#616366");
        });
        $('#partnermarital').change(function() {
            $('#partnermaritalcross').hide();
            $("#partnermarital_chosen").css("border-color", "#616366");
        });
        $('#partnerreligion').change(function() {
            $('#partnerreligioncross').hide();
            $("#partnerreligion_chosen").css("border-color", "#616366");
        });
        $('#partnercaste').change(function() {
            $('#partnercastecross').hide();
            $("#partnercaste_chosen").css("border-color", "#616366");
        });
        $('#partnerstream').change(function() {
            $('#partnerstreamcross').hide();
            $("#partnerstream_chosen").css("border-color", "#616366");
        });
        $('#partnerprofession').change(function() {
            $('#partnerprofessioncross').hide();
            $("#partnerprofession_chosen").css("border-color", "#616366");
        });
        $('#partnerincome').change(function() {
            $('#partnerincomecross').hide();
            $("#partnerincome_chosen").css("border-color", "#616366");
        });
        $('#partnercountry').change(function() {
            $('#partnercountrycross').hide();
            $("#partnercountry_chosen").css("border-color", "#616366");
        });
        $('#partnerstate').change(function() {
            $('#partnerstatecross').hide();
            $("#partnerstate_chosen").css("border-color", "#616366");
        });
    });
</script>


<script>
    $('#partnerupdatebtn').click(function() {
        var partneragefrom = $('#partneragefrom').val();
        var partnerageto = $('#partnerageto').val();
        var partnerheightfrom = $('#partnerheightfrom').val();
        var partnerheightto = $('#partnerheightto').val();
        var partnermarital = $('#partnermarital').val();
        var partnerreligion = $('#partnerreligion').val();
        var partnercaste = $('#partnercaste').val();
        var partnerstream = $('#partnerstream').val();
        var partnerprofession = $('#partnerprofession').val();
        var partnerincome = $('#partnerincome').val();
        var partnercountry = $('#partnercountry').val();
        var partnerstate = $('#partnerstate').val();

        if (partneragefrom == '' && partnerageto == '') {
            $('#partneragecross').show();
            $("#partneragefrom_chosen").css("border-color", "#dc3545");
            $("#partnerageto_chosen").css("border-color", "#dc3545");
        } else {
            $('#partneragecross').hide();
            $("#partneragefrom_chosen").css("border-color", "#616366");
            $("#partnerageto_chosen").css("border-color", "#616366");
        }

        if (partnerheightfrom == '' && partnerheightto == '') {
            $('#partnerheightcross').show();
            $('#partnerheightfrom_chosen').css("border-color", "#dc3545");
            $('#partnerheightto_chosen').css("border-color", "#dc3545");
        } else {
            $('#partnerheightcross').hide();
            $('#partnerheightfrom_chosen').css("border-color", "#616366");
            $('#partnerheightto_chosen').css("border-color", "#616366");
        }

        if (partnermarital == '') {
            $('#partnermaritalcross').show();
            $('#partnermarital_chosen').css("border-color", "#dc3545");
        } else {
            $('#partnermaritalcross').hide();
            $('#partnermarital_chosen').css("border-color", "#616366");
        }

        if (partnerreligion == '') {
            $('#partnerreligioncross').show();
            $('#partnerreligion_chosen').css("border-color", "#dc3545");
        } else {
            $('#partnerreligioncross').hide();
            $('#partnerreligion_chosen').css("border-color", "#616366");
        }

        if (partnercaste == '') {
            $('#partnercastecross').show();
            $('#partnercaste_chosen').css("border-color", "#dc3545");
        } else {
            $('#partnercastecross').hide();
            $('#partnercaste_chosen').css("border-color", "#616366");
        }

        if (partnerstream == '') {
            $('#partnerstreamcross').show();
            $('#partnerstream_chosen').css("border-color", "#dc3545");
        } else {
            $('#partnerstreamcross').hide();
            $('#partnerstream_chosen').css("border-color", "#616366");
        }

        if (partnerprofession == '') {
            $('#partnerprofessioncross').show();
            $('#partnerprofession_chosen').css("border-color", "#dc3545");
        } else {
            $('#partnerprofessioncross').hide();
            $('#partnerprofession_chosen').css("border-color", "#616366");
        }

        if (partnerincome == '') {
            $('#partnerincomecross').show();
            $('#partnerincome_chosen').css("border-color", "#dc3545");
        } else {
            $('#partnerincomecross').hide();
            $('#partnerincome_chosen').css("border-color", "#616366");
        }

        if (partnercountry == '') {
            $('#partnercountrycross').show();
            $('#partnercountry_chosen').css("border-color", "#dc3545");
        } else {
            $('#partnercountrycross').hide();
            $('#partnercountry_chosen').css("border-color", "#616366");
        }

        if (partnerstate == '') {
            $('#partnerstatecross').show();
            $('#partnerstate_chosen').css("border-color", "#dc3545");
        } else {
            $('#partnerstatecross').hide();
            $('#partnerstate_chosen').css("border-color", "#616366");
        }
    });
</script>

<script>
    $('#addphoto1').click(function() {
        $("#addphoto1input").trigger('click');
    });
    $('#addphoto2').click(function() {
        $("#addphoto2input").trigger('click');
    });
    $('#addphoto3').click(function() {
        $("#addphoto3input").trigger('click');
    });
    $('#addphoto4').click(function() {
        $("#addphoto4input").trigger('click');
    });
</script>
<script>
$(document).ready(function(){
    // URL se 'tab' parameter padhein
    const urlParams = new URLSearchParams(window.location.search);
    const tabName = urlParams.get('tab');

    if(tabName){
        // Sabhi tabs se 'active' class hatayein
        $('.nav-tabs a').removeClass('active');
        $('.tab-pane').removeClass('active show'); // Bootstrap 4/5 syntax check karein

        // Sahi tab ko activate karein
        if(tabName === 'aboutme'){
            $('#aboutme').addClass('active'); // Tab Link
            $('#aboutmetab').addClass('active show'); // Tab Content
        }
        else if(tabName === 'photos'){
            $('#photos').addClass('active');
            $('#photostab').addClass('active show');
        }
        else if(tabName === 'groom'){
            $('#groom').addClass('active');
            $('#groomtab').addClass('active show');
        }
    }
});
</script>