<?php

namespace App\Http\Requests\Organization\TaskManagement\FolderEmployee;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;

class FolderEmployeeStoreUpdateRequest extends FormRequest
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
    #[ArrayShape(['employee_id' => "array", 'folder_id' => "array"])] public function rules(): array
    {    $id = $this->route('folder_employee');
        $employee_id = request()->input('employee_id');
        $folder_id = request()->input('folder_id');
        $unique = Rule::unique('byorkit_organization.tm_folder_employees')->where(function ($query) use ($employee_id, $folder_id) {
            return $query->where('folder_id', $folder_id)
                ->where('employee_id', $employee_id);
        });
        if (request()->isMethod('PUT')) {
            $unique = $unique->ignore($id);
        }
        return [
            'employee_id' => ['integer', $unique],
            'folder_id' => ['integer', $unique]
        ];
    }
}
