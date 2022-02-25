<?php

namespace App\Http\Requests\Organization\Basic\EmployeeSetting;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeSettingStoreUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "employee_id" => ['required','integer'],
            "default_organization" => ['required','integer'],
            "default_language" => ['required','integer']
        ];
    }
}
