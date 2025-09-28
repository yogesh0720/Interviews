<?php
function is_anagram($string1, $string2)
{
    echo count_chars($string1, 1) == count_chars($string2, 1) ? "Yes\n" : "No\n";
}

is_anagram('anagram', 'nagaram');
is_anagram('yoge', 'egoy');
is_anagram('cat', 'rat');

is_anagram('listen', 'silent');

is_anagram('rat', 'cat');
class Solution
{

    /**
     * @param String $s
     * @param String $t
     * @return Boolean
     */
    function isAnagram($s, $t)
    {
        $s = str_split($s);
        $t = str_split($t);
        sort($s);
        sort($t);
        return $s == $t;
    }
}

echo new Solution()->isAnagram('anagram', 'nagaram') ? "yes\n" : "No\n";
