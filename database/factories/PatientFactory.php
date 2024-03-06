<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       return [
            'firstname' => fake()->firstName(),
            'lastname' => fake()->lastName(),
            'gender' => fake()->randomElement(['male', 'female']),
            'qid' => fake()->numberBetween(111111111, 999999999),
            'password' => bcrypt(fake()->password),
            'birthday' => fake()->dateTimeBetween('-80 years', '-18 years')
        ];
    }
}
