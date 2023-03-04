<?php

namespace App\Http\Controllers\Api\V1;

use App\Core\Request\ListDataRequest;
use App\Core\Request\ListSearchDataRequest;
use App\Core\Request\ListSearchPageDataRequest;
use App\Enums\JobStatus;
use App\Http\Controllers\Api\ApiBaseController;
use App\Http\Requests\Job\JobStoreRequest;
use App\Http\Resources\JobResource;
use App\Http\Resources\JobResourceCollection;
use App\Models\Job;
use App\Services\Contracts\IJobService;
use Illuminate\Http\Request;

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


    /**
     * Show a opening job to applicants.
     *
     * @param integer $id
     * @return void
     */
    public function show(int $id)
    {
        $job = Job::where('status', JobStatus::Open)->find($id);
        return new JobResource($job);
    }


    /**
     * Show a opening job to applicants by admin.
     *
     * @param integer $id
     * @return void
     */
    public function showAdmin(int $id)
    {
        $job = Job::find($id);
        return new JobResource($job);
    }

    /**
     * Register a job by admin.
     *
     * @param JobStoreRequest $request
     * @return void
     */
    public function create(JobStoreRequest $request)
    {
        $job = new Job;
        $job->company_id = $request->company_id;
        $job->job_title_id = $request->job_title_id;
        $job->description = $request->description;
        $job->status = JobStatus::fromKey($request->status);
        $job->save();
        return new JobResource($job);
    }

    /**
     * Update job by admin.
     *
     * @param JobStoreRequest $request
     * @param integer $id
     * @return void
     */
    public function update(JobStoreRequest $request, int $id)
    {
        $job = Job::find($id);
        $job->company_id = $request->company_id;
        $job->job_title_id = $request->job_title_id;
        $job->description = $request->description;
        $job->status = JobStatus::fromKey($request->status);
        $job->save();
        return new JobResource($job);
    }

    /**
     * Delete job by admin.
     *
     * @param JobStoreRequest $request
     * @param integer $id
     * @return void
     */
    public function delete(int $id)
    {
        $job = Job::find($id);
        $job->delete();
        return response()->noContent();
    }
}
