<?php

namespace App\Http\Requests\Organization\HumanResources\Department;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentTranslationRequest extends FormRequest
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
            'translations.*.id' => ['nullable'],
            'translations.*.object_id' => ['nullable','integer'],
            'translations.*.name' => ['nullable','string','max:50'],
            'translations.*.language_code' => ['nullable','string','max:100']
        ];
    }
}
