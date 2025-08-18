<?php
class SingleTon
{
    private static ?SingleTon $instance = null;

    // Private constructor prevents direct instantiation
    private function __construct() {}

    public static function getInstance(): SingleTon
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}

// Usage
$obj1 = SingleTon::getInstance();
$obj2 = SingleTon::getInstance();

var_dump($obj1 === $obj2); // true ✅
