<?php

namespace Database\Factories\Master\Phrase;

use App\Models\Master\Phrase\PhraseTranslation;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhraseTranslationFactory extends Factory
{
    protected $model = PhraseTranslation::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'object_id' => $this->faker->numberBetween(1, 50),
            'language_code' => $this->faker->name(),
            'translation' => $this->faker->name()
        ];
    }
}
