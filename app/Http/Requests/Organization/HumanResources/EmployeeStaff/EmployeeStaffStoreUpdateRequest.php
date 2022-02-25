<?php

namespace App\Http\Requests\Organization\HumanResources\EmployeeStaff;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeStaffStoreUpdateRequest extends FormRequest
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
            'employee_id' => ['required','integer'],
            'staff_id' => ['required','integer'],
            'is_active' => ['nullable','integer'],
            'is_main_staff' => ['nullable','integer'],
            'enter_date' => ['nullable','date'],
            'leave_date'=>['nullable','date']

        ];
    }
}
