<?php

namespace core\exceptions;

class NotFoundHttpException extends HttpException
{
    /**
     * Constructor.
     * @param $message
     * @param $code
     * @param $previous
     */
    public function __construct($message = null, $code = 0, $previous = null)
    {
        parent::__construct(404, $message, $code, $previous);
    }
}