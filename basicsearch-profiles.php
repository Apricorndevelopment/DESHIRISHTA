<?php
include 'header.php';
include 'config.php';

// Ensure session is started for persistence
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$userid = $_COOKIE['dr_userid'];
$gender = $_COOKIE['dr_gender'];

if($userid == '') {
    header('location:login.php');
    exit;
}

// ==========================================
// 1. HANDLE SEARCH REQUEST & PERSISTENCE
// ==========================================

// If it's a new POST search, save to Session
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['search_criteria'] = $_POST;
    
    // --- SEARCH LOGGING ---
    $log_date = date('Y-m-d');
    $log_time = date('H:i:s');
    $criteria_list = array();

    foreach($_POST as $key => $value) {
        if(!empty($value) && $key != 'submit') {
            if(is_array($value)) {
                $value = implode(", ", $value);
            }
            $key_formatted = ucfirst($key);
            $criteria_list[] = "$key_formatted: $value";
        }
    }
    
    $criteria_final = implode(" | ", $criteria_list);
    $criteria_final = mysqli_real_escape_string($con, $criteria_final);

    if(!empty($criteria_final)) {
        $sql_log = "INSERT INTO user_search_logs (userid, search_date, search_time, criteria) 
                    VALUES ('$userid', '$log_date', '$log_time', '$criteria_final')";
        mysqli_query($con, $sql_log);
    }
    // ---------------------
}

// Retrieve filters from Session (or empty array if none)
$search_data = isset($_SESSION['search_criteria']) ? $_SESSION['search_criteria'] : [];

// ==========================================
// 2. CONSTRUCT SQL QUERY
// ==========================================

// Initialize Query Parts
$age_data = "";
$height_data = "";
$marital_data = "";
$religion_data = "";
$caste_data = "";
$manglik_data = "";
$eating_data = "";
$drinking_data = "";
$smoking_data = "";
$education_data = "";
$workingwith_data = "";
$domain_data = "";
$familystatus_data = "";
$familytype_data = "";
$city_data = "";
$state_data = "";
$country_data = "";

// Extract Variables with Fallbacks
$agefrom = isset($search_data['agefrom']) ? $search_data['agefrom'] : '';
$ageto = isset($search_data['ageto']) ? $search_data['ageto'] : '';

if($agefrom != '' && $ageto != '') {
    $age_data = " AND age BETWEEN '$agefrom' AND '$ageto'";
}

$heightfrom = isset($search_data['heightfrom']) ? $search_data['heightfrom'] : '';
$heightto = isset($search_data['heightto']) ? $search_data['heightto'] : '';

if($heightfrom != '' && $heightto != '') {
    $height_data = " AND height BETWEEN '$heightfrom' AND '$heightto'";
}

// Helper function to process Array Inputs for SQL IN clause
function process_multi_select($key, $data) {
    if(isset($data[$key]) && is_array($data[$key]) && !empty($data[$key])) {
        // Create string: 'Value1','Value2'
        $sanitized = array_map(function($item) {
            // Basic sanitization if needed, though prepared statements are better
            return str_replace("'", "", $item); 
        }, $data[$key]);
        return implode("','", $sanitized);
    }
    return '';
}

// Marital Status
$marital_str = process_multi_select('maritalstatus', $search_data);
if($marital_str != '') { $marital_data = " AND marital IN ('$marital_str')"; }

// Religion
$religion_str = process_multi_select('religion', $search_data);
if($religion_str != '') { $religion_data = " AND religion IN ('$religion_str')"; }

// Caste
$caste_str = process_multi_select('caste', $search_data);
if($caste_str != '') { $caste_data = " AND caste IN ('$caste_str')"; }

// Manglik
$manglik = isset($search_data['manglik']) ? $search_data['manglik'] : '';
if($manglik != '') { $manglik_data = " AND manglik = '$manglik'"; }

// Habits
$eating_str = process_multi_select('eating', $search_data);
if($eating_str != '') { $eating_data = " AND eating IN ('$eating_str')"; }

$drinking_str = process_multi_select('drinking', $search_data);
if($drinking_str != '') { $drinking_data = " AND drinking IN ('$drinking_str')"; }

