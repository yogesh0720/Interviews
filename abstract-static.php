<?php
/*
    Static Abstract Method → Defined in interface/abstract class, forces implementing class to provide a static method.
*/

interface DBFactory
{
    public static function create();
}

class MySQLFactory implements DBFactory
{
    public static function create(): \PDO
    {
        return new \PDO("mysql:host=localhost;dbname=testdb;charset=utf8mb4", "root", "");
    }
}

class SQLiteFactory implements DBFactory
{
    public static function create(): \PDO
    {
        return new \PDO("sqlite::memory:");
    }
}

// Usage
$mysql = MySQLFactory::create();
$sqlite = SQLiteFactory::create();

echo "MySQL connection: " . get_class($mysql) . PHP_EOL;
echo "SQLite connection: " . get_class($sqlite) . PHP_EOL;

//MySQL connection: PDO
//SQLite connection: PDO
