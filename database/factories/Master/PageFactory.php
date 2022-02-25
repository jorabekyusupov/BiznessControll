<?php

namespace Database\Factories\Master;

use App\Models\Master\Page;
use Illuminate\Database\Eloquent\Factories\Factory;

class PageFactory extends Factory
{
    protected $model=Page::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->name(),
            'module_id'=>$this->faker->numberBetween(1,10),
            'page_link'=>$this->faker->word(1,true),
            'page_icon'=>$this->faker->word(1,true),
            'icon_type'=>$this->faker->numberBetween(1,10)

        ];
    }
}
