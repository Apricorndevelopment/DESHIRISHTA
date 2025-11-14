<?php
include 'config.php';

$userid = $_COOKIE['dr_userid'];
$partnermarital = $_POST['partnermarital'];
$partneragefrom = $_POST['partneragefrom'];
$partnerageto = $_POST['partnerageto'];
$partnerage = $partneragefrom.'-'.$partnerageto;
$partnerheightfrom = $_POST['partnerheightfrom'];
$partnerheightto = $_POST['partnerheightto'];
$partnerheight = $partnerheightfrom.'-'.$partnerheightto;
$partnertongue = $_POST['partnertongue'];
$partnerphysical = $_POST['partnerphysical'];
$partnereating = $_POST['partnereating'];
$partnerdrinking = $_POST['partnerdrinking'];
$partnersmoking = $_POST['partnersmoking'];
$partnerreligion = implode("//", $_POST['partnerreligion']);
$partnercaste = implode("//", $_POST['caste']);
$castebar = $_POST['castebar'];
$partnergothram = $_POST['partnergothram'];
$partnermanglik = $_POST['partnermanglik'];
$partnerstream = implode("//", $_POST['partnerstream']);
$partnereducation = implode("//", $_POST['education']);
$partnercollege = $_POST['partnercollege'];
$partnerprofession = implode("//", $_POST['partnerprofession']);
$partnerdomain = implode("//", $_POST['partnerdomain']);
$partnerdesignation = $_POST['designation'];
$partneremployername = $_POST['partneremployername'];
$partnerincome = $_POST['partnerincome'];
$partnerstate = implode("//", $_POST['partnerstate']);
$partnercity = implode("//", $_POST['city']);
$partnercountry = implode("//", $_POST['partnercountry']);

$sqlcheck = "select * from partner_info where userid = '$userid'";
$resultcheck = mysqli_query($con,$sqlcheck);
$countcheck = mysqli_num_rows($resultcheck);

if($countcheck == '0')
{
    $sqlinsert = "INSERT INTO `partner_info`(`userid`, `partnermarital`, `partnerage`, `partnerheight`, `partnertongue`, `partnerphysical`, `partnereating`, `partnerdrinking`, `partnersmoking`, `partnerreligion`, `partnercaste`, `castebar`, `partnergothram`, `partnermanglik`, `partnerstream`, `partnereducation`, `partnercollege`, `partnerprofession`, `partnerdomain`, `partnerdesignation`, `partneremployername`, `partnerincome`, `partnerstate`, `partnercity`, `partnercountry`) VALUES ('$userid', '$partnermarital', '$partnerage', '$partnerheight', '$partnertongue', '$partnerphysical', '$partnereating', '$partnerdrinking', '$partnersmoking', '$partnerreligion', '$partnercaste', '$castebar', '$partnergothram', '$partnermanglik', '$partnerstream', '$partnereducation', '$partnercollege', '$partnerprofession', '$partnerdomain', '$partnerdesignation', '$partneremployername', '$partnerincome', '$partnerstate', '$partnercity', '$partnercountry')";
    $resultinsert = mysqli_query($con,$sqlinsert);
    
    if($partnermarital != '' && $partneragefrom != '' && $partnerageto != '' && $partnerheightfrom != '' && $partnerheightto != '' && $partnereating != '' && $partnerdrinking != '' && $partnersmoking != '' && $partnerreligion != '' && $partnercaste != ''  && $partnermanglik != '' && $partnerstream != '' && $partnereducation != '' && $partnerprofession != '' && $partnerdomain != '' && $partnerincome != '' && $partnerstate != '' && $partnercity != '' && $partnercountry != '')
    {
        $updatebasicinfo1 = "UPDATE `registration` SET `partnerinfo`='Done' WHERE `userid`='$userid'";
        $resultbasicinfo1 = mysqli_query($con,$updatebasicinfo1);
    }
    else
    {
        $updatebasicinfo2 = "UPDATE `registration` SET `partnerinfo`='' WHERE `userid`='$userid'";
        $resultbasicinfo2 = mysqli_query($con,$updatebasicinfo2);
    }
}
else
{
    $sqlupdate = "UPDATE `partner_info` SET `partnermarital`='$partnermarital',`partnerage`='$partnerage',`partnerheight`='$partnerheight',`partnertongue`='$partnertongue',`partnerphysical`='$partnerphysical',`partnereating`='$partnereating',`partnerdrinking`='$partnerdrinking',`partnersmoking`='$partnersmoking',`partnerreligion`='$partnerreligion',`partnercaste`='$partnercaste',`castebar`='$castebar',`partnergothram`='$partnergothram',`partnermanglik`='$partnermanglik',`partnerstream`='$partnerstream',`partnereducation`='$partnereducation',`partnercollege`='$partnercollege',`partnerprofession`='$partnerprofession',`partnerdomain`='$partnerdomain',`partnerdesignation`='$partnerdesignation',`partneremployername`='$partneremployername',`partnerincome`='$partnerincome',`partnerstate`='$partnerstate',`partnercity`='$partnercity',`partnercountry`='$partnercountry' WHERE `userid`='$userid'";
    $resultupdate = mysqli_query($con,$sqlupdate);
    
    if($partnermarital != '' && $partneragefrom != '' && $partnerageto != '' && $partnerheightfrom != '' && $partnerheightto != '' && $partnereating != '' && $partnerdrinking != '' && $partnersmoking != '' && $partnerreligion != '' && $partnercaste != ''  && $partnermanglik != '' && $partnerstream != '' && $partnereducation != '' && $partnerprofession != '' && $partnerdomain != '' && $partnerincome != '' && $partnerstate != '' && $partnercity != '' && $partnercountry != '')
    {
        $updatebasicinfo3 = "UPDATE `registration` SET `partnerinfo`='Done' WHERE `userid`='$userid'";
        $resultbasicinfo3 = mysqli_query($con,$updatebasicinfo3);
    }
    else
    {
        $updatebasicinfo4 = "UPDATE `registration` SET `partnerinfo`='' WHERE `userid`='$userid'";
        $resultbasicinfo4 = mysqli_query($con,$updatebasicinfo4); 
    }
}

header('location:user-profile-edit.php?tab=partner&partner_update=yes');
?>