<?php
include 'header.php';
include 'config.php';

$geturl = $_GET['url'];
$divurl = explode("_", $geturl);
$url = $divurl[0];
$tableid = $divurl[1];

$sqlblog = "select * from blogs where url = '$url' and id = '$tableid'";
$resultblog = mysqli_query($con,$sqlblog);
$rowblog = mysqli_fetch_assoc($resultblog)
?>
<head>
     <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>
    <!-- START -->
    <section>
        <div class="inn-ban">
            <div class="container">
                <div class="row">
                    <h1><?php echo $rowblog['heading']; ?></h1>
                </div>
            </div>
        </div>
    </section>
    <!-- END -->
<style>
/* MOBILE VIEW (max-width: 768px) */
@media (max-width: 768px) {
    .inn {
        flex-direction: column !important;  /* row → column */
    }

    .lhs, .rhs {
        width: 100% !important; 
    }

    .blog-main .lhs {
        margin-bottom: 20px;
    }
}
</style>
    <!-- START -->
    <section>
        <div class="blog-main blog-detail">
            <div class="container">
                <div class="row" >
                    <div class="inn" style="display:flex; flex-direction: row;">
                        <div class="lhs">
                            <!--BIG POST START-->
                            <div class="blog-home-box">
                                <div class="im">
                                    <img src="controller/blogimages/<?php echo $rowblog['blogimages']; ?>" alt="" loading="lazy">
                                    <span class="blog-date"><?php echo date('d, M Y', strtotime($rowblog['postdate'])); ?></span>
                                    <input type="text" name="bloglink" value="https://myptetest.com/desirishta/blog-detail.php?url=<?php echo $rowblog['url'].'_'.$rowblog['id']?>" id="myInput<?php echo $rowblog['id']; ?>" style="display:none">
                                    <div class="shar-1">
                                        <i class="fa fa-share-alt" aria-hidden="true"></i>
                                                 <!-- <i class="fa fa-share-alt act" aria-hidden="true"></i> -->
           <ul>
    <li><a href="https://api.whatsapp.com/send?text=<?= $link ?>" target="_blank"><i class="fa-brands fa-whatsapp"></i></a></li>
    <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?= $link ?>" target="_blank"><i class="fa-brands fa-facebook"></i></a></li>
    <li><a href="https://www.instagram.com/?url=<?= $link ?>" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
    <li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?= $link ?>" target="_blank"><i class="fa-brands fa-linkedin"></i></a></li>
    <li><a href="https://twitter.com/intent/tweet?url=<?= $link ?>" target="_blank"><i class="fa-brands fa-x-twitter"></i></a></li>

    <!-- FIXED COPY BUTTON -->
    <li>
        <a href="javascript:void(0)" onclick="copyLink(<?= $rowblog['id']; ?>)">
            <i class="fa fa-link" id="copyIcon<?= $rowblog['id']; ?>"></i>
        </a>
    </li>
