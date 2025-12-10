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

$maritalstatus = $_POST['maritalstatus'];
if($maritalstatus != '')
{
    $marital_data = " and marital = '".$maritalstatus."'";
}

$religion = $_POST['religion'];
if($religion != '')
{
    $religion_data = " and religion = '".$religion."'";
}

$caste = str_replace("//", "','", implode("//",$_POST['caste']));
if($caste != '')
{
    $caste_data = " and caste in ('".$caste."')";
}

$manglik = $_POST['manglik'];
if($manglik != '')
{
    $manglik_data = " and manglik = '".$manglik."'";
}

$education = str_replace("//", "','", implode("//",$_POST['education']));
if($education != '')
{
    $education_data = " and education in ('".$education."')";
}

$domain = str_replace("//", "','", implode("//", $_POST['domain']));
if($domain != '')
{
    $domain_data = " and profession in ('".$domain."')";
}

$income = $_POST['income'];
if($income != '')
{
    $income_data = " and income = '".$income."'";
}

$city = str_replace("//", "','", implode("//", $_POST['city']));
if($city != '')
{
    $city_data = " and city in ('".$city."')";
}

$country = str_replace("//", "','", implode("//", $_POST['country']));
if($country != '')
{
    $country_data = " and country in ('".$country."')";
}

$sqlcountregis = "select * from final_bio where $age_data $height_data $marital_data $religion_data $caste_data $manglik_data $education_data $domain_data $income_data $city_data $country_data and userid != '$userid' and gender != '$gender' and delete_status != 'delete'";
$resultcountregis = mysqli_query($con,$sqlcountregis);
$countregis = mysqli_num_rows($resultcountregis);

?>
    <!-- SUB-HEADING -->
    <section>
        <div class="all-pro-head">
            <div class="container">
                <div class="row">
                    <h1>Filter Profiles</h1>
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
                                Showing <b><?php echo $countregis; ?></b> profiles
                            </div>
                            <div class="short-rhs">
                                <ul>
                                    <li>
                                        Sort by:
                                    </li>
                                    <li>
                                        <div class="form-group oldnew">
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
                                
                                $sqlinfo = "select * from final_bio where $age_data $height_data $marital_data $religion_data $caste_data $manglik_data $education_data $domain_data $income_data $city_data $country_data and userid != '$userid' and gender != '$gender' and delete_status != 'delete' order by id $sort limit $lower_limit,3";
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
                                                <div class="all-pro-box user-avil-onli <?php if($userid == '') { echo "head-pro2"; } ?>" data-useravil="avilyes" data-aviltxt="Available online">
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
                                                        <?php
                                                        if($userid != '')
                                                        {
                                                        ?>
                                                        <h4><a href="user-profile-details.php?uid=<?php echo $rowbasicinfo['userid']; ?>"><?php echo $rowbasicinfo['fullname']; ?></a></h4>
                                                        <?php
                                                        }
                                                        else
                                                        {
                                                        ?>
                                                        <h4><a href="#"><?php echo $rowbasicinfo['fullname']; ?></a></h4>
                                                        <?php
                                                        }
                                                        ?>
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
                                                            <span class="stat-6 text-success" data-toggle="tooltip" title="Click to save this provile."><i class="fa fa-shield text-success" aria-hidden="true"></i>&nbsp;ID Verified</span>
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
                                                        <?php
                                                        if($userid != '')
                                                        {
                                                        ?>
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
                                                        <?php
                                                        }
                                                        else
                                                        {
                                                        ?>
                                                        <div class="links">
                                                            <a href="#">Profile</a>
                                                            <a href="#">Contact</a>
                                                            <a href="#">Shortlist</a>
                                                            <a href="#">WhatsApp</a>
                                                            <div class="dropdown">
                                                                <button type="button" class="btn btn-outline-secondary blockreport" data-bs-toggle="dropdown">
                                                                    <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                                                </button>
                                                                <ul class="dropdown-menu">
                                                                <?php
                                                                if($countblock == '0')
                                                                {
                                                                ?>
                                                                    <li><a class="dropdown-item" href="#">Block</a></li>
                                                                <?php
                                                                }
                                                                ?>
                                                                    <li><a class="dropdown-item" href="#">Report</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        }
                                                        ?>
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
                                $sqltotalentry = "select * from final_bio where $age_data $height_data $marital_data $religion_data $caste_data $manglik_data $education_data $domain_data $income_data $city_data $country_data and userid != '$userid' and gender != '$gender' and delete_status != 'delete'";
                                $resulttotalentry = mysqli_query($con,$sqltotalentry);
                                $counttotalentry = mysqli_num_rows($resulttotalentry);
                                $total_page = ceil($counttotalentry/3);
                                
                                if($page >= 2)
                                {
                                ?>
                                <li class="page-item"><a class="page-link" href="filter-profiles.php?page=<?php echo $page - 1; ?>&sort=<?php echo $_GET['sort']; ?>">Previous</a></li>
                                <?php
                                }
                                if($total_page >= 1)
                                {
                                ?>
                                <li class="page-item <?php if($page == '1') { echo "active"; }?>"><a class="page-link" href="filter-profiles.php?page=1&sort=<?php echo $_GET['sort']; ?>">1</a></li>
                                <?php
                                }
                                if($total_page >= 2)
                                {
                                ?>
                                <li class="page-item <?php if($page == '2') { echo "active"; }?>"><a class="page-link" href="filter-profiles.php?page=2&sort=<?php echo $_GET['sort']; ?>">2</a></li>
                                <?php
                                }
                                if($total_page >= 3)
                                {
                                ?>
                                <li class="page-item <?php if($page == '3') { echo "active"; }?>"><a class="page-link" href="filter-profiles.php?page=3&sort=<?php echo $_GET['sort']; ?>">3</a></li>
                                <?php
                                }
                                if($total_page >= 4)
                                {
                                ?>
                                <li class="page-item <?php if($page == '4') { echo "active"; }?>"><a class="page-link" href="filter-profiles.php?page=4&sort=<?php echo $_GET['sort']; ?>">4</a></li>
                                <?php
                                }
                                if($total_page >= 5)
                                {
                                ?>
                                <li class="page-item <?php if($page == '5') { echo "active"; }?>"><a class="page-link" href="filter-profiles.php?page=5&sort=<?php echo $_GET['sort']; ?>">5</a></li>
                                <?php
                                }
                                if($total_page >= 6)
                                {
                                ?>
                                <li class="page-item <?php if($page == '6') { echo "active"; }?>"><a class="page-link" href="filter-profiles.php?page=6&sort=<?php echo $_GET['sort']; ?>">6</a></li>
                                <?php
                                }
                                if($total_page >= 7)
                                {
                                ?>
                                <li class="page-item <?php if($page == '7') { echo "active"; }?>"><a class="page-link" href="filter-profiles.php?page=7&sort=<?php echo $_GET['sort']; ?>">7</a></li>
                                <?php
                                }
                                if($total_page > $page)
                                {
                                ?>
                                <li class="page-item"><a class="page-link" href="filter-profiles.php?page=<?php echo $page + 1; ?>&sort=<?php echo $_GET['sort']; ?>">Next</a></li>
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
 