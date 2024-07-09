<?php

namespace Database\Seeders;

use App\Models\HomePageSlide;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HomePageSlideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HomePageSlide::factory(8)->create();
        
    }
}
