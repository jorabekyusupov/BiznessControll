<?php

namespace Database\Factories\Organization\TaskManagement;

use App\Models\Organization\TaskManagement\Priority\Priority;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PriorityFactory extends Factory
{
    protected $model = Priority::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => Str::random(10),
        ];
    }
}
