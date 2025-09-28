<?php
/*function flattenArray(array $input): array
{
    $result = [];
    array_walk_recursive($input, function ($item) use (&$result) {
        $result[] = $item;
    });
    return $result;
}
*/

/*
function flattenArrayYield(array $array): Generator
{
    foreach ($array as $item) {
        if (is_array($item)) {
            yield from flattenArrayYield($item); // recursive yield
        } else {
            yield $item;
        }
    }
}

// Usage
$data = [1, [2, [3, 4], 5], 6];

foreach (flattenArrayYield($data) as $value) {
    echo $value . " ";
}
*/

// Alternative: recursive custom logic
function flattenArrayRecursive(array $input): array
{
    $result = [];
    foreach ($input as $value) {
        if (is_array($value)) {
            $result = array_merge($result, flattenArrayRecursive($value));
        } else {
            $result[] = $value;
        }
    }
    return $result;
}

// Example
$input = [1, [2, 3, [4, 5]], 6];
$input = [1, [2, 3, [4, 5]], 6, [7, [8, 9], 10, [11, 12, [13, [[14, 15]]]]]];
print_r(flattenArrayRecursive($input));

// Array
// (
//     [0] => 1
//     [1] => 2
//     [2] => 3
//     [3] => 4
//     [4] => 5
//     [5] => 6
// )

// Array
// (
//     [0] => 1
//     [1] => 2
//     [2] => 3
//     [3] => 4
//     [4] => 5
//     [5] => 6
//     [6] => 7
//     [7] => 8
//     [8] => 9
//     [9] => 10
//     [10] => 11
//     [11] => 12
//     [12] => 13
//     [13] => 14
//     [14] => 15
// )
