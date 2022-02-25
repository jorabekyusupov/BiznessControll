<?php

namespace App\Http\Requests\Organization\TaskManagement\Status;

use Illuminate\Foundation\Http\FormRequest;

class StatusStoreUpdateRequest extends FormRequest
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
        $id = $this->route('status');
        $name = 'required';
        if (request()->isMethod('POST')) {
            $name = ['required', 'string', 'max:100', 'unique:byorkit_organization.tm_statuses,name'];
        } elseif (request()->isMethod('PUT')) {
            $name = ['required', 'string', 'max:100', 'unique:byorkit_organization.tm_statuses,name,' . $id];
        }
        return [
            'name' => $name,
            'color' => ['nullable', 'string'],
            'sequence' => ['nullable', 'integer']
        ];
    }
}
