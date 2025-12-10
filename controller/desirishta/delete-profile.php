<?php
include 'header.php';
include 'config.php';

$userid = $_COOKIE['dr_userid'];
?>
<script type="text/javascript">
    function previewImage2(event) {
         var input2 = document.getElementById('addphoto2input');
         var image2 = document.getElementById('preview2');
         if (addphoto2input.files && addphoto2input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
               image2.src = e.target.result;
            }
            reader.readAsDataURL(addphoto2input.files[0]);
         }
         $("#addicon2").hide();
         $("#addbtn2").hide();
      }
      
      function previewImage3(event) {
         var input3 = document.getElementById('addphoto3input');
         var image3 = document.getElementById('preview3');
         if (addphoto3input.files && addphoto3input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
               image3.src = e.target.result;
            }
            reader.readAsDataURL(addphoto3input.files[0]);
         }
         $("#addicon3").hide();
         $("#addbtn3").hide();
      }
</script>
    <!-- START -->
    <section>
        <div class="inn-ban">
            <div class="container">
                <div class="row">
                    <h1>Delete Profile</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- END -->
    
    <!-- REGISTER -->
    <section>
        <div class="login pro-edit-update pt-0">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-lg-3"></div>
                    <div class="col-md-6 col-lg-6">
                        <div class="row">
                            <div class="col-md-12 db-sec-com profileform">
                                <div class="db-pro-stat p-0" style="overflow:visible">
                                    <div class="db-inte-main">
                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div id="basictab" class="container tab-pane active p-0">
                                                <div class="form-login p-0">
                                                    <form action="insert-deleteprofile.php" method="post" enctype="multipart/form-data">
                                                        <!--PROFILE BIO-->
                                                        <?php
                                                        if($_POST['deletestatus'] == 'delete')
                                                        {
                                                        ?>
                                                            <div class="edit-pro-parti">
                                                                <div class="form-tit p-3 tophead">
                                                                    <h1 class="text-white">Profile Deleted</h1>
                                                                    <p class="m-0 text-white"><?php echo $userid; ?></p>
                                                                </div>
                                                                <div class="row p-4">
                                                                    <div class="text-center">
                                                                        <img src="images/gif/delete.gif" style="width:20%">
                                                                    </div>
                                                                    <p class="text-center"><b>Your profile has been successfully deleted. <br> Thank you for using Desi Rishta</b></p>
                                                                </div>
                                                            </div>
                                                            <a href="deleteprofilemail.php" class="btn btn-primary profile-btn">OK</a>
                                                        <?php
                                                        }
                                                        else
                                                        {
                                                        ?>
                                                        <div class="edit-pro-parti">
                                                            <div class="form-tit p-3 tophead">
                                                                <h1 class="text-white">Delete Profile</h1>
                                                                <p class="m-0 text-white"><?php echo $userid; ?></p>
                                                            </div>
                                                            <div class="row p-4">
                                                                <div class="col-md-12 form-group">
                                                                    <label class="lb">Choose Option: <span class="text-danger">*</span></label>
                                                                    <span class="iconbox">
                                                                        <select class="form-select chosen-select" name="option" id="options" required>
                                                                            <option value="">Select</option>
                                                                            <option value="Marriage Fixed">Marriage Fixed </option>
                                                                            <option value="Other Reasons">Other Reasons</option>
                                                                      </select>
                                                                      <span class="material-symbols-outlined icon">tv_options_edit_channels</span>
                                                                    </span>
                                                                </div>
                                                                
                                                                <div class="col-md-12 form-group" id="mf" style="display:none">
                                                                    <label class="lb">Marriage Fixed By: <span class="text-danger">*</span></label>
                                                                    <span class="iconbox">
                                                                        <select class="form-select chosen-select" name="mfoption" id="mfoption">
                                                                            <option value="">Select</option>
                                                                            <option value="Desi Rishta">Desi Rishta</option>
                                                                            <option value="Others Source">Others Source</option>
                                                                      </select>
                                                                      <span class="material-symbols-outlined icon">tv_options_edit_channels</span>
                                                                    </span>
                                                                </div>
                                                                
                                                                <div class="col-md-6 form-group drmf" style="display:none">
                                                                    <label class="lb">Partner’s Name : <span class="text-danger">*</span></label>
                                                                    <span class="iconbox">
                                                                        <input type="hidden" pseudo="placeholder" class="form-control leftspace" name="userid" value="<?php echo $userid; ?>">
                                                                        <input type="text" pseudo="placeholder" class="form-control leftspace" placeholder="Enter Partner’s Name" name="partnername">
                                                                        <span class="material-symbols-outlined icon">person</span>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 form-group drmf" style="display:none">
                                                                    <label class="lb">Date Of Marriage : <span class="text-danger">*</span></label>
                                                                    <span class="iconbox">
                                                                        <input type="date" pseudo="placeholder" class="form-control leftspace" placeholder="Enter Partner’s Name" name="marriagedate">
                                                                        <span class="material-symbols-outlined icon">calendar_month</span>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-12 form-group drmf" style="display:none">
                                                                    <label class="lb">Partner’s ID/Phone No./Email ID : <span class="text-danger">*</span></label>
                                                                    <span class="iconbox">
                                                                        <input type="text" pseudo="placeholder" class="form-control leftspace" placeholder="Enter Partner’s ID/Phone No./Email ID" name="partnerid">
                                                                        <span class="material-icons icon">123</span>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-12 form-group drmf" style="display:none">
                                                                    <label class="lb">Upload Couple Photographs : <span class="text-danger">*</span></label>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="picborder" id="addphoto2">
                                                                                <img id="preview2" style="width:90%; margin:0 auto; padding-top:12%">
                                                                                <span class="material-symbols-outlined" id="addicon2">add_photo_alternate</span>
                                                                                <p class="m-0" id="addbtn2">Add Photo</p>
                                                                            </div>
                                                                            <input type="file" class="form-control lh" id="addphoto2input" name="photo1" style="display:none;"  onchange="previewImage2(event)">
                                                                        </div>    
                                                                        <div class="col-md-6">
                                                                            <div class="picborder" id="addphoto3">
                                                                                <img id="preview3" style="width:90%; margin:0 auto; padding-top:12%">
                                                                                <span class="material-symbols-outlined" id="addicon3">add_photo_alternate</span>
                                                                                <p class="m-0" id="addbtn3">Add Photo</p>
                                                                            </div>
                                                                            <input type="file" class="form-control lh" id="addphoto3input" name="photo2"  style="display:none;"  onchange="previewImage3(event)">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="col-md-12 form-group osmf" style="display:none">
                                                                    <label class="lb">Other Source: <span class="text-danger">*</span></label>
                                                                    <span class="iconbox">
                                                                        <select class="form-select chosen-select" name="osoption" id="osoption">
                                                                            <option value="">Select</option>
                                                                            <option value="Other matchmaking sites">Other matchmaking sites </option>
                                                                            <option value="Offline matchmakers">Offline matchmakers </option>
                                                                            <option value="Others">Others</option>
                                                                      </select>
                                                                      <span class="material-symbols-outlined icon">tv_options_edit_channels</span>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-12 form-group" id="osoption1" style="display:none">
                                                                    <label class="lb">Other matchmaking sites  : <span class="text-danger">*</span></label>
                                                                    <span class="iconbox">
                                                                        <input type="text" pseudo="placeholder" class="form-control leftspace" placeholder="Enter Partner’s Name" name="matchmaking">
                                                                        <span class="material-symbols-outlined icon">edit_note</span>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-12 form-group" id="osoption2" style="display:none">
                                                                    <label class="lb">Offline matchmakers  : <span class="text-danger">*</span></label>
                                                                    <span class="iconbox">
                                                                        <input type="text" pseudo="placeholder" class="form-control leftspace" placeholder="Enter Partner’s Name" name="matchmakers">
                                                                        <span class="material-symbols-outlined icon">edit_note</span>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-12 form-group" id="osoption3" style="display:none">
                                                                    <label class="lb">Others  : <span class="text-danger">*</span></label>
                                                                    <span class="iconbox">
                                                                        <input type="text" pseudo="placeholder" class="form-control leftspace" placeholder="Enter Partner’s Name" name="others">
                                                                        <span class="material-symbols-outlined icon">edit_note</span>
                                                                    </span>
                                                                </div>
                                                                
                                                                <div class="col-md-12 form-group" id="or" style="display:none">
                                                                    <label class="lb">Other Reasons : <span class="text-danger">*</span></label>
                                                                    <span class="iconbox">
                                                                        <input type="text" pseudo="placeholder" class="form-control leftspace" placeholder="Enter Other Reasons" name="otherreason">
                                                                        <span class="material-symbols-outlined icon">edit_note</span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--END PROFILE BIO-->
                                                        <button type="submit" id="basicupdatebtn" class="btn btn-primary profile-btn">Delete</button>
                                                        <?php
                                                        }
                                                        ?>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-lg-3"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- END -->

