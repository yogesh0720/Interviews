<?php

class Polymorphism
{
    function operation($x, $y)
    {
        //addition
        return ($x + $y);
    }
}

class Multiplication extends Polymorphism
{
    function operation($x, $y)
    {
        //multiply
        return ($x * $y);
    }
}

$multiply = new Multiplication();
var_dump($multiply->operation(4, 5));
