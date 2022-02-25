<?php

namespace App\Http\Requests\Master\Phrase;

use Illuminate\Foundation\Http\FormRequest;

class PhraseTranslationRequest extends FormRequest
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
            'translations.*.id' => ['nullable'],
            'translations.*.phrase_id' => ['nullable', 'integer'],
            'translations.*.language_code' => ['required', 'string'],
            'translations.*.translation' => ['nullable', 'string']
        ];
    }
}
