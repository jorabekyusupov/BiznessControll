<?php

namespace App\Http\Requests\Organization\AttendanceManagement\Attendance;

use Illuminate\Foundation\Http\FormRequest;

class AttendanceStoreUpdateRequest extends FormRequest
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

        if (request()->isMethod('POST')) {
            $employee_id = ['required'];
            $in = ['required'];
        } elseif (request()->isMethod('PUT')) {
            $employee_id = ['nullable'];
            $in = ['nullable'];
        }

        return [
            'employee_id' => $employee_id, 
            'in' => $in,
            'out' => ['nullable']
        ];
        
    }
}
