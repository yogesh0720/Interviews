<?php

// Anonymous Functions in PHP

$hello = function ($string) {
    return "Hello $string!\n";
};

echo $hello("Yogesh");


// Closures in PHP
$message = "WELCOME";
$hello = function ($string) use ($message) {
    return "$message, $string!\n";
};

echo $hello("Yogesh nayi");
