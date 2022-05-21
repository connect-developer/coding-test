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
    /** added fillable variable so we can retrieve mass fields*/
    /** i think rather than writing request and also the field name in the controller
     * this is better to just write the fileds in a model 
     * and then take all the request that is validated so unnecessary request won`t come in
     */
    protected $fillable=[
        'company_id',
        'job_title_id',
        'description',
        'status'
    ];
    
    protected $hidden=["company_id","job_title_id"];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function jobTitle()
    {
        return $this->belongsTo(JobTitle::class);
    }
}
