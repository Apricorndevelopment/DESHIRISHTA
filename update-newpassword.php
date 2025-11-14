<?php
include 'config.php';

$phone = $_POST['phone'];
$email = $_POST['email'];
$newpass = $_POST['newpass'];

if($phone != '')
{
    $sqlcheck1 = "select * from registration where phone = '$phone'";
    $resultcheck1 = mysqli_query($con,$sqlcheck1);
    $rowcheck1 = mysqli_fetch_assoc($resultcheck1);

    echo $previous_pass1 = $rowcheck1['password'];
    
    if($previous_pass1 != $newpass)
    {
        echo $sql1 = "UPDATE `registration` SET `password`='$newpass' WHERE `phone`='$phone'";
        $result1 = mysqli_query($con,$sql1);
    ?>
        <form action="forgotpassword-update.php" method="post" id="myForm1">
            <input type="hidden" name="passtype" value="new">
        </form>
        <script>
            document.getElementById("myForm1").submit();
        </script>
    <?php
    }
    else
    {
    ?>
        <form action="forgot-newpassword.php" method="post" id="myForm2">
            <input type="hidden" name="passtype" value="old">
            <input type="hidden" name="validphone" value="<?php echo $phone; ?>">
        </form>
        <script>
            document.getElementById("myForm2").submit();
        </script>
    <?php
    }
}

if($email != '')
{
    $sqlcheck2 = "select * from registration where email = '$email'";
    $resultcheck2 = mysqli_query($con,$sqlcheck2);
    $rowcheck2 = mysqli_fetch_assoc($resultcheck2);

    $previous_pass2 = $rowcheck2['password'];
    
    if($previous_pass2 != $newpass)
    {
        $sql2 = "UPDATE `registration` SET `password`='$newpass' WHERE `email`='$email'";
        $result2 = mysqli_query($con,$sql2);
    ?>
        <form action="forgotpassword-update.php" method="post" id="myForm3">
            <input type="hidden" name="passtype" value="new">
        </form>
        <script>
            document.getElementById("myForm3").submit();
        </script>
    <?php
    }
    else
    {
    ?>
        <form action="forgot-newpassword.php" method="post" id="myForm4">
            <input type="hidden" name="passtype" value="old">
            <input type="hidden" name="validemail" value="<?php echo $email; ?>">
        </form>
        <script>
            document.getElementById("myForm4").submit();
        </script>
    <?php
    }
}
?>