$smoking_str = process_multi_select('smoking', $search_data);
if($smoking_str != '') { $smoking_data = " AND smoking IN ('$smoking_str')"; }

// Education & Work
$education_str = process_multi_select('education', $search_data);
if($education_str != '') { $education_data = " AND education IN ('$education_str')"; }

$workingwith_str = process_multi_select('workingwith', $search_data);
if($workingwith_str != '') { $workingwith_data = " AND workingwith IN ('$workingwith_str')"; }

// Domain: Special handling for dashes/spaces as per original code logic
if(isset($search_data['domain']) && is_array($search_data['domain']) && !empty($search_data['domain'])) {
    $d_arr = [];
    foreach($search_data['domain'] as $d) {
        // Original Logic: str_replace("&", "and", str_replace(",", "", str_replace(" ", "-", ...)))
        // Assuming the value passed is already formatted or needs to be matched against specific DB format
        $d_arr[] = $d; 
    }
    $domain_str = implode("','", $d_arr);
    $domain_data = " AND profession IN ('$domain_str')"; 
}

// Family
$familystatus_str = process_multi_select('familystatus', $search_data);
if($familystatus_str != '') { $familystatus_data = " AND familystatus IN ('$familystatus_str')"; }

$familytype_str = process_multi_select('familytype', $search_data);
if($familytype_str != '') { $familytype_data = " AND familytype IN ('$familytype_str')"; }

// Location
$city_str = process_multi_select('city', $search_data);
if($city_str != '') { $city_data = " AND city IN ('$city_str')"; }

$state_str = process_multi_select('state', $search_data);
if($state_str != '') { $state_data = " AND state IN ('$state_str')"; }

$country_str = process_multi_select('country', $search_data);
if($country_str != '') { $country_data = " AND country IN ('$country_str')"; }


// ==========================================
// 3. PAGINATION & COUNTS
// ==========================================
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if($page < 1) $page = 1;
$lower_limit = ($page - 1) * 3; // 3 items per page as per original code

$sort = 'DESC'; // Default
if(isset($_GET['sort']) && $_GET['sort'] == 'asc') {
    $sort = 'ASC';
}

// Base Condition
$base_condition = "userid != '$userid' AND gender != '$gender' AND delete_status != 'delete'";

// Construct Full WHERE Clause
$where_clause = "WHERE $base_condition $age_data $height_data $marital_data $religion_data $caste_data $manglik_data $eating_data $drinking_data $smoking_data $education_data $workingwith_data $domain_data $familystatus_data $familytype_data $city_data $state_data $country_data";

