<?php

namespace App\Http\Requests\Organization\TaskManagement\Folder;

use Illuminate\Foundation\Http\FormRequest;

class FolderStoreUpdateRequest extends FormRequest
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
           'parent_id' => ['nullable'],
            'name' => ['required']

        ];
    }
}
