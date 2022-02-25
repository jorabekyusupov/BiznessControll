<?php

namespace Database\Factories\Master;

use App\Models\Master\Organization;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrganizationFactory extends Factory
{
    protected $model=Organization::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->words($nb=1,$asText=true),
            'db_name'=>$this->faker->words($nb=1,$asText=true),
            'host_name'=>$this->faker->words($nb=1,$asText=true),
            'status'=>$this->faker->numberBetween($int1=1,$int2=10)
        ];
    }
}
