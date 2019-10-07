<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class MatrixAppException extends Exception
{
    private $http_status_code = '';

    public function __construct($message = "", $http_status_code = 500, $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->http_status_code = $http_status_code;
    }

    public function getHttpStatusCode()
    {
        return $this->http_status_code;
    }

    public function report()
    {
        //error reporting code to log etc.
    }
}
