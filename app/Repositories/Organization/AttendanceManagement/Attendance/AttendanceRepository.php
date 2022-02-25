<?php

namespace App\Repositories\Organization\AttendanceManagement\Attendance;

use App\Models\Organization\AttendanceManagement\Attendance\Attendance;
use App\Repositories\Repository;

class AttendanceRepository extends Repository
{
    public function __construct(Attendance $attendance)
    {
        $this->model = $attendance;
    }
}
