<?php
include('config.php');

// 1. Contact Us Count
$new_messages_count = 0;
$count_query = "SELECT COUNT(id) AS total FROM contact_us WHERE status = 'New'";
$count_result = mysqli_query($con, $count_query);

if ($count_result && mysqli_num_rows($count_result) > 0) {
    $count_row = mysqli_fetch_assoc($count_result);
    $new_messages_count = $count_row['total'];
}

// 2. Pending User Profiles Count (for User Profiles badge)
$pending_profiles_count = 0;
$pp_query = "SELECT COUNT(id) AS total FROM registration WHERE profilestatus = '0'";
$pp_result = mysqli_query($con, $pp_query);

if ($pp_result && mysqli_num_rows($pp_result) > 0) {
    $pp_row = mysqli_fetch_assoc($pp_result);
    $pending_profiles_count = $pp_row['total'];
}

// 3. Pending Approval Count (Waitlist/Photos etc)
$pending_sql = "
SELECT COUNT(*) AS total_pending
FROM registration
WHERE 
    aboutme_approval_status = 'Pending'
    OR groom_approval_status = 'Pending'
    OR photos_approval_status = 'Pending'
";

$pending_result = mysqli_query($con, $pending_sql);
$pending_row = mysqli_fetch_assoc($pending_result);
$pending_count = $pending_row['total_pending'];

// 4. NEW: Pending Subscription Requests Count
$sub_req_count = 0;
$sub_req_query = "SELECT COUNT(id) AS total FROM tbl_subscription_requests WHERE status = 'Pending'";
$sub_req_result = mysqli_query($con, $sub_req_query);
if ($sub_req_result && mysqli_num_rows($sub_req_result) > 0) {
    $sub_req_row = mysqli_fetch_assoc($sub_req_result);
    $sub_req_count = $sub_req_row['total'];
}
?>

