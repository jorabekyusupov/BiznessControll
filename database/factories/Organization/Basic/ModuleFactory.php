<?php

namespace Database\Factories\Organization\Basic;

use App\Models\Master\Module as MasterModule;
use App\Models\Organization\Basic\Module\Module;
use Illuminate\Database\Eloquent\Factories\Factory;

class ModuleFactory extends Factory
{
    protected $model = Module::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'module_id' => $this->faker->randomElement(MasterModule::pluck('id')),
            'is_active' => $this->faker->randomElement([1,0]),
        ];
    }
}
