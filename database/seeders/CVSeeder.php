<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CV;
use App\Models\Application;

class CVSeeder extends Seeder
{
    public function run(): void
    {
        CV::factory()->count(90)->create();
    }
}
