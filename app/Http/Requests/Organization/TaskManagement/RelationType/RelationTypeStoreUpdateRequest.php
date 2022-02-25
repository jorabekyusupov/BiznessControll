<?php

namespace App\Http\Requests\Organization\TaskManagement\RelationType;

use Illuminate\Foundation\Http\FormRequest;

class RelationTypeStoreUpdateRequest extends FormRequest
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
        $id = $this->route('relation_type');
        $name = 'required';
        if (request()->isMethod('POST')) {
            $name = ['required',  'string', 'max:100','unique:byorkit_organization.tm_relation_types,name'];
        } elseif (request()->isMethod('PUT')) {
            $name = ['required',  'string', 'max:100','unique:byorkit_organization.tm_relation_types,name,' . $id];
        }
        return [
            'name' => $name,
            'type' => ['nullable']
        ];
    }
}
