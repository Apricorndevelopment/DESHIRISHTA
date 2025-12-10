<?php
include 'config.php'; // Database connection: $con

// 1. Set Headers for CSV Download
$filename = "All_User_Details_" . date('Ymd_His') . ".csv";
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="' . $filename . '"');

// Output stream for the CSV
$output = fopen('php://output', 'w');

// 2. Define CSV Headers (Column Names)
$header_row = array(
    'UserID', 'Name', 'Email', 'Phone', 'Join Date', 'Profile Status', 'ID Status',
    
    // Basic Info
    'Profile Created By', 'Password', 'Gender', 'Marital Status', 'Has Children', 'Age', 'Height', 'Weight', 'Disability', 'Language', 'Eating', 'Smoking', 'Drinking', 'About Me',
    
    // Astro Info
    'DOB', 'Birth Place', 'Birth Time', 'Dosh/Manglik',
    
    // Religious Info
    'Religion', 'Caste', 'Gothram', 'Sub-Caste',
    
    // Education & Career
    'Stream', 'Highest Education', 'College', 'Working With', 'Profession', 'Designation', 'Profession Detail', 'Employer Name', 'Annual Income',
    
    // Current Location (from groom_location)
    'Country', 'Citizenship', 'Resident Status', 'State', 'City',
    
    // Family Info
    'Family Value', 'Family Type', 'Family Status', 'Native Place', 'Father Name', 'Mother Name', 'Father Occupation', 'Mother Occupation', 'Brothers', 'Brothers Married', 'Sisters', 'Sisters Married', 'Family Location', 'Family State', 'Family City', 'Family Country',
    
    // Hobbies
    'Hobbies', 'Music', 'Sports', 'Food',
    
    // Partner Preferences
    'P.Age', 'P.Height', 'P.Marital', 'P.Eating', 'P.Drinking', 'P.Smoking', 'P.Religion', 'P.Caste', 'P.Manglik', 'P.Stream', 'P.Education', 'P.College', 'P.Profession', 'P.Domain', 'P.Designation', 'P.Employer', 'P.Income', 'P.State', 'P.City', 'P.Country'
);

// Write the header row to the CSV file
fputcsv($output, $header_row);

// 3. SQL Query: Join all relevant tables
$sql = "
    SELECT 
        r.userid, r.name, r.email, r.phone, r.entrydate, r.profilestatus, r.verificationinfo, r.password,
        bi.*, ai.*, ri.*, ei.*, gl.*, fi.*, hi.*, pi.*
    FROM 
        registration r
    LEFT JOIN basic_info bi ON r.userid = bi.userid
    LEFT JOIN astro_info ai ON r.userid = ai.userid
    LEFT JOIN religious_info ri ON r.userid = ri.userid
    LEFT JOIN education_info ei ON r.userid = ei.userid
    LEFT JOIN groom_location gl ON r.userid = gl.userid
    LEFT JOIN family_info fi ON r.userid = fi.userid
    LEFT JOIN hobbies_info hi ON r.userid = hi.userid
    LEFT JOIN partner_info pi ON r.userid = pi.userid
    ORDER BY r.id DESC
";

$result = mysqli_query($con, $sql);

if ($result) {
    // 4. Loop through data and write to CSV
    while ($row = mysqli_fetch_assoc($result)) {
        
        // Map status codes to human-readable strings
        $profile_status = '';
        switch ($row['profilestatus']) {
            case '0': $profile_status = 'Pending'; break;
            case '1': $profile_status = 'Approved'; break;
            case '2': $profile_status = 'Deactivated'; break;
            case '3': $profile_status = 'Deleted'; break;
            default: $profile_status = 'N/A'; break;
        }

        // Create the data row array in the same order as the headers
        $data_row = array(
            $row['userid'], 
            $row['name'], 
            $row['email'], 
            $row['phone'], 
            date('Y-m-d', strtotime($row['entrydate'])), 
            $profile_status, 
            $row['verificationinfo'],
            
            // Basic Info
            $row['createby'], $row['password'], $row['gender'], $row['marital'], $row['children'], $row['age'], $row['height'], $row['weight'], $row['physical'], $row['langauge'], $row['eating'], $row['smoking'], $row['drinking'], $row['aboutme'],
            
            // Astro Info
            $row['dob'], $row['birthplace'], $row['birthtime'], $row['manglik'],
            
            // Religious Info
            $row['religion'], $row['caste'], $row['gothram'], $row['subcaste'],
            
            // Education & Career
            $row['stream'], $row['education'], $row['college'], $row['workingwith'], $row['profession'], $row['designation'], $row['professiondetail'], $row['employername'], $row['income'],
            
            // Current Location
            $row['country'], $row['citizenship'], $row['resident'], $row['state'], $row['city'],
            
            // Family Info
            $row['familyvalue'], $row['familytype'], $row['familystatus'], $row['nativeplace'], $row['fathername'], $row['mothername'], $row['fatheroccupation'], $row['motheroccupation'], $row['brothers'], $row['bromarried'], $row['sisters'], $row['sismarried'], $row['familylocation'], $row['family_state'], $row['family_city'], $row['family_country'],
            
            // Hobbies
            $row['hobbies'], $row['music'], $row['sports'], $row['food'],
            
            // Partner Preferences
            $row['partnerage'], $row['partnerheight'], $row['partnermarital'], $row['partnereating'], $row['partnerdrinking'], $row['partnersmoking'], $row['partnerreligion'], $row['partnercaste'], $row['partnermanglik'], $row['partnerstream'], $row['partnereducation'], $row['partnercollege'], $row['partnerprofession'], $row['partnerdomain'], $row['partnerdesignation'], $row['partneremployername'], $row['partnerincome'], $row['partnerstate'], $row['partnercity'], $row['partnercountry']
        );
        
        fputcsv($output, $data_row);
    }
}

// Close the output stream
fclose($output);
exit;
?>