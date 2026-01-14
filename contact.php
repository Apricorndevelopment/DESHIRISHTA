<?php
include 'header.php';
?>
<!-- BANNER -->
 <style>
    /* Placeholder color black – Support form */
.form-login input::placeholder,
.form-login textarea::placeholder {
    color: #000 !important;
    opacity: 1; /* Firefox fix */
}

/* Edge / IE support */
.form-login :-ms-input-placeholder {
    color: #000 !important;
}

.form-login ::-ms-input-placeholder {
    color: #000 !important;
}

 </style>
<style>
    input::placeholder {
        color: #000;
        opacity: 1;
    }

    .form-login .form-control {
        border: none;
        border-radius: 0;
        
        /* NOTE: Maine yahan se '!important' hata diya hai taaki click karne par color change ho sake */
        border-bottom: 2px solid maroon; 
        
        outline: none;
        box-shadow: none;
        transition: border-bottom-color 0.3s; /* Smooth color change ke liye */
    }

    /* Jab user click karega (Focus State) tab Grey color hoga */
    .form-login .form-control:focus {
        border-bottom-color: #000000 !important; /* Grey Color */
        box-shadow: none;
    }
</style>
<section>
    <div class="str">
        <div class="ban-inn ab-ban pg-cont">
            <div class="container">
                <div class="row">
                    <div class="hom-ban">
                        <div class="ban-tit">
                            <span>We are here to assist you.</span>
                            <h1>Our Support</h1>
                            <p>Most Trusted and premium Matrimony & Matchmaking Service in the World.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END -->

<!-- START -->
<section>
    <div class="ab-sec2 pg-cont">
        <div class="container">
            <div class="row">
                <ul>
                    <li>
                        <div class="we-cont">
                            <img src="images/icon/buildings.png" alt="">
                            <h4>Our office</h4>
                            <p class="mb-2"> +91-8377053041</p>
                            <p class="mb-2"> support@desi-rishta.com </p>
                            <p class="mb-2"> New Delhi, India</p>
                        </div>
                    </li>
                    <li>
                        <div class="we-cont">
                            <img src="images/icon/help-desk.png" alt="">
                            <h4>Customer Relations</h4>
                            <p>Your inquiries are invaluable to us.</p>
                            <?php
                            if ($userid == '') {
                            ?>
                                <a href="#support" class="cta-rou-line">Enquire Now</a>
                            <?php
                            } else {
                            ?>
                                <a href="#support" class="cta-rou-line">Send Request Now</a>
                            <?php
                            }
                            ?>
                        </div>
                    </li>
                    <li>
                        <div class="we-cont">
                            <img src="images/icon/telephone.png" alt="">
                            <h4>WhatsApp Support</h4>
                            <p>Welcome to our WhatsApp support Mon – Sat (9AM – 6PM)</p>
                            <a href="https://wa.me/918377053041?text=Hi There,
I have some queries toask.
Thanks!
" target="_blank" class="cta-rou-line">Chat Now</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- END -->

