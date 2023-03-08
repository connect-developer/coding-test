<?php

namespace App\Http\Controllers;

use App\Enums\JobStatus;
use App\Http\Requests\JobStoreRequest;
use App\Http\Resources\JobResource;
use App\Http\Traits\CompanyTrait;
use App\Models\Job;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    use CompanyTrait;

    /**
     * Get a list of opening jobs to applicants.
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {
        $jobs = Job::where('status', JobStatus::Open)->paginate($request->per_page);
        return JobResource::collection($jobs);
    }

    /**
     * Show a opening job to applicants.
     *
     * @param integer $id
     * @return void
     */
    public function show(int $id)
    {
        $job = Job::where('status', JobStatus::Open)->firstOrFail($id);
        return new JobResource($job);
    }

    /**
     * Register a job by company.
     *
     * @param JobStoreRequest $request
     * @return void
     */
    public function create(JobStoreRequest $request)
    {
        $job = $this->storeCompanyJob($request);
        return new JobResource($job);
    }

    /**
     * Update job by company.
     *
     * @param JobStoreRequest $request
     * @param integer $id
     * @return void
     */
    public function update(JobStoreRequest $request, Job $job)
    {
        $job = $this->updateCompanyJob($request, $job);
        return new JobResource($job);
    }

    /**
     * Delete job by company.
     *
     * @param JobStoreRequest $request
     * @param integer $id
     * @return void
     */
    public function delete(int $id)
    {
        $job = Job::first($id)->delete();
        $job->delete();
        return response()->noContent();
    }
}
