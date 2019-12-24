<?php

namespace YuuDrive\DriveSDK\Services;

use YuuDrive\DriveSDK\Constants\BaseURL;
use YuuDrive\DriveSDK\Http\HttpClient;

/**
 * Auth Service
 */
trait Auth
{
    public function authURI() {
        $params_request = array(
            "response_type" => "code",
            "client_id" => $this->client_id,
            "redirect_uri" => $this->redirect_uri,
            "access_type" => $this->access_type,
            "scope" => self::SCOPE
        );
        return BaseURL::GOOGLE_ACCOUNT_OAUTH2.http_build_query($params_request);
    }

    public function fetchAccessTokenWithAuthCode($code) {
        $http = new HttpClient('form-urlencoded');
        $http->passEndpoint('token');
        $data = array(
			'code' => $code,
			'client_id' => $this->client_id,
			'client_secret' => $this->client_secret,
			'redirect_uri' => $this->redirect_uri,
			'grant_type' => 'authorization_code'
        );
        $url = BaseURL::GOOGLE_ACCOUNT_OAUTH2 . '/token';
        return $http->post($url, $data);
    }

    public function fetchAccessTokenWithRefreshToken($refresh_token) {
        $http = new HttpClient('form-urlencoded');
        $http->passEndpoint('refresh_token');
        $data = array(
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
            'refresh_token' => $refresh_token,
            'grant_type' => 'refresh_token'
        );
        $url = BaseURL::GOOGLE_OAUTH2 . '/v4/token';
        return $http->post($url, $data);
    }

    public function revokeAccessToken($access_token) {
        $http = new HttpClient();
        $http->passEndpoint('revoke_token');
        $data = [
            'token' => $access_token
        ];
        $url = BaseURL::GOOGLE_ACCOUNT_OAUTH2 . '/revoke';
        return $http->get($url, $data);
    }
    
}
