<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Education;
use App\Models\User;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usersWithoutEducation = User::whereHas('profile', function ($query) {
            $query->where('is_company', false);
        })->doesntHave('Educations')->get();


        foreach ($usersWithoutEducation as $user) {
            Education::factory()
                ->count(rand(1, 5))
                ->for($user)
                ->create();
        }        
    }
}
