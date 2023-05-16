<?php

namespace App\Http\Controllers;


use App\Models\Job;
use Illuminate\Http\Request;
use App\Http\Resources\JobResource;

class JobController extends Controller
{

    public $job;

    public function __construct(Job $job){
        $this->job = $job;
    }
    /**
     * Get a list of opening jobs to applicants.
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {
        return JobResource::collection($this->job->statusOpen($request->per_page));
    }

    /**
     * Show a opening job to applicants.
     *
     * @param integer $id
     * @return void
     */
    public function show(Job $job)
    {
        return new JobResource($this->job->findOneJob($job));
    }
}
