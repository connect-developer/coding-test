<?php

namespace App\Models;

use App\Core\Entity\BaseEntity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobTitle extends BaseEntity
{
    use HasFactory;

    public function jobs()
    {
        return $this->hasMany(Job::class, 'job_title_id');
    }
}
