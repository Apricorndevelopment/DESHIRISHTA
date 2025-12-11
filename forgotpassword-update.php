<?php
include 'header.php';
?>
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
                                <div class="form-tit">
                                    <h1>Reset Password</h1>
                                    <p>Updating...</p>
                                </div>
                                <div class="form-login">
                                    </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
<div id="passSuccessModal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close-modal">&times;</span>

        <div class="modal-body-content">
            <img src="images/gif/update.gif" alt="Updated" class="modal-gif">
            <h2 class="text-success">Password Updated!</h2>
            <p>Your password has been changed successfully. You can now login with your new password.</p>

            <a href="login.php" class="btn btn-primary">Go to Sign In</a>
        </div>
    </div>
</div>


     <!-- <a href="login.php">
    <div id="passSuccessModal" class="modal" style="display:block;">
        <div class="modal-content">
            <div class="modal-body-content">
                <img src="images/gif/update.gif" alt="Updated" class="modal-gif">
                <h2 class="text-success">Password Updated!</h2>
                <p>Your password has been changed successfully. You can now login with your new password.</p>
                <a href="login.php" class="btn btn-primary">Go to Sign In</a>
            </div>
        </div>
    </div>
</a> -->
 <style>
    .modal {
    display: none;
    position: fixed;
    z-index: 999999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.8);
    backdrop-filter: blur(5px);
}

.modal-content {
    background-color: #fff;
    margin: 10% auto;
    padding: 40px;
    border-radius: 15px;
    width: 90%;
    max-width: 450px;
    text-align: center;
    box-shadow: 0 15px 40px rgba(0,0,0,0.5);
    animation: popIn 0.5s ease;
    position: relative;
}

/* ❌ Close Button */
.close-modal {
    position: absolute;
    right: 15px;
    top: 10px;
    font-size: 30px;
    font-weight: bold;
    cursor: pointer;
    color: #333;
}

.close-modal:hover {
    color: red;
}

.modal-gif {
    width: 150px;
    margin-bottom: 20px;
}

 </style>
<script>
// Popup show after password update
document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("passSuccessModal");
    const closeBtn = document.querySelector(".close-modal");


    modal.style.display = "block";


    closeBtn.addEventListener("click", function() {
        modal.style.display = "none";
    });

    window.addEventListener("click", function(e) {
        if (e.target === modal) {
            modal.style.display = "none";
        }
    });
});
</script>

<?php
include 'footer.php';
?>