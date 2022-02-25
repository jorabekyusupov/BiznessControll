<?php

namespace Database\Factories;

use App\Models\Master\Organization;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model=User::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'username'=>$this->faker->unique()->email(),
            'name'=>$this->faker->words($nb=1,$asText=true),
            'phone'=>$this->faker->phoneNumber(),
            'default_database'=>$this->faker->words($nb=1,$asText=true),
            'verification_token'=>$this->faker->words($nb=1,$asText=true),
            'password'=>$this->faker->password(),
            'remember_token' => Str::random(10)
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
