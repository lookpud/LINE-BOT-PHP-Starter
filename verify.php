<?php
$access_token = 'mp9W1fQUWXhFHXoIzL7fGy0sW55YeJX3w+2/q/L7zeQa4Ouk/xK1aUypnqo0lFg9hN5GyFN/v/HmDARGeep1o9Pm8kEzQ/h6JA8kxwFAxXUvmF7cEaPm9u6/pMdFWay5FEc35vYlxceDLvixuLzmSwdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
