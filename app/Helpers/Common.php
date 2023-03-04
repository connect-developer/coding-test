<?php

namespace App\Helpers;

use App\Core\Request\AuditableRequest;
use App\Core\Request\ListDataRequest;
use App\Core\Request\ListSearchDataRequest;
use App\Core\Request\ListSearchPageDataRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class Common
{
    public static function setRuleAuthor(array $rules, AuditableRequest $auditableRequest)
    {
        return array_merge($rules, $auditableRequest->rules());
    }

    public static function setRequestAuthor(FormRequest $request, AuditableRequest $auditableRequest): void
    {
        $request->merge(['request_by' => (Auth::user()) ? Auth::user()->username : $auditableRequest->request_by]);
    }
}
