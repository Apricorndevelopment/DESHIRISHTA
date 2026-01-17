<?php
include 'header.php';
include 'config.php';

// 1. Auth Check
$userid = $_COOKIE['dr_userid'];

if ($userid == '') {
    header('location:login.php');
    exit;
}

// 2. Pagination & Sorting Setup
$results_per_page = 3; // Fixed to 3 (as per your original requirement)
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$lower_limit = ($page - 1) * $results_per_page;

// Handling Sort Safely
$current_sort = isset($_GET['sort']) ? $_GET['sort'] : 'desc';
$sort_sql = ($current_sort == 'asc') ? 'ASC' : 'DESC';

// 3. Count Total Blocked Profiles
$sqlcountregis = "SELECT COUNT(id) as total FROM block_ids WHERE by_whom = '$userid'";
$resultcountregis = mysqli_query($con, $sqlcountregis);
$rowcount = mysqli_fetch_assoc($resultcountregis);
$countregis = $rowcount['total'];

?>

<!-- CSS STYLES (Identical to All Profiles) -->
<style>
    /* Custom Action Button */
    .btn-action-outline {
        background-color: #fff;
        color: #000;
        border: 1px solid #333;
        padding: 5px 15px;
        font-size: 13px;
        border-radius: 30px;
        transition: all 0.3s ease;
        cursor: pointer;
        display: inline-block;
    }

    .btn-action-outline:hover {
        background-color: #333;
        color: #fff;
    }

    /* Status Badges */
    .pro-info-status {
        display: flex;
        gap: 10px;
        align-items: center;
        flex-wrap: wrap;
        margin-bottom: 8px;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
        line-height: 1;
    }

    /* Verified theme */
    .status-badge.verified {
        background: rgba(40, 167, 69, 0.15);
        color: #28a745;
    }

    /* Blocked theme */
    .status-badge.blocked {
        background: rgba(220, 53, 69, 0.15);
        color: #dc3545;
    }

    /* Reported theme */
    .status-badge.reported {
        background: rgba(255, 193, 7, 0.15);
        color: #d39e00;
    }

    /* Hide links styling for cleaner look */
    .links form { display: inline-block; }
    
    @media(max-width:576px) {
        .status-badge { font-size: 12px; padding: 5px 10px; }
    }
</style>

<section>
    <div class="all-pro-head">
        <div class="container">
            <div class="row">
                <h1>Blocked Profiles</h1>
            </div>
        </div>
    </div>
    <div class="fil-mob fil-mob-act">
        <h4>Profile filters <i class="fa fa-filter" aria-hidden="true"></i> </h4>
    </div>
</section>

