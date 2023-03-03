<?php

namespace App\Exceptions;

use Exception;

class ResponseNotFoundException extends Exception
{
    public array|string $messages;

    public function __construct(array|string $messages)
    {
        parent::__construct();

        $this->messages = $messages;
    }

    public function getMessages() {
        return $this->messages;
    }
}
