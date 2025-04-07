<?php

namespace Database\Factories;

use App\Models\Profile;

use App\Models\JobPost;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobPost>
 */
class JobPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = JobPost::class;

    public function definition(): array
    {
        return [
            'user_id' => Profile::where('is_company', true)->inRandomOrder()->first()?->id ?? Profile::factory(),
            'title' => $this->faker->jobTitle(),
            'description' => $this->faker->paragraph(4),
            'requirements' => $this->faker->paragraph(3),
            'salary_range' => $this->faker->randomElement(['$40k-$60k', '$60k-$80k', '$80k-$100k']),
            'location' => $this->faker->address(),
            'created_at' => now(),
            'updated_at' => now(),        ];
    }
}
