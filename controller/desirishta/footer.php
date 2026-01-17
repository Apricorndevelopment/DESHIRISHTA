    <!-- FOOTER -->
     <div id="webPushPopup" style="display:none; position: fixed; bottom: 20px; right: 20px; width: 320px; background: #fff; border-left: 5px solid #E91E63; box-shadow: 0 5px 20px rgba(0,0,0,0.2); border-radius: 8px; padding: 20px; z-index: 99999; animation: slideIn 0.5s ease-out;">
    <div style="display:flex; justify-content:space-between; align-items:start;">
        <h5 id="wp-title" style="margin:0; font-size:16px; font-weight:700; color:#333;">Notification</h5>
        <span onclick="closeWebPush()" style="cursor:pointer; color:#888; font-size:20px;">&times;</span>
    </div>
    <p id="wp-msg" style="margin: 10px 0; font-size:14px; color:#555; line-height: 1.4;"></p>
    <a id="wp-link" href="#" style="display:inline-block; background:#E91E63; color:#fff; padding:8px 15px; text-decoration:none; font-size:12px; border-radius:4px;">Check Now</a>
</div>

<style>
@keyframes slideIn {
    from { transform: translateX(100%); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}
</style>

<script>
// --- WEB PUSH LOGIC ---
document.addEventListener("DOMContentLoaded", function() {
    // Page load hone ke 2 second baad check karein
    setTimeout(checkWebPush, 2000);
});

function checkWebPush() {
    fetch('aj-check-notify.php')
    .then(response => response.json())
    .then(data => {
        if(data.status === 'found') {
            
            // Check karein ki user ne ye wala notification already close kiya hai kya
            let seenId = localStorage.getItem('seen_push_id');
            
            if(seenId != data.id) {
                // Show Popup
                document.getElementById('wp-title').innerText = data.title;
                document.getElementById('wp-msg').innerText = data.msg;
                
                let linkBtn = document.getElementById('wp-link');
                if(data.link && data.link != '') {
                    linkBtn.href = data.link;
                    linkBtn.style.display = 'inline-block';
                } else {
                    linkBtn.style.display = 'none';
                }

                // Store current ID in element to use in close function
                document.getElementById('webPushPopup').setAttribute('data-id', data.id);
                document.getElementById('webPushPopup').style.display = 'block';
                
                // Sound play (Optional)
                // let audio = new Audio('images/notification.mp3');
                // audio.play().catch(e => console.log('Audio blocked'));
            }
        }
    });
}

function closeWebPush() {
    let popup = document.getElementById('webPushPopup');
    let currentId = popup.getAttribute('data-id');
    
    // LocalStorage mein save kar lo ki ye ID dekh liya hai
    localStorage.setItem('seen_push_id', currentId);
    
    popup.style.display = 'none';
}
</script>
    <section class="wed-hom-footer">
        <div class="container">
            <div class="row wed-foot-link wed-foot-link-1">
                <div class="col-md-4">
                    <h4>Get In Touch</h4>
                    <p>Location: New Delhi, India</p>
                    <p>Phone: <a href="tel:+918377053041">+91-8377053041</a></p>
                    <p>Email: <a href="mailto:support@desi-rishta.com">support@desi-rishta.com.</a></p>
                </div>
                <div class="col-md-4">
                    <h4>HELP &amp; SUPPORT</h4>
                    <?php
                    if($useractive == '0')
                    {
                    ?>
                    <ul>
                        <li><a href="contact.php">Contact us</a>
                        </li>
                        <li><a href="contact.php?#support">Business Enquiries</a>
                        </li>
                        <li><a href="https://wa.me/918377053041?text=Hello i am having some queries" target="_blank">Chat Support</a>
                        </li>
                        <li><a href="faq.php">FAQ's</a>
                        </li>
                           <li><a href="faqterms.php">Terms and Conditions </a>
                        </li>
                         <li><a href="faqprivacy.php">Privacy policy</a>
                        </li>
                         <li><a href="faqcookies.php"> Cookies policy </a>
                        </li>
                        <li><a href="faqgravience.php">Grievances</a>
                        </li>
                    </ul>
                    <?php
                    }
                    else
                    {
                    ?>
                    <ul>
                  <li><a href="contact.php">Contact us</a>
                        </li>
                        <li><a href="contact.php?#support">Business Enquiries</a>
                        </li>
                        <li><a href="https://wa.me/918377053041?text=Hello i am having some queries" target="_blank">Chat Support</a>
                        </li>
                        <li><a href="faq.php">FAQ's</a>
                        </li>
                           <li><a href="faqterms.php">Terms and Conditions </a>
                        </li>
                         <li><a href="faqprivacy.php">Privacy policy</a>
                        </li>
                         <li><a href="faqcookies.php"> Cookies policy </a>
                        </li>
                        <li><a href="faqgravience.php">Grievances</a>
                        </li>
                     
                       
                    </ul>
                    <?php
                    }
                    ?>
                </div>
                <div class="col-md-4 fot-soc">
                    <h4>SOCIAL MEDIA</h4>
                    <ul>
                    <!-- I added 'data-platform' to each <a> to help the API find them -->
                    <!-- 'onerror' is added just for this preview so you see icons instead of broken images -->
                    <li>
                        <a href="#!" data-platform="facebook">
                            <img src="images/social/facebook.jpeg" alt="FB" loading="lazy" onerror="this.src='https://placehold.co/40x40/3b5998/white?text=f'">
                        </a>
                    </li>
                    <li>
                        <a href="#!" data-platform="instagram">
                            <img src="images/social/instagram.png" alt="IG" loading="lazy" onerror="this.src='https://placehold.co/40x40/E1306C/white?text=Ig'">
                        </a>
                    </li>
                    <li>
                        <a href="#!" data-platform="linkedin">
                            <img src="images/social/linkedin.jpeg" alt="IN" loading="lazy" onerror="this.src='https://placehold.co/40x40/0077b5/white?text=In'">
                        </a>
                    </li>
                    <li>
                        <a href="#!" data-platform="twitter">
                            <img src="images/social/twitter.jpeg" alt="TW" loading="lazy" onerror="this.src='https://placehold.co/40x40/1DA1F2/white?text=Tw'">
                        </a>
                    </li>
                    <li>
                        <a href="#!" data-platform="youtube">
                            <img src="images/social/youtube.jpeg" alt="YT" loading="lazy" onerror="this.src='https://placehold.co/40x40/FF0000/white?text=Yt'">
                        </a>
                    </li>
                </ul>
                </div>
            </div>
            <div class="row foot-count">
                <!--<p>Desi Rishta - Trusted by over thousands of Boys & Girls for successfull marriage.</p>-->
                <p>Desi Rishta is a dedicated matrimonial platform for serious marriage seekers only and is not a dating website. 
All profiles must reflect sincere marriage intentions.
</p>
                <?php
                // if($_COOKIE['dr_userid'] == '')

if($useractive == '0') 

                {
                ?>
                <p><a href="sign-up.php" class="btn btn-primary btn-sm">Join us today !</a></p>
                <?php
                }
                ?>
            </div>
        </div>
    </section>
    <!-- END -->

    <!-- COPYRIGHTS -->
    <section>
        <div class="cr">
            <div class="container">
                <div class="row">
                    <p class="pb-0">Copyright © <span><?php echo date('Y'); ?></span> <a href="#!" target="_blank">Desi-Rishta.com</a> All
                        rights reserved.</p>
                    <p class="pt-0">Crafted with
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart text-danger"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" style="color:rgb(200, 4, 108);"></path></svg> By Apricorn Solution Sonipat, India</p>
                </div>
            </div>
        </div>
    </section>
    <!-- END -->

    <!-- link copy-->
    <div class="container copybox" style="display:none">
        <div class="alert alert-success">
            <strong>Copied!</strong> link has been copied.
        </div>
    </div>
    <!-- link copy-->
    
    
    <!-- INTEREST POPUP -->
    <div class="modal fade plncanl-pop" id="plancancel">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title seninter-tit">Plan cancellation</h4>
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body seninter chosenini">
                    <div class="row">
                        <div class="col-md-6 lhs-poli">
                            <h5>Cancellation policy</h5>
                            <ul>
                                <li>Your refund amount calculated day basis</li>
                                <li>As per your plan, your perday cost:10$</li>
                                <li>After 3 months only you can able to join</li>
                                <li>Fair ipsum dummy content ipsum jenuane ai</li>
                                <li>Rairt ipsum dummy content ipsum jenuane ai</li>
                            </ul>
                        </div>
                        <div class="col-md-6 rhs-form">
                            <div class="form-login">
                                <form>
                                    <div class="form-group">
                                        <label class="lb">Reason for the cancellation: *</label>
                                        <select class="chosen-select">
                                            <option value="">I joint my pare</option>
                                            <option value="">Profile match not good</option>
                                            <option value="">Support not good</option>
                                            <option value="">My reason not in the list</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="lb">Message: *</label>
                                        <textarea placeholder="Enter your message" class="form-control" id="" cols="20" rows="5"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-bordered table-responsive">
                                <thead>
                                    <tr>
                                      <th>Plan type</th>
                                      <th>Duration</th>
                                      <th>Cost paid</th>
                                      <th>Perday cost</th>
                                      <th>Plan active days</th>
                                      <th>Remaining days</th>
                                      <th>Cancellation charges</th>
                                      <th>Cost saved</th>
                                    </tr>
                                  </thead>
                                <tbody>
                                  <tr>
                                    <td>Platinum</td>
                                    <td>365 days(12 months)</td>
                                    <td>$1000</td>
                                    <td>$2.73</td>
                                    <td>190 days</td>
                                    <td>175 days</td>
                                    <td>$100</td>
                                    <td>$377.75</td>
                                  </tr>
                                </tbody>
                              </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- END INTEREST POPUP -->
    
     <!-- CHAT CONVERSATION BOX START -->
    <div class="chatbox">
        <span class="comm-msg-pop-clo"><i class="fa fa-times" aria-hidden="true"></i></span>

        <div class="inn">
            <form name="new_chat_form" method="post">
                <div class="s1">
                    <img src="images/user/2.jpg" class="intephoto2" alt="">
                    <h4><b class="intename2">Julia</b>,</h4>
                    <span class="avlsta avilyes">Available online</span>
                </div>
                <div class="s2 chat-box-messages">
                    <span class="chat-wel">Start a new chat!!! now</span>
                    <div class="chat-con">
                        <div class="chat-lhs">Hi</div>
                        <div class="chat-rhs">Hi</div>
                    </div>
                    <!--<span>Start A New Chat!!! Now</span>-->
                </div>
                <div class="s3">
                    <input type="text" name="chat_message" placeholder="Type a message here.." required="">
                    <button id="chat_send1" name="chat_send" type="submit">Send <i class="fa fa-paper-plane-o"
                            aria-hidden="true"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- END -->
    
    
    <!-- Optional JavaScript -->
    
    
    
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/select-opt.js"></script>
    <script src="js/slick.js"></script>
    <script src="js/Chart.js"></script>
    <script src="js/gallery.js"></script>
    <script src="js/custom.js"></script> 
     <script>
        // --- 1. MOCK API DATA ---
        // Simulates the response from your backend
        const mockApiData = {
            success: true,
            socials: {
                facebook: 'https://www.facebook.com/YourPage',
                instagram: 'https://www.instagram.com/YourPage',
                linkedin: 'https://www.linkedin.com/company/YourPage',
                twitter: 'https://twitter.com/YourPage',
                youtube: 'https://www.youtube.com/c/YourPage'
            }
        };

        // --- 2. FUNCTION TO ATTACH LINKS ---
        function attachSocialLinks() {
            const statusMsg = document.getElementById('status-msg');
            
            // Select all links inside your specific structure
            const links = document.querySelectorAll('.fot-soc ul li a');

            links.forEach(link => {
                // Get the platform name from the attribute we added
                const platform = link.getAttribute('data-platform');
                
                // If we have a URL for this platform in the API data...
                if (platform && mockApiData.socials[platform]) {
                    link.href = mockApiData.socials[platform];
                    link.target = "_blank"; // Open in new tab
                    link.rel = "noopener noreferrer"; // Security best practice
                    
                    console.log(`Updated ${platform} to ${mockApiData.socials[platform]}`);
                }
            });

            // Update status text
            if(statusMsg) {
                statusMsg.innerText = "API Connected. Links Updated.";
                statusMsg.style.color = "#28a745"; // Bootstrap success green
            }
        }

        // Simulate network request delay (1 second)
        setTimeout(() => {
            attachSocialLinks();
        }, 1000);

    </script>
    <script>
         //COMMON SLIDER
    $('.slider').slick({
        infinite: true,
        slidesToShow: 5,
        arrows: false,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        dots: false,
        responsive: [{
            breakpoint: 992,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
                centerMode: false
            }
        }]
    });
    
    $('.slider11').slick({
        infinite: true,
        slidesToShow: 3,
        arrows: false,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        dots: false,
        vertical: true,
        responsive: [{
            breakpoint: 992,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                centerMode: false
            }
        }]

    });
    
    $('.slider12').slick({
        infinite: true,
        slidesToShow: 1,
        arrows: false,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000,
        dots: false,
        responsive: [{
            breakpoint: 992,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                centerMode: false
            }
        }]
    });

    $('.count').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
    }, {
        duration: 4000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
});

