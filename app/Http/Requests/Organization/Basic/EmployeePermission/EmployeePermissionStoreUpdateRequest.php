<?php

namespace App\Http\Requests\Organization\Basic\EmployeePermission;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeePermissionStoreUpdateRequest extends FormRequest
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

        $id = $this->route('employee_permission');
        $employee_id = request()->input('employee_id');
        $permission_id = request()->input('permission_id');
        $unique = Rule::unique('byorkit_organization.hr_employee_permissions')->where(function ($query) use ($employee_id, $permission_id) {
            return $query->where('permission_id', $permission_id)
                ->where('employee_id', $employee_id);
        });
        if (request()->isMethod('PUT')) {
            $unique = $unique->ignore($id);
        }
        return [
            'employee_id' => ['required','integer'],
            'permission_id' => ['required','integer']
        ];
    }
}
