<?php

namespace App\Models;

use App\Core\Entity\BaseEntity;
use App\Enums\JobStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends BaseEntity
{
    use HasFactory;

    protected $casts = [
        'status' => JobStatus::class,
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function jobTitle()
    {
        return $this->belongsTo(JobTitle::class);
    }
}
