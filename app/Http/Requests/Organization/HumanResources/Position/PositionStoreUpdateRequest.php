<?php

namespace App\Http\Requests\Organization\HumanResources\Position;


use Illuminate\Foundation\Http\FormRequest;

class PositionStoreUpdateRequest extends FormRequest
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
            "position_type_id" => ["nullable",'integer'],
            "code" => ["nullable",'string','max:15']


        ];
    }
}
