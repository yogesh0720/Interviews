<?php
//$url = "https://cmd.dev.thislife.com/json?method=album.saveAlbum"; // Replace with your actual API endpoint
$url = "https://cmd.beta.thislife.com/json?method=album.saveAlbum"; // Replace with your actual API endpoint
//$url = "https://cmd.thislife.com/json?method=album.saveAlbum"; // Replace with your actual API endpoint

$token = "eyJraWQiOiJNOXQ5dlwvcGhscWFDdmpCTFFnYTlUS1puNUJPeFB3emhCRUNKcjVJKzVGTT0iLCJhbGciOiJSUzI1NiJ9.eyJzdWIiOiJmMmRlYzE0ZC05NGJlLTRiOWYtOGNiYy1lZjUxNmUxMTRjY2UiLCJjb2duaXRvOmdyb3VwcyI6WyJDb2duaXRvTmV3U2lnbnVwIl0sImlzcyI6Imh0dHBzOlwvXC9jb2duaXRvLWlkcC51cy1lYXN0LTEuYW1hem9uYXdzLmNvbVwvdXMtZWFzdC0xXzJJd1VxVjFJZyIsInBpZCI6Ilwvc2ZseSIsInNmbHkzX3RyayI6IjIuMCIsImNyb2xlcyI6IlNPRiIsInVzZXJfdHlwZSI6IkFDVCIsInNnIjoid2ViIiwic2NvcGUiOiJwcm9maWxlIHVzZXIiLCJhdXRoX3RpbWUiOjE3NDk1Mjk5ODQsImNvbnRleHQiOiJcL3NmbHlcL3NodXR0ZXJmbHlcL3NodXR0ZXJmbHktdXNcL2RlZmF1bHQiLCJleHAiOjE3NDk2NDk0NzgsImlhdCI6MTc0OTY0NTg3OCwianRpIjoiYjFkYTVlMzctMzQzOS00NDNiLTlkMWItY2M4YzAzNGFlYmQ1IiwiZW1haWwiOiJ5b2dlc2huQHlvcG1haWwuY29tIiwiZSI6InNmbHktYmV0YSIsInNmbHkzX3VpZCI6IjEwNzE3Nzc0NjUiLCJkYXRhX2NlbnRlciI6IkFVUyIsImNvZ25pdG86dXNlcm5hbWUiOiJmMmRlYzE0ZC05NGJlLTRiOWYtOGNiYy1lZjUxNmUxMTRjY2UiLCJnaXZlbl9uYW1lIjoiWW9nZXNoIiwib3JpZ2luX2p0aSI6IjQ4MTExM2U5LWZmZWEtNDYyMS05NDMzLWM4ODk4NWRkYTNiMiIsImF1ZCI6IjJnbzh2aTc1dWtmZnZzMG82cmN1b3N0Ym44IiwiZXZlbnRfaWQiOiJmMGUxZmVmNC1jMDYwLTRmYTEtYmVkMS03MjMwMDk4ZjlkNWMiLCJzZmx5X3VpZCI6IjAwMTA3MTc3NzQ2NSIsInRva2VuX3VzZSI6ImlkIiwiZmFtaWx5X25hbWUiOiJOIn0.gEOSxINWeY4YAaeP4UOIDeWoz-lpUWNSLp9WOyDCeRCL1IFFEsXMAOt0teB6F2tCV7kcrRG3WeUbsccYyJjN1Zzhf8QplqiIiZEE0zac6-gO3BnEC1CnnqloeEaIlDEqfwkdtdAQ7lxyCzdwoEWnXU66AqieudeXslHBB6UX3R71Zz43_2JctuYYOi44eGIeqVdU5TmOqPyu0zOWJanYlCZde8ykmoI88c2UuLQ-kF380d-EMhcV-Pd9iMY4MD8XPjgDNiiLduQaDU2OEriAnwcOZb0jK3BlTXfc2yuT5fBbglX3tdCvHt0eoVaK4VeC2LjbS4ydUcbWWgupBhJlIA";

try {
    $start_id = 1;
    $count = 100;
    for ($i = 0; $i < $count; $i++) {
        $new_id = $start_id + $i;
        // Customize the album name in each request
        $params = [
            $token,
            [
                "name" => "mynewal_" . $new_id,
                //"life_uid" => "026096698502", //local
                //"life_uid" => "000082842848", //dev                
                "life_uid" => "001071777465" // "001050507631", //beta
                
            ]
        ];
    
        $postData = [
            "method" => "album.saveAlbum",
            "id" => null,
            "params" => $params
        ];
    

        // Encode the full body to JSON
        $jsonData = json_encode($postData);

        $headers = [
            'Accept: application/json, text/javascript, */*; q=0.01',
              'Accept-Language: en-US,en;q=0.9',
              'Connection: keep-alive',
              'Content-Type: application/x-www-form-urlencoded; charset=UTF-8',
              'Origin: https://photos.shutterfly.com',
              'Referer: https://photos.shutterfly.com/',
              'Sec-Fetch-Dest: empty',
              'Sec-Fetch-Mode: cors',
              'Sec-Fetch-Site: cross-site',
              'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36',
              'sec-ch-ua: "Google Chrome";v="137", "Chromium";v="137", "Not/A)Brand";v="24"',
              'sec-ch-ua-mobile: ?0',
              'sec-ch-ua-platform: "macOS"'
        ];
    
    
        // Initialize cURL
        $ch = curl_init($url);
    
        curl_setopt_array(
            $ch,
            array(
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST  => false,
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $jsonData,
                CURLOPT_HTTPHEADER => $headers
            )
        );
    
    
        // Execute and get response
        $response = curl_exec($ch);
    
        // Error handling
        if (curl_errno($ch)) {
            echo 'Curl error: ' . curl_error($ch);
        } else {
            echo "Response for album $i: $response\n";
        }
    
        curl_close($ch);
    }
} catch (Exception $e) {
    throw new Exception('Save album insert failed.. Error-'.print_r($e,true) );
}