<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="dashboard.php">
                    <span class="brand-logo">
                        <img src="logo/desirishtalogo.png">
                    </span>
                </a>
            </li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item">
                <a class="d-flex align-items-center" href="dashboard.php">
                    <i data-feather="airplay"></i>
                    <span class="menu-title text-truncate" data-i18n="Dashboards">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="d-flex align-items-center" href="seotech.php">
                    <i data-feather="airplay"></i>
                    <span class="menu-title text-truncate" data-i18n="Dashboards">SEO Tech</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="d-flex align-items-center" href="#">
                    <i data-feather="columns"></i>
                    <span class="menu-title text-truncate" data-i18n="Dashboards">Header</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="d-flex align-items-center" href="logo.php">
                            <i data-feather="circle"></i>
                            <span class="menu-title text-truncate" data-i18n="Dashboards">Logo</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center" href="analytics-stats.php">
                            <i data-feather="circle"></i>
                            <span class="menu-title text-truncate" data-i18n="Dashboards">Analytics-stats</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center" href="contact.php">
                            <i data-feather="circle"></i>
                            <span class="menu-title text-truncate" data-i18n="Dashboards">Contact</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center" href="sociallink.php">
                            <i data-feather="circle"></i>
                            <span class="menu-title text-truncate" data-i18n="Dashboards">Social Links</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="heart"></i><span class="menu-title text-truncate" data-i18n="Couples">Couples</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="add-couple.php"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Add Couple">Add Couple</span></a></li>
                    <li><a class="d-flex align-items-center" href="view-couples.php"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="View Couples">View Couples</span></a></li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="d-flex align-items-center" href="#">
                    <i data-feather="file-text"></i>
                    <span class="menu-title text-truncate" data-i18n="Dashboards">Blogs</span>
                </a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="add-blog.php"><i data-feather="circle"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Add Blogs</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="view-blogs.php?page=1"><i data-feather="circle"></i><span class="menu-title text-truncate" data-i18n="Dashboards">View Blogs</span></a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="d-flex align-items-center" href="#">
                    <i data-feather="dollar-sign"></i>
                    <span class="menu-title text-truncate">Subscription Mgmt</span>
                    <?php if ($sub_req_count > 0): ?>
                        <span class="badge badge-light-danger rounded-pill ms-auto"><?php echo $sub_req_count; ?></span>
                    <?php endif; ?>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="d-flex align-items-center" href="manage-plans.php">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">Manage Plans</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center" href="subscription-requests.php">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">View Requests</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="users"></i><span class="menu-title text-truncate" data-i18n="Team">Our Team</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="add-team.php"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Add Member">Add Member</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="view-team.php"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="View Members">View Members</span></a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="message-square"></i><span class="menu-title text-truncate" data-i18n="Testimonials">Testimonials</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="add-testimonial.php"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Add">Add Testimonial</span></a></li>
                    <li><a class="d-flex align-items-center" href="view-testimonials.php"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="View">View Testimonials</span></a></li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="d-flex align-items-center" href="#">
                    <i data-feather="users"></i>
                    <span class="menu-title text-truncate" data-i18n="Dashboards">User Profiles</span>
                    <?php if ($pending_profiles_count > 0): ?>
                        <span class="badge badge-light-danger rounded-pill ms-auto"><?php echo $pending_profiles_count; ?></span>
                    <?php endif; ?>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="d-flex align-items-center" href="user-profiles.php">
                            <i data-feather="circle"></i>
                            <span class="menu-title text-truncate" data-i18n="Dashboards">All Users</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center" href="userprofiles-pending.php">
                            <i data-feather="circle"></i>
                            <span class="menu-title text-truncate" data-i18n="Dashboards">Pending Profiles</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center" href="userprofiles-approved.php">
                            <i data-feather="circle"></i>
                            <span class="menu-title text-truncate" data-i18n="Dashboards">Approved Profiles</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center" href="userprofiles-deactivated.php">
                            <i data-feather="circle"></i>
                            <span class="menu-title text-truncate" data-i18n="Dashboards">Profiles Deactivated</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="d-flex align-items-center" href="#">
                    <i data-feather="users"></i>
                    <span class="menu-title text-truncate" data-i18n="Dashboards">Dummy Profiles</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="d-flex align-items-center" href="view-dummy.php">
                            <i data-feather="circle"></i>
                            <span class="menu-title text-truncate" data-i18n="Dashboards">All Users</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center" href="add-dummy.php">
                            <i data-feather="circle"></i>
                            <span class="menu-title text-truncate" data-i18n="Dashboards">Add profile </span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="d-flex align-items-center" href="#">
                    <i data-feather="tool"></i>
                    <span class="menu-title text-truncate" data-i18n="Dashboards">Manage Dropdown Data</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="d-flex align-items-center" href="manage-basic-options.php">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">Basic Dropdown</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center" href="manage-religious-options.php">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">Religious Dropdown</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center" href="manage-education-attributes.php">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">Education Attributes</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center" href="manage-location-attributes.php">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">Location </span>
                        </a>
                    </li>
                </ul>
            </li>
            
            <li class="nav-item">
                <a class="d-flex align-items-center" href="pending-approvals.php">
                    <i data-feather="check-square"></i>
                    <span class="menu-title text-truncate">Moderative Approvals</span>
                    <?php if ($pending_count > 0): ?>
                        <span class="badge badge-light-danger rounded-pill ms-auto"><?php echo $pending_count ?></span>
                    <?php endif; ?>
                </a>
            </li>
            <li class="nav-item">
                <a class="d-flex align-items-center" href="manage-ecards.php">
                    <i data-feather="credit-card"></i>
                    <span class="menu-title text-truncate">Manage E-Card</span>
                </a>
            </li>
            <li class="nav-item">
    <a class="d-flex align-items-center" href="view-delete-requests.php">
        <i data-feather="trash-2"></i>
        <span class="menu-title text-truncate">Deleted Profile Requests</span>
    </a>
