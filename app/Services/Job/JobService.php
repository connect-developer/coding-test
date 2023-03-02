<?php
namespace App\Services\Job;

use App\Repositories\Job\IJobRepository;
use App\Models\Job;
use App\Http\Requests\JobStoreRequest;
use App\Enums\JobStatus;
use Illuminate\Validation\ValidationException;

class JobService implements IJobService
{
    private IJobRepository $jobRepository;

    public function __construct(IJobRepository $jobRepository)
    {
        $this->jobRepository = $jobRepository;
    }

    public function UpdateJob(JobStoreRequest $request, int $id): Job 
    {
        $job = Job::find($id);
        if($job == null){
            abort(404, "The Partner was not found");
        }
        $job->company_id = $request->company_id;
        $job->job_title_id = $request->job_title_id;
        $job->description = $request->description;
        $job->status = JobStatus::fromKey($request->status);
        $job->save();

        return $job;
    }

    public function DeleteJob(int $id): void 
    {
        $job = Job::find($id);
        if($job == null){
            abort(404, "The Partner was not found");
        }
        $job->delete();
    }
}