// var xValues = "0";
//     var yValues = "50";

//     new Chart("Chart_leads", {
//         type: "line",
//         data: {
//             labels: xValues,
//             datasets: [{
//                 fill: false,
//                 lineTension: 0,
//                 backgroundColor: "#f1bb51",
//                 borderColor: "#fae9c8",
//                 data: yValues
//             }]
//         },
//         options: {
//             responsive: true,
//             legend: {display: false},
//             scales: {
//                 yAxes: [{ticks: {min: 0, max: 100}}]
//             }
//         }
//     });
//     var xValues = "0";
// var yValues = "50";

// --- FIX: Check if Chart Element Exists ---
var chartCanvas = document.getElementById("Chart_leads");

if (chartCanvas) { // Agar chart element mila, tabhi chart banao
    new Chart(chartCanvas, {
        type: "line",
        data: {
            labels: xValues,
            datasets: [{
                fill: false,
                lineTension: 0,
                backgroundColor: "#f1bb51",
                borderColor: "#fae9c8",
                data: yValues
            }]
        },
        options: {
            responsive: true,
            legend: {display: false},
            scales: {
                yAxes: [{ticks: {min: 0, max: 100}}]
            }
        }
    });
}
// ------------------------------------------
    </script>
    
    <script>
    //CHAT WINDOW OPEN
    $(".db-chat-trig").on('click', function () {
        $(".chatbox").addClass("open")
    });
    </script>
    
    <script>
    $(document).ready(function(){
        $('#marital').on('change', function() {
        
        var marital = this.value;
        
        if(marital == 'Divorced')
        {
            $("#children").show();
        }
        else if(marital == 'Widowed')
        {
            $("#children").show();
        }
        else if(marital == 'Awaiting Divorce')
        {
            $("#children").show();
        }
        else
        {
            $("#children").hide();
        }
        });
    });
    </script>
    
    <script>
    $(document).ready(function(){
        $('#familylocation').on('change', function() {
        
        var familylocation = this.value;
        
        if(familylocation == 'Same as my location')
        {
            $(".familystate").hide();
            $("#familystate").prop("required", false);
            $(".familycity").hide();
            $(".familycountry").hide();
            $("#diffcountry").prop("required", false);
            $(".familycities").hide();
        }
        else
        {
            $(".familystate").show();
            $("#familystate").prop("required", true);
            $(".familycity").show();
            $(".familycountry").show();
            $("#diffcountry").prop("required", true);
        }
        });
    });
    </script>
    
    <script>
    $(document).ready(function(){
        $('#stream').on('change', function() {
        
        var stream1 = this.value;
        
        if(stream1 == '')
        {
            $("#emptyeducation").css("display","block"); 
            $(".signupstream").css("display","none");
            $("#"+stream1).css("display","none");
        }
        else
        {
            $("#emptyeducation").css("display","none");
            $(".signupstream").css("display","none");
            $("#"+stream1).css("display","block");
        }
        });
    });
    </script>
    
    <script>
    /*$(document).ready(function(){
        $('#partnerstream').on('change', function() {
        
        var stream11 = this.value;
        
        $.ajax({
            url: "aj-geteducation.php",
            type: "POST",
            data: {stream : stream11}
        }).done(function(data){
                $("#partnereducation").html(data);
            });
        });
    });*/
    </script>
    
    <script>
    $(document).ready(function(){
        $('#domain').on('change', function() {
        
        var domain1 = this.value;
        
        if(domain1 == '')
        {
            $("#emptydesignation").css("display","block");
            $(".signupdomain").css("display","none");
            $("#"+"desig_"+domain1).css("display","none");
        }
        else
        {
            $("#emptydesignation").css("display","none");
            $(".signupdomain").css("display","none");
            $("#"+"desig_"+domain1).css("display","block");
        }
        });
    });
    </script>
    
    <script>
    $(document).ready(function(){
        $('#partnerdomain').on('change', function() {
        
        var domain11 = this.value;
        
        $.ajax({
            url: "aj-getdesignation.php",
            type: "POST",
            data: {domain : domain11}
        }).done(function(data){
                $("#partnerdesignation").html(data);
            });
        });
    });
    </script>
    
    <script>
    $(document).ready(function(){
        $('#state').on('change', function() {
        
        var state1 = this.value;
        
        $.ajax({
            url: "aj-getcity.php",
            type: "POST",
            data: {state : state1}
        }).done(function(data){
                $("#city").html(data);
            });
        });
    });
    </script>
    
    <script>
    $(document).ready(function(){
        $('#partnerstate').on('change', function() {
        
        var state11 = this.value;
        
        if(state11 == '')
        {
            $("#emptypartnercity").css("display","block");
            $(".signuppartnercity").css("display","none");
            $("#"+"pc_"+state11).css("display","none");
        }
        else
        {
            $("#emptypartnercity").css("display","none");
            $(".signuppartnercity").css("display","none");
            $("#"+"pc_"+state11).css("display","block");
        }
            
        });
        
        $('#groomstate').on('change', function() {
        
        var state22 = this.value;
        
        if(state22 == '')
        {
            $("#emptygroomcity").css("display","block");
            $(".signupgroomcity").css("display","none");
            $("#"+state22).css("display","none");
        }
        else
        {
            $("#emptygroomcity").css("display","none");
            $(".signupgroomcity").css("display","none");
            $("#"+state22).css("display","block");
        }
        });
        
        $('#familystate').on('change', function() {
        
        var state33 = this.value;
        
        if(state33 == '')
        {
            $("#emptyfamilycity").css("display","block");
            $(".familycities").css("display","none");
            $("#"+state33).css("display","none");
        }
        else
        {
            $("#emptyfamilycity").css("display","none");
            $(".familycities").css("display","none");
            $("#"+state33).css("display","block");
            $("#gc_"+state33).prop("required",true);
        }
        });
    });
    </script>
    
    <script>
    $(document).ready(function(){
        $('#religion').on('change', function() {
        
        var religion1 = this.value;
        
        if(religion1 == '')
        {
            $("#emptycaste").css("display","block");
            $(".signupcaste").css("display","none");
            $("#"+religion1).css("display","none");
        }
        else
        {
            $("#emptycaste").css("display","none");
            $(".signupcaste").css("display","none");
            $("#"+religion1).css("display","block");
        }
        });
    });
    </script>
    
    <script>
    /*$(document).ready(function(){
        $('#partnerreligion').on('change', function() {
        
        var religion11 = this.value;
        
        $.ajax({
            url: "aj-getcaste.php",
            type: "POST",
            data: {religion : religion11}
        }).done(function(data){
                $("#partnercaste").html(data);
            });
        });
    });*/
    </script>
    
    
    
    <script>
        $(document).ready(function(){
            $('#bridecountry').on('change', function() {
            
            var bridecountry = this.value;
            
            if(bridecountry != 'India')
            {
                $('#bridecitizen').show();
                $('#brideresident').show();
            }
            else
            {
                $('#bridecitizen').hide();
                $('#brideresident').hide();
            }
        });
    });
    </script>
    
    <?php
    if(isset($_GET['tab']) && $_GET['tab'] != '')
    // if($_GET['tab'] != '')
    {
    ?>
    <script>
        $(document).ready(function() {
            $(".profiletabs li a").removeClass("active"); 
            $(".tab-content .tab-pane").removeClass("active");
            $("#<?php echo $_GET['tab']; ?>").addClass("active"); 
            $("#<?php echo $_GET['tab'].'tab'; ?>").addClass("active"); 
            $("#<?php echo $_GET['tab'].'tab'; ?>").addClass("show"); 
            $("#<?php echo $_GET['tab'].'tab'; ?>").removeClass("fade");
        });
    </script>
    <?php
    }
    ?>
    
    <script>
        $(document).ready(function(){
            //setup before functions
            var typingTimer1;                //timer identifier
            var doneTypingInterval1 = 1000;  //time in ms (5 seconds)
            
            //on keyup, start the countdown
            $('#aadharnumber').keyup(function(){
                clearTimeout(typingTimer1);
                if ($('#aadharnumber').val()) {
                    typingTimer1 = setTimeout(doneTyping1, doneTypingInterval1);
                }
            });
            
            //user is "finished typing," do something
            function doneTyping1 () {
                //do something
                var aadharnum = $('#aadharnumber').val();
                
                var aadharnumlen = $('#aadharnumber').val().length;
                
                if(aadharnumlen == '12')
                {
                    $.ajax({
                        type: "POST",
                        url: "api_aadharotp.php",
                        data: { aadharnumber : aadharnum} 
                    }).done(function(data){
                        $("#aadharnumber").addClass('is-valid')
                        $("#aadharotp").html(data);
                    });
                }
                else
                {
                    $("#aadharnumber").addClass('is-invalid')
                }
            }
        });
