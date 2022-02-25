<?php

namespace App\Http\Requests\Master\Page;

use Illuminate\Foundation\Http\FormRequest;

class PageStoreUpdateRequest extends FormRequest
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
            "name" => ['required', 'string', 'max:100'],
            "module_id" => ['required', 'integer'],
            'page_link' => ['nullable', 'string'],
            'page_icon' => ['nullable', 'string'],
            'icon_type' => ['nullable', 'integer']
        ];
    }
}
