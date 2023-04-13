<?php

namespace Database\Seeders;

use App\Models\Channel;
use App\Models\Country;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DummyDataSeeder extends Seeder
{
    public function run()
    {
        if(Country::query()->count() == 0) {
            Country::query()->create([
                'name' => 'Türkiye',
                'iso_code' => 'TUR',
            ]);

            Country::query()->create([
                'name' => 'United Kingdom',
                'iso_code' => 'GBR',
            ]);

            Country::query()->create([
                'name' => 'United States',
                'iso_code' => 'USA',
            ]);
        }

        User::factory()->count(10)->create();

        Channel::factory()->count(10)->create([
            'user_id' => User::query()->inRandomOrder()->first()->id
        ]);

        Post::factory()->count(10)->create([
            'user_id' => User::query()->inRandomOrder()->first()->id,
            'channel_id' => Channel::query()->inRandomOrder()->first()->id,
        ]);

    }
}
