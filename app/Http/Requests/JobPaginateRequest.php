<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobPaginateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
             'keyword' => ['string', 'nullable'],
            //'paginate' => ['required', 'boolean'],
            'per_page' => ['required'],
            'order_by' => ['nullable'],
            'page' => ['sometimes'],
            'status' => ['sometimes']
        ];
    }
}
