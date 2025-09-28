<?php
//bubble sort
$array = [3, 6, 6, 6, 1, 9, 2];

function bubbleSort(array $array, int $order = 1): array
{
    $n = count($array);

    for ($i = 0; $i < $n; $i++) {
        for ($j = 0; $j < $n - 1; $j++) {
            if ($order === 1 && $array[$j] > $array[$j + 1]) {
                [$array[$j], $array[$j + 1]] = [$array[$j + 1], $array[$j]];
            } elseif ($order === 2 && $array[$j] < $array[$j + 1]) {
                [$array[$j], $array[$j + 1]] = [$array[$j + 1], $array[$j]];
            }
        }
    }
    return $array;
}

print_r(bubbleSort($array, 1)); // Ascending: [1, 2, 3, 6, 6, 6, 9]
print_r(bubbleSort($array, 2)); // Descending: [9, 6, 6, 6, 3, 2, 1]

//selection sort
function selectionSort(array $array, int $order = 1): array
{
    $n = count($array);

    for ($i = 0; $i < $n; $i++) {
        for ($j = $i + 1; $j < $n; $j++) {
            if ($order === 1 && $array[$i] > $array[$j]) { // Ascending
                [$array[$i], $array[$j]] = [$array[$j], $array[$i]];
            } elseif ($order === 2 && $array[$i] < $array[$j]) { // Descending
                [$array[$i], $array[$j]] = [$array[$j], $array[$i]];
            }
        }
    }
    return $array;
}
print_r(selectionSort($array, 1)); // Ascending: [1, 2, 3, 6, 6, 9]
print_r(selectionSort($array, 2)); // Descending: [9, 6, 6, 3, 2, 1]
