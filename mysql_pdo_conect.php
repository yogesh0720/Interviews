<?php

$host = '127.0.0.1';
$port = 4406;
$db   = 'interview';
$user = 'root';
$pass = 'interview@pass123';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Throw exceptions on errors
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Fetch associative arrays
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Use real prepared statements
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    echo "✅ Connected successfully!";
} catch (\PDOException $e) {
    echo "❌ Connection failed: " . $e->getMessage();
}
