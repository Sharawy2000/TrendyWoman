<?php

namespace Database\Seeders;

use App\Models\SystemText;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SystemTextSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SystemText::factory(20)->create();
        
    }
}
