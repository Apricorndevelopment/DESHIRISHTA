<?php
ob_start();
include 'config.php';

date_default_timezone_set('Asia/kolkata'); 

$userid = 'DR'.date('ymdHis');
setcookie("dr_userid", $userid, time() + (10 * 365 * 24 * 60 * 60));

$fullname = $_POST['fullname'];
setcookie("dr_name", $fullname, time() + (10 * 365 * 24 * 60 * 60));

$email = $_POST['email'];
setcookie("dr_email", $email, time() + (10 * 365 * 24 * 60 * 60));

$phone = $_POST['phonenumber'];
setcookie("dr_phone", $phone, time() + (10 * 365 * 24 * 60 * 60));

$password = $_POST['password'];
$otp = $_POST['otp'];

$agree = $_POST['agree'];

$createby = $_POST['createby'];
$fullname = $_POST['fullname'];
$gender = $_POST['gender'];
$marital = $_POST['marital'];
$children = $_POST['children'];
$height = $_POST['height'];
$heigth_div = explode(" ", $height);
$eating = $_POST['eating'];
$smoking = $_POST['smoking'];
$drinking = $_POST['drinking'];

$dob = $_POST['dob'];
$birthplace = $_POST['birthplace'];
$birthtime = $_POST['birthtime'];
$manglik = $_POST['manglik'];

$year = explode("-",$_POST['dob']);
$birth_year = $year[0];
$current_year = date('Y');
$age = $current_year - $birth_year;

$religion = $_POST['religion'];
$caste = str_replace("//", "",implode("//",$_POST['caste']));

$stream = $_POST['stream'];
$education = str_replace("//", "",implode("//",$_POST['education']));
$profession = $_POST['profession'];
$domain = $_POST['domain'];
$designation = str_replace("//", "",implode("//",$_POST['designation']));
$annualincome = $_POST['annualincome'];

$familystatus = $_POST['familystatus'];
$familytype = $_POST['familytype'];
$fathername = $_POST['fathername'];
$mothername = $_POST['mothername'];
$fatheroccupation = $_POST['fatheroccupation'];
$motheroccupation = $_POST['motheroccupation'];
$state = str_replace("-", " ",$_POST['state']);
$city = str_replace("//", "",implode("//",$_POST['city']));
$country = $_POST['country'];

if($gender == 'Male')
{
    $groomlocation = 'Done';
    
    $agediff = $age - 5;
    
    if($agediff < 20)
    {
        $partneragefrom = '20';
    }
    else
    {
        $partneragefrom = $agediff;
    }
    
    $partnerageto = $age;
    
    $partnerage = $partneragefrom.' Yrs-'.$partnerageto.' Yrs';
    
    $heightdiff = $heigth_div[0] - 1;
    
    if($heightdiff < 4)
    {
        $partnerheight = $height.'-'.$height;
    }
    else
    {
        $partnerheight = ($heigth_div[0] - 1).' '.$heigth_div[1].' '.$heigth_div[2].' '.$heigth_div[3].'-'.$height;
    }
}
if($gender == 'Female')
{
    $bridelocation = 'Done';
    $partneragefrom = $age;
    $partnerageto = $age + 5;
    
    $partnerage = $partneragefrom.' Yrs-'.$partnerageto.' Yrs';
    
    $partnerheight = $height.'-'.($heigth_div[0] + 1).' '.$heigth_div[1].' '.$heigth_div[2].' '.$heigth_div[3];
}

$groomstate = $_POST['groomstate'];
$groomcity = str_replace("//", "",implode("//",$_POST['groomcity']));
$groomcountry = $_POST['groomcountry'];

$aboutme = str_replace("'", "\'", $_POST['aboutme']);

$s1=$_FILES["profilepic"]["name"];
$s11=$_FILES["profilepic"]["tmp_name"];
$sd1=move_uploaded_file($s11,"userphoto//".$s1);

$entrydate = date('Y-m-d');

$sqlcheck = "select * from registration where phone = '$phone'";
$rowcheck = mysqli_query($con,$sqlcheck);
$check = mysqli_num_rows($rowcheck);

