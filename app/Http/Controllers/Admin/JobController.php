<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use App\Models\Job;
use Illuminate\Http\Request;
use App\Http\Resources\JobResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\JobStoreRequest;

class JobController extends Controller
{
    public $job;

    public function __construct(Job $job){
        $this->job = $job;
    }
    /**
     * Get a list of opening jobs to applicants by admin.
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {
        return JobResource::collection($this->job->getPaginatedJob($request->per_page));
    }

    /**
     * Show a opening job to applicants by admin.
     *
     * @param integer $id
     * @return void
     */
    public function show(Job $job)
    {
        return new JobResource($this->job->findOneJob($job));
    }

    /**
     * Register a job by admin.
     *
     * @param JobStoreRequest $request
     * @return void
     */
    public function store(JobStoreRequest $request)
    {
        try {
            $job = Job::create($request->validated());
            return new JobResource($job);
        } catch (Throwable $e) {
            return $e;
        }
       
    }

    /**
     * Update job by admin.
     *
     * @param JobStoreRequest $request
     * @param integer $id
     * @return void
     */
    public function update(JobStoreRequest $request, Job $job)
    {
        $job->update($request->validated());
        return new JobResource($this->job->updateJob($job));
    }

    /**
     * Delete job by admin.
     *
     * @param JobStoreRequest $request
     * @param integer $id
     * @return void
     */
    public function destroy(Job $job)
    {
        $job->delete();
        return response()->noContent();
    }
}