// Count Query
$sqlcountregis = "SELECT * FROM final_bio $where_clause";
$resultcountregis = mysqli_query($con, $sqlcountregis);
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
                            
                            <!-- AGE -->
                            <div class="filt-com lhs-cate">
                                <h4><i><span class="material-icons">123</span></i>Age</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="chosen-select" name="agefrom">
                                                <option value="">From</option>
                                                <?php for($i=18; $i<=65; $i++) { ?>
                                                <option value="<?php echo $i; ?>" <?php if($agefrom == $i) echo 'selected'; ?>><?php echo $i; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="chosen-select" name="ageto">
                                                <option value="">To</option>
                                                <?php for($i=20; $i<=65; $i++) { ?>
                                                <option value="<?php echo $i; ?>" <?php if($ageto == $i) echo 'selected'; ?>><?php echo $i; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- HEIGHT -->
                            <div class="filt-com lhs-cate">
                                <h4><i><span class="material-icons">height</span></i>Height</h4>
                                <div class="row">
                                    <div class="col-md-12 mb-2">
                                        <div class="form-group">
                                            <select class="chosen-select" name="heightfrom">
                                                <option value="">From</option>
                                                <?php 
                                                $heights = [
                                                    "4 Feet 5 Inches", "4 Feet 6 Inches", "4 Feet 7 Inches", "4 Feet 8 Inches", "4 Feet 9 Inches", "4 Feet 10 Inches", "4 Feet 11 Inches",
                                                    "5 Feet 0 Inches", "5 Feet 1 Inches", "5 Feet 2 Inches", "5 Feet 3 Inches", "5 Feet 4 Inches", "5 Feet 5 Inches", "5 Feet 6 Inches", "5 Feet 7 Inches", "5 Feet 8 Inches", "5 Feet 9 Inches", "5 Feet 10 Inches", "5 Feet 11 Inches",
                                                    "6 Feet 0 Inches", "6 Feet 1 Inches", "6 Feet 2 Inches", "6 Feet 3 Inches", "6 Feet 4 Inches", "6 Feet 5 Inches", "6 Feet 6 Inches", "6 Feet 7 Inches", "6 Feet 8 Inches", "6 Feet 9 Inches", "6 Feet 10 Inches", "6 Feet 11 Inches",
                                                    "7 Feet 0 Inches", "7 Feet 1 Inches", "7 Feet 2 Inches", "7 Feet 3 Inches", "7 Feet 4 Inches", "7 Feet 5 Inches"
                                                ];
                                                foreach($heights as $h) {
                                                    $sel = ($heightfrom == $h) ? 'selected' : '';
                                                    echo "<option value='$h' $sel>$h</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <select class="chosen-select" name="heightto">
                                                <option value="">To</option>
                                                <?php 
                                                foreach($heights as $h) {
                                                    $sel = ($heightto == $h) ? 'selected' : '';
                                                    echo "<option value='$h' $sel>$h</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- MARITAL STATUS -->
                            <div class="filt-com lhs-cate">
                                <h4><i><span class="material-symbols-outlined">diversity_4</span></i>Marital Status</h4>
                                <div class="form-group">
                                    <?php $ms_arr = isset($search_data['maritalstatus']) ? $search_data['maritalstatus'] : []; ?>
                                    <select class="form-select chosen-select" name="maritalstatus[]" multiple>
                                        <option value="">Select</option>
                                        <?php 
                                        $statuses = ['Never Married', 'Divorced', 'Widowed', 'Awaiting Divorce'];
                                        foreach($statuses as $s) {
                                            $sel = in_array($s, $ms_arr) ? 'selected' : '';
                                            echo "<option value='$s' $sel>$s</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <!-- RELIGION -->
                            <div class="filt-com lhs-cate">
                                <h4><i><span class="material-symbols-outlined">temple_hindu</span></i>Religion</h4>
                                <div class="form-group">
                                    <?php $rel_arr = isset($search_data['religion']) ? $search_data['religion'] : []; ?>
                                    <select class="form-select chosen-select" name="religion[]" multiple>
                                        <option value="">Select</option>
                                        <?php 
                                        $rels = ['Hindu', 'Muslim', 'Christain', 'Sikh', 'Parsi', 'Jain', 'Buddhist', 'Jewish', 'Other'];
                                        foreach($rels as $r) {
                                            $sel = in_array($r, $rel_arr) ? 'selected' : '';
                                            echo "<option value='$r' $sel>$r</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <!-- CASTE -->
                            <div class="filt-com lhs-cate">
                                <h4><i><span class="material-symbols-outlined">reduce_capacity</span></i>Caste</h4>
                                <div class="form-group">
                                    <?php $caste_arr = isset($search_data['caste']) ? $search_data['caste'] : []; ?>
                                    <select class="form-select chosen-select" name="caste[]" multiple>
                                        <?php 
                                        $sqlgetcaste = "select * from religion_caste";
                                        $resultgetcaste = mysqli_query($con,$sqlgetcaste);
                                        while($rowgetcaste = mysqli_fetch_assoc($resultgetcaste)) {
                                            $sel = in_array($rowgetcaste['caste'], $caste_arr) ? 'selected' : '';
                                            echo "<option value='{$rowgetcaste['caste']}' $sel>{$rowgetcaste['caste']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <!-- EATING -->
                            <div class="filt-com lhs-cate">
                                <h4><i><span class="material-icons">dining</span></i>Eating Habits</h4>
                                <div class="form-group">
                                    <?php $eat_arr = isset($search_data['eating']) ? $search_data['eating'] : []; ?>
                                    <select class="form-select chosen-select" name="eating[]" multiple>
                                        <option value="">Select</option>
                                        <?php 
                                        $opts = ['Vegetarian', 'Non-Vegetarian', 'Eggetarian', 'Vegan'];
                                        foreach($opts as $o) {
                                            $sel = in_array($o, $eat_arr) ? 'selected' : '';
                                            echo "<option value='$o' $sel>$o</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <!-- DRINKING -->
                            <div class="filt-com lhs-cate">
                                <h4><i><span class="material-icons">liquor</span></i>Drinking Habits</h4>
                                <div class="form-group">
                                    <?php $drink_arr = isset($search_data['drinking']) ? $search_data['drinking'] : []; ?>
                                    <select class="form-select chosen-select" name="drinking[]" multiple>
                                        <option value="">Select</option>
                                        <?php 
                                        $opts = ['Non-drinker', 'Light / Social drinker', 'Regular drinker'];
                                        foreach($opts as $o) {
                                            $sel = in_array($o, $drink_arr) ? 'selected' : '';
                                            echo "<option value='$o' $sel>$o</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <!-- SMOKING -->
                            <div class="filt-com lhs-cate">
                                <h4><i><span class="material-icons">smoking_rooms</span></i>Smoking Habits</h4>
                                <div class="form-group">
                                    <?php $smoke_arr = isset($search_data['smoking']) ? $search_data['smoking'] : []; ?>
                                    <select class="form-select chosen-select" name="smoking[]" multiple>
                                        <option value="">Select</option>
                                        <?php 
                                        $opts = ['Non-smoker', 'Light / Social smoker', 'Regular Smoker'];
                                        foreach($opts as $o) {
                                            $sel = in_array($o, $smoke_arr) ? 'selected' : '';
                                            echo "<option value='$o' $sel>$o</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <!-- EDUCATION -->
                            <div class="filt-com lhs-cate">
                                <h4><i><span class="material-symbols-outlined">school</span></i>Highest Education</h4>
                                <div class="form-group">
                                    <?php $edu_arr = isset($search_data['education']) ? $search_data['education'] : []; ?>
                                    <select class="chosen-select" name="education[]" multiple>
                                        <option value="">Select</option>
                                        <?php
                                        $sqlgeteducation = "select distinct(education) from stream_education";
                                        $resultgeteducation = mysqli_query($con,$sqlgeteducation);
                                        while($row = mysqli_fetch_assoc($resultgeteducation)) {
                                            $sel = in_array($row['education'], $edu_arr) ? 'selected' : '';
                                            echo "<option value='{$row['education']}' $sel>{$row['education']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <!-- WORKING WITH -->
                            <div class="filt-com lhs-cate">
                                <h4><i><span class="material-symbols-outlined">work</span></i>Working With</h4>
                                <div class="form-group">
                                    <?php $work_arr = isset($search_data['workingwith']) ? $search_data['workingwith'] : []; ?>
                                    <select class="chosen-select" name="workingwith[]" multiple>
                                        <option value="">Select</option>
                                        <?php 
                                        $opts = ['Private Company/Corporate', 'Government/Public Sector', 'Defence Services', 'Civil Services', 'Business/Self Employed', 'Not Working'];
                                        foreach($opts as $o) {
                                            $sel = in_array($o, $work_arr) ? 'selected' : '';
                                            echo "<option value='$o' $sel>$o</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <!-- PROFESSION -->
                            <div class="filt-com lhs-cate">
                                <h4><i><span class="material-symbols-outlined">account_circle</span></i>Profession</h4>
                                <div class="form-group">
                                    <?php $dom_arr = isset($search_data['domain']) ? $search_data['domain'] : []; ?>
                                    <select class="chosen-select" name="domain[]" multiple>
                                        <?php
                                        $sqlgetdomain = "select distinct(domain) from domain_designation";
                                        $resultgetdomain = mysqli_query($con,$sqlgetdomain);
                                        while($row = mysqli_fetch_assoc($resultgetdomain)) {
                                            $val = str_replace("&", "and", str_replace(",", "", str_replace(" ", "-", $row['domain'])));
                                            $sel = in_array($val, $dom_arr) ? 'selected' : '';
                                            echo "<option value='$val' $sel>{$row['domain']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <!-- FAMILY STATUS -->
                            <div class="filt-com lhs-cate">
                                <h4><i><span class="material-symbols-outlined">diversity_3</span></i>Family Status</h4>
                                <div class="form-group">
                                    <?php $fam_arr = isset($search_data['familystatus']) ? $search_data['familystatus'] : []; ?>
                                    <select class="chosen-select" name="familystatus[]" multiple>
                                        <option value="">Select</option>
                                        <?php 
                                        $opts = ['Middle Class', 'Upper Middle Class', 'Affluent', 'Other'];
                                        foreach($opts as $o) {
                                            $sel = in_array($o, $fam_arr) ? 'selected' : '';
                                            echo "<option value='$o' $sel>$o</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <!-- FAMILY TYPE -->
                            <div class="filt-com lhs-cate">
                                <h4><i><span class="material-symbols-outlined">diversity_3</span></i>Family Type</h4>
                                <div class="form-group">
                                    <?php $famt_arr = isset($search_data['familytype']) ? $search_data['familytype'] : []; ?>
                                    <select class="chosen-select" name="familytype[]" multiple>
                                        <option value="">Select</option>
                                        <?php 
                                        $opts = ['Joint Family', 'Nuclear Family'];
                                        foreach($opts as $o) {
                                            $sel = in_array($o, $famt_arr) ? 'selected' : '';
                                            echo "<option value='$o' $sel>$o</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <!-- CITY -->
                            <div class="filt-com lhs-cate">
                                <h4><i><span class="material-symbols-outlined">location_on</span></i>City</h4>
                                <div class="form-group">
                                    <?php $city_arr = isset($search_data['city']) ? $search_data['city'] : []; ?>
                                    <select class="form-select chosen-select" name="city[]" multiple>
                                        <option value="">Select</option>
                                        <?php
                                        $sqlgetcity = "select distinct(city) from city_state";
                                        $resultgetcity = mysqli_query($con,$sqlgetcity);
                                        while($row = mysqli_fetch_assoc($resultgetcity)) {
                                            $sel = in_array($row['city'], $city_arr) ? 'selected' : '';
                                            echo "<option value='{$row['city']}' $sel>{$row['city']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <!-- STATE -->
                            <div class="filt-com lhs-cate">
                                <h4><i><span class="material-symbols-outlined">map</span></i>State</h4>
                                <div class="form-group">
                                    <?php $state_arr = isset($search_data['state']) ? $search_data['state'] : []; ?>
                                    <select class="form-select chosen-select" name="state[]" multiple>
                                        <option value="">Select</option>
                                        <?php
                                        $sqlgetstate = "select distinct(state) from city_state";
                                        $resultgetstate = mysqli_query($con,$sqlgetstate);
                                        while($row = mysqli_fetch_assoc($resultgetstate)) {
                                            $sel = in_array($row['state'], $state_arr) ? 'selected' : '';
                                            echo "<option value='{$row['state']}' $sel>{$row['state']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <!-- COUNTRY -->
                            <div class="filt-com lhs-cate">
                                <h4><i><span class="material-symbols-outlined">flag</span></i>Country</h4>
                                <div class="form-group mb-3">
                                    <?php $country_arr = isset($search_data['country']) ? $search_data['country'] : []; ?>
                                    <select class="form-select chosen-select" name="country[]" multiple>
                                        <option value="">Select</option>
                                        <?php
                                        $sqlgetcountries = "select * from countries";
                                        $resultgetcountries = mysqli_query($con,$sqlgetcountries);
                                        while($row = mysqli_fetch_assoc($resultgetcountries)) {
                                            $sel = in_array($row['country'], $country_arr) ? 'selected' : '';
                                            echo "<option value='{$row['country']}' $sel>{$row['country']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <!-- SUBMIT -->
                            <div class="filt-com lhs-cate">
                                <button type="submit" class="cta-3 w-100 text-center">Search</button>
                            </div>
                        </form>
                    </div>

                    <!-- SEARCH RESULTS DISPLAY -->
                    <div class="col-md-9">
                        <div class="short-all">
                            <div class="short-lhs">
                                Showing <b><?php echo $countregis; ?></b> profiles
                            </div>
                            <div class="short-rhs">
                                <ul>
                                    <li>Sort by:</li>
                                    <li>
                                        <div class="form-group">
                                            <!-- Fix: Use JS to submit or reload with GET param for sorting -->
                                            <select class="chosen-select p-2" id="sortby" onchange="window.location.href='basicsearch-profiles.php?page=<?php echo $page; ?>&sort='+this.value">
                                                <option value="desc" <?php if($_GET['sort'] == 'desc') echo "selected"; ?>>Date listed: Newest</option>
                                                <option value="asc" <?php if($_GET['sort'] == 'asc') echo "selected"; ?>>Date listed: Oldest</option>
                                            </select>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="all-list-sh">
                            <ul>
                                <?php
                                $sqlinfo = "SELECT * FROM final_bio $where_clause ORDER BY id $sort LIMIT $lower_limit, 3";
                                $resultinfo = mysqli_query($con, $sqlinfo);
                                $countinfo = mysqli_num_rows($resultinfo);

                                if($countinfo != 0) {
                                    while($rowinfo = mysqli_fetch_assoc($resultinfo)) {
                                        $profileid = $rowinfo['userid'];
                                        
                                        // Fetch User Details
                                        $rowbasicinfo = mysqli_fetch_assoc(mysqli_query($con, "select * from basic_info where userid = '$profileid'"));
                                        $rowreligiousinfo = mysqli_fetch_assoc(mysqli_query($con, "select * from religious_info where userid = '$profileid'"));
                                        $roweducationinfo = mysqli_fetch_assoc(mysqli_query($con, "select * from education_info where userid = '$profileid'"));
                                        $rowlocationinfo = mysqli_fetch_assoc(mysqli_query($con, "select * from groom_location where userid = '$profileid'"));
                                        $rowphotoinfo = mysqli_fetch_assoc(mysqli_query($con, "select * from photos_info where userid = '$profileid'"));
                                        
                                        // Fetch Actions
                                        $sqlblock = "select * from block_ids where by_whom = '$userid' and for_who = '$profileid'";
                                        $countblock = mysqli_num_rows(mysqli_query($con, $sqlblock));
                                        
                                        $sqlshortlist = "select * from shortlist_ids where by_whom = '$userid' and for_who = '$profileid'";
                                        $countshortlist = mysqli_num_rows(mysqli_query($con, $sqlshortlist));
                                        
                                        // Default Photo Logic
                                        $prof_pic = "images/gif/not-found.gif";
                                        if(!empty($rowphotoinfo['profilepic'])) { $prof_pic = "userphoto/".$rowphotoinfo['profilepic']; }
                                ?>
                                    <li>
                                        <div class="all-pro-box user-avil-onli">
                                            <!--PROFILE IMAGE-->
                                            <div class="pro-img">
                                                <div class="slid-inn pr-bio-c wedd-rel-pro sliderarrow m-0">
                                                    <ul class="slider5">
                                                        <li>
                                                            <div class="wedd-rel-box">
                                                                <div class="wedd-rel-img">
                                                                    <img src="<?php echo $prof_pic; ?>" alt="">
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <?php if(!empty($rowphotoinfo['photo1'])) { ?>
                                                        <li><div class="wedd-rel-box"><div class="wedd-rel-img"><img src="userphoto/<?php echo $rowphotoinfo['photo1']; ?>" alt=""></div></div></li>
                                                        <?php } ?>
                                                        <?php if(!empty($rowphotoinfo['photo2'])) { ?>
                                                        <li><div class="wedd-rel-box"><div class="wedd-rel-img"><img src="userphoto/<?php echo $rowphotoinfo['photo2']; ?>" alt=""></div></div></li>
                                                        <?php } ?>
                                                        <?php if(!empty($rowphotoinfo['photo3'])) { ?>
                                                        <li><div class="wedd-rel-box"><div class="wedd-rel-img"><img src="userphoto/<?php echo $rowphotoinfo['photo3']; ?>" alt=""></div></div></li>
                                                        <?php } ?>
                                                    </ul>
                                                </div>
                                            </div>
                                            
                                            <!--PROFILE INFO-->
                                            <div class="pro-detail">
                                                <h4><a href="user-profile-details.php?uid=<?php echo $rowbasicinfo['userid']; ?>"><?php echo $rowbasicinfo['fullname']; ?></a></h4>
                                                <div>
                                                    <?php echo $rowbasicinfo['userid']; ?>
                                                    <?php if($countblock == '1') { ?>
                                                        <span class="text-danger desktop" style="float: right;">You have blocked this member</span>
                                                    <?php } ?>
                                                </div>
                                                
                                                <div class="pro-info-status mb-2">
                                                    <?php if($rowinfo['verificationinfo'] == '1' || $rowinfo['verificationinfo'] == 'Done') { ?>
                                                        <span class="stat-2 m-0"><b>ID Verified</b></span>
                                                    <?php } ?>
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
                                                    <span><?php echo $rowlocationinfo['city'].', '.$rowlocationinfo['state']; ?></span>
                                                </div>

                                                <div class="links">
                                                    <a href="user-profile-details.php?uid=<?php echo $rowbasicinfo['userid']; ?>">Profile</a>
                                                    
                                                    <?php if($countblock == '1') { ?>
                                                        <a href="#" class="bg-danger text-white shortblock">Shortlist</a>
                                                    <?php } elseif($countshortlist >= 1) { ?>
                                                        <a href="#" class="bg-success text-white shortlist">Shortlisted</a>
                                                    <?php } else { ?>
                                                        <a href="insert-shortlisted.php?uid=<?php echo $rowbasicinfo['userid']; ?>">Shortlist</a>
                                                    <?php } ?>

                                                    <?php if($countblock == '1') { ?>
                                                        <a href="#" class="bg-danger text-white shortblock">WhatsApp</a>
                                                    <?php } else { ?>
                                                        <a href="https://api.whatsapp.com/send?text=Check out this profile: https://myptetest.com/desirishta/user-profile-details.php?uid=<?php echo $rowbasicinfo['userid']; ?>" target="_blank">WhatsApp</a>
                                                    <?php } ?>

                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-outline-secondary blockreport" data-bs-toggle="dropdown">
                                                            <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <?php if($countblock == '0' && $countshortlist == '0') { ?>
                                                                <li><a class="dropdown-item" href="insert-blockprofile.php?uid=<?php echo $rowbasicinfo['userid']; ?>">Block</a></li>
                                                            <?php } ?>
                                                            <li><a class="dropdown-item" href="matches-reportid.php?uid=<?php echo $rowbasicinfo['userid']; ?>">Report</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                <?php
                                    }
                                } else {
                                    echo "<li><div class='all-pro-box'><h4 class='text-center p-4'>No profiles found matching your criteria.</h4></div></li>";
                                }
                                ?>
                            </ul>
                        </div>

                        <!-- PAGINATION -->
                        <?php 
                        $total_page = ceil($countregis / 3);
                        if($total_page > 1) {
                        ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="page-nation">
                                    <ul class="pagination pagination-sm" style="justify-content: center;">
                                        <?php
                                        // Previous
                                        if($page > 1) {
                                            echo '<li class="page-item"><a class="page-link" href="basicsearch-profiles.php?page='.($page - 1).'&sort='.$_GET['sort'].'">Previous</a></li>';
                                        }

                                        // Pages
                                        for($i = 1; $i <= $total_page; $i++) {
                                            $active = ($page == $i) ? 'active' : '';
                                            echo '<li class="page-item '.$active.'"><a class="page-link" href="basicsearch-profiles.php?page='.$i.'&sort='.$_GET['sort'].'">'.$i.'</a></li>';
                                        }

                                        // Next
                                        if($page < $total_page) {
                                            echo '<li class="page-item"><a class="page-link" href="basicsearch-profiles.php?page='.($page + 1).'&sort='.$_GET['sort'].'">Next</a></li>';
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
include 'footer.php';
?>