<?php
include 'header.php';
include 'config.php';

$username = $_COOKIE['dr_name'];
$userid = $_COOKIE['dr_userid'];

if($userid == '')
{
    header('location:login.php');
}

$sqlphotoinfo = "select * from photos_info where userid = '$userid'";
$resultphotoinfo = mysqli_query($con,$sqlphotoinfo);
$rowphotoinfo = mysqli_fetch_assoc($resultphotoinfo);

$sqlprofile = "select * from registration where userid = '$userid'";
$resultprofile = mysqli_query($con,$sqlprofile);
$rowprofile = mysqli_fetch_assoc($resultprofile);

$sqlplan = "select * from plan_info where userid = '$userid'";
$resultplan = mysqli_query($con,$sqlplan);
$rowplan = mysqli_fetch_assoc($resultplan);
?>

    <!-- LOGIN -->
    <section>
        <div class="db pb-0">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-lg-3">
                        <?php
                        include 'user-sidebar.php';
                        ?>
                    </div>
                    <div class="col-md-8 col-lg-9">
                        <div class="row">
                            <div class="col-md-12 db-sec-com">
                                
                                <div class="col7 fol-set-rhs">
                                    <!--START-->
                                    <div class="ms-write-post fol-sett-sec sett-rhs-pro" style="">
                                        <div class="foll-set-tit fol-pro-abo-ico">
                                            <h2 class="db-tit">Account Privacy Control</h2>
                                        </div>
                                        <div class="fol-sett-box">
                                            <ul>
                                                <li>
                                                    <div class="sett-lef">
                                                        <div class="auth-pro-sm sett-pro-wid">
                                                            <div class="auth-pro-sm-img">
                                                                <img src="userphoto/<?php echo $rowphotoinfo['profilepic']?>" alt="">
                                                            </div>
                                                            <div class="auth-pro-sm-desc">
                                                                <h5><?php echo $username; ?></h5>
                                                                <p><b><?php echo $userid; ?></b></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="sett-rig">
                                                        <a href="logout.php" class="set-sig-out">Sign Out</a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="sett-lef">
                                                        <div class="sett-rad-left">
                                                            <h5>Profile Privacy </h5>
                                                            <p>You can set-up who can able to view your profile</p>
                                                        </div>
                                                    </div>
                                                    <div class="sett-rig">
                                                        <div class="sett-select-drop">
                                                            <select>
                                                              <option value="all_members">Show my profile to all members including visitors </option>
                                                              <option value="registered_members">Show my profile to registered members only</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="sett-lef">
                                                        <div class="sett-rad-left">
                                                            <h5>Photo Privacy </h5>
                                                            <p>You can set-up who can able to view your photographs</p>
                                                        </div>
                                                    </div>
                                                    <div class="sett-rig">
                                                        <div class="sett-select-drop">
                                                            <select>
                                                              <option value="all_members">Visible to all members including visitors</option>
                                                              <option value="registered_members">Visible to registered members only</option>
                                                              <option value="visited_members">Visible to members visited my profile</option>
                                                              <option value="hide">Hide from all members</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="sett-lef">
                                                        <div class="sett-rad-left">
                                                            <h5>Contact Privacy </h5>
                                                            <p>You can set-up who can able to view your phone no.</p>
                                                        </div>
                                                    </div>
                                                    <div class="sett-rig">
                                                        <div class="sett-select-drop">
                                                            <select>
                                                              <option value="all_members">Show to all members including visitors</option>
                                                              <option value="registered_members">Show to registered members only</option>
                                                              <option value="visited_members">Show to members visited my profile</option>
                                                              <option value="hide">Hide from all members</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="sett-lef">
                                                        <div class="sett-rad-left">
                                                            <h5>Profile sharing using WhatsApp </h5>
                                                            <p>You can set-up who can able to send you message on whatapp</p>
                                                        </div>
                                                    </div>
                                                    <div class="sett-rig">
                                                        <div class="sett-select-drop">
                                                            <select>
                                                                <option value="all_members">Enable to all the members</option>
                                                                <option value="visited_members">Enable to visitors only</option>
                                                                <option value="hide">Disable to all the members</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!--END-->	
                                    <!--START-->
                                    <div class="ms-write-post fol-sett-sec sett-rhs-acc" id="accountdetails">
                                        <div class="foll-set-tit fol-pro-abo-ico">
                                            <h2 class="db-tit">Account Details</h2>
                                        </div>
                                        <div class="fol-sett-box sett-acc-view sett-two-tab">
                                            <ul>
                                                <li>
                                                    <div>Full name</div>
                                                    <div><?php echo $username; ?></div>
                                                </li>
                                                <li>
                                                    <div>Desi Rishta ID</div>
                                                    <div><?php echo $userid; ?></div>
                                                </li>
                                                <li>
                                                    <div>Mobile</div>
                                                    <div><?php echo $rowprofile['phone']; ?></div>
                                                </li>
                                                <li>
                                                    <div>Email id</div>
                                                    <?php
                                                    if($rowprofile['emailverify'] == '1')
                                                    {
                                                    ?>
                                                    <div><?php echo $rowprofile['email']; ?><a href="#" style="float:right" class="sett-acc-edit-eve sett-edit-btn3"> Verified</a></div>
                                                    <?php
                                                    }
                                                    if($rowprofile['emailverify'] == '0')
                                                    {
                                                    ?>
                                                    <div><?php echo $rowprofile['email']; ?><a href="#" style="float:right" class="sett-acc-edit-eve sett-edit-btn1"> Verification Pending</a></div>
                                                    <?php
                                                    }
                                                    if($rowprofile['emailverify'] == '')
                                                    {
                                                    ?>
                                                    <div><?php echo $rowprofile['email']; ?><a href="verifyemailmail.php" style="float:right" class="sett-acc-edit-eve sett-edit-btn2"> Verify</a></div>
                                                    <?php
                                                    }
                                                    ?>
                                                </li>
                                                <li>
                                                    <div>Profile type</div>
                                                    <div><?php echo $rowplan['plan']; ?></div>
                                                </li>
                                                <li>
                                                    <div>Password</div>
                                                    <div><?php $passlength = strlen($rowprofile['password']); for($pass = 1; $pass <= $passlength; $pass++) { echo "*"; } ?><a href="#!" style="float:right" class="sett-acc-edit-eve sett-edit-btn1 "><i class="fa fa-edit" aria-hidden="true"></i> Edit</a></div>
                                                    <?php
                                                    if($_POST['passtype'] == 'old')
                                                    {
                                                    ?>
                                                        <div class="text-danger text-center invalid" id="invalidpop"><i class="fa fa-exclamation-circle"></i>&nbsp;Your new password cannot be one of your last three passwords</div>
                                                    <?php
                                                    }
                                                    ?>
                                                    <?php
                                                    if($_POST['passtype'] == 'new')
                                                    {
                                                    ?>
                                                        <div class="text-success text-center invalid" id="invalidpop"><i class="fa fa-check"></i>&nbsp;Password Updated Successfully</div>
                                                    <?php
                                                    }
                                                    ?>
                                                    <div class="sett-acc-edit">
                                                        <form class="form-com sett-pro-form" action="change-password.php" method="post">
                                                            <ul>
                                                                <li class="b-0 m-0">
                                                                    <div class="fm-lab">New Password</div>
                                                                    <div class="fm-fie">
                                                                        <span class="iconbox">
                                                                            <input type="hidden" name="userid" value="<?php echo $userid; ?>">
                                                                            <input type="password" class="form-control leftspace pl-10" id="newpass" placeholder="Enter New Password" name="password" required>
                                                                            <span class="material-symbols-outlined icon1" style="font-size: 15px;">lock</span>
                                                                            <span class="material-symbols-outlined iconright1" id="openid" style="font-size: 15px;">visibility</span>
                                                                            <span class="material-symbols-outlined iconright1" id="closeeye" style="display:none;" style="font-size: 15px;">visibility_off</span>
                                                                        </span>
                                                                        <p class="text-danger errorstatement fs-12" id="newpasserror" style="display:none">Please Enter New Password.</p>
                                                                        <p class="mb-2 errorstatement fs-12" id="charlen" style="display:none"  style="display:none"><i class="fa fa-exclamation-circle" id="charlenexclamation"></i><i class="fa fa-check" id="charlencheck" style="display:none"></i>&nbsp;Password must be 6-20 characters long</p>
                                                                        <p class="mb-2 errorstatement fs-12" id="charnum" style="display:none"><i class="fa fa-exclamation-circle" id="charnumexclamation"></i><i class="fa fa-check" id="charnumcheck" style="display:none"></i>&nbsp;Password must contain at least one numeric character</p>
                                                                        <p class="text-success errorstatement fs-12" id="passaccept" style="display:none"><i class="fa fa-check"></i>&nbsp;Password Accepted</p>
                                                                        <p class="text-danger errorstatement fs-12" id="criterianotmatch" style="display:none">Password criteria do not match</p>
                                                                    </div>
                                                                </li>
                                                                <li class="b-0 m-0">
                                                                    <div class="fm-lab">Confirm password</div>
                                                                    <div class="fm-fie">
                                                                        <span class="iconbox">
                                                                            <input type="password" class="form-control leftspace pl-10" id="comfrimpass" placeholder="Enter Confirm Password" name="cpassword" required>
                                                                            <span class="material-symbols-outlined icon1" style="font-size: 15px;">lock</span>
                                                                            <span class="material-symbols-outlined iconright1" id="openid" style="font-size: 15px;">visibility</span>
                                                                            <span class="material-symbols-outlined iconright1" id="closeeye" style="display:none;" style="font-size: 15px;">visibility_off</span>
                                                                        </span>
                                                                        <p class="text-danger errorstatement fs-12" id="comfrimpasserror" style="display:none">Please Enter Confirm Password</p>
                                                                        <p class="text-danger errorstatement fs-12" id="notmatched" style="display:none"><i class="fa fa-exclamation-circle"></i>&nbsp;The Password you entered do not match</p>
                                                                        <p class="text-success errorstatement fs-12" id="matched" style="display:none"><i class="fa fa-check"></i>&nbsp;The Password you entered matches</p>
                                                                    </div>
                                                                </li>
                                                                <li class="b-0 m-0">
                                                                    <input type="submit" id="resetpassword" value="Update" class="">
                                                                    <input type="reset" value="Cancel" class="sett-acc-edi-can">
                                                                </li>
                                                            </ul>
                                                        </form>
                                                    </div>
                                                </li>
                                                
                                            </ul>
                                        </div>
                                    </div>
                                    <!--END-->	
                                    <!--START-->
                                    <div class="ms-write-post fol-sett-sec sett-rhs-acc ms-write-post fol-sett-sec sett-rhs-not" style="">
                                        <div class="foll-set-tit fol-pro-abo-ico">
                                            <h2 class="db-tit">User Account Control</h2>
                                        </div>
                                        <div class="fol-sett-box">
                                            <ul>
                                                <li>
                                                    <div class="sett-lef">
                                                        <div class="sett-rad-left">
                                                            <h5>Deactivate Profile</h5>
                                                            <p>You can temporarily hide your profile from all members. Upon deactivation, you will not be able to contact any members until you reactivate your profile.</p>
                                                        </div>
                                                    </div>
                                                    <div class="sett-rig">
                                                        <div class="sett-select-drop">
                                                            <select>
                                                                <option value="">Select</option>
                                                                <option value="1_week">1 Week</option>
                                                                <option value="2_week">2 Week</option>
                                                                <option value="1_month">1 Month</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="sett-lef">
                                                        <div class="sett-rad-left">
                                                            <h5>Delete Profile</h5>
                                                            <p>Delete your profile. Once you delete it, your data will be removed permanently.</p>
                                                        </div>
                                                    </div>
                                                    <div class="sett-rig">
                                                        <a href="delete-profile.php" style="float:right" class=""><i class="fa fa-chevron-circle-right" aria-hidden="true" style='font-size:31px; color:#66451c'></i></a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="sett-lef">
                                                        <div class="sett-rad-left">
                                                            <h5>Blocked Profiles </h5>
                                                            <p>All your blocked profiles will be displayed here</p>
                                                        </div>
                                                    </div>
                                                    <div class="sett-rig">
                                                        <a href="matches-blockid.php" style="float:right" class=""><i class="fa fa-chevron-circle-right" aria-hidden="true" style='font-size:31px; color:#66451c'></i></a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!--END-->
                                   						
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
    $('#newpass').attr('type', 'text');
});

