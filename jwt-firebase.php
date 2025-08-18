<?php
require 'vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// Secret key (keep safe, don’t expose!)
$secret = "mySuperSecretKey123";

// ---------------- CREATE TOKEN ----------------
$payload = [
    "user_id" => 101,
    "name" => "Yogesh",
    "iat" => time(),             // issued at
    "exp" => time() + 3600       // expires in 1 hour
];

// Encode payload into JWT
$jwt = JWT::encode($payload, $secret, 'HS256');

echo "JWT: " . $jwt . "\n\n";

// ---------------- VERIFY TOKEN ----------------
try {
    $decoded = JWT::decode($jwt, new Key($secret, 'HS256'));

    echo "Valid Token ✅\n";
    print_r($decoded);
} catch (Exception $e) {
    echo "Invalid Token ❌: " . $e->getMessage();
}


// JWT: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...
// Valid Token ✅
// stdClass Object
// (
//     [user_id] => 101
//     [name] => Yogesh
//     [iat] => 1724060200
//     [exp] => 1724063800
// )
