<?php

namespace App\Http\Requests\Organization\TaskManagement\History;

use Illuminate\Foundation\Http\FormRequest;

class HistoryStoreUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
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
            'task_id' => ['required', 'integer'],
            'type_id' => ['required','integer'],
            'old' => ['nullable', 'string', 'max:255'],
            'new' => ['nullable', 'string', 'max:255'],
            'user_id' => ['required', 'integer'],
            'type' => ['required'],
        ];
    }
}