<section>
    <div class="all-weddpro all-jobs all-serexp chosenini">
        <div class="container">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-md-3 fil-mob-view">
                    <span class="filter-clo">+</span>
                    <?php include 'filter-sidebar.php'; ?>
                </div>

                <!-- Main Content -->
                <div class="col-md-9">
                    <div class="short-all">
                        <div class="short-lhs">
                            Showing <b><?php echo $countregis; ?></b> blocked profiles
                        </div>
                        <div class="short-rhs">
                            <ul>
                                <li>Sort by:</li>
                                <li>
                                    <div class="form-group oldnew">
                                        <select class="chosen-select p-2" id="sortby" onchange="window.location.href='matches-blockid.php?sort='+this.value">
                                            <option value="desc" <?php if ($current_sort == 'desc') echo "selected"; ?>>Newest Blocked</option>
                                            <option value="asc" <?php if ($current_sort == 'asc') echo "selected"; ?>>Oldest Blocked</option>
                                        </select>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="all-list-sh">
                        <ul>
                            <?php
                            // ==========================================
                            // 4. LOGIC: FETCH FROM BLOCK_IDS WITH JOINS
                            // ==========================================
                            $sqlinfo = "
                                SELECT 
                                    blk.id as block_ref_id,
                                    r.userid, r.verificationinfo,
                                    b.fullname, b.age, b.height, b.marital,
                                    rel.religion, rel.caste,
                                    edu.education, edu.designation,
                                    loc.city, loc.state,
                                    p.profilepic, p.photo1, p.photo2, p.photo3,
                                    -- Check if I also reported them
                                    MAX(rpt.id) as is_reported
                                FROM block_ids blk
                                JOIN registration r ON blk.for_who = r.userid
                                LEFT JOIN basic_info b ON r.userid = b.userid
                                LEFT JOIN religious_info rel ON r.userid = rel.userid
                                LEFT JOIN education_info edu ON r.userid = edu.userid
                                LEFT JOIN groom_location loc ON r.userid = loc.userid
                                LEFT JOIN photos_info p ON r.userid = p.userid
                                LEFT JOIN report_ids rpt ON (rpt.by_who = '$userid' AND rpt.against = r.userid)
                                WHERE blk.by_whom = '$userid'
                                GROUP BY blk.id
                                ORDER BY blk.id $sort_sql 
                                LIMIT $lower_limit, $results_per_page
                            ";

                            $resultinfo = mysqli_query($con, $sqlinfo);

                            if (mysqli_num_rows($resultinfo) > 0) {
                                while ($rowinfo = mysqli_fetch_assoc($resultinfo)) {
                                    $profileid = $rowinfo['userid'];
                                    
                                    // Image Logic
                                    $prof_pic = !empty($rowinfo['profilepic']) ? "userphoto/" . $rowinfo['profilepic'] : "images/gif/not-found.gif";
                            ?>
                                    <li>
                                        <div class="all-pro-box user-avil-onli">
                                            <!-- LEFT: Image Slider -->
                                            <div class="pro-img">
                                                <div class="slid-inn pr-bio-c wedd-rel-pro sliderarrow m-0">
                                                    <ul class="slider5">
                                                        <li>
                                                            <div class="wedd-rel-box">
                                                                <div class="wedd-rel-img"><img src="<?php echo $prof_pic; ?>" alt=""></div>
                                                            </div>
                                                        </li>
                                                        <?php if (!empty($rowinfo['photo1'])) { ?><li>
                                                                <div class="wedd-rel-box">
                                                                    <div class="wedd-rel-img"><img src="userphoto/<?php echo $rowinfo['photo1']; ?>" alt=""></div>
                                                                </div>
                                                            </li><?php } ?>
                                                        <?php if (!empty($rowinfo['photo2'])) { ?><li>
                                                                <div class="wedd-rel-box">
                                                                    <div class="wedd-rel-img"><img src="userphoto/<?php echo $rowinfo['photo2']; ?>" alt=""></div>
                                                                </div>
                                                            </li><?php } ?>
                                                    </ul>
                                                </div>
                                            </div>

                                            <!-- RIGHT: Details -->
                                            <div class="pro-detail">
                                                <h4><a href="user-profile-details.php?uid=<?php echo $profileid; ?>"><?php echo $rowinfo['fullname']; ?></a></h4>
                                                <div><?php echo $profileid; ?></div>

                                                <!-- Status Badges -->
                                                <div class="pro-info-status mb-2">
                                                    <!-- Always show Blocked Badge here -->
                                                    <span class="status-badge blocked">
                                                        <i class="fa fa-ban"></i> Blocked
                                                    </span>

                                                    <?php if ($rowinfo['verificationinfo'] == '1' || $rowinfo['verificationinfo'] == 'Done') { ?>
                                                        <span class="status-badge verified">
                                                            <i class="fa fa-check-circle"></i> ID Verified
                                                        </span>
                                                    <?php } ?>

                                                    <?php if (!empty($rowinfo['is_reported'])) { ?>
                                                        <span class="status-badge reported">
                                                            <i class="fa fa-exclamation-triangle"></i> Reported
                                                        </span>
                                                    <?php } ?>
                                                </div>

                                                <!-- Bio Grid -->
                                                <div class="pro-bio m-0 b-0 pb-1">
                                                    <span><?php echo $rowinfo['age']; ?> Yrs</span>
                                                    <span><?php echo $rowinfo['height']; ?></span>
                                                    <span><?php echo $rowinfo['marital']; ?></span>
                                                    <span><?php echo $rowinfo['religion'] . ', ' . $rowinfo['caste']; ?></span>
                                                </div>
                                                <div class="pro-bio m-0 pt-0">
                                                    <span><?php echo $rowinfo['education']; ?></span>
                                                    <span><?php echo $rowinfo['designation']; ?></span>
                                                    <span><?php echo $rowinfo['city'] . ', ' . $rowinfo['state']; ?></span>
                                                </div>

                                                <!-- Actions -->
                                                <div class="links">
                                                    <a href="user-profile-details.php?uid=<?php echo $profileid; ?>">View Profile</a>

                                                    <!-- Unblock Action -->
                                                    <a href="delete-blockprofile.php?uid=<?php echo $profileid; ?>" class="btn-action-outline">
                                                        Unblock User
                                                    </a>

                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-outline-secondary blockreport" data-bs-toggle="dropdown">
                                                            <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item" href="matches-reportid.php?uid=<?php echo $profileid; ?>">Report</a></li>
                                                        </ul>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </li>
                            <?php
                                }
                            } else {
                                echo "<li><div class='all-pro-box'><h4 class='text-center p-4'>No blocked profiles found.</h4></div></li>";
                            }
                            ?>
                        </ul>
                    </div>

                    <!-- Pagination -->
                    <div class="page-nation">
                        <ul class="pagination pagination-sm" style="justify-content:center;">
                            <?php
                            $total_pages = ceil($countregis / $results_per_page);

                            // Prev Button
                            if ($page > 1) {
                                echo '<li class="page-item"><a class="page-link" href="matches-blockid.php?page=' . ($page - 1) . '&sort=' . $current_sort . '">Previous</a></li>';
                            }

                            // Page Numbers
                            for ($i = 1; $i <= $total_pages; $i++) {
                                $active = ($page == $i) ? 'active' : '';
                                echo '<li class="page-item ' . $active . '"><a class="page-link" href="matches-blockid.php?page=' . $i . '&sort=' . $current_sort . '">' . $i . '</a></li>';
                            }

                            // Next Button
                            if ($page < $total_pages) {
                                echo '<li class="page-item"><a class="page-link" href="matches-blockid.php?page=' . ($page + 1) . '&sort=' . $current_sort . '">Next</a></li>';
                            }
                            ?>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
</section>

<?php
include 'footer.php';
?>