<?php
include 'header.php';
include '../config.php';
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
                <li class="breadcrumb-item active">View Push</li>
            </ol>
        </div>
    </div>
</div>

<!-- PAGE BODY -->
<div class="content-body">

<section>
<div class="row">
<div class="col-md-12">

<div class="card">
<div class="card-header">
    <h4 class="card-title">Sent Push Notifications</h4>
</div>

<div class="table-responsive">
<table class="table table-striped mb-0">

<thead>
<tr>
    <th>#</th>
    <th>Title</th>
    <th>Message</th>
    <th>Link</th>
    <th>Date</th>
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
        <?php echo htmlspecialchars(substr($row['message'],0,60)); ?>...
    </td>

    <td>
        <?php if($row['link'] != ''){ ?>
            <a href="<?php echo $row['link']; ?>" target="_blank">
                Open
            </a>
        <?php } else { echo '-'; } ?>
    </td>

    <td>
        <?php echo date('d M Y h:i A', strtotime($row['created_at'])); ?>
    </td>
</tr>
<?php 
    }
}else{
?>
<tr>
    <td colspan="5" class="text-center text-muted">
        No push notifications found
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
