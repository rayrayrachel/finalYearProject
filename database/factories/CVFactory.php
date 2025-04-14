<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Application;
use App\Models\PersonalStatement;
use App\Models\ProfessionalExperience;
use App\Models\Education;
use App\Models\Skill;
use App\Models\Certification;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CV>
 */
class CVFactory extends Factory
{
    public function definition(): array
    {
        $application = Application::inRandomOrder()->first();

        $userId = $application?->user_id;
        $applicationId = $application?->id;

        $user = User::with('profile')->find($userId);

        return [
            'user_id' => $userId,
            'application_id' => $applicationId,

            'contact_information' => $user ? [
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->profile->phone_number ?? 'Not Provided',
                'location' => $user->profile->location ?? 'Not Provided',
                'date_of_birth' => $user->profile->date_of_birth ?? 'Not Provided',
            ] : [],

            'personal_statement' => PersonalStatement::where('user_id', $userId)
                ->inRandomOrder()
                ->first()?->only(['statement']) ?? null,

            'professional_experiences' => ProfessionalExperience::where('user_id', $userId)
                ->inRandomOrder()
                ->take(3)
                ->get()
                ->map(fn($exp) => $exp->only([
                    'job_title',
                    'company_name',
                    'location',
                    'start_date',
                    'end_date',
                    'key_achievements',
                    'quantifiable_results',
                ]))
                ->toArray(),

            'educations' => Education::where('user_id', $userId)
                ->inRandomOrder()
                ->take(2)
                ->get()
                ->map(fn($education) => $education->only([
                    'degree',
                    'field_of_study',
                    'university_name',
                    'graduation_date',
                    'grade',
                ]))
                ->toArray(),

            'skills' => Skill::where('user_id', $userId)
                ->inRandomOrder()
                ->take(3)
                ->get()
                ->map(fn($skill) => $skill->only(['skills']))
                ->toArray(),

            'certifications' => Certification::where('user_id', $userId)
                ->inRandomOrder()
                ->first()?->only([
                    'languages_spoken',
                    'certifications',
                    'awards',
                    'publications',
                    'presentations',
                    'relevant_activities',
                    'hobbies_and_interests',
                ]) ?? null,
        ];
    }
}
