<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'status' => $this->faker->randomElement(['draft', 'published']),
            'user_id' => $this->faker->randomNumber(),
            'channel_id' => $this->faker->randomNumber(),
            'title' => $this->faker->word(),
            'slug' => $this->faker->slug(),
            'content' => $this->faker->word(),
            'is_nsfw' => $this->faker->boolean(),
            'is_spoiler' => $this->faker->boolean(),
            'is_locked' => $this->faker->boolean(),
            'is_pinned' => $this->faker->boolean(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
