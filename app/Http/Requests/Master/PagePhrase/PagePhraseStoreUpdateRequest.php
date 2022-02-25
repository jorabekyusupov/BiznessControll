<?php

namespace App\Http\Requests\Master\PagePhrase;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PagePhraseStoreUpdateRequest extends FormRequest
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
        $id = $this->route('page_phrase');
        $page_id = request()->input('page_id');
        $phrase_id = request()->input('phrase_id');
        $unique = Rule::unique('page_phrases')->where(function ($query) use ($page_id, $phrase_id) {
            return $query->where('page_id', $page_id)
                ->where('phrase_id', $phrase_id);
        });
        if (request()->isMethod('PUT')) {
            $unique = $unique->ignore($id);
        }
        return [
            'page_id' => ['required', $unique, 'integer'],
            'phrase_id' => ['required', $unique, 'integer']
        ];
    }
}
