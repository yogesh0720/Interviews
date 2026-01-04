<?php

class A
{
    public static $count = 0;
    public function __construct()
    {
        if (A::$count == 4) {
            throw new Exception('count is :' . A::$count);
        }
        A::$count++;
    }
}
$object1 = new  A();
echo PHP_EOL;
echo $object1::$count;
$object2 = new  A();
echo PHP_EOL;
echo $object2::$count;
$object3 = new  A();
echo PHP_EOL;
echo $object3::$count;
$object4 = new  A();
echo PHP_EOL;
echo $object4::$count;
//$object5 = new  A();echo PHP_EOL; echo $object5::$count;
//echo "The number of objects in the class is " . A::$count;
