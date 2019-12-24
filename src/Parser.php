<?php

namespace YuuDrive\DriveSDK;

class Parser
{
    private $response;
    private $raw_response;
    private $statusCode;
    private $passEndpoint;

    protected $routeResponseClass = [
        'token' => 'YuuDrive\DriveSDK\Responses\AuthResponse',
        'refresh_token' => 'YuuDrive\DriveSDK\Responses\AuthResponse',
        'userinfo' => 'YuuDrive\DriveSDK\Responses\AccountResponse',
        'file' => 'YuuDrive\DriveSDK\Responses\FileResponse',
        'files' => 'YuuDrive\DriveSDK\Responses\FilesResponse',
    ];
    /**
     * Parser init
     *
     * @param mixed  $response
     * @param string $url
     * @param string $code
     * @param string $endpointName
     */
    public function __construct($response, $url, $code=null, $endpointName=null)
    {
        $this->passEndpoint = $endpointName;
        $this->statusCode = $code;
        $jsonDecodeResult = json_decode($response);
        $this->raw_response = $jsonDecodeResult;
        $parts = parse_url($url);
        $endpoint = $parts['path'];
        if (isset($jsonDecodeResult->error)) {
            $errCode = isset($jsonDecodeResult->error->code) ? $jsonDecodeResult->error->code : null;
            if($endpointName == 'token' || $endpointName == 'refresh_token' || $endpointName == 'revoke_token') {
                throw new \YuuDrive\DriveSDK\Exceptions\OAuthException($response);
            } elseif($endpointName == 'userinfo') {
                throw new \YuuDrive\DriveSDK\Exceptions\AccountException($response);
            } elseif($errCode == 404) {
                throw new \YuuDrive\DriveSDK\Exceptions\FileNotFoundException($response);
            } else {
                throw new \Exception($response);
            }
        }
        if(isset($this->routeResponseClass[$endpointName])) {
            $this->response = new $this->routeResponseClass[$endpointName]($jsonDecodeResult);
        } else {
            $this->response = $jsonDecodeResult;
        }
    }

    /**
     * Get response following by class
     *
     * @return void
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Get response following by class
     *
     * @return string $statusCode
     */
    public function getResponseCode(): int
    {
        return $this->statusCode;
    }

    /**
     * Get response following by class
     *
     * @return string $raw_response
     */
    public function getRawResponse(): array
    {
        return $this->raw_response;
    }
}