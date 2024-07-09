<?php

namespace Database\Seeders;

use App\Models\SuccessPartner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuccessPartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SuccessPartner::factory(8)->create();
        
    }
}
