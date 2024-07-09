<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderResponse>
 */
class OrderResponseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'=>rand(1,20),
            'order_id'=>rand(1,20),
            'response'=>rand(0,1),
            'msg'=>fake()->text(),
        ];
    }
}
