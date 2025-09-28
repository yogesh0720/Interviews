<?php
/*
    Static Factory Method → A static method (create()) that returns an object, often with a private constructor.
*/

class DBConnection
{
    private static ?\PDO $connection = null;

    // private constructor - prevent direct creation
    private function __construct() {}

    // static factory method
    public static function create(string $dsn, string $user, string $password): \PDO
    {
        if (self::$connection === null) {
            try {
                self::$connection = new \PDO($dsn, $user, $password);
                self::$connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $e) {
                die("DB Connection failed: " . $e->getMessage());
            }
        }
        return self::$connection;
    }
}

// Usage
$dsn = "mysql:host=localhost;dbname=testdb;charset=utf8mb4";
$user = "root";
$password = "";

$db = DBConnection::create($dsn, $user, $password);

// Example query
$stmt = $db->query("SELECT NOW()");
echo "DB Time: " . $stmt->fetchColumn();
