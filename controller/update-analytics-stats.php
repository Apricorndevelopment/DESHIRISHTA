<?php
include 'config.php'; // $con variable ko include karega

// Check karein ki form submit hua hai ya nahi
if(isset($_POST['submit'])) {

    // Form se values lein
    $couples = mysqli_real_escape_string($con, $_POST['couples_paired']);
    $registrants = mysqli_real_escape_string($con, $_POST['total_registrants']);
    $men = mysqli_real_escape_string($con, $_POST['total_men']);
    $women = mysqli_real_escape_string($con, $_POST['total_women']);

    // Database update query
    $sql = "UPDATE tbl_homepage_stats SET 
              couples_paired = '$couples', 
              total_registrants = '$registrants', 
              total_men = '$men', 
              total_women = '$women' 
            WHERE id = '1'";

    // Query ko run karein
    if (mysqli_query($con, $sql)) {
        // Query successful hui, success message aur redirect code show karein
        echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="refresh" content="5;url=analytics-stats.php">
            <title>Update Successful</title>
            <style>
                body { font-family: Arial, sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #f4f4f4; margin: 0; }
                .message-box { padding: 30px; border: 1px solid #4CAF50; background-color: #dff0d8; color: #3c763d; border-radius: 8px; text-align: center; font-size: 1.2em; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
                .message-box h3 { margin-top: 0; color: #4CAF50; }
            </style>
        </head>
        <body>
            <div class="message-box">
                <h3>Updated Successfully!</h3>
                <p>Redirecting back in 5 seconds...</p>
            </div>
            
            <script>
                // JavaScript se 5 second baad redirect
                setTimeout(function() {
                    window.location.href = "analytics-stats.php";
                }, 5000); // 5000 milliseconds = 5 seconds
            </script>
        </body>
        </html>
        ';

    } else {
        // Agar error aaye, toh error dikhayein
        echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Update Error</title>
            <style>
                body { font-family: Arial, sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #f4f4f4; margin: 0; }
                .message-box { padding: 30px; border: 1px solid #f44336; background-color: #f2dede; color: #a94442; border-radius: 8px; text-align: center; font-size: 1.2em; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
                .message-box h3 { margin-top: 0; color: #f44336; }
            </style>
        </head>
        <body>
            <div class="message-box">
                <h3>Error updating record!</h3>
                <p>' . mysqli_error($con) . '</p>
                <br>
                <a href="analytics-stats.php">Click here to go back</a>
            </div>
        </body>
        </html>
        ';
    }

} else {
    // Agar koi form direct access kare, toh wapas bhej dein
    header("Location: analytics-stats.php");
    exit();
}
?>