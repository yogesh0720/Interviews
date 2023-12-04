<?php
$filename = "test.php";
$file = new SplFileObject($filename);
foreach ($file as $line) {
    echo $line;
}
