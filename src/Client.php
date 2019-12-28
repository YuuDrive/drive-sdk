<?php

namespace YuuDrive\DriveSDK;

use YuuDrive\DriveSDK\GDriveInterface;

use YuuDrive\DriveSDK\Services\Auth;
use YuuDrive\DriveSDK\Services\Account;
use YuuDrive\DriveSDK\Services\File;
use YuuDrive\DriveSDK\Services\Folder;

/**
 * undocumented class
 */
class Client implements ClientInterface
{
    use Auth;
    use Account;
    use File;
    use Folder;

    protected $accessToken;
    protected $client_id;
    protected $client_secret;
    protected $developer_key;
    protected $redirect_uri = "urn:ietf:wg:oauth:2.0:oob";
    protected $access_type = "offline";

    const SCOPE = [
        'https://www.googleapis.com/auth/userinfo.profile',
        'email', 'https://www.googleapis.com/auth/drive'
    ];
    
    public function __construct($client_id=null, $client_secret=null, $developer_key=null, $redirect_uri=null) {
        if(!$client_id) {
            throw new \YuuDrive\Exceptions\InstanceException("Client Id required");
        } elseif(!$client_secret) {
            throw new \YuuDrive\Exceptions\InstanceException("Client secret required");
        } elseif(!$developer_key) {
            throw new \YuuDrive\Exceptions\InstanceException("Developer key required");
        } else {
            $this->client_id = $client_id;
            $this->client_secret = $client_secret;
            $this->developer_key = $developer_key;
            if($redirect_uri) $this->redirect_uri = $redirect_uri;
        }
    }

    public function setAccessToken($accessToken=null): self {
        if($accessToken) {
            $this->accessToken = $accessToken;
        }
        return $this;
    }

    public function getAccessToken(): string {
        return $this->accessToken;
    }

}
