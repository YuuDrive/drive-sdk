<?php

namespace YuuDrive\DriveSDK\Responses;

class FileResponse
{
    public $data;
    private $name;
    private $id;
    private $mimeType;
    private $size;
    private $link;
    private $extension;
    private $isOwnedByMe;
    private $owners;
    private $version;
    private $checksum;

    public function __construct($data) {
        $this->data = $data;
        $this->id = $data->id;
        $this->name = $data->title;
        $this->mimeType = $data->mimeType;
        $this->size = $data->fileSize;
        $this->link = $data->webContentLink;
        $this->extension = $data->fileExtension;
        $this->isOwnedByMe = $data->ownedByMe;
        $this->owners = $data->owners;
        $this->version = $data->version;
        $this->checksum = $data->md5Checksum;
    }

    public function getId() {
        return $this->id;
    }
    public function getName() {
        return $this->name;
    }
    public function getSize() {
        return $this->size;
    }
    public function getLink() {
        return $this->link;
    }
    public function getExtention() {
        return $this->extension;
    }
    public function isOwnedByMe() {
        return (bool) $this->isOwnedByMe;
    }
    public function getOwners() {
        return $this->owners;
    }
    public function getVersion() {
        return $this->version;
    }
    public function getChecksum() {
        return $this->md5Checksum;
    }

}
