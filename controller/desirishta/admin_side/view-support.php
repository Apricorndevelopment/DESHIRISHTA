<?php
include 'header.php';
include 'config.php';
?>

<style>
table.dataTable thead th::before,
table.dataTable thead th::after{
    display:none !important;
    content:"" !important;
}
</style>

<div class="app-content content">
<div class="content-wrapper">

<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <h2 class="content-header-title">User Support Requests</h2>
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Support Requests</li>
            </ol>
        </div>
    </div>
</div>

<div class="content-body">
<section>
<div class="card">

<div class="card-header">
    <h4 class="card-title">Support Messages</h4>
</div>

<div class="table-responsive">
<table class="table table-striped" id="dt">
<thead>
<tr>
    <th>Sr No</th>
    <th>Name</th>
    <th>Date</th>
    <th>Status</th>
    <th>Action</th>
</tr>
</thead>

<tbody>
<?php
$sr = 1;
$q = mysqli_query(
    $con,
    "SELECT * FROM contact_us 
     WHERE category='User Support Request' 
     ORDER BY status DESC, submission_date DESC"
);

while($row = mysqli_fetch_assoc($q)){
?>
<tr>
    <td><?php echo $sr++; ?></td>
    <td><?php echo htmlspecialchars($row['name']); ?></td>
    <td><?php echo date('d M Y, H:i', strtotime($row['submission_date'])); ?></td>
    <td>
        <?php
        echo ($row['status']=='New')
        ? "<span class='text-danger'>New</span>"
        : "<span class='text-success'>Seen</span>";
        ?>
    </td>
    <td>
        <a href="view-contact-detail.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary">
            View
        </a>
    </td>
</tr>
<?php } ?>
</tbody>

</table>
</div>

</div>
</section>
</div>

</div>
</div>

<?php include 'footer.php'; ?>