</script>

<script>
$(document).ready(function(){
  $("#activities").click(function(){
    $("#activitiessubmenu").toggle();
  });
});

$(document).ready(function(){
  $("#profile").click(function(){
    $("#profilesubmenu").toggle();
  });
});
</script>

<script>
$(document).ready(function(){
    <?php
    for($i=1; $i<=50; $i++)
    {
    ?>
  $(".collapse<?php echo $i; ?>").click(function(){
    $("#collapse<?php echo $i; ?>").toggle();
    $(".collapse<?php echo $i; ?>").toggleClass("collapse");
    $(".collapse<?php echo $i; ?>").toggleClass("collapsed");
  });
  <?php
    }
  ?>
});
</script>

<script>
$(document).ready(function(){
  $(".sett-acc-edit-eve").click(function(){
    $(".sett-acc-edit").toggle();
  });
});
</script>


<script>
    $(document).ready(function () {
    $("#passupdate").click(function () {
        var pass = $('#pass').val();
        var cpass = $('#cpass').val();
        
        if (pass === "") 
        {
            $(".pempty").show();
            return false;
        }
        
        if (cpass === "") 
        {
            $(".pempty").hide();
            $(".cpempty").show();
            return false;
        }
        
        if ( parseInt(pass) < parseInt(cpass) ) 
        {
            $(".pempty").hide();
            $(".cpempty").hide();
            $(".notmatch").toggle();
            return false;
        }
        
        if ( parseInt(pass) === parseInt(cpass) )
        {
            $(".pempty").hide();
            $(".cpempty").hide();
            $(".notmatch").hide();
            return true;
        }
    });
});
</script>

