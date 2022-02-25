<?php

namespace App\Http\Requests\Master\OrganizationModule;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class OrganizationModuleStoreUpdateRequest extends FormRequest
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
        $id = $this->route('organization_module');
        $organization_id = request()->input('organization_id');
        $module_id = request()->input('module_id');
        $unique = Rule::unique('organization_modules')->where(function ($query) use ($organization_id, $module_id) {
            return $query->where('organization_id', $organization_id)
                ->where('module_id', $module_id);
        });
        if (request()->isMethod('PUT')) {
            $unique = $unique->ignore($id);
        }
        return [
            'organization_id' => ['required', $unique, 'integer'],
            'module_id' => ['required', $unique, 'integer'],
            'status' => ['nullable', 'boolean']
        ];
    }
}
