<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Enums\JobStatus;
use App\Http\Controllers\Company\Traits\CompanyTrait;
use App\Http\Requests\JobStoreRequest;
use App\Http\Resources\JobResource;
use App\Models\Job;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    use CompanyTrait;
    /**
     * Get a list of opening jobs to applicants.
     *
     * @param Request $request
     * @return JobResource
     */
    public function index(Request $request)
    {
        $jobs = Job::where('status', JobStatus::Open)->paginate($request->per_page);

        return JobResource::collection($jobs);
    }

    /**
     * Show a opening job to applicants.
     *
     * @param Job $job
     * @return void
     */
    public function show(Job $job)
    {
        $job = Job::where('status', JobStatus::Open)->findOrFail($job->id);

        return new JobResource($job);
    }

    /**
     * Register a job by admin.
     *
     * @param JobStoreRequest $request
     * @return JobResource
     */
    public function store(JobStoreRequest $request)
    {
        $job = $this->storeJobInCompany($request);

        return new JobResource($job);
    }

    /**
     * Update job by admin.
     *
     * @param JobStoreRequest $request
     * @param Job $job
     * @return JobResource
     */
    public function update(JobStoreRequest $request, Job $job)
    {
        $job = $this->updateJobInCompany($request, $job);
        
        return new JobResource($job);
    }

    /**
     * Delete job by admin.
     *
     * @param JobStoreRequest $request
     * @param Job $job
     * @return void
     */
    public function destroy(Job $job)
    {
        $job->delete();

        return $this->success();
    }
}
