<?php
include 'header.php';
include 'config.php';
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    /* DataTable sorting arrows completely remove */
table.dataTable thead th::before,
table.dataTable thead th::after {
    display: none !important;
    content: "" !important;
}

table.dataTable thead .sorting,
table.dataTable thead .sorting_asc,
table.dataTable thead .sorting_desc,
table.dataTable thead .sorting_asc_disabled,
table.dataTable thead .sorting_desc_disabled {
    background-image: none !important;
}

</style>
<div class="app-content content">
<div class="content-wrapper">

<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <h2 class="content-header-title">Review & Rating</h2>
    </div>
</div>

<div class="content-body">
<section>
<div class="card">
<div class="card-header">
    <h4 class="card-title">Reviews List</h4>
</div>

<div class="table-responsive">
<table class="table table-striped" id="dt">

<thead>
<tr>
    <th>Sr No</th>
    <th>Name</th>
    <th>Rating</th>
    <th>Date</th>
    <th>Status</th>
    <th>Action</th>
</tr>
</thead>

<tbody>
<?php
$sql = "SELECT * FROM review_rating ORDER BY status DESC, created_at DESC";
$res = mysqli_query($con, $sql);
$sr = 1;

while($row = mysqli_fetch_assoc($res)) {
?>
<tr>
    <td><?php echo $sr++; ?></td>

    <td><?php echo $row['name']; ?></td>

    <td>
        <?php
        $rating = (int)$row['rating'];
        if($rating > 0){
            for($i=1; $i<=5; $i++){
                if($i <= $rating){
                    echo "<i class='fa fa-star text-warning'></i>";
                } else {
                    echo "<i class='fa fa-star-o text-muted'></i>";
                }
            }
        } else {
            echo "<span class='text-danger'>No Rating</span>";
        }
        ?>
    </td>

    <td><?php echo date('d M Y, H:i', strtotime($row['created_at'])); ?></td>

    <td>
        <?php
        if($row['status'] == 'New'){
            echo "<span class='text-danger'>New</span>";
        } else {
            echo "<span class='text-success'>Seen</span>";
        }
        ?>
    </td>

    <td>
        <a href="view-review-detail.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary">
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
