<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Skill;
use App\Models\User;


class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usersWithoutSkills = User::whereHas('profile', function ($query) {
            $query->where('is_company', false);
        })->doesntHave('skills')->get();


        foreach ($usersWithoutSkills as $user) {
            Skill::factory()
                ->count(rand(1, 5))
                ->for($user)
                ->create();
        }    
    }
}
