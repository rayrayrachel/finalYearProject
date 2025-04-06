<?php

namespace Database\Factories;

use App\Models\Profile;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'hunter_id' => Profile::inRandomOrder()->first()?->id ?? Profile::factory(),
            'company_id' => Profile::where('is_company', true)->inRandomOrder()->first()?->id ?? Profile::factory(),
            'content' => $this->faker->paragraph(),
            ];
    }
}
