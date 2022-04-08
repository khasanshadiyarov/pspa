<?php

namespace core\exceptions;

class BadRequestHttpException extends HttpException
{
    /**
     * Constructor.
     * @param $message
     * @param $code
     * @param $previous
     */
    public function __construct($message = null, $code = 0, $previous = null)
    {
        parent::__construct(400, $message, $code, $previous);
    }
}