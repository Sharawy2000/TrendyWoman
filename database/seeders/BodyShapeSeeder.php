<?php

namespace Database\Seeders;

use App\Models\BodyShape;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BodyShapeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BodyShape::factory(8)->create();
    }
}
