<?php

namespace App\Http\Requests\Organization\Basic\Module;

use Illuminate\Foundation\Http\FormRequest;

class ModuleStoreUpdateRequest extends FormRequest
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
        $id = $this->route('module');
        $module_id = 'nullable';
        if (request()->isMethod('POST')) {
            $module_id = ['nullable', 'unique:modules,module_id'];
        } elseif (request()->isMethod('PUT')) {
            $module_id = ['nullable', 'unique:modules,module_id,' . $id];
        }
        return [
            'module_id'=>[$module_id,'integer'],
            'is_active'=>["nullable",'integer']
        ];
    }
}