$('#closeeye').click(function() {
    $('#closeeye').hide();
    $('#openid').show();
    $('#newpass').attr('type', 'password');
});

$('#openid1').click(function() {
    $('#openid1').hide();
    $('#closeeye1').show();
    $('#comfrimpass').attr('type', 'text');
});

$('#closeeye1').click(function() {
    $('#closeeye1').hide();
    $('#openid1').show();
    $('#comfrimpass').attr('type', 'password');
});
$('#resetpassword').click(function() {
    var comfrimpass = $('#comfrimpass').val();
    var newpass = $('#newpass').val();
    
    var newpasslen1 = $('#newpass').val().length;
    var regex1 = /\d+/g;
            
    if(newpass == '')
    {
        $('#newpasserror').show();
    }
    else
    {
        $('#newpasserror').hide();
    }
    
    if(comfrimpass == '')
    {
        $('#comfrimpasserror').show();
    }
    else
    {
        $('#comfrimpasserror').hide();
    }
    
    if(newpass != comfrimpass)
    {
        $("#notmatched").show();
        $("#matched").hide();
        $("#charlen").hide();
        $("#charnum").hide();
        $("#criterianotmatch").hide();
        
        $("#newpass").css('border', "2px solid red");
        $("#comfrimpass").css('border', "2px solid red");
        
        return false;
    }
    else
    {
        if(newpass == '' && comfrimpass == '')
        {
            $("#newpass").css('border', "2px solid red");
            $("#comfrimpass").css('border', "2px solid red");
        
            $("#notmatched").hide();
            $("#matched").hide();
        }
        else
        {
            if(newpasslen1 >= '6' && regex1.test(newpass))
            {
                $("#newpass").css('border', "2px solid green");
                $("#comfrimpass").css('border', "2px solid green");
        
                $("#notmatched").hide();
                $("#matched").show();
                
                return true;
            }
            else
            {
                $("#charlen").hide();
                $("#charnum").hide();
                $("#criterianotmatch").show();
                $("#newpass").css('border', "2px solid red");
                return false;
            }
        }
        
    }
});
</script>

