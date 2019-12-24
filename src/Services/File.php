<?php

namespace YuuDrive\DriveSDK\Services;

use YuuDrive\DriveSDK\Http\HttpClient;
use YuuDrive\DriveSDK\Constants\BaseURL;

/**
 * File Service
 */
trait File
{
    public function getFile(string $file_id, $fields='*') {
        $http = new HttpClient();
        $http->passEndpoint('file');
        $data = [
            'fields' => $fields,
            'key' => $this->developer_key
        ];
        $url = BaseURL::GOOGLEAPIS_DRIVE_V2 . "/files/$file_id";
        return $http->get($url, $data);
    }

    public function getAllFiles($fields='*') {
        $http = new HttpClient();
        $http->passEndpoint('files');
        $data = [
            'fields' => $fields,
        ];
        $headers = [
            'Authorization' => "Bearer $this->accessToken"
        ];
        $url = BaseURL::GOOGLEAPIS_DRIVE_V2 . '/files';
        return $http->get($url, $data, $headers);
    }

    public function copyFile($fileId, $title=null, $description='', $folderId=null) {
        $http = new HttpClient('json');
        $http->passEndpoint('copy_file');
        $data = [
            'title' => $title,
            'description' => $description
        ];
        if($folderId) {
            $data['parents'] = [[
                'id' => $folderId
            ]];
        }
        $headers = [
            'Authorization' => "Bearer $this->accessToken"
        ];
        $url = BaseUrl::GOOGLEAPIS_DRIVE_V2 . '/copy';
        return $http->post($url, $data, $headers);
    }
}
