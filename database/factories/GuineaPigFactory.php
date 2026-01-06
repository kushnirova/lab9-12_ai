<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GuineaPig>
 */
class GuineaPigFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName(),
            'age' => $this->faker->numberBetween(1, 8),
            'category_id' => \App\Models\Category::factory(),
            'description' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(['available', 'hotel', 'adopted']),
            'image_path' => $this->faker->imageUrl(),
        ];
    }
}
