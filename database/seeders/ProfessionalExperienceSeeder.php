<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProfessionalExperience;
use App\Models\User;

class ProfessionalExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usersWithoutProfessionalExperience = User::whereHas('profile', function ($query) {
            $query->where('is_company', false);
        })->doesntHave('professionalExperiences')->get();


        foreach ($usersWithoutProfessionalExperience as $user) {
            ProfessionalExperience::factory()
                ->count(rand(1, 5))
                ->for($user)
                ->create();
        }       
    }
}
