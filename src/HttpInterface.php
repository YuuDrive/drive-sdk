<?php
namespace YuuDrive\DriveSDK;

interface HttpInterface
{
    /**
     * send GET request
     *
     * @param  string                $url
     * @param  array                 $data
     * @param  array                 $headers
     * @return \YuuDrive\ParseResponse
     */
    public function post($url, array $data, array $headers);
    
    /**
     * send POST request
     *
     * @param  string                $url
     * @param  array/string                 $data
     * @param  array                 $headers
     * @return \YuuDrive\ParseResponse
     */
    public function get($url, $data, array $headers);
}