<?php
$str = 'नमस्ते';
//echo strrev($str);
//print_r($strArray);
//$revArr = array_reverse($strArray);
//print_r($revArr);

for ($i = strlen($str) - 1; $i >= 0; $i--) {
    echo $str[$i] . "\n";
}

//array.
$srtA = [1, 3, 5, 7, 9, 11];
$result = [];
for ($i = count($srtA) - 1; $i >= 0; $i--) {
    $result[] = $srtA[$i];
}
print_r($result);


// $new = [];
// for ($i = $count - $i; $i >= 0; $i--) {
//     var_dump($array[$i]);
//     $new[] = $i;
// }
// print_r($new);

$array = [
    "a" => 1,
    "b" => 2,
    "c" => 3,
    "d" => 4
];
$count = count($array);
$reversed = [];
$keys = array_keys($array);
$values = array_values($array);
for ($i = $count - $i; $i >= 0; $i--) {
    $key = $keys[$i];
    $value = $values[$i];
    $reversed[$key] = $value;
}
print_r($reversed);
