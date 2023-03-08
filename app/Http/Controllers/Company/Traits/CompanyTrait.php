<?php

namespace App\Http\Controllers\Company\Traits;

use App\Enums\JobStatus;
use App\Http\Requests\JobStoreRequest;
use App\Models\Job;

trait CompanyTrait {
    public function storeJobInCompany(JobStoreRequest $request)
    {
        $job = new Job();
        $job->fill([
            'company_id' => $request->company_id,
            'job_title_id' => $request->job_title_id,
            'description' => $request->description,
            'status' => JobStatus::fromKey($request->status),
        ]);
        $job->saveOrFail();

        return $job;
    }

    public function updateJobInCompany(JobStoreRequest $request, Job $job)
    {
        $job->fill([
            'company_id' => $request->company_id,
            'job_title_id' => $request->job_title_id,
            'description' => $request->description,
            'status' => JobStatus::fromKey($request->status),
        ]);
        $job->saveOrFail();

        return $job;
    }
}