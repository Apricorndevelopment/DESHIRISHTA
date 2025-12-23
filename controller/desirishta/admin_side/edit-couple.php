<?php
include 'header.php';
include 'config.php'; // $con variable yahan se aayega

// 1. Check karein ki ID valid hai
if(!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<p>Invalid ID. <a href='view-couples.php'>Go Back</a></p>";
    include 'footer.php';
    exit();
}

$id = mysqli_real_escape_string($con, $_GET['id']);

// 2. Database se is ID ka data fetch karein
$sql = "SELECT * FROM tbl_recent_couples WHERE id = '$id'";
$result = mysqli_query($con, $sql);

if(mysqli_num_rows($result) == 0) {
    echo "<p>No couple found with this ID. <a href='view-couples.php'>Go Back</a></p>";
    include 'footer.php';
    exit();
}

// 3. Data ko $row variable mein store karein
$row = mysqli_fetch_assoc($result);
?>

    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Edit Couple</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                    <li class="breadcrumb-item"><a href="view-couples.php">View Couples</a></li>
                                    <li class="breadcrumb-item active">Edit Couple</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="multiple-column-form">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Edit Couple Details</h4>
                                </div>
                                <div class="card-body">
                                    
                                    <form class="form" action="update-couple.php" method="post" enctype="multipart/form-data">
                                        
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <input type="hidden" name="old_image" value="<?php echo $row['image']; ?>">

                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="couple-name"><b>Couple Name</b></label>
                                                    <input type="text" id="couple-name" class="form-control" name="couple_name" 
                                                           value="<?php echo htmlspecialchars($row['couple_name']); ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="location"><b>Location</b></label>
                                                    <input type="text" id="location" class="form-control" name="location" 
                                                           value="<?php echo htmlspecialchars($row['location']); ?>">
                                                </div>
                                            </div>

                                            <!-- NEW DYNAMIC FIELDS START -->
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="event_date"><b>Event Date</b></label>
                                                    <input type="date" id="event_date" class="form-control" name="event_date" 
                                                           value="<?php echo $row['event_date']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="event_time"><b>Event Time</b></label>
                                                    <input type="text" id="event_time" class="form-control" name="event_time" 
                                                           value="<?php echo htmlspecialchars($row['event_time']); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="description"><b>Couple Description / Bio</b></label>
                                                    <textarea id="description" class="form-control" name="description" rows="4"><?php echo htmlspecialchars($row['description']); ?></textarea>
                                                </div>
                                            </div>
                                            <!-- NEW DYNAMIC FIELDS END -->

                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="image"><b>Change Couple Image</b> (Optional)</label>
                                                    <input type="file" id="image" class="form-control" name="image">
                                                    <small class="form-text text-muted">Aapki current image:</small>
                                                    <br>
                                                    <img src="../images/couples/<?php echo $row['image']; ?>" alt="Current Image" style="width: 100px; margin-top: 10px; border-radius: 5px;">
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="gallery"><b>Add More Gallery Images</b></label>
                                                    <input type="file" id="gallery" class="form-control" name="gallery_images[]" multiple>
                                                    <small class="text-muted">Select new images to ADD to the existing gallery.</small>
                                                </div>
                                            </div>

                                            <div class="col-12 text-center mt-2 mb-2">
                                                <button type="submit" name="submit" class="btn btn-primary">Update Couple</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                </div>
        </div>
    </div>
    <?php
include 'footer.php';   
?>