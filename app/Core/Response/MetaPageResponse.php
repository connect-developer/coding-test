<?php

namespace App\Core\Response;

class MetaPageResponse
{
    public string $type;

    public int $code_status;

    public int $total_count;

    public int $per_page;

    public int $current_page;

    public function __construct(string $type, int $code_status, int $total_count, array $meta)
    {
        $this->type = $type;
        $this->code_status = $code_status;
        $this->total_count = $total_count;
        $this->per_page = $meta['perPage'];
        $this->current_page = $meta['currentPage'];
    }
}
