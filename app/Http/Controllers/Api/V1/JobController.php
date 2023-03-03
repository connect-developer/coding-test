<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\JobStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Job\JobStoreRequest;
use App\Http\Resources\JobResource;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Get a list of opening jobs to applicants.
     *
     * @param Request $request
     * @return void
     */
    public function view(Request $request)
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
        $job = Job::where('status', JobStatus::Open)->find($id);
        return new JobResource($job);
    }

    /**
     * Get a list of opening jobs to applicants by admin.
     *
     * @param Request $request
     * @return void
     */
    public function viewByAdmin(Request $request)
    {
        $jobs = Job::paginate($request->per_page);
        return JobResource::collection($jobs);
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
