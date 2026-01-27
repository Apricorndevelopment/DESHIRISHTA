<?php
// 1. Debugging ON (Error dekhne ke liye)
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'config.php';

// 2. Connection Check (Agar variable name $conn hai to use $con me dalenge)
if (!isset($con) && isset($conn)) {
    $con = $conn;
}
if (!isset($con) || !$con) {
    die("<script>alert('CRITICAL ERROR: Database connection variable ($con) nahi mila. config.php check karein.');</script>");
}

// 3. Login Check
$userid = isset($_COOKIE['dr_userid']) ? $_COOKIE['dr_userid'] : '';

if($userid == '')
{
    header('location:login.php');
    exit(); // Yahan exit lagana zaroori hai
}

// 4. Page Number Logic
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
if($page < 1) { $page = 1; }

$lower_page = $page - 1;
$lower_limit = $lower_page * 3;

// 5. Main Query with POPUP Error Handling
// FIX: 'firstapprove' column viewvist_ids table me nahi hai, isliye hata diya gya hai.
$sqlvisited = "select DISTINCT(view) from viewvist_ids where visit = '$userid' and delete_status != 'delete'";
$resultvisited = mysqli_query($con, $sqlvisited);

// --- ERROR POPUP START ---
if (!$resultvisited) {
    $error_msg = mysqli_error($con);
    echo "<script>
        alert('QUERY ERROR AA GYI HAI:\\n\\n" . addslashes($error_msg) . "');
        window.history.back();
    </script>";
    exit(); // Page yahi rok denge
}
// --- ERROR POPUP END ---

$rowvisited = mysqli_num_rows($resultvisited);

?>

<?php 
include 'header.php';
?>