</li>
            <li class="nav-item"> 
                <a class="d-flex align-items-center" href="manage-web-push.php"> 
                    <i data-feather="bell"></i>
                    <span class="menu-title text-truncate">Push Notification</span> 
                </a> 
            </li>
                 <li class="nav-item"> 
                <a class="d-flex align-items-center" href="send-push.php"> 
                    <i data-feather="bell"></i>
                    <span class="menu-title text-truncate"> Web Push Notification</span> 
                </a> 
            </li>

            <li class="nav-item">
                <a class="d-flex align-items-center" href="view-subscribers.php">
                    <i data-feather="mail"></i>
                    <span class="menu-title text-truncate">Subscribers List</span>
                </a>
            </li>
<li class="nav-item">
    <a class="d-flex align-items-center" href="view-reports.php">
        <i data-feather="alert-triangle"></i>
        <span class="menu-title text-truncate">Reported Profiles</span>
    </a>
</li>
            <li class="nav-item">
                <a class="d-flex align-items-center" href="#">
                    <i data-feather="phone"></i>
                    <span class="menu-title text-truncate" data-i18n="Contacts">Contacts</span>
                    <?php if ($new_messages_count > 0): ?>
                        <span class="badge badge-light-danger rounded-pill ms-auto"><?php echo $new_messages_count; ?></span>
                    <?php endif; ?>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="d-flex align-items-center" href="view-contact-enquiries.php">
                            <i data-feather="circle"></i>
                            <span class="menu-title text-truncate" data-i18n="ContactEnquiries">Business Enquiries</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center" href="view-support.php">
                            <i data-feather="circle"></i>
                            <span class="menu-title text-truncate" data-i18n="ContactEnquiries">Submit a Request</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center" href="view-review-rating.php">
                            <i data-feather="circle"></i>
                            <span class="menu-title text-truncate" data-i18n="ContactEnquiries">Reviews & Ratings</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="d-flex align-items-center" href="#">
                    <i data-feather="activity"></i>
                    <span class="menu-title text-truncate">User Activity</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="d-flex align-items-center" href="admin-user-activity.php">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">View User Activity</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="d-flex align-items-center" href="#">
                    <i data-feather="file-text"></i>
                    <span class="menu-title text-truncate" data-i18n="Dashboards">Data Export</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="d-flex align-items-center" href="export-users.php" target="_blank">
                            <i data-feather="circle"></i>
                            <span class="menu-title text-truncate" data-i18n="Dashboards">Data Export (Excel)</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="d-flex align-items-center" href="#">
                    <i data-feather="mail"></i>
                    <span class="menu-title text-truncate">Marketing & Comms</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="d-flex align-items-center" href="promotion.php">
                            <i data-feather="circle"></i>
                            <span class="menu-title text-truncate" data-i18n="Dashboards">Announcement</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center" href="create-communication.php">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">Create New Communication</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center" href="manage-communication.php">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">Manage Email Campaigns</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center" href="view-campaigns.php">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">View Past Campaigns</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="d-flex align-items-center" href="#">
                    <i data-feather="file-text"></i>
                    <span class="menu-title text-truncate" data-i18n="Dashboards">Reports / Analytics</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="d-flex align-items-center" href="#">
                            <i data-feather="circle"></i>
                            <span class="menu-title text-truncate" data-i18n="Dashboards">Facebook Pixel</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center" href="#">
                            <i data-feather="circle"></i>
                            <span class="menu-title text-truncate" data-i18n="Dashboards">Google Analytics</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="d-flex align-items-center" href="#">
                    <i data-feather="settings"></i>
                    <span class="menu-title text-truncate" data-i18n="Dashboards">Settings</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="d-flex align-items-center" href="changepassword.php">
                            <i data-feather="circle"></i>
                            <span class="menu-title text-truncate" data-i18n="Dashboards">Password</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>