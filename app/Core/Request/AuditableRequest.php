<?php

namespace App\Core\Request;

use Illuminate\Foundation\Http\FormRequest;

class AuditableRequest
{
    public string $request_by = "system";

    public function rules()
    {
        return [
            'request_by' => ['string']
        ];
    }
}
