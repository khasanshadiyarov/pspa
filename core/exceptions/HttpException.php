<?php

namespace core\exceptions;

class HttpException extends \Exception
{
    /**
     * @var int HTTP status code.
     */
    public $statusCode;

    /**
     * Constructor.
     * @param $status
     * @param $message
     * @param $code
     * @param $previous
     */
    public function __construct($status, $message = null, $code = 0, $previous = null)
    {
        $this->statusCode = $status;
        parent::__construct((string)$message, $code, $previous);
    }

    /**
     * Get status code of the thrown exception.
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }
}