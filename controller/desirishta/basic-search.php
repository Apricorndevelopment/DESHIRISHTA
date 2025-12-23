<?php
include 'header.php';
include 'config.php';

$userid = $_COOKIE['dr_userid'];
$gender = $_COOKIE['dr_gender'];


if($userid == '')
{
    header('location:login.php');
}
?>
    <!-- SUB-HEADING -->
    <section>
        <div class="all-pro-head">
            <div class="container">
                <div class="row">
                    <h1>Search Profiles</h1>
                </div>
            </div>
        </div>
        <!--FILTER ON MOBILE VIEW-->
        <div class="fil-mob fil-mob-act">
            <h4>Profile filters <i class="fa fa-filter" aria-hidden="true"></i> </h4>
        </div>
    </section>
    <!-- END -->

    <!-- START -->
    <section>
        <div class="all-weddpro all-jobs all-serexp chosenini">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <span class="filter-clo">+</span> 
                        <form action="basicsearch-profiles.php" method="post" class="row mt-5">
                            <div class="col-md-4">
                                <!-- START -->
                                <div class="filt-com lhs-cate">
                                    <h4><i><span class="material-icons">123</span></i>Age <span class="text-danger">*</span></h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <select class="chosen-select" name="agefrom" required>
                                                    <option value="">From</option>
                                                    <?php
                                                    for($agefrom = '18'; $agefrom <= '65'; $agefrom++)
                                                    {
                                                    ?>
                                                    <option <?php if($_POST['agefrom'] == $agefrom) { echo "selected"; } ?> value="<?php echo $agefrom; ?>"><?php echo $agefrom; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <select class="chosen-select" name="ageto" required>
                                                    <option value="">To</option>
                                                    <?php
                                                    for($ageto = '20'; $ageto <= '65'; $ageto++)
                                                    {
                                                    ?>
                                                    <option <?php if($_POST['ageto'] == $ageto) { echo "selected"; } ?> value="<?php echo $ageto; ?>"><?php echo $ageto; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END -->
                            </div>
                            <div class="col-md-4">
                                <!-- START -->
                                <div class="filt-com lhs-cate">
                                    <h4><i><span class="material-icons">height</span></i>Height</h4>
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <div class="form-group">
                                                <select class="chosen-select" name="heightfrom">
                                                    <option value="">From</option>
                                                    <option <?php if($_POST['heightfrom'] == "4 Feet 5 Inches") { echo "selected"; } ?> value="4 Feet 5 Inches">4 Feet 5 Inches</option>
                                                    <option <?php if($_POST['heightfrom'] == "4 Feet 6 Inches") { echo "selected"; } ?> value="4 Feet 6 Inches">4 Feet 6 Inches</option>
                                                    <option <?php if($_POST['heightfrom'] == "4 Feet 7 Inches") { echo "selected"; } ?> value="4 Feet 7 Inches">4 Feet 7 Inches</option>
                                                    <option <?php if($_POST['heightfrom'] == "4 Feet 8 Inches") { echo "selected"; } ?> value="4 Feet 8 Inches">4 Feet 8 Inches</option>
                                                    <option <?php if($_POST['heightfrom'] == "4 Feet 9 Inches") { echo "selected"; } ?> value="4 Feet 9 Inches">4 Feet 9 Inches</option>
                                                    <option <?php if($_POST['heightfrom'] == "4 Feet 10 Inches") { echo "selected"; } ?> value="4 Feet 10 Inches">4 Feet 10 Inches</option>
                                                    <option <?php if($_POST['heightfrom'] == "4 Feet 11 Inches") { echo "selected"; } ?> value="4 Feet 11 Inches">4 Feet 11 Inches</option>
                                                    <option <?php if($_POST['heightfrom'] == "5 Feet 0 Inches") { echo "selected"; } ?> value="5 Feet 0 Inches">5 Feet 0 Inches</option>
                                                    <option <?php if($_POST['heightfrom'] == "5 Feet 1 Inches") { echo "selected"; } ?> value="5 Feet 1 Inches">5 Feet 1 Inches</option>
                                                    <option <?php if($_POST['heightfrom'] == "5 Feet 2 Inches") { echo "selected"; } ?> value="5 Feet 2 Inches">5 Feet 2 Inches</option>
                                                    <option <?php if($_POST['heightfrom'] == "5 Feet 3 Inches") { echo "selected"; } ?> value="5 Feet 3 Inches">5 Feet 3 Inches</option>
                                                    <option <?php if($_POST['heightfrom'] == "5 Feet 4 Inches") { echo "selected"; } ?> value="5 Feet 4 Inches">5 Feet 4 Inches</option>
                                                    <option <?php if($_POST['heightfrom'] == "5 Feet 5 Inches") { echo "selected"; } ?> value="5 Feet 5 Inches">5 Feet 5 Inches</option>
                                                    <option <?php if($_POST['heightfrom'] == "5 Feet 6 Inches") { echo "selected"; } ?> value="5 Feet 6 Inches">5 Feet 6 Inches</option>
                                                    <option <?php if($_POST['heightfrom'] == "5 Feet 7 Inches") { echo "selected"; } ?> value="5 Feet 7 Inches">5 Feet 7 Inches</option>
                                                    <option <?php if($_POST['heightfrom'] == "5 Feet 8 Inches") { echo "selected"; } ?> value="5 Feet 8 Inches">5 Feet 8 Inches</option>
                                                    <option <?php if($_POST['heightfrom'] == "5 Feet 9 Inches") { echo "selected"; } ?> value="5 Feet 9 Inches">5 Feet 9 Inches</option>
                                                    <option <?php if($_POST['heightfrom'] == "5 Feet 10 Inches") { echo "selected"; } ?> value="5 Feet 10 Inches">5 Feet 10 Inches</option>
                                                    <option <?php if($_POST['heightfrom'] == "5 Feet 11 Inches") { echo "selected"; } ?> value="5 Feet 11 Inches">5 Feet 11 Inches</option>
                                                    <option <?php if($_POST['heightfrom'] == "6 Feet 0 Inches") { echo "selected"; } ?> value="6 Feet 0 Inches">6 Feet 0 Inches</option>
                                                    <option <?php if($_POST['heightfrom'] == "6 Feet 1 Inches") { echo "selected"; } ?> value="6 Feet 1 Inches">6 Feet 1 Inches</option>
                                                    <option <?php if($_POST['heightfrom'] == "6 Feet 2 Inches") { echo "selected"; } ?> value="6 Feet 2 Inches">6 Feet 2 Inches</option>
                                                    <option <?php if($_POST['heightfrom'] == "6 Feet 3 Inches") { echo "selected"; } ?> value="6 Feet 3 Inches">6 Feet 3 Inches</option>
                                                    <option <?php if($_POST['heightfrom'] == "6 Feet 4 Inches") { echo "selected"; } ?> value="6 Feet 4 Inches">6 Feet 4 Inches</option>
                                                    <option <?php if($_POST['heightfrom'] == "6 Feet 5 Inches") { echo "selected"; } ?> value="6 Feet 5 Inches">6 Feet 5 Inches</option>
                                                    <option <?php if($_POST['heightfrom'] == "6 Feet 6 Inches") { echo "selected"; } ?> value="6 Feet 6 Inches">6 Feet 6 Inches</option>
                                                    <option <?php if($_POST['heightfrom'] == "6 Feet 7 Inches") { echo "selected"; } ?> value="6 Feet 7 Inches">6 Feet 7 Inches</option>
                                                    <option <?php if($_POST['heightfrom'] == "6 Feet 8 Inches") { echo "selected"; } ?> value="6 Feet 8 Inches">6 Feet 8 Inches</option>
                                                    <option <?php if($_POST['heightfrom'] == "6 Feet 9 Inches") { echo "selected"; } ?> value="6 Feet 9 Inches">6 Feet 9 Inches</option>
                                                    <option <?php if($_POST['heightfrom'] == "6 Feet 10 Inches") { echo "selected"; } ?> value="6 Feet 10 Inches">6 Feet 10 Inches</option>
                                                    <option <?php if($_POST['heightfrom'] == "6 Feet 11 Inches") { echo "selected"; } ?> value="6 Feet 11 Inches">6 Feet 11 Inches</option>
                                                    <option <?php if($_POST['heightfrom'] == "7 Feet 0 Inches") { echo "selected"; } ?> value="7 Feet 0 Inches">7 Feet 0 Inches</option>
                                                    <option <?php if($_POST['heightfrom'] == "7 Feet 1 Inches") { echo "selected"; } ?> value="7 Feet 1 Inches">7 Feet 1 Inches</option>
                                                    <option <?php if($_POST['heightfrom'] == "7 Feet 2 Inches") { echo "selected"; } ?> value="7 Feet 2 Inches">7 Feet 2 Inches</option>
                                                    <option <?php if($_POST['heightfrom'] == "7 Feet 3 Inches") { echo "selected"; } ?> value="7 Feet 3 Inches">7 Feet 3 Inches</option>
                                                    <option <?php if($_POST['heightfrom'] == "7 Feet 4 Inches") { echo "selected"; } ?> value="7 Feet 4 Inches">7 Feet 4 Inches</option>
                                                    <option <?php if($_POST['heightfrom'] == "7 Feet 5 Inches") { echo "selected"; } ?> value="7 Feet 5 Inches">7 Feet 5 Inches</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <select class="chosen-select" name="heightto">
                                                    <option value="">To</option>
                                                    <option <?php if($_POST['heightto'] == "5 Feet 0 Inches") { echo "selected"; } ?> value="5 Feet 0 Inches">5 Feet 0 Inches</option>
                                                    <option <?php if($_POST['heightto'] == "5 Feet 1 Inches") { echo "selected"; } ?> value="5 Feet 1 Inches">5 Feet 1 Inches</option>
                                                    <option <?php if($_POST['heightto'] == "5 Feet 2 Inches") { echo "selected"; } ?> value="5 Feet 2 Inches">5 Feet 2 Inches</option>
                                                    <option <?php if($_POST['heightto'] == "5 Feet 3 Inches") { echo "selected"; } ?> value="5 Feet 3 Inches">5 Feet 3 Inches</option>
                                                    <option <?php if($_POST['heightto'] == "5 Feet 4 Inches") { echo "selected"; } ?> value="5 Feet 4 Inches">5 Feet 4 Inches</option>
                                                    <option <?php if($_POST['heightto'] == "5 Feet 5 Inches") { echo "selected"; } ?> value="5 Feet 5 Inches">5 Feet 5 Inches</option>
                                                    <option <?php if($_POST['heightto'] == "5 Feet 6 Inches") { echo "selected"; } ?> value="5 Feet 6 Inches">5 Feet 6 Inches</option>
                                                    <option <?php if($_POST['heightto'] == "5 Feet 7 Inches") { echo "selected"; } ?> value="5 Feet 7 Inches">5 Feet 7 Inches</option>
                                                    <option <?php if($_POST['heightto'] == "5 Feet 8 Inches") { echo "selected"; } ?> value="5 Feet 8 Inches">5 Feet 8 Inches</option>
                                                    <option <?php if($_POST['heightto'] == "5 Feet 9 Inches") { echo "selected"; } ?> value="5 Feet 9 Inches">5 Feet 9 Inches</option>
                                                    <option <?php if($_POST['heightto'] == "5 Feet 10 Inches") { echo "selected"; } ?> value="5 Feet 10 Inches">5 Feet 10 Inches</option>
                                                    <option <?php if($_POST['heightto'] == "5 Feet 11 Inches") { echo "selected"; } ?> value="5 Feet 11 Inches">5 Feet 11 Inches</option>
                                                    <option <?php if($_POST['heightto'] == "6 Feet 0 Inches") { echo "selected"; } ?> value="6 Feet 0 Inches">6 Feet 0 Inches</option>
                                                    <option <?php if($_POST['heightto'] == "6 Feet 1 Inches") { echo "selected"; } ?> value="6 Feet 1 Inches">6 Feet 1 Inches</option>
                                                    <option <?php if($_POST['heightto'] == "6 Feet 2 Inches") { echo "selected"; } ?> value="6 Feet 2 Inches">6 Feet 2 Inches</option>
                                                    <option <?php if($_POST['heightto'] == "6 Feet 3 Inches") { echo "selected"; } ?> value="6 Feet 3 Inches">6 Feet 3 Inches</option>
                                                    <option <?php if($_POST['heightto'] == "6 Feet 4 Inches") { echo "selected"; } ?> value="6 Feet 4 Inches">6 Feet 4 Inches</option>
                                                    <option <?php if($_POST['heightto'] == "6 Feet 5 Inches") { echo "selected"; } ?> value="6 Feet 5 Inches">6 Feet 5 Inches</option>
                                                    <option <?php if($_POST['heightto'] == "6 Feet 6 Inches") { echo "selected"; } ?> value="6 Feet 6 Inches">6 Feet 6 Inches</option>
                                                    <option <?php if($_POST['heightto'] == "6 Feet 7 Inches") { echo "selected"; } ?> value="6 Feet 7 Inches">6 Feet 7 Inches</option>
                                                    <option <?php if($_POST['heightto'] == "6 Feet 8 Inches") { echo "selected"; } ?> value="6 Feet 8 Inches">6 Feet 8 Inches</option>
                                                    <option <?php if($_POST['heightto'] == "6 Feet 9 Inches") { echo "selected"; } ?> value="6 Feet 9 Inches">6 Feet 9 Inches</option>
                                                    <option <?php if($_POST['heightto'] == "6 Feet 10 Inches") { echo "selected"; } ?> value="6 Feet 10 Inches">6 Feet 10 Inches</option>
                                                    <option <?php if($_POST['heightto'] == "6 Feet 11 Inches") { echo "selected"; } ?> value="6 Feet 11 Inches">6 Feet 11 Inches</option>
                                                    <option <?php if($_POST['heightto'] == "7 Feet 0 Inches") { echo "selected"; } ?> value="7 Feet 0 Inches">7 Feet 0 Inches</option>
                                                    <option <?php if($_POST['heightto'] == "7 Feet 1 Inches") { echo "selected"; } ?> value="7 Feet 1 Inches">7 Feet 1 Inches</option>
                                                    <option <?php if($_POST['heightto'] == "7 Feet 2 Inches") { echo "selected"; } ?> value="7 Feet 2 Inches">7 Feet 2 Inches</option>
                                                    <option <?php if($_POST['heightto'] == "7 Feet 3 Inches") { echo "selected"; } ?> value="7 Feet 3 Inches">7 Feet 3 Inches</option>
                                                    <option <?php if($_POST['heightto'] == "7 Feet 4 Inches") { echo "selected"; } ?> value="7 Feet 4 Inches">7 Feet 4 Inches</option>
                                                    <option <?php if($_POST['heightto'] == "7 Feet 5 Inches") { echo "selected"; } ?> value="7 Feet 5 Inches">7 Feet 5 Inches</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END -->
                            </div>
                            <div class="col-md-4">
                                <!-- START -->
                                <div class="filt-com lhs-cate">
                                    <h4><i><span class="material-symbols-outlined">diversity_4</span></i>Marital Status</h4>
                                    <div class="form-group">
                                        <select class="form-select chosen-select" name="maritalstatus[]" multiple>
                                            <option value="">Select</option>
                                            <option <?php if($_POST['maritalstatus'] == "Never Married") { echo "selected"; } ?> value="Never Married">Never Married</option>
                                            <option <?php if($_POST['maritalstatus'] == "Divorced") { echo "selected"; } ?> value="Divorced">Divorced</option>
                                            <option <?php if($_POST['maritalstatus'] == "Widowed") { echo "selected"; } ?> value="Widowed">Widowed</option>
                                            <option <?php if($_POST['maritalstatus'] == "Awaiting Divorce") { echo "selected"; } ?> value="Awaiting Divorce">Awaiting Divorce</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- END -->
                            </div>
                            <div class="col-md-4">
                                <!-- START -->
                                <div class="filt-com lhs-cate">
                                    <h4><i><span class="material-symbols-outlined">temple_hindu</span></i>Religion</h4>
                                    <div class="form-group">
                                        <select class="form-select chosen-select" name="religion[]" multiple>
                                            <option value="">Select</option>
                                            <option <?php if($_POST['religion'] == "Hindu") { echo "selected"; } ?> value="Hindu">Hindu</option>
                                            <option <?php if($_POST['religion'] == "Muslim") { echo "selected"; } ?> value="Muslim">Muslim</option>
                                            <option <?php if($_POST['religion'] == "Christain") { echo "selected"; } ?> value="Christain">Christain</option>
                                            <option <?php if($_POST['religion'] == "Christain") { echo "selected"; } ?> value="Sikh">Sikh</option>
                                            <option <?php if($_POST['religion'] == "Parsi") { echo "selected"; } ?> value="Parsi">Parsi</option>
                                            <option <?php if($_POST['religion'] == "Jain") { echo "selected"; } ?> value="Jain">Jain</option>
                                            <option <?php if($_POST['religion'] == "Buddhist") { echo "selected"; } ?> value="Buddhist">Buddhist</option>
                                            <option <?php if($_POST['religion'] == "Jewish") { echo "selected"; } ?> value="Jewish">Jewish</option>
                                            <option <?php if($_POST['religion'] == "Other") { echo "selected"; } ?> value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- END -->
                            </div>
                            <div class="col-md-4">
                                <!-- START -->
                                <div class="filt-com lhs-cate">
                                    <h4><i><span class="material-symbols-outlined">reduce_capacity</span></i>Caste</h4>
                                    <div class="form-group">
                                        <?php
                                        $caste_array = explode("','",$caste); 
                                        ?>
                                        <select class="form-select chosen-select" name="caste[]" multiple>
                                        <?php 
                                        $sqlgetcaste = "select * from religion_caste";
                                        $resultgetcaste = mysqli_query($con,$sqlgetcaste);
                                        while($rowgetcaste = mysqli_fetch_assoc($resultgetcaste))
                                        {
                                        ?>
                                            <option <?php if(in_array($rowgetcaste['caste'],$caste_array)) { echo "selected"; } ?> value="<?php echo $rowgetcaste['caste']; ?>"><?php echo $rowgetcaste['caste'];?></option>
                                        <?php
                                        }
                                        ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- END -->
                            </div>
                            
                            <div class="col-md-4">
                                <div class="filt-com lhs-cate">
                                    <h4><i><span class="material-symbols-outlined">diversity_3</span></i>Dosh/Dosham</h4>
                                    <div class="form-group">
                                        <select class="chosen-select" name="manglik">
                                            <option value="">Select</option>
                                            <option value="yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <!-- START -->
                                <div class="filt-com lhs-cate">
                                    <h4><i><span class="material-icons">dining</span></i>Eating Habits</h4>
                                    <div class="form-group">
                                        <select class="form-select chosen-select" name="eating[]" multiple>
                                            <option value="">Select</option>
                                            <option <?php if($rowbasicinfo['eating'] == 'Vegetarian') { echo "selected"; }?>>Vegetarian</option>
                                            <option <?php if($rowbasicinfo['eating'] == 'Non-Vegetarian') { echo "selected"; }?>>Non-Vegetarian</option>
                                            <option <?php if($rowbasicinfo['eating'] == 'Eggetarian') { echo "selected"; }?>>Eggetarian</option>
                                            <otpion <?php if($rowbasicinfo['eating'] == 'Vegan') { echo "selected"; }?>>Vegan</otpion>
                                        </select>
                                    </div>
                                </div>
                                <!-- END -->
                            </div>
                            <div class="col-md-4">
                                <!-- START -->
                                <div class="filt-com lhs-cate">
                                    <h4><i><span class="material-icons">liquor</span></i>Drinking Habits</h4>
                                    <div class="form-group">
                                        <select class="form-select chosen-select" name="drinking[]" multiple>
                                            <option value="">Select</option>
                                            <option <?php if($rowbasicinfo['drinking'] == 'Non-drinker') { echo "selected"; }?>>Non-drinker</option>
                                            <option <?php if($rowbasicinfo['drinking'] == 'Light / Social drinker') { echo "selected"; }?>>Light / Social drinker</option>
                                            <option <?php if($rowbasicinfo['drinking'] == 'Regular drinker') { echo "selected"; }?>>Regular drinker</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- END -->
                            </div>
                            <div class="col-md-4">
                                <!-- START -->
                                <div class="filt-com lhs-cate">
                                    <h4><i><span class="material-icons">smoking_rooms</span></i>Smoking Habits</h4>
                                    <div class="form-group">
                                        <select class="form-select chosen-select" name="smoking[]" multiple>
                                            <option value="">Select</option>
                                            <option <?php if($rowbasicinfo['smoking'] == 'Non-smoker') { echo "selected"; }?>>Non-smoker</option>
                                            <option <?php if($rowbasicinfo['smoking'] == 'Light / Social smoker') { echo "selected"; }?>>Light / Social smoker</option>
                                            <option <?php if($rowbasicinfo['smoking'] == 'Regular Smoker') { echo "selected"; }?>>Regular Smoker</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- END -->
                            </div>
                            <div class="col-md-4">
                                <!-- START -->
                                <div class="filt-com lhs-cate">
                                    <h4><i><span class="material-symbols-outlined">school</span></i>Highest Education </h4>
                                    <div class="form-group">
                                        <?php
                                        $education_array = explode("','",$education); 
                                        ?>
                                        <select class="chosen-select" name="education[]" multiple>
                                            <option value="">Select</option>
                                            <?php
                                            $sqlgeteducation = "select distinct(education) from stream_education";
                                            $resultgeteducation = mysqli_query($con,$sqlgeteducation);
                                            while($rowgeteducation = mysqli_fetch_assoc($resultgeteducation))
                                            {
                                            ?>
                                            <option <?php if(in_array($rowgeteducation['education'],$education_array)) { echo "selected"; } ?> value="<?php echo $rowgeteducation['education']; ?>"><?php echo $rowgeteducation['education']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- END -->
                            </div>
                            <div class="col-md-4">
                                <!-- START -->
                                <div class="filt-com lhs-cate">
                                    <h4><i><span class="material-symbols-outlined">work</span></i>Working With</h4>
                                    <div class="form-group">
                                        <select class="chosen-select" name="workingwith[]" multiple>
                                            <option value="">Select</option>
                                            <option <?php if($roweudcationinfo['workingwith'] == 'Private Company/Corporate') { echo "selected"; } ?>>Private Company/Corporate</option>
                                            <option <?php if($roweudcationinfo['workingwith'] == 'Government/Public Sector') { echo "selected"; } ?>>Government/Public Sector</option>
                                            <option <?php if($roweudcationinfo['workingwith'] == 'Defence Services') { echo "selected"; } ?>>Defence Services</option>
                                            <option <?php if($roweudcationinfo['workingwith'] == 'Civil Services') { echo "selected"; } ?>>Civil Services</option>
                                            <option <?php if($roweudcationinfo['workingwith'] == 'Business/Self Employed') { echo "selected"; } ?>>Business/Self Employed</option>
                                            <option <?php if($roweudcationinfo['workingwith'] == 'Not Working') { echo "selected"; } ?>>Not Working</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- END -->
                            </div>
                            <div class="col-md-4">
                                <!-- START -->
                                <div class="filt-com lhs-cate">
                                    <h4><i><span class="material-symbols-outlined">account_circle</span></i>Profession</h4>
                                    <div class="form-group">
                                        <?php
                                        $domain_array = explode("','",$domain); 
                                        ?>
                                        <select class="chosen-select" name="domain[]" multiple>
                                            <?php
                                            $sqlgetdomain = "select distinct(domain) from domain_designation";
                                            $resultgetdomain = mysqli_query($con,$sqlgetdomain);
                                            while($rowgetdomain = mysqli_fetch_assoc($resultgetdomain))
                                            {
                                            ?>
                                            <option <?php if(in_array(str_replace("&", "and", str_replace(",", "", str_replace(" ", "-", $rowgetdomain['domain']))),$domain_array)) { echo "selected"; } ?> value="<?php echo str_replace("&", "and", str_replace(",", "", str_replace(" ", "-", $rowgetdomain['domain']))); ?>"><?php echo $rowgetdomain['domain']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- END -->
                            </div>
                            <div class="col-md-4">
                                <!-- START -->
                                <div class="filt-com lhs-cate">
                                    <h4><i><span class="material-symbols-outlined">diversity_3</span></i>Family Status</h4>
                                    <div class="form-group">
                                        <select class="chosen-select" name="familystatus[]" multiple>
                                            <option value="">Select</option>
                                            <option <?php if($rowfamilyinfo['familystatus'] == 'Middle Class') { echo "selected"; } ?>>Middle Class</option>
                                            <option <?php if($rowfamilyinfo['familystatus'] == 'Upper Middle Class') { echo "selected"; } ?>>Upper Middle Class</option>
                                            <option <?php if($rowfamilyinfo['familystatus'] == 'Affluent') { echo "selected"; } ?>>Affluent</option>
                                            <option <?php if($rowfamilyinfo['familystatus'] == 'Other') { echo "selected"; } ?>>Other</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- END -->
                            </div>
                            
                            <div class="col-md-4">
                                <!-- START -->
                                <div class="filt-com lhs-cate">
                                    <h4><i><span class="material-symbols-outlined">location_on</span></i>City</h4>
                                    <div class="form-group">
                                        <select class="form-select chosen-select" name="city[]" multiple>
                                            <option value="">Select</option>
                                            <?php
                                            $sqlgetstate = "select distinct(city) from city_state";
                                            $resultgetstate = mysqli_query($con,$sqlgetstate);
                                            while($rowgetstate = mysqli_fetch_assoc($resultgetstate))
                                            {
                                            ?>
                                            <option value="<?php echo $rowgetstate['city']; ?>"><?php echo $rowgetstate['city']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- END -->
                            </div>
                            <div class="col-md-4">
                                <!-- START -->
                                <div class="filt-com lhs-cate">
                                    <h4><i><span class="material-symbols-outlined">map</span></i>State</h4>
                                    <div class="form-group">
                                        <select class="form-select chosen-select" name="state[]" multiple>
                                            <option value="">Select</option>
                                            <?php
                                            $sqlgetstate = "select distinct(state) from city_state";
                                            $resultgetstate = mysqli_query($con,$sqlgetstate);
                                            while($rowgetstate = mysqli_fetch_assoc($resultgetstate))
                                            {
                                            ?>
                                            <option value="<?php echo $rowgetstate['state']; ?>"><?php echo $rowgetstate['state']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- END -->
                            </div>
                            <div class="col-md-4">
                                <!-- START -->
                                <div class="filt-com lhs-cate">
                                    <h4><i><span class="material-symbols-outlined">flag</span></i>Country</h4>
                                    <div class="form-group mb-3">
                                        <select class="form-select chosen-select" name="country[]" multiple>
                                            <option value="">Select</option>
                                            <?php
                                            $sqlgetcountries = "select * from countries";
                                            $resultgetcountries = mysqli_query($con,$sqlgetcountries);
                                            while($rowgetcountries = mysqli_fetch_assoc($resultgetcountries))
                                            {
                                            ?>
                                            <option value="<?php echo $rowgetcountries['country']; ?>"><?php echo $rowgetcountries['country']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- END -->
                            </div>
                            <div class="col-md-12">
                                <!-- START -->
                                <p class="text-danger">Required fields</p>
                                <div class="filt-com lhs-cate">
                                    <button type="submit" class="cta-3 w-100 text-center">Search</button>
                                </div>
                                <!-- END -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END -->
    
    



 <?php
 include 'footer.php';
 ?>
 