<script>
    $('#comfrimpass').keyup(function() {
    var comfrimpass = $('#comfrimpass').val();
    var newpass = $('#newpass').val();
    
    $('#comfrimpasserror').hide();
    
    if(newpass != comfrimpass)
    {
        $("#notmatched").show();
        $("#matched").hide();
        
        $("#newpass").css('border', "2px solid red");
        $("#comfrimpass").css('border', "2px solid red");
        
        return false;
    }
    else
    {
        if(newpass == '' && comfrimpass == '')
        {
            $("#notmatched").hide();
            $("#matched").hide();
            
            $("#newpass").css('border', "");
            $("#comfrimpass").css('border', "");
            
            $('#newpasserror').hide();
            $('#comfrimpasserror').hide();
        }
        else
        {
            $("#newpass").css('border', "2px solid green");
            $("#comfrimpass").css('border', "2px solid green");
        
            $("#notmatched").hide();
            $("#matched").show();
        }
        return true;
    }
});
</script>
<script>
    $(document).ready(function(){
        $('#newpass').keyup(function(){
            
            $('#newpasserror').hide();
            $("#charlen").show();
            $("#charnum").show();
            $("#criterianotmatch").hide();
            $("#matched").hide();
            $("#comfrimpass").css('border', "");
            
            var newpassstr = $('#newpass').val();
            var comfrimpassstr = $('#comfrimpass').val();
            var newpasslen = $('#newpass').val().length;
            var regex = /\d+/g;
    
            if(newpassstr == comfrimpassstr)
            {
                $("#newpass").css('border', "2px solid green");
                $("#comfrimpass").css('border', "2px solid green");
            
                $("#notmatched").hide();
                $("#matched").show();
            }
            else
            {
                $("#newpass").css('border', "2px solid red");
                $("#comfrimpass").css('border', "2px solid red");
            
                $("#notmatched").show();
                $("#matched").hide();
            }
            
            if(newpassstr == '' && comfrimpassstr == '')
            {
                $("#notmatched").hide();
                $("#matched").hide();
            
                $("#newpass").css('border', "");
                $("#comfrimpass").css('border', "");
                
                $('#newpasserror').hide();
                $('#comfrimpasserror').hide();
            }
        
            if(newpassstr == '' && comfrimpassstr != '')
            {
                $("#notmatched").show();
                $("#matched").hide();
        
                $("#newpass").css('border', "2px solid red");
                $("#comfrimpass").css('border', "2px solid red");
            }
            
            if(newpassstr != '' && comfrimpassstr == '')
            {
                $("#notmatched").hide();
                $("#matched").hide();
        
                $("#newpass").css('border', "");
                $("#comfrimpass").css('border', "");
            }
            
            if(newpassstr == '')
            {
                $("#charlen").hide();
                $("#charnum").hide();
                $("#passaccept").hide();
            }
            
            if(newpasslen >= '6')
            {
                $('#charlen').css("color", "green");
                $("#charlenexclamation").hide();
                $("#charlencheck").show();
                
                if(regex.test(newpassstr))
                {
                    $("#passaccept").show();
                    $("#charlen").hide();
                    $("#charnum").hide();
                }
                else
                {
                    $("#passaccept").hide();
                    $("#charlen").show();
                    $("#charnum").show();
                }
            }
            else
            {
                $('#charlen').css("color", "");
                $("#charlenexclamation").show();
                $("#charlencheck").hide();
            }
            
            if(regex.test(newpassstr))
            { 
                $('#charnum').css("color", "green");
                $("#charnumexclamation").hide();
                $("#charnumcheck").show();
                
                if(newpasslen >= '6')
                {
                    $("#passaccept").show();
                    $("#charlen").hide();
                    $("#charnum").hide();
                }
                else
                {
                    $("#passaccept").hide();
                    $("#charlen").show();
                    $("#charnum").show();
                }
            }
            else
            {
                $('#charnum').css("color", "");
                $("#charnumexclamation").show();
                $("#charnumcheck").hide();
            }
            
        });
    });
</script>