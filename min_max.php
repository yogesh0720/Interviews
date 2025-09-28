<?php
$array = [3, 6, 6, 6, 1, 9, 2];
$count = count($array);

$min = $array[0];
for ($i = 0; $i < $count; $i++) {
    if ($array[$i] < $min) {
        $min = $array[$i];
    }
}
echo "minimum : " . $min . "\n";


$max = $array[0];
for ($i = 0; $i < $count; $i++) {
    if ($array[$i] > $max) {
        $max = $array[$i];
    }
}
echo "Maximum : " . $max . "\n";

$array = [3, 6, 6, 9, 1, 9, 2, 1, 1, 1];
$count = count($array);

$min = $array[0];
$minCount = 0;
for ($i = 0; $i < $count; $i++) {
    if ($array[$i] < $min) {
        $min = $array[$i];
        $minCount = 1;
    } elseif ($array[$i] === $min) {
        $minCount++;
    }
}
echo "minimum : " . $min . " and min value of count: " . ($minCount) . "\n";


$max = $array[0];
$maxCount = 0;
for ($i = 0; $i < $count; $i++) {
    if ($array[$i] > $max) {
        $max = $array[$i];
        $maxCount = 1;
    } else if ($array[$i] === $max) {
        $maxCount++;
    }
}
echo "Maximum : " . $max . " and max value of count: " . ($maxCount) . "\n";



###  With foreach loop ##
// foreach ($array as $value) {
//     if ($value < $min) {
//         $min = $value;
//     }

//     if ($value > $max) {
//         $max = $value;
//     }
// }
// echo "minimum : " . $min . "\n";
// echo "Maximum : " . $max . "\n";
