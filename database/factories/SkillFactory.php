<?php

namespace Database\Factories;

use App\Models\Profile;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Skill>
 */
class SkillFactory extends Factory
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
            'skills' => $this->faker->word(),

        ];
    }
}
