<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserUpdate>
 */
class UserUpdateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => rand(1,20),
            'code' => fake()->unique()->numberBetween(100000,999999),
            'new_phone'=>fake()->phoneNumber()
        ];
    }
}
