<?php
include 'header.php';
include '../config.php';
?>

<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>

    <div class="content-wrapper">

        <!-- PAGE HEADER -->
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">User Activity</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">User Activity</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                <small class="text-muted">
                    Updated: <?php echo date('d M Y H:i:s'); ?>
                </small>
            </div>
        </div>

        <!-- PAGE BODY -->
        <div class="content-body">
            <section id="multiple-column-form">
                <div class="row" id="basic-table">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">User Live Activity</h4>
                            </div>

                            <div class="table-responsive p-1">
                                <table class="table table-striped file-export" id="dt">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Online</th>
                                            <th>Browser</th>
                                            <th>Device</th>
                                            <th>Location</th>
                                            <th>Last Login</th>
                                            <th>Last Logout</th>
                                            <th>Last Session</th>
                                            <th>Avg Usage</th>
                                            <th>Contacts Left</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        // $sql = mysqli_query($con, "
                                        //     SELECT r.*,
                                        //       (SELECT login_time FROM user_logs WHERE userid=r.userid ORDER BY id DESC LIMIT 1) 
                                        //     AS last_login,
                                        //       (SELECT logout_time FROM user_logs WHERE userid=r.userid ORDER BY id DESC LIMIT 1) AS last_logout,
                                        //       (SELECT browser FROM user_logs WHERE userid=r.userid ORDER BY id DESC LIMIT 1) AS last_browser,
                                        //       (SELECT device FROM user_logs WHERE userid=r.userid ORDER BY id DESC LIMIT 1) AS last_device,
                                        //       (SELECT city FROM user_logs WHERE userid=r.userid ORDER BY id DESC LIMIT 1) AS last_city,
                                        //       (SELECT state FROM user_logs WHERE userid=r.userid ORDER BY id DESC LIMIT 1) AS last_state,
                                        //       (SELECT country FROM user_logs WHERE userid=r.userid ORDER BY id DESC LIMIT 1) AS last_country,
                                        //       (SELECT AVG(session_seconds) FROM user_logs WHERE userid=r.userid) AS avg_usage_seconds,
                                        //       (SELECT session_seconds FROM user_logs WHERE userid=r.userid ORDER BY id DESC LIMIT 1) AS last_session_seconds
                                        //     FROM registration r
                                        //     ORDER BY r.userid DESC
                                        // ");
                                        // NEW & CORRECTED CODE - Yeh wala block add karna hai
