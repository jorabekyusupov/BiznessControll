<?php

namespace App\Http\Requests\Organization\Basic\Phrase;

use Illuminate\Foundation\Http\FormRequest;

class PhraseTranslateRequest extends FormRequest
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
            'language_code' => ['required', 'string'],
            'translate_languages' => 'required',
            'page_id' => ['nullable', 'integer']
        ];
    }
}
