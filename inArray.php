<?php
$input = 'USA';
$country = ['INDIA', 'USA', 'CANADA'];
function isCountryExist($input,  $country)
{
    //return  in_array($input, $country) ? 'true' : 'false';
    foreach ($country as $c) {
        if ($c == $input) {
            return true;
        }
    }
    return false;
}
$output = isCountryExist($input,  $country);
var_dump($output);
