<?php

namespace App\Http\Requests\Organization\Basic\ExtraColumn;

use Illuminate\Foundation\Http\FormRequest;

class ExtraColumnTranslationRequest extends FormRequest
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
            'task_id'=> ['required', 'integer'],
            'text'=> ['required', 'string'],
            'reply_employee_id'=> ['nullable', 'integer']
        ];
    }
}
