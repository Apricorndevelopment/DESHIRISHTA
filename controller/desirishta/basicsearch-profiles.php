<?php
include 'header.php';
include 'config.php';

$userid = $_COOKIE['dr_userid'];
$gender = $_COOKIE['dr_gender'];

$page = $_GET['page'];

if($page == '')
{
    $lower_page =  0;
}
else
{
    $lower_page = $page - 1;
}

$lower_limit = $lower_page * 3;

$agefrom = $_POST['agefrom'];
$ageto = $_POST['ageto'];

if($agefrom != '' && $ageto != '')
{
    $age_data = " age between '".$agefrom."' and '".$ageto."'";
}

$heightfrom = $_POST['heightfrom'];
$heightto = $_POST['heightto'];

if($heightfrom != '' && $heightto != '')
{
    $height_data = " and height between '".$heightfrom."' and '".$heightto."'";
}

$maritalstatus = str_replace("//", "','", implode("//",$_POST['maritalstatus']));
if($maritalstatus != '')
{
    $marital_data = " and marital in ('".$maritalstatus."')";
}

$religion = str_replace("//", "','", implode("//",$_POST['religion']));
if($religion != '')
{
    $religion_data = " and religion in ('".$religion."')";
}

$caste = str_replace("//", "','", implode("//",$_POST['caste']));
if($caste != '')
{
    $caste_data = " and caste in ('".$caste."')";
}

$manglik = $_POST['manglik'];
if($manglik != '')
{
    $manglik_data = " and manglik = '$manglik'";
}

$eating = str_replace("//", "','", implode("//",$_POST['eating']));
if($eating != '')
{
    $eating_data = " and eating in ('".$eating."')";
}

$drinking = str_replace("//", "','", implode("//",$_POST['drinking']));
if($drinking != '')
{
    $drinking_data = " and drinking in ('".$drinking."')";
}

$smoking = str_replace("//", "','", implode("//",$_POST['smoking']));
if($smoking != '')
{
    $smoking_data = " and smoking in ('".$smoking."')";
}

$education = str_replace("//", "','", implode("//",$_POST['education']));
if($education != '')
{
    $education_data = " and education in ('".$education."')";
}

$workingwith = str_replace("//", "','", implode("//",$_POST['workingwith']));
if($workingwith != '')
{
    $workingwith_data = " and workingwith in ('".$workingwith."')";
}

$domain = str_replace("//", "','", implode("//", $_POST['domain']));
if($domain != '')
{
    $domain_data = " and profession in ('".$domain."')";
}

$familystatus = str_replace("//", "','", implode("//", $_POST['familystatus']));
if($familystatus != '')
{
    $familystatus_data = " and familystatus in ('".$familystatus."')";
}

$familytype = str_replace("//", "','", implode("//", $_POST['familytype']));
if($familytype != '')
{
    $familytype_data = " and familytype in ('".$familytype."')";
}

$city = str_replace("//", "','", implode("//", $_POST['city']));
if($city != '')
{
    $city_data = " and city in ('".$city."')";
}

$state = str_replace("//", "','", implode("//", $_POST['state']));
if($state != '')
{
    $state_data = " and state in ('".$state."')";
}

$country = str_replace("//", "','", implode("//", $_POST['country']));
if($country != '')
{
    $country_data = " and country in ('".$country."')";
}

$sqlcountregis = "select * from final_bio where $age_data $height_data $marital_data $religion_data $caste_data $manglik_data $eating_data $drinking_data $smoking_data $education_data $workingwith_data $domain_data $familystatus_data $familytype_data $city_data $state_data $country_data and userid != '$userid' and gender != '$gender' and delete_status != 'delete'";
$resultcountregis = mysqli_query($con,$sqlcountregis);
$countregis = mysqli_num_rows($resultcountregis);

