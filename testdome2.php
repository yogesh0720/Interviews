<?php

function findRoots($a, $b, $c)
{
    // $equation = '';
    // $root = '';
    // //2x2 10x+8 = 0 are -1 and -4;
    // $temp = $b*$b - 4*$a*$c;

    // if($temp >= 0){
    //     $x = (- $b+sqrt($temp)) / (2*$a);
    //     $y = (-$b - sqrt($temp)) / (2*$a);
    //     $equation = "Equation is x*x+".$b."x+".$c."=0";
    //     $root = "Roots are: $x, $y ";        
    // } else {       
    //     $x = (- $b / (2*$a));
    //     $y = (sqrt(-$temp)) / (2*$a);
    //     $equation = "Equation is x*x+".$b."x+".$c."=0";
    //     $root = "Roots are: ".$x." ± ".$y. " i";  
    // }
    // return [$equation, $root];
    $delta = ($b * $b) - 4 * ($a * $c);
    $x = (-$b - sqrt($delta)) / (2 * $a);
    $y = (-$b + sqrt($delta)) / (2 * $a);
    return [$x, $y];
}

print_r(findRoots(2, 10, 8));
print_r(findRoots(1, 5, 4));
print_r(findRoots(1, 4, 5));