<?php
include 'footer.php';
?>

<script>
    $(document).ready(function(){
        $('#options').on('change', function() {
        
        var options = $('#options').val();
        
        if(options == '')
        {
            $("#mf").hide();
            $(".drmf").hide();
            $(".osmf").hide();
            $("#osoption1").hide();
            $("#osoption2").hide();
            $("#osoption3").hide();
            $("#or").hide();
        }
        if(options == 'Marriage Fixed')
        {
            $("#mf").show();
            $(".drmf").hide();
            $(".osmf").hide();
            $("#osoption1").hide();
            $("#osoption2").hide();
            $("#osoption3").hide();
            $("#or").hide();
        }
        if(options == 'Other Reasons')
        {
            $("#mf").hide();
            $(".drmf").hide();
            $(".osmf").hide();
            $("#osoption1").hide();
            $("#osoption2").hide();
            $("#osoption3").hide();
            $("#or").show();
        }
        });
    });
    
    $(document).ready(function(){
        $('#mfoption').on('change', function() {
        
        var mfoption = $('#mfoption').val();
        
        if(mfoption == 'Desi Rishta')
        {
            $(".drmf").show();
            $(".osmf").hide();
        }
        if(mfoption == 'Others Source')
        {
            $(".drmf").hide();
            $(".osmf").show();
        }
        });
    });
    
    $(document).ready(function(){
        $('#osoption').on('change', function() {
        
        var osoption = $('#osoption').val();
        
        if(osoption == 'Other matchmaking sites')
        {
            $("#osoption1").show();
            $("#osoption2").hide();
            $("#osoption3").hide();
        }
        if(osoption == 'Offline matchmakers')
        {
            $("#osoption1").hide();
            $("#osoption2").show();
            $("#osoption3").hide();
        }
        if(osoption == 'Others')
        {
            $("#osoption1").hide();
            $("#osoption2").hide();
            $("#osoption3").show();
        }
        });
    });
</script>
<script>
    $('#addphoto2').click(function(){
        $("#addphoto2input").trigger('click');
    });
    $('#addphoto3').click(function(){
        $("#addphoto3input").trigger('click');
    });
</script>

