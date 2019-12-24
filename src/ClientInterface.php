<?php

namespace YuuDrive\DriveSDK;

interface ClientInterface {
    public function authURI();
    public function setAccessToken($accessToken=null);
    public function getAccessToken();
}