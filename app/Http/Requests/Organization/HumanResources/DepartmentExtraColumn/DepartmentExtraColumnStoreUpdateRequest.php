<?php

namespace App\Http\Requests\Organization\HumanResources\DepartmentExtraColumn;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DepartmentExtraColumnStoreUpdateRequest extends FormRequest
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
        $id = $this->route('department_extra_column');
        $department_id = request()->input('department_id');
        $extra_column_id = request()->input('extra_column_id');
        $unique = Rule::unique('byorkit_organization.hr_department_extra_columns')->where(function ($query) use (
            $department_id,
            $extra_column_id
        ) {
            return $query->where('extra_column_id', $extra_column_id)
                ->where('department_id', $department_id);
        });
        if (request()->isMethod('PUT')) {
            $unique = $unique->ignore($id);
        }
        return [
            'department_id' => [$unique, 'integer', 'required'],
            'extra_column_id' => [$unique, 'integer', 'required'],
            'value' => ['string', 'required', 'max:255']
        ];
    }
}
