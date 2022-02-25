<?php

namespace App\Http\Requests\Organization\TaskManagement\EmployeeFavoriteTask;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;

class EmployeeFavoriteTaskStoreUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    #[ArrayShape(['employee_id' => "array", 'task_id' => "array"])] public function rules(): array
    {    $id = $this->route('employee_favorite_task');
        $employee_id = request()->input('employee_id');
        $task_id = request()->input('task_id');
        $unique = Rule::unique('byorkit_organization.tm_employee_favorite_tasks')->where(function ($query) use ($employee_id, $task_id) {
            return $query->where('task_id', $task_id)
                ->where('employee_id', $employee_id);
        });
        if (request()->isMethod('PUT')) {
            $unique = $unique->ignore($id);
        }
        return [
            'employee_id' => ['integer', $unique],
            'task_id' => ['integer', $unique]
        ];
    }
}
