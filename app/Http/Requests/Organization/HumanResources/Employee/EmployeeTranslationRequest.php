<?php

namespace App\Http\Requests\Organization\HumanResources\Employee;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeTranslationRequest extends FormRequest
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
            'translations.*.language_code' => ['nullable', 'string', 'max:100'],
            'translations.*.first_name' => ['nullable', 'string', 'max:50'],
            'translations.*.last_name' => ['nullable', 'string', 'max:50'],
            'translations.*.middle_name' => ['nullable', 'string', 'max:50']
        ];
    }
}
