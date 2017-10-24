<?php
msgPush();
function msgPush(){
	$access_token = 'mp9W1fQUWXhFHXoIzL7fGy0sW55YeJX3w+2/q/L7zeQa4Ouk/xK1aUypnqo0lFg9hN5GyFN/v/HmDARGeep1o9Pm8kEzQ/h6JA8kxwFAxXUvmF7cEaPm9u6/pMdFWay5FEc35vYlxceDLvixuLzmSwdB04t89/1O/w1cDnyilFU=';
	
	// get data from API
	ini_set("allow_url_fopen", 1);
	$json = file_get_contents('http://139.59.247.234:1337/TestBot/FindUser/findUser');
	$obj = json_decode($json);
	echo $obj->LUID[0]->LUID;
	echo 'ok';
// 	foreach($json as $key => $value){
//   		echo 'value' . $value . '<br />';
// 	}
	
	// Build message to reply back
	$arr = [];
	// PGMJL
// 	$arr[] = $obj->LUID[0]->LUID;
// 	$arr[] = $obj->LUID[1]->LUID;
	$luidArr[] = $obj->LUID;
	foreach($luidArr as $key => $value){
  		echo 'value ' . $value . '<br />';
		
		$arr[] = $value;
	}
	function RecursiveWrite($obj) {
    		foreach ($obj as $vals) {
        		echo $vals['LUID'] . "\n";
        		RecursiveWrite($vals['LUID']);
    		}
	}
			
	// Make a POST Request to Messaging API to reply to sender
// 	$url = 'https://api.line.me/v2/bot/message/push';
// 	$data = [
// 		'to' => '',
// 		'messages' => $arr,
// 	];
// 	echo 'data: ' . $data . "\n";
// 	$post = json_encode($data);
// 	$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
// 	$ch = curl_init($url);
// 	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// 	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
// 	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
// 	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
// 	$result = curl_exec($ch);
// 	curl_close($ch);
// 	echo 'result: ' . $result . "\r\n";
// 	echo "OK2";
}
