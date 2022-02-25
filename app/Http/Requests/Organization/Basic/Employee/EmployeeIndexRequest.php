<?php

namespace App\Http\Requests\Organization\Basic\Employee;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeIndexRequest extends FormRequest
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
            'language' => ['nullable', 'string', 'max:15'],
            'page' => ['integer', 'nullable'],
            'rows' => ['integer', 'nullable'],
            'filter.*' => 'nullable',
            'sort.*' => 'nullable'
        ];
    }
}
