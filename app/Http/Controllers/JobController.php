<?php

namespace App\Http\Controllers;

use App\Enums\JobStatus;
use App\Http\Requests\JobPaginateRequest;
use App\Http\Requests\JobRequest;
use App\Http\Requests\JobStoreRequest;
use App\Http\Resources\JobResource;
use App\Models\Job;
use App\Repositories\JobRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class JobController extends Controller
{
    private $jobRepository;

    public function __construct(JobRepository $jobRepository)
    {
        $this->jobRepository = $jobRepository;
    }

    public function index(JobPaginateRequest $request)
    {
        $jobs = $this->jobRepository->all($request->validated());

        return JobResource::collection($jobs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobRequest $request)
    {
        $job = $this->jobRepository->save($request->validated());

        return (new JobResource($job));
    }

    /**
     * Show a opening job to applicants.
     *
     * @param integer $id
     * @return void
     */
    public function show(Job $job): JobResource
    {
        return (new JobResource($job));
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(JobRequest $request, Job $job): JobResource
    {
        $job = $this->jobRepository->update($request->validated(), $job);

        return (new JobResource($job));
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Job $job): Response
    {
        $job->delete();

        return response()->noContent();
    }
}
