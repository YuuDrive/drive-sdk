<?php

namespace YuuDrive\DriveSDK\Http;

use YuuDrive\DriveSDK\HttpInterface;
use YuuDrive\DriveSDK\Parser;

class HttpClient implements HttpInterface
{
    /**
     * curl init
     *
     * @var string
     */
    private $ch;
    protected $contentTypeHeader = 'application/json;charset=UTF-8';
    protected $contentType;
    private $userAgent;
    protected $statusCode;
    protected $response;
    private $passEndpoint;

    public function __construct($contentType=null, $userAgent=null)
    {
        $this->contentType = $contentType;
        if($contentType == 'json') {
            $this->contentTypeHeader = 'application/json;charset=UTF-8';
        } elseif($contentType == 'form-urlencoded') {
            $this->contentTypeHeader = 'application/x-www-form-urlencoded';
        } elseif($contentType == 'form-data') {
            $this->contentTypeHeader = 'multipart/form-data';
        }
        if($userAgent) $this->userAgent;
        $this->ch = curl_init();
    }

    /**
     * pass endpoint used
     *
     * @param  string                $endpointName
     * @return \YuuDrve\DriveSDK\Http\HttpClient
     */
    public function passEndpoint($endpointName) {
        $this->passEndpoint = $endpointName;
        return $this;
    }

    /**
     * send post request
     *
     * @param  string                $url
     * @param  array                 $data
     * @param  array                 $headers
     * @return \YuuDrve\DriveSDK\Parser
     */
    public function post($url, array $data, array $headers=[])
    {
        $headerJson = ['Content-Type: ' . $this->contentTypeHeader];

        $tempHeaders = [];

        foreach ($headers as $key => $value) {
            array_push($tempHeaders, $key . ': ' . $value);
        }
        $headers = array_merge($headerJson, $tempHeaders);
        
        if($this->contentType == 'json') {
            $data = json_encode($data);
        } elseif($this->contentType = 'form-urlencoded') {
            $data = http_build_query($data);
        }
        curl_setopt($this->ch, CURLOPT_URL, $url);
        curl_setopt($this->ch, CURLOPT_POST, true);
        curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, true);

        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($this->ch);
        $status_code = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);

        $this->response = $result;
        $this->statusCode = $status_code;
        curl_close($this->ch);

        return new Parser($result, $url, $status_code, $this->passEndpoint);
    }

    /**
     * send get request
     *
     * @param  string                $url
     * @param  array/string          $data
     * @param  array                 $headers
     * @return \YuuDrve\DriveSDK\Parser
     */
    public function get($url, $data='', array $headers=[])
    {
        $headerJson = ['Content-Type: ' . $this->contentTypeHeader];

        $tempHeaders = [];
        if(is_array($data)) {
            $data = http_build_query($data);
            $url = $url . "?$data";
        } else {
            $url = $url . $data;
        }
        foreach ($headers as $key => $value) {
            array_push($tempHeaders, $key . ': ' . $value);
        }
        $headers = array_merge($headerJson, $tempHeaders);
        curl_setopt($this->ch, CURLOPT_URL, $url);
        curl_setopt($this->ch, CURLOPT_POST, false);
        curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, true);

        $result = curl_exec($this->ch);
        $status_code = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);
        $this->response = $result;
        $this->statusCode = $status_code;
        curl_close($this->ch);

        return new Parser($result, $url, $status_code, $this->passEndpoint);
    }

    /**
     * Get response following by class
     *
     * @return self
     */
    public function setContentType($content) {
        $this->contentType = $content;
        return $this;
    }

    /**
     * Get response following by class
     *
     * @return string
     */
    public function getStatusCode() {
        return $this->statusCode;
    }

    /**
     * Get response following by class
     *
     * @return void
     */
    public function getResponse() {
        return $this->response;
    }
}