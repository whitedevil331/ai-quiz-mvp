<?php

namespace App\Exceptions;

use Exception;

class AiServiceException extends Exception
{
    public function __construct(
        string $message = 'AI service is temporarily unavailable'
    ) {
        parent::__construct($message);
    }
}
