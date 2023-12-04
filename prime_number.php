<?php
//check the prime number
//A Prime number is a natural number greater than 1 and divisible by 1 
//and itself only, for example: 2, 3, 5, 7, etc.

$num = 3;
$n = 0;
for ($i = 2; $i < $num; $i++) {
    if ($num % 2 == 0) {
        $n++;
        break;
    }
}
echo $n == 0 ? "Prime" : "Not prime";
