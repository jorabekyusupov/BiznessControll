<?php

namespace Database\Factories\Master\Phrase;

use App\Models\Master\Phrase\Phrase;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhraseFactory extends Factory
{
    protected $model = Phrase::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'word' => $this->faker->unique()->words(2, true),
            'page_id' => $this->faker->numberBetween(1, true)
        ];
    }
}