?>
    <!-- SUB-HEADING -->
    <section>
        <div class="all-pro-head">
            <div class="container">
                <div class="row">
                    <h1>Search Results</h1>
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
                    <div class="col-md-3 fil-mob-view">
                        <span class="filter-clo">+</span>
                        <form action="basicsearch-profiles.php" method="post">
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
                                <!-- START -->
                                <div class="filt-com lhs-cate">
                                    <h4><i><span class="material-icons">height</span></i>Height</h4>
                                    <div class="row">
                                        <div class="col-md-12 mb-2">
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
                                        <div class="col-md-12">
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
                                <!-- START -->
                                <div class="filt-com lhs-cate">
                                    <h4><i><span class="material-symbols-outlined">diversity_4</span></i>Marital Status</h4>
                                    <div class="form-group">
                                        <?php
                                        $maritalstatus_array = explode("','",$maritalstatus); 
                                        ?>
                                        <select class="form-select chosen-select" name="maritalstatus[]" multiple>
                                            <option value="">Select</option>
                                            <option <?php if(in_array('Never Married',$maritalstatus_array)) { echo "selected"; } ?> value="Never Married">Never Married</option>
                                            <option <?php if(in_array('Divorced',$maritalstatus_array)) { echo "selected"; } ?> value="Divorced">Divorced</option>
                                            <option <?php if(in_array('Widowed',$maritalstatus_array)) { echo "selected"; } ?> value="Widowed">Widowed</option>
                                            <option <?php if(in_array('Awaiting Divorce',$maritalstatus_array)) { echo "selected"; } ?> value="Awaiting Divorce">Awaiting Divorce</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- END -->
                                <!-- START -->
                                <div class="filt-com lhs-cate">
                                    <h4><i><span class="material-symbols-outlined">temple_hindu</span></i>Religion</h4>
                                    <div class="form-group">
                                        <?php
                                        $religion_array = explode("','",$religion); 
                                        ?>
                                        <select class="form-select chosen-select" name="religion[]" multiple>
                                            <option value="">Select</option>
                                            <option <?php if(in_array('Hindu',$religion_array)) { echo "selected"; } ?> value="Hindu">Hindu</option>
                                            <option <?php if(in_array('Muslim',$religion_array)) { echo "selected"; } ?> value="Muslim">Muslim</option>
                                            <option <?php if(in_array('Christain',$religion_array)) { echo "selected"; } ?> value="Christain">Christain</option>
                                            <option <?php if(in_array('Sikh',$religion_array)) { echo "selected"; } ?> value="Sikh">Sikh</option>
                                            <option <?php if(in_array('Parsi',$religion_array)) { echo "selected"; } ?> value="Parsi">Parsi</option>
                                            <option <?php if(in_array('Jain',$religion_array)) { echo "selected"; } ?> value="Jain">Jain</option>
                                            <option <?php if(in_array('Buddhist',$religion_array)) { echo "selected"; } ?> value="Buddhist">Buddhist</option>
                                            <option <?php if(in_array('Jewish',$religion_array)) { echo "selected"; } ?> value="Jewish">Jewish</option>
                                            <option <?php if(in_array('Other',$religion_array)) { echo "selected"; } ?> value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- END -->
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
                                <!-- START -->
                                <div class="filt-com lhs-cate">
                                    <h4><i><span class="material-icons">dining</span></i>Eating Habits</h4>
                                    <div class="form-group">
                                        <?php
                                        $eating_array = explode("','",$eating); 
                                        ?>
                                        <select class="form-select chosen-select" name="eating[]" multiple>
                                            <option value="">Select</option>
                                            <option <?php if(in_array('Vegetarian',$eating_array)) { echo "selected"; }?>>Vegetarian</option>
                                            <option <?php if(in_array('Non-Vegetarian',$eating_array)) { echo "selected"; }?>>Non-Vegetarian</option>
                                            <option <?php if(in_array('Eggetarian',$eating_array)) { echo "selected"; }?>>Eggetarian</option>
                                            <otpion <?php if(in_array('Vegan',$eating_array)) { echo "selected"; }?>>Vegan</otpion>
                                        </select>
                                    </div>
                                </div>
                                <!-- END -->
                                <!-- START -->
                                <div class="filt-com lhs-cate">
                                    <h4><i><span class="material-icons">liquor</span></i>Drinking Habits</h4>
                                    <div class="form-group">
                                        <?php
                                        $drinking_array = explode("','",$drinking); 
                                        ?>
                                        <select class="form-select chosen-select" name="drinking[]" multiple>
                                            <option value="">Select</option>
                                            <option <?php if(in_array('Non-drinker',$drinking_array)) { echo "selected"; }?>>Non-drinker</option>
                                            <option <?php if(in_array('Light / Social drinker',$drinking_array)) { echo "selected"; }?>>Light / Social drinker</option>
                                            <option <?php if(in_array('Regular drinker',$drinking_array)) { echo "selected"; }?>>Regular drinker</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- END -->
                                <!-- START -->
                                <div class="filt-com lhs-cate">
                                    <h4><i><span class="material-icons">smoking_rooms</span></i>Smoking Habits</h4>
                                    <div class="form-group">
                                        <?php
                                        $smoking_array = explode("','",$smoking); 
                                        ?>
                                        <select class="form-select chosen-select" name="smoking[]" multiple>
                                            <option value="">Select</option>
                                            <option <?php if(in_array('Non-smoker',$smoking_array)) { echo "selected"; }?>>Non-smoker</option>
                                            <option <?php if(in_array('Light / Social smoker',$smoking_array)) { echo "selected"; }?>>Light / Social smoker</option>
                                            <option <?php if(in_array('Regular Smoker',$smoking_array)) { echo "selected"; }?>>Regular Smoker</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- END -->
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
                                <!-- START -->
                                <div class="filt-com lhs-cate">
                                    <h4><i><span class="material-symbols-outlined">work</span></i>Working With</h4>
                                    <div class="form-group">
                                        <?php
                                        $workingwith_array = explode("','",$workingwith); 
                                        ?>
                                        <select class="chosen-select" name="workingwith[]" multiple>
                                            <option value="">Select</option>
                                            <option <?php if(in_array('Private Company/Corporate',$workingwith_array)) { echo "selected"; } ?>>Private Company/Corporate</option>
                                            <option <?php if(in_array('Government/Public Sector',$workingwith_array)) { echo "selected"; } ?>>Government/Public Sector</option>
                                            <option <?php if(in_array('Defence Services',$workingwith_array)) { echo "selected"; } ?>>Defence Services</option>
                                            <option <?php if(in_array('Civil Services',$workingwith_array)) { echo "selected"; } ?>>Civil Services</option>
                                            <option <?php if(in_array('Business/Self Employed',$workingwith_array)) { echo "selected"; } ?>>Business/Self Employed</option>
                                            <option <?php if(in_array('Not Working',$workingwith_array)) { echo "selected"; } ?>>Not Working</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- END -->
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
                                <!-- START -->
                                <div class="filt-com lhs-cate">
                                    <h4><i><span class="material-symbols-outlined">diversity_3</span></i>Family Status</h4>
                                    <div class="form-group">
                                        <?php
                                        $familystatus_array = explode("','",$familystatus); 
                                        ?>
                                        <select class="chosen-select" name="familystatus[]" multiple>
                                            <option value="">Select</option>
                                            <option <?php if(in_array('Middle Class',$familystatus_array)) { echo "selected"; } ?>>Middle Class</option>
                                            <option <?php if(in_array('Upper Middle Class',$familystatus_array)) { echo "selected"; } ?>>Upper Middle Class</option>
                                            <option <?php if(in_array('Affluent',$familystatus_array)) { echo "selected"; } ?>>Affluent</option>
                                            <option <?php if(in_array('Other',$familystatus_array)) { echo "selected"; } ?>>Other</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- END -->
                                <!-- START -->
                                <div class="filt-com lhs-cate">
                                    <h4><i><span class="material-symbols-outlined">diversity_3</span></i>Family Type</h4>
                                    <div class="form-group">
                                        <?php
                                        $familytype_array = explode("','",$familytype); 
                                        ?>
                                        <select class="chosen-select" name="familytype[]" multiple>
                                            <option value="">Select</option>
                                            <option <?php if(in_array('Joint Family',$familytype_array)) { echo "selected"; } ?>>Joint Family</option>
                                            <option <?php if(in_array('Nuclear Family',$familytype_array)) { echo "selected"; } ?>>Nuclear Family</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- END -->
                                <!-- START -->
                                <div class="filt-com lhs-cate">
                                    <h4><i><span class="material-symbols-outlined">location_on</span></i>City</h4>
                                    <div class="form-group">
                                        <?php
                                        $city_array = explode("','",$city); 
                                        ?>
                                        <select class="form-select chosen-select" name="city[]" multiple>
                                            <option value="">Select</option>
                                            <?php
                                            $sqlgetcity = "select distinct(city) from city_state";
                                            $resultgetcity = mysqli_query($con,$sqlgetcity);
                                            while($rowgetcity = mysqli_fetch_assoc($resultgetcity))
                                            {
                                            ?>
                                            <option <?php if(in_array($rowgetcity['city'],$city_array)) { echo "selected"; } ?> value="<?php echo $rowgetcity['city']; ?>"><?php echo $rowgetcity['city']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- END -->
                                <!-- START -->
                                <div class="filt-com lhs-cate">
                                    <h4><i><span class="material-symbols-outlined">map</span></i>State</h4>
                                    <div class="form-group">
                                        <?php
                                        $state_array = explode("','",$state); 
                                        ?>
                                        <select class="form-select chosen-select" name="state[]" multiple>
                                            <option value="">Select</option>
                                            <?php
                                            $sqlgetstate = "select distinct(state) from city_state";
                                            $resultgetstate = mysqli_query($con,$sqlgetstate);
                                            while($rowgetstate = mysqli_fetch_assoc($resultgetstate))
                                            {
                                            ?>
                                            <option <?php if(in_array($rowgetstate['state'],$state_array)) { echo "selected"; } ?> value="<?php echo $rowgetstate['state']; ?>"><?php echo $rowgetstate['state']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- END -->
                                <!-- START -->
                                <div class="filt-com lhs-cate">
                                    <h4><i><span class="material-symbols-outlined">flag</span></i>Country</h4>
                                    <div class="form-group mb-3">
                                        <?php
                                        $country_array = explode("','",$country); 
                                        ?>
                                        <select class="form-select chosen-select" name="country[]" multiple>
                                            <option value="">Select</option>
                                            <?php
                                            $sqlgetcountries = "select * from countries";
                                            $resultgetcountries = mysqli_query($con,$sqlgetcountries);
                                            while($rowgetcountries = mysqli_fetch_assoc($resultgetcountries))
                                            {
                                            ?>
                                            <option <?php if(in_array($rowgetcountries['country'],$country_array)) { echo "selected"; } ?> value="<?php echo $rowgetcountries['country']; ?>"><?php echo $rowgetcountries['country']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- END -->
                                <!-- START -->
                                <div class="filt-com lhs-cate">
                                    <button type="submit" class="cta-3 w-100 text-center">Search</button>
                                </div>
                                <!-- END -->
                        </form>
                    </div>
                    <div class="col-md-9">
                        <div class="short-all">
                            <div class="short-lhs">
                                Showing <b><?php echo $countregis; ?></b> profiles
                            </div>
                            <div class="short-rhs">
                                <ul>
                                    <li>
                                        Sort by:
                                    </li>
                                    <li>
                                        <div class="form-group">
                                            <select class="chosen-select p-2" id="sortby">
                                                <option value="">Select</option>
                                                <option value="desc" <?php if($_GET['sort'] == 'desc') { echo "selected"; } ?>>Date listed: Newest</option>
                                                <option value="asc" <?php if($_GET['sort'] == 'asc') { echo "selected"; } ?>>Date listed: Oldest</option>
                                            </select>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="sort-grid sort-grid-1">
                                            <i class="fa fa-th-large" aria-hidden="true"></i>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="sort-grid sort-grid-2 act">
                                            <i class="fa fa-bars" aria-hidden="true"></i>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="all-list-sh">
                            <ul>
                                <?php
                                if($_GET['sort'] == 'desc')
                                {
                                    $sort = "desc";
                                }
                                if($_GET['sort'] == 'asc')
                                {
                                    $sort = "asc";
                                }
                                if($_GET['sort'] == '')
                                {
                                    $sort = "desc";
                                }
                                
                                $sqlinfo = "select * from final_bio where $age_data $height_data $marital_data $religion_data $caste_data $eating_data $drinking_data $smoking_data $education_data $workingwith_data $domain_data $familystatus_data $familytype_data $city_data $state_data $country_data and userid != '$userid' and gender != '$gender' and delete_status != 'delete' order by id $sort limit $lower_limit,3";
                                $resultinfo = mysqli_query($con,$sqlinfo);
                                $countinfo = mysqli_num_rows($resultinfo);
                                if($countinfo != 0)
                                {
                                    while($rowinfo = mysqli_fetch_assoc($resultinfo))
                                    {
                                        $profileid = $rowinfo['userid'];
                                        
                                        $sqlbasicinfo = "select * from basic_info where userid = '$profileid'";
                                        $resultbasicinfo = mysqli_query($con,$sqlbasicinfo);
                                        $rowbasicinfo = mysqli_fetch_assoc($resultbasicinfo);
                                        
                                        $sqlreligiousinfo = "select * from religious_info where userid = '$profileid'";
                                        $resultreligiousinfo = mysqli_query($con,$sqlreligiousinfo);
                                        $rowreligiousinfo = mysqli_fetch_assoc($resultreligiousinfo);
                                        
                                        $sqleducationinfo = "select * from education_info where userid = '$profileid'";
                                        $resulteducationinfo = mysqli_query($con,$sqleducationinfo);
                                        $roweducationinfo = mysqli_fetch_assoc($resulteducationinfo);
                                        
                                        $sqllocationinfo = "select * from groom_location where userid = '$profileid'";
                                        $resultlocationinfo = mysqli_query($con,$sqllocationinfo);
                                        $rowlocationinfo = mysqli_fetch_assoc($resultlocationinfo);
                                        
                                        $sqlphotoinfo = "select * from photos_info where userid = '$profileid'";
                                        $resultphotoinfo = mysqli_query($con,$sqlphotoinfo);
                                        $rowphotoinfo = mysqli_fetch_assoc($resultphotoinfo);
                                        
                                        $sqlblock = "select * from block_ids where by_whom = '$userid' and for_who = '$profileid'";
                                        $resultblock = mysqli_query($con,$sqlblock);
                                        $countblock = mysqli_num_rows($resultblock);
                                        
                                        $sqlshortlist = "select * from shortlist_ids where by_whom = '$userid' and for_who = '$profileid'";
                                        $resultshortlist = mysqli_query($con,$sqlshortlist);
                                        $countshortlist = mysqli_num_rows($resultshortlist);
                                    ?>
                                            <li>
                                                <div class="all-pro-box user-avil-onli" data-useravil="avilyes" data-aviltxt="Available online">
                                                    <!--PROFILE IMAGE-->
                                                    <div class="pro-img">
                                                        <div class="slid-inn pr-bio-c wedd-rel-pro sliderarrow m-0">
                                                            <ul class="slider5">
                                                                <?php
                                                                if($rowphotoinfo['profilepic'] != '')
                                                                {
                                                                ?>
                                                                <li>
                                                                    <div class="wedd-rel-box">
                                                                        <div class="wedd-rel-img">
                                                                            <img src="userphoto/<?php echo $rowphotoinfo['profilepic']?>" alt="">
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <?php
                                                                }
                                                                if($rowphotoinfo['photo1'] != '')
                                                                {
                                                                ?>
                                                                <li>
                                                                    <div class="wedd-rel-box">
                                                                        <div class="wedd-rel-img">
                                                                            <img src="userphoto/<?php echo $rowphotoinfo['photo1']?>" alt="">
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <?php
                                                                }
                                                                if($rowphotoinfo['photo2'] != '')
                                                                {
                                                                ?>
                                                                <li>
                                                                    <div class="wedd-rel-box">
                                                                        <div class="wedd-rel-img">
                                                                            <img src="userphoto/<?php echo $rowphotoinfo['photo2']?>" alt="">
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <?php
                                                                }
                                                                if($rowphotoinfo['photo3'] != '')
                                                                {
                                                                ?>
                                                                <li>
                                                                    <div class="wedd-rel-box">
                                                                        <div class="wedd-rel-img">
                                                                            <img src="userphoto/<?php echo $rowphotoinfo['photo3']?>" alt="">
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <?php
                                                                }
                                                                ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <!--END PROFILE IMAGE-->
            
                                                    <!--PROFILE NAME-->
                                                    <div class="pro-detail">
                                                        <h4><a href="user-profile-details.php?uid=<?php echo $rowbasicinfo['userid']; ?>"><?php echo $rowbasicinfo['fullname']; ?></a></h4>
                                                        <div>
                                                            <?php echo $rowbasicinfo['userid']; ?>
                                                            <?php
                                                            if($countblock == '1')
                                                            {
                                                            ?>
                                                            <span class="text-danger desktop" style="float: right;">You have blocked this member</span>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                        <div class="pro-info-status mobile mb-2">
                                                            <?php
                                                            if($rowinfo['verificationinfo'] == 'Done')
                                                            {
                                                            ?>
                                                            <span class="stat-2 m-0"><b>ID Verified</b></span>
                                                            <?php
                                                            }
                                                            if($countblock == '1')
                                                            {
                                                            ?>
                                                            <span class="stat-5 m-0"><b>You blocked this member</b></span>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                        <div class="pro-bio m-0 b-0 pb-1">
                                                            <span><?php echo $rowbasicinfo['age'].' Yrs'; ?></span>
                                                            <span><?php echo $rowbasicinfo['height']; ?></span>
                                                            <span><?php echo $rowbasicinfo['marital']; ?></span>
                                                            <span><?php echo $rowreligiousinfo['religion'].', '.$rowreligiousinfo['caste']; ?></span>
                                                        </div>    
                                                        <div class="pro-bio m-0 pt-0">
                                                            <span><?php echo $roweducationinfo['education']; ?></span>
                                                            <span><?php echo $roweducationinfo['designation']; ?></span>
                                                            <?php
                                                            $cityarray1 = explode("//", $rowlocationinfo['city']);
                                                            $state11 = str_replace("_", " ", $rowlocationinfo['state']);
                                                                    
                                                            $sqlcitydata = "select * from city_state where state = '$state11'";
                                                            $resultcitydata = mysqli_query($con,$sqlcitydata);
                                                            while($rowcitydata = mysqli_fetch_assoc($resultcitydata))
                                                            {
                                                                    
                                                                if(in_array($rowcitydata['city'],$cityarray1)) 
                                                                { 
                                                                    $city11 = $rowcitydata['city']; 
                                                                }
                                                            }
                                                            ?>
                                                            <span><?php echo $city11.', '.$state11; ?></span>
                                                        </div>
                                                        <div class="links">
                                                            <a href="user-profile-details.php?uid=<?php echo $rowbasicinfo['userid']; ?>">Profile</a>
                                                            <a href="user-profile-details.php?uid=<?php echo $rowbasicinfo['userid']; ?>&#contactinfo">Contact</a>
                                                            <?php
                                                            if($countblock == '1')
                                                            {
                                                            ?>
                                                                <a href="#" class="bg-danger text-white shortblock">Shortlist</a>
                                                            <?php
                                                            }
                                                            else
                                                            {
                                                                if($countshortlist >= 1)
                                                                {
                                                                ?>
                                                                    <a href="#" class="bg-success text-white shortlist">Shortlisted</a>
                                                                <?php
                                                                }
                                                                else
                                                                {
                                                                ?>
                                                                    <a href="insert-shortlisted.php?uid=<?php echo $rowbasicinfo['userid']; ?>">Shortlist</a>
                                                                <?php
                                                                }
                                                            }
                                                            ?>
                                                            <?php
                                                            if($countblock == '1')
                                                            {
                                                            ?>
                                                                <a href="#" class="bg-danger text-white shortblock">WhatsApp</a>
                                                            <?php
                                                            }
                                                            else
                                                            {
                                                            ?>
                                                                <a href="https://api.whatsapp.com/send?text=https://myptetest.com/desirishta/user-profile-details.php?uid=<?php echo $rowbasicinfo['userid']; ?>" target="_blank">WhatsApp</a>
                                                            <?php
                                                            }
                                                            ?>
                                                            <div class="dropdown">
                                                                <button type="button" class="btn btn-outline-secondary blockreport" data-bs-toggle="dropdown">
                                                                    <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                                                </button>
                                                                <ul class="dropdown-menu">
                                                                    <?php
                                                                    if($countblock == '0' && $countshortlist == '0')
                                                                    {
                                                                    ?>
                                                                    <li><a class="dropdown-item" href="insert-blockprofile.php?uid=<?php echo $rowbasicinfo['userid']; ?>">Block</a></li>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                    <li><a class="dropdown-item" href="matches-reportid.php?uid=<?php echo $rowbasicinfo['userid']; ?>">Report</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        
                                                        <!--SAVE-->
                                                        <?php
                                                        if($rowinfo['verificationinfo'] == 'Done')
                                                        {
                                                        ?>
                                                        <span class="enq-sav text-success desktop" data-toggle="tooltip" title="Click to save this provile."><i class="fa fa-shield text-success" aria-hidden="true"></i>&nbsp;ID Verified</span>
                                                        <?php
                                                        }
                                                        ?>
                                                        
                                                        <!--END SAVE-->
                                                    </div>
                                                    <!--END PROFILE NAME-->
                                                </div>
                                            </li>
                                    <?php
                                    }
                                }
                                else
                                {
                                ?>
                                    <li>
                                        <div class="all-pro-box user-avil-onli" data-useravil="avilyes" data-aviltxt="Available online">
                                            <!--PROFILE IMAGE-->
                                            <div class="pro-img">
                                                <div class="slid-inn pr-bio-c wedd-rel-pro sliderarrow m-0">
                                                    <ul class="slider5">
                                                        <li>
                                                            <div class="wedd-rel-box">
                                                                <div class="wedd-rel-img">
                                                                    <img src="images/gif/not-found.gif" alt="">
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <!--END PROFILE IMAGE-->
    
                                            <!--PROFILE NAME-->
                                            <div class="pro-detail">
                                                <h4><a href="#">Profiles not found</a></h4>
                                            </div>
                                            <!--END PROFILE NAME-->
                                        </div>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <div class="page-nation">
                            <ul class="pagination pagination-sm">
                                <?php
                                $sqltotalentry = "select * from final_bio where $age_data $height_data $marital_data $religion_data $caste_data $eating_data $drinking_data $smoking_data $education_data $workingwith_data $domain_data $familystatus_data $familytype_data $city_data $state_data $country_data and userid != '$userid' and gender != '$gender' and delete_status != 'delete'";
                                $resulttotalentry = mysqli_query($con,$sqltotalentry);
                                $counttotalentry = mysqli_num_rows($resulttotalentry);
                                $total_page = ceil($counttotalentry/10);
                                
                                if($page >= 2)
                                {
                                ?>
                                <li class="page-item"><a class="page-link" href="basicsearch-profiles.php?page=<?php echo $page - 1; ?>&sort=<?php echo $_GET['sort']; ?>">Previous</a></li>
                                <?php
                                }
                                if($total_page >= 1)
                                {
                                ?>
                                <li class="page-item <?php if($page == '1') { echo "active"; }?>"><a class="page-link" href="basicsearch-profiles.php?page=1&sort=<?php echo $_GET['sort']; ?>">1</a></li>
                                <?php
                                }
                                if($total_page >= 2)
                                {
                                ?>
                                <li class="page-item <?php if($page == '2') { echo "active"; }?>"><a class="page-link" href="basicsearch-profiles.php?page=2&sort=<?php echo $_GET['sort']; ?>">2</a></li>
                                <?php
                                }
                                if($total_page >= 3)
                                {
                                ?>
                                <li class="page-item <?php if($page == '3') { echo "active"; }?>"><a class="page-link" href="basicsearch-profiles.php?page=3&sort=<?php echo $_GET['sort']; ?>">3</a></li>
                                <?php
                                }
                                if($total_page >= 4)
                                {
                                ?>
                                <li class="page-item <?php if($page == '4') { echo "active"; }?>"><a class="page-link" href="basicsearch-profiles.php?page=4&sort=<?php echo $_GET['sort']; ?>">4</a></li>
                                <?php
                                }
                                if($total_page >= 5)
                                {
                                ?>
                                <li class="page-item <?php if($page == '5') { echo "active"; }?>"><a class="page-link" href="basicsearch-profiles.php?page=5&sort=<?php echo $_GET['sort']; ?>">5</a></li>
                                <?php
                                }
                                if($total_page >= 6)
                                {
                                ?>
                                <li class="page-item <?php if($page == '6') { echo "active"; }?>"><a class="page-link" href="basicsearch-profiles.php?page=6&sort=<?php echo $_GET['sort']; ?>">6</a></li>
                                <?php
                                }
                                if($total_page >= 7)
                                {
                                ?>
                                <li class="page-item <?php if($page == '7') { echo "active"; }?>"><a class="page-link" href="basicsearch-profiles.php?page=7&sort=<?php echo $_GET['sort']; ?>">7</a></li>
                                <?php
                                }
                                if($total_page > $page)
                                {
                                ?>
                                <li class="page-item"><a class="page-link" href="basicsearch-profiles.php?page=<?php echo $page + 1; ?>&sort=<?php echo $_GET['sort']; ?>">Next</a></li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
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
 