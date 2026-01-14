<?php
include 'header.php';
include 'config.php';

date_default_timezone_set("Asia/Kolkata");
// send-push.php में जहाँ मैसेज दिखाना हो:
if(isset($_GET['msg']) && $_GET['msg'] == 'sent') {
    echo '<div class="alert alert-success">Notification sent successfully!</div>';
}
?>

<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">

        <!-- Page Header -->
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Send Web Push</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Send Web Push</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Body -->
        <div class="content-body">
            <section id="multiple-column-form">
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <!-- Card Header -->
                            <div class="card-header">
                                <h4 class="card-title">🔔 Send Web Push Notification</h4> 
                            
                            </div>

                            <!-- Card Body -->
                            <div class="card-body">
                                <form class="form" method="post" action="push-action.php">
                                    <div class="row">

                                        <!-- Title -->
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label><b>Notification Title</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i data-feather="bell"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control" name="title" placeholder="Enter notification title" required>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Message -->
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label><b>Notification Message</b></label>
                                                <div class="input-group input-group-merge">
                                                    <textarea class="form-control" name="message" rows="4" placeholder="Enter notification message" required></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Redirect Link -->
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label><b>Redirect Link</b></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i data-feather="link"></i>
                                                        </span>
                                                    </div>
                                                    <input type="url" class="form-control" name="link" placeholder="https://example.com" required>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Submit -->
                                        <div class="col-12 text-center mt-2">
                                            <button type="submit" name="send_push" class="btn btn-primary">
                                                <i data-feather="send" class="mr-50"></i> Send Push Notification
                                            </button>
                                        </div>

                                    </div>
                                </form>
                            </div>
                            <!-- End Card Body -->

                        </div>
                    </div>
                </div>
            </section>
        </div>

    </div>
</div>
<!-- END: Content-->

<?php include 'footer.php'; ?>
