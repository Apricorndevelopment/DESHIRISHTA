<?php
include 'config.php';

$id = intval($_GET['id']);
if($id <= 0){
    header("location:view-review-rating.php");
    exit;
}

// Mark as Seen
mysqli_query($con, "UPDATE review_rating SET status='Seen' WHERE id=$id");

// Fetch review
$q = mysqli_query($con, "SELECT * FROM review_rating WHERE id=$id");
$data = mysqli_fetch_assoc($q);

if(!$data){
    header("location:view-review-rating.php");
    exit;
}

include 'header.php';
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="app-content content">
<div class="content-wrapper">

<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <h2 class="content-header-title">Review Details</h2>
    </div>
</div>

<div class="content-body">
<section>
<div class="card">

<div class="card-header">
    <h4 class="card-title">Review by <?php echo $data['name']; ?></h4>
</div>

<div class="card-body">

<!-- STATUS & DATE -->
<div class="row mb-2">
    <div class="col-md-6">
        <p><strong>Status:</strong>
            <span class="text-success">Seen</span>
        </p>
    </div>

    <div class="col-md-6">
        <p><strong>Date:</strong>
            <?php echo date('d M Y, H:i', strtotime($data['created_at'])); ?>
        </p>
    </div>
</div>

<hr>

<!-- USER INFO -->
<div class="row mb-2">
    <div class="col-md-6">
        <p><strong>Name:</strong> <?php echo $data['name']; ?></p>
    </div>

    <div class="col-md-6">
        <p><strong>Email:</strong> <?php echo $data['email']; ?></p>
    </div>
</div>

<div class="row mb-2">
    <div class="col-md-6">
        <p><strong>Phone:</strong> <?php echo $data['phone']; ?></p>
    </div>

    <div class="col-md-6">
        <p><strong>Rating:</strong><br>
        <?php
        $rating = (int)$data['rating'];
        if($rating > 0){
            for($i=1; $i<=5; $i++){
                if($i <= $rating){
                    echo "<i class='fa fa-star text-warning' style='font-size:18px'></i>";
                } else {
                    echo "<i class='fa fa-star-o text-muted' style='font-size:18px'></i>";
                }
            }
        } else {
            echo "<span class='text-danger'>No Rating</span>";
        }
        ?>
        </p>
    </div>
</div>

<hr>

<!-- MESSAGE -->
<h4>Review Message</h4>
<p style="white-space:pre-line;">
    <?php echo htmlspecialchars($data['message']); ?>
</p>

</div>

<div class="card-footer text-right">
    <a href="view-review-rating.php" class="btn btn-secondary">
        Back to Reviews
    </a>
</div>

</div>
</section>
</div>

</div>
</div>

<?php include 'footer.php'; ?>
