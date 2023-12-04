<?php
class SingleTon 
{
    private static $instance;

    public static function getInstance(){

        if(!isset(self::$instance) && self::$instance == null){            
            self::$instance = new static();
        }
        return self::$instance;
    }
}

//$obj1 = (new SingleTon())->getInstance();
//$obj2 = (new SingleTon())->getInstance();
$obj1 = (new SingleTon())::getInstance();
$obj2 = (new SingleTon())::getInstance();

var_dump($obj1 == $obj2);
