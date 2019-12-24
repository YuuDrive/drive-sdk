<?php

namespace YuuDrive\DriveSDK\Exceptions;

class InstanceException extends \Exception
{
    protected $msg;
    public function __construct($msg = null, $code = 0, Exception $previous = null) {
        $this->msg = $msg;
        parent::__construct($msg);
    }

    public function __toString() {
        return $this->msg;
    }
}
