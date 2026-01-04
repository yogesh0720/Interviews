<?php

class SingleTon
{
    private static ?SingleTon $instance = null;

    // Private constructor prevents direct instantiation
    private function __construct()
    {
        throw new \Exception("Cannot instantiate SingleTon directly");
    }

    private function __clone()
    {
        throw new \Exception("Cannot clone instance of SingleTon");
    }

    private function __wakeup()
    {
        throw new \Exception("Cannot unserialize instance of SingleTon");
    }

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

final class Logger
{
    private static ?Logger $instance = null;

    private function __construct()
    {
        throw new \Exception("Cannot instantiate Logger directly");
    }

    public static function getInstance(): Logger
    {
        return self::$instance ??= new self();
    }

    public function log(string $msg): void
    {
        echo $msg;
    }
}

// Usage
$obj11 = Logger::getInstance();
$obj22 = Logger::getInstance();

var_dump($obj11 === $obj22); // true ✅
