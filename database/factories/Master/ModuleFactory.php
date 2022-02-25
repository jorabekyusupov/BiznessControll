<?php

namespace Database\Factories\Master;

use App\Models\Master\Module;
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
            'name' => $this->faker->words($nb=1,$asText=true) ,
            'icon_name' => $this->faker->words($nb=1,$asText=true) ,
            'module_link' => $this->faker->words($nb=1,$asText=true) ,
            'icon_type' => $this->faker->numberBetween($int1 = 0, $int2 = 10)
        ];
    }
}
