<?php
// Simple script to test SMTP Provider Token validity

// 1. Define Token and Endpoint
// Note: Changed URL from dashboard to app based on 301 error and previous files
$token = '4b2e12b43338e42361077cb6516ad63e';
$url = 'https://app.smtpprovider.com/api/send-mail/'; 

// 2. Prepare Test Data
$test_payload = [
    'to' => 'test@example.com', // You can change this to your real email to see if it arrives
    'from' => 'info@noreply-duastro.com',
    'from_name' => 'Token Test',
    'subject' => 'Token Verification Test',
    'body' => 'This is a test email to verify the API token.',
    'token' => $token
];

// 3. Initialize cURL
$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode($test_payload), 
    CURLOPT_HTTPHEADER => ['Content-Type: application/json', 'Accept: application/json'],
    CURLOPT_SSL_VERIFYPEER => false, // Disable SSL verification for testing
    CURLOPT_SSL_VERIFYHOST => 0,      // Disable Host verification for testing
    CURLOPT_FOLLOWLOCATION => true    // Follow redirects
]);

// 4. Execute Request
echo "<h2>Testing Token: $token</h2>";
echo "<p>Sending request to: $url</p>";

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$redirect_url = curl_getinfo($ch, CURLINFO_REDIRECT_URL);
$error = curl_error($ch);

curl_close($ch);

// 5. Display Results
echo "<h3>Result:</h3>";

if ($error) {
    echo "<p style='color:red;'><strong>cURL Error:</strong> $error</p>";
} else {
    echo "<p><strong>HTTP Status Code:</strong> $http_code</p>";
    if($redirect_url) {
        echo "<p><strong>Redirected To:</strong> $redirect_url</p>";
    }
    echo "<p><strong>API Response:</strong></p>";
    echo "<pre style='background:#f4f4f4; padding:10px; border:1px solid #ddd;'>";
    var_dump($response);
    echo "</pre>";
    
    // Check if response contains specific errors
    $json_resp = json_decode($response, true);
    if (isset($json_resp['success']) && $json_resp['success'] == false) {
        echo "<p style='color:red;'><strong>Failed:</strong> " . ($json_resp['data']['message'] ?? 'Unknown Error') . "</p>";
        if(strpos($response, 'User Not Exist') !== false) {
             echo "<p><strong>Tip:</strong> 'User Not Exist' usually means the Token is wrong OR the 'From' email is not registered in the SMTP Dashboard.</p>";
        }
    } elseif (isset($json_resp['success']) && $json_resp['success'] == true) {
        echo "<p style='color:green;'><strong>Success!</strong> The token is valid.</p>";
    } elseif(is_null($json_resp)) {
         echo "<p style='color:orange;'><strong>Warning:</strong> Response is not valid JSON. Check if the URL is correct (HTML response?).</p>";
    }
}
?>