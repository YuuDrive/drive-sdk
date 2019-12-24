<?php

namespace YuuDrive\DriveSDK\Services;

use YuuDrive\DriveSDK\Http\HttpClient;
use YuuDrive\DriveSDK\Constants\BaseURL;

/**
 * Folder Service
 */
trait Folder
{
    protected $folderName = 'New Folder';
    protected $permissionRole;
    protected $permissionType;
    protected $starred = false;
    protected $folderColorRgb;

    public function folder($folderName='New Folder') {
        $this->folerName = $folderName;
        return $this;
    }
    public function setRole($role='reader') {
        $this->permissionRole = $role;
        return $this;
    }
    public function setPermissionType($type='anyone') {
        $this->permissionType = $type;
        return $this;
    }
    public function starred($isStarred) {
        $this->starred = $isStarred;
        return $this;
    }
    public function colorRgb($colorRgb='') {
        $this->folderColorRgb = $colorRgb;
        return $this;
    }
    public function create() {
        $http = new HttpClient('json');
        $http->passEndpoint('folder');
        $data = [
            'title' => $this->folderName,
            'name' => $this->folderName,
            'mimeType' => 'application/vnd.google-apps.folder',
        ];
        if($this->starred != null) {
            $data['starred'] = $this->starred;
        }
        if($this->folderColorRgb != null) {
            $data['folderColorRgb'] = $this->folderColorRgb;
        }        
        $headers = [
            'Authorization' => "Bearer $this->accessToken"
        ];
        $url = BaseUrl::GOOGLEAPIS_DRIVE_V2 . '/files/';
        return $http->post($url, $data, $headers);
    }
}