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
        $applicationsWithoutCV = Application::doesntHave('cV')->get();

        foreach ($applicationsWithoutCV as $application) {
            CV::factory()
                ->create();
        }
    }
}
