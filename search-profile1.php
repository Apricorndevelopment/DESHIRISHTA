<?php
include 'header.php';
include 'config.php'; // Database connection 

// ==========================================
// 1. FILTER LOGIC (SEARCH FUNCTIONALITY)
// ==========================================
$where = " WHERE 1=1 "; // Default condition

// Age Filter
if (!empty($_GET['agefrom'])) {
    $agefrom = mysqli_real_escape_string($con, $_GET['agefrom']);
    $where .= " AND age >= '$agefrom'";
}
if (!empty($_GET['ageto'])) {
    $ageto = mysqli_real_escape_string($con, $_GET['ageto']);
    $where .= " AND age <= '$ageto'";
}

// Height Filter (String comparison)
if (!empty($_GET['heightfrom'])) {
    $hfrom = mysqli_real_escape_string($con, $_GET['heightfrom']);
    $where .= " AND height >= '$hfrom'";
}
if (!empty($_GET['heightto'])) {
    $hto = mysqli_real_escape_string($con, $_GET['heightto']);
    $where .= " AND height <= '$hto'";
}

// Marital Status
if (!empty($_GET['maritalstatus'])) {
    $ms = mysqli_real_escape_string($con, $_GET['maritalstatus']);
    $where .= " AND marital_status = '$ms'";
}

// Religion
if (!empty($_GET['religion'])) {
    $rel = mysqli_real_escape_string($con, $_GET['religion']);
    $where .= " AND religion = '$rel'";
}

// City (Handles Multiple Selections)
if (!empty($_GET['city'])) {
    $cities = $_GET['city'];
    if (is_array($cities)) {
        // Create string like 'Delhi','Mumbai'
        $city_list = "'" . implode("','", array_map(function ($c) use ($con) {
            return mysqli_real_escape_string($con, $c);
        }, $cities)) . "'";
        $where .= " AND city IN ($city_list)";
    }
}

// Sorting Logic
$order_by = "ORDER BY id DESC"; // Default
if (isset($_GET['sortby'])) {
    if ($_GET['sortby'] == 'asc') {
        $order_by = "ORDER BY id ASC";
    }
}

// ==========================================
// 2. PAGINATION LOGIC
// ==========================================
$limit = 6; // Records per page
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$offset = ($page - 1) * $limit;

// Count Total Records (With Filters applied)
$sql_count = "SELECT COUNT(*) as total FROM `dummy-profile` $where";
$result_count = mysqli_query($con, $sql_count);
$row_count = mysqli_fetch_assoc($result_count);
$total_records = $row_count['total'];
$total_pages = ceil($total_records / $limit);

// ==========================================
// 3. FETCH PROFILES (With Filters + Limit)
// ==========================================
$sql_profiles = "SELECT * FROM `dummy-profile` $where $order_by LIMIT $offset, $limit";
$result_profiles = mysqli_query($con, $sql_profiles);

// Helper function to keep URL params for pagination
function get_url_params($remove_page = true)
{
    $params = $_GET;
    if ($remove_page && isset($params['page'])) unset($params['page']);
    return http_build_query($params);
}
?>

<style>
    /* === POPUP CSS === */
    .menu-pop {
        display: none;
        position: fixed;
        top: 50%;
        left: 70%;
        transform: translate(-50%, -50%);
        z-index: 1001;
        background: #fff;
        width: 90%;
        max-width: 400px;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
    }

    .menu-pop.act {
        display: block !important;
        animation: fadeIn 0.4s;
    }

    .pop-bg {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        z-index: 1000;
    }

    .scroll-hide {
        overflow: hidden;
    }

    .menu-pop-clo {
        position: absolute;
        top: 10px;
        right: 15px;
        cursor: pointer;
        font-size: 20px;
        color: #333;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translate(-50%, -60%);
        }

        to {
            opacity: 1;
            transform: translate(-50%, -50%);
        }
    }

    /* Ensure slider images fit well */
    .wedd-rel-img img {
        width: 100%;
        height: 250px;
        /* Fixed height for consistency */
        object-fit: cover;
    }
</style>
             <style>
                        /* MOBILE VIEW FIX */
