<?php

namespace App\Http\Requests\Organization\HumanResources\Department;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentIndexRequest extends FormRequest
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
            'page' => ['nullable'],
            'rows' => ['nullable'],
            'filter' => ['nullable'],
            'sort' => ['nullable']
        ];
    }
}
