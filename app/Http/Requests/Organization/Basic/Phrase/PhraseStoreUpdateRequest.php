<?php

namespace App\Http\Requests\Organization\Basic\Phrase;

use Illuminate\Foundation\Http\FormRequest;

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
        $word = 'required';
        if (request()->isMethod('POST')) {
            $word = ['required',  'string', 'max:100','unique:byorkit_organization.phrases,word'];
        } elseif (request()->isMethod('PUT')) {
            $word = ['required',  'string', 'max:100','unique:byorkit_organization.phrases,word,' . $id];
        }
        return [
            'word' => $word,
            'page_id' => ['nullable', 'integer']
        ];
    }
}
