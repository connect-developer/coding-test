<?php

namespace App\Repositories\Contracts;

use App\Core\Request\ListDataRequest;
use App\Core\Request\ListSearchDataRequest;
use App\Core\Request\ListSearchPageDataRequest;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

interface IJobRepository
{
    public function allJob(ListDataRequest $request): Collection;

    public function allSearchJob(ListSearchDataRequest $request): Collection;

    public function allSearchPageJob(ListSearchPageDataRequest $request): Paginator;
}
