<?php
// function testFibonacci($numbers)
// {
//     $f1 = 0;
//     $f2 = 1;
//     echo $f1 . "\n";
//     echo $f2 . "\n";
//     for ($i = 1; $i < $numbers; $i++) {
//         $f3 = $f1 + $f2;
//         $f1 = $f2;
//         $f2 = $f3;
//         echo $f3 . "\n";
//     }
// }

function testFibonacci($numbers)
{
    if ($numbers == 0) {
        return 0;
    } else if ($numbers == 1) {
        return 1;
    } else {
        return (testFibonacci($numbers - 1) + testFibonacci($numbers - 2));
    }
}
for ($i = 1; $i < 10; $i++) {
    echo testFibonacci($i) . "\n";
}
