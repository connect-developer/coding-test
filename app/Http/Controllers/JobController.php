<?php

namespace App\Http\Controllers;

use App\Enums\JobStatus;
use App\Http\Requests\JobStoreRequest;
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
   
     public function showByAdmin(int $id)
    {
        //the function name before was showAdmin and mispelled as not recognized in the routes
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
        /**==============before===========
        * $job = new Job;
        * $job->company_id = $request->company_id;
        * $job->job_title_id = $request->job_title_id;
        * $job->description = $request->description;
        * $job->status = JobStatus::fromKey($request->status);
        * $job->save();
        * return new JobResource($job);
        *============after============
        */
        $job=Job::create($request->store());
        return new JobResource($job);
        /**moved handle request logic including update and create as function called store 
        *
        *because if there are too many fields, assigning 1 by 1 all fields will take a lot of effort
        *also it is reusable to implement at update method by making a function inside jobStoreRequest 
        *
        */    
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

        /**==========before==========
        * $job = Job::find($id);
        * $job->company_id = $request->company_id;
        * $job->job_title_id = $request->job_title_id;
        * $job->description = $request->description;
        * $job->status = JobStatus::fromKey($request->status);
        * $job->save();
        *return new JobResource($job);
        */
        //==========after=======//
        $job=Job::find($id);
        $job->update($request->store());
        return new JobResource($job); 
        /**moved handle request logic including update and create as function called store */
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
        /**=============Before==========
         *
        * $job = Job::find($id);
        * $job->delete();
         * return response()->noContent();
         * 
         */
        /**==============After========= */
        Job::find($id)->delete();
        return response()->noContent();
        /** removed the declaration because it is not used */
    }
}