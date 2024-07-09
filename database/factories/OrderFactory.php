<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
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
            'package_id' => rand(1,8),
            'size_id' => rand(1,5),
            'body_shape_id' => rand(1,8),
            'user_name' => fake()->name(),
            'user_phone'=>fake()->phoneNumber(),
            'age'=>rand(18,50),
            'gender'=>fake()->randomElement(['Male','Female']),
            'occation'=>fake()->randomElement(['Casual','Formal']),
            'occation_date'=>fake()->date(),
            'balance'=>rand(100,10000),
            'value_added'=>rand(10,100),
            'order_price'=>rand(500,5000),
            'rating'=>rand(1,5),
            'status'=>fake()->randomElement(['pending', 'processing', 'completed', 'cancelled']),
            'image'=>fake()->imageUrl(640,480),
            'cancel_reason'=>fake()->text(),
        ];
    }
}
