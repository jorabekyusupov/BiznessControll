<?php

namespace App\Http\Requests\Organization\TaskManagement\TaskExtraColumn;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskExtraColumnStoreUpdateRequest extends FormRequest
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
        $id = $this->route('task_extra_column');
        $task_id = request()->input('task_id');
        $extra_column_id = request()->input('extra_column_id');
        $unique = Rule::unique('byorkit_organization.tm_task_extra_columns')->where(function ($query) use ($extra_column_id, $task_id) {
            return $query->where('task_id', $task_id)
                ->where('extra_column_id', $extra_column_id);
        });
        if (request()->isMethod('PUT')) {
            $unique = $unique->ignore($id);
        }
        return [
            'task_id' => ['integer', 'required',$unique],
            'extra_column_id' => ['integer', 'required',$unique],
            'value' => ['nullable','string', 'max:255'],
        ];
    }
}
