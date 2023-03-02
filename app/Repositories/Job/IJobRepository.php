<?php
namespace App\Repositories\Job;

use Illuminate\Http\Request;
use App\Models\Job;

Interface IJobRepository{
    
    public function GetOpenJobs(Request $request): object|null;
    public function GetOpenJobByID(int $id): object|null;
    public function GetJobsByPage(Request $request): object|null;
    public function GetJobByID(int $id): object;
    public function CreateJob($request): object;
}