<!-- SUB-HEADING -->
<section>
    <div class="all-pro-head">
        <div class="container">
            <div class="row">
                <h1>Recent Visitors Profiles</h1>
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
                    <?php
                    // Check if file exists to avoid warning
                    if(file_exists('filter-sidebar.php')) {
                        include 'filter-sidebar.php';
                    } else {
                        echo "<p>Filter sidebar not found</p>";
                    }
                    ?>
                </div>
                <div class="col-md-9">
                    <div class="short-all">
                        <div class="short-lhs">
                            Showing <b><?php echo $rowvisited; ?></b> profiles
                        </div>
                        <div class="short-rhs">
                            <ul>
                                <li>
                                    Sort by:
                                </li>
                                <li>
                                    <div class="form-group oldnew">
                                        <select class="chosen-select p-2 " id="sortby">
                                            <option value="">Select</option>
                                            <option value="desc" <?php if(isset($_GET['sort']) && $_GET['sort'] == 'desc') { echo "selected"; } ?>>Date listed: Newest</option>
                                            <option value="asc" <?php if(isset($_GET['sort']) && $_GET['sort'] == 'asc') { echo "selected"; } ?>>Date listed: Oldest</option>
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
                            // Sort Logic
                            $sort_val = isset($_GET['sort']) ? $_GET['sort'] : 'desc';
                            if($sort_val != 'asc' && $sort_val != 'desc') { $sort_val = 'desc'; }

                            // FIX: Removed 'and firstapprove = 1' here as well
                            $sqlinfo = "select distinct(view) from viewvist_ids where visit = '$userid' and delete_status != 'delete' order by id $sort_val limit $lower_limit,3";
                            $resultinfo = mysqli_query($con,$sqlinfo);
                            
                            // Inner Query Check
                            if(!$resultinfo) {
                                echo "Error in list query: " . mysqli_error($con);
                            } else {
                                $countinfo = mysqli_num_rows($resultinfo);
                                
                                if($countinfo != 0)
                                {
                                    while($rowinfo = mysqli_fetch_assoc($resultinfo))
                                    {
                                        $profileid = $rowinfo['view'];
                                        
                                        // Helper function to safely fetch row (avoids crashes)
                                        if (!function_exists('safe_get_row')) {
                                            function safe_get_row($con, $sql) {
                                                $res = mysqli_query($con, $sql);
                                                if($res && mysqli_num_rows($res) > 0) {
                                                    return mysqli_fetch_assoc($res);
                                                }
                                                return []; // Return empty array if failed
                                            }
                                        }

                                        $rowbasicinfo = safe_get_row($con, "select * from basic_info where userid = '$profileid'");
                                        $rowreligiousinfo = safe_get_row($con, "select * from religious_info where userid = '$profileid'");
                                        $roweducationinfo = safe_get_row($con, "select * from education_info where userid = '$profileid'");
                                        $rowlocationinfo = safe_get_row($con, "select * from groom_location where userid = '$profileid'");
                                        $rowphotoinfo = safe_get_row($con, "select * from photos_info where userid = '$profileid'");
                                        $rowregistration = safe_get_row($con, "select * from registration where userid = '$profileid'");
                                        
                                        // Count queries
                                        $resultblock = mysqli_query($con, "select * from block_ids where by_whom = '$userid' and for_who = '$profileid'");
                                        $countblock = ($resultblock) ? mysqli_num_rows($resultblock) : 0;
                                        
                                        $resultshortlist = mysqli_query($con, "select * from shortlist_ids where by_whom = '$userid' and for_who = '$profileid'");
                                        $countshortlist = ($resultshortlist) ? mysqli_num_rows($resultshortlist) : 0;

                                        // Safety check: ensure basic info exists
                                        if(empty($rowbasicinfo)) { continue; } 
                                        ?>
                                        <li>
                                            <div class="all-pro-box user-avil-onli" data-useravil="avilyes"
                                                data-aviltxt="Available online">
                                                <!--PROFILE IMAGE-->
                                                <div class="pro-img">
                                                    <div class="slid-inn pr-bio-c wedd-rel-pro sliderarrow m-0">
                                                        <ul class="slider5">
                                                            <?php
                                                            if(isset($rowphotoinfo['profilepic']) && $rowphotoinfo['profilepic'] != '') { ?>
                                                            <li>
                                                                <div class="wedd-rel-box">
                                                                    <div class="wedd-rel-img">
                                                                        <img src="userphoto/<?php echo $rowphotoinfo['profilepic']?>" alt="">
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <?php } 
                                                            if(isset($rowphotoinfo['photo1']) && $rowphotoinfo['photo1'] != '') { ?>
                                                            <li>
                                                                <div class="wedd-rel-box">
                                                                    <div class="wedd-rel-img">
                                                                        <img src="userphoto/<?php echo $rowphotoinfo['photo1']?>" alt="">
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <?php } 
                                                            if(isset($rowphotoinfo['photo2']) && $rowphotoinfo['photo2'] != '') { ?>
                                                            <li>
                                                                <div class="wedd-rel-box">
                                                                    <div class="wedd-rel-img">
                                                                        <img src="userphoto/<?php echo $rowphotoinfo['photo2']?>" alt="">
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <?php }
                                                            if(isset($rowphotoinfo['photo3']) && $rowphotoinfo['photo3'] != '') { ?>
                                                            <li>
                                                                <div class="wedd-rel-box">
                                                                    <div class="wedd-rel-img">
                                                                        <img src="userphoto/<?php echo $rowphotoinfo['photo3']?>" alt="">
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <?php } ?>
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
                                                        if(isset($rowregistration['verificationinfo']) && $rowregistration['verificationinfo'] == 'Done')
                                                        {
                                                        ?>
                                                            <span class="stat-6 text-success" data-toggle="tooltip" ><i class="fa fa-shield text-success" aria-hidden="true"></i>&nbsp;ID Verified</span>
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
                                                    <div class="pro-bio m-0 b-0 pb-0">
                                                        <span><?php echo isset($rowbasicinfo['age']) ? $rowbasicinfo['age'].' Yrs' : ''; ?></span>
                                                        <span><?php echo isset($rowbasicinfo['height']) ? $rowbasicinfo['height'] : ''; ?></span>
                                                        <span><?php echo isset($rowbasicinfo['marital']) ? $rowbasicinfo['marital'] : ''; ?></span>
                                                        <span><?php echo (isset($rowreligiousinfo['religion']) ? $rowreligiousinfo['religion'] : '') . ', ' . (isset($rowreligiousinfo['caste']) ? $rowreligiousinfo['caste'] : ''); ?></span>
                                                    </div>    
                                                    <div class="pro-bio m-0 pt-0">
                                                        <span><?php echo isset($roweducationinfo['education']) ? $roweducationinfo['education'] : ''; ?></span>
                                                        <span><?php echo isset($roweducationinfo['designation']) ? $roweducationinfo['designation'] : ''; ?></span>
                                                        <span><?php echo (isset($rowlocationinfo['city']) ? $rowlocationinfo['city'] : '') . ', ' . (isset($rowlocationinfo['state']) ? $rowlocationinfo['state'] : ''); ?></span>
                                                    </div>
                                                    <div class="links">
                                                        <a href="user-profile-details.php?uid=<?php echo $rowbasicinfo['userid']; ?>">Profile</a>
                                                        <!-- <a href="user-profile-details.php?uid=<?php echo $rowbasicinfo['userid']; ?>&#contactinfo">Contact</a> -->
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
                                                </div>
                                                <!--END PROFILE NAME-->
                                                <!--SAVE-->
                                                <?php
                                                if(isset($rowregistration['verificationinfo']) && $rowregistration['verificationinfo'] == 'Done')
                                                {
                                                ?>
                                                <span class="enq-sav text-success desktop" data-toggle="tooltip" ><i class="fa fa-shield text-success" aria-hidden="true"></i>&nbsp;ID Verified</span>
                                                <?php
                                                }
                                                ?>
                                                <!--END SAVE-->
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
                                                <div class="slid-inn pr-bio-c wedd-rel-pro sliderarrow m-0 p-0">
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
                                                <h4 class="profilenotfound"><a href="#">Profiles not found</a></h4>
                                            </div>
                                            <!--END PROFILE NAME-->
                                        </div>
                                    </li>
                                <?php
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END -->

<!-- START -->
<section>
    <div class="blog-main">
        <div class="container">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="page-nation">
                        <ul class="pagination pagination-sm" style="justify-content: center;">
                            <?php
                            // FIX: Removed 'and firstapprove = 1' here as well
                            $sqltotalentry = "select distinct(view) from viewvist_ids where visit = '$userid' and delete_status != 'delete'";
                            $resulttotalentry = mysqli_query($con,$sqltotalentry);
                            
                            if($resulttotalentry) {
                                $counttotalentry = mysqli_num_rows($resulttotalentry);
                                $total_page = ceil($counttotalentry/3);
                                $sort_url = isset($_GET['sort']) ? $_GET['sort'] : 'desc';

                                if($page >= 2) {
                                ?>
                                <li class="page-item"><a class="page-link" href="matches-visitors.php?page=<?php echo $page - 1; ?>&sort=<?php echo $sort_url; ?>">Previous</a></li>
                                <?php }
                                
                                // Limit pagination buttons logic can be added here, showing basic for now
                                for($i = 1; $i <= $total_page; $i++) {
                                    if($i <= 5) { // Showing first 5 for safety, customize as needed
                                    ?>
                                    <li class="page-item <?php if($page == $i) { echo "active"; }?>"><a class="page-link" href="matches-visitors.php?page=<?php echo $i; ?>&sort=<?php echo $sort_url; ?>"><?php echo $i; ?></a></li>
                                    <?php
                                    }
                                }

                                if($total_page > $page) {
                                ?>
                                <li class="page-item"><a class="page-link" href="matches-visitors.php?page=<?php echo $page + 1; ?>&sort=<?php echo $sort_url; ?>">Next</a></li>
                                <?php
                                }
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
<!-- END -->

<?php
include 'footer.php';
?>