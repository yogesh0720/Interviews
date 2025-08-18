<?php
// 1. Function to encode (create) JWT
function create_jwt(array $payload, string $secret, string $algo = 'HS256'): string
{
    $header = ['typ' => 'JWT', 'alg' => $algo];

    // base64UrlEncode (instead of normal base64)
    $base64UrlHeader  = rtrim(strtr(base64_encode(json_encode($header)), '+/', '-_'), '=');
    $base64UrlPayload = rtrim(strtr(base64_encode(json_encode($payload)), '+/', '-_'), '=');

    // signature
    $signature = hash_hmac('sha256', "$base64UrlHeader.$base64UrlPayload", $secret, true);
    $base64UrlSignature = rtrim(strtr(base64_encode($signature), '+/', '-_'), '=');

    return "$base64UrlHeader.$base64UrlPayload.$base64UrlSignature";
}

// 2. Function to decode (verify) JWT
function verify_jwt(string $jwt, string $secret): ?array
{
    $parts = explode('.', $jwt);
    if (count($parts) !== 3) {
        return null; // invalid format
    }

    [$header, $payload, $signature] = $parts;

    // verify signature
    $validSignature = rtrim(strtr(base64_encode(
        hash_hmac('sha256', "$header.$payload", $secret, true)
    ), '+/', '-_'), '=');

    if (!hash_equals($validSignature, $signature)) {
        return null; // invalid signature
    }

    // decode payload
    return json_decode(base64_decode(strtr($payload, '-_', '+/')), true);
}

// ----------------------------
// Example Usage
// ----------------------------
$secret = "mysecret123";

// create token
$payload = [
    "user_id" => 101,
    "name" => "Yogesh",
    "exp" => time() + 3600 // expires in 1 hour
];

$jwt = create_jwt($payload, $secret);
echo "JWT: " . $jwt . "\n\n";

// verify token
$decoded = verify_jwt($jwt, $secret);

if ($decoded && $decoded['exp'] > time()) {
    echo "Valid Token ✅\n";
    print_r($decoded);
} else {
    echo "Invalid or Expired Token ❌\n";
}

// JWT: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...
// Valid Token ✅
// Array
// (
//     [user_id] => 101
//     [name] => Yogesh
//     [exp] => 1691745247
// )
