<?php
include 'config.php'; // Ensure DB connection is available

// 1. Get ID from URL
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);
    
    // 2. Fetch Couple Details
    $sql = "SELECT * FROM tbl_recent_couples WHERE id = '$id'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    
    // 3. Fetch Gallery Images (Limit 4)
    $gallery_sql = "SELECT * FROM tbl_couple_gallery WHERE couple_id = '$id' LIMIT 4";
    $gallery_result = mysqli_query($con, $gallery_sql);
} else {
    // Redirect if no ID provided (Optional security)
    echo "<script>alert('No couple selected'); window.location.href='index.php';</script>";
    exit();
}
?>
<!doctype html>
<html lang="en">
<head>
    <title><?php echo isset($row['couple_name']) ? $row['couple_name'] : 'Couple Details'; ?> | Desi Rishta</title>
    <!--== META TAGS ==-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="theme-color" content="#f6af04">
    <meta name="description" content="">
    <meta name="keyword" content="">
    <!--== FAV ICON(BROWSER TAB ICON) ==-->
    <link rel="shortcut icon" href="images/ring.jpeg" type="image/x-icon">
    <!--== CSS FILES ==-->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
      <![endif]-->
      
      <script language=Javascript>
      
      function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
   </script>
   <script>
       function numberMobile(e){
            e.target.value = e.target.value.replace(/[^\d]/g,'');
            return false;
        }
   </script>
   
   
</head>

<body>
    <!-- PRELOADER -->
 <?php 
 include "header.php";
 ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700;900&family=Great+Vibes&family=Lato:wght@300;400&display=swap" rel="stylesheet">
    
    <!-- END MOBILE MENU POPUP -->    <!-- START -->
    <section>
        <div class="wedd pg-wedd-vid m-tp">
            <div class="container">
                <div class="row">
                    <div class="ban-wedd">
                        <style>
                            h1, h2, h3 {
  font-family: 'Cinzel Decorative', serif;
}
                        </style>
                        <!-- DYNAMIC NAME -->
                        <h2><?php echo isset($row['couple_name']) ? $row['couple_name'] : ''; ?></h2>
                        <!-- DYNAMIC LOCATION -->
                        <p><?php echo isset($row['location']) ? $row['location'] : ''; ?></p>
                        
                        <div class="wedd-info">
                            <ul>
                                <!-- DYNAMIC DATE AND TIME -->
                                <li>
                                    <i class="fa fa-calendar-o" aria-hidden="true"></i>
                                    <span>
                                        <?php 
                                        if(isset($row['event_date']) && $row['event_date'] != '0000-00-00') {
                                            echo date('d F Y', strtotime($row['event_date'])); 
                                        } else {
                                            echo "Date: N/A";
                                        }
                                        ?> 
                                        | 
                                        <?php echo isset($row['event_time']) ? $row['event_time'] : ''; ?>
                                    </span>
                                </li>
                                <li><i class="fa fa-map-marker" aria-hidden="true"></i><a href="#!"><?php echo isset($row['location']) ? $row['location'] : 'Location'; ?></a></li>
                            </ul>
                        </div>
                        
                        <!-- DYNAMIC DESCRIPTION INSIDE wedd-vid CLASS -->
                        <div class="wedd-vid" style="display: block; width: 100%; text-align: center;">
                             <!-- Inline styling to make text readable inside the existing container -->
                        <!-- Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<div style="position: relative; max-width: 900px; margin: 0 auto; padding: 45px 40px; background: #ffffffff; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.1); text-align: justify; color:#7e5656; font-family: 'Playfair Display', serif; line-height: 1.8; border: 30px outset #ffc9c9ff;">

    <!-- Opening Quote -->
    <i class="bi bi-quote" style="font-size: 50px; position: absolute; top: -10px; left: 10px; color: #fa2626ff;"></i>

    <?php 
        if(isset($row['description']) && !empty($row['description'])) {
            echo nl2br($row['description']); 
        } else {
            echo "No description available for this couple.";
        }
    ?>

    <!-- Closing Quote -->
    <i class="bi bi-quote" style="font-size: 40px; position: absolute; bottom: -20px; right: 10px; transform: rotate(180deg); color: #f84242ff;"></i>
</div>

                        </div>
                        
                        <div class="wedd-vid-tree">
                            <span class="wedd-vid-tre-1" ></span>
                            <span class="wedd-vid-tre-2"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END -->

    <!-- START -->
    <section>
        <div class="wedd-dat wedd-vid-dat wedd-gall wedd-vid-gall">
            <div class="">
                <div class="gall-inn">
                    <div class="home-tit">
                        <p>collections</p>
                        <h2><span>Photo gallery</span></h2>
                        <span class="leaf1"></span>
                        <span class="tit-ani-"></span>
                    </div>
                    
                    <!-- DYNAMIC GALLERY SECTION -->
                    <div class="container">
                        <div class="row" style="margin-top: 30px;">
                            <?php
                            if(mysqli_num_rows($gallery_result) > 0) {
                                while($gal = mysqli_fetch_assoc($gallery_result)) {
                            ?>
                                <div class="col-md-3 col-sm-6" style="margin-bottom: 20px;">
                                    <div class="gallery-item" style="overflow: hidden; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                                        <img src="images/couples/gallery/<?php echo $gal['image_name']; ?>" alt="Gallery Image" style="width: 100%; height: 250px; object-fit: cover; transition: transform 0.3s;">
                                    </div>
                                </div>
                            <?php 
                                }
                            } else {
                                echo '<div class="col-12 text-center"><p style="color: #fff;">No photos uploaded for this gallery.</p></div>';
                            }
                            ?>
                        </div>
                    </div>
                  
                </div>
            </div>
        </div>
    </section>
    <!-- END -->


    <?php include "footer.php";?>
   
    
    
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

