<?php

namespace App\Http\Controllers;

use App\Enums\JobStatus;
use App\Http\Requests\JobStoreRequest;
use App\Http\Resources\JobResource;
use App\Models\Job;
use Illuminate\Http\Request;
use App\Repositories\Job\IJobRepository;
use App\Services\Job\IJobService;

class JobController extends Controller
{

    private IJobRepository $jobRepository;
    private IJobService $jobService;

    public function __construct(
        IJobRepository $jobRepository,
        IJobService $jobService
    )
    {
        $this->jobRepository = $jobRepository;
        $this->jobService = $jobService;
    }
    /**
     * Get a list of opening jobs to applicants.
     *
     * @param Request $request
     * @return void
     */
    public function view(Request $request)
    {
        $jobs = $this->jobRepository->GetOpenJobs($request);
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
        $job = $this->jobRepository->GetOpenJobByID($id);
        if($job == null){
            abort(404, "The Partner was not found");
        }
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
        $jobs = $this->jobRepository->GetJobsByPage($request);
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
        $job = $this->jobRepository->GetJobByID($id);
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
        $job = $this->jobRepository->CreateJob($request);
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
        $job = $this->jobService->UpdateJob($request, $id);
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
        $this->jobService->DeleteJob($id);
        return response()->noContent();
    }
}
