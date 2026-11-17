<?php

namespace iutnc\deefy\exception;
use \Exception;
use \Throwable;

class InvalidPropertyValueException extends Exception
{

    public function __construct(string $message = "", int $code = 0, Throwable|null $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
