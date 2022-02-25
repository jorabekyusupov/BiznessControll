<?php

namespace Database\Factories\Master;

use App\Models\Master\File;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

class FileFactory extends Factory
{
    protected $model=File::class;
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
            'file_name' => UploadedFile::fake()->image($this->faker->name()),
            'physical_name' => UploadedFile::fake()->image($this->faker->name())
        ];
    }
}
