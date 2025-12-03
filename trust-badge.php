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
        <section>
            <div class="db">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-lg-3">
                            <?php
                            include 'user-sidebar.php';
                            ?>
                        </div>
                        <div class="col-md-8 col-lg-9">
                            <div class="row">
                                <div class="col-md-12 db-sec-com db-pro-stat-pg">
                                    <div class="form-login  white-box p-0">
                                        <form action="trust-aadhaar.php" method="post">
                                        <div class="edit-pro-parti">
                                                <?php 
                                                // Using $rowverificationinfo['adhaarnum'] == '' check
                                                if($rowverificationinfo['adhaarnum'] == '')
                                                {
                                                ?>
                                                    <div class="form-tit p-3 tophead">
                                                        <h1 class="text-white">Aadhaar Verification </h1>
                                                        <p class="text-white m-0">'<span class="text-danger">*</span>' Required Fields</p>
                                                    </div>
                                                    <div class="row p-4 pb-0" id="aadharotp">
                                                        <div class="col-md-6 form-group">
                                                            <label class="lb">Aadhaar Number</label>
                                                            <input type="text" class="form-control" id="aadharnumber" placeholder="Enter Details" name="adhaarnum">
                                                        </div>
                                                        <div class="col-md-6 form-group">
                                                            <label class="lb">Aadhaar OTP</label>
                                                            <input type="text" class="form-control" placeholder="Enter Details" name="adhaarotp">
                                                        </div>
                                                        <div class="col-md-6 form-group">
                                                            <label class="lb"></label>
                                                            <button type="button" class="btn btn-primary m-0">Validate</button>
                                                        </div>
                                                    </div>
                                                    <div class="row p-4 pt-0" id="aadhardata">
                                                                
                                                    </div>
                                                <?php
                                                }
                                                else
                                                {
                                                ?>
                                                    <div class="form-tit p-3 tophead">
                                                        <h1 class="text-white">Aadhaar Verification </h1>
                                                    </div>
                                                    <div class="row p-4">
                                                        <div class="col-md-6 form-group">
                                                            <label class="lb">Aadhaar Number</label>
                                                            <span class="iconbox">
                                                                <input type="password" id="adhaar" class="form-control" id="aadharnumber" placeholder="Enter Details" name="adhaarnum" value="<?php echo $rowverificationinfo['adhaarnum']; ?>" readonly>
                                                                <span class="material-symbols-outlined iconright" id="openid">visibility</span>
                                                                <span class="material-symbols-outlined iconright" id="closeeye" style="display:none;">visibility_off</span>
                                                            </span>
                                                        </div>
                                                        <div class="col-md-6 form-group">
                                                            <label class="lb">Full Name</label>
                                                            <input type="text" class="form-control" placeholder="Enter Details (Auto fetch)" name="fullname" value="<?php echo $rowverificationinfo['fullname']; ?>" readonly>
                                                        </div>
                                                        <div class="col-md-12 form-group">
                                                            <label class="lb">Address</label>
                                                            <input type="text" class="form-control text-capitalize" placeholder="Enter Details (Auto fetch)" name="address" value="<?php echo $rowverificationinfo['address']; ?>" readonly>
                                                        </div>
                                                        <div class="col-md-4 form-group">
                                                            <label class="lb">City</label>
                                                            <input type="text" class="form-control" placeholder="Enter Details (Auto fetch)" name="city" value="<?php echo $rowverificationinfo['city']; ?>" 	readonly>
                                                        </div>
                                                        <div class="col-md-4 form-group">
                                                            <label class="lb">State</label>
                                                            <input type="text" class="form-control" placeholder="Enter Details (Auto fetch)" name="state" value="<?php echo $rowverificationinfo['state']; ?>" 	readonly>
                                                        </div>
                                                        <div class="col-md-4 form-group">
                                                            <label class="lb">Pincode</label>
                                                            <input type="text" class="form-control" placeholder="Enter Details (Auto fetch)" name="pincode" value="<?php echo $rowverificationinfo['pincode']; ?>" 	readonly>
                                                        </div>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                            </form>
                                    </div>
                                </div>
                                <div class="col-md-12 db-sec-com db-pro-stat-pg">
                                    <div class="form-group m-0 text-center">
                                        <h2 class="hr-lines1"><span class="or">OR</span></h2>
                                    </div>
                                </div>


                                <div class="col-md-12 db-sec-com db-pro-stat-pg">
                                  <div class="form-login white-box p-0">
                                    <form action="upload-govtid.php" method="post" enctype= "multipart/form-data">
                                                    <div class="edit-pro-parti">
                                            <?php
                                             // Using $rowverificationinfo['govtid'] == '' check
                                            if($rowverificationinfo['govtid'] == '')
                                            {
                                            ?>
                                            <div class="form-tit p-3 tophead">
                                              <h1 class="text-white">Upload Govt. ID</h1>
                                              <p class="text-white m-0">'<span class="text-danger">*</span>' Required Fields </p>
                                            </div>
                                            <div class="row p-4" id="aadharotp">
                                              <div class="col-md-6 form-group">
                                                <label class="lb">Govt. ID <span class="text-danger">*</span></label>
                                                <span class="iconbox">
                                                <select class="form-select chosen-select" name="govtid" required>
                                                  <option value="">Select</option>
                                                  <option value="Adhaar Card">Adhaar Card</option>
                                                  <option value="PAN Card">PAN Card</option>
                                                  <option value="Voter Card">Voter Card</option>
                                                  <option value="Driving License">Driving License</option>
                                                  <option value="Other">Other</option>
                                                </select>
                                                <span class="material-symbols-outlined icon">list</span>
                                                </span>
                                              </div>
                                              <div class="col-md-6 form-group">
                                                <label class="lb">Upload ID <span class="text-danger">*</span></label>
                                                <input type="file" class="form-control chooseimg" placeholder="Enter Details" name="govtidphoto" accept="image/png, image/jpg, image/jpeg" required>
                                                <p class=""><span class="text-danger">Supports:</span> PNG, JPG and JPEG</p>
                                              </div>
                                              <div class="row">
                                                <div class="col-md-4"></div>
                                                <div class="col-md-4 form-group text-center">
                                                  <button type="submit" class="btn btn-primary m-0 custom-upload-btn"><i class="fa fa-upload"></i> Upload</button>
                                                </div>
                                                <div class="col-md-4"></div>
                                              </div>
                                            </div>
                                            <?php
                                            }
                                            else // Document already uploaded - Show View/Edit option
                                            {
                                            ?>
                                            <div class="form-tit p-3 tophead">
                                              <h1 class="text-white">Uploaded Govt. ID</h1>
                                            </div>
                                                    <div class="row p-4">
                                                           <div class="col-md-12 mb-3">
                                                               <p>
                                                                   <strong>Current Verification Status: </strong>
                                                                   <?php 
                                                                   // --- [UPDATED LOGIC] Now checks the Document Status column ---
                                                                       if($doc_verified_status == 'Done') { 
                                                                           echo '<span class="badge bg-success">Verified <i class="fa fa-check-circle"></i></span>';
                                                                       } elseif($doc_verified_status == 'Declined') {
                                                                           echo '<span class="badge bg-danger">Declined <i class="fa fa-times-circle"></i></span>';
                                                                       } else {
                                                                           echo '<span class="badge bg-warning text-dark">Pending Admin Review <i class="fa fa-clock-o"></i></span>';
                                                                       }
                                                                   ?>
                                                               </p>
                                                           </div>
                                              <div class="col-md-6 form-group">
                                                <label class="lb">Govt. ID Type</label>
                                                <span class="iconbox">
                                                <select class="form-select chosen-select" name="govtid" required>
                                                  <option value="">Select</option>
                                                  <option value="Adhaar Card" <?php if($rowverificationinfo['govtid'] == 'Adhaar Card') { echo "selected"; }?>>Adhaar Card</option>
                                                  <option value="PAN Card" <?php if($rowverificationinfo['govtid'] == 'PAN Card') { echo "selected"; }?>>PAN Card</option>
                                                  <option value="Voter Card" <?php if($rowverificationinfo['govtid'] == 'Voter Card') { echo "selected"; }?>>Voter Card</option>
                                                  <option value="Driving License" <?php if($rowverificationinfo['govtid'] == 'Driving License') { echo "selected"; }?>>Driving License</option>
                                                  <option value="Other" <?php if($rowverificationinfo['govtid'] == 'Other') { echo "selected"; }?>>Other</option>
                                                </select>
                                                <i class="fa fa-list icon"></i>
                                                </span>
                                              </div>
                                              <div class="col-md-6 form-group">
                                                <label class="lb">Uploaded ID (Click to view full image)</label>
                                                                 <a href="govtidphoto/<?php echo $rowverificationinfo['govpic'];?>" target="_blank">
                                                <img src="govtidphoto/<?php echo $rowverificationinfo['govpic'];?>" style="max-width: 100%; height: auto; border: 1px solid #ccc; padding: 5px;">
                                                                 </a>
                                              </div>

<div class="upload-box">
                                    <h5>Upload Files</h5>

                                    <label class="upload-area">
                                        <div class="upload-content">
                                            <p class="select-text">Select File here</p>
                                            <small>Files Supported: PNG, JPG, JPEG</small>

                                            <button type="button" class="choose-btn">Choose File</button>
                                            <p id="file-name" style="margin-top:8px; font-size:14px; color:#555;"></p>
                                        </div>

                                        <input type="file" name="govtidphoto" class="hidden-file" accept="image/png, image/jpg, image/jpeg">
                                    </label>

                                    <button type="submit" class="submit-btn">Submit File</button>
                                </div>


                                            </div>
                                            <?php
                                            }
                                            ?>
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
        <style>
    .upload-box {
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    width: 100%;
}

/* Dotted Upload Area */
.upload-area {
    border: 2px dashed #d4d4d4;
    border-radius: 10px;
    padding: 40px 20px;
    display: block;
    text-align: center;
    cursor: pointer;
    transition: 0.3s ease;
}

.upload-area:hover {
    border-color: #999;
}

.select-text {
    font-size: 18px;
    font-weight: 600;
    color: #333;
}

.upload-content small {
    display: block;
    margin-bottom: 15px;
    color: #777;
}

/* Choose File Button */
.choose-btn {
    background: #1b74e4;
    border: none;
    padding: 8px 18px;
    color: #fff;
    border-radius: 6px;
    font-size: 14px;
    cursor: pointer;
}

.choose-btn:hover {
    background: #0d5ec8;
}

/* Submit Button */
.submit-btn {
    margin-top: 20px;
    background: #28a745;
    border: none;
    padding: 10px 25px;
    color: #fff;
    border-radius: 6px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    width: 180px;
}

.submit-btn:hover {
    background: #218838;
}

/* Hide default file input */
.hidden-file {
    display: none;
}

</style>
 <script>
const chooseBtn = document.querySelector(".choose-btn");
const hiddenFileInput = document.querySelector(".hidden-file");
const fileNameText = document.getElementById("file-name");

chooseBtn.addEventListener("click", () => {
    hiddenFileInput.click();
});

hiddenFileInput.addEventListener("change", () => {
    if (hiddenFileInput.files.length > 0) {
        fileNameText.textContent = "Selected: " + hiddenFileInput.files[0].name;
    }
});


 </script>
<?php
include 'footer.php';
?>
<script>
    $('#openid').click(function() {
    $('#openid').hide();
    $('#closeeye').show();
    $('#adhaar').attr('type', 'text');
});

$('#closeeye').click(function() {
    $('#closeeye').hide();
    $('#openid').show();
    $('#adhaar').attr('type', 'password');
});
</script>