<?php

$students = [
    ["name" => "Amar",  "percentage" => 91, "rank" => 1, "passed" => true],
    ["name" => "Krisha", "percentage" => 88, "rank" => 2, "passed" => true],
    ["name" => "Ravi",  "percentage" => 82, "rank" => 3, "passed" => true],
    ["name" => "Priya", "percentage" => 69, "rank" => 4, "passed" => true],
    ["name" => "John",  "percentage" => 32, "rank" => 0, "passed" => false],
    ["name" => "Alex",  "percentage" => 41, "rank" => 0, "passed" => false],
];

// Task: write
function sortByRank($students)
{
    $sorted = $students;
    usort($sorted, fn($a, $b) => ($a['rank'] ?: PHP_INT_MAX) <=> ($b['rank'] ?: PHP_INT_MAX));
    return $sorted;
}

var_dump(sortByRank($students));
