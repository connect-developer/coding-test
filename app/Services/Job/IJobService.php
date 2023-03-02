<?php
namespace App\Services\Job;

use App\Http\Requests\JobStoreRequest;
use App\Models\Job;

Interface IJobService{

    public function UpdateJob(JobStoreRequest $request, int $id): object|null;
    public function DeleteJob(int $id): void;
}