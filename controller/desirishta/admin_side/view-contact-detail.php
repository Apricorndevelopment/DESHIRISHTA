<?php
include('config.php'); 

$id = intval($_GET['id']); 

if($id > 0) {

    // Mark as Seen
    $update_sql = "UPDATE contact_us SET status = 'Seen' WHERE id = $id AND status = 'New'";
    mysqli_query($con, $update_sql);

    // Fetch enquiry details
    $detail_query = "SELECT * FROM contact_us WHERE id = $id";
    $detail_result = mysqli_query($con, $detail_query);
    $data = mysqli_fetch_assoc($detail_result);

    if (!$data) {
        header('location: view-contact-enquiries.php');
        exit;
    }

} else {
    header('location: view-contact-enquiries.php');
    exit;
}

include('header.php'); 
?>

<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>

    <div class="content-wrapper">

        <!-- PAGE HEADER -->
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <h2 class="content-header-title float-left mb-0">Enquiry Details</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="view-contact-enquiries.php">Contact Enquiries</a></li>
                        <li class="breadcrumb-item active">Details</li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- PAGE BODY -->
        <div class="content-body">

            <section id="multiple-column-form">
                <div class="row">
                    <div class="col-12">

                        <div class="card">

                            <div class="card-header">
                                <h4 class="card-title">Message from <?php echo $data['name']; ?></h4>
                            </div>

                            <div class="card-body">

                                <!-- STATUS + DATE -->
                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <p>
                                            <strong>Status:</strong> 
                                            <span class="text-success">Seen</span>
                                        </p>
                                    </div>

                                    <div class="col-md-6">
                                        <p>
                                            <strong>Date:</strong> 
                                            <?php echo date('d M Y, H:i', strtotime($data['submission_date'])); ?>
                                        </p>
                                    </div>
                                </div>

                                <hr>

                                <!-- BASIC DETAILS -->
                                <div class="row mb-1">
                                    <div class="col-md-6">
                                        <p><strong>Name:</strong> <?php echo $data['name']; ?></p>
                                    </div>

                                    <div class="col-md-6">
                                        <p><strong>Email:</strong> <?php echo $data['email']; ?></p>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <p><strong>Category:</strong> <?php echo $data['category']; ?></p>
                                    </div>
                                </div>

                                <hr>

                                <!-- MESSAGE -->
                                <h4 class="mb-1">Message</h4>
                                <p style="white-space: pre-line; font-size: 15px;">
                                    <?php echo htmlspecialchars($data['message']); ?>
                                </p>

                            </div>

                            <div class="card-footer text-right">
                                <a href="view-contact-enquiries.php" class="btn btn-secondary">
                                    Back to Enquiries
                                </a>
                            </div>

                        </div>

                    </div>
                </div>
            </section>

        </div>

    </div>
</div>

<?php include('footer.php'); ?>
