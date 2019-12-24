# drive-sdk
Google Drive Sharer Client SDK

[![Version](https://img.shields.io/packagist/v/yuudrive/drive-sdk?style=flat-square "Packagist Version")](https://packagist.org/packages/yuudrive/drive-sdk "Packagist Version")
[![LICENSE](https://img.shields.io/packagist/l/yuudrive/drive-sdk?style=flat-square "LICENSE")](https://github.com/YuuDrive/drive-sdk/blob/master/LICENSE "LICENSE")
![Packagist](https://img.shields.io/packagist/dt/yuudrive/drive-sdk?style=flat-square)

## Instalation
```bash
composer require yuudrive/drive-sdk
```

## Quick start
### Initialization
```php
// include your composer dependencies
require_once 'vendor/autoload.php';

use YuuDrive\DriveSDK\Client;

$client_id = "YOUR_CLIENT_ID_HERE";
$client_secret = "YOUR_SECRET_KEY_HERE";
$developer_key = "YOUR_DEV_KEY_HERE";

$client = new Client($client_id, $client_secret, $developer_key);
```

### OAuth
#### Generate OAuth URI
```php
$authURI = $client->authURI();
```

#### Fetch Access Token from OAuth code
```php
$fetchToken = $client->fetchAccessTokenWithAuthCode($code)->getResponse();

print_r($fetchToken->data); // return raw response
echo $fetchToken->getAccessToken() // return access_token attribute
echo $fetchToken->getRefreshToken() // return refresh_token attribute
```

#### Fetch Access Token from Refresh code
```php
$fetchToken = $client->fetchAccessTokenWithRefreshToken($refresh_token)->getResponse();

print_r($fetchToken->data); // return raw response
echo $fetchToken->getAccessToken() // return access_token attribute
echo $fetchToken->getRefreshToken() // return refresh_token attribute
```

#### Revoke Access Token
```php
$client->revokeAccessToken($access_token);
```

### Account
-
### File
-
### Folder
-
## Tests