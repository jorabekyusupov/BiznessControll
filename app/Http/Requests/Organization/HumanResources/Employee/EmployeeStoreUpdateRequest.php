<?php

namespace App\Http\Requests\Organization\HumanResources\Employee;


use Illuminate\Foundation\Http\FormRequest;

class EmployeeStoreUpdateRequest extends FormRequest
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
            'user_id' => ['nullable', 'integer'],
            'nationality_id' => ['nullable', 'integer'],
            'born_date' => ['nullable', 'date'],
            'gender' => ['nullable', 'integer'],
            'phone' => ['nullable', 'string', 'max:100'],
            'first_work_date' => ['nullable', 'date'],
            'contract_number' => ['nullable', 'string', 'max:30'],
            'contract_date' => ['nullable', 'date'],
            'phone' => ['nullable', 'string', 'max:100'],
            'telegram' => ['nullable', 'string', 'max:100'],
            'note' => ['nullable', 'string'],
            'responsible_id' => ['nullable', 'integer'],
            'inn' => ['nullable', 'integer'],
            'inps' => ['nullable', 'numeric'],
            'is_accessible' => ['nullable', 'integer'],
            'employee_main_staff_id' => ['nullable', 'integer'],
        ];
    }
}
