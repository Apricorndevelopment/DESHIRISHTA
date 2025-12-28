<?php
include 'header.php';
include 'config.php';

/* ================= INSERT NOTIFICATION ================= */
if (isset($_POST['send_notification'])) {

    $title   = mysqli_real_escape_string($con, $_POST['title']);
    $message = mysqli_real_escape_string($con, $_POST['message']);
    $link    = mysqli_real_escape_string($con, $_POST['link']);

    // Optional: ek time par sirf ek active
    mysqli_query($con, "UPDATE web_notifications SET status='inactive'");

    $sql = "INSERT INTO web_notifications (title, message, link, status) 
            VALUES ('$title', '$message', '$link', 'active')";

    if (mysqli_query($con, $sql)) {
        echo "<script>alert('Notification Broadcasted Successfully'); window.location='manage-web-push.php';</script>";
    } else {
        echo "<script>alert('Something went wrong');</script>";
    }
}

/* ================= STOP NOTIFICATION ================= */
if (isset($_GET['stop_id'])) {
    $id = intval($_GET['stop_id']);
    mysqli_query($con, "UPDATE web_notifications SET status='inactive' WHERE id='$id'");
    echo "<script>window.location='manage-web-push.php';</script>";
}
?>

<div class="app-content content">
<div class="content-overlay"></div>
<div class="header-navbar-shadow"></div>

<div class="content-wrapper">

<!-- PAGE HEADER -->
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <h2 class="content-header-title float-left mb-0">
            Web Push Notifications
        </h2>
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Web Push</li>
            </ol>
        </div>
    </div>
</div>

<!-- PAGE BODY -->
<div class="content-body">

<!-- SEND NOTIFICATION -->
<section>
<div class="row">
<div class="col-md-12">

<div class="card">
<div class="card-header">
    <h4 class="card-title">Send New Broadcast</h4>
</div>

<div class="card-body">
<form method="post">

<div class="form-group">
    <label>Notification Title</label>
    <input type="text" name="title" class="form-control"
           placeholder="e.g. Special Offer for You!" required>
</div>

<div class="form-group">
    <label>Message</label>
    <textarea name="message" class="form-control" rows="3"
              placeholder="Enter notification message..." required></textarea>
</div>

<div class="form-group">
    <label>Redirect Link (Optional)</label>
    <input type="text" name="link" class="form-control"
           placeholder="https://example.com/page">
</div>

<button type="submit" name="send_notification" class="btn btn-primary">
    <i class="fa fa-paper-plane mr-1"></i> Broadcast Now
</button>

</form>
</div>
</div>

</div>
</div>
</section>

<!-- NOTIFICATION LIST -->
<section>
<div class="row">
<div class="col-md-12">

<div class="card">
<div class="card-header">
    <h4 class="card-title">Recent Notifications</h4>
</div>

<div class="table-responsive">
<table class="table table-striped mb-0">

<thead>
<tr>
    <th>Date</th>
    <th>Title</th>
    <th>Message</th>
    <th>Status</th>
    <th>Action</th>
</tr>
</thead>

<tbody>
<?php
$res = mysqli_query($con, "SELECT * FROM web_notifications ORDER BY id DESC LIMIT 10");
while ($row = mysqli_fetch_assoc($res)) {
?>
<tr>
    <td><?php echo date('d M Y', strtotime($row['created_at'])); ?></td>

    <td><?php echo htmlspecialchars($row['title']); ?></td>

    <td><?php echo htmlspecialchars(substr($row['message'], 0, 60)); ?>...</td>

    <td>
        <?php if ($row['status'] == 'active') { ?>
            <span class="badge badge-success">Active</span>
        <?php } else { ?>
            <span class="badge badge-secondary">Inactive</span>
        <?php } ?>
    </td>

    <td>
        <?php if ($row['status'] == 'active') { ?>
            <a href="manage-web-push.php?stop_id=<?php echo $row['id']; ?>"
               class="btn btn-danger btn-sm">
               Stop
            </a>
        <?php } else { ?>
            <span class="text-muted">—</span>
        <?php } ?>
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
