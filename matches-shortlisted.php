<?php
include 'config.php';

// 1. Auth Check (Must be before any output)
if(!isset($_COOKIE['dr_userid']) || empty($_COOKIE['dr_userid'])) {
    header('location:login.php');
    exit;
}

$userid = $_COOKIE['dr_userid'];

include 'header.php';

// 2. Pagination & Sorting Logic
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
if($page < 1) {
    $page = 1;
}
$lower_limit = ($page - 1) * 3;

$sort = "DESC"; // Default sort
if(isset($_GET['sort']) && $_GET['sort'] == 'asc') {
    $sort = "ASC";
}

// 3. Count Total Shortlisted Profiles (For Pagination)
// Using count(distinct for_who) to be safe against duplicates
$sql_count = "SELECT COUNT(DISTINCT for_who) as total FROM shortlist_ids WHERE by_whom = '$userid'";
$res_count = mysqli_query($con, $sql_count);
$row_count = mysqli_fetch_assoc($res_count);
$total_count = $row_count['total'];
?>

    <!-- SUB-HEADING -->
    <section>
        <div class="all-pro-head">
            <div class="container">
                <div class="row">
                    <h1>Shortlisted Profiles</h1>
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
                        <?php include 'filter-sidebar.php'; ?>
                    </div>
                    <div class="col-md-9">
                        <div class="short-all">
                            <div class="short-lhs">
                                Showing <b><?php echo $total_count; ?></b> profiles
                            </div>
                            <div class="short-rhs">
                                <ul>
                                    <li>
                                        Sort by:
                                    </li>
                                    <li>
                                        <div class="form-group oldnew">
                                            <select class="chosen-select p-2" id="sortby" onchange="window.location.href='matches-shortlisted.php?sort='+this.value">
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
                                // 4. Main Query: Fetch Shortlisted IDs
                                // Orders by 'id' which acts as timestamp (higher ID = newer)
                                $sqlinfo = "SELECT * FROM shortlist_ids WHERE by_whom = '$userid' ORDER BY id $sort LIMIT $lower_limit, 3";
                                $resultinfo = mysqli_query($con, $sqlinfo);

                                if(mysqli_num_rows($resultinfo) > 0)
                                {
                                    while($rowinfo = mysqli_fetch_assoc($resultinfo))
                                    {
                                        $profileid = $rowinfo['for_who']; // The ID of the person I shortlisted
                                        $shortlist_db_id = $rowinfo['id']; // ID of the shortlist record (for deletion)

                                        // Fetch User Data for the shortlisted profile
                                        $sqlbasicinfo = "SELECT * FROM basic_info WHERE userid = '$profileid'";
                                        $resultbasicinfo = mysqli_query($con,$sqlbasicinfo);
                                        
                                        // Skip if profile deleted or not found
                                        if(mysqli_num_rows($resultbasicinfo) == 0) continue;
                                        
                                        $rowbasicinfo = mysqli_fetch_assoc($resultbasicinfo);
                                        
                                        $sqlreligiousinfo = "SELECT * FROM religious_info WHERE userid = '$profileid'";
                                        $resultreligiousinfo = mysqli_query($con,$sqlreligiousinfo);
                                        $rowreligiousinfo = mysqli_fetch_assoc($resultreligiousinfo);
                                        
                                        $sqleducationinfo = "SELECT * FROM education_info WHERE userid = '$profileid'";
                                        $resulteducationinfo = mysqli_query($con,$sqleducationinfo);
                                        $roweducationinfo = mysqli_fetch_assoc($resulteducationinfo);
                                        
                                        $sqllocationinfo = "SELECT * FROM groom_location WHERE userid = '$profileid'";
                                        $resultlocationinfo = mysqli_query($con,$sqllocationinfo);
                                        $rowlocationinfo = mysqli_fetch_assoc($resultlocationinfo);
                                        
                                        $sqlphotoinfo = "SELECT * FROM photos_info WHERE userid = '$profileid'";
                                        $resultphotoinfo = mysqli_query($con,$sqlphotoinfo);
                                        $rowphotoinfo = mysqli_fetch_assoc($resultphotoinfo);
                                        
                                        $sqlregistration = "SELECT * FROM registration WHERE userid = '$profileid'";
                                        $resultregistration = mysqli_query($con,$sqlregistration);
                                        $rowregistration = mysqli_fetch_assoc($resultregistration);
                                        
                                        // Check Block Status (Have I blocked them?)
                                        $sqlblock = "SELECT * FROM block_ids WHERE by_whom = '$userid' AND for_who = '$profileid'";
                                        $resultblock = mysqli_query($con,$sqlblock);
                                        $countblock = mysqli_num_rows($resultblock);
                                        
                                        // Fallback for profile picture
                                        $profile_pic = "images/gif/not-found.gif";
                                        if(!empty($rowphotoinfo['profilepic'])) {
                                            $profile_pic = "userphoto/" . $rowphotoinfo['profilepic'];
                                        }
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
                                                                    <img src="<?php echo $profile_pic; ?>" alt="">
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <?php if(!empty($rowphotoinfo['photo1'])) { ?>
                                                        <li>
                                                            <div class="wedd-rel-box">
                                                                <div class="wedd-rel-img">
                                                                    <img src="userphoto/<?php echo $rowphotoinfo['photo1']?>" alt="">
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <?php } ?>
                                                        <?php if(!empty($rowphotoinfo['photo2'])) { ?>
                                                        <li>
                                                            <div class="wedd-rel-box">
                                                                <div class="wedd-rel-img">
                                                                    <img src="userphoto/<?php echo $rowphotoinfo['photo2']?>" alt="">
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <?php } ?>
                                                        <?php if(!empty($rowphotoinfo['photo3'])) { ?>
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
                                                    <?php if($countblock >= 1) { ?>
                                                        <span class="text-danger desktop" style="float: right;">You have blocked this member</span>
                                                    <?php } ?>
                                                </div>
                                                <div class="pro-info-status mobile mb-2">
                                                    <?php if($rowregistration['verificationinfo'] == 'Done') { ?>
                                                        <span class="stat-6 text-success"><i class="fa fa-shield text-success" aria-hidden="true"></i>&nbsp;ID Verified</span>
                                                    <?php } ?>
                                                    <?php if($countblock >= 1) { ?>
                                                        <span class="stat-5 m-0"><b>You blocked this member</b></span>
                                                    <?php } ?>
                                                </div>
                                                <div class="pro-bio m-0 b-0 pb-0">
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
                                                    <a href="user-profile-details.php?uid=<?php echo $rowbasicinfo['userid']; ?>">View Profile</a>
                                                    
                                                    <!-- REMOVE FROM SHORTLIST -->
                                                    <a href="delete-shortlisted.php?id=<?php echo $shortlist_db_id; ?>" class="ta-dark" onclick="return confirm('Are you sure you want to remove this profile from your shortlist?');">Remove</a>
                                                    
                                                    <?php if($countblock >= 1) { ?>
                                                        <a href="#" class="bg-danger text-white shortblock">WhatsApp</a>
                                                    <?php } else { ?>
                                                        <a href="https://api.whatsapp.com/send?text=Check this profile: https://myptetest.com/desirishta/user-profile-details.php?uid=<?php echo $rowbasicinfo['userid']; ?>" target="_blank">WhatsApp</a>
                                                    <?php } ?>
                                                    
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-outline-secondary blockreport" data-bs-toggle="dropdown">
                                                            <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <?php if($countblock == 0) { ?>
                                                                <li><a class="dropdown-item" href="insert-blockprofile.php?uid=<?php echo $rowbasicinfo['userid']; ?>">Block</a></li>
                                                            <?php } ?>
                                                            <li><a class="dropdown-item" href="matches-reportid.php?uid=<?php echo $rowbasicinfo['userid']; ?>">Report</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--END PROFILE NAME-->
                                            
                                            <!--SAVE-->
                                            <?php if($rowregistration['verificationinfo'] == 'Done') { ?>
                                                <span class="enq-sav text-success desktop" data-toggle="tooltip"><i class="fa fa-shield text-success" aria-hidden="true"></i>&nbsp;ID Verified</span>
                                            <?php } ?>
                                            <!--END SAVE-->
                                        </div>
                                    </li>
                                <?php
                                    }
                                } else {
                                ?>
                                    <li>
                                        <div class="all-pro-box user-avil-onli">
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
                                            <div class="pro-detail">
                                                <h4 class="profilenotfound"><a href="#">No shortlisted profiles found.</a></h4>
                                            </div>
                                        </div>
                                    </li>
                                <?php
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
    
    <!-- PAGINATION -->
    <section>
        <div class="blog-main">
            <div class="container">
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <div class="page-nation">
                            <ul class="pagination pagination-sm" style="justify-content: center;">
                                <?php
                                $total_page = ceil($total_count / 3);
                                $sort_param = isset($_GET['sort']) ? $_GET['sort'] : 'desc';
                                
                                // Previous Button
                                if($page > 1) {
                                    echo '<li class="page-item"><a class="page-link" href="matches-shortlisted.php?page='.($page - 1).'&sort='.$sort_param.'">Previous</a></li>';
                                }
                                
                                // Page Numbers
                                for($i = 1; $i <= $total_page; $i++) {
                                    $active = ($page == $i) ? 'active' : '';
                                    echo '<li class="page-item '.$active.'"><a class="page-link" href="matches-shortlisted.php?page='.$i.'&sort='.$sort_param.'">'.$i.'</a></li>';
                                }
                                
                                // Next Button
                                if($page < $total_page) {
                                    echo '<li class="page-item"><a class="page-link" href="matches-shortlisted.php?page='.($page + 1).'&sort='.$sort_param.'">Next</a></li>';
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