<?php
include 'header.php';
?>

<style>
    /* FORM INPUTS (INPUT + TEXTAREA + SELECT) */
    .form-login .form-control,
    .form-login select.form-select,
    .form-login textarea.form-control {
        border: none !important;
        border-radius: 0 !important;
        border-bottom: 3px solid maroon !important;
        outline: none !important;
        box-shadow: none !important;
        background-color: transparent !important;
    }

    /* FOCUS EFFECT */
    .form-login .form-control:focus,
    .form-login select.form-select:focus,
    .form-login textarea.form-control:focus {
        border-bottom-color: maroon !important;
        box-shadow: none !important;
    }

    /* ICONBOX */
    .iconbox {
        position: relative;
    }

    .iconbox .icon,
    .iconbox .iconright {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        color: black;
    }

    /* Left padding for inputs */
    .leftspace {
        padding-left: 50px !important;
    }

    /* Right-side icon */
    .iconright {
        right: 10px;
    }
</style>

<section>
    <div class="login">
        <div class="container">
            <div class="row">

                <div class="inn">
                    <div class="lhs">
                        <div class="tit">
                            <h2>Now <b>Find <br> your life partner</b> Easy and fast.</h2>
                        </div>
                        <div class="im">
                            <img src="images/login-couple.png" alt="">
                        </div>
                        <div class="log-bg">&nbsp;</div>
                    </div>
                    <div class="rhs">
                        <div>
                            <form action="insert-registration.php" method="post" enctype="multipart/form-data">
                                <div id="registration">
                                    <div class="form-tit mt-5">
                                        <h4>Start for free</h4>
                                        <h1>Sign up with Desi Rishta Matrimony</h1>
                                        <!--<p class="mb-0">Fields marked as '<span class="text-danger">*</span>' mandatory fields</p>-->
                                    </div>
                                    <div class="form-login">
                                        <?php
                                        if ($_POST['user'] == 'exist') {
                                        ?>
                                            <p class="text-danger text-center invalid" id="invalidpop"><i class="fa fa-exclamation-circle"></i>&nbsp;User Already Exist</p>
                                        <?php
                                        }
                                        ?>
                                        <div class="form-group">
                                            <label class="lb">Phone No.</label>
                                            <span class="iconbox">
                                                <input type="text" class="form-control leftspace" id="phone" placeholder="Enter Phone No." name="phonenumber" onkeypress="return isNumberKey(event)" onkeyup="numberMobile(event);" maxlength="10" required>
                                                <span class="material-symbols-outlined icon">call</span>
                                            </span>
                                            <p class="text-danger errorstatement" id="phoneerror" style="display:none">Please Enter Phone No.</p>
                                            <span id="duplicatephone"></span>
                                        </div>
                                        <div class="form-group">
                                            <label class="lb">Email ID</label>
                                            <span class="iconbox">
                                                <input type="email" class="form-control leftspace" id="email" placeholder="Enter Email ID" name="email" required>
                                                <span class="material-symbols-outlined icon">mail</span>
                                            </span>
                                            <p class="text-danger errorstatement" id="emailerror" style="display:none">Please Enter Email ID</p>
                                            <span id="duplicateemail"></span>
                                        </div>
                                        <div class="form-group">
                                            <label class="lb">Password</label>
                                            <span class="iconbox">
                                                <input type="password" class="form-control leftspace" id="pwd" placeholder="Set Password" name="password" required>
                                                <span class="material-symbols-outlined icon">lock</span>
                                                <span class="material-symbols-outlined iconright" id="openid">visibility</span>
                                                <span class="material-symbols-outlined iconright" id="closeeye" style="display:none;">visibility_off</span>
                                            </span>
                                            <p class="text-danger errorstatement" id="passworderror" style="display:none">Please Enter Password</p>
                                            <p class="mb-2 errorstatement" id="charlen" style="display:none" style="display:none"><i class="fa fa-exclamation-circle" id="charlenexclamation"></i><i class="fa fa-check" id="charlencheck" style="display:none"></i>&nbsp;Password must be 6-20 characters long</p>
                                            <p class="mb-2 errorstatement" id="charnum" style="display:none"><i class="fa fa-exclamation-circle" id="charnumexclamation"></i><i class="fa fa-check" id="charnumcheck" style="display:none"></i>&nbsp;Password must contain at least one numeric character</p>
                                            <p class="text-success errorstatement" id="passaccept" style="display:none"><i class="fa fa-check"></i>&nbsp;Password Accepted</p>
                                            <p class="text-danger errorstatement" id="criterianotmatch" style="display:none">Password criteria do not match</p>
                                        </div>
                                        <!-- <div class="form-group form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="checkbox" name="agree" value="yes" checked> By creating an account, I agree to the <a href="/desirishta/faqterms.php" class="faqlink-text pink"><b>T&C</b></a> and <a href="/desirishta/faqprivacy.php" class="faqlink-text pink"><b>Privacy Policy</b></a>
                                                </label>
                                            </div> -->
                                        <div class="form-group form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="agree" id="agree" value="yes" checked>
                                                By creating an account, I agree to the <a href="faqterms.php" class="faqlink-text pink"><b>T&C</b></a> and <a href="faqprivacy.php" class="faqlink-text pink"><b>Privacy Policy</b></a>
                                            </label>
                                            <p class="text-danger errorstatement" id="agreeerror" style="display:none">
                                                <i class="fa fa-exclamation-circle"></i> Please agree to the Terms & Conditions
                                            </p>
                                        </div>
                                        <button type="button" id="mobileverifybtn" class="btn btn-primary" style="">Register Free &nbsp;<i class="fa fa-arrow-right"></i></button>
                                        <div class="form-tit" style="border:0px">
                                            <p class="text-center mt-5">Already have an account? <a href="login.php" class="linkbold pink" style="font-weight: 800;">Sign In</a></p>
                                        </div>
                                    </div>
                                </div>



                                <div id="mobileverify" style="display:none">
                                    <div>
                                        <i class="fa fa-arrow-left text-left leftarrow" id="mobileverifyback"></i>
                                        <a href="sign-up.php"><i class="fa fa-close text-right closecross"></i></a>
                                    </div>

                                    <div class="form-tit mt-5">
                                        <h1>Verify Phone Number</h1>
                                        <p>We have sent an OTP to <span id="otpphone"></span></p>
                                    </div>

                                    <div class="form-login">
                                        <span id="otpinvalid"></span>

                                        <div class="form-group">
                                            <label class="lb">OTP Code</label>
                                            <span class="iconbox">
                                                <input type="hidden" class="form-control" id="phoneno"
                                                    value="<?php echo $_COOKIE['dr_phone']; ?>" readonly>

                                                <input type="text" class="form-control leftspace" id="otp"
                                                    placeholder="Enter OTP Code"
                                                    onkeypress="return isNumberKey(event)">

                                                <span class="material-symbols-outlined icon">password</span>
                                            </span>
                                            <p class="text-danger errorstatement" id="otperror" style="display:none">
                                                Please Enter OTP
                                            </p>
                                        </div>

                                        <!-- 🔹 RESEND OTP -->


                                        <button type="button" id="basicinfobtn"
                                            class="btn btn-primary mb-5">
                                            Verify Phone Number
                                        </button>
                                        <p id="resendWrapper" style="margin-top:10px;     
    
    color: rgb(91, 44, 44);
    font-weight: 500;
    font-size: 13px;
    text-align: center;">
                                            Didn’t receive the code?
                                            <span id="resendOtp"
                                                style="color:#e91e63; cursor:pointer; font-weight:600;">
                                                Resend
                                            </span>
                                        </p>

                                        <!-- 🔹 TIMER -->
                                        <p id="resendTimer"
                                            style="display:none;
    margin-top: 10px;
    color: rgb(91, 44, 44);
    font-weight: 500;
    font-size: 13px;
    text-align: center;">
                                            Resend OTP in <span id="timerCount">40</span> seconds
                                        </p>
                                    </div>
                                </div>
                             


                                <style>
                                    #otpphone {
                                        color: #000000;
                                        font-weight: 700;
                                        letter-spacing: 1px;
                                        font-size: 20px;
                                    }
                                </style>



                                <div id="basicinfo" style="display:none">
                                    <div>
                                        <i class="fa fa-arrow-left text-left leftarrow" id="basicinfoback"></i>
                                        <a href="sign-up.php"><i class="fa fa-close text-right closecross"></i></a>
                                    </div>
                                    <div class="form-tit mt-5 row">
                                        <div class="col-md-12 mb-3 p-0">
                                            <div class="formnum active">1</div>
                                            <div class="formnum">2</div>
                                            <div class="formnum">3</div>
                                            <div class="formnum">4</div>
                                            <div class="formnum">5</div>
                                            <div class="formnum">6</div>
                                            <div class="formnum">7</div>
                                            <div class="formnum">8</div>
                                        </div>
                                        <div class="col-md-12">
                                            <h4>Thanks for signing up! Let's create your profile….</h4>
                                            <h1>Basic Information</h1>
                                            <!--<p class="mb-0">Fields marked as '<span class="text-danger">*</span>' mandatory fields</p>-->
                                        </div>
                                    </div>
                                    <div class="form-login">
                                        <div class="form-group">
                                            <label class="lb">Profile Created By</label>
                                            <span class="iconbox">
                                                <select class="form-select chosen-select" name="createby" id="createby">
                                                    <option value="">Select</option>
                                                    <option>Self</option>
                                                    <option>Son</option>
                                                    <option>Daughter</option>
                                                    <option>Brother</option>
                                                    <option>Sister</option>
                                                    <option>Friends</option>
                                                    <option>Relative</option>
                                                    <option>Others</option>
                                                </select>
                                                <span class="material-icons icon">person</span>
                                            </span>
                                            <p class="text-danger errorstatement" id="profileerror" style="display:none">Please Select Profile Created By</p>
                                        </div>
                                        <div class="form-group">
                                            <label class="lb">Full Name</label>
                                            <span class="iconbox">
                                                <input type="text" pseudo="placeholder" class="form-control leftspace" placeholder="Enter Details" name="fullname" id="fullname">
                                                <span class="material-icons icon">badge</span>
                                            </span>
                                            <p class="text-danger errorstatement" id="nameerror" style="display:none">Please Enter Name</p>
                                        </div>
                                        <!-- <div class="form-group">
                                                <label class="lb">Gender</label>
                                                <span class="iconbox">
                                                    <select class="form-select chosen-select" name="gender" id="gender">
                                                        <option value="">Select</option>
                                                        <option>Male</option>
                                                        <option>Female</option>
                                                        <option>Other</option>
                                                    </select>
                                                    <span class="material-icons icon">transgender</span>
                                                </span>
                                                <p class="text-danger errorstatement" id="gendererror" style="display:none">Please Select Gender</p>
                                            </div> -->
                                        <style>
                                            /* Gender Button Styles */
                                            .gender-btn {
                                                border: 2px solid maroon;
                                                color: maroon;
                                                background-color: transparent;
                                                padding: 10px;
                                                font-weight: bold;
                                                transition: all 0.3s ease;
                                                border-radius: 5px;
                                            }

                                            /* Active State (When selected) */
                                            .gender-btn.active {
                                                background-color: maroon;
                                                color: white;
                                                box-shadow: 0 4px 8px rgba(128, 0, 0, 0.3);
                                            }

                                            .gender-btn:hover {
                                                background-color: #fcebeb;
                                                /* Light maroon hover */
                                            }
                                        </style>

                                        <div class="form-group">
                                            <label class="lb" style="display:block; margin-bottom: 10px;">Gender</label>

                                            <div class="d-flex" style="gap: 15px;">
                                                <button type="button" class="btn gender-btn w-50" data-value="Male">
                                                    <i class="fa fa-male"></i> Male
                                                </button>

                                                <button type="button" class="btn gender-btn w-50" data-value="Female">
                                                    <i class="fa fa-female"></i> Female
                                                </button>
                                            </div>

                                            <input type="hidden" name="gender" id="gender" value="">

                                            <p class="text-danger errorstatement" id="gendererror" style="display:none; margin-top: 10px;">Please Select Gender</p>
                                        </div>

                                        <div class="form-group">
                                            <label class="lb">Marital Status</label>
                                            <span class="iconbox">
                                                <select class="form-select chosen-select" name="marital" id="marital">
                                                    <option value="">Select</option>
                                                    <option>Never Married</option>
                                                    <option>Divorced</option>
                                                    <option>Widowed</option>
                                                    <option>Awaiting Divorce</option>
                                                </select>
                                                <span class="material-symbols-outlined icon">diversity_4</span>
                                            </span>
                                            <p class="text-danger errorstatement" id="maritalerror" style="display:none">Please Select Marital Status</p>
                                        </div>
                                        <div class="form-group" id="children" style="display:none">
                                            <label class="lb">Have Children</label>
                                            <span class="iconbox">
                                                <select class="form-select chosen-select" name="children">
                                                    <option value="">Select</option>
                                                    <option>Yes</option>
                                                    <option>No</option>
                                                </select>
                                                <span class="material-icons icon">child_care</span>
                                            </span>
                                            <p class="text-danger errorstatement" id="childerror" style="display:none">Please Select Children</p>
                                        </div>
                                        <div class="form-group">
                                            <label class="lb">Height</label>
                                            <span class="iconbox">
                                                <select class="form-select chosen-select" name="height" id="height">
                                                    <option value="">Select</option>
                                                    <option>4 Feet 5 Inches</option>
                                                    <option>4 Feet 6 Inches</option>
                                                    <option>4 Feet 7 Inches</option>
                                                    <option>4 Feet 8 Inches</option>
                                                    <option>4 Feet 9 Inches</option>
                                                    <option>4 Feet 10 Inches</option>
                                                    <option>4 Feet 11 Inches</option>
                                                    <option>5 Feet 0 Inches</option>
                                                    <option>5 Feet 1 Inches</option>
                                                    <option>5 Feet 2 Inches</option>
                                                    <option>5 Feet 3 Inches</option>
                                                    <option>5 Feet 4 Inches</option>
                                                    <option>5 Feet 5 Inches</option>
                                                    <option>5 Feet 6 Inches</option>
                                                    <option>5 Feet 7 Inches</option>
                                                    <option>5 Feet 8 Inches</option>
                                                    <option>5 Feet 9 Inches</option>
                                                    <option>5 Feet 10 Inches</option>
                                                    <option>5 Feet 11 Inches</option>
                                                    <option>6 Feet 0 Inches</option>
                                                    <option>6 Feet 1 Inches</option>
                                                    <option>6 Feet 2 Inches</option>
                                                    <option>6 Feet 3 Inches</option>
                                                    <option>6 Feet 4 Inches</option>
                                                    <option>6 Feet 5 Inches</option>
                                                    <option>6 Feet 6 Inches</option>
                                                    <option>6 Feet 7 Inches</option>
                                                    <option>6 Feet 8 Inches</option>
                                                    <option>6 Feet 9 Inches</option>
                                                    <option>6 Feet 10 Inches</option>
                                                    <option>6 Feet 11 Inches</option>
                                                    <option>7 Feet 0 Inches</option>
                                                    <option>7 Feet 1 Inches</option>
                                                    <option>7 Feet 2 Inches</option>
                                                    <option>7 Feet 3 Inches</option>
                                                    <option>7 Feet 4 Inches</option>
                                                    <option>7 Feet 5 Inches</option>
                                                </select>
                                                <span class="material-icons icon">height</span>
                                            </span>
                                            <p class="text-danger errorstatement" id="heighterror" style="display:none">Please Select Height</p>
                                        </div>
                                        <div class="form-group">
                                            <label class="lb">Eating Habits</label>
                                            <span class="iconbox">
                                                <select class="form-select chosen-select" name="eating" id="eating">
                                                    <option value="">Select</option>
                                                    <option>Vegetarian</option>
                                                    <option>Non-Vegetarian</option>
                                                    <option>Eggetarian</option>
                                                    <otpion>Vegan</otpion>
                                                </select>
                                                <span class="material-icons icon">dining</span>
                                            </span>
                                            <p class="text-danger errorstatement" id="eatingerror" style="display:none">Please Select Eating Habits</p>
                                        </div>
                                        <div class="form-group">
                                            <label class="lb">Smoking Habits</label>
                                            <span class="iconbox">
                                                <select class="form-select chosen-select" id="smoking" name="smoking">
                                                    <option value="">Select</option>
                                                    <option>Non-smoker</option>
                                                    <option>Light / Social smoker</option>
                                                    <option>Regular Smoker</option>
                                                </select>
                                                <i class="material-icons icon">smoking_rooms</i>
                                            </span>
                                            <p class="text-danger errorstatement" id="smokingerror" style="display:none">Please Select Smoking Habits</p>
                                        </div>
                                        <div class="form-group">
                                            <label class="lb">Drinking Habits</label>
                                            <span class="iconbox">
                                                <select class="form-select chosen-select" id="drinking" name="drinking">
                                                    <option value="">Select</option>
                                                    <option>Non-drinker</option>
                                                    <option>Light / Social drinker</option>
                                                    <option>Regular drinker</option>
                                                </select>
                                                <i class="material-icons icon">local_drink</i>
                                            </span>
                                            <p class="text-danger errorstatement" id="drinkingerror" style="display:none">Please Select Drinking Habits</p>
                                        </div>


                                        <button type="button" id="astrodetailsbtn" class="btn btn-primary">Continue</button>
                                        <div style="font-size:14px; color:#555; margin-top:10px; text-align: center;">
                                            Your Information & Pictures will be
                                            <span style="color:#28a745; font-weight:600;">100% Safe</span><br>
                                            Privacy controls are available in Settings
                                        </div>
                                    </div>
                                </div>

                                <div id="astrodetails" style="display:none">
                                    <div>
                                        <i class="fa fa-arrow-left text-left leftarrow" id="astrodetailsback"></i>
                                        <a href="sign-up.php"><i class="fa fa-close text-right closecross"></i></a>
                                    </div>
                                    <div class="form-tit mt-5 row">
                                        <div class="col-md-12 mb-3">
                                            <div class="formnum active">1</div>
                                            <div class="formnum active">2</div>
                                            <div class="formnum">3</div>
                                            <div class="formnum">4</div>
                                            <div class="formnum">5</div>
                                            <div class="formnum">6</div>
                                            <div class="formnum">7</div>
                                            <div class="formnum">8</div>
                                        </div>
                                        <div class="col-md-12">
                                            <h4>Below details help us find better matches….</h4>
                                            <h1>Astro Details</h1>
                                            <!--<p class="mb-0">Fields marked as '<span class="text-danger">*</span>' mandatory fields</p>-->
                                        </div>
                                    </div>
                                    <div class="form-login">
                                        <div class="form-group">
                                            <label class="lb">Date of Birth</label>
                                            <span class="iconbox">
                                                <input type="date" onfocus="this.showPicker()" class="form-control  leftspace text-uppercase" placeholder="DD-MM-YYYY" name="dob" id="dob">
                                                <span class="material-icons icon">calendar_month</span>
                                            </span>
                                            <p class="text-danger errorstatement" id="doberror" style="display:none">Please Enter Date of Birth</p>
                                        </div>
                                        <div class="form-group">
                                            <label class="lb">Place of Birth</label>
                                            <span class="iconbox">
                                                <input type="text" class="form-control leftspace" placeholder="Enter Details" name="birthplace" id="birthplace">
                                                <span class="material-icons icon">location_on</span>
                                            </span>
                                            <p class="text-danger errorstatement" id="birthplaceerror" style="display:none">Please Enter Place of Birth</p>
                                        </div>
                                        <div class="form-group">
                                            <label class="lb">Time of Birth</label>
                                            <span class="iconbox">
                                                <input type="time" onfocus="this.showPicker()" class="form-control leftspace" placeholder="Enter Details" name="birthtime" id="birthtime">
                                                <span class="material-symbols-outlined icon">schedule</span>
                                            </span>
                                            <p class="text-danger errorstatement" id="birthtimeerror" style="display:none">Please Enter Time of Birth</p>
                                        </div>
                                        <div class="form-group">
                                            <label class="lb">Dosh/Dosham</label>
                                            <span class="iconbox">
                                                <select class="form-select chosen-select" name="manglik" id="manglik">
                                                    <option value="">Select</option>
                                                    <option>Yes</option>
                                                    <option>No</option>
                                                    <option>Dont Know</option>
                                                </select>
                                                <span class="material-symbols-outlined icon">error</span>
                                            </span>
                                            <p class="text-danger errorstatement" id="manglikerror" style="display:none">Please Select Dosh/Dosham</p>
                                        </div>

                                        <button type="button" id="religiousbackgroundbtn" class="btn btn-primary">Continue</button>
                                        <div style="font-size:14px; color:#555; margin-top:10px; text-align: center;">
                                            Your Information & Pictures will be
                                            <span style="color:#28a745; font-weight:600;">100% Safe</span><br>
                                            Privacy controls are available in Settings
                                        </div>
                                        <p class="errorstatement text-white notebox" id="ageerror" style="display:none"></p>
                                    </div>
                                </div>

                                <div id="religiousbackground" style="display:none">
                                    <div>
                                        <i class="fa fa-arrow-left text-left leftarrow" id="religiousbackgroundback"></i>
                                        <a href="sign-up.php"><i class="fa fa-close text-right closecross"></i></a>
                                    </div>
                                    <div class="form-tit mt-5 row">
                                        <div class="col-md-12 mb-3">
                                            <div class="formnum active">1</div>
                                            <div class="formnum active">2</div>
                                            <div class="formnum active">3</div>
                                            <div class="formnum">4</div>
                                            <div class="formnum">5</div>
                                            <div class="formnum">6</div>
                                            <div class="formnum">7</div>
                                            <div class="formnum">8</div>
                                        </div>
                                        <div class="col-md-12">
                                            <h4>Below details help us find better matches & Just few more steps!</h4>
                                            <h1>Religious Background</h1>
                                            <!--<p class="mb-0">Fields marked as '<span class="text-danger">*</span>' mandatory fields</p>-->
                                        </div>
                                    </div>
                                    <div class="form-login">
                                        <div class="form-group">
                                            <label class="lb">Religion</label>
                                            <span class="iconbox">
                                                <select class="form-select chosen-select" id="religion" name="religion">
                                                    <option value="">Select</option>
                                                    <?php
                                                    $sqlreligion = "select distinct(religion) from religion_caste";
                                                    $resultreligion = mysqli_query($con, $sqlreligion);
                                                    while ($rowreligion = mysqli_fetch_assoc($resultreligion)) {
                                                    ?>
                                                        <option value="<?php echo $rowreligion['religion']; ?>"><?php echo $rowreligion['religion']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                                <span class="material-symbols-outlined icon">temple_hindu</span>
                                            </span>
                                            <p class="text-danger errorstatement" id="religionerror" style="display:none">Please Select Religion</p>
                                        </div>
                                        <div class="form-group" id="emptycaste">
                                            <label class="lb">Caste</label>
                                            <span class="iconbox">
                                                <select class="form-select chosen-select">
                                                    <option value="">Select</option>
                                                </select>
                                                <span class="material-symbols-outlined icon">reduce_capacity</span>
                                            </span>
                                        </div>
                                        <?php
                                        $sqlreligion1 = "select distinct(religion) from religion_caste";
                                        $resultreligion1 = mysqli_query($con, $sqlreligion1);
                                        while ($rowreligion1 = mysqli_fetch_assoc($resultreligion1)) {
                                            $religion = $rowreligion1['religion'];
                                        ?>
                                            <div class="form-group signupcaste" id="<?php echo str_replace(" ", "-", $religion) ?>" style="display:none">
                                                <label class="lb">Caste</label>
                                                <span class="iconbox">
                                                    <select class="form-select chosen-select yourcaste <?php echo str_replace(" ", "-", $religion) ?>" name="caste[]">
                                                        <option value="">Select</option>
                                                        <?php
                                                        $sqlcaste = "select * from religion_caste where religion = '$religion'";
                                                        $resultcaste = mysqli_query($con, $sqlcaste);
                                                        while ($rowcaste = mysqli_fetch_assoc($resultcaste)) {
                                                        ?>
                                                            <option value="<?php echo $rowcaste['caste']; ?>"><?php echo $rowcaste['caste']; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <span class="material-symbols-outlined icon">reduce_capacity</span>
                                                </span>
                                                <p class="text-danger errorstatement" id="<?php echo str_replace(" ", "-", $religion) . 'error' ?>" style="display:none">Please Select Caste</p>
                                            </div>
                                        <?php
                                        }
                                        ?>

                                        <button type="button" id="educationcareerbtn" class="btn btn-primary">Continue</button>
                                        <div style="font-size:14px; color:#555; margin-top:10px; text-align: center;">
                                            Your Information & Pictures will be
                                            <span style="color:#28a745; font-weight:600;">100% Safe</span><br>
                                            Privacy controls are available in Settings
                                        </div>
                                    </div>
                                </div>

                                <div id="educationcareer" style="display:none">
                                    <div>
                                        <i class="fa fa-arrow-left text-left leftarrow" id="educationcareerback"></i>
                                        <a href="sign-up.php"><i class="fa fa-close text-right closecross"></i></a>
                                    </div>
                                    <div class="form-tit mt-5 row">
                                        <div class="col-md-12 mb-3">
                                            <div class="formnum active">1</div>
                                            <div class="formnum active">2</div>
                                            <div class="formnum active">3</div>
                                            <div class="formnum  active">4</div>
                                            <div class="formnum">5</div>
                                            <div class="formnum">6</div>
                                            <div class="formnum">7</div>
                                            <div class="formnum">8</div>
                                        </div>
                                        <div class="col-md-12">
                                            <h4>Below details help us find better matches & Just few more steps!</h4>
                                            <h1>Education & Career</h1>
                                            <!--<p class="mb-0">Fields marked as '<span class="text-danger">*</span>' mandatory fields</p>-->
                                        </div>
                                    </div>
                                    <div class="form-login">
                                        <div class="form-group">
                                            <label class="lb">Stream</label>
                                            <span class="iconbox">
                                                <select class="form-select chosen-select" id="stream" name="stream">
                                                    <option value="">Select</option>
                                                    <?php
                                                    $sqlstream = "select distinct(stream) from stream_education";
                                                    $resultstream = mysqli_query($con, $sqlstream);
                                                    while ($rowstream = mysqli_fetch_assoc($resultstream)) {
                                                    ?>
                                                        <option value="<?php echo str_replace("/", "_", str_replace(" ", "-", $rowstream['stream'])); ?>"><?php echo $rowstream['stream']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                                <span class="material-symbols-outlined icon">menu_book</span>
                                            </span>
                                            <p class="text-danger errorstatement" id="streamerror" style="display:none">Please Select Stream</p>
                                        </div>
                                        <div class="form-group" id="emptyeducation">
                                            <label class="lb">Highest Education</label>
                                            <span class="iconbox">
                                                <select class="form-select chosen-select education">
                                                    <option value="">Select</option>
                                                </select>
                                                <span class="material-symbols-outlined icon">school</span>
                                            </span>
                                            <p class="text-danger errorstatement" id="educationerror" style="display:none">Please Select Highest Education</p>
                                        </div>
                                        <?php
                                        $sqlstream1 = "select distinct(stream) from stream_education";
                                        $resultstream1 = mysqli_query($con, $sqlstream1);
                                        while ($rowstream1 = mysqli_fetch_assoc($resultstream1)) {
                                            $stream = $rowstream1['stream'];
                                        ?>
                                            <div class="form-group signupstream" id="<?php echo str_replace("/", "_", str_replace(" ", "-", $stream)); ?>" style="display:none">
                                                <label class="lb">Highest Education</label>
                                                <span class="iconbox">
                                                    <select class="form-select chosen-select signupstream-s <?php echo str_replace("/", "_", str_replace(" ", "-", $stream)); ?>" name="education[]">
                                                        <option value="">Select</option>
                                                        <?php
                                                        $sqleducation = "select * from stream_education where stream = '$stream'";
                                                        $resulteducation = mysqli_query($con, $sqleducation);
                                                        while ($roweducation = mysqli_fetch_assoc($resulteducation)) {
                                                        ?>
                                                            <option value="<?php echo $roweducation['education']; ?>"><?php echo $roweducation['education']; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <i class="fa fa-map-pin icon"></i>
                                                </span>
                                                <p class="text-danger errorstatement" id="<?php echo str_replace("/", "_", str_replace(" ", "-", $stream)) . 'error'; ?>" style="display:none">Please Select Highest Education</p>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <div class="form-group">
                                            <label class="lb">Working With</label>
                                            <span class="iconbox">
                                                <select class="form-select chosen-select" name="profession" id="profession">
                                                    <option value="">Select</option>
                                                    <option>Private Company/Corporate</option>
                                                    <option>Government/Public Sector</option>
                                                    <option>Defence Services</option>
                                                    <option>Civil Services</option>
                                                    <option>Business/Self Employed</option>
                                                    <option>Not Working</option>
                                                </select>
                                                <span class="material-symbols-outlined icon">work</span>
                                            </span>
                                            <p class="text-danger errorstatement" id="professionerror" style="display:none">Please Select Working With</p>
                                        </div>
                                        <div class="form-group">
                                            <label class="lb">Profession</label>
                                            <span class="iconbox">
                                                <select class="form-select chosen-select" id="domain" name="domain">
                                                    <option value="">Select</option>
                                                    <?php
                                                    $sqldomain = "select distinct(domain) from domain_designation";
                                                    $resultdomain = mysqli_query($con, $sqldomain);
                                                    while ($rowdomain = mysqli_fetch_assoc($resultdomain)) {
                                                    ?>
                                                        <option value="<?php echo str_replace("&", "and", str_replace(",", "", str_replace(" ", "-", $rowdomain['domain']))); ?>"><?php echo $rowdomain['domain']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                                <span class="material-symbols-outlined icon">account_circle</span>
                                            </span>
                                            <p class="text-danger errorstatement" id="domainerror" style="display:none">Please Select Profession</p>
                                        </div>
                                        <div class="form-group" id="emptydesignation">
                                            <label class="lb">Designation </label>
                                            <span class="iconbox">
                                                <select class="form-select chosen-select designation">
                                                    <option value="">Select</option>
                                                </select>
                                                <span class="material-symbols-outlined icon">airline_seat_recline_normal</span>
                                            </span>
                                            <p class="text-danger errorstatement" id="designationerror" style="display:none">Please Select Designation</p>
                                        </div>
                                        <?php
                                        $sqldomain1 = "select distinct(domain) from domain_designation";
                                        $resultdomain1 = mysqli_query($con, $sqldomain1);
                                        while ($rowdomain1 = mysqli_fetch_assoc($resultdomain1)) {
                                            $domain = $rowdomain1['domain'];
                                        ?>
                                            <div class="form-group signupdomain" id="<?php echo "desig_" . str_replace("&", "and", str_replace(",", "", str_replace(" ", "-", $domain))); ?>" style="display:none">
                                                <label class="lb">Designation </label>
                                                <span class="iconbox">
                                                    <select class="form-select chosen-select <?php echo str_replace("&", "and", str_replace(",", "", str_replace(" ", "-", $domain))); ?>" name="designation[]">
                                                        <option value="">Select</option>
                                                        <?php
                                                        $sqldesignation = "select * from domain_designation where domain = '$domain'";
                                                        $resultdesignation = mysqli_query($con, $sqldesignation);
                                                        while ($rowdesignation = mysqli_fetch_assoc($resultdesignation)) {
                                                        ?>
                                                            <option value="<?php echo $rowdesignation['designation']; ?>"><?php echo $rowdesignation['designation']; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <span class="material-symbols-outlined icon">airline_seat_recline_normal</span>
                                                </span>
                                                <p class="text-danger errorstatement" id="<?php echo str_replace("&", "and", str_replace(",", "", str_replace(" ", "-", $domain))) . 'error'; ?>" style="display:none">Please Select Designation</p>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <div class="form-group">
                                            <label class="lb">Annual Income</label>
                                            <span class="iconbox">
                                                <select class="form-select chosen-select" name="annualincome" id="annualincome">
                                                    <option value="">Select</option>
                                                    <option>Upto 1 Lakhs</option>
                                                    <option>1 Lakhs - 2 Lakhs</option>
                                                    <option>2 Lakhs - 5 Lakhs</option>
                                                    <option>5 Lakhs - 7 Lakhs</option>
                                                    <option>7 Lakhs - 10 Lakhs</option>
                                                    <option>10 Lakhs - 15 Lakhs</option>
                                                    <option>15 Lakhs - 20 Lakhs</option>
                                                    <option>20 Lakhs - 25 Lakhs</option>
                                                    <option>25 Lakhs - 30 Lakhs</option>
                                                    <option>30 Lakhs - 50 Lakhs</option>
                                                    <option>50 Lakhs - 75 Lakhs</option>
                                                    <option>75 Lakhs - 1 Crore</option>
                                                    <option>1 Crore and Above</option>
                                                </select>
                                                <span class="material-symbols-outlined icon">currency_rupee</span>
                                            </span>
                                            <p class="text-danger errorstatement" id="annualincomeerror" style="display:none">Please Enter Annual Income</p>
                                        </div>

                                        <button type="button" id="familydetailsbtn" class="btn btn-primary">Continue</button>
                                        <div style="font-size:14px; color:#555; margin-top:10px; text-align: center;">
                                            Your Information & Pictures will be
                                            <span style="color:#28a745; font-weight:600;">100% Safe</span><br>
                                            Privacy controls are available in Settings
                                        </div>
                                    </div>
                                </div>

                                <div id="familydetails" style="display:none">
                                    <div>
                                        <i class="fa fa-arrow-left text-left leftarrow" id="familydetailsback"></i>
                                        <a href="sign-up.php"><i class="fa fa-close text-right closecross"></i></a>
                                    </div>
                                    <div class="form-tit mt-5 row">
                                        <div class="col-md-12 mb-3">
                                            <div class="formnum active">1</div>
                                            <div class="formnum active">2</div>
                                            <div class="formnum active">3</div>
                                            <div class="formnum  active">4</div>
                                            <div class="formnum active">5</div>
                                            <div class="formnum">6</div>
                                            <div class="formnum">7</div>
                                            <div class="formnum">8</div>
                                        </div>
                                        <div class="col-md-12">
                                            <h4>Just few more steps to go...</h4>
                                            <h1>Family Details</h1>
                                            <!--<p class="mb-0">Fields marked as '<span class="text-danger">*</span>' mandatory fields</p>-->
                                        </div>
                                    </div>
                                    <div class="form-login">
                                        <div class="form-group">
                                            <label class="lb">Family Type</label>
                                            <span class="iconbox">
                                                <select class="form-select chosen-select" name="familytype" id="familytype">
                                                    <option value="">Select</option>
                                                    <option>Joint Family</option>
                                                    <option>Nuclear Family</option>
                                                </select>
                                                <span class="material-symbols-outlined icon">diversity_3</span>
                                            </span>
                                            <p class="text-danger errorstatement" id="familytypeerror" style="display:none">Please Select Family Type</p>
                                        </div>
                                        <div class="form-group">
                                            <label class="lb">Family Status</label>
                                            <span class="iconbox">
                                                <select class="form-select chosen-select" name="familystatus" id="familystatus">
                                                    <option value="">Select</option>
                                                    <option>Middle Class</option>
                                                    <option>Upper Middle Class</option>
                                                    <option>Affluent</option>
                                                    <option>Other</option>
                                                </select>
                                                <span class="material-symbols-outlined icon">diversity_3</span>
                                            </span>
                                            <p class="text-danger errorstatement" id="familystatuserror" style="display:none">Please Select Family Status</p>
                                        </div>
                                        <div class="form-group">
                                            <label class="lb">Father's Name</label>
                                            <span class="iconbox">
                                                <input type="text" class="form-control leftspace" placeholder="Enter Details" id="fathername" name="fathername">
                                                <span class="material-symbols-outlined icon">man</span>
                                            </span>
                                            <p class="text-danger errorstatement" id="fathernameerror" style="display:none">Please Enter Father's Name</p>
                                        </div>
                                        <div class="form-group">
                                            <label class="lb">Mother's Name</label>
                                            <span class="iconbox">
                                                <input type="text" class="form-control leftspace" placeholder="Enter Details" name="mothername" id="mothername">
                                                <span class="material-symbols-outlined icon">woman</span>
                                            </span>
                                            <p class="text-danger errorstatement" id="mothernameerror" style="display:none">Please Enter Mother's Name</p>
                                        </div>
                                        <div class="form-group">
                                            <label class="lb">Father's Occupation</label>
                                            <span class="iconbox">
                                                <input type="text" class="form-control leftspace" placeholder="Enter Details" name="fatheroccupation" id="fatheroccupation">
                                                <span class="material-symbols-outlined icon">work</span>
                                            </span>
                                            <p class="text-danger errorstatement" id="fatheroccupationerror" style="display:none">Please Select Father's Occupation</p>
                                        </div>
                                        <div class="form-group">
                                            <label class="lb">Mother's Occupation</label>
                                            <span class="iconbox">
                                                <input type="text" class="form-control leftspace" placeholder="Enter Details" name="motheroccupation" id="motheroccupation">
                                                <span class="material-symbols-outlined icon">work</span>
                                            </span>
                                            <p class="text-danger errorstatement" id="motheroccupationerror" style="display:none">Please Select Mother's Occupation</p>
                                        </div>
                                        <div class="form-group">
                                            <label class="lb">Country</label>
                                            <span class="iconbox">
                                                <select class="form-select chosen-select" name="country" id="country">
                                                    <option value="">Select</option>
                                                    <?php
                                                    $sqlcountry = "select * from countries";
                                                    $resultcountry = mysqli_query($con, $sqlcountry);
                                                    while ($rowcountry = mysqli_fetch_assoc($resultcountry)) {
                                                    ?>
                                                        <option><?php echo $rowcountry['country']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                                <span class="material-symbols-outlined icon">globe</span>
                                            </span>
                                            <p class="text-danger errorstatement" id="countryerror" style="display:none">Please Select Country</p>
                                        </div>
                                        <div class="form-group">
                                            <label class="lb">State</label>
                                            <span class="iconbox">
                                                <select class="form-select chosen-select" id="partnerstate" name="state">
                                                    <option value="">Select</option>
                                                    <?php
                                                    $sqlstate = "select distinct(state) from city_state";
                                                    $resultstate = mysqli_query($con, $sqlstate);
                                                    while ($rowstate = mysqli_fetch_assoc($resultstate)) {
                                                    ?>
                                                        <option value="<?php echo str_replace(" ", "-", $rowstate['state']); ?>"><?php echo $rowstate['state']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                                <span class="material-symbols-outlined icon">map</span>
                                            </span>
                                            <p class="text-danger errorstatement" id="stateerror" style="display:none">Please Select State</p>
                                        </div>
                                        <div class="form-group" id="emptypartnercity">
                                            <label class="lb">City</label>
                                            <span class="iconbox">
                                                <select class="form-select chosen-select familycity">
                                                    <option value="">Select</option>
                                                </select>
                                                <span class="material-symbols-outlined icon">location_on</span>
                                            </span>
                                            <p class="text-danger errorstatement" id="cityerror" style="display:none">Please Select City</p>
                                        </div>
                                        <?php
                                        $sqlstate11 = "select distinct(state) from city_state";
                                        $resultstate11 = mysqli_query($con, $sqlstate11);
                                        while ($rowstate11 = mysqli_fetch_assoc($resultstate11)) {
                                            $partnerstate = $rowstate11['state'];
                                        ?>
                                            <div class="form-group signuppartnercity" id="<?php echo "pc_" . str_replace(" ", "-", $partnerstate) ?>" style="display:none">
                                                <label class="lb">City</label>
                                                <span class="iconbox">
                                                    <select class="form-select chosen-select <?php echo str_replace(" ", "-", $partnerstate) ?>" name="city[]">
                                                        <option value="">Select</option>
                                                        <?php
                                                        $sqlcity11 = "select * from city_state where state = '$partnerstate'";
                                                        $resultcity11 = mysqli_query($con, $sqlcity11);
                                                        while ($rowcity11 = mysqli_fetch_assoc($resultcity11)) {
                                                        ?>
                                                            <option value="<?php echo $rowcity11['city']; ?>"><?php echo $rowcity11['city']; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <span class="material-symbols-outlined icon">location_on</span>
                                                </span>
                                                <p class="text-danger errorstatement" id="<?php echo str_replace(" ", "-", $partnerstate) . 'error' ?>" style="display:none">Please Select City</p>
                                            </div>
                                        <?php
                                        }
                                        ?>

                                        <button type="button" id="groomlocationbtn" class="btn btn-primary">Continue</button>
                                        <div style="font-size:14px; color:#555; margin-top:10px; text-align: center;">
                                            Your Information & Pictures will be
                                            <span style="color:#28a745; font-weight:600;">100% Safe</span><br>
                                            Privacy controls are available in Settings
                                        </div>
                                    </div>
                                </div>

                                <div id="groomlocation" style="display:none">
                                    <div>
                                        <i class="fa fa-arrow-left text-left leftarrow" id="groomlocationback"></i>
                                        <a href="sign-up.php"><i class="fa fa-close text-right closecross"></i></a>
                                    </div>
                                    <div>
                                        <div class="form-tit mt-5 row">
                                            <div class="col-md-12 mb-3">
                                                <div class="formnum active">1</div>
                                                <div class="formnum active">2</div>
                                                <div class="formnum active">3</div>
                                                <div class="formnum active">4</div>
                                                <div class="formnum active">5</div>
                                                <div class="formnum active">6</div>
                                                <div class="formnum">7</div>
                                                <div class="formnum">8</div>
                                            </div>
                                            <div class="col-md-12">
                                                <h4>We are almost done...</h4>
                                                <div id="groom" style="display:none">
                                                    <h1>Groom Location</h1>
                                                </div>
                                                <div id="bride" style="display:none">
                                                    <h1>Bride Location</h1>
                                                </div>
                                                <!--<p class="mb-0">Fields marked as '<span class="text-danger">*</span>' mandatory fields</p>-->
                                            </div>
                                        </div>
                                        <div class="form-login">
                                            <div class="form-group">
                                                <label class="lb">Country</label>
                                                <span class="iconbox">
                                                    <select class="form-select chosen-select" name="groomcountry" id="groomcountry">
                                                        <option value="">Select</option>
                                                        <?php
                                                        $sqlcountry = "select * from countries";
                                                        $resultcountry = mysqli_query($con, $sqlcountry);
                                                        while ($rowcountry = mysqli_fetch_assoc($resultcountry)) {
                                                        ?>
                                                            <option value="<?php echo $rowcountry['country']; ?>"><?php echo $rowcountry['country']; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <span class="material-symbols-outlined icon">globe</span>
                                                </span>
                                                <p class="text-danger errorstatement" id="groomcountryerror" style="display:none">Please Select Country</p>
                                            </div>
                                            <div class="form-group">
                                                <label class="lb">State</label>
                                                <span class="iconbox">
                                                    <select class="form-select chosen-select" name="groomstate" id="groomstate">
                                                        <option value="">Select</option>
                                                        <?php
                                                        $sqlstate = "select distinct(state) from city_state";
                                                        $resultstate = mysqli_query($con, $sqlstate);
                                                        while ($rowstate = mysqli_fetch_assoc($resultstate)) {
                                                        ?>
                                                            <option value="<?php echo str_replace(" ", "-", $rowstate['state']); ?>"><?php echo $rowstate['state']; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <span class="material-symbols-outlined icon">map</span>
                                                </span>
                                                <p class="text-danger errorstatement" id="groomstateerror" style="display:none">Please Select State</p>
                                            </div>

                                            <div class="form-group" id="emptygroomcity">
                                                <label class="lb">City</label>
                                                <span class="iconbox">
                                                    <select class="form-select chosen-select">
                                                        <option value="">Select</option>
                                                    </select>
                                                    <span class="material-symbols-outlined icon">location_on</span>
                                                </span>
                                            </div>
                                            <?php
                                            $sqlstate1 = "select distinct(state) from city_state";
                                            $resultstate1 = mysqli_query($con, $sqlstate1);
                                            while ($rowstate1 = mysqli_fetch_assoc($resultstate1)) {
                                                $state = $rowstate1['state'];
                                            ?>
                                                <div class="form-group signupgroomcity" id="<?php echo str_replace(" ", "-", $state) ?>" style="display:none">
                                                    <label class="lb">City</label>
                                                    <span class="iconbox">
                                                        <select class="form-select chosen-select gc" id="<?php echo "gc_" . str_replace(" ", "-", $state) ?>" name="groomcity[]">
                                                            <option value="">Select</option>
                                                            <?php
                                                            $sqlcity = "select * from city_state where state = '$state'";
                                                            $resultcity = mysqli_query($con, $sqlcity);
                                                            while ($rowcity = mysqli_fetch_assoc($resultcity)) {
                                                            ?>
                                                                <option value="<?php echo $rowcity['city']; ?>"><?php echo $rowcity['city']; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                        <span class="material-symbols-outlined icon">location_on</span>
                                                    </span>
                                                    <p class="text-danger errorstatement" id="<?php echo str_replace(" ", "-", $state) . 'error' ?>" style="display:none">Please Select City</p>
                                                </div>
                                            <?php
                                            }
                                            ?>

                                            <button type="button" id="aboutmebtn" class="btn btn-primary">Continue</button>
                                            <div style="font-size:14px; color:#555; margin-top:10px; text-align: center;">
                                                Your Information & Pictures will be
                                                <span style="color:#28a745; font-weight:600;">100% Safe</span><br>
                                                Privacy controls are available in Settings
                                            </div>
                                            <!--<button type="submit" id="createaccount" class="btn btn-primary">Create Profile</button>-->
                                        </div>
                                    </div>
                                </div>

                                <div id="aboutme" style="display:none">
                                    <div>
                                        <i class="fa fa-arrow-left text-left leftarrow" id="aboutmeback"></i>
                                        <a href="sign-up.php"><i class="fa fa-close text-right closecross"></i></a>
                                    </div>
                                    <div>
                                        <div class="form-tit mt-5 row">
                                            <div class="col-md-12 mb-3">
                                                <div class="formnum active">1</div>
                                                <div class="formnum active">2</div>
                                                <div class="formnum active">3</div>
                                                <div class="formnum  active">4</div>
                                                <div class="formnum active">5</div>
                                                <div class="formnum active">6</div>
                                                <div class="formnum active">7</div>
                                                <div class="formnum ">8</div>
                                            </div>
                                            <div class="col-md-12">
                                                <h4>We are almost done...</h4>
                                                <div id="groom1" style="display:none">
                                                    <h1>About Groom</h1>
                                                </div>
                                                <div id="bride1" style="display:none">
                                                    <h1>About Bride</h1>
                                                </div>
                                                <!--<p class="mb-0">Fields marked as '<span class="text-danger">*</span>' mandatory fields</p>-->
                                            </div>
                                        </div>
                                        <div class="form-login">
                                            <div class="form-group">
                                                <label class="lb">About Me</label>
                                                <span class="iconbox">
                                                    <textarea type="text" class="form-control leftspace" placeholder="Enter Details" id="aboutmecontent" name="aboutme"></textarea>
                                                    <span class="material-symbols-outlined icon">edit_note</span>
                                                </span>
                                                <div class="form-group form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" id="autofill" value="Auto Generated">Auto Generated Text
                                                    </label>
                                                </div>
                                                <div id="autotext" class=" text-justify" style="display:none"><span class="personname">[User Name]</span>, <span id="personage">[Age]</span> years old and <span id="personheight">[Height]</span>, is based in <span id="personcity">[City]</span>, <span id="personstate">[State]</span> and follows the <span id="personreligion">[Religion]</span> faith, belonging to the <span id="personcaste">[Caste]</span> community. <span class="personintial">[He/She as per Male/Female]</span> leads a lifestyle of <span id="personeating">[Eating Habits], [Drinking Habits], and [Smoking Habits]</span>, with his horoscope indicating <span id="personmaglik">[Dosham Status]</span>. <span class="personintial">[He/She as per Male/Female]</span> holds a qualification of <span id="personeducation">[Highest Education]</span> and works with <span id="personworking">[Working With]</span> as a <span class="personprofession">[Designation]</span> with an impressive annual income of <span id="personincome">[Annual Income]</span>. He comes from a <span id="personfamilystatus">[Family Status]</span> and <span id="personfamilytype">[Family Type]</span> family. His father, <span id="personfather">[Father Name]</span>, is a <span id="personfatherocc">[Father's occupation]</span>, and his mother, <span id="personmother">[Mother Name]</span>, is a <span id="personmotherocc">[Mother Occupation]</span>. <span class="personname">[User Name]</span>s family values love, respect, and tradition. <span class="personname">[User Name]</span> is a perfect blend of ambition and grounded values. <span class="personintial">[He/She as per Male/Female]</span> is now ready to embark on a new chapter of life with a loving and supportive partner, making him an ideal match for a meaningful and fulfilling relationship.
                                                    <p class="text-danger errorstatement" id="aboutmeerror" style="display:none"></p>
                                                </div>

                                                <button type="button" id="profilepicbtn" class="btn btn-primary">Continue</button>
                                                <div style="font-size:14px; color:#555; margin-top:10px; text-align: center;">
                                                    Your Information & Pictures will be
                                                    <span style="color:#28a745; font-weight:600;">100% Safe</span><br>
                                                    Privacy controls are available in Settings
                                                </div>
                                                <!--<button type="submit" id="createaccount" class="btn btn-primary">Create Profile</button>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="profilepic" style="display:none">
                                    <div>
                                        <i class="fa fa-arrow-left text-left leftarrow" id="profilepicback"></i>
                                        <a href="sign-up.php"><i class="fa fa-close text-right closecross"></i></a>
                                    </div>
                                    <div>
                                        <div class="form-tit mt-5 row">
                                            <div class="col-md-12 mb-3">
                                                <div class="formnum active">1</div>
                                                <div class="formnum active">2</div>
                                                <div class="formnum active">3</div>
                                                <div class="formnum  active">4</div>
                                                <div class="formnum active">5</div>
                                                <div class="formnum active">6</div>
                                                <div class="formnum active">7</div>
                                                <div class="formnum active">8</div>
                                            </div>
                                            <div class="col-md-12">
                                                <h4>One Last Thing!</h4>
                                                <h1>Profile Picture</h1>
                                                <!--<p class="mb-0">Fields marked as '<span class="text-danger">*</span>' mandatory fields</p>-->
                                            </div>
                                        </div>
                                        <div class="form-login">
                                            <div class="form-group">
                                                <label class="lb">Picture</label>
                                                <!-- <span class="iconbox">
                                                        <input type="file" class="form-control lh" id="profileimage" name="profilepic" accept="image/png, image/jpg, image/jpeg">
                                                    </span> -->
                                        <label class="iconbox upload-box">
    <input type="file"
           id="profileimage"
           name="profilepic"
           accept="image/png, image/jpg, image/jpeg"
           onchange="previewImage(this)">

    <div class="upload-content" id="uploadContent">
        <i class="fa fa-image"></i>
        <p>Upload</p>
    </div>

    <img id="previewImg" class="preview-img" />

    <span class="upload-plus">+</span>
</label>
<style type="text/css" media="all">
  .upload-box {
    position: relative;
    display: block;
    width: 100%;
    max-width: 320px;
    height: 220px;
    border: 2px dashed #d1d5db;
    border-radius: 14px;
    background: #fff;
    cursor: pointer;
    transition: all 0.3s ease;
    /*overflow: hidden;*/
}

/* Hide real input */
.upload-box input[type="file"] {
    display: none;
}

/* Upload content */
.upload-content {
    position: absolute;
    inset: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: #b45309;
}

.upload-content i {
    font-size: 42px;
    margin-bottom: 8px;
    color: #9ca3af;
}

.upload-content p {
    font-size: 15px;
    font-weight: 600;
    margin: 0;
}

/* Preview Image */
.preview-img {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: none;
}

/* Plus icon */
.upload-plus {
    position: absolute;
    bottom: -12px;
    right: -12px;
    width: 38px;
    height: 38px;
    background: #e91e63;
    color: #fff;
    border-radius: 50%;
    font-size: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 6px 14px rgba(0,0,0,0.2);
    z-index: 3000000;
    overflow: visible;
}

/* Hover */
.upload-box:hover {
    border-color: #e91e63;
    background: #fff7fb;
}

</style>


                                                <p class=""><span class="text-danger">Supports:</span> Upload a clear photo of yourself.<br>
                                                    No others, edits, or inappropriate images.<br>
                                                    No personal details in the image.<br>
                                                    PNG/JPG/JPEG only, max 5MB.<br>
                                                </p>
                                                <p class="text-danger errorstatement" id="profileimageerror" style="display:none">Please Select Profile Picture</p>
                                            </div>


                                            <button type="submit" id="createaccount" class="btn btn-primary">Create Profile</button>
                                            <div style="font-size:14px; color:#555; margin-top:10px; text-align: CENTER;">
                                                Your Information & Pictures will be
                                                <span style="color:#28a745; font-weight:600;">100% Safe</span><br>
                                                Privacy controls are available in Settings
                                            </div>
                                        </div>
                                    </div>
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
<div id="agePopup" class="popup-overlay" style="display:none;">
    <div class="popup-content">
        <div class="popup-icon">
            <i class="fa fa-exclamation-circle"></i>
        </div>
        <h3 class="popup-title">Age Eligibility</h3>
        <p id="popupMessage" class="popup-text"></p>
        <button type="button" class="btn-popup-close" onclick="closeAgePopup()">OK, Got it</button>
    </div>
</div>

  <style>
    /* Popup Overlay */
.popup-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6); /* Dimmed background */
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(3px); /* Blur effect */
}

/* Popup Box */
.popup-content {
    background: #fff;
    width: 90%;
    max-width: 400px;
    padding: 30px;
    border-radius: 15px;
    text-align: center;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    position: relative;
    border-top: 5px solid maroon; /* Theme Match */
    animation: fadeInScale 0.3s ease-in-out;
}

/* Icon */
.popup-icon i {
    font-size: 50px;
    color: maroon;
    margin-bottom: 15px;
}

/* Title */
.popup-title {
    font-size: 22px;
    font-weight: 700;
    color: #333;
    margin-bottom: 10px;
}

/* Message Text */
.popup-text {
    font-size: 16px;
    color: #555;
    margin-bottom: 25px;
    line-height: 1.5;
}

/* Close Button */
.btn-popup-close {
    background: maroon;
    color: #fff;
    border: none;
    padding: 10px 30px;
    font-size: 16px;
    font-weight: 600;
    border-radius: 50px;
    cursor: pointer;
    transition: background 0.3s;
    outline: none;
}

.btn-popup-close:hover {
    background: #e91e63; /* Pink hover effect */
}

/* Animation */
@keyframes fadeInScale {
    from { opacity: 0; transform: scale(0.9); }
    to { opacity: 1; transform: scale(1); }
}
  </style>

<!-- END -->

<?php
include 'footer.php';
?>

<script>
    $(document).ready(function() {
        $('#phone').keyup(function() {
            $("#phoneerror").hide();
            $("#duplicatephone").hide();
            $('#phone').css("border", "");
        });
        $('#email').keyup(function() {
            $("#emailerror").hide();
            $("#duplicateemail").hide();
            $('#email').css("border", "");
        });
        $('#pwd').keyup(function() {
            $("#passworderror").hide();
            $('#pwd').css("border", "");
        });
    });
</script>
<script>
    $(document).ready(function() {
        //setup before functions
        var typingTimer1; //timer identifier
        var doneTypingInterval1 = 1000; //time in ms (5 seconds)

        //on keyup, start the countdown
        $('#phone').keyup(function() {
            clearTimeout(typingTimer1);
            if ($('#phone').val()) {
                typingTimer1 = setTimeout(doneTyping1, doneTypingInterval1);
            }
        });

        //user is "finished typing," do something
        function doneTyping1() {
            //do something
            var phone1 = $('#phone').val();

            $.ajax({
                type: "POST",
                url: "aj-duplicatephone.php",
                data: {
                    phone: phone1
                }
            }).done(function(data) {
                $("#duplicatephone").html(data);
            });
        }

        //on keyup, start the countdown
        $('#email').keyup(function() {
            clearTimeout(typingTimer1);
            if ($('#email').val()) {
                typingTimer2 = setTimeout(doneTyping2, doneTypingInterval1);
            }
        });

        //user is "finished typing," do something
        function doneTyping2() {
            //do something
            var email1 = $('#email').val();

            $.ajax({
                type: "POST",
                url: "aj-duplicateemail.php",
                data: {
                    email: email1
                }
            }).done(function(data) {
                $("#duplicateemail").html(data);
            });
        }
    });
</script>


<script>
    $('#openid').click(function() {
        $('#openid').hide();
        $('#closeeye').show();
        $('#pwd').attr('type', 'text');
    });

    $('#closeeye').click(function() {
        $('#closeeye').hide();
        $('#openid').show();
        $('#pwd').attr('type', 'password');
    });

    $('#mobileverifybtn').click(function() {
        // Existing variables
        var phonecheck = $('#phonecheck').val(); // Make sure ye hidden field aapke form me ho
        var emailcheck = $('#emailcheck').val(); // Make sure ye hidden field aapke form me ho
        var phone = $('#phone').val();
        var email = $('#email').val();
        var pwd = $('#pwd').val();

        // NEW: Checkbox ki value check karne ke liye
        var agree = $('#agree').is(":checked");

        var pwdlen1 = $('#pwd').val().length;
        var regex1 = /\d+/g;

        // Phone Validation
        if (phone == '') {
            $('#phoneerror').show();
            $('#phone').css("border", "2px solid red");
        } else {
            $('#phoneerror').hide();
        }

        // Email Validation
        if (email == '') {
            $('#emailerror').show();
            $('#email').css("border", "2px solid red");
        } else {
            $('#emailerror').hide();
        }

        // Password Validation
        if (pwd == '') {
            $('#passworderror').show();
            $('#pwd').css("border", "2px solid red");
        } else {
            $('#passworderror').hide();
        }

        // NEW: T&C Checkbox Validation
        if (!agree) {
            $('#agreeerror').show(); // Agar tick nahi hai to error dikhaye
        } else {
            $('#agreeerror').hide(); // Agar tick hai to error chhupaye
        }

        // Password Logic
        if (pwdlen1 >= '6' && regex1.test(pwd)) {
            $("#pwd").css('border', "2px solid green");
            $("#criterianotmatch").hide();
        } else {
            if (pwdlen1 == '0') {
                $("#criterianotmatch").hide();
            } else {
                $("#charlen").hide();
                $("#charnum").hide();
                $("#criterianotmatch").show();
                $("#pwd").css('border', "2px solid red");
                return false;
            }
        }

        // Final Condition: Ab isme 'agree' variable bhi check hoga
        if (phone != '' && email != '' && pwd != '' && phonecheck == 'checked' && emailcheck == 'checked' && agree == true) {
            $('#registration').hide();
            $('#mobileverify').show();
            $('#basicinfo').hide();
            $('#astrodetails').hide();
            $('#religiousbackground').hide();
            $('#educationcareer').hide();
            $('#familydetails').hide();
            $('#groomlocation').hide();
            $('#aboutme').hide();
            $('#profilepic').hide();

            // $('#otpphone').html($('#phone').val());
            var phone = $('#phone').val();
            // $('#otpphone').text(maskPhone(phone));
            $('#otpphone').text('xxxxxx' + phone.slice(-4));
            //   $('#otpphone').text("xxxxxx" + phone.slice(-4));
            $('#phoneno').val($('#phone').val());

            $.ajax({
                url: "aj-sendotp.php",
                type: "POST",
                data: {
                    phonenum: phone
                }
            }).done(function(data) {
                //$("#city").html(data);
            });
        }
    });


    // $('#mobileverifybtn').click(function() {
    //     var phonecheck = $('#phonecheck').val();
    //     var emailcheck = $('#emailcheck').val();
    //     var phone = $('#phone').val();
    //     var email = $('#email').val();
    //     var pwd = $('#pwd').val();

    //     var pwdlen1 = $('#pwd').val().length;
    //     var regex1 = /\d+/g;

    //     if(phone == '')
    //     {
    //         $('#phoneerror').show();
    //         $('#phone').css("border", "2px solid red");
    //     }
    //     else
    //     {
    //         $('#phoneerror').hide();
    //     }
    //     if(email == '')
    //     {
    //         $('#emailerror').show();
    //         $('#email').css("border", "2px solid red");
    //     }
    //     else
    //     {
    //         $('#emailerror').hide(); 
    //     }
    //     if(pwd == '')
    //     {
    //         $('#passworderror').show();
    //         $('#pwd').css("border", "2px solid red");
    //     }
    //     else
    //     {
    //         $('#passworderror').hide();
    //     }

    //     if(pwdlen1 >= '6' && regex1.test(pwd))
    //     {
    //         $("#pwd").css('border', "2px solid green");
    //         $("#criterianotmatch").hide();
    //     }
    //     else
    //     {
    //         if(pwdlen1 == '0')
    //         {
    //             $("#criterianotmatch").hide();
    //         }
    //         else
    //         {
    //             $("#charlen").hide();
    //             $("#charnum").hide();
    //             $("#criterianotmatch").show();
    //             $("#pwd").css('border', "2px solid red");

    //             return false;
    //         }
    //     }

    //     if(phone != '' && email != '' && pwd != '' && phonecheck == 'checked' && emailcheck == 'checked')
    //     {
    //         $('#registration').hide();
    //         $('#mobileverify').show();
    //         $('#basicinfo').hide();
    //         $('#astrodetails').hide();
    //         $('#religiousbackground').hide();
    //         $('#educationcareer').hide();
    //         $('#familydetails').hide();
    //         $('#groomlocation').hide();
    //         $('#aboutme').hide();
    //         $('#profilepic').hide();

    //         $('#otpphone').html($('#phone').val());
    //         $('#phoneno').val($('#phone').val());

    //         $.ajax({
    //             url: "aj-sendotp.php",
    //             type: "POST",
    //             data: {phonenum : phone}
    //             }).done(function(data){
    //                 //$("#city").html(data);
    //         });
    //     }

    // });

    $('#basicinfobtn').click(function() {
        var otp = $('#otp').val();
        var phoneno = $('#phoneno').val();

        if (otp == '') {
            $('#otperror').show();
        } else {
            $('#otperror').hide();
        }

        if (otp != '') {
            $.ajax({
                url: "aj-verifyotp.php",
                type: "POST",
                data: {
                    phone_num: phoneno,
                    otp_val: otp
                }
            }).done(function(data) {
                $("#otpinvalid").html(data);
            });

        }
    });

    $('#astrodetailsbtn').click(function() {
        var createby = $('#createby').val();
        var fullname = $('#fullname').val();
        var gender = $('#gender').val();
        var marital = $('#marital').val();
        var children = $('#children').val();
        var height = $('#height').val();
        var eating = $('#eating').val();
        var smoking = $('#smoking').val();
        var drinking = $('#drinking').val();

        if (gender == 'Male') {
            $('#groom').show();
            $('#bride').hide();
            $('#groom1').show();
            $('#bride1').hide();
        }
        if (gender == 'Female') {
            $('#groom').hide();
            $('#bride').show();
            $('#groom1').hide();
            $('#bride1').show();
        }

        if (createby == '') {
            $('#profileerror').show();
        } else {
            $('#profileerror').hide();
        }
        if (fullname == '') {
            $('#nameerror').show();
        } else {
            $('#nameerror').hide();
        }
        if (gender == '') {
            $('#gendererror').show();
        } else {
            $('#gendererror').hide();
        }
        if (marital == '') {
            $('#maritalerror').show();
        } else {
            $('#maritalerror').hide();
        }
        if (marital == 'Divorced' || marital == 'Widowed' || marital == 'Awaiting Divorce') {
            if (children == '') {
                $('#childerror').show();
            } else {
                $('#childerror').hide();
            }
        }
        if (height == '') {
            $('#heighterror').show();
        } else {
            $('#heighterror').hide();
        }
        if (eating == '') {
            $('#eatingerror').show();
        } else {
            $('#eatingerror').hide();
        }
        if (smoking == '') {
            $('#smokingerror').show();
        } else {
            $('#smokingerror').hide();
        }
        if (drinking == '') {
            $('#drinkingerror').show();
        } else {
            $('#drinkingerror').hide();
        }

        if (createby != '' && fullname != '' && gender != '' && marital != '' && height != '' && eating != '' && smoking != '' && drinking != '') {
            $('#registration').hide();
            $('#mobileverify').hide();
            $('#basicinfo').hide();
            $('#astrodetails').show();
            $('#religiousbackground').hide();
            $('#educationcareer').hide();
            $('#familydetails').hide();
            $('#groomlocation').hide();
            $('#aboutme').hide();
            $('#profilepic').hide();
        }
    });

    $('#religiousbackgroundbtn').click(function() {
        var dob = $('#dob').val();
        var birthplace = $('#birthplace').val();
        var birthtime = $('#birthtime').val();
        var manglik = $('#manglik').val();

        if (dob == '') {
            $('#doberror').show();
        } else {
            $('#doberror').hide();
        }
        if (birthplace == '') {
            $('#birthplaceerror').show();
        } else {
            $('#birthplaceerror').hide();
        }
        if (birthtime == '') {
            $('#birthtimeerror').show();
        } else {
            $('#birthtimeerror').hide();
        }
        if (manglik == '') {
            $('#manglikerror').show();
        } else {
            $('#manglikerror').hide();
        }

        if (dob != '' && birthplace != '' && birthtime != '' && manglik != '') {
            $('#registration').hide();
            $('#mobileverify').hide();
            $('#basicinfo').hide();
            $('#astrodetails').hide();
            $('#religiousbackground').show();
            $('#educationcareer').hide();
            $('#familydetails').hide();
            $('#groomlocation').hide();
            $('#aboutme').hide();
            $('#profilepic').hide();
        }
    });

    $('#educationcareerbtn').click(function() {

        var religion = $('#religion').val();

        if (religion == '') {
            $('#religionerror').show();
        } else {
            $('#religionerror').hide();
        }

        var caste1 = $("." + religion).val();

        if (caste1 == '') {
            $('#' + religion + "error").show();
        } else {
            $('#' + religion + "error").hide();
        }

        if (religion != '' && caste1 != '') {
            $('#registration').hide();
            $('#mobileverify').hide();
            $('#basicinfo').hide();
            $('#astrodetails').hide();
            $('#religiousbackground').hide();
            $('#educationcareer').show();
            $('#familydetails').hide();
            $('#groomlocation').hide();
            $('#aboutme').hide();
            $('#profilepic').hide();
        }
    });

    $('#familydetailsbtn').click(function() {
        var stream = $('#stream').val();

        if (stream == '') {
            var education11 = $('.education').val();
        } else {
            var education1 = $('.' + stream).val();
        }

        var profession = $('#profession').val();
        var domain = $('#domain').val();

        if (domain == '') {
            var designation11 = $('.designation').val();
        } else {
            var designation1 = $('.' + domain).val();
        }

        var annualincome = $('#annualincome').val();

        if (stream == '') {
            $('#streamerror').show();
        } else {
            $('#streamerror').hide();
        }

        if (education11 == '') {
            $('#educationerror').show();
        } else {
            $('#educationerror').hide();
        }

        if (education1 == '') {
            $('#' + stream + 'error').show();
        } else {
            $('#' + stream + 'error').hide();
        }

        if (profession == '') {
            $('#professionerror').show();
        } else {
            $('#professionerror').hide();
        }
        if (domain == '') {
            $('#domainerror').show();
        } else {
            $('#domainerror').hide();
        }

        if (designation11 == '') {
            $('#designationerror').show();
        } else {
            $('#designationerror').hide();
        }

        if (designation1 == '') {
            $('#' + domain + 'error').show();
        } else {
            $('#' + domain + 'error').hide();
        }

        if (annualincome == '') {
            $('#annualincomeerror').show();
        } else {
            $('#annualincomeerror').hide();
        }
        if (stream != '' && education1 != '' && profession != '' && domain != '' && designation1 != '' && annualincome != '') {
            $('#registration').hide();
            $('#mobileverify').hide();
            $('#basicinfo').hide();
            $('#astrodetails').hide();
            $('#religiousbackground').hide();
            $('#educationcareer').hide();
            $('#familydetails').show();
            $('#groomlocation').hide();
            $('#aboutme').hide();
            $('#profilepic').hide();
        }
    });

    $('#groomlocationbtn').click(function() {
        var familystatus = $('#familystatus').val();
        var familytype = $('#familytype').val();
        var fathername = $('#fathername').val();
        var mothername = $('#mothername').val();
        var fatheroccupation = $('#fatheroccupation').val();
        var motheroccupation = $('#motheroccupation').val();
        var partnerstate = $('#partnerstate').val();

        if (partnerstate == '') {
            var city11 = $('.familycity').val();
        } else {
            var city = $('.' + partnerstate).val();
        }

        var country = $('#country').val();

        if (familystatus == '') {
            $('#familystatuserror').show();
        } else {
            $('#familystatuserror').hide();
        }
        if (familytype == '') {
            $('#familytypeerror').show();
        } else {
            $('#familytypeerror').hide();
        }
        if (fathername == '') {
            $('#fathernameerror').show();
        } else {
            $('#fathernameerror').hide();
        }
        if (mothername == '') {
            $('#mothernameerror').show();
        } else {
            $('#mothernameerror').hide();
        }
        if (fatheroccupation == '') {
            $('#fatheroccupationerror').show();
        } else {
            $('#fatheroccupationerror').hide();
        }
        if (motheroccupation == '') {
            $('#motheroccupationerror').show();
        } else {
            $('#motheroccupationerror').hide();
        }
        if (partnerstate == '') {
            $('#stateerror').show();
        } else {
            $('#stateerror').hide();
        }
        if (city11 == '') {
            $('#cityerror').show();
        } else {
            $('#cityerror').hide();
        }
        if (city == '') {
            $('#' + partnerstate + 'error').show();
        } else {
            $('#' + partnerstate + 'error').hide();
        }
        if (country == '') {
            $('#countryerror').show();
        } else {
            $('#countryerror').hide();
        }
        if (familystatus != '' && familytype != '' && fathername != '' && mothername != '' && fatheroccupation != '' && motheroccupation != '' && partnerstate != '' && city != '' && country != '') {
            $('#registration').hide();
            $('#mobileverify').hide();
            $('#basicinfo').hide();
            $('#astrodetails').hide();
            $('#religiousbackground').hide();
            $('#educationcareer').hide();
            $('#familydetails').hide();
            $('#groomlocation').show();
            $('#aboutme').hide();
            $('#profilepic').hide();
        }
    });

    $('#aboutmebtn').click(function() {
        var groomcountry = $('#groomcountry').val();
        if (groomcountry == '') {
            $('#groomcountryerror').show();
        } else {
            $('#groomcountryerror').hide();
        }

        var groomstate = $('#groomstate').val();
        if (groomstate == '') {
            $('#groomstateerror').show();
        } else {
            $('#groomstateerror').hide();
        }

        var groomcity = $('#gc_' + groomstate).val();
        if (groomcity == '') {
            $('#' + groomstate + 'error').show();
        } else {
            $('#' + groomstate + 'error').hide();
        }

        if (groomstate != '' && groomcity != '' && groomcountry != '') {
            $('#registration').hide();
            $('#mobileverify').hide();
            $('#basicinfo').hide();
            $('#astrodetails').hide();
            $('#religiousbackground').hide();
            $('#educationcareer').hide();
            $('#familydetails').hide();
            $('#groomlocation').hide();
            $('#aboutme').show();
            $('#profilepic').hide();
        }
    });

    $('#profilepicbtn').click(function() {
        var aboutmecontent = $('#aboutmecontent').val();

        if (aboutmecontent == '') {
            $('#aboutmeerror').show();
        } else {
            $('#aboutmeerror').hide();
        }

        if (aboutmecontent != '') {
            $('#registration').hide();
            $('#mobileverify').hide();
            $('#basicinfo').hide();
            $('#astrodetails').hide();
            $('#religiousbackground').hide();
            $('#educationcareer').hide();
            $('#familydetails').hide();
            $('#groomlocation').hide();
            $('#aboutme').hide();
            $('#profilepic').show();
        }
    });

    $('#createaccount').click(function() {
        var profileimage = $('#profileimage').val();

        if (profileimage == '') {
            $('#profileimageerror').show();
        } else {
            $('#profileimageerror').hide();
        }

        if (profileimage != '') {
            $('#registration').hide();
            $('#mobileverify').hide();
            $('#basicinfo').hide();
            $('#astrodetails').hide();
            $('#religiousbackground').hide();
            $('#educationcareer').hide();
            $('#familydetails').hide();
            $('#groomlocation').hide();
            $('#aboutme').hide();
            $('#profilepic').show();
            $(this).parents('form').submit();
        }
    });

    $('#mobileverifyback').click(function() {
        $('#registration').show();
        $('#mobileverify').hide();
        $('#basicinfo').hide();
        $('#astrodetails').hide();
        $('#religiousbackground').hide();
        $('#educationcareer').hide();
        $('#familydetails').hide();
        $('#groomlocation').hide();
        $('#aboutme').hide();
        $('#profilepic').hide();
    });

    $('#basicinfoback').click(function() {
        $('#registration').show();
        $('#mobileverify').hide();
        $('#basicinfo').hide();
        $('#astrodetails').hide();
        $('#religiousbackground').hide();
        $('#educationcareer').hide();
        $('#familydetails').hide();
        $('#groomlocation').hide();
        $('#aboutme').hide();
        $('#profilepic').hide();
    });

    $('#astrodetailsback').click(function() {
        $('#registration').hide();
        $('#mobileverify').hide();
        $('#basicinfo').show();
        $('#astrodetails').hide();
        $('#religiousbackground').hide();
        $('#educationcareer').hide();
        $('#familydetails').hide();
        $('#groomlocation').hide();
        $('#aboutme').hide();
        $('#profilepic').hide();
    });

    $('#religiousbackgroundback').click(function() {
        $('#registration').hide();
        $('#mobileverify').hide();
        $('#basicinfo').hide();
        $('#astrodetails').show();
        $('#religiousbackground').hide();
        $('#educationcareer').hide();
        $('#familydetails').hide();
        $('#groomlocation').hide();
        $('#aboutme').hide();
        $('#profilepic').hide();
    });

    $('#educationcareerback').click(function() {
        $('#registration').hide();
        $('#mobileverify').hide();
        $('#basicinfo').hide();
        $('#astrodetails').hide();
        $('#religiousbackground').show();
        $('#educationcareer').hide();
        $('#familydetails').hide();
        $('#groomlocation').hide();
        $('#aboutme').hide();
        $('#profilepic').hide();
    });

    $('#familydetailsback').click(function() {
        $('#registration').hide();
        $('#mobileverify').hide();
        $('#basicinfo').hide();
        $('#astrodetails').hide();
        $('#religiousbackground').hide();
        $('#educationcareer').show();
        $('#familydetails').hide();
        $('#groomlocation').hide();
        $('#aboutme').hide();
        $('#profilepic').hide();
    });

    $('#groomlocationback').click(function() {
        $('#registration').hide();
        $('#mobileverify').hide();
        $('#basicinfo').hide();
        $('#astrodetails').hide();
        $('#religiousbackground').hide();
        $('#educationcareer').hide();
        $('#familydetails').show();
        $('#groomlocation').hide();
        $('#aboutme').hide();
        $('#profilepic').hide();
    });

    $('#aboutmeback').click(function() {
        $('#registration').hide();
        $('#mobileverify').hide();
        $('#basicinfo').hide();
        $('#astrodetails').hide();
        $('#religiousbackground').hide();
        $('#educationcareer').hide();
        $('#familydetails').hide();
        $('#groomlocation').show();
        $('#aboutme').hide();
        $('#profilepic').hide();
    });

    $('#profilepicback').click(function() {
        $('#registration').hide();
        $('#mobileverify').hide();
        $('#basicinfo').hide();
        $('#astrodetails').hide();
        $('#religiousbackground').hide();
        $('#educationcareer').hide();
        $('#familydetails').hide();
        $('#groomlocation').hide();
        $('#aboutme').show();
        $('#profilepic').hide();
    });
</script>

<script>
    $(document).ready(function() {
        $('#pwd').keyup(function() {

            $("#charlen").show();
            $("#charnum").show();
            $("#criterianotmatch").hide();

            var pwdstr = $('#pwd').val();
            var pwdlen = $('#pwd').val().length;
            var regex = /\d+/g;

            if (pwdstr == '') {
                $("#passaccept").hide();
                $("#charlen").hide();
                $("#charnum").hide();
            }

            if (pwdlen >= '6') {
                $('#charlen').css("color", "green");
                $("#charlenexclamation").hide();
                $("#charlencheck").show();

                if (regex.test(pwdstr)) {
                    $("#passaccept").show();
                    $("#charlen").hide();
                    $("#charnum").hide();
                } else {
                    $("#passaccept").hide();
                    $("#charlen").show();
                    $("#charnum").show();
                }
            } else {
                $('#charlen').css("color", "");
                $("#charlenexclamation").show();
                $("#charlencheck").hide();
            }

            if (regex.test(pwdstr)) {
                $('#charnum').css("color", "green");
                $("#charnumexclamation").hide();
                $("#charnumcheck").show();

                if (pwdlen >= '6') {
                    $("#passaccept").show();
                    $("#charlen").hide();
                    $("#charnum").hide();
                } else {
                    $("#passaccept").hide();
                    $("#charlen").show();
                    $("#charnum").show();
                }
            } else {
                $('#charnum').css("color", "");
                $("#charnumexclamation").show();
                $("#charnumcheck").hide();
            }

        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#otp').keyup(function() {
            $('#otperror').hide();
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#fullname').keyup(function() {
            $('.personname').text($('#fullname').val());
        });

        // $('#gender').change(function() {
        //     var gender = $('#gender').val();

        //     if(gender == 'Male')
        //     {
        //         $('.personintial').text('He');
        //         $('.personintial1').text('His');
        //     }

        //     if(gender == 'Female')
        //     {
        //         $('.personintial').text('She');
        //         $('.personintial1').text('Her');
        //     }
        // });
        $('.gender-btn').click(function() {
            // 1. Visual: Handle Button Active State
            $('.gender-btn').removeClass('active'); // Remove active from all
            $(this).addClass('active'); // Add active to clicked button

            // 2. Data: Get value (Male/Female) and put it in hidden input
            var genderVal = $(this).data('value');
            $('#gender').val(genderVal);

            // 3. Validation: Hide error message
            $('#gendererror').hide();

            // 4. Logic: Toggle Groom/Bride Views & Text (From your original code)
            if (genderVal == 'Male') {
                $('#groom').show();
                $('#bride').hide();
                $('#groom1').show();
                $('#bride1').hide();

                // Update Auto-text pronouns
                $('.personintial').text('He');
                $('.personintial1').text('His');
            } else if (genderVal == 'Female') {
                $('#groom').hide();
                $('#bride').show();
                $('#groom1').hide();
                $('#bride1').show();

                // Update Auto-text pronouns
                $('.personintial').text('She');
                $('.personintial1').text('Her');
            }
        });

        $('#marital').change(function() {
            $('#personmarital').text($('#marital').val());
        });

        $('#height').change(function() {
            $('#personheight').text($('#height').val());
        });

        $('#eating').change(function() {
            $('#personeating').text($('#eating').val());
        });

      $('#manglik').change(function() {
    $('#personmaglik').text($('#manglik').val());
});


        $(".signupstream-s").change(function() {
            var stream = $("#stream").val();
            var he = $("." + stream).val();
            $("#personeducation").text(he);
        });

        // $('#dob').change(function() {
        //     var getgender = $('#gender').val();
        //     var dob = $('#dob').val();
        //     const dobspilt = dob.split("-");
        //     var birthyear = dobspilt[0]
        //     var currentyear = <?php echo date('Y'); ?>;
        //     var age = currentyear - birthyear;
        //     $('#personage').text(age);

        //     if (getgender == 'Male' && age < '21') {
        //         $('#religiousbackgroundbtn').hide();
        //         $('#ageerror').show();
        //         $('#ageerror').text("The age of boy is less then 21 years, you can not create the account");
        //     }
        //     if (getgender == 'Male' && age >= '21') {
        //         $('#religiousbackgroundbtn').show();
        //         $('#ageerror').hide();
        //     }

        //     if (getgender == 'Female' && age < '18') {
        //         $('#religiousbackgroundbtn').hide();
        //         $('#ageerror').show();
        //         $('#ageerror').text("The age of girl is less then 18 years, you can not create the account");
        //     }
        //     if (getgender == 'Female' && age >= '18') {
        //         $('#religiousbackgroundbtn').show();
        //         $('#ageerror').hide();
        //     }
        // });

       
       $('#dob').change(function() {
        var getgender = $('#gender').val();
        var dob = $('#dob').val();
        
        // Ensure Gender is selected first
        if(getgender === "") {
             alert("Please select Gender first.");
             $('#dob').val(""); // Reset date
             return;
        }

        if (dob) {
            const dobspilt = dob.split("-");
            var birthyear = dobspilt[0];
            var currentyear = new Date().getFullYear(); // Dynamic current year
            var age = currentyear - birthyear;
            
            // Precise Age Calculation (Checking month/day)
            var birthDate = new Date(dob);
            var today = new Date();
            var m = today.getMonth() - birthDate.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }

            $('#personage').text(age);

            // Logic for Male (Age < 21)
            if (getgender == 'Male') {
                if (age < 21) {
                    $('#religiousbackgroundbtn').hide(); // Hide Continue Button
                    $('#popupMessage').text("As per legal guidelines, the groom must be at least 21 years old to create an account.");
                    $('#agePopup').fadeIn(); // Show Popup
                    $('#dob').val(""); // Clear invalid date
                } else {
                    $('#religiousbackgroundbtn').show(); // Show Continue Button
                }
            }

            // Logic for Female (Age < 18)
            if (getgender == 'Female') {
                if (age < 18) {
                    $('#religiousbackgroundbtn').hide(); // Hide Continue Button
                    $('#popupMessage').text("As per legal guidelines, the bride must be at least 18 years old to create an account.");
                    $('#agePopup').fadeIn(); // Show Popup
                    $('#dob').val(""); // Clear invalid date
                } else {
                    $('#religiousbackgroundbtn').show(); // Show Continue Button
                }
            }
        }
    });
       
       
        $('#religion').change(function() {
            $('#personreligion').text($('#religion').val());
        });

        $('.yourcaste').change(function() {
            var religion = $('#religion').val();
            $('#personcaste').text($('.' + religion).val());
        });

        $('#profession').change(function() {
            $('#personworking').text($('#profession').val());
        });

        $('#domain').change(function() {
            $('.personprofession').text($('#domain').val());
        });

        $('#annualincome').change(function() {
            $('#personincome').text($('#annualincome').val());
        });

        $('#familytype').change(function() {
            $('#personfamilytype').text($('#familytype').val());
        });

        $('#familystatus').change(function() {
            $('#personfamilystatus').text($('#familystatus').val());
        });

        $('#fathername').keyup(function() {
            $('#personfather').text($('#fathername').val());
        });

        $('#fatheroccupation').keyup(function() {
            $('#personfatherocc').text($('#fatheroccupation').val());
        });

        $('#mothername').keyup(function() {
            $('#personmother').text($('#mothername').val());
        });

        $('#motheroccupation').keyup(function() {
            $('#personmotherocc').text($('#motheroccupation').val());
        });

        $('#country').change(function() {
            $('#personlocation').text($('#country').val());
        });

        $('#groomcountry').change(function() {
            $('#personcountry').text($('#groomcountry').val());
        });

        $('#groomstate').change(function() {
            $('#personstate').text($('#groomstate').val());
        });

        $('.gc').change(function() {
            var groomstate = $('#groomstate').val();
            $('#personcity').text($('#gc_' + groomstate).val());
        });

    });
    function closeAgePopup() {
    $('#agePopup').fadeOut();
}
</script>

<script>
    $(document).ready(function() {
        $('#createby').change(function() {
            $('#profileerror').hide();
        });

        $('#fullname').keyup(function() {
            $('#nameerror').hide();
        });

        $('#gender').change(function() {
            $('#gendererror').hide();
        });

        $('#marital').change(function() {
            $('#maritalerror').hide();
        });

        $('#height').change(function() {
            $('#heighterror').hide();
        });

        $('#eating').change(function() {
            $('#eatingerror').hide();
        });

        $('#smoking').change(function() {
            $('#smokingerror').hide();
        });

        $('#drinking').change(function() {
            $('#drinkingerror').hide();
        });

        $('#dob').change(function() {
            $('#doberror').hide();
        });

        $('#birthplace').keyup(function() {
            $('#birthplaceerror').hide();
        });

        $('#birthtime').change(function() {
            $('#birthtimeerror').hide();
        });

        $('#manglik').change(function() {
            $('#manglikerror').hide();
        });

        $('#religion').change(function() {
            $('#religionerror').hide();
        });

        $('#caste1').change(function() {
            $('#casteerror').hide();
        });

        $('#stream').change(function() {
            $('#streamerror').hide();
        });

        $('#education1').change(function() {
            $('#educationerror').hide();
        });

        $('#profession').change(function() {
            $('#professionerror').hide();
        });

        $('#domain').change(function() {
            $('#domainerror').hide();
        });

        $('#designation').change(function() {
            $('#designationerror').hide();
        });

        $('#annualincome').change(function() {
            $('#annualincomeerror').hide();
        });

        $('#familytype').change(function() {
            $('#familytypeerror').hide();
        });

        $('#familystatus').change(function() {
            $('#familystatuserror').hide();
        });

        $('#fathername').keyup(function() {
            $('#fathernameerror').hide();
        });

        $('#mothername').keyup(function() {
            $('#mothernameerror').hide();
        });

        $('#fatheroccupation').keyup(function() {
            $('#fatheroccupationerror').hide();
        });

        $('#motheroccupation').keyup(function() {
            $('#motheroccupationerror').hide();
        });

        $('#country').change(function() {
            $('#countryerror').hide();
        });

        $('#partnerstate').change(function() {
            $('#stateerror').hide();
        });

        $('#city').change(function() {
            $('#cityerror').hide();
        });

        $('#groomcountry').change(function() {
            $('#groomcountryerror').hide();
        });

        $('#groomstate').change(function() {
            $('#groomstateerror').hide();
        });

        $('#groomstate').change(function() {
            $('#groomstateerror').hide();
        });

        $('#city').change(function() {
            $('#groomcityerror').hide();
        });

        $('#autofill').click(function() {

            if ($('#autofill').is(":checked")) {
                var aboutmecontent1 = $('#aboutmecontent').val();

                if (aboutmecontent1 != '') {
                    $("#aboutmecontent").val('');
                    $("#aboutmecontent").val($('#autotext').text());
                } else {
                    $("#aboutmecontent").val($('#autotext').text());
                }
            } else {
                $("#aboutmecontent").val('');
            }
        });

    });
</script>
<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            document.getElementById('previewImg').src = e.target.result;
            document.getElementById('previewImg').style.display = 'block';
            document.getElementById('uploadContent').style.display = 'none';
        };

        reader.readAsDataURL(input.files[0]);
    }
}
</script>
   <script>
                                    let countdown = 40;
                                    let timer = null;

                                    document.getElementById('resendOtp').addEventListener('click', function() {

                                        // Hide resend text
                                        document.getElementById('resendWrapper').style.display = 'none';

                                        // Show timer
                                        document.getElementById('resendTimer').style.display = 'block';
                                        document.getElementById('timerCount').innerText = countdown;

                                        // 🔥 RESEND OTP AJAX
                                        let phone = document.getElementById('phoneno').value;

                                        $.ajax({
                                            url: "aj-sendotp.php",
                                            type: "POST",
                                            data: {
                                                phonenum: phone
                                            },
                                            success: function() {
                                                console.log("OTP resent successfully");
                                            }
                                        });

                                        // Start countdown
                                        timer = setInterval(function() {
                                            countdown--;
                                            document.getElementById('timerCount').innerText = countdown;

                                            if (countdown <= 0) {
                                                clearInterval(timer);
                                                countdown = 40;

                                                document.getElementById('resendTimer').style.display = 'none';
                                                document.getElementById('resendWrapper').style.display = 'block';
                                            }
                                        }, 1000);
                                    });
                                </script>