<?php

namespace App\Http\Resources\Organization\HumanResources;

use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'department_type' => $this->department_type_id,
            'sequence' => $this->sequense,
            'single_block' => $this->single_block,
            'block_color' => $this->block_color,
            'background_color' => $this->background_color,
            'text_color' => $this->text_color,
            'department_translation_id' => $this->department_translation_id,
            'code' => $this->code,
            'language_code' => $this->language_code,
            'name' => $this->name,
            'dt_sequence' => $this->sequence,
            'dt_language_code' => $this->dt_language_code,
            'dt_name' => $this->dt_name
        ];
    }
}