<script>
    $(document).ready(function() {
        setTimeout(function() { 
            $("#invalidpop").fadeOut(1500); 
        }, 13000)
    });
</script>

<script>
    $(document).ready(function() {
        setTimeout(function() { 
            $(".copybox").fadeOut(1500); 
        }, 13000)
    });
</script>

<!-- <script>
$(document).ready(function(){
    timeLeft = 60;

    function countdown() {
	    timeLeft--;
	    document.getElementById("seconds").innerHTML = String( timeLeft );
	    if (timeLeft > 0) {
		    setTimeout(countdown, 1000);
	    }
	    else
	    {
	        $('#resendbtn').css('display', 'block');
	        $('#timer').css('display', 'none');
	        $('#pwd').css('border', '2px solid red')
	    }
    };

    setTimeout(countdown, 1000);

});
</script> -->

<script>
$(document).ready(function(){
    // Step 1: Check karein ki 'seconds' element page par hai ya nahi
    var timerDisplay = document.getElementById("seconds");

    if (timerDisplay) { // Agar element mil gaya, tabhi aage badho
        
        var timeLeft = 60;

        function countdown() {
            timeLeft--;
            
            // Safety check inside loop
            if(document.getElementById("seconds")) {
                document.getElementById("seconds").innerHTML = String( timeLeft );
            }

            if (timeLeft > 0) {
                setTimeout(countdown, 1000);
            }
            else {
                $('#resendbtn').css('display', 'block');
                $('#timer').css('display', 'none');
                $('#pwd').css('border', '2px solid red');
            }
        };

        setTimeout(countdown, 1000);
    } 
});
</script>
<script>
    $(document).ready(function () {
        $("#sortby").change(function () {
            var sortby = $('#sortby').val();
            
            currLoc = $(location).attr('href');
            
            var clean_uri = currLoc.substring(0, currLoc.indexOf("?"))
            
            window.location.replace(clean_uri+'?&sort='+sortby);
        });
    });
