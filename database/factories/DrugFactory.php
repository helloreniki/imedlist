<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Drug>
 */
class DrugFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $unit = ['tablet', 'capsule', 'ml', 'drops'];
        $dosage_custom = fake()->boolean ? fake()->numberBetween(1,4) . '/day' : null;

        return [
          'name' => fake()->word(1),
          'concentration' => fake()->numberBetween(2, 500),
          'active_ingredient' => fake()->word(),
          'dosage_custom' => $dosage_custom,
          'dosage_morning' => $dosage_custom ? null : fake()->optional()->numberBetween(1,2),
          'dosage_midday' => $dosage_custom ? null : fake()->optional()->numberBetween(1,2),
          'dosage_evening' => $dosage_custom ? null : fake()->optional()->numberBetween(1,2),
          'unit' => fake()->randomElement($unit),
          'patient_id' => Patient::inRandomOrder()->first(),
        ];
    }
}
