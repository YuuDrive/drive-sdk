<?php

namespace YuuDrive\DriveSDK\Responses;

class AuthResponse
{
    private $access_token;
    private $refresh_token;
    public $data;
    public function __construct($data) {
        $this->access_token = $data->access_token;
        $this->refresh_token = $data->refresh_token;
        $this->data = $data;
    }
    /**
     * attribute
     *
     * @return string
     */
    public function getAccessToken() {
        return $this->access_token;
    }
    
    /**
     * attribute
     *
     * @return string
     */
    public function getRefreshToken() {
        return $this->refresh_token;
    }

}
