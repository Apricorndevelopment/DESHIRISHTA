<?php
include 'header.php';
include 'config.php';



$page = $_GET['page'];

if($page == '')
{
    $lower_page =  0;
}
else
{
    $lower_page = $page - 1;
}

$lower_limit = $lower_page * 3;
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
                    <h1>Blog & Articles</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- END -->

    <!-- START -->
    <section>
        <div class="blog-main">
            <div class="container">
                <div class="row">
                    <div class="inn">
                        <div class="lhs">
                            <div class="blog-com-tit">
                                <h2>Latest &amp; Popular</h2>
                            </div>
                            <div class="row">
                            <?php
                            $sqlblog = "select * from blogs order by id desc limit $lower_limit,3";
                            $resultblog = mysqli_query($con,$sqlblog);
                            while($rowblog = mysqli_fetch_assoc($resultblog))
                            {
                            ?>
                            <!--BIG POST START-->
                           
<!--BIG POST START-->
<div class="blog-home-box w-30">
    <div class="im">
        <img src="controller/blogimages/<?php echo $rowblog['blogimages']; ?>" alt="" loading="lazy" style="height:400px; width:100%; object-fit:cover;">
        <span class="blog-date"><?php echo date('d, M Y', strtotime($rowblog['postdate'])); ?></span>
        <input type="text" name="bloglink" value="https://myptetest.com/desirishta/blog-detail.php?url=<?php echo $rowblog['url'].'_'.$rowblog['id']?>" id="myInput<?php echo $rowblog['id']; ?>" style="display:none">
        <div class="shar-1">
            <i class="fa fa-share-alt" aria-hidden="true"></i>
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
        <h2 class="text-justify"><?php echo $rowblog['heading']; ?></h2>
        <p class="text-justify"><?php echo $rowblog['shortcontent']; ?></p>
        <a href="blog-detail.php?url=<?php echo $rowblog['url'].'_'.$rowblog['id'];?>" class="fclick"></a>
    </div>
</div>
<!--END BIG POST START-->


                            <?php
                            }
                            ?>
                            </div>
                            <div class="row">
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <div class="page-nation">
                                        <ul class="pagination pagination-sm">
                                            <?php
                                            $sqltotalentry = "select * from blogs";
                                            $resulttotalentry = mysqli_query($con,$sqltotalentry);
                                            $counttotalentry = mysqli_num_rows($resulttotalentry);
                                            $total_page = ceil($counttotalentry/3);
                                            
                                            if($page >= 2)
                                            {
                                            ?>
                                            <li class="page-item"><a class="page-link" href="blog.php?page=<?php echo $page - 1; ?>">Previous</a></li>
                                            <?php
                                            }
                                            if($total_page >= 1)
                                            {
                                            ?>
                                            <li class="page-item <?php if($page == '1' || $page == '') { echo "active"; }?>"><a class="page-link" href="blog.php?page=1">1</a></li>
                                            <?php
                                            }
                                            if($total_page >= 2)
                                            {
                                            ?>
                                            <li class="page-item <?php if($page == '2') { echo "active"; }?>"><a class="page-link" href="blog.php?page=2">2</a></li>
                                            <?php
                                            }
                                            if($total_page >= 3)
                                            {
                                            ?>
                                            <li class="page-item <?php if($page == '3') { echo "active"; }?>"><a class="page-link" href="blog.php?page=3">3</a></li>
                                            <?php
                                            }
                                            if($total_page >= 4)
                                            {
                                            ?>
                                            <li class="page-item <?php if($page == '4') { echo "active"; }?>"><a class="page-link" href="blog.php?page=4">4</a></li>
                                            <?php
                                            }
                                            if($total_page >= 5)
                                            {
                                            ?>
                                            <li class="page-item <?php if($page == '5') { echo "active"; }?>"><a class="page-link" href="blog.php?page=5">5</a></li>
                                            <?php
                                            }
                                            if($total_page > $page)
                                            {
                                            ?>
                                            <li class="page-item"><a class="page-link" href="blog.php?page=<?php echo $page + 1; ?>">Next</a></li>
                                            <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END -->


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
include 'footer.php';

$sqlblog1 = "select * from blogs order by id desc";
                            $resultblog1 = mysqli_query($con,$sqlblog1);
                            while($rowblog1 = mysqli_fetch_assoc($resultblog1))
?>
                                   

