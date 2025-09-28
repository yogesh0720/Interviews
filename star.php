<?php
//diamond-like half pattern
$star = "*";

for ($i = 1; $i <= 5; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo $star;
    }
    echo "\n";
}
for ($i = 1; $i <= 4; $i++) {
    for ($j = 4; $j >= $i; $j--) {
        echo $star;
    }
    echo "\n";
}
##
// *
// **
// ***
// ****
// *****
// ****
// ***
// **
// *
##

for ($i = 1; $i <= 5; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo $star;
    }
    echo "\n";
}
