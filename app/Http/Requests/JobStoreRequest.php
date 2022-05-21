<?php

namespace App\Http\Requests;

use App\Enums\JobStatus;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Job;
class JobStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'company_id' => 'required',
            'job_title_id' => 'required',
            'description' => 'required|max:20000',
            'status' => 'required|enum_key:' . JobStatus::class,
        ];
    }
    public function handleStatus()
    {
        return JobStatus::fromKey($this->status);
    }
    public function store()
    {
        $job=$this->validated();
        $job['status']=$this->handleStatus();
        return $job;
    }
    
}