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
