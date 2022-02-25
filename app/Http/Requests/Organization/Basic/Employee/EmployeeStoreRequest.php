<?php

namespace App\Http\Requests\Organization\Basic\Employee;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'username' => ['email', 'required'],
            'name' => ['string', 'nullable', 'max:100'],
            'password' => ['required', 'string'],
            'permission_user' => ['nullable', 'integer'],
        ];
    }
}
