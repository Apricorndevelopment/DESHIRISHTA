<?php
include 'header.php';
include 'config.php';

$userid = $_COOKIE['dr_userid'];

if($userid == '')
{
    header('location:login.php');
} 

// --- [UPDATED FETCH]: Fetch both ID status and Document status at once ---
$sql_reg_status = "select verificationinfo, document_verification_status from registration where userid = '$userid'";
$result_reg_status = mysqli_query($con, $sql_reg_status);
$row_reg_status = mysqli_fetch_assoc($result_reg_status);
$id_verified_status = $row_reg_status['verificationinfo']; // ID Status (Old Logic)
$doc_verified_status = $row_reg_status['document_verification_status'] ?? 'Pending'; // Document Status (New Logic)

// --- Existing verification_info table fetch (for Aadhaar details/pics)
$sqlverificationinfo = "select * from verification_info where userid = '$userid'";
$resultverificationinfo = mysqli_query($con,$sqlverificationinfo);
$rowverificationinfo = mysqli_fetch_assoc($resultverificationinfo);
?>
<style>
    /* Custom Styling for Verification Page */
    .upload-box {
        background: #f9f9f9;
        padding: 20px;
        border-radius: 10px;
        border: 1px solid #e0e0e0;
        width: 100%;
        height: 100%; /* Match height */
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    /* Dotted Upload Area */
    .upload-area {
        border: 2px dashed #845d5d; /* Theme color */
        border-radius: 10px;
        padding: 40px 20px;
        display: block;
        text-align: center;
        cursor: pointer;
        background: #fff;
        transition: 0.3s ease;
        position: relative;
    }

    .upload-area:hover {
        background-color: #fffdfd;
        border-color: #0d5ec8;
    }

    .select-text {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        margin-bottom: 5px;
        margin-top: 10px;
    }

    /* Hide the default file input completely */
    .hidden-file {
        display: none !important;
    }

    /* Submit Button */
    .submit-btn {
        margin-top: 15px;
        background: #7c5353;
        border: none;
        padding: 10px 0;
        color: #fff;
        border-radius: 6px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        width: 100%;
        transition: 0.3s;
    }

    .submit-btn:hover {
        background: #218838;
    }

    /* Image Preview Container */
    .current-id-preview {
        border: 1px solid #eeececff;
        padding: 10px;
        border-radius: 10px;
        background: #f9f9f9;
        text-align: center;
        height: 100%;
    }
    
    .current-id-preview img {
        /* max-height: 250px; */
        object-fit: contain;
        border-radius: 5px;
        margin-top: 48px;
    }

    /* Status Card Styling */
    .verification-status-card {
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }

    .status-success {
        background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
        border-left: 5px solid #28a745;
        color: #155724;
    }

    .status-pending {
        background: linear-gradient(135deg, #fff3cd 0%, #ffecb5 100%);
        border-left: 5px solid #ffc107;
        color: #856404;
    }

    .status-declined {
        background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
        border-left: 5px solid #dc3545;
        color: #721c24;
    }

    .status-icon {
        font-size: 40px;
        margin-right: 20px;
    }

    .status-text h4 {
        margin: 0;
        font-weight: 700;
        font-size: 18px;
    }
    .status-text p {
        margin: 0;
        font-size: 14px;
        opacity: 0.9;
    }

    /* --- Custom Popup Modal Styles --- */
    .custom-modal {
        display: none; 
        position: fixed; 
        z-index: 9999; 
        left: 0;
        top: 0;
        width: 100%; 
        height: 100%; 
        overflow: auto; 
        background-color: rgba(0,0,0,0.6); 
        backdrop-filter: blur(5px);
        justify-content: center;
        align-items: center;
    }

    .custom-modal-content {
        background-color: #fff;
        margin: auto;
        padding: 0;
        border: none;
        width: 90%;
        max-width: 420px;
        border-radius: 15px;
        text-align: center;
        position: relative;
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        animation: slideDown 0.4s ease-out;
    }

    @keyframes slideDown {
        from {transform: translateY(-50px); opacity: 0;}
        to {transform: translateY(0); opacity: 1;}
    }

    .close-modal-btn {
        color: #999;
        font-size: 28px;
        font-weight: bold;
        position: absolute;
        right: 15px;
        top: 10px;
        cursor: pointer;
        transition: 0.3s;
        line-height: 1;
        z-index: 10;
    }

    .close-modal-btn:hover {
        color: #333;
    }

    .modal-body {
        padding: 40px 30px;
    }

    .success-gif {
        width: 120px;
        height: 120px;
        margin-bottom: 20px;
        object-fit: cover;
    }

    .modal-title {
        font-size: 24px;
        font-weight: 700;
        color: #28a745;
        margin-bottom: 10px;
    }

    .modal-desc {
        font-size: 15px;
        color: #666;
        margin-bottom: 25px;
    }

    .ok-btn {
        background: #28a745;
        color: white;
        padding: 12px 40px;
        border: none;
        border-radius: 50px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
        transition: 0.3s;
    }

    .ok-btn:hover {
        background: #218838;
        transform: translateY(-2px);
    }
    
    /* List Style for Guidelines */
    .guideline-list {
        text-align: left;
        margin-top: 15px;
        font-size: 12px;
        color: #555;
        line-height: 1.5;
        padding-left: 20px;
    }
    .guideline-list li {
        margin-bottom: 5px;
    }
</style>

<section>
    <div class="db">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-lg-3">
                    <?php include 'user-sidebar.php'; ?>
                </div>
                <div class="col-md-8 col-lg-9">
                    <div class="row">
                        <div class="col-md-12 db-sec-com db-pro-stat-pg">
                            <div class="form-login white-box p-0">
                                <form action="upload-govtid.php" method="post" enctype="multipart/form-data">
                                    <div class="edit-pro-parti">
                                        
                                        <div class="form-tit p-3 tophead">
                                            <h1 class="text-white">Upload Govt. ID</h1>
                                            <p class="text-white m-0">Secure Verification Process</p>
                                        </div>

                                        <div class="p-4">
                                            
                                            <?php 
                                            $statusClass = 'status-pending';
                                            $statusIcon = 'fa-clock-o';
                                            $statusTitle = 'Verification Pending';
                                            $statusDesc = 'Your document is under review by the admin.';
                                            
                                            // Logic to show "User Government ID under review" if pending
                                            if($doc_verified_status == 'Pending') {
                                                $statusClass = 'status-pending';
                                                $statusIcon = 'fa-clock-o';
                                                $statusTitle = 'Under Review';
                                                $statusDesc = 'User Government ID under review.';
                                            } elseif($doc_verified_status == 'Done') { 
                                                $statusClass = 'status-success';
                                                $statusIcon = 'fa-check-circle';
                                                $statusTitle = 'Verified Successfully';
                                                $statusDesc = 'Your Government ID has been approved.';
                                            } elseif($doc_verified_status == 'Declined') {
                                                $statusClass = 'status-declined';
                                                $statusIcon = 'fa-times-circle';
                                                $statusTitle = 'Verification Failed';
                                                $statusDesc = 'Please re-upload a clear document.';
                                            }
                                            ?>

                                            <div class="verification-status-card <?php echo $statusClass; ?>">
                                                <div class="d-flex align-items-center">
                                                    <i class="fa <?php echo $statusIcon; ?> status-icon"></i>
                                                    <div class="status-text">
                                                        <h4><?php echo $statusTitle; ?></h4>
                                                        <p><?php echo $statusDesc; ?></p>
                                                    </div>
                                                </div>
                                                <?php if($doc_verified_status == 'Done') { ?>
                                                    <span class="badge bg-success" style="font-size:14px;">Active</span>
                                                <?php } ?>
                                            </div>

                                            <div class="row">
                                                
                                                <div class="col-md-12 form-group mb-4">
                                                    <label class="lb font-weight-bold">Select ID Type <span class="text-danger">*</span></label>
                                                    <div class="iconbox">
                                                        <select class="form-select chosen-select form-control" name="govtid" required style="height: 50px;">
                                                            <option value="">-- Select Document Type --</option>
                                                            <option value="Adhaar Card" <?php if($rowverificationinfo['govtid'] == 'Adhaar Card') { echo "selected"; }?>>Adhaar Card</option>
                                                            <option value="PAN Card" <?php if($rowverificationinfo['govtid'] == 'PAN Card') { echo "selected"; }?>>PAN Card</option>
                                                            <option value="Voter Card" <?php if($rowverificationinfo['govtid'] == 'Voter Card') { echo "selected"; }?>>Voter Card</option>
                                                            <option value="Driving License" <?php if($rowverificationinfo['govtid'] == 'Driving License') { echo "selected"; }?>>Driving License</option>
                                                            <option value="Other" <?php if($rowverificationinfo['govtid'] == 'Other') { echo "selected"; }?>>Other</option>
                                                        </select>
                                                        </div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label class="lb mb-2">Document Preview</label>
                                                    <div class="current-id-preview">
                                                        <?php if($rowverificationinfo['govpic'] != '') { ?>
                                                            <a href="govtidphoto/<?php echo $rowverificationinfo['govpic'];?>" target="_blank">
                                                                <img src="govtidphoto/<?php echo $rowverificationinfo['govpic'];?>" alt="Govt ID">
                                                            </a>
                                                            <p class="mt-2 text-muted"><small><i class="fa fa-search-plus"></i> Click image to zoom</small></p>
                                                        <?php } else { ?>
                                                            <div style="padding: 60px 0; color: #ccc;">
                                                                <i class="fa fa-id-card-o" style="font-size: 60px;"></i>
                                                                <p class="mt-3">No document uploaded yet</p>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label class="lb mb-2">Upload / Update File</label>
                                                    <div class="upload-box">
                                                        <label class="upload-area">
                                                            <div class="upload-content">
                                                                <i class="fa fa-cloud-upload" style="font-size: 50px; color: #845d5d; margin-bottom: 10px;"></i>
                                                                
                                                                <p class="select-text">Click here to Upload File</p>
                                                                
                                                                <div style="border-top: 1px solid #eee; margin-top: 10px; padding-top: 5px;">
                                                                    <strong>Do's and Don'ts:</strong>
                                                                    <ul class="guideline-list">
                                                                        <li>Do upload a clear picture with your face clearly visible.</li>
                                                                        <li>Do not upload blurred or unclear pictures.</li>
                                                                        <li>Do not upload pictures of others.</li>
                                                                        <li>Do not upload watermarked, morphed, or obscene pictures.</li>
                                                                        <li>Do not add any personal content (address, phone) to your picture.</li>
                                                                        <li>Supported formats: PNG, JPG, and JPEG only.</li>
                                                                        <li>Combined max file size: 5MB.</li>
                                                                    </ul>
                                                                </div>

                                                                <p id="file-name" style="margin-top:10px; font-size:13px; color:#28a745; font-weight:600; min-height: 20px;"></p>
                                                            </div>
                                                            <input type="file" name="govtidphoto" class="hidden-file" accept="image/png, image/jpg, image/jpeg" <?php if($rowverificationinfo['govpic'] == '') { echo "required"; } ?>>
                                                        </label>

                                                        <button type="submit" class="submit-btn"><i class="fa fa-upload"></i> Upload & Save</button>
                                                    </div>
                                                </div>

                                            </div> </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div id="successModal" class="custom-modal">
    <div class="custom-modal-content">
        <span class="close-modal-btn">&times;</span>
        <div class="modal-body">
            <img src="images/gif/verifiedidentity.gif" alt="Verified" class="success-gif">
            <h3 class="modal-title">Verification Successful!</h3>
            <p class="modal-desc">Your Government ID has been verified successfully.</p>
            <button class="ok-btn">OK</button>
        </div>
    </div>
</div>

<script>
    // File Upload Preview Logic
    const hiddenFileInput = document.querySelector(".hidden-file");
    const fileNameText = document.getElementById("file-name");

    hiddenFileInput.addEventListener("change", () => {
        if (hiddenFileInput.files.length > 0) {
            fileNameText.innerHTML = '<i class="fa fa-check"></i> ' + hiddenFileInput.files[0].name;
        }
    });

    // Modal Logic
    var modal = document.getElementById("successModal");
    var span = document.getElementsByClassName("close-modal-btn")[0];
    var okBtn = document.getElementsByClassName("ok-btn")[0];

    // Define a unique key for local storage (using userID to be safe across different logins on same device)
    var storageKey = 'verified_popup_seen_<?php echo $userid; ?>';

    // Show modal if PHP status is 'Done' AND the user hasn't clicked OK yet
    <?php if($doc_verified_status == 'Done') { ?>
        window.addEventListener('load', function() {
            // Check LocalStorage
            if (!localStorage.getItem(storageKey)) {
                modal.style.display = "flex";
            }
        });
    <?php } ?>

    // Close actions
    span.onclick = function() {
        modal.style.display = "none";
    }
    
    // When OK is clicked, set the flag in LocalStorage so it doesn't show again
    okBtn.onclick = function() {
        localStorage.setItem(storageKey, 'true'); 
        modal.style.display = "none";
    }
    
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

<?php
include 'footer.php';
?>