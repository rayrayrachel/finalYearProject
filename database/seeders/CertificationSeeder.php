<?php

namespace Database\Seeders;

use App\Models\Certification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class CertificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usersWithoutCertifications  = User::whereHas('profile', function ($query) {
            $query->where('is_company', false);
        })->doesntHave('certifications')->get();


        foreach ($usersWithoutCertifications  as $user) {
            Certification::factory()
                ->count(rand(1, 5))
                ->for($user)
                ->create();
        }        
    }
}
