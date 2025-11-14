<?php
include 'header.php';
include 'config.php';

date_default_timezone_set('Asia/kolkata'); 

$loginid = $_COOKIE['dr_userid'];
$gender = $_COOKIE['dr_gender'];
$profileid = $_GET['uid'];

if($loginid == '')
{
    header('location:login.php');
}

$entrydate = date('Y-m-d');

$sqlcheck = "select * from viewvist_ids where view = '$loginid' and visit = '$profileid' and entrydate = '$entrydate'";
$resultcheck = mysqli_query($con,$sqlcheck);
$countcheck = mysqli_num_rows($resultcheck);

if($countcheck == 0)
{
    $sqlviewvisit = "INSERT INTO `viewvist_ids`(`view`, `visit`, `entrydate`) VALUES ('$loginid', '$profileid', '$entrydate')";
    $resultviewvisit = mysqli_query($con,$sqlviewvisit);
}
    
$sqlbasicinfo = "select * from basic_info where userid = '$profileid'";
$resultbasicinfo = mysqli_query($con,$sqlbasicinfo);
$rowbasicinfo = mysqli_fetch_assoc($resultbasicinfo);

$sqlastroinfo = "select * from astro_info where userid = '$profileid'";
$resultastroinfo = mysqli_query($con,$sqlastroinfo);
$rowastroinfo = mysqli_fetch_assoc($resultastroinfo);
                                    
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

$sqlcontactinfo = "select * from contact_info where userid = '$profileid'";
$resultcontactinfo = mysqli_query($con,$sqlcontactinfo);
$rowcontactinfo = mysqli_fetch_assoc($resultcontactinfo);

$sqlfamilyinfo = "select * from family_info where userid = '$profileid'";
$resultfamilyinfo = mysqli_query($con,$sqlfamilyinfo);
$rowfamilyinfo = mysqli_fetch_assoc($resultfamilyinfo);

$sqlhobbiesinfo = "select * from hobbies_info where userid = '$profileid'";
$resulthobbiesinfo = mysqli_query($con,$sqlhobbiesinfo);
$rowhobbiesinfo = mysqli_fetch_assoc($resulthobbiesinfo);
                                    
$sqlpartnerinfo = "select * from partner_info where userid = '$profileid'";
$resultpartnerinfo = mysqli_query($con,$sqlpartnerinfo);
$rowpartnerinfo = mysqli_fetch_assoc($resultpartnerinfo);

$sqlregistration = "select * from registration where userid = '$profileid'";
$resultregistration = mysqli_query($con,$sqlregistration);
$rowregistration = mysqli_fetch_assoc($resultregistration);

