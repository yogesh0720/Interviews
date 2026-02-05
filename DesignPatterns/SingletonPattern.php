<?php

/*
    3️⃣ Singleton Pattern
    ❓ When to use
    Only one instance needed
    Shared resource
    ⚠️ Warning (Important)
    Singleton is often discouraged in modern PHP because it hurts testing.
    ✅ Acceptable use
    Logger
    Configuration (read-only)
*/

class Logger
{
    private static ?Logger $instance = null;

    private function __construct() {}

    public static function getInstance(): Logger
    {
        return self::$instance ??= new Logger();
    }
}

// 👉 Prefer Dependency Injection over Singleton when possible.
// $logger = new Logger(); // ❌
$logger = Logger::getInstance();
$logger2 = Logger::getInstance();
var_dump($logger === $logger2); // ✅ true
