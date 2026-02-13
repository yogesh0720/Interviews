<?php

//✅ Correct Natural Sorting Logic
//Option 1: Built-in (Best Answer in Interview)
$input = array('Z1', 'Z10', 'z12', 'z2', 'Z3');
natcasesort($input);
print_r($input);

//✅ Option 2: Custom Sort Logic Using usort()
$input = array('Z1', 'Z10', 'z12', 'z2', 'Z3');
usort($input, function ($a, $b) {
    return strnatcasecmp($a, $b);
});
print_r($input);

//🔥 If They Want Manual Logic (Advanced)
$input = array('Z1', 'Z10', 'z12', 'z2', 'Z3');
usort($input, function ($a, $b) {
    preg_match('/\d+/', $a, $numA);
    preg_match('/\d+/', $b, $numB);
    return (int)$numA[0] <=> (int)$numB[0];
});

print_r($input);
