<?php
namespace YuuDrive\DriveSDK\Exceptions;
class YuudriveException extends \Exception
{
    protected $msg;
    public function __construct($msg = null, $code = null, Exception $previous = null) {
        $this->msg = $msg;
        if(!$code) $code = $this->msg->error->code;
        parent::__construct($msg, $code, $previous);
    }

    public function __toString() {
        return $this->msg;
    }
}