if($check == '0')
{
    $sql = "INSERT INTO `registration`(`userid`, `name`, `email`, `phone`, `city`, `state`, `country`, `password`, `otp`, `gender`, `groomlocation`, `bridelocation`, `tnc`, `entrydate`) VALUES ('$userid', '$fullname', '$email', '$phone', '$groomcity', '$groomstate', '$groomcountry', '$password', '$otp', '$gender', '$groomlocation', '$bridelocation', '$agree', '$entrydate')";
    $result = mysqli_query($con,$sql);
    $sqlbasicinfo = "INSERT INTO `basic_info`(`userid`, `createby`, `fullname`, `gender`, `marital`, `children`, `age`, `height`, `eating`, `smoking`, `drinking`, `aboutme`) VALUES ('$userid', '$createby', '$fullname', '$gender', '$marital', '$children', '$age', '$height', '$eating', '$smoking', '$drinking', '$aboutme')";
    $resultbasicinfo = mysqli_query($con,$sqlbasicinfo);
    $updatebasicstatus = "UPDATE `registration` SET `aboutme`='Done' WHERE `userid`='$userid'";
    $resultbasicstatus = mysqli_query($con,$updatebasicstatus);
    $sqlastroinfo = "INSERT INTO `astro_info`(`userid`, `dob`, `birthplace`, `birthtime`, `manglik`) VALUES ('$userid', '$dob', '$birthplace', '$birthtime', '$manglik')";
    $resultastroinfo = mysqli_query($con,$sqlastroinfo);
    $updateastrostatus = "UPDATE `registration` SET `astroinfo`='Done' WHERE `userid`='$userid'";
    $resultastrostatus = mysqli_query($con,$updateastrostatus);
    $sqlcontactinfo = "INSERT INTO `contact_info`(`userid`, `phonenumber`, `email`) VALUES ('$userid', '$phone', '$email')";
    $resultcontactinfo = mysqli_query($con,$sqlcontactinfo);
    $sqlreligiousinfo = "INSERT INTO `religious_info`(`userid`, `religion`, `caste`) VALUES ('$userid', '$religion', '$caste')";
    $resultreligiousinfo = mysqli_query($con,$sqlreligiousinfo);
    $sqleducationinfo = "INSERT INTO `education_info`(`userid`, `stream`, `education`, `workingwith`, `profession`, `designation`, `income`) VALUES ('$userid', '$stream', '$education', '$profession', '$domain', '$designation', '$annualincome')";
    $resulteducationinfo = mysqli_query($con,$sqleducationinfo);
    $sqlfamilyinfo = "INSERT INTO `family_info`(`userid`, `familytype`, `familystatus`, `fathername`, `mothername`, `fatheroccupation`, `motheroccupation`, `state`, `city`, `country`) VALUES ('$userid', '$familytype', '$familystatus', '$fathername', '$mothername', '$fatheroccupation', '$motheroccupation', '$state', '$city', '$country')";
    $resultfamilyinfo = mysqli_query($con,$sqlfamilyinfo);
    $sqlgroomlocation = "INSERT INTO `groom_location`(`userid`, `state`, `city`, `country`) VALUES ('$userid', '$groomstate', '$groomcity', '$groomcountry')";
    $resultgroomlocation = mysqli_query($con,$sqlgroomlocation);
    $sqlprofilepic = "INSERT INTO `photos_info`(`userid`, `profilepic`) VALUES ('$userid','$s1')";
    $resultprofilepic = mysqli_query($con,$sqlprofilepic);
    $sqlupdate = "UPDATE `registration` SET `otpstatus`='active' WHERE phone = '$phone'";
    $resultupdate = mysqli_query($con,$sqlupdate);
    $sqlplan = "INSERT INTO `plan_info`(`userid`, `plan`, `entrydate`) VALUES ('$userid','free','$entrydate')";
    $resultplan = mysqli_query($con,$sqlplan);
    $sql_finalbio = "INSERT INTO `final_bio`(`userid`, `age`, `height`, `marital`, `religion`, `caste`, `stream`, `workingwith`, `gender`, `manglik`, `education`, `profession`, `income`, `state`, `country`) VALUES ('$userid', '$age', '$height', '$marital', '$religion', '$caste', '$stream', '$profession', '$gender', '$manglik', '$education', '$domain', '$annualincome', '$groomstate', '$groomcountry')";
    $result_finalbio = mysqli_query($con,$sql_finalbio);
    $sqlpartnerinfo = "INSERT INTO `partner_info`(`userid`, `partnermarital`, `partnerage`, `partnerheight`, `partnerreligion`, `partnercaste`, `partnerstream`, `partnerprofession`, `partnerdomain`, `partnerincome`, `partnerstate`,  `partnercountry`) VALUES ('$userid', '$marital', '$partnerage', '$partnerheight', '$religion', '$caste', '$stream', '$profession', '$domain', '$annualincome', '$groomstate', '$groomcountry')";
    $resultpartnerinfo = mysqli_query($con,$sqlpartnerinfo);
    
    header('location:signup-thankyou.php');
}
else
{
?>
    <form action="sign-up.php" method="post" id="myForm">
        <input type="hidden" name="user" value="exist">
    </form>
    <script>
        document.getElementById("myForm").submit();
    </script>
<?php
}
?>