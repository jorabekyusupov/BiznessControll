<?php

namespace App\Http\Requests\Organization\HumanResources\Employee;

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
            'relation_type' => ['required', 'integer'],
            'task_id' => ['required', 'integer'],
            'employee_id' => ['required', 'integer'],
            'staff_id' => ['nullable', 'integer']

        ];
    }
}
