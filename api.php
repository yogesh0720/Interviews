<?php

$curlHandle = curl_init();
curl_setopt($curlHandle, CURLOPT_URL, 'https://smarts-beta.photoccino.com/v1/memories/user/001040787469/all?page=1');

curl_setopt($curlHandle, CURLOPT_HEADER, true);
curl_setopt($curlHandle, CURLOPT_NOBODY, true);  // we don't need body
curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
curl_exec($curlHandle);
$response = curl_getinfo($curlHandle);
curl_close($curlHandle); // Don't forget to close the connection

print_r($response);
