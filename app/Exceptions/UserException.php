<?php

namespace App\Exceptions;

use Throwable;

class UserException extends \Exception
{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        $message = $message ?: ' ';
        parent::__construct($message, $code, $previous);
    }
}
