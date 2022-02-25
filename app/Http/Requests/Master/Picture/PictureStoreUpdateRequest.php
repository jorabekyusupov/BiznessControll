<?php

namespace App\Http\Requests\Master\Picture;

use Illuminate\Foundation\Http\FormRequest;

class PictureStoreUpdateRequest extends FormRequest
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
            'object_type' => ['required', 'string'],
            'object_id' => ['required', 'integer'],
            'is_default' => ['nullable','boolean'],
            'picture_name' => ['nullable','string'],
            'physical_name' => ['nullable','string'],
            'picture' => 'nullable|file|image|mimes:jpeg,png,jpg,gif,ico,svg,webp|max:8192'
        ];
    }
}