var xValues = "0";
    var yValues = "50";

    new Chart("Chart_leads", {
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
      $(".collapse1").click(function(){
    $("#collapse1").toggle();
    $(".collapse1").toggleClass("collapse");
    $(".collapse1").toggleClass("collapsed");
  });
    $(".collapse2").click(function(){
    $("#collapse2").toggle();
    $(".collapse2").toggleClass("collapse");
    $(".collapse2").toggleClass("collapsed");
  });
    $(".collapse3").click(function(){
    $("#collapse3").toggle();
    $(".collapse3").toggleClass("collapse");
    $(".collapse3").toggleClass("collapsed");
  });
    $(".collapse4").click(function(){
    $("#collapse4").toggle();
    $(".collapse4").toggleClass("collapse");
    $(".collapse4").toggleClass("collapsed");
  });
    $(".collapse5").click(function(){
    $("#collapse5").toggle();
    $(".collapse5").toggleClass("collapse");
    $(".collapse5").toggleClass("collapsed");
  });
    $(".collapse6").click(function(){
    $("#collapse6").toggle();
    $(".collapse6").toggleClass("collapse");
    $(".collapse6").toggleClass("collapsed");
  });
    $(".collapse7").click(function(){
    $("#collapse7").toggle();
    $(".collapse7").toggleClass("collapse");
    $(".collapse7").toggleClass("collapsed");
  });
    $(".collapse8").click(function(){
    $("#collapse8").toggle();
    $(".collapse8").toggleClass("collapse");
    $(".collapse8").toggleClass("collapsed");
  });
    $(".collapse9").click(function(){
    $("#collapse9").toggle();
    $(".collapse9").toggleClass("collapse");
    $(".collapse9").toggleClass("collapsed");
  });
    $(".collapse10").click(function(){
    $("#collapse10").toggle();
    $(".collapse10").toggleClass("collapse");
    $(".collapse10").toggleClass("collapsed");
  });
    $(".collapse11").click(function(){
    $("#collapse11").toggle();
    $(".collapse11").toggleClass("collapse");
    $(".collapse11").toggleClass("collapsed");
  });
    $(".collapse12").click(function(){
    $("#collapse12").toggle();
    $(".collapse12").toggleClass("collapse");
    $(".collapse12").toggleClass("collapsed");
  });
    $(".collapse13").click(function(){
    $("#collapse13").toggle();
    $(".collapse13").toggleClass("collapse");
    $(".collapse13").toggleClass("collapsed");
  });
    $(".collapse14").click(function(){
    $("#collapse14").toggle();
    $(".collapse14").toggleClass("collapse");
    $(".collapse14").toggleClass("collapsed");
  });
    $(".collapse15").click(function(){
    $("#collapse15").toggle();
    $(".collapse15").toggleClass("collapse");
    $(".collapse15").toggleClass("collapsed");
  });
    $(".collapse16").click(function(){
    $("#collapse16").toggle();
    $(".collapse16").toggleClass("collapse");
    $(".collapse16").toggleClass("collapsed");
  });
    $(".collapse17").click(function(){
    $("#collapse17").toggle();
    $(".collapse17").toggleClass("collapse");
    $(".collapse17").toggleClass("collapsed");
  });
    $(".collapse18").click(function(){
    $("#collapse18").toggle();
    $(".collapse18").toggleClass("collapse");
    $(".collapse18").toggleClass("collapsed");
  });
    $(".collapse19").click(function(){
    $("#collapse19").toggle();
    $(".collapse19").toggleClass("collapse");
    $(".collapse19").toggleClass("collapsed");
  });
    $(".collapse20").click(function(){
    $("#collapse20").toggle();
    $(".collapse20").toggleClass("collapse");
    $(".collapse20").toggleClass("collapsed");
  });
    $(".collapse21").click(function(){
    $("#collapse21").toggle();
    $(".collapse21").toggleClass("collapse");
    $(".collapse21").toggleClass("collapsed");
  });
    $(".collapse22").click(function(){
    $("#collapse22").toggle();
    $(".collapse22").toggleClass("collapse");
    $(".collapse22").toggleClass("collapsed");
  });
    $(".collapse23").click(function(){
    $("#collapse23").toggle();
    $(".collapse23").toggleClass("collapse");
    $(".collapse23").toggleClass("collapsed");
  });
    $(".collapse24").click(function(){
    $("#collapse24").toggle();
    $(".collapse24").toggleClass("collapse");
    $(".collapse24").toggleClass("collapsed");
  });
    $(".collapse25").click(function(){
    $("#collapse25").toggle();
    $(".collapse25").toggleClass("collapse");
    $(".collapse25").toggleClass("collapsed");
  });
    $(".collapse26").click(function(){
    $("#collapse26").toggle();
    $(".collapse26").toggleClass("collapse");
    $(".collapse26").toggleClass("collapsed");
  });
    $(".collapse27").click(function(){
    $("#collapse27").toggle();
    $(".collapse27").toggleClass("collapse");
    $(".collapse27").toggleClass("collapsed");
  });
    $(".collapse28").click(function(){
    $("#collapse28").toggle();
    $(".collapse28").toggleClass("collapse");
    $(".collapse28").toggleClass("collapsed");
  });
    $(".collapse29").click(function(){
    $("#collapse29").toggle();
    $(".collapse29").toggleClass("collapse");
    $(".collapse29").toggleClass("collapsed");
  });
    $(".collapse30").click(function(){
    $("#collapse30").toggle();
    $(".collapse30").toggleClass("collapse");
    $(".collapse30").toggleClass("collapsed");
  });
    $(".collapse31").click(function(){
    $("#collapse31").toggle();
    $(".collapse31").toggleClass("collapse");
    $(".collapse31").toggleClass("collapsed");
  });
    $(".collapse32").click(function(){
    $("#collapse32").toggle();
    $(".collapse32").toggleClass("collapse");
    $(".collapse32").toggleClass("collapsed");
  });
    $(".collapse33").click(function(){
    $("#collapse33").toggle();
    $(".collapse33").toggleClass("collapse");
    $(".collapse33").toggleClass("collapsed");
  });
    $(".collapse34").click(function(){
    $("#collapse34").toggle();
    $(".collapse34").toggleClass("collapse");
    $(".collapse34").toggleClass("collapsed");
  });
    $(".collapse35").click(function(){
    $("#collapse35").toggle();
    $(".collapse35").toggleClass("collapse");
    $(".collapse35").toggleClass("collapsed");
  });
    $(".collapse36").click(function(){
    $("#collapse36").toggle();
    $(".collapse36").toggleClass("collapse");
    $(".collapse36").toggleClass("collapsed");
  });
    $(".collapse37").click(function(){
    $("#collapse37").toggle();
    $(".collapse37").toggleClass("collapse");
    $(".collapse37").toggleClass("collapsed");
  });
    $(".collapse38").click(function(){
    $("#collapse38").toggle();
    $(".collapse38").toggleClass("collapse");
    $(".collapse38").toggleClass("collapsed");
  });
    $(".collapse39").click(function(){
    $("#collapse39").toggle();
    $(".collapse39").toggleClass("collapse");
    $(".collapse39").toggleClass("collapsed");
  });
    $(".collapse40").click(function(){
    $("#collapse40").toggle();
    $(".collapse40").toggleClass("collapse");
    $(".collapse40").toggleClass("collapsed");
  });
    $(".collapse41").click(function(){
    $("#collapse41").toggle();
    $(".collapse41").toggleClass("collapse");
    $(".collapse41").toggleClass("collapsed");
  });
    $(".collapse42").click(function(){
    $("#collapse42").toggle();
    $(".collapse42").toggleClass("collapse");
    $(".collapse42").toggleClass("collapsed");
  });
    $(".collapse43").click(function(){
    $("#collapse43").toggle();
    $(".collapse43").toggleClass("collapse");
    $(".collapse43").toggleClass("collapsed");
  });
    $(".collapse44").click(function(){
    $("#collapse44").toggle();
    $(".collapse44").toggleClass("collapse");
    $(".collapse44").toggleClass("collapsed");
  });
    $(".collapse45").click(function(){
    $("#collapse45").toggle();
    $(".collapse45").toggleClass("collapse");
    $(".collapse45").toggleClass("collapsed");
  });
    $(".collapse46").click(function(){
    $("#collapse46").toggle();
    $(".collapse46").toggleClass("collapse");
    $(".collapse46").toggleClass("collapsed");
  });
    $(".collapse47").click(function(){
    $("#collapse47").toggle();
    $(".collapse47").toggleClass("collapse");
    $(".collapse47").toggleClass("collapsed");
  });
    $(".collapse48").click(function(){
    $("#collapse48").toggle();
    $(".collapse48").toggleClass("collapse");
    $(".collapse48").toggleClass("collapsed");
  });
    $(".collapse49").click(function(){
    $("#collapse49").toggle();
    $(".collapse49").toggleClass("collapse");
    $(".collapse49").toggleClass("collapsed");
  });
    $(".collapse50").click(function(){
    $("#collapse50").toggle();
    $(".collapse50").toggleClass("collapse");
    $(".collapse50").toggleClass("collapsed");
  });
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

<script>
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

</body>
</html>