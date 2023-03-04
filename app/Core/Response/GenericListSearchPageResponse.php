<?php

namespace App\Core\Response;

use Illuminate\Support\Collection;

class GenericListSearchPageResponse extends BasicResponse
{
    public Collection $dtoListSearchPage;

    public int $totalCount;

    public array $meta;

    public function getTotalCount(): int
    {
        return $this->totalCount;
    }

    public function getMeta(): array
    {
        return $this->meta;
    }

    public function getDtoListSearchPage(): Collection
    {
        return $this->dtoListSearchPage ?? new Collection();
    }
}