<!-- REGISTER -->
<section>
    <div class="login pg-cont" id="support">
        <?php
        if ($userid == '') {
        ?>
            <div class="container">
                <div class="row">

                    <div class="inn">
                        <div class="lhs">
                            <div class="tit">
                                <h2>Now <b>Contact to us</b> Easy and fast.</h2>
                            </div>
                            <div class="im">
                                <img src="images/login-couple.png" alt="">
                            </div>
                            <div class="log-bg">&nbsp;</div>
                        </div>
                        <div class="rhs">
                            <div>
                                <div class="form-tit">
                                    <h4>Let's talk</h4>
                                    <h1>Send your enquiry now </h1>
                                </div>
                                <div class="form-login">
                                    <form class="cform fvali" method="post" action="insert-contact.php">
                                        <!-- <?php
                                                if ($_GET['success'] == 'yes') {
                                                ?>
                                            <p class="text-success text-center" id="invalidpop">Your message was sent successfully</p>
                                            <?php
                                                }
                                            ?> -->
                                        <?php if (isset($_GET['success']) && $_GET['success'] == 'yes') { ?>
                                            <script>
                                                setTimeout(() => {
                                                    showSuccessModal();
                                                }, 300);
                                            </script>
                                        <?php } ?>

                                        <div class="form-group">
                                            <label class="lb">Name</label>
                                            <span class="iconbox">
                                                <input type="text" id="name" class="form-control leftspace" placeholder="Enter Full Name" name="name" required>
                                                <span class="material-symbols-outlined icon">account_circle</span>
                                            </span>
                                            <p class="text-danger errorstatement" id="nameerror" style="display:none">Please Enter Name</p>
                                        </div>
                                        <div class="form-group">
                                            <label class="lb">Email ID</label>
                                            <span class="iconbox">
                                                <input type="email" class="form-control leftspace" id="email" placeholder="Enter Email ID" name="email" required>
                                                <span class="material-symbols-outlined icon">mail</span>
                                            </span>
                                            <p class="text-danger errorstatement" id="emailerror" style="display:none">Please Enter Email ID</p>
                                        </div>
                                        <div class="form-group">
                                            <label class="lb">Phone No.</label>
                                            <span class="iconbox">
                                                <input type="text" class="form-control leftspace" id="phone" placeholder="Enter Phone No." name="phone" required>
                                                <span class="material-symbols-outlined icon">call</span>
                                            </span>
                                            <p class="text-danger errorstatement" id="phoneerror" style="display:none">Please Enter Phone No.</p>
                                        </div>
                                         <div class="form-group">
                                        <label for="category">Select Issue Category <span class="text-danger">*</span></label>
                                        <select class="form-control" id="category" name="category" required>
                                            <option value="" disabled selected>--- Select ---</option>
                                            <option value="General Query">General Query</option>
                                            <option value="Technical Issue">Technical Issue</option>
                                            <option value="Billing/Payment">Billing/Payment</option>
                                            <option value="Profile Update">Profile Update</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                        <div class="form-group">
                                            <label class="lb">Message</label>
                                            <span class="iconbox">
                                                <textarea name="message" class="form-control leftspace" id="message" placeholder="Enter Message" required></textarea>
                                                <span class="material-symbols-outlined icon">edit_note</span>
                                            </span>
                                            <p class="text-danger errorstatement" id="messerror" style="display:none">Please Enter Message</p>
                                        </div>
                                        <!-- <div class="terms-container">
                                            <input type="checkbox" id="terms" name="terms" checked>

                                            <p>
                                                By creating an account, I agree to the
                                                <a href="terms.php">T&C</a> and
                                                <a href="privacy.php">Privacy Policy</a>
                                            </p>
                                        </div> -->
                                        <button type="submit" id="enquirybtn" class="btn btn-primary">Send Message</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div id="successModal" class="modal">
                    <div class="modal-content">
                        <img src="images/thank-you-free-png.webp" alt="Congrats" style="height:200px;margin-bottom:12px;">
                    <H2> Thank you for contacting us! </H2>
<p>We’ve received your message successfully.<br> Our support team will review your query and get back to you shortly.<br> You will be notified via Email or WhatsApp once we respond to your message.</p>
                        <button onclick="closeModal()" class="modal-btn">I Understands</button>
                    </div>
                </div>

            </div>
        <?php
        } else {
        ?>
            <div class="container">
                <div class="row">

                    <div class="inn">
                        <div class="lhs">
                            <div class="tit">
                                <h2>Now <b>Contact to us</b> Easy and fast.</h2>
                            </div>
                            <div class="im">
                                <img src="images/login-couple.png" alt="">
                            </div>
                            <div class="log-bg">&nbsp;</div>
                        </div>
                        <div class="rhs">
                            <div>
                                <div class="form-tit">
                                    <h4>Let's talk</h4>
                                    <h1>Send your message now </h1>
                                </div>
                                <div class="form-login">
                                    <form class="cform fvali" method="post" action="insert-submitrequest.php">
                                        <?php
                                        if ($_GET['success'] == 'yes') {
                                        ?>
                                            <p class="text-success text-center" id="invalidpop">Your message was sent successfully.</p>
                                        <?php
                                        }
                                        ?>
                                        <div class="form-group">
                                            <label class="lb">Name</label>
                                            <span class="iconbox">
                                                <input type="text" id="name" class="form-control leftspace" placeholder="Enter Full Name" value="<?php echo $_COOKIE['dr_name']; ?>" name="name" required readonly>
                                                <span class="material-symbols-outlined icon">account_circle</span>
                                            </span>
                                        </div>
                                        <div class="form-group">
                                            <label class="lb">Email ID</label>
                                            <span class="iconbox">
                                                <input type="email" class="form-control leftspace" id="email" placeholder="Enter Email ID" value="<?php echo $_COOKIE['dr_email']; ?>" name="email" required readonly>
                                                <span class="material-symbols-outlined icon">mail</span>
                                            </span>
                                        </div>
                                        <div class="form-group">
                                            <label class="lb">Phone No.</label>
                                            <span class="iconbox">
                                                <input type="text" class="form-control leftspace" id="phone" placeholder="Enter Phone No." value="<?php echo $_COOKIE['dr_phone']; ?>" name="phone" required readonly>
                                                <span class="material-symbols-outlined icon">call</span>
                                            </span>
                                        </div>


                                        <div class="form-group">
                                        <label for="category">Select Issue Category <span class="text-danger">*</span></label>
                                        <select class="form-control" id="category" name="category" required>
                                            <option value="" disabled selected>--- Select ---</option>
                                            <option value="General Query">General Query</option>
                                            <option value="Technical Issue">Technical Issue</option>
                                            <option value="Billing/Payment">Billing/Payment</option>
                                            <option value="Profile Update">Profile Update</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                   <div class="form-group">
                                            <label class="lb">Message</label>
                                            <span class="iconbox">
                                                <textarea name="message" class="form-control leftspace" id="message" placeholder="Enter Message" required></textarea>
                                                <span class="material-symbols-outlined icon">edit_note</span>
                                            </span>
                                            <p class="text-danger errorstatement" id="messerror" style="display:none">Please Enter Messagess</p>
                                        </div>

                                        <button type="submit" id="enquirybtn" class="btn btn-primary">Send Message</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        <?php
        }
        ?>
    </div>
