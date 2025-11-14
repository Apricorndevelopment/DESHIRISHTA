<?php
include 'config.php';

$sql = 'select * from groom_location order by id asc';
$result = mysqli_query($con,$sql);
while($row = mysqli_fetch_assoc($result))
{
    $userid = $row['userid'];
    $city = $row['city'];
    
    echo $update = "UPDATE `registration` SET `city`='$city' WHERE userid = '$userid'";
    $resultupdate = mysqli_query($con,$update);
    echo "</br>";
}
?>