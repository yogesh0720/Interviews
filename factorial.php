<?php

// function factorial($args)
// {
//     if ($args < 0) {
//         return "Not correct number of arguments\n";
//     }
//     $factorial = 1;
//     for ($i = $args; $i >= 1; $i--) {
//         $factorial = ($factorial * $i);
//     }
//     return $factorial;
// }
function factorial($n)
{
    if ($n <= 1) {
        return 1;
    } else {
        return $n * factorial($n - 1);
    }
}
$input = -1;
var_dump(factorial($input));
//1*2*3*4*5;
//0