$sqlcountview = "select * from viewvist_ids where visit = '$profileid'";
$rowcountview = mysqli_query($con,$sqlcountview);
$countview = mysqli_num_rows($rowcountview);
?>


    <!-- PROFILE -->
    <section>
        <div class="profi-pg profi-ban">
            <div class="">
                <div class="">
                    <div class="profile">
                        <div class="pg-pro-big-im">
                            <div class="s1">
                                <div class="slid-inn pr-bio-c wedd-rel-pro sliderarrow m-0" id="gallery">
                                                <ul class="slider3" id="image-gallery" >
                                                    <?php
                                                    if($rowphotoinfo['profilepic'] != '')
                                                    {
                                                    ?>
                                                    <li class="p-0">
                                                        <div class="wedd-rel-box">
                                                            <div class="wedd-rel-img pro-gal-imag">
                                                                <div class="img-wrapper">
                                                                    <a href="#!"><img src="userphoto/<?php echo $rowphotoinfo['profilepic']?>" alt=""></a>
                                                                    <div class="img-overlay"><i class="fa fa-arrows-alt" aria-hidden="true"></i></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <?php
                                                    }
                                                    if($rowphotoinfo['photo1'] != '')
                                                    {
                                                    ?>
                                                    <li class="p-0">
                                                        <div class="wedd-rel-box">
                                                            <div class="wedd-rel-img pro-gal-imag">
                                                                <div class="img-wrapper">
                                                                <a href="#!"><img src="userphoto/<?php echo $rowphotoinfo['photo1']?>" alt=""></a>
                                                                <div class="img-overlay"><i class="fa fa-arrows-alt" aria-hidden="true"></i></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <?php
                                                    }
                                                    if($rowphotoinfo['photo2'] != '')
                                                    {
                                                    ?>
                                                    <li class="p-0">
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
                                                    <li class="p-0">
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
                            <div class="s3">
                                <a href="https://api.whatsapp.com/send?text=https://myptetest.com/desirishta/user-profile-details.php?uid=<?php echo $rowbasicinfo['userid']; ?>" target="_blank" class="cta fol w-100">WhatsApp</a>
                            </div>
                        </div>
                    </div>
                    <div class="profi-pg profi-bio">
                        <div class="lhs">
                            <div class="pro-pg-intro pr-bio-c">
                                <h1><?php echo $rowbasicinfo['fullname']; ?></h1>
                                <div class="mb-2 brown textcenter"><b><?php echo $rowbasicinfo['userid']; ?></b></div>
                                <div class="pro-info-status">
                                    <?php
                                    if($rowregistration['verificationinfo'] == 'Done')
                                    {
                                    ?>
                                    <span class="stat-3"><b>ID Verified</b></span>
                                    <?php
                                    }
                                    ?>
                                    <span class="stat-1"><b><?php echo $countview;?></b> viewers</span>
                                    <?php
                                    if($rowregistration['online'] == 'yes')
                                    {
                                    ?>
                                    <span class="stat-2"><b>Available</b></span>
                                    <?php
                                    }
                                    if($rowregistration['online'] == 'no')
                                    {
                                    ?>
                                    <span class="stat-4"><b>Unavailable</b></span>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <ul class="mb-3">
                                    <li>
                                        <div>
                                            <img src="images/gif/age.gif" loading="lazy" alt="">
                                            <span> <strong><?php echo $rowbasicinfo['age'].' Yrs'; ?></strong></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <img src="images/gif/height.gif" loading="lazy" alt="">
                                            <span> <strong><?php echo $rowbasicinfo['height']; ?></strong></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <img src="images/gif/religioncaste.gif" loading="lazy" alt="">
                                            <span> <strong><?php echo $rowreligiousinfo['religion'].', '.$rowreligiousinfo['caste']; ?></strong></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <img src="images/gif/graduation-cap.gif" loading="lazy" alt="">
                                            <span> <strong><?php echo $roweducationinfo['education']; ?></strong></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <img src="images/gif/career.gif" loading="lazy" alt="">
                                            <span> <strong><?php echo $roweducationinfo['designation']; ?></strong></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <img src="images/gif/location.gif" loading="lazy" alt="">
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
                                            <span> <strong><?php echo $city11.', '.$state11; ?></strong></span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <!-- PROFILE ABOUT -->
                            <div class="pr-bio-c pr-bio-abo" id="contactinfo">
                                <h3><img src="images/profilepage/aboutus.png" style="width:6%"> About <?php echo $rowbasicinfo['fullname']; ?></h3>
                                <p class="text-justify"><?php echo $rowbasicinfo['aboutme']; ?></p>
                            </div>
                            <!-- END PROFILE ABOUT -->
                            
                            
                            <!-- PROFILE ABOUT -->
                            <div class="pr-bio-c pr-bio-conta">
                                <h3><img src="images/profilepage/contactinfo.png" style="width:6%"> Contact information</h3>
                                <div class="conborder">
                                    <ul class="coninfo">
                                        <li><span><i class="fa fa-mobile" aria-hidden="true"></i><b>Phone</b><?php echo $rowcontactinfo['phonenumber']; ?>&nbsp;<i class="fa fa-check text-success b-0" aria-hidden="true"></i></span></li>
                                        <li><span><i class="fa fa-envelope-o" aria-hidden="true"></i><b>Email</b><?php echo $rowcontactinfo['email']; ?>&nbsp;<?php if($rowregistration['emailverify'] == '1') { echo '<i class="fa fa-check text-success b-0" aria-hidden="true"></i>'; } ?></span></li>
                                        <?php
                                        if($rowcontactinfo['contactperson'] != '')
                                        {
                                        ?>
                                        <li><span><i class="fa fa-user" aria-hidden="true"></i><b>Contact Person</b><?php echo $rowcontactinfo['contactperson']; ?></span></li>
                                        <?php
                                        }
                                        if($rowcontactinfo['relationship'] != '')
                                        {
                                        ?>
                                        <li><span><i class="fa fa-handshake-o" aria-hidden="true"></i><b>Relationship</b><?php echo $rowcontactinfo['relationship']; ?></span></li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                                <div class="lockscreen">
                                    <img src="images/gif/lock.gif" style="width: 8%; border: 2px solid rgb(104,72,52); border-radius: 50%; padding: 1%; background: #fff;">
                                    <span><span class="pink" id="removeblur">Click</span> to view contact details</span>
                                </div>
                            </div>
                            <!-- END PROFILE ABOUT -->
                            <!-- PROFILE ABOUT -->
                            <div class="pr-bio-c pr-bio-info">
                                <h3><img src="images/profilepage/basicinfo.png" style="width:6%"> Basic Information </h3>
                                <ul>
                                    <?php
                                    if($rowbasicinfo['createby'] != '')
                                    {
                                    ?>
                                    <li><b>Profile Created by</b> <?php echo $rowbasicinfo['createby']; ?></li>
                                    <?php
                                    }
                                    if($rowbasicinfo['gender'] != '')
                                    {
                                    ?>
                                    <li><b>Gender</b> <?php echo $rowbasicinfo['gender']; ?></li>
                                    <?php
                                    }
                                    if($rowbasicinfo['marital'] != '')
                                    {
                                    ?>
                                    <li><b>Marital Status</b> <?php echo $rowbasicinfo['marital']; ?></li>
                                    <?php
                                    }
                                    if($rowbasicinfo['marital'] == 'Divorced')
                                    {
                                    ?>
                                    <li><b>children</b> <?php echo $rowbasicinfo['children']; ?></li>
                                    <?php
                                    }
                                    if($rowbasicinfo['age'] != '')
                                    {
                                    ?>
                                    <li><b>Age</b> <?php echo $rowbasicinfo['age']; ?> Yrs</li>
                                    <?php
                                    }
                                    if($rowbasicinfo['height'] != '')
                                    {
                                    ?>
                                    <li><b>Height</b> <?php echo $rowbasicinfo['height']; ?></li>
                                    <?php
                                    }
                                    if($rowbasicinfo['weight'] != '')
                                    {
                                    ?>
                                    <li><b>Weight</b> <?php echo $rowbasicinfo['weight']; ?></li>
                                    <?php
                                    }
                                    if($rowbasicinfo['physical'] != '')
                                    {
                                    ?>
                                    <li><b>Any Disability</b> <?php echo $rowbasicinfo['physical']; ?></li>
                                    <?php
                                    }
                                    if($rowbasicinfo['langauge'] != '')
                                    {
                                    ?>
                                    <li><b>Languages Known</b> <?php echo str_replace("//", ", ",$rowbasicinfo['langauge']); ?></li>
                                    <?php
                                    }
                                    if($rowlocationinfo['country'] != '')
                                    {
                                    ?>
                                    <li><b>Country Living In</b> <?php echo $rowlocationinfo['country']; ?></li>
                                    <?php
                                    }
                                    if($rowlocationinfo['state'] != '')
                                    {
                                    ?>
                                    <li><b>State</b> <?php echo $rowlocationinfo['state']; ?></li>
                                    <?php
                                    }
                                    if($rowlocationinfo['city'] != '')
                                    {
                                    ?>
                                    <li><b>City</b> <?php echo $rowlocationinfo['city']; ?></li>
                                    <?php
                                    }
                                    if($rowlocationinfo['citizenship'] != '')
                                    {
                                    ?>
                                    <li><b>Citizenship</b> <?php echo $rowlocationinfo['citizenship']; ?></li>
                                    <?php
                                    }
                                    if($rowlocationinfo['resident'] != '')
                                    {
                                    ?>
                                    <li><b>Resident Status</b> <?php echo $rowlocationinfo['resident']; ?></li>
                                    <?php
                                    }
                                    if($rowbasicinfo['eating'] != '')
                                    {
                                    ?>
                                    <li><b>Eating Habits</b> <?php echo $rowbasicinfo['eating']; ?></li>
                                    <?php
                                    }
                                    if($rowbasicinfo['smoking'] != '')
                                    {
                                    ?>
                                    <li><b>Smoking Habits</b> <?php echo $rowbasicinfo['smoking']; ?></li>
                                    <?php
                                    }
                                    if($rowbasicinfo['drinking'] != '')
                                    {
                                    ?>
                                    <li><b>Drinking Habits</b> <?php echo $rowbasicinfo['drinking']; ?></li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                            <!-- END PROFILE ABOUT -->
                            <!-- PROFILE ABOUT -->
                            <div class="pr-bio-c pr-bio-info">
                                <h3><img src="images/profilepage/astrology.png" style="width:6%"> Astro Details </h3>
                                <ul>
                                    <?php
                                    if($rowastroinfo['dob'] != '')
                                    {
                                    ?>
                                    <li><b>Date of Birth</b> <?php echo date('d M Y', strtotime($rowastroinfo['dob'])); ?></li>
                                    <?php
                                    }
                                    if($rowastroinfo['birthplace'] != '')
                                    {
                                    ?>
                                    <li><b>Place of Birth</b> <?php echo $rowastroinfo['birthplace']; ?></li>
                                    <?php
                                    }
                                    if($rowastroinfo['birthtime'] != '')
                                    {
                                    ?>
                                    <li><b>Time of Birth</b> <?php echo $rowastroinfo['birthtime']; ?></li>
                                    <?php
                                    }
                                    if($rowastroinfo['manglik'] != '')
                                    {
                                    ?>
                                    <li><b>Dosh/Dosham</b> <?php echo $rowastroinfo['manglik']; ?></li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                            <!-- END PROFILE ABOUT -->
                            <!-- PROFILE ABOUT -->
                            <div class="pr-bio-c pr-bio-info">
                                <h3><img src="images/profilepage/religion.png" style="width:6%"> Religious Background  </h3>
                                <ul>
                                    <?php
                                    if($rowreligiousinfo['religion'] != '')
                                    {
                                    ?>
                                    <li><b>Religion</b> <?php echo $rowreligiousinfo['religion']; ?></li>
                                    <?php
                                    }
                                    if($rowreligiousinfo['caste'] != '')
                                    {
                                    ?>
                                    <li><b>Caste</b> <?php echo $rowreligiousinfo['caste']; ?></li>
                                    <?php
                                    }
                                    if($rowreligiousinfo['subcaste'] != '')
                                    {
                                    ?>
                                    <li><b>Subcaste</b> <?php echo $rowreligiousinfo['subcaste']; ?></li>
                                    <?php
                                    }
                                    if($rowreligiousinfo['gothram'] != '')
                                    {
                                    ?>
                                    <li><b>Gothram</b> <?php echo $rowreligiousinfo['gothram']; ?></li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                            <!-- END PROFILE ABOUT -->
                            <!-- PROFILE ABOUT -->
                            <div class="pr-bio-c pr-bio-info">
                                <h3><img src="images/profilepage/career.png" style="width:6%"> Education & Career </h3>
                                <ul>
                                    <?php
                                    if($roweducationinfo['stream'] != '')
                                    {
                                    ?>
                                    <li><b>Stream</b> <?php echo $roweducationinfo['stream']; ?></li>
                                    <?php
                                    }
                                    if($roweducationinfo['education'] != '')
                                    {
                                    ?>
                                    <li><b>Highest Education</b> <?php echo $roweducationinfo['education']; ?></li>
                                    <?php
                                    }
                                    if($roweducationinfo['college'] != '')
                                    {
                                    ?>
                                    <li><b>College/Institute</b> <?php echo $roweducationinfo['college']; ?></li>
                                    <?php
                                    }
                                    if($roweducationinfo['workingwith'] != '')
                                    {
                                    ?>
                                    <li><b>Working With</b> <?php echo $roweducationinfo['workingwith']; ?></li>
                                    <?php
                                    }
                                    if($roweducationinfo['profession'] != '')
                                    {
                                    ?>
                                    <li><b>Profession</b> <?php echo $roweducationinfo['profession']; ?></li>
                                    <?php
                                    }
                                    if($roweducationinfo['profession'] != '')
                                    {
                                    ?>
                                    <li><b>Designation</b> <?php echo $roweducationinfo['profession']; ?></li>
                                    <?php
                                    }
                                    if($roweducationinfo['professiondetail'] != '')
                                    {
                                    ?>
                                    <li><b>Profession in Detail</b> <?php echo $roweducationinfo['professiondetail']; ?></li>
                                    <?php
                                    }
                                    if($roweducationinfo['employername'] != '')
                                    {
                                    ?>
                                    <li><b>Employer Name</b> <?php echo $roweducationinfo['employername']; ?></li>
                                    <?php
                                    }
                                    if($roweducationinfo['income'] != '')
                                    {
                                    ?>
                                    <li><b>Annual Income</b> <?php echo $roweducationinfo['income']; ?></li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                            <!-- END PROFILE ABOUT -->
                            
                            <!-- PROFILE ABOUT -->
                            <div class="pr-bio-c pr-bio-info">
                                <h3><img src="images/profilepage/family.png" style="width:6%"> Family Details </h3>
                                <ul>
                                    <?php
                                    if($rowfamilyinfo['fathername'] != '')
                                    {
                                    ?>
                                    <li><b>Father Name</b> <?php echo $rowfamilyinfo['fathername']; ?></li>
                                    <?php
                                    }
                                    if($rowfamilyinfo['mothername'] != '')
                                    {
                                    ?>
                                    <li><b>Mother Name</b> <?php echo $rowfamilyinfo['mothername']; ?></li>
                                    <?php
                                    }
                                    if($rowfamilyinfo['fatheroccupation'] != '')
                                    {
                                    ?>
                                    <li><b>Father’s Occupation</b> <?php echo $rowfamilyinfo['fatheroccupation']; ?></li>
                                    <?php
                                    }
                                    if($rowfamilyinfo['motheroccupation'] != '')
                                    {
                                    ?>
                                    <li><b>Mother’s Occupation</b> <?php echo $rowfamilyinfo['motheroccupation']; ?></li>
                                    <?php
                                    }
                                    if($rowfamilyinfo['familyvalue'] != '')
                                    {
                                    ?>
                                    <li><b>Family Value</b> <?php echo $rowfamilyinfo['familyvalue']; ?></li>
                                    <?php
                                    }
                                    if($rowfamilyinfo['familytype'] != '')
                                    {
                                    ?>
                                    <li><b>Family Type</b> <?php echo $rowfamilyinfo['familytype']; ?></li>
                                    <?php
                                    }
                                    if($rowfamilyinfo['familystatus'] != '')
                                    {
                                    ?>
                                    <li><b>Family Status</b> <?php echo $rowfamilyinfo['familystatus']; ?></li>
                                    <?php
                                    }
                                    if($rowfamilyinfo['nativeplace'] != '')
                                    {
                                    ?>
                                    <li><b>Native Place</b> <?php echo $rowfamilyinfo['nativeplace']; ?></li>
                                    <?php
                                    }
                                    if($rowfamilyinfo['brothers'] != '')
                                    {
                                    ?>
                                    <li><b>No. of Brother</b> <?php echo $rowfamilyinfo['brothers']; ?></li>
                                    <?php
                                    }
                                    if($rowfamilyinfo['bromarried'] != '')
                                    {
                                    ?>
                                    <li><b>Bothers Married</b> <?php echo $rowfamilyinfo['bromarried']; ?></li>
                                    <?php
                                    }
                                    if($rowfamilyinfo['sisters'] != '')
                                    {
                                    ?>
                                    <li><b>No. of Sisters</b> <?php echo $rowfamilyinfo['sisters']; ?></li>
                                    <?php
                                    }
                                    if($rowfamilyinfo['sismarried'] != '')
                                    {
                                    ?>
                                    <li><b>Sisters Married</b> <?php echo $rowfamilyinfo['sismarried']; ?></li>
                                    <?php
                                    }
                                    if($rowfamilyinfo['country'] != '')
                                    {
                                    ?>
                                    <li><b>Country Living In</b> <?php echo $rowfamilyinfo['country']; ?></li>
                                    <?php
                                    }
                                    if($rowfamilyinfo['state'] != '')
                                    {
                                    ?>
                                    <li><b>State</b> <?php echo $rowfamilyinfo['state']; ?></li>
                                    <?php
                                    }
                                    if($rowfamilyinfo['city'] != '')
                                    {
                                    ?>
                                    <li><b>City</b> <?php echo $rowfamilyinfo['city']; ?></li>
                                    <?php
                                    }
                                    if($rowfamilyinfo[''] != '')
                                    {
                                    ?>
                                    <li><b>Citizenship</b> <?php echo $rowfamilyinfo['']; ?></li>
                                    <?php
                                    }
                                    if($rowfamilyinfo[''] != '')
                                    {
                                    ?>
                                    <li><b>Resident Status</b> <?php echo $rowfamilyinfo['']; ?></li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                            
                            <!-- END PROFILE ABOUT -->
                            <!-- PROFILE ABOUT -->
                            <div class="pr-bio-c pr-bio-hob">
                                <h3><img src="images/profilepage/hobbiesinterests.png" style="width:6%"> Hobbies and Interest</h3>
                                <ul>
                                    <?php
                                    $hobbies = $rowhobbiesinfo['hobbies'];
                                    $music = $rowhobbiesinfo['music'];
                                    $sports = $rowhobbiesinfo['sports'];
                                    $food  = $rowhobbiesinfo['food'];
                                    
                                    if($hobbies == "" && $music == "" && $sports == "" && $food == "")
                                    {
                                    ?>
                                        <li>User didn't share the details</li>
                                    <?php
                                    }
                                    else
                                    {
                                        $hobbies = explode("//", $rowhobbiesinfo['hobbies']);
                                        foreach($hobbies as $single_hobbies)
                                        {
                                        ?>
                                        <li><span><?php echo $single_hobbies; ?></span></li>
                                        <?php
                                        }
                                        
                                        $music = explode("//", $rowhobbiesinfo['music']);
                                        foreach($music as $single_music)
                                        {
                                        ?>
                                        <li><span><?php echo $single_music; ?></span></li>
                                        <?php
                                        }
                                        
                                        $sports = explode("//", $rowhobbiesinfo['sports']);
                                        foreach($sports as $single_sports)
                                        {
                                        ?>
                                        <li><span><?php echo $single_sports; ?></span></li>
                                        <?php
                                        }
                                        
                                        $food  = explode("//", $rowhobbiesinfo['food']);
                                        foreach($food as $single_food)
                                        {
                                        ?>
                                        <li><span><?php echo $single_food; ?></span></li>
                                        <?php
                                        }
                                    }
                                        ?>
                                </ul>
                            </div>
                            <!-- END PROFILE ABOUT -->
                            <!-- PROFILE ABOUT -->
                            <div class="pr-bio-c pr-bio-info">
                                <h3><img src="images/profilepage/preferences.png" style="width:6%"> Partner Preferences </h3>
                                <ul>
                                    <?php
                                    if($rowpartnerinfo['partnerage'] != '')
                                    {
                                    ?>
                                    <li><b>Partner Age</b> <?php echo $rowpartnerinfo['partnerage']; ?></li>
                                    <?php
                                    }
                                    if($rowpartnerinfo['partnerheight'] != '')
                                    {
                                    ?>
                                    <li><b>Height</b> <?php echo $rowpartnerinfo['partnerheight']; ?></li>
                                    <?php
                                    }
                                    if($rowpartnerinfo['partnermarital'] != '')
                                    {
                                    ?>
                                    <li><b>Marital Status</b> <?php echo $rowpartnerinfo['partnermarital']; ?></li>
                                    <?php
                                    }
                                    if($rowpartnerinfo['partnerphysical'] != '')
                                    {
                                    ?>
                                    <li><b>Physical Status</b> <?php echo $rowpartnerinfo['partnerphysical']; ?></li>
                                    <?php
                                    }
                                    if($rowpartnerinfo['partnereating'] != '')
                                    {
                                    ?>
                                    <li><b>Eatin Habits</b> <?php echo $rowpartnerinfo['partnereating']; ?></li>
                                    <?php
                                    }
                                    if($rowpartnerinfo['partnerdrinking'] != '')
                                    {
                                    ?>
                                    <li><b>Drinking Habits</b> <?php echo $rowpartnerinfo['partnerdrinking']; ?></li>
                                    <?php
                                    }
                                    if($rowpartnerinfo['partnersmoking'] != '')
                                    {
                                    ?>
                                    <li><b>Smoking Habits</b> <?php echo $rowpartnerinfo['partnersmoking']; ?></li>
                                    <?php
                                    }
                                    if($rowpartnerinfo['partnermanglik'] != '')
                                    {
                                    ?>
                                    <li><b>Dosh/Dosham</b> <?php echo $rowpartnerinfo['partnermanglik']; ?></li>
                                    <?php
                                    }
                                    if($rowpartnerinfo['partnerreligion'] != '')
                                    {
                                    ?>
                                    <li><b>Religion</b> <?php echo str_replace("//", ", ", $rowpartnerinfo['partnerreligion']); ?></li>
                                    <?php
                                    }
                                    if($rowpartnerinfo['partnercaste'] != '')
                                    {
                                    ?>
                                    <li><b>Caste</b> <?php echo str_replace("//", ", ", $rowpartnerinfo['partnercaste']); ?></li>
                                    <?php
                                    }
                                    if($rowpartnerinfo['partnergothram'] != '')
                                    {
                                    ?>
                                    <li><b>Gothram</b> <?php echo $rowpartnerinfo['partnergothram']; ?></li>
                                    <?php
                                    }
                                    if($rowpartnerinfo['partnerstream'] != '')
                                    {
                                    ?>
                                    <li><b>Stream</b> <?php echo str_replace("//", ", ", $rowpartnerinfo['partnerstream']); ?></li>
                                    <?php
                                    }
                                    if($rowpartnerinfo['partnereducation'] != '')
                                    {
                                    ?>
                                    <li><b>Highest Education</b> <?php echo str_replace("//", ", ", $rowpartnerinfo['partnereducation']); ?></li>
                                    <?php
                                    }
                                    if($rowpartnerinfo['partnerprofession'] != '')
                                    {
                                    ?>
                                    <li><b>Profession</b> <?php echo str_replace("//", ", ", $rowpartnerinfo['partnerprofession']); ?></li>
                                    <?php
                                    }
                                    if($rowpartnerinfo['partnerdomain'] != '')
                                    {
                                    ?>
                                    <li><b>Working With</b> <?php echo str_replace("//", ", ", $rowpartnerinfo['partnerdomain']); ?></li>
                                    <?php
                                    }
                                    if($rowpartnerinfo['partnerincome'] != '')
                                    {
                                    ?>
                                    <li><b>Annual Income</b> <?php echo $rowpartnerinfo['partnerincome']; ?></li>
                                    <?php
                                    }
                                    if($rowpartnerinfo['partnercity'] != '')
                                    {
                                    ?>
                                    <li><b>City</b> <?php echo str_replace("//", ", ", $rowpartnerinfo['partnercity']); ?></li>
                                    <?php
                                    }
                                    if($rowpartnerinfo['partnerstate'] != '')
                                    {
                                    ?>
                                    <li><b>State</b> <?php echo str_replace("//", ", ", $rowpartnerinfo['partnerstate']); ?></li>
                                    <?php
                                    }
                                    if($rowpartnerinfo['partnercountry'] != '')
                                    {
                                    ?>
                                    <li><b>Country</b> <?php echo str_replace("//", ", ", $rowpartnerinfo['partnercountry']); ?></li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                            <!-- END PROFILE ABOUT -->
                        </div>

                        <!-- PROFILE lHS -->
                        <div class="rhs">
                            <!-- RELATED PROFILES -->
                            <div class="slid-inn pr-bio-c wedd-rel-pro relatedprofile m-0">
                                <h3>Related profiles</h3>
                                <ul class="slider4">
                                    <?php
                                    $sqlbasicinfo11 = "select * from basic_info where userid = '$loginid'";
                                    $resultbasicinfo11 = mysqli_query($con,$sqlbasicinfo11);
                                    $rowbasicinfo11 = mysqli_fetch_assoc($resultbasicinfo11);
                                    $age = $rowbasicinfo11['age'];
                                    $height = $rowbasicinfo11['height'];
                                    $marital = $rowbasicinfo11['marital'];
                                    
                                    $sqlreligiousinfo11 = "select * from religious_info where userid = '$loginid'";
                                    $resultreligiousinfo11 = mysqli_query($con,$sqlreligiousinfo11);
                                    $rowreligiousinfo11 = mysqli_fetch_assoc($resultreligiousinfo11);
                                    $religion = $rowreligiousinfo11['religion'];
                                    $caste = $rowreligiousinfo11['caste'];
                                    
                                    $sqleducationinfo11 = "select * from education_info where userid = '$loginid'";
                                    $resulteducationinfo11 = mysqli_query($con,$sqleducationinfo11);
                                    $roweducationinfo11 = mysqli_fetch_assoc($resulteducationinfo11);
                                    $stream = $roweducationinfo11['stream'];
                                    $workingwith = $roweducationinfo11['workingwith'];

                                    $sqlinfo = "select * from final_bio where age <= '$age' and marital = '$marital' and  religion = '$religion' and caste = '$caste' and stream = '$stream' and workingwith = '$workingwith' and gender != '$gender' and userid != '$loginid' and userid != '$profileid' order by id desc limit 50";
                                    $resultinfo = mysqli_query($con,$sqlinfo);
                                    $countinfo = mysqli_num_rows($resultinfo);
                                    if($countinfo != 0)
                                    {
                                        while($rowinfo = mysqli_fetch_assoc($resultinfo))
                                        {
                                            $userid = $rowinfo['userid'];
                                            
                                            $sqlphotoinfo1 = "select * from photos_info where userid = '$userid'";
                                            $resultphotoinfo1 = mysqli_query($con,$sqlphotoinfo1);
                                            $rowphotoinfo1 = mysqli_fetch_assoc($resultphotoinfo1);
                                            
                                            $sqlbasicinfo1 = "select * from basic_info where userid = '$userid'";
                                            $resultbasicinfo1 = mysqli_query($con,$sqlbasicinfo1);
                                            $rowbasicinfo1 = mysqli_fetch_assoc($resultbasicinfo1);
                                            
                                            $sqllocationinfo1 = "select * from groom_location where userid = '$userid'";
                                            $resultlocationinfo1 = mysqli_query($con,$sqllocationinfo1);
                                            $rowlocationinfo1 = mysqli_fetch_assoc($resultlocationinfo1);
                                        ?>
                                        <li>
                                            <div class="wedd-rel-box">
                                                <div class="wedd-rel-img">
                                                    <img src="userphoto/<?php echo $rowphotoinfo1['profilepic']?>" alt="">
                                                </div>
                                                <div class="wedd-rel-con">
                                                    <h5><?php echo $rowbasicinfo1['fullname']; ?></h5>
                                                    <span>City <b><?php echo $rowlocationinfo1['city'];?></b></span>
                                                </div>
                                                <a href="user-profile-details.php?uid=<?php echo $rowbasicinfo1['userid']; ?>" class="fclick"></a>
                                            </div>
                                        </li>
                                        <?php
                                        }
                                    }
                                    else
                                    {
                                    ?>
                                        <li><b>No Profiles Found</b></li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                            <!-- END RELATED PROFILES -->
                        </div>
                        <!-- END PROFILE lHS -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END PROFILE -->
<?php
include 'footer.php';

?>