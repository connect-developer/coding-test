<?php

namespace App\Core\Response;

class MetaResponse
{
    public string $type;

    public int $code_status;

    public function __construct(string $type, int $code_status)
    {
        $this->type = $type;
        $this->code_status = $code_status;
    }
}
