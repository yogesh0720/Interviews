<?php
### Question ## alice@example.com' OR '1'='1


$email = $_GET['email'];               // e.g. ?email=alice@example.com
$pdo = new PDO('mysql:host=localhost;dbname=mydb', 'user', 'pass');

$sql = "SELECT id, name, email, role FROM users WHERE email = '$email' LIMIT 1";
$stmt = $pdo->query($sql);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
print_r($user);


### SOLUTIONS ####
$email = $_GET['email'] ?? '';
$pdo = new PDO('mysql:host=localhost;dbname=mydb;charset=utf8mb4', 'user', 'pass', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);

// Use a prepared statement with a bound parameter
$stmt = $pdo->prepare('SELECT id, name, email, role FROM users WHERE email = :email LIMIT 1');
$stmt->execute([':email' => $email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    print_r($user);
} else {
    echo "User not found";
}
