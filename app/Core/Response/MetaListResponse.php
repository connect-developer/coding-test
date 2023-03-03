<?php

namespace App\Core\Response;

class MetaListResponse
{
    public string $type;

    public int $code_status;

    public int $total_count;

    public function __construct(string $type, int $code_status, int $total_count)
    {
        $this->type = $type;
        $this->code_status = $code_status;
        $this->total_count = $total_count;
    }
}
