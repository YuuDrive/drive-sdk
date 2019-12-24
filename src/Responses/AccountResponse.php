<?php

namespace YuuDrive\DriveSDK\Responses;

class AccountResponse
{
    public $data;
    private $id;
    private $email;
    private $name;
    private $picture;
    private $given_name;

    public function __construct($data) {
        $this->data = $data;
        $this->id = $data->id;
        $this->email = $data->email;
        $this->name = $data->name;
        $this->given_name = $data->given_name;
        $this->picture = $data->picture;
    }
    public function getData() {
        return $this->data;
    }
    public function getId() {
        return $this->id;
    }
    public function getEmail() {
        return $this->email;
    }
    public function getName() {
        return $this->name;
    }
    public function getGivenName() {
        return $this->given_name;
    }
    public function getPicture() {
        return $this->picture;
    }

}
