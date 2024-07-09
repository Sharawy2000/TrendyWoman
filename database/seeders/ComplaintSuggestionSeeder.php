<?php

namespace Database\Seeders;

use App\Models\ComplaintSuggestion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComplaintSuggestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ComplaintSuggestion::factory(15)->create();
        
    }
}
