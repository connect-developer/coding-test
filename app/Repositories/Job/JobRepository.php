<?php
namespace App\Repositories\Job;

use App\Models\Job;
use App\Enums\JobStatus;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class JobRepository implements IJobRepository
{
    public function GetOpenJobs(Request $request): object|null {
        $jobs = Job::where('status', JobStatus::Open)->paginate($request->per_page);
        return $jobs;
    }

    public function GetOpenJobByID(int $id): object|null {
        $job = Job::where('status', JobStatus::Open)->find($id);
        return $job;
    }

    public function GetJobsByPage(Request $request): object|null {
        $jobs = Job::paginate($request->per_page);
        return $jobs;
    }

    public function GetJobByID(int $id): object {
        $job = Job::find($id);
        if($job == null){
            abort(404, "The Partner was not found");
        }
        return $job;
    }

    public function CreateJob($request): object {
        $company = Job::find($request->company_id);
        $job_title = Job::find($request->job_title_id);
        if($company == null){
            throw ValidationException::withMessages([
                'company_id' => 'The company id field is required.',
            ]);
        }else if($job_title == null) {
            throw ValidationException::withMessages([
                'job_title_id' => 'The job title id field is required.'
            ]);
        }
        $job = new Job;
        $job->company_id = $request->company_id;
        $job->job_title_id = $request->job_title_id;
        $job->description = $request->description;
        $job->status = JobStatus::fromKey($request->status);
        $job->save();

        return $job;
    }
}