<?php

namespace Database\Seeders;

use App\Models\OrderResponse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderResponseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OrderResponse::factory(100)->create();
        
    }
}
