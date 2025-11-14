<?php
include 'header.php';
include 'config.php';

$userid = $_COOKIE['dr_userid'];

if($userid == '')
{
    header('location:login.php');
} 
?>
        <!-- LOGIN -->
        <section>
            <div class="db">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-lg-3">
                            <?php
                            include 'user-sidebar.php';
                            ?>
                        </div>
                        <div class="col-md-8 col-lg-9">
                            <div class="row">
                                <div class="col-md-12 db-sec-com db-pro-stat-pg">
                                    <div class="form-login  white-box p-0">
                                        <form action="trust-aadhaar.php" method="post">
                                        <!--PROFILE BIO-->
                                            <div class="edit-pro-parti">
                                                <?php       
                                                $sqlverificationinfo = "select * from verification_info where userid = '$userid'";
                                                $resultverificationinfo = mysqli_query($con,$sqlverificationinfo);
                                                $rowverificationinfo = mysqli_fetch_assoc($resultverificationinfo);
                                                            
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
                                                            <input type="text" class="form-control" placeholder="Enter Details (Auto fetch)" name="city" value="<?php echo $rowverificationinfo['city']; ?>"  readonly>
                                                        </div>
                                                        <div class="col-md-4 form-group">
                                                            <label class="lb">State</label>
                                                            <input type="text" class="form-control" placeholder="Enter Details (Auto fetch)" name="state" value="<?php echo $rowverificationinfo['state']; ?>"  readonly>
                                                        </div>
                                                        <div class="col-md-4 form-group">
                                                            <label class="lb">Pincode</label>
                                                            <input type="text" class="form-control" placeholder="Enter Details (Auto fetch)" name="pincode" value="<?php echo $rowverificationinfo['pincode']; ?>"  readonly>
                                                        </div>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                            <!--END PROFILE BIO-->
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
                                        <!--PROFILE BIO-->
                                            <div class="edit-pro-parti">
                                                <?php
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
                                                        <input type="file" class="form-control chooseimg" placeholder="Enter Details" name="govtidphoto" accept="image/png, image/jpg, image/jpeg">
                                                        <p class=""><span class="text-danger">Supports:</span> PNG, JPG and JPEG</p>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4"></div>
                                                        <div class="col-md-4 form-group">
                                                            <button type="submit" class="btn btn-primary m-0">Upload</button>
                                                        </div>
                                                        <div class="col-md-4"></div>
                                                    </div>
                                                </div>
                                                <?php
                                                }
                                                else
                                                {
                                                ?>
                                                <div class="form-tit p-3 tophead">
                                                    <h1 class="text-white">Upload Govt. ID</h1>
                                                </div>
                                                <div class="row p-4" id="aadharotp">
                                                    <div class="col-md-6 form-group">
                                                        <label class="lb">Govt. ID</label>
                                                        <span class="iconbox">
                                                        <select class="form-select chosen-select" name="govtid" required>
                                                            <option value="">Select</option>
                                                            <option <?php if($rowverificationinfo['govtid'] == 'Adhaar Card') { echo "selected"; }?>>Adhaar Card</option>
                                                            <option <?php if($rowverificationinfo['govtid'] == 'PAN Card') { echo "selected"; }?>>PAN Card</option>
                                                            <option <?php if($rowverificationinfo['govtid'] == 'Voter Card') { echo "selected"; }?>>Voter Card</option>
                                                            <option <?php if($rowverificationinfo['govtid'] == 'Driving License') { echo "selected"; }?>>Driving License</option>
                                                            <option <?php if($rowverificationinfo['govtid'] == 'Other') { echo "selected"; }?>>Other</option>
                                                        </select>
                                                        <i class="fa fa-list icon"></i>
                                                        </span>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label class="lb">Upload ID</label>
                                                        <img src="govtidphoto/<?php echo $rowverificationinfo['govpic'];?>">
                                                    </div>
                                                </div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                            <!--END PROFILE BIO-->
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END -->
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