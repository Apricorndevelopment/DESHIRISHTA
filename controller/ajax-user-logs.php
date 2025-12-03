<?php
include '../config.php';

$userid = isset($_GET['userid']) ? (int)$_GET['userid'] : 0;
if(!$userid) {
    echo '<div class="text-danger p-2">Invalid user.</div>';
    exit;
}

$sql = mysqli_query($con,
    "SELECT * FROM user_logs 
     WHERE userid='".mysqli_real_escape_string($con,$userid)."' 
     ORDER BY id DESC 
     LIMIT 200"
);
?>

<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th><i data-feather="log-in"></i> Login</th>
                <th><i data-feather="log-out"></i> Logout</th>
                <th><i data-feather="chrome"></i> Browser</th>
                <th><i data-feather="smartphone"></i> Device</th>
                <th><i data-feather="wifi"></i> IP</th>
                <th><i data-feather="map-pin"></i> Location</th>
                <th><i data-feather="clock"></i> Session</th>
            </tr>
        </thead>

        <tbody>
        <?php
        $i = 1;
        while($log = mysqli_fetch_assoc($sql)) {

            // LOCATION
            $loc = [];
            if ($log['city']) $loc[] = $log['city'];
            if ($log['state']) $loc[] = $log['state'];
            if ($log['country']) $loc[] = $log['country'];
            $location = $loc ? implode(', ', $loc) : '-';

            // SESSION TIME
            if ($log['session_seconds']) {
                $session = round($log['session_seconds']/60,1) . " mins";
            } elseif ($log['logout_time']) {
                $session = "0 mins";
            } else {
                $session = "<span class='badge badge-light-success'>Active</span>";
            }

            // LOGOUT
            $logout = $log['logout_time']
                ? $log['logout_time']
                : "<span class='badge badge-light-success'>Active</span>";
        ?>
        <tr>
            <td><?php echo $i++; ?></td>

            <td><?php echo htmlspecialchars($log['login_time']); ?></td>

            <td><?php echo $logout; ?></td>

            <td><?php echo htmlspecialchars($log['browser'] ?: '-'); ?></td>

            <td><?php echo htmlspecialchars($log['device'] ?: '-'); ?></td>

            <td><?php echo htmlspecialchars($log['ip_address'] ?: '-'); ?></td>

            <td><?php echo htmlspecialchars($location); ?></td>

            <td><?php echo $session; ?></td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<script>
    // Feather icons reload
    if (feather) {
        feather.replace();
    }
</script>
