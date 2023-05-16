<?php

namespace App\Models;

use App\Enums\JobStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $casts = [
        'status' => JobStatus::class,
    ];

    protected $fillable = [
        'name',
        'company_id',
        'job_title_id',
        'description',
        'status'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function jobTitle()
    {
        return $this->belongsTo(JobTitle::class);
    }
    public function statusOpen(int $perPage)
    {
        return $this->where('status', JobStatus::Open)->paginate($perPage);
    }
    public function findOneJob(object $job)
    {
        return $this->where('status', JobStatus::Open)->find($job->id);
    }
    public function getPaginatedJob(int $perPage)
    {
        return $this->paginate($perPage);
    }

    public function updateJob($job)
    {
        return $this->where('id',$job->id)->first();
    }
}
