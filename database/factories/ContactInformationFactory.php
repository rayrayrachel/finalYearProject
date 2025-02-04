<?php

namespace Database\Factories;

use App\Models\Profile;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ContactInformation>
 */
class ContactInformationFactory extends Factory
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
            'full_name' => $this->faker->name(),
            'title' => $this->faker->jobTitle(),
            'phone_number' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'linkedin_profile' => $this->faker->url(),
            'portfolio_website' => $this->faker->url(),
            'location' => $this->faker->city() . ', ' . $this->faker->country(),
             ];
    }
}
