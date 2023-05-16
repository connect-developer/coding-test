<?php

namespace App\Http\Requests;

use App\Enums\JobStatus;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Foundation\Http\FormRequest;

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
            'status' => ['required', new Enum(JobStatus::class)],
        ];
    }
}
