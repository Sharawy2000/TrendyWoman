<?php

namespace Database\Seeders;

use App\Models\FQS;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FQSSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FQS::factory(30)->create();
        
    }
}
