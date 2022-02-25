<?php

namespace Database\Factories\Master;

use App\Models\Master\Picture;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

class PictureFactory extends Factory
{
    protected $model = Picture::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'object_type' => $this->faker->name(),
            'object_id' => $this->faker->numberBetween(1,50),
            'is_default' => $this->faker->boolean(),
            'picture_name' => UploadedFile::fake()->image($this->faker->name()),
            'physical_name' => UploadedFile::fake()->image($this->faker->name())
        ];
    }
}
