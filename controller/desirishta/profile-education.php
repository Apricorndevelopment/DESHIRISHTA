<?php
include 'config.php';

$userid = $_COOKIE['dr_userid'];
$stream = $_POST['stream'];
$education = $_POST['education'];
$college = $_POST['college'];
$workingwith = $_POST['workingwith'];
$profession = $_POST['profession'];
$professiondetail = $_POST['professiondetail'];
$designation = $_POST['designation'];
$employername = $_POST['employername'];
$income = $_POST['income'];


$sqlcheck = "select * from education_info where userid = '$userid'";
$resultcheck = mysqli_query($con,$sqlcheck);
$countcheck = mysqli_num_rows($resultcheck);

if($countcheck == '0')
{
    $sqlinsert = "INSERT INTO `education_info`(`userid`, `stream`, `education`, `college`, `workingwith`, `profession`, `professiondetail`, `designation`, `employername`, `income`) VALUES ('$userid', '$stream', '$education', '$college', '$workingwith', '$profession', '$professiondetail', '$designation', '$employername', '$income')";
    $resultinsert = mysqli_query($con,$sqlinsert);
    
    if($stream != '' && $education != '' && $college != '' && $workingwith != '' && $profession != '' && $professiondetail != '' && $designation != '' && $employername != '' && $income != '')
    {
        $updatebasicinfo1 = "UPDATE `registration` SET `educationinfo`='Done' WHERE `userid`='$userid'";
        $resultbasicinfo1 = mysqli_query($con,$updatebasicinfo1);
    }
    else
    {
        $updatebasicinfo2 = "UPDATE `registration` SET `educationinfo`='' WHERE `userid`='$userid'";
        $resultbasicinfo2 = mysqli_query($con,$updatebasicinfo2);
    }
}
else
{
    $sqlupdate = "UPDATE `education_info` SET `stream`='$stream',`education`='$education',`college`='$college',`workingwith`='$workingwith',`profession`='$profession',`professiondetail`='$professiondetail',`designation`='$designation',`employername`='$employername',`income`='$income' WHERE `userid`='$userid'";
    $resultupdate = mysqli_query($con,$sqlupdate);
    
    if($stream != '' && $education != '' && $college != '' && $workingwith != '' && $profession != '' && $professiondetail != '' && $designation != '' && $employername != '' && $income != '')
    {
        $updatebasicinfo3 = "UPDATE `registration` SET `educationinfo`='Done' WHERE `userid`='$userid'";
        $resultbasicinfo3 = mysqli_query($con,$updatebasicinfo3);
    }
    else
    {
        $updatebasicinfo4 = "UPDATE `registration` SET `educationinfo`='' WHERE `userid`='$userid'";
        $resultbasicinfo4 = mysqli_query($con,$updatebasicinfo4);
    }
}

header('location:user-profile-edit.php?tab=educationcareer&education_update=yes');
?>