$sql = mysqli_query($con, "
    SELECT 
        r.*,
        ul.login_time AS last_login,
        ul.logout_time AS last_logout,
        ul.browser AS last_browser,
        ul.device AS last_device,
        ul.city AS last_city,
        ul.state AS last_state,
        ul.country AS last_country,
        ul.session_seconds AS last_session_seconds,
        /* AVG Usage ko nikalne ke liye correlated subquery theek hai */
        (SELECT AVG(session_seconds) FROM user_logs WHERE userid = r.userid) AS avg_usage_seconds
    FROM registration r
    LEFT JOIN (
        /* Har user ke liye latest log ID dhoondho */
        SELECT userid, MAX(id) AS max_id 
        FROM user_logs 
        GROUP BY userid
    ) AS latest_log ON latest_log.userid = r.userid
    /* Latest ID ka pura data fetch karo */
    LEFT JOIN user_logs ul ON ul.id = latest_log.max_id
    ORDER BY r.userid DESC
");

                                        $sr = 1;
                                        while($row = mysqli_fetch_assoc($sql)) {

                                            $loc = [];
                                            if ($row['last_city']) $loc[] = $row['last_city'];
                                            if ($row['last_state']) $loc[] = $row['last_state'];
                                            if ($row['last_country']) $loc[] = $row['last_country'];

                                            $location = !empty($loc) ? implode(', ', $loc) : '-';

                                            $last_session = $row['last_session_seconds']
                                                ? round($row['last_session_seconds']/60,1)." mins"
                                                : '-';

                                            $avg_usage = $row['avg_usage_seconds']
                                                ? round($row['avg_usage_seconds']/60,1)." mins"
                                                : '-';

                                            $userid = $row['userid'];
                                            $status_badge = ($row['online'] == 'yes')
                                                ? "<span class='badge badge-light-success'>Online</span>"
                                                : "<span class='badge badge-light-secondary'>Offline</span>";
                                        ?>
                                        <!-- <tr>
                                            <td><?php echo $sr++; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $status_badge; ?></td>
                                            <td><?php echo $row['last_browser'] ?: '-'; ?></td>
                                            <td><?php echo $row['last_device'] ?: '-'; ?></td>
                                            <td><?php echo $location; ?></td>
                                            <td><?php echo $row['last_login'] ?: '-'; ?></td>
                                            <td><?php echo $row['last_logout'] ?: '-'; ?></td>
                                            <td><?php echo $last_session; ?></td>
                                            <td><?php echo $avg_usage; ?></td>
                                            <td><?php echo $row['contact_views_left'] ?: '-'; ?></td>

                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item btn-view-logs" data-userid="<?php echo $userid; ?>">
                                                            <i data-feather="clock" class="mr-50"></i> View Logs
                                                        </a>
                                                        <a class="dropdown-item" href="user-profile.php?userid=<?php echo $userid; ?>">
                                                            <i data-feather="user" class="mr-50"></i> Open Profile
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr> -->
                                        
                                        
                                        <tr>
                                            <td><?php echo $sr++; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $status_badge; ?></td>

                                            <?php
                                            // Check karein ki user online hai ya nahi
                                            $is_online = ($row['online'] == 'yes');
                                            
                                            // Agar online hai, toh data dikhayein, warna '-'
                                            $display_browser = $is_online ? ($row['last_browser'] ?: '-') : '-';
                                            $display_device = $is_online ? ($row['last_device'] ?: '-') : '-';
                                            $display_location = $is_online ? $location : '-'; // $location variable upar calculate hua hai
                                            $display_last_login = $is_online ? ($row['last_login'] ?: '-') : '-';
                                            $display_last_logout = $is_online ? ($row['last_logout'] ?: '-') : '-';
                                            $display_last_session = $is_online ? $last_session : '-'; // $last_session variable upar calculate hua hai
                                            $display_avg_usage = $is_online ? $avg_usage : '-'; // $avg_usage variable upar calculate hua hai
                                            ?>

                                            <td><?php echo $display_browser; ?></td>
                                            <td><?php echo $display_device; ?></td>
                                            <td><?php echo $display_location; ?></td>
                                            <td><?php echo $display_last_login; ?></td>
                                            <td><?php echo $display_last_logout; ?></td>
                                            <td><?php echo $display_last_session; ?></td>
                                            <td><?php echo $display_avg_usage; ?></td>
                                            <td><?php echo $row['contact_views_left'] ?: '-'; ?></td>

                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item btn-view-logs" data-userid="<?php echo $userid; ?>">
                                                            <i data-feather="clock" class="mr-50"></i> View Logs
                                                        </a>
                                                        <a class="dropdown-item" href="user-profile.php?userid=<?php echo $userid; ?>">
                                                            <i data-feather="user" class="mr-50"></i> Open Profile
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                        </div><!-- card -->
                    </div>
                </div>
            </section>
        </div>
    </div>

</div>
<!-- END: Content -->


<!-- LOGS MODAL -->
<div class="modal fade" id="userLogsModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title"><i data-feather="clock"></i> User Activity Logs</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>

            <div class="modal-body" id="userLogsModalBody">
                <div class="text-center text-muted py-3">Loading...</div>
            </div>

        </div>
    </div>
</div>


<script>
$(document).on('click', '.btn-view-logs', function(){
    var userid = $(this).data('userid');

    $('#userLogsModalBody').html(`
        <div class="text-center py-4">
            <div class="spinner-border"></div>
        </div>
    `);

    $('#userLogsModal').modal('show');

    $.ajax({
        url: 'ajax-user-logs.php',
        data: { userid: userid },
        success: function(res){
            $('#userLogsModalBody').html(res);
        }
    });
});
</script>

<?php include 'footer.php'; ?>
