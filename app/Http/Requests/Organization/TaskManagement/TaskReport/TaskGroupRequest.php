<?php

namespace App\Http\Requests\Organization\TaskManagement\TaskReport;

use Illuminate\Foundation\Http\FormRequest;

class TaskGroupRequest extends FormRequest
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
            'group_type' => ['required', 'integer'],
            'employee_id' => ['required', 'integer'],
            'filter' => ['nullable'],
            'date_range' => ['nullable'],
            'global_search' => ['nullable', 'string'],
        ];
    }
}
