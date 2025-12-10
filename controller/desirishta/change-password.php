<?php
include 'config.php';

$userid = $_POST['userid'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];

$sqlcheck = "select * from registration where userid = '$userid'";
$resultcheck = mysqli_query($con,$sqlcheck);
$rowcheck = mysqli_fetch_assoc($resultcheck);

$previous_pass = $rowcheck['password'];

if($previous_pass != $password)
{
    $sql = "UPDATE `registration` SET `password`='$password' WHERE `userid`='$userid'";
    $result = mysqli_query($con,$sql);
?>
    <form action="user-setting.php#accountdetails" method="post" id="myForm1">
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
    <form action="user-setting.php#accountdetails" method="post" id="myForm2">
        <input type="hidden" name="passtype" value="old">
    </form>
    <script> 
        document.getElementById("myForm2").submit();
    </script>
<?php
}
?>