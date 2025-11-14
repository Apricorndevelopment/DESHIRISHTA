<?php
include 'config.php';

$userid = $_POST['userid'];
$options = $_POST['option'];
$mfoption = $_POST['mfoption'];
$partnername = $_POST['partnername'];
$marriagedate = $_POST['marriagedate'];
$partnerid = $_POST['partnerid'];

$s1=$_FILES["photo1"]["name"];
$s11=$_FILES["photo1"]["tmp_name"];
$sd1=move_uploaded_file($s11,"weddingphoto//".$s1);

$s2=$_FILES["photo2"]["name"];
$s22=$_FILES["photo2"]["tmp_name"];
$sd2=move_uploaded_file($s22,"weddingphoto//".$s2);

$osoption = $_POST['osoption'];
$matchmaking = $_POST['matchmaking'];
$matchmakers = $_POST['matchmakers'];
$others = $_POST['others'];
$otherreason = $_POST['otherreason'];

$sql = "INSERT INTO `delete_profile`(`userid`, `options`, `mfoption`, `partnername`, `marriagedate`, `partnerid`, `s1`, `s2`, `osoption`, `matchmaking`, `matchmakers`, `others`, `otherreason`) VALUES ('$userid', '$options', '$mfoption', '$partnername', '$marriagedate', '$partnerid', '$s1', '$s2', '$osoption', '$matchmaking', '$matchmakers', '$others', '$otherreason')";
$result = mysqli_query($con,$sql);

$updateresgistration = "UPDATE `registration` SET `delete_status`='delete' WHERE `userid`='$userid'";
$resultresgistration = mysqli_query($con,$updateresgistration);

$updateshortlist1 = "UPDATE `shortlist_ids` SET `delete_status`='delete' WHERE `by_whom`='$userid'";
$resultshortlist1 = mysqli_query($con,$updateshortlist1);

$updateshortlist2 = "UPDATE `shortlist_ids` SET `delete_status`='delete' WHERE `for_who`='$userid'";
$resultshortlist2 = mysqli_query($con,$updateshortlist2);

$updateviewvisit1 = "UPDATE `viewvist_ids` SET `delete_status`='delete' WHERE `view`='$userid'";
$resultviewvisit1 = mysqli_query($con,$updateviewvisit1);

$updateviewvisit2 = "UPDATE `viewvist_ids` SET `delete_status`='delete' WHERE `visit`='$userid'";
$resultviewvisit2 = mysqli_query($con,$updateviewvisit2);

$updatefinalbio = "UPDATE `final_bio` SET `delete_status`='delete' WHERE `userid`='$userid'";
$resultfinalbio = mysqli_query($con,$updatefinalbio);

$sqlgetdelete = "select * from registration where userid = '$userid'";
$resultgetdelete = mysqli_query($con,$sqlgetdelete);
$rowgetdelete = mysqli_fetch_assoc($resultgetdelete);

$userid = $rowgetdelete['userid'];
$name = $rowgetdelete['name'];
$email = $rowgetdelete['email'];
$phone = $rowgetdelete['phone'];
$city = $rowgetdelete['city'];
$state = $rowgetdelete['state'];
$country = $rowgetdelete['country'];
$password = $rowgetdelete['password'];
$otp = $rowgetdelete['otp'];
$otpstatus = $rowgetdelete['otpstatus'];
$basicinfo = $rowgetdelete['basicinfo'];
$aboutme = $rowgetdelete['aboutme'];
$astroinfo = $rowgetdelete['astroinfo'];
$religiousinfo = $rowgetdelete['religiousinfo'];
$educationinfo = $rowgetdelete['educationinfo'];
$gender = $rowgetdelete['gender'];
$groomlocation = $rowgetdelete['groomlocation'];
$bridelocation = $rowgetdelete['bridelocation'];
$familyinfo = $rowgetdelete['familyinfo'];
$hobbiesinfo = $rowgetdelete['hobbiesinfo'];
$partnerinfo = $rowgetdelete['partnerinfo'];
$contactinfo = $rowgetdelete['contactinfo'];
$photosinfo = $rowgetdelete['photosinfo'];
$verificationinfo = $rowgetdelete['verificationinfo'];
$verification_popup = $rowgetdelete['verification_popup'];
$profilestatus = $rowgetdelete['profilestatus'];
$profilestatus_popup = $rowgetdelete['profilestatus_popup'];
$firstapprove = $rowgetdelete['firstapprove'];
$online = $rowgetdelete['online'];
$tnc = $rowgetdelete['tnc'];
$entrydate = $rowgetdelete['entrydate'];
$delete_status = "delete";

$sqlinsert = "INSERT INTO `delete_users`(`userid`, `name`, `email`, `phone`, `city`, `state`, `country`, `password`, `otp`, `otpstatus`, `basicinfo`, `aboutme`, `astroinfo`, `religiousinfo`, `educationinfo`, `gender`, `groomlocation`, `bridelocation`, `familyinfo`, `hobbiesinfo`, `partnerinfo`, `contactinfo`, `photosinfo`, `verificationinfo`, `verification_popup`, `profilestatus`, `profilestatus_popup`, `firstapprove`, `online`, `tnc`, `entrydate`, `delete_status`) VALUES ('$userid','$name','$email','$phone','$city','$state','$country','$password','$otp','$otpstatus','$basicinfo','$aboutme','$astroinfo','$religiousinfo','$educationinfo','$gender','$groomlocation','$bridelocation','$familyinfo','$hobbiesinfo','$partnerinfo','$contactinfo','$photosinfo','$verificationinfo','$verification_popup','$profilestatus','$profilestatus_popup','$firstapprove','$online','$tnc','$entrydate','$delete_status')";
$resultinsert = mysqli_query($con,$sqlinsert);

$sqldelete = "delete from registration where userid = '$userid'";
$resultdelete = mysqli_query($con,$sqldelete);
?>
<form action="delete-profile.php" method="post" id="myform">
    <input type="hidden" value="delete" name="deletestatus">
</form>
<script>
    document.getElementById("myform").submit();
</script>


