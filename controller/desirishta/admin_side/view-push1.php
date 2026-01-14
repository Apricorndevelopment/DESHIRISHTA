<?php
// --- 1. XAMPP/Live Server OpenSSL Config ---
$configPath = 'C:\xampp\apache\conf\openssl.cnf'; 
if (file_exists($configPath)) {
    putenv("OPENSSL_CONF=$configPath");
} else {
    putenv("OPENSSL_CONF=C:\xampp\php\extras\ssl\openssl.cnf");
}
// -------------------------------------------

include 'header.php';
include '../config.php';
require __DIR__ . '/../vendor/autoload.php'; // Vendor load karein

use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

// Error Handling
error_reporting(0);
ini_set('display_errors', 0);

$msg = "";
$msg_type = "";

// --- DELETE LOGIC ---
if(isset($_GET['del_id'])){
    $del_id = mysqli_real_escape_string($con, $_GET['del_id']);
    $del_qry = mysqli_query($con, "DELETE FROM web_notifications WHERE id='$del_id'");
    if($del_qry){
        echo "<script>window.location.href='view-push.php?msg=deleted';</script>";
        exit();
    }
}

// --- RESEND LOGIC (Same as push-action.php) ---
if(isset($_POST['resend_push'])){
    $push_id = mysqli_real_escape_string($con, $_POST['push_id']);
    
    // Fetch Notification Details from DB to be sure
    $get_notif = mysqli_query($con, "SELECT * FROM web_notifications WHERE id='$push_id'");
    $notif_data = mysqli_fetch_assoc($get_notif);

    if($notif_data){
        $title   = $notif_data['title'];
        $message = $notif_data['message'];
        $link    = $notif_data['link'];

        // VAPID Keys
        $auth = [
            'VAPID' => [
                'subject' => 'mailto:admin@desirishta.com',
                'publicKey' => 'BHfvtXOrMtJBEsTOQyYqEPG-db9j7Ynf-Wq2mxUj8HfXkpJNOBeSmW6xhOfjiyqygUVEZIWml31L3CcFZR--dMg',
                'privateKey' => 'o6XF_j9JVGaUnTmQsHLbfXR1E8eYpX1cX3BZxLTZJbU',
            ],
        ];

        $webPush = new WebPush($auth);

        // Fetch Subscribers
        $subs_res = mysqli_query($con, "SELECT * FROM web_push_subscriptions");
        
        if(mysqli_num_rows($subs_res) > 0){
            while($row = mysqli_fetch_assoc($subs_res)) {
                $subscription = Subscription::create([
                    'endpoint' => $row['endpoint'],
                    'publicKey' => $row['p256dh'],
                    'authToken' => $row['auth'],
                ]);

                $payload = json_encode([
                    'title' => $title,
                    'message' => $message,
                    'link' => $link,
                    'icon' => 'images/logo.png'
                ]);

                $webPush->queueNotification($subscription, $payload);
            }

            // Flush & Clean Expired
            foreach ($webPush->flush() as $report) {
                if (!$report->isSuccess()) {
                    if ($report->isSubscriptionExpired()) {
                        $endpoint = $report->getRequest()->getUri()->__toString();
                        $safeEndpoint = mysqli_real_escape_string($con, $endpoint);
                        mysqli_query($con, "DELETE FROM web_push_subscriptions WHERE endpoint = '$safeEndpoint'");
                    }
                }
            }
            $msg = "Notification Resent Successfully!";
            $msg_type = "success";
        } else {
            $msg = "No subscribers found!";
            $msg_type = "warning";
        }
    }
}

// Show Message from URL (Delete)
if(isset($_GET['msg']) && $_GET['msg']=='deleted'){
    $msg = "Notification deleted successfully!";
    $msg_type = "danger";
}
?>

<div class="app-content content">
<div class="content-overlay"></div>
<div class="header-navbar-shadow"></div>

<div class="content-wrapper">

<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <h2 class="content-header-title float-left mb-0">Web Push Notifications</h2>
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active">View Sent Push</li>
            </ol>
        </div>
    </div>
</div>

<div class="content-body">

<section>
<div class="row">
<div class="col-md-12">

<?php if($msg != "") { ?>
    <div class="alert alert-<?php echo $msg_type; ?>">
        <?php echo $msg; ?>
    </div>
<?php } ?>

<div class="card">
<div class="card-header">
    <h4 class="card-title">Sent Notifications History</h4>
    <a href="send-push.php" class="btn btn-primary btn-sm">Compose New</a>
</div>

<div class="table-responsive">
<table class="table table-striped mb-0">

<thead>
<tr>
    <th>#</th>
    <th>Title</th>
    <th>Message</th>
    <th>Link</th>
    <th>Sent Date</th>
    <th>Action</th>
</tr>
</thead>

<tbody>
<?php
$i = 1;
$res = mysqli_query($con, "SELECT * FROM web_notifications ORDER BY id DESC");

if(mysqli_num_rows($res) > 0){
    while($row = mysqli_fetch_assoc($res)){
?>
<tr>
    <td><?php echo $i++; ?></td>

    <td><?php echo htmlspecialchars($row['title']); ?></td>

    <td>
        <?php echo htmlspecialchars(substr($row['message'],0,50)); ?>...
    </td>

    <td>
        <?php if($row['link'] != ''){ ?>
            <a href="<?php echo $row['link']; ?>" target="_blank" class="badge badge-light-info">
                View Link
            </a>
        <?php } else { echo '-'; } ?>
    </td>

    <td>
        <?php echo date('d M Y h:i A', strtotime($row['created_at'])); ?>
    </td>

    <td>
        <div class="d-flex">
            <form method="post" onsubmit="return confirm('Are you sure you want to resend this notification to ALL subscribers?');" style="margin-right: 5px;">
                <input type="hidden" name="push_id" value="<?php echo $row['id']; ?>">
                <button type="submit" name="resend_push" class="btn btn-success btn-sm" title="Resend">
                    <i data-feather="refresh-cw"></i>
                </button>
            </form>

            <a href="view-push.php?del_id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this history?');" title="Delete">
                <i data-feather="trash-2"></i>
            </a>
        </div>
    </td>
</tr>
<?php 
    }
}else{
?>
<tr>
    <td colspan="6" class="text-center text-muted">
        No push notifications history found.
    </td>
</tr>
<?php } ?>
</tbody>

</table>
</div>

</div>

</div>
</div>
</section>

</div>
</div>
</div>

<?php include 'footer.php'; ?>