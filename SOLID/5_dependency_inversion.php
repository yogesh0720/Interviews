<?php

/**
 * D – Dependency Inversion Principle (DIP)
 * 
 * WHEN TO USE:
 * - When building scalable systems
 * - When dependencies may change (DB, API, services)
 * - When writing testable code
 * 
 * WHY TO USE:
 * - Reduce tight coupling
 * - Enable easy replacement, testing, and mocking
 * - High-level modules shouldn't depend on low-level modules
 */

// ❌ BAD: Tightly coupled to concrete implementation
class MySQLDatabaseBad
{
    public function connect()
    {
        echo "Connected to MySQL\n";
    }
}

class UserServiceBad
{
    private $db;

    public function __construct()
    {
        $this->db = new MySQLDatabaseBad(); // Hard dependency
    }
}

// ✅ GOOD: Depend on abstractions
interface Database
{
    public function connect();
    public function save($data);
    public function find($id);
}

class MySQLDatabase implements Database
{
    public function connect()
    {
        echo "Connected to MySQL\n";
    }

    public function save($data)
    {
        echo "Saving to MySQL: $data\n";
    }

    public function find($id)
    {
        echo "Finding in MySQL: $id\n";
        return "user_data_$id";
    }
}

class PostgreSQLDatabase implements Database
{
    public function connect()
    {
        echo "Connected to PostgreSQL\n";
    }

    public function save($data)
    {
        echo "Saving to PostgreSQL: $data\n";
    }

    public function find($id)
    {
        echo "Finding in PostgreSQL: $id\n";
        return "user_data_$id";
    }
}

class UserService
{
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db; // Depends on abstraction
        $this->db->connect();
    }

    public function createUser($userData)
    {
        $this->db->save($userData);
    }

    public function getUser($id)
    {
        return $this->db->find($id);
    }
}

// Usage: Easy to switch databases
$mysqlDb = new MySQLDatabase();
$userService1 = new UserService($mysqlDb);
$userService1->createUser("John Doe");

echo "\n--- Switching to PostgreSQL ---\n\n";

$postgresDb = new PostgreSQLDatabase();
$userService2 = new UserService($postgresDb);
$userService2->createUser("Jane Smith");
