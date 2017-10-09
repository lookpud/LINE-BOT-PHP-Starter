<?php

$access_token = 'mp9W1fQUWXhFHXoIzL7fGy0sW55YeJX3w+2/q/L7zeQa4Ouk/xK1aUypnqo0lFg9hN5GyFN/v/HmDARGeep1o9Pm8kEzQ/h6JA8kxwFAxXUvmF7cEaPm9u6/pMdFWay5FEc35vYlxceDLvixuLzmSwdB04t89/1O/w1cDnyilFU=';

			$userid = 'U5c95645df3a889a8a270bd48e8a803c5';
			// Build message to reply back
			$messages = [
				{
                         		"type":"text",
                         		"text":"Hello, PGame"
                    		},
                    		{
                         		"type":"text",
                         		"text":"Are you hungry?"
                    		}
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/push';
			$data = [
				'to' => $userid,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
curl_close ($ch);

			echo $result . "\r\n";
	
echo "OK2";
?>
