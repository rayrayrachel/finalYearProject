<?php

namespace Database\Factories;

use App\Models\Profile;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Certification>
 */
class CertificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => Profile::where('is_company', true)->inRandomOrder()->first()?->id ?? Profile::factory(),
            'languages_spoken' => implode(', ', $this->faker->words(rand(1, 3))),
            'certifications' => implode(', ', $this->faker->words(rand(1, 2))),
            'awards' => implode(', ', $this->faker->words(rand(1, 2))),
            'publications' => implode(', ', $this->faker->words(rand(1, 2))),
            'presentations' => implode(', ', $this->faker->words(rand(1, 2))),
            'relevant_activities' => implode(', ', $this->faker->words(rand(2, 4))),
            'hobbies_and_interests' => implode(', ', $this->faker->words(rand(2, 4))),
        ];
    }
}
