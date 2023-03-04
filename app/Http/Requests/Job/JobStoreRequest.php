<?php

namespace App\Http\Requests\Job;

use App\Core\Request\AuditableRequest;
use App\Enums\JobStatus;
use App\Helpers\Common;
use App\Models\Company;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class JobStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'company_id' => 'required',
            'job_title_id' => 'required',
            'description' => 'required|max:20000',
            'status' => 'required|enum_key:' . JobStatus::class,
        ];

        return Common::setRuleAuthor($rules, new AuditableRequest());
    }

    public function prepareForValidation()
    {
        if (Auth::user()->role === "COMPANY") {
            $this->merge(['company_id' => Auth::user()->company->id]);
        }

        Common::setRequestAuthor($this, new AuditableRequest());
    }
}
