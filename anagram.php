<?php
function is_anagram($string1, $string2)
{
    echo count_chars($string1, 1) == count_chars($string2, 1) ? "Yes\n" : "No\n";
}

is_anagram('anagram', 'nagaram');
is_anagram('yoge', 'egoy');
is_anagram('cat', 'rat');