</section>
<!-- END -->

<?php
include 'footer.php';
?>

<script>
    $(document).ready(function() {
        $("#enquirybtn").click(function(e) { // 'e' yahaan zaroori hai
            var name = $("#name").val();
            var email = $("#email").val();
            var phone = $("#phone").val();
            var message = $("#message").val();
            var isValid = true; // Form valid hai ya nahi, iska flag

            if (name == '') {
                $("#nameerror").show();
                // BADLAAV YAHAN: Sirf border-bottom-color badlein
                $("#name").css("border-bottom-color", "red");
                isValid = false;
            } else {
                $("#nameerror").hide();
            }

            if (email == '') {
                $("#emailerror").show();
                // BADLAAV YAHAN
                $("#email").css("border-bottom-color", "red");
                isValid = false;
            } else {
                $("#emailerror").hide();
            }

            if (phone == '') {
                $("#phoneerror").show();
                // BADLAAV YAHAN
                $("#phone").css("border-bottom-color", "red");
                isValid = false;
            } else {
                $("#phoneerror").hide();
            }

            if (message == '') {
                $("#messerror").show();
                // BADLAAV YAHAN
                $("#message").css("border-bottom-color", "red");
                isValid = false;
            } else {
                $("#messerror").hide();
            }

            if (isValid == false) {
                e.preventDefault(); // Form ko submit hone se rokein
                return false;
            }
            // Agar sab aacha hai, toh form submit ho jaayega
        });

        // Keyup events (Jab user type karega)
        $("#name").keyup(function() {
            $("#nameerror").hide();
            // BADLAAV YAHAN: Border color ko normal karein
            $("#name").css("border-bottom-color", "#626466");
        });
        $("#email").keyup(function() {
            $("#emailerror").hide();
            // BADLAAV YAHAN
            $("#email").css("border-bottom-color", "#626466");
        });
        $("#phone").keyup(function() {
            $("#phoneerror").hide();
            // BADLAAV YAHAN
            $("#phone").css("border-bottom-color", "#626466");
        });
        $("#message").keyup(function() {
            $("#messerror").hide();
            // BADLAAV YAHAN
            $("#message").css("border-bottom-color", "#626466");
        });

    });
