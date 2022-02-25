<?php

namespace Database\Factories\Organization\Basic;

use App\Models\Organization\Basic\Phrase\Phrase;
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
            'word' => $this->faker->unique()->word(),
        ];
    }
}
