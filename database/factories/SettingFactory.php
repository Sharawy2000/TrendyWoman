<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Setting>
 */
class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'contact_id'=>rand(1,5),
            'text_id'=>rand(1,20),
            'terms_conditions'=> fake()->text(100),
            'who_are_we'=> fake()->text(100),
            
        ];
    }
}
