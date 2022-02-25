<?php

namespace App\Http\Requests\Organization\TaskManagement\Task;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskStoreUpdateRequest extends FormRequest
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
        $title = 'required';
        $type_id = ['required', 'integer'];
        if (request()->isMethod('PUT')) {
            $title = 'nullable';
            $type_id = ['nullable', 'integer'];
        }
        return [
            'parent_id' => ['nullable', 'integer'],
            'folder_id' => ['nullable', 'integer'],
            'title' => $title,
            'type_id' => $type_id,
            'status_id' => ['nullable', 'integer'],
            'expected_result' => ['nullable', 'string', 'max:255'],
            'actual_result' => ['nullable', 'string', 'max:255'],
            'actual_duration' => ['nullable', 'integer'],
            'priority_id' => ['nullable', 'integer'],
            'description' => ['nullable', 'string'],
            'begin_date' => ['nullable'],
            'end_date' => ['nullable']
        ];
    }
}
