<?php
include 'header.php';
include 'config.php';

$userid = $_COOKIE['dr_userid'];
$state = $_COOKIE['dr_state'];
$gender = $_COOKIE['dr_gender'];

if($userid == '')
{
    header('location:login.php');
}
?>
    <!-- LOGIN -->
    <section>
        <div class="db">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-lg-3">
                        <?php
                        include 'user-sidebar.php';
                        ?>
                    </div>
                    <div class="col-md-8 col-lg-9">
                        <div class="row">
                            <div class="col-lg-12 col-xl-12">
                                <h2 class="db-tit">Summary</h2>
                            </div>
                            <div class="col-lg-12 col-xl-4 mb-3">
                                <div class="db-pro-stat p-3 pt-1 pb-1">
                                    <div class="db-inte-prof-list db-inte-prof-chat">
                                        <ul>
                                            <li>
                                                <div class="db-int-pro-1"> <img src="images/gif/allprofiles.gif" alt=""> </div>
                                                <div class="db-int-pro-2">
                                                    <?php
                                                    $sqlallprofile = "select * from registration where userid != '$userid' and gender != '$gender' and delete_status != 'delete' and firstapprove = '1'";
                                                    $resultallprofile = mysqli_query($con,$sqlallprofile);
                                                    $countallprofile = mysqli_num_rows($resultallprofile)
                                                    ?>
                                                    <h5><?php echo $countallprofile; ?></h5> 
                                                    <span><b>All Profiles</b></span> 
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-4 mb-3">
                                <div class="db-pro-stat p-3 pt-1 pb-1">
                                    <div class="db-inte-prof-list db-inte-prof-chat">
                                        <ul>
                                            <li>
                                                <div class="db-int-pro-1"> <img src="images/gif/recentvisitors.gif" alt=""> </div>
                                                <div class="db-int-pro-2">
                                                    <?php
                                                    $today_date = date("Y-m-d");
                                                    $seven_days = date("Y-m-d", strtotime('-7 days'));
                                                    
                                                    $sqlnewmatches = "select * from registration where userid != '$userid' and gender != '$gender' and delete_status != 'delete' and entrydate between '$seven_days' and '$today_date'";
                                                    $resultnewmatches = mysqli_query($con,$sqlnewmatches);
                                                    $countnewmatches = mysqli_num_rows($resultnewmatches);
                                                    ?>
                                                    <h5><?php echo $countnewmatches; ?></h5> 
                                                    <span><b>New Matches</b></span> 
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-4 mb-3">
                                <div class="db-pro-stat p-3 pt-1 pb-1">
                                    <div class="db-inte-prof-list db-inte-prof-chat">
                                        <ul>
                                            <li>
                                                <div class="db-int-pro-1"> <img src="images/gif/mymatches.gif" alt=""> </div>
                                                <div class="db-int-pro-2">
                                                    <h5>0</h5> 
                                                    <span><b>My Matches</b></span> 
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-4 mb-3">
                                <div class="db-pro-stat p-3 pt-1 pb-1">
                                    <div class="db-inte-prof-list db-inte-prof-chat">
                                        <ul>
                                            <li>
                                                <div class="db-int-pro-1"> <img src="images/gif/nearbymatches-pin.gif" alt=""> </div>
                                                <div class="db-int-pro-2">
                                                    <?php
                                                    $sqlnearby = "select * from registration where userid != '$userid' and gender != '$gender' and state = '$state'  and delete_status != 'delete'";
                                                    $resultnearby = mysqli_query($con,$sqlnearby);
                                                    $rownearby = mysqli_num_rows($resultnearby);
                                                    ?>
                                                    <h5><?php echo $rownearby; ?></h5> 
                                                    <span><b>Nearby Matches</b></span> 
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-4 mb-3">
                                <div class="db-pro-stat p-3 pt-1 pb-1">
                                    <div class="db-inte-prof-list db-inte-prof-chat">
                                        <ul>
                                            <li>
                                                <div class="db-int-pro-1"> <img src="images/gif/recentlyviewed.gif" alt=""> </div>
                                                <div class="db-int-pro-2">
                                                    <?php
                                                    $sqlviewed = "select DISTINCT(visit) from viewvist_ids where view = '$userid' and visit != '' and delete_status != 'delete'";
                                                    $resultviewed = mysqli_query($con,$sqlviewed);
                                                    $rowviewed = mysqli_num_rows($resultviewed);
                                                    ?>
                                                    <h5><?php echo $rowviewed; ?></h5> 
                                                    <span><b>Recently Viewed</b></span> 
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-4 mb-3">
                                <div class="db-pro-stat p-3 pt-1 pb-1">
                                    <div class="db-inte-prof-list db-inte-prof-chat">
                                        <ul>
                                            <li>
                                                <div class="db-int-pro-1"> <img src="images/gif/like.gif" alt=""> </div>
                                                <div class="db-int-pro-2">
                                                    <?php
                                                    $sqlvisited = "select DISTINCT(view) from viewvist_ids where visit = '$userid' and view != '' and delete_status != 'delete'";
                                                    $resultvisited = mysqli_query($con,$sqlvisited);
                                                    $rowvisited = mysqli_num_rows($resultvisited);
                                                    ?>
                                                    <h5><?php echo $rowvisited; ?></h5> 
                                                    <span><b>Recent Visitors</b></span> 
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-4 mb-3">
                                <div class="db-pro-stat p-3 pt-1 pb-1">
                                    <div class="db-inte-prof-list db-inte-prof-chat">
                                        <ul>
                                            <li>
                                                <div class="db-int-pro-1"> <img src="images/gif/shortlistedlist.gif" alt=""> </div>
                                                <div class="db-int-pro-2">
                                                    <?php
                                                    $sqlshortlisted = "select * from shortlist_ids where by_whom = '$userid' and delete_status != 'delete'";
                                                    $resultshortlisted = mysqli_query($con,$sqlshortlisted);
                                                    $countshortlisted = mysqli_num_rows($resultshortlisted);
                                                    ?>
                                                    <h5><?php echo $countshortlisted; ?></h5> 
                                                    <span><b>Shortlisted Members</b></span> 
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-4 mb-3">
                                <div class="db-pro-stat p-3 pt-1 pb-1">
                                    <div class="db-inte-prof-list db-inte-prof-chat">
                                        <ul>
                                            <li>
                                                <div class="db-int-pro-1"> <img src="images/gif/contactviews.gif" alt=""> </div>
                                                <div class="db-int-pro-2">
                                                    <?php
                                                    $sqlcontact = "select DISTINCT(visit) from viewvist_ids where view = '$userid' and delete_status != 'delete'";
                                                    $resultcontact = mysqli_query($con,$sqlcontact);
                                                    $rowcontact = mysqli_num_rows($resultcontact);
                                                    ?>
                                                    <h5><?php echo $rowcontact; ?></h5> 
                                                    <span><b>Contact Views</b></span> 
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-4 mb-3">
                                <div class="db-pro-stat p-3 pt-1 pb-1">
                                    <div class="db-inte-prof-list db-inte-prof-chat">
                                        <ul>
                                            <li>
                                                <div class="db-int-pro-1"> <img src="images/gif/whatsappshare.gif" alt=""> </div>
                                                <div class="db-int-pro-2">
                                                    <h5>0</h5> 
                                                    <span><b>Whatsapp Shares</b></span> 
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12 col-lg-6 col-xl-4 db-sec-com">
                                <h2 class="db-tit">Profiles completion</h2>
                                <div class="db-pro-stat h-85">
                                    <h6>Profile completion</h6>
                                    <div class="db-pro-pgog">
                                        <?php
                                        $sqlprofilecomplete = "select * from registration where userid='$userid'";
                                        $resultprofilecomplete = mysqli_query($con,$sqlprofilecomplete);
                                        $resultprofilecomplete = mysqli_fetch_assoc($resultprofilecomplete);
                                        
                                        if($resultprofilecomplete['basicinfo'] == 'Done')
                                        {
                                            $basicinfo = '10';
                                        }
                                        if($resultprofilecomplete['aboutme'] == 'Done')
                                        {
                                            $aboutme = '10';
                                        }
                                        if($resultprofilecomplete['astroinfo'] == 'Done')
                                        {
                                            $astroinfo = '10';
                                        }
                                        if($resultprofilecomplete['religiousinfo'] == 'Done')
                                        {
                                            $religiousinfo = '10';
                                        }
                                        if($resultprofilecomplete['educationinfo'] == 'Done')
                                        {
                                            $educationinfo = '10';
                                        }
                                        if($resultprofilecomplete['familyinfo'] == 'Done')
                                        {
                                            $familyinfo = '10';
                                        }
                                        if($resultprofilecomplete['hobbiesinfo'] == 'Done')
                                        {
                                            $hobbiesinfo = '10';
                                        }
                                        if($resultprofilecomplete['partnerinfo'] == 'Done')
                                        {
                                            $partnerinfo = '10';
                                        }
                                        if($resultprofilecomplete['contactinfo'] == 'Done')
                                        {
                                            $contactinfo = '10';
                                        }
                                        if($resultprofilecomplete['photosinfo'] == 'Done')
                                        {
                                            $photosinfo = '10';
                                        }
                                        ?>
                                        <span><b class="count"><?php echo ($basicinfo + $aboutme + $astroinfo + $religiousinfo + $educationinfo + $familyinfo + $hobbiesinfo + $partnerinfo + $contactinfo + $photosinfo); ?></b>%</span>
                                    </div>
                                    <?php
                                    $sqlformfill = "select * from registration where userid = '$userid'";
                                    $resultformfill = mysqli_query($con,$sqlformfill);
                                    $rowformfill = mysqli_fetch_assoc($resultformfill);
                                    ?>
                                    <ul class="pro-stat-ic">
                                        <li class="roundicon <?php if($rowformfill['basicinfo'] == 'Done') { echo "bg-success"; } else { echo "bg-danger"; }?>"><span class="material-symbols-outlined">contacts</span></li>
                                        <li class="roundicon <?php if($rowformfill['aboutme'] == 'Done') { echo "bg-success"; } else { echo "bg-danger"; }?>"><span class="material-symbols-outlined">person</span></li>
                                        <li class="roundicon <?php if($rowformfill['astroinfo'] == 'Done') { echo "bg-success"; } else { echo "bg-danger"; }?>"><span class="material-symbols-outlined">brightness_auto</span></li>
                                        <li class="roundicon <?php if($rowformfill['religiousinfo'] == 'Done') { echo "bg-success"; } else { echo "bg-danger"; }?>"><span class="material-symbols-outlined">temple_hindu</span></li>
                                        <li class="roundicon <?php if($rowformfill['educationinfo'] == 'Done') { echo "bg-success"; } else { echo "bg-danger"; }?>"><span class="material-symbols-outlined">school</span></li>
                                        <li class="roundicon <?php if($rowformfill['familyinfo'] == 'Done') { echo "bg-success"; } else { echo "bg-danger"; }?>"><span class="material-symbols-outlined">family_restroom</span></li>
                                        <li class="roundicon <?php if($rowformfill['hobbiesinfo'] == 'Done') { echo "bg-success"; } else { echo "bg-danger"; }?>"><span class="material-symbols-outlined">interests</span></li>
                                        <li class="roundicon <?php if($rowformfill['partnerinfo'] == 'Done') { echo "bg-success"; } else { echo "bg-danger"; }?>"><span class="material-symbols-outlined">diversity_2</span></li>
                                        <li class="roundicon <?php if($rowformfill['contactinfo'] == 'Done') { echo "bg-success"; } else { echo "bg-danger"; }?>"><span class="material-symbols-outlined">call</span></li>
                                        <li class="roundicon <?php if($rowformfill['photosinfo'] == 'Done') { echo "bg-success"; } else { echo "bg-danger"; }?>"><span class="material-symbols-outlined">photo_camera</span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6 col-xl-4 db-sec-com">
                                <h2 class="db-tit">Plan details</h2>
                                <div class="db-pro-stat h-85">
                                    <h6 class="tit-top-curv">Standard plan</h6>
                                    <div class="db-plan-card">
                                        <img src="images/icon/plan.png" alt="">
                                    </div>
                                    <div class="db-plan-detil mt-3">
                                        <?php
                                        $joindate = "select * from registration where userid = '$userid'";
                                        $resultjoindate = mysqli_query($con,$joindate);
                                        $rowjoindate = mysqli_fetch_assoc($resultjoindate);
                                        
                                        $tilldate = date('M d, Y H:i:s', strtotime('+14 day',strtotime($rowjoindate['entrydate'])));
                                        ?>
                                        <script>
                                        // Set the date we're counting down to
                                        var countDownDate = new Date("<?php echo $tilldate; ?>").getTime();
                                        
                                        // Update the count down every 1 second
                                        var x = setInterval(function() {
                                        
                                          // Get today's date and time
                                          var now = new Date().getTime();
                                            
                                          // Find the distance between now and the count down date
                                          var distance = countDownDate - now;
                                            
                                          // Time calculations for days, hours, minutes and seconds
                                          var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                          var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                          var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                          var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                                            
                                          // Output the result in an element with id="demo"
                                          document.getElementById("demo").innerHTML = days + "d " + hours + "h "
                                          + minutes + "m " + seconds + "s ";
                                            
                                          // If the count down is over, write some text 
                                          if (distance < 0) {
                                            clearInterval(x);
                                            document.getElementById("demo").innerHTML = "EXPIRED";
                                          }
                                        }, 1000);
                                        </script>
                                        <ul>
                                            <li>Plan name: <strong>Free</strong></li>
                                            <li>Validity: <strong>Unlimited</strong></li>
                                            <li>Join Date: <strong><?php echo date('d M Y', strtotime($rowjoindate['entrydate'])); ?></strong></li>
                                            <!--<li>Valid till: <strong id="demo"></strong></li>-->
                                            <li><a href="#" class="cta-3">Comming Soon</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-4 db-sec-com">
                                <h2 class="db-tit">Recent Visitors</h2>
                                    <div class="db-pro-stat overflow h-85">
                                        <div class="db-inte-prof-list db-inte-prof-chat">
                                            <?php
                                            /*and entrydate between '$seven_days' and '$today_date'*/
                                            $sqlvisitors = "select distinct(view) from viewvist_ids where visit = '$userid' and view != '' and delete_status != 'delete' order by id desc limit 50";
                                            $resultvisitors = mysqli_query($con,$sqlvisitors);
                                            $countvisitors = mysqli_num_rows($resultvisitors);
                                            if($countvisitors == 0)
                                            {
                                            ?>
                                                <img src="userphoto/recent-visitors.gif" alt="" style="width:100%">
                                                <p class="text-center"><b>No Visitors Yet</b></p>
                                            <?php
                                            } 
                                            else
                                            {
                                            ?>
                                            <ul class="slider11">
                                            <?php
                                                    while($rowvisitors = mysqli_fetch_assoc($resultvisitors))
                                                    {
                                                        $pro_id = $rowvisitors['view'];
                                                        
                                                        $sqlphoto = "select * from photos_info where userid = '$pro_id'";
                                                        $resultphoto = mysqli_query($con,$sqlphoto);
                                                        $rowphoto = mysqli_fetch_assoc($resultphoto);
                                        
                                                        $sqlbasic = "select * from basic_info where userid = '$pro_id'";
                                                        $resultbasic = mysqli_query($con,$sqlbasic);
                                                        $rowbasic = mysqli_fetch_assoc($resultbasic);
                                                        
                                                        $sqllocation = "select * from groom_location where userid = '$pro_id'";
                                                        $resultlocation = mysqli_query($con,$sqllocation);
                                                        $rowlocation = mysqli_fetch_assoc($resultlocation);
                                                     ?>
                                                    <li>
                                                        <div class="db-int-pro-1"> <img src="userphoto/<?php echo $rowphoto['profilepic']?>" alt=""> </div>
                                                        <div class="db-int-pro-2">
                                                            <h5><?php echo $rowbasic['fullname']; ?></h5> 
                                                            <span><?php echo $rowlocation['city'].', '.$rowlocation['country'] ?></span> 
                                                        </div>
                                                        <a href="user-profile-details.php?uid=<?php echo $pro_id; ?>" class="fclick">&nbsp;</a>
                                                    </li>
                                                    <?php
                                                    }
                                            
                                            ?>
                                            </ul>
                                            <?php
                                            }
                                            ?>
                                            
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="col-md-12 db-sec-com db-new-pro-main">
                            <h2 class="db-tit">New Profiles Matches</h2>
                            <ul class="slider">
                                <?php
                                $sqlprofile = "select * from registration where userid != '$userid' and gender != '$gender' and delete_status != 'delete' order by id desc limit 50";
                                $resultprofile = mysqli_query($con,$sqlprofile);
                                while($rowprofile = mysqli_fetch_assoc($resultprofile))
                                {
                                    $profileid = $rowprofile['userid'];
                                    
                                    $sqlbasicinfo = "select * from basic_info where userid = '$profileid'";
                                    $resultbasicinfo = mysqli_query($con,$sqlbasicinfo);
                                    $rowbasicinfo = mysqli_fetch_assoc($resultbasicinfo);
                                    
                                    $sqlphotoinfo = "select * from photos_info where userid = '$profileid'";
                                    $resultphotoinfo = mysqli_query($con,$sqlphotoinfo);
                                    $rowphotoinfo = mysqli_fetch_assoc($resultphotoinfo);
                                    
                                    $sqllocationinfo = "select * from groom_location where userid = '$profileid'";
                                    $resultlocationinfo = mysqli_query($con,$sqllocationinfo);
                                    $rowlocationinfo = mysqli_fetch_assoc($resultlocationinfo);
                                ?>
                                <li>
                                    <div class="db-new-pro">
                                        <img src="userphoto/<?php echo $rowphotoinfo['profilepic']?>" alt="" class="profile">
                                        <div>
                                            <h5><?php echo $rowbasicinfo['fullname']; ?></h5>
                                            <span class="city"><?php echo $rowlocationinfo['city']; ?></span>
                                            <br>
                                            <span class="age"><?php echo $rowbasicinfo['age']; ?> Years</span>
                                        </div>
                                        <a href="user-profile-details.php?uid=<?php echo $profileid; ?>" class="fclick">&nbsp;</a>
                                    </div>
                                </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                        <!--<div class="row">
                            <div class="col-md-12 db-sec-com">
                                <h2 class="db-tit">Profiles views</h2>
                                <div class="chartin">
                                    <canvas id="Chart_leads"></canvas>
                                </div>
                            </div>
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END -->
    
    <!-- CONTACT EXPERT -->
    <div class="menu-pop menu-pop1">
        <span class="menu-pop-clo"><i class="fa fa-times" aria-hidden="true"></i></span>
        <div class="inn">
            <div class="col-md-12 db-sec-com db-new-pro-main">
                <ul class="slider12">
                    <?php
                    if($id_profilestatus == '0' && $id_profilestatus_popup == '0')
                    {
                        $sqlupdate1 = "UPDATE `registration` SET `profilestatus_popup`='1' WHERE `userid`='$userid'";
                        $resultupdate1 = mysqli_query($con,$sqlupdate1);
                    ?>
                    <li>
                        <div class="menu-pop-help">
                            <h4>Welcome To Desi Rishta</h4>
                            <div class="user-pro">
                                <img src="images/gif/notscreened.gif" alt="" loading="lazy">
                            </div>
                            <div class="user-bio mt-3">
                                <h5>"Your profile is under screening will be made live shortly” </h5>                             
                            </div>
                        </div>
                    </li>
                    <?php
                    }
                    if($id_profilestatus == '1' && $id_profilestatus_popup == '0')
                    {
                        $sqlupdate2 = "UPDATE `registration` SET `profilestatus_popup`='1' WHERE `userid`='$userid'";
                        $resultupdate2 = mysqli_query($con,$sqlupdate2);
                    ?>
                    <li>
                        <div class="menu-pop-help">
                            <h4>Welcome To Desi Rishta</h4>
                            <div class="user-pro">
                                <img src="images/gif/screeningcompleted.gif" alt="" loading="lazy">
                            </div>
                            <div class="user-bio mt-3">
                                <h5>"Your profile screening is complete. It's now live!” </h5>                               
                            </div>
                        </div>
                    </li> 
                    <?php
                    }
                    if($id_verification != 'Done' && $id_verification_popup == '0')
                    {
                        $sqlupdate3 = "UPDATE `registration` SET `verification_popup`='1' WHERE `userid`='$userid'";
                        $resultupdate3 = mysqli_query($con,$sqlupdate3);
                    ?>
                    <li>
                        <div class="menu-pop-help">
                            <h4>Welcome To Desi Rishta</h4>
                            <div class="user-pro">
                                <img src="images/gif/unverifiedidentity.gif" alt="" loading="lazy">
                            </div>
                            <div class="user-bio mt-3">
                                <h5>"Complete verification to earn your trust badge” </h5>
                                <br>
                                <a href="trust-badge.php" class="btn btn-primary btn-sm">Verify Now</a>                               
                            </div>
                        </div>
                    </li> 
                    <?php
                    }
                    if($id_verification == 'Done' && $id_verification_popup == '0')
                    {
                        $sqlupdate4 = "UPDATE `registration` SET `verification_popup`='1' WHERE `userid`='$userid'";
                        $resultupdate4 = mysqli_query($con,$sqlupdate4);
                    ?>
                    <li>
                        <div class="menu-pop-help">
                            <h4>Welcome To Desi Rishta</h4>
                            <div class="user-pro">
                                <img src="images/gif/verifiedidentity.gif" alt="" loading="lazy">
                            </div>
                            <div class="user-bio mt-3">
                                <h5>"Congratulations! You've Earned Your Trust Badge” </h5>                            
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
    <!-- END -->

<?php
include 'footer.php'; 
?>

    
    
    
    
    <?php
    if($id_profilestatus_popup == '0')
    {
    ?>
        <script>
            $(document).ready(function(){
                $('.menu-pop1, .pop-bg').addClass('act');
            });
        </script>
    <?php
    }
    if($id_verification_popup == '0')
    {
    ?>
        <script>
            $(document).ready(function(){
                $('.menu-pop1, .pop-bg').addClass('act');
            });
        </script>
    <?php
    }
    ?>