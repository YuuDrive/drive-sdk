<?php

namespace YuuDrive\DriveSDK\Services;

use YuuDrive\DriveSDK\Constants\BaseURL;
use YuuDrive\DriveSDK\Http\HttpClient;

/**
 * Account Service
 */
trait Account
{
    public function profile($access_token=null) {
        if(!$this->accessToken && $access_token) {
            $this->accessToken = $access_token;
        }
        $http = new HttpClient();
        $http->passEndpoint('userinfo');
        $data = [
            'alt' => 'json',
            'access_token' => $this->accessToken
        ];
        $headers = [
            'Authorization' => "Bearer $this->accessToken"
        ];
        $url = BaseURL::GOOGLE_OAUTH2 . '/v2/userinfo';
        return $http->get($url, $data, $headers);
    }
}