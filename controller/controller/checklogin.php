<?php
ob_start();
session_start();
include 'config.php';

echo $email = $_POST['email'];
echo $password = $_POST['password'];

echo $sql = "SELECT * FROM `administrator` WHERE `email` = '$email' and `password` = '$password'";
$result = mysqli_query($con,$sql);
echo $count = mysqli_num_rows($result);
if($count)
{
    while($row = mysqli_fetch_assoc($result))
    {
        echo $_SESSION['name'] = $row['name'];
        echo "</br>";
        echo $_SESSION['email'] = $row['email'];
        echo "</br>";
        echo $_SESSION['join_date'] = $row['join_date'];
        
        header('location:dashboard.php');
    }
}
else
{
   header('location:index.php?detail=invalid');
}


?>