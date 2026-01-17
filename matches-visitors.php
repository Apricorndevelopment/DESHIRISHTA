<?php
include 'header.php';
include 'config.php';

$userid = $_COOKIE['dr_userid'];

if($userid == '')
{
    header('location:login.php');
}

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

$sqlvisited = "select DISTINCT(view) from viewvist_ids where visit = '$userid' and delete_status != 'delete' and firstapprove = '1'";
$resultvisited = mysqli_query($con,$sqlvisited);
$rowvisited = mysqli_num_rows($resultvisited);
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
                        include 'filter-sidebar.php';
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
                                
                                $sqlinfo = "select distinct(view) from viewvist_ids where visit = '$userid' and delete_status != 'delete' and firstapprove = '1' order by id $sort limit $lower_limit,3";
                                $resultinfo = mysqli_query($con,$sqlinfo);
                                $countinfo = mysqli_num_rows($resultinfo);
                                if($countinfo != 0)
                                {
                                    while($rowinfo = mysqli_fetch_assoc($resultinfo))
                                    {
                                        $profileid = $rowinfo['view'];
                                        
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
                                        
                                        $sqlregistration = "select * from registration where userid = '$profileid'";
                                        $resultregistration = mysqli_query($con,$sqlregistration);
                                        $rowregistration = mysqli_fetch_assoc($resultregistration);
                                        
                                        $sqlblock = "select * from block_ids where by_whom = '$userid' and for_who = '$profileid'";
                                        $resultblock = mysqli_query($con,$sqlblock);
                                        $countblock = mysqli_num_rows($resultblock);
                                        
                                        $sqlshortlist = "select * from shortlist_ids where by_whom = '$userid' and for_who = '$profileid'";
                                        $resultshortlist = mysqli_query($con,$sqlshortlist);
                                        $countshortlist = mysqli_num_rows($resultshortlist);
                                    ?>
                                    <li>
                                        <div class="all-pro-box user-avil-onli" data-useravil="avilyes"
                                            data-aviltxt="Available online">
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
                                                    if($rowregistration['verificationinfo'] == 'Done')
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
                                            </div>
                                            <!--END PROFILE NAME-->
                                            <!--SAVE-->
                                            <?php
                                            if($rowregistration['verificationinfo'] == 'Done')
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
                                $sqltotalentry = "select distinct(view) from viewvist_ids where visit = '$userid' and delete_status != 'delete' and firstapprove = '1'";
                                $resulttotalentry = mysqli_query($con,$sqltotalentry);
                                $counttotalentry = mysqli_num_rows($resulttotalentry);
                                $total_page = ceil($counttotalentry/3);
                                
                                if($page >= 2)
                                {
                                ?>
                                <li class="page-item"><a class="page-link" href="matches-visitors.php?page=<?php echo $page - 1; ?>&sort=<?php echo $_GET['sort']; ?>">Previous</a></li>
                                <?php
                                }
                                if($total_page >= 1)
                                {
                                ?>
                                <li class="page-item <?php if($page == '1') { echo "active"; }?>"><a class="page-link" href="matches-visitors.php?page=1&sort=<?php echo $_GET['sort']; ?>">1</a></li>
                                <?php
                                }
                                if($total_page >= 2)
                                {
                                ?>
                                <li class="page-item <?php if($page == '2') { echo "active"; }?>"><a class="page-link" href="matches-visitors.php?page=2&sort=<?php echo $_GET['sort']; ?>">2</a></li>
                                <?php
                                }
                                if($total_page >= 3)
                                {
                                ?>
                                <li class="page-item <?php if($page == '3') { echo "active"; }?>"><a class="page-link" href="matches-visitors.php?page=3&sort=<?php echo $_GET['sort']; ?>">3</a></li>
                                <?php
                                }
                                if($total_page >= 4)
                                {
                                ?>
                                <li class="page-item <?php if($page == '4') { echo "active"; }?>"><a class="page-link" href="matches-visitors.php?page=4&sort=<?php echo $_GET['sort']; ?>">4</a></li>
                                <?php
                                }
                                if($total_page >= 5)
                                {
                                ?>
                                <li class="page-item <?php if($page == '5') { echo "active"; }?>"><a class="page-link" href="matches-visitors.php?page=5&sort=<?php echo $_GET['sort']; ?>">5</a></li>
                                <?php
                                }
                                if($total_page > $page)
                                {
                                ?>
                                <li class="page-item"><a class="page-link" href="matches-visitors.php?page=<?php echo $page + 1; ?>&sort=<?php echo $_GET['sort']; ?>">Next</a></li>
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
    </section>
    <!-- END -->



 <?php
 include 'footer.php';
 ?>
 