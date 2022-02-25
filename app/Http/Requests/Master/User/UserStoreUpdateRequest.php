<?php

namespace App\Http\Requests\Master\User;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreUpdateRequest extends FormRequest
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
        $unique = '';
        $ignore = $this->route('username');
        if (request()->isMethod('POST')) {
            $unique = 'unique:users,username';
        } elseif (request()->isMethod('PUT')) {
            $unique = 'unique:users,username,'.$ignore;
        }
        return [
            'username' => ['required', 'email', 'max:255', $unique],
            'name' => ['nullable', 'string', 'max:50'],
            'phone' => ['nullable', 'string'],
            'host_name' => ['nullable', 'string']
        ];
    }
}
