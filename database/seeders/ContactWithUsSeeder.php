<?php

namespace Database\Seeders;

use App\Models\ContactWithUS;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactWithUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContactWithUS::factory(8)->create();
        
    }
}
