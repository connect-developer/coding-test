<?php

namespace App\Http\Controllers\Api\V1;

use App\Core\Request\ListDataRequest;
use App\Core\Request\ListSearchDataRequest;
use App\Core\Request\ListSearchPageDataRequest;
use App\Http\Controllers\Api\ApiBaseController;
use App\Http\Requests\Job\JobStoreRequest;
use App\Http\Resources\JobResource;
use App\Http\Resources\JobResourceCollection;
use App\Models\Job;
use App\Services\Contracts\IJobService;

class JobController extends ApiBaseController
{
    public IJobService $_jobService;

    public function __construct(IJobService $jobService)
    {
        $this->_jobService = $jobService;
    }

    public function jobListAll(ListDataRequest $request)
    {
        $jobs = $this->_jobService->getAllJob($request);

        if ($jobs->isError()) {
            return $this->getErrorJsonResponse($jobs);
        }

        return $this->getListJsonResponse($jobs, JobResourceCollection::class);
    }

    public function jobListAllSearch(ListSearchDataRequest $request)
    {
        $jobs = $this->_jobService->getAllSearchJob($request);

        if ($jobs->isError()) {
            return $this->getErrorJsonResponse($jobs);
        }

        return $this->getListSearchJsonResponse($jobs, JobResourceCollection::class);
    }

    public function jobListAllSearchPage(ListSearchPageDataRequest $request)
    {
        $jobs = $this->_jobService->getAllSearchPageJob($request);

        if ($jobs->isError()) {
            return $this->getErrorJsonResponse($jobs);
        }

        return $this->getListSearchPageJsonResponse($jobs, JobResourceCollection::class);
    }

    public function jobShow(string $path, int $id)
    {
        $job = $this->_jobService->getJob($id);

        if ($job->isError()) {
            return $this->getErrorJsonResponse($job);
        }

        return $this->getObjectJsonResponse($job, JobResource::class);
    }

    public function jobCreate(JobStoreRequest $request)
    {
        $storeJobResponse = $this->_jobService->storeJob($request);

        if ($storeJobResponse->isError()) {
            return $this->getErrorJsonResponse($storeJobResponse);
        }

        return $this->getObjectJsonResponse($storeJobResponse, JobResource::class);
    }

    public function jobUpdate(string $path, int $id, JobStoreRequest $request)
    {
        $updateJobResponse = $this->_jobService->updateJob($id, $request);

        if ($updateJobResponse->isError()) {
            return $this->getErrorJsonResponse($updateJobResponse);
        }

        return $this->getObjectJsonResponse($updateJobResponse, JobResource::class);
    }

    public function jobDelete(string $path, int $id)
    {
        $deleteJobResponse = $this->_jobService->destroyJob($id);

        if ($deleteJobResponse->isError()) {
            return $this->getErrorJsonResponse($deleteJobResponse);
        }

        return $this->getSuccessLatestJsonResponse($deleteJobResponse);
    }
}
