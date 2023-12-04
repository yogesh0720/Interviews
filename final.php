<?php
class Base
{
    final function operation($x, $y)
    {
        //subtract
        return ($x + $y);
    }
}

class Multiplication extends Base
{
    function operation($x, $y)
    {
        //multiply
        return ($x * $y);
    }
}

$multiply = new Multiplication();
var_dump($multiply->operation(4, 5));