</script>
<style>
    .modal {
        display: none;
        /* display: none; show the modal */
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.4);
    }

  

    .modal-content {
        background: #fff;
        padding: 32px 24px;
        margin: 120px auto;
        border-radius: 12px;
        max-width: 410px;
        text-align: center;
        box-shadow: 0 4px 24px rgba(0, 0, 0, 0.18);
    }

    .modal-content h2 {
        color: #553d2b;
        font-size: 1.5rem;
        margin: 12px 0 16px 0;
    }

    .modal-content p {
        color: #454545;
        font-size: 1rem;
        margin-bottom: 22px;
        line-height: 1.5;
    }

    .modal-btn {
        background: #232c3d;
        color: #fff;
        padding: 10px 32px;
        border: none;
        border-radius: 6px;
        font-size: 1.1rem;
        cursor: pointer;
    }

    .modal-btn:hover {
        background: #284664;
    }
</style>
<!-- <script>
$(document).ready(function(){
  $("#enquirybtn").click(function(){
    var name = $("#name").val();
    var email = $("#email").val();
    var phone = $("#phone").val();
    var message = $("#message").val();
    
    if(name == '')
    {
        $("#nameerror").show();
        $("#name").css("border", "2px solid red");
    }
    else
    {
        $("#nameerror").hide();
    }
    
    if(email == '')
    {
        $("#emailerror").show();
        $("#email").css("border", "2px solid red");
    }
    else
    {
        $("#emailerror").hide();
    }
    
    if(phone == '')
    {
        $("#phoneerror").show();
        $("#phone").css("border", "2px solid red");
    }
    else
    {
        $("#phoneerror").hide();
    }
    
    if(message == '')
    {
        $("#messerror").show();
        $("#message").css("border", "2px solid red");
    }
    else
    {
        $("#messerror").hide();
    }
    
    
  });
  
  $("#name").keyup(function(){
    $("#nameerror").hide();
    $("#name").css("border", "2px solid #626466");
  });
  $("#email").keyup(function(){
    $("#emailerror").hide();
    $("#email").css("border", "2px solid #626466");
  });
  $("#phone").keyup(function(){
    $("#phoneerror").hide();
    $("#phone").css("border", "2px solid #626466");
  });
  $("#message").keyup(function(){
    $("#messerror").hide();
    $("#message").css("border", "2px solid #626466");
  });
  
  if(name == '' || email == '' || phone == '' || message == '')
  {
      return false;
  }
  else
  {
      return true;
  }
});
</script> -->

<script>
    function showSuccessModal() {
        document.getElementById('successModal').style.display = 'block';
    }
</script>
<script> function closeModal() { document.getElementById('successModal').style.display = 'none'; } </script>

<style>
    input::placeholder {
    color: #000;
    opacity: 1;
}

    .form-login .form-control {
        border: none;
        /* Saare default borders hata dein */
        border-radius: 0;
            border-bottom: 3px solid maroon !important;
        /* Corners ko flat rakhein */
        border-bottom: 2px solid maroon;
        /* Sirf bottom border rakhein */
        outline: none;
        /* Click karne par aane waali outline hata dein */
        box-shadow: none;
        /* Default shadow hata dein */
    }

    /* Optional: Jab user type kar raha ho tab border ka color badalna */
    .form-login .form-control:focus {
        border-bottom-color: maroon;
        /* Aap yahaan apna primary color daal sakte hain */
        box-shadow: none;
    }
</style>
<style>
    .terms-container {
        display: flex;
        /* Checkbox aur text ko ek line mein laata hai */
        align-items: center;
        /* Unhein vertically center karta hai */
        font-family: Arial, sans-serif;
        font-size: 16px;
        /* Font size aap adjust kar sakte hain */
    }

    /* Checkbox ko blue karne ke liye */
    .terms-container input[type="checkbox"] {
        width: 18px;
        height: 18px;
        accent-color: #0d6efd;
        /* Yeh modern browsers mein checkbox ka color badalta hai */
    }

    .terms-container p {
        margin-left: 8px;
        /* Checkbox aur text ke beech thodi space */
        margin-bottom: 0;
        /* Default <p> margin hatane ke liye */
    }

    /* Links ko red aur bold karne ke liye */
    .terms-container a {
        color: #E60023;
        /* Aapka red color */
        font-weight: bold;
        text-decoration: none;
        /* Underline hatane ke liye */
    }

    .terms-container a:hover {
        text-decoration: underline;
        /* Hover par underline dikhana acha rehta hai */
    }
</style>