@media (max-width: 768px) {

    .register-popup,
    .login-popup,
    .modal,
    .popup {
        width: 90% !important;      /* thoda chhota */
        max-width: 360px;           /* control size */
        left: 50% !important;
        top: 50% !important;
        transform: translate(-50%, -50%) !important;
        margin: 0 !important;
        border-radius: 12px;
    }
.menu-pop2.act {
    /* right: 0px; */
    left: -127px;
    top: 500px;
}}

                    </style>

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

<!-- START MAIN SECTION -->
<section>
    <div class="all-weddpro all-jobs all-serexp chosenini">
        <div class="container">
            <div class="row">
                <!-- SIDEBAR FILTERS (SEARCH WALA) -->
                <div class="col-md-3 fil-mob-view">
                    <span class="filter-clo">+</span>
                    <!-- Changed method to GET so pagination works with search -->
                    <form action="all-profiles.php" method="get">

                        <div class="filt-com lhs-cate">
                            <h4><i><span class="material-icons">123</span></i>Age <span class="text-danger">*</span></h4>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <div class="form-group">
                                        <select class="chosen-select" name="agefrom">
                                            <option value="">From</option>
                                            <option value="18" <?php if (isset($_GET['agefrom']) && $_GET['agefrom'] == '18') echo 'selected'; ?>>18</option>
                                            <option value="25" <?php if (isset($_GET['agefrom']) && $_GET['agefrom'] == '25') echo 'selected'; ?>>25</option>
                                            <option value="30" <?php if (isset($_GET['agefrom']) && $_GET['agefrom'] == '30') echo 'selected'; ?>>30</option>
                                            <option value="35" <?php if (isset($_GET['agefrom']) && $_GET['agefrom'] == '35') echo 'selected'; ?>>35</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select class="chosen-select" name="ageto">
                                            <option value="">To</option>
                                            <option value="25" <?php if (isset($_GET['ageto']) && $_GET['ageto'] == '25') echo 'selected'; ?>>25</option>
                                            <option value="30" <?php if (isset($_GET['ageto']) && $_GET['ageto'] == '30') echo 'selected'; ?>>30</option>
                                            <option value="35" <?php if (isset($_GET['ageto']) && $_GET['ageto'] == '35') echo 'selected'; ?>>35</option>
                                            <option value="40" <?php if (isset($_GET['ageto']) && $_GET['ageto'] == '40') echo 'selected'; ?>>40</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="filt-com lhs-cate">
                                <h4><i><span class="material-icons">height</span></i>Height</h4>
                                <div class="row">
                                    <div class="col-md-12 mb-2">
                                        <div class="form-group">
                                            <select class="chosen-select" name="heightfrom">
                                                <option value="">From</option>
                                                <option value="4 Feet 5 Inches">4 Feet 5 Inches</option>
                                                <option value="5 Feet 0 Inches">5 Feet 0 Inches</option>
                                                <option value="6 Feet 0 Inches">6 Feet 0 Inches</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <select class="chosen-select" name="heightto">
                                                <option value="">To</option>
                                                <option value="5 Feet 0 Inches">5 Feet 0 Inches</option>
                                                <option value="6 Feet 0 Inches">6 Feet 0 Inches</option>
                                                <option value="7 Feet 0 Inches">7 Feet 0 Inches</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        <div class="filt-com lhs-cate">

                            <!-- 1. AGE SECTION -->
                            <h4><i><span class="material-icons">cake</span></i>Age</h4>
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <div class="form-group">
                                        <select class="chosen-select" name="agefrom" id="ageFrom">
                                            <option value="">Age From</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <select class="chosen-select" name="ageto" id="ageTo">
                                            <option value="">Age To</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <br>

                            <!-- 2. HEIGHT SECTION -->
                            <h4><i><span class="material-icons">height</span></i>Height</h4>
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <div class="form-group">
                                        <select class="chosen-select" name="heightfrom" id="heightFrom">
                                            <option value="">Height From</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <select class="chosen-select" name="heightto" id="heightTo">
                                            <option value="">Height To</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <br>

                            <!-- 3. RELIGION SECTION -->
                            <h4><i><span class="material-icons">self_improvement</span></i>Religion</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <select class="chosen-select" name="religion" id="religionSelect">
                                            <option value="">Select Religion</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <br>

                            <!-- 4. LOCATION SECTION -->
                            <h4><i><span class="material-icons">location_on</span></i>Location</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <select class="chosen-select" name="location" id="locationSelect">
                                            <option value="">Select Location</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- Aapka Div End -->

                        <!-- Inline Script to Populate Options -->
                        <script>
                            (function() {
                                // 1. Populate Age (18 to 100)
                                var ageFrom = document.getElementById('ageFrom');
                                var ageTo = document.getElementById('ageTo');
                                for (var i = 18; i <= 100; i++) {
                                    var opt1 = document.createElement('option');
                                    opt1.value = i;
                                    opt1.innerHTML = i + " Years";
                                    ageFrom.appendChild(opt1);

                                    var opt2 = document.createElement('option');
                                    opt2.value = i;
                                    opt2.innerHTML = i + " Years";
                                    ageTo.appendChild(opt2);
                                }

                                // 2. Populate Height (4ft to 7ft)
                                var heightFrom = document.getElementById('heightFrom');
                                var heightTo = document.getElementById('heightTo');
                                for (var ft = 4; ft <= 7; ft++) {
                                    for (var inch = 0; inch <= 11; inch++) {
                                        var hText = ft + " Feet " + inch + " Inches";
                                        // Stop at 7 feet 2 inches roughly
                                        if (ft === 7 && inch > 2) break;

                                        var optH1 = document.createElement('option');
                                        optH1.value = hText;
                                        optH1.innerHTML = hText;
                                        heightFrom.appendChild(optH1);

                                        var optH2 = document.createElement('option');
                                        optH2.value = hText;
                                        optH2.innerHTML = hText;
                                        heightTo.appendChild(optH2);
                                    }
                                }

                                // 3. Populate Religion
                                var religions = ["Hindu", "Muslim", "Sikh", "Christian", "Jain", "Parsi", "Buddhist", "Jewish", "No Religion", "Other"];
                                var relSelect = document.getElementById('religionSelect');
                                for (var r = 0; r < religions.length; r++) {
                                    var optR = document.createElement('option');
                                    optR.value = religions[r];
                                    optR.innerHTML = religions[r];
                                    relSelect.appendChild(optR);
                                }

                                // 4. Populate Location
                                var locations = [
                                    "Mumbai", "Delhi", "Bangalore", "Hyderabad", "Ahmedabad", "Chennai",
                                    "Kolkata", "Surat", "Pune", "Jaipur", "Lucknow", "Kanpur", "Nagpur",
                                    "Indore", "Thane", "Bhopal", "Visakhapatnam", "Patna", "Vadodara",
                                    "Ghaziabad", "Ludhiana", "Agra", "Nashik", "Faridabad", "Meerut",
                                    "Rajkot", "Varanasi", "Srinagar", "Aurangabad", "Dhanbad", "Amritsar",
                                    "Navi Mumbai", "Allahabad", "Ranchi", "Howrah", "Coimbatore",
                                    "Jabalpur", "Gwalior", "Vijayawada", "Jodhpur", "USA", "UK", "Canada", "Australia", "UAE"
                                ];
                                // Sort A-Z
                                locations.sort();
                                var locSelect = document.getElementById('locationSelect');
                                for (var l = 0; l < locations.length; l++) {
                                    var optL = document.createElement('option');
                                    optL.value = locations[l];
                                    optL.innerHTML = locations[l];
                                    locSelect.appendChild(optL);
                                }
                            })();
                        </script>

                        <div class="filt-com lhs-cate">
                            <h4><i><span class="material-symbols-outlined">diversity_4</span></i>Marital Status</h4>
                            <div class="form-group">
                                <select class="chosen-select" name="maritalstatus">
                                    <option value="">Select</option>
                                    <option value="Never Married" <?php if (isset($_GET['maritalstatus']) && $_GET['maritalstatus'] == 'Never Married') echo 'selected'; ?>>Never Married</option>
                                    <option value="Divorced" <?php if (isset($_GET['maritalstatus']) && $_GET['maritalstatus'] == 'Divorced') echo 'selected'; ?>>Divorced</option>
                                    <option value="Widowed" <?php if (isset($_GET['maritalstatus']) && $_GET['maritalstatus'] == 'Widowed') echo 'selected'; ?>>Widowed</option>
                                    <option value="Awaiting Divorce" <?php if (isset($_GET['maritalstatus']) && $_GET['maritalstatus'] == 'Awaiting Divorce') echo 'selected'; ?>>Awaiting Divorce</option>
                                </select>
                            </div>
                        </div>

                        <div class="filt-com lhs-cate">
                            <h4><i><span class="material-symbols-outlined">temple_hindu</span></i>Religion</h4>
                            <div class="form-group">
                                <select class="chosen-select" name="religion">
                                    <option value="">Select</option>
                                    <option value="Hindu" <?php if (isset($_GET['religion']) && $_GET['religion'] == 'Hindu') echo 'selected'; ?>>Hindu</option>
                                    <option value="Muslim" <?php if (isset($_GET['religion']) && $_GET['religion'] == 'Muslim') echo 'selected'; ?>>Muslim</option>
                                    <option value="Christian" <?php if (isset($_GET['religion']) && $_GET['religion'] == 'Christian') echo 'selected'; ?>>Christian</option>
                                    <option value="Sikh" <?php if (isset($_GET['religion']) && $_GET['religion'] == 'Sikh') echo 'selected'; ?>>Sikh</option>
                                    <option value="Buddhist" <?php if (isset($_GET['religion']) && $_GET['religion'] == 'Buddhist') echo 'selected'; ?>>Buddhist</option>
                                    <option value="Jain" <?php if (isset($_GET['religion']) && $_GET['religion'] == 'Jain') echo 'selected'; ?>>Jain</option>
                                    <option value="Jewish" <?php if (isset($_GET['religion']) && $_GET['religion'] == 'Jewish') echo 'selected'; ?>>Jewish</option>
                                    <option value="Bahai" <?php if (isset($_GET['religion']) && $_GET['religion'] == 'Bahai') echo 'selected'; ?>>Bahai</option>
                                    <option value="Parsi" <?php if (isset($_GET['religion']) && $_GET['religion'] == 'Parsi') echo 'selected'; ?>>Parsi (Zoroastrian)</option>
                                    <option value="Taoist" <?php if (isset($_GET['religion']) && $_GET['religion'] == 'Taoist') echo 'selected'; ?>>Taoist</option>
                                    <option value="Confucian" <?php if (isset($_GET['religion']) && $_GET['religion'] == 'Confucian') echo 'selected'; ?>>Confucian</option>
                                    <option value="Shinto" <?php if (isset($_GET['religion']) && $_GET['religion'] == 'Shinto') echo 'selected'; ?>>Shinto</option>
                                    <option value="Pagan" <?php if (isset($_GET['religion']) && $_GET['religion'] == 'Pagan') echo 'selected'; ?>>Pagan</option>
                                    <option value="Wiccan" <?php if (isset($_GET['religion']) && $_GET['religion'] == 'Wiccan') echo 'selected'; ?>>Wiccan</option>
                                    <option value="Atheist" <?php if (isset($_GET['religion']) && $_GET['religion'] == 'Atheist') echo 'selected'; ?>>Atheist</option>
                                    <option value="Agnostic" <?php if (isset($_GET['religion']) && $_GET['religion'] == 'Agnostic') echo 'selected'; ?>>Agnostic</option>
                                    <option value="Spiritual" <?php if (isset($_GET['religion']) && $_GET['religion'] == 'Spiritual') echo 'selected'; ?>>Spiritual</option>
                                    <option value="Tribal" <?php if (isset($_GET['religion']) && $_GET['religion'] == 'Tribal') echo 'selected'; ?>>Tribal</option>
                                    <option value="Animist" <?php if (isset($_GET['religion']) && $_GET['religion'] == 'Animist') echo 'selected'; ?>>Animist</option>
                                    <option value="African Traditional" <?php if (isset($_GET['religion']) && $_GET['religion'] == 'African Traditional') echo 'selected'; ?>>African Traditional</option>
                                    <option value="Native American" <?php if (isset($_GET['religion']) && $_GET['religion'] == 'Native American') echo 'selected'; ?>>Native American</option>
                                    <option value="Aboriginal" <?php if (isset($_GET['religion']) && $_GET['religion'] == 'Aboriginal') echo 'selected'; ?>>Aboriginal</option>
                                    <option value="Mormon" <?php if (isset($_GET['religion']) && $_GET['religion'] == 'Mormon') echo 'selected'; ?>>Mormon</option>
                                    <option value="Jehovah Witness" <?php if (isset($_GET['religion']) && $_GET['religion'] == 'Jehovah Witness') echo 'selected'; ?>>Jehovah's Witness</option>
                                    <option value="Orthodox Christian" <?php if (isset($_GET['religion']) && $_GET['religion'] == 'Orthodox Christian') echo 'selected'; ?>>Orthodox Christian</option>
                                    <option value="Catholic" <?php if (isset($_GET['religion']) && $_GET['religion'] == 'Catholic') echo 'selected'; ?>>Catholic</option>
                                    <option value="Protestant" <?php if (isset($_GET['religion']) && $_GET['religion'] == 'Protestant') echo 'selected'; ?>>Protestant</option>
                                    <option value="Sunni" <?php if (isset($_GET['religion']) && $_GET['religion'] == 'Sunni') echo 'selected'; ?>>Sunni</option>
                                    <option value="Shia" <?php if (isset($_GET['religion']) && $_GET['religion'] == 'Shia') echo 'selected'; ?>>Shia</option>
                                    <option value="Ahmadiyya" <?php if (isset($_GET['religion']) && $_GET['religion'] == 'Ahmadiyya') echo 'selected'; ?>>Ahmadiyya</option>
                                    <option value="Druze" <?php if (isset($_GET['religion']) && $_GET['religion'] == 'Druze') echo 'selected'; ?>>Druze</option>
                                    <option value="Yazidi" <?php if (isset($_GET['religion']) && $_GET['religion'] == 'Yazidi') echo 'selected'; ?>>Yazidi</option>
                                    <option value="Cao Dai" <?php if (isset($_GET['religion']) && $_GET['religion'] == 'Cao Dai') echo 'selected'; ?>>Cao Dai</option>
                                    <option value="Tenrikyo" <?php if (isset($_GET['religion']) && $_GET['religion'] == 'Tenrikyo') echo 'selected'; ?>>Tenrikyo</option>
                                    <option value="Rastafarian" <?php if (isset($_GET['religion']) && $_GET['religion'] == 'Rastafarian') echo 'selected'; ?>>Rastafarian</option>
                                    <option value="Scientology" <?php if (isset($_GET['religion']) && $_GET['religion'] == 'Scientology') echo 'selected'; ?>>Scientology</option>
                                    <option value="Falun Gong" <?php if (isset($_GET['religion']) && $_GET['religion'] == 'Falun Gong') echo 'selected'; ?>>Falun Gong</option>
                                    <option value="Eckankar" <?php if (isset($_GET['religion']) && $_GET['religion'] == 'Eckankar') echo 'selected'; ?>>Eckankar</option>
                                    <option value="Unitarian Universalist" <?php if (isset($_GET['religion']) && $_GET['religion'] == 'Unitarian Universalist') echo 'selected'; ?>>Unitarian Universalist</option>
                                    <option value="Other" <?php if (isset($_GET['religion']) && $_GET['religion'] == 'Other') echo 'selected'; ?>>Other</option>

                                </select>
                            </div>
                        </div>

                        <div class="filt-com lhs-cate">
                            <h4><i><span class="material-symbols-outlined">location_on</span></i>City</h4>
                            <div class="form-group">
                                <select class="chosen-select" name="city[]" multiple>
                                    <option>Delhi</option>
                                    <option>Mumbai</option>
                                    <option>Bangalore</option>
                                    <option>Chennai</option>
                                    <option>Kolkata</option>
                                    <option>Hyderabad</option>
                                    <option>Pune</option>
                                    <option>Ahmedabad</option>
                                    <option>Jaipur</option>
                                    <option>Chandigarh</option>
                                    <option>Lucknow</option>
                                    <option>Kanpur</option>
                                    <option>Indore</option>
                                    <option>Bhopal</option>
                                    <option>Gwalior</option>
                                    <option>Ujjain</option>
                                    <option>Jabalpur</option>
                                    <option>Raipur</option>
                                    <option>Bilaspur</option>
                                    <option>Nagpur</option>
                                    <option>Amravati</option>
                                    <option>Nashik</option>
                                    <option>Aurangabad</option>
                                    <option>Solapur</option>
                                    <option>Kolhapur</option>
                                    <option>Sangli</option>
                                    <option>Satara</option>
                                    <option>Latur</option>
                                    <option>Nanded</option>
                                    <option>Akola</option>
                                    <option>Thane</option>
                                    <option>Vasai</option>
                                    <option>Virar</option>
                                    <option>Kalyan</option>
                                    <option>Dombivli</option>
                                    <option>Panvel</option>
                                    <option>Ulhasnagar</option>
                                    <option>Palghar</option>
                                    <option>Surat</option>
                                    <option>Vadodara</option>
                                    <option>Rajkot</option>
                                    <option>Bhavnagar</option>
                                    <option>Jamnagar</option>
                                    <option>Junagadh</option>
                                    <option>Gandhinagar</option>
                                    <option>Udaipur</option>
                                    <option>Jodhpur</option>
                                    <option>Kota</option>
                                    <option>Ajmer</option>
                                    <option>Alwar</option>
                                    <option>Bikaner</option>
                                    <option>Sikar</option>
                                    <option>Bharatpur</option>
                                    <option>Noida</option>
                                    <option>Greater Noida</option>
                                    <option>Ghaziabad</option>
                                    <option>Faridabad</option>
                                    <option>Gurgaon</option>
                                    <option>Meerut</option>
                                    <option>Agra</option>
                                    <option>Mathura</option>
                                    <option>Aligarh</option>
                                    <option>Bareilly</option>
                                    <option>Moradabad</option>
                                    <option>Rampur</option>
                                    <option>Shahjahanpur</option>
                                    <option>Prayagraj</option>
                                    <option>Varanasi</option>
                                    <option>Mirzapur</option>
                                    <option>Sonbhadra</option>
                                    <option>Gorakhpur</option>
                                    <option>Deoria</option>
                                    <option>Ballia</option>
                                    <option>Patna</option>
                                    <option>Gaya</option>
                                    <option>Bhagalpur</option>
                                    <option>Muzaffarpur</option>
                                    <option>Darbhanga</option>
                                    <option>Purnia</option>
                                    <option>Ranchi</option>
                                    <option>Dhanbad</option>
                                    <option>Bokaro</option>
                                    <option>Jamshedpur</option>
                                    <option>Hazaribagh</option>
                                    <option>Deoghar</option>
                                    <option>Koderma</option>
                                    <option>Giridih</option>
                                    <option>Asansol</option>
                                    <option>Durgapur</option>
                                    <option>Siliguri</option>
                                    <option>Howrah</option>
                                    <option>Hooghly</option>
                                    <option>Midnapore</option>
                                    <option>Malda</option>
                                    <option>Cooch Behar</option>
                                    <option>Darjeeling</option>
                                    <option>Kalimpong</option>

                                </select>
                            </div>
                        </div>

                        <div class="filt-com lhs-cate">
                            <a href="#!" class="cta-3 w-100 text-center search-popup-btn">
                                Search
                            </a>


                        </div>
                    </form>
                </div>
                <!-- END SIDEBAR -->

                <!-- PROFILE RESULTS -->
                <div class="col-md-9">
                    <div class="short-all">
                        <div class="short-lhs">
                            Showing <b><?php echo $page; ?></b> - <b><?php echo $total_pages; ?></b> of <b><?php echo $total_records; ?></b> profiles
                        </div>
                        <div class="short-rhs">
                            <ul>
                                <li>Sort by:</li>
                                <li>
                                    <!-- Sort Form -->
                                    <form id="sortForm" method="get">
                                        <!-- Keep existing search params hidden -->
                                        <?php
                                        foreach ($_GET as $key => $val) {
                                            if ($key == 'sortby' || $key == 'page') continue;
                                            if (is_array($val)) {
                                                foreach ($val as $v) echo "<input type='hidden' name='{$key}[]' value='$v'>";
                                            } else {
                                                echo "<input type='hidden' name='$key' value='$val'>";
                                            }
                                        }
                                        ?>
                                        <div class="form-group oldnew">
                                            <select class="chosen-select p-2" name="sortby" onchange="this.form.submit()">
                                                <option value="">Select</option>
                                                <option value="desc" <?php if (isset($_GET['sortby']) && $_GET['sortby'] == 'desc') echo 'selected'; ?>>Date listed: Newest</option>
                                                <option value="asc" <?php if (isset($_GET['sortby']) && $_GET['sortby'] == 'asc') echo 'selected'; ?>>Date listed: Oldest</option>
                                            </select>
                                        </div>
                                    </form>
                                </li>
                                <li>
                                    <div class="sort-grid sort-grid-1"><i class="fa fa-th-large" aria-hidden="true"></i></div>
                                </li>
                                <li>
                                    <div class="sort-grid sort-grid-2 act"><i class="fa fa-bars" aria-hidden="true"></i></div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="all-list-sh">
                        <ul>
                            <?php
                            if (mysqli_num_rows($result_profiles) > 0) {
                                while ($row = mysqli_fetch_assoc($result_profiles)) {

                                    // 1. HANDLE MULTIPLE IMAGES
                                    $image_string = $row['image'];
                                    $image_array = explode(',', $image_string);
                                    $image_array = array_filter($image_array, function ($value) {
                                        return !is_null($value) && $value !== '';
                                    });

                                    if (empty($image_array)) {
                                        $image_array = ['default.jpg'];
                                    }
                            ?>
                                    <li>
                                        <div class="all-pro-box user-avil-onli head-pro2" data-useravil="avilyes" data-aviltxt="Available online">
                                            <!-- Profile Image Slider -->
                                            <div class="pro-img">
                                                <div class="slid-inn pr-bio-c wedd-rel-pro sliderarrow m-0">
                                                    <ul class="slider5">
                                                        <?php
                                                        // Loop images for slider
                                                        foreach ($image_array as $img_file) {
                                                            $full_img_path = 'images/profiles/' . $img_file;
                                                            if ($img_file == 'default.jpg') {
                                                                $full_img_path = 'images/user/default.jpg';
                                                            }
                                                        ?>
                                                            <li>
                                                                <div class="wedd-rel-box">
                                                                    <div class="wedd-rel-img">
                                                                        <img src="<?php echo $full_img_path; ?>" alt="Profile Photo" onerror="this.src='images/user/default.jpg'">
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        <?php
                                                        }
                                                        ?>
                                                    </ul>
                                                </div>
                                            </div>

                                            <!-- Profile Details -->
                                            <div class="pro-detail">
                                                <h4><a href="#"><?php echo htmlspecialchars($row['name']); ?></a></h4>
                                                <div><?php echo htmlspecialchars($row['profile_id']); ?></div>
                                                <div style="
        display:flex;
        align-items:center;
        gap:6px;
        background:#e9f9ec;
        color:#2e7d32;
        padding:4px 10px;
        border-radius:6px;
        font-size:12px;
        font-weight:600;
        height:30px;
        width:130px;
    ">
                                                    <!-- Check Icon -->
                                                    <span style="
            width:16px;
            height:16px;
            display:inline-flex;
            align-items:center;
            justify-content:center;
            background:#2ecc71;
            color:#fff;
            border-radius:50%;
            font-size:10px;
        ">✓</span>
                                                    ID Verified
                                                </div>
                                                <div class="pro-info-status mobile mb-2"></div>

                                                <div class="pro-bio m-0 b-0 pb-1">
                                                    <span><?php echo $row['age']; ?> Yrs</span>
                                                    <span><?php echo $row['height']; ?></span>
                                                    <span><?php echo $row['marital_status']; ?></span>
                                                    <span><?php echo $row['religion']; ?>, <?php echo $row['caste']; ?></span>
                                                </div>

                                                <div class="pro-bio m-0 pt-0">
                                                    <span><?php echo $row['education']; ?></span>
                                                    <span><?php echo $row['profession']; ?></span>
                                                    <span><?php echo $row['city']; ?></span>
                                                </div>

                                                <div class="links">
                                                    <a href="#!">Profile</a>
                                                    <a href="#!">Send</a>
                                                    <a href="#!">Shortlist</a>
                                                    <a href="#!">WhatsApp</a>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-outline-secondary blockreport" data-bs-toggle="dropdown">
                                                            <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item" href="#">Block</a></li>
                                                            <li><a class="dropdown-item" href="#">Report</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                            <?php
                                } // End While Loop
                            } else {
                                echo "<li><div class='all-pro-box'><h4 class='text-center p-4'>No Profiles Found.</h4></div></li>";
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- PAGINATION -->
<section>
    <div class="blog-main">
        <div class="container">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="page-nation">
                        <ul class="pagination pagination-sm">
                            <?php
                            // Current search params string
                            $search_params = get_url_params();
                            $link_prefix = "?";
                            if (!empty($search_params)) {
                                $link_prefix .= $search_params . "&";
                            }

                            if ($page > 1) {
                                echo '<li class="page-item"><a class="page-link" href="' . $link_prefix . 'page=' . ($page - 1) . '">Previous</a></li>';
                            } else {
                                echo '<li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>';
                            }
                            for ($i = 1; $i <= $total_pages; $i++) {
                                $active = ($i == $page) ? 'active' : '';
                                echo '<li class="page-item ' . $active . '"><a class="page-link" href="' . $link_prefix . 'page=' . $i . '">' . $i . '</a></li>';
                            }
                            if ($page < $total_pages) {
                                echo '<li class="page-item"><a class="page-link" href="' . $link_prefix . 'page=' . ($page + 1) . '">Next</a></li>';
                            } else {
                                echo '<li class="page-item disabled"><a class="page-link" href="#">Next</a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>

<!-- POPUP HTML -->
<div class="menu-pop menu-pop2">
    <span class="menu-pop-clo"><i class="fa bi bi-x" aria-hidden="true"></i></span>
    <div class="inn">
        <div class="menu-pop-help">
            <h4>Welcome To Desi Rishta</h4>
            <div class="user-pro">
                <img src="images/gif/meetup.gif" alt="" loading="lazy">
            </div>
            <div class="user-bio mt-3">
                <h5>"Unlock countless profiles” </h5>
                <span>Register for free now!</span>
                <br>
                <a href="sign-up.php" class="btn btn-primary btn-sm">Register Now</a>
            </div>
        </div>
    </div>
</div>
<div class="pop-bg"></div>

<!-- SCRIPTS -->
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/select-opt.js"></script>
<script src="js/slick.js"></script>
<script src="js/custom.js"></script>

<script>
    $(document).ready(function() {
        // === UPDATED SLIDER LOGIC ===
        if ($('.slider5').length > 0) {
            $('.slider5').slick({
                dots: true,
                infinite: true,
                speed: 500,
                slidesToShow: 1,
                adaptiveHeight: true,
                arrows: true,
                autoplay: true, // ENABLE AUTO SCROLL
                autoplaySpeed: 2000 // 2 SECONDS DELAY
            });
        }

        // Popup Logic
        $(document).on('click', '.links a .search-popup-btn', function(e) {
            e.preventDefault();
            $(".menu-pop2").addClass("act");
            $(".pop-bg").fadeIn();
            $("body").addClass("scroll-hide");
        });

        $(".menu-pop-clo, .pop-bg").on('click', function() {
            $(".menu-pop2").removeClass("act");
            $(".pop-bg").fadeOut();
            $("body").removeClass("scroll-hide");
        });

        // Grid View Logic
        $(".sort-grid-1").click(function() {
            $(".all-list-sh").addClass("grid-view");
            $(".sort-grid-1").addClass("act");
            $(".sort-grid-2").removeClass("act");
        });
        $(".sort-grid-2").click(function() {
            $(".all-list-sh").removeClass("grid-view");
            $(".sort-grid-2").addClass("act");
            $(".sort-grid-1").removeClass("act");
        });
    });
</script>
</body>

</html>