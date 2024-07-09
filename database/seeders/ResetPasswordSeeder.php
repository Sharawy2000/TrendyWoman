<?php

namespace Database\Seeders;

use App\Models\ResetPassword;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResetPasswordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ResetPassword::factory(50)->create();
        
    }
}