</ul>
                                    </div>
                                </div>
                                <div class="txt">
                                    <span class="blog-cate"><?php echo $rowblog['category']; ?></span>
                                    <h2><?php echo $rowblog['heading']; ?></h2>
                                    <div class="text-justify">
                                        <?php echo $rowblog['content']; ?>
                                    </div>
                                </div>
                            </div>
                            <!--END BIG POST START-->

                            <!--START-->
                            <!-- <div class="blog-nav">
                                <div class="com lhs">
                                    <?php
                                    $sqlprevious = "select * from blogs where id < '$tableid' order by id desc limit 1";
                                    $resultprevious = mysqli_query($con,$sqlprevious);
                                    $rowprevious = mysqli_fetch_assoc($resultprevious);
                                    
                                    $previousid = $rowprevious['id'];
                                    if($previousid != '')
                                    {
                                    ?>
                                    <span><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Previous post</span>
                                    <a href="blog-detail.php?url=<?php echo $rowprevious['url'].'_'.$rowprevious['id']; ?>" class="fclick"></a>
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                    <span class="noprevious"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Previous post</span>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="com rhs">
                                    <?php
                                    $sqlnext = "select * from blogs where id > '$tableid' order by id asc limit 1";
                                    $resultnext = mysqli_query($con,$sqlnext);
                                    $rownext = mysqli_fetch_assoc($resultnext);
                                    
                                    $nextid = $rownext['id'];
                                    if($nextid != '')
                                    {
                                    ?>
                                    <span>Next post <i class="fa fa-long-arrow-right" aria-hidden="true"></i></span>
                                    <a href="blog-detail.php?url=<?php echo $rownext['url'].'_'.$rownext['id']; ?>" class="fclick"></a>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div> -->
                            <!--END-->
                            <div class="blog-nav-new">
    
    <!-- PREVIOUS -->
    <div class="nav-box">
        <?php if($previousid != '') { ?>
            <a href="blog-detail.php?url=<?php echo $rowprevious['url'].'_'.$rowprevious['id']; ?>" class="nav-link left">
                <i class="fa fa-long-arrow-left"></i>
                <span>Previous Post</span>
            </a>
        <?php } else { ?>
            <div class="nav-link disabled">
                <i class="fa fa-long-arrow-left"></i>
                <span>No Previous Post</span>
            </div>
        <?php } ?>
    </div>

    <!-- NEXT -->
    <div class="nav-box">
        <?php if($nextid != '') { ?>
            <a href="blog-detail.php?url=<?php echo $rownext['url'].'_'.$rownext['id']; ?>" class="nav-link right">
                <span>Next Post</span>
                <i class="fa fa-long-arrow-right"></i>
            </a>
        <?php } else { ?>
            <div class="nav-link disabled">
                <span>No Next Post</span>
                <i class="fa fa-long-arrow-right"></i>
            </div>
        <?php } ?>
    </div>

</div>
<style>
    /* MAIN CONTAINER */
.blog-nav-new {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    margin: 40px 0;
    padding: 20px;
    border: 1px solid #eee;
    border-radius: 10px;
    /* background: #fafafa; */
}

/* BOX */
.blog-nav-new .nav-box {
    flex: 1;
}

/* LINKS */
.blog-nav-new .nav-link {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 17px;
    font-weight: 600;
    color: #702525ff; /* premium maroon shade */
    padding: 12px 18px;
    border-radius: 8px;
    /* background: #fff; */
    /* box-shadow: 0 0 10px rgba(0,0,0,0.05); */
    transition: 0.3s;
    justify-content: center;
    text-decoration: none;
}

/* LEFT ARROW LEFT SIDE */
.blog-nav-new .left i {
    margin-right: 8px;
}

/* RIGHT ARROW RIGHT SIDE */
.blog-nav-new .right i {
    margin-left: 8px;
}
.blog-nav-new .right i:hover{
  color:black;
}

/* HOVER EFFECT */
.blog-nav-new .nav-link:hover {
    /* background: maroon; */
    color: #fff;
    transform: translateY(-3px);
}

/* DISABLED STATE */
.blog-nav-new .disabled {
    /* background: #eaeaea; */
    color: #777;
    cursor: not-allowed;
    box-shadow: none;
}

/* MOBILE RESPONSIVE */
@media (max-width: 768px) {
    .blog-nav-new {
        flex-direction: row;
        gap: 15px;
        padding: 15px;
    }

    .blog-nav-new .nav-link {
        width: 100%;
        justify-content: center;
        font-size: 16px;
        padding: 12px;
    }
}

</style>

                        </div>
                      <div class="rhs">
                            <div class="blog-com-rhs">
                                <!-- SUBSCRIBE START-->
                                <div class="blog-subsc">
                                    <div class="ud-rhs-poin1">
                                        <img src="https://cdn-icons-png.flaticon.com/512/6349/6349282.png" alt=""
                                            loading="lazy">
                                        <h5>Subscribe <b>Newsletter</b></h5>
                                    </div>
                                    <form name="news_newsletter_subscribe_form" id="news_newsletter_subscribe_form">
                                        <ul>
                                            <li><input type="text" name="news_newsletter_subscribe_name"
                                                    placeholder="Enter Email Id*" class="form-control" required="">
                                            </li>
                                            <li><input type="submit" style="border-color: BLACK;" id="news_newsletter_subscribe_submit"
                                                    name="news_newsletter_subscribe_submit" class="form-control"></li>
                                        </ul>
                                    </form>
                                </div>
                                <!-- SUBSCRIBE END-->
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
        <div class="blog-rel slid-inn">
            <div class="container">
                <div class="row">
                    <div class="home-tit">
                        <p>Blog & Articles</p>
                        <h2><span>Related posts</span></h2>
                        <span class="leaf1"></span>
                    </div>
                    <div class="cus-revi">
                        <ul class="slider4">
                            <?php
                            $sqlrelatedblog = "select * from blogs where id != '$tableid' order by id desc";
                            $resultrelatedblog = mysqli_query($con,$sqlrelatedblog);
                            while($rowrelatedblog = mysqli_fetch_assoc($resultrelatedblog))
                            {
                            ?>
                            <li>
                                <div class="blog-home-box">
                                    <div class="im">
                                        <img src="controller/blogimages/<?php echo $rowrelatedblog['blogimages']; ?>" alt="" loading="lazy">
                                    </div>
                                    <div class="txt">
                                        <span class="blog-cate"><?php echo $rowrelatedblog['category']; ?></span>
                                        <h2><?php echo $rowrelatedblog['heading']; ?></h2>
                                        <a href="blog-detail.php?url=<?php echo $rowrelatedblog['url'].'_'.$rowrelatedblog['id'];?>" class="fclick"></a>
                                    </div>
                                </div>
                            </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END -->
<div id="newsletterModal" class="custom-modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <!-- <img src="img/" alt="Success"> -->
        
        <h3>Thank You!</h3>
        <p>You have successfully subscribed to our newsletter.</p>
    </div>
</div>
<style>
    /* --- Newsletter Modal CSS --- */
.custom-modal {
    display: none; /* Hidden by default */
    position: fixed;
    z-index: 10000; /* Sabse upar */
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.6); /* Background dim */
    backdrop-filter: blur(2px); /* Thoda blur effect */
    justify-content: center;
    align-items: center;
}

.modal-content {
    background-color: #fff;
    padding: 30px;
    border-radius: 20px;
    width: 90%;
    max-width: 450px;
    text-align: center;
    position: relative;
    box-shadow: 0 10px 25px rgba(214, 51, 132, 0.3); /* Pink Shadow */
    animation: popUp 0.4s ease-out;
    border: 2px solid #ffebf0; /* Light pink border */
}

/* Animation for popup */
@keyframes popUp {
    from { transform: scale(0.7); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
}

.modal-content img {
    width: 80px;
    margin-bottom: 15px;
}

.modal-content h3 {
    color: #d63384; /* Deep Pink */
    font-family: sans-serif;
    margin: 10px 0;
    font-size: 24px;
    font-weight: 700;
}

.modal-content p {
    color: #666;
    font-size: 14px;
    margin-bottom: 10px;
}

/* Close Button (Cross) */
.close-btn {
    position: absolute;
    top: 10px;
    right: 15px;
    color: #d63384;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
    line-height: 20px;
}

.close-btn:hover {
    color: #a61e4d;
    transform: rotate(90deg);
}
</style>

<?php
include 'footer.php';

$sqlblog1 = "select * from blogs where url = '$url' and id = '$tableid'";
$resultblog1 = mysqli_query($con,$sqlblog1);
while($rowblog1 = mysqli_fetch_assoc($resultblog1))
{
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function myFunction<?php echo $rowblog1['id']; ?>() {
            // Get the text field
            var copyText = document.getElementById("myInput<?php echo $rowblog1['id']; ?>");
                                      
            // Select the text field
            copyText.select();
            copyText.setSelectionRange(0, 99999); // For mobile devices
                                    
            // Copy the text inside the text field
            navigator.clipboard.writeText(copyText.value);
                                      
            // Alert the copied text
            //alert("Copied the text: " + copyText.value);
                                      
            $('.copybox').css('display', 'block');
        }
    </script>
    <script>
function copyLink(id) {
    var copyText = document.getElementById("myInput" + id);

    // Select text
    copyText.select();
    copyText.setSelectionRange(0, 99999);

    // Copy
    navigator.clipboard.writeText(copyText.value).then(() => {

        // Find icon inside share list
        let icon = document.querySelector("#copyIcon" + id);

        icon.classList.remove("fa-link");
        icon.classList.add("fa-chain-broken");

        setTimeout(() => {
            icon.classList.remove("fa-chain-broken");
            icon.classList.add("fa-link");
        }, 1500);
    });
}
</script>
<?php
}
?>
<script>
$(document).ready(function() {
    
    // Modal Close Logic (Cross button click)
    $('.close-btn').click(function() {
        $('#newsletterModal').fadeOut();
    });

    // Modal Close Logic (Outside click)
    $(window).click(function(e) {
        if ($(e.target).is('#newsletterModal')) {
            $('#newsletterModal').fadeOut();
        }
    });

    // Form Submit Logic
    $('#news_newsletter_subscribe_form').submit(function(e) {
        e.preventDefault(); 

        var email = $('input[name="news_newsletter_subscribe_name"]').val();
        var submitBtn = $('#news_newsletter_subscribe_submit');

        if(email == '') {
            alert("Please enter a valid email.");
            return;
        }

        submitBtn.val('Subscribing...'); 

        $.ajax({
            url: 'insert-newsletter.php',
            type: 'POST',
            data: { email: email },
            success: function(response) {
                if(response.trim() == "success") {
                    
                    // --- YAHAN CHANGE HUA HAI ---
                    // Alert hata diya, Modal show kiya
                    $('#newsletterModal').css('display', 'flex').hide().fadeIn();
                    
                    $('#news_newsletter_subscribe_form')[0].reset(); // Form clear
                
                } else if(response.trim() == "exist") {
                    alert("You have already subscribed!");
                } else {
                    alert("Something went wrong. Please try again.");
                }
                submitBtn.val('Subscribe'); 
            }
        });
    });
});
</script>
<!-- <script>

$(document).ready(function() {
    $('#news_newsletter_subscribe_form').submit(function(e) {
        e.preventDefault(); // Page refresh rokein

        var email = $('input[name="news_newsletter_subscribe_name"]').val();
        var submitBtn = $('#news_newsletter_subscribe_submit');

        if(email == '') {
            alert("Please enter a valid email.");
            return;
        }

        submitBtn.val('Subscribing...'); // Button text change

        $.ajax({
            url: 'insert-newsletter.php',
            type: 'POST',
            data: { email: email },
            success: function(response) {
                if(response.trim() == "success") {
                    alert("Thank you for subscribing to our newsletter!");
                    $('#news_newsletter_subscribe_form')[0].reset(); // Form clear karein
                } else if(response.trim() == "exist") {
                    alert("You have already subscribed!");
                } else {
                    alert("Something went wrong. Please try again.");
                }
                submitBtn.val('Subscribe'); // Button text reset
            }
        });
    });
});
</script> -->