</script>

<script>
    $(document).ready(function () {
        $("#removeblur").click(function () {
            $("ul").removeClass("coninfo");
            $("div").removeClass("conborder");
            $(".lockscreen").hide();
        });
    });
</script>

<script>
$(document).ready(function () {
   
    $("#banner-search-form").submit(function (event) {
        
        // Saari values check karein
        var lookingFor = $('#looking_for').val();
        var ageFrom = $('#age_from').val();
        var ageTo = $('#age_to').val();
        var religion = $('#religion').val();
        var city = $('#city').val();

        
        if (lookingFor === "" && ageFrom === "" && ageTo === "" && religion === "" && city === "") {
            
          
            event.preventDefault(); 
            
          
            $("#search-alert").show();
        } else {
           
            $("#search-alert").hide();
        }
    });
});
</script>
</body>
</html>
<style>
    @media (min-width: 768px) {
    .col-md-4 {
        flex: 0 0 auto;
        width: 33.333333%;
    }
}
</style>
<script>
const publicVapidKey = "BHfvtXOrMtJBEsTOQyYqEPG-db9j7Ynf-Wq2mxUj8HfXkpJNOBeSmW6xhOfjiyqygUVEZIWml31L3CcFZR--dMg";

if ('serviceWorker' in navigator && 'PushManager' in window) {
    navigator.serviceWorker.register('sw.js')
    .then(reg => {
        Notification.requestPermission().then(permission => {
            if (permission === 'granted') {
                subscribeUser(reg);
            }
        });
    });
}

function subscribeUser(reg) {
    reg.pushManager.subscribe({
        userVisibleOnly: true,
        applicationServerKey: urlBase64ToUint8Array(publicVapidKey)
    }).then(sub => {
        fetch('save-subscription.php', {
            method: 'POST',
            body: JSON.stringify(sub),
            headers: {'Content-Type': 'application/json'}
        });
    });
}

function urlBase64ToUint8Array(base64String) {
    const padding = '='.repeat((4 - base64String.length % 4) % 4);
    const base64 = (base64String + padding)
        .replace(/-/g, '+')
        .replace(/_/g, '/');
    const rawData = window.atob(base64);
    return Uint8Array.from([...rawData].map(c => c.charCodeAt(0)));
}
</script>
