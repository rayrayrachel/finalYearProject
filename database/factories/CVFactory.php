<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Application;
use App\Models\ContactInformation;
use App\Models\PersonalStatement;
use App\Models\ProfessionalExperience;
use App\Models\Education;
use App\Models\Skill;
use App\Models\Certification;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CV>
 */
class CVFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $application = Application::inRandomOrder()->first();

        $userId = $application?->user_id;
        $applicationId = $application?->id;

        return [
            'user_id' => $userId,
            'application_id' => $applicationId,

            'contact_information' => ContactInformation::where('user_id', $userId)
                ->first()?->only(['full_name', 'title', 'phone_number', 'email', 'linkedin_profile', 'portfolio_website', 'location'])
                ?? [],

            'personal_statement' => PersonalStatement::where('user_id', $userId)
                ->inRandomOrder()
                ->limit(1)
                ->pluck('statement')
                ->first() ?? '',


            'professional_experiences' => ProfessionalExperience::where('user_id', $userId)
                ->inRandomOrder()
                ->take(3)
                ->get(['job_title', 'company_name', 'location', 'start_date', 'end_date', 'key_achievements', 'quantifiable_results'])
                ->map(fn($experience) => $experience->toArray())
                ->toArray() ?? [],

            'educations' => Education::where('user_id', $userId)
                ->inRandomOrder()
                ->take(2)
                ->get(['degree', 'field_of_study', 'university_name', 'graduation_date', 'grade'])
                ->map(fn($education) => $education->only(['degree', 'field_of_study', 'university_name', 'graduation_date', 'grade']))
                ->toArray() ?? [],

            'skills' => Skill::where('user_id', $userId)
                ->inRandomOrder()
                ->take(2)
                ->get(['skills'])
                ->map(fn($skill) => $skill->only(['skills']))
                ->toArray() ?? [],

            'certifications' => Certification::where('user_id', $userId)
                ->inRandomOrder()
                ->take(2)
                ->get(['languages_spoken', 'certifications', 'awards', 'publications', 'presentations', 'relevant_activities', 'hobbies_and_interests'])
                ->map(fn($certifications) => $certifications->only(['languages_spoken', 'certifications', 'awards', 'publications', 'presentations', 'relevant_activities', 'hobbies_and_interests']))
                ->toArray() ?? [],
        ];
    }
}
