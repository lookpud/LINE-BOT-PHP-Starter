<?php

/**
 * Copyright 2016 LINE Corporation
 *
 * LINE Corporation licenses this file to you under the Apache License,
 * version 2.0 (the "License"); you may not use this file except in compliance
 * with the License. You may obtain a copy of the License at:
 *
 *   https://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */

/*
 * This polyfill of hash_equals() is a modified edition of https://github.com/indigophp/hash-compat/tree/43a19f42093a0cd2d11874dff9d891027fc42214
 *
 * Copyright (c) 2015 Indigo Development Team
 * Released under the MIT license
 * https://github.com/indigophp/hash-compat/blob/43a19f42093a0cd2d11874dff9d891027fc42214/LICENSE
 */
if (!function_exists('hash_equals')) {
    defined('USE_MB_STRING') or define('USE_MB_STRING', function_exists('mb_strlen'));

    function hash_equals($knownString, $userString)
    {
        $strlen = function ($string) {
            if (USE_MB_STRING) {
                return mb_strlen($string, '8bit');
            }

            return strlen($string);
        };

        // Compare string lengths
        if (($length = $strlen($knownString)) !== $strlen($userString)) {
            return false;
        }

        $diff = 0;

        // Calculate differences
        for ($i = 0; $i < $length; $i++) {
            $diff |= ord($knownString[$i]) ^ ord($userString[$i]);
        }
        return $diff === 0;
    }
}

class LINEBotTiny
{
    public function __construct($channelAccessToken, $channelSecret)
    {
        $this->channelAccessToken = $channelAccessToken;
        $this->channelSecret = $channelSecret;
    }

    public function parseEvents()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);

            error_log("Method not allowed");
            exit();
        }

        $entityBody = file_get_contents('php://input');

        if (strlen($entityBody) === 0) {
            http_response_code(400);
            error_log("Missing request body");
            exit();
        }

        if (!hash_equals($this->sign($entityBody), $_SERVER['HTTP_X_LINE_SIGNATURE'])) {
            http_response_code(400);
            error_log("Invalid signature value");
            exit();
        }

        $data = json_decode($entityBody, true);
        if (!isset($data['events'])) {
            http_response_code(400);
            error_log("Invalid request body: missing events property");
            exit();
        }

        return $data['events'];
    }

    public function replyMessage($message)
    {
        $header = array(
            "Content-Type: application/json",
            'Authorization: Bearer ' . $this->channelAccessToken,
        );

        $context = stream_context_create(array(
            "http" => array(
                "method" => "POST",
                "header" => implode("\r\n", $header),
                "content" => json_encode($message),
            ),
        ));

        $response = file_get_contents('https://api.line.me/v2/bot/message/reply', false, $context);
        if (strpos($http_response_header[0], '200') === false) {
            http_response_code(500);
            error_log("Request failed: " . $response, 3, "/var/tmp/reply-errors.log");
//            error_log("Request message: " . json_encode($message));
        }
        else{
        error_log("Response message: " .  $response, 3, "/var/tmp/reply-errors.log");
        }
    }
    public function pushMessage($message)
    {
        // $header = array(
        //     "Content-Type: application/json",
        //     'Authorization: Bearer ' . $this->channelAccessToken,
        // );

        // $context = stream_context_create(array(
        //     "http" => array(
        //         "method" => "POST",
        //         "header" => implode("\r\n", $header),
        //         "content" => json_encode($message),
        //     ),
        // ));

        $authHeaders = [
            "Authorization: Bearer $this->channelAccessToken",
        ];
        $method = "POST";
        $curl = new Curl("https://api.line.me/v2/bot/message/push");
        $headers = array_merge($authHeaders, ['User-Agent: LINE-BotSDK-PHP/v2'],  ['Content-Type: application/json; charset=utf-8']);
        $options = [
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_HEADER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_BINARYTRANSFER => true,
            CURLOPT_HEADER => true,
        ];
        if ($method === 'POST') {
            if (empty($message)) {
                // Rel: https://github.com/line/line-bot-sdk-php/issues/35
                $options[CURLOPT_HTTPHEADER][] = 'Content-Length: 0';
            } else {
                $options[CURLOPT_POSTFIELDS] = json_encode($message);
            }
        }
        $curl->setoptArray($options);
        $result = $curl->exec();
        

        if ($curl->errno()) {
            error_log(json_encode($curl->error()));
        }
        $info = $curl->getinfo();
        $httpStatus = $info['http_code'];
        $responseHeaderSize = $info['header_size'];
        $responseHeaderStr = substr($result, 0, $responseHeaderSize);
        $responseHeaders = [];
        foreach (explode("\r\n", $responseHeaderStr) as $responseHeader) {
            $kv = explode(':', $responseHeader, 2);
            if (count($kv) === 2) {
                $responseHeaders[$kv[0]] = trim($kv[1]);
            }
        }
        $body = substr($result, $responseHeaderSize);
        error_log('['.date("F j, Y, g:i a e O").']', 3, "/var/tmp/push-errors.log");
        error_log(json_encode($httpStatus), 3, "/var/tmp/push-errors.log");
        error_log("\n ", 3, "/var/tmp/push-errors.log");
        return $body;
        // $response = file_get_contents('https://api.line.me/v2/bot/message/push', false, $context);
        // if (strpos($http_response_header[0], '200') === false) {
        //     http_response_code(500);

        //    // error_log("Request message push: " . json_encode($message));
        // }
        // else{
        // error_log("Response message push: " . $response);
        // }
    }

    private function sign($body)
    {
        $hash = hash_hmac('sha256', $body, $this->channelSecret, true);
        $signature = base64_encode($hash);
        return $signature;
    }
}


class Curl
{
    /** @var resource */
    private $ch;
    /**
     * Initialize a cURL session
     *
     * @param string $url
     */
    public function __construct($url)
    {
        $this->ch = curl_init($url);
    }
    /**
     * Set multiple options for a cURL transfer
     *
     * @param array $options Returns TRUE if all options were successfully set. If an option could not be
     * successfully set, FALSE is immediately returned, ignoring any future options in the options array.
     * @return bool
     */
    public function setoptArray(array $options)
    {
        return curl_setopt_array($this->ch, $options);
    }
    /**
     * Perform a cURL session
     *
     * @return bool Returns TRUE on success or FALSE on failure. However, if the CURLOPT_RETURNTRANSFER
     * option is set, it will return the result on success, FALSE on failure.
     */
    public function exec()
    {
        return curl_exec($this->ch);
    }
    /**
     * Gets information about the last transfer.
     *
     * @return array
     */
    public function getinfo()
    {
        return curl_getinfo($this->ch);
    }
    /**
     * @return int Returns the error number or 0 (zero) if no error occurred.
     */
    public function errno()
    {
        return curl_errno($this->ch);
    }
    /**
     * @return string Returns the error message or '' (the empty string) if no error occurred.
     */
    public function error()
    {
        return curl_error($this->ch);
    }
    /**
     * Closes a cURL session and frees all resources. The cURL handle, ch, is also deleted.
     */
    public function __destruct()
    {
        curl_close($this->ch);
    }
}
