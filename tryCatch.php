<?php

$array = [
    'name' => 'John',
    'age' => 30,
    'city' => 'New York'
];

foreach($array as $key => $value)
{
    try {
        if($key=='age' && $value==30)
        {
            throw new Exception('Age is 30');
        }
        //echo $key . ': ' . $value . '<br>';
    } catch(Exception $e){
        print_r("having error due to exeption:" . $e->getMessage());
    }
    
}