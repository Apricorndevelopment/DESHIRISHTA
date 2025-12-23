<?php
include 'header.php';
include 'config.php';

$userid = $_COOKIE['dr_userid'];
$profile = $_GET['uid'];

if($userid == '')
{
    header('location:login.php');
}
?>

    <!-- REGISTER -->
    <section>
        <div class="login">
            <div class="container">
                <div class="row">

                    <div class="inn">
                        <div class="lhs">
                            <div class="tit">
                                <h2>Promptly <b>Report</b> any violations or <b>Misuse</b> for swift action</h2>
                            </div>
                            <div class="im">
                                <img src="images/login-couple.png" alt="">
                            </div>
                            <div class="log-bg">&nbsp;</div>
                        </div>
                        <div class="rhs">
                            <div>
                                <div class="form-tit">
                                    <h1>Report or Misuse</h1>
                                    <p><span class="text-danger">Note</span> – We will not disclose your identify to the miscreant </p>
                                </div>
                                <div class="form-login">
                                    <?php
                                    if($_GET['success'] == 'yes')
                                    {
                                    ?>
                                    <p class="text-success text-center">We have recived your request, we will look into it and take action if required.</p>
                                    <?php
                                    }
                                    ?>
                                    <form class="cform fvali" method="post" action="insert-reportprofile.php">
                                        <div class="form-group">
                                            <label class="lb">Violation Category:</label>
                                            <span class="iconbox">
                                                <select class="form-select chosen-select" name="violation[]" multiple required>
                                                    <option value="">Select</option>
                                                    <option value="Incorrect Profile Information">Incorrect Profile Information</option>
                                                    <option value="Phone number is incorrect/unreachable">Phone number is incorrect/unreachable</option>
                                                    <option value="Have more than one profile">Have more than one profile</option>
                                                    <option value="Photo belongs to someone else">Photo belongs to someone else</option>
                                                    <option value="Not responding">Not responding</option>
                                                    <option value="Member uses abusive language">Member uses abusive language</option>
                                                    <option value="Member calls/text repeatedly">Member calls/text repeatedly</option>
                                                    <option value="Looking for dating only">Looking for dating only</option>
                                                    <option value="Scammer">Scammer</option>
                                                    <option value="Member is already married">Member is already married</option>
                                                    <option value="Irrelevant photo">Irrelevant photo</option>
                                                    <option value="Inappropriate photo">Inappropriate photo</option>
                                                    <option value="Others">Others</option>
                                                </select>
                                            <span class="material-symbols-outlined icon">list</span>
                                            </span>
                                        </div>
                                        <div class="form-group">
                                            <label class="lb">Enter Your Subject:</label>
                                            <span class="iconbox">
                                                <input type="text" class="form-control leftspace"  placeholder="Enter Subject" name="subject" required>
                                                <span class="material-symbols-outlined icon">edit_note</span>
                                            </span>
                                        </div>
                                        <div class="form-group">
                                            <label class="lb">Enter Your Complaint Details:</label>
                                            <span class="iconbox">
                                                <textarea name="complaint" class="form-control leftspace" placeholder="Enter Complaint" required></textarea>
                                                <span class="material-symbols-outlined icon">edit_note</span>
                                            </span>
                                        </div>
                                        <div class="form-group">
                                            <label class="lb">Complaint Against Account ID :</label>
                                            <span class="iconbox">
                                                <input type="text" class="form-control leftspace" value="<?php echo $profile; ?>" name="against" readonly required>
                                                <input type="hidden" class="form-control" value="<?php echo $userid; ?>" name="by_who" readonly required>
                                                <span class="material-symbols-outlined icon">account_circle</span>
                                            </span>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary">Send Message</button>
                                    </form>
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