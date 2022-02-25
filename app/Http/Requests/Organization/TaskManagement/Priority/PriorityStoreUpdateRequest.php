<?php

namespace App\Http\Requests\Organization\TaskManagement\Priority;

use Illuminate\Foundation\Http\FormRequest;

class PriorityStoreUpdateRequest extends FormRequest
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
        $id = $this->route('priority');
        $name = 'required';
        if (request()->isMethod('POST')) {
            $name = ['required',  'string', 'max:100','unique:byorkit_organization.tm_priorities,name'];
        } elseif (request()->isMethod('PUT')) {
            $name = ['required',  'string', 'max:100','unique:byorkit_organization.tm_priorities,name,' . $id];
        }
        return [
            'name' => $name
        ];
    }
}
