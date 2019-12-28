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
$redirect_uri = 'http://example.com/callback';

$client = new Client($client_id, $client_secret, $developer_key, $redirect_uri);
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
#### Get Profile info
```php
// passing access token parameter
$client->profile($access_token);

// OR

$client->setAccessToken($access_token);
$profile = $client->profile()->getResponse();

// attributes:
$profile->getId(); // get User id
$profile->getEmail(); // user email
$profile->getName(); // name
$profile->getPicture(); // profile picture
```
### File
#### Get File info
```php
$client->setAccessToken($access_token);
$file = $client->getFile($file_id)->getResponse();

//attributes:
$file->getId(); // file id
$file->getName(); // file name
$file->getSize(); // file size
$file->getExtention(); // file extention
$file->getChecksum(); // file checksum
```
#### Get File list
```php
$client->setAccessToken($access_token);
$files = $client->getFiles()->getResponse();

// only return the file list
$files->showFileOnly();

// only return the folder list
$files->showFolderOnly();

```

### Folder
#### Create Folder
```php
$client->setAccessToken($access_token);
$create_folder = $client->folder($folder_name)->setRole('reader')->setPermissionType('anyone');

// to set folder color
->colorRgb($rgb_code);

// to set folder starred
->starred(true);

//execute instance
$create_folder = $create_folder->create()->getResponse();

print_r($create_folder->data); // to return object response
```
**Permission role list**
The role granted by this permission. While new values may be supported in the future, the following are currently allowed: 
- owner
- organizer 
- fileOrganizer 
- commenter 
- reader

**Permission type list**
The type of the grantee. Valid values are: 
- user 
- group 
- domain 
- anyone 


## Tests