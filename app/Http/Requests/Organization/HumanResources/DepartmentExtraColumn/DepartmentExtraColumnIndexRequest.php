<?php

namespace App\Http\Requests\Organization\HumanResources\DepartmentExtraColumn;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentExtraColumnIndexRequest extends FormRequest
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
            'department_id' => ['nullable', 'integer'],
            'page' => ['nullable'],
            'rows' => ['nullable'],
            'filter' => ['nullable'],
            'sort' => ['nullable']
        ];
    }
}
