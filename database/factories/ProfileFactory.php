<?php

namespace Database\Factories;

use App\Models\Profile;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Profile::class;

    public function definition(): array
    {
        return [
            'is_company' => $this->faker->boolean(),
            'bio' => $this->faker->paragraph(),
            'website' => $this->faker->url(),
            //          'profile_picture' => $this->faker->imageUrl(640, 480, 'people'),
            'location' => $this->faker->city(),
            'phone_number' => $this->faker->phoneNumber(),
            'date_of_birth' => $this->faker->date('Y-m-d', '2000-01-01'),
        ];
    }

    public function forUser(int $userId, string $userName): self
    {
        return $this->state([
            'user_id' => $userId,
            'user_name' => $userName,
        ]);
    }
}
