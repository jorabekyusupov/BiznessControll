<?php

namespace Database\Factories\Organization\AttendanceManagement;

use App\Models\Organization\AttendanceManagement\Attendance\Attendance;
use App\Models\Organization\Basic\Employee\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttendanceFactory extends Factory
{
    protected $model = Attendance::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $in = time();
        $duration = 8*60*60;
        $out = $in + $duration;
        
        return [
            'employee_id' => $this->faker->randomElement(Employee::pluck('id')),
            'in' => $in,
            'out' => $out,
            'duration' => $duration,
        ];
    }
}
