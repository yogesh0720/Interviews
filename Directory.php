<?php

function getDirectorySize(string $path): int
{
    $size = 0;

    foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path)) as $file) {
        if ($file->isFile()) {
            $size += $file->getSize();
        }
    }

    return $size;
}

// Example
$dir = __DIR__; // current folder
echo "Directory size: " . getDirectorySize($dir) . " bytes" . PHP_EOL;
