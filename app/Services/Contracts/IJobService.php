<?php

namespace App\Services\Contracts;

use App\Core\Request\ListDataRequest;
use App\Core\Request\ListSearchDataRequest;
use App\Core\Request\ListSearchPageDataRequest;
use App\Core\Response\BasicResponse;
use App\Core\Response\GenericListResponse;
use App\Core\Response\GenericListSearchPageResponse;
use App\Core\Response\GenericListSearchResponse;
use App\Core\Response\GenericObjectResponse;
use App\Http\Requests\Job\JobStoreRequest;

interface IJobService
{
    public function getAllJob(ListDataRequest $request): GenericListResponse;

    public function getAllSearchJob(ListSearchDataRequest $request): GenericListSearchResponse;

    public function getAllSearchPageJob(ListSearchPageDataRequest $request): GenericListSearchPageResponse;

    public function getJob(int $id): GenericObjectResponse;

    public function storeJob(JobStoreRequest $request): GenericObjectResponse;

    public function updateJob(JobStoreRequest $request): GenericObjectResponse;

    public function destroyJob(string $id): BasicResponse;
}
