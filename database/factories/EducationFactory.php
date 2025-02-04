<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Profile;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Education>
 */
class EducationFactory extends Factory
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
            'degree' => $this->faker->randomElement(['BSc', 'MSc', 'PhD']),
            'field_of_study' => $this->faker->word(),
            'university_name' => $this->faker->company() . ' University',
            'graduation_date' => $this->faker->date(),
            'grade' => $this->faker->randomElement(['First Class', '2:1', '2:2']),
        ];
    }
}
