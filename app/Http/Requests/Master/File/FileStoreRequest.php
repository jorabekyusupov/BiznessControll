<?php

namespace App\Http\Requests\Master\File;

use Illuminate\Foundation\Http\FormRequest;

class FileStoreRequest extends FormRequest
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
            'object_type' => ['string', 'required'],
            'object_id' => ['integer', 'required'],
            'file_name' => ['string', 'nullable'],
            'file_caption' => ['string', 'nullable'],
            'physical_name' => ['string', 'nullable'],
            'file' => ['nullable', 'file', 'max:8192']
        ];
    }
}
