<?php

namespace App\Http\Requests\Organization\HumanResources\DepartmentType;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentTypeTranslationRequest extends FormRequest
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
            'translations.*.object_id' => ['nullable', 'integer'],
            'translations.*.language_code' => ['required', 'string', 'max:15'],
            'translations.*.name' => ['nullable', 'string', 'max:50']
        ];
    }
}
