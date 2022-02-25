<?php

namespace App\Http\Requests\Organization\TaskManagement\TaskTag;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskTagStoreUpdateRequest extends FormRequest
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
        $id = $this->route('task_tags');
        $task_id = request()->input('task_id');
        $tag_id = request()->input('tag_id');
        $unique = Rule::unique('byorkit_organization.tm_task_tags')->where(function ($query) use ($tag_id, $task_id) {
            return $query->where('task_id', $task_id)
                ->where('tag_id', $tag_id);
        });
        if (request()->isMethod('PUT')) {
            $unique = $unique->ignore($id);
        }
        return [
            'tag_id' => ['required', 'integer', $unique],
            'task_id' => ['required', 'integer', $unique]
        ];
    }
}
