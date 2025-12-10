<?php 
include 'header.php'; 
include 'config.php'; // Database connection 

// --- PAGINATION LOGIC ---
$limit = 6; // Ek page par kitne profiles dikhane hain
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$offset = ($page - 1) * $limit;

// Total records count karna (Pagination numbers ke liye)
$sql_count = "SELECT COUNT(*) as total FROM `dummy-profile`";
$result_count = mysqli_query($con, $sql_count);
$row_count = mysqli_fetch_assoc($result_count);
$total_records = $row_count['total'];
$total_pages = ceil($total_records / $limit);
// ------------------------
?>

<style>
    /* === POPUP CSS (Yeh page specific hai isliye yahan rakha hai) === */
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
        box-shadow: 0 0 15px rgba(0,0,0,0.2);
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
        background: rgba(0,0,0,0.7);
        z-index: 1000;
    }
    .scroll-hide { overflow: hidden; }
    .menu-pop-clo {
        position: absolute;
        top: 10px;
        right: 15px;
        cursor: pointer;
        font-size: 20px;
        color: #333;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translate(-50%, -60%); }
        to { opacity: 1; transform: translate(-50%, -50%); }
    }
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
                    <!-- SIDEBAR FILTERS -->
                    <div class="col-md-3 fil-mob-view">
                        <span class="filter-clo">+</span>
                        <form action="#" method="post">
                            <div class="filt-com lhs-cate">
                                <h4><i><span class="material-icons">123</span></i>Age <span class="text-danger">*</span></h4>
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group">
                                            <select class="chosen-select" name="agefrom">
                                                <option value="">From</option>
                                                <option value="18">18</option>
                                                <option value="25">25</option>
                                                <option value="30">30</option>
                                                <option value="35">35</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="chosen-select" name="ageto">
                                                <option value="">To</option>
                                                <option value="25">25</option>
                                                <option value="30">30</option>
                                                <option value="35">35</option>
                                                <option value="40">40</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="filt-com lhs-cate">
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
                            </div>

                            <div class="filt-com lhs-cate">
                                <h4><i><span class="material-symbols-outlined">diversity_4</span></i>Marital Status</h4>
                                <div class="form-group">
                                    <select class="chosen-select" name="maritalstatus">
                                        <option value="">Select</option>
                                        <option value="Never Married">Never Married</option>
                                        <option value="Divorced">Divorced</option>
                                        <option value="Widowed">Widowed</option>
                                        <option value="Awaiting Divorce">Awaiting Divorce</option>
                                    </select>
                                </div>
                            </div>

                            <div class="filt-com lhs-cate">
                                <h4><i><span class="material-symbols-outlined">temple_hindu</span></i>Religion</h4>
                                <div class="form-group">
                                    <select class="chosen-select" name="religion">
                                        <option value="">Select</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Muslim">Muslim</option>
                                        <option value="Christian">Christian</option>
                                        <option value="Sikh">Sikh</option>
                                    </select>
                                </div>
                            </div>

                            <div class="filt-com lhs-cate">
                                <h4><i><span class="material-symbols-outlined">location_on</span></i>City</h4>
                                <div class="form-group">
                                    <select class="chosen-select" name="city[]" multiple>
                                        <option value="Delhi">Delhi</option>
                                        <option value="Mumbai">Mumbai</option>
                                        <option value="Bangalore">Bangalore</option>
                                        <option value="Chennai">Chennai</option>
                                    </select>
                                </div>
                            </div>

                            <div class="filt-com lhs-cate">
                                <button type="button" class="cta-3 w-100 text-center">Search</button>
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
                                        <div class="form-group oldnew">
                                            <select class="chosen-select p-2" id="sortby">
                                                <option value="">Select</option>
                                                <option value="desc">Date listed: Newest</option>
                                                <option value="asc">Date listed: Oldest</option>
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
                                // === DYNAMIC PHP LOOP STARTS HERE ===
                                // Fetch data from dummy-profile table with LIMIT and OFFSET
                                $sql_profiles = "SELECT * FROM `dummy-profile` ORDER BY id DESC LIMIT $offset, $limit";
                                $result_profiles = mysqli_query($con, $sql_profiles);

                                if (mysqli_num_rows($result_profiles) > 0) {
                                    while ($row = mysqli_fetch_assoc($result_profiles)) {
                                        // Image path handling
                                        $image_path = 'images/profiles/' . $row['image'];
                                        // Fallback if image field is empty or file doesn't exist
                                        // (Note: file_exists check works best with absolute server path, here simplistic)
                                        if(empty($row['image'])){
                                            $image_path = 'images/user/default.jpg'; 
                                        }
                                ?>
                                <li>
                                    <div class="all-pro-box user-avil-onli head-pro2" data-useravil="avilyes" data-aviltxt="Available online">
                                        <!-- Profile Image -->
                                        <div class="pro-img">
                                            <div class="slid-inn pr-bio-c wedd-rel-pro sliderarrow m-0">
                                                <ul class="slider5">
                                                    <li>
                                                        <div class="wedd-rel-box">
                                                            <div class="wedd-rel-img">
                                                                <img src="<?php echo $image_path; ?>" alt="" onerror="this.src='images/user/default.jpg'">
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <!-- Profile Details -->
                                        <div class="pro-detail">
                                            <h4><a href="#"><?php echo htmlspecialchars($row['name']); ?></a></h4>
                                            <div><?php echo htmlspecialchars($row['profile_id']); ?></div>
                                            <div class="pro-info-status mobile mb-2"></div>
                                            
                                            <!-- Bio Part 1: Personal -->
                                            <div class="pro-bio m-0 b-0 pb-1">
                                                <span><?php echo $row['age']; ?> Yrs</span>
                                                <span><?php echo $row['height']; ?></span>
                                                <span><?php echo $row['marital_status']; ?></span>
                                                <span><?php echo $row['religion']; ?>, <?php echo $row['caste']; ?></span>
                                            </div>

                                            <!-- Bio Part 2: Professional -->
                                            <div class="pro-bio m-0 pt-0">
                                                <span><?php echo $row['education']; ?></span>
                                                <span><?php echo $row['profession']; ?></span>
                                                <span><?php echo $row['city']; ?></span>
                                            </div>

                                            <!-- Links that trigger Popup -->
                                            <div class="links">
                                                <a href="#!">Profile</a>
                                                <a href="#!">Contact</a>
                                                <a href="#!">Shortlist</a>
                                                <a href="#!">WhatsApp</a>
                                                <!-- Dropdown (Optional) -->
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
                                // Previous Button
                                if ($page > 1) {
                                    echo '<li class="page-item"><a class="page-link" href="?page='.($page - 1).'">Previous</a></li>';
                                } else {
                                    echo '<li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>';
                                }

                                // Page Numbers
                                for ($i = 1; $i <= $total_pages; $i++) {
                                    $active = ($i == $page) ? 'active' : '';
                                    echo '<li class="page-item '.$active.'"><a class="page-link" href="?page='.$i.'">'.$i.'</a></li>';
                                }

                                // Next Button
                                if ($page < $total_pages) {
                                    echo '<li class="page-item"><a class="page-link" href="?page='.($page + 1).'">Next</a></li>';
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

    <!-- FOOTER -->
    <?php include 'footer.php'; ?>

    <!-- POPUP HTML (Hidden by default) -->
    <div class="menu-pop menu-pop2" style="">
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
    $(document).ready(function(){
        // 1. Initialize Slider if content exists
        if($('.slider5').length > 0) {
             $('.slider5').slick({
                dots: false, infinite: true, speed: 300, slidesToShow: 1, adaptiveHeight: true, arrows: true
            });
        }

        // 2. POPUP LOGIC for ANY link inside .links
        // Using 'document' delegation so it works even if content loads via AJAX later
        $(document).on('click', '.links a', function(e){
            e.preventDefault(); 
            $(".menu-pop2").addClass("act"); 
            $(".pop-bg").fadeIn(); 
            $("body").addClass("scroll-hide"); 
        });

        // 3. Close Popup Actions
        $(".menu-pop-clo, .pop-bg").on('click', function(){
            $(".menu-pop2").removeClass("act");
            $(".pop-bg").fadeOut();
            $("body").removeClass("scroll-hide");
        });
        
        // 4. Grid View / List View Toggles (Restored from static)
        $(".sort-grid-1").click(function(){
            $(".all-list-sh").addClass("grid-view");
            $(".sort-grid-1").addClass("act");
            $(".sort-grid-2").removeClass("act");
        });
        $(".sort-grid-2").click(function(){
            $(".all-list-sh").removeClass("grid-view");
            $(".sort-grid-2").addClass("act");
            $(".sort-grid-1").removeClass("act");
        });
    });
    </script>
</body>
</html>