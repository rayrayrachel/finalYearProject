<?php

namespace Database\Seeders;


use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usersWithoutProfile = User::doesntHave('Profile')->get();

        foreach ($usersWithoutProfile as $user) {
            Profile::factory()
                ->forUser($user->id, $user->name) // Pass user_id and user_name
                ->create();
        }    
    }
}
