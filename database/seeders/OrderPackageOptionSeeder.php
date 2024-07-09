<?php

namespace Database\Seeders;

use App\Models\OrderPackageOptions;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderPackageOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OrderPackageOptions::factory(8)->create();
        
    }
}
