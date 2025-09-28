<?php

/**
 * 
 * Use PHP string functions only (preg_match_all, substr, etc.)
 * Do not use loops to manually parse character by character.
 * 
 **/

function splitAlphaNumeric(string $str): array
{
    // Match consecutive letters or digits
    preg_match_all('/[a-zA-Z]+|\d+/', $str, $matches);
    return $matches[0];
}

// Example usage
$input = "abcd123def456ghi789";
$result = splitAlphaNumeric($input);
print_r($result);


// Input:  "abc123def456ghi789"
// Output: ["abc", "123", "def", "456", "ghi", "789"]

// Array
// (
//     [0] => abc
//     [1] => 123
//     [2] => def
//     [3] => 456
//     [4] => ghi
//     [5] => 789
// )
