<?php

namespace Database\Factories;

use App\Models\User;
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
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'dob' => fake()->dateTimeBetween('-50years', '-30years'),
            'health_insurance_number' => fake()->randomNumber(8),
            'address' => fake()->address(),
            'phone' => fake()->phoneNumber(),
            'illness' => fake()->words(rand(0,3), true), // without true u get array
            'allergies' => fake()->words(rand(0,2), true),
            'emergency_contact' => fake()->firstName(),
            'user_id' => User::inRandomOrder()->first(),
        ];
    }
}
