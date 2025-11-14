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
                            <div class="col-md-12">
                                <h2 class="db-tit">Plan details</h2>
                            </div>
                            <div class="col-md-4 db-sec-com">
                                <div class="db-pro-stat">
                                    <h6 class="tit-top-curv">Free plan</h6>
                                    <div class="db-plan-card">
                                        <img src="images/icon/plan.png" alt="">
                                    </div>
                                    <div class="db-plan-detil">
                                        <ul>
                                            <li>Plan name: <strong>Free</strong></li>
                                            <li>Validity: <strong>14 Days</strong></li>
                                            <li>Valid till <strong>01 January 1900 </strong></li>
                                            <li><a href="#" class="cta-3">Coming Soon</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 db-sec-com">
                                <div class="db-pro-stat">
                                    <h6 class="tit-top-curv">Gold plan</h6>
                                    <div class="db-plan-card">
                                        <img src="images/icon/plan.png" alt="">
                                    </div>
                                    <div class="db-plan-detil">
                                        <ul>
                                            <li>Plan name: <strong>Gold</strong></li>
                                            <li>Validity: <strong>1 Months</strong></li>
                                            <li>Valid till <strong>01 January 1900 </strong></li>
                                            <li><a href="#" class="cta-3">Coming Soon</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 db-sec-com">
                                <div class="db-pro-stat">
                                    <h6 class="tit-top-curv">Platinum plan</h6>
                                    <div class="db-plan-card">
                                        <img src="images/icon/plan.png" alt="">
                                    </div>
                                    <div class="db-plan-detil">
                                        <ul>
                                            <li>Plan name: <strong>Platinum</strong></li>
                                            <li>Validity: <strong>2 Months</strong></li>
                                            <li>Valid till <strong>01 January 1900 </strong></li>
                                            <li><a href="#" class="cta-3">Coming Soon</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--<div class="col-md-12 db-sec-com">
                                <div class="alert alert-warning db-plan-canc">
                                    <p><strong>Plan cancellation:</strong> <a href="#" data-bs-toggle="modal" data-bs-target="#plancancel">Click here</a> to cancell the current plan.</p>
                                </div>
                            </div>
                            <div class="col-md-12 db-sec-com">
                                <div class="alert alert-warning db-plan-canc db-plan-canc-app">
                                    <p>Your plan cancellation request has been successfully received by the admin. Once the admin approves your cancellation, the cost will be sent to you.</p>
                                </div>
                            </div>-->
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