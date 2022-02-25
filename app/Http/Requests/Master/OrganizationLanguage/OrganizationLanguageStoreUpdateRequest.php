<?php

namespace App\Http\Requests\Master\OrganizationLanguage;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrganizationLanguageStoreUpdateRequest extends FormRequest
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
        $id = $this->route('organization_language');
        $organization_id = request()->input('organization_id');
        $language_id = request()->input('language_id');
        $unique = Rule::unique('organization_languages')
            ->where(function ($query) use ($organization_id, $language_id) {
                return $query->where('organization_id', $organization_id)
                    ->where('language_id', $language_id);
            });
        if (request()->isMethod('PUT')) {
            $unique = $unique->ignore($id);
        }
        return [
            'organization_id' => ['required', 'integer', $unique],
            'language_id' => ['required', 'integer', $unique],
            'is_default' => ['boolean', 'nullable']
        ];
    }
}
