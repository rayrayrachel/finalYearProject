<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ContactInformation;
use App\Models\User;



class ContactInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $usersWithoutContactInformation = User::whereHas('profile', function ($query) {
            $query->where('is_company', false);
        })->doesntHave('contactInformation')->get();

            
        foreach ($usersWithoutContactInformation as $user) {
            ContactInformation::factory()
                ->for($user) 
                ->create();
        }    
    }
}
