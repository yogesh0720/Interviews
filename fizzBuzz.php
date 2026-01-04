<?php

/*
    Print number 1 to 50.
    If number is a multiplier of 3, print Fizz.
    If it's multiplier of 5, print Buzz.
    If it's a multiplier of both print FizzBuzz.
*/
$number = 50;
printFizzBuzz($number);
function printFizzBuzz($number)
{
    $count3 = 0;
    $count5 = 0;
    for ($i = 1; $i <= $number; $i++) {
        $count3++;
        $count5++;
        $flag = false;

        if ($count3 == 3) {
            echo $i . "Fizz";
            $count3 = 0;
            $flag = true;
        }
        if ($count5 == 5) {
            echo $i . "Buzz";
            $count5 = 0;
            $flag = true;
        }
        if (!$flag) {
            echo $i;
        }
        echo "\n";
    }
}


/*
    Print number 1 to 50.
    If number is a divisible of 3, print Fizz.
    If it's divisible of 5, print Buzz.
    If it's a divisible of both print FizzBuzz.
*/
// function printFizzBuzz($number)
// {
//     for ($i = 1; $i <= $number; $i++) {
//         if (($i % 3) == 0 && ($i % 5) == 0) {
//             echo $i . "FizzBuzz\n";
//         } elseif (($i % 3) == 0) {
//             echo $i . "Fizz\n";
//         } elseif (($i % 5) == 0) {
//             echo $i . "Buzz\n";
//         }
//     }
// }
