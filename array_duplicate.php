<?php

//find the array have duplicates or not
$array = [1, 2, 2, 3, 3, 4, 5, 5]; // 2,3,5
// $d = array_diff_assoc($array, array_unique($array));
//print_r($d);
$result = [];
foreach ($array as $key => $value) {
    unset($array[$key]);
    if (in_array($value, $array)) {
        $result[$key] = $value;
    }
}
print_r(array_values($result));



//remove duplicates
// $new = [];
// foreach ($array as $key) {
//     $new[$key] = $key;
// }
// print_r($new);
