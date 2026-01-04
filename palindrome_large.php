<?php

function largestPalindrome($start, $end)
{
    $palindrome = 0;
    for ($i = $start; $i <= $end; $i++) {
        for ($j = $start; $j <= $end; $j++) {
            $x = $i * $j;
            if ($x > $palindrome && $x == strrev($x)) {
                $palindrome = $x;
            }
        }
    }
    return $palindrome;
}

echo largestPalindrome(200, 999);
