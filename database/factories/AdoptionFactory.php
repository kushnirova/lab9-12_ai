<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Adoption>
 */
class AdoptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'guinea_pig_id' => \App\Models\GuineaPig::factory(),
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
            'notes' => $this->faker->sentence(),
        ];
    }
}
