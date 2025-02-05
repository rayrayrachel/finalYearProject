<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(ProfileSeeder::class);
        $this->call(JobPostSeeder::class);
        $this->call(ApplicationSeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(ContactInformationSeeder::class);
        $this->call(PersonalStatementSeeder::class);
        $this->call(ProfessionalExperienceSeeder::class);
        $this->call(EducationSeeder::class);
        $this->call(SkillSeeder::class);
        $this->call(CertificationSeeder::class);


    }
}
