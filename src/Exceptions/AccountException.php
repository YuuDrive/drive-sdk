<?php
namespace YuuDrive\DriveSDK\Exceptions;
class AccountException extends \Exception
{
    protected $msg;
    public function __construct($msg = null, $code = null, Exception $previous = null) {
        if($this->isJson($msg)) {
            $this->msg = json_decode($msg);
        } else {
            $this->msg = $msg;
        }
        if(!$code) $code = $this->msg->error->code;
        parent::__construct($msg, $code, $previous);
    }
    private function isJson($string) {
        return is_string($string) && is_array(json_decode($string, true)) ? true : false;
    }
    public function __toString() {
        return $this->msg->error->message;
    }
}