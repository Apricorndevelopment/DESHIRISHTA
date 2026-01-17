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

<div class="mobile-menu">
    <button onclick="toggleSidebar()">
        <span class="material-symbols-outlined">menu</span> Dashboard
    </button>
</div>

<div class="sidebar-overlay" onclick="toggleSidebar()"></div>

<div class="db-nav" id="mySidebar">
    
    <a href="javascript:void(0)" class="closebtn d-block d-md-none" onclick="toggleSidebar()">&times;</a>

    <div class="db-nav-pro row">
        <div class="slid-inn pr-bio-c wedd-rel-pro sliderarrow sidebararrows m-0 p-0">
            <ul class="slider3">
                <?php if($rowphotoinfo['profilepic'] != '') { ?>
                <li>
                    <div class="wedd-rel-box">
                        <div class="wedd-rel-img">
                            <img src="userphoto/<?php echo $rowphotoinfo['profilepic']?>" alt="">
                        </div>
                    </div>
                </li>
                <?php } if($rowphotoinfo['photo1'] != '') { ?>
                <li>
                    <div class="wedd-rel-box">
                        <div class="wedd-rel-img">
                            <img src="userphoto/<?php echo $rowphotoinfo['photo1']?>" alt="">
                        </div>
                    </div>
                </li>
                <?php } if($rowphotoinfo['photo2'] != '') { ?>
                <li>
                    <div class="wedd-rel-box">
                        <div class="wedd-rel-img">
                            <img src="userphoto/<?php echo $rowphotoinfo['photo2']?>" alt="">
                        </div>
                    </div>
                </li>
                <?php } if($rowphotoinfo['photo3'] != '') { ?>
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
        <div class="" style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
            <div>
                <h2 class="db-tit mt-4 text-center"><?php echo $rowbasicinfo['fullname']; ?></h2>
            </div>

            <style>
                .numberplate {
                    background: #5c1b1bff;;
                    padding: 8px 14px;
                    display: inline-flex;
                    gap: 2px;
                    border-radius: 4px;
                    align-items: center;
                }
             .np-char {
    font-size: 20px;
    font-weight: 900;
    color: #ffc941;
    letter-spacing: 1px;
    display: inline-block;
    font-family: 'cinzel decorative', cursive;
}
                @media (max-width: 480px) {
                    .np-char { font-size: 22px; letter-spacing: 0.5px; }
                    .numberplate { padding: 6px 10px; gap: 3px; }
                }
                @media (max-width: 360px) {
                    .np-char { font-size: 20px; }
                }
            </style>

            <div class="numberplate">
                <?php 
                $uid = str_split($_COOKIE['dr_userid']); 
                foreach($uid as $single_uid) {
                    echo '<span class="np-char">'.$single_uid.'</span>';
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
            <li><a href="trust-badge.php" <?php if($url == 'trust-badge.php') { echo 'class="act"'; } ?>><span class="material-symbols-outlined fs-18">verified</span>&nbsp;Verification/Trust Badge </a></li>
            <li><a href="user-setting.php" <?php if($url == 'user-setting.php') { echo 'class="act"'; } ?>><span class="material-symbols-outlined fs-18">settings</span>&nbsp;Settings</a></li>
            <li><a href="user-plan.php" <?php if($url == 'user-plan.php') { echo 'class="act"'; } ?>><span class="material-symbols-outlined">payments</span>&nbsp;Plan</a></li>
        </ul>
    </div>
</div>

<style>
/* Default Desktop Styles (Keeps your existing layout) */
.mobile-menu {
    display: none; /* Hidden on desktop */
}
.closebtn {
    display: none;
}
.sidebar-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
    z-index: 998; /* Just behind the sidebar */
}

/* Mobile Styles (Max width 991px - Tablets and Phones) */
@media (max-width: 991px) {
    
    /* Show the trigger button */
    .mobile-menu {
        display: block;
        padding: 10px 15px;
        background: #fff;
        border-bottom: 1px solid #eee;
    }
    
       .mobile-menu button {
        background: #754d4dff;
        border: none;
        color: rgb(255, 255, 255);
        border: 2px solid #ffc941;
        padding: 8px 15px;
        border-radius: 5px;
        display: flex;
        align-items: center;
        gap: 5px;
                left: 18px;
        font-size: 14px;
        cursor: pointer;
        position: fixed;
        top: 100px;
        z-index: 10;
        /* position: sticky; */
        /* top: 100px; */
    }

    /* Transform the main nav into a sidebar drawer */
    .db-nav {
        height: 100%;
        width: 280px; /* Width of the sidebar */
        position: fixed;
        z-index: 999;
        top: 0;
        left: -290px; /* Start hidden off-screen to the left */
        background-color: #fff; /* Sidebar background color */
        overflow-x: hidden;
        transition: 0.4s; /* Smooth slide effect */
        box-shadow: 2px 0 5px rgba(0,0,0,0.2);
        padding-top: 20px;
    }
.material-symbols-outlined {
    vertical-align: middle;
    color: #080808ff !important;
}
    /* Class added via JS to slide it in */
    .db-nav.active {
        left: 0;
    }

    /* Show overlay when active */
    .sidebar-overlay.active {
        display: block;
    }

    /* Close button styling */
    .closebtn {
        display: block;
        position: absolute;
        top: 10px;
        right: 20px;
        font-size: 36px;
        color: #fffc63ff;
        text-decoration: none;
        z-index: 1001;
    }
}
</style>

<script>
function toggleSidebar() {
    var sidebar = document.getElementById("mySidebar");
    var overlay = document.querySelector(".sidebar-overlay");
    
    // Toggle the 'active' class on both sidebar and overlay
    sidebar.classList.toggle("active");
    overlay.classList.toggle("active");
}
</script>