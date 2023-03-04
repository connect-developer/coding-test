<?php

namespace App\Repositories\Contracts;

use App\Core\Entity\BaseEntity;
use App\Core\Request\ListDataRequest;
use App\Core\Request\ListSearchDataRequest;
use App\Core\Request\ListSearchPageDataRequest;
use App\Http\Requests\Job\JobStoreRequest;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

interface IJobRepository
{
    public function allJob(ListDataRequest $request): Collection;

    public function allSearchJob(ListSearchDataRequest $request): Collection;

    public function allSearchPageJob(ListSearchPageDataRequest $request): Paginator;

    public function findJobById(int $id): BaseEntity | null;

    public function createJob(JobStoreRequest $request): BaseEntity;

    public function updateJob(int $id, JobStoreRequest $request): BaseEntity|null;

    public function deleteJob(int $id): BaseEntity|null;
}
