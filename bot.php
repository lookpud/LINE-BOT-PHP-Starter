<?php

msgPush();


function msgReply(){
$access_token = 'mp9W1fQUWXhFHXoIzL7fGy0sW55YeJX3w+2/q/L7zeQa4Ouk/xK1aUypnqo0lFg9hN5GyFN/v/HmDARGeep1o9Pm8kEzQ/h6JA8kxwFAxXUvmF7cEaPm9u6/pMdFWay5FEc35vYlxceDLvixuLzmSwdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');

// Parse JSON
$events = json_decode($content, true);

// try
// foreach($messages as $key => $value){
//   	echo $key . '<br />';
// 	foreach($value as $key_arr => $value_arr){
//   		echo $key_arr . ': ' . implode('-', $values_arr) . '<br /><br />';
// 	}
// }

// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];
			
			$sticker = [
				'type' => 'sticker',
				'packageId' => '1',
    				'stickerId' => '1'
			];
			$reply = [
				'type' => 'text',
				'text' => 'zzZZ'
			];
			// Build message to reply back
			if($text == 'Hi'){
				$messages = [
					'sticker' => $sticker,
					'reply' => $reply
				];
			}else{
				$messages = [
					'type' => 'text',
					'text' => 'Say "Hi" to me' 
				];
			}
			
			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			echo $data;
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

			echo $result . "\r\n";
		}
	}
}
echo "OK2";
}


function msgPush(){
	$access_token = 'mp9W1fQUWXhFHXoIzL7fGy0sW55YeJX3w+2/q/L7zeQa4Ouk/xK1aUypnqo0lFg9hN5GyFN/v/HmDARGeep1o9Pm8kEzQ/h6JA8kxwFAxXUvmF7cEaPm9u6/pMdFWay5FEc35vYlxceDLvixuLzmSwdB04t89/1O/w1cDnyilFU=';
	
	//
	ini_set("allow_url_fopen", 1);
	$json = file_get_contents('http://139.59.247.234:1337/myApi/17');
	$obj = json_decode($json, true);
	echo [$json] . "\n";
	
	// Build message to reply back
	$sticker = [
		'type' => 'sticker',
		'packageId' => '1',
    		'stickerId' => '1'
	];
	$messages = [
		'type' => 'text',
		'text' => 'zzZZ'
	];
	$ar = [
    		['type' => 'text','text' => 'zzZZ1']
	];
// 	$messages = [
// 		'sticker' => $sticker,
// 		'reply' => $reply
// 	];
	echo 'msg: ' . [$messages] . "\n";
	print 'msg: ' . [$messages] . "\n";
			
	// Make a POST Request to Messaging API to reply to sender
	$url = 'https://api.line.me/v2/bot/message/push';
	$data = [
		'to' => 'Ua7085916d72ba072759cfa5fe05ac3b8',
		'messages' => [$ar],
	];
	echo 'data: ' . $data . "\n";
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

	echo 'result: ' . $result . "\r\n";
	echo "OK1";
}







