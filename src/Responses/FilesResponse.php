<?php

namespace YuuDrive\DriveSDK\Responses;

class FilesResponse
{
    public $data;

    public function __construct($data) {
        $this->data = $data;
    }
    public function showFolderOnly() {
        $folders = array_filter($this->data->items, function ($var) {
            return ($var->mimeType == 'application/vnd.google-apps.folder');
        });
        $this->data->items = $folders;
        return $this->data;
    }
    public function showFileOnly() {
        $files = array_filter($this->data->items, function ($var) {
            return ($var->mimeType != 'application/vnd.google-apps.folder');
        });
        $this->data->items = $files;
        return $this->data;
    }

}
