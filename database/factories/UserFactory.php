<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use function bcrypt;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'country_id' => 1,
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'username' => $this->faker->userName(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('8c723e04A'),
            'phone' => $this->faker->phoneNumber(),
            'email_verified_at' => now(),
            'phone_verified_at' => now(),
            'blocked_at' => null,
            'bio' => $this->faker->sentence(),
            'display_name' => $this->faker->firstName(),
            'gender' => $this->faker->randomElement(['man', 'woman', 'none'])
        ];
    }
}
