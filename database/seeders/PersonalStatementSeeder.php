<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PersonalStatement;
use App\Models\User;

class PersonalStatementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usersWithoutPersonalStatement = User::whereHas('profile', function ($query) {
            $query->where('is_company', false);
        })->doesntHave('personalStatements')->get();


        foreach ($usersWithoutPersonalStatement as $user) {
            PersonalStatement::factory()
                ->count(rand(1, 5))
                ->for($user)
                ->create();
        }    
    }
}
