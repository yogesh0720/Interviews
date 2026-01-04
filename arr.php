<?php

$array1 = [1,2,3,4,5,6,7,8,9];
$count = count($array1);
var_dump(str_repeat($count, $count));
// for( $i=0; $i < $count ; $i++)
// {
//       echo $count;
// }
/*
9
9
9
9
9
9
9
9
9
*/
