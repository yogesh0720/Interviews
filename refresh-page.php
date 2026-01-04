<?php

// I want to refresh the below URL for every .5 seconds so i gitgub profile visiter count increase. Add limit to 1000 requests.
// How do i know if it is working or not?

$url = "https://github.com/yogesh0720";
$limit = 10;
for ($i = 0; $i < $limit; $i++) {
    $flag = file_get_contents($url);
    echo "Refreshed $i times and flag:$flag\n";
    usleep(500000); // Sleep for 0.5 seconds
}
echo "Refreshed the page $limit times.";
