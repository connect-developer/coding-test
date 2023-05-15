<?php

namespace App\Repositories;

use App\Enums\JobStatus;
use App\Models\Job;
use Illuminate\Pagination\LengthAwarePaginator;

class JobRepository
{
    private $job;

    public function __construct(Job $job)
    {
        $this->job = $job;
    }

    public function all(array $filters): LengthAwarePaginator
    {
        if (!auth()->check()) {
            $filters['status'] = JobStatus::Open;
        }

        return $this->job->filters($filters)
            ->paginate($filters['per_page']);
    }

    public function save(array $payload): Job
    {
        $job = Job::create($payload);

        return $job;
    }

    public function update(array $payload, Job $job): Job
    {
        $job->update($payload);

        return $job;
    }
}
