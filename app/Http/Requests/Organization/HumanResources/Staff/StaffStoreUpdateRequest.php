<?php

namespace App\Http\Requests\Organization\HumanResources\Staff;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StaffStoreUpdateRequest extends FormRequest
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
        $id = $this->route('staff');
        $department_id = request()->input('department_id');
        $position_id = request()->input('position_id');
        $unique = Rule::unique('byorkit_organization.hr_staff')->where(function ($query) use ($department_id, $position_id) {
            return $query->where('department_id', $department_id)
                ->where('position_id', $position_id);
        });
        if (request()->isMethod('PUT')) {
            $unique = $unique->ignore($id);
        }
        return [
            "department_id" => ["required", 'integer'],
            "position_id" => ["required", 'integer'],
            "is_active" => ["required",'integer']
        ];
    }
}
