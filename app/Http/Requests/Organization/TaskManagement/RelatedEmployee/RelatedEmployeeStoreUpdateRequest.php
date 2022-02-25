<?php

namespace App\Http\Requests\Organization\TaskManagement\RelatedEmployee;

use Illuminate\Foundation\Http\FormRequest;

class RelatedEmployeeStoreUpdateRequest extends FormRequest
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
            'relation_type_id' => ['required', 'integer'],
            'task_id' => ['required', 'integer'],
            'employee_id' => ['required', 'integer'],
            'staff_id' => ['nullable', 'integer'],
            'expected_duration' => ['nullable'],
            'actual_duration' => ['nullable'],
            'begin_date' => ['nullable'],
            'status_id' => ['nullable']

        ];
    }
}
