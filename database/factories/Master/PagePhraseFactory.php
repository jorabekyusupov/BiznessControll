<?php

namespace Database\Factories\Master;

use App\Models\Master\PagePhrase;
use Illuminate\Database\Eloquent\Factories\Factory;

class PagePhraseFactory extends Factory
{
    protected $model=PagePhrase::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'page_id'=>$this->faker->unique()->numberBetween(1,150),
            'phrase_id'=>$this->faker->unique()->numberBetween(1,150)
        ];
    }
}
