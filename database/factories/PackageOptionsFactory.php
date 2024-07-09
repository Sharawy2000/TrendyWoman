<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PackageOptions>
 */
class PackageOptionsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'package_id'=>rand(1,10),
            'type' => fake()->text(10),
            'value' => fake()->text(10),
            'price' => fake()->numberBetween(100, 1000),

        ];
    }
}
