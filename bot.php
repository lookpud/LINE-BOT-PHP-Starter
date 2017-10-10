<?php

$access_token = 'mp9W1fQUWXhFHXoIzL7fGy0sW55YeJX3w+2/q/L7zeQa4Ouk/xK1aUypnqo0lFg9hN5GyFN/v/HmDARGeep1o9Pm8kEzQ/h6JA8kxwFAxXUvmF7cEaPm9u6/pMdFWay5FEc35vYlxceDLvixuLzmSwdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');

// Parse JSON
$events = json_decode($content, true);

//
ini_set("allow_url_fopen", 1);
$json = file_get_contents('http://139.59.247.234:1337/myApi/17');
$obj = json_decode($json, true);
echo [$json] . "\n";

// Validate parsed JSON data

			// Build message to reply back
			
// 				$messages = [
// 					'type' => 'text',
// 					'text' => 'Yo'//$text				 
// 				];
			$messages :[
          			{
               				"type":"text",
               				"text":"Hello, user"
          			},
         			{
               				"type":"text",
               				"text":"Are you Hungry?"
          			}
      			]

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/push';
			$data = [
				'to' => 'U5c95645df3a889a8a270bd48e8a803c5',
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo 'result' . $result . "\r\n";
		
echo "OK1";

