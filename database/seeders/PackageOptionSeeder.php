<?php

namespace Database\Seeders;

use App\Models\PackageOptions;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PackageOptions::factory(8)->create();
        
    }
}
