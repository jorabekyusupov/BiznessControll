<?php

namespace App\Http\Requests\Master\Permission;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PermissionStoreUpdateRequest extends FormRequest
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
        $id = $this->route('permission');
        $name = ['required', 'string'];
        if (request()->isMethod('POST')) {
            $name = ['required', 'string', Rule::unique('permissions')];
        } elseif (request()->isMethod('PUT')) {
            $name = ['required', 'string', Rule::unique('permissions')->ignore($id)];
        }
        return [
            'name' => $name,
            'display_name' => ['nullable', 'string'],
            'description' => ['nullable', 'string']
        ];
    }
}
