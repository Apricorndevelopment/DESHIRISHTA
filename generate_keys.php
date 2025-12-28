<?php
// XAMPP ke liye OpenSSL Config path set karein
$configPath = 'C:\xampp\apache\conf\openssl.cnf'; // Check karein ye path sahi hai ya nahi
if (file_exists($configPath)) {
    putenv("OPENSSL_CONF=$configPath");
} else {
    // Agar upar wala path na mile, toh ye wala try karein
    putenv("OPENSSL_CONF=C:\xampp\php\extras\ssl\openssl.cnf");
}

require 'vendor/autoload.php';

use Minishlink\WebPush\VAPID;

try {
    // Keys generate karein
    $keys = VAPID::createVapidKeys();

    echo "<h3>VAPID Keys Generated Successfully</h3>";
    echo "<strong>Subject:</strong> mailto:admin@desirishta.com<br><br>";
    echo "<strong>Public Key:</strong> " . $keys['publicKey'] . "<br><br>";
    echo "<strong>Private Key:</strong> " . $keys['privateKey'] . "<br>";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>