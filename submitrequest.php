<?php
include 'header.php';

$userid = $_COOKIE['dr_userid'];

if($userid == '')
{
    echo "<script>window.location.href='login.php';</script>";
    exit();
}
?>
    <section>
        <div class="str">
            <div class="ban-inn ab-ban pg-cont">
                <div class="container">
                    <div class="row">
                        <div class="hom-ban">
                            <div class="ban-tit">
                                <span>We are here to assist you.</span>
                                <h1>Submit A Request</h1>
                                <p>Most Trusted and premium Matrimony & Matchmaking Service in the World.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
                                <p>Your messages are invaluable to us</p>
                                <a href="#support" class="cta-rou-line">Send Request Now</a>
                            </div>
                        </li>
                        <li>
                            <div class="we-cont">
                                <img src="images/icon/telephone.png" alt="">
                                <h4>WhatsApp Support</h4>
                                <p>Welcome to our WhatsApp support</p>
                                <a href="https://wa.me/918377053041?text=Hello i am having some queries" target="_blank" class="cta-rou-line">Chat Now</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="login pg-cont" id="support">
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
                                        
                                        <?php if(isset($_GET['success']) && $_GET['success'] == 'yes') { ?>
                                            <script>
                                                document.addEventListener("DOMContentLoaded", function() {
                                                    document.getElementById('successModal').style.display = 'block';
                                                });
                                            </script>
                                        <?php } ?>

                                        <div class="form-group">
                                            <label class="lb">Name</label>
                                            <span class="iconbox">
                                                <input type="text" id="name" class="form-control leftspace" placeholder="Enter Full Name" value="<?php echo htmlspecialchars($_COOKIE['dr_name']); ?>" name="name" required readonly>
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
                                            <label class="lb">Select Issue Category <span class="text-danger">*</span></label>
                                            <select class="form-control" id="category" name="category" required>
                                                <option value="" disabled selected>--- Select ---</option>
                                                <option value="General Query">General Query</option>
                                                <option value="Technical Issue">Technical Issue</option>
                                                <option value="Billing/Payment">Billing/Payment</option>
                                                <option value="Profile Update">Profile Update</option>
                                                <option value="Other">Other</option>
                                            </select>
                                            <p class="text-danger errorstatement" id="categoryerror" style="display:none">Please Select Issue Category</p>
                                        </div>
                                        <div class="form-group">
                                            <label class="lb">Message</label>
                                            <span class="iconbox">
                                                <textarea name="message" class="form-control leftspace" id="message" placeholder="Enter Message" required></textarea>
                                                <span class="material-symbols-outlined icon">edit_note</span>
                                            </span>
                                            <p class="text-danger errorstatement" id="messerror" style="display:none">Please Enter Message</p>
                                        </div>
                                        <button type="submit" id="enquirybtn" class="btn btn-primary">Send Enquiry</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    
    <div id="successModal" class="modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeModal()">&times;</span>
            <div class="modal-body-content">
                <img src="images/gif/sent.gif" alt="Success" class="modal-gif">
                <h2>Message Sent!</h2>
                <p>Your request has been submitted successfully. We will get back to you shortly.</p>
                <button onclick="closeModal()" class="btn btn-primary">OK</button>
            </div>
        </div>
    </div>

    <style>
        /* Modal Styles */
        .modal {
            display: none; 
            position: fixed; 
            z-index: 9999; 
            left: 0; 
            top: 0; 
            width: 100%; 
            height: 100%; 
            background-color: rgba(0,0,0,0.6); 
            backdrop-filter: blur(5px);
        }
        .modal-content {
            background-color: #fff;
            margin: 10% auto; 
            padding: 30px; 
            border-radius: 12px;
            width: 90%; 
            max-width: 400px;
            text-align: center;
            position: relative;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            animation: fadeIn 0.4s ease-in-out;
        }
        .close-modal {
            position: absolute;
            top: 10px;
            right: 15px;
            color: #aaa;
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
        }
        .close-modal:hover { color: #000; }
        .modal-gif {
            width: 120px;
            margin-bottom: 20px;
        }
        .modal-content h2 {
            color: #2c3e50;
            margin-bottom: 10px;
            font-size: 24px;
        }
        .modal-content p {
            color: #7f8c8d;
            font-size: 16px;
            margin-bottom: 25px;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Select Box Styling match */
      select.form-control {
    border: none;
    border-bottom: 3px solid maroon;
    border-radius: 1;
    outline: none;
    box-shadow: none;
    height: 45px;
}
    </style>

<?php
include 'footer.php';
?>

<script>
function closeModal() {
    document.getElementById('successModal').style.display = 'none';
    // Remove query param to prevent showing again on reload
    const url = new URL(window.location.href);
    url.searchParams.delete('success');
    window.history.replaceState(null, null, url);
}

$(document).ready(function(){
  $("#enquirybtn").click(function(e){
    var message = $("#message").val();
    var category = $("#category").val();
    var isValid = true;

    // Validate Category
    if(category == null || category == "")
    {
        $("#categoryerror").show();
        $("#category").css("border-bottom", "2px solid red");
        isValid = false;
    }
    else
    {
        $("#categoryerror").hide();
        $("#category").css("border-bottom", "2px solid maroon");
    }

    // Validate Message
    if(message == '')
    {
        $("#messerror").show();
        $("#message").css("border", "2px solid red");
        isValid = false;
    }
    else
    {
        $("#messerror").hide();
        $("#message").css("border", ""); // Reset to default
    }

    if(!isValid) {
        e.preventDefault(); // Stop form submission
        return false;
    }
  });
  
  // Reset errors on user interaction
  $("#category").change(function(){
    $("#categoryerror").hide();
    $(this).css("border-bottom", "2px solid maroon");
  });

  $("#message").keyup(function(){
    $("#messerror").hide();
    $(this).css("border", "");
  });
});
</script>