<?php
include 'model.php';
require_once 'vendor/autoload.php';
require_once 'config.php';


    $client = new GuzzleHttp\Client(['base_uri' => 'https://zoom.us']);
  
    $response = $client->request('POST', '/oauth/token', [
        "headers" => [
            "Authorization" => "Basic ". base64_encode(CLIENT_ID.':'.CLIENT_SECRET)
        ],
        'form_params' => [
            "grant_type" => "authorization_code",
            "code" => $_GET['code'],
            "redirect_uri" => REDIRECT_URI
        ],
    ]);
 
    $token = json_decode($response->getBody()->getContents(), true);
    $model_obj->update_access_token($token['access_token']);
   
 
    $result = $model_obj->get_access_token();   
       
     $row = $result->fetch_assoc();
     $accessToken = $row['access_token'];
   
   $client = new GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);
 
 
    try {
        $response = $client->request('POST', '/v2/users/me/meetings', [
            "headers" => [
                "Authorization" => "Bearer $accessToken"
            ],
            'json' => [
                "topic" => "Aditya zoom integration",
                "type" => 2,
                "start_time" => "2020-12-12T20:30:00",
                "duration" => "30", // 30 mins
                "password" => "123456"
            ],
        ]);
 
        $data = json_decode($response->getBody());
        echo "Join URL: ". $data->join_url;
        echo "<br>";
        echo "Meeting Password: ". $data->password;
 
    } catch(Exception $e) {
        if( 401 == $e->getCode() ) { echo "401 err";
            // $refresh_token = $db->get_refersh_token();
 
            // $client = new GuzzleHttp\Client(['base_uri' => 'https://zoom.us']);
            // $response = $client->request('POST', '/oauth/token', [
            //     "headers" => [
            //         "Authorization" => "Basic ". base64_encode(CLIENT_ID.':'.CLIENT_SECRET)
            //     ],
            //     'form_params' => [
            //         "grant_type" => "refresh_token",
            //         "refresh_token" => $refresh_token
            //     ],
            // ]);
            // $db->update_access_token($response->getBody());
 
            // create_meeting();
        } else {
            echo $e->getMessage();
        }
    }
 



exit;