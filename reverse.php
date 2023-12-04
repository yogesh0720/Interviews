<?php
$str = '12345';
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
