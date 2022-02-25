<?php

namespace App\Http\Requests\Master\Phrase;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PhraseStoreUpdateRequest extends FormRequest
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
        $id = $this->route('phrase');
        $word = ['required', 'string'];
        if (request()->isMethod('POST')) {
            $word = ['required' ,'string', Rule::unique('phrases')->withoutTrashed()];
        } elseif (request()->isMethod('PUT')) {
            $word = ['required' ,'string', Rule::unique('phrases')->withoutTrashed()->ignore($id)];
        }
        return [
            'word' => $word,
            'page_id' => ['nullable', 'integer']
        ];
    }
}
