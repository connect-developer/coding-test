<?php

namespace App\Http\Requests\User;

use App\Core\Request\AuditableRequest;
use App\Helpers\Common;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        if ($this->route('path') === 'admin') {
            $rules = [
                'email' => ['required', 'email'],
                'username' => ['required', 'string', 'unique:users'],
                'password' => ['required', 'min:6', 'confirmed'],
                'password_confirmation' => ['required']
            ];
        } else if ($this->route('path') === 'company') {
            $rules = [
                'email' => ['required', 'email'],
                'username' => ['required', 'string', 'unique:users'],
                'password' => ['required', 'min:6', 'confirmed'],
                'password_confirmation' => ['required'],
                'company_name' => ['required']
            ];
        } else {
            $rules = [];
        }

        return Common::setRuleAuthor($rules, new AuditableRequest());
    }

    public function prepareForValidation()
    {
        Common::setRequestAuthor($this, new AuditableRequest());
    }
}
