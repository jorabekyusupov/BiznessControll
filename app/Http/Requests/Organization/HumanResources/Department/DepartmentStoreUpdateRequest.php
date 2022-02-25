<?php

namespace App\Http\Requests\Organization\HumanResources\Department;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentStoreUpdateRequest extends FormRequest
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
            "parent_id" => ['nullable', 'integer'],
            "department_type_id" => ['required', 'integer'],
            'sequence' => ['nullable','integer'],
            'single_block' => ['nullable','boolean'],
            'block_color' => ['nullable','string','max:25'],
            'background_color' => ['nullable','string','max:25'],
            'text_color' => ['nullable','string','max:25'],
            "code" => ['required', 'string', 'max:15']
        ];
    }
}
