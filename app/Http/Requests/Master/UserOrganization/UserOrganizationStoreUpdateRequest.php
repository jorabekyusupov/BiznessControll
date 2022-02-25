<?php

namespace App\Http\Requests\Master\UserOrganization;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserOrganizationStoreUpdateRequest extends FormRequest
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
        $id = $this->route('user_organization');
        $organization_id = request()->input('organization_id');
        $user_id = request()->input('user_id');
        $unique = Rule::unique('user_organizations')->where(function ($query) use ($organization_id, $user_id) {
            return $query->where('organization_id', $organization_id)
                ->where('user_id', $user_id);
        });
        if (request()->isMethod('PUT')) {
            $unique = $unique->ignore($id);
        }
        return [
            'user_id' => ['required', $unique],
            'organization_id' => ['required', $unique]
        ];
    }
}
