<?php

namespace App\Http\Requests\Master\OrganizationModule;

use Illuminate\Foundation\Http\FormRequest;

class OrganizationModuleIndexRequest extends FormRequest
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
            'organization_id' => ['nullable', 'integer'],
            'page' => ['nullable'],
            'rows' => ['nullable'],
            'filter' => ['nullable'],
            'sort' => ['nullable']
        ];
    }
}
