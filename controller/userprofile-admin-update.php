<?php
include 'config.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Sabse pehle UserID lein
    $userid = $_POST['userid'];

    // --- 1. Registration Table Update (Password) ---
    // Har variable ko SQL injection se bachayein
    $password = mysqli_real_escape_string($con, $_POST['password']);
    
    $sql_reg = "UPDATE registration SET 
                    password = '$password' 
                  WHERE userid = '$userid'";
    mysqli_query($con, $sql_reg);

    // --- 2. Basic Info Update ---
    $createby = mysqli_real_escape_string($con, $_POST['createby']);
    $fullname = mysqli_real_escape_string($con, $_POST['fullname']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $marital = mysqli_real_escape_string($con, $_POST['marital']);
    $children = mysqli_real_escape_string($con, $_POST['children']);
    $age = mysqli_real_escape_string($con, $_POST['age']);
    $height = mysqli_real_escape_string($con, $_POST['height']);
    $weight = mysqli_real_escape_string($con, $_POST['weight']);
    $physical = mysqli_real_escape_string($con, $_POST['physical']);
    $langauge = mysqli_real_escape_string($con, $_POST['langauge']); // DB me typo hai 'langauge'
    $eating = mysqli_real_escape_string($con, $_POST['eating']);
    $smoking = mysqli_real_escape_string($con, $_POST['smoking']);
    $drinking = mysqli_real_escape_string($con, $_POST['drinking']);
    $aboutme = mysqli_real_escape_string($con, $_POST['aboutme']);

    $sql_basic = "UPDATE basic_info SET 
                    createby = '$createby', 
                    fullname = '$fullname', 
                    gender = '$gender',
                    marital = '$marital',
                    children = '$children',
                    age = '$age',
                    height = '$height',
                    weight = '$weight',
                    physical = '$physical',
                    langauge = '$langauge',
                    eating = '$eating',
                    smoking = '$smoking',
                    drinking = '$drinking',
                    aboutme = '$aboutme'
                  WHERE userid = '$userid'";
    mysqli_query($con, $sql_basic);

    // --- 3. Astro Info Update ---
    $dob = mysqli_real_escape_string($con, $_POST['dob']);
    $birthplace = mysqli_real_escape_string($con, $_POST['birthplace']);
    $birthtime = mysqli_real_escape_string($con, $_POST['birthtime']);
    $manglik = mysqli_real_escape_string($con, $_POST['manglik']);
    
    $sql_astro = "UPDATE astro_info SET 
                    dob = '$dob', 
                    birthplace = '$birthplace',
                    birthtime = '$birthtime',
                    manglik = '$manglik'
                  WHERE userid = '$userid'";
    mysqli_query($con, $sql_astro);
    
    // --- 4. Religious Info Update ---
    $religion = mysqli_real_escape_string($con, $_POST['religion']);
    $caste = mysqli_real_escape_string($con, $_POST['caste']);
    $gothram = mysqli_real_escape_string($con, $_POST['gothram']);
    $subcaste = mysqli_real_escape_string($con, $_POST['subcaste']);
    
    $sql_religious = "UPDATE religious_info SET 
                        religion = '$religion',
                        caste = '$caste',
                        gothram = '$gothram',
                        subcaste = '$subcaste'
                      WHERE userid = '$userid'";
    mysqli_query($con, $sql_religious);

    // --- 5. Education & Career Update ---
    $stream = mysqli_real_escape_string($con, $_POST['stream']);
    $education = mysqli_real_escape_string($con, $_POST['education']);
    $college = mysqli_real_escape_string($con, $_POST['college']);
    $workingwith = mysqli_real_escape_string($con, $_POST['workingwith']);
    $profession = mysqli_real_escape_string($con, $_POST['profession']);
    $designation = mysqli_real_escape_string($con, $_POST['designation']);
    $professiondetail = mysqli_real_escape_string($con, $_POST['professiondetail']);
    $employername = mysqli_real_escape_string($con, $_POST['employername']);
    $income = mysqli_real_escape_string($con, $_POST['income']);

    $sql_education = "UPDATE education_info SET 
                        stream = '$stream',
                        education = '$education',
                        college = '$college',
                        workingwith = '$workingwith',
                        profession = '$profession',
                        designation = '$designation',
                        professiondetail = '$professiondetail',
                        employername = '$employername',
                        income = '$income'
                      WHERE userid = '$userid'";
    mysqli_query($con, $sql_education);

    // --- 6. Groom/Bride Location Update ---
    $groom_country = mysqli_real_escape_string($con, $_POST['groom_country']);
    $groom_citizenship = mysqli_real_escape_string($con, $_POST['groom_citizenship']);
    $groom_resident = mysqli_real_escape_string($con, $_POST['groom_resident']);
    $groom_state = mysqli_real_escape_string($con, $_POST['groom_state']);
    $groom_city = mysqli_real_escape_string($con, $_POST['groom_city']);

    $sql_groom_loc = "UPDATE groom_location SET 
                        country = '$groom_country',
                        citizenship = '$groom_citizenship',
                        resident = '$groom_resident',
                        state = '$groom_state',
                        city = '$groom_city'
                      WHERE userid = '$userid'";
    mysqli_query($con, $sql_groom_loc);

    // --- 7. Family Details Update ---
    $familyvalue = mysqli_real_escape_string($con, $_POST['familyvalue']);
    $familytype = mysqli_real_escape_string($con, $_POST['familytype']);
    $familystatus = mysqli_real_escape_string($con, $_POST['familystatus']);
    $nativeplace = mysqli_real_escape_string($con, $_POST['nativeplace']);
    $fathername = mysqli_real_escape_string($con, $_POST['fathername']);
    $mothername = mysqli_real_escape_string($con, $_POST['mothername']);
    $fatheroccupation = mysqli_real_escape_string($con, $_POST['fatheroccupation']);
    $motheroccupation = mysqli_real_escape_string($con, $_POST['motheroccupation']);
    $brothers = mysqli_real_escape_string($con, $_POST['brothers']);
    $bromarried = mysqli_real_escape_string($con, $_POST['bromarried']);
    $sisters = mysqli_real_escape_string($con, $_POST['sisters']);
    $sismarried = mysqli_real_escape_string($con, $_POST['sismarried']);
    $familylocation = mysqli_real_escape_string($con, $_POST['familylocation']);
    $family_state = mysqli_real_escape_string($con, $_POST['family_state']);
    $family_city = mysqli_real_escape_string($con, $_POST['family_city']);
    $family_country = mysqli_real_escape_string($con, $_POST['family_country']);

    $sql_family = "UPDATE family_info SET 
                    familyvalue = '$familyvalue',
                    familytype = '$familytype',
                    familystatus = '$familystatus',
                    nativeplace = '$nativeplace',
                    fathername = '$fathername',
                    mothername = '$mothername',
                    fatheroccupation = '$fatheroccupation',
                    motheroccupation = '$motheroccupation',
                    brothers = '$brothers',
                    bromarried = '$bromarried',
                    sisters = '$sisters',
                    sismarried = '$sismarried',
                    familylocation = '$familylocation',
                    state = '$family_state',
                    city = '$family_city',
                    country = '$family_country'
                  WHERE userid = '$userid'";
    mysqli_query($con, $sql_family);

    // --- 8. Hobbies & Interest Update ---
    mysqli_query($con, "INSERT IGNORE INTO hobbies_info (userid) VALUES ('$userid')");

    $hobbies = mysqli_real_escape_string($con, $_POST['hobbies']);
    $music = mysqli_real_escape_string($con, $_POST['music']);
    $sports = mysqli_real_escape_string($con, $_POST['sports']);
    $food = mysqli_real_escape_string($con, $_POST['food']);

    $sql_hobbies = "UPDATE hobbies_info SET 
                        hobbies = '$hobbies',
                        music = '$music',
                        sports = '$sports',
                        food = '$food'
                      WHERE userid = '$userid'";
    mysqli_query($con, $sql_hobbies);
mysqli_query($con, "INSERT IGNORE INTO partner_info (userid) VALUES ('$userid')");

    // --- 9. Partner Preferences Update ---
    $partnerage = mysqli_real_escape_string($con, $_POST['partnerage']);
    $partnerheight = mysqli_real_escape_string($con, $_POST['partnerheight']);
    $partnermarital = mysqli_real_escape_string($con, $_POST['partnermarital']);
    $partnereating = mysqli_real_escape_string($con, $_POST['partnereating']);
    $partnerdrinking = mysqli_real_escape_string($con, $_POST['partnerdrinking']);
    $partnersmoking = mysqli_real_escape_string($con, $_POST['partnersmoking']);
    $partnerreligion = mysqli_real_escape_string($con, $_POST['partnerreligion']);
    $partnercaste = mysqli_real_escape_string($con, $_POST['partnercaste']);
    $partnermanglik = mysqli_real_escape_string($con, $_POST['partnermanglik']);
    $partnerstream = mysqli_real_escape_string($con, $_POST['partnerstream']);
    $partnereducation = mysqli_real_escape_string($con, $_POST['partnereducation']);
    $partnercollege = mysqli_real_escape_string($con, $_POST['partnercollege']);
    $partnerprofession = mysqli_real_escape_string($con, $_POST['partnerprofession']);
    $partnerdomain = mysqli_real_escape_string($con, $_POST['partnerdomain']);
    $partnerdesignation = mysqli_real_escape_string($con, $_POST['partnerdesignation']);
    $partneremployername = mysqli_real_escape_string($con, $_POST['partneremployername']);
    $partnerincome = mysqli_real_escape_string($con, $_POST['partnerincome']);
    $partnerstate = mysqli_real_escape_string($con, $_POST['partnerstate']);
    $partnercity = mysqli_real_escape_string($con, $_POST['partnercity']);
    $partnercountry = mysqli_real_escape_string($con, $_POST['partnercountry']);

    $sql_partner = "UPDATE partner_info SET 
                        partnerage = '$partnerage',
                        partnerheight = '$partnerheight',
                        partnermarital = '$partnermarital',
                        partnereating = '$partnereating',
                        partnerdrinking = '$partnerdrinking',
                        partnersmoking = '$partnersmoking',
                        partnerreligion = '$partnerreligion',
                        partnercaste = '$partnercaste',
                        partnermanglik = '$partnermanglik',
                        partnerstream = '$partnerstream',
                        partnereducation = '$partnereducation',
                        partnercollege = '$partnercollege',
                        partnerprofession = '$partnerprofession',
                        partnerdomain = '$partnerdomain',
                        partnerdesignation = '$partnerdesignation',
                        partneremployername = '$partneremployername',
                        partnerincome = '$partnerincome',
                        partnerstate = '$partnerstate',
                        partnercity = '$partnercity',
                        partnercountry = '$partnercountry'
                      WHERE userid = '$userid'";
    mysqli_query($con, $sql_partner);

    // --- 10. Contact Details Update ---
    $phonenumber = mysqli_real_escape_string($con, $_POST['phonenumber']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $contactperson = mysqli_real_escape_string($con, $_POST['contactperson']);
    $relationship = mysqli_real_escape_string($con, $_POST['relationship']);

    $sql_contact = "UPDATE contact_info SET 
                        phonenumber = '$phonenumber',
                        email = '$email',
                        contactperson = '$contactperson',
                        relationship = '$relationship'
                      WHERE userid = '$userid'";
    mysqli_query($con, $sql_contact);


    // --- 11. Photo Management ---
    // (Yeh aapka original code hai, jo sahi hai)
    
    // Function to handle photo upload
    function handlePhotoUpload($file_input_name, $userid, $column_name, $con) {
        if (isset($_FILES[$file_input_name]) && $_FILES[$file_input_name]['error'] == 0) {
            // Sanitize file name
            $file_info = pathinfo($_FILES[$file_input_name]["name"]);
            $safe_filename = preg_replace("/[^a-zA-Z0-9._-]/", "", $file_info['filename']);
            $s1 = time() . '_' . $safe_filename . '.' . $file_info['extension'];
            
            $s11 = $_FILES[$file_input_name]["tmp_name"];
            $sd1 = move_uploaded_file($s11, "../userphoto/" . $s1);
            
            if($sd1) {
                $sql_photo = "UPDATE photos_info SET $column_name = '$s1' WHERE userid = '$userid'";
                mysqli_query($con, $sql_photo);
            }
        }
    }

    // Function to handle photo delete
    function handlePhotoDelete($checkbox_name, $userid, $column_name, $con) {
        if (isset($_POST[$checkbox_name]) && $_POST[$checkbox_name] == '1') {
            
            // Optional: Delete file from server
            $sql_get = "SELECT $column_name FROM photos_info WHERE userid = '$userid'";
            $result_get = mysqli_query($con, $sql_get);
            if($row_get = mysqli_fetch_assoc($result_get)) {
                $filename_to_delete = $row_get[$column_name];
                if (!empty($filename_to_delete) && file_exists("../userphoto/" . $filename_to_delete)) {
                    unlink("../userphoto/" . $filename_to_delete);
                }
            }
            
            $sql_delete = "UPDATE photos_info SET $column_name = '' WHERE userid = '$userid'";
            mysqli_query($con, $sql_delete);
        }
    }

    // Handle Profile Pic
    handlePhotoDelete('delete_profilepic', $userid, 'profilepic', $con);
    handlePhotoUpload('profilepic', $userid, 'profilepic', $con);

    // Handle Photo 1
    handlePhotoDelete('delete_photo1', $userid, 'photo1', $con);
    handlePhotoUpload('photo1', $userid, 'photo1', $con);
    
    // Handle Photo 2
    handlePhotoDelete('delete_photo2', $userid, 'photo2', $con);
    handlePhotoUpload('photo2', $userid, 'photo2', $con);

    // Handle Photo 3
    handlePhotoDelete('delete_photo3', $userid, 'photo3', $con);
    handlePhotoUpload('photo3', $userid, 'photo3', $con);

    // Redirect back to the profile page
    header('Location: userprofile-view.php?uid=' . $userid . '&status=updated');
    exit;

} else {
    echo "Invalid request.";
}
?>