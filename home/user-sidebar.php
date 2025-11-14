<?php
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$url = substr($actual_link, strrpos($actual_link, '/' )+1);

$userid = $_COOKIE['dr_userid'];

$sqlphotoinfo = "select * from photos_info where userid = '$userid'";
$resultphotoinfo = mysqli_query($con,$sqlphotoinfo);
$rowphotoinfo = mysqli_fetch_assoc($resultphotoinfo);

$sqlbasicinfo = "select * from basic_info where userid = '$userid'";
$resultbasicinfo = mysqli_query($con,$sqlbasicinfo);
$rowbasicinfo = mysqli_fetch_assoc($resultbasicinfo);
?>
<div class="db-nav">
    <div class="db-nav-pro row">
        <div class="slid-inn pr-bio-c wedd-rel-pro sliderarrow sidebararrows m-0 p-0">
            <ul class="slider3">
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
        <div class="">
            <div>
                <h2 class="db-tit mt-4 text-center"><?php echo $rowbasicinfo['fullname']; ?></h2>
            </div>
            <div>
                <?php 
                $uid = str_split($_COOKIE['dr_userid']); 
                foreach($uid as $single_uid)
                {
                    echo '<span class="rounduid">';
                    echo $single_uid;
                    echo "</span>";
                }
                ?>
            </div>
        </div>
    </div>
    <div class="db-nav-list">
        <ul>
            <li><a href="user-dashboard.php" <?php if($url == 'user-dashboard.php') { echo 'class="act"'; } ?>><span class="material-symbols-outlined fs-18">dashboard</span>&nbsp;My Dashboard</a></li>
            <li><a href="user-profile-edit.php" <?php if($url == 'user-profile-edit.php') { echo 'class="act"'; } ?>><span class="material-symbols-outlined fs-18">edit_note</span>&nbsp;Edit Profile</a></li>
            <li><a href="user-profile.php" <?php if($url == 'user-profile.php') { echo 'class="act"'; } ?>><span class="material-symbols-outlined fs-18">preview</span>&nbsp;View Profile</a></li>
            <li><a href="user-final-profile.php?uid=<?php echo $_COOKIE['dr_userid']; ?>" <?php if($url == 'user-profile-details.php') { echo 'class="act"'; } ?>><span class="material-symbols-outlined fs-18">contact_page</span>&nbsp;Final Profile</a></li>
            <!--<li>
                <a href="#" id="profile" <?php if($url == 'user-profile.php') { echo 'class="act"'; } ?>><i class="fa fa-user-circle-o" aria-hidden="true"></i>My Profile</a>
                <ul id="profilesubmenu" style="<?php if($url == 'user-profile.php' || $url == 'user-profile-edit.php') { echo 'display:block'; } else { echo 'display:none'; } ?>">
                    <li><a href="user-profile.php" <?php if($url == 'user-profile.php') { echo 'class="act"'; } ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;View Profile</a></li>
                    <li><a href="user-profile-edit.php" <?php if($url == 'user-profile-edit.php') { echo 'class="act"'; } ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Edit Profile</a></li>
                    <li><a href="#" <?php if($url == '#') { echo 'class="act"'; } ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Preview Final Profile</a></li>
                </ul>
            </li>-->
            <!--<li>
                <a href="#" id="activities" <?php if($url == 'user-outgoing-interests.php' || $url == 'user-incoming-interests.php') { echo 'class="act"'; } ?>><i class="fa fa-list" aria-hidden="true"></i>My Activities</a>
                <ul id="activitiessubmenu" style="<?php if($url == 'user-outgoing-interests.php' || $url == 'user-incoming-interests.php') { echo 'display:block'; } else { echo 'display:none'; } ?>">
                    <li><a href="user-outgoing-interests.php" <?php if($url == 'user-outgoing-interests.php') { echo 'class="act"'; } ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Outgoing Requests</a></li>
                    <li><a href="user-incoming-interests.php" <?php if($url == 'user-incoming-interests.php') { echo 'class="act"'; } ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Incoming Requests</a></li>
                </ul>
            </li>
            <li><a href="user-chat.php" <?php if($url == 'user-chat.php') { echo 'class="act"'; } ?>><i class="fa fa-comments" aria-hidden="true"></i>Chat List</a></li>-->
            <li><a href="trust-badge.php" <?php if($url == 'trust-badge.php') { echo 'class="act"'; } ?>><span class="material-symbols-outlined fs-18">verified</span>&nbsp;Verification/Trust Badge </a></li>
            <li><a href="user-setting.php" <?php if($url == 'user-setting.php') { echo 'class="act"'; } ?>><span class="material-symbols-outlined fs-18">settings</span>&nbsp;Settings</a></li>
            <li><a href="user-plan.php" <?php if($url == 'user-plan.php') { echo 'class="act"'; } ?>><span class="material-symbols-outlined">payments</span>&nbsp;Plan</a></li>
        </ul>
    </div>
</div>