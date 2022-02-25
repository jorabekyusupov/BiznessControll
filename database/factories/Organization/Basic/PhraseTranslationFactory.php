<?php

namespace Database\Factories\Organization\Basic;

use App\Models\Organization\Basic\Phrase\Phrase;
use App\Models\Organization\Basic\Phrase\PhraseTranslation;
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
            'object_id' => $this->faker->randomElement(Phrase::pluck('id')),
            'language_code' => $this->faker->randomElement(['uz', 'ru', 'en']),
            'translation' => $this->faker->word(),
        ];
    }
}
