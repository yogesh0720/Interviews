<?php
//bubble sort
$array = [3, 6, 6, 6, 1, 9, 2];

function sortArr($array, $order)
{
    for ($i = 0; $i < count($array); $i++) {
        for ($j = 0; $j < count($array) - 1; $j++) {
            if ($order == 1 && $array[$j] > $array[$j + 1]) {
                $temp = $array[$j + 1];
                $array[$j + 1] = $array[$j];
                $array[$j] = $temp;
            } elseif ($order == 2 && $array[$j] < $array[$j + 1]) {
                $temp = $array[$j + 1];
                $array[$j + 1] = $array[$j];
                $array[$j] = $temp;
            }
        }
    }
    return $array;
}

//var_dump(sortArr($array, 1));

//selection sort
function sortArr1($array, $order)
{
    for ($i = 0; $i < count($array); $i++) {
        for ($j = $i + 1; $j < count($array); $j++) {
            if ($array[$i] > $array[$j]) {
                $temp = $array[$i];
                $array[$i] = $array[$j];
                $array[$j] = $temp;
            }
        }
    }
}
var_dump(sortArr1($array, 1));
