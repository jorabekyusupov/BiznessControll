<?php

namespace App\Http\Resources\Organization\AttendanceManagement\Attendance;

use Illuminate\Http\Resources\Json\JsonResource;

class AttendanceResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'employee_id' => $this->employee_id,
            'in' => date("Y-m-d H:i:s", $this->in),
            'out' => date("Y-m-d H:i:s", $this->out),
            'duration' => $this->duration / 60,
            'created_at' => $this->created_at->format("Y-m-d H:i:s"),
            'updated_at' => $this->updated_at->format("Y-m-d H:i:s"),
        ];
    }
}
