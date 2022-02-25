<?php

namespace App\Http\Requests\Master\Organization;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrganizationStoreUpdateRequest extends FormRequest
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
        $id = $this->route('organization');
        $db_name = 'nullable';
        if (request()->isMethod('POST')) {
            $db_name = ['nullable', Rule::unique('Organizations')->withoutTrashed()];
        } elseif (request()->isMethod('PUT')) {
            $db_name = ['nullable', Rule::unique('Organizations')->withoutTrashed()->ignore($id)];
        }
        return [
            'name' => ['required', 'string', 'max:255'],
            'db_name' => [$db_name, 'string', 'max:25'],
            'host_name' => ['required', 'string', 'max:50'],
            'status' => ['nullable', 'integer']
        